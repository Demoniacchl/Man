<?php
namespace Database;

class Conexion {
    private $db_host = "localhost";
    private $db_name = "ticcarcl_gesdoc";
    private $db_login = "ticcarcl_wmgesdoc";
    private $db_pswd = "RRMWTjf~TUAK";
    private $link;

    public function __construct() {
        $this->link = mysqli_connect($this->db_host, $this->db_login, $this->db_pswd, $this->db_name);
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

?>