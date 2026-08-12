# Anexo I — SEFIN/ADN — DPS/NFS-e — Sistema Nacional NFS-e — v1.01

> Reconstrução em Markdown do arquivo XLSX `anexo_i-sefin_adn-dps_nfse-snnfse-v1-01-20260209(1).xlsx`.
> O objetivo desta versão é preservar o conteúdo técnico e, ao mesmo tempo, tornar explícitas as relações que no XLSX dependem de células mescladas, continuidade visual entre linhas, comentários de células e referências entre abas.

## 1. Identificação e integridade da fonte

- **Arquivo de origem:** `anexo_i-sefin_adn-dps_nfse-snnfse-v1-01-20260209(1).xlsx`
- **SHA-256 do XLSX de origem:** `de5bc492959eadc8bfa7540e16939995924f2188f743648eaf84d3b31e9eeb7c`
- **Versão indicada no nome do arquivo:** `v1.01`
- **Data indicada no nome do arquivo:** `2026-02-09`
- **Última modificação registrada nas propriedades internas do XLSX:** `2026-02-12T17:08:40Z`
- **Último editor registrado no XLSX:** `Adriano Guedes da Silva`

### 1.1 Abas convertidas

| Aba de origem | Conteúdo | Registros principais |
|---|---|---:|
| `MUN.INCID_INFO.SERV.` | Lista nacional de serviços, regra de local de incidência e grupos específicos | 337 serviços |
| `EXPORTACAO_EMISSÃO_NFS-e` | Matriz de cenários de exportação/comércio exterior | 112 cenários |
| `RN_RECEPCAO_DPS` | Regras de recepção/transmissão da DPS | 13 validações + cabeçalhos de seção |
| `LEIAUTE DPS_NFS-e` | Leiaute XML, tipos, ocorrências, tamanhos, descrições e notas | 416 registros |
| `RN DPS_NFS-e` | Regras de negócio vinculadas ao leiaute XML | 429 regras com conteúdo |

## 2. Como ler esta versão Markdown

### 2.1 Relações reconstruídas

As relações abaixo estavam distribuídas entre células e abas e foram explicitadas nesta conversão:

1. **Leiaute XML ↔ regras de negócio:** as regras da aba `RN DPS_NFS-e` foram associadas ao campo da aba `LEIAUTE DPS_NFS-e` pelo par **Caminho no XML + Campo**. Linhas em que o XLSX usa células mescladas e deixa o caminho/campo visualmente em branco herdam o identificador da célula mesclada anterior.
2. **Lista de serviços ↔ regras de incidência:** a aba `MUN.INCID_INFO.SERV.` define, por `cTribNac`, qual referência de localidade é utilizada para a incidência do ISSQN (`EP`, `LP` ou `ET`) e quais grupos específicos (`obra` ou `atvEvento`) são associados ao serviço.
3. **Lista de serviços ↔ comércio exterior:** o próprio cabeçalho de `MUN.INCID_INFO.SERV.` determina que o grupo `comExt` deve ser definido conforme a aba `EXPORTACAO_EMISSÃO_NFS-e`.
4. **Matriz de exportação ↔ regras de negócio:** a aba de regras contém validações que dependem dos cenários de exportação e de campos como `tribISSQN`, `cPaisResult`, `cNBS` e `comExt`.
5. **Comentários de células:** 55 comentários da matriz de exportação e 32 comentários encadeados da aba de regras foram lidos e incorporados às seções correspondentes.

### 2.2 Convenções preservadas

- `V` = regra executada no contexto indicado pela coluna.
- `X` = regra não executada, ou marcador de aplicabilidade conforme o contexto da tabela.
- `-` = não aplicável / não informado na matriz de origem.
- `Obrig.` = validação obrigatória.
- `Rej.` = efeito de rejeição.
- Ocorrências como `1-1`, `0-1`, `1-99` e `1-1000` foram preservadas literalmente. Em leitura estrutural, correspondem respectivamente a exatamente uma, zero ou uma, uma a 99 e uma a 1000 ocorrências.
- Os códigos da lista nacional de serviços são armazenados no XLSX como números com máscara `000000`. Nesta conversão eles são materializados com **seis dígitos**, por exemplo `010101`, evitando perda de zero à esquerda.
- Identificadores de XML são normalizados apenas para **ligação interna** removendo espaços externos acidentais. O conteúdo textual original é preservado e as anomalias relevantes são registradas no final.

### 2.3 Códigos observados na coluna `ELE` do leiaute

| Código | Interpretação estrutural usada nesta documentação |
|---|---|
| `Raiz` | elemento raiz do documento |
| `A` | atributo |
| `ID` | identificador XML |
| `G` | grupo |
| `CG` | grupo de escolha |
| `E` | elemento |
| `CE` | elemento de escolha |

A coluna `TIPO` é preservada como no XLSX (`C`, `N`, `D` ou `-`), sem redefinir regras que não estejam escritas na fonte.

## 3. Lista nacional de serviços e determinação da localidade de incidência

### 3.1 Regras gerais transcritas do cabeçalho da planilha

LI para os serviços indicados seguem as regras geral de EP e as exceções para LP e ET.<br><br>* Com exceção do subitem 200101 da lista nacional de serviços, <br>todos os demais serviços podem ser prestados em "Águas Marítimas" <br>(cLocPrestacao = 0000000). Neste caso o LI será EDP. <br><br>** Caso o emitente informe o subitem 200101, <br>o LP não poderá ser "Águas Marítimas" e o LI será o município informado em LP. <br><br>(Art 3º, § 3º da LC 116/03).

**Regra específica para importação de serviços:**

IMPORTAÇÃO <br><br><br>Emitente  = T | I<br><br>País Exterior P <br>e/ou<br>País Exterior LP<br><br>A incidência do ISSQN em casos de Importação de serviço prevalece sobre as regras do Art 3º da LC 116/03

**Referências das colunas de incidência:**

- `EP` = Estabelecimento / Domicílio do Prestador.
- `LP` = Local da Prestação.
- `ET` = Estabelecimento / Domicílio do Tomador.
- `EDEmit` = Estabelecimento / Domicílio do Emitente; na condição indicada pelo XLSX, `LI = EDEmit (T|I)`.
- O subitem `200101` preserva o marcador `(**) X` em `LP`, remetendo à observação do cabeçalho sobre Águas Marítimas.
- O código `990101` é descrito na fonte como **Serviços sem a incidência de ISSQN e ICMS** e não possui marcador de local de incidência.

### 3.2 Serviços

| cTribNac | Descrição | EP | LP | ET | EDEmit (importação) | Grupo específico | `infoComplem` | LI principal derivada |
|---|---|:---:|:---:|:---:|:---:|---|:---:|---|
| `010101` | Análise e desenvolvimento de sistemas. | X | - | - | X | - | X | EP |
| `010201` | Programação. | X | - | - | X | - | X | EP |
| `010301` | Processamento de dados, textos, imagens, vídeos, páginas eletrônicas, aplicativos e sistemas de informação, entre outros formatos, e congêneres. | X | - | - | X | - | X | EP |
| `010302` | Armazenamento ou hospedagem de dados, textos, imagens, vídeos, páginas eletrônicas, aplicativos e sistemas de informação, entre outros formatos, e congêneres. | X | - | - | X | - | X | EP |
| `010401` | Elaboração de programas de computadores, inclusive de jogos eletrônicos, independentemente da arquitetura construtiva da máquina em que o programa será executado, incluindo tablets, smartphones e congêneres. | X | - | - | X | - | X | EP |
| `010501` | Licenciamento ou cessão de direito de uso de programas de computação. | X | - | - | X | - | X | EP |
| `010601` | Assessoria e consultoria em informática. | X | - | - | X | - | X | EP |
| `010701` | Suporte técnico em informática, inclusive instalação, configuração e manutenção de programas de computação e bancos de dados. | X | - | - | X | - | X | EP |
| `010801` | Planejamento, confecção, manutenção e atualização de páginas eletrônicas. | X | - | - | X | - | X | EP |
| `010901` | Disponibilização, sem cessão definitiva, de conteúdos de áudio por meio da internet (exceto a distribuição de conteúdos pelas prestadoras de Serviço de Acesso Condicionado, de que trata a Lei nº 12.485, de 12 de setembro de 2011, sujeita ao ICMS). | X | - | - | X | - | X | EP |
| `010902` | Disponibilização, sem cessão definitiva, de conteúdos de vídeo, imagem e texto por meio da internet, respeitada a imunidade de livros, jornais e periódicos (exceto a distribuição de conteúdos pelas prestadoras de Serviço de Acesso Condicionado, de que trata a Lei nº 12.485, de 12 de setembro de 2011, sujeita ao ICMS). | X | - | - | X | - | X | EP |
| `020101` | Serviços de pesquisas e desenvolvimento de qualquer natureza. | X | - | - | X | - | X | EP |
| `030201` | Cessão de direito de uso de marcas e de sinais de propaganda. | X | - | - | X | - | X | EP |
| `030301` | Exploração de salões de festas, centro de convenções, stands e congêneres, para realização de eventos ou negócios de qualquer natureza. | X | - | - | X | - | X | EP |
| `030302` | Exploração de escritórios virtuais e congêneres, para realização de eventos ou negócios de qualquer natureza. | X | - | - | X | - | X | EP |
| `030303` | Exploração de quadras esportivas, estádios, ginásios, canchas e congêneres, para realização de eventos ou negócios de qualquer natureza. | X | - | - | X | - | X | EP |
| `030304` | Exploração de auditórios, casas de espetáculos e congêneres, para realização de eventos ou negócios de qualquer natureza. | X | - | - | X | - | X | EP |
| `030305` | Exploração de parques de diversões e congêneres, para realização de eventos ou negócios de qualquer natureza. | X | - | - | X | - | X | EP |
| `030401` | Locação, sublocação, arrendamento, direito de passagem ou permissão de uso, compartilhado ou não, de ferrovia. | - | X | - | X | - | X | LP |
| `030402` | Locação, sublocação, arrendamento, direito de passagem ou permissão de uso, compartilhado ou não, de rodovia. | - | X | - | X | - | X | LP |
| `030403` | Locação, sublocação, arrendamento, direito de passagem ou permissão de uso, compartilhado ou não, de postes, cabos, dutos e condutos de qualquer natureza. | - | X | - | X | - | X | LP |
| `030501` | Cessão de andaimes, palcos, coberturas e outras estruturas de uso temporário. | - | X | - | X | - | X | LP |
| `040101` | Medicina. | X | - | - | X | - | X | EP |
| `040102` | Biomedicina. | X | - | - | X | - | X | EP |
| `040201` | Análises clínicas e congêneres. | X | - | - | X | - | X | EP |
| `040202` | Patologia e congêneres. | X | - | - | X | - | X | EP |
| `040203` | Eletricidade médica (eletroestimulação de nervos e musculos, cardioversão, etc) e congêneres. | X | - | - | X | - | X | EP |
| `040204` | Radioterapia, quimioterapia e congêneres. | X | - | - | X | - | X | EP |
| `040205` | Ultra-sonografia, ressonância magnética, radiologia, tomografia e congêneres. | X | - | - | X | - | X | EP |
| `040301` | Hospitais e congêneres. | X | - | - | X | - | X | EP |
| `040302` | Laboratórios e congêneres. | X | - | - | X | - | X | EP |
| `040303` | Clínicas, sanatórios, manicômios, casas de saúde, prontos-socorros, ambulatórios e congêneres. | X | - | - | X | - | X | EP |
| `040401` | Instrumentação cirúrgica. | X | - | - | X | - | X | EP |
| `040501` | Acupuntura. | X | - | - | X | - | X | EP |
| `040601` | Enfermagem, inclusive serviços auxiliares. | X | - | - | X | - | X | EP |
| `040701` | Serviços farmacêuticos. | X | - | - | X | - | X | EP |
| `040801` | Terapia ocupacional. | X | - | - | X | - | X | EP |
| `040802` | Fisioterapia. | X | - | - | X | - | X | EP |
| `040803` | Fonoaudiologia. | X | - | - | X | - | X | EP |
| `040901` | Terapias de qualquer espécie destinadas ao tratamento físico, orgânico e mental. | X | - | - | X | - | X | EP |
| `041001` | Nutrição. | X | - | - | X | - | X | EP |
| `041101` | Obstetrícia. | X | - | - | X | - | X | EP |
| `041201` | Odontologia. | X | - | - | X | - | X | EP |
| `041301` | Ortóptica. | X | - | - | X | - | X | EP |
| `041401` | Próteses sob encomenda. | X | - | - | X | - | X | EP |
| `041501` | Psicanálise. | X | - | - | X | - | X | EP |
| `041601` | Psicologia. | X | - | - | X | - | X | EP |
| `041701` | Casas de repouso e congêneres. | X | - | - | X | - | X | EP |
| `041702` | Casas de recuperação e congêneres. | X | - | - | X | - | X | EP |
| `041703` | Creches e congêneres. | X | - | - | X | - | X | EP |
| `041704` | Asilos e congêneres. | X | - | - | X | - | X | EP |
| `041801` | Inseminação artificial, fertilização in vitro e congêneres. | X | - | - | X | - | X | EP |
| `041901` | Bancos de sangue, leite, pele, olhos, óvulos, sêmen e congêneres. | X | - | - | X | - | X | EP |
| `042001` | Coleta de sangue, leite, tecidos, sêmen, órgãos e materiais biológicos de qualquer espécie. | X | - | - | X | - | X | EP |
| `042101` | Unidade de atendimento, assistência ou tratamento móvel e congêneres. | X | - | - | X | - | X | EP |
| `042201` | Planos de medicina de grupo ou individual e convênios para prestação de assistência médica, hospitalar, odontológica e congêneres. | X | - | - | X | - | X | EP |
| `042301` | Outros planos de saúde que se cumpram através de serviços de terceiros contratados, credenciados, cooperados ou apenas pagos pelo operador do plano mediante indicação do beneficiário. | X | - | - | X | - | X | EP |
| `050101` | Medicina veterinária | X | - | - | X | - | X | EP |
| `050102` | Zootecnia. | X | - | - | X | - | X | EP |
| `050201` | Hospitais e congêneres, na área veterinária. | X | - | - | X | - | X | EP |
| `050202` | Clínicas, ambulatórios, prontos-socorros e congêneres, na área veterinária. | X | - | - | X | - | X | EP |
| `050301` | Laboratórios de análise na área veterinária. | X | - | - | X | - | X | EP |
| `050401` | Inseminação artificial, fertilização in vitro e congêneres. | X | - | - | X | - | X | EP |
| `050501` | Bancos de sangue e de órgãos e congêneres. | X | - | - | X | - | X | EP |
| `050601` | Coleta de sangue, leite, tecidos, sêmen, órgãos e materiais biológicos de qualquer espécie. | X | - | - | X | - | X | EP |
| `050701` | Unidade de atendimento, assistência ou tratamento móvel e congêneres. | X | - | - | X | - | X | EP |
| `050801` | Guarda, tratamento, amestramento, embelezamento, alojamento e congêneres. | X | - | - | X | - | X | EP |
| `050901` | Planos de atendimento e assistência médico-veterinária. | X | - | - | X | - | X | EP |
| `060101` | Barbearia, cabeleireiros, manicuros, pedicuros e congêneres. | X | - | - | X | - | X | EP |
| `060201` | Esteticistas, tratamento de pele, depilação e congêneres. | X | - | - | X | - | X | EP |
| `060301` | Banhos, duchas, sauna, massagens e congêneres. | X | - | - | X | - | X | EP |
| `060401` | Ginástica, dança, esportes, natação, artes marciais e demais atividades físicas. | X | - | - | X | - | X | EP |
| `060501` | Centros de emagrecimento, spa e congêneres. | X | - | - | X | - | X | EP |
| `060601` | Aplicação de tatuagens, piercings e congêneres. | X | - | - | X | - | X | EP |
| `070101` | Engenharia e congêneres. | X | - | - | X | - | X | EP |
| `070102` | Agronomia e congêneres. | X | - | - | X | - | X | EP |
| `070103` | Agrimensura e congêneres. | X | - | - | X | - | X | EP |
| `070104` | Arquitetura, urbanismo e congêneres. | X | - | - | X | - | X | EP |
| `070105` | Geologia e congêneres. | X | - | - | X | - | X | EP |
| `070106` | Paisagismo e congêneres. | X | - | - | X | - | X | EP |
| `070201` | Execução, por administração, de obras de construção civil, hidráulica ou elétrica e de outras obras semelhantes, inclusive sondagem, perfuração de poços, escavação, drenagem e irrigação, terraplanagem, pavimentação, concretagem e a instalação e montagem de produtos, peças e equipamentos (exceto o fornecimento de mercadorias produzidas pelo prestador de serviços fora do local da prestação dos serviços, que fica sujeito ao ICMS). | - | X | - | X | obra | X | LP |
| `070202` | Execução, por empreitada ou subempreitada, de obras de construção civil, hidráulica ou elétrica e de outras obras semelhantes, inclusive sondagem, perfuração de poços, escavação, drenagem e irrigação, terraplanagem, pavimentação, concretagem e a instalação e montagem de produtos, peças e equipamentos (exceto o fornecimento de mercadorias produzidas pelo prestador de serviços fora do local da prestação dos serviços, que fica sujeito ao ICMS). | - | X | - | X | obra | X | LP |
| `070301` | Elaboração de planos diretores, estudos de viabilidade, estudos organizacionais e outros, relacionados com obras e serviços de engenharia. | X | - | - | X | - | X | EP |
| `070302` | Elaboração de anteprojetos, projetos básicos e projetos executivos para trabalhos de engenharia. | X | - | - | X | - | X | EP |
| `070401` | Demolição. | - | X | - | X | obra | X | LP |
| `070501` | Reparação, conservação e reforma de edifícios e congêneres (exceto o fornecimento de mercadorias produzidas pelo prestador dos serviços, fora do local da prestação dos serviços, que fica sujeito ao ICMS). | - | X | - | X | obra | X | LP |
| `070502` | Reparação, conservação e reforma de estradas, pontes, portos e congêneres (exceto o fornecimento de mercadorias produzidas pelo prestador dos serviços, fora do local da prestação dos serviços, que fica sujeito ao ICMS). | - | X | - | X | obra | X | LP |
| `070601` | Colocação e instalação de tapetes, carpetes, cortinas e congêneres, com material fornecido pelo tomador do serviço. | X | - | - | X | obra | X | EP |
| `070602` | Colocação e instalação de assoalhos, revestimentos de parede, vidros, divisórias, placas de gesso e congêneres, com material fornecido pelo tomador do serviço. | X | - | - | X | obra | X | EP |
| `070701` | Recuperação, raspagem, polimento e lustração de pisos e congêneres. | X | - | - | X | obra | X | EP |
| `070801` | Calafetação. | X | - | - | X | obra | X | EP |
| `070901` | Varrição, coleta e remoção de lixo, rejeitos e outros resíduos quaisquer. | - | X | - | X | - | X | LP |
| `070902` | Incineração, tratamento, reciclagem, separação e destinação final de lixo, rejeitos e outros resíduos quaisquer. | - | X | - | X | - | X | LP |
| `071001` | Limpeza, manutenção e conservação de vias e logradouros públicos, parques, jardins e congêneres. | - | X | - | X | - | X | LP |
| `071002` | Limpeza, manutenção e conservação de imóveis, chaminés, piscinas e congêneres. | - | X | - | X | - | X | LP |
| `071101` | Decoração. | - | X | - | X | - | X | LP |
| `071102` | Jardinagem, inclusive corte e poda de árvores. | - | X | - | X | - | X | LP |
| `071201` | Controle e tratamento de efluentes de qualquer natureza e de agentes físicos, químicos e biológicos. | - | X | - | X | - | X | LP |
| `071301` | Dedetização, desinfecção, desinsetização, imunização, higienização, desratização, pulverização e congêneres. | X | - | - | X | - | X | EP |
| `071601` | Florestamento, reflorestamento, semeadura, adubação, reparação de solo, plantio, silagem, colheita, corte e descascamento de árvores, silvicultura, exploração florestal e dos serviços congêneres indissociáveis da formação, manutenção e colheita de florestas, para quaisquer fins e por quaisquer meios. | - | X | - | X | - | X | LP |
| `071701` | Escoramento, contenção de encostas e serviços congêneres. | - | X | - | X | obra | X | LP |
| `071801` | Limpeza e dragagem de rios, portos, canais, baías, lagos, lagoas, represas, açudes e congêneres. | - | X | - | X | - | X | LP |
| `071901` | Acompanhamento e fiscalização da execução de obras de engenharia, arquitetura e urbanismo. | - | X | - | X | obra | X | LP |
| `072001` | Aerofotogrametria (inclusive interpretação), cartografia, mapeamento e congêneres. | X | - | - | X | - | X | EP |
| `072002` | Levantamentos batimétricos, geográficos, geodésicos, geológicos, geofísicos e congêneres. | X | - | - | X | - | X | EP |
| `072003` | Levantamentos topográficos e congêneres. | X | - | - | X | - | X | EP |
| `072101` | Pesquisa, perfuração, cimentação, mergulho, perfilagem, concretação, testemunhagem, pescaria, estimulação e outros serviços relacionados com a exploração e explotação de petróleo, gás natural e de outros recursos minerais. | X | - | - | X | - | X | EP |
| `072201` | Nucleação e bombardeamento de nuvens e congêneres. | X | - | - | X | - | X | EP |
| `080101` | Ensino regular pré-escolar, fundamental e médio. | X | - | - | X | - | X | EP |
| `080102` | Ensino regular superior. | X | - | - | X | - | X | EP |
| `080201` | Instrução, treinamento, orientação pedagógica e educacional, avaliação de conhecimentos de qualquer natureza. | X | - | - | X | - | X | EP |
| `090101` | Hospedagem em hotéis, hotelaria marítima e congêneres (o valor da alimentação e gorjeta, quando incluído no preço da diária, fica sujeito ao Imposto Sobre Serviços). | X | - | - | X | - | X | EP |
| `090102` | Hospedagem em pensões, albergues, pousadas, hospedarias, ocupação por temporada com fornecimento de serviços e congêneres (o valor da alimentação e gorjeta, quando incluído no preço da diária, fica sujeito ao Imposto Sobre Serviços). | X | - | - | X | - | X | EP |
| `090103` | Hospedagem em motéis e congêneres (o valor da alimentação e gorjeta, quando incluído no preço da diária, fica sujeito ao Imposto Sobre Serviços). | X | - | - | X | - | X | EP |
| `090104` | Hospedagem em apart-service condominiais, flat, apart-hotéis, hotéis residência, residence-service, suite service e congêneres (o valor da alimentação e gorjeta, quando incluído no preço da diária, fica sujeito ao Imposto Sobre Serviços). | X | - | - | X | - | X | EP |
| `090201` | Agenciamento e intermediação de programas de turismo, passeios, viagens, excursões, hospedagens e congêneres. | X | - | - | X | - | X | EP |
| `090202` | Organização, promoção e execução de programas de turismo, passeios, viagens, excursões, hospedagens e congêneres. | X | - | - | X | - | X | EP |
| `090301` | Guias de turismo. | X | - | - | X | - | X | EP |
| `100101` | Agenciamento, corretagem ou intermediação de câmbio. | X | - | - | X | - | X | EP |
| `100102` | Agenciamento, corretagem ou intermediação de seguros. | X | - | - | X | - | X | EP |
| `100103` | Agenciamento, corretagem ou intermediação de cartões de crédito. | X | - | - | X | - | X | EP |
| `100104` | Agenciamento, corretagem ou intermediação de planos de saúde. | X | - | - | X | - | X | EP |
| `100105` | Agenciamento, corretagem ou intermediação de planos de previdência privada. | X | - | - | X | - | X | EP |
| `100201` | Agenciamento, corretagem ou intermediação de títulos em geral e valores mobiliários. | X | - | - | X | - | X | EP |
| `100202` | Agenciamento, corretagem ou intermediação de contratos quaisquer. | X | - | - | X | - | X | EP |
| `100301` | Agenciamento, corretagem ou intermediação de direitos de propriedade industrial, artística ou literária. | X | - | - | X | - | X | EP |
| `100401` | Agenciamento, corretagem ou intermediação de contratos de arrendamento mercantil (leasing). | X | - | - | X | - | X | EP |
| `100402` | Agenciamento, corretagem ou intermediação de contratos de franquia (franchising). | X | - | - | X | - | X | EP |
| `100403` | Agenciamento, corretagem ou intermediação de faturização (factoring). | X | - | - | X | - | X | EP |
| `100501` | Agenciamento, corretagem ou intermediação de bens móveis ou imóveis, não abrangidos em outros itens ou subitens, por quaisquer meios. | X | - | - | X | - | X | EP |
| `100502` | Agenciamento, corretagem ou intermediação de bens móveis ou imóveis realizados no âmbito de Bolsas de Mercadorias e Futuros, por quaisquer meios. | X | - | - | X | - | X | EP |
| `100601` | Agenciamento marítimo. | X | - | - | X | - | X | EP |
| `100701` | Agenciamento de notícias. | X | - | - | X | - | X | EP |
| `100801` | Agenciamento de publicidade e propaganda, inclusive o agenciamento de veiculação por quaisquer meios. | X | - | - | X | - | X | EP |
| `100901` | Representação de qualquer natureza, inclusive comercial. | X | - | - | X | - | X | EP |
| `101001` | Distribuição de bens de terceiros. | X | - | - | X | - | X | EP |
| `110101` | Guarda e estacionamento de veículos terrestres automotores. | - | X | - | X | - | X | LP |
| `110102` | Guarda e estacionamento de aeronaves e de embarcações. | - | X | - | X | - | X | LP |
| `110201` | Vigilância, segurança ou monitoramento de bens, pessoas e semoventes. | - | X | - | X | - | X | LP |
| `110301` | Escolta, inclusive de veículos e cargas. | X | - | - | X | - | X | EP |
| `110401` | Armazenamento, depósito, guarda de bens de qualquer espécie. | - | X | - | X | - | X | LP |
| `110402` | Carga, descarga, arrumação de bens de qualquer espécie. | - | X | - | X | - | X | LP |
| `110501` | Serviços relacionados ao monitoramento e rastreamento a distância, em qualquer via ou local, de veículos, cargas, pessoas e semoventes em circulação ou movimento, realizados por meio de telefonia móvel, transmissão de satélites, rádio ou qualquer outro meio, inclusive pelas empresas de Tecnologia da Informação Veicular, independentemente de o prestador de serviços ser proprietário ou não da infraestrutura de telecomunicações que utiliza. | X | - | - | X | - | X | EP |
| `120101` | Espetáculos teatrais. | - | X | - | X | atvEvento | X | LP |
| `120201` | Exibições cinematográficas. | - | X | - | X | atvEvento | X | LP |
| `120301` | Espetáculos circenses. | - | X | - | X | atvEvento | X | LP |
| `120401` | Programas de auditório. | - | X | - | X | atvEvento | X | LP |
| `120501` | Parques de diversões, centros de lazer e congêneres. | - | X | - | X | atvEvento | X | LP |
| `120601` | Boates, taxi-dancing e congêneres. | - | X | - | X | atvEvento | X | LP |
| `120701` | Shows, ballet, danças, desfiles, bailes, óperas, concertos, recitais, festivais e congêneres. | - | X | - | X | atvEvento | X | LP |
| `120801` | Feiras, exposições, congressos e congêneres. | - | X | - | X | atvEvento | X | LP |
| `120901` | Bilhares. | - | X | - | X | atvEvento | X | LP |
| `120902` | Boliches. | - | X | - | X | atvEvento | X | LP |
| `120903` | Diversões eletrônicas ou não. | - | X | - | X | atvEvento | X | LP |
| `121001` | Corridas e competições de animais. | - | X | - | X | atvEvento | X | LP |
| `121101` | Competições esportivas ou de destreza física ou intelectual, com ou sem a participação do espectador. | - | X | - | X | atvEvento | X | LP |
| `121201` | Execução de música. | - | X | - | X | atvEvento | X | LP |
| `121301` | Produção, mediante ou sem encomenda prévia, de eventos, espetáculos, entrevistas, shows, ballet, danças, desfiles, bailes, teatros, óperas, concertos, recitais, festivais e congêneres. | X | - | - | X | atvEvento | X | EP |
| `121401` | Fornecimento de música para ambientes fechados ou não, mediante transmissão por qualquer processo. | - | X | - | X | atvEvento | X | LP |
| `121501` | Desfiles de blocos carnavalescos ou folclóricos, trios elétricos e congêneres. | - | X | - | X | atvEvento | X | LP |
| `121601` | Exibição de filmes, entrevistas, musicais, espetáculos, shows, concertos, desfiles, óperas, competições esportivas, de destreza intelectual ou congêneres. | - | X | - | X | atvEvento | X | LP |
| `121701` | Recreação e animação, inclusive em festas e eventos de qualquer natureza. | - | X | - | X | atvEvento | X | LP |
| `130201` | Fonografia ou gravação de sons, inclusive trucagem, dublagem, mixagem e congêneres. | X | - | - | X | - | X | EP |
| `130301` | Fotografia e cinematografia, inclusive revelação, ampliação, cópia, reprodução, trucagem e congêneres. | X | - | - | X | - | X | EP |
| `130401` | Reprografia, microfilmagem e digitalização. | X | - | - | X | - | X | EP |
| `130501` | Composição gráfica, inclusive confecção de impressos gráficos, fotocomposição, clicheria, zincografia, litografia e fotolitografia, exceto se destinados a posterior operação de comercialização ou industrialização, ainda que incorporados, de qualquer forma, a outra mercadoria que deva ser objeto de posterior circulação, tais como bulas, rótulos, etiquetas, caixas, cartuchos, embalagens e manuais técnicos e de instrução, quando ficarão sujeitos ao ICMS. | X | - | - | X | - | X | EP |
| `140101` | Lubrificação, limpeza, lustração, revisão, carga e recarga, conserto, restauração, blindagem, manutenção e conservação de máquinas, veículos, aparelhos, equipamentos, motores, elevadores ou de qualquer objeto (exceto peças e partes empregadas, que ficam sujeitas ao ICMS). | X | - | - | X | - | X | EP |
| `140201` | Assistência técnica. | X | - | - | X | - | X | EP |
| `140301` | Recondicionamento de motores (exceto peças e partes empregadas, que ficam sujeitas ao ICMS). | X | - | - | X | - | X | EP |
| `140401` | Recauchutagem ou regeneração de pneus. | X | - | - | X | - | X | EP |
| `140501` | Restauração, recondicionamento, acondicionamento, pintura, beneficiamento, lavagem, secagem, tingimento, galvanoplastia, anodização, corte, recorte, plastificação, costura, acabamento, polimento e congêneres de objetos quaisquer. | X | - | - | X | - | X | EP |
| `140601` | Instalação e montagem de aparelhos, máquinas e equipamentos, inclusive montagem industrial, prestados ao usuário final, exclusivamente com material por ele fornecido. | X | - | - | X | - | X | EP |
| `140701` | Colocação de molduras e congêneres. | X | - | - | X | - | X | EP |
| `140801` | Encadernação, gravação e douração de livros, revistas e congêneres. | X | - | - | X | - | X | EP |
| `140901` | Alfaiataria e costura, quando o material for fornecido pelo usuário final, exceto aviamento. | X | - | - | X | - | X | EP |
| `141001` | Tinturaria e lavanderia. | X | - | - | X | - | X | EP |
| `141101` | Tapeçaria e reforma de estofamentos em geral. | X | - | - | X | - | X | EP |
| `141201` | Funilaria e lanternagem. | X | - | - | X | - | X | EP |
| `141301` | Carpintaria. | X | - | - | X | - | X | EP |
| `141302` | Serralheria. | X | - | - | X | - | X | EP |
| `141401` | Guincho intramunicipal. | - | X | - | X | - | X | LP |
| `141402` | Guindaste e içamento. | - | X | - | X | - | X | LP |
| `141403` | Guincho intramunicipal em construção civil. | - | X | - | X | obra | X | LP |
| `141404` | Guindaste e içamento em construção civil. | - | X | - | X | obra | X | LP |
| `150101` | Administração de fundos quaisquer e congêneres. | X | - | - | X | - | X | EP |
| `150102` | Administração de consórcio e congêneres. | X | - | - | X | - | X | EP |
| `150103` | Administração de cartão de crédito ou débito e congêneres. | X | - | - | X | - | X | EP |
| `150104` | Administração de carteira de clientes e congêneres. | X | - | - | X | - | X | EP |
| `150105` | Administração de cheques pré-datados e congêneres. | X | - | - | X | - | X | EP |
| `150201` | Abertura de conta-corrente no País, bem como a manutenção da referida conta ativa e inativa. | X | - | - | X | - | X | EP |
| `150202` | Abertura de conta-corrente no exterior, bem como a manutenção da referida conta ativa e inativa. | X | - | - | X | - | X | EP |
| `150203` | Abertura de conta de investimentos e aplicação no País, bem como a manutenção da referida conta ativa e inativa. | X | - | - | X | - | X | EP |
| `150204` | Abertura de conta de investimentos e aplicação no exterior, bem como a manutenção da referida conta ativa e inativa. | X | - | - | X | - | X | EP |
| `150205` | Abertura de caderneta de poupança no País, bem como a manutenção da referida conta ativa e inativa. | X | - | - | X | - | X | EP |
| `150206` | Abertura de caderneta de poupança no exterior, bem como a manutenção da referida conta ativa e inativa. | X | - | - | X | - | X | EP |
| `150207` | Abertura de contas em geral no País, não abrangida em outro subitem, bem como a manutenção das referidas contas ativas e inativas. | X | - | - | X | - | X | EP |
| `150208` | Abertura de contas em geral no exterior, não abrangida em outro subitem, bem como a manutenção das referidas contas ativas e inativas. | X | - | - | X | - | X | EP |
| `150301` | Locação de cofres particulares. | X | - | - | X | - | X | EP |
| `150302` | Manutenção de cofres particulares. | X | - | - | X | - | X | EP |
| `150303` | Locação de terminais eletrônicos. | X | - | - | X | - | X | EP |
| `150304` | Manutenção de terminais eletrônicos. | X | - | - | X | - | X | EP |
| `150305` | Locação de terminais de atendimento. | X | - | - | X | - | X | EP |
| `150306` | Manutenção de terminais de atendimento. | X | - | - | X | - | X | EP |
| `150307` | Locação de bens e equipamentos em geral. | X | - | - | X | - | X | EP |
| `150308` | Manutenção de bens e equipamentos em geral. | X | - | - | X | - | X | EP |
| `150401` | Fornecimento ou emissão de atestados em geral, inclusive atestado de idoneidade, atestado de capacidade financeira e congêneres. | X | - | - | X | - | X | EP |
| `150501` | Cadastro, elaboração de ficha cadastral, renovação cadastral e congêneres. | X | - | - | X | - | X | EP |
| `150502` | Inclusão no Cadastro de Emitentes de Cheques sem Fundos - CCF. | X | - | - | X | - | X | EP |
| `150503` | Exclusão no Cadastro de Emitentes de Cheques sem Fundos - CCF. | X | - | - | X | - | X | EP |
| `150504` | Inclusão em quaisquer outros bancos cadastrais. | X | - | - | X | - | X | EP |
| `150505` | Exclusão em quaisquer outros bancos cadastrais. | X | - | - | X | - | X | EP |
| `150601` | Emissão, reemissão e fornecimento de avisos, comprovantes e documentos em geral | X | - | - | X | - | X | EP |
| `150602` | Abono de firmas. | X | - | - | X | - | X | EP |
| `150603` | Coleta e entrega de documentos, bens e valores. | X | - | - | X | - | X | EP |
| `150604` | Comunicação com outra agência ou com a administração central. | X | - | - | X | - | X | EP |
| `150605` | Licenciamento eletrônico de veículos. | X | - | - | X | - | X | EP |
| `150606` | Transferência de veículos. | X | - | - | X | - | X | EP |
| `150607` | Agenciamento fiduciário ou depositário. | X | - | - | X | - | X | EP |
| `150608` | Devolução de bens em custódia. | X | - | - | X | - | X | EP |
| `150701` | Acesso, movimentação, atendimento e consulta a contas em geral, por qualquer meio ou processo, inclusive por telefone, fac-símile, internet e telex. | X | - | - | X | - | X | EP |
| `150702` | Acesso a terminais de atendimento, inclusive vinte e quatro horas. | X | - | - | X | - | X | EP |
| `150703` | Acesso a outro banco e à rede compartilhada. | X | - | - | X | - | X | EP |
| `150704` | Fornecimento de saldo, extrato e demais informações relativas a contas em geral, por qualquer meio ou processo. | X | - | - | X | - | X | EP |
| `150801` | Emissão, reemissão, alteração, cessão, substituição, cancelamento e registro de contrato de crédito. | X | - | - | X | - | X | EP |
| `150802` | Estudo, análise e avaliação de operações de crédito. | X | - | - | X | - | X | EP |
| `150803` | Emissão, concessão, alteração ou contratação de aval, fiança, anuência e congêneres. | X | - | - | X | - | X | EP |
| `150804` | Serviços relativos à abertura de crédito, para quaisquer fins. | X | - | - | X | - | X | EP |
| `150901` | Arrendamento mercantil (leasing) de quaisquer bens, inclusive cessão de direitos e obrigações, substituição de garantia, alteração, cancelamento e registro de contrato, e demais serviços relacionados ao arrendamento mercantil (leasing). | X | - | - | X | - | X | EP |
| `151001` | Serviços relacionados a cobranças em geral, de títulos quaisquer, de contas ou carnês, de câmbio, de tributos e por conta de terceiros, inclusive os efetuados por meio eletrônico, automático ou por máquinas de atendimento. | X | - | - | X | - | X | EP |
| `151002` | Serviços relacionados a recebimentos em geral, de títulos quaisquer, de contas ou carnês, de câmbio, de tributos e por conta de terceiros, inclusive os efetuados por meio eletrônico, automático ou por máquinas de atendimento. | X | - | - | X | - | X | EP |
| `151003` | Serviços relacionados a pagamentos em geral, de títulos quaisquer, de contas ou carnês, de câmbio, de tributos e por conta de terceiros, inclusive os efetuados por meio eletrônico, automático ou por máquinas de atendimento. | X | - | - | X | - | X | EP |
| `151004` | Serviços relacionados a fornecimento de posição de cobrança, recebimento ou pagamento. | X | - | - | X | - | X | EP |
| `151005` | Serviços relacionados a emissão de carnês, fichas de compensação, impressos e documentos em geral. | X | - | - | X | - | X | EP |
| `151101` | Devolução de títulos, protesto de títulos, sustação de protesto, manutenção de títulos, reapresentação de títulos, e demais serviços a eles relacionados. | X | - | - | X | - | X | EP |
| `151201` | Custódia em geral, inclusive de títulos e valores mobiliários. | X | - | - | X | - | X | EP |
| `151301` | Serviços relacionados a operações de câmbio em geral, edição, alteração, prorrogação, cancelamento e baixa de contrato de câmbio. | X | - | - | X | - | X | EP |
| `151302` | Serviços relacionados a emissão de registro de exportação ou de crédito. | X | - | - | X | - | X | EP |
| `151303` | Serviços relacionados a cobrança ou depósito no exterior. | X | - | - | X | - | X | EP |
| `151304` | Serviços relacionados a emissão, fornecimento e cancelamento de cheques de viagem. | X | - | - | X | - | X | EP |
| `151305` | Serviços relacionados a fornecimento, transferência, cancelamento e demais serviços relativos a carta de crédito de importação, exportação e garantias recebidas. | X | - | - | X | - | X | EP |
| `151306` | Serviços relacionados a envio e recebimento de mensagens em geral relacionadas a operações de câmbio. | X | - | - | X | - | X | EP |
| `151401` | Fornecimento, emissão, reemissão de cartão magnético, cartão de crédito, cartão de débito, cartão salário e congêneres. | X | - | - | X | - | X | EP |
| `151402` | Renovação de cartão magnético, cartão de crédito, cartão de débito, cartão salário e congêneres. | X | - | - | X | - | X | EP |
| `151403` | Manutenção de cartão magnético, cartão de crédito, cartão de débito, cartão salário e congêneres. | X | - | - | X | - | X | EP |
| `151501` | Compensação de cheques e títulos quaisquer. | X | - | - | X | - | X | EP |
| `151502` | Serviços relacionados a depósito, inclusive depósito identificado, a saque de contas quaisquer, por qualquer meio ou processo, inclusive em terminais eletrônicos e de atendimento. | X | - | - | X | - | X | EP |
| `151601` | Emissão, reemissão, liquidação, alteração, cancelamento e baixa de ordens de pagamento, ordens de crédito e similares, por qualquer meio ou processo. | X | - | - | X | - | X | EP |
| `151602` | Serviços relacionados à transferência de valores, dados, fundos, pagamentos e similares, inclusive entre contas em geral. | X | - | - | X | - | X | EP |
| `151701` | Emissão e fornecimento de cheques quaisquer, avulso ou por talão. | X | - | - | X | - | X | EP |
| `151702` | Devolução de cheques quaisquer, avulso ou por talão. | X | - | - | X | - | X | EP |
| `151703` | Sustação, cancelamento e oposição de cheques quaisquer, avulso ou por talão. | X | - | - | X | - | X | EP |
| `151801` | Serviços relacionados a crédito imobiliário, de avaliação e vistoria de imóvel ou obra. | X | - | - | X | - | X | EP |
| `151802` | Serviços relacionados a crédito imobiliário, de análise técnica e jurídica. | X | - | - | X | - | X | EP |
| `151803` | Serviços relacionados a crédito imobiliário, de emissão, reemissão, alteração, transferência e renegociação de contrato. | X | - | - | X | - | X | EP |
| `151804` | Serviços relacionados a crédito imobiliário, de emissão e reemissão do termo de quitação. | X | - | - | X | - | X | EP |
| `151805` | Demais serviços relacionados a crédito imobiliário. | X | - | - | X | - | X | EP |
| `160101` | Serviços de transporte coletivo municipal rodoviário de passageiros. | - | X | - | X | - | X | LP |
| `160102` | Serviços de transporte coletivo municipal metroviário de passageiros. | - | X | - | X | - | X | LP |
| `160103` | Serviços de transporte coletivo municipal ferroviário de passageiros. | - | X | - | X | - | X | LP |
| `160104` | Serviços de transporte coletivo municipal aquaviário de passageiros. | - | X | - | X | - | X | LP |
| `160201` | Outros serviços de transporte de natureza municipal. | - | X | - | X | - | X | LP |
| `170101` | Assessoria ou consultoria de qualquer natureza, não contida em outros itens desta lista. | X | - | - | X | - | X | EP |
| `170102` | Análise, exame, pesquisa, coleta, compilação e fornecimento de dados e informações de qualquer natureza, inclusive cadastro e similares. | X | - | - | X | - | X | EP |
| `170201` | Datilografia, digitação, estenografia e congêneres. | X | - | - | X | - | X | EP |
| `170202` | Expediente, secretaria em geral, apoio e infra-estrutura administrativa e congêneres. | X | - | - | X | - | X | EP |
| `170203` | Resposta audível e congêneres. | X | - | - | X | - | X | EP |
| `170204` | Redação, edição, revisão e congêneres. | X | - | - | X | - | X | EP |
| `170205` | Interpretação, tradução e congêneres. | X | - | - | X | - | X | EP |
| `170301` | Planejamento, coordenação, programação ou organização técnica. | X | - | - | X | - | X | EP |
| `170302` | Planejamento, coordenação, programação ou organização financeira. | X | - | - | X | - | X | EP |
| `170303` | Planejamento, coordenação, programação ou organização administrativa. | X | - | - | X | - | X | EP |
| `170401` | Recrutamento, agenciamento, seleção e colocação de mão-de-obra. | X | - | - | X | - | X | EP |
| `170501` | Fornecimento de mão-de-obra, mesmo em caráter temporário, inclusive de empregados ou trabalhadores, avulsos ou temporários, contratados pelo prestador de serviço. | - | - | X | X | - | X | ET |
| `170601` | Propaganda e publicidade, inclusive promoção de vendas, planejamento de campanhas ou sistemas de publicidade, elaboração de desenhos, textos e demais materiais publicitários. | X | - | - | X | - | X | EP |
| `170801` | Franquia (franchising). | X | - | - | X | - | X | EP |
| `170901` | Perícias, laudos, exames técnicos e análises técnicas. | X | - | - | X | - | X | EP |
| `171001` | Planejamento, organização e administração de feiras, exposições, e congêneres. | - | X | - | X | - | X | LP |
| `171002` | Planejamento, organização e administração de congressos e congêneres. | - | X | - | X | - | X | LP |
| `171101` | Organização de festas e recepções. | X | - | - | X | - | X | EP |
| `171102` | Bufê (exceto o fornecimento de alimentação e bebidas, que fica sujeito ao ICMS). | X | - | - | X | - | X | EP |
| `171201` | Administração em geral, inclusive de bens e negócios de terceiros. | X | - | - | X | - | X | EP |
| `171301` | Leilão e congêneres. | X | - | - | X | - | X | EP |
| `171401` | Advocacia | X | - | - | X | - | X | EP |
| `171501` | Arbitragem de qualquer espécie, inclusive jurídica. | X | - | - | X | - | X | EP |
| `171601` | Auditoria. | X | - | - | X | - | X | EP |
| `171701` | Análise de Organização e Métodos. | X | - | - | X | - | X | EP |
| `171801` | Atuária e cálculos técnicos de qualquer natureza. | X | - | - | X | - | X | EP |
| `171901` | Contabilidade, inclusive serviços técnicos e auxiliares. | X | - | - | X | - | X | EP |
| `172001` | Consultoria e assessoria econômica ou financeira. | X | - | - | X | - | X | EP |
| `172101` | Estatística. | X | - | - | X | - | X | EP |
| `172201` | Cobrança em geral. | X | - | - | X | - | X | EP |
| `172301` | Assessoria, análise, avaliação, atendimento, consulta, cadastro, seleção, gerenciamento de informações, administração de contas a receber ou a pagar e em geral, relacionados a operações de faturização (factoring). | X | - | - | X | - | X | EP |
| `172401` | Apresentação de palestras, conferências, seminários e congêneres. | X | - | - | X | - | X | EP |
| `172501` | Inserção de textos, desenhos e outros materiais de propaganda e publicidade, em qualquer meio (exceto em livros, jornais, periódicos e nas modalidades de serviços de radiodifusão sonora e de sons e imagens de recepção livre e gratuita). | X | - | - | X | - | X | EP |
| `180101` | Serviços de regulação de sinistros vinculados a contratos de seguros e congêneres. | X | - | - | X | - | X | EP |
| `180102` | Serviços de inspeção e avaliação de riscos para cobertura de contratos de seguros e congêneres. | X | - | - | X | - | X | EP |
| `180103` | Serviços de prevenção e gerência de riscos seguráveis e congêneres. | X | - | - | X | - | X | EP |
| `190101` | Serviços de distribuição e venda de bilhetes e demais produtos de loteria, cartões, pules ou cupons de apostas, sorteios, prêmios, inclusive os decorrentes de títulos de capitalização e congêneres. | X | - | - | X | - | X | EP |
| `190102` | Serviços de distribuição e venda de bingos e congêneres. | X | - | - | X | - | X | EP |
| `200101` | Serviços portuários, ferroportuários, utilização de porto, movimentação de passageiros, reboque de embarcações, rebocador escoteiro, atracação, desatracação, serviços de praticagem, capatazia, armazenagem de qualquer natureza, serviços acessórios, movimentação de mercadorias, serviços de apoio marítimo, de movimentação ao largo, serviços de armadores, estiva, conferência, logística e congêneres. | - | (**) X | - | X | - | X | LP |
| `200201` | Serviços aeroportuários, utilização de aeroporto, movimentação de passageiros, armazenagem de qualquer natureza, capatazia, movimentação de aeronaves, serviços de apoio aeroportuários, serviços acessórios, movimentação de mercadorias, logística e congêneres. | - | X | - | X | - | X | LP |
| `200301` | Serviços de terminais rodoviários, ferroviários, metroviários, movimentação de passageiros, mercadorias, inclusive suas operações, logística e congêneres. | - | X | - | X | - | X | LP |
| `210101` | Serviços de registros públicos, cartorários e notariais. | X | - | - | X | - | X | EP |
| `220101` | Serviços de exploração de rodovia mediante cobrança de preço ou pedágio dos usuários, envolvendo execução de serviços de conservação, manutenção, melhoramentos para adequação de capacidade e segurança de trânsito, operação, monitoração, assistência aos usuários e outros serviços definidos em contratos, atos de concessão ou de permissão ou em normas oficiais. | - | X | - | X | - | X | LP |
| `230101` | Serviços de programação e comunicação visual e congêneres. | X | - | - | X | - | X | EP |
| `230102` | Serviços de desenho industrial e congêneres. | X | - | - | X | - | X | EP |
| `240101` | Serviços de chaveiros, confecção de carimbos e congêneres. | X | - | - | X | - | X | EP |
| `240102` | Serviços de placas, sinalização visual, banners, adesivos e congêneres. | X | - | - | X | - | X | EP |
| `250101` | Funerais, inclusive fornecimento de caixão, urna ou esquifes; aluguel de capela; transporte do corpo cadavérico; fornecimento de flores, coroas e outros paramentos; desembaraço de certidão de óbito; fornecimento de véu, essa e outros adornos; embalsamento, embelezamento, conservação ou restauração de cadáveres. | X | - | - | X | - | X | EP |
| `250201` | Translado intramunicipal de corpos e partes de corpos cadavéricos. | X | - | - | X | - | X | EP |
| `250202` | Cremação de corpos e partes de corpos cadavéricos. | X | - | - | X | - | X | EP |
| `250301` | Planos ou convênio funerários. | X | - | - | X | - | X | EP |
| `250401` | Manutenção e conservação de jazigos e cemitérios. | X | - | - | X | - | X | EP |
| `250501` | Cessão de uso de espaços em cemitérios para sepultamento. | X | - | - | X | - | X | EP |
| `260101` | Serviços de coleta, remessa ou entrega de correspondências, documentos, objetos, bens ou valores, inclusive pelos correios e suas agências franqueadas. | X | - | - | X | - | X | EP |
| `260102` | Serviços de courrier e congêneres. | X | - | - | X | - | X | EP |
| `270101` | Serviços de assistência social. | X | - | - | X | - | X | EP |
| `280101` | Serviços de avaliação de bens e serviços de qualquer natureza. | X | - | - | X | - | X | EP |
| `290101` | Serviços de biblioteconomia. | X | - | - | X | - | X | EP |
| `300101` | Serviços de biologia e biotecnologia. | X | - | - | X | - | X | EP |
| `300102` | Serviços de química. | X | - | - | X | - | X | EP |
| `310101` | Serviços técnicos em edificações e congêneres. | X | - | - | X | - | X | EP |
| `310102` | Serviços técnicos em eletrônica, eletrotécnica e congêneres. | X | - | - | X | - | X | EP |
| `310103` | Serviços técnicos em mecânica e congêneres. | X | - | - | X | - | X | EP |
| `310104` | Serviços técnicos em telecomunicações e congêneres. | X | - | - | X | - | X | EP |
| `320101` | Serviços de desenhos técnicos. | X | - | - | X | - | X | EP |
| `330101` | Serviços de desembaraço aduaneiro, comissários, despachantes e congêneres. | X | - | - | X | - | X | EP |
| `340101` | Serviços de investigações particulares, detetives e congêneres. | X | - | - | X | - | X | EP |
| `350101` | Serviços de reportagem e jornalismo. | X | - | - | X | - | X | EP |
| `350102` | Serviços de assessoria de imprensa. | X | - | - | X | - | X | EP |
| `350103` | Serviços de relações públicas. | X | - | - | X | - | X | EP |
| `360101` | Serviços de meteorologia. | X | - | - | X | - | X | EP |
| `370101` | Serviços de artistas, atletas, modelos e manequins. | X | - | - | X | - | X | EP |
| `380101` | Serviços de museologia. | X | - | - | X | - | X | EP |
| `390101` | Serviços de ourivesaria e lapidação (quando o material for fornecido pelo tomador do serviço). | X | - | - | X | - | X | EP |
| `400101` | Obras de arte sob encomenda. | X | - | - | X | - | X | EP |
| `990101` | Serviços sem a incidência de ISSQN e ICMS | - | - | - | - | - | X | sem LI indicada |

## 4. Matriz de cenários de exportação / comércio exterior

A matriz abaixo preserva os 112 cenários da aba `EXPORTACAO_EMISSÃO_NFS-e`. Ela combina a localização do tomador, intermediário e prestação do serviço com a regra de incidência do subitem e a declaração de tributação do ISSQN.

### 4.1 Semântica das colunas normalizadas

- `Tomador`, `Intermediário` e `LP`: `Brasil` ou `Ext` conforme a planilha.
- `Referência LI do serviço`: `EP`, `ET`, `LP`, `99.01.01`, `Qq.Serv.Param.Mun.Incid.` ou variante literal existente na fonte.
- `Caso especial?`: resposta à pergunta da fonte sobre imunidade, exportação de serviço ou não incidência do ISSQN.
- `Exportação ISSQN?`: conclusão para ISSQN considerando o local da prestação no exterior.
- `Exportação RFB?`: conclusão de comércio exterior para RFB quando ao menos um dos três locais está no exterior.
- `Mensagem`: mensagem/aviso disparado após a validação; os textos completos dos comentários do XLSX aparecem na subseção 4.3.
- `LI resultante`: existência e município da incidência após a validação.
- `NBS`, `País resultado` e `Grupo Comex`: `SIM`, `NÃO`, `Opcional` ou `X` (cenário inexistente), conforme a matriz original.

### 4.2 Cenários

| Cenário | Tomador | Intermediário | LP | Referência LI do serviço | Caso especial? | Tributação ISSQN | Exportação ISSQN? | Exportação RFB? | Mensagem | LI resultante | NBS | País resultado | Grupo Comex |
|---:|---|---|---|---|:---:|---|:---:|:---:|---|---|---|---|---|
| 1 | Brasil | Brasil | Brasil | EP | Sim | Imunidade | - | NÃO | - | - | Opcional | NÃO | NÃO |
| 2 | Brasil | Brasil | Brasil | EP | Sim | Exportação de Serviço | NÃO | NÃO | - | - | SIM | SIM | SIM |
| 3 | Brasil | Brasil | Brasil | EP | Sim | Não Incidência | - | NÃO | MENSAGEM ERRO 3 | X | X | X | X |
| 4 | Brasil | Brasil | Brasil | EP | Não | Operação Tributável | NÃO | NÃO | - | Município do EP | Opcional | NÃO | NÃO |
| 5 | Brasil | Brasil | Brasil | ET | Sim | Imunidade | - | NÃO | - | - | Opcional | NÃO | NÃO |
| 6 | Brasil | Brasil | Brasil | ET | Sim | Exportação de Serviço | NÃO | NÃO | MENSAGEM ERRO 1 | X | X | X | X |
| 7 | Brasil | Brasil | Brasil | ET | Sim | Não Incidência | - | NÃO | MENSAGEM ERRO 3 | X | X | X | X |
| 8 | Brasil | Brasil | Brasil | ET | Não | Operação Tributável | NÃO | NÃO | - | Município do ET | Opcional | NÃO | NÃO |
| 9 | Brasil | Brasil | Brasil | LP | Sim | Imunidade | - | NÃO | - | - | Opcional | NÃO | NÃO |
| 10 | Brasil | Brasil | Brasil | LP | Sim | Exportação de Serviço | NÃO | NÃO | MENSAGEM ERRO 1 | X | X | X | X |
| 11 | Brasil | Brasil | Brasil | LP | Sim | Não Incidência | - | NÃO | MENSAGEM ERRO 3 | X | X | X | X |
| 12 | Brasil | Brasil | Brasil | LP | Não | Operação Tributável | NÃO | NÃO | - | Município do LP | Opcional | NÃO | NÃO |
| 13 | Brasil | Brasil | Brasil | 99.01.01 | Sim | Não Incidência | - | NÃO | - | - | Opcional | NÃO | NÃO |
| 14 | Brasil | Brasil | Brasil | Qq.Serv.Param.Mun.Incid. | Sim | Não Incidência | - | NÃO | - | - | Opcional | NÃO | NÃO |
| 15 | Brasil | Brasil | Ext | EP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 16 | Brasil | Brasil | Ext | EP | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 17 | Brasil | Brasil | Ext | EP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 18 | Brasil | Brasil | Ext | EP | Não | Operação Tributável | SIM | SIM | - | Município do EP | SIM | NÃO | SIM |
| 19 | Brasil | Brasil | Ext | ET | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 20 | Brasil | Brasil | Ext | ET | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 21 | Brasil | Brasil | Ext | ET | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 22 | Brasil | Brasil | Ext | ET | Não | Operação Tributável | SIM | SIM | - | Município do ET | SIM | NÃO | SIM |
| 23 | Brasil | Brasil | Ext | LP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 24 | Brasil | Brasil | Ext | LP | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 25 | Brasil | Brasil | Ext | LP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 26 | Brasil | Brasil | Ext | LP | Não | Operação Tributável | SIM | SIM | MENSAGEM ERRO 2 | X | X | X | X |
| 27 | Brasil | Brasil | Ext | 99.01.01 | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 28 | Brasil | Brasil | Ext | Qq.Serv.Param.Mun.Incid. | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 29 | Brasil | Ext | Brasil | EP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 30 | Brasil | Ext | Brasil | EP | Sim | Exportação de Serviço | NÃO | SIM | - | - | SIM | SIM | SIM |
| 31 | Brasil | Ext | Brasil | EP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 32 | Brasil | Ext | Brasil | EP | Não | Operação Tributável | NÃO | SIM | - | Município do EP | SIM | NÃO | SIM |
| 33 | Brasil | Ext | Brasil | ET | Sim | Imunidade | - | SIM | - | - | SIM | - | SIM |
| 34 | Brasil | Ext | Brasil | ET | Sim | Exportação de Serviço | NÃO | SIM | MENSAGEM ERRO 1 | X | X | X | X |
| 35 | Brasil | Ext | Brasil | ET | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 36 | Brasil | Ext | Brasil | ET | Não | Operação Tributável | NÃO | SIM | - | Município do ET | SIM | NÃO | SIM |
| 37 | Brasil | Ext | Brasil | LP | Sim | Imunidade | - | SIM | - | - | SIM | - | SIM |
| 38 | Brasil | Ext | Brasil | LP | Sim | Exportação de Serviço | NÃO | SIM | MENSAGEM ERRO 1 | X | X | X | X |
| 39 | Brasil | Ext | Brasil | LP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 40 | Brasil | Ext | Brasil | LP | Não | Operação Tributável | NÃO | SIM | - | Município do LP | SIM | NÃO | SIM |
| 41 | Brasil | Ext | Brasil | 99.01.01 | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 42 | Brasil | Ext | Brasil | Qq.Serv.Param.Mun.Incid. | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 43 | Brasil | Ext | Ext | EP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 44 | Brasil | Ext | Ext | EP | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 45 | Brasil | Ext | Ext | EP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 46 | Brasil | Ext | Ext | EP | Não | Operação Tributável | SIM | SIM | - | Município do EP | SIM | NÃO | SIM |
| 47 | Brasil | Ext | Ext | ET | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 48 | Brasil | Ext | Ext | ET | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 49 | Brasil | Ext | Ext | ET | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 50 | Brasil | Ext | Ext | ET | Não | Operação Tributável | SIM | SIM | - | Município do ET | SIM | NÃO | SIM |
| 51 | Brasil | Ext | Ext | LP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 52 | Brasil | Ext | Ext | LP | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 53 | Brasil | Ext | Ext | LP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 54 | Brasil | Ext | Ext | LP | Não | Operação Tributável | SIM | SIM | MENSAGEM ERRO 2 | X | X | X | X |
| 55 | Brasil | Ext | Ext | 99.01.01 | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 56 | Brasil | Ext | Ext | Param.Mun.Incid. | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 57 | Ext | Brasil | Brasil | EP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 58 | Ext | Brasil | Brasil | EP | Sim | Exportação de Serviço | NÃO | SIM | - | - | SIM | SIM | SIM |
| 59 | Ext | Brasil | Brasil | EP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 60 | Ext | Brasil | Brasil | EP | Não | Operação Tributável | NÃO | SIM | - | Município do EP | SIM | NÃO | SIM |
| 61 | Ext | Brasil | Brasil | ET | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 62 | Ext | Brasil | Brasil | ET | Sim | Exportação de Serviço | NÃO | SIM | - | - | SIM | SIM | SIM |
| 63 | Ext | Brasil | Brasil | ET | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 64 | Ext | Brasil | Brasil | ET | Não | Operação Tributável | NÃO | SIM | MENSAGEM AVISO 1 | Município do LP | SIM | NÃO | SIM |
| 65 | Ext | Brasil | Brasil | LP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 66 | Ext | Brasil | Brasil | LP | Sim | Exportação de Serviço | NÃO | SIM | MENSAGEM ERRO 1 | X | X | X | X |
| 67 | Ext | Brasil | Brasil | LP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 68 | Ext | Brasil | Brasil | LP | Não | Operação Tributável | NÃO | SIM | - | Município do LP | SIM | SIM | SIM |
| 69 | Ext | Brasil | Brasil | 99.01.01 | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 70 | Ext | Brasil | Brasil | Qq.Serv.Param.Mun.Incid. | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 71 | Ext | Ext | Brasil | EP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 72 | Ext | Ext | Brasil | EP | Sim | Exportação de Serviço | NÃO | SIM | - | - | SIM | SIM | SIM |
| 73 | Ext | Ext | Brasil | EP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 74 | Ext | Ext | Brasil | EP | Não | Operação Tributável | NÃO | SIM | - | Município do EP | SIM | NÃO | SIM |
| 75 | Ext | Ext | Brasil | ET | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 76 | Ext | Ext | Brasil | ET | Sim | Exportação de Serviço | NÃO | SIM | - | - | SIM | SIM | SIM |
| 77 | Ext | Ext | Brasil | ET | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 78 | Ext | Ext | Brasil | ET | Não | Operação Tributável | NÃO | SIM | MENSAGEM AVISO 1 | Município do LP | SIM | NÃO | SIM |
| 79 | Ext | Ext | Brasil | LP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 80 | Ext | Ext | Brasil | LP | Sim | Exportação de Serviço | NÃO | SIM | MENSAGEM ERRO 1 | X | X | X | X |
| 81 | Ext | Ext | Brasil | LP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 82 | Ext | Ext | Brasil | LP | Não | Operação Tributável | NÃO | SIM | - | Município do LP | SIM | NÃO | SIM |
| 83 | Ext | Ext | Brasil | 99.01.01 | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 84 | Ext | Ext | Brasil | Qq.Serv.Param.Mun.Incid. | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 85 | Ext | Brasil | Ext | EP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 86 | Ext | Brasil | Ext | EP | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 87 | Ext | Brasil | Ext | EP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 88 | Ext | Brasil | Ext | EP | Não | Operação Tributável | SIM | SIM | - | Município do EP | SIM | NÃO | SIM |
| 89 | Ext | Brasil | Ext | ET | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 90 | Ext | Brasil | Ext | ET | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 91 | Ext | Brasil | Ext | ET | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 92 | Ext | Brasil | Ext | ET | Não | Operação Tributável | SIM | SIM | MENSAGEM ERRO 2 | X | X | X | X |
| 93 | Ext | Brasil | Ext | LP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 94 | Ext | Brasil | Ext | LP | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 95 | Ext | Brasil | Ext | LP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 96 | Ext | Brasil | Ext | LP | Não | Operação Tributável | SIM | SIM | MENSAGEM ERRO 2 | X | X | X | X |
| 97 | Ext | Brasil | Ext | 99.01.01 | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 98 | Ext | Brasil | Ext | Qq.Serv.Param.Mun.Incid. | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |
| 99 | Ext | Ext | Ext | EP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 100 | Ext | Ext | Ext | EP | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 101 | Ext | Ext | Ext | EP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 102 | Ext | Ext | Ext | EP | Não | Operação Tributável | SIM | SIM | - | Município do EP | SIM | NÃO | SIM |
| 103 | Ext | Ext | Ext | ET | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 104 | Ext | Ext | Ext | ET | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 105 | Ext | Ext | Ext | ET | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 106 | Ext | Ext | Ext | ET | Não | Operação Tributável | SIM | SIM | MENSAGEM ERRO 2 | X | X | X | X |
| 107 | Ext | Ext | Ext | LP | Sim | Imunidade | - | SIM | - | - | SIM | NÃO | SIM |
| 108 | Ext | Ext | Ext | LP | Sim | Exportação de Serviço | SIM | SIM | - | - | SIM | NÃO | SIM |
| 109 | Ext | Ext | Ext | LP | Sim | Não Incidência | - | SIM | MENSAGEM ERRO 3 | X | X | X | X |
| 110 | Ext | Ext | Ext | LP | Não | Operação Tributável | SIM | SIM | MENSAGEM ERRO 2 | X | X | X | X |
| 111 | Ext | Ext | Ext | 99.01.01 | Sim | Não Incidência | SIM | SIM | - | - | SIM | NÃO | SIM |
| 112 | Ext | Brasil | Ext | Qq.Serv.Param.Mun.Incid. | Sim | Não Incidência | - | SIM | - | - | SIM | NÃO | SIM |

### 4.3 Comentários de célula associados aos cenários

Os textos abaixo estavam em **comentários de células**, não no conteúdo visível da tabela. Eles foram agrupados por texto, preservando as células e cenários em que aparecem.

#### EXP-COM-01

- **Células de origem:** `J8`, `J12`, `J16`, `J22`, `J26`, `J30`, `J36`, `J40`, `J44`, `J50`, `J54`, `J58`, `J64`, `J68`, `J72`, `J78`, `J82`, `J86`, `J92`, `J96`, `J100`, `J106`, `J110`, `J114`
- **Cenários associados:** 3, 7, 11, 17, 21, 25, 31, 35, 39, 45, 49, 53, 59, 63, 67, 73, 77, 81, 87, 91, 95, 101, 105, 109
- **Autor(es) do comentário:** Adriano Guedes da Silva
- **Texto:** Mensagem de erro:<br>A opção "Não Incidência" para a tributação do ISSQN somente é válida quando o código de tributação nacional selecionado corresponder ao código de serviço 99.01.01 - Serviço sem incidência de ISSQN e ICMS.

#### EXP-COM-02

- **Células de origem:** `J11`, `J15`
- **Cenários associados:** 6, 10
- **Autor(es) do comentário:** Adriano Guedes da Silva
- **Texto:** Mensagem de erro:<br>O sistema considera este cenário para a prestação de serviço informado na DPS uma Operação Tributável. <br>Não é permitido ao emitente da DPS informar que este cenário de prestação de serviço se trata de uma operação de Exportação de Serviço.

#### EXP-COM-03

- **Células de origem:** `E18`, `E32`, `E46`, `E60`, `E61`, `E74`, `E88`, `E102`, `E116`
- **Cenários associados:** 13, 27, 41, 55, 56, 69, 83, 97, 111
- **Autor(es) do comentário:** Adriano Guedes da Silva
- **Texto:** Serviços sem a incidência de ISSQN e ICMS

#### EXP-COM-04

- **Células de origem:** `E19`, `E33`, `E47`, `E75`, `E89`, `E103`, `E117`
- **Cenários associados:** 14, 28, 42, 70, 84, 98, 112
- **Autor(es) do comentário:** Adriano Guedes da Silva
- **Texto:** Serviços sem a incidência de ISSQN

#### EXP-COM-05

- **Células de origem:** `J31`, `J59`, `J97`, `J101`, `J111`, `J115`
- **Cenários associados:** 26, 54, 92, 96, 106, 110
- **Autor(es) do comentário:** Adriano Guedes da Silva
- **Texto:** Mensagem de erro:<br>O sistema considera este cenário para a prestação de serviço informado na DPS uma Exportação de Serviço. <br>Não é permitido ao emitente da DPS informar que que este cenário de prestação de serviço se trata de uma Operação Tributável.

#### EXP-COM-06

- **Células de origem:** `J39`, `J43`, `J71`, `J85`
- **Cenários associados:** 34, 38, 66, 80
- **Autor(es) do comentário:** Adriano Guedes da Silva
- **Texto:** Mensagem de erro:<br>O sistema considera este cenário para a prestação de serviço informada na DPS uma operação tributável. Não é permitido ao emitente da DPS informar que a prestação de serviço se trata de uma Exportação de serviço.

#### EXP-COM-07

- **Células de origem:** `J69`, `J83`
- **Cenários associados:** 64, 78
- **Autor(es) do comentário:** Adriano Guedes da Silva
- **Texto:** Mensagem de Aviso:<br>Para este cenário em que foi informado que o tomador do serviço está no exterior e o serviço prestado é devido no local do estabelecimento do tomador, o sujeito passivo será o prestador do serviço e o local de incidência do ISSQN será o local da prestação do serviço, conforme os parágrafos 1º e 2º do Art. 127 do CTN.

## 5. Regras de recepção da DPS

Esta seção reorganiza a aba `RN_RECEPCAO_DPS`. As células `B:C` estão mescladas no XLSX; aqui o texto é tratado como uma única coluna de regra.

### Validação do Certificado de Transmissão

#### Regra de recepção — linha 3 — E1200

- **Regra:** Certificado de Transmissor Inválido:<br>- Certificado de Transmissor inexistente na mensagem<br>- Versão difere "3"<br>- Se informado o Basic Constraint deve ser true (não pode ser Certificado de AC)<br>- KeyUsage não define "Autenticação Cliente"
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1200`
- **Mensagem de erro:** Certificado de Transmissão Inválido
- **Notas explicativas:** -

#### Regra de recepção — linha 4 — E1203

- **Regra:** Validade do Certificado (data início e data fim)
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1203`
- **Mensagem de erro:** Certificado de Transmissão expirado
- **Notas explicativas:** -

#### Regra de recepção — linha 5 — E1205

- **Regra:** Verifica a Cadeia de Certificação:<br>- Certificado da AC emissora não cadastrado na RFB<br>- Certificado de AC revogado<br>- Certificado não assinado pela AC emissora do Certificado
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1205`
- **Mensagem de erro:** Certificado de Transmissão - Erro Cadeira de Certificação
- **Notas explicativas:** -

#### Regra de recepção — linha 6 — E1206

- **Regra:** LCR do Certificado de Transmissor<br>- Falta o endereço da LCR (CRL DistributionPoint)<br>- LCR indisponível<br>- LCR inválida
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1206`
- **Mensagem de erro:** Certificado de Transmissão - Erro de acesso a LCR
- **Notas explicativas:** -

#### Regra de recepção — linha 7 — E1207

- **Regra:** Certificado do Transmissor revogado
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1207`
- **Mensagem de erro:** Certificado de Transmissão revogado
- **Notas explicativas:** -

#### Regra de recepção — linha 8 — E1208

- **Regra:** Certificado Raiz difere da "ICP-Brasil"
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1208`
- **Mensagem de erro:** Certificado de Transmissão difere da ICP - Brasil
- **Notas explicativas:** -

#### Regra de recepção — linha 9 — E1209

- **Regra:** Falta a extensão de CNPJ ou CPF no Certificado (OtherName - OID=2.16.76.1.3.3)
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1209`
- **Mensagem de erro:** Certificado de Transmissão sem CNPJ ou CPF.
- **Notas explicativas:** -

### Validação da Área de Dados

#### Regra de recepção — linha 11 — E1225

- **Regra:** Falha na descompactado da base 64.
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1225`
- **Mensagem de erro:** Falha na decodificação da base 64 da área de dados
- **Notas explicativas:** -

#### Regra de recepção — linha 12 — E1226

- **Regra:** Estrutura descompactada mal formada.
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1226`
- **Mensagem de erro:** Estrutura descompactada mal formada.
- **Notas explicativas:** -

### Validação dos Tipos de Documentos

#### Regra de recepção — linha 14 — E1242

- **Regra:** Validar os tipos de DF-e tratados pelo Sistema Nacional NFS-e.
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1242`
- **Mensagem de erro:** Tipo DF-e não tratado pelo Sistema Nacional NFS-e.
- **Notas explicativas:** -

#### Regra de recepção — linha 15 — E1228

- **Regra:** Uso de prefixo de namespace não permitido na área de dados descompactada.
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1228`
- **Mensagem de erro:** Uso de prefixo de namespace não permitido na área de dados descompactada.
- **Notas explicativas:** -

#### Regra de recepção — linha 16 — E1229

- **Regra:** XML não está utilizando codificação UTF8.
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1229`
- **Mensagem de erro:** XML não está utilizando codificação UTF8.
- **Notas explicativas:** -

#### Regra de recepção — linha 17 — E1235

- **Regra:** Falha no esquema XML do DF-e.
- **Aplicação:** Obrig.
- **Efeito:** Rej.
- **Código de erro:** `E1235`
- **Mensagem de erro:** Falha no esquema XML do DF-e.
- **Notas explicativas:** -

## 6. Leiaute XML e regras de negócio integradas

Nesta seção, cada registro da aba `LEIAUTE DPS_NFS-e` é apresentado junto das regras da aba `RN DPS_NFS-e` que se referem ao mesmo caminho/campo.

**Relação `exata`:** caminho e campo coincidem após remover apenas espaços externos.

**Relação `inferida`:** o XLSX contém uma discrepância textual entre as duas abas (por exemplo, segmento de caminho ausente, nome `totalTrib` vs. `totTrib`, ou `dEmiDoc` vs. `dtEmiDoc`). A regra é colocada junto ao campo mais provável, mas o localizador original da regra continua explicitamente registrado.

**Reconstrução das colunas D:E:** o cabeçalho `REGRAS DE NEGÓCIO` ocupa as colunas D e E. Em quase todas as linhas elas estão mescladas horizontalmente. Nas linhas 390–392 da planilha, porém, a coluna D contém um contexto compartilhado e a coluna E contém três condições distintas. Esta versão preserva essa estrutura explicitando o contexto compartilhado junto a cada condição.

### 6.1 Legenda das colunas de execução das regras

| Campo no Markdown | Coluna da planilha | Significado |
|---|---|---|
| `Público / normal` | K | execução em recepção de DPS / geração por emissores públicos nacionais |
| `Público / cStat=102` | L | execução para NFS-e sob decisão judicial ou administrativa nos emissores públicos |
| `ADN / normal` | M | execução na recepção de NFS-e compartilhada por municípios com o ADN |
| `ADN / cStat=102` | N | execução no ADN para NFS-e sob decisão judicial ou administrativa |

### Caminho de origem: `-`

#### L001 — Campo `NFS-e`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 2
- **Caminho no XML (origem):** `-`
- **Campo:** `NFS-e`
- **ELE:** `Raiz`
- **TIPO:** `-`
- **Ocorrência:** `-`
- **Tamanho:** `-`
- **Descrição:** -
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/`

#### L002 — Campo `versao`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 3
- **Caminho no XML (origem):** `NFSe/`
- **Campo:** `versao`
- **ELE:** `A`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-4V2`
- **Descrição:** Versão do leiaute da NFS-e.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `2` · E1260 · linha 5 · relação exata**
    - **Regra:** Prazo de aceitação da versão do leiaute NFS-e ultrapassado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1260`
    - **Mensagem:** O prazo de aceitação da versão do leiaute da NFS-e expirou.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L003 — Campo `infNFSe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 4
- **Caminho no XML (origem):** `NFSe/`
- **Campo:** `infNFSe`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações da NFS-e
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L416 — Campo `Signature`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 417
- **Caminho no XML (origem):** `NFSe/`
- **Campo:** `Signature`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Assinatura XML da NFS-e segundo o padrão XML digital signature
- **Notas explicativas:** -
- **Regras de negócio associadas:** 5

  - **RN `647` · E1630 · linha 650 · relação exata**
    - **Regra:** A assinatura da NFS-e deve ser válida.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1630`
    - **Mensagem:** Arquivo enviado com erro na assinatura.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `648` · E1632 · linha 651 · relação exata**
    - **Regra:** Certificado Digital da assintura inválido:<br><br>- Validade do Certificado (data início e data fim);<br>- Verifica a Cadeia de Certificação;<br>- Certificado do Transmissor revogado;<br>- LCR indisponível ou inválida.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1632`
    - **Mensagem:** Certificado Digital da assinatura inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `649` · E1634 · linha 652 · relação exata**
    - **Regra:** Certificado Digital da assinatura fora do padrão estabelecido pelo Sistema Nacional NFS-e:<br><br>- Versão diferente de 3;<br>- Se informado, Basic Constraint deve ser true (não pode ser Certificado de AC);<br>- KeyUsage não define 'Assinatura Digital' e 'Não Recusa';<br>- Falta a extensão de CNPJ (OtherName - OID=2.16.76.1.3.3) ou CPF (OtherName - OID=2.16.76.1.3.1);<br>- Certificado Raiz difere da 'ICP-Brasil'.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1634`
    - **Mensagem:** Certificado Digital fora do padrão estabelecido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `650` · E1636 · linha 653 · relação exata**
    - **Regra:** É obrigatória a existência da assinatura da NFS-e quando for enviado para API.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1636`
    - **Mensagem:** A assinatura é obrigatória quando for enviado paraa API.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `651` · E1638 · linha 654 · relação exata**
    - **Regra:** A assinatura deve ser feita com o certificado digital do município emissor da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1638`
    - **Mensagem:** A assinatura deve ser feita com o certificado digital do municiípio emissor da NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/`

#### L004 — Campo `id`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 5
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `id`
- **ELE:** `ID`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `53`
- **Descrição:** Informar o identificador precedido do literal ‘ID’.<br> <br>A formação do identificador de 53 posições da NFS-e é:<br><br>"NFS" + <br>Cód.Mun. (7) + <br>Amb.Ger. (1) + <br>Tipo de Inscrição Federal (1) + <br>Inscrição Federal (14 - CPF completar com 000 à esquerda) + <br>nNFSe (13) +<br>AnoMes Emis. (4) + <br>Cód.Num. (9) + <br>DV (1)<br><br>Código numérico de 9 Posições numérico, aleatório, gerado automaticamente pelo sistema gerador da NFS-e.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `4` · E1263 · linha 7 · relação exata**
    - **Regra:** O identificador da NFS-e é formado conforme a concatenação dos seguintes campos:<br>"NFS" + Cód.Mun. (7) + Amb.Ger. (1) + Tipo de Inscrição Federal (1) + Inscrição Federal (14 - CPF completar com 000 à esquerda) + nNFSe (13) + AnoMes Emis. (4) + Cód.Num. (9) + DV (1)<br><br>Verificar se tipo de inscrição e inscrição, informados no identificador da NFS-e, estão corretamente correspondidos conforme o seguinte:<br><br>Tipo de inscrição Federal = 1 / Inscrição Federal = CPF emitente da NFS-e;<br>Tipo de inscrição Federal = 2 / Inscrição Federal = CNPJ emitente da NFS-e;<br><br>Cód.Mun.Emi. é o código do município do endereço do emitente da NFS-e."
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1263`
    - **Mensagem:** Conteúdo informado no identificador da NFS-e difere da concatenação dos campos correspondentes que formam o identificador.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `5` · E1268 · linha 8 · relação exata**
    - **Regra:** Chave a acesso da NFS-e enviada já existe no ADN.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1268`
    - **Mensagem:** Chave de acesso informada para a NFS-e já foi compartilhada com o ADN.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L005 — Campo `xLocEmi`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 6
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `xLocEmi`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `150`
- **Descrição:** Descrição do código de 7 dígitos da localidade emissora da NFS-e.
- **Notas explicativas:** Descrição do nome do município emissor da NFS-e correspondente ao Código da Localidade de Emissão da DPS (cLocEmi).
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L006 — Campo `xLocPrestacao`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 7
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `xLocPrestacao`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `150`
- **Descrição:** Descrição do código de 7 dígitos referente ao local da prestação do serviço.
- **Notas explicativas:** Descrição do nome do município emissor da NFS-e correspondente ao Código do Local da Prestação de Serviço da DPS (cLocPrestacao).
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L007 — Campo `nNFSe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 8
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `nNFSe`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `13`
- **Descrição:** Número da NFS-e (Sequencial pelo emitente e tipo de emitente da NFS-e)
- **Notas explicativas:** Número sequencial por emitente da NFS-e.<br>A Sefin Nacional NFS-e irá gerar o número da NFS-e de forma sequencial por emitente. <br>Por se tratar de um ambiente altamente transacional, a Sefin Nacional NFS-e não irá reutilizar números inutilizados durante a geração da NFS-e.<br>Obrigatoriamente o campo deve conter 13 dígitos pois faz parte do identificador da NFS-e.<br>Valores possiveis de 0000000000000 até 9999999999999
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L008 — Campo `cLocIncid`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 9
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `cLocIncid`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `7`
- **Descrição:** Código de 7 dígitos da localidade de incidência do ISSQN.
- **Notas explicativas:** O Sistema Nacional NFS-e identifica a localidade de incidência do ISSQN conforme regras estabelecidas na LC 116/03.<br> <br> Existem exceções em que o Sistema Nacional NFS-e não identifica a localidade de incidência nem haverá destaque do ISSQN na emissão da NFS-e:<br> <br> 1) Em caso de imunidade não existe localidade de incidência para o ISSQN;<br> <br> 2) Em caso de exportação de serviço não existe localidade de incidência para o ISSQN;<br> <br> 3) Em caso de serviços sem a incidência de ISSQN (cTribNac igual a 990101), não existe localidade de incidência para o ISSQN;<br> <br> 4) Em caso de operação tributável deve existir localidade de incidência para o ISSQN.<br><br>OBS 1: Para serviços prestados para o subitem 03.04, o município de incidência será o município do local de prestação de serviço informado na DPS, conforme TAB.MUN_IBGE. <br> <br>OBS 2: As operações de exploração de vias (ou rodovias) no campo de incidência do ISSQN (subitem 22.01 da lista de serviço do Sistema Nacional NFS-e) serão formalizadas pela "NFS-e Via", Nota Fiscal de Serviço eletrônica de Exploração de Via, que terá um layout específico a ser publicado em breve.
- **Regras de negócio associadas:** 7

  - **RN `9` · E1301 · linha 12 · relação exata**
    - **Regra:** Não é permitido informar o código do local de incidência quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1301`
    - **Mensagem:** Não é permitido informar o código do local de incidência quando o campo referente à tributação do ISSQN indicar imunidade, exportação ou não incidência.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `10` · E1305 · linha 13 · relação exata**
    - **Regra:** É obrigatório informar o código do local de incidência quando o serviço prestado for uma operação tributável, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "1 - Operação Tributável", (tribISSQN = 1).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1305`
    - **Mensagem:** É obrigatório informar  o código do local de incidência quando o campo referente à tributação do ISSQN indicar Operação Tributável.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `11` · E1309 · linha 14 · relação exata**
    - **Regra:** Se o código da localidade de incidência for informado na NFS-e, então ele deve existir nas tabelas<br>de municípios do IBGE ou tabela de concessões de rodovia ou  tabela de localidade geral do arquivo <br>ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1309`
    - **Mensagem:** O código do local de incidência do ISSQN não existe conforme a tabela de municípios IBGE ou tabela de concessões de rodovia ou tabela de localidade geral no ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `12` · E1313 · linha 15 · relação exata**
    - **Regra:** Se o código de tributação nacional (cTribNac) corresponder a um subitem diferente de 200101 e <br>o local da prestação do serviço (cLocPrestacao) "Águas Marítmas" (código 0000000), <br>então o local de incidência (cLocIncid) deve ser igual ao código do município do endereço do prestador do serviço <br>(NFSe/infNFSe/DPS/infDPS/prest/end/endNac/cMun).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1313`
    - **Mensagem:** A localidade de incidência para o ISSQN deve corresponder ao município do estabelecimento/domicílio do prestador do serviço, quando não for informado o código de tributação nacional (cTribNac) 200101, da lista nacional de serviços do Sistema Nacional NFS-e, e a localidade de prestação do serviço corresponder a "Águas Marítimas" (0000000).
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `13` · E1317 · linha 16 · relação exata**
    - **Regra:** Se o código de tributação nacional informado corresponder a um dos seguintes códigos: <br>030401, 030402, 030403, 030501, 070201, 070202, 070401, 070501, 070502, 070901, 070902, 071001, 071002, 071101, 071102, 071201, 071601, 071701, 071801, 071901, 110101, 110102, 110201, 110301, 110401, 110402, 120101, 120201, 120301, 120401, 120501, 120601, 120701, 120801, 120901, 120902, 120903, 121001, 121101, 121201, 121401, 121501, 121601, 121701, 160101, 160102, 160103, 160104, 160201, 171001, 171002, 220101,<br>então o codigo da localidade de  incidência do ISSQN deve ser igual ao código do local de prestação do serviço informado na NFS-e pelo município.<br><br>Exceto para os casos de Imunidade, Exportação de Serviço e Não Incidência (tribISSQN = 2, 3 ou 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1317`
    - **Mensagem:** O local de incidência do ISSQN deve ser igual ao município da prestação do serviço (NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao)<br> do serviço informado na NFS-e compartilhada pelo município, quando informado qualquer código de tributação nacional cuja regra de incidência indique o local da prestação, conforme a tabela MUN.INCID_INFO.SERV. do ANEXO_I-SEFIN_ADN-DPS_NFSe-SNNFSe.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `14` · E1321 · linha 17 · relação exata**
    - **Regra:** Se o código de tributação nacional informado corresponder a um dos seguintes códigos: <br>170501, <br>então o codigo do local de incidência do ISSQN deve ser igual ao código do município do endereço do tomador <br>(NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun) <br> do serviço informado na NFS-e compartilhada pelo município.<br><br>Exceto para os casos de Imunidade, Exportação de Serviço e Não Incidência (tribISSQN = 2, 3 ou 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1321`
    - **Mensagem:** O local de incidência do ISSQN deve ser igual ao município do endereço do tomador do serviço informado na NFS-e compartilhada pelo município (NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun).
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `15` · E1325 · linha 18 · relação exata**
    - **Regra:** Excetuados os códigos de tributação nacional:<br>030401, 030402, 030403, 030501, 070201, 070202, 070401, 070501, 070502, 070901, 070902, 071001, 071002, 071101, 071102, 071201, 071601, 071701, 071801, 071901, 110101, 110102, 110201, 110301, 110401, 110402, 120101, 120201, 120301, 120401, 120501, 120601, 120701, 120801, 120901, 120902, 120903, 121001, 121101, 121201, 121401, 121501, 121601, 121701, 160101, 160102, 160103, 160104, 160201, 171001, 171002, 170501, 220101 e 990101,<br>para os demais códigos de tributação, de acordo com a tabela MUN.INCID_INFO.SERV. do ANEXO_I-SEFIN_ADN-DPS_NFSe-SNNFSe, <br>o codigo da localidade de incidência do ISSQN deve ser igual ao<br>código do município do endereço do emitente da NFS-e (NFSe/infNFSe/emit/endNac/cMun), <br>quanto o emitente for o prestador do serviço (tpEmit = 1),<br> ou código do município do endereço do prestador do serviço da DPS (NFSe/infNFSe/DPS/infDPS/prest/end/endNac/cMun),<br>quando o emitente da NFS-e for o tomador ou intermediário (tpEmit = 2 ou 3).<br><br><br>Exceto para os casos de Imunidade, Exportação de Serviço e Não Incidência (tribISSQN = 2, 3 ou 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1325`
    - **Mensagem:** O local de incidência do ISSQN deve ser igual ao município do endereço do prestador (NFSe/infNFSe/DPS/infDPS/prest/end/endNac/cMun)<br>do serviço informado na NFS-e compartilhada pelo município, quando informado qualquer código de tributação nacional cuja regra de incidência indique o município do estabelecimento do prestador, conforme a tabela MUN.INCID_INFO.SERV. do ANEXO_I-SEFIN_ADN-DPS_NFSe-SNNFSe.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L009 — Campo `xLocIncid`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 10
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `xLocIncid`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `150`
- **Descrição:** Descrição da localidade de incidência do ISSQN.
- **Notas explicativas:** Descrição do nome da localidade de incidência do ISSQN na NFS-e correspondente ao código da Localidade de incidência do ISSQN (cLocIncid).
- **Regras de negócio associadas:** 2

  - **RN `16` · E1327 · linha 19 · relação exata**
    - **Regra:** É obrigatório informar a descrição do local de incidência quando o código do local de incidência (cLocIncid) for informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1327`
    - **Mensagem:** É obrigatório informar a descrição do local de incidência quando o código do local de incidência (cLocIncid) for informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `17` · E1329 · linha 20 · relação exata**
    - **Regra:** Não é permitido informar a descrição do local de incidência quando o código do local de incidência (cLocIncid) não for informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1329`
    - **Mensagem:** Não é permitido informar a descrição do local de incidência quando o código do local de incidência (cLocIncid) não for informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L010 — Campo `xTribNac`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 11
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `xTribNac`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `600`
- **Descrição:** Descrição do código de tributação nacional do ISSQN.
- **Notas explicativas:** A descrição do código de tributação nacional utilizada pelo Sistema Nacional NFS-e, para "traduzir" o código de serviço nacional, enviado pelo emitente na DPS, é a descrição dos subitens da lista de serviços do "Anexo III - Lista Nacional de Serviços", que consta ao final do Manual de Orientação ao Contribuinte do ISSQN para a Sefin Nacional NFS-e.<br>A lista nacional utilizada é uma derivação direta da lista de serviços anexa à LC 116/03. A diferença entre as duas listas é que a lista nacional possui alguns subitens "desdobrados" nos mesmos grupamentos de itens. <br>Os desdobros foram necessários para que alguns subitens do anexo à LC 116/03 fossem divididos em dois ou mais subitens, preservando a mesma lógica da lista original. A separação dos termos que compõem um subitem do anexo da lei para cada novo subitem na nova lista nacional não muda em essência a legislação vigente e permite atender tanto à legislação específica de pequenos, médios e grandes municípios que aderirem ao Sistema Nacional NFS-e.
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L011 — Campo `xTribMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 12
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `xTribMun`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `600`
- **Descrição:** Descrição do código de tributação municipal do ISSQN.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L012 — Campo `xNBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 13
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `xNBS`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `600`
- **Descrição:** Descrição do código da NBS.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L013 — Campo `verAplic`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 14
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `verAplic`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-20`
- **Descrição:** Versão da aplicação que gerou a NFS-e.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L014 — Campo `ambGer`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 15
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `ambGer`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Ambiente gerador da NFS-e:<br><br>1- Sistema Próprio do Município;<br>2- Sefin Nacional NFS-e;
- **Notas explicativas:** NFS-e compartilhada pelo município para o ADN NFS-e sempre tem ambGer = 1.<br><br>NFS-e emitidas pelo Sistema Nacional NFS-e sempre tem ambGer = 2.
- **Regras de negócio associadas:** 1

  - **RN `22` · E1274 · linha 25 · relação exata**
    - **Regra:** Verificar se o ambiente gerador da NFS-e está de acordo com a definição:<br>1- Sistema Próprio do Município, para as NFS-e compartilhadas pelo município para o ADN, ou<br>2 - Sefin Nacional NFS-e, para as NFS-e emitidas pela Sefin ou recepcionadas via API "Bypass".
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1274`
    - **Mensagem:** O ambiente gerador da NFS-e não está de acordo com a definição 1 (Sistema Próprio do Município) ou 2 (Sefin Nacional).
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L015 — Campo `tpEmis`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 16
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `tpEmis`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Tipo de emissão da NFS-e:<br><br>1 - Emissão direta no modelo da NFS-e Nacional;<br>2 - Emissão original em leiaute próprio do município com transcrição para o modelo da NFS-e Nacional.
- **Notas explicativas:** O sistema municipal pode emitir a NFS-e seguindo o XML do modelo da NFS-e Nacional ou pode manter seu próprio modelo, diferente do modelo padrão nacional.<br><br>Caso mantenha seu próprio modelo, o município deverá transcrever as informações das suas NFS-e para o modelo da NFS-e nacional e assinar o documento para depois compartilhar as NFS-e transcritas para o ADN NFS-e. Neste caso, tpEmis = 2.<br>Caso o município emita suas NFS-e já no modelo da NFS-e padrão nacional o tpEmis = 1.<br><br>Notas emitidas pela Sistema Nacional NFS-e sempre tem tpEmis = 1.
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L016 — Campo `procEmi`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 17
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `procEmi`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1`
- **Descrição:** Processo de Emissão da DPS:<br><br>1 - Emissão com aplicativo do contribuinte (via API);<br>2 - Emissão com aplicativo disponibilizado pelo fisco (Web);<br>3 - Emissão com aplicativo disponibilizado pelo fisco (App);
- **Notas explicativas:** Esta informação deve ser preenchida somente em NFS-e emitidas pelo Sistema Nacional NFS-e.<br><br>Municipios com emissores próprios não podem informar este campo na transcrição de suas NFS-e para o compartilhamento com o ADN.
- **Regras de negócio associadas:** 1

  - **RN `24` · E1276 · linha 27 · relação exata**
    - **Regra:** Os emissores públicos nacionais devem gerar a NFS-e informando qual o processo de emissão:<br><br>1 - Emissão com aplicativo do contribuinte (via Web Service);<br>2 - Emissão com aplicativo disponibilizado pelo fisco (Web);<br>3 - Emissão com aplicativo disponibilizado pelo fisco (App);<br><br>Verificar se a NFS-e compartilhada pelo município preencheu alguma informação para o processo de emissão. <br>Este campo não deve ser informado em NFS-e compartilhada com o ADN NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1276`
    - **Mensagem:** A informação do processo de emissão de NFS-e é exclusiva para notas emitidas pela Sefin Nacional NFS-e. O município não deve informar este campo nas NFS-e compartilhadas com o ADN NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L017 — Campo `cStat`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 18
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `cStat`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `3`
- **Descrição:** Código de Situações da NFS-e:<br><br>100 - NFS-e Gerada;<br>102 - NFS-e de Decisão Judicial ou Administrativa;<br>103 - NFS-e Avulsa;<br>107 - NFS-e MEI;
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L018 — Campo `dhProc`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 19
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `dhProc`
- **ELE:** `E`
- **TIPO:** `D`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Data/Hora do processamento (geração) NFS-e.<br>Data e hora no formato UTC (Universal Coordinated Time):<br>AAAA-MM-DDThh:mm:ssTZD
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `26` · E1278 · linha 29 · relação exata**
    - **Regra:** A data e hora do processamento (geração) da NFS-e deve ser anterior ou igual à data e hora da sua recepção pelo Sistema Nacional NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1278`
    - **Mensagem:** A data e hora do processamento (geração) da NFS-e deve ser anterior ou igual à data da recepção pelo Sistema Nacional NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L019 — Campo `nDFSe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 20
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `nDFSe`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-13`
- **Descrição:** Número sequencial do documento gerado por ambiente gerador de DFe do múnicípio.
- **Notas explicativas:** Valores possiveis 0 até 9999999999999
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L020 — Campo `emit`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 21
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `emit`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações da DPS relativas ao emitente da NFS-e
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L036 — Campo `valores`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 37
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `valores`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de valores referentes ao serviço prestado
- **Notas explicativas:** -
- **Regras de negócio associadas:** 4

  - **RN `46` · E1302 · linha 49 · relação exata**
    - **Regra:** Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando o prestador é optante do simples nacional do tipo MEI (opSimpNac = 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1302`
    - **Mensagem:** Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores para prestador de serviço optante do simples nacional do tipo MEI.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** —
  - **RN `47` · E1303 · linha 50 · relação exata**
    - **Regra:** Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1303`
    - **Mensagem:** Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando o campo referente à tributação do ISSQN indicar imunidade, exportação ou não incidência.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** —
  - **RN `48` · E1307 · linha 51 · relação exata**
    - **Regra:** Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando o prestador de serviço tiver um regime especial de tributação, ou seja, o campo que indica o regime especial de tributação é diferente de 0, (regEspTrib = 1, 2, 3, 4, 5, 6 ou 9).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1307`
    - **Mensagem:** Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando o prestador de serviço possui algum regime especial de tributação.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** —
  - **RN `49` · E1311 · linha 52 · relação exata**
    - **Regra:** Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando estiver indicado na DPS que a tributação do ISSQN está com sua exigibilidade suspensa, seja administrativamente ou judicialmente, ou seja, o campo que indica a suspensão da exigibilidade está informado na DPS (tpSUSP = 1 ou 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1311`
    - **Mensagem:** Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando a exigibilidade da tributação do ISSQN estiver suspensa por decisão judicial ou administrativa.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** —


#### L045 — Campo `xOutInf`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 46
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `xOutInf`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `2000`
- **Descrição:** Uso da Administração Tributária Municipal.
- **Notas explicativas:** O Sistema Nacional NFS-e deverá incluir estas mensagens quando:<br><br>1) ocorrer os cenários 28 e 34, conforme a planilha "COMEX - EXPORTAÇÃO DE SERVIÇO" do AnexoI-LeiautesRN_DPS_NFSe-SNNFSe.<br><br>"Por não se tratar de um caso de Exportação de serviço ou Imunidade tributária, então, para este cenário em que foi informado que o tomador do serviço está no exterior e o serviço prestado é devido no local do estabelecimento do tomador, o sujeito passivo será o prestador do serviço e o local de incidência do ISSQN será o local da prestação do serviço, conforme os parágrafos 1º e 2º do Art. 127 do CTN."
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L046 — Campo `IBSCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 47
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `IBSCBS`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações geradas pelo sistema referentes ao IBS e à CBS
- **Notas explicativas:** Para optantes dos Simples Nacional, os grupos IBSCBS só serão obrigatórios a partir de 2027.
- **Regras de negócio associadas:** 2

  - **RN `60` · E1515 · linha 63 · relação exata**
    - **Regra:** Se o grupo de informações de IBS/CBS da DPS (NFSe/infNFSe/DPS/infDPS/IBSCBS/) for informado, <br>então o grupo de informações de IBS/CBS da NFS-e deve ser informado obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1515`
    - **Mensagem:** É obrigatório informar o grupo de informações de IBS/CBS da NFS-e quando o grupo de informações de IBS/CBS da DPS for informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `61` · E1517 · linha 64 · relação exata**
    - **Regra:** Se o grupo de informações de IBS/CBS da DPS (NFSe/infNFSe/DPS/infDPS/IBSCBS/) não for informado, <br>então não é permitido informar o grupo de informações de IBS/CBS da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1517`
    - **Mensagem:** Não é permitido informar o grupo de informações de IBS/CBS da NFS-e quando o grupo de informações de IBS/CBS da DPS não for informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L098 — Campo `DPS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 99
- **Caminho no XML (origem):** `NFSe/infNFSe/`
- **Campo:** `DPS`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações da DPS relativas ao serviço prestado
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/emit/`

#### L021 — Campo `CNPJ`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 22
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/`
- **Campo:** `CNPJ`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `14`
- **Descrição:** Número da inscrição federal (CNPJ) do emitente da NFS-e.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `29` · E1280 · linha 32 · relação exata**
    - **Regra:** Verificar se o CNPJ informado para o emitente da NFS-e é válido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1280`
    - **Mensagem:** CNPJ informado para o emitente da NFS-e é inválido (verificar DV).
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `30` · E1282 · linha 33 · relação exata**
    - **Regra:** Verificar se o CNPJ do emitente corresponde ao CNPJ informado para prestador ou tomador ou intermediário, conforme o valor do campo tpEmit informado na DPS.<br>tpemit = 1 - Prestador, tpemit = 2 - Tomador, tpemit = 3 - Intermediário,
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1282`
    - **Mensagem:** O CNPJ do emitente não corresponde ao CNPJ do informado conforme o tipo de emitente informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** —


#### L022 — Campo `CPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 23
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/`
- **Campo:** `CPF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `11`
- **Descrição:** Número da inscrição federal (CPF) do emitente da NFS-e.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `31` · E1284 · linha 34 · relação exata**
    - **Regra:** Verificar se o CPF informado para o emitente da NFS-e é válido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1284`
    - **Mensagem:** CPF informado para o emitente da NFS-e é inválido (verificar DV).
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `32` · E1285 · linha 35 · relação exata**
    - **Regra:** Verificar se o CPF do emitente corresponde ao CPF informado para prestador ou tomador ou intermediário, conforme o valor do campo tpEmit informado na DPS.<br>tpemit = 1 - Prestador, tpemit = 2 - Tomador, tpemit = 3 - Intermediário,
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1285`
    - **Mensagem:** O CPF do emitente não corresponde ao CPF do informado conforme o tipo de emitente informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** —


#### L023 — Campo `IM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 24
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/`
- **Campo:** `IM`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `15`
- **Descrição:** Número do indicador municipal do emitente da NFS-e.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L024 — Campo `xNome`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 25
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/`
- **Campo:** `xNome`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `150`
- **Descrição:** Nome / Razão Social do emitente.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L025 — Campo `xFant`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 26
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/`
- **Campo:** `xFant`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `150`
- **Descrição:** Nome / Fantasia do emitente.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L026 — Campo `enderNac`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 27
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/`
- **Campo:** `enderNac`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço nacional do Emitente da NFS-e
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L034 — Campo `fone`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 35
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/`
- **Campo:** `fone`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `9-20`
- **Descrição:** Número do telefone do emitente.<br>(Preencher com o Código DDD + número do telefone. <br>Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L035 — Campo `email`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 36
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/`
- **Campo:** `email`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `80`
- **Descrição:** E-mail do emitente.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/emit/enderNac/`

#### L027 — Campo `xLgr`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 28
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/enderNac/`
- **Campo:** `xLgr`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Tipo e nome do logradouro da localização do endereço do emitente.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L028 — Campo `nro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 29
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/enderNac/`
- **Campo:** `nro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Número do imóvel do endereço do emitente.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L029 — Campo `xCpl`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 30
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/enderNac/`
- **Campo:** `xCpl`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-156`
- **Descrição:** Complemento do endereço do emitente.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L030 — Campo `xBairro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 31
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/enderNac/`
- **Campo:** `xBairro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Bairro do endereço do emitente.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L031 — Campo `cMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 32
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/enderNac/`
- **Campo:** `cMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código do município do endereço do emitente.<br>(Tabela do IBGE)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `41` · E1286 · linha 44 · relação exata**
    - **Regra:** Verificar se o código do município do emitente da NFS-e corresponde ao código do município emissor (cLocEmi) informado na NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1286`
    - **Mensagem:** O código do município do emitente da NFS-e difere do código do municipio emissor informado na NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L032 — Campo `UF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 33
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/enderNac/`
- **Campo:** `UF`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Sigla da unidade da federação do município do endereço do emitente.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L033 — Campo `CEP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 34
- **Caminho no XML (origem):** `NFSe/infNFSe/emit/enderNac/`
- **Campo:** `CEP`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Número do CEP do endereço do emitente.<br>(Informar os zeros não significativos)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/valores/`

#### L037 — Campo `vCalcDR`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 38
- **Caminho no XML (origem):** `NFSe/infNFSe/valores/`
- **Campo:** `vCalcDR`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário (R$) de dedução/redução da base de cálculo (BC) do ISSQN.
- **Notas explicativas:** vCalcDR é:<br><br>o valor monetário calculado a partir do percentual de dedução/redução da BC do ISSQN, informado pelo emitente no campo pDR da DPS. Este percentual é calculado sobre valor do serviço informado na DPS e o resultado calculado é o valor deste campo do leiaute NFS-e;<br>ou<br>a soma dos valores de dedução/redução da BC do ISSQN, quando um ou mais documentos são informados nos campos vDeducaoReducao pelo emitente na DPS. Neste caso, o resultado do somatório é o valor deste campo do leiaute NFS-e;
- **Regras de negócio associadas:** 1

  - **RN `50` · E1287 · linha 53 · relação exata**
    - **Regra:** vCalcDR é o valor monetário calculado a partir do percentual de dedução/redução da BC do ISSQN, informado pelo emitente no campo pDR da DPS. Este percentual é calculado sobre valor do serviço informado na DPS e o resultado calculado é o valor deste campo do leiaute NFS-e<br>ou<br>a soma dos valores de dedução/redução da BC do ISSQN, quando um ou mais documentos são informados nos campos vDeducaoReducao pelo emitente na DPS. Neste caso, o resultado do somatório é o valor deste campo do leiaute NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1287`
    - **Mensagem:** O valor calculado de dedução/redução não corresponde aos valores de (valor do serviço x percentual de dedução/redução), quando pDR é informado na DPS ou ao somatório dos valores do campo vDeducaoReducao, quando um ou mais documentos são informados para dedução/redução da base de cálculo do ISSQN.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L038 — Campo `tpBM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 39
- **Caminho no XML (origem):** `NFSe/infNFSe/valores/`
- **Campo:** `tpBM`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `40`
- **Descrição:** Tipo Benefício Municipal (BM):<br><br>1 ) "Isenção";<br>2) "Redução da BC em 'ppBM' %";<br>3) "Redução da BC em R$ 'vInfoBM' ";<br>4) "Alíquota Diferenciada de 'aliqDifBM' %";
- **Notas explicativas:** Onde, nos itens abaixo:<br><br> 3) ppBM é o percentual parametrizado pelo município de incidência para redução da base de cálculo do benefício municipal concedido;<br><br>4) vInfoBM é o valor informado na DPS da redução da base de cálculo do benefício municipal concedido;<br><br>5) aliqDifBM é o percentual parametrizado pelo município de incidência para alíquota diferenciada do benefício municipal concedido;
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L039 — Campo `vCalcBM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 40
- **Caminho no XML (origem):** `NFSe/infNFSe/valores/`
- **Campo:** `vCalcBM`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário (R$) do percentual de redução da base de cálculo (BC) do ISSQN devido a um benefício municipal (BM).
- **Notas explicativas:** Este valor é:<br><br>o cálculo do valor de redução da BC do ISSQN, quando um percentual é parametrizado pelo município de incidência na lei de BM, que foi informada pelo emitente na DPS. Neste caso o percentual parametrizado é aplicado sobre o valor do serviço informado na DPS e o resultado calculado é o valor deste campo do leiaute NFS-e;
- **Regras de negócio associadas:** 1

  - **RN `52` · E1288 · linha 55 · relação exata**
    - **Regra:** vCalcBM é o valor mmonetário calculado a partir do percentual  de BM, que foi informada no campo pRedBCBM da DPS. Neste caso o percentual é aplicado sobre o valor do serviço informado na DPS e o resultado calculado é o valor deste campo do leiaute NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1288`
    - **Mensagem:** O valor calculado do percentual de reduçãõ da base de cálculo por Benefício Municipal não corresponde aos valores de (valor do serviço x percentual de benefício municipal), quando pRedBCBM é informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L040 — Campo `vBC`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 41
- **Caminho no XML (origem):** `NFSe/infNFSe/valores/`
- **Campo:** `vBC`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor da Base de Cálculo do ISSQN (R$) = Valor do Serviço - Desconto Incondicionado - Deduções/Reduções - Benefício Municipal<br> <br> vBC = vServ - descIncond - (vDR ou vCalcDR + vCalcReeRepRes) - (vRedBCBM ou VCalcBM)
- **Notas explicativas:** A Base de Cálculo do ISSQN é igual a valor do serviço menos a soma dos seguintes valores: desconto incondicionado, total de deduções/reduções e benefício municipal.<br> <br> Sendo que:<br> 1 - Quando o valor de dedução/redução for apurado a partir de um percentual informado na DPS, calcular este percentual sobre o valor do serviço já abatido o valor do desconto incondicionado.<br> <br> 2 - Quando o valor do benefício municipal for apurado a partir de um percentual parametrizado para redução da base de cálculo, aplicar o percentual parametrizado sobre o valor do serviço já abatidos os valores do desconto incondicionado e dedução/redução.<br><br>OBS: As operações de exploração de vias (ou rodovias) no campo de incidência do ISSQN (subitem 22.01 da lista de serviço do Sistema Nacional NFS-e) serão formalizadas pela "NFS-e Via", Nota Fiscal de Serviço eletrônica de Exploração de Via, que terá um layout específico a ser publicado em breve.
- **Regras de negócio associadas:** 2

  - **RN `53` · E1295 · linha 56 · relação exata**
    - **Regra:** O valor da base de cálculo do ISSQN (vBC) é calculado a partir de valores informados na NFS-e:<br><br>Valor da BC = Valor do serviço - Desconto incondicionado - Valores monetário de Dedução Redução - Valor monetário de Benerfício Municipal - Valor monetário total relativo ao fornecimento próprio de bens materiais ou relacionados a operações de terceiros, objeto de reembolso, repasse ou ressarcimento pelo recebedor<br><br>vBC = vServ - vDescIncond - (vDR ou vDeducaoReducao ou vCalcDR) - (vRedBCBM ou vCalcBM) - vCalcReeRepRes
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1295`
    - **Mensagem:** O valor da base cálculo deve ser igual ao valor do serviço menos desconto incondicionado e, valores monetários de dedução/redução e benefício municipal e valores relativos ao fornecimento próprio de bens materiais ou relacionados a operações de terceiros, objeto de reembolso, repasse ou ressarcimento pelo recebedor, informados na NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `54` · E1297 · linha 57 · relação exata**
    - **Regra:** O valor BC calculado não pode estar reduzida de forma que resulte para valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos serviços:<br>042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1297`
    - **Mensagem:** O valor BC calculado não pode estar reduzida de forma que resulte para valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos subitens 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301, da lista de serviços nacional do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** O valor do desconto incondicionado, se informado na DPS, não é considerado para a redução do valor da BC de forma que resulte para valor do ISSQN a uma alíquota efetiva menor que 2%.


#### L041 — Campo `pAliqAplic`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 42
- **Caminho no XML (origem):** `NFSe/infNFSe/valores/`
- **Campo:** `pAliqAplic`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota aplicada sobre a base de cálculo para apuração do ISSQN.
- **Notas explicativas:** A - O valor percentual da aliquota aplicada (%) poderá ser:<br> <br> 1) o percentual de alíquota informado pelo emitente, referente ao código de serviço, que foi informado na DPS do município de incidência do ISSQN, que identificado pelo sistema, mas que não é conveniado ao Sistema Nacional NFS-e;<br> <br> 2) o percentual de alíquota previamente parametrizado pelo município de incidência no código de serviço, que foi indicado pelo emitente na DPS, quando o município de incidência do ISSQN identificado pelo sistema é conveniado ao Sistema Nacional NFS-e;<br> <br> 3) o percentual de alíquota diferenciada, previamente parametrizada pelo município de incidência do ISSQN, no benefício municipal que foi indicado pelo emitente na DPS (quando este benefício municipal referir-se a uma alíquota diferenciada e forem satisfeitas as condições de aplicabilidade deste benefício municipal às informações prestadas pelo emitente na DPS;<br> <br> *A ordem de prioridade para a utilização da aliquota aplicada é decrescente conforme itens acima. <br> Um alíquota parametrizada sobrepõem uma alíquota informada na DPS e uma alíquota diferenciada, proveniente de um benefício municipal indicado na DPS, satisfeitas as condições de aplicabilidade deste benefício municipal às informações prestadas pelo emitente na DPS, sobrepõem uma alíquota parametrizada pelo município no código de tributação nacional ou municipal (se for o caso).<br> <br> *Considerar data de competência informada na DPS para recuperar a alíquota em qualquer um dos casos.<br> <br> B - Se o emitente informar na DPS para o campo Regime Especial de Tributação, "Profissional Autônomo" ou "Sociedade de Profissionais", e para o campo Exigibilidade, "Exigível", não há destaque de ISSQN na NFS-e. Os campos pAliqAplic, vISSQN da NFS-e não contém valor.<br><br> OBS: As operações de exploração de vias (ou rodovias) no campo de incidência do ISSQN (subitem 22.01 da lista de serviço do Sistema Nacional NFS-e) serão formalizadas pela "NFS-e Via", Nota Fiscal de Serviço eletrônica de Exploração de Via, que terá um layout específico a ser publicado em breve.
- **Regras de negócio associadas:** 1

  - **RN `55` · E1300 · linha 58 · relação exata**
    - **Regra:** Não é permitido informar alíquota aplicada superior a 5%.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1300`
    - **Mensagem:** Não é permitido informar alíquota aplicada superior a 5%.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L042 — Campo `vISSQN`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 43
- **Caminho no XML (origem):** `NFSe/infNFSe/valores/`
- **Campo:** `vISSQN`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor do ISSQN (R$) = Valor da Base de Cálculo x Alíquota<br><br>vISSQN = vBC x pAliqAplic
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `56` · E1289 · linha 59 · relação exata**
    - **Regra:** O valor do ISSQN informado na NFS-e (vISSQN) deve ser igual ao produto da base de cálculo pela alíquota aplicada (vBC x pAliqAPlic).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1289`
    - **Mensagem:** O produto do valor da base de cálculo pela alíquota aplicada, ambos informados na NFS-e compartilhada, não está de acordo com o resultado cálculado pelo sistema (vBC x pAliAplic).
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L043 — Campo `vTotalRet`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 44
- **Caminho no XML (origem):** `NFSe/infNFSe/valores/`
- **Campo:** `vTotalRet`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor total das retenções de tributos da NFS-e.<br><br>Valor total de retenções (R$) = Σ(vRetCP + vRetIRRF + vRetCSLL + ISSQN*)
- **Notas explicativas:** *ISSQN pode não sofrer retenção. Para o resultado do valor total de retenções o ISSQN somente será somado quando for retido.
- **Regras de negócio associadas:** 1

  - **RN `57` · E1506 · linha 60 · relação exata**
    - **Regra:** O valor total da retenção da NFS-e não pode ser inferior a zero.<br><br>O valor total da retenção da NFS-e é calculado a partir de valores que constam na DPS através do seguinte cálculo:<br><br>Valor total de retenções (R$) = Σ(vRetCP + vRetIRRF+ vRetCSLL + ISSQN*)<br><br>vTotalRet = vRetCP + vRetIRRF + vRetCSLL + vISSQN*
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1506`
    - **Mensagem:** O valor total de tributos retidos da NFS-e não pode ser inferior a zero.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L044 — Campo `vLiq`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 45
- **Caminho no XML (origem):** `NFSe/infNFSe/valores/`
- **Campo:** `vLiq`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor líquido da NFS-e.<br><br>Valor líquido (R$) = Valor do serviço - Desconto condicionado - Desconto incondicionado - Valores retidos
- **Notas explicativas:** *Para o resultado do Valor Líquido o CP, IRRF e CSLL serão sempre subtraídos, se constarem na DPS, pois sempre são retidos.<br><br>**Para o resultado do Valor Líquido o ISSQN, PIS e COFINS somente serão subtraídos quando forem retidos.
- **Regras de negócio associadas:** 1

  - **RN `58` · E1508 · linha 61 · relação exata**
    - **Regra:** O valor líquido da NFS-e não pode ser inferior a zero.<br><br>O valor líquido da NFS-e é calculado a partir de valores que constam na DPS através do seguinte cálculo:<br><br>Valor líquido (R$) = Valor do serviço - Desconto condicionado - Desconto incondicionado - Valores retidos <br> <br> VLiq = vServ – vDescIncond – vDescCond – vTotalRet
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1508`
    - **Mensagem:** O valor líquido da NFS-e não pode ser inferior a zero.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/IBSCBS/`

#### L047 — Campo `cLocalidadeIncid`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 48
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/`
- **Campo:** `cLocalidadeIncid`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código IBGE da localidade de incidência do IBS/CBS (local da operação).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `61` · E1521 · linha 65 · relação exata**
    - **Regra:** O código da localidade de incidência informado deve estar de acordo com o código de indicador da operação. A tabela de indicadores das operações deve ser observada. (Anexo B). Para os casos de endereço no exterior, deve ser igual a "999999"
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1521`
    - **Mensagem:** Código da localidade de incidência diverge do que deveria ser informado de acordo com a tabela de indicador da operação.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L048 — Campo `xLocalidadeIncid`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 49
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/`
- **Campo:** `xLocalidadeIncid`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `600`
- **Descrição:** Nome da localidade de incidência do IBS/CBS.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L049 — Campo `pRedutor`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 50
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/`
- **Campo:** `pRedutor`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Percentual de redução de aliquota em compra governamental.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `63` · E1522 · linha 67 · relação exata**
    - **Regra:** O percentual redutor para compras governamentais só deve ser informando se tpEnteGov foi informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1522`
    - **Mensagem:** O percentual redutor para compras governamentais (IBS/CBS) não deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `65` · E1523 · linha 68 · relação exata**
    - **Regra:** O percentual redutor para compras governamentais deve ser informado se tpEnteGov foi informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1523`
    - **Mensagem:** O percentual redutor para compras governamentais (IBS/CBS) deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L050 — Campo `valores`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 51
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/`
- **Campo:** `valores`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de valores brutos referentes ao IBS / CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L065 — Campo `totCIBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 66
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/`
- **Campo:** `totCIBS`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de Totalizadores
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/IBSCBS/valores/`

#### L051 — Campo `vBC`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 52
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/`
- **Campo:** `vBC`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor da base de cálculo (BC) do IBS/CBS antes das reduções para cálculo do tributo bruto. <br><br>vBC = vServ - descIncond – vCalcReeRepRes – vISSQN – vPIS - vCOFINS (até 2026)<br><br>ou<br><br>vBC = vServ - descIncond – vCalcReeRepRes – vISSQN (até 2032)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `67` · E1530 · linha 70 · relação exata**
    - **Regra:** O valor da base de cálculo do IBS/CBS (vBC) é calculado a partir de valores informados na NFS-e:<br><br>(de 01/01/2026 até 31/12/2026)<br>vBC = vServ - descIncond – vCalcReeRepRes – vISSQN – vPIS - vCOFINS<br>ou<br>(de 01/01/2027 até 31/12/2032)<br>vBC = vServ - descIncond – vCalcReeRepRes – vISSQN
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1530`
    - **Mensagem:** Valor da Base de cálculo para IBS/CBS incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L052 — Campo `vCalcReeRepRes`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 53
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/`
- **Campo:** `vCalcReeRepRes`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário (R$) total relativo ao fornecimento próprio de bens materiais ou relacionados a operações de terceiros, objeto de reembolso, repasse ou ressarcimento pelo recebedor, já tributados e aqui referenciados e que não integram da base de cálculo (BC) do ISSQN, do IBS e da CBS.
- **Notas explicativas:** vCalcReeRepRes é:<br><br>A soma dos valores dos fornecimento próprio de bens materiais ou relacionados a operações de terceiros, objeto de reembolso, repasse ou ressarcimento pelo recebedor que não integram da base de cálculo (BC) do ISSQN, do IBS e da CBS, quando um ou mais documentos são informados pelo emitente na DPS. Neste caso, o resultado do somatório é o valor deste campo do leiaute NFS-e;
- **Regras de negócio associadas:** 4

  - **RN `68` · E1531 · linha 71 · relação exata**
    - **Regra:** O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcReeRepRes) não deve ser informado se o grupo de documentos referenciados que irão compor o valor não foi informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1531`
    - **Mensagem:** O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcReeRepRes) não deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `69` · E1533 · linha 72 · relação exata**
    - **Regra:** O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcReeRepRes) deve ser informado se o grupo de documentos referenciados que irão compor o valor foi informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1533`
    - **Mensagem:** O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcReeRepRes) deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `70` · E1534 · linha 73 · relação exata**
    - **Regra:** O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcReeRepRes) deve ser menor que o valor do serviço informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1534`
    - **Mensagem:** O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcReeRepRes) deve ser menor que o valor do serviço prestado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `71` · E1535 · linha 74 · relação exata**
    - **Regra:** O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcReeRepRes) deve ser igual à soma dos valores de documentos referenciados informados na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1535`
    - **Mensagem:** O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcReeRepRes) incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L053 — Campo `uf`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 54
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/`
- **Campo:** `uf`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de Informações relativas aos valores do IBS Estadual
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L057 — Campo `mun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 58
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/`
- **Campo:** `mun`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de Informações relativas aos valores do IBS Municipal
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L061 — Campo `fed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 62
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/`
- **Campo:** `fed`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de Informações relativas aos valores da CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/IBSCBS/valores/uf/`

#### L054 — Campo `pIBSUF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 55
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/uf/`
- **Campo:** `pIBSUF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota da UF para IBS da localidade de incidência parametrizada no sistema.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `73` · E1539 · linha 76 · relação exata**
    - **Regra:** A alíquota da UF para IBS deve ser igual ao valor IBSCBS/gIBSCBS/gIBSUF/pIBSUF retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1539`
    - **Mensagem:** Alíquota da UF para IBS incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L055 — Campo `pRedAliqUF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 56
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/uf/`
- **Campo:** `pRedAliqUF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-3V2`
- **Descrição:** Percentual de redução de alíquota estadual.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 4

  - **RN `74` · E1540 · linha 77 · relação exata**
    - **Regra:** O percentual redutor de alíquota para o IBS estadual não deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS não possuir essa indicação.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1540`
    - **Mensagem:** O percentual redutor de alíquota para o IBS estadual não deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `75` · E1541 · linha 78 · relação exata**
    - **Regra:** O percentual redutor de alíquota para o IBS estadual deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS possuir essa indicação.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1541`
    - **Mensagem:** O percentual redutor de alíquota para o IBS estadual deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `76` · E1543 · linha 79 · relação exata**
    - **Regra:** O percentual redutor de alíquota para o IBS estadual informado deve ser o mesmo indicado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1543`
    - **Mensagem:** O percentual redutor de alíquota para o IBS estadual informado difere do indicado para o o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `77` · E1557 · linha 80 · relação exata**
    - **Regra:** O percentual redutor de alíquota para o IBS estadual deve ser igual ao valor IBSCBS/gIBSCBS/gIBSUF/gRed/pRedAliq retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1557`
    - **Mensagem:** Percentual redutor de alíquota para o IBS estadual incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L056 — Campo `pAliqEfetUF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 57
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/uf/`
- **Campo:** `pAliqEfetUF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** pAliqEfetUF = pIBSUF x (1 - pRedAliqUF) x (1 - pRedutor)<br><br>Se pRedAliqUF não for informado na DPS, então pAliqEfetUF é a própria pIBSUF.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `78` · E1577 · linha 81 · relação exata**
    - **Regra:** A alíquota efetiva da UF para IBS deve ser igual ao valor IBSCBS/gIBSCBS/gIBSUF/gRed/pAliqEfet retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1577`
    - **Mensagem:** Alíquota efetiva da UF para IBS incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


### Caminho de origem: `NFSe/infNFSe/IBSCBS/valores/mun/`

#### L058 — Campo `pIBSMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 59
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/mun/`
- **Campo:** `pIBSMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota do Município para IBS da localidade de incidência parametrizada <br>no sistema.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `80` · E1578 · linha 83 · relação exata**
    - **Regra:** A alíquota do Município para IBS deve ser igual ao valor IBSCBS/gIBSCBS/gIBSMun/pIBSMun retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1578`
    - **Mensagem:** Alíquota do Município para IBS incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L059 — Campo `pRedAliqMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 60
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/mun/`
- **Campo:** `pRedAliqMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-3V2`
- **Descrição:** Percentual de redução de alíquota municipal.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 4

  - **RN `81` · E1545 · linha 84 · relação exata**
    - **Regra:** O percentual redutor de alíquota para o IBS municipal não deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS não possuir essa indicação.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1545`
    - **Mensagem:** O percentual redutor de alíquota para o IBS municipal não deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `82` · E1546 · linha 85 · relação exata**
    - **Regra:** O percentual redutor de alíquota para o IBS municipal deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS possuir essa indicação.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1546`
    - **Mensagem:** O percentual redutor de alíquota para o IBS municipal deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `83` · E1547 · linha 86 · relação exata**
    - **Regra:** O percentual redutor de alíquota para o IBS municipal informado deve ser o mesmo indicado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1547`
    - **Mensagem:** O percentual redutor de alíquota para o IBS municipal informado difere do indicado para o o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `84` · E1548 · linha 87 · relação exata**
    - **Regra:** O percentual de redução de alíquota municipal deve ser igual ao valor IBSCBS/gIBSCBS/gIBSMun/gRed/pRedAliq retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1548`
    - **Mensagem:** Percentual de redução de alíquota municipal incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L060 — Campo `pAliqEfetMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 61
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/mun/`
- **Campo:** `pAliqEfetMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** pAliqEfetMun = pIBSMun x (1 - pRedAliqMun) x (1 - pRedutor)<br><br>Se pRedAliqMun não for informado na DPS, então pAliqEfetMun é a própria pIBSMun.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `85` · E1549 · linha 88 · relação exata**
    - **Regra:** A alíquota efetiva do Município para IBS deve ser igual ao valor IBSCBS/gIBSCBS/gIBSMun/gRed/pAliqEfet retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1549`
    - **Mensagem:** Alíquota efetiva do Município para IBS incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


### Caminho de origem: `NFSe/infNFSe/IBSCBS/valores/fed/`

#### L062 — Campo `pCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 63
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/fed/`
- **Campo:** `pCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota da União para CBS parametrizada no sistema.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `87` · E1558 · linha 90 · relação exata**
    - **Regra:** A alíquota da União para CBS deve ser igual ao valor IBSCBS/gIBSCBS/gCBS/pCBS retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1558`
    - **Mensagem:** Alíquota da União para CBS incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L063 — Campo `pRedAliqCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 64
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/fed/`
- **Campo:** `pRedAliqCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-3V2`
- **Descrição:** Percentual da redução de alíquota da CBS.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 4

  - **RN `88` · E1550 · linha 91 · relação exata**
    - **Regra:** O percentual redutor de alíquota para a CBS não deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS não possuir essa indicação.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1550`
    - **Mensagem:** O percentual redutor de alíquota para a CBS não deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `89` · E1551 · linha 92 · relação exata**
    - **Regra:** O percentual redutor de alíquota para a CBS deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS possuir essa indicação.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1551`
    - **Mensagem:** O percentual redutor de alíquota para a CBS deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `90` · E1552 · linha 93 · relação exata**
    - **Regra:** O percentual redutor de alíquota para a CBS informado deve ser o mesmo indicado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1552`
    - **Mensagem:** O percentual redutor de alíquota para a CBS informado difere do indicado para o o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `91` · E1553 · linha 94 · relação exata**
    - **Regra:** O percentual redutor de alíquota para a CBS deve ser igual ao valor IBSCBS/gIBSCBS/gCBS/gRed/pRedAliq retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1553`
    - **Mensagem:** Percentual redutor de alíquota para a CBS incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L064 — Campo `pAliqEfetCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 65
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/valores/fed/`
- **Campo:** `pAliqEfetCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** pAliqEfetCBS = pCBS x (1 - pRedAliqCBS) x (1 - pRedutor)<br><br>Se pRedAliqCBS não for informado na DPS, então pAliqEfetCBS é a própria pCBS.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `92` · E1554 · linha 95 · relação exata**
    - **Regra:** A alíquota efetiva da União para CBS deve ser igual ao valor IBSCBS/gIBSCBS/gCBS/gRed/pAliqEfet retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1554`
    - **Mensagem:** Alíquota efetiva da União para CBS incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


### Caminho de origem: `NFSe/infNFSe/IBSCBS/totCIBS/`

#### L066 — Campo `vTotNF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 67
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Campo:** `vTotNF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor Total da NF considerando os impostos por fora: IBS e CBS.<br>O IBS e a CBS são por fora, por isso seus valores devem ser adicionados ao valor total da NF.<br><br> vTotNF = vLiq (em 2026)<br><br> vTotNF = vLiq + vCBS + vIBSTot (a partir de 2027)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `94` · E1555 · linha 97 · relação exata**
    - **Regra:** O valor total da NFS-e considerando os impostos por fora (IBS e CBS) é calculado a partir dos valores informados na NFS-e:<br>vTotNF = vLiq (em 2026)<br>vTotNF = vLiq + vCBS + vIBSTot (a partir de 2027)
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1555`
    - **Mensagem:** Valor total da NFS-e está incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L067 — Campo `gIBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 68
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Campo:** `gIBS`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de valores referentes ao IBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L078 — Campo `gCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 79
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Campo:** `gCBS`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de valores referentes à CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L084 — Campo `gTribRegular`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 85
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Campo:** `gTribRegular`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações de tributação regular
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `120` · E1583 · linha 123 · relação exata**
    - **Regra:** O grupo de tributação regular não deve ser informado se o indicador para tributação regular (exigeGrupoTributacaoRegular) para o código da classificação tributária - cClassTribIBSCBS for igual a false
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1583`
    - **Mensagem:** Grupo de tributação regular não deve ser informado para o cClassTribIBSCBS indicado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA
  - **RN `121` · E1584 · linha 124 · relação exata**
    - **Regra:** O grupo de tributação regular deve ser informado se o indicador para tributação regular (exigeGrupoTributacaoRegular) para o código da classificação tributária - cClassTribIBSCBS for igual a true
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1584`
    - **Mensagem:** Grupo de tributação regular deve ser informado para o cClassTribIBSCBS indicado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L091 — Campo `gTribCompraGov`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 92
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Campo:** `gTribCompraGov`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações da composição do valor do IBS e da CBS em compras governamentais
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `128` · E1600 · linha 131 · relação exata**
    - **Regra:** O grupo de tributação para compras governamentais não deve ser informado para essas operações (tpEnteGov não foi informado informado na DPS).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1600`
    - **Mensagem:** Grupo de compras governamentais não deve ser informando quando o tpEnteGov não foi informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `129` · E1601 · linha 132 · relação exata**
    - **Regra:** O grupo de tributação para compras governamentais deve ser informado para essas operações (tpEnteGov foi informado informado na DPS).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1601`
    - **Mensagem:** Grupo de compras governamentais deve ser informando quando o tpEnteGov não foi informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/`

#### L068 — Campo `vIBSTot`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 69
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/`
- **Campo:** `vIBSTot`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor total do IBS.<br><br>vIBSTot = vIBSUF + vIBSMun
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `96` · E1556 · linha 99 · relação exata**
    - **Regra:** O valor total do IBS deve ser igual ao valor total/IBSCBSTot/vIBS retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1556`
    - **Mensagem:** Valor total do IBS incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L069 — Campo `gIBSCredPres`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 70
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/`
- **Campo:** `gIBSCredPres`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de valores referentes ao crédito presumido para IBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `97` · E1560 · linha 100 · relação exata**
    - **Regra:** O grupo de crédito presumido para IBS não deve ser informado se o código do crédito presumido - cCredPres não foi informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1560`
    - **Mensagem:** Grupo crédito presumido para IBS não deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `98` · E1561 · linha 101 · relação exata**
    - **Regra:** O grupo de crédito presumido para IBS deve ser informado se o código do crédito presumido - cCredPres foi informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1561`
    - **Mensagem:** Grupo crédito presumido para IBS deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L072 — Campo `gIBSUFTot`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 73
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/`
- **Campo:** `gIBSUFTot`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de valores referentes ao IBS Estadual
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L075 — Campo `gIBSMunTot`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 76
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/`
- **Campo:** `gIBSMunTot`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de valores referentes ao IBS Municipal
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSCredPres/`

#### L070 — Campo `pCredPresIBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 71
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSCredPres/`
- **Campo:** `pCredPresIBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota do crédito presumido para o IBS
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L071 — Campo `vCredPresIBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 72
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSCredPres/`
- **Campo:** `vCredPresIBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor do Crédito Presumido para o IBS<br><br>vCredPresIBS = vBC x pCredPresIBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSUFTot/`

#### L073 — Campo `vDifUF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 74
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSUFTot/`
- **Campo:** `vDifUF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Total do Diferimento do IBS estadual.<br><br>vDifUF = vIBSUF x pDifUF
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `102` · E1565 · linha 105 · relação exata**
    - **Regra:** O valor do diferimento para o IBS estadual não deve ser informado se não foi informada, na DPS, a alíquota para o diferimento do IBS estadual - pDifUF.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1565`
    - **Mensagem:** Valor do diferimento para o IBS estadual não deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `103` · E1566 · linha 106 · relação exata**
    - **Regra:** O valor do diferimento para o IBS estadual deve ser informado se foi informada, na DPS, a alíquota para o diferimento do IBS estadual - pDifUF.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1566`
    - **Mensagem:** Valor do diferimento para o IBS estadual deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `104` · E1567 · linha 107 · relação exata**
    - **Regra:** O valor do diferimento para o IBS estadual deve ser igual ao valor total/IBSCBSTot/gIBSUF/vDif retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1567`
    - **Mensagem:** Valor do diferimento para o IBS estadual incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L074 — Campo `vIBSUF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 75
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSUFTot/`
- **Campo:** `vIBSUF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Total valor do IBS estadual.<br><br>vIBSUF = vBC x (pIBSUF ou pAliqEfetUF)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `105` · E1568 · linha 108 · relação exata**
    - **Regra:** O valor total do IBS estadual deve ser igual ao valor total/IBSCBSTot/gIBSUF/vIBSUF retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1568`
    - **Mensagem:** Valor total do IBS estadual incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


### Caminho de origem: `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSMunTot/`

#### L076 — Campo `vDifMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 77
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSMunTot/`
- **Campo:** `vDifMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Total do Diferimento do IBS municipal.<br><br>vDifMun = vIBSMun x pDifMun
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `107` · E1569 · linha 110 · relação exata**
    - **Regra:** O valor do diferimento para o IBS municipal não deve ser informado se não foi informada, na DPS, a alíquota para o diferimento do IBS municipal - pDifMun.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1569`
    - **Mensagem:** Valor do diferimento para o IBS municipal não deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `108` · E1570 · linha 111 · relação exata**
    - **Regra:** O valor do diferimento para o IBS municipal deve ser informado se foi informada, na DPS, a alíquota para o diferimento do IBS municipal - pDifMun.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1570`
    - **Mensagem:** Valor do diferimento para o IBS municipal deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `109` · E1571 · linha 112 · relação exata**
    - **Regra:** O valor do diferimento para o IBS municipal deve ser igual ao valor total/IBSCBSTot/gIBSMun/vDif retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1571`
    - **Mensagem:** Valor do diferimento para o IBS municipal incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L077 — Campo `vIBSMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 78
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSMunTot/`
- **Campo:** `vIBSMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Total valor do IBS municipal.<br><br>vIBSMun = vBC x (pIBSMun ou pAliqEfetMun)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `110` · E1572 · linha 113 · relação exata**
    - **Regra:** O valor total do IBS municipal deve ser igual ao valor total/IBSCBSTot/gIBSMun/vIBSUF retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1572`
    - **Mensagem:** Valor total do IBS municipal incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


### Caminho de origem: `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/`

#### L079 — Campo `gCBSCredPres`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 80
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/`
- **Campo:** `gCBSCredPres`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de valores referentes ao crédito presumido para CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `112` · E1575 · linha 115 · relação exata**
    - **Regra:** O grupo de crédito presumido para CBS não deve ser informado se o código do crédito presumido - cCredPres não foi informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1575`
    - **Mensagem:** Grupo crédito presumido para CBS não deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `113` · E1576 · linha 116 · relação exata**
    - **Regra:** O grupo de crédito presumido para CBS deve ser informado se o código do crédito presumido - cCredPres também foi informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1576`
    - **Mensagem:** Grupo crédito presumido para CBS deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L082 — Campo `vDifCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 83
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/`
- **Campo:** `vDifCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Total do Diferimento CBS.<br><br>vDifCBS = vCBS x pDifCBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `116` · E1570 · linha 119 · relação exata**
    - **Regra:** O valor do diferimento para a CBS não deve ser informado se foi não informada, na DPS, a alíquota para o diferimento da CBS - pDifCBS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1570`
    - **Mensagem:** Valor do diferimento para a CBS não deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `117` · E1580 · linha 120 · relação exata**
    - **Regra:** O valor do diferimento para a CBS deve ser informado se foi informada, na DPS, a alíquota para o diferimento da CBS - pDifCBS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1580`
    - **Mensagem:** Valor do diferimento para a CBS deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `118` · E1581 · linha 121 · relação exata**
    - **Regra:** O valor do diferimento para a CBS deve ser igual ao valor total/IBSCBSTot/gCBS/vDif retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1581`
    - **Mensagem:** Valor do diferimento para a CBS incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L083 — Campo `vCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 84
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/`
- **Campo:** `vCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Total valor da CBS da União.<br><br>vCBS = vBC x (pCBS ou pAliqEfetCBS)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `119` · E1582 · linha 122 · relação exata**
    - **Regra:** O valor total da CBS da União deve ser igual ao valor total/IBSCBSTot/gCBS/vCBS retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1582`
    - **Mensagem:** Valor total da CBS da União incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA


### Caminho de origem: `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/gCBSCredPres/`

#### L080 — Campo `pCredPresCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 81
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/gCBSCredPres/`
- **Campo:** `pCredPresCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota do crédito presumido para a CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L081 — Campo `vCredPresCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 82
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/gCBSCredPres/`
- **Campo:** `vCredPresCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor do Crédito Presumido da CBS.<br><br>vCredPresCBS = vBC x pCredPresCBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`

#### L085 — Campo `pAliqEfeRegIBSUF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 86
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Campo:** `pAliqEfeRegIBSUF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota efetiva de tributação regular do IBS estadual
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `122` · E1585 · linha 125 · relação exata**
    - **Regra:** A alíquota efetiva de tributação regular do IBS estadual deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/pAliqEfetRegIBSUF retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1585`
    - **Mensagem:** Alíquota efetiva de tributação regular do IBS estadual incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L086 — Campo `vTribRegIBSUF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 87
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Campo:** `vTribRegIBSUF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor da tributação regular do IBS estadual.<br><br>vTribRegIBSUF = vBC x pAliqEfeRegIBSUF
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `123` · E1586 · linha 126 · relação exata**
    - **Regra:** O valor da tributação regular do IBS estadual deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/vTribRegIBSUF retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1586`
    - **Mensagem:** Valor da tributação regular do IBS estadual incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L087 — Campo `pAliqEfeRegIBSMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 88
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Campo:** `pAliqEfeRegIBSMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota efetiva de tributação regular do IBS municipal
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `124` · E1587 · linha 127 · relação exata**
    - **Regra:** A alíquota efetiva de tributação regular do IBS municipal deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/pAliqEfetRegIBSMun retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1587`
    - **Mensagem:** Alíquota efetiva de tributação regular do IBS municipal incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L088 — Campo `vTribRegIBSMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 89
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Campo:** `vTribRegIBSMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor da tributação regular do IBS municipal.<br><br>vTribRegIBSMun = vBC x pAliqEfeRegIBSMun
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `125` · E1588 · linha 128 · relação exata**
    - **Regra:** O valor da tributação regular do IBS municipal deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/vTribRegIBSMun retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1588`
    - **Mensagem:** Valor da tributação regular do IBS municipal incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L089 — Campo `pAliqEfeRegCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 90
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Campo:** `pAliqEfeRegCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota efetiva de tributação regular da CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `126` · E1589 · linha 129 · relação exata**
    - **Regra:** A alíquota efetiva de tributação regular da CBS deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/pAliqEfetRegCBS retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1589`
    - **Mensagem:** Alíquota efetiva de tributação regular da CBS incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L090 — Campo `vTribRegCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 91
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Campo:** `vTribRegCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor da tributação regular da CBS.<br><br>vTribRegCBS = vBC x pAliqEfeRegCBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `127` · E1590 · linha 130 · relação exata**
    - **Regra:** O valor da tributação regular da CBS deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/vTribRegCBS retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1590`
    - **Mensagem:** Valor da tributação regular da CBS incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


### Caminho de origem: `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`

#### L092 — Campo `pIBSUF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 93
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Campo:** `pIBSUF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota do IBS de competência do Estado
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `130` · E1602 · linha 133 · relação exata**
    - **Regra:** A alíquota do IBS de competência do Estado deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/pAliqIBSUF retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1602`
    - **Mensagem:** Alíquota do IBS de competência do Estado incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L093 — Campo `vIBSUF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 94
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Campo:** `vIBSUF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor do Tributo do IBS da UF calculado
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `131` · E1603 · linha 134 · relação exata**
    - **Regra:** O valor do Tributo do IBS da UF deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/vTribIBSUF retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1603`
    - **Mensagem:** Valor do Tributo do IBS da UF incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L094 — Campo `pIBSMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 95
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Campo:** `pIBSMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota do IBS de competência do<br>Município
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `132` · E1604 · linha 135 · relação exata**
    - **Regra:** A alíquota do IBS de competência do<br>Município deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/pAliqIBSMun retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1604`
    - **Mensagem:** Alíquota do IBS de competência do<br>Município incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L095 — Campo `vIBSMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 96
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Campo:** `vIBSMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor do Tributo do IBS do Município<br>calculado
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `133` · E1605 · linha 136 · relação exata**
    - **Regra:** O valor do Tributo do IBS do Município deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/vTribIBSMun retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1605`
    - **Mensagem:** Valor do Tributo do IBS do Município incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L096 — Campo `pCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 97
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Campo:** `pCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota da CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `134` · E1606 · linha 137 · relação exata**
    - **Regra:** A alíquota da CBS deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/pAliqCBS retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1606`
    - **Mensagem:** Alíquota da CBS incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


#### L097 — Campo `vCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 98
- **Caminho no XML (origem):** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Campo:** `vCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor do Tributo da CBS calculado
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `135` · E1607 · linha 138 · relação exata**
    - **Regra:** O valor do Tributo da CBS deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/vTribCBS retornado pela Calculadora
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1607`
    - **Mensagem:** Valor do Tributo da CBS incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA<br>Margem de erro de R$ 0,01


### Caminho de origem: `NFSe/infNFSe/DPS/`

#### L099 — Campo `versao`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 100
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/`
- **Campo:** `versao`
- **ELE:** `A`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-4V2`
- **Descrição:** Versão do leiaute da DPS.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `137` · E0001 · linha 140 · relação exata**
    - **Regra:** Prazo de aceitação da versão do leiaute DPS ultrapassado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0001`
    - **Mensagem:** O prazo de aceitação da versão do leiaute da DPS expirou.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L100 — Campo `infDPS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 101
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/`
- **Campo:** `infDPS`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de Informações da<br>Declaração de Prestação de Serviços - DPS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/`

#### L101 — Campo `id`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 102
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `id`
- **ELE:** `ID`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `45`
- **Descrição:** O identificador da DPS é composto pela concatenação de campos que constam no leiaute da DPS.<br>A formação deste identificador considera o literal "DPS" associado a outras 42 posições numéricas, conforme descrito abaixo:<br><br>"DPS" + <br>Cód.Mun. (7) + <br>Tipo de Inscrição Federal (1) + <br>Inscrição Federal (14 - CPF completar com 000 à esquerda) + <br>Série DPS (5) + <br>Núm. DPS (15)
- **Notas explicativas:** Tipo de inscrição Federal = 1 / Inscrição Federal = CPF emitente da DPS;<br>Tipo de inscrição Federal = 2 / Inscrição Federal = CNPJ emitente da DPS;
- **Regras de negócio associadas:** 1

  - **RN `139` · E0004 · linha 142 · relação exata**
    - **Regra:** O identificador da DPS é formado conforme a concatenação dos seguintes campos:<br>"DPS" + Cód.Mun.Emi. + Tipo de Inscrição Federal + Inscrição Federal + Série DPS + Núm. DPS<br><br>Campo identificador da DPS inválido.<br>Identificador da DPS difere da concatenação dos campos correspondentes.<br>"DPS" + Cód.Mun.Emi. + Tipo de Inscrição Federal + Inscrição Federal + Série DPS + Núm. DPS <br><br>Verificar se tipo de inscrição e inscrição, informados no identificador da DPS, estão corretamente correspondidos conforme o seguinte:<br><br>Tipo de inscrição Federal = 1 / Inscrição Federal = CPF emitente da DPS;<br>Tipo de inscrição Federal = 2 / Inscrição Federal = CNPJ emitente da DPS;<br><br>Cód.Mun.Emi. é o código do município do endereço do emitente da DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0004`
    - **Mensagem:** Conteúdo do identificador informado na DPS difere da concatenação dos campos correspondentes.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L102 — Campo `tpAmb`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 103
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `tpAmb`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Identificação do tipo de ambiente no Sistema Nacional NFS-e: <br>1 - Produção; <br>2 - Homologação;
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `140` · E0006 · linha 143 · relação exata**
    - **Regra:** Ambiente informado diverge do ambiente de recebimento para o qual o emitente enviou a DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0006`
    - **Mensagem:** Ambiente informado diverge do ambiente de recebimento para o qual o emitente enviou a DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L103 — Campo `dhEmi`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 104
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `dhEmi`
- **ELE:** `E`
- **TIPO:** `D`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Data e hora da emissão da DPS.<br>Data e hora no formato UTC (Universal Coordinated Time):<br>AAAA-MM-DDThh:mm:ssTZD
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `141` · E0008 · linha 144 · relação exata**
    - **Regra:** A data de emissão da DPS deve ser anterior ou igual à data e hora do seu processamento (dhProc) pelo Sistema Nacional NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0008`
    - **Mensagem:** A data e hora de emissão da DPS deve ser anterior ou igual à data do seu processamento (dhProc) pelo Sistema Nacional NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `142` · E1294 · linha 145 · relação exata**
    - **Regra:** A data de compartilhamento do DF-e não pode ser posterior à há mais de 6 anos de sua emissão.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1294`
    - **Mensagem:** Prazo para entrega da DF-e excedido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L104 — Campo `verAplic`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 105
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `verAplic`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-20`
- **Descrição:** Versão do aplicativo que gerou a DPS.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L105 — Campo `serie`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 106
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `serie`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-5`
- **Descrição:** Série da DPS.
- **Notas explicativas:** Faixas de utilização da série da DPS:<br> <br> 00001 a 49999 - Emissão com aplicativo pŕoprio;<br> 50000 a 69999 - Emissor Móvel;<br> 70000 a 79999 - Emissor Web;<br> 80000 a 89999 - Emissão com *transcrição manual (Web);<br> <br> *O emitente deve informar o número de série (transcrever o número de série) que foi repassado ao não emitente da NFS-e.
- **Regras de negócio associadas:** 2

  - **RN `144` · E0010 · linha 147 · relação exata**
    - **Regra:** A série informada na DPS não pertence à faixa definida para o tipo de emissor utilizado para a sua emissão.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0010`
    - **Mensagem:** A série informada na DPS não pertence à faixa definida para o tipo de emissor utilizado para a sua emissão.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** Faixas de utilização da série da DPS:<br><br>00001 a 49999 - Emissão com aplicativo pŕoprio;<br>50000 a 69999 - Emissor Móvel;<br>70000 a 79999 - Emissor Web;<br>80000 a 89999 - Emissão com *transcrissão manual (Web);<br><br>*O emitente deve informar o número de série (transcrever o número de série) que foi repassado ao não emitente da NFS-e.
  - **RN `145` · E0014 · linha 148 · relação exata**
    - **Regra:** Conjunto de Série, Número, Código do Município Emissor e CNPJ/CPF informado nesta DPS já existe em uma NFS-e gerada a partir de uma DPS enviada anteriormente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0014`
    - **Mensagem:** Conjunto de Série, Número, Código do Município Emissor e CNPJ/CPF informado nesta DPS já existe em uma NFS-e gerada a partir de uma DPS enviada anteriormente.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L106 — Campo `nDPS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 107
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `nDPS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15`
- **Descrição:** Número da DPS.
- **Notas explicativas:** 1 até 999999999999999
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L107 — Campo `dCompet`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 108
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `dCompet`
- **ELE:** `E`
- **TIPO:** `D`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Data de competência da prestação do serviço.<br>Ano, Mês e Dia (AAAA-MM-DD)
- **Notas explicativas:** A data de competência deve ser única e ser a mesma que a data do fato gerador do tributo, ou seja, a data da prestação do serviço.
- **Regras de negócio associadas:** 7

  - **RN `147` · E0015 · linha 150 · relação exata**
    - **Regra:** A data de competência informada na DPS deve ser anterior ou igual à data de emissão (dhEmi) da DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0015`
    - **Mensagem:** A data de competência informada na DPS não pode ser posterior à data de emissão (dhEmi) da DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `148` · E0016 · linha 151 · relação exata**
    - **Regra:** A data de competência deve ser igual ou posterior à data de ativação do convênio do município emissor informado na DPS.<br><br>Exceto quando o emitente da DPS for MEI (opSimpNac = 2) na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0016`
    - **Mensagem:** A data de competência deve ser igual ou posterior à data de ativação do convênio do município emissor informado na DPS, exceto quando o emitente for MEI na data de competëncia informada.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** Regras idênticas mas aplicadas em sistemas diferentes. <br>A primeira é realizada apenas na Sefin e <br>a segunda é realizada apena no ADN.
  - **RN `149` · E1270 · linha 152 · relação exata**
    - **Regra:** A data de competência deve ser igual ou posterior à data de ativação do convênio do município emissor informado na DPS.<br>A situação do convêncio do município emissor informado na DPS deve ser ATIVO.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1270`
    - **Mensagem:** A data de competência deve ser igual ou posterior à data de ativação do convênio do município emissor informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** Regras idênticas mas aplicadas em sistemas diferentes. <br>A primeira é realizada apenas na Sefin e <br>a segunda é realizada apena no ADN.
  - **RN `150` · E0018 · linha 153 · relação exata**
    - **Regra:** A data de competência informada na DPS deve ser igual ou posterior à data de inscrição do CNPJ do emitente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0018`
    - **Mensagem:** A data de competência informada na DPS deve ser igual ou posterior à data de inscrição do CNPJ do emitente no cadastro CNPJ.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `151` · E0020 · linha 154 · relação exata**
    - **Regra:** A data de competência informada na DPS deve ser igual ou posterior à data de inscrição do CPF do emitente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0020`
    - **Mensagem:** A data de competência informada na DPS deve ser igual ou posterior à data de inscrição do CPF do emitente no cadastro CPF.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `152` · E0023 · linha 155 · relação exata**
    - **Regra:** Se houver registro complementar do contribuinte (CNPJ ou CPF + IM do emitente da DPS), com situação "Ativo", no CNC do município correspondente ao município emissor da DPS (cLocEmi), a data de competência informada na DPS deve ser igual ou posterior à data do indicador municipal.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0023`
    - **Mensagem:** A data de competência informada na DPS deve ser igual ou posterior à data do indicador municipal, registrada no CNC do município correspondente ao município emissor da DPS (cLocEmi).
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `153` · E0025 · linha 156 · relação exata**
    - **Regra:** Se houver registro complementar do contribuinte (CNPJ ou CPF + IM do emitente da DPS), com situação "Ativo", no CNC do município correspondente ao município emissor da DPS (cLocEmi), a data de competência informada na DPS deve ser igual ou posterior à data de autorizasção de uso do emissores para o contribuinte pelo município emissor (cLocEmi).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0025`
    - **Mensagem:** A data de competência informada na DPS deve ser igual ou posterior à data autorizasção de uso do emissores, registrada no CNC do município correspondente ao município emissor da DPS (cLocEmi) para o contribuinte.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L108 — Campo `tpEmit`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 109
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `tpEmit`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Emitente da DPS:<br><br>1 - Prestador;<br>2 - Tomador;<br>3 - Intermediário;
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `154` · E9996 · linha 157 · relação exata**
    - **Regra:** Se a DPS for emitida pelo tomador ou intermendiário (tpEmit = 2 ou 3), então a DPS deve ser rejeitada pelo sistema.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E9996`
    - **Mensagem:** Nesta versão da aplicação, não é permitida a emissão de NFS-e pelo tomador ou intermediário.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L109 — Campo `cMotivoEmisTI`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 110
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `cMotivoEmisTI`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1`
- **Descrição:** Motivo da Emissão da DPS pelo Tomador/Intermediário:<br><br>1 - Importação de Serviço;<br>2 - Tomador/Intermediário obrigado a emitir NFS-e por legislação municipal;<br>3 - Tomador/Intermediário emitindo NFS-e por recusa de emissão pelo prestador;<br>4 - Tomador/Intermediário emitindo por rejeitar a NFS-e emitida pelo prestador;
- **Notas explicativas:** Se o município de incidência não for o do tomador, o sistema deve rejeitar eventuais retenções.
- **Regras de negócio associadas:** 3

  - **RN `155` · E0029 · linha 158 · relação exata**
    - **Regra:** Se o emitente for o prestador de serviço (tpEmit = 1), então este campo não deve ser preenchido.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0029`
    - **Mensagem:** O motivo da emissão não pode ser preenchido se o emitente for o prestador de serviço.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `156` · E0031 · linha 159 · relação exata**
    - **Regra:** Para o tomador emitente da DPS, estabelecido em município diferente do município de incidência do ISSQN, então não pode haver retenção (tpRetISSQN tem que ser igual a 1).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0031`
    - **Mensagem:** Não pode haver retenção do ISSQN pelo tomador quando o município de incidência não for o do tomador.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `157` · E0032 · linha 160 · relação exata**
    - **Regra:** Para o intermediário emitente da DPS, estabelecido em município diferente do município de incidência do ISSQN, então não pode haver retenção (tpRetISSQN tem que ser igual a 1).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0032`
    - **Mensagem:** Não pode haver retenção do ISSQN pelo intermediário quando o município de incidência não for o do intermediário.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.


#### L110 — Campo `chNFSeRej`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 111
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `chNFSeRej`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `50`
- **Descrição:** Chave de Acesso da NFS-e rejeitada pelo Tomador/Intermediário.
- **Notas explicativas:** O tomador deve referenciar neste campo a nota do prestador, utilizando-se da chave da NFS-e emitida pelo prestador e previamente rejeitada pelo tomador, ou seja, o Tomador/Intermediário antes de emitir sua NFS-e pelo motivo 4 do campo cMotivoEmisTI deverá emitir um Evento de Manifestação de NFS-e de rejeição para a NFS-e emitida pelo prestador, cuja chave de acesso será informada neste campo chNFSeRej.
- **Regras de negócio associadas:** 2

  - **RN `158` · E0034 · linha 161 · relação exata**
    - **Regra:** Somente é permitido o preencimento deste campo se o emitente da DPS for o Tomador ou Intermediário (tpEmit igual a 2 ou 3) e o motivo da emissão for a rejeição de NFS-e emitida pelo Prestador (cMotivoEmisTI igual a 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0034`
    - **Mensagem:** Somente é permitido o preenchimento do campo de chave de acesso de NFS-e rejeitada se o tipo de emitente for Tomador ou Intermediário e o motivo da emissao for por rejeição de NFS-e emitida pelo prestador.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `159` · E0035 · linha 162 · relação exata**
    - **Regra:** Verificar se a NFS-e informada possui Evento de Manifestação de Rejeição de NFS-e do Tomador ou Intermediario cujo autor do evento seja o mesmo emitente (Tomador ou Intermediário) desta DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0035`
    - **Mensagem:** A chave de acesso de NFS-e informada nesta DPS não possui a ela vinculada o evento de manifestação de rejeição emitido pelo mesmo emitente desta DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.


#### L111 — Campo `cLocEmi`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 112
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `cLocEmi`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código de 7 dígitos da localidade emissora da NFS-e.
- **Notas explicativas:** O campo cLocEmi (Código da Localidade de Emissão da DPS) sempre corresponderá a um município brasileiro e identificado pela tabela de códigos de municípios do IBGE ou um trecho de concessão de exploração de rodovia para a qual a NFS-e foi emiitida.<br><br>O município emissor da NFS-e é aquele município em que o emitente da DPS está cadastrado e autorizado a "emitir uma NFS-e", ou seja, emitir uma DPS para que o sistema nacional valide as informações nela prestadas e gere a NFS-e correspondente para o emitente.<br><br>Para que o sistema nacional emita a NFS-e o município emissor deve ser conveniado e estar ativo no sistema nacional. Além disso o convênio do município deve permitir que os contribuintes do município utilize os emissores públicos do Sistema Nacional NFS-e.
- **Regras de negócio associadas:** 6

  - **RN `160` · E0037 · linha 163 · relação exata**
    - **Regra:** O código do município emissor informado na DPS deve existir no cadastro de convênio municipal do sistema nacional.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0037`
    - **Mensagem:** O código do município emissor informado na DPS é inexistente no cadastro de convênio municipal do sistema nacional.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `161` · E0038 · linha 164 · relação exata**
    - **Regra:** A situação do convênio do município emissor informado na DPS deve ser "ATIVO" no cadastro de convênio municipal do sistema nacional.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0038`
    - **Mensagem:** A situação do convênio do município emissor informado na DPS deve ser "ATIVO" no cadastro de convênio municipal do sistema nacional.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `162` · E0039 · linha 165 · relação exata**
    - **Regra:** O município emissor informado na DPS deve estar parametrizado para utilizar os emissores públicos nacionais, conforme parametrização do município no Sistema Nacional NFS-e.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0039`
    - **Mensagem:** O município emissor informado na DPS deve estar parametrizado para utilizar os emissores públicos nacionais, conforme parametrização do município no Sistema Nacional NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `163` · E0041 · linha 166 · relação exata**
    - **Regra:** Se tpEmit for igual a 1 (prestador) e a opção pelo simples nacional for igual a 2 (MEI), <br>então o município emissor deve corresponder ao município do endereço do emitente no cadastro CNPJ.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0041`
    - **Mensagem:** O município emissor não corresponde ao município do emitente MEI no CNPJ.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `164` · E1304 · linha 167 · relação exata**
    - **Regra:** Verificar se o código do município emissor da NFS-e existe, conforme TAB.MUN_IBGE do ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe, e corresponde ao mesmo município que está compartilhando a NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1304`
    - **Mensagem:** O código do município emissor da NFS-e não existe conforme tabela do IBGE ou difere do código do municipio que está compartilhando o documento com o ADN do Sistema Nacional NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `165` · E1272 · linha 168 · relação exata**
    - **Regra:** O código do município informado deve existir e estar ativo no cadastro de convênio municipal na data de processamento do compartilhamento com o ADN.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1272`
    - **Mensagem:** O código do município informado não existe ou não está ativo no convênio municipal na data de processamento de compartilhamento com o ADN.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** Compartilhamento e Distribuição devem serguir esta regra


#### L112 — Campo `subst`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 113
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `subst`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas à NFS-e a ser substituída
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L116 — Campo `prest`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 117
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `prest`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas ao prestador do serviço
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L143 — Campo `toma`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 144
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `toma`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas ao tomador do serviço
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `234` · E0187 · linha 237 · relação exata**
    - **Regra:** Se campo cIndOp for igual a 030102, 050102, 100101, 100301, 100501, 030103, 050103, 100102, 100201, 100302, 100401, 100502 ou 100601, então o grupo toma deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0187`
    - **Mensagem:** O grupo de informações relativas ao tomador/adquirente do serviço é obrigatório para o indicador de operação informado.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L166 — Campo `interm`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 167
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `interm`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas ao intermediário do serviço
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L189 — Campo `serv`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 190
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `serv`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas ao serviço prestado
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L246 — Campo `valores`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 247
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `valores`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas à valores do serviço prestado
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L335 — Campo `IBSCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 336
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `IBSCBS`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações declaradas pelo emitente referentes ao IBS e à CBS
- **Notas explicativas:** Para optantes dos Simples Nacional, os grupos IBSCBS só serão obrigatórios a partir de 2027.
- **Regras de negócio associadas:** 2

  - **RN `542` · E0850 · linha 545 · relação exata**
    - **Regra:** É permitido declarar informações de IBS/CBS somente a partir da data de competência 01/01/2026.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0850`
    - **Mensagem:** É permitido declarar informações de IBS/CBS somente a partir da data de competência 01/01/2026.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `543` · E0854 · linha 546 · relação exata**
    - **Regra:** Somente é permitio declarar informações de IBS/CBS a partir da versão 1.01 da DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0854`
    - **Mensagem:** Somente é permitio declarar informações de IBS/CBS a partir da versão 1,01 da DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L415 — Campo `Signature`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 416
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/`
- **Campo:** `Signature`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Assinatura XML da NFS-e Segundo o Padrão XML Digital Signature<br>Obrigatório quando for enviado para API.<br>Demais casos poderão ser opcionais a serem definidos em regra de validação.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 5

  - **RN `642` · E0714 · linha 645 · relação inferida**
    - **Regra:** A assinatura da DPS deve ser válida.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0714`
    - **Mensagem:** Arquivo enviado com erro na assinatura.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/`, campo `Signature`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `643` · E0715 · linha 646 · relação inferida**
    - **Regra:** Certificado Digital da assintura inválido:<br><br>- Validade do Certificado (data início e data fim);<br>- Verifica a Cadeia de Certificação;<br>- Certificado do Transmissor revogado;<br>- LCR indisponível ou inválida.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0715`
    - **Mensagem:** Certificado Digital da assinatura inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/`, campo `Signature`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `644` · E0716 · linha 647 · relação inferida**
    - **Regra:** Certificado Digital da assinatura fora do padrão estabelecido pelo projeto NFS-e:<br><br>- Versão diferente de 3;<br>- Se informado, Basic Constraint deve ser true (não pode ser Certificado de AC);<br>- KeyUsage não define 'Assinatura Digital' e 'Não Recusa';<br>- Falta a extensão de CNPJ (OtherName - OID=2.16.76.1.3.3) ou CPF (OtherName - OID=2.16.76.1.3.1);<br>- Certificado Raiz difere da 'ICP-Brasil'.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0716`
    - **Mensagem:** Certificado Digital fora do padrão estabelecido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/`, campo `Signature`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `645` · E0717 · linha 648 · relação inferida**
    - **Regra:** É obrigatória a existência da assinatura da DPS quando for enviado para Web Service.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0717`
    - **Mensagem:** A assinatura é obrigatória quando for enviado para o Web Service.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/`, campo `Signature`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `646` · E0718 · linha 649 · relação inferida**
    - **Regra:** A assinatura deve ser feita com o certificado digital do emitente da DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0718`
    - **Mensagem:** A assinatura deve ser feita com o certificado digital do emitente da DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/`, campo `Signature`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/subst`

#### L113 — Campo `chSubstda`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 114
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/subst`
- **Campo:** `chSubstda`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `50`
- **Descrição:** Chave de Acesso da NFS-e a ser substituída.
- **Notas explicativas:** O município conveniado ao Sistema Nacional NFS-e deverá parametrizar o prazo máximo permitido para que o emitente da NFS-e possa substituir uma NFS-e que o município tenha gerado.<br><br>Prazo máximo parametrizável é 2 anos.<br><br>O município conveniado ao Sistema Nacional NFS-e deverá parametrizar se impede ou não a substituição de nota caso a nota Substuída não tenha as informações do NI do tomador<br><br>Um evento de bloqueio de ofício para qualquer outro tipo de evento é considerado vigente se não há um correspondente evento de desbloqueio de ofício que contemple o tipo de evento bloqueado.
- **Regras de negócio associadas:** 16

  - **RN `167` · E0042 · linha 170 · relação exata**
    - **Regra:** Chave de NFS-e a ser substituída é inválida.<br><br>1 - Verificar DV da chave de NFS-e a ser substituída informada nesta DPS;<br>2 - Verificar a correspondência exata dos campos (Cód.Mun. / Tipo de Inscrição / Inscrição) da chave de NFS-e a ser substituída informada e o id desta DPS;
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0042`
    - **Mensagem:** Chave de NFS-e a ser substituída é inválida.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `168` · E0044 · linha 171 · relação exata**
    - **Regra:** NFS-e inexistente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0044`
    - **Mensagem:** NFS-e não existe na base de dados do autorizador de NFS-e nacional. Informe uma chave de NFS-e existente.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `169` · E0046 · linha 172 · relação exata**
    - **Regra:** NFS-e cancelada não pode ser substituída.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0046`
    - **Mensagem:** Uma NFS-e cancelada não pode ser substituída. Informe uma chave de NFS-e não cancelada anteriormente.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `170` · E0050 · linha 173 · relação exata**
    - **Regra:** Não poderá ocorrer a substituição de NFS-e fora do prazo permitido, conforme parametrização do município emissor da NFS-e, exceto quando a justificativa para substituição de NFS-e for Desenquadramento ou Enquadramento de NFS-e no Simples Nacional (cMotivo = 1 ou 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0050`
    - **Mensagem:** Uma NFS-e não pode ser substituída fora do prazo estabelecido pelo município emissor da NFS-e.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `171` · E0056 · linha 174 · relação exata**
    - **Regra:** Não poderá ocorrer a substituição de NFS-e que não contenha identificação do tomador, conforme parametrização do município emissor da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0056`
    - **Mensagem:** NFS-e não pode ser substituída pois não possui identificação do tomador.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `172` · E0058 · linha 175 · relação exata**
    - **Regra:** Não poderá ocorrer a substituição de NFS-e com alteração da identificação do não emitente, conforme parametrização do município emissor da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0058`
    - **Mensagem:** Não poderá ocorrer a substituição de NFS-e com alteração da identificação do não emitente, conforme parametrização do município emissor da NFS-e.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `173` · E0060 · linha 176 · relação exata**
    - **Regra:** Os campos data de competência, subitem da lista nacional de serviços, código complementar municipal e local da prestação não podem ser alterados quando a opção do simples nacional for Não Optante (opSimpNac = 1).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0060`
    - **Mensagem:** Os campos data de competência, subitem da lista nacional de serviços, código complementar municipal e local da prestação não podem ser alterados quando a opção do simples nacional for Não Optante (opSimpNac = 1).
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `174` · E0061 · linha 177 · relação exata**
    - **Regra:** Os campos identificação do Tomador (se identificado na DPS), data de competência (dCompet), e valor do serviço (vServ), não podem ser alterados quando a opção do simples nacional for MEI (opSimpNac = 2) ou ME/EPP (opSimpNac = 3).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0061`
    - **Mensagem:** Os campos identificação do Tomador (se identificado na DPS), data de competência (dCompet), e valor do serviço (vServ), não podem ser alterados quando a opção do simples nacional for MEI (opSimpNac = 2) ou ME/EPP (opSimpNac = 3).
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `175` · E0065 · linha 178 · relação exata**
    - **Regra:** Não poderá ocorrer a substituição de NFS-e que tenha sido gerada em ambientes geradores difentes.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0065`
    - **Mensagem:** Não é possível substituição da NFS-e que tenha sido gerada em ambientes geradores diferentes.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `176` · E0068 · linha 179 · relação exata**
    - **Regra:** Não é possível a substituição desta NFS-e pois a mesma possui registro de Evento de Solicitação de Análise Fiscal para Cancelamento de NFS-e aguardando resposta.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0068`
    - **Mensagem:** Não é possível a substituição desta NFS-e pois a mesma possui registro de Evento de Solicitação de Análise Fiscal para Cancelamento de NFS-e aguardando resposta. Para mais informações, consultar a Administração Tributária Municipal do município emissor da NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `177` · E0070 · linha 180 · relação exata**
    - **Regra:** Não poderá ocorrer a substituição de NFS-e que tenha registro de Evento de Manifestação de Confirmação da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0070`
    - **Mensagem:** Não é possível a substituição desta NFS-e pois já ocorreu uma manifestação de confirmação de serviço. Para mais informações, consultar a Administração Tributária Municipal do município emissor da NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `178` · E0072 · linha 181 · relação exata**
    - **Regra:** Não poderá ocorrer a substituição de NFS-e que tenha registro de Evento de Manifestação de Confirmação Tácita da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0072`
    - **Mensagem:** Não é possível a substituição desta NFS-e pois já ocorreu uma manifestação tácita da NFS-e. Para mais informações, consultar a Administração Tributária Municipal do município emissor da NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `179` · E0074 · linha 182 · relação exata**
    - **Regra:** Não é permitido realizar a substituição para NFS-e que possua Evento de Tributos Recolhidos vinculado, conforme parametrização do município de incidência do ISSQN.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0074`
    - **Mensagem:** Não é permitido realizar a substituição para NFS-e que possua Evento de Tributos Recolhidos vinculado, conforme parametrização do município de incidência do ISSQN. Para mais informações, consultar a Administração Tributária Municipal do município emissor da NFS-e.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** Aguarda para Implementar no Contexto do MAN.
  - **RN `180` · E0076 · linha 183 · relação exata**
    - **Regra:** Não é permitido realizar a substituição para NFS-e que possua Evento de Bloqueio de Ofício para o Evento de Cancelamento de NFS-e por Substituição vigente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0076`
    - **Mensagem:** Não é permitido realizar a substituição para NFS-e que possua Evento de Bloqueio de Ofício para o Evento de Cancelamento de NFS-e por Substituição vigente.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `181` · E1308 · linha 184 · relação exata**
    - **Regra:** Uma NFS-e substituta não pode ser compartilhada com o ADN pelo município conveniado antes que o cancelamento por sustituição de NFS-e da nota a ser substituída tenha sido compartilhada anteriormente.<br><br>Obs: Verificar se já houve o compartilhamento com o ADN do cancelamento por substituição de NFS-e, quando uma NFS-e que está sendo compartilhada possuir uma chave de NFS-e válida informada no leiaute.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1308`
    - **Mensagem:** NFS-e a ser substituída não possui um evento de Cancelamento por substituição compartilhado com o ADN e por isso não pode ser substituída.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `182` · E1310 · linha 185 · relação exata**
    - **Regra:** Uma NFS-e substituta não pode ser compartilhada com o ADN pelo município conveniado antes que o evento de cancelamento por sustituição de NFS-e, compartilhado anteriormente, contenha a referência ao identificador da NFS-e substituta que está sendo conpartilhada.<br><br>Obs: <br>Obs: Verificar se o identificador da NFS-e substituta corresponde à chave de acesso informada no campo evento/pedRegEvento/infPedReg/e105102/chSubstituta do evento de cancelamento por sustituição da NFS-e substituída;
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1310`
    - **Mensagem:** O identificador desta NFS-e substituta não está referenciado no evento de Cancelamento por substituição da NFS-e substituída.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L114 — Campo `cMotivo`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 115
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/subst`
- **Campo:** `cMotivo`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Código de justificativa para substituição de NFS-e:<br><br>1 - Desenquadramento de NFS-e do Simples Nacional;<br>2 - Enquadramento de NFS-e no Simples Nacional;<br>3 - Inclusão Retroativa de Imunidade/Isenção para NFS-e;<br>4 - Exclusão Retroativa de Imunidade/Isenção para NFS-e;<br>5 - Rejeição de NFS-e pelo tomador ou pelo intermediário se responsável pelo recolhimento do tributo;<br>99 - Outros;
- **Notas explicativas:** Rejeição de NFS-e pelo tomador ou pelo intermediário se responsável pelo recolhimento do tributo.
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L115 — Campo `xMotivo`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 116
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/subst`
- **Campo:** `xMotivo`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `15-255`
- **Descrição:** Descrição do motivo da substituição da NFS-e quando o emitente deve descrever o motivo da substituição para outros motivos (cMotivo = 99).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `184` · E0078 · linha 187 · relação exata**
    - **Regra:** Quando o campo cMotivo = 99, o campo xMotivo deve informado obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0078`
    - **Mensagem:** Quando o campo cMotivo = 99, o campo xMotivo deve informado obrigatoriamente.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/prest/`

#### L117 — Campo `CNPJ`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 118
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `CNPJ`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `14`
- **Descrição:** Número da inscrição federal (CNPJ) do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `186` · E0080 · linha 189 · relação exata**
    - **Regra:** CNPJ informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0080`
    - **Mensagem:** CNPJ do prestador informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `187` · E0082 · linha 190 · relação exata**
    - **Regra:** CNPJ do prestador não existe no cadastro CNPJ na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0082`
    - **Mensagem:** CNPJ do emitente prestador não encontrado no cadastro CNPJ na data de competência.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `188` · E0084 · linha 191 · relação exata**
    - **Regra:** Para este CNPJ, se o emitente for o prestador de serviço (tpEmit = 1), na data de competência informada na DPS, o município emissor deve corresponder:<br>1) ao município do endereço registrado no cadastro CNPJ, se a situação padrão para emissão dos contribuintes, com endereço no município, do cadastro CNPJ da RFB for habilitada ou;<br>2) ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CNPJ + IM informados na DPS para o prestador devem existir no CNC NFS-e);<br><br>Exceto quando o emitente da DPS for MEI (opSimpNac = 2) na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0084`
    - **Mensagem:** CNPJ do emitente prestador não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme cadastros CNPJ e CNC NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L118 — Campo `CPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 119
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `CPF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `11`
- **Descrição:** Número da inscrição federal (CPF) do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `189` · E0096 · linha 192 · relação exata**
    - **Regra:** CPF informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0096`
    - **Mensagem:** CPF do prestador informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `190` · E0098 · linha 193 · relação exata**
    - **Regra:** CPF do prestador não existe no cadastro CPF na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0098`
    - **Mensagem:** CPF do emitente prestador não encontrado no cadastro CPF na data de competência.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `191` · E0099 · linha 194 · relação exata**
    - **Regra:** Para este CPF, se o emitente for o prestador de serviço (tpEmit = 1), na data de competência informada na DPS, o município emissor deve corresponder ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CPF + IM informados na DPS para o prestador devem existir no CNC NFS-e);
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0099`
    - **Mensagem:** CPF do emitente prestador não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme  cadastro nacional complementar NFS-e (cLocEmi + CPF + IM informados na DPS para o prestador devem existir no CNC NFS-e).
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L119 — Campo `NIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 120
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `NIF`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `40`
- **Descrição:** Número de identificação fiscal fornecido por órgão de administração tributária no exterior.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `192` · E0112 · linha 195 · relação exata**
    - **Regra:** Se o campo tpEmit for ígual a 1, então NIF do prestador não pode ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0112`
    - **Mensagem:** O prestador de serviço, quando emitente da DPS, não pode ser identificado pelo NIF.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `193` · E0113 · linha 196 · relação exata**
    - **Regra:** Se o grupo de informações de endereço no exterior do prestador de serviços foi informado então o NIF ou cNaoNIF do prestador deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0113`
    - **Mensagem:** O NIF ou cNaoNIF do prestador deve ser informado quando o grupo de informações de endereço no exterior do prestador de serviços foi informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L120 — Campo `cNaoNIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 121
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `cNaoNIF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Motivo para não informação do NIF:<br><br>0 - Não informado na nota de origem;<br>1 - Dispensado do NIF;<br>2 - Não exigência do NIF;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Regras de negócio associadas:** 2

  - **RN `195` · E0114 · linha 198 · relação exata**
    - **Regra:** Se o campo tpEmit for ígual a 1, então cNaoNIF do prestador não pode ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0114`
    - **Mensagem:** O prestador de serviço, quando emitente da DPS, somente pode ser identificado pelo CNPJ ou CPF.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `196` · E0115 · linha 199 · relação exata**
    - **Regra:** Se o valor do campo cNaoNIF do prestador, informado na DPS, for 0, então a DPS deve ser rejeitada.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0115`
    - **Mensagem:** Valor 0 para o motivo da não informação do NIF do prestador não é permitido na Sefin do Sistema Nacional NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L121 — Campo `CAEPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 122
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `CAEPF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `14`
- **Descrição:** Número do Cadastro de Atividade Econômica da Pessoa Física (CAEPF).
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L122 — Campo `IM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 123
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `IM`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `15`
- **Descrição:** Número do indicador municipal do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 4

  - **RN `198` · E0116 · linha 201 · relação exata**
    - **Regra:** Se o emitente for o prestador de serviço (tpEmit = 1) e, se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então a IM deve ser informada na DPS.<br><br>Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço e o codigo do município emissor (cLocEmi), ambos informados na DPS, para identificar as ocorrências no CNC NFS-e. Se houver pelo menos uma ocorrência, então o emitente da DPS deve informar o IM correspondente registrado no CNC NFS-e, que identifique unicamente o registro complementar.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0116`
    - **Mensagem:** A IM deve ser informada para o emitente prestador do serviço na DPS, conforme informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `199` · E0119 · linha 202 · relação exata**
    - **Regra:** Se o emitente for o prestador de serviço (tpEmit = 1) e se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, verificar se o IM informado está autorizado a emitir NFS-e na data de processamento desta DPS,.<br><br>Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0119`
    - **Mensagem:** IM do emitente prestador não está autorizado a emitir NFS-e, conforme informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `200` · E0120 · linha 203 · relação exata**
    - **Regra:** Se o emitente for o prestador de serviço (tpEmit = 1) e, se não houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então o IM não deve ser informado na DPS.<br><br>Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço, o codigo do município emissor (cLocEmi),  informados na DPS, para identificar o registro complementar no CNC NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0120`
    - **Mensagem:** IM do prestador não deve ser informado, pois não existem informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `201` · E0124 · linha 204 · relação exata**
    - **Regra:** Para o emitente prestador de serviço (tpEmit = 1), verificar se o IM informado nesta DPS está Inativo (cStat) no CNC do município emissor na data de competência informada.<br><br>Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.<br> <br>Se todos os registros complementares estiverem inativos, utilizar as informações dos cadastros RFB (CNPJ ou CPF), conforme identificador federal utilizado para identificar o emitente da DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0124`
    - **Mensagem:** O IM informado está inativo no CNC NFS-e do município emissor para a data de competência informada na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L123 — Campo `xNome`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 124
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `xNome`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `150`
- **Descrição:** Nome / Nome Empresarial do prestador.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `202` · E0121 · linha 205 · relação exata**
    - **Regra:** Se o emitente da DPS for o prestador de serviço (tpEmit for igual a 1), então o nome ou razão social não deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0121`
    - **Mensagem:** O nome ou razão social do prestador não deve ser informado quando o emitente da DPS for o próprio prestador.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `203` · E0122 · linha 206 · relação exata**
    - **Regra:** Se o emitente da DPS não for o prestador de serviço (tpEmit for igual a 2 ou 3), então o nome ou razão social deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0122`
    - **Mensagem:** O nome ou razão social do prestador deve ser informado quando o emitente da DPS não for o próprio prestador.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `204` · E0123 · linha 207 · relação exata**
    - **Regra:** Se NIF do prestador for preenchido então o campo xNome deve ser preenchido obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0123`
    - **Mensagem:** O preenchimento do nome empresarial é obrigatório quando o prestador for identificado com NIF.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L124 — Campo `end`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 125
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `end`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço do prestador de serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `205` · E0129 · linha 208 · relação exata**
    - **Regra:** Se o emitente da DPS for o tomador ou intermediário (tpEmit = 2 ou 3) o grupo de informações do endereço do prestador de serviço deve ser informado na DPS obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0129`
    - **Mensagem:** O endereço do prestador deve ser informado na DPS quando o prestador não for o emitente da DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `206` · E0128 · linha 209 · relação exata**
    - **Regra:** Se o emitente da DPS é o prestador do serviço (tpEmit = 1), então o grupo de informações do endereço do prestador de serviço não deve ser informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0128`
    - **Mensagem:** O endereço do prestador do serviço não deve ser informado na DPS quando o próprio prestador for o emitente da DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L137 — Campo `fone`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 138
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `fone`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `6-20`
- **Descrição:** Número do telefone do prestador.<br>(Preencher com o Código DDD + número do telefone. <br>Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L138 — Campo `email`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 139
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `email`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-80`
- **Descrição:** E-mail do prestador.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `222` · E0148 · linha 225 · relação exata**
    - **Regra:** Email deve ser informado conforme estrutura (conter @, ponto etc.).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0148`
    - **Mensagem:** Email inválido.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L139 — Campo `regTrib`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 140
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Campo:** `regTrib`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas aos regimes de tributação do prestador de serviços
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/prest/end/`

#### L125 — Campo `endNac`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 126
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Campo:** `endNac`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço nacional.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `207` · E0125 · linha 210 · relação inferida**
    - **Regra:** Se o CNPJ ou CPF do prestador de serviço foi informado e o emitente da DPS for o prestador (tpEmit = 2 ou 3), então o grupo de informações de endereço nacional do prestador do serviço deve ser informado obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0125`
    - **Mensagem:** O endereço nacional do prestador do serviço deve ser informado na DPS quando for identificado pelo CNPJ ou CPF e o emitente da DPS for o tomador ou intermediário.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/infDPS/prest/`, campo `endNac`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.


#### L128 — Campo `endExt`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 129
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Campo:** `endExt`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço no exterior.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `212` · E0142 · linha 215 · relação exata**
    - **Regra:** Se o NIF do prestador de serviço foi informado e o emitente da DPS, tomador ou intermedirio (tpEmit = 2 ou 3), for identificado por CNPJ, então o grupo de informações de endereço no exterior do prestador do serviço deve ser informado obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0142`
    - **Mensagem:** O grupo de informações de endereço no exterior deve ser informado obrigatoriamente quando o prestador for identificado pelo NIF e o emitente por CNPJ.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L133 — Campo `xLgr`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 134
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Campo:** `xLgr`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Tipo e nome do logradouro do endereço do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L134 — Campo `nro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 135
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Campo:** `nro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Número no logradouro do endereço do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L135 — Campo `xCpl`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 136
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Campo:** `xCpl`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-156`
- **Descrição:** Complemento do endereço do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L136 — Campo `xBairro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 137
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Campo:** `xBairro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Bairro do endereço do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/prest/end/endNac/`

#### L126 — Campo `cMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 127
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/endNac/`
- **Campo:** `cMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código do município do endereço do prestador do serviço.<br> (Tabela do IBGE)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `208` · E0130 · linha 211 · relação exata**
    - **Regra:** O código do município para o endereço do prestador do serviço não existe, conforme TAB.MUN_IBGE do ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0130`
    - **Mensagem:** O código do município para o endereço do prestador do serviço não existe conforme tabela de município do IBGE.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `209` · E0132 · linha 212 · relação exata**
    - **Regra:** Quando o endereço nacional do prestador for informado na DPS e o mesmo for identificado pelo CNPJ, o código do município do endereço do prestador, deve existir e corresponder ao município do seu endereço no cadastro CNPJ ou do endereço registrado em suas informações complementares no CNC NFS-e, na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0132`
    - **Mensagem:** O código do município informado na DPS para o endereço do prestador do serviço, identificado pelo CNPJ, não corresponde ao município registrado em seus cadastros na data de competência informada na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `210` · E0134 · linha 213 · relação exata**
    - **Regra:** Quando o endereço nacional do prestador for informado na DPS e o mesmo for identificado pelo CPF, o código do município do endereço do prestador, deve existir e corresponder ao município do seu endereço no cadastro CPF ou do endereço registrado em suas informações complementares no CNC NFS-e, na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0134`
    - **Mensagem:** O código do município informado na DPS para o endereço do prestador do serviço, identificado pelo CPF, não corresponde ao município registrado em seus cadastros na data de competência informada na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L127 — Campo `CEP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 128
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/endNac/`
- **Campo:** `CEP`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP) <br> do endereço do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `211` · E0138 · linha 214 · relação exata**
    - **Regra:** O CEP informado deve existir e pertencer ao município correspondente ao código do município informado para o endereço do prestador do serviço.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0138`
    - **Mensagem:** O CEP informado para o endereço nacional do prestador do serviço não existente ou não pertence ao município informado na DPS. Informe um CEP existente e que pertença ao município informado para o endereço do prestador do serviço na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/`

#### L129 — Campo `cPais`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 130
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/`
- **Campo:** `cPais`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Código do país do endereço do prestador do prestador do serviço.<br> (Tabela de Países ISO)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `213` · E0146 · linha 216 · relação exata**
    - **Regra:** O código de país informado para o endereço no exterior do prestador do serviço deve existir e ser diferente de Brasil (BR), conforme a tabela ISO2.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0146`
    - **Mensagem:** O código de país informado para o endereço no exterior do prestador do serviço não existe ou é igual ao código do Brasil. Informe um código de país existente e diferente do codigo do Brasil (BR) para o endereço no exterior do prestador do serviço, conforme tabela de país do ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe-ESPEC.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L130 — Campo `cEndPost`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 131
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/`
- **Campo:** `cEndPost`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-11`
- **Descrição:** Código alfanumérico do Endereçamento Postal no exterior do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L131 — Campo `xCidade`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 132
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/`
- **Campo:** `xCidade`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Nome da cidade no exterior do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L132 — Campo `xEstProvReg`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 133
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/`
- **Campo:** `xEstProvReg`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Estado, província ou região da cidade no exterior do prestador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/prest/regTrib/`

#### L140 — Campo `opSimpNac`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 141
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/regTrib/`
- **Campo:** `opSimpNac`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Situação perante Simples Nacional:<br><br>1 - Não Optante;<br>   2 - Optante - Microempreendedor Individual (MEI);<br>   3 - Optante - Microempresa ou Empresa de Pequeno Porte (ME/EPP);
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `224` · E0160 · linha 227 · relação exata**
    - **Regra:** Opção de situação perante o Simples Nacional do prestador, informada na DPS, não está de acordo com o cadastro Simples Nacional na data de competência informada na DPS.<br>Se CNPJ do prestador não consta no cadastro então opSimpNac é igual a 1;
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0160`
    - **Mensagem:** No mês de competência da NFS-e, a opção de situação perante o Simples Nacional, do prestador, informada na DPS não está de acordo com o cadastro Simples Nacional.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `225` · E0161 · linha 228 · relação exata**
    - **Regra:** Quando o emitente for MEI a NFS-e poderá ser compartilhada pelo município com o ADN somente se a data de competência for igual ou menor que 31/08/2023.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0161`
    - **Mensagem:** NFS-e cujo emitente for MEI somente poderá ser compartilhada pelo município com o ADN se a data de competência, informada na NFS-e, for menor ou igual a 31/08/2023.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L141 — Campo `regApTribSN`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 142
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/regTrib/`
- **Campo:** `regApTribSN`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1`
- **Descrição:** Regime de Apuração Tributária pelo Simples Nacional.<br><br>Opção para que o contribuinte optante pelo Simples Nacional ME/EPP (opSimpNac = 3) possa indicar, ao emitir o documento fiscal, em qual regime de apuração os tributos federais e municipal estão inseridos, caso tenha ultrapassado algum sublimite ou limite definido para o Simples Nacional.<br> <br>1 – Regime de apuração dos tributos federais e municipal pelo SN;<br>2 – Regime de apuração dos tributos federais pelo SN e o ISSQN pela NFS-e conforme respectiva legislação municipal do tributo;<br>3 – Regime de apuração dos tributos federais e municipal pela NFS-e conforme respectivas legislações federal e municipal de cada tributo;
- **Notas explicativas:** 1 - Um MEI, identificado como tal na data de competência informada na DPS após a verificação na base de dados do Simples Nacional, será tratado sempre como MEI no Sistema Nacional NFS-e, independentemente de quaisquer circustâncias que o próprio MEI tenha detectado que o descaracterize como MEI. A informação da situação do MEI sempre será aquela que for verificada no Simples Nacional na data de competência informada na DPS.<br><br>2 - Uma ME/EPP deixará de apurar o ISSQN pelo Simples Nacional quando atribuir ao campo regAPTribSN os valores 2 ou 3, conforme leiaute DPS.
- **Regras de negócio associadas:** 2

  - **RN `226` · E0162 · linha 229 · relação exata**
    - **Regra:** O regime de apuração dos tributos para o optante do Simples Nacional (ME/EPP) não pode ser preenchido quando o prestador de serviço não for optante do simples nacional ou for MEI, ou seja, o campo opSimpNac = 1 ou 2.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0162`
    - **Mensagem:** Não é permitido ao não optante do Simples Nacional e o MEI preencherem o campo de indicação do regime de apuração dos tributos apurados.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `227` · E0166 · linha 230 · relação exata**
    - **Regra:** O regime de apuração dos tributos para o optante do Simples Nacional (ME/EPP) deve ser preenchido obrigatoriamente quando o prestador de serviço for optante do simples nacional (ME/EPP), ou seja, o campo opSimpNac = 3.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0166`
    - **Mensagem:** É obrigatorio o preenchimento do campo de regime de apuração dos tributos do SN para o optante do Simples Nacional ME/EPP.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L142 — Campo `regEspTrib`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 143
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/prest/regTrib/`
- **Campo:** `regEspTrib`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Tipos de Regimes Especiais de Tributação Municipal:<br><br>0 - Nenhum;<br>1 - Ato Cooperado (Cooperativa);<br>2 - Estimativa;<br>3 - Microempresa Municipal;<br>4 - Notário ou Registrador;<br>5 - Profissional Autônomo;<br>6 - Sociedade de Profissionais;<br>9 - Outros;
- **Notas explicativas:** -
- **Regras de negócio associadas:** 6

  - **RN `228` · E0172 · linha 231 · relação exata**
    - **Regra:** Não é permitido informar Regime Especial de Tributação, ou seja, regEspTrib deve ser igual a 0 (Nenhum), quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", <br>(tribISSQN = 2, 3 ou 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0172`
    - **Mensagem:** O Regime Especial de Tributação deve ser "Nenhum" (regEspTrib = 0) quando o serviço prestado for diferente de Tributável (tribISSQN = 1), ou seja, tribISSQN = 2, 3 ou 4.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `229` · E0174 · linha 232 · relação exata**
    - **Regra:** O tipo de regime especial de tributação deve ser "Nenhum", quando o prestador for MEI (opSimpNac = 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0174`
    - **Mensagem:** Quando o prestador da NFS-e é MEI (opSimpNac = 2) o regime especial de tributação deve ser "Nenhum" (regEspTrib = 0).
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `230` · E0175 · linha 233 · relação exata**
    - **Regra:** O tipo de regime especial de tributação deve ser "Nenhum" (regEspTrib = 0) quando o prestador for optante do Simples Nacional ME/EPP (opSimpNac = 3) e o regime de apuração dos tributos federais e municipal ocorrer pelo SN (regApTribSN = 1).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0175`
    - **Mensagem:** Quando o prestador optante pelo Simples Nacional tiver o regime de apuração dos tributos ocorrendo também pelo Simples Nacional, o regime especial de tributação do ISSQN deve ser "Nenhum" (regEspTrib = 0).
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `231` · E0177 · linha 234 · relação exata**
    - **Regra:** Não é permitido informar Regime Especial de Tributação "Não admitido pelo município", conforme parametrização do município de incidência do ISSQN.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0177`
    - **Mensagem:** Regime especial de tributação informado na DPS não é admitido na parametrização do município de incidência do ISSQN.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `232` · E0176 · linha 235 · relação exata**
    - **Regra:** É permitido informar Profissional Autônomo na DPS somente se:<br><br> o prestador de serviço estiver parametrizado como Profissional Autônomo, na data de competência informada na DPS, em pelo menos um dos municípios, emissor ou de incidência do ISSQN (cLocIncid ou cLocEmi)<br>ou<br>se estiver admitido sem verificação (parâmetro "Informado na DPS pelo Emitente - Sem verificação"), conforme parametrização do município de incidência do ISSQN na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0176`
    - **Mensagem:** É permitido informar Profissional Autônomo na DPS somente se o prestador de serviço estiver parametrizado como Profissional Autônomo, na data de competência informada na DPS, em pelo menos um dos municípios, emissor ou de incidência do ISSQN (cLocIncid ou cLocEmi) ou se estiver admitido sem verificação (parâmetro "Informado na DPS pelo Emitente - Sem verificação"), conforme parametrização do município de incidência do ISSQN na data de competência informada na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `233` · E0178 · linha 236 · relação exata**
    - **Regra:** É permitido informar Regime Especial de Tributação atribuído para contribuinte específico, conforme parametrização do município de incidência do ISSQN na data de competência informada na DPS.<br><br>ver descrição na coluna observações de negócio.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0178`
    - **Mensagem:** Regime especial de tributação não permitido para o prestador do serviço com código de tributação na data de competência, informados na DPS, conforme parametrização do município de incidência do ISSQN.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/toma/`

#### L144 — Campo `CNPJ`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 145
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Campo:** `CNPJ`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `14`
- **Descrição:** Número da inscrição federal (CNPJ) do tomador de serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 5

  - **RN `235` · E0188 · linha 238 · relação exata**
    - **Regra:** CNPJ informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0188`
    - **Mensagem:** CNPJ do tomador informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `236` · E0190 · linha 239 · relação exata**
    - **Regra:** CNPJ do tomador não existe no cadastro CNPJ na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0190`
    - **Mensagem:** CNPJ do tomador não encontrado no cadastro CNPJ.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `237` · E0194 · linha 240 · relação exata**
    - **Regra:** Para este CNPJ, se o emitente for o tomador de serviço (tpEmit = 2), na data de competência informada na DPS o município emissor deve corresponder:<br>1) ao município do endereço registrado no cadastro CNPJ ou;<br>2) ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CNPJ + IM informados na DPS para o prestador devem existir no CNC NFS-e);
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0194`
    - **Mensagem:** CNPJ do emitente tomador não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme cadastros CNPJ e CNC NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3).
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `238` · E0202 · linha 241 · relação exata**
    - **Regra:** CNPJ do tomador é igual ao CNPJ do prestador. Para efeitos desta regra comparar o CNPJ completo.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0202`
    - **Mensagem:** Na emissão da NFS-e não é permitido que o prestador do serviço seja igual ao tomador do serviço.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `239` · E0204 · linha 242 · relação exata**
    - **Regra:** Se a DPS indicar retenção pelo tomador (tpRetISSQN = 2), então o tomador deve ser identificado por CNPJ ou CPF.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0204`
    - **Mensagem:** CNPJ ou CPF do tomador não foi informado, mas existe uma indicação para retenção do ISSQN na DPS no campo de tipo de "Retenção do ISSQN".
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L145 — Campo `CPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 146
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Campo:** `CPF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `11`
- **Descrição:** Número da inscrição federal (CPF) do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `241` · E0206 · linha 244 · relação exata**
    - **Regra:** CPF informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0206`
    - **Mensagem:** CPF do tomador informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `242` · E0207 · linha 245 · relação exata**
    - **Regra:** CPF do tomador inexistente no cadastro CPF na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0207`
    - **Mensagem:** CPF do tomador não encontrado no cadastro CPF.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `243` · E0212 · linha 246 · relação exata**
    - **Regra:** Para este CPF, se o emitente for o tomador de serviço (tpEmit = 2), na data de competência informada na DPS o município emissor deve corresponder ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CPF + IM informados na DPS para o prestador devem existir no CNC NFS-e);
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0212`
    - **Mensagem:** CPF do emitente tomador não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme cadastros CPF e CNC NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.


#### L146 — Campo `NIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 147
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Campo:** `NIF`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `40`
- **Descrição:** Número de identificação fiscal fornecido por órgão de administração tributária no exterior.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `244` · E0222 · linha 247 · relação exata**
    - **Regra:** Se o campo tpEmit for ígual a 2, então NIF do tomador não pode ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0222`
    - **Mensagem:** O tomador de serviço, quando emitente da DPS, não pode ser identificado pelo NIF.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `245` · E0223 · linha 248 · relação exata**
    - **Regra:** Se o grupo de informações de endereço no exterior do tomador de serviços foi informado então o NIF ou cNaoNIF do tomador deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0223`
    - **Mensagem:** O NIF ou cNaoNIF do tomador deve ser informado quando o grupo de informações de endereço no exterior do tomador de serviços foi informado.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L147 — Campo `cNaoNIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 148
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Campo:** `cNaoNIF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Motivo para não informação do NIF:<br><br>0 - Não informado na nota de origem;<br>1 - Dispensado do NIF;<br>2 - Não exigência do NIF;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Regras de negócio associadas:** 2

  - **RN `247` · E0224 · linha 250 · relação exata**
    - **Regra:** Se o campo tpEmit for ígual a 2, então cNaoNIF do tomador não pode ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0224`
    - **Mensagem:** O tomador de serviço, quando emitente da DPS, somente pode ser identificado pelo CNPJ ou CPF.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `248` · E0226 · linha 251 · relação exata**
    - **Regra:** Se o valor do campo cNaoNIF do tomador, informado na DPS, for 0, então a DPS deve ser rejeitada.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0226`
    - **Mensagem:** Valor 0 para o motivo da não informação do NIF do tomador não é permitido na Sefin do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L148 — Campo `CAEPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 149
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Campo:** `CAEPF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `14`
- **Descrição:** Número do Cadastro de Atividade Econômica da Pessoa Física (CAEPF).
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L149 — Campo `IM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 150
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Campo:** `IM`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `15`
- **Descrição:** Número do indicador municipal do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 4

  - **RN `250` · E0228 · linha 253 · relação exata**
    - **Regra:** Se o emitente for o prestador de serviço (tpEmit = 2) e, se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então a IM deve ser informada na DPS.<br><br>Utilizar o identificador federal (CNPJ ou CPF) do tomador de serviço e o codigo do município emissor (cLocEmi), ambos informados na DPS, para identificar as ocorrências no CNC NFS-e. Se houver pelo menos uma ocorrência então o emitente da DPS deve informar o IM correspondente registrado no CNC NFS-e, que identifique unicamente o registro complementar.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0228`
    - **Mensagem:** A IM deve ser informada para o emitente tomador do serviço na DPS, conforme informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `251` · E0231 · linha 254 · relação exata**
    - **Regra:** Verificar se o IM informado na DPS está autorizado a emitir NFS-e na data de processamento desta DPS, se o emitente for o tomador de serviço (tpEmit = 2) e, se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então a IM deve ser informada na DPS.<br><br>Utilizar o identificador federal (CNPJ ou CPF) do tomador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0231`
    - **Mensagem:** IM do emitente tomador não está autorizado a emitir NFS-e, conforme informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `252` · E0232 · linha 255 · relação exata**
    - **Regra:** Se o emitente for o tomador de serviço (tpEmit = 2) e, se não houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então o IM não deve ser informado na DPS.<br><br>Utilizar o identificador federal (CNPJ ou CPF) do tomador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0232`
    - **Mensagem:** IM do tomador não deve ser informado, pois não existem informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `253` · E0229 · linha 256 · relação exata**
    - **Regra:** Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.<br><br>Para o emitente tomador de serviço (tpEmit = 2), verificar se o IM informado nesta DPS está Inativo (cStat) no CNC do município emissor na data de competência informada.<br> <br>Se todos os registros complementares estiverem inativos, utilizar as informações dos cadastros RFB (CNPJ ou CPF), conforme identificador federal utilizado para identificar o emitente da DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0229`
    - **Mensagem:** O IM informado está inativo no CNC NFS-e do município emissor para a data de competência informada na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.


#### L150 — Campo `xNome`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 151
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Campo:** `xNome`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `150`
- **Descrição:** Nome / Nome Empresarial do tomador.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `254` · E0233 · linha 257 · relação exata**
    - **Regra:** Se NIF for preenchido então o campo xNome deve ser preenchido obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0233`
    - **Mensagem:** O nome tomador deve ser preenchido obrigatoriamente quando o NIF do tomador for preenchido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L151 — Campo `end`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 152
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Campo:** `end`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `255` · E0234 · linha 258 · relação exata**
    - **Regra:** Quando o emitente da DPS informar um subitem da lista de serviço cuja incidência do ISSQN ocorra no local do estabelecimento/endereço do tomador, conforme planilha MUN.INCID_INFO.SERV. <br>ou cIndOp for igual a 030102, 050102, 100101, 100301, 100501, 030103, 050103, 100102, 100201, 100302, 100401, 100502 ou 100601<br> o endereço do tomador deve ser obrigatoriamente informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0234`
    - **Mensagem:** O endereço do tomador é obrigatório para o indicador de operação informado ou quando a incidência do ISSQN definida para o serviço prestado ocorrer no local do estabelecimento/domicílio do tomador.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L164 — Campo `fone`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 165
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Campo:** `fone`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `6-20`
- **Descrição:** Número do telefone do tomador.<br>(Preencher com o Código DDD + número do telefone. <br>Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L165 — Campo `email`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 166
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Campo:** `email`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-80`
- **Descrição:** E-mail do tomador.
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `271` · E0247 · linha 274 · relação exata**
    - **Regra:** Email deve ser informado conforme estrutura (conter @, ponto etc.).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0247`
    - **Mensagem:** Email inválido.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/toma/end/`

#### L152 — Campo `endNac`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 153
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Campo:** `endNac`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço nacional.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `256` · E0235 · linha 259 · relação exata**
    - **Regra:** Se o tpEmit é igual a 1 e o tomador foi identificado pelo CNPJ, então o grupo de informações de endereço nacional do tomador do serviço deve ser informado obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0235`
    - **Mensagem:** O endereço nacional do tomador do serviço deve ser informado na DPS quando o tomador for identificado pelo CNPJ.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `257` · E0236 · linha 260 · relação exata**
    - **Regra:** Se o emitente da DPS é o tomador do serviço (tpEmit = 2), então o grupo de informações do endereço nacional do tomador não deve ser informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0236`
    - **Mensagem:** O endereço nacional do tomador do serviço não deve ser informado na DPS quando o próprio tomador do serviço for o emitente da DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `258` · E0237 · linha 261 · relação exata**
    - **Regra:** Se o valor do ISSQN deve ser retido pelo tomador do serviço (tpRetISSQN = 2), então o grupo de informações do endereço nacional deve ser informado na DPS obrigatoriamente, exceto se o emitente da DPS é o tomador do serviço (tpEmit = 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0237`
    - **Mensagem:** O endereço nacional do tomador do serviço deve ser informado na DPS quando o valor do ISSQN for retido pelo tomador, exceto se o emitente da DPS é o próprio tomador do serviço.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L155 — Campo `endExt`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 156
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Campo:** `endExt`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço no exterior.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `261` · E0242 · linha 264 · relação exata**
    - **Regra:** Se o NIF do tomador de serviço foi informado e o emitente da DPS for identificado por CNPJ, então o grupo de informações de endereço no exterior do tomador do serviço deve ser informado obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0242`
    - **Mensagem:** O grupo de informações de endereço no exterior deve ser informado obrigatoriamente quando o tomador for identificado pelo NIF e o emitente por CNPJ.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L160 — Campo `xLgr`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 161
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Campo:** `xLgr`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Tipo e nome do logradouro do endereço do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L161 — Campo `nro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 162
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Campo:** `nro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Número no logradouro do endereço do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L162 — Campo `xCpl`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 163
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Campo:** `xCpl`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-156`
- **Descrição:** Complemento do endereço do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L163 — Campo `xBairro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 164
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Campo:** `xBairro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Bairro do endereço do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/toma/end/endNac/`

#### L153 — Campo `cMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 154
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/endNac/`
- **Campo:** `cMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código do município do endereço do tomador do serviço.<br> (Tabela do IBGE)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `259` · E0238 · linha 262 · relação exata**
    - **Regra:** O código do município informado para o endereço do tomador do serviço não existe, conforme tabela de municípios do IBGE.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0238`
    - **Mensagem:** O código do município informado na DPS para o endereço do tomador do serviço não existe conforme tabela de município do IBGE.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L154 — Campo `CEP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 155
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/endNac/`
- **Campo:** `CEP`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP) <br> do endereço do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `260` · E0240 · linha 263 · relação exata**
    - **Regra:** O CEP informado deve existir e pertencer ao município correspondente ao código do município informado para o endereço do tomador do serviço.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0240`
    - **Mensagem:** O CEP informado para o endereço nacional do tomador do serviço não existe ou não pertence ao município do endereço do tomador.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/`

#### L156 — Campo `cPais`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 157
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/`
- **Campo:** `cPais`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Código do país do endereço do prestador do tomador do serviço.<br> (Tabela de Países ISO)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `262` · E0246 · linha 265 · relação exata**
    - **Regra:** O código de país informado para o endereço no exterior do tomador do serviço deve existir e ser diferente de Brasil (BR), conforme a tabela ISO2.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0246`
    - **Mensagem:** O código de país informado para o endereço no exterior do tomador do serviço não existe ou é igual ao código do Brasil. Informe um código de país existente e diferente do codigo do Brasil (BR) para o endereço no exterior do tomador do serviço, conforme tabela de país do ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe-ESPEC.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L157 — Campo `cEndPost`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 158
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/`
- **Campo:** `cEndPost`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-11`
- **Descrição:** Código alfanumérico do Endereçamento Postal no exterior do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L158 — Campo `xCidade`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 159
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/`
- **Campo:** `xCidade`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Nome da cidade no exterior do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L159 — Campo `xEstProvReg`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 160
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/`
- **Campo:** `xEstProvReg`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Estado, província ou região da cidade no exterior do tomador do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/interm/`

#### L167 — Campo `CNPJ`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 168
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Campo:** `CNPJ`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `14`
- **Descrição:** Número da inscrição federal (CNPJ) do intermediário de serviço
- **Notas explicativas:** -
- **Regras de negócio associadas:** 5

  - **RN `273` · E0248 · linha 276 · relação exata**
    - **Regra:** CNPJ informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0248`
    - **Mensagem:** CNPJ do intermediário informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `274` · E0250 · linha 277 · relação exata**
    - **Regra:** CNPJ do intermediário não existe no cadastro CNPJ na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0250`
    - **Mensagem:** CNPJ do intermediário não encontrado no cadastro CNPJ.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `275` · E0254 · linha 278 · relação exata**
    - **Regra:** Para este CNPJ, se o emitente for o intermediário do serviço (tpEmit = 3), na data de competência informada na DPS o município emissor deve corresponder:<br>1) ao município do endereço registrado no cadastro CNPJ ou;<br>2) ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CNPJ + IM informados na DPS para o prestador devem existir no CNC NFS-e);
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0254`
    - **Mensagem:** CNPJ do emitente intermediário não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme cadastros CNPJ e CNC NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `276` · E0262 · linha 279 · relação exata**
    - **Regra:** CNPJ do intermediário é igual ao CNPJ do prestador. Para efeitos desta regra comparar a raíz dos CNPJ (8 primeiros dígitos).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0262`
    - **Mensagem:** Na emissão da NFS-e não é permitido que o prestador do serviço seja igual ao intermediário do serviço.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `277` · E0264 · linha 280 · relação exata**
    - **Regra:** Se a DPS indicar retenção pelo intermediário (tpRetISSQN = 3), então o intermediário deve ser identificado por CNPJ ou CPF.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0264`
    - **Mensagem:** CNPJ ou CPF do intermediário não foi informado, mas existe uma indicação para retenção do ISSQN na DPS no campo de tipo de "Retenção do ISSQN".
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L168 — Campo `CPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 169
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Campo:** `CPF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `11`
- **Descrição:** Número da inscrição federal (CPF) do intermediário do serviço
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `279` · E0266 · linha 282 · relação exata**
    - **Regra:** CPF informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0266`
    - **Mensagem:** CPF do intermediário informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `280` · E0268 · linha 283 · relação exata**
    - **Regra:** CPF intermediário inexistente no cadastro CPF na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0268`
    - **Mensagem:** CPF do intermediário não encontrado no cadastro CPF.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `281` · E0272 · linha 284 · relação exata**
    - **Regra:** Para este CPF, se o emitente for o intermediário do serviço (tpEmit = 3), na data de competência informada na DPS o município emissor (cLocEmi) deve corresponder ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CPF + IM informados na DPS para o prestador devem existir no CNC NFS-e);
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0272`
    - **Mensagem:** CPF do emitente intermediário não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme cadastros CPF e CNC NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.


#### L169 — Campo `NIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 170
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Campo:** `NIF`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `40`
- **Descrição:** Número de identificação fiscal fornecido por órgão de administração tributária no exterior
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `282` · E0280 · linha 285 · relação exata**
    - **Regra:** Se o campo tpEmit for ígual a 3, então NIF do intermediário não pode ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0280`
    - **Mensagem:** O intermediário de serviço, quando emitente da DPS, não pode ser identificado pelo NIF.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `283` · E0281 · linha 286 · relação exata**
    - **Regra:** Se o grupo de informações de endereço no exterior do intermediário de serviços foi informado então o NIF ou cNaoNIF do intermediário deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0281`
    - **Mensagem:** O NIF ou cNaoNIF do intermediário deve ser informado quando o grupo de informações de endereço no exterior do intermediário de serviços foi informado.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L170 — Campo `cNaoNIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 171
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Campo:** `cNaoNIF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Motivo para não informação do NIF:<br><br>0 - Não informado na nota de origem;<br>1 - Dispensado do NIF;<br>2 - Não exigência do NIF;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Regras de negócio associadas:** 2

  - **RN `285` · E0284 · linha 288 · relação exata**
    - **Regra:** Se o campo tpEmit for ígual a 3, então cNaoNIF do intermediário não pode ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0284`
    - **Mensagem:** O intermediário de serviço, quando emitente da DPS, somente pode ser identificado pelo CNPJ ou CPF.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `286` · E0286 · linha 289 · relação exata**
    - **Regra:** Se o valor do campo cNaoNIF do intermediário, informado na DPS, for 0, então a DPS deve ser rejeitada.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0286`
    - **Mensagem:** Valor 0 para o motivo da não informação do NIF do intermediário não é permitido na Sefin do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L171 — Campo `CAEPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 172
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Campo:** `CAEPF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `14`
- **Descrição:** Número do Cadastro de Atividade Econômica da Pessoa Física (CAEPF).
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L172 — Campo `IM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 173
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Campo:** `IM`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `15`
- **Descrição:** Número do indicador municipal do intermediário do serviço
- **Notas explicativas:** -
- **Regras de negócio associadas:** 4

  - **RN `288` · E0287 · linha 291 · relação exata**
    - **Regra:** Se o emitente for o prestador de serviço (tpEmit = 3) e, se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então a IM deve ser informada na DPS.<br><br>Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço e o codigo do município emissor (cLocEmi), ambos informados na DPS, para identificar as ocorrências no CNC NFS-e. Se houver pelo menos uma ocorrência então o emitente da DPS deve informar o IM correspondente registrado no CNC NFS-e, que identifique unicamente o registro complementar.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0287`
    - **Mensagem:** A IM não foi informada para o emitente intermediário do serviço na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `289` · E0289 · linha 292 · relação exata**
    - **Regra:** Verificar se o IM informado na DPS está autorizado a emitir NFS-e na data de processamento desta DPS, se o emitente for o intermediário de serviço (tpEmit = 3) e, se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então a IM deve ser informada na DPS.<br><br>Utilizar o identificador federal (CNPJ ou CPF) do intermediário de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0289`
    - **Mensagem:** IM do emitente intermediário não está autorizado a emitir NFS-e, conforme informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `290` · E0290 · linha 293 · relação exata**
    - **Regra:** Se o emitente for o intermediário de serviço (tpEmit = 3) e, se não houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então o IM não deve ser informado na DPS.<br><br>Utilizar o identificador federal (CNPJ ou CPF) do intermediário de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0290`
    - **Mensagem:** IM do intermediário não deve ser informado, pois não existem informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `291` · E0288 · linha 294 · relação exata**
    - **Regra:** Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.<br><br>Para o emitente intermediário de serviço (tpEmit = 3), verificar se o IM informado nesta DPS está Inativo (cStat) no CNC do município emissor na data de competência informada.<br> <br>Se todos os registros complementares estiverem inativos, utilizar as informações dos cadastros RFB (CNPJ ou CPF), conforme identificador federal utilizado para identificar o emitente da DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0288`
    - **Mensagem:** O IM informado está inativo no CNC NFS-e do município emissor para a data de competência informada na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.


#### L173 — Campo `xNome`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 174
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Campo:** `xNome`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `150`
- **Descrição:** Nome / Nomer Empresarial do intermediário
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `292` · E0292 · linha 295 · relação exata**
    - **Regra:** Se NIF for preenchido então o campo xNome deve ser preenchido obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0292`
    - **Mensagem:** O nome intermediário deve ser preenchido obrigatoriamente quando o NIF do intermediário for preenchido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `-`; ADN / normal = `V`; ADN / `cStat=102` = `-`.
    - **Observações de negócio:** -


#### L174 — Campo `end`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 175
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Campo:** `end`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço do intermediário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L187 — Campo `fone`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 188
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Campo:** `fone`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `6-20`
- **Descrição:** Número do telefone do intermediário.<br>(Preencher com o Código DDD + número do telefone. <br>Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L188 — Campo `email`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 189
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Campo:** `email`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-80`
- **Descrição:** E-mail do intermediário.
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `309` · E0300 · linha 312 · relação exata**
    - **Regra:** Email deve ser informado conforme estrutura (conter @, ponto etc.).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0300`
    - **Mensagem:** Email inválido.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/interm/end/`

#### L175 — Campo `endNac`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 176
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Campo:** `endNac`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço nacional.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `294` · E1388 · linha 297 · relação exata**
    - **Regra:** Se o tpEmit é igual a 1 e o intermediário foi identificado pelo CNPJ, então o grupo de informações de endereço nacional do intermediário do serviço deve ser informado obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1388`
    - **Mensagem:** O endereço nacional do intermediário do serviço deve ser informado na DPS quando o intermediário for identificado pelo CNPJ.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `295` · E0291 · linha 298 · relação exata**
    - **Regra:** Se o emitente da DPS é o intermediário do serviço (tpEmit = 3), então o grupo de informações do endereço nacional do intermediário não deve ser informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0291`
    - **Mensagem:** O endereço nacional do intermediário do serviço não deve ser informado na DPS quando o próprio tomador do serviço for o emitente da DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `296` · E0293 · linha 299 · relação exata**
    - **Regra:** Se o valor do ISSQN deve ser retido pelo intermediário do serviço (tpRetISSQN = 3), então o grupo de informações do endereço nacional deve ser informado na DPS obrigatoriamente, exceto se o emitente da DPS é o intermediário do serviço (tpEmit = 3).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0293`
    - **Mensagem:** O endereço nacional do intermediário do serviço deve ser informado na DPS quando o valor do ISSQN for retido pelo intermediário, exceto se o emitente da DPS é o intermediário do serviço.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L178 — Campo `endExt`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 179
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Campo:** `endExt`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço no exterior.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `299` · E0298 · linha 302 · relação exata**
    - **Regra:** Se o NIF do intermediário de serviço foi informado e o emitente da DPS for identificado por CNPJ, então o grupo de informações de endereço no exterior do tomador do serviço deve ser informado obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0298`
    - **Mensagem:** O grupo de informações de endereço no exterior deve ser informado obrigatoriamente quando o intermediário for identificado pelo NIF e o emitente por CNPJ.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L183 — Campo `xLgr`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 184
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Campo:** `xLgr`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Tipo e nome do logradouro do endereço do intermediário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L184 — Campo `nro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 185
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Campo:** `nro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Número no logradouro do endereço do intermediário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L185 — Campo `xCpl`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 186
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Campo:** `xCpl`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-156`
- **Descrição:** Complemento do endereço do intermediário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L186 — Campo `xBairro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 187
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Campo:** `xBairro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Bairro do endereço do intermediário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/interm/end/endNac/`

#### L176 — Campo `cMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 177
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/endNac/`
- **Campo:** `cMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código do município do endereço do intermediário do serviço.<br> (Tabela do IBGE)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `297` · E0294 · linha 300 · relação exata**
    - **Regra:** O código do município informado para o endereço do intermediário do serviço não existe, conforme tabela de municípios do IBGE.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0294`
    - **Mensagem:** O código do município informado na DPS para o endereço do intermediário do serviço não existe conforme tabela de município do IBGE.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L177 — Campo `CEP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 178
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/endNac/`
- **Campo:** `CEP`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP) <br> do endereço do intermediário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `298` · E0296 · linha 301 · relação exata**
    - **Regra:** O CEP informado deve existir e pertencer ao município correspondente ao código do município informado para o endereço do intermediário do serviço.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0296`
    - **Mensagem:** O CEP informado para o endereço nacional do intermediário do serviço não existe ou não pertence ao município do endereço do intermediário.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/`

#### L179 — Campo `cPais`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 180
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/`
- **Campo:** `cPais`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Código do país do endereço do prestador do intermediário do serviço.<br> (Tabela de Países ISO)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `300` · E0299 · linha 303 · relação exata**
    - **Regra:** O código de país informado para o endereço no exterior do intermediário do serviço deve existir e ser diferente de Brasil (BR), conforme a tabela ISO2.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0299`
    - **Mensagem:** O código de país informado para o endereço no exterior do intermediário do serviço não existe ou é igual ao código do Brasil. Informe um código de país existente e diferente do codigo do Brasil (BR) para o endereço no exterior do intermediário do serviço, conforme tabela de país do ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe-ESPEC.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L180 — Campo `cEndPost`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 181
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/`
- **Campo:** `cEndPost`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-11`
- **Descrição:** Código alfanumérico do Endereçamento Postal no exterior do intermediário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L181 — Campo `xCidade`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 182
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/`
- **Campo:** `xCidade`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Nome da cidade no exterior do intermediário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L182 — Campo `xEstProvReg`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 183
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/`
- **Campo:** `xEstProvReg`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Estado, província ou região da cidade no exterior do intermediário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/`

#### L190 — Campo `locPrest`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 191
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/`
- **Campo:** `locPrest`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas ao local da prestação do serviço
- **Notas explicativas:** OBS: As operações de exploração de vias (ou rodovias) no campo de incidência do ISSQN (subitem 22.01 da lista de serviço do Sistema Nacional NFS-e) serão formalizadas pela "NFS-e Via", Nota Fiscal de Serviço eletrônica de Exploração de Via, que terá um layout específico a ser publicado em breve.<br><br> <br> Para atender o dispositivo do Art 3º, § 3º,<br> (Considera-se ocorrido o fato gerador do imposto no local do estabelecimento prestador nos serviços executados em águas marítimas, excetuados os serviços descritos no subitem 20.01)<br> o Sistema Nacional NFS-e "Águas Marítimas" como uma localidade de prestação de serviço, assim como qualquer município brasileiro.<br> <br> cLocPrestacao poderá assumir: qualquer código que represente um município da tabela de códigos de municípios do IBGE, qualquer código quer represente um trecho de concessão de exploração de rodovias do cadastro próprio do Sistema Nacional NFS-e ou 0000000, que representa "Águas Marítimas".
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L193 — Campo `cServ`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 194
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/`
- **Campo:** `cServ`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas ao código do serviço prestado
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L199 — Campo `comExt`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 200
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/`
- **Campo:** `comExt`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações sobre transações entre residentes ou domiciliados no Brasil com residentes ou domiciliados no exterior
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `326` · E0330 · linha 329 · relação exata**
    - **Regra:** EXPORTAÇÃO DE SERVIÇO<br><br>Se o emitente for o prestador (tpEmit = 1), e qualquer um dos campos abaixo for informado na DPS <br><br>País no exterior do endereço do tomador do serviço,<br>País no exterior do endereço do intermediário do serviço ou<br>cPaisPrestacao é informado ou <br>tribISSQN for Exportação de serviço (tribISSQN = 3),<br><br>então o grupo de informações de comércio exterior devem ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0330`
    - **Mensagem:** É obrigatório prestar informações de comércio exterior para as situações de exportação de serviços.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `327` · E0331 · linha 330 · relação exata**
    - **Regra:** IMPORTAÇÃO DE SERVIÇO <br><br>Se o emitente for o tomador (tpEmit = 2) ou o intermediário de serviço (tpEmit = 3),  e qualquer um dos campos abaixo for informado na DPS<br><br>País no exterior do endereço do prestador do serviço ou<br>cPaisPrestacao é informado,<br><br>então o grupo de informações de comércio exterior devem ser informados.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0331`
    - **Mensagem:** É obrigatório prestar informações de comércio exterior para as situações de importação de serviços.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.


#### L224 — Campo `atvEvento`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 225
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/`
- **Campo:** `atvEvento`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas à atividades de eventos
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `357` · E0390 · linha 360 · relação exata**
    - **Regra:** Se o código de tributação nacional pertencer ao item 12 da lista de serviços, então o grupo de informações de Atividade/Evento é obrigatório.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0390`
    - **Mensagem:** O grupo de informações de Atividade/Evento é obrigatório quando o código de tributação nacional pertencer ao item 12 da lista de serviços.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `358` · E0392 · linha 361 · relação exata**
    - **Regra:** Se o código de tributação nacional não pertencer ao item 12 da lista de serviços, então o grupo de informações de Atividade/Evento não é permitido.<br>*Exceção: O grupo de informações de Atividade/Evento pode ser informado se o código de tributação nacional for o 99.01.01.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0392`
    - **Mensagem:** O grupo de informações de Atividade/Evento não é permitido quando o código de tributação nacional não pertencer ao item 12 da lista de serviços, com exceção do código 99.01.01.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/locPrest/`

#### L191 — Campo `cLocPrestacao`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 192
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/locPrest/`
- **Campo:** `cLocPrestacao`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código da localidade da prestação do serviço.
- **Notas explicativas:** —
- **Regras de negócio associadas:** 2

  - **RN `312` · E0302 · linha 315 · relação exata**
    - **Regra:** Se informado, o código do município deve existir na tabela de municípios do IBGE ou possuir a codificação 0000000, que representa "Águas Marítimas".
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0302`
    - **Mensagem:** O código do local da prestação do serviço não existe conforme a tabela de municípios IBGE disponibilizada no ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `313` · E1402 · linha 316 · relação exata**
    - **Regra:** Se informado o subitem 200101 para o código de tributação nacional (cTribNac), <br>então não é permitido informar 0000000, que representa "Águas Marítimas", para o local de prestação do serviço (cLocPrestacao).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1402`
    - **Mensagem:** Quando é informado o subitem 200101 para o código de tributação nacional (cTribNac), não é permitido informar 0000000, que representa "Águas Marítimas", para o local de prestação do serviço (cLocPrestacao).
    - **Nível da regra:** `—`
    - **Execução:** Público / normal = `X`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** Para atender o dispositivo do Art 3º, § 2º,<br>(No caso dos serviços a que se refere o subitem 22.01 da lista anexa, considera-se ocorrido o fato gerador e devido o imposto em cada Município em cujo território haja extensão de rodovia explorada.)<br>o Sistema Nacional NFS-e considera o trecho de concessão de exploração de rodovia como uma localidade de prestação de serviço, assim como qualquer município brasileiro.<br><br>Para atender o dispositivo do Art 3º, § 3º,<br>(Considera-se ocorrido o fato gerador do imposto no local do estabelecimento prestador nos serviços executados em águas marítimas, excetuados os serviços descritos no subitem 20.01)<br>o Sistema Nacional NFS-e "Águas Marítimas" como uma localidade de prestação de serviço, assim como qualquer município brasileiro.<br><br>cLocPrestacao poderá assumir: qualquer código que represente um município da tabela de códigos de municípios do IBGE, qualquer código quer represente um trecho de concessão de exploração de rodovias do cadastro próprio do Sistema Nacional NFS-e ou 0000000, que representa "Águas Marítimas".


#### L192 — Campo `cPaisPrestacao`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 193
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/locPrest/`
- **Campo:** `cPaisPrestacao`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Código do país onde ocorreu a prestação do serviço.<br>(Tabela de Países ISO)
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `314` · E0304 · linha 317 · relação exata**
    - **Regra:** Se informado, o código do país deve existir na tabela de país ISO2 e ser diferente de Brasil (BR).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0304`
    - **Mensagem:** Informe um código de país existente e diferente de Brasil (BR), conforme tabela de país do ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe-ESPEC.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/cServ/`

#### L194 — Campo `cTribNac`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 195
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Campo:** `cTribNac`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `6`
- **Descrição:** Código de tributação nacional do ISSQN, nos termos da LC 116/2003, Conforme aba MUN.INCID_INFO.SERV. do ANEXO I
- **Notas explicativas:** Para o caso de serviço prestado em "Águas Marítimas" o seviço informado nunca poderá ser 20.01
- **Regras de negócio associadas:** 2

  - **RN `316` · E0310 · linha 319 · relação exata**
    - **Regra:** Verificar se o código de tributação nacional informado existe conforme a lista de serviços nacional do Sistema Nacional NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0310`
    - **Mensagem:** O código de tributação nacional informado não existe<br>conforme a lista de serviços nacional do Sistema Nacional NFS-e.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `317` · E0312 · linha 320 · relação exata**
    - **Regra:** Verificar se o código de tributação nacional informado está administrado pelo município de incidência do ISSQN na data de competência informada na DPS, conforme a lista de serviços nacional do Sistema Nacional NFS-e.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0312`
    - **Mensagem:** O código de tributação nacional informado não está administrado pelo município de incidência do ISSQN na data de competência informada na DPS, <br>conforme a lista de serviços nacional do Sistema Nacional NFS-e.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L195 — Campo `cTribMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 196
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Campo:** `cTribMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `3`
- **Descrição:** Código de tributação municipal do ISSQN.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `318` · E0314 · linha 321 · relação exata**
    - **Regra:** Verificar se o código de tributação municipal informado existe e está administrado pelo município de incidência do ISSQN na data de competência informada na DPS.<br><br>Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0314`
    - **Mensagem:** O código de tributação municipal informado não existe ou não está administrado pelo município de incidência do ISSQN na data de competência informada na DPS,
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `319` · E0315 · linha 322 · relação exata**
    - **Regra:** Não é permitido informar 000 para o codigo de tributação municipal na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0315`
    - **Mensagem:** Não é permitido informar 000 para o codigo de tributação municipal na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L196 — Campo `xDescServ`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 197
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Campo:** `xDescServ`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1000`
- **Descrição:** Descrição completa do serviço prestado
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L197 — Campo `cNBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 198
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Campo:** `cNBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `9`
- **Descrição:** Código NBS correspondente ao serviço prestado, seguindo a versão 2.0, conforme Anexo B.
- **Notas explicativas:** NBS - Nomenclatura Brasileira de Serviços, Intangíveis e outras Operações que produzam Variações no Patrimônio
- **Regras de negócio associadas:** 4

  - **RN `321` · E0316 · linha 324 · relação exata**
    - **Regra:** O código da lista NBS informado na DPS não existe, conforme tabela NBS do ANEXO_B-NBS2-LISTA_SERVICO_NACIONAL-SNNFSe do Manual Integrado do Sistema Nacional NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0316`
    - **Mensagem:** Código da lista NBS informado inexistente tabela de NBS do sistema.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `322` · E0318 · linha 325 · relação exata**
    - **Regra:** Se o emitente for o prestador (tpEmit = 1) e qualquer um dos campos abaixo for informado na DPS,<br><br>País no exterior do endereço do tomador do serviço ou<br>País no exterior do endereço do intermediário do serviço ou<br>cPaisPrestacao é informado,<br><br>então é obrigatório informar na DPS um  item da NBS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0318`
    - **Mensagem:** É obrigatório informar na DPS um item da NBS para casos de exportação de serviço.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `323` · E0320 · linha 326 · relação exata**
    - **Regra:** Se o emitente for o tomador (tpEmit = 2) ou o intermediário de serviço (tpEmit = 3), e qualquer um dos campos abaixo for informado na DPS<br><br>País no exterior do endereço do prestador do serviço ou<br>cPaisPrestacao é informado,<br><br>então é obrigatório informar na DPS um item da NBS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0320`
    - **Mensagem:** É obrigatório informar na DPS um item da NBS para casos de importação de serviço.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `324` · E0322 · linha 327 · relação exata**
    - **Regra:** Se o bloco de informações de IBS/CBS (NFSe/infNFSe/DPS/infDPS/IBSCBS) for informado na DPS, então é obrigatório informar na DPS um item da NBS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0322`
    - **Mensagem:** É obrigatório informar na DPS um item da NBS se for declarada qualquer informação de IBS/CBS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L198 — Campo `cIntContrib`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 199
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Campo:** `cIntContrib`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `20`
- **Descrição:** Código interno do contribuinte
- **Notas explicativas:** Utilizado para identificação da DPS no Sistema interno do Contribuinte
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/comExt/`

#### L200 — Campo `mdPrestacao`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 201
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Campo:** `mdPrestacao`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Modo de Prestação:<br><br>0 - Desconhecido (tipo não informado na nota de origem);<br>1 - Transfronteiriço;<br>2 - Consumo no Brasil;<br>3 - Movimento Temporário de Pessoas Físicas;<br>4 - Consumo no Exterior;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Regras de negócio associadas:** 1

  - **RN `328` · E0333 · linha 331 · relação exata**
    - **Regra:** Se o valor do campo mdPrestacao for 0, então a DPS deve ser rejeitada.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0333`
    - **Mensagem:** Valor 0 para o modo de prestação não é permitido na Sefin do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L201 — Campo `vincPrest`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 202
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Campo:** `vincPrest`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Vínculo entre as partes no negócio:<br><br>0 - Sem vínculo com o Tomador/Prestador<br>1 - Controlada;<br>2 - Controladora;<br>3 - Coligada;<br>4 - Matriz;<br>5 - Filial ou sucursal;<br>6 - Outro vínculo;<br>9 - Desconhecido (tipo não informado na nota de origem);
- **Notas explicativas:** Adicionar ao Hint do campo: O adquirente/ Prestador do serviço é pessoa considerada vinculada ao prestador/ adquirente, nos termos do art. 23 da Lei nº 9.430, de 1996
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L202 — Campo `tpMoeda`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 203
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Campo:** `tpMoeda`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `3`
- **Descrição:** Identifica a moeda da transação comercial. <br>O usuário deve informar o código da moeda.
- **Notas explicativas:** inclusão, no Emissor Público, da tabela de moedas do Banco Central do Brasil para seleção pelo emitente da NFS-e. <br>No Painel Nacional deverá haver função para atualização da tabela de Moedas.
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L203 — Campo `vServMoeda`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 204
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Campo:** `vServMoeda`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor do serviço prestado expresso em moeda estrangeira especificada em tpmoeda.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L204 — Campo `mecAFComexP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 205
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Campo:** `mecAFComexP`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Mecanismo de apoio/fomento ao Comércio Exterior utilizado pelo prestador do serviço:<br><br>00 - Desconhecido (tipo não informado na nota de origem);<br>01 - Nenhum;<br>02 - ACC - Adiantamento sobre Contrato de Câmbio – Redução a Zero do IR e do IOF;<br>  03 - ACE – Adiantamento sobre Cambiais Entregues - Redução a Zero do IR e do IOF;<br>04 - BNDES-Exim Pós-Embarque – Serviços;<br> 05 - BNDES-Exim Pré-Embarque - Serviços;<br>  06 - FGE - Fundo de Garantia à Exportação;<br>07 - PROEX - EQUALIZAÇÃO<br> 08 - PROEX - Financiamento;
- **Notas explicativas:** Campo disponível na nota do prestador.<br><br>O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Regras de negócio associadas:** 1

  - **RN `332` · E0341 · linha 335 · relação exata**
    - **Regra:** Se o valor do campo mecAFComexP for 0, então a DPS deve ser rejeitada.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0341`
    - **Mensagem:** Valor 0 para o Mecanismo de apoio/fomento ao Comércio Exterior utilizado pelo prestador do serviço não é permitido na Sefin do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L205 — Campo `mecAFComexT`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 206
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Campo:** `mecAFComexT`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Mecanismo de apoio/fomento ao Comércio Exterior utilizado pelo tomador do serviço:<br><br>00 - Desconhecido (tipo não informado na nota de origem);<br>01 - Nenhum;<br>02 - Adm. Pública e Repr. Internacional;<br>03 - Alugueis e Arrend. Mercantil de maquinas, equip., embarc. e aeronaves;<br>04 - Arrendamento Mercantil de aeronave para empresa de transporte aéreo público;<br>05 - Comissão a agentes externos na exportação;<br>06 - Despesas de armazenagem, mov. e transporte de carga no exterior;<br>07 - Eventos FIFA (subsidiária);<br>08 - Eventos FIFA;<br>09 - Fretes, arrendamentos de embarcações ou aeronaves e outros;<br>10 - Material Aeronáutico;<br>11 - Promoção de Bens no Exterior;<br>12 - Promoção de Dest. Turísticos Brasileiros;<br>13 - Promoção do Brasil no Exterior;<br>14 - Promoção Serviços no Exterior;<br>15 - RECINE;<br>16 - RECOPA;<br>17 - Registro e Manutenção de marcas, patentes e cultivares;<br>18 - REICOMP;<br>19 - REIDI;<br>20 - REPENEC;<br>21 - REPES;<br>22 - RETAERO; <br>23 - RETID;<br>24 - Royalties, Assistência Técnica, Científica e Assemelhados;<br>25 - Serviços de avaliação da conformidade vinculados aos Acordos da OMC;<br>26 - ZPE;
- **Notas explicativas:** Campo disponível na nota do tomador.<br><br>O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Regras de negócio associadas:** 1

  - **RN `333` · E0343 · linha 336 · relação exata**
    - **Regra:** Se o valor do campo mecAFComexT for 0, então a DPS deve ser rejeitada.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0343`
    - **Mensagem:** Valor 0 para o Mecanismo de apoio/fomento ao Comércio Exterior utilizado pelo tomador do serviço não é permitido na Sefin do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L206 — Campo `movTempBens`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 207
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Campo:** `movTempBens`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Vínculo da Operação à Movimentação Temporária de Bens:<br><br>0 - Desconhecido (tipo não informado na nota de origem);<br>1 - Não;<br>2 - Vinculada - Declaração de Importação;<br>3 - Vinculada - Declaração de Exportação;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Regras de negócio associadas:** 1

  - **RN `334` · E0345 · linha 337 · relação exata**
    - **Regra:** Se o valor do campo movTempBens for 0, então a DPS deve ser rejeitada.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0345`
    - **Mensagem:** Valor 0 para o Vínculo da Operação à Movimentação Temporária de Bens não é permitido na Sefin do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L207 — Campo `nDI`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 208
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Campo:** `nDI`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-12`
- **Descrição:** Número da Declaração de Importação (DI/DSI/DA/DRI-E) averbado.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `335` · E0352 · linha 338 · relação exata**
    - **Regra:** Se movTempBens = 2, então o preenchimento de nDI é obrigatório
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0352`
    - **Mensagem:** O preenchimento do campo nDI (Número da Declaração de Importação) é obrigatório quando o campo (movTempBens) Vínculo da Operação à Movimentação Temporária de Bens for igual a 2.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `336` · E0354 · linha 339 · relação exata**
    - **Regra:** Se movTempBens = 1, então o preenchimento de nDI e nRE não é permitido
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0354`
    - **Mensagem:** O preenchimento dos campos nDI (Número da Declaração de Importação) ou do nRE (úmero do Registro de Exportação) não é permitido quando o campo (movTempBens) Vínculo da Operação à Movimentação Temporária de Bens for igual a 1.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L208 — Campo `nRE`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 209
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Campo:** `nRE`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `12`
- **Descrição:** Número do Registro de Exportação (RE) averbado.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `338` · E0356 · linha 341 · relação exata**
    - **Regra:** Se movTempBens = 3, então o preenchimento de nRE é obrigatório
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0356`
    - **Mensagem:** O preenchimento do campo nRE (úmero do Registro de Exportação) é obrigatório quando o campo (movTempBens) Vínculo da Operação à Movimentação Temporária de Bens for igual a 3.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L209 — Campo `mdic`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 210
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Campo:** `mdic`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Indicador se a NFS-e deverá ser disponibilizada ao MDIC.<br><br>0 - Não enviar para o MDIC;<br>1 - Enviar para o MDIC;
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv`

#### L210 — Campo `obra`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 211
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv`
- **Campo:** `obra`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas à obras de construção civil e congêneres
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `340` · E0370 · linha 343 · relação exata**
    - **Regra:** Se o código de tributação nacional pertencer a um dos subitens, 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01, 07.19.01, 14.14.03 e 14.14.04 da lista de serviços, então o grupo de informações de obra é obrigatório.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0370`
    - **Mensagem:** O grupo de informações de obra é obrigatório quando o código de tributação nacional pertencer a um dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01, 07.19.01, 1414.03 e 14.14.04 da lista de serviços.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `341` · E0372 · linha 344 · relação exata**
    - **Regra:** Se o código de tributação nacional não pertencer a algum dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01, 07.19.01, 14.14.03 e 14.14.04 da lista de serviços, então o grupo de informações de obra não é permitido.<br>*Exceção: O grupo de informações de obra pode ser informado se o código de tributação nacional for o 99.01.01.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0372`
    - **Mensagem:** O grupo de informações de obra não é permitido quando o código de tributação nacional não pertencer a algum dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01, 07.19.01, 1414.03 e 14.14.04 da lista de serviços, com exceção do código 99.01.01.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L239 — Campo `infoCompl`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 240
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv`
- **Campo:** `infoCompl`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações complementares disponível para todos os serviços prestados
- **Notas explicativas:** Campos possíveis de preenchimento na DPS para todos os subitens da lista de serviços que forem prestados
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/obra/`

#### L211 — Campo `inscImobFisc`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 212
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/`
- **Campo:** `inscImobFisc`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-30`
- **Descrição:** Inscrição imobiliária fiscal <br>(código fornecido pela prefeitura para a identificação da obra ou para fins de recolhimento do IPTU)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L212 — Campo `cObra`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 213
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/`
- **Campo:** `cObra`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-30`
- **Descrição:** Número de identificação da obra.<br>Cadastro Nacional de Obras (CNO) ou Cadastro Específico do INSS (CEI).
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L213 — Campo `cCIB`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 214
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/`
- **Campo:** `cCIB`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Código do Cadastro Imobiliário Brasileiro - CIB
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `344` · E0373 · linha 347 · relação exata**
    - **Regra:** Código do Cadastro Imobiliário Brasileito - CIB deve ser um código válido - 7 caracteres + DV
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0373`
    - **Mensagem:** Código CIB inválido.
    - **Nível da regra:** `-`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L214 — Campo `end`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 215
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/`
- **Campo:** `end`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço da obra.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`

#### L215 — Campo `CEP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 216
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Campo:** `CEP`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Código de Endereçamento Postal numérico do endereço nacional da obra.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `346` · E0380 · linha 349 · relação exata**
    - **Regra:** O CEP a ser informa para endereço da obra deve pertencer ao município que foi informado como local da prestação do serviço.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0380`
    - **Mensagem:** Informe um CEP correspondente ao município do local da prestação do serviço informado nesta DPS para indicar corretamente o endereço da obra.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `347` · E0382 · linha 350 · relação exata**
    - **Regra:** Se o pais da prestação do serviço de obra foi informado (cPaisPrestacao foi informado), então o CEP não pode ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0382`
    - **Mensagem:** O CEP não deve ser informado quando o endereço da obra ocorrer no exterior do país.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L216 — Campo `endExt`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 217
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Campo:** `endExt`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações descritivas do endereço no exterior da obra.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `348` · E0384 · linha 351 · relação exata**
    - **Regra:** Se o pais local da prestação do serviço de obra foi informado (cPaisPrestacao foi informado), então o grupo de informações de endereço no exterior deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0384`
    - **Mensagem:** O grupo de informações de endereço da atividade de obra ocorrido no exterior deve ser informado quando o país do local da prestação for informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `349` · E0386 · linha 352 · relação exata**
    - **Regra:** Se o município local da prestação do serviço de obra foi informado (cMunPrestacao foi informado), então o grupo de informações de endereço no exterior não pode ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0386`
    - **Mensagem:** O grupo de informações de endereço da atividade de obra ocorrido no exterior não deve ser informado quando o município do local da prestação for informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L220 — Campo `xLgr`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 221
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Campo:** `xLgr`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Tipo e nome do logradouro do endereço da obra.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L221 — Campo `nro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 222
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Campo:** `nro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Número no logradouro do endereço da obra.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L222 — Campo `xCpl`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 223
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Campo:** `xCpl`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-156`
- **Descrição:** Complemento do endereço da obra.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L223 — Campo `xBairro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 224
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Campo:** `xBairro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Bairro do endereço da obra.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/`

#### L217 — Campo `cEndPost`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 218
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/`
- **Campo:** `cEndPost`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-11`
- **Descrição:** Código de Endereçamento Postal alfanumérico do endereço no exterior da obra.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L218 — Campo `xCidade`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 219
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/`
- **Campo:** `xCidade`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Nome da cidade no exterior, local da obra.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L219 — Campo `xEstProvReg`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 220
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/`
- **Campo:** `xEstProvReg`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Estado, província ou região da cidade no exterior, local da obra.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`

#### L225 — Campo `xNome`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 226
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`
- **Campo:** `xNome`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `255`
- **Descrição:** Nome do evento Artístico, Cultural, Esportivo, ...
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L226 — Campo `dtIni`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 227
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`
- **Campo:** `dtIni`
- **ELE:** `E`
- **TIPO:** `D`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Data de início da atividade de evento.<br>Ano, Mês e Dia (AAAA-MM-DD)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L227 — Campo `dtFim`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 228
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`
- **Campo:** `dtFim`
- **ELE:** `E`
- **TIPO:** `D`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Data de fim da atividade de evento.<br>Ano, Mês e Dia (AAAA-MM-DD)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L228 — Campo `idAtvEvt`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 229
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`
- **Campo:** `idAtvEvt`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-30`
- **Descrição:** Identificação da Atividade de Evento <br>(código identificador de evento determinado pela Administração Tributária Municipal)
- **Notas explicativas:** Choice com o grupo de endereço da atividade de evento
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L229 — Campo `end`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 230
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`
- **Campo:** `end`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço da atividade de evento.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`

#### L230 — Campo `CEP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 231
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Campo:** `CEP`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Código de Endereçamento Postal numérico do endereço nacional da atividade de evento.
- **Notas explicativas:** —
- **Regras de negócio associadas:** 2

  - **RN `364` · E0398 · linha 367 · relação exata**
    - **Regra:** Se o município local da prestação da atividade de evento foi informado (cMunPrestacao foi informado), então o CEP deve ser informado e pertencer a este município.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0398`
    - **Mensagem:** Informe um CEP correspondente ao município do local da prestação do serviço informado nesta DPS para indicar corretamente o endereço da atividade ou evento.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `365` · E0400 · linha 368 · relação exata**
    - **Regra:** Se o pais local da prestação da atividade de evento foi informado (cPaisPrestacao foi informado), então o CEP não deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0400`
    - **Mensagem:** O CEP não deve ser informado quando o endereço da atividade de evento ocorrer no exterior do país.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L231 — Campo `endExt`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 232
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Campo:** `endExt`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações descritivas do endereço no exterior da atividade de evento.
- **Notas explicativas:** —
- **Regras de negócio associadas:** 2

  - **RN `366` · E0402 · linha 369 · relação exata**
    - **Regra:** Se o pais da prestação da atividade de evento foi informado (cPaisPrestacao foi informado), então o grupo de informações do endereço no exterior deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0402`
    - **Mensagem:** O grupo de informações de endereço da atividade de evento ocorrido no exterior deve ser informado quando o país do local da prestação for informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `367` · E0404 · linha 370 · relação exata**
    - **Regra:** Se o município local da prestação da atividade de evento foi informado (cMunPrestacao foi informado), então o grupo de informações  do endereço no exterior não deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0404`
    - **Mensagem:** O grupo de informações de endereço da atividade de evento ocorrido no exterior não deve ser informado quando o município do local da prestação for informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L235 — Campo `xLgr`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 236
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Campo:** `xLgr`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Tipo e nome do logradouro do endereço da atividade de evento.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L236 — Campo `nro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 237
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Campo:** `nro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Número no logradouro do endereço da atividade de evento.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L237 — Campo `xCpl`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 238
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Campo:** `xCpl`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-156`
- **Descrição:** Complemento do endereço da atividade de evento.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L238 — Campo `xBairro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 239
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Campo:** `xBairro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Bairro do endereço da atividade de evento.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/`

#### L232 — Campo `cEndPost`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 233
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/`
- **Campo:** `cEndPost`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `11`
- **Descrição:** Código de Endereçamento Postal alfanumérico do endereço no exterior da atividade de evento.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L233 — Campo `xCidade`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 234
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/`
- **Campo:** `xCidade`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Nome da cidade no exterior, local da atividade de evento.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L234 — Campo `xEstProvReg`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 235
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/`
- **Campo:** `xEstProvReg`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Estado, província ou região da cidade no exterior, local da atividade de evento.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`

#### L240 — Campo `idDocTec`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 241
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`
- **Campo:** `idDocTec`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-40`
- **Descrição:** Identificador de Documento de Responsabilidade Técnica:<br>ART, RRT, DRT, Outros.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L241 — Campo `docRef`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 242
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`
- **Campo:** `docRef`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-255`
- **Descrição:** Chave da nota, número identificador da nota, número do contrato ou outro identificador de documento emitido pelo prestador de serviços, que subsidia a emissão dessa nota pelo tomador do serviço ou intermediário (preenchimento obrigatório caso a nota esteja sendo emitida pelo Tomador ou intermediário do serviço).
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `377` · E0420 · linha 380 · relação inferida**
    - **Regra:** Quando o emitente da DPS for o tomador ou o intermediário do serviço (tpEmit = 2  ou 3, respectivamente) este campo deve ser obrigatoriamente informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0420`
    - **Mensagem:** O documento de referência deve ser obrigatoriamente informado quando o emitente da DPS for o tomador ou intermediário do serviço.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/infDPS/serv/`, campo `docRef`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


#### L242 — Campo `xPed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 243
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`
- **Campo:** `xPed`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-60`
- **Descrição:** Número do  pedido/ordem de compra/ordem de serviço/projeto que autorize a prestação do serviço em<br>operações B2B - Informação de interesse do tomador do serviço para controle e gestão da<br>Negociação
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L243 — Campo `gItemPed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 244
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`
- **Campo:** `gItemPed`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de itens do pedido/ordem de compra/ordem de serviço/projeto.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L245 — Campo `xInfComp`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 246
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`
- **Campo:** `xInfComp`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `2000`
- **Descrição:** Campo livre para preenchimento pelo contribuinte.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/gItemPed/`

#### L244 — Campo `xItemPed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 245
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/gItemPed/`
- **Campo:** `xItemPed`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-99`
- **Tamanho:** `1-60`
- **Descrição:** Número do item do  pedido/ordem de compra/ordem de serviço/projeto - Identificação do número do item do<br>pedido ou ordem de compra destacado e xPed
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/`

#### L247 — Campo `vServPrest`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 248
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/`
- **Campo:** `vServPrest`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas aos valores do serviço prestado
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L250 — Campo `vDescCondIncond`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 251
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/`
- **Campo:** `vDescCondIncond`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas aos descontos condicionados e incondicionados
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L253 — Campo `vDedRed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 254
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/`
- **Campo:** `vDedRed`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas ao valores para dedução/redução do valor da base de cálculo (valor do serviço)
- **Notas explicativas:** Aqui referenciadas as deduções/reduções que serão consideradas apenas para a Base de Cálculo do ISSQN.
- **Regras de negócio associadas:** 7

  - **RN `393` · E0435 · linha 396 · relação exata**
    - **Regra:** Não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução para o ISSQN quando ocorrer "Imunidade" (tribISSQN = 2), "Exportação de serviço" (tribISSQN = 3) ou "Não incidência" (tribISSQN = 4), ou seja, tpRetISSQN tem que ser igual a 1 (tpRetISSQN = 1).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0435`
    - **Mensagem:** Não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução do ISSQN quando ocorrer Imunidade, Exportação do serviço ou Não incidência.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `394` · E0436 · linha 397 · relação exata**
    - **Regra:** Não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução para o ISSQN quando o prestador do serviço é MEI (opSimpNac = 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0436`
    - **Mensagem:** Não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução do ISSQN quando o prestador de serviço é MEI.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `395` · E0438 · linha 398 · relação exata**
    - **Regra:** Não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução para o ISSQN, quando o prestador de serviço tiver um regime especial de tributação, ou seja, o campo que indica o regime especial de tributação é diferente de 0, (regEspTrib = 1, 2, 3, 4, 5, 6 ou 9).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0438`
    - **Mensagem:** Não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução do ISSQN, quando o prestador de serviço tiver algum regime especial de tributação.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `396` · E0439 · linha 399 · relação exata**
    - **Regra:** Não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução para o ISSQN, quando o benefício municipal informado na DPS for do tipo "Isenção".
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0439`
    - **Mensagem:** Não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução do ISSQN, quando o benefício municipal informado na DPS for do tipo "Isenção".
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `397` · E0440 · linha 400 · relação exata**
    - **Regra:** Se o prestador de serviço não for optante do Simples Nacional (opSimpNac = 1) e a situação do convênio do município de incidência do ISSQN no Sistema Nacional NFS-e for "Ativo", então o sistema permite informações de dedução/redução, conforme admissões dos tipos de dedução/redução nas parametrizações dos respectivos códigos de serviço administrado pelo municipio de incidência do ISSQN no Sistema Nacional NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0440`
    - **Mensagem:** O tipo de dedução/redução informado na DPS não é permitida pelo município de incidência do ISSQN, conforme parametrizações do código de serviço do município de incidência.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `398` · E0441 · linha 401 · relação exata**
    - **Regra:** Se o prestador do serviço é ME/EPP (opSimpNac = 3), o regime de apuração ocorre pelo SN (regApTribSN = 1) e o municipio de incidência está "Ativo", <br>então não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução, <br>exceto quando o código de tributação nacional (cTribNac) corresponder aos subitens:<br>042201, 042301, 050901, 060101, 060201, 070201, 070202, 070501 ,070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.<br><br>Neste cenário, o sistema verifica a parametrização e permite o preenchimento das informações conforme admissões dos tipos de dedução/redução nas parametrizações destes respectivos códigos de serviço acima listados, administradas pelo municipio de incidência do ISSQN no Sistema Nacional NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0441`
    - **Mensagem:** Não é permitido o preenchimento de informações relativas à Dedução/Redução para o prestador de serviço ME/EPP, apurando pelo SN conforme parametrização do código de serviço admnistrado pelo municipio de incidência do ISSQN.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `399` · E0442 · linha 402 · relação exata**
    - **Regra:** Se o prestador do serviço é ME/EPP (opSimpNac = 3), o regime de apuração ocorre pelo SN (regApTribSN = 1) e o municipio de incidência não está "Ativo", <br>então não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução, <br>exceto quando o código de tributação nacional (cTribNac) corresponder aos subitens:<br>042201, 042301, 050901, 060101, 060201, 070201, 070202, 070501 ,070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0442`
    - **Mensagem:** O tipo de dedução/redução informado na DPS não é permitida para o prestador de serviço ME/EPP, apurando pelo SN.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L298 — Campo `trib`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 299
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/`
- **Campo:** `trib`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relacionados aos tributos relacionados ao serviço prestado
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vServPrest/`

#### L248 — Campo `vReceb`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 249
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vServPrest/`
- **Campo:** `vReceb`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário recebido pelo intermediário do serviço (R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `384` · E0423 · linha 387 · relação exata**
    - **Regra:** O valor recebido deve ser informado na DPS quando o intermediário do serviço for o emitente da DPS (tpEmit = 3).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0423`
    - **Mensagem:** O valor recebido deve ser informado na DPS quando o intermediário do serviço for o emitente da DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `385` · E0424 · linha 388 · relação exata**
    - **Regra:** O valor recebido não deve ser informado na DPS quando o prestador ou tomador do serviço for o emitente da DPS <br>(tpEmit = 1 ou tpEmit = 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0424`
    - **Mensagem:** O valor recebido não deve ser informado na DPS quando o prestador ou tomador do serviço for o emitente da DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `386` · E0425 · linha 389 · relação exata**
    - **Regra:** O valor recebido não pode ser menor que o valor do serviço informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0425`
    - **Mensagem:** O valor recebido não pode ser menor que o valor do serviço informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L249 — Campo `vServ`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 250
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vServPrest/`
- **Campo:** `vServ`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário do serviço (R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `387` · E0427 · linha 390 · relação exata**
    - **Contexto compartilhado da coluna D:** vDR é:<br>um valor informado pelo emitente para dedução/redução da BC do ISSQN;<br><br>vCalcDR é:<br>o cálculo do valor de dedução/redução da BC do ISSQN:<br><br>1) Quando o valor de dedução/redução for apurado a partir de um percentual informado na DPS, calcular este percentual sobre o valor do serviço já abatido o valor do desconto incondicionado.<br>Ex: <br>Valor de dedução/redução = (Valor do serviço - valor desconto incodicional) x <br>% de dedução/redução.<br><br>VServ >= desconto incondicionado + Valor de dedução/redução<br><br>2) Quando um ou mais documentos são informados pelo emitente na DPS para dedução/redução da BC do ISSQN. <br>Neste caso o resultado do somatório é o valor deste campo do leiaute NFS-e;<br><br>---------------------------<br><br>vInfoBM é:<br>um valor informado pelo emitente para reduzir a BC do ISSQN;<br><br>VCalcBM é:<br>o cálculo do valor de redução da BC do ISSQN a partir de benefício municipal:<br><br>1) Quando o valor do benefício municipal for apurado a partir de um percentual parametrizado para redução da base de cálculo, aplicar o percentual parametrizado sobre o valor do serviço já abatidos os valores do desconto incondicionado e dedução/redução.<br><br>Ex: <br>Valor de benefício municipal = (Valor do serviço - valor desconto incodicional - valor de dedução/redução) x % de benefício municipal.<br><br>VServ >= desconto incondicionado + Valor de dedução/redução + valor de benefício municipal.<br><br>2) Quando um valor monetário de benefício municipal é informado pelo emitente na DPS para redução da BC do ISSQN.
    - **Regra:** O valor do serviço deve ser maior ou igual ao somatório dos valores informados para Desconto Incondicionado, Deduções/Reduções e Benefício Municipal.<br><br>Valor do Serviço >= Desconto Incondicionado + Deduções/Reduções + Benefício Municipal<br><br>vServ >= descIncond + (vDR ou vCalcDR) + (vRedBCBM ou VCalcBM)
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0427`
    - **Mensagem:** O valor do serviço deve ser maior ou igual ao somatório dos valores informados para Desconto Incondicionado, Deduções/Reduções e Benefício Municipal.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `388` · E0428 · linha 391 · relação exata**
    - **Contexto compartilhado da coluna D:** vDR é:<br>um valor informado pelo emitente para dedução/redução da BC do ISSQN;<br><br>vCalcDR é:<br>o cálculo do valor de dedução/redução da BC do ISSQN:<br><br>1) Quando o valor de dedução/redução for apurado a partir de um percentual informado na DPS, calcular este percentual sobre o valor do serviço já abatido o valor do desconto incondicionado.<br>Ex: <br>Valor de dedução/redução = (Valor do serviço - valor desconto incodicional) x <br>% de dedução/redução.<br><br>VServ >= desconto incondicionado + Valor de dedução/redução<br><br>2) Quando um ou mais documentos são informados pelo emitente na DPS para dedução/redução da BC do ISSQN. <br>Neste caso o resultado do somatório é o valor deste campo do leiaute NFS-e;<br><br>---------------------------<br><br>vInfoBM é:<br>um valor informado pelo emitente para reduzir a BC do ISSQN;<br><br>VCalcBM é:<br>o cálculo do valor de redução da BC do ISSQN a partir de benefício municipal:<br><br>1) Quando o valor do benefício municipal for apurado a partir de um percentual parametrizado para redução da base de cálculo, aplicar o percentual parametrizado sobre o valor do serviço já abatidos os valores do desconto incondicionado e dedução/redução.<br><br>Ex: <br>Valor de benefício municipal = (Valor do serviço - valor desconto incodicional - valor de dedução/redução) x % de benefício municipal.<br><br>VServ >= desconto incondicionado + Valor de dedução/redução + valor de benefício municipal.<br><br>2) Quando um valor monetário de benefício municipal é informado pelo emitente na DPS para redução da BC do ISSQN.
    - **Regra:** O valor do serviço deve ser maior ou igual ao somatório dos valores informados para Desconto Incondicionado, Desconto Condicionado, Deduções/Reduções, Benefício Municipal, valores de tributos devidos (CP, IRRF, CSLL), e valores dos tributos se retidos (PIS, COFINS, ISSQN).<br><br>Valor do serviço >= Desconto condicionado + Desconto incondicionado + (CP, IRRF, CSLL)* + Valores, se retidos (ISSQN, PIS, COFINS)**<br><br>vServ >= vDescIncond + vDescCond + (vRetCP + vRetIRRF + vRetCSLL)* + vISSQN**<br><br>*Para o resultado do Valor Líquido o CP, IRRF e CSLL serão sempre subtraídos, se constarem na DPS, pois sempre são retidos.<br><br>**Para o resultado do Valor Líquido o ISSQN, somente será subtraído quando for retido.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0428`
    - **Mensagem:** O valor do serviço deve ser maior ou igual ao somatório dos valores informados para Desconto Incondicionado, Desconto Condicionado, Deduções/Reduções, Benefício Municipal, valores de tributos devidos CP, IRRF, CSLL e ISSQN se o valor deste tributo for retido.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `389` · E0429 · linha 392 · relação exata**
    - **Contexto compartilhado da coluna D:** vDR é:<br>um valor informado pelo emitente para dedução/redução da BC do ISSQN;<br><br>vCalcDR é:<br>o cálculo do valor de dedução/redução da BC do ISSQN:<br><br>1) Quando o valor de dedução/redução for apurado a partir de um percentual informado na DPS, calcular este percentual sobre o valor do serviço já abatido o valor do desconto incondicionado.<br>Ex: <br>Valor de dedução/redução = (Valor do serviço - valor desconto incodicional) x <br>% de dedução/redução.<br><br>VServ >= desconto incondicionado + Valor de dedução/redução<br><br>2) Quando um ou mais documentos são informados pelo emitente na DPS para dedução/redução da BC do ISSQN. <br>Neste caso o resultado do somatório é o valor deste campo do leiaute NFS-e;<br><br>---------------------------<br><br>vInfoBM é:<br>um valor informado pelo emitente para reduzir a BC do ISSQN;<br><br>VCalcBM é:<br>o cálculo do valor de redução da BC do ISSQN a partir de benefício municipal:<br><br>1) Quando o valor do benefício municipal for apurado a partir de um percentual parametrizado para redução da base de cálculo, aplicar o percentual parametrizado sobre o valor do serviço já abatidos os valores do desconto incondicionado e dedução/redução.<br><br>Ex: <br>Valor de benefício municipal = (Valor do serviço - valor desconto incodicional - valor de dedução/redução) x % de benefício municipal.<br><br>VServ >= desconto incondicionado + Valor de dedução/redução + valor de benefício municipal.<br><br>2) Quando um valor monetário de benefício municipal é informado pelo emitente na DPS para redução da BC do ISSQN.
    - **Regra:** O ISSQN não pode ser objeto de redução de base de cálculo que resulte em carga tributária menor que a decorrente da aplicação da alíquota mínima de 2,0% do valor do serviço, exceto para os serviços a que se referem os subitens:<br>042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.<br><br>O valor da base de cálculo do ISSQN da NFS-e é encontrada a partir de valores que constam na DPS através do seguinte cálculo:<br><br>Valor da Base de Cálculo do ISSQN = Valor do Serviço - Deduções/Reduções - Benefício Municipal<br><br>vBC = vServ - (vDR ou vCalcDR) - (vInfoBM ou VCalcBM)
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0429`
    - **Mensagem:** O ISSQN não pode ser objeto de redução de base de cálculo que resulte em carga tributária menor que a decorrente da aplicação da alíquota mínima de 2,0% do valor do serviço, exceto para os serviços a que se referem aos subitens 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301, da lista de serviços nacional do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vDescCondIncond/`

#### L251 — Campo `vDescIncond`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 252
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDescCondIncond/`
- **Campo:** `vDescIncond`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário do desconto incondicionado (R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `391` · E0431 · linha 394 · relação exata**
    - **Regra:** Verificar o valor do desconto incondicionado informado na DPS que deve ser menor que o valor do serviço e maior que zero.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0431`
    - **Mensagem:** O valor do desconto incondicionado informado na DPS deve ser menor que o valor do serviço e maior que zero.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L252 — Campo `vDescCond`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 253
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDescCondIncond/`
- **Campo:** `vDescCond`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário do desconto condicionado (R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `392` · E0432 · linha 395 · relação exata**
    - **Regra:** Verificar se o valor do desconto condicionado informado na DPS deve ser menor que o valor do serviço e maior que zero.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0432`
    - **Mensagem:** O valor do desconto condicionado informado na DPS deve ser menor que o valor do serviço e maior que zero.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/`

#### L254 — Campo `pDR`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 255
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/`
- **Campo:** `pDR`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-3V2`
- **Descrição:** Valor percentual padrão para dedução/redução do valor do serviço.
- **Notas explicativas:** As três opções para informação de Dedução/Redução, caso exista, são:<br>Valor, Percentual ou Documento;
- **Regras de negócio associadas:** 3

  - **RN `400` · E0453 · linha 403 · relação exata**
    - **Regra:** Se informado, o valor percentual para dedução/redução deve ser maior 0 e menor ou igual a 100%.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0453`
    - **Mensagem:** O valor percentual para dedução/redução deve ser maior que 0 e menor ou igual a 100%.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `401` · E0454 · linha 404 · relação exata**
    - **Regra:** Código de serviço informado na DPS não permite dedução/redução na base de cálculo do ISSQN por percentual, conforme parametrização do município de incidência conveniado ao Sistema Nacional NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0454`
    - **Mensagem:** Código de serviço informado na DPS não permite dedução/redução na base de cálculo do ISSQN por percentual.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `402` · E0444 · linha 405 · relação exata**
    - **Regra:** O valor percentual  de dedução/redução informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos serviços:<br>042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0444`
    - **Mensagem:** O valor percentual  de dedução/redução informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos subitens 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301, da lista de serviços nacional do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** O valor do desconto incondicionado, se informado na DPS, não é considerado para a redução do valor da BC de forma que resulte para valor do ISSQN a uma alíquota efetiva menor que 2%.


#### L255 — Campo `vDR`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 256
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/`
- **Campo:** `vDR`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário padrão para dedução/redução do valor do serviço.
- **Notas explicativas:** —
- **Regras de negócio associadas:** 2

  - **RN `403` · E0446 · linha 406 · relação exata**
    - **Regra:** Código de serviço informado na DPS não permite dedução/redução na base de cálculo do ISSQN por valor monetário, conforme parametrização do município de incidência conveniado ao Sistema Nacional NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0446`
    - **Mensagem:** Código de serviço informado na DPS não permite dedução/redução na base de cálculo do ISSQN por valor monetário.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `404` · E0447 · linha 407 · relação exata**
    - **Regra:** O valor de dedução/redução informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos serviços:<br>042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0447`
    - **Mensagem:** O valor de dedução/redução informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos subitens 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301, da lista de serviços nacional do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** O valor do desconto incondicionado, se informado na DPS, não é considerado para a redução do valor da BC de forma que resulte para valor do ISSQN a uma alíquota efetiva menor que 2%.


#### L256 — Campo `documentos`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 257
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/`
- **Campo:** `documentos`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações de documento utilizado para dedução/redução do valor da base de cálculo (valor do serviço)
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `405` · E0449 · linha 408 · relação exata**
    - **Regra:** Código de serviço informado na DPS não permite dedução/redução na base de cálculo do ISSQN por documentos, conforme parametrização do município de incidência conveniado ao Sistema Nacional NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0449`
    - **Mensagem:** Código de serviço informado na DPS não permite dedução/redução na base de cálculo do ISSQN por documento informado.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos`

#### L257 — Campo `docDedRed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 258
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos`
- **Campo:** `docDedRed`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1000`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações de documento utilizado para dedução/redução do valor da base de cálculo (valor do serviço)
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`

#### L258 — Campo `chNFSe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 259
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `chNFSe`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `50`
- **Descrição:** Chave de acesso da NFS-e (padrão nacional).
- **Notas explicativas:** Para o caso de informação de documento para Dedução/Redução existem seis opções possíveis:<br>NFS-e, <br>NF-e, <br>Outras NFS-e, <br>NFS/NFS (Modelo não eletrônico), <br>Outros documentos fiscais e<br>Outros documentos;
- **Regras de negócio associadas:** 3

  - **RN `407` · E0455 · linha 410 · relação exata**
    - **Regra:** Chave de NFS-e inválida.<br><br>1 - Verificar DV da chave de NFS-e informada neste campo desta DPS;
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0455`
    - **Mensagem:** Informe uma chave de NFS-e válida.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `408` · E0456 · linha 411 · relação exata**
    - **Regra:** Chave de NFS-e inexistente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0456`
    - **Mensagem:** NFS-e não existe na base de dados do autorizador de NFS-e nacional. Informe uma chave de NFS-e existente.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `409` · E0458 · linha 412 · relação exata**
    - **Regra:** NFS-e da chave informada está cancelada.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0458`
    - **Mensagem:** Uma NFS-e cancelada não pode ser informada para dedução/redução.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L259 — Campo `chNFe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 260
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `chNFe`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `44`
- **Descrição:** Chave de acesso da NF-e.
- **Notas explicativas:** —
- **Regras de negócio associadas:** 3

  - **RN `410` · E0460 · linha 413 · relação exata**
    - **Regra:** Chave de NF-e inválida.<br><br>1 - Verificar DV da chave de NF-e informada neste campo desta DPS;
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0460`
    - **Mensagem:** Informe uma chave de NF-e válida.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `411` · E0462 · linha 414 · relação exata**
    - **Regra:** Chave de NF-e inexistente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0462`
    - **Mensagem:** NF-e não existe na base de dados do autorizador de NF-e nacional. Informe uma chave de NF-e existente.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `412` · E0464 · linha 415 · relação exata**
    - **Regra:** NF-e da chave informada está cancelada.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0464`
    - **Mensagem:** Uma NF-e cancelada não pode ser informada para dedução/redução.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.


#### L260 — Campo `NFSeMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 261
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `NFSeMun`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações para outras notas eletrônicas municipais<br>(Nota eletrônica municipal emitida fora do padrão nacional)
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L264 — Campo `NFNFS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 265
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `NFNFS`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações de NF ou NFS<br>(Modelo não eletrônico)
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L268 — Campo `nDocFisc`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 269
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `nDocFisc`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `255`
- **Descrição:** Identificador de documento fiscal diferente dos demais do grupo.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L269 — Campo `nDoc`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 270
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `nDoc`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `255`
- **Descrição:** Identificador de documento não fiscal diferente dos demais do grupo.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L270 — Campo `tpDedRed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 271
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `tpDedRed`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Tipo da Dedução/Redução:<br><br>01 – Alimentação e bebidas/frigobar; <br>02 – Materiais;<br>03 - Produção Externa;<br>04 - Reembolso de despesas;<br>  05 – Repasse consorciado;<br>  06 – Repasse plano de saúde;<br>  07 – Serviços;<br>08 – Subempreitada de mão de obra;<br>99 – Outras deduções;
- **Notas explicativas:** O grupo de informações de documentos para dedução/redução pode não ter correspondência para Municípios que não utilizem o padrão ABRASF na versão 2.04.<br> <br> Nesse caso, sugere-se que o Município que vá utilizar a transcrição da NFS-e do padrão de seu emissor para o padrão nacional, para encaminhamento ao ADN, apenas para essa fase inicial de implantação do padrão, utilize nessa operação o valor obtido como dedução/redução e o informe como “valor monetário”, e não “documentos”.<br> <br> Nesse sentido, também o Painel Administrativo Municipal deve ser parametrizado como dedução por “valor monetário” para o código de serviço correspondente, até que seu emissor próprio passe a refletir na origem o padrão nacional.<br><br>A partir de janeiro de 2026, o tipo de dedução/redução " 01 – Alimentação e bebidas/frigobar" não será mais permitido.
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L271 — Campo `xDescOutDed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 272
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `xDescOutDed`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `150`
- **Descrição:** Descrição da Dedução/Redução quando a opção é "99 – Outras Deduções".
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `424` · E0468 · linha 427 · relação exata**
    - **Regra:** O campo de descrição deve ser informado no caso de tpDedRed igual a 99 – Outras deduções.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0468`
    - **Mensagem:** Informar, obrigatoriamente, o campo de descrição no caso ideDedRed igual a 99 – Outras deduções.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `425` · E0470 · linha 428 · relação exata**
    - **Regra:** O campo de descrição não deve ser informado no caso de tpDedRed diferente de 99 – Outras deduções.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0470`
    - **Mensagem:** Não informar o campo de descrição no caso ideDedRed diferente a 99 – Outras deduções.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L272 — Campo `dtEmiDoc`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 273
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `dtEmiDoc`
- **ELE:** `E`
- **TIPO:** `D`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Data da emissão do documento dedutível.<br>Ano, mês e dia (AAAA-MM-DD)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `426` · E0472 · linha 429 · relação inferida**
    - **Regra:** A data de emissão do documento informado na DPS não pode ser posterior à data de competência da DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0472`
    - **Mensagem:** A data de emissão do documento informado na DPS não pode ser posterior à data de competência da DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`, campo `dEmiDoc`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


#### L273 — Campo `vDedutivelRedutivel`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 274
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `vDedutivelRedutivel`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário total dedutível/redutível no documento informado (R$).<br>Este é o valor total no documento informado que é passível de dedução/redução.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L274 — Campo `vDeducaoReducao`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 275
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `vDeducaoReducao`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário utilizado para dedução/redução do valor do serviço da NFS-e que está sendo emitida (R$). <br>Deve ser menor ou igual ao valor deduzível/redutível (vDedutivelRedutivel).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `428` · E0474 · linha 431 · relação exata**
    - **Regra:** O valor de dedução/redução não pode ser superior ao valor dedutível/redutível.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0474`
    - **Mensagem:** O valor de dedução/redução não pode ser superior ao valor dedutível/redutível.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `429` · E0476 · linha 432 · relação exata**
    - **Regra:** O valor de dedução/redução informado na DPS não pode ser superior ao valor do serviço.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0476`
    - **Mensagem:** O valor de dedução/redução informado na DPS não pode ser superior ao valor do serviço.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L275 — Campo `fornec`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 276
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/`
- **Campo:** `fornec`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do fornecedor do serviço prestado
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `430` · E0477 · linha 433 · relação exata**
    - **Regra:** O grupo de informações para o fornecedor deve ser informado obrigatoriamente para todos os tipos de documentos informados, exceto para os tipos de documentos NFS-e e NF-e padrões nacionais.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0477`
    - **Mensagem:** O grupo de informações para o fornecedor deve ser informado obrigatoriamente para o tipo de documento de dedução/redução informado na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/NFSeMun/`

#### L261 — Campo `cMunNFSeMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 262
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/NFSeMun/`
- **Campo:** `cMunNFSeMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código Município emissor da nota eletrônica municipal.<br>(Tabela do IBGE)
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `414` · E0466 · linha 417 · relação exata**
    - **Regra:** O código do município informado para o documento de nota não existe, conforme tabela de municípios do IBGE.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0466`
    - **Mensagem:** Informe um código de município existente para o documento de nota, conforme tabela de municípios do IBGE.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L262 — Campo `nNFSeMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 263
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/NFSeMun/`
- **Campo:** `nNFSeMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `15`
- **Descrição:** Número da nota eletrônica municipal.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L263 — Campo `cVerifNFSeMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 264
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/NFSeMun/`
- **Campo:** `cVerifNFSeMun`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `9`
- **Descrição:** Código de Verificação da nota eletrônica municipal.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/NFNFS/`

#### L265 — Campo `nNFS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 266
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/NFNFS/`
- **Campo:** `nNFS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Número da Nota Fiscal NF ou NFS.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L266 — Campo `modNFS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 267
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/NFNFS/`
- **Campo:** `modNFS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `15`
- **Descrição:** Modelo da Nota Fiscal NF ou NFS.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L267 — Campo `serieNFS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 268
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/NFNFS/`
- **Campo:** `serieNFS`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `9`
- **Descrição:** Série Nota Fiscal NF ou NFS.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`

#### L276 — Campo `CNPJ`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 277
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `CNPJ`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `14`
- **Descrição:** Número da inscrição federal (CNPJ) do fornecedor de serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `431` · E0478 · linha 434 · relação exata**
    - **Regra:** CNPJ informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0478`
    - **Mensagem:** CNPJ do fornecedor informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `432` · E0482 · linha 435 · relação exata**
    - **Regra:** CNPJ informado na DPS é inexistente no cadastro CNPJ.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0482`
    - **Mensagem:** CNPJ do fornecedor informado na DPS não encontrado no cadastro CNPJ.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L277 — Campo `CPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 278
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `CPF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `11`
- **Descrição:** Número da inscrição federal (CPF) do fornecedor do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `433` · E0484 · linha 436 · relação exata**
    - **Regra:** CPF informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0484`
    - **Mensagem:** CPF do fornecedor informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `434` · E0488 · linha 437 · relação exata**
    - **Regra:** CPF informado na DPS é inexistente no cadastro CPF.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0488`
    - **Mensagem:** CPF do fornecedor informado na DPS não encontrado no cadastro CPF.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L278 — Campo `NIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 279
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `NIF`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `40`
- **Descrição:** Este elemento só deverá ser preenchido para fornecedores não residentes no Brasil.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `436` · E1538 · linha 439 · relação exata**
    - **Regra:** Se o grupo de informações de endereço no exterior do fornecedor de serviços foi informado então o NIF ou cNaoNIF do fornecedor deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E1538`
    - **Mensagem:** O NIF ou cNaoNIF do fornecedor deve ser informado quando o grupo de informações de endereço no exterior do fornecedor de serviços for informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L279 — Campo `cNaoNIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 280
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `cNaoNIF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Motivo para não informação do NIF:<br><br>0 - Não informado na nota de origem;<br>1 - Dispensado do NIF;<br>2 - Não exigência do NIF;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Regras de negócio associadas:** 1

  - **RN `438` · E0490 · linha 441 · relação exata**
    - **Regra:** Se o valor do campo cNaoNIF do fornecedor, informado na DPS, for 0, então a DPS deve ser rejeitada.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0490`
    - **Mensagem:** Valor 0 para o motivo da não informação do NIF do fornecedor não é permitido na Sefin do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L280 — Campo `CAEPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 281
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `CAEPF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `14`
- **Descrição:** Número do Cadastro de Atividade Econômica da Pessoa Física (CAEPF).
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L281 — Campo `IM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 282
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `IM`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `15`
- **Descrição:** Número do indicador municipal do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L282 — Campo `xNome`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 283
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `xNome`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `150`
- **Descrição:** Nome / Razão Social do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L283 — Campo `end`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 284
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `end`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L292 — Campo `xLgr`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 293
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `xLgr`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Tipo e nome do logradouro do endereço do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L293 — Campo `nro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 294
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `nro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Número no logradouro do endereço do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L294 — Campo `xCpl`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 295
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `xCpl`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-156`
- **Descrição:** Complemento do endereço do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L295 — Campo `xBairro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 296
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `xBairro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Bairro do endereço do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L296 — Campo `fone`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 297
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `fone`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `6-20`
- **Descrição:** Número do telefone do fornecedor.<br>(Preencher com o Código DDD + número do telefone. <br>Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L297 — Campo `email`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 298
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/`
- **Campo:** `email`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-80`
- **Descrição:** E-mail do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/`

#### L284 — Campo `endNac`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 285
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/`
- **Campo:** `endNac`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço nacional.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `443` · E0492 · linha 446 · relação exata**
    - **Regra:** Se CNPJ ou CPF do fornecedor for informado, então o grupo de informaçoes de endereço nacional do fornecedor deve ser informado obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0492`
    - **Mensagem:** O grupo de informações de endereço nacional deve ser informado obrigatoriamente quando o fornecedor for identificado pelo CPF ou CNPJ.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L287 — Campo `endExt`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 288
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/`
- **Campo:** `endExt`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço no exterior.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `446` · E0498 · linha 449 · relação exata**
    - **Regra:** Se o NIF do fornecedor foi informado, então o grupo de informações de endereço no exterior do fornecedor deve ser informado obrigatoriamente.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0498`
    - **Mensagem:** O grupo de informações de endereço no exterior deve ser informado obrigatoriamente quando o fornecedor for identificado pelo NIF.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/endNac/`

#### L285 — Campo `cMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 286
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/endNac/`
- **Campo:** `cMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código do município do endereço do fornecedor.<br> (Tabela do IBGE)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `444` · E0494 · linha 447 · relação exata**
    - **Regra:** O código do município informado para o endereço do fornecedor não existe, conforme tabela de municípios do IBGE.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0494`
    - **Mensagem:** O código do município informado na DPS para o endereço do fornecedor do serviço não existe conforme tabela de município do IBGE.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L286 — Campo `CEP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 287
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/endNac/`
- **Campo:** `CEP`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP) <br> do endereço do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `445` · E0496 · linha 448 · relação exata**
    - **Regra:** O CEP informado deve existir e pertencer ao município correspondente ao código do município informado para o endereço do fornecedor.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0496`
    - **Mensagem:** O CEP informado para o endereço nacional do fornecedor não existe ou não pertence ao município do endereço do fornecedor.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/endExt/`

#### L288 — Campo `cPais`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 289
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/endExt/`
- **Campo:** `cPais`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Código do país do endereço do prestador do fornecedor.<br> (Tabela de Países ISO)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `447` · E0499 · linha 450 · relação exata**
    - **Regra:** O código de país informado para o endereço no exterior do fornecedor deve existir e ser diferente de Brasil (BR), conforme a tabela ISO2.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0499`
    - **Mensagem:** O código de país informado para o endereço no exterior do fornecedor não existe ou é igual ao código do Brasil. Informe um código de país existente e diferente do codigo do Brasil (BR) para o endereço no exterior do fornecedor, conforme tabela de país do ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe-ESPEC.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L289 — Campo `cEndPost`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 290
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/endExt/`
- **Campo:** `cEndPost`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-11`
- **Descrição:** Código alfanumérico do Endereçamento Postal no exterior do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L290 — Campo `xCidade`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 291
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/endExt/`
- **Campo:** `xCidade`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Nome da cidade no exterior do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L291 — Campo `xEstProvReg`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 292
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/fornec/end/endExt/`
- **Campo:** `xEstProvReg`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Estado, província ou região da cidade no exterior do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/trib/`

#### L299 — Campo `tribMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 300
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/`
- **Campo:** `tribMun`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relacionados ao <br>Imposto Sobre Serviços de Qualquer Natureza - ISSQN
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L312 — Campo `tribFed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 313
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/`
- **Campo:** `tribFed`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações de outros tributos relacionados ao serviço prestado
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `514` · E0675 · linha 517 · relação exata**
    - **Regra:** Não é permitido o preenchimento das informações relativas aos tributos federais quando o emitente da DPS for identificado por uma pessoa física (CPF).
    - **Aplicação:** Obrig.
    - **Efeito:** Obrig.
    - **Código de erro:** `E0675`
    - **Mensagem:** Não é permitido a prestação de informações relativas aos tributos federais quando o emitente da DPS for identificado por um pessoa física (CPF).
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `515` · E0676 · linha 518 · relação exata**
    - **Regra:** Não é permitido o preenchimento das informações relativas aos tributos federais quando o emitente for identificado como MEI na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Obrig.
    - **Código de erro:** `E0676`
    - **Mensagem:** Não é permitido o preenchimento das informações relativas aos tributos federais quando o emitente for identificado como MEI na data de competência informada na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L324 — Campo `totTrib`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 325
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/`
- **Campo:** `totTrib`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações para totais aproximados dos tributos relacionados ao serviço prestado
- **Notas explicativas:** Os campos totalizadores deste grupo serão reavaliados em novas versões do layout proposto.
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`

#### L300 — Campo `tribISSQN`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 301
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Campo:** `tribISSQN`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Tributação do ISSQN sobre o serviço prestado:<br><br>1 - Operação tributável;<br>2 - Imunidade;<br>3 - Exportação de serviço;<br>4 - Não Incidência;
- **Notas explicativas:** -
- **Regras de negócio associadas:** 5

  - **RN `459` · E0529 · linha 462 · relação exata**
    - **Regra:** Não é permitido ao emitente informar se tratar de uma situação de exportação de serviço (tribISSQN = 3) para os cenários 6, 10, 34, 38, 66, 80, conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0529`
    - **Mensagem:** O sistema considera este cenário para a prestação de serviço informada na DPS uma operação tributável. Não é permitido ao emitente da DPS informar que a prestação de serviço se trata de uma exportação de serviço.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** Os campos a serem verificados conforme os cenários são:<br>6<br>NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = ET <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>10<br>NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = LP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>34<br>NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = ET  <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>38<br>NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = LP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>66<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = LP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>80<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = LP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)
  - **RN `461` · E0530 · linha 464 · relação exata**
    - **Regra:** Não é permitido ao emitente informar se tratar de uma situação de operação tributável (tribISSQN = 1) para os cenários 26, 54, 92, 96, 106, 110, conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0530`
    - **Mensagem:** O sistema considera este cenário para a prestação de serviço informada na DPS uma exportação de serviço. Não é permitido ao emitente da DPS informar que a prestação de serviço se trata de uma operação tributável.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** Os campos a serem verificados conforme os cenários são:<br><br>26<br>NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>54<br>NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>92<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>96<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = ET<br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>106<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP<br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>110<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = ET<br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)
  - **RN `463` · E0532 · linha 466 · relação exata**
    - **Regra:** Quando o serviço prestado for 99.01.01 - Serviços sem a incidência de ISSQN e ICMS não há incidência do ISSQN (tribISSQN = 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0532`
    - **Mensagem:** O campo que informa sobre a tributação do ISSQN deve ser "4 - Não Incidência", quando houver o serviço prestado for 99.01.01 - Serviços sem a incidência de ISSQN e ICMS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `464` · E0539 · linha 467 · relação exata**
    - **Regra:** Quando qualquer subitem da lista de serviço nacional for incidente, conforme a parametrização do município de incidência do ISSQN, não é permitido informar não incidência do ISSQN, ou seja, os valores permitidos para o campo tribISSQN são: tribISSQN = 1, 2 ou 3.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0539`
    - **Mensagem:** Não é permitido informar não incidência do ISSQN = 4 (Não Incidência) para qualquer subitem da lista nacional de serviço informado na DPS, se o subitem for incidente, conforme a parametrização do município de incidência do ISSQN.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** —
  - **RN `465` · E0540 · linha 468 · relação exata**
    - **Regra:** Quando qualquer subitem da lista de serviço nacional for não incidente, conforme a parametrização do município de incidência do ISSQN, é obrigatório informar não incidência do ISSQN, ou seja, o valor permitido para o campo tribISSQN é: tribISSQN = 4.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0540`
    - **Mensagem:** Não há incidência do ISSQN (tribISSQN = 4) pois a parametrização do muncípio de incidência do ISSQN indica que o código de serviço prestado, informado na DPS, não é incidente neste município.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L301 — Campo `cPaisResult`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 302
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Campo:** `cPaisResult`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `2`
- **Descrição:** Código do país onde ocorreu o resultado do serviço prestado.<br>(Tabela de Países ISO)
- **Notas explicativas:** Se houver indicação pelo emitente de exportação de serviço, mesmo não havendo nenhum elemento para a ocorrência de exportação, então o emitente deve indicar em qual país ocorreu o resultado do serviço prestado.
- **Regras de negócio associadas:** 2

  - **RN `466` · E0590 · linha 469 · relação exata**
    - **Regra:** Se, a tributação do ISSQN é igual à Exportação de serviço e Local da Prestação do Serviço é no Brasil e o Serviço prestado tem incidência no Local do Estabelecimento do Prestador, conforme LC 116/03,<br>ou<br>Se, a tributação do ISSQN é igual à Exportação de serviço e Local da Prestação do Serviço é no Brasil e o Serviço prestado tem incidência no Local do Estabelecimento do Tomador, conforme LC 116/03, e o Endereço do Tomador do serviço é no Exterior ou não informado,<br>Então,<br>é obrigatório informar o código do país onde ocorreu o resultado do serviço prestado.<br><br>obs: todos os cenários iguais a 2, 30, 58, 62, 72, 76, conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0590`
    - **Mensagem:** É obrigatório informar o código do país onde ocorreu o resultado do serviço prestado para os cenários 2, 30, 58, 62, 72, 76, conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** Os campos a serem verificados conforme os cenários são:<br>2<br>NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>30<br>NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>58<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>62<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = ET<br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>72<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP<br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>76<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = ET<br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)
  - **RN `467` · E0591 · linha 470 · relação exata**
    - **Regra:** Se a tributação do ISSQN é diferente de Exportação de serviço ou Local da Prestação do Serviço é no Exterior ou o Serviço prestado tem incidência no Local de Prestação, conforme LC 116/03,<br>ou<br>Se a tributação do ISSQN é igual à Exportação de serviço e Local da Prestação do Serviço é no Brasil e o Serviço prestado tem incidência no Local do Estabelecimento do Tomador, conforme LC 116/03, e o Endereço do Tomador do serviço é no Brasil.<br><br>Não é permitido informar o código do país onde ocorreu o resultado do serviço prestado.<br><br>obs: todos os cenários diferentes de 2, 30, 58, 62, 72, 76, conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0591`
    - **Mensagem:** Não é permitido informar o código do país onde ocorreu o resultado do serviço prestado para os cenários diferentes de 2, 30, 58, 62, 72, 76 conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** Os campos a serem verificados conforme os cenários são:<br>2<br>NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>30<br>NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>58<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP <br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>62<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = ET<br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>72<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = EP<br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)<br><br>76<br>NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais<br>NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao<br>NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac<br>Resultado do local de incidência = ET<br>NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN<br>tribISSQN = 3 (Exportação de Serviço)


#### L302 — Campo `tpImunidade`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 303
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Campo:** `tpImunidade`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1`
- **Descrição:** Identificação da Imunidade do ISSQN – somente para o caso de Imunidade.<br><br>Tipos de Imunidades:<br><br>0 - Imunidade (tipo não informado na nota de origem);<br>1 - Patrimônio, renda ou serviços, uns dos outros (CF88, Art 150, VI, a);<br>2 - Entidades religiosas e templos de qualquer culto, inclusive suas organizações assistenciais e beneficentes (CF88, Art 150, VI, b);<br>3 - Patrimônio, renda ou serviços dos partidos políticos, inclusive suas fundações, das entidades sindicais dos trabalhadores, das instituições de educação e de assistência social, sem fins lucrativos, atendidos os requisitos da lei (CF88, Art 150, VI, c);<br>4 - Livros, jornais, periódicos e o papel destinado a sua impressão (CF88, Art 150, VI, d);<br>5 - Fonogramas e videofonogramas musicais produzidos no Brasil contendo obras musicais ou literomusicais de autores brasileiros e/ou obras em geral interpretadas por artistas brasileiros bem como os suportes materiais ou arquivos digitais que os contenham, salvo na etapa de replicação industrial de mídias ópticas de leitura a laser.   (CF88, Art 150, VI, e);
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Regras de negócio associadas:** 2

  - **RN `468` · E0592 · linha 471 · relação exata**
    - **Regra:** Obrigatório e informado somente quando o campo referente à tributação do ISSQN for igual a 2 (tribISSQN = 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0592`
    - **Mensagem:** O tipo de imunidade é obrigatório e deve ser informado somente quando o campo referente à tributação do ISSQN for igual a "2 - Imunidade".
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `469` · E0593 · linha 472 · relação exata**
    - **Regra:** Não permitido o valor "0 - Imunidade (tipo não informado na nota de origem)" na DPS quando utilizado os Emissores Públicos Nacionais para emissão de NFS-e.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0593`
    - **Mensagem:** Não permitido o valor "0 - Imunidade (tipo não informado na nota de origem)" na DPS quando utilizado os Emissores Públicos Nacionais para emissao de NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L303 — Campo `exigSusp`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 304
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Campo:** `exigSusp`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Informações para a suspensão da Exigibilidade do ISSQN
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `470` · E0585 · linha 473 · relação exata**
    - **Regra:** Não é permitido informar suspensão da exigibilidade do ISSQN por decisão judicial ou administrativa, quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0585`
    - **Mensagem:** Somente é permitido informar suspensão de exigibilidade quando a opção da tributação do ISSQN for uma operação tributável <br>(tribISSQN = 1).
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L306 — Campo `BM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 307
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Campo:** `BM`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações sobre o tipo do Benefício Municipal
- **Notas explicativas:** -
- **Regras de negócio associadas:** 5

  - **RN `473` · E0533 · linha 476 · relação inferida**
    - **Regra:** Não é permitido informar BM quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Obrig.
    - **Código de erro:** `E0533`
    - **Mensagem:** Não é permitido informar Benefício Municipal (BM deve ser nulo) quando o serviço prestado diferente de Tributável (tribISSQN = 1), ou seja, tribISSQN = 2, 3 ou 4.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/`, campo `BM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `474` · E0534 · linha 477 · relação inferida**
    - **Regra:** Não é permitido o preenchimento dos campos do grupo de informações relativas ao Benefício Municipal quando o prestador do serviço é MEI (opSimpNac = 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Obrig.
    - **Código de erro:** `E0534`
    - **Mensagem:** Não é permitido o preenchimento de informações relativas à benefício municipal para o prestador de serviço MEI.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/`, campo `BM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `475` · E0535 · linha 478 · relação inferida**
    - **Regra:** Não é permitido informar benefício municipal quando o prestador de serviço tiver um regime especial de tributação, ou seja, o campo que indica o regime especial de tributação é diferente de 0, (regEspTrib = 1, 2, 3, 4, 5, 6 ou 9).
    - **Aplicação:** Obrig.
    - **Efeito:** Obrig.
    - **Código de erro:** `E0535`
    - **Mensagem:** Não é permitido informar benefício municipal quando o prestador de serviço tiver um regime especial de tributação, ou seja, o campo que indica o regime especial de tributação é diferente de 0, (regEspTrib = 1, 2, 3, 4, 5, 6 ou 9).
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/`, campo `BM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `476` · E0537 · linha 479 · relação inferida**
    - **Regra:** Se o município de incidência do ISSQN não está "Ativo" no Sistema Nacional NFS-e, então não é permitido informar benefício municipal.
    - **Aplicação:** Obrig.
    - **Efeito:** Obrig.
    - **Código de erro:** `E0537`
    - **Mensagem:** Não é permitido informar benefício municipal (BM deve ser nulo) quando o município de incidência do ISSQN não está "Ativo" no Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/`, campo `BM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `477` · E0536 · linha 480 · relação inferida**
    - **Regra:** Se o emitente da DPS for ME/EPP (opSimpNac = 3), apurando o ISSQN pelo Simples Nacional (regApTribSN = 1) e o município de incidência do ISSQN está "Ativo" no Sistema Nacional NFS-e, então não é permitido informar benefício municipal, ou seja, (nBM = nulo).<br><br>Obs: Exceto quando o código de tributação nacional corresponder aos subitens 07.02 e 07.05 da lista de serviços do sistema nacional NFS-e. Cenário em que o sistema verifica se há parametrização de BM para o emitente da DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Obrig.
    - **Código de erro:** `E0536`
    - **Mensagem:** Não é permitido o preenchimento de informações relativas à benefício municipal para o prestador de serviço ME/EPP, apurando pelo SN, conforme parametrização do código de serviço admnistrado pelo municipio de incidência do ISSQN.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/`, campo `BM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


#### L310 — Campo `tpRetISSQN`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 311
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Campo:** `tpRetISSQN`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Tipo de retencao do ISSQN:<br><br>1 - Não Retido;<br>2 - Retido pelo Tomador;<br>3 - Retido pelo Intermediario;
- **Notas explicativas:** -
- **Regras de negócio associadas:** 11

  - **RN `490` · E0580 · linha 493 · relação exata**
    - **Regra:** Não é permitido haver retenção do ISSQN (tpRetISSQN = 2 ou 3) quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo tpRetISSQ = 1 quando o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0580`
    - **Mensagem:** Não é permitido haver retenção quando o campo referente à tributação do ISSQN indicar imunidade, exportação ou não incidência.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `491` · E0583 · linha 494 · relação exata**
    - **Regra:** Se o prestador do serviço tiver opção perante o Simples Nacional MEI (opSimpNac = 2) na data de competência informada na DPS, então não é permitido ocorrer retenção do ISSQN (tpRetISSQN igual a 2 ou 3), ou seja, tpRetISSQN tem que ser igual a 1 (tpRetISSQN = 1).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0583`
    - **Mensagem:** Não é permitido retenção do ISSQN para o prestador do serviço que seja MEI na data de competência informada na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `492` · E0588 · linha 495 · relação exata**
    - **Regra:** Se o prestador do serviço tiver um regime especial de tributação (regEspTrib = 1, 2, 3, 4, 5, 6 ou 9) na data de competência informada na DPS, então não é permitido ocorrer retenção do ISSQN (tpRetISSQN igual a 2 ou 3), ou seja, tpRetISSQN tem que ser igual a 1 (tpRetISSQN = 1).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0588`
    - **Mensagem:** Não é permitido retenção do ISSQN para o prestador do serviço que tenha algum regime especial de tributação na data de competência informada na DPS.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `493` · E0594 · linha 496 · relação exata**
    - **Regra:** Quando o benefício municipal informado na DPS for do tipo "Isenção", não poderá ocorrer retenção do ISSQN <br>(tpRetISSQN igual a 2 ou 3) ou seja, tpRetISSQN tem que ser igual a 1.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0594`
    - **Mensagem:** Não é permitido retenção do ISSQN quando houver Benefício Municipal do tipo Isenção.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `494` · E0596 · linha 497 · relação exata**
    - **Regra:** Quando o codigo de tributação nacional corresponder ao subitem 220101 da lista de serviços do Sistema Nacional NFS-e, não poderá ocorrer retenção do ISSQN (tpRetISSQN igual a 2 ou 3) ou seja, tpRetISSQN tem que ser igual a 1.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0596`
    - **Mensagem:** Não é permitido retenção do ISSQN quando o serviço prestado corresponder ao subitem 220101 - Serviço de exploração de rodovia da lista de serviços do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `495` · E0650 · linha 498 · relação exata**
    - **Regra:** Se o emitente da DPS for o tomador de serviço (tpEmit = 2) e o prestador for identificado por NIF ou, <br>na falta do NIF informado, o endereço for no exterior e local da prestação no território brasileiro <br>(cLocPrestacao é preenchido), então a retenção do imposto devido deve ser realizada obrigatoriamente <br>pelo tomador (tpRetISSQN = 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0650`
    - **Mensagem:** Em caso de importação de serviço pelo tomador, o ISSQN deve ser retido pelo tomador.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `496` · E0652 · linha 499 · relação exata**
    - **Regra:** Se o emitente da DPS for o intermediário de serviço (tpEmit = 3) e o prestador for identificado por NIF ou, <br>na falta do NIF informado, o endereço for no exterior e local da prestação no território brasileiro <br>(cLocPrestacao é preenchido), então a retenção do imposto devido deve ser realizada obrigatoriamente <br>pelo tomador (tpRetISSQN = 3).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0652`
    - **Mensagem:** Em caso de importação de serviço pelo intermediário, o ISSQN deve ser retido pelo intermediário.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `497` · E0667 · linha 500 · relação exata**
    - **Regra:** Verificar se o CPF informado como tomador na DPS (NFSe/infNFSe/DPS/infDPS/toma/CPF) está previamente cadastrado para retenção do ISSQN na parametrização do município de incidência do imposto.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0667`
    - **Mensagem:** Município da incidência do ISSQN não autoriza que o CPF do tomador informado na DPS seja indicado para retenção deste imposto.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `498` · E0670 · linha 501 · relação exata**
    - **Regra:** Verificar se o CPF informado como intermediário na DPS (NFSe/infNFSe/DPS/infDPS/interm/CPF) está previamente cadastrado para retenção na parametrização do município de incidência do imposto.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0670`
    - **Mensagem:** Município da incidência do ISSQN não autoriza que o CPF do intermediário informado na DPS seja indicado para retenção deste imposto.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `499` · E0672 · linha 502 · relação exata**
    - **Regra:** Se o tomador emitente da DPS (tpEmit = 2) for estabelecido em município diferente do município de incidência do ISSQN, então não pode haver retenção (tpRetISSQN deve ser igual a 1).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0672`
    - **Mensagem:** Não pode haver retenção do ISSQN se e o tomador for o emitente da DPS e estiver estabelecido em município diferente do município de incidência do ISSQN.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.
  - **RN `500` · E0673 · linha 503 · relação exata**
    - **Regra:** Se o intermediário emitente da DPS (tpEmit = 3) for estabelecido em município diferente do município de incidência do ISSQN, então não pode haver retenção (tpRetISSQN deve ser igual a 1).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0673`
    - **Mensagem:** Não pode haver retenção do ISSQN se e o intermediário for o emitente da DPS e estiver estabelecido em município diferente do município de incidência do ISSQN.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Comentário encadeado do XLSX:** Regra executada somente quando o emitente da DPS for o tomador ou intermediário do serviço (tpEmit = 2 ou 3). — Adriano Guedes da Silva, `2024-07-02T00:18:04.31`.


#### L311 — Campo `pAliq`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 312
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Campo:** `pAliq`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1V2`
- **Descrição:** Valor da alíquota (%) do serviço prestado relativo ao município sujeito ativo (município de incidência) do ISSQN.
- **Notas explicativas:** Se o município de incidência pertence ao Sistema Nacional NFS-e a alíquota estará parametrizada e, portanto, será fornecida pelo sistema.<br><br>Se o município de incidência não pertence ao Sistema Nacional NFS-e a alíquota não estará parametrizada e, por isso, deverá ser fornecida pelo emitente.
- **Regras de negócio associadas:** 13

  - **RN `501` · E0595 · linha 504 · relação exata**
    - **Regra:** Não é permitido informar alíquota superior a 5%.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0595`
    - **Mensagem:** Não é permitido informar alíquota superior a 5%.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `502` · E0600 · linha 505 · relação exata**
    - **Regra:** Não é permitido informar alíquota quando o prestador é optante do simples nacional do tipo MEI (opSimpNac = 2).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0600`
    - **Mensagem:** Não é permitido informar a alíquota para prestador de serviço optante do simples nacional do tipo MEI.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `503` · E0602 · linha 506 · relação exata**
    - **Regra:** Não é permitido informar alíquota quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0602`
    - **Mensagem:** Não é permitido informar alíquota quando o campo referente à tributação do ISSQN indicar imunidade, exportação ou não incidência.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `504` · E0604 · linha 507 · relação exata**
    - **Regra:** Não é permitido informar alíquota quando o prestador de serviço tiver um regime especial de tributação, ou seja, o campo que indica o regime especial de tributação é diferente de 0, (regEspTrib = 1, 2, 3, 4, 5, 6 ou 9).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0604`
    - **Mensagem:** Não é permitido informar alíquota quando o prestador de serviço possui algum regime especial de tributação.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `505` · E0612 · linha 508 · relação exata**
    - **Regra:** Não é permitido informar alíquota quando o benefício municipal for informado na DPS for do tipo "Isenção" ou "Alíquota Diferenciada".
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0612`
    - **Mensagem:** Não é permitido informar alíquota quando o benefício municipal informado na DPS for do tipo "Isenção" ou "Alíquota Diferenciada".
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `506` · E0617 · linha 509 · relação exata**
    - **Regra:** Não é permitido o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:<br><br>1) o prestador de serviço seja não optante do Simples Nacional (opSimpNac = 1) <br>na data de competência informada na DPS, e<br>2) o convênio do município de incidência do ISSQN está ativo na data de competência informada na DPS;
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0617`
    - **Mensagem:** Não é permitido informar alíquota quando o prestador de serviço não é optante do simples nacional (opSimpNac = 1) na data de competência informada na DPS, com o município de incidência do ISSQN com situação "ATIVO" no Sistema Nacional NFS-e.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `507` · E0619 · linha 510 · relação exata**
    - **Regra:** É obrigatório o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:<br><br>1) o prestador de serviço seja não optante do Simples Nacional (opSimpNac = 1) <br>na data de competência informada na DPS, e<br>2) o convênio do município de incidência do ISSQN não está "Ativo" na data de competência informada na DPS, e<br>3) nenhum regime especial de tributação para o prestador de serviço (regEspTrib = 0);
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0619`
    - **Mensagem:** É obrigatório informar alíquota quando o prestador de serviço não é optante do simples nacional (opSimpNac = 1) na data de competência informada na DPS, o município de incidência do ISSQN não está com situação "ATIVO" no Sistema Nacional NFS-e e não haja algum regime especial de tributaçao para o prestador.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `508` · E0621 · linha 511 · relação exata**
    - **Regra:** É obrigatorio o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:<br><br>1) O prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3) <br>na data de competência de emissão da DPS e; <br>2) a apuração do ISSQN seja pelo SN (regApTribSN = 1) e;<br>3) o convênio do município de incidência do ISSQN está "Ativo" na data de competência informada na DPS, <br>4) não haja benefício municipal ou, se houver, seja diferente de "Isenção" e "Alíquota diferenciada", e<br>5) haja retenção do ISSQN (tpRetISSQN = 2 ou 3);<br><br>Obs: neste cenário, o percentual da alíquota mínima informada permitida é 1,8%.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0621`
    - **Mensagem:** É obrigatório informar alíquota quando há indicação de retenção do ISSQN (tpRetISSQN = 2 ou 3) para o prestador de serviço ME/EPP (opSimpNac = 3) na data de competência informada na DPS, com apuração do ISSQN pelo simples nacional (regApTribISSQN = 1), sem benefício municipal ou, se houver, seja diferente de isenção ou alíquota diferenciada, cujo município de incidência esteja Ativo no Sistema Nacional NFS-e. Obs: neste cenário, o percentual da alíquota mínima informada permitida é 1,8%.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `509` · E0625 · linha 512 · relação exata**
    - **Regra:** Não é permitido o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:<br><br>1) O prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3) <br>na data de competência de emissão da DPS e; <br>2) a apuração do ISSQN seja pelo SN (regApTribSN = 1) e;<br>3) o convênio do município de incidência do ISSQN está "Ativo" na data de competência informada na DPS, <br>4) não haja benefício municipal ou, se houver, seja diferente de "Isenção" e "Alíquota diferenciada", e<br>5) não haja retenção do ISSQN (tpRetISSQN = 1);
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0625`
    - **Mensagem:** Não é permitido informar alíquota quando não há indicação de retenção do ISSQN (tpRetISSQN = 1) para o prestador de serviço ME/EPP (opSimpNac = 3) na data de competência informada na DPS, com apuração do ISSQN pelo simples nacional (regApTribISSQN = 1), sem benefício municipal ou, se houver, seja diferente de isenção ou alíquota diferenciada, cujo município de incidência esteja Ativo no Sistema Nacional NFS-e.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `510` · E0628 · linha 513 · relação exata**
    - **Regra:** É obrigatório o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:<br><br>1) O prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3) <br>na data de competência de emissão da DPS e; <br>2) a apuração do ISSQN seja pelo SN (regApTribSN = 1) e;<br>3) o convênio do município de incidência do ISSQN não está "Ativo" na data de competência informada na DPS, e<br>4) haja retenção do ISSQN (tpRetISSQN = 2 ou 3);<br><br>Obs: neste cenário, o percentual da alíquota mínima informada permitida é 1,8%.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0628`
    - **Mensagem:** É obrigatório informar alíquota quando o município de incidência do ISSQN não está Ativo no Sistema Nacional NFS-e, para o prestador de serviço ME/EPP (opSimpNac = 3) na data de competência informada na DPS, com apuração do ISSQN pelo simples nacional (regApTribISSQN = 1), com retenção do ISSQN (tpRetISSQN = 2 ou 3). Obs: neste cenário, o percentual da alíquota mínima informada permitida é 1,8%.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `511` · E0631 · linha 514 · relação exata**
    - **Regra:** Não é permitido o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:<br><br>1) O prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3) <br>na data de competência de emissão da DPS e; <br>2) a apuração do ISSQN seja pelo SN (regApTribSN = 1) e;<br>3) o convênio do município de incidência do ISSQN não está "Ativo" na data de competência informada na DPS, e<br>4) não haja retenção do ISSQN (tpRetISSQN = 1);
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0631`
    - **Mensagem:** Não é permitido informar alíquota quando o município de incidência do ISSQN não está Ativo no Sistema Nacional NFS-e, para o prestador de serviço ME/EPP (opSimpNac = 3) na data de competência informada na DPS, com apuração do ISSQN pelo simples nacional (regApTribISSQN = 1) sem retenção do ISSQN (tpRetISSQN = 1).
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `512` · E0635 · linha 515 · relação exata**
    - **Regra:** Não é permitido o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:<br><br>1) o prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3) <br>na data de competência informada na DPS, e<br>2) a apuração do ISSQN fora do Simples Nacional, ou seja, pela alíquota do município <br>para o serviço prestado (regApTribSN = 2 ou 3) e;<br>3) o convênio do município de incidência do ISSQN está ativo na data de competência informada na DPS;
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0635`
    - **Mensagem:** Não é permitido informar alíquota quando o convênio do município de incidência do ISSQN está ativo na data de competência informada na DPS, para o prestador de serviço ME/EPP (opSimpNac = 3) com a apuração do ISSQN fora do Simples Nacional, ou seja, pela alíquota do município para o serviço prestado (regApTribSN = 2 ou 3).
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `513` · E0640 · linha 516 · relação exata**
    - **Regra:** É obrigatorio o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:<br><br>1) O prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3) <br>na data de competência de emissão da DPS e; <br>2) a apuração do ISSQN fora do Simples Nacional, ou seja, pela alíquota do município <br>para o serviço prestado (regApTribSN = 2 ou 3) e;<br>3) o convênio do município de incidência do ISSQN não está "Ativo" na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0640`
    - **Mensagem:** É obrigatório informar alíquota quando o prestador de serviço ME/EPP (opSimpNac = 3) na data de competência informada na DPS, com apuração do ISSQN fora do Simples Nacional (regApTribISSQN = 2 ou 3), ou seja, pela alíquota do município para o serviço prestado, cujo município de incidência não esteja "Ativo" no Sistema Nacional NFS-e.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/exigSusp/`

#### L304 — Campo `tpSusp`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 305
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/exigSusp/`
- **Campo:** `tpSusp`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Opção para Exigibilidade Suspensa:<br><br>1 - Exigibilidade do ISSQN Suspensa por Decisão Judicial;<br>2 - Exigibilidade do ISSQN Suspensa por Processo Administrativo;
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L305 — Campo `nProcesso`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 306
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/exigSusp/`
- **Campo:** `nProcesso`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `30`
- **Descrição:** Número do processo judicial ou administrativo de suspensão da exigibilidade.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/`

#### L307 — Campo `nBM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 308
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/`
- **Campo:** `nBM`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `14`
- **Descrição:** Identificador do benefício parametrizado pelo município.<br><br>Trata-se de um identificador único que foi gerado pelo Sistema Nacional no momento em que o município de incidência do ISSQN incluiu o benefício no sistema.<br><br>Critério de formação do número de identificação de parâmetros municipais:<br><br>7 dígitos - posição 1 a 7: número identificador do Município, conforme código IBGE;<br>2 dígitos - posições 8 e 9 : número identificador do tipo de parametrização <br>(01-legislação, 02-regimes especiais, 03-retenções, 04-outros benefícios);<br>5 dígitos - posição 10 a 14 : número sequencial definido pelo sistema quando do registro específico do parâmetro dentro do tipo de parametrização no sistema;
- **Notas explicativas:** Trata-se de um identificador único que foi gerado pelo Sistema Nacional no momento em que o município de incidência do ISSQN incluiu o benefício no sistema.<br><br>Critério de formação do número de identificação de parâmetros municipais:<br><br>7 dígitos - posição 1 a 7: número identificador do Município, conforme código IBGE;<br><br>2 dígitos - posições 8 e 9 : número identificador do tipo de parametrização <br>(01-legislação, 02-regimes especiais, 03-retenções, 04-outros benefícios);<br><br>5 dígitos - posição 10 a 14 : número sequencial definido pelo sistema quando do registro específico do parâmetro dentro do tipo de parametrização no sistema;<br><br>O emitente poderá obter essa informação de parametrização do município através de API própria que dará publicidade às parametrizações dos municípios.
- **Regras de negócio associadas:** 4

  - **RN `478` · E0541 · linha 481 · relação inferida**
    - **Regra:** O código de identificação do Benefício Municipal não existente para municipio de incidência do ISSQN.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0541`
    - **Mensagem:** Não existe o código de identificação do benefício municipal informado na DPS para o municipío de incidência do ISSQN.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `nBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `479` · E0544 · linha 482 · relação inferida**
    - **Regra:** O código de identificação de Benefício Municipal do municipío de incidência do ISSQN não está vigente na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0544`
    - **Mensagem:** Período de vigência expirado para o código de identificação do Benefício Municipal no municipío de incidência do ISSQN para a data de competência informada na DPS.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `nBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `480` · E0548 · linha 483 · relação inferida**
    - **Regra:** O código de indentificação de Benefício Municipal informado na DPS é restrita à prestadores de serviço estabelecidos no município de incidência do ISSQN.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0548`
    - **Mensagem:** O Benefício Municipal informado na DPS não permite benefício para prestadores de serviço que não estejam estabelecidos no município de incidência do ISSQN.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `nBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `481` · E0550 · linha 484 · relação inferida**
    - **Regra:** O código de indentificação de Benefício Municipal, informada na DPS, não permite benefício para o código de tributação e/ou prestador (CPF ou CNPJ) informado na DPS, conforme parametrização do município de incidência do ISSQN.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0550`
    - **Mensagem:** O código de identificação de Benefício Municipal, informada na DPS, não permite benefício para o código de tributação e/ou prestador (CPF ou CNPJ) informado na DPS, conforme parametrização do município de incidência do ISSQN.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `nBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


#### L308 — Campo `vRedBCBM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 309
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/`
- **Campo:** `vRedBCBM`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário (R$) informado pelo emitente para redução da base de cálculo (BC) do ISSQN devido a um Benefício Municipal (BM).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 4

  - **RN `482` · E0565 · linha 485 · relação inferida**
    - **Regra:** Somente é permitido informar vRedBCBM quando o código de identificação do Benefício Municipal (nBM) for um benefício do tipo Redução de Base de Cálculo por Valor Monetário.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0565`
    - **Mensagem:** Não é permitido informar um valor monetário de redução de base de cálculo do ISSQN por benefício municipal, se o código de identificação do Benefício Municipal não corresponder ao tipo de redução por valor monetário.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `vRedBCBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `483` · E0567 · linha 486 · relação inferida**
    - **Regra:** É obrigatório informar vRedBCBM quando o código de identificação do Benefício Municipal (nBM) for um benefício do tipo Redução de Base de Cálculo por Valor Monetário.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0567`
    - **Mensagem:** É obrigatório informar vRedBCBM quando o código de identificação do Benefício Municipal (nBM) for um benefício do tipo Redução de Base de Cálculo por Valor Monetário.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `vRedBCBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `484` · E0574 · linha 487 · relação inferida**
    - **Regra:** O valor monetário do benefício municipal informado na DPS não pode ser superior ao valor do preço serviço.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0574`
    - **Mensagem:** O valor monetário do benefício municipal informado na DPS não pode ser superior ao valor do serviço.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `vRedBCBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `485` · E0575 · linha 488 · relação inferida**
    - **Regra:** O valor monetário do benefício municipal informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos serviços:<br>042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0575`
    - **Mensagem:** O valor monetário do benefício municipal informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos subitens 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301, da lista de serviços nacional do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** O valor do desconto incondicionado, se informado na DPS, não é considerado para a redução do valor da BC de forma que resulte para valor do ISSQN a uma alíquota efetiva menor que 2%. (desconsiderar vCalcReepRepRes e vDescIncond)
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `vRedBCBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


#### L309 — Campo `pRedBCBM`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 310
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/`
- **Campo:** `pRedBCBM`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-3V2`
- **Descrição:** Valor percentual (%) informado pelo emitente para redução da base de cálculo (BC) do ISSQN devido a um Benefício Municipal (BM).
- **Notas explicativas:** O limite para este valor percentual informado pelo emitente está previamente parametrizado pelo município de incidência no cadastro do benefício municipal.
- **Regras de negócio associadas:** 4

  - **RN `486` · E0577 · linha 489 · relação inferida**
    - **Regra:** Somente é permitido informar pRedBCBM quando o código de identificação do Benefício Municipal (nBM) for um benefício do tipo Redução de Base de Cálculo por percentual.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0577`
    - **Mensagem:** Não é permitido informar um valor percentual de redução de base de cálculo do ISSQN por benefício municipal, se o código de identificação do Benefício Municipal não corresponder ao tipo de redução por valor percentual.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `pRedBCBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `487` · E0579 · linha 490 · relação inferida**
    - **Regra:** É obrigatório informar pRedBCBM quando o código de identificação do Benefício Municipal (nBM) for um benefício do tipo Redução de Base de Cálculo por percentual.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0579`
    - **Mensagem:** É obrigatório informar pRedBCBM quando o código de identificação do Benefício Municipal (nBM) for um benefício do tipo Redução de Base de Cálculo por percentual.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `pRedBCBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `488` · E0586 · linha 491 · relação inferida**
    - **Regra:** O valor percentual para redução da base de cálculo deve ser maior que 0 e menor ou igual ao percentual parametrizado pelo município de incidência do ISSQN.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0586`
    - **Mensagem:** O valor percentual para redução da base de cálculo deve ser maior que 0 e menor ou igual ao percentual parametrizado pelo município de incidência do ISSQN.
    - **Nível da regra:** `3`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `pRedBCBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.
  - **RN `489` · E0587 · linha 492 · relação inferida**
    - **Regra:** O valor percentual do benefício municipal informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos serviços:<br>042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0587`
    - **Mensagem:** O valor percentual do benefício municipal informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos subitens 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301, da lista de serviços nacional do Sistema Nacional NFS-e.
    - **Nível da regra:** `2`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** O valor do desconto incondicionado, se informado na DPS, não é considerado para a redução do valor da BC de forma que resulte para valor do ISSQN a uma alíquota efetiva menor que 2%.
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/`, campo `pRedBCBM`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/`

#### L313 — Campo `piscofins`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 314
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/`
- **Campo:** `piscofins`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações dos tributos PIS/COFINS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L321 — Campo `vRetCP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 322
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/`
- **Campo:** `vRetCP`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário do CP(R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `524` · E0699 · linha 527 · relação exata**
    - **Regra:** Se o valor do tributo CP for informado, então deve ser maior que zero e menor que o valor do serviço informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0699`
    - **Mensagem:** O valor do tributo CP deve ser maior que zero e menor que o valor do serviço informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L322 — Campo `vRetIRRF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 323
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/`
- **Campo:** `vRetIRRF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário do IRRF (R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `525` · E0700 · linha 528 · relação exata**
    - **Regra:** Se o valor do tributo IRRF for informado, então deve ser maior que zero e menor que o valor do serviço informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0700`
    - **Mensagem:** O valor do tributo IRRF deve ser maior que zero e menor que o valor do serviço informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L323 — Campo `vRetCSLL`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 324
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/`
- **Campo:** `vRetCSLL`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário do CSLL (R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `526` · E0720 · linha 529 · relação exata**
    - **Regra:** Se o tipo de retenção do PIS/COFINS/CSLL for igual a "0 - PIS/COFINS/CSLL Não Retidos", então não é permitido informar o campo vRetCSLL.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0720`
    - **Mensagem:** Se o tipo de retenção do PIS/COFINS for igual a "0 - PIS/COFINS/CSLL Não Retidos", então não é permitido informar o campo vRetCSLL.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `527` · E0724 · linha 530 · relação exata**
    - **Regra:** Se o tipo de retenção do PIS/COFINS/CSLL for diferente de "0 - PIS/COFINS/CSLL Não Retidos" ou <br>de "2 - PIS/COFINS Não Retido", então é obrigatório informar o campo vRetCSLL.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0724`
    - **Mensagem:** Se o tipo de retenção do PIS/COFINS for diferente de "0 - PIS/COFINS/CSLL Não Retidos" ou <br>de "2 - PIS/COFINS Não Retido", então é obrigatório informar o campo vRetCSLL.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `528` · E0701 · linha 531 · relação exata**
    - **Regra:** Se o valor de retenção do CSLL for informado, então deve ser maior que zero e menor que o valor do serviço informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0701`
    - **Mensagem:** O valor do tributo CSLL deve ser maior que zero e menor que o valor do serviço informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`

#### L314 — Campo `CST`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 315
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Campo:** `CST`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Código de Situação Tributária do PIS/COFINS (CST):<br> <br> 00 - Nenhum; <br> 01 - Operação Tributável com Alíquota Básica;<br> 02 - Operação Tributável com Alíquota Diferenciada;<br> 03 - Operação Tributável com Alíquota por Unidade de Medida de Produto;<br> 04 - Operação Tributável monofásica - Revenda a Alíquota Zero;<br> 05 - Operação Tributável por Substituição Tributária;<br> 06 - Operação Tributável a Alíquota Zero;<br> 07 - Operação Isenta da Contribuição;<br> 08 - Operação sem Incidência da Contribuição;<br> 09 - Operação com Suspensão da Contribuição;<br>49 - Outras Operações de Saída;<br>50 - Operação com Direito a Crédito – Vinculada Exclusivamente a Receita Tributada no Mercado Interno;<br>51 - Operação com Direito a Crédito – Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno;<br>52 - Operação com Direito a Crédito – Vinculada Exclusivamente a Receita de Exportação;<br>53 - Operação com Direito a Crédito – Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno;<br>54 - Operação com Direito a Crédito – Vinculada a Receitas Tributadas no Mercado Interno e de Exportação;<br>55 - Operação com Direito a Crédito – Vinculada a Receitas Não Tributadas no Mercado Interno e de Exportação;<br>56 - Operação com Direito a Crédito – Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno e de Exportação;<br>60 - Crédito Presumido – Operação de Aquisição Vinculada Exclusivamente a Receita Tributada no Mercado Interno;<br>61 - Crédito Presumido – Operação de Aquisição Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno;<br>62 - Crédito Presumido – Operação de Aquisição Vinculada Exclusivamente a Receita de Exportação;<br>63 - Crédito Presumido – Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno;<br>64 - Crédito Presumido – Operação de Aquisição Vinculada a Receitas Tributadas no Mercado Interno e de Exportação;<br>65 - Crédito Presumido – Operação de Aquisição Vinculada a Receitas Não-Tributadas no Mercado Interno e de Exportação;<br>66 - Crédito Presumido – Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno e de Exportação;<br>67 - Crédito Presumido – Outras Operações;<br>70 - Operação de Aquisição sem Direito a Crédito;<br>71 - Operação de Aquisição com Isenção;<br>72 - Operação de Aquisição com Suspensão;<br>73 - Operação de Aquisição a Alíquota Zero;<br>74 - Operação de Aquisição sem Incidência da Contribuição;<br>75 - Operação de Aquisição por Substituição Tributária;<br>98 - Outras Operações de Entrada;<br>99 - Outras Operações;
- **Notas explicativas:** Informar a CST relativa ao tipo de incidência tributária da apuração própria, Cumulativa ou Não Cumulativa, de acordo com o o regime de opção.<br><br>Estes códigos não correspondem ao da último GUIA da EFD Contribuições, ver com Orlando e Guilherme se entendem ser necessário adequar
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L315 — Campo `vBCPisCofins`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 316
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Campo:** `vBCPisCofins`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor da Base de Cálculo do PIS/COFINS, relativo à apuração própria (R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `518` · E0677 · linha 521 · relação exata**
    - **Regra:** O valor da BC para Pis/Cofins deve ser menor ou igual ao valor do serviço informado na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Obrig.
    - **Código de erro:** `E0677`
    - **Mensagem:** O valor da BC para Pis/Cofins deve ser menor ou igual ao valor do serviço informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L316 — Campo `pAliqPis`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 317
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Campo:** `pAliqPis`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota do PIS, relativa à apuração própria (%).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `519` · E0686 · linha 522 · relação exata**
    - **Regra:** Se a alíquota do Pis (pAliqPis) for informada, então deve ser igual ou maior que 0 e menor ou igual a 100%.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0686`
    - **Mensagem:** A alíquota do Pis deve ser igual ou maior que 0 e menor ou igual a 100%.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L317 — Campo `pAliqCofins`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 318
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Campo:** `pAliqCofins`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Alíquota da COFINS, relativa à apuração própria (%).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `520` · E0692 · linha 523 · relação exata**
    - **Regra:** Se a alíquota do Cofins (pAliqCofins) for informada, então deve ser igual ou maior que 0 e menor ou igual a 100%.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0692`
    - **Mensagem:** A alíquota do Cofins deve ser igual ou maior que 0 e menor ou igual a 100%.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L318 — Campo `vPis`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 319
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Campo:** `vPis`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor do débito de PIS apuração própria (R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `521` · E0694 · linha 524 · relação exata**
    - **Regra:** Se o valor da alíquota do Pis (pAliqPis) for informado, então o valor do Pis informado na DPS deve ser igual ao valor da base de cálculo do Pis/Cofins x alíquota do Pis, que foram informados na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0694`
    - **Mensagem:** O valor do Pis informado não corresponde ao resultado da BC Pis/Cofins x Alíquota Pis, que foram informados na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L319 — Campo `vCofins`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 320
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Campo:** `vCofins`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor do débito de COFINS apuração própria (R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `522` · E0696 · linha 525 · relação exata**
    - **Regra:** Se o valor da alíquota do Cofins (pAliqCofins) for informado, então o valor Cofins informado na DPS deve ser igual ao valor da base de cálculo do Pis/Cofins x alíquota do Cofins , que foram informados na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0696`
    - **Mensagem:** O valor do Cofins informado não corresponde ao resultado da BC Pis/Cofins x Alíquota Cofins, que foram informados na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L320 — Campo `tpRetPisCofins`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 321
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Campo:** `tpRetPisCofins`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1`
- **Descrição:** Tipo de retenção PIS/COFINS e CSLL:<br><br>0 - PIS/COFINS/CSLL Não Retidos;<br>1 - PIS/COFINS Retido;<br>2 - PIS/COFINS Não Retido;<br>3 - PIS/COFINS/CSLL Retidos;<br>4 - PIS/COFINS Retidos, CSLL Não Retido;<br>5 - PIS Retido, COFINS/CSLL Não Retido;<br>6 - COFINS Retido, PIS/CSLL Não Retido;<br>7 - PIS Não Retido, COFINS/CSLL Retidos;<br>8 - PIS/COFINS Não Retidos, CSLL Retido;<br>9 - COFINS Não Retido, PIS/CSLL Retidos;
- **Notas explicativas:** Indica quais contribuições retidas na fonte compoem o campo vRetCSLL.
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/`

#### L325 — Campo `vTotTrib`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 326
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/`
- **Campo:** `vTotTrib`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Valor monetário total aproximado dos tributos,<br>em conformidade com o artigo 1o da Lei no 12.741/2012
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L333 — Campo `indTotTrib`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 334
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/`
- **Campo:** `indTotTrib`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Indicador de informação de valor total de tributos.<br>Se informado indica que o emitente opta por não informar nenhum valor estimado para os Tributos<br>(Decreto 8.264/2014).<br><br>0 - Não;
- **Notas explicativas:** —
- **Regras de negócio associadas:** 2

  - **RN `538` · E0712 · linha 541 · relação exata**
    - **Regra:** Se a situação do emitente da DPS perante o Simples Nacional na data de competência informada for ME/EPP, o choice indTotTrib nunca poderá ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0712`
    - **Mensagem:** Para ME/EPP indTotTrib nunca poderá ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
  - **RN `539` · E0713 · linha 542 · relação exata**
    - **Regra:** Se a situação do emitente da DPS perante o Simples Nacional na data de competência informada for Não Optante, indTotTrib e pTotTribSN nunca poderá ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0713`
    - **Mensagem:** Para Não Optante do SN os campos, indicador de informação de valor total de tributos e  percentual aproximado do total dos tributos da alíquota do Simples Nacional (%), não podem ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L334 — Campo `pTotTribSN`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 335
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/`
- **Campo:** `pTotTribSN`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Valor percentual aproximado do total dos tributos da alíquota do Simples Nacional (%).
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `541` · E0710 · linha 544 · relação exata**
    - **Regra:** Se a situação do emitente da DPS perante o Simples Nacional na data de competência informada for MEI, o choice pTotTribSN nunca poderá ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0710`
    - **Mensagem:** Para MEI pTotTribSN nunca poderá ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/`

#### L326 — Campo `vTotTribFed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 327
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/`
- **Campo:** `vTotTribFed`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário total aproximado dos tributos federais (R$).
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `531` · E0702 · linha 534 · relação inferida**
    - **Regra:** Se valor for informado, então deve ser igual ou maior que 0 e menor ou igual o valor do serviço.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0702`
    - **Mensagem:** Se o valor for informado, então deve ser igual ou maior que 0 e menor ou igual o valor do serviço.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/vTotTrib`, campo `vTotTribFed`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


#### L327 — Campo `vTotTribEst`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 328
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/`
- **Campo:** `vTotTribEst`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário total aproximado dos tributos estaduais (R$).
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `532` · E0703 · linha 535 · relação inferida**
    - **Regra:** Se valor for informado, então deve ser igual ou maior que 0 e menor ou igual o valor do serviço.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0703`
    - **Mensagem:** Se o valor for informado, então deve ser igual ou maior que 0 e menor ou igual o valor do serviço.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/vTotTrib`, campo `vTotTribEst`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


#### L328 — Campo `vTotTribMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 329
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/`
- **Campo:** `vTotTribMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário total aproximado dos tributos municipais (R$).
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `533` · E0704 · linha 536 · relação inferida**
    - **Regra:** Se valor for informado, então deve ser igual ou maior que 0 e menor ou igual o valor do serviço.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0704`
    - **Mensagem:** Se o valor for informado, então deve ser igual ou maior que 0 e menor ou igual o valor do serviço.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/vTotTrib`, campo `vTotTribMun`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valorestrib/totTrib/`

#### L329 — Campo `pTotTrib`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 330
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valorestrib/totTrib/`
- **Campo:** `pTotTrib`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Valor percentual total aproximado dos tributos,<br>em conformidade com o artigo 1o da Lei no 12.741/2012
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/`

#### L330 — Campo `pTotTribFed`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 331
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/`
- **Campo:** `pTotTribFed`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Valor percentual total aproximado dos tributos federais (%).
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `535` · E0706 · linha 538 · relação inferida**
    - **Regra:** Se a alíquota for informada, então deve ser igual ou maior que 0 e menor ou igual a 100%.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0706`
    - **Mensagem:** Se a alíquota for informada, então deve ser igual ou maior que 0 e menor ou igual a 100%.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/pTotTrib`, campo `pTotTribFed`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


#### L331 — Campo `pTotTribEst`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 332
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/`
- **Campo:** `pTotTribEst`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Valor percentual total aproximado dos tributos estaduais (%).
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `536` · E0707 · linha 539 · relação inferida**
    - **Regra:** Se a alíquota for informada, então deve ser igual ou maior que 0 e menor ou igual a 100%.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0707`
    - **Mensagem:** Se a alíquota for informada, então deve ser igual ou maior que 0 e menor ou igual a 100%.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/pTotTrib`, campo `pTotTribEst`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


#### L332 — Campo `pTotTribMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 333
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/`
- **Campo:** `pTotTribMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-2V2`
- **Descrição:** Valor percentual total aproximado dos tributos municipais (%).
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `537` · E0708 · linha 540 · relação inferida**
    - **Regra:** Se a alíquota for informada, então deve ser igual ou maior que 0 e menor ou igual a 100%.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0708`
    - **Mensagem:** Se a alíquota for informada, então deve ser igual ou maior que 0 e menor ou igual a 100%.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `X`; ADN / normal = `V`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/pTotTrib`, campo `pTotTribMun`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/`

#### L336 — Campo `finNFSe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 337
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Campo:** `finNFSe`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Indicador da finalidade da emissão de NFS-e <br><br>0 = NFS-e regular;
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L337 — Campo `indFinal`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 338
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Campo:** `indFinal`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1`
- **Descrição:** Indica operação de uso ou consumo pessoal. (art. 57)<br><br>0=Não;<br>1=Sim;
- **Notas explicativas:** Esse campo será descontinuado a partir da implantação do layout da NT 005 que ocorrerá ao longo de 2026, em data a ser divulgada no portal da NFS-e.I327
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L338 — Campo `cIndOp`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 339
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Campo:** `cIndOp`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `6`
- **Descrição:** Código indicador da operação de fornecimento, conforme tabela “código indicador de operação”
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `546` · E0901 · linha 549 · relação exata**
    - **Regra:** O código indicador da operação deve constar na tabela de códigos conforme ANEXO C.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0901`
    - **Mensagem:** Código indicador da operação inexistente.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L339 — Campo `tpOper`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 340
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Campo:** `tpOper`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1`
- **Descrição:** Tipo de Operação com Entes Governamentais ou outros serviços sobre bens imóveis:<br><br>1 – Fornecimento com pagamento posterior;<br>2 - Recebimento do pagamento com fornecimento já realizado;<br>3 – Fornecimento com pagamento já realizado;<br>4 – Recebimento do pagamento com fornecimento posterior;<br>5 – Fornecimento e recebimento do pagamento concomitantes;
- **Notas explicativas:** Campo deve ser informado para as seguintes situações previstas na LC 214/2025:<br><br>Aquisição de serviços pela administração pública direta, por autarquias e por fundações públicas: Art. 10 §2º (Qualquer serviço);<br>Cessão onerosa de bem imóvel: Art. 254 III (Serviço 25.05 da LC 116/2003);<br>Arrendamento de bem imóvel: Art. 254 III (Serviço 15.09 da LC 116/2003);<br>Administração de bem imóvel: Art. 254 IV (Serviço 17.12 da LC 116/2003);<br>Intermediação de bem imóvel: Art. 254 IV (Serviço 10.05 da LC 116/2003).
- **Regras de negócio associadas:** 2

  - **RN `547` · E0903 · linha 550 · relação exata**
    - **Regra:** tpOper deve ser informado se tpEnteGov for informado ou se o serviço prestado (cTribNac) corresponder aos serviços listados da LC 116/2003 (e seus correspondentes na NBS): 25.05; 15.09; 17.12; 10.05.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0903`
    - **Mensagem:** Código do tipo de Operação (tpOper) deve ser informado quando se tratar de uma compra governamental ou um dos serviços da LC 116/2003 listados: 25.05; 15.09; 17.12; 10.05.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `548` · E0904 · linha 551 · relação exata**
    - **Regra:** tpOper não pode ser informado se tpEnteGov não for informado ou o serviço (cTribNac) não corresponder aos serviços da LC 116/2003 (e seus correspondentes na NBS): 25.05; 15.09; 17.12; 10.05.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0904`
    - **Mensagem:** Código do tipo de Operação (tpOper) não pode ser informado quando não se tratar de uma compra governamental ou um dos serviços da LC 116/2003 listados: 25.05; 15.09; 17.12; 10.05.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L340 — Campo `gRefNFSe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 341
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Campo:** `gRefNFSe`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de NFS-e referenciadas.
- **Notas explicativas:** Obrigatório para tpOper = 2 ou 3
- **Regras de negócio associadas:** 2

  - **RN `549` · E0905 · linha 552 · relação exata**
    - **Regra:** O grupo de documentos referenciados (gRefNFSe) deve ser informado quando tpOper = 2 ou 3.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0905`
    - **Mensagem:** O grupo de documentos referenciados deve ser informado para o tipo de operação (tpOper).
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `550` · E0906 · linha 553 · relação exata**
    - **Regra:** O grupo de documentos referenciados (gRefNFSe) não pode ser informado se tpOper não for informado <br>ou quando tpOper = 1, 4 ou 5.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0906`
    - **Mensagem:** O grupo de documentos referenciados não pode ser informado para o tipo de operação (tpOper).
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L342 — Campo `tpEnteGov`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 343
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Campo:** `tpEnteGov`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `1`
- **Descrição:** Tipo de ente governamental<br><br>Para administração pública direta e suas autarquias e fundações: <br>1 = União;<br>2 = Estado;<br>3 = Distrito Federal; <br>4 = Município;
- **Notas explicativas:** Campo só deve ser informado no caso de compras governamentais.
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L343 — Campo `indDest`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 344
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Campo:** `indDest`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** A respeito do Destinatário dos serviços:<br><br>0 – o destinatário é o próprio tomador/adquirente identificado na NFS-e (tomador=adquirente=destinatário);<br>1 – o destinatário não é o próprio adquirente, podendo ser outra pessoa, física ou jurídica (ou equiparada), ou um estabelecimento diferente do indicado como tomador (tomador=adquirente≠destinatário);
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L344 — Campo `dest`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 345
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Campo:** `dest`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas ao Destinatário
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `554` · E0910 · linha 557 · relação exata**
    - **Regra:** O destinatário só deve ser identificado quando indDest for 1.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0910`
    - **Mensagem:** O destinatário não deve ser identificado para o código indicador indDest informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L365 — Campo `imovel`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 366
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Campo:** `imovel`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações de operações relacionadas a bens imóveis, exceto obras.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `579` · E0931 · linha 582 · relação exata**
    - **Regra:** Se o código de tributação nacional (cTribNac) pertencer a um dos subitens, 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01 e 07.19.01 da lista de serviços, então o grupo de informações de imóvel não é permitido.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0931`
    - **Mensagem:** Não é permitido o grupo de informações relativo a imóvel quando o código de tributação nacional, relativo à construção civil, for infomado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `580` · E0932 · linha 583 · relação exata**
    - **Regra:** Se o código de tributação nacional (cTribNac) não pertencer a algum dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01 e 07.19.01 da lista de serviços e, o código indicador da operação (cIndOp) for relativo a operações com imóveis (020101, 020201 ou 020301), então o grupo de informações de imóvel é obrigatório.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0932`
    - **Mensagem:** É obrigatório o grupo de informações relativo ao imóvel na DPS quando o código indicador da operação informado for relacionado à imóvel conforme a tabela IndOp do ANEXO_C-INDOP_IBSCBS-SNNFSe-ESPEC.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `581` · E0928 · linha 584 · relação exata**
    - **Regra:** Se o código de tributação nacional (cTribNac) não pertencer a algum dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01 e 07.19.01 da lista de serviços e, o código indicador da operação (cIndOp) não for relativo a operações com imóveis (020101, 020201 ou 020301), então o grupo de informações de imóvel não é permitido.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0928`
    - **Mensagem:** Não é permitido o grupo de informações relativo a imóvel quando o código de tributação nacional (cTribNac) não pertencer a algum dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01 e 07.19.01 da lista de serviços e, o código indicador da operação (cIndOp) não for relativo a operações com imóveis (020101, 020201 ou 020301), conforme a tabela IndOp do ANEXO_C-INDOP_IBSCBS-SNNFSe-ESPEC.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L378 — Campo `valores`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 379
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Campo:** `valores`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas aos valores do serviço prestado para IBS e CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/gRefNFSe/`

#### L341 — Campo `refNFSe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 342
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/gRefNFSe/`
- **Campo:** `refNFSe`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-99`
- **Tamanho:** `50`
- **Descrição:** Chave da NFS-e referenciada.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `551` · E0907 · linha 554 · relação exata**
    - **Regra:** A chave NFS-e referenciada deve ser uma chave válida (validar DV)
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0907`
    - **Mensagem:** NFS-e referenciada é inválida.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`

#### L345 — Campo `CNPJ`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 346
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Campo:** `CNPJ`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `14`
- **Descrição:** Número da inscrição no Cadastro Nacional de Pessoa Jurídica (CNPJ) do destinatário de serviço
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `555` · E0911 · linha 558 · relação exata**
    - **Regra:** CNPJ informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0911`
    - **Mensagem:** CNPJ do destinatário informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `556` · E0912 · linha 559 · relação exata**
    - **Regra:** CNPJ do destinatário não existe no cadastro CNPJ na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0912`
    - **Mensagem:** CNPJ do destinatário não encontrado no cadastro CNPJ na data de competência.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L346 — Campo `CPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 347
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Campo:** `CPF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `11`
- **Descrição:** Número da inscrição no Cadastro Nacional de Pessoa Física (CPF) do destinatário do serviço
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `557` · E0913 · linha 560 · relação exata**
    - **Regra:** CPF informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0913`
    - **Mensagem:** CPF do destinatário informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `558` · E0914 · linha 561 · relação exata**
    - **Regra:** CPF do destinatário não existe no cadastro CPF na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0914`
    - **Mensagem:** CPF do destinatário não encontrado no cadastro CPF na data de competência.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L347 — Campo `NIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 348
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Campo:** `NIF`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `40`
- **Descrição:** Número de identificação fiscal fornecido por órgão de administração tributária no exterior
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L348 — Campo `cNaoNIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 349
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Campo:** `cNaoNIF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Motivo para não informação do NIF:<br> <br> 0 - Não informado na nota de origem;<br> 1 - Dispensado do NIF;<br> 2 - Não exigência do NIF;
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L349 — Campo `xNome`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 350
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Campo:** `xNome`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-150`
- **Descrição:** Nome / Nome Empresarial do destinatário
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L350 — Campo `end`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 351
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Campo:** `end`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço do destinatário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L363 — Campo `fone`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 364
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Campo:** `fone`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `6-20`
- **Descrição:** Número do telefone do destinatário.<br> (Preencher com o Código DDD + número do telefone.  Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L364 — Campo `email`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 365
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Campo:** `email`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-80`
- **Descrição:** E-mail do destinatário.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `578` · E0930 · linha 581 · relação exata**
    - **Regra:** E-mail deve ser informado conforme estrutura (conter @, ponto etc.).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0930`
    - **Mensagem:** E-mail inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`

#### L351 — Campo `endNac`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 352
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Campo:** `endNac`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço nacional.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L354 — Campo `endExt`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 355
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Campo:** `endExt`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço no exterior.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L359 — Campo `xLgr`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 360
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Campo:** `xLgr`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Tipo e nome do logradouro do endereço do destinatário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L360 — Campo `nro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 361
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Campo:** `nro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Número no logradouro do endereço do destinatário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L361 — Campo `xCpl`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 362
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Campo:** `xCpl`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-156`
- **Descrição:** Complemento do endereço do destinatário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L362 — Campo `xBairro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 363
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Campo:** `xBairro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Bairro do endereço do destinatário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endNac/`

#### L352 — Campo `cMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 353
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endNac/`
- **Campo:** `cMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código do município do endereço do destinatário do serviço.<br>  (Tabela do IBGE)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 3

  - **RN `564` · E0920 · linha 567 · relação exata**
    - **Regra:** O código do município para o endereço do destinatário do serviço não existe, conforme tabela IBGE.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0920`
    - **Mensagem:** O código do município para o endereço do destinatário do serviço não existe conforme tabela de município do IBGE.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `565` · E0921 · linha 568 · relação exata**
    - **Regra:** Se o destinatário for identificado pelo CNPJ, o código do município do endereço do destinatário deve existir e corresponder ao município do seu endereço no cadastro CNPJ na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0921`
    - **Mensagem:** O código do município informado na DPS para o endereço do destinatário do serviço, identificado pelo CNPJ, não corresponde ao município registrado em seus cadastros na data de competência informada na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `566` · E0922 · linha 569 · relação exata**
    - **Regra:** Se o destinatário for identificado pelo CPF, o código do município do endereço do destinatário deve existir e corresponder ao município do seu endereço no cadastro CPF na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0922`
    - **Mensagem:** O código do município informado na DPS para o endereço do destinatário do serviço, identificado pelo CPF, não corresponde ao município registrado em seus cadastros na data de competência informada na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L353 — Campo `CEP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 354
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endNac/`
- **Campo:** `CEP`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP) do endereço do destinatário do serviço.<br>(Informar os zeros não significativos)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/`

#### L355 — Campo `cPais`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 356
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/`
- **Campo:** `cPais`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Código do país do endereço do destinatário do serviço.<br>  (Tabela de Países ISO)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L356 — Campo `cEndPost`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 357
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/`
- **Campo:** `cEndPost`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-11`
- **Descrição:** Código alfanumérico do Endereçamento Postal no exterior do destinatário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L357 — Campo `xCidade`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 358
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/`
- **Campo:** `xCidade`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Nome da cidade no exterior do destinatário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L358 — Campo `xEstProvReg`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 359
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/`
- **Campo:** `xEstProvReg`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Estado, província ou região da cidade no exterior do destinatário do serviço.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/`

#### L366 — Campo `inscImobFisc`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 367
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/`
- **Campo:** `inscImobFisc`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-30`
- **Descrição:** Inscrição imobiliária fiscal <br> (código fornecido pela prefeitura para a identificação da obra ou para fins de recolhimento do IPTU)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L367 — Campo `cCIB`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 368
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/`
- **Campo:** `cCIB`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Código do Cadastro Imobiliário Brasileiro - CIB
- **Notas explicativas:** —
- **Regras de negócio associadas:** 1

  - **RN `583` · E0933 · linha 586 · relação exata**
    - **Regra:** Código do Cadastro Imobiliário Brasileito - CIB deve ser um código válido - 7 caracteres + DV
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0933`
    - **Mensagem:** Código CIB inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L368 — Campo `end`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 369
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/`
- **Campo:** `end`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do endereço do imóvel.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/`

#### L369 — Campo `CEP`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 370
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/`
- **Campo:** `CEP`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `8`
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP) do endereço do imóvel.<br>(Informar os zeros não significativos)
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L370 — Campo `endExt`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 371
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/`
- **Campo:** `endExt`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações descritivas do endereço do imóvel no exterior.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `586` · E0934 · linha 589 · relação exata**
    - **Regra:** Se o pais local da prestação do serviço foi informado (cPaisPrestacao foi informado), então o grupo de informações de endereço no exterior deve ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0934`
    - **Mensagem:** O grupo de informações de endereço da atividade sobre bem imóvel ocorrido no exterior deve ser informado quando o país do local da prestação for informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `587` · E0935 · linha 590 · relação exata**
    - **Regra:** Se o município local da prestação do serviço foi informado (cMunPrestacao foi informado), então o grupo de informações de endereço no exterior não pode ser informado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0935`
    - **Mensagem:** O grupo de informações de endereço da atividade sobre bem imóvel ocorrido no exterior não deve ser informado quando o município do local da prestação for informado na DPS.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L374 — Campo `xLgr`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 375
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/`
- **Campo:** `xLgr`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Tipo e nome do logradouro do endereço do imóvel.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L375 — Campo `nro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 376
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/`
- **Campo:** `nro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Número no logradouro do endereço do imóvel.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L376 — Campo `xCpl`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 377
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/`
- **Campo:** `xCpl`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-156`
- **Descrição:** Complemento do endereço do imóvel.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L377 — Campo `xBairro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 378
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/`
- **Campo:** `xBairro`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Bairro do endereço do imóvel.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/endExt/`

#### L371 — Campo `cEndPost`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 372
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/endExt/`
- **Campo:** `cEndPost`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-11`
- **Descrição:** Código de Endereçamento Postal alfanumérico do endereço do imóvel no exterior.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L372 — Campo `xCidade`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 373
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/endExt/`
- **Campo:** `xCidade`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Nome da cidade no exterior, local do imóvel.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L373 — Campo `xEstProvReg`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 374
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/end/endExt/`
- **Campo:** `xEstProvReg`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-60`
- **Descrição:** Estado, província ou região da cidade no exterior, local do imóvel.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/`

#### L379 — Campo `gReeRepRes`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 380
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/`
- **Campo:** `gReeRepRes`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relativas a valores incluídos neste documento e recebidos por motivo de estarem relacionadas a operações de terceiros, objeto de reembolso, repasse ou ressarcimento pelo recebedor, já tributados e aqui referenciados
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L403 — Campo `trib`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 404
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/`
- **Campo:** `trib`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relacionados aos tributos IBS e CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/`

#### L380 — Campo `documentos`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 381
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/`
- **Campo:** `documentos`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1000`
- **Tamanho:** `-`
- **Descrição:** Grupo relativo aos documentos referenciados nos casos de reembolso, repasse e ressarcimento que serão considerados na base de cálculo do ISSQN, do IBS e da CBS.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/`

#### L381 — Campo `dFeNacional`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 382
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/`
- **Campo:** `dFeNacional`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações de documentos fiscais eletrônicos que se encontram no repositório nacional.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L385 — Campo `docFiscalOutro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 386
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/`
- **Campo:** `docFiscalOutro`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações de documento fiscais, eletrônicos ou não, que não se encontram no repositório nacional.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `603` · E0942 · linha 606 · relação inferida**
    - **Regra:** Outros documentos fiscais só podem ser informados se a data de competência do documento (dtCompDoc) for anterior a 31/12/2025.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0942`
    - **Mensagem:** Outros documentos ficais fiscais não podem ser informados quando a data de competência for posterior a 31 de dezembro de 2025.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
    - **Localizador original na aba de regras:** caminho `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos`, campo `docFiscalOutro`.
    - **Nota de associação:** correspondência inferida; o texto original não foi corrigido nem substituído.


#### L389 — Campo `docOutro`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 390
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/`
- **Campo:** `docOutro`
- **ELE:** `CG`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações de documento não fiscal.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L392 — Campo `fornec`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 393
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/`
- **Campo:** `fornec`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações do fornecedor do documento referenciado
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L398 — Campo `dtEmiDoc`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 399
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/`
- **Campo:** `dtEmiDoc`
- **ELE:** `E`
- **TIPO:** `D`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Data da emissão do documento dedutível.<br>Ano, mês e dia (AAAA-MM-DD)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `618` · E0950 · linha 621 · relação exata**
    - **Regra:** Data de emissão do documento tem que ser igual ou posterior à data de competência (dtCompDoc)
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0950`
    - **Mensagem:** Data de emissão do documento tem que ser igual ou posterior à data de competência (dtCompDoc)
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L399 — Campo `dtCompDoc`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 400
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/`
- **Campo:** `dtCompDoc`
- **ELE:** `E`
- **TIPO:** `D`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Data da competência do documento dedutível.<br>Ano, mês e dia (AAAA-MM-DD)
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `619` · E0951 · linha 622 · relação exata**
    - **Regra:** Data de competência do documento tem que ser igual ou anterior à data de emissão (dtEmiDoc)
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0951`
    - **Mensagem:** Data de competência do documento tem que ser igual ou anterior à data de emissão (dtEmiDoc)
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L400 — Campo `tpReeRepRes`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 401
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/`
- **Campo:** `tpReeRepRes`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `2`
- **Descrição:** Tipo de valor incluído neste documento, recebido por motivo de estarem relacionadas a operações de terceiros, objeto de reembolso, repasse ou ressarcimento pelo recebedor, já tributados e aqui referenciados<br><br>  01 = Repasse de remuneração por intermediação de imóveis a demais corretores <br>           envolvidos na operação<br>  02 = Repasse de valores a fornecedor relativo a fornecimento intermediado por <br>           agência de turismo<br>  03 = Reembolso ou ressarcimento recebido por agência de propaganda e <br>           publicidade por valores pagos relativos a serviços de produção externa por conta                           <br>           e ordem de terceiro<br>  04 = Reembolso ou ressarcimento recebido por agência de propaganda e <br>           publicidade por valores pagos relativos a serviços de mídia por conta                           <br>           e ordem de terceiro<br>  99 = Outros reembolsos ou ressarcimentos recebidos por valores pagos relativos a <br>           operações por conta e ordem de terceiro
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L401 — Campo `xTpReeRepRes`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 402
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/`
- **Campo:** `xTpReeRepRes`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `0-150`
- **Descrição:** Descrição do reembolso ou ressarcimento quando a opção é "99 – Outros reembolsos ou ressarcimentos recebidos por valores pagos relativos a operações por conta e ordem de terceiro".
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `621` · E0952 · linha 624 · relação exata**
    - **Regra:** A descrição do tipo de reembolso, repasse e ressarcimento só deve ser informada quando o tpReeRepRes = 99
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0952`
    - **Mensagem:** A descrição do tipo de reembolso, repasse e ressarcimento não deve ser preenchida.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L402 — Campo `vlrReeRepRes`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 403
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/`
- **Campo:** `vlrReeRepRes`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-15V2`
- **Descrição:** Valor monetário (total ou parcial, conforme documento informado) utilizado para não inclusão na base de cálculo do ISS e do IBS e da CBS da NFS-e que está sendo emitida (R$).
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `622` · E0953 · linha 625 · relação exata**
    - **Regra:** O valor reembolso, repasse e ressarcimento deve ser menor ou igual ao valor do serviço prestado.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0953`
    - **Mensagem:** O valor reembolso, repasse e ressarcimento deve ser menor ou igual ao valor do serviço prestado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/dFeNacional/`

#### L382 — Campo `tipoChaveDFe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 383
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/dFeNacional/`
- **Campo:** `tipoChaveDFe`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Documento fiscal a que se refere a chaveDfe que seja um dos documentos do Repositório Nacional:<br>1 = NFS-e;<br>2 = NF-e;<br>3 = CT-e;<br>9 = Outro;
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L383 — Campo `xTipoChaveDFe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 384
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/dFeNacional/`
- **Campo:** `xTipoChaveDFe`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `0-1`
- **Tamanho:** `1-255`
- **Descrição:** Descrição da DF-e a que se refere a chaveDfe que seja um dos documentos do Repositório Nacional. Deve ser preenchido apenas quando tipoChaveDFe = 9 (Outro).
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L384 — Campo `chaveDFe`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 385
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/dFeNacional/`
- **Campo:** `chaveDFe`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-50`
- **Descrição:** Chave do Documento Fiscal eletrônico do repositório nacional referenciado para os casos de operações já tributadas.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `601` · E0940 · linha 604 · relação exata**
    - **Regra:** A chave do Documento Fiscal eletrônico - DF-e deve estar no formato DF-e indicado no tipo.<br>Verificar tamanho: NFSe - 50 dígitos e NFe e CTe - 44 dígitos
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0940`
    - **Mensagem:** Chave DF-e incorreta.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/docFiscalOutro/`

#### L386 — Campo `cMunDocFiscal`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 387
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/docFiscalOutro/`
- **Campo:** `cMunDocFiscal`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `7`
- **Descrição:** Código do município emissor do documento fiscal que não se encontra no repositório nacional
- **Notas explicativas:** -
- **Regras de negócio associadas:** 1

  - **RN `604` · E0943 · linha 607 · relação exata**
    - **Regra:** O código deve existir conforme tabela de município do IBGE.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0943`
    - **Mensagem:** O código do município emissor do documento fiscal para fins de reembolso, repasse e ressarcimento que não está no repositório nacional está incorreto.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L387 — Campo `nDocFiscal`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 388
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/docFiscalOutro/`
- **Campo:** `nDocFiscal`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Número do documento fiscal que não se encontra no repositório nacional
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L388 — Campo `xDocFiscal`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 389
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/docFiscalOutro/`
- **Campo:** `xDocFiscal`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Descrição do documento fiscal
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/docOutro/`

#### L390 — Campo `nDoc`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 391
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/docOutro/`
- **Campo:** `nDoc`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Número do documento não fiscal.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L391 — Campo `xDoc`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 392
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/docOutro/`
- **Campo:** `xDoc`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-255`
- **Descrição:** Descrição do documento não fiscal.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/fornec/`

#### L393 — Campo `CNPJ`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 394
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/fornec/`
- **Campo:** `CNPJ`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `14`
- **Descrição:** Número da inscrição federal (CNPJ) do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `611` · E0945 · linha 614 · relação exata**
    - **Regra:** CNPJ informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0945`
    - **Mensagem:** CNPJ do fornecedor de reembolso, repasse e ressarcimento informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `612` · E0946 · linha 615 · relação exata**
    - **Regra:** CNPJ do fornecedor não existe no cadastro CNPJ na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0946`
    - **Mensagem:** CNPJ do fornecedor de reembolso, repasse e ressarcimento informado não encontrado no cadastro CNPJ na data de competência.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L394 — Campo `CPF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 395
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/fornec/`
- **Campo:** `CPF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `11`
- **Descrição:** Número da inscrição federal (CPF) do fornecedor.
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `613` · E0947 · linha 616 · relação exata**
    - **Regra:** CPF informado na DPS é inválido (verificar DV).
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0947`
    - **Mensagem:** CPF do fornecedor de reembolso, repasse e ressarcimento informado informado na DPS é inválido.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -
  - **RN `614` · E0948 · linha 617 · relação exata**
    - **Regra:** CPF do fornecedor não existe no cadastro CPF na data de competência informada na DPS.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0948`
    - **Mensagem:** CPF do fornecedor de reembolso, repasse e ressarcimento informado não encontrado no cadastro CPF na data de competência.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `X`; ADN / `cStat=102` = `X`.
    - **Observações de negócio:** -


#### L395 — Campo `NIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 396
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/fornec/`
- **Campo:** `NIF`
- **ELE:** `CE`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `40`
- **Descrição:** Este elemento só deverá ser preenchido para fornecedores não residentes no Brasil.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L396 — Campo `cNaoNIF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 397
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/fornec/`
- **Campo:** `cNaoNIF`
- **ELE:** `CE`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1`
- **Descrição:** Motivo para não informação do NIF:<br><br>0 - Não informado na nota de origem;<br>1 - Dispensado do NIF;<br>2 - Não exigência do NIF;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L397 — Campo `xNome`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 398
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/fornec/`
- **Campo:** `xNome`
- **ELE:** `E`
- **TIPO:** `C`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-150`
- **Descrição:** Nome / Razão Social do fornecedor.
- **Notas explicativas:** —
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/`

#### L404 — Campo `gIBSCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 405
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/`
- **Campo:** `gIBSCBS`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `1-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relacionadas ao IBS e à CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`

#### L405 — Campo `CST`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 406
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Campo:** `CST`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `3`
- **Descrição:** Código de Situação Tributária do <br>IBS e da CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L406 — Campo `cClassTrib`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 407
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Campo:** `cClassTrib`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `6`
- **Descrição:** Código de Classificação Tributária <br>do IBS e da CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `626` · E0958 · linha 629 · relação exata**
    - **Regra:** Código da classificação tributária - cClassTrib informado não é suportado para as operações de prestação de serviços (validoParaSiglaDfeInformado = false)
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0958`
    - **Mensagem:** cClassTrib para IBS/CBS incorreto para operação de prestação de serviços.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA
  - **RN `627` · E0959 · linha 630 · relação exata**
    - **Regra:** Código da classificação tributária - cClassTrib informado não pertence ao grupo do CST para IBS/CBS informado<br>3 primeiros dígitos do cClassTrib devem ser iguais ao CST
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0959`
    - **Mensagem:** cClassTrib não pertence ao grupo CST indicado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


#### L407 — Campo `cCredPres`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 408
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Campo:** `cCredPres`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `0-1`
- **Tamanho:** `2`
- **Descrição:** Código e classificação do crédito presumido: IBS e CBS.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L408 — Campo `gTribRegular`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 409
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Campo:** `gTribRegular`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações da Tributação Regular
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `632` · E0964 · linha 635 · relação exata**
    - **Regra:** Grupo de tributação regular não deve ser informado quando o indicador para tributação regular (exigeGrupoTributacaoRegular) para o Código da Classificação Tributária - cClassTribIBSCBS for igual a false.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0964`
    - **Mensagem:** Grupo de tributação regular não deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA
  - **RN `633` · E0965 · linha 636 · relação exata**
    - **Regra:** Grupo de tributação regular não deve ser informado quando o indicador para tributação regular (exigeGrupoTributacaoRegular) para o Código da Classificação Tributária - cClassTribIBSCBS for igual a true.
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0965`
    - **Mensagem:** Grupo de tributação regular deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA


#### L411 — Campo `gDif`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 412
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Campo:** `gDif`
- **ELE:** `G`
- **TIPO:** `-`
- **Ocorrência:** `0-1`
- **Tamanho:** `-`
- **Descrição:** Grupo de informações relacionadas ao diferimento para IBS e CBS
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `637` · E0971 · linha 640 · relação exata**
    - **Regra:** O código da situação tributária (cClassTribIBSCBS ) possui indicador que não permite o uso de diferimento (permiteDiferimento=false)
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0971`
    - **Mensagem:** Grupo de diferimento para IBS/CBS não deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA
  - **RN `638` · E0972 · linha 641 · relação exata**
    - **Regra:** O código da situação tributária possui indicador que o diferimento deve ser informado (permiteDiferimento=true)
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0972`
    - **Mensagem:** Grupo de diferimento para IBS/CBS deve ser informado.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gTribRegular/`

#### L409 — Campo `CSTReg`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 410
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gTribRegular/`
- **Campo:** `CSTReg`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `3`
- **Descrição:** Código de Situação Tributária do <br>IBS e da CBS de tributação regular
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L410 — Campo `cClassTribReg`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 411
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gTribRegular/`
- **Campo:** `cClassTribReg`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `6`
- **Descrição:** Código da Classificação Tributária do <br>IBS e da CBS de tributação regular
- **Notas explicativas:** -
- **Regras de negócio associadas:** 2

  - **RN `635` · E0969 · linha 638 · relação exata**
    - **Regra:** Código da classificação tributária - cClassTribReg informado não é suportado para as operações de prestação de serviços (validoParaSiglaDfeInformado = false)
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0969`
    - **Mensagem:** cClassTribReg para IBS/CBS incorreto para operação de prestação de serviços.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** CALCULADORA
  - **RN `636` · E0970 · linha 639 · relação exata**
    - **Regra:** Código da classificação tributária - cClassTrib informado não pertence ao grupo do CST para IBS/CBS informado.<br>3 primeiros dígitos do cClassTribReg devem ser iguais ao CSTReg
    - **Aplicação:** Obrig.
    - **Efeito:** Rej.
    - **Código de erro:** `E0970`
    - **Mensagem:** cClassTribReg não pertence ao grupo CST indicado em CSTReg.
    - **Nível da regra:** `1`
    - **Execução:** Público / normal = `V`; Público / `cStat=102` = `V`; ADN / normal = `V`; ADN / `cStat=102` = `V`.
    - **Observações de negócio:** -


### Caminho de origem: `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/`

#### L412 — Campo `pDifUF`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 413
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/`
- **Campo:** `pDifUF`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-3V2`
- **Descrição:** Percentual de diferimento para o IBS estadual.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L413 — Campo `pDifMun`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 414
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/`
- **Campo:** `pDifMun`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-3V2`
- **Descrição:** Percentual de diferimento para o IBS municipal.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

#### L414 — Campo `pDifCBS`

- **Linha no XLSX (`LEIAUTE DPS_NFS-e`):** 415
- **Caminho no XML (origem):** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/`
- **Campo:** `pDifCBS`
- **ELE:** `E`
- **TIPO:** `N`
- **Ocorrência:** `1-1`
- **Tamanho:** `1-3V2`
- **Descrição:** Percentual de diferimento para a CBS.
- **Notas explicativas:** -
- **Regras de negócio associadas:** nenhuma regra textual específica encontrada na aba `RN DPS_NFS-e` para este caminho/campo.

## 7. Regras de negócio sem associação resolvida

Todas as 429 regras textuais foram associadas a um registro do leiaute: 397 por correspondência exata e 32 por correspondência inferida e explicitamente sinalizada.


## 8. Relações explícitas entre abas e conceitos

### 8.1 `cLocIncid` e `MUN.INCID_INFO.SERV.`

As regras associadas a `NFSe/infNFSe/cLocIncid` determinam que o local de incidência seja validado conforme o código de tributação nacional. Entre as próprias mensagens da aba `RN DPS_NFS-e` há referências textuais à tabela `MUN.INCID_INFO.SERV.` para decidir se o município esperado é o local da prestação, o domicílio do tomador ou o estabelecimento/domicílio do prestador.

### 8.2 `comExt`, `cNBS`, `tribISSQN` e `cPaisResult`

A matriz `EXPORTACAO_EMISSÃO_NFS-e` é a referência de cenário para exportação/comércio exterior. Na aba de regras, os campos `cNBS`, `comExt`, `tribISSQN` e `cPaisResult` possuem validações específicas de exportação/importação; por isso devem ser interpretados em conjunto com os 112 cenários da seção 4.

### 8.3 Grupos específicos `obra` e `atvEvento`

A coluna de obrigatoriedade de grupos específicos em `MUN.INCID_INFO.SERV.` associa determinados códigos de serviço aos grupos `obra` e `atvEvento` do leiaute DPS. Esses grupos aparecem como estruturas XML na seção 6 e suas regras são listadas junto aos respectivos campos.

## 9. Anomalias e inconsistências observadas no XLSX de origem

Esta seção não altera a documentação; registra pontos que um humano ou modelo de IA deve conhecer para não interpretar erros da planilha como regra normativa.

### 9.1 Numeração da aba `RN DPS_NFS-e`

- A coluna `#` contém fórmulas e valores de numeração com inconsistências no arquivo de origem.
- Célula `A21` (linha 21): fórmula `ROW(A17)` → valor `17`.
- Célula `A23` (linha 23): fórmula `ROW(#REF!)` → valor `#REF!`.
- Célula `A65` (linha 65): fórmula `ROW(A61)` → valor `61`.
- Também existem valores repetidos na numeração visível (por exemplo `17` e `61`). Nesta versão, **linha física da planilha + código de erro + índice original** são usados em conjunto para rastreabilidade.

### 9.2 Discrepâncias de caminho/campo entre `LEIAUTE DPS_NFS-e` e `RN DPS_NFS-e`

| Localizador na aba de regras | Localizador associado no leiaute | Códigos de erro afetados |
|---|---|---|
| `NFSe/infNFSe/DPS/infDPS/prest/endNac` | `NFSe/infNFSe/DPS/infDPS/prest/end/endNac` | E0125 |
| `NFSe/infNFSe/DPS/infDPS/serv/docRef` | `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/docRef` | E0420 |
| `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/dEmiDoc` | `NFSe/infNFSe/DPS/infDPS/valores/vDedRed/documentos/docDedRed/dtEmiDoc` | E0472 |
| `NFSe/infNFSe/DPS/valores/trib/tribMun/BM` | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM` | E0533, E0534, E0535, E0536, E0537 |
| `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/nBM` | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/nBM` | E0541, E0544, E0548, E0550 |
| `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/vRedBCBM` | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/vRedBCBM` | E0565, E0567, E0574, E0575 |
| `NFSe/infNFSe/DPS/valores/trib/tribMun/BM/pRedBCBM` | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/pRedBCBM` | E0577, E0579, E0586, E0587 |
| `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/vTotTribvTotTribFed` | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/vTotTribFed` | E0702 |
| `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/vTotTribvTotTribEst` | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/vTotTribEst` | E0703 |
| `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/vTotTribvTotTribMun` | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/vTotTribMun` | E0704 |
| `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/pTotTribpTotTribFed` | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/pTotTribFed` | E0706 |
| `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/pTotTribpTotTribEst` | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/pTotTribEst` | E0707 |
| `NFSe/infNFSe/DPS/infDPS/valores/trib/totalTrib/pTotTribpTotTribMun` | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/pTotTribMun` | E0708 |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentosdocFiscalOutro` | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/gReeRepRes/documentos/docFiscalOutro` | E0942 |
| `NFSe/infNFSe/DPS/Signature` | `NFSe/infNFSe/DPS/infDPS/Signature` | E0714, E0715, E0716, E0717, E0718 |

### 9.3 Espaços externos em identificadores

- `LEIAUTE DPS_NFS-e`, linha 311: campo armazenado como `` tpRetISSQN`` (espaço inicial).
- `LEIAUTE DPS_NFS-e`, linha 321: campo armazenado como `` tpRetPisCofins`` (espaço inicial).
- `LEIAUTE DPS_NFS-e`, linha 338: campo armazenado como ``indFinal `` (espaço final).
- A aba de regras repete os espaços iniciais em `tpRetISSQN` e `tpRetPisCofins`. Para associação interna, os espaços externos foram removidos; a grafia técnica foi preservada.

### 9.4 Comentários técnicos ocultos

- `EXPORTACAO_EMISSÃO_NFS-e`: 55 comentários tradicionais; 54 contêm texto não vazio e estão documentados na seção 4.3.
- `RN DPS_NFS-e`: 32 comentários encadeados, todos incorporados às regras correspondentes na seção 6.

## 10. Orientação para uso por modelos de IA

Para responder perguntas sobre este documento, recomenda-se seguir a seguinte ordem:

1. Localizar o **campo XML** na seção 6 e ler tipo, ocorrência, tamanho, descrição e notas.
2. Ler todas as **regras de negócio associadas** ao campo, incluindo nível, código/mensagem de erro e matriz de execução.
3. Se a regra envolver `cTribNac` ou local de incidência, consultar a seção 3.
4. Se envolver exportação, importação, NBS, país de resultado ou `comExt`, consultar a seção 4.
5. Para erros de transmissão/certificado/XML de recepção, consultar a seção 5.
6. Em caso de divergência de caminho/nome, consultar a seção 9 antes de concluir que se trata de um elemento XML distinto.

---

Fim da documentação convertida.