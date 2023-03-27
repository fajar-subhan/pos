<?php
class Penjualan extends Controllers
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

        $this->data["title"] = "Data Penjualan - Aplikasi Point Of Sales";
        $this->data["data"] = $this->model("Penjualan_model")->tampilall();
        $this->view("templates/header", $this->data);
        $this->view("penjualan/index", $this->data);
        $this->view("templates/footer");
    }

    // * tampilkan data berdasarkan id 
    public function tampil_data_id()
    {
        $id = htmlentities(strip_tags(trim($_POST["id"])));
        $data = $this->model("Penjualan_model")->tampil_data_id($id);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }


    // * tampilkan data untuk pengisian form
    public function namabarangall()
    {
        $data = $this->model("Penjualan_model")->namabarangall();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    // * tampilkan data kode barang dan harga jual berdasarkan nama barang
    public function data_by_nama()
    {
        $nama_barang = htmlentities(strip_tags(trim($_POST["nama_barang"])));
        $data = $this->model("Penjualan_model")->data_by_nama($nama_barang);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    // * tambah data penjualan 
    public function tambah_data()
    {
        // * tampilkan data no_trans di tabel jual berdasarkan tanggal saat ini
        $date = date("Y-m-d");
        $no_trans = $this->model("Penjualan_model")->no_trans($date);

        if ($no_trans == false) {
            $no_trans = null;
        } else {
            $no_trans = $no_trans;
        }

        // ? cek apakah no trans sudah ada
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

        $no_trans = "J" . "-" . $tanggal_no_trans . "-" . $kode;
        $pembeli = htmlentities(strip_tags(trim($_POST["pembeli"])));
        $nama_barang = htmlentities(strip_tags(trim($_POST["nama_barang"])));
        $qty = htmlentities(strip_tags(trim($_POST["qty"])));
        $kd_barang = htmlentities(strip_tags(trim($_POST["kd_barang"])));
        $harga_jual = htmlentities(strip_tags(trim($_POST["harga_jual"])));
        $total = htmlentities(strip_tags(trim($_POST["total"])));

        if ($this->model("Penjualan_model")->tambah($no_trans, $pembeli, $nama_barang, $qty, $kd_barang, $harga_jual, $total) >= 0) {
            $data = $this->model("Penjualan_model")->tampilall();
            $response = [
                "status" => "berhasil",
                "data" => $data,
                "pesan" => "Data berhasil ditambahkan"
            ];
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // * untuk menampilkan file pdf di browser
    public function printpdf($no_trans)
    {
        // * tampilkan data berdasarkan no transaksi
        $this->data["data"] = $this->model("Penjualan_model")->tampil_no_trans($no_trans);

        // * tampilkan nama perusahaan dan alamat perusahaan
        $this->data["perusahaan"] = $this->model("Pengaturan_model")->tampil();

        $html2pdf = new Html2Pdf('P', 'A4', 'en');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($this->get_html($this->data));

        $html2pdf->Output("Kwitansi Pembayaran.pdf", "FI");
    }

    public function get_html($data = [])
    {
        $nama_perusahaan = $data["perusahaan"]["nama_perusahaan"];
        $alamat          = $data["perusahaan"]["alamat_perusahaan"];
        $no_trans        = $data["data"]["no_trans"];
        $nama_pembeli    = $data["data"]["nama_pembeli"];
        $nama_barang     = $data["data"]["nama_barang"];
        $harga_jual      = $data["data"]["harga_jual"];
        $qty             = $data["data"]["qty"];
        $total_harga     = number_format($data["data"]["total_harga"], 0, ",", ".");

        $content = "
        <div>
            <h1 style='text-align:center'>$nama_perusahaan</h1>
            <p style='text-align:center'>$alamat</p>
        </div>
        <hr>
        <br />

        <style>
                table,tr,td,th {
                    border:1px sold black;
                    border-collapse: collapse;
                }

                td,
            th {
                padding: 10px 36px;
            }
        </style>

        <div>
            <h3 style='text-align:center'>Kwitansi Pembayaran</h3>
            <h4  style='text-align:center'>No. $no_trans</h4>
            <table>
                <tr>
                    <td>
                        <strong>Sudah Terima Dari</strong>
                    </td>
                    <td>:</td>
                    <td>Bpk/Ibu $nama_pembeli</td>
                </tr>

                <tr>
                    <td>
                        <strong>Uang Sejumlah</strong>
                    </td>
                    <td>:</td>
                    <td>Rp. $total_harga </td>
                </tr>
            </table>

            <p>Untuk pembayaran :</p>
            <br >
            <table id='detail' border='1'>
                <thead style='text-align:center;'>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <td>$nama_barang</td>
                        <td>Rp. $harga_jual</td>
                        <td>$qty</td>
                        <td>Rp $total_harga</td>
                    </tr>

                </tbody>
            </table>
        </div>
        ";

        return $content;
    }
}
