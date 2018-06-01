<?php
namespace IMooc;

class AllUser implements \Iterator
{
    protected $ids;
    protected $data = array();
    protected $index;

    public function __construct()
    {
        $db = \IMooc\Factory::getDatabase();
        $request = $db->query("SELECT id FROM user");
        $this->ids = $result->fetch_all(MYSQL_ASSOC);
    }

    public function cuttent()
    {
        $id = $this->ids[$this->index]['id'];
        return \IMooc\Factory::getUser($id);
    }

    public function next()
    {
        $this->index++;
    }

    public function valid()
    {
        return $this->index < count($this->ids);
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function key()
    {
        return $this->index;
    }
}

$users = new AllUser();
foreach ($users as $user) {

    var_dump($user->name);
    $user->serial_no = rand(10000, 90000);
}
