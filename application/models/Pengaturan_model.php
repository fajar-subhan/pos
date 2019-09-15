<?php
class Pengaturan_model extends Database
{
    private $tabel_pengaturan = "pengaturan";
    // * tampilkan  data nama_perusahaan dan alamat di tabel pengaturan 
    public function tampil()
    {
        $this->query("SELECT nama_perusahaan,alamat_perusahaan FROM $this->tabel_pengaturan");
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // * ubah data berdasarkan nama pt yang lama
    public function ubah_data_nama($nama_lama, $nama_baru)
    {
        $this->query("UPDATE $this->tabel_pengaturan SET nama_perusahaan = :nama_baru WHERE nama_perusahaan = :nama_lama");
        $this->bind(":nama_baru", $nama_baru);
        $this->bind(":nama_lama", $nama_lama);
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }

    // * ubah data berdasarkan alamat yang lama 
    public function ubah_data_alamat($alamat_lama, $alamat_baru)
    {
        $this->query("UPDATE $this->tabel_pengaturan SET alamat_perusahaan = :alamat_baru WHERE alamat_perusahaan = :alamat_lama");
        $this->bind(":alamat_baru", $alamat_baru);
        $this->bind(":alamat_lama", $alamat_lama);
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }
}
