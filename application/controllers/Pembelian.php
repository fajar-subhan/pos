<?php
class Pembelian extends Controllers
{
    // * method tampilan awal data pembelian
    public function index()
    {
        // * jika sesi sudah berakhir
        if (!isset($_SESSION["data"]["nama"])) {
            $pesan = "Sesi telah berakhir";
            $pesan = urlencode($pesan);
            header("location:" . BASEURL . "$pesan");
        }


        $this->data["title"] = "Data Pembelian - Aplikasi Point Of Sales";
        $this->data["data"] = $this->model("Pembelian_model")->tampilkan();
        $this->view("templates/header", $this->data);
        $this->view("pembelian/index", $this->data);
        $this->view("templates/footer");
    }

    // * method untuk tambah data pembelian
    public function tambah_data()
    {
        $date = date("Y-m-d");
        // * ambil data no trans terakhir berdasarkan tanggal saat ini
        $no_trans = $this->model("Pembelian_model")->no_trans($date);
        // ? cek apakah no trans terakhir ada 
        if ($no_trans["no_trans"] != null) {
            // * jika ada maka ambil data 10 digit no trans
            $ambil = substr($no_trans["no_trans"], 10);
            // * tambahkan 1 pada no_trans pada 10 digit dan tambahkan angka 0 disebelah kiri
            $kode = str_pad($ambil + 1, 4, "0", STR_PAD_LEFT);
        } else {
            // * jika data no trans tidak ada,maka gunakan  default
            $kode = "0001";
        }
        $tanggal_no_trans = date("ymd");

        $no_trans    = "B" . "-" . $tanggal_no_trans . "-" . $kode;
        $supplier    = htmlentities(strip_tags(trim($_POST["supplier"])));
        $qty         = htmlentities(strip_tags(trim($_POST["qty"])));
        $kd_barang   = htmlentities(strip_tags(trim($_POST["kd_barang"])));
        $nama_barang = htmlentities(strip_tags(trim($_POST["nama_barang"])));
        $harga_beli  = htmlentities(strip_tags(trim($_POST["harga_beli"])));
        $harga_jual  = htmlentities(strip_tags(trim($_POST["harga_jual"])));
        $total       = htmlentities(strip_tags(trim($_POST["total"])));

        // ? apakah ada jumlah baris (rows) yang dipengaruhi dari hasil tambah data >= 0
        if ($this->model("Pembelian_model")->tambah($no_trans, $supplier, $qty, $kd_barang, $nama_barang, $harga_beli, $harga_jual, $total) >= 0) {
            $data =  $this->data["data"] = $this->model("Pembelian_model")->tampilkan();
            $response = [
                "status" => "berhasil",
                "data" => $data,
                "pesan" => "Data berhasil ditambahkan"
            ];
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
