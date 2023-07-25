<?php
namespace App\Controllers;

class Cart extends BaseController
{
    public function index()
    {
        $model = model('App\Models\cartModel');
        $data = $model->getSearch(session()->get('username'));
        $try = ['results' => $data];
        echo view('template/header');
        echo view('Views/cart', $try );
        echo view('template/footer');
    }
    
    public function remove()
    {
        $model = model('App\Models\cartModel');
        $courseCode = $this->request->getVar('courseCode');
        $model->removeCourse($courseCode,session()->get('username'));
        $data = $model->getSearch(session()->get('username'));
        $try = ['results' => $data];
        echo view('template/header');
        echo view('Views/cart', $try );
        echo view('template/footer');
    }
}
