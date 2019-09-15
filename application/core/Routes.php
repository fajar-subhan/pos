<?php
// ! class untuk menentukan controller dan method default
class Routes
{
    // * persiapkan property 'default' untuk menampung 
    // * controller,method,parameter jika ada
    protected $controller = "Login";
    protected $method     = "index";
    protected $params     = [];

    public function __construct()
    {
        // * hasil nilai method getURL()
        $url = $this->getURL();

        // ? cek apakah didalam folder controllers,terdapat nama yang sama dengan
        // ? isi index array $url[0]
        if (file_exists("application/controllers/" . ucfirst($url[0]) . ".php")) {
            // * jika ada maka masukan isi $url[0] kedalam property
            $this->controller = ucfirst($url[0]);
            // * hapus $url[0] = controller 
            unset($url[0]);
        }

        // * require once file yang berada didalam folder controllers
        require_once "application/controllers/" . $this->controller . ".php";

        // * buat object dari property controller 
        $this->controller = new $this->controller;

        // ? cek apakah index array $url[1] ada
        if (isset($url[1])) {
            // ? cek apakah ada nama method didalam object class $this->controller
            // ? yang berasal dari isi index array $_GET[1] 
            if (method_exists($this->controller, $url[1])) {
                // * jika ada maka masukan $url[1] kedalam property method
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // ? cek apakah $url tidak kosong
        if (!empty($url)) {
            $this->params = array_values($url);
            unset($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // * method untuk mengambil index array $_GET['url']
    public function getURL()
    {
        // ? cek apakah ada $_GET["url"],jika ada baru jalankan
        if (isset($_GET["url"])) {
            // * hapus karakter "/" yang berada disebelah kanan url
            $url = rtrim($_GET["url"], "/");
            // * filter url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // * rubah $_GET[url] menjadi sebuah array
            $url = explode("/", $url);
            return $url;
        }
    }
}
