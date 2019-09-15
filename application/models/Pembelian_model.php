<?php
class Pembelian_model extends Database
{
    private $tabel_beli = "beli";
    // * tampilkan semua yang ada di dalam tabel beli
    public function tampilkan()
    {
        $this->query("SELECT * FROM $this->tabel_beli");
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // * method untuk tambah data pembelian
    public function tambah($no_trans, $supplier, $qty, $kd_barang, $nama_barang, $harga_beli, $harga_jual, $total)
    {
        $tanggal = date("Y-m-d");
        $uploader = $_SESSION["data"]["nama"];
        $this->query("INSERT INTO $this->tabel_beli VALUES(null,:no_trans,:supplier,:kd_barang,:nama_barang,:harga_beli,:harga_jual,:qty,:total,:tanggal,:upload)");
        $this->bind(":supplier", $supplier);
        $this->bind(":qty", $qty);
        $this->bind(":kd_barang", $kd_barang);
        $this->bind(":nama_barang", $nama_barang);
        $this->bind(":harga_beli", $harga_beli);
        $this->bind(":harga_jual", $harga_jual);
        $this->bind(":tanggal", $tanggal);
        $this->bind(":upload", $uploader);
        $this->bind(":total", str_replace(".", "", $total));
        $this->bind(":no_trans", $no_trans);
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }

    // * hitung total pembelian berdasarkan tanggal saat ini 
    public function total_beli()
    {
        $date = date("Y-m-d");
        $this->query("SELECT SUM(total_harga) FROM $this->tabel_beli WHERE tanggal = :tanggal");
        $this->bind(":tanggal", $date);
        $this->stmt->execute();
        return $this->stmt->fetchColumn();
    }

    // * tampilkan data no trans terakhir berdasarkan tanggal saat ini 
    public function no_trans($date)
    {
        $this->query("SELECT no_trans FROM $this->tabel_beli WHERE tanggal = :tanggal ORDER BY no_trans DESC LIMIT 1");
        $this->bind(":tanggal", $date);
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // * total pembelian secara keseluruhan 
    public function total_beli_all()
    {
        $this->query("SELECT SUM(total_harga) FROM $this->tabel_beli");
        $this->stmt->execute();
        return $this->stmt->fetchColumn();
    }

    // * tampilkan data berdasarkan periode 
    public function tampilperiode($tglawal, $tglakhir)
    {

        $this->query("SELECT * FROM $this->tabel_beli WHERE tanggal BETWEEN :tgl_awal AND :tgl_akhir");
        $this->bind(":tgl_awal", $tglawal);
        $this->bind(":tgl_akhir", $tglakhir);
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // * tampilkan total pembelian per periode
    public function total_beli_periode($tglawal, $tglakhir)
    {
        $this->query("SELECT SUM(total_harga) FROM $this->tabel_beli WHERE tanggal BETWEEN :tgl_awal AND :tgl_akhir");
        $this->bind(":tgl_awal", $tglawal);
        $this->bind(":tgl_akhir", $tglakhir);
        $this->stmt->execute();
        return $this->stmt->fetchColumn();
    }
}
