<?php

namespace App\Modules\Otrs\Models;

use App\Shared\Models\ModelBase;
use App\Modules\Nucleo\Models\Protheus\Protheus;
use Phalcon\Db\RawValue;
use Phalcon\Http\Response;

class Chamados extends ModelBase
{

    protected $tipo;
    protected $id;
    protected $chamado;
    protected $assunto;
    protected $fila;
    protected $filaMaster;
    protected $servico;
    protected $dataAbertura;
    protected $dataFechamento;
    protected $status;
    protected $totvs;
    protected $prioridade;
    protected $diasAberto;
    protected $periodoDiasAberto;
    protected $cliente;
    protected $proprietario;
    protected $responsavel;
    protected $create;
    protected $update;
    protected $cpf;
    protected $empresa;
    protected $chapa;
    protected $nome;
    protected $email;
    protected $cc;
    protected $masterCc;
    protected $descCc;
    protected $codGestor;
    protected $gestor;
    protected $codDepto;
    protected $depto;

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getChamado()
    {
        return $this->chamado;
    }

    public function getAssunto()
    {
        return $this->assunto;
    }

    public function getFila()
    {
        return $this->fila;
    }

    public function getFilaMaster()
    {
        return $this->filaMaster;
    }

    public function getServico()
    {
        return $this->servico;
    }

    public function getDataAbertura()
    {
        if (empty($this->dataAbertura)) {
            return $this->dataAbertura;
        }
        $myDateTime = \DateTime::createFromFormat('d-M-y', $this->dataAbertura);
        return $myDateTime->format('Y-m-d');
    }

