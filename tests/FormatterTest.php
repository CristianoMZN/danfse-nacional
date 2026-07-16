<?php

namespace DanfseNacional\Tests;

use DanfseNacional\Data\Municipios;
use DanfseNacional\Formatter;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase
{
    private Formatter $fmt;

    protected function setUp(): void
    {
        $this->fmt = new Formatter();
    }

    public function test_municipios_nome_retorna_apenas_nome(): void
    {
        $this->assertSame('Marau', Municipios::nome('4311809'));
        $this->assertSame('São Paulo', Municipios::nome('3550308'));
    }

    public function test_municipios_nome_fallback_para_codigo(): void
    {
        $this->assertSame('9999999', Municipios::nome('9999999'));
        $this->assertSame('', Municipios::nome(''));
    }
    public function test_cnpj_formatting(): void
    {
        $this->assertSame('18.587.777/0001-60', $this->fmt->cnpjCpf('18587777000160'));
    }

    public function test_cpf_formatting(): void
    {
        $this->assertSame('123.456.789-09', $this->fmt->cnpjCpf('12345678909'));
    }

    public function test_cnpj_already_formatted_is_cleaned_and_reformatted(): void
    {
        $this->assertSame('18.587.777/0001-60', $this->fmt->cnpjCpf('18.587.777/0001-60'));
    }

    public function test_phone_10_digits(): void
    {
        $this->assertSame('(21) 3619-9708', $this->fmt->phone('2136199708'));
    }

    public function test_phone_11_digits(): void
    {
        $this->assertSame('(21) 99999-9999', $this->fmt->phone('21999999999'));
    }

    public function test_cep_formatting(): void
    {
        $this->assertSame('24020-085', $this->fmt->cep('24020085'));
    }

    public function test_date_formatting(): void
    {
        $this->assertSame('19/02/2026', $this->fmt->date('2026-02-19'));
    }

    public function test_datetime_formatting(): void
    {
        $result = $this->fmt->dateTime('2026-02-19T09:59:11-03:00');
        // Hora pode variar por fuso, verificamos o padrão de formato
        $this->assertMatchesRegularExpression('/\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}/', $result);
    }

    public function test_currency_formatting(): void
    {
        $this->assertSame('R$ 400,00', $this->fmt->currency('400.00'));
        $this->assertSame('R$ 1.234,56', $this->fmt->currency('1234.56'));
    }

    public function test_cod_trib_nacional_formatting(): void
    {
        $this->assertSame('01.03.01', $this->fmt->codTribNacional('010301'));
    }

    public function test_limit(): void
    {
        $this->assertSame('Processamento de dad...', $this->fmt->limit('Processamento de dados', 20));
        $this->assertSame('curto', $this->fmt->limit('curto', 20));
    }

    public function test_empty_values_return_dash(): void
    {
        $this->assertSame('-', $this->fmt->cnpjCpf(''));
        $this->assertSame('-', $this->fmt->phone(''));
        $this->assertSame('-', $this->fmt->cep(''));
        $this->assertSame('-', $this->fmt->date(''));
        $this->assertSame('-', $this->fmt->dateTime(''));
        $this->assertSame('-', $this->fmt->currency(''));
        $this->assertSame('-', $this->fmt->codTribNacional(''));
    }

    public function test_concat_local_prestacao_nacional_sem_pais_explicito(): void
    {
        $this->assertSame('Marau / RS / BR', $this->fmt->concatLocalPrestacao('4311809', ''));
        $this->assertSame('Marau / RS / BR', $this->fmt->concatLocalPrestacao('4311809', 'BR'));
    }

    public function test_concat_local_prestacao_internacional_sem_match_ibge(): void
    {
        $this->assertSame('99999999 / AR', $this->fmt->concatLocalPrestacao('99999999', 'AR'));
        $this->assertSame('99999999 / US', $this->fmt->concatLocalPrestacao('99999999', 'US'));
    }

    public function test_concat_local_prestacao_internacional_sem_cidade(): void
    {
        $this->assertSame('AR', $this->fmt->concatLocalPrestacao('', 'AR'));
    }

    public function test_concat_local_prestacao_sem_cidade_sem_pais_default_br(): void
    {
        $this->assertSame('BR', $this->fmt->concatLocalPrestacao('', ''));
    }

    public function test_concat_local_prestacao_ibge_inexistente_sem_pais_usapais_default(): void
    {
        $this->assertSame('9999999 / BR', $this->fmt->concatLocalPrestacao('9999999', ''));
    }

    public function test_concat_municipio_uf_com_ambos_preenchidos_nao_duplica_uf(): void
    {
        $this->assertSame('Marau / RS', $this->fmt->concatMunicipioUf('4311809', 'RS'));
    }

    public function test_concat_municipio_uf_apenas_cmun_cai_na_uf_do_ibge(): void
    {
        $this->assertSame('Marau / RS', $this->fmt->concatMunicipioUf('4311809', ''));
    }

    public function test_concat_municipio_uf_apenas_uf(): void
    {
        $this->assertSame('RS', $this->fmt->concatMunicipioUf('', 'RS'));
    }

    public function test_concat_municipio_uf_vazio_total(): void
    {
        $this->assertSame('-', $this->fmt->concatMunicipioUf('', ''));
    }

    public function test_concat_municipio_uf_ibge_inexistente_sem_uf(): void
    {
        $this->assertSame('9999999', $this->fmt->concatMunicipioUf('9999999', ''));
    }
}
