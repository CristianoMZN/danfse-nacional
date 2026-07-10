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

    public function test_footer_is_last_child_of_body(): void
    {
        $dom = $this->loadDom();
        $body = $dom->getElementsByTagName('body')->item(0);
        $this->assertNotNull($body);

        $lastChild = $body->lastChild;
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

        // Verifica que table-footer existe como filho direto de body
        $footerInBody = $xpath->query('./table[contains(@class, "table-footer")]', $xpath->query('//body')->item(0));
        $this->assertSame(1, $footerInBody->length, 'Deve haver exatamente um table-footer filho direto de body');
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

        // O body precisa de min-height que cubra a área imprimível do A4.
        // Aceita a forma com calc() (preferida) ou o valor fixo 828pt (fallback).
        $hasCalc = (bool) preg_match(
            '/\bbody\s*\{[^}]*min-height:\s*calc\s*\(\s*100vh\s*-\s*14pt\s*\)/s',
            $printCss
        );
        $hasFixed = (bool) preg_match(
            '/\bbody\s*\{[^}]*min-height:\s*828pt/s',
            $printCss
        );

        $this->assertTrue(
            $hasCalc || $hasFixed,
            'body deve ter min-height: calc(100vh - 14pt) (ou 828pt como fallback) em @media print'
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

        $footer = $xpath->query('//body/table[contains(@class, "table-footer")]')->item(0);
        $this->assertNotNull($footer);

        // Pega a primeira linha
        $firstRow = $footer->getElementsByTagName('tr')->item(0);
        $this->assertNotNull($firstRow);

        $cells = $firstRow->getElementsByTagName('td');
        $this->assertSame(3, $cells->length, 'Canhoto deve ter 3 colunas');

        // Verifica os rótulos
        $this->assertStringContainsString('DATA CIENTIFICAÇÃO', $cells->item(0)->textContent);
        $this->assertStringContainsString('IDENTIFICAÇÃO E ASSINATURA', $cells->item(1)->textContent);
        $this->assertStringContainsString('Nº NFS-e / CHAVE NFS-e', $cells->item(2)->textContent);
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
}
