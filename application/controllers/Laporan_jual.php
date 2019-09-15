<?php
class Laporan_jual extends Controllers
{

    public function index()
    {
        // * jika sesi sudah berakhir
        if (!isset($_SESSION["data"]["nama"])) {
            $pesan = "Sesi telah berakhir";
            $pesan = urlencode($pesan);
            header("location:" . BASEURL . "$pesan");
        }
        $this->data["title"] = "Laporan Penjualan - Aplikasi Point Of Sales";
        $this->view("templates/header", $this->data);
        $this->view("laporan/laporan_penjualan/index");
        $this->view("templates/footer");
    }

    // * laporan penjualan all 
    public function laporan_penjualan_all()
    {
        // * nama perusahaan dan alamat
        $this->data["perusahaan"] = $this->model("Pengaturan_model")->tampil();
        // * data keseluruhan 
        $this->data["data"] = $this->model("Penjualan_model")->tampilall();
        // * total harga keseluruhan
        $this->data["total_keseluruhan"] = $this->model("Penjualan_model")->total_jual_all();
        $this->view("laporan/laporan_penjualan/laporan_penjualan_all", $this->data);
    }

    // * laporan penjualan periode 
    public function laporan_penjualan_periode()
    {
        $tgl_awal  = htmlentities(strip_tags(trim($_POST["tgl_awal"])));
        $tgl_akhir = htmlentities(strip_tags(trim($_POST["tgl_akhir"])));

        $tgl1 = strtotime($tgl_awal);
        $tanggal_awal = date("Y-m-d", $tgl1);

        $tgl2 = strtotime($tgl_akhir);
        $tanggal_akhir = date("Y-m-d", $tgl2);
        // * nama perusahaan dan alamat
        $this->data["perusahaan"] = $this->model("Pengaturan_model")->tampil();

        $this->data["title"] = "Laporan penjualan periode " . tanggal($tanggal_awal) . "-" . tanggal($tanggal_akhir);

        $this->data["total_jual"] = $this->model("Penjualan_model")->total_jual_periode($tanggal_awal, $tanggal_akhir);

        //  * data per periode 
        $this->data["periode"] = $this->model("Penjualan_model")->tampilperiode($tanggal_awal, $tanggal_akhir);
        $this->view("laporan/laporan_penjualan/laporan_penjualan_periode", $this->data);
    }
}
