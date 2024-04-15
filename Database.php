<?php
namespace Database;
class Conexion {
    private $dbhost = "localhost";
    private $dbname = "ticcarcl_gesdoc";
    private $dblogin = "ticcarcl_wmgesdoc";
    private $dbpswd = "RRMWTjf~TUAK";
    private $link;

    public function __construct() {
        $this->link = mysqli_connect($this->dbhost, $this->dblogin, $this->dbpswd, $this->dbname);
        if (!$this->link) {
            die("Error de conexión: " . mysqli_connect_error());
        }
        mysqli_set_charset($this->link, "utf8");
    }
    public function getLink() {
        return $this->link;
    }
    public function close() {
        mysqli_close($this->link);
    }
}
