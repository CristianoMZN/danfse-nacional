<?php

namespace DanfseNacional;

use CuyZ\Valinor\MapperBuilder;
use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Dto\NFSe;
use DanfseNacional\Template\DanfseTemplate;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;
use Dompdf\Options;

/**
 * Gerador de PDF DANFSE a partir do XML NFS-e Nacional.
 *
 * Uso simples:
 *   $pdf = (new DanfseGenerator())->generateFromXml($xmlString);
 *
 * Com configuração:
 *   $generator = new DanfseGenerator(new DanfseConfig(logoDataUri: '...'));
 *   $pdf = $generator->generateFromXml($xmlString);
 */
class DanfseGenerator
{
    /**
     * Diretório com as fontes embarcadas pela lib (Liberation Sans como
     * equivalente métrico do Arial). O Microsoft Sans Serif é substituído por
     * DejaVu Sans, que já vem embutido no Dompdf.
     */
    private const FONT_DIR = __DIR__ . '/Template/fonts';

    public function __construct(
        private readonly DanfseConfig $config = new DanfseConfig(),
    ) {}

    /**
     * Gera o PDF DANFSE a partir do XML da NFS-e.
     *
     * @return string Conteúdo binário do PDF
     */
    public function generateFromXml(string $xml): string
    {
        $nfse = $this->parseXml($xml);
        return $this->generatePdf($nfse);
    }

    /**
     * Faz o parse do XML e retorna o DTO NFSe.
     */
    public function parseXml(string $xml): NFSe
    {
        $converter = new XmlToArray();
        $array = $converter->convert($xml);

        $array = $this->nullifyEmptyGroups($array, NFSe::class);

        $mapper = (new MapperBuilder())
            ->allowSuperfluousKeys()
            ->allowPermissiveTypes()
            ->mapper();

        return $mapper->map(NFSe::class, $array);
    }

    /**
     * Converte strings vazias em null nas posições do array cuja chave, no
     * DTO alvo, é uma propriedade nullable de tipo objeto/grupo. Sem isso,
     * elementos XML vazios como `<tribFed/>` ou `<vDescCondIncond/>` seriam
     * mapeados como string vazia e rejeitados pelo Valinor quando o campo
     * correspondente é `?Objeto`. Strings vazias em campos `string $foo = ''`
     * permanecem intocadas — a passagem para null ocorre apenas quando o
     * tipo de destino é objeto nullable.
     */
    private function nullifyEmptyGroups(array $data, string $dtoClass): array
    {
        $ref = new \ReflectionClass($dtoClass);
        $ctor = $ref->getConstructor();
        if ($ctor === null) {
            return $data;
        }

        foreach ($ctor->getParameters() as $param) {
            $name = $param->getName();
            if (!array_key_exists($name, $data)) {
                continue;
            }

            $type = $param->getType();

            if ($type instanceof \ReflectionNamedType && !$type->isBuiltin() && $type->allowsNull()) {
                if ($data[$name] === '' || $data[$name] === []) {
                    $data[$name] = null;
                }
            }

            if (
                $type instanceof \ReflectionNamedType
                && !$type->isBuiltin()
                && is_array($data[$name])
                && $data[$name] !== []
            ) {
                $data[$name] = $this->nullifyEmptyGroups($data[$name], $type->getName());
            }
        }

        return $data;
    }

    /**
     * Gera e renderiza o template HTML a partir do DTO da NFSe.
     * Útil para testes.
     */
    public function generateHtml(NFSe $nfse): string
    {
        $template = new DanfseTemplate();
        return $template->render($nfse, $this->config);
    }

    /**
     * Gera o PDF a partir do DTO NFSe já processado.
     *
     * @return string Conteúdo binário do PDF
     */
    public function generatePdf(NFSe $nfse): string
    {
        $html = $this->generateHtml($nfse);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', false);
        $options->set('defaultFont', 'liberationsans');
        $options->set('defaultMediaType', 'print');
        $options->set('dpi', 96);
        $options->set('isFontSubsettingEnabled', true);

        $dompdf = new Dompdf($options);
        $this->registerFonts($dompdf);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pageCount = $dompdf->getCanvas()->get_page_count();
        if ($pageCount > 1) {
            throw new \RuntimeException(sprintf(
                'DANFSe deve caber em uma única página (NT 008/2026 §2.2). '
                . 'Foram geradas %d páginas; provável causa: Descrição do Serviço '
                . 'ou Informações Complementares acima do limite permitido.',
                $pageCount
            ));
        }

        return $dompdf->output();
    }

    /**
     * Registra Liberation Sans (substituto de Arial) no Dompdf. O Microsoft
     * Sans Serif é substituído por DejaVu Sans (embutido no Dompdf).
     */
    private function registerFonts(Dompdf $dompdf): void
    {
        /** @var FontMetrics $fontMetrics */
        $fontMetrics = $dompdf->getFontMetrics();

        $variants = [
            'normal' => self::FONT_DIR . '/LiberationSans-Regular.ttf',
            'bold' => self::FONT_DIR . '/LiberationSans-Bold.ttf',
            'italic' => self::FONT_DIR . '/LiberationSans-Italic.ttf',
            'bold_italic' => self::FONT_DIR . '/LiberationSans-BoldItalic.ttf',
        ];

        foreach (['liberationsans', 'arial'] as $family) {
            foreach ($variants as $style => $file) {
                if (is_file($file)) {
                    $fontMetrics->registerFont(
                        ['family' => $family, 'style' => $style, 'weight' => $style === 'bold' || $style === 'bold_italic' ? 'bold' : 'normal'],
                        $file
                    );
                }
            }
        }

        // MicrosoftSansSerif → DejaVu Sans (embutido no Dompdf).
        $dompdfFontDir = __DIR__ . '/../vendor/dompdf/dompdf/lib/fonts';
        $dejavu = [
            'normal' => $dompdfFontDir . '/DejaVuSans.ttf',
            'bold' => $dompdfFontDir . '/DejaVuSans-Bold.ttf',
            'italic' => $dompdfFontDir . '/DejaVuSans-Oblique.ttf',
            'bold_italic' => $dompdfFontDir . '/DejaVuSans-BoldOblique.ttf',
        ];
        foreach (['microsoftsansserif'] as $family) {
            foreach ($dejavu as $style => $file) {
                if (is_file($file)) {
                    $fontMetrics->registerFont(
                        ['family' => $family, 'style' => $style, 'weight' => $style === 'bold' || $style === 'bold_italic' ? 'bold' : 'normal'],
                        $file
                    );
                }
            }
        }
    }
}
