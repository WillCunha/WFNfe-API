<?php


namespace App;

require_once '../vendor/autoload.php';

use NFePHP\NFe\Make;
use App\InsereProdutos;

/**
 * Classe da API que gera a NFE.
 */
class GeraNfe
{


    /**
     * Variavel que carrega classe do NFE.
     * 
     * @var string
     */

    static public  $nfe;

    /**
     * Variavel que ainda não sei pra que server
     * 
     * @var string
     */
    static public  $cNfEmissor;

    /**
     * Variavel que carrega o codigo da chave
     * 
     * @var string
     */
    static public  $chave;

    /**
     * Variavel que carrega a data da emissão.
     * 
     * @var string
     */
    static public  $dataEmissao;

    /**
     * Variavel que carrega a data da saída.
     * 
     * @var string
     */
    static public  $dataSaida;

    /**
     * Variavel que carrega os dados do emissor
     * 
     */
    static public  $codigoMunicipio;


    /**
     * Variavel que carrega os dados do emissor
     * 
     * @var string
     */
    static public  $razaoSocialEmissor;


    /**
     * Variavel que carrega os dados do emissor
     * 
     * @var string
     */
    static public  $ieEmissor;


    /**
     * Variavel que carrega os dados do emissor
     * 
     * @var string
     */
    static public  $cnpjEmisor;
    /**
     * Variavel que carrega os dados do emissor
     * 
     * @var string
     */
    static public  $ruaEmissor;
    /**
     * Variavel que carrega os dados do emissor
     * 
     * @var string
     */
    static public  $numeroRuaEmissor;
    /**
     * Variavel que carrega os dados do emissor
     * 
     * @var string
     */
    static public  $nomeBairroEmissor;
    /**
     * Variavel que carrega os dados do emissor
     * 
     * @var string
     */
    static public  $codigoMunicipioEmissor;
    /**
     * Variavel que carrega os dados do emissor
     * 
     * @var string
     */
    static public  $nomeCidadeEmissor;
    /**
     * Variavel que carrega os dados do emissor
     * 
     */
    static public  $siglaUFEmissor;
    /**
     * Variavel que carrega os dados do emissor
     * 
     * @var string
     */
    static public  $cepEmissor;
    /**
     * Variavel que carrega os dados do emissor
     * 
     * @var string
     */
    static public  $codigoPaisEmissor;


    /**
     * Variavel que carrega os dados do emissor
     * @var string
     */
    static public  $nomePaisEmissor;

    /**
     * Variável que carrega a Razão Social / NOme do comprador
     * 
     * @var string
     */
    static public  $razaoSocialDest;

    /**
     * Variavel que carrega a Inscrição Estadual do Destinatário
     * 
     * @var string
     */
    static public  $indIEDest;

    /**
     * Variável que carrega a Inscrição Estadual do Destinatário
     * 
     * @var string
     */
    static public  $IEDest;

    /**
     * Variável que carrega o CNPJ do Destinatário 
     * 
     * @var string
     */
    static public  $cnpjDest;

    /**
     * Variavel que carrega a rua do Destinatário
     * 
     * @var string
     */
    static public  $ruaDest;

    /**
     * Variável que carrega o número do endereço do Destinatário
     * 
     * @var string
     */
    static public  $numeroRuaDest;

    /**
     * Variável que carrega o nome do bairro do destinatário
     * 
     * @var string
     */
    static public  $nomeBairroDest;

    /**
     * Variavel que carrega o código da cidade do destinatário
     * 
     * @var string
     */
    static public  $codigoMunicipioDest;

    /**
     * Variavel que carrega o nome da cidade do Destinatário
     * 
     * @var string
     */
    static public  $nomeCidadeDest;

    /**
     * Variavel que carrega a sigla da Unidade Federal do Destinatário
     * 
     * @var string
     */
    static public  $siglaUFDest;

