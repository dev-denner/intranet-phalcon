<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Plugins;

use Phalcon\Mvc\User\Component;
use Phalcon\Config as ObjectPhalcon;
use App\Modules\Nucleo\Models\Menus;
use App\Modules\Nucleo\Models\PagesCategories;

class Elements extends Component {

    /**
     *
     * @return string
     */
    public function renderMenuPrincipal() {
        try {
            $departments = $this->getMenu();

            $return = '<ul class="main-menu principal">';

            foreach ($departments as $idDepartment => $department) {
                if ($idDepartment === '0') {
                    foreach ($department->category as $idCategory => $category) {
                        if ($idCategory === '0') {
                            foreach ($category->menus as $idMenus => $menus) {
                                $return .= '<li>';
                                $return .= "<a class='{$menus->active}' href='{$menus->slug}'>";
                                $return .= "<i class='{$menus->icon}'></i> ";
                                $return .= $menus->title;
                                $return .= '</a>';
                                $return .= '</li>';
                            }
                        } else {
                            $return .= "<li class='sub-menu {$category->active}'>";
                            $return .= "<a href=''>";
                            $return .= "<i class='{$category->icon}'></i> ";
                            $return .= $category->title;
                            $return .= '</a>';
                            $return .= '<ul>';
                            foreach ($category->menus as $idMenus => $menus) {
                                $return .= '<li>';
                                $return .= "<a class='{$menus->active}' href='{$menus->slug}'>";
                                $return .= "<i class='{$menus->icon}'></i> ";
                                $return .= $menus->title;
                                $return .= '</a>';
                                $return .= '</li>';
                            }
                            $return .= '</ul>';
                            $return .= '</li>';
                        }
                    }
                } else {
                    $return .= "<li class='sub-menu {$department->active}'>";
                    $return .= "<a href=''>";
                    $return .= "<i class='{$department->icon}'></i> ";
                    $return .= $department->title;
                    $return .= '</a>';
                    $return .= '<ul>';
                    foreach ($department->category as $idCategory => $category) {
                        if ($idCategory === '0') {

                            foreach ($category->menus as $idMenus => $menus) {
                                $return .= '<li>';
                                $return .= "<a class='{$menus->active}' href='{$menus->slug}'>";
                                $return .= "<i class='{$menus->icon}'></i> ";
                                $return .= $menus->title;
                                $return .= '</a>';
                                $return .= '</li>';
                            }
                        } else {
                            $return .= "<li class='sub-menu {$category->active}'>";
                            $return .= "<a href=''>";
                            $return .= "<i class='{$category->icon}'></i> ";
                            $return .= $category->title;
                            $return .= '</a>';
                            $return .= '<ul>';
                            foreach ($category->menus as $idMenus => $menus) {
                                $return .= '<li>';
                                $return .= "<a class='{$menus->active}' href='{$menus->slug}'>";
                                $return .= "<i class='{$menus->icon}'></i> ";
                                $return .= $menus->title;
                                $return .= '</a>';
                                $return .= '</li>';
                            }
                            $return .= '</ul>';
                            $return .= '</li>';
                        }
                    }
                    $return .= '</ul>';
                    $return .= '</li>';
                }
            }

            $return .= '<li class="chat-trigger" id="chat-trigger" data-trigger="#chat">
                            <a href="javascript:;"><i class="tm-icon zmdi zmdi-view-comfy"></i> Aplicativos Externos</a>
                        </li>';
            $return .= '</ul>';

            return $return;
        } catch (\Exception $exc) {
            return $this->flash->error($exc->getMessage());
        }
    }

