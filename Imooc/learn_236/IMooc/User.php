<?php
namespace IMooc;
/**
 * 数据对象映射模式
 */


class User
{
    protected $db = '';
    public $id = '';
    public $name = '';
    public $mobile = '';
    public $regtime = '';

    public function __construct($id)
    {
        $this->db = new \IMooc\Database\MySQLi();
        $this->db->connect('127.0.0.1', 'root', 'root', 'test');
        $res = $this->db->query("SELECT * FROM user WHERE id = '{ $id }'");
        $data = $res->fetch_assoc();

        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->mobile = $data['mobile'];
        $this->regtime = $data['regtime'];
    }

    public function __destruct()
    {
        $this->db->query("UPDATE user SET name = '{ $this->name }', mobile = '{ $this->mobile }', regtime = '{ $this->regtime }' WHERE id = '{ $this->id }'" );
    }
}
