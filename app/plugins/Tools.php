<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace SysPhalcon\Plugins;

use Phalcon\Mvc\User\Plugin as Plugin;
use Phalcon\Http\Response;
use Phalcon\Mvc\View;

//include(APP_PATH . '/vendor/mpdf/mpdf/mpdf.php');

class Tools extends Plugin {

    /**
     *
     * @param type $html
     * @param type $options
     * @return type
     * @throws Exception
     */
    public function writePdf($dados = '', $options) {
        if (empty($dados)) {
            throw new Exception('HTML vazio. Uso incorreto do criador de PDF.');
        }

        $parameters['dados'] = $dados->toArray();
        $parameters['title'] = $options['fileName'];

        $html = $this->view->getRender('pdfTemplates', 'index', $parameters, function($view) {
            $view->setMainView('common/pdfTemplates/index');
        });

        $mpdf = new \mPDF('c', 'A4-L');
        $mpdf->cacheTables = true;
        $mpdf->simpleTables = true;
        $mpdf->packTableData = true;
        $mpdf->WriteHTML($html);
        return $mpdf->Output();
    }

    /**
     *
     * @param type $dados
     * @param type $options
     * @return type
     * @throws Exception
     */
    public function writeXLS($dados = NULL, $options = []) {

        if (is_null($dados)) {
            throw new Exception('Não foi enviados dados para criar o arquivo Excel.');
        }

        $download = isset($options['download']) ? $options['download'] : true;
        $fileName = isset($options['fileName']) ? $options['fileName'] : 'Export';
        $createBy = isset($options['createBy']) ? $options['createBy'] : 'Intranet - Grupo MPE';

        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getProperties()->setCreator($createBy)
                ->setLastModifiedBy($createBy)
                ->setTitle($fileName)
                ->setCategory('Arquivos Exportados');
        $objPHPExcel->getActiveSheet()->setTitle($fileName);

        $alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $i = 0;

        foreach ($dados as $dado) {

            $i++;
            $j = 0;
            $l = -1;
            $letra = '';
            $liga = FALSE;
            foreach ($dado as $key => $value) {

                if ($j > 25) {
                    $l++;
                    $j = 0;
                    $liga = TRUE;
                }
                if ($liga) {
                    $letra = $alpha[$l] . $alpha[$j];
                } else {
                    $letra = $alpha[$j];
                }

                if (1 == $i) {

                    /* ------------------Perfumaria---------------------- */
                    $objPHPExcel->getActiveSheet()->getStyle($letra . $i)->getFont()->getColor(new \PHPExcel_Style_Color(\PHPExcel_Style_Color::COLOR_DARKGREEN));
                    $objPHPExcel->getActiveSheet()->getStyle($letra . $i)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle($letra . $i)->getFont()->setSize(12);
                    $objPHPExcel->getActiveSheet()->getStyle($letra . $i)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $objPHPExcel->getActiveSheet()->getStyle($letra . $i)->getFont()->setItalic(true);
                    $objPHPExcel->getActiveSheet()->getStyle($letra . $i)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
                    /* -------------------------------------------------- */

                    $label = str_replace('_', ' ', $key);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra . $i, $label);
                }
                $k = $i + 1;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra . $k, $value);

                $validator = $this->validator;

                //se $value for valor numerico
                if ($validator::intVal()->validate($value) || $validator::floatVal()->validate($value)) {
                    //se tamanho de value for maior que 1 e começão com 0
                    if (substr($value, 0, 1) == '0' && $validator::stringType()->length(2, null)->validate($value) || $validator::stringType()->length(10, null)->validate($value)) {
                        $type = \PHPExcel_Cell_DataType::TYPE_STRING;
                    } else {
                        $type = \PHPExcel_Cell_DataType::TYPE_NUMERIC;
                    }
                } else {
                    $type = \PHPExcel_Cell_DataType::TYPE_STRING;
                }

                $objPHPExcel->getActiveSheet()->setCellValueExplicit($letra . $k, $value, $type);
                $objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
                $j++;
            }
        }

        $fileName = $fileName . ' ' . date('Ymd His') . '.xlsx';

        if ($download) {

            $fileTemp = tempnam(getcwd() . '/temp/', 'phpexcel');
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save($fileTemp);

            return $this->download($fileName, $fileTemp);
        } else {
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save(getcwd() . '/temp/' . $fileName);
            return 'temp/' . $fileName;
        }
    }

    /**
     *
     * @param type $fileName
     * @param type $fileTemp
     * @return type
     */
    private function download($fileName, $fileTemp) {

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_NO_RENDER);

        $response = new Response();
        $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->setHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        //$response->setHeader('Cache-Control', 'max-age=1');
        $response->setContent(file_get_contents($fileTemp));
        unlink($fileTemp);
        return $response->send();
    }

    /**
     *
     * @param type $ext
     * @param type $file
     * @return type
     */
    public function readXLS($file) {

        $PHPExcel = new \PHPExcel();

        $excelReader = PHPExcel_IOFactory::createReaderForFile($file);

        $excelReader->setReadDataOnly();
        $excelReader->setLoadAllSheets();
        $excelObj = $excelReader->load($fileName);

        $worksheetNames = $excelObj->getSheetNames($fileName);
        $return = array();
        foreach ($worksheetNames as $key => $sheetName) {

            $excelObj->setActiveSheetIndexByName($sheetName);

            $return[$sheetName] = $excelObj->getActiveSheet()->toArray(null, true, true, true);
        }

        return $return;
    }

}
