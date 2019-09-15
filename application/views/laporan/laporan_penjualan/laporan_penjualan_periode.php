<?php
header("Content-type: application/vnd-ms-excel");
header('Content-Disposition: attachment; filename=' . $data["title"] . '.xls');
?>
<h1 style="text-transform:uppercase;"><?php echo $data["perusahaan"]["nama_perusahaan"] ?></h1>
<p><?php echo $data["perusahaan"]["alamat_perusahaan"] ?></p>
<h2><?php echo $data["title"] ?></h2>

<table border="2">
    <tr>
        <th>No</th>
        <th>No Transaksi</th>
        <th>Pembeli</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga Jual</th>
        <th>Qty</th>
        <th>Harga Total</th>
        <th>Pengunggah</th>
        <th>Tanggal</th>
    </tr>
    <?php $no = 0;
    foreach ($data["periode"] as $periode) : $no++; ?>
        <tr>
            <td style="text-align:center;"><?php echo $no ?></td>
            <td><?php echo $periode["no_trans"] ?></td>
            <td><?php echo $periode["nama_pembeli"] ?></td>
            <td><?php echo $periode["kd_barang"] ?></td>
            <td><?php echo $periode["nama_barang"] ?></td>
            <td><?php echo str_replace(".", "", $periode["harga_jual"]) ?></td>
            <td><?php echo $periode["qty"] ?></td>
            <td><?php echo str_replace(".", ",", $periode["total_harga"]) ?></td>
            <td><?php echo $periode["uploader"] ?></td>
            <td><?php echo tanggal($periode["tanggal"]) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p>Total <?php echo $data["title"] ?> sebesar : Rp <?php echo format($data["total_jual"]) ?></p>