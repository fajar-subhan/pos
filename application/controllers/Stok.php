<?php
class Stok extends Controllers
{
    // * tampilan awal stok 
    public function index()
    {
        //* jika sesi sudah berakhir
        if (!isset($_SESSION["data"]["nama"])) {
            $pesan = "Sesi telah berakhir";
            $pesan = urlencode($pesan);
            header("location:" . BASEURL . "$pesan");
        }

        $this->data["title"] = "Stok Barang - Aplikasi Point Of Sales";
        $this->data["data"] = $this->model("Stok_model")->tampilall();
        $this->view("templates/header", $this->data);
        $this->view("stok/index", $this->data);
        $this->view("templates/footer");
    }
}
