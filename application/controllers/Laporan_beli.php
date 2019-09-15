<?php
class Laporan_beli extends Controllers
{
    public function index()
    {
        // * jika sesi sudah berakhir
        if (!isset($_SESSION["data"]["nama"])) {
            $pesan = "Sesi telah berakhir";
            $pesan = urlencode($pesan);
            header("location:" . BASEURL . "$pesan");
        }

        $this->data["title"] = "Laporan Pembelian - Aplikasi Point Of Sales";
        $this->view("templates/header", $this->data);
        $this->view("laporan/laporan_pembelian/index");
        $this->view("templates/footer");
    }

    // * laporan pembelian all 
    public function laporan_pembelian_all()
    {
        // * nama perusahaan dan alamat
        $this->data["perusahaan"] = $this->model("Pengaturan_model")->tampil();
        // * data keseluruhan 
        $this->data["data"] = $this->model("Pembelian_model")->tampilkan();
        // * total harga keseluruhan
        $this->data["total_keseluruhan"] = $this->model("Pembelian_model")->total_beli_all();
        $this->view("laporan/laporan_pembelian/laporan_pembelian_all", $this->data);
    }

    // * laporan pembelian periode 
    public function laporan_pembelian_periode()
    {
        $tgl_awal  = htmlentities(strip_tags(trim($_POST["tgl_awal"])));
        $tgl_akhir = htmlentities(strip_tags(trim($_POST["tgl_akhir"])));

        $tgl1 = strtotime($tgl_awal);
        $tanggal_awal = date("Y-m-d", $tgl1);

        $tgl2 = strtotime($tgl_akhir);
        $tanggal_akhir = date("Y-m-d", $tgl2);
        // * nama perusahaan dan alamat
        $this->data["perusahaan"] = $this->model("Pengaturan_model")->tampil();

        $this->data["title"] = "Laporan pembelian periode " . tanggal($tanggal_awal) . "-" . tanggal($tanggal_akhir);

        $this->data["total_beli"] = $this->model("Pembelian_model")->total_beli_periode($tanggal_awal, $tanggal_akhir);

        //  * data per periode 
        $this->data["periode"] = $this->model("Pembelian_model")->tampilperiode($tanggal_awal, $tanggal_akhir);
        $this->view("laporan/laporan_pembelian/laporan_pembelian_periode", $this->data);
    }
}
