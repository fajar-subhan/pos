<?php
// * require_once file html2pdf
require_once "libraries/html2pdf/html2pdf.class.php";

// * require_once file config.php yang berada di dalam folder config
require_once "config/config.php";

// * require file tanggal.php yang berada di dalam folder helpers
require_once "helpers/tanggal.php";

// * require file format.php yang berada di dalam folder helpers
require_once "helpers/format.php";

// * require_once file class yang berada didalam folder core secara auto
spl_autoload_register(function ($class) {
    require_once "core/" . $class . ".php";
});