    /**
     *
     * @return string
     */
    public function renderDepartment() {
        $return = '';
        $i = 0;
        $baseUri = $this->url->getBaseUri();

        $colors = $this->getColors();
        shuffle($colors);
        $icons = $this->getDepartments();

        $return .= '<div class="row">';
        foreach ($icons as $key => $value) {

            if ($i % 4 == 0) {
                $return .= '</div>';
                $return .= '<div class="row">';
            }

            $return .= '<div class="col-sm-3">';
            $return .= "<div class='card {$colors[$i][0]}'>";
            $return .= "<a href='{$baseUri}intranet/categories/index/{$value->id}' class='{$colors[$i][1]}'>";
            $return .= '<div class="card-body card-padding">';
            $return .= "<span class='icon-index text-center'>";
            $return .= "<i class='{$value->icon}'></i>";
            $return .= "<b>{$value->title}</b>";
            $return .= '</span>';
            $return .= '</div>';
            $return .= '</a>';
            $return .= '</div>';
            $return .= '</div>';
            $i++;
        }
        $return .= '</div>';

        return $return;
    }

    /**
     *
     * @param type $id
     * @return string
     */
    public function renderCategories($id) {
        $return = '';
        $departments = $this->getMenu($id, true);
        $link = false;

        foreach ($departments as $idDepartment => $department) {

            if ($idDepartment === '0') {
                $departmentTitle = 'Outros';
                $departmentIcon = 'zmdi zmdi-more';
            } else {
                $departmentTitle = $department->title;
                $departmentIcon = $department->icon;
            }

            $return .= '<div class="title_category m-b-15 p-l-30 p-t-10 p-b-10 card">';
            $return .= "<h1 data-id='$idDepartment'><i class='{$departmentIcon}'></i> {$departmentTitle}</h1>";
            $return .= '</div>
                        <div class="grid-isotope row">';

            foreach ($department->category as $idCategory => $category) {

                if ($idDepartment !== '0') {
                    /* if ($idCategory === '0') {
                      continue;
                      } */
                }
                if ($idCategory === '0') {
                    $categoryTitle = 'Miscelâneas';
                    $categoryDescription = 'Menus não associados';
                    $categoryIcon = 'zmdi zmdi-star-circle';
                } else {
                    $categoryTitle = $category->title;
                    $categoryDescription = $category->description;
                    $categoryIcon = $category->icon;
                }

                $return .= '<div class="grid-item col-lg-4">
                                <div class="card">
                                    <div class="card-header">';
                $return .= "<h2 data-id='$idCategory'><i class='{$categoryIcon}'></i> {$categoryTitle} <small>{$categoryDescription}</small></h2>";
                $return .= '</div><!-- grid-header -->
                            <div class="card-body card-padding">
                                <div class="media">
                                    <div class="media-body">';

                if (isset($category->menus)) {
                    foreach ($category->menus as $idMenus => $menu) {
                        $return .= "<a href='{$menu->slug}' class='p-5 a-link' style='display: block' data-id='$idMenus'><i class='{$menu->icon}'></i> {$menu->title} </a>";
                    }
                }
                if (isset($category->document)) {
                    foreach ($category->document as $idDocument => $document) {
                        $return .= $document->description;
                    }
                    $link = true;
                }
                $return .= '</div><!-- media-body -->
                            </div><!-- media -->';
                if ($link) {
                    $return .= $this->renderLink($categoryTitle);
                    $link = false;
                }
                $return .= '</div><!-- card-body -->
                            </div><!-- card -->
                            </div><!-- grid-item -->';
            }

            $return .= '</div>';
        }
        return $return;
    }

    private function renderLink($categoryTitle) {

        switch ($categoryTitle) {
            case 'Portal RH':
                $link = 'http://portalrh.grupompe.com.br/';
                $title = 'Portal RH - TOTVS';
                $description = 'Portal RH do Colaborador';
                break;
            default:
                $link = 'http://ecm.grupompe.com.br/';
                $title = 'ECM - TOTVS';
                $description = 'Gerenciador de Documentos';
                break;
        }

        $return = "<a class='lv-item' href='{$link}' target='_new'>";
        $return .= '<div class="media">';
        $return .= '<div class="pull-left p-relative">';
        $return .= "<img class='lv-img-sm' src='{$this->url->getBaseUri()}assets/img/logos/apps/totvs.png'>";
        $return .= '</div>';
        $return .= '<div class="media-body">';
        $return .= "<div class='lv-title'>{$title}</div>";
        $return .= "<small class='lv-small'>{$description}</small>";
        $return .= '</div>';
        $return .= '</div>';
        $return .= '</a>';

        return $return;
    }

