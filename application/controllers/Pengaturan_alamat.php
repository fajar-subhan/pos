<?php
class Pengaturan_alamat extends Controllers
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

        $this->data["title"] = "Pengaturan Alamat Perusahaan - Aplikasi Point Of Sales";
        // * nama perusahaan dan alamat
        $this->data["perusahaan"] = $this->model("Pengaturan_model")->tampil();
        $this->view("templates/header", $this->data);
        $this->view("pengaturan/pengaturan_alamat/index", $this->data);
        $this->view("templates/footer");
    }

    // * ubah data alamat perusahaan
    public function ubah_alamat()
    {
        $alamat_lama = htmlentities(strip_tags(trim($_POST["alamat_lama"])));
        $alamat_baru = htmlentities(strip_tags(trim($_POST["alamat_baru"])));

        if ($this->model("Pengaturan_model")->ubah_data_alamat($alamat_lama, $alamat_baru) >= 0) {
            $data = $this->model("Pengaturan_model")->tampil();
            $response = [
                "status" => "berhasil",
                "data" => $data,
                "pesan" => "Alamat perusahaan berhasil di ubah"
            ];

            echo json_encode($response);
        }
    }
}
