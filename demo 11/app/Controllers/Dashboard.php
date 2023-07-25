<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {  
        $data = ['results' => []];
        return view('Views/dashboard', $data);
    }

    public function Rating()
    {
        $model = model('App\Models\Dashboard_model');
        $search = $this->request->getPost('search');
        $data = $model->getSearch(session()->get('username'));
        $try = ['results' => $data];
        return view('Views/dashboard', $try);
    }

    public function rate()
    {
        $model = model('App\Models\Dashboard_model');
        $your = $this->request->getVar('rate');
        $data = [
            'courseCode' => $this->request->getVar('courseCode'),
            'username' => session()->get('username'),
            'Rating' => $your
        ];
        $data = $model->rate($this->request->getVar('courseCode'),session()->get('username'),$data);
        echo "Done";
    }
}
