<?php
class Login_model extends Database
{
    private $tabel = "user";

    // * method untuk mengambil data username dan password  berdasarkan username
    // * untuk pengecekan login
    public function getByUsername($username)
    {
        $this->query("SELECT * FROM $this->tabel WHERE username = :username");
        $this->bind(":username", $username);
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
