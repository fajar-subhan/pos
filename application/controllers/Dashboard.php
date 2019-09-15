<?php
class Dashboard extends Controllers
{

    // * method tampilan awal dashboard 
    public function index()
    {
        // * jika sesi sudah berakhir
        if (!isset($_SESSION["data"]["nama"])) {
            $pesan = "Sesi telah berakhir";
            $pesan = urlencode($pesan);
            header("location:" . BASEURL . "$pesan");
        }
        $this->data["title"] = "Dashboard - Aplikasi Point Of Sales";
        $this->data["total_stok"] = $this->model("Stok_model")->total_stok();
        $this->data["total_beli"] = $this->model("Pembelian_model")->total_beli();
        $this->data["total_jual"] = $this->model("Penjualan_model")->total_jual();
        $this->data["total_user"] = $this->model("User_model")->total_user();
        // * nama perusahaan dan alamat
        $this->data["perusahaan"] = $this->model("Pengaturan_model")->tampil();
        $this->view("templates/header", $this->data);
        $this->view("dashboard/index", $this->data);
        $this->view("templates/footer");
    }
}
