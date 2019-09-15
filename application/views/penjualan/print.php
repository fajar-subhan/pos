<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>
    #header {
        text-align: center;
    }

    #header h1 {
        margin-top: 10px;
        text-transform: uppercase;
    }

    #body {
        margin-top: 30px;
    }

    #body h3 {
        text-transform: uppercase;
        text-align: center;
    }

    #body h4 {
        text-align: center;
    }

    #body table {
        margin-top: 40px;
    }

    #detail {
        border-collapse: collapse;
    }

    #detail td,
    th {
        padding: 10px 36px;
    }

    #detail th {
        background-color: grey;
        color: white;
    }

    #footer {
        margin-top: 200px;
    }

    #footer p {
        text-align: right;
    }
</style>

<body>
    <div id="header">
        <h1><?php echo $data["perusahaan"]["nama_perusahaan"] ?></h1>
        <p><?php echo $data["perusahaan"]["alamat_perusahaan"] ?></p>
    </div>
    <hr>

    <div id="body">
        <h3>Kwitansi Pembayaran</h3>
        <h4>No. <?php echo $data["data"]["no_trans"] ?></h4>
        <table>
            <tr>
                <td>
                    <strong>Sudah Terima Dari</strong>
                </td>
                <td>:</td>
                <td>Bpk/Ibu <?php echo $data["data"]["nama_pembeli"] ?></td>
            </tr>

            <tr>
                <td>
                    <strong>Uang Sejumlah</strong>
                </td>
                <td>:</td>
                <td>Rp <?php echo format($data["data"]["total_harga"]) ?></td>
            </tr>

            <tr>
                <td>
                    <strong>Untuk Pembayaran</strong>
                </td>
                <td>:</td>
            </tr>
        </table>

        <table id="detail" border="1">
            <thead style="text-align:center;">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>


                <tr>
                    <td><?php $no = 0;
                        $no++;
                        echo $no; ?></td>
                    <td><?php echo $data["data"]["nama_barang"] ?></td>
                    <td>Rp <?php echo $data["data"]["harga_jual"] ?></td>
                    <td><?php echo $data["data"]["qty"] ?></td>
                    <td>Rp <?php echo number_format($data["data"]["total_harga"], 0, ",", ".") ?></td>
                </tr>

            </tbody>
        </table>
    </div>

    <div id="footer">
        <p>Jakarta, <?php echo tanggal($data["data"]["tanggal"]) ?></p>
        <br><br><br>
        <p style="padding-right:40px"><?php echo $_SESSION["data"]["nama"] ?></p>
        <p style="padding-right:30px;">(
            <?php
            if ($_SESSION["data"]["tipe"] == 1) {
                echo "Admin";
            } else {
                echo "User";
            }
            ?>

            )</p>
    </div>
</body>

</html>