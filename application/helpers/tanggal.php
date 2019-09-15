<?php
function tanggal($date)
{
    // * nama bulan di indonesia
    $bulan_indo = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    ];

    // * ambil beberapa bagian dari argument $date dengan substr
    $thn = substr($date, 0, 4); // 2019-09-08
    $bln = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);

    $tanggal = $tgl . " " . $bulan_indo[(int) $bln - 1] . " " . $thn;
    return $tanggal;
}
