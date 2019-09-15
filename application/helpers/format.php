<?php
function format($angka)
{
    $hasil_rupiah = number_format($angka, 0, ",", ".");
    return $hasil_rupiah;
}
