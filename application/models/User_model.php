<?php
class User_model extends Database
{
    private $tabel_user = "user";
    // * tampilkan semua data tabel user
    public function tampil()
    {
        $this->query("SELECT id_user,nama_user,email_user,jabatan_user,username,tipe_user FROM $this->tabel_user");
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // * tambah data user 
    public function tambah($nama, $email, $jabatan, $username, $password, $tipe_user)
    {
        $tanggal = date("Y-m-d");
        $this->query("INSERT INTO $this->tabel_user VALUES(null,:nama,:email,:jabatan,:username,:password,:tipe,:tanggal)");
        $this->bind(":nama", $nama);
        $this->bind(":email", $email);
        $this->bind(":jabatan", $jabatan);
        $this->bind(":username", $username);
        $this->bind(":password", password_hash($password, PASSWORD_DEFAULT));
        $this->bind(":tipe", $tipe_user);
        $this->bind(":tanggal", $tanggal);
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }

    // * tampilkan user berdasarkan id
    public function tampil_id($id)
    {
        $this->query("SELECT id_user,nama_user,email_user,jabatan_user,username,tipe_user FROM $this->tabel_user WHERE id_user = :id");
        $this->bind(":id", $id);
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // * ubah user berdasarkan id 
    public function ubah_user_id($id, $nama_user, $email_user, $jabatan, $username, $tipe_user)
    {
        $this->query("UPDATE $this->tabel_user SET nama_user = :nama_user,email_user = :email,jabatan_user = :jabatan,username = :username,tipe_user = :tipe WHERE id_user = :id");
        $this->bind(":nama_user", $nama_user);
        $this->bind(":email", $email_user);
        $this->bind(":jabatan", $jabatan);
        $this->bind(":username", $username);
        $this->bind(":tipe", $tipe_user);
        $this->bind(":id", $id);
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }

    // * ubah password berdasarkan id
    public function ubah_pass_id($id, $passwordbaru)
    {
        $hashbaru = password_hash($passwordbaru, PASSWORD_DEFAULT);
        $this->query("UPDATE $this->tabel_user SET password = :passwordbaru WHERE id_user = :id");
        $this->bind(":id", $id);
        $this->bind(":passwordbaru", $hashbaru);
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }

    // * hapus user 
    public function hapus_user($id)
    {
        $this->query("DELETE FROM $this->tabel_user WHERE id_user = :id");
        $this->bind(":id", $id);
        $this->stmt->execute();
        $this->stmt->rowCount();
    }

    // * total user 
    public function total_user()
    {
        $this->query("SELECT COUNT(nama_user) FROM $this->tabel_user");
        $this->stmt->execute();
        return $this->stmt->fetchColumn();
    }
}
