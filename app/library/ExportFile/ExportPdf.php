<?php

namespace App\Library\ExportFile;

use App\Library\ExportFile\Export;
use Dompdf\Dompdf;

class ExportPdf extends Export
{

    public function writeFilePdf($dados, $options = [])
    {
        
        $template = 'index';

        $parameters['dados'] = $dados;
        
        if (!empty($options) and isset($options['header'])) {
            $parameters['header'] = $options['header'];
        }
        
        if (!empty($options) and isset($options['template'])) {
            $template = $options['template'];
        }
        
        $html = $this->view->getRender('pdfTemplates', $template, $parameters, function($view) use ($template) {
            return $view->setMainView('common/pdfTemplates/'. $template);
        });

        $mpdf = new \mPDF('c', 'A4-L');
        $mpdf->cacheTables = true;
        $mpdf->simpleTables = true;
        $mpdf->packTableData = true;
        $mpdf->WriteHTML($html);
        return $mpdf->Output();
    }

}
