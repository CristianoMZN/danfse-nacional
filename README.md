# DANFSe Nacional

> Fork do [`andrevabo/danfse-nacional`](https://github.com/andrevabo/danfse-nacional), adaptado para o padrão NFS-e 2.0 (NT 008/2026 e NT 009/2026 — IBS/CBS).

Biblioteca PHP 8.1+ para geração do **DANFSe** (PDF), parser tipado do XML e visualizador HTML da NFS-e Nacional. Sem dependência de framework — integra em qualquer projeto PHP (Laravel, Symfony, Cake ou script puro).

- 📦 [Packagist](https://packagist.org/packages/cristianomzn/danfse-nacional)
- 📚 [Documentação completa](https://cristianomzn.github.io/danfse-nacional)
- 🐛 [Issues](https://github.com/CristianoMZN/danfse-nacional/issues)

## Instalação

```bash
composer require cristianomzn/danfse-nacional
```

PHP 8.1+ com as extensões `simplexml`, `mbstring` e `fileinfo` habilitadas.

## Uso rápido

```php
use DanfseNacional\DanfseGenerator;

$xml = file_get_contents('nfse_autorizada.xml');

$generator = new DanfseGenerator();
$pdf = $generator->generateFromXml($xml);

file_put_contents('danfse.pdf', $pdf);
```

XMLs v1.01 com o grupo IBS/CBS (Reforma Tributária) renderizam automaticamente a seção IBS/CBS no DANFSe — sem código extra.

Para acessar os dados tipados antes de gerar o PDF:

```php
$nfse = $generator->parseXml($xml);
echo $nfse->infNFSe->nNFSe;
echo $nfse->infNFSe->valores->vLiq;

$pdf = $generator->generatePdf($nfse);
```

## Documentação completa

Toda a referência — conformidade com NT 008/2026 e NT 009/2026, layout do DANFSe, parser XML, árvore de DTOs, customização (logos, `DanfseConfig`, `MunicipalityBranding`, canhoto), fontes, breaking changes e testes — está em **[cristianomzn.github.io/danfse-nacional](https://cristianomzn.github.io/danfse-nacional)**.

A documentação é gerada via Jekyll (tema Cayman) a partir de `docs/`. Para ler localmente, abra `docs/index.md` no editor de Markdown.

## Encontrou um problema ou tem uma sugestão?

Antes de abrir uma issue, dê uma passada na documentação completa — é provável que a resposta já esteja lá.

Se ainda assim você quiser reportar algo:

- 🐞 **Bugs e comportamentos inesperados:** [abra uma issue](https://github.com/CristianoMZN/danfse-nacional/issues/new) com um XML de exemplo (anexe ou cole o trecho relevante) e o PDF/HTML gerado, se possível. Sem fixture, fica difícil reproduzir.
- 💡 **Sugestões e melhorias:** [abra uma issue](https://github.com/CristianoMZN/danfse-nacional/issues/new) descrevendo o caso de uso e o que você gostaria que a biblioteca fizesse.
- 🔒 **Vulnerabilidades de segurança:** não abra issue pública — entre em contato diretamente com os mantenedores pelo GitHub.

Toda contribuição é bem-vinda: relatos cuidadosos com fixture e contexto aceleram muito a triagem.

## Licença

MIT — veja [`LICENSE.md`](LICENSE.md).