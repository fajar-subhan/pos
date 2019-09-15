<?php
class Stok_model extends Database
{
    private $tabel_beli = "beli";
    private $tabel_stok = "stok";

    // * tampilkan data hasil dari inner join ke tabel beli
    public function tampilall()
    {
        $this->query("SELECT stok.kd_barang,stok.qty,beli.nama_barang,beli.uploader,beli.tanggal
        FROM $this->tabel_stok INNER JOIN $this->tabel_beli ON stok.kd_barang = beli.kd_barang GROUP BY stok.kd_barang ORDER BY stok.kd_barang ASC");
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // * hitung berapa banyak data stok barang 
    public function total_stok()
    {
        $this->query("SELECT SUM(qty) FROM $this->tabel_stok");
        $this->stmt->execute();
        return $this->stmt->fetchColumn();
    }
}
