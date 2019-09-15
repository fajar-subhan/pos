# Aplikasi Point Of Sales (POS)

![sample](https://github.com/Fajarsubhan/pos/blob/master/assets/img/sample.png)

## Tentang Aplikasi

Aplikasi Point of Sales (POS) adalah sebuah aplikasi berbasis web yang digunakan untuk melakukan proses transaksi pembelian maupun penjualan sebuah barang.

Aplikasi ini saya kembangkan dengan framework mini buatan saya sendiri,dengan design [MVC](https://bertzzie.com/knowledge/framework-php/1-Model-View-Controller.html) dan dengan konsep [OOP](https://idcloudhost.com/panduan/mengenal-pengertian-dan-konsep-oop/) dan juga dibalut dengan [Ajax](https://www.hostinger.co.id/tutorial/apa-itu-ajax/).

___

## Persyaratan Server

* [PHP](https://www.php.net/) versi 5.6 atau yang lebih baru
* [MySQL](https://www.mysql.com/)
* [Apache](https://httpd.apache.org/) atau [Nginx](https://www.nginx.com/)
* [Xampp](https://www.apachefriends.org/index.html) jika tidak ingin repot
* [Template SB Admin 2](https://startbootstrap.com/themes/sb-admin-2/) yang saya sudah sertakan di repository ini

___

## Struktur Folder
1. **application** =  digunakan untuk menampung seluruh folder sistem utama
2. **assets** = digunakan untuk menyimpan file-file library,plugin,gambar beserta file templatenya
3. **config** = digunakan untuk menyimpan file config.php yang dimana file config.php digunakan untuk menampung url dan informasi database
4. **controllers** = file class controller
5. **helpers** = file pembantu function untuk format dan tanggal
6. **libraries** = untuk menaruh file html2pdf
7. **models** = digunakan untuk menampung seluruh file class yang terhubung ke database
8. **core** = digunakan untuk menyimpan file parent class
9. **views** = digunakan untuk tampilan website

___

## Pemasangan
1. Download dan extract file repository ini
2. Letakan semua file kedalam server [localhost](https://idcloudhost.com/mengenal-macam-macam-web-server-localhost/) atau [web hosting](https://www.proweb.co.id/articles/general/web_hosting_adalah.html) masing-masing
3. Import file **.sql** yang telah saya sertakan kedalam phpmyadmin kalian
4. Lalu kita buka file [config.php](https://github.com/Fajarsubhan/pos/blob/master/application/config/config.php) terlebih dahulu,yang berada didalam folder **application/config** dan rubah nilai dari constant [BASEURL](https://www.w3schools.com/php/func_misc_define.asp) sesuai dengan url tujuan masing-masing,jangan lupa untuk merubah nilai dari informasi databasenya
5. Buka file [script.js](https://github.com/Fajarsubhan/pos/blob/master/assets/js/script.js) yang berada didalam folder **assets/js** lalu cari pada baris **517**,
ubah url yang berada didalam tag ``` tabel += '<a href="http://lokasiserver/folderserver/penjualan/printpdf/' + value.no_trans + '">'; ```,jika kalian mau menggunakan yang [script.min.js](https://github.com/Fajarsubhan/pos/blob/master/assets/js/script.min.js) silahkan dirubah juga pada bagian urlnya. agar tidak terjadi error saat download file pdf

6. Silahkan untuk dikembangkan kembali.

___

## Catatan Login
* username : Admin
* password : Admin1234

___

## Hak Cipta dan Lisensi

* Copyright 2013-2019 Blackrock Digital LLC. Code released under the [MIT](https://github.com/BlackrockDigital/startbootstrap-resume/blob/gh-pages/LICENSE) license.