    /**
     *
     * @return type
     */
    public function getColors() {
        return [
            ['bgm-red', 'c-white'],
            ['bgm-deeppurple', 'c-white'],
            ['bgm-indigo', 'c-white'],
            ['bgm-blue', 'c-white'],
            ['bgm-cyan', 'c-white'],
            ['bgm-teal', 'c-white'],
            ['bgm-green', 'c-white'],
            ['bgm-orange', 'c-white'],
            ['bgm-deeporange', 'c-white'],
            ['bgm-bluegray', 'c-white'],
                  //['bgm-gray', 'c-white'],
                  //['bgm-lightblue', 'c-white'],
                  //['bgm-lightgreen', 'c-white'],
                  //['bgm-lime', 'c-white'],
                  //['bgm-pink', 'c-white'],
                  //['bgm-purple', 'c-white'],
                  //['bgm-yellow', 'c-black'],
                  //['bgm-amber', 'c-white'],
                  //['bgm-brown', 'c-white'],
                  //['bgm-black', 'c-white'],
                  //['bgm-white', 'c-black'],
        ];
    }

    /**
     *
     * @return ObjectPhalcon
     */
    private function getDepartments() {

        $return = [];

        $catDocs = PagesCategories::find();
        foreach ($catDocs as $catDoc) {
            $return[$catDoc->department]['id'] = $catDoc->departments->id;
            $return[$catDoc->department]['title'] = $catDoc->departments->title;
            $return[$catDoc->department]['icon'] = $catDoc->departments->icon;
        }

        asort($return);

        $menus = Menus::find(['order' => 'department, title']);

        foreach ($menus as $menu) {

            if ($this->access->isAllowed('private', $menu->modules->slug, $menu->controllers->slug, $menu->actions->slug) or $this->access->isAllowed('public', $menu->modules->slug, $menu->controllers->slug, $menu->actions->slug)) {

                if (!is_object($menu->departments)) {

                    $menu->department = 'outros';
                    $return[$menu->department]['id'] = 0;
                    $return[$menu->department]['title'] = 'Outros';
                    $return[$menu->department]['icon'] = 'zmdi zmdi-more';
                } else {
                    $return[$menu->department]['id'] = $menu->departments->id;
                    $return[$menu->department]['title'] = $menu->departments->title;
                    $return[$menu->department]['icon'] = $menu->departments->icon;
                }
            }
        }

        $return[0]['id'] = 'all';
        $return[0]['title'] = 'Todos';
        $return[0]['icon'] = 'zmdi zmdi-view-comfy';

        return new ObjectPhalcon($return);
    }

