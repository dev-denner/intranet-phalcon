<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace DevDenners\Plugins;

use Phalcon\Mvc\User\Component;
use Phalcon\Config as ObjectPhalcon;
use Nucleo\Models\Menus;

class Elements extends Component {

    /**
     *
     * @return type
     */
    public function renderMenuPrincipal() {
        $return = '';
        $return .= '<ul class="main-menu">';
        $return .= $this->renderMenuPrincipalWithoutCategories();
        $return .= $this->renderMenuPrincipalByCategories();
        $return .= '</ul>';
        return $return;
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
            $return .= "<a href='{$baseUri}intranet/index/categories/{$value->id}' class='{$colors[$i][1]}'>";
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

    public function renderCategories($id) {
        $return = '';
        $categories = $this->getMenuByCategory($id);
        foreach ($categories as $department => $category) {

            $return .= '<div class="title_category m-b-15 p-l-30 p-t-10 p-b-10 card">';
            $return .= "<h1>{$department}</h1>";
            $return .= '</div>';
            $return .= '<div class="row">';
            foreach ($category as $cat) {
                $return .= '<div class="col-sm-4">';
                $return .= '<div class="card">';
                $return .= '<div class="card-header">';
                $return .= "<h2><i class='{$cat->icon}'></i> {$cat->title} <small>{$cat->description}</small></h2>";
                $return .= '</div>';
                $return .= '<div class="card-body card-padding">';
                $return .= '<div class="media">';
                $return .= '<div class="media-body">';
                foreach ($cat->menus as $menu) {
                    $return .= "<a href='{$menu->slug}' class='m-b-15' style='display: block'><h4><i class='{$menu->icon}'></i> {$menu->title} </h4></a>";
                }
                $return .= '</div>';
                $return .= '</div>';
                $return .= '</div>';
                $return .= '</div>';
                $return .= '</div>';
            }
            $return .= '</div>';
        }
        return $return;
    }

    /**
     *
     * @return type
     */
    public function getColors() {
        return [ ['bgm-red', 'c-white'],
            ['bgm-pink', 'c-black'],
            ['bgm-purple', 'c-black'],
            ['bgm-deeppurple', 'c-white'],
            ['bgm-indigo', 'c-white'],
            ['bgm-blue', 'c-white'],
            ['bgm-lightblue', 'c-black'],
            ['bgm-cyan', 'c-black'],
            ['bgm-teal', 'c-white'],
            ['bgm-green', 'c-white'],
            ['bgm-lightgreen', 'c-white'],
            ['bgm-lime', 'c-black'],
            ['bgm-yellow', 'c-black'],
            ['bgm-amber', 'c-black'],
            ['bgm-orange', 'c-black'],
            ['bgm-deeporange', 'c-white'],
            ['bgm-brown', 'c-white'],
            ['bgm-gray', 'c-white'],
            ['bgm-bluegray', 'c-white'],
            ['bgm-black', 'c-white'],
            ['bgm-white', 'c-black'],
        ];
    }

    /**
     *
     * @return string
     */
    private function getMenuPrincipalWithoutCategories() {

        $return = [];
        $i = 0;
        $departmentActive = false;
        $categoryActive = false;

        $currentModule = $this->dispatcher->getModuleName();
        $currentController = $this->dispatcher->getControllerName();
        $currentAction = $this->dispatcher->getActionName();

        $baseUri = $this->url->getBaseUri();

        $menus = Menus::find([
                    'conditions' => 'department IS NULL AND category IS NULL',
        ]);

        foreach ($menus as $menu) {

            if ($this->access->isAllowed('private', $menu->modules->name, $menu->controllers->slug, $menu->actions->slug) or $this->access->isAllowed('public', $menu->modules->name, $menu->controllers->slug, $menu->actions->slug)) {
                if ($currentModule == $menu->modules->name &&
                        $currentController == $menu->controllers->slug &&
                        $currentAction == $menu->actions->slug
                ) {
                    $active = 'active toggled';
                } else {
                    $active = '';
                }

                $return[$menu->id]['slug'] = $baseUri . $menu->slug;
                $return[$menu->id]['title'] = $menu->title;
                $return[$menu->id]['icon'] = $menu->icon;
                $return[$menu->id]['active'] = $active;
            }
        }

        return $return;
    }

    /**
     *
     * @return string
     */
    private function renderMenuPrincipalWithoutCategories() {
        $return = '';
        $dataMenu = $this->getMenuPrincipalWithoutCategories();
        foreach ($dataMenu as $idMenu => $menu) {

            $return .= "<li class='{$menu['active']}'>";
            $return .= "<a href='{$menu['slug']}' data-id='{$idMenu}'>";
            $return .= "<i class='{$menu['icon']}'></i> {$menu['title']}";
            $return .= "</a>";
            $return .= "</li>";
        }

        return $return;
    }

    /**
     *
     * @return string
     */
    private function getMenuPrincipalByCategories() {

        $return = [];
        $departmentActive = false;
        $categoryActive = false;

        $currentModule = $this->dispatcher->getModuleName();
        $currentController = $this->dispatcher->getControllerName();
        $currentAction = $this->dispatcher->getActionName();

        $baseUri = $this->url->getBaseUri();

        $menus = Menus::find([
                    'order' => 'department, category, title',
                    'conditions' => 'department IS NOT NULL AND category IS NOT NULL',
        ]);

        foreach ($menus as $menu) {

            if ($this->access->isAllowed('private', $menu->modules->name, $menu->controllers->slug, $menu->actions->slug) or $this->access->isAllowed('public', $menu->modules->name, $menu->controllers->slug, $menu->actions->slug)) {
                if ($currentModule == $menu->modules->name &&
                        $currentController == $menu->controllers->slug &&
                        $currentAction == $menu->actions->slug
                ) {
                    $active = 'active toggled';
                    $departmentActive = true;
                    $categoryActive = true;
                } else {
                    $active = '';
                }

                $return[$menu->department]['title'] = $menu->departments->title;
                $return[$menu->department]['icon'] = $menu->departments->icon;

                if ($departmentActive) {
                    $return[$menu->department]['active'] = $active;
                    $departmentActive = false;
                }

                $return[$menu->department]['categories'][$menu->category]['title'] = $menu->categories->title;
                $return[$menu->department]['categories'][$menu->category]['icon'] = $menu->categories->icon;

                if ($categoryActive) {
                    $return[$menu->department]['categories'][$menu->category]['active'] = $active;
                    $categoryActive = false;
                }

                $return[$menu->department]['categories'][$menu->category]['menus'][$menu->id]['title'] = $menu->title;
                $return[$menu->department]['categories'][$menu->category]['menus'][$menu->id]['slug'] = $baseUri . $menu->slug;
                $return[$menu->department]['categories'][$menu->category]['menus'][$menu->id]['icon'] = $menu->icon;
                $return[$menu->department]['categories'][$menu->category]['menus'][$menu->id]['active'] = $active;
            }
        }
        return $return;
    }

    /**
     *
     * @return string
     */
    private function renderMenuPrincipalByCategories() {
        $return = '';
        $dataMenu = $this->getMenuPrincipalByCategories();
        foreach ($dataMenu as $departments => $department) {

            if (count($department['categories']) > 0) {
                $submenu = 'sub-menu';
                $hasCategories = true;
            } else {
                $submenu = '';
                $hasCategories = false;
            }

            $activeDepartment = isset($department['active']) ? $department['active'] : '';

            $return .= "<li class='{$submenu} {$activeDepartment}'>";
            $return .= '<a href="javascript:;">';
            $return .= "<i class='{$department['icon']}'></i> {$department['title']}";
            $return .= '</a>';

            if ($hasCategories) {
                $return .= '<ul>';
                foreach ($department['categories'] as $categories => $category) {
                    if (count($category['menus']) > 0) {
                        $submenu = 'sub-menu';
                        $hasmenus = true;
                    } else {
                        $submenu = '';
                        $hasmenus = false;
                    }

                    $activeCategory = isset($category['active']) ? $category['active'] : '';

                    $return .= "<li class='{$submenu} {$activeCategory}'>";
                    $return .= '<a href="javascript:;">';
                    $return .= "<i class='{$category['icon']}'></i> {$category['title']}";
                    $return .= '</a>';
                    if ($hasmenus) {
                        $return .= '<ul>';

                        foreach ($category['menus'] as $menus => $menu) {

                            $return .= '<li>';
                            $return .= "<a class='{$menu['active']}' href='{$menu['slug']}' data-id='{$menus}'>";
                            $return .= "<i class='{$menu['icon']}'></i> {$menu['title']}";
                            $return .= '</a></li>';
                        }
                        $return .= '</ul>';
                    }
                }
                $return .= '</ul>';
            }
            $return .= '</li>';
        }

        return $return;
    }

    /**
     *
     * @return type
     */
    private function getDepartments() {

        $return = [];

        $menus = Menus::find(['order' => 'department, title']);

        foreach ($menus as $menu) {

            if ($this->access->isAllowed('private', $menu->modules->name, $menu->controllers->slug, $menu->actions->slug) or $this->access->isAllowed('public', $menu->modules->name, $menu->controllers->slug, $menu->actions->slug)) {

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
     * @return type
     */
    private function getMenuByCategory($id) {
        $return = [];
        $param['order'] = 'department, title';
        $baseUri = $this->url->getBaseUri();

        if (is_numeric($id)) {
            if ($id == 0) {
                $param['conditions'] = 'department IS NULL ';
            } else {
                $param['conditions'] = 'department = ' . (int) $id;
            }
        }

        $menus = Menus::find($param);

        foreach ($menus as $menu) {

            if ($this->access->isAllowed('private', $menu->modules->name, $menu->controllers->slug, $menu->actions->slug) or $this->access->isAllowed('public', $menu->modules->name, $menu->controllers->slug, $menu->actions->slug)) {

                if (is_null($menu->departments->id)) {
                    $menu->category = 0;
                    $department = 'Outros';
                    $return[$department][$menu->category]['id'] = '';
                    $return[$department][$menu->category]['title'] = 'Miscelâneas';
                    $return[$department][$menu->category]['description'] = 'Menus não associados';
                    $return[$department][$menu->category]['icon'] = 'zmdi zmdi-star-circle';
                } else {
                    $department = $menu->departments->title;
                    $return[$department][$menu->category]['id'] = $menu->categories->id;
                    $return[$department][$menu->category]['title'] = $menu->categories->title;
                    $return[$department][$menu->category]['description'] = $menu->categories->description;
                    $return[$department][$menu->category]['icon'] = $menu->categories->icon;
                }
                $return[$department][$menu->category]['menus'][$menu->id]['title'] = $menu->title;
                $return[$department][$menu->category]['menus'][$menu->id]['slug'] = $baseUri . $menu->slug;
                $return[$department][$menu->category]['menus'][$menu->id]['icon'] = $menu->icon;
            }
        }

        return new ObjectPhalcon($return);
    }

}
