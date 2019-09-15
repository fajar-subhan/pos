<?php
class Pengaturan_nama extends Controllers
{
    // * tampilan awal
    public function index()
    {
        // * jika sesi sudah berakhir
        if (!isset($_SESSION["data"]["nama"])) {
            $pesan = "Sesi telah berakhir";
            $pesan = urlencode($pesan);
            header("location:" . BASEURL . "$pesan");
        }

        $this->data["title"] = "Pengaturan Nama Perusahaan - Aplikasi Point Of Sales";
        // * nama perusahaan dan alamat
        $this->data["perusahaan"] = $this->model("Pengaturan_model")->tampil();
        $this->view("templates/header", $this->data);
        $this->view("pengaturan/pengaturan_nama/index", $this->data);
        $this->view("templates/footer");
    }

    // * ubah data nama perusahaan
    public function ubah_nama()
    {
        $nama_lama = htmlentities(strip_tags(trim($_POST["nama_lama"])));
        $nama_baru = htmlentities(strip_tags(trim($_POST["nama_baru"])));

        if ($this->model("Pengaturan_model")->ubah_data_nama($nama_lama, $nama_baru) >= 0) {
            $data = $this->model("Pengaturan_model")->tampil();
            $response = [
                "status" => "berhasil",
                "data" => $data,
                "pesan" => "Nama perusahaan berhasil di ubah"
            ];

            echo json_encode($response);
        }
    }
}
