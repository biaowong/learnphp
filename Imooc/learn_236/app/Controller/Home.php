<?php
namespace App\Controller;

use IMooc\Controller;
use IMooc\Factory;

class Home extends Controller
{
    public function index()
    {
        $model = Factory::getModel('User');
        $userid = $model->create(array('name'=>'rango', 'mobile'=>'13311111111', ));

        return array('userid'=>$userid, 'name'=>'rango');

    }
}
