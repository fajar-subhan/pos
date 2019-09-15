<?php
class Penjualan_model extends Database
{
    private $tabel_jual = "jual";
    private $tabel_beli = "beli";

    // * tampilkan data per ID 
    public function tampil_data_id($id)
    {
        $this->query("SELECT id_jual,nama_pembeli FROM $this->tabel_jual WHERE id_jual = :id");
        $this->bind(":id", $id);
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // * tampilkan seluruh data 
    public function tampilall()
    {
        $this->query("SELECT * FROM $this->tabel_jual");
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // * tampilkan nama barang
    public function namabarangall()
    {
        $this->query("SELECT nama_barang FROM $this->tabel_beli");
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // * tampilkan data kd barang dan harga jual berdasarkan nama barang
    public function data_by_nama($nama_barang)
    {
        $this->query("SELECT kd_barang,harga_jual FROM $this->tabel_beli WHERE nama_barang = :nama_barang");
        $this->bind(":nama_barang", $nama_barang);
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // * untuk tambah data 
    public function tambah($no_trans, $pembeli, $nama_barang, $qty, $kd_barang, $harga_jual, $total)
    {

        $uploader = $_SESSION["data"]["nama"];
        $tanggal = date("Y-m-d");
        $this->query("INSERT INTO $this->tabel_jual VALUES(null,:no_trans,:nama_pembeli,:nama_barang,:kd_barang,:harga_jual,:qty,:total_harga,:uploader,:tanggal)");
        $this->bind(":no_trans", $no_trans);
        $this->bind(":nama_pembeli", $pembeli);
        $this->bind(":nama_barang", $nama_barang);
        $this->bind(":kd_barang", $kd_barang);
        $this->bind(":harga_jual", $harga_jual);
        $this->bind(":qty", $qty);
        $this->bind(":total_harga", str_replace(".", "", $total));
        $this->bind(":uploader", $uploader);
        $this->bind(":tanggal", $tanggal);
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }

    // * total penjualan per hari 
    public function total_jual()
    {
        $date = date("Y-m-d");
        $this->query("SELECT SUM(total_harga) FROM $this->tabel_jual WHERE tanggal = :tanggal");
        $this->bind(":tanggal", $date);
        $this->stmt->execute();
        return $this->stmt->fetchColumn();
    }

    // * tampilkan no trans berdasarkan tanggal saat ini
    public function no_trans($date)
    {
        $this->query("SELECT no_trans FROM $this->tabel_jual WHERE tanggal = :tanggal ORDER BY no_trans DESC LIMIT 1");
        $this->bind(":tanggal", $date);
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // * tampilkan data berdasarkan no trans
    public function tampil_no_trans($no_trans)
    {
        $this->query("SELECT * FROM $this->tabel_jual WHERE no_trans = :no_trans");
        $this->bind(":no_trans", $no_trans);
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // * total jual keseluruhan
    public function total_jual_all()
    {
        $this->query("SELECT SUM(total_harga) FROM $this->tabel_jual");
        $this->stmt->execute();
        return $this->stmt->fetchColumn();
    }


    // * tampilkan total pembelian per periode
    public function total_jual_periode($tglawal, $tglakhir)
    {
        $this->query("SELECT SUM(total_harga) FROM $this->tabel_jual WHERE tanggal BETWEEN :tgl_awal AND :tgl_akhir");
        $this->bind(":tgl_awal", $tglawal);
        $this->bind(":tgl_akhir", $tglakhir);
        $this->stmt->execute();
        return $this->stmt->fetchColumn();
    }

    // * tampilkan data berdasarkan periode 
    public function tampilperiode($tglawal, $tglakhir)
    {
        $this->query("SELECT * FROM $this->tabel_jual WHERE tanggal BETWEEN :tgl_awal AND :tgl_akhir");
        $this->bind(":tgl_awal", $tglawal);
        $this->bind(":tgl_akhir", $tglakhir);
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
