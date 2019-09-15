<?php
// ! parent class untuk database yang berada didalam folder models
class Database
{
    protected $stmt;
    protected $link;

    // * informasi database yang diambil dari folder config
    private $dbhost = DB_HOST;
    private $dbuser = DB_USER;
    private $dbpass = DB_PASS;
    private $dbname = DB_NAME;

    public function __construct()
    {
        // * setting jenis database server didalam data source namenya
        $dsn = "mysql:dbhost=$this->dbhost;dbname=$this->dbname;charset=utf8";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ];

        try {
            // * buat object koneksi PDO 
            $this->link = new PDO($dsn, $this->dbuser, $this->dbpass, $options);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    // * method untuk menampung isi dari peryataan SQL beserta tipe data nya 
    public function bind($parameter, $value, $type = null)
    {
        // * jika $type = null 
        if (is_null($type)) {
            switch (true) {
                    // ? cek type data dari isi $value 
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }

            $this->stmt->bindValue($parameter, $value, $type);
        }
    }

    // * method untuk menjalankan query 
    public function query($query)
    {
        $this->stmt = $this->link->prepare($query);
    }
}
