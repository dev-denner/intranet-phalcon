<?php

namespace App\Library\ExportFile;

use Phalcon\Mvc\User\Component;
use Phalcon\Http\Response;

class Export extends Component
{

    protected function download($fileName, $fileTemp)
    {
        //$view = $this->getDI()->get('view');
        //$view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_NO_RENDER);

        $response = new Response();
        $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->setHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setContent(file_get_contents($fileTemp));
        unlink($fileTemp);
        return $response->send();
    }

}
