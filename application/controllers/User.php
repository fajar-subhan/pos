<?php
class User extends Controllers
{
    // * tampilan awal user
    public function index()
    {
        // * jika sesi sudah berakhir
        if (!isset($_SESSION["data"]["nama"])) {
            $pesan = "Sesi telah berakhir";
            $pesan = urlencode($pesan);
            header("location:" . BASEURL . "$pesan");
        }

        $this->data["title"] = "Data User - Aplikasi Point Of Sales";
        // * tampilkan semua data user
        $this->data["data"] = $this->model("User_model")->tampil();
        $this->view("templates/header", $this->data);
        $this->view("user/index", $this->data);
        $this->view("templates/footer");
    }

    // * tambah data user 
    public function tambah_user()
    {
        $nama       = htmlentities(strip_tags(trim($_POST["nama_user"])));
        $email      = htmlentities(strip_tags(trim($_POST["email_user"])));
        $jabatan    = htmlentities(strip_tags(trim($_POST["jabatan_user"])));
        $username   = htmlentities(strip_tags(trim($_POST["username"])));
        $password   = htmlentities(strip_tags(trim($_POST["password"])));
        $tipe_user  = htmlentities(strip_tags(trim($_POST["tipe_user"])));

        if ($this->model("User_model")->tambah($nama, $email, $jabatan, $username, $password, $tipe_user) >= 0) {
            // * tampilkan semua data user
            $data = $this->data["data"] = $this->model("User_model")->tampil();
            $response = [
                "status" => "berhasil",
                "data" => $data,
                "pesan" => "User berhasil ditambahkan"
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    // * tampilkan user berdasarkan id 
    public function tampil_id()
    {
        $id = htmlentities(strip_tags(trim($_POST["id"])));
        $data = $this->model("User_model")->tampil_id($id);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    // * ubah data user berdasarkan id
    public function ubah_user_id()
    {
        $id = htmlentities(strip_tags(trim($_POST["id"])));
        $nama_user = htmlentities(strip_tags(trim($_POST["nama_user"])));
        $email_user = htmlentities(strip_tags(trim($_POST["email_user"])));
        $jabatan = htmlentities(strip_tags(trim($_POST["jabatan_user"])));
        $username = htmlentities(strip_tags(trim($_POST["username"])));
        $tipe_user = htmlentities(strip_tags(trim($_POST["tipe_user"])));

        if ($this->model("User_model")->ubah_user_id($id, $nama_user, $email_user, $jabatan, $username, $tipe_user) >= 0) {
            // * tampilkan semua data user
            $data = $this->model("User_model")->tampil();
            $response = [
                "status" => "berhasil",
                "data" => $data,
                "pesan" => "User berhasil diubah"
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    // * ubah password berdasarkan id 
    public function ubah_pass_id()
    {
        $id         = htmlentities(strip_tags(trim($_POST["id"])));
        $passbaru   = htmlentities(strip_tags(trim($_POST["passwordbaru"])));

        if ($this->model("User_model")->ubah_pass_id($id, $passbaru) >= 0) {
            // * tampilkan semua data user
            $data = $this->model("User_model")->tampil();
            $response = [
                "status" => "berhasil",
                "data" => $data,
                "pesan" => "Password berhasil di ubah"
            ];
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // * hapus data user 
    public function hapus_user()
    {
        $id = htmlentities(strip_tags(trim($_POST["id"])));
        if ($this->model("User_model")->hapus_user($id) >= 0) {
            // * tampilkan semua data user
            $data = $this->model("User_model")->tampil();
            $response = [
                "status" => "berhasil",
                "data" => $data,
                "pesan" => "User berhasil dihapus"
            ];
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