    /**
     *
     * @param type $id
     * @param type $docs
     * @return ObjectPhalcon
     */
    private function getMenu($id = null, $docs = false) {
        $return = [];
        $desc = '';
        $keyActive = true;

        if (!$docs) {
            $desc = 'DESC';
        }

        $param['order'] = "department {$desc}, category {$desc}";
        $baseUri = $this->url->getBaseUri();

        if (is_numeric($id)) {
            if ($id == 0) {
                $param['conditions'] = 'department IS NULL ';
            } else {
                $param['conditions'] = 'department = ' . (int) $id;
            }
        }

        if ($docs) {
            $catDocs = PagesCategories::find($param);
            foreach ($catDocs as $catDoc) {

                $department = $catDoc->departments->id;
                $titleDepartment = $catDoc->departments->title;
                $ccDepartment = $catDoc->departments->cc;
                $iconDepartment = $catDoc->departments->icon;

                $category = $catDoc->categories->id;
                $titleCategory = $catDoc->categories->title;
                $descriptionCategory = $catDoc->categories->description;
                $iconCategory = $catDoc->categories->icon;


                $return[$department]['title'] = $titleDepartment;
                $return[$department]['cc'] = $ccDepartment;
                $return[$department]['icon'] = $iconDepartment;
                $return[$department]['active'] = '';
                $return[$department]['category'][$category]['title'] = $titleCategory;
                $return[$department]['category'][$category]['description'] = $descriptionCategory;
                $return[$department]['category'][$category]['icon'] = $iconCategory;
                $return[$department]['category'][$category]['document'][$catDoc->id]['description'] = $catDoc->description;
                $return[$department]['category'][$category]['active'] = '';
            }
        }

        $param['order'] = "department {$desc}, title, category {$desc}";

        $menus = Menus::find($param);

        $currentModule = $this->dispatcher->getModuleName();
        $currentController = $this->dispatcher->getControllerName();
        $currentAction = $this->dispatcher->getActionName();
        $currentDepartment = '';
        $currentCategory = '';

        $baseUri = $this->url->getBaseUri();

        foreach ($menus as $menu) {

            $modules = $menu->modules->slug;
            $controllers = $menu->controllers->slug;
            $actions = $menu->actions->slug;

            if ($this->access->isAllowed('private', $modules, $controllers, $actions)
                      or $this->access->isAllowed('public', $modules, $controllers, $actions)) {

                if (is_null($menu->department)) {
                    $department = 0;
                    $titleDepartment = '';
                    $ccDepartment = '';
                    $iconDepartment = '';
                } else {
                    $department = $menu->departments->id;
                    $titleDepartment = $menu->departments->title;
                    $ccDepartment = $menu->departments->cc;
                    $iconDepartment = $menu->departments->icon;
                }

                if (is_null($menu->category)) {
                    $category = 0;
                    $titleCategory = 0;
                    $descriptionCategory = '';
                    $iconCategory = '';
                } else {
                    $category = $menu->categories->id;
                    $titleCategory = $menu->categories->title;
                    $descriptionCategory = $menu->categories->description;
                    $iconCategory = $menu->categories->icon;
                }

                if ($keyActive) {
                    $return[$department]['active'] = '';
                    $return[$department]['category'][$category]['active'] = '';
                    $return[$department]['category'][$category]['menus'][$menu->id]['active'] = '';
                    $keyActive = false;
                }

                if ($currentModule == $modules && $currentController == $controllers && $currentAction == $actions) {
                    $return[$department]['active'] = 'active toggled';
                    $return[$department]['category'][$category]['active'] = 'active toggled';
                    $return[$department]['category'][$category]['menus'][$menu->id]['active'] = 'active';
                    $currentDepartment = $department;
                    $currentCategory = $category;
                }


                if ($currentDepartment != $department) {
                    $return[$department]['active'] = '';
                }

                if ($currentCategory != $category) {
                    $return[$department]['category'][$category]['active'] = '';
                }
                if ($currentAction != $actions) {
                    $return[$department]['category'][$category]['menus'][$menu->id]['active'] = '';
                }

                $return[$department]['title'] = $titleDepartment;
                $return[$department]['cc'] = $ccDepartment;
                $return[$department]['icon'] = $iconDepartment;
                $return[$department]['category'][$category]['title'] = $titleCategory;
                $return[$department]['category'][$category]['description'] = $descriptionCategory;
                $return[$department]['category'][$category]['icon'] = $iconCategory;
                $return[$department]['category'][$category]['menus'][$menu->id]['title'] = $menu->title;
                $return[$department]['category'][$category]['menus'][$menu->id]['slug'] = $baseUri . $menu->slug;
                $return[$department]['category'][$category]['menus'][$menu->id]['icon'] = $menu->icon;

                if (!isset($return[$department]['active'])) {
                    $return[$department]['active'] = '';
                }
                if (!isset($return[$department]['category'][$category]['active'])) {
                    $return[$department]['category'][$category]['active'] = '';
                }
                if (!isset($return[$department]['category'][$category]['menus'][$menu->id]['active'])) {
                    $return[$department]['category'][$category]['menus'][$menu->id]['active'] = '';
                }
            }
        }

        ksort($return);

        return new ObjectPhalcon($return);
    }

}
