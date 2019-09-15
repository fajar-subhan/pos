<?php
// ! class controllers untuk parent class 
// ! semua file yang berada didalam folder controllers
class Controllers
{
    // * method untuk require_once file yang berada didalam folder views
    public function view($view, $data = [])
    {
        require_once "application/views/" . $view . ".php";
    }

    // * method untuk require_once file yang berada didalam folder models
    public function model($model)
    {
        require_once "application/models/" . $model . ".php";
        return new $model;
    }
}
