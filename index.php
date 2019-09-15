<?php
if (empty(session_id())) {
    session_start();
}
// * require_once file init.php yang berada didalam folder application
require_once "application/init.php";

// * buat object dari class Routes
$routes = new Routes();
