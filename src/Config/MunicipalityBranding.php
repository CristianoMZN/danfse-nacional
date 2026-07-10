<?php

namespace DanfseNacional\Config;

readonly class MunicipalityBranding
{
    public ?string $logoDataUri;

    /**
     * Identificação do ente emitente exibida no canto direito do cabeçalho
     * do DANFSe. Pode ser usada para:
     *  - Prefeitura / secretaria municipal (caso típico, exibe brasão);
     *  - Empresa emitente (caso queira expor marca além do nome);
     *  - Autarquia, órgão público, etc.
     *
     * Quando este objeto é fornecido ao DanfseConfig, a linha "Município:"
     * do XML é substituída por este conteúdo (name + department + email + logo).
     * Quando omitido, o canto direito mostra apenas "Município: <cidade/UF>".
     *
     * ATENÇÃO: a logo NFS-e (a "logo da nota") NÃO é configurada aqui.
     * Ela é obrigatória e vem embutida em DefaultLogo::DATA_URI.
     *
     * @param string      $name        Nome do ente (prefeitura / empresa / autarquia).
     * @param string      $department  Departamento ou secretaria (opcional).
     * @param string      $email       E-mail de contato (opcional).
     * @param string|null $logoDataUri Data URI pronto. Tem precedência sobre logoPath.
     * @param string|null $logoPath    Caminho do arquivo de imagem. Detectado MIME
     *                                 automaticamente e convertido para data URI.
     *                                 Inválido lança InvalidArgumentException.
     */
    public function __construct(
        public string $name,
        public string $department = '',
        public string $email = '',
        ?string $logoDataUri = null,
        ?string $logoPath = null,
    ) {
        $this->logoDataUri = $logoDataUri ?? ($logoPath !== null ? self::pathToDataUri($logoPath) : null);
    }

    private static function pathToDataUri(string $path): string
    {
        if (!is_readable($path)) {
            throw new \InvalidArgumentException("Arquivo de logo não encontrado ou ilegível: {$path}");
        }

        $mime = mime_content_type($path) ?: 'image/png';
        $contents = file_get_contents($path);

        if ($contents === false) {
            throw new \RuntimeException("Não foi possível ler o arquivo de logo: {$path}");
        }

        return 'data:' . $mime . ';base64,' . base64_encode($contents);
    }
}
