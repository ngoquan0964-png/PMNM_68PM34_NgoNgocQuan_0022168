<?php
class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($viewName, $data = [], $title = 'Hệ thống Quản lý') {
        extract($data);
        $viewname = $viewName;
        require_once '../app/views/layout/masterlayout.php';
    }
}