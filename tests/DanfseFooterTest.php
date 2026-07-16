<?php

namespace DanfseNacional\Tests;

use DanfseNacional\DanfseGenerator;
use PHPUnit\Framework\TestCase;

class DanfseFooterTest extends TestCase
{
    private string $realXml;
    private string $html;

    protected function setUp(): void
    {
        $path = __DIR__ . '/../examples/35489062255036530000181000000000653426072486424961.xml';
        $this->realXml = file_get_contents($path);
        $this->assertNotFalse($this->realXml, "XML canônico não encontrado em $path");

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->realXml);
        $this->html = $generator->generateHtml($nfse);
    }

    private function loadDom(): \DOMDocument
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $this->html);
        libxml_clear_errors();
        return $dom;
    }

    public function test_footer_is_last_child_of_page_wrapper(): void
    {
        $dom = $this->loadDom();
        $page = $dom->getElementsByTagName('body')->item(0)?->getElementsByTagName('div')->item(0);
        $this->assertNotNull($page, 'Deve existir o wrapper .page dentro de body');
        $this->assertStringContainsString('page', $page->getAttribute('class'));

        $lastChild = $page->lastChild;
        $this->assertNotNull($lastChild);

        // Pula nós vazios (espaços/quebras) até achar um elemento
        while ($lastChild !== null && $lastChild->nodeType !== XML_ELEMENT_NODE) {
            $lastChild = $lastChild->previousSibling;
        }

        $this->assertNotNull($lastChild);
        $this->assertSame('table', $lastChild->nodeName);
        $this->assertSame('table-footer', $lastChild->getAttribute('class'));
    }

    public function test_footer_is_outside_last_bordered_section(): void
    {
        $dom = $this->loadDom();
        $xpath = new \DOMXPath($dom);

        // Pega todas as bordered-section
        $sections = $xpath->query('//div[contains(@class, "bordered-section")]');
        $this->assertGreaterThan(0, $sections->length);

        // Pega a última bordered-section
        $lastSection = $sections->item($sections->length - 1);

        // Verifica que table-footer NÃO está dentro de nenhuma bordered-section
        $footerInsideSection = $xpath->query(
            './/table[contains(@class, "table-footer")]',
            $lastSection
        );
        $this->assertSame(
            0,
            $footerInsideSection->length,
            'O canhoto não deve estar dentro da última bordered-section'
        );

        // Verifica que table-footer existe dentro do wrapper .page (uma ocorrência)
        $footerInPage = $xpath->query(
            './table[contains(@class, "table-footer")]',
            $xpath->query('//div[contains(@class, "page")]')->item(0)
        );
        $this->assertSame(1, $footerInPage->length, 'Deve haver exatamente um table-footer dentro do wrapper .page');
    }

    public function test_footer_default_css_has_no_absolute_positioning(): void
    {
        // Garante que .table-footer não tem position: absolute no CSS padrão
        $this->assertStringContainsString('.table-footer', $this->html);

        // Extrai o bloco <style>
        preg_match('/<style[^>]*>(.*?)<\/style>/s', $this->html, $matches);
        $this->assertNotEmpty($matches);

        $css = $matches[1];

        // Encontra a regra .table-footer que NÃO está dentro de @media print
        // Para simplificar, verifica que fora do @media print, não há position: absolute
        $printPos = strpos($css, '@media print');
        $cssBeforePrint = $printPos !== false ? substr($css, 0, $printPos) : $css;

        // Procura a regra .table-footer mais próxima (heurística simples)
        $this->assertStringNotContainsString(
            'position: absolute',
            $cssBeforePrint,
            '.table-footer não deve ter position: absolute no CSS padrão'
        );
    }

    public function test_footer_in_natural_flow_in_print(): void
    {
        $printCss = $this->extractPrintCss();

        // O canhoto NÃO deve ter position: fixed em @media print,
        // para que fique dentro do box do body (e portanto dentro da moldura)
        $this->assertStringNotContainsString(
            'position: fixed',
            $printCss,
            '.table-footer não deve ter position: fixed em @media print (canhoto precisa ficar dentro da moldura)'
        );

        // Mas a borda tracejada do picote deve continuar presente
        $this->assertMatchesRegularExpression(
            '/\.table-footer\s*\{[^}]*border-top:\s*1pt\s*dashed/s',
            $printCss,
            '.table-footer deve manter border-top: 1pt dashed em @media print (linha do picote)'
        );
    }

    public function test_body_has_min_height_in_print(): void
    {
        $printCss = $this->extractPrintCss();

        // O wrapper .page (que recebe position: relative para ancorar o canhoto
        // via position: absolute — body em Dompdf não honra position: relative)
        // precisa de altura que cubra a área imprimível do A4. Em Dompdf,
        // `height` é a forma confiável (min-height não é totalmente honrado
        // quando position: relative está envolvido), então aceitamos qualquer
        // declaração de altura/min-height em .page.
        $hasCalc = (bool) preg_match(
            '/\.page\s*\{[^}]*(min-)?height:\s*calc\s*\(\s*100vh\s*-\s*14pt\s*\)/s',
            $printCss
        );
        $hasFixed = (bool) preg_match(
            '/\.page\s*\{[^}]*(min-)?height:\s*8(1|2)8pt/s',
            $printCss
        );

        $this->assertTrue(
            $hasCalc || $hasFixed,
            '.page deve ter altura (height/min-height) cobrindo a área imprimível do A4 em @media print'
        );
    }

    public function test_page_wrapper_is_position_relative_in_print(): void
    {
        $printCss = $this->extractPrintCss();

        // O wrapper .page precisa de position: relative em @media print para
        // que o canhoto (.table-footer, position: absolute) seja ancorado a ele
        // e não à página inteira (Dompdf ignora position: relative no <body>).
        $this->assertMatchesRegularExpression(
            '/\.page\s*\{[^}]*position:\s*relative/s',
            $printCss,
            '.page deve ter position: relative em @media print (ancorar o canhoto)'
        );
    }

    public function test_last_bordered_section_grows_in_print(): void
    {
        $printCss = $this->extractPrintCss();

        // A última bordered-section precisa crescer em print
        // para empurrar o canhoto ao final do body (que tem min-height).
        // A regex tolera seletores múltiplos na mesma regra
        // (ex.: ".x, .x > table { ... }").
        $this->assertMatchesRegularExpression(
            '/\.bordered-section:last-of-type[^{]*\{[^}]*flex-grow:\s*1/s',
            $printCss,
            '.bordered-section:last-of-type deve ter flex-grow: 1 em @media print'
        );
    }

    public function test_print_media_query_defines_a4_page(): void
    {
        preg_match('/<style[^>]*>(.*?)<\/style>/s', $this->html, $matches);
        $this->assertNotEmpty($matches);
        $css = $matches[1];

        $this->assertStringContainsString('@page', $css);
        $this->assertMatchesRegularExpression('/@page\s*\{[^}]*size:\s*A4\s*portrait/s', $css);
    }

    public function test_footer_renders_correct_numero_and_chave(): void
    {
        // Extrai o bloco do table-footer do HTML
        preg_match(
            '/<table class="table-footer">(.*?)<\/table>/s',
            $this->html,
            $matches
        );
        $this->assertNotEmpty($matches, 'Bloco table-footer não encontrado');
        $footerHtml = $matches[1];

        // O número da NFS-e e a chave devem aparecer (vindos do XML canônico)
        $this->assertStringContainsString('6534', $footerHtml, 'Número da NFS-e não aparece no canhoto');
        $this->assertStringContainsString(
            '35489062255036530000181000000000653426072486424961',
            $footerHtml,
            'Chave de acesso não aparece no canhoto'
        );

        // Garante que os campos antigos (nfs_e, chave_nfs_e) não são mais usados
        $this->assertStringNotContainsString('$data[\'nfs_e\']', $this->html);
        $this->assertStringNotContainsString('$data[\'chave_nfs_e\']', $this->html);
    }

    public function test_footer_contains_three_columns(): void
    {
        $dom = $this->loadDom();
        $xpath = new \DOMXPath($dom);

        $footer = $xpath->query('//body//table[contains(@class, "table-footer")]')->item(0);
        $this->assertNotNull($footer);

        // Pega a primeira linha
        $firstRow = $footer->getElementsByTagName('tr')->item(0);
        $this->assertNotNull($firstRow);

        $cells = $firstRow->getElementsByTagName('td');
        $this->assertSame(3, $cells->length, 'Canhoto deve ter 3 colunas');

        // Rótulos do canhoto conforme NT 008 §2.4.5 (primeira maiúscula, não caixa alta).
        $this->assertStringContainsString('Data Cientificação', $cells->item(0)->textContent);
        $this->assertStringContainsString('Identificação e Assinatura', $cells->item(1)->textContent);
        $this->assertStringContainsString('Nº NFS-e / Chave NFS-e', $cells->item(2)->textContent);
    }

    public function test_footer_has_page_break_inside_avoid(): void
    {
        preg_match('/<style[^>]*>(.*?)<\/style>/s', $this->html, $matches);
        $this->assertNotEmpty($matches);
        $css = $matches[1];

        $this->assertMatchesRegularExpression(
            '/\.table-footer\s*\{[^}]*page-break-inside:\s*avoid/s',
            $css
        );
    }

    private function extractPrintCss(): string
    {
        preg_match('/<style[^>]*>(.*?)<\/style>/s', $this->html, $matches);
        $this->assertNotEmpty($matches);
        $css = $matches[1];

        $printStart = strpos($css, '@media print');
        $this->assertNotFalse($printStart);

        $openBrace = strpos($css, '{', $printStart);
        $this->assertNotFalse($openBrace);

        $depth = 1;
        $pos = $openBrace + 1;
        $len = strlen($css);
        while ($pos < $len && $depth > 0) {
            $ch = $css[$pos];
            if ($ch === '{') {
                $depth++;
            } elseif ($ch === '}') {
                $depth--;
            }
            $pos++;
        }
        return substr($css, $openBrace + 1, $pos - $openBrace - 2);
    }

    public function test_body_has_border_in_print(): void
    {
        $printCss = $this->extractPrintCss();

        $this->assertStringNotContainsString(
            'border: none',
            $printCss,
            'body não deve ter border: none em @media print (moldura deve aparecer na folha A4)'
        );
        $this->assertMatchesRegularExpression(
            '/\bbody\s*\{[^}]*border:\s*1pt\s*#000\s*solid/s',
            $printCss,
            'body deve ter border: 1pt #000 solid em @media print (moldura da folha A4)'
        );
    }

    public function test_body_has_padding_in_print(): void
    {
        $printCss = $this->extractPrintCss();

        $this->assertMatchesRegularExpression(
            '/\bbody\s*\{[^}]*padding:\s*4pt\s+7pt/s',
            $printCss,
            'body deve ter padding: 4pt 7pt em @media print (espaço interno entre borda e conteúdo)'
        );
    }

    public function test_body_has_box_sizing_in_print(): void
    {
        $printCss = $this->extractPrintCss();

        $this->assertMatchesRegularExpression(
            '/\bbody\s*\{[^}]*box-sizing:\s*border-box/s',
            $printCss,
            'body deve ter box-sizing: border-box em @media print (evita que a borda cause overflow)'
        );
    }

    public function test_body_does_not_have_fixed_height_in_print(): void
    {
        $printCss = $this->extractPrintCss();

        $this->assertDoesNotMatchRegularExpression(
            '/\bbody\s*\{[^}]*(?<!min-)height:\s*100%/s',
            $printCss,
            'body não deve ter height: 100% em @media print (forçaria o body a 1 página e travaria o canhoto na página 1 quando o conteúdo crescer)'
        );
    }

    public function test_html_uses_min_height_in_print(): void
    {
        $printCss = $this->extractPrintCss();

        $this->assertMatchesRegularExpression(
            '/html,\s*body\s*\{[^}]*min-height:\s*100%/s',
            $printCss,
            'html, body devem ter min-height: 100% em @media print (permite o body crescer além de 1 página quando o conteúdo é longo)'
        );
    }

    public function test_text_information_value_has_min_height_and_no_fixed_height(): void
    {
        preg_match('/<style[^>]*>(.*?)<\/style>/s', $this->html, $matches);
        $this->assertNotEmpty($matches);
        $css = $matches[1];

        $this->assertMatchesRegularExpression(
            '/\.text-information-value\s*\{[^}]*min-height:\s*30pt/s',
            $css,
            '.text-information-value deve ter min-height: 30pt (garante altura mínima quando o texto é curto)'
        );

        $this->assertMatchesRegularExpression(
            '/\.text-information-value\s*\{[^}]*padding:\s*5pt/s',
            $css,
            '.text-information-value deve ter padding: 5pt (movido do inline para o CSS)'
        );

        $this->assertDoesNotMatchRegularExpression(
            '/\.text-information-value\s*\{[^}]*(?<!min-)height:\s*\d/s',
            $css,
            '.text-information-value não deve ter height fixo (precisa crescer com o número de linhas)'
        );

        $dom = $this->loadDom();
        $xpath = new \DOMXPath($dom);
        $cell = $xpath->query('//td[contains(@class, "text-information-value")]')->item(0);
        $this->assertNotNull($cell, 'Célula .text-information-value deve existir no DOM');
        $this->assertFalse(
            $cell->hasAttribute('style'),
            '.text-information-value não deve ter style inline (movido para o CSS)'
        );
    }

    public function test_footer_appears_after_long_complementary_info(): void
    {
        $path = __DIR__ . '/../examples/35489062255036530000181000000000653426072486424961.xml';
        $xml = file_get_contents($path);
        $this->assertNotFalse($xml);

        $nfse = (new DanfseGenerator())->parseXml($xml);

        $paragrafo = trim(str_repeat(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. '
            . 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',
            40
        ));

        $reflection = new \ReflectionClass($nfse->infNFSe);
        $original = $nfse->infNFSe;
        $args = [];
        foreach ($reflection->getProperties() as $prop) {
            $prop->setAccessible(true);
            $name = $prop->getName();
            $args[$name] = $name === 'xOutInf' ? $paragrafo : $prop->getValue($original);
        }
        $newInfNFSe = $reflection->newInstanceArgs($args);

        $nfseReflection = new \ReflectionClass($nfse);
        $nfseArgs = [];
        foreach ($nfseReflection->getProperties() as $prop) {
            $prop->setAccessible(true);
            $name = $prop->getName();
            $nfseArgs[$name] = $name === 'infNFSe' ? $newInfNFSe : $prop->getValue($nfse);
        }
        $nfseLong = $nfseReflection->newInstanceArgs($nfseArgs);

        $html = (new DanfseGenerator())->generateHtml($nfseLong);

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $html);
        libxml_clear_errors();

        $body = $dom->getElementsByTagName('body')->item(0);
        $this->assertNotNull($body);

        $page = $body->getElementsByTagName('div')->item(0);
        $this->assertNotNull($page, 'Deve existir o wrapper .page dentro de body');

        $lastChild = $page->lastChild;
        while ($lastChild !== null && $lastChild->nodeType !== XML_ELEMENT_NODE) {
            $lastChild = $lastChild->previousSibling;
        }

        $this->assertNotNull($lastChild);
        $this->assertSame('table', $lastChild->nodeName);
        $this->assertSame('table-footer', $lastChild->getAttribute('class'));

        $xpath = new \DOMXPath($dom);
        $valueCell = $xpath->query('//td[contains(@class, "text-information-value")]')->item(0);
        $this->assertNotNull($valueCell);

        $this->assertStringContainsString(
            'Lorem ipsum',
            $valueCell->textContent,
            'O texto longo das informações complementares deve permanecer no HTML gerado'
        );
        $this->assertStringContainsString(
            'dolore magna aliqua',
            $valueCell->textContent,
            'O texto longo deve estar completo (não truncado)'
        );
    }
}
