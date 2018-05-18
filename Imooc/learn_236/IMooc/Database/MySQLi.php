<?php
namespace IMooc\Database;

use IMooc\IDatabase;

class MySQLi implements IDatabase
{
    protected $conn = '';

    public function connect($host, $user, $passwd, $dbname)
    {
        $conn = mysqli_connect($host, $user, $passwd, $dbname);
        mysql_select_db($dbname, $conn);
        $this->conn = $conn;
    }

    public function query($sql)
    {
        $res = mysqli_query($sql, $this->conn);
        return $res;
    }

    public function close()
    {
        mysqli_close($this->conn);
    }
}
