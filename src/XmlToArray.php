<?php

namespace DanfseNacional;

/**
 * Converte XML de NFS-e Nacional para array associativo limpo.
 *
 * Trata namespaces automaticamente e exclui elementos de assinatura digital.
 * Atributos XML (como Id) são incluídos como chaves regulares do array.
 *
 * Elementos com cardinalidade repetível (1-N ou 0-N no leiaute NT 008/009)
 * são sempre materializados como array indexado, mesmo quando há uma única
 * ocorrência — assim o mapeamento para `list<Foo>` no DTO é estável.
 */
class XmlToArray
{
    private const NFSE_NS = 'http://www.sped.fazenda.gov.br/nfse';
    private const SIG_NS = 'http://www.w3.org/2000/09/xmldsig#';

    /**
     * Elementos repetíveis do leiaute. Para esses nomes, o parser retorna
     * sempre uma lista numericamente indexada, mesmo que só exista um
     * elemento — o consumidor (Valinor + DTOs `list<Foo>`) exige esse
     * formato estável. Mantido como set local para evitar acoplar o
     * conversor a todos os DTOs.
     */
    private const REPEATABLE_ELEMENTS = [
        'xItemPed',
        'refNFSe',
        'docAjusteBC',
        'docDedRed',
        'bensMoveis',
        'gUnidImob',
        'gAjusteBCLocImoveis',
    ];

    public function convert(string $xml): array
    {
        $root = new \SimpleXMLElement($xml);
        $result = $this->nodeToArray($root);

        // Garante que sempre retorna um array no nível raiz
        if (!is_array($result)) {
            return [];
        }

        return $result;
    }

    /**
     * @return array|string
     */
    private function nodeToArray(\SimpleXMLElement $node): mixed
    {
        $result = [];
        $attrCount = 0;

        // Extrai atributos sem namespace (ex: Id, versao)
        foreach ($node->attributes() as $key => $value) {
            $result[(string) $key] = (string) $value;
            $attrCount++;
        }

        // Processa filhos no namespace NFS-e, agrupando por nome para
        // identificar elementos repetíveis sem perder ocorrências.
        $childCount = 0;
        $byName = [];
        foreach ($node->children(self::NFSE_NS) as $name => $child) {
            $name = (string) $name;
            $byName[$name][] = $this->nodeToArray($child);
            $childCount++;
        }

        foreach ($byName as $name => $values) {
            if (in_array($name, self::REPEATABLE_ELEMENTS, true)) {
                $result[$name] = array_values($values);
            } else {
                $result[$name] = $values[count($values) - 1];
            }
        }

        // Fallback: tenta filhos sem namespace (compatibilidade com XMLs
        // alternativos). Mantém comportamento histórico: primeira ocorrência.
        if ($childCount === 0) {
            foreach ($node->children() as $name => $child) {
                $name = (string) $name;
                if (!isset($result[$name])) {
                    $result[$name] = $this->nodeToArray($child);
                    $childCount++;
                }
            }
        }

        // Elemento folha sem atributos: retorna o texto diretamente
        if ($attrCount === 0 && $childCount === 0) {
            return trim((string) $node);
        }

        // Elemento com atributos mas sem filhos: inclui texto como _value (caso raro)
        if ($childCount === 0 && $attrCount > 0) {
            $text = trim((string) $node);
            if ($text !== '') {
                $result['_value'] = $text;
            }
        }

        return $result;
    }
}