    public function getDataFechamento()
    {
        if (empty($this->dataFechamento)) {
            return $this->dataFechamento;
        }
        $myDateTime = \DateTime::createFromFormat('d-M-y', $this->dataFechamento);
        return $myDateTime->format('Y-m-d');
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getTotvs()
    {
        return $this->totvs;
    }

    public function getPrioridade()
    {
        return $this->prioridade;
    }

    public function getDiasAberto()
    {
        $inicio = \DateTime::createFromFormat('d-M-y', $this->dataAbertura);
        $hoje = new \DateTime();
        $intervalo = $inicio->diff($hoje);
        return $intervalo->days;
    }

    public function getPeriodoDiasAberto()
    {
        $inicio = \DateTime::createFromFormat('d-M-y', $this->dataAbertura);
        $hoje = new \DateTime();
        $intervalo = $inicio->diff($hoje);
        return $intervalo->days - 1;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getProprietario()
    {
        return $this->proprietario;
    }

    public function getResponsavel()
    {
        return $this->responsavel;
    }

    public function getCreate()
    {
        if (empty($this->create)) {
            return $this->create;
        }
        $myDateTime = \DateTime::createFromFormat('d-M-y H:i:s', $this->create);
        return $myDateTime->format('Y-m-d H:i:s');
    }

    public function getUpdate()
    {
        if (empty($this->update)) {
            return $this->update;
        }
        $myDateTime = \DateTime::createFromFormat('d-M-y', $this->update);
        return $myDateTime->format('Y-m-d H:i:s');
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function getChapa()
    {
        return $this->chapa;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCc()
    {
        return $this->cc;
    }

    public function getMasterCc()
    {
        return $this->masterCc;
    }

    public function getDescCc()
    {
        return $this->descCc;
    }

    public function getCodGestor()
    {
        return $this->codGestor;
    }

    public function getGestor()
    {
        return $this->gestor;
    }

    public function getCodDepto()
    {
        return $this->codDepto;
    }

    public function getDepto()
    {
        return $this->depto;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setChamado($chamado)
    {
        $this->chamado = '#' . $chamado;
        return $this;
    }

    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;
        return $this;
    }

    public function setFila($fila)
    {
        $this->fila = $fila;
        return $this;
    }

    public function setFilaMaster($filaMaster)
    {
        $filaMaster = explode('::', $filaMaster);
        $filaMaster = $filaMaster[0];

        if (empty($filaMaster)) {
            $filaMaster = 'Não se aplica';
        }

        $this->filaMaster = $filaMaster;
        return $this;
    }

    public function setServico($servico)
    {
        $this->servico = $servico;
        return $this;
    }

    public function setDataAbertura($dataAbertura)
    {
        $this->dataAbertura = new RawValue("TO_DATE('{$dataAbertura}', 'YYYY-MM-DD HH24:MI:SS')");
        return $this;
    }

    public function setDataFechamento($dataFechamento)
    {
        $this->dataFechamento = new RawValue("TO_DATE('{$dataFechamento}', 'YYYY-MM-DD HH24:MI:SS')");
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setTotvs($totvs)
    {
        $this->totvs = $totvs;
        return $this;
    }

    public function setPrioridade($prioridade)
    {
        $this->prioridade = $prioridade;
        return $this;
    }

    public function setDiasAberto($diasAberto)
    {
        $this->diasAberto = $diasAberto;
        return $this;
    }

    public function setPeriodoDiasAberto($periodoDiasAberto)
    {
        $this->periodoDiasAberto = $periodoDiasAberto;
        return $this;
    }

    public function setCliente($cliente)
    {
        $aux = explode('@', $cliente);

        if (!isset($aux[1]) && !empty($aux[0])) {
            $cliente = $cliente . '@grupompe.com.br';
        }

        $this->cliente = $cliente;
        return $this;
    }

    public function setProprietario($proprietario)
    {
        $this->proprietario = $proprietario;
        return $this;
    }

    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
        return $this;
    }

    public function setCreate($create)
    {
        $this->create = new RawValue("TO_DATE('{$create}', 'YYYY-MM-DD HH24:MI:SS')");
        return $this;
    }

    public function setUpdate($update)
    {
        $this->update = new RawValue("TO_DATE('{$update}', 'YYYY-MM-DD HH24:MI:SS')");
        return $this;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
        return $this;
    }

    public function setChapa($chapa)
    {
        $this->chapa = $chapa;
        return $this;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setCc($cc)
    {
        $this->cc = $cc;
        return $this;
    }

    public function setMasterCc($masterCc)
    {
        $this->masterCc = substr($masterCc, 0, 4);
        return $this;
    }

    public function setDescCc($descCc)
    {
        $this->descCc = $descCc;
        return $this;
    }

    public function setCodGestor($codGestor)
    {
        $this->codGestor = $codGestor;
        return $this;
    }

    public function setGestor($gestor)
    {
        $this->gestor = $gestor;
        return $this;
    }

    public function setCodDepto($codDepto)
    {
        $this->codDepto = $codDepto;
        return $this;
    }

    public function setDepto($depto)
    {
        $this->depto = $depto;
        return $this;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'CHAMADOS';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap()
    {
        return [
            'CD_TIPO' => 'tipo',
            'ID_CHAMADOS' => 'id',
            'CD_COD_CHAMADO' => 'chamado',
            'DS_ASSUNTO' => 'assunto',
            'DS_FILA' => 'fila',
            'DS_MASTER_FILA' => 'filaMaster',
            'DS_SERVICO' => 'servico',
            'DT_DATA_ABERTURA' => 'dataAbertura',
            'DT_DATA_FECHAMENTO' => 'dataFechamento',
            'DS_STATUS' => 'status',
            'CD_TOTVS' => 'totvs',
            'DS_PRIORIDADE' => 'prioridade',
            'NU_DIAS_ABERTO' => 'diasAberto',
            'NU_PER_DIAS_ABERTO' => 'periodoDiasAberto',
            'DS_CLIENTE' => 'cliente',
            'DS_PROPRIETARIO' => 'proprietario',
            'DS_RESPONSAVEL' => 'responsavel',
            'DT_CREATE' => 'create',
            'DT_UPDATE' => 'update',
            'DS_EMPRESA' => 'empresa',
            'CD_CHAPA' => 'chapa',
            'NM_NOME' => 'nome',
            'CD_CPF' => 'cpf',
            'DS_EMAIL' => 'email',
            'CD_CCEO' => 'cc',
            'CD_MASTER_CCEO' => 'masterCc',
            'DS_DESC_CCEO' => 'descCc',
            'CD_COD_GESTOR' => 'codGestor',
            'DS_GESTOR' => 'gestor',
            'CD_COD_DEPTO' => 'codDepto',
            'DS_DEPTO' => 'depto',
        ];
    }

    /**
     *
     * @return array
     */
    public static function exportMap()
    {
        return [
            'fields' => [
                'tipo' => 'Tipo',
                'id' => 'ID',
                'chamado' => 'Chamado',
                'assunto' => 'Assunto',
                'fila' => 'Fila',
                'filaMaster' => 'Fila Pai',
                'servico' => 'Serviço',
                'dataAbertura' => 'Data de Abertura',
                'dataFechamento' => 'Data de Fechamento',
                'status' => 'Status',
                'totvs' => 'Chamados TOTVS',
                'prioridade' => 'Prioridade',
                'diasAberto' => 'Dias Abertos',
                'periodoDiasAberto' => 'Período de Dias Aberto',
                'cliente' => 'Cliente',
                'proprietario' => 'Proprietário',
                'responsavel' => 'Responsável',
                'empresa' => 'Empresa do Cliente',
                'chapa' => 'Chapa do Cliente',
                'nome' => 'Nome do Cliente',
                'cpf' => 'CPF do Cliente',
                'email' => 'E-mail do Cliente',
                'cc' => 'Centro de Custo do Cliente',
                'masterCc' => 'Centro de Custo Pai do Cliente',
                'descCc' => 'Descrição do Centro de Custo do Cliente',
                'codGestor' => 'Código do Gestor do Cliente',
                'gestor' => 'Gestor do Cliente',
                'codDepto' => 'Código do Departamento do CLiente',
                'depto' => 'Departamento do CLiente',
            ],
            'questions' => [
                'tipo' => 'Tipo de Chamados',
                'assunto' => 'Título do Chamado',
                'fila' => 'Fila',
                'dataDe' => 'Data de',
                'dataAte' => 'Data até',
                'gestor' => 'Gestor',
                'centrocusto' => 'Centro de Custo',
                'departamento' => 'Departamento',
                'cliente' => 'Cliente',
                'responsavel' => 'Responsável',
                'proprietario' => 'Proprietário',
                'status' => 'Status',
            ]
        ];
    }

    /**
     *
     * @return boolean
     */
    public function compareChamados()
    {
        $date = $this->readFileOtrs();
        $dados = $this->getChamadosOtrs($date);

        if (!empty($dados)) {
            $this->setChamadosOtrs($dados);
            $merged = $this->getChamadosOtrsMerged($date);
            if (!empty($merged)) {
                $this->deleteChamadosOtrs($merged);
            }
            $this->writeFileOtrs(date('Y-m-d H:i:s'));
        }
        return true;
    }

    /**
     *
     * @param type $date
     * @return type
     */
    private function getChamadosOtrs($date = null)
    {
        $search = '';
        if (!is_null($date)) {
            $search = " AND (ti.change_time > '{$date}' OR ti.change_time IS NULL) ";
        }

        $connection = $this->customSimpleQuery('otrsDb');

        $query = "SELECT
                    CASE
                        WHEN ts.type_id = 3 THEN 'Fechados'
                        ELSE 'Abertos'
                    END AS tipo,
                    ti.id AS id,
                    ti.tn AS chamado,
                    ti.title AS assunto,
                    qu.name AS fila,
                    sv.name AS servico,
                    STR_TO_DATE(DATE_FORMAT(ti.create_time, '%d/%m/%Y'), '%d/%m/%Y') AS data_abertura,
                    IF((ti.ticket_state_id IN (2 , 3)), STR_TO_DATE(DATE_FORMAT(ti.change_time, '%d/%m/%Y'), '%d/%m/%Y'), NULL) AS data_fechamento,
                    ts.name AS status,
                    ti.freetext1 AS totvs,
                    tp.name AS prioridade,
                    TO_DAYS(CURDATE()) - TO_DAYS(ti.create_time) AS dias_aberto,
                    TRUNCATE(TO_DAYS(CURDATE()) - TO_DAYS(ti.create_time), - 1) AS periodo_dias_aberto,
                    ti.customer_id AS cliente,
                    CONCAT(up.first_name, ' ', up.last_name) AS proprietario,
                    CONCAT(ur.first_name, ' ', ur.last_name) AS responsavel,
                    ti.create_time AS create_time,
                    ti.change_time AS update_time
                FROM
                    ticket ti
                        LEFT JOIN queue qu ON qu.id = ti.queue_id
                        LEFT JOIN users up ON up.id = ti.user_id
                        LEFT JOIN users ur ON ur.id = ti.responsible_user_id
                        LEFT JOIN ticket_state ts ON ts.id = ti.ticket_state_id
                        LEFT JOIN ticket_priority tp ON tp.id = ti.ticket_priority_id
                        LEFT JOIN service sv ON sv.id = ti.service_id
                WHERE
                    ti.title IS NOT NULL
                        AND ts.type_id NOT IN (6 , 7)
                        $search
                ORDER BY 1, ti.id";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    /**
     *
     * @param type $date
     * @return type
     */
    private function getChamadosOtrsMerged($date = null)
    {
        $search = '';
        if (!is_null($date)) {
            $search = " AND (t.change_time > '{$date}' OR t.change_time IS NULL)";
        }

        $connection = $this->customSimpleQuery('otrsDb');

        $query = "SELECT
                    t.tn AS chamado
                  FROM ticket t
                  LEFT JOIN ticket_state s
                    ON s.id = t.ticket_state_id
                  WHERE t.title IS NOT NULL
                    AND s.type_id IN (6, 7)
                    $search";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    /**
     *
     * @param type $dados
     */
    private function setChamadosOtrs($dados)
    {
        foreach ($dados as $key => $value) {

            $chamados = new Chamados();
            $chamados->setTipo($value['tipo'])
                      ->setId($value['id'])
                      ->setChamado($value['chamado'])
                      ->setAssunto($value['assunto'])
                      ->setFila($value['fila'])
                      ->setFilaMaster($value['fila'])
                      ->setServico($value['servico'])
                      ->setDataAbertura($value['data_abertura'])
                      ->setDataFechamento($value['data_fechamento'])
                      ->setStatus($value['status'])
                      ->setTotvs($value['totvs'])
                      ->setPrioridade($value['prioridade'])
                      ->setDiasAberto($value['dias_aberto'])
                      ->setPeriodoDiasAberto($value['periodo_dias_aberto'])
                      ->setCliente($value['cliente'])
                      ->setProprietario($value['proprietario'])
                      ->setResponsavel($value['responsavel'])
                      ->setCreate($value['create_time'])
                      ->setUpdate($value['update_time']);

            if (!empty($chamados->getCliente())) {

                $colaborador = new Protheus();
                $ret = $colaborador->getColaboradoresByEmail($chamados->getCliente());

                if ($ret !== false) {

                    $chamados->setCpf($ret['CPF'])
                              ->setEmpresa($ret['EMPRESA'])
                              ->setChapa($ret['CHAPA'])
                              ->setNome($ret['NOME'])
                              ->setEmail($ret['EMAIL'])
                              ->setCc($ret['CCEO'])
                              ->setMasterCc($ret['CCEO'])
                              ->setDescCc($ret['DESCCCEO'])
                              ->setCodGestor($ret['COD_GESTOR'])
                              ->setGestor($ret['GESTOR'])
                              ->setCodDepto($ret['COD_DEPARTAMENTO'])
                              ->setDepto($ret['DEPARTAMENTO']);
                } else {
                    $chamados->setCc('000000000')
                              ->setMasterCc('0000')
                              ->setDescCc('NÃO SE APLICA')
                              ->setCodGestor('000')
                              ->setGestor('NÃO SE APLICA')
                              ->setCodDepto('00')
                              ->setDepto('NÃO SE APLICA');
                }
            } else {
                $chamados->setCc('000000000')
                          ->setMasterCc('0000')
                          ->setDescCc('NÃO SE APLICA')
                          ->setCodGestor('000')
                          ->setGestor('NÃO SE APLICA')
                          ->setCodDepto('00')
                          ->setDepto('NÃO SE APLICA');
            }
            try {
                if ($chamados->save() === false) {
                    $msg = '';
                    foreach ($chamados->getMessages() as $message) {
                        $msg .= $message . '<br />';
                    }
                    echo $msg;
                }
            } catch (\PDOException $e) {
                dump($e);
            }
        }
    }

    /**
     *
     * @param type $dados
     */
    private function deleteChamadosOtrs($dados)
    {
        foreach ($dados as $key => $value) {
            $chamados = self::findFirst("chamado = '#{$value['chamado']}'");

            if ($chamados !== false) {
                try {
                    if ($chamados->delete() === false) {
                        $msg = '';
                        foreach ($chamados->getMessages() as $message) {
                            $msg .= $message . '<br />';
                        }
                        echo $msg;
                    }
                } catch (\Exception $e) {
                    dump($e);
                } catch (\PDOException $p) {
                    dump($p);
                }
            }
        }
    }

    /**
     *
     * @return type
     */
    private function readFileOtrs()
    {
        $path = APP_PATH . '/files/otrs.txt';
        return file_get_contents($path);
    }

    /**
     *
     * @param type $date
     * @return type
     */
    private function writeFileOtrs($date = '2010-01-01 00:00:00')
    {
        $path = APP_PATH . '/files/otrs.txt';
        return file_put_contents($path, $date);
    }

    /**
     *
     * @param type $post
     */
    public function report($post)
    {
        $search = json_decode($post['search']);
        $questions = $this->prepareArrayHead((array) json_decode($post['questions']));
        $fields = $post['fields'];
        $type = $post['type_export'];
        $objects = Chamados::find(['conditions' => $search]);
        $dados = $this->prepareArrayBody($objects, $fields);

        if ($type == 'excel') {
            return $this->writeFileExcel($dados, $questions);
        }
        return false;
    }

    /**
     *
     * @param array $questions
     * @return type
     */
    private function prepareArrayHead(array $questions)
    {
        $return = [];
        foreach ($questions as $key => $value) {
            if (!empty($value)) {
                $return[] = [$key . ':', $value];
            }
        }
        return $return;
    }

    /**
     *
     * @param type $objects
     * @param array $fields
     * @return array
     */
    private function prepareArrayBody($objects, array $fields)
    {
        $return = [];
        $titles = true;
        foreach ($objects as $keyObject => $object) {
            $array = [];

            if ($titles) {
                foreach ($fields as $keyField => $field) {
                    array_push($array, $field);
                }
                $return[] = $array;
                $titles = false;
                $array = [];
            }

            foreach ($fields as $keyField => $field) {
                $method = 'get' . ucfirst($keyField);
                array_push($array, $object->$method());
            }
            $return[] = $array;
        }
        return $return;
    }

    private function writeFileExcel($dados, $questions)
    {

        $objPHPExcel = $this->prepareObjectExcel();
        $objPHPExcel = $this->headExcel($objPHPExcel, $questions, count($dados[0]));
        $objPHPExcel = $this->bodyExcel($objPHPExcel, $dados, count($questions) + 5);

        /* $this->viewExcel($objPHPExcel); exit; */
        return $this->download($objPHPExcel);
    }

    private function prepareObjectExcel()
    {

        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getProperties()->setCreator('Intranet - Grupo MPE')
                  ->setLastModifiedBy('Intranet - Grupo MPE')
                  ->setTitle('OTRS - Relatório de Chamados')
                  ->setCategory('Relatórios');
        $objPHPExcel->getActiveSheet()
                  ->setTitle('Relatório de Chamados');

        $validLocale = \PHPExcel_Settings::setLocale('pt_br');
        if (!$validLocale) {
            echo 'Não é possível definir a localidade para pt_br - revertendo para en_us' . PHP_EOL;
        }

        return $objPHPExcel;
    }

    private function getColunns($width)
    {
        $colunns = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return $colunns[$width - 1];
    }

    private function headExcel($objPHPExcel, $questions, $width)
    {
        $merged = 'A1:' . $this->getColunns($width) . '1';
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'OTRS - Relatório de Chamados')->mergeCells($merged);
        $objPHPExcel = $this->titleStyle($objPHPExcel, $merged);
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Filtros:');
        $objPHPExcel = $this->titleStyle($objPHPExcel, 'B3');
        $objPHPExcel->getActiveSheet()->fromArray($questions, null, 'B4');

        $count = count($questions) + 4;

        for ($i = 4; $i < $count; $i++) {
            $objPHPExcel->getActiveSheet()->mergeCells('C' . $i . ':' . $this->getColunns($width) . $i);
        }

        return $objPHPExcel;
    }

    private function bodyExcel($objPHPExcel, $dados, $width)
    {
        $objPHPExcel->getActiveSheet()->fromArray($dados, null, 'A' . $width);
        $objPHPExcel = $this->titleStyle($objPHPExcel, 'A' . $width . ':' . $this->getColunns(count($dados[0])) . $width);

        $count = count($dados[0]);

        for ($i = 1; $i <= $count; $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($this->getColunns($i))->setAutoSize(true);
        }

        return $objPHPExcel;
    }

    private function titleStyle(\PHPExcel $objPHPExcel, $position)
    {
        $objPHPExcel->getActiveSheet()->getStyle($position)->getFont()->getColor(new \PHPExcel_Style_Color(\PHPExcel_Style_Color::COLOR_DARKGREEN));
        $objPHPExcel->getActiveSheet()->getStyle($position)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($position)->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getStyle($position)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($position)->getFont()->setItalic(true);
        $objPHPExcel->getActiveSheet()->getStyle($position)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);

        return $objPHPExcel;
    }

    private function download($objPHPExcel)
    {
        $fileName = 'Otrs - Relatório de Chamados ' . date('Ymd His') . '.xlsx';

        $fileTemp = tempnam(getcwd() . '/temp/', 'phpexcel');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($fileTemp);

        $view = $this->getDI()->get('view');
        $view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_NO_RENDER);

        $response = new Response();
        $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->setHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setContent(file_get_contents($fileTemp));
        unlink($fileTemp);
        return $response->send();
    }

    private function viewExcel(\PHPExcel $objPHPExcel)
    {
        $objWorksheet = $objPHPExcel->getActiveSheet();
        echo '<table>' . PHP_EOL;
        foreach ($objWorksheet->getRowIterator() as $row) {
            echo '<tr>' . PHP_EOL;
            $cellIterator = $row->getCellIterator();
            //$cellIterator->setIterateOnlyExistingCells(FALSE);
            foreach ($cellIterator as $cell) {
                echo '<td>' .
                $cell->getValue() .
                '</td>' . PHP_EOL;
            }
            echo '</tr>' . PHP_EOL;
        }
        echo '</table>' . PHP_EOL;
    }

}
