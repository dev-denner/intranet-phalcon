<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Catraca\Controllers;

use App\Shared\Controllers\ControllerBase;
use App\Modules\Catraca\Models\Movimentos;
use App\Modules\Catraca\Models\Firebird;

/**
 * Class ReportsController
 * @package Catraca\Controllers
 */
class ReportsController extends ControllerBase {

    public function indexAction() {

        try {

            if ($this->request->isPost()) {

                $dateFrom = implode('-', array_reverse(explode('/', $this->request->getPost('dateFrom', 'string'))));
                $dateTo = implode('-', array_reverse(explode('/', $this->request->getPost('dateTo', 'string'))));
                $search = $this->request->getPost('pesquisa', 'string');

                if ($dateTo < $dateFrom && !empty($dateTo)) {
                    throw new \Exception('Data até menor que Data de.');
                }

                $movimentosCount = Movimentos::find("dataMovimento = TO_DATE('{$dateTo}', 'YYYY-MM-DD')");

                if ($movimentosCount->count() <= 0) {

                    $movimentos = new Movimentos();

                    if ($movimentos->deleteByRange($dateFrom, $dateTo) != false) {
                        $firebird = new Firebird();
                        $movimentos = $firebird->getMovimento($dateFrom, $dateTo);

                        foreach ($movimentos as $movimento) {
                            $this->saveMovimentos($movimento);
                        }
                    }
                }

                $movimentos = new Movimentos();
                $this->view->movimentos = $movimentos->getReport($dateFrom, $dateTo, $search);
                $this->view->pesquisa = $dateFrom . '|' . $dateTo . '|' . $search;
                $this->view->export = true;
            }
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
    }

    private function saveMovimentos($request) {
        $movimentos = new Movimentos();
        $this->makeSetObject($request, $movimentos);

        if (!$movimentos->save()) {
            $msg = '';
            foreach ($movimentos->getMessages() as $message) {
                $msg .= $message . '<br />';
            }
            throw new \Exception($msg);
        }
    }

}