    /**
     * Variável que carrega o CEP do Destinatário
     * 
     * @var string
     */
    static public  $cepDest;



    /**
     * Array que carrega todos os produtos vendidos
     * 
     * @var array
     */
    static public  $arrayProdutos;

    /**
     * Valor total da venda
     * 
     * @var string
     */
    static public  $totalVenda;

    /**
     * Variavel que carrega o modo de frete
     * 
     * @var stdClass
     */
    static public  $modFrete;

    /**
     * Variavel que carrega a quantidade de volumes
     * 
     * @var stdClass
     */
    static public  $quantidadeVol;

    /**
     * Variavel que carrega o tipo de especie do volum
     * 
     * @var string
     */
    static public  $especie;

    /**
     * Variavel que carrega a marca da caixa
     * 
     * @var string
     */
    static public  $marcaCaixa;

    /**
     * Variavel que carrega o peso
     * 
     * @var string
     */
    static public  $peso;

    /**
     * variavel que carrega a quantidade de parcelas
     * 
     * @var string
     */
    static public  $quantidadeParcelas;


    static public function GeraNFE()
    {

        $diaEmissao = date('Y-m-d');
        $horaEmissao = date('H:i:s');

        $nfe = new Make();


        $std = new \stdClass();
        $std->chave = self::$chave;

        $std->versao = '4.00';
        $std->id = null;
        $std->pk_nItem = '';
        $nfe->tagInfNFe($std);

        $std = new \stdClass();
        $std->cUF = '35';
        $std->cNF = self::$cNfEmissor;
        $std->natOp = 'VENDA';
        $std->mod = 55;
        $std->serie = 1;
        $std->nNF = 10;
        $std->dhEmi = $diaEmissao."T".$horaEmissao."-03:00";
        $std->dhSaiEnt = $diaEmissao."T".$horaEmissao."-03:00";
        $std->tpNF = 1;
        $std->idDest = 1;
        $std->cMunFG = self::$codigoMunicipioEmissor;
        $std->tpImp = 1;
        $std->tpEmis = 1;
        $std->cDV = 2;
        $std->tpAmb = 2; // O AMBIENTE DE EMISSÃO ESTÁ EM HOMOLOGAÇÃO, CASO O VALOR SEJA '1' ELE ESTARÁ EM PROD
        $std->finNFe = 1;
        $std->indFinal = 0;
        $std->indPres = 0;
        $std->procEmi = '0';
        $std->verProc = 1;
        $std->modoFrete = 0;
        $nfe->tagide($std);

        $std = new \stdClass();
        $std->xNome = self::$razaoSocialEmissor;
        $std->IE = self::$ieEmissor;
        $std->CRT = 3;
        $std->CNPJ = self::$cnpjEmisor;
        $nfe->tagemit($std);

        $std = new \stdClass();
        $std->xLgr = self::$ruaEmissor;
        $std->nro = self::$numeroRuaEmissor;
        $std->xBairro = self::$nomeBairroEmissor;
        $std->cMun = self::$codigoMunicipioEmissor;
        $std->xMun = self::$nomeCidadeEmissor;
        $std->UF = self::$siglaUFEmissor;
        $std->CEP = self::$cepEmissor;
        $std->cPais = self::$codigoPaisEmissor;
        $std->xPais = self::$nomePaisEmissor;
        $nfe->tagenderEmit($std);

        $std = new \stdClass();
        $std->xNome = self::$razaoSocialDest;
        $std->indIEDest = 9;
        $std->IEDest = self::$IEDest;
        $std->CNPJ = self::$cnpjDest;
        $nfe->tagdest($std);

        $std = new \stdClass();
        $std->xLgr = self::$ruaDest;
        $std->nro = self::$numeroRuaDest;
        $std->xBairro = self::$nomeBairroDest;
        $std->cMun = self::$codigoMunicipioDest;
        $std->xMun = self::$nomeCidadeDest;
        $std->UF = self::$siglaUFDest;
        $std->CEP = self::$cepDest;
        $std->cPais = '1058';
        $std->xPais = 'BRASIL';
        $nfe->tagenderDest($std);

        $std = new \stdClass();
        $i = 0;
        $baseICMS = 0;


        $produtos = self::$arrayProdutos;
        foreach ($produtos as $prod) {
            $std = new \stdClass();
            $idVenda = $prod->idVenda;
            $std->item = $prod->nItem;
            $std->cProd = $prod->cProd;
            $std->cEAN = $prod->cEAN;
            $std->xProd = $prod->xProd;
            $std->NCM = $prod->NCM;
            $std->CFOP = $prod->CFOP;
            $std->uCom = $prod->uCom;
            $std->qCom = $prod->qCom;
            $std->vUnCom = $prod->vUnCom;
            $std->campoModBc = $prod->modBc;
            $std->icms = $prod->icms;
            $std->cstipi = $prod->cstipi;
            $std->ipi = $prod->ipi;
            $std->CST = $prod->CST;
            $std->ipINT = $prod->ipINT;
            $std->cstpis = $prod->cstpis;
            $std->pis = $prod->pis;
            $std->cstcofins = $prod->cstcofins;
            $std->cofins = $prod->cofins;
            $std->orig = $prod->orig;
            $std->vProd = $prod->vProd;
            $std->cEANTrib = $prod->cEANTrib;
            $std->uTrib = $prod->uTrib;
            $std->qTrib = $prod->qTrib;
            $std->vUnTrib = $prod->vUnTrib;
            $std->vFrete = $prod->vFrete;
            $std->vDesc = $prod->vDesc;
            $std->indTot = $prod->indTot;


            $vUnCom = $std->vUnCom;
            $valorTotal = $std->vProd;
            $icms = $std->icms;
            $orig = $std->orig;
            $campoModBc = $std->campoModBc;
            $cstipi = $std->cstipi;
            $ipINT  = $std->ipINT;
            $ipi = $std->ipi;
            $cstpis = $std->cstpis;
            $pis = $std->pis;
            $cstcofins = $std->cstcofins;
            $cofins = $std->cofins;

            InsereProdutos::$idProduto = $std->cProd;
            InsereProdutos::$idVenda = $idVenda;
            InsereProdutos::$nome = $std->xProd;
            InsereProdutos::$quantidade = $std->qCom;
            InsereProdutos::$total = $std->vProd;
            InsereProdutos::insereBanco();
            $nfe->tagprod($std);

            //ICMS - Imposto sobre Circulação de Mercadorias e Serviços
            $std = new \stdClass();
            $std->item = $prod->nItem; //produtos 1
            $std->orig = $prod->orig;
            $std->CST = $prod->CST; // Tributado Integralmente
            $std->modBC = $campoModBc;
            $std->vBC = $valorTotal;   //$qTrib * $vUnTrib
            $std->pICMS = $prod->icms; // Alíquota do Estado de GO p/ 'NCM 2203.00.00 - Cervejas de Malte, inclusive Chope'
            $std->pRedBC = '';
            $std->vICMS = $valorTotal * $icms / 100; // = $vBC * ( $pICMS / 100 )
            $std->vICMSDeson = '';
            $std->motDesICMS = '';
            $std->modBCST = '';
            $std->pMVAST = '';
            $std->pRedBCST = '';
            $std->vBCST = '';
            $std->pICMSST = '';
            $std->vICMSST = '';
            $std->pDif = '';
            $std->vICMSDif = '';
            $std->vICMSOp = '';
            $std->vBCSTRet = '';
            $std->vICMSSTRet = '';

            $vICMS = $std->vICMS;

            $nfe->tagICMS($std);


            //IPI - Imposto sobre Produto Industrializado
            $std = new \stdClass();
            $std->item = $prod->nItem; //produtos 1
            $std->CST = $cstipi; // 50 - Saída Tributada (Código da Situação Tributária)
            $std->clEnq = '';
            $std->cnpjProd = '';
            $std->cSelo = '';
            $std->qSelo = '';
            $std->cEnq = '999';
            $std->vBC = $valorTotal;
            $std->pIPI = $ipi;
            $std->qUnid = $prod->qCom;
            $std->vUnid = '';
            $std->vIPI = $valorTotal * $ipi / 100; // = $vBC * ( $pIPI / 100 )
            $std->CST = $ipINT;

            $vIPI = $std->vIPI;
            $nfe->tagIPI($std);

            //PIS - Programa de Integração Social
            $std = new \stdClass();
            $std->item = $prod->nItem; //produtos 1
            $std->CST = $cstpis; //Operação Tributável (base de cálculo = quantidade vendida x alíquota por unidade de produto)
            $std->vBC = $vUnCom;
            $std->pPIS = $pis;
            $std->vPIS = $valorTotal * $pis / 100;
            $std->qBCProd = $prod->qCom;
            $std->vAliqProd = $valorTotal * $pis / 100;

            $vPIS = $std->vPIS;
            $nfe->tagPIS($std);

            //PISST
            //$std = $nfe->tagPISST($nItem, $vBC, $pPIS, $qBCProd, $vAliqProd, $vPIS);

            //COFINS - Contribuição para o Financiamento da Seguridade Social
            $std = new \stdClass();
            $std->item = $prod->nItem; //produtos 1
            $std->CST = $cstcofins; //Operação Tributável (base de cálculo = quantidade vendida x alíquota por unidade de produto)
            $std->vBC = $vUnCom;
            $std->pCOFINS = $cofins;
            $std->vCOFINS = $valorTotal * $cofins / 100;
            $std->qBCProd = $prod->qCom;
            $std->vAliqProd = $valorTotal * $cofins / 100;

            $vCOFINS = $std->vCOFINS;
            $nfe->tagCOFINS($std);

            //Impostos
            $std = new \stdClass();
            $std->item = $prod->nItem; //produtos 1
            $std->vTotTrib = $vICMS + $vIPI + $vPIS + $vCOFINS; // 226.80 ICMS + 51.50 ICMSST + 50.40 IPI + 39.36 PIS + 81.84 CONFIS
            $nfe->tagimposto($std);
        }
        //Inicialização de váriaveis não declaradas...
        $vII = isset($vII) ? $vII : 0;
        $vIPI = isset($vIPI) ? $vIPI : 0;
        $vIOF = isset($vIOF) ? $vIOF : 0;
        $vPIS = isset($vPIS) ? $vPIS : 0;
        $vCOFINS = isset($vCOFINS) ? $vCOFINS : 0;
        $vICMS = isset($vICMS) ? $vICMS : 0;
        $vBCST = isset($vBCST) ? $vBCST : 0;
        $vST = isset($vST) ? $vST : 0;
        $vISS = isset($vISS) ? $vISS : 0;

        //total
        $std = new \stdClass();
        $vBC = self::$totalVenda;
        $vICMS += $vICMS;
        $vICMSDeson = '0.00';
        $vBCST = '1030.80';
        $vST = '51.50';
        $vProd = self::$totalVenda;
        $vFrete = '0.00';
        $vSeg = '0.00';
        $vDesc = '0.00';
        $vII = '0.00';
        $vIPI += $vIPI;
        $vPIS += $vPIS;
        $vCOFINS += $vCOFINS;
        $vOutro = '0.00';
        $vNF = number_format($vProd - $vDesc - $vICMSDeson + $vST + $vFrete + $vSeg + $vOutro + $vII + $vIPI, 2, '.', '');
        $vTotTrib = number_format($vICMS + $vST + $vII + $vIPI + $vPIS + $vCOFINS + $vIOF + $vISS, 2, '.', '');
        $nfe->tagICMSTot($std);

        //frete
        $std = new \stdClass();
        $std->modFrete = self::$modFrete; //0=Por conta do emitente; 1=Por conta do destinatário/remetente; 2=Por conta de terceiros; 9=Sem Frete;
        $nfe->tagtransp($std);


        $std = new \stdClass();
        $std->qVol = self::$quantidadeVol; //Quantidade de volumes transportados
        $std->esp = self::$especie; //Espécie dos volumes transportados
        $std->marca = self::$marcaCaixa; //Marca dos volumes transportados
        $std->nVol = ' '; //Numeração dos volume
        $std->pesoL = self::$peso; //Kg do tipo Int, mesmo que no manual diz que pode ter 3 digitos verificador...
        $std->pesoB = self::$peso; //...se colocar Float não vai passar na expressão regular do Schema. =\
        $std->aLacres = ' ';
        $nfe->tagvol($std);

        $codigoFatura = rand();
        //dados da fatura
        $std = new \stdClass();
        $std->nFat = $codigoFatura;
        $std->vOrig = self::$totalVenda;
        $std->vDesc = '';
        $std->vLiq = self::$totalVenda;
        $nfe->tagfat($std);

        $parcelas = self::$quantidadeParcelas;
        $valorParcelas = self::$totalVenda / $parcelas;
        $aDup[] = array();
        for ($i = 0; $i < $parcelas; $i++) {
            $aDup = array(
                array($codigoFatura . '-' . $i, '2016-06-20', $valorParcelas),
            );
        }

        foreach ($aDup as $dup) {
            $std = new \stdClass();
            $std->nDup = $dup[0]; //Código da Duplicata
            $std->dVenc = $dup[1]; //Vencimento
            $std->vDup = $dup[2]; // Valor
            $nfe->tagdup($std);
        }

        $aleatorio1 = '1000000';
        // Calculo de carga tributária similar ao IBPT - Lei 12.741/12
        $federal = number_format($aleatorio1, 2, ',', '.');
        $estadual = number_format($aleatorio1, 2, ',', '.');
        $municipal = number_format($aleatorio1, 2, ',', '.');
        $totalT = number_format($aleatorio1, 2, ',', '.');
        $textoIBPT = "Valor Aprox. Tributos R$ {$totalT} - {$federal} Federal, {$estadual} Estadual e {$municipal} Municipal.";

        //Informações Adicionais
        //$infAdFisco = "SAIDA COM SUSPENSAO DO IPI CONFORME ART 29 DA LEI 10.637";
        $std = new \stdClass();
        $std->infAdFisco = "";
        $std->infCpl = "WF Soft - www.wfsoft.com.br | {$textoIBPT} ";
        $nfe->taginfAdic($std);

        $std = new \stdClass();
        $std->CNPJ = '60098716000103';
        $std->xContato = 'WF Soft LTDA';
        $std->email = 'suporte_wfnfe@wfsoft.com';
        $std->fone = '19998064472';
        $nfe->taginfRespTec($std);

        echo "Valor na string IPINT: " . $ipINT;
        $std = $nfe->montaNFe();

        if ($std) {
            header('Content-type: text/xml; charset=UTF-8');
            $xml = $nfe->getXML();

            // $filename = "/var/www/nfe/homologacao/entradas/{self::$chave}-nfe.xml"; // Ambiente Linux

            $filename = "C:/xampp/htdocs/homologacao/entradas/" . self::$chave . "-nfe.xml"; // Ambiente Windows

            file_put_contents($filename, $xml);
            chmod($filename, 0777);
            echo $xml;
        } else {
            header('Content-type: text/html; charset=UTF-8');
            foreach ($nfe->errors as $err) {
                echo 'tag: &lt;' . $err['tag'] . '&gt; ---- ' . $err['desc'] . '<br>';
            }
        }
        $nfe->getErrors();

        return;
    }
}
