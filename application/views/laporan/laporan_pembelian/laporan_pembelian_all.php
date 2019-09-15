<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Pembelian Keseluruhan.xls");
?>
<h1 style="text-transform:uppercase;"><?php echo $data["perusahaan"]["nama_perusahaan"] ?></h1>
<p><?php echo $data["perusahaan"]["alamat_perusahaan"] ?></p>
<h2>LAPORAN PEMBELIAN BARANG KESELURUHAN</h2>
<table border="2">
    <tr>
        <th>No</th>
        <th>No Transaksi</th>
        <th>Supplier</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga Beli</th>
        <th>Qty</th>
        <th>Harga Jual</th>
        <th>Harga Total</th>
        <th>Pengunggah</th>
        <th>Tanggal</th>
    </tr>
    <?php
    $no = 0;
    foreach ($data["data"] as $beli) :
        $no++;
        ?>
        <tr>
            <td style="text-align:center;"><?php echo $no ?></td>
            <td><?php echo $beli["no_trans"] ?></td>
            <td><?php echo $beli["supplier"] ?></td>
            <td><?php echo $beli["kd_barang"] ?></td>
            <td><?php echo $beli["nama_barang"] ?></td>
            <td><?php echo str_replace(".", "", $beli["harga_beli"]) ?></td>
            <td><?php echo $beli["qty"] ?></td>
            <td><?php echo str_replace(".", "", $beli["harga_jual"]) ?></td>
            <td><?php echo str_replace(".", ",", $beli["total_harga"]) ?></td>
            <td><?php echo $beli["uploader"] ?></td>
            <td><?php echo tanggal($beli["tanggal"]) ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<p>Total Pembelian Keseluruhan : Rp <?php echo format($data["total_keseluruhan"]) ?></p>