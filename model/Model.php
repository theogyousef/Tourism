<?php
// session_start(); activate only when hosted 
require_once("../includes/Dbh.php");
abstract class Model
{
    protected $db;
    protected $conn;

    public function __construct()
    {
        $this->db = new Dbh();
        $this->conn = $this->db->getConn();
    }
    public function getConn()
    {
        return $this->conn;
    }


}


?>