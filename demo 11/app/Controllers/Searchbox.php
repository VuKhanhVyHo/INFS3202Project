<?php

namespace App\Controllers;

class Searchbox extends BaseController
{
    public function index() 
    {
        $data = ['results' => []];
        return view('Views/courses', $data);
    }

    public function page1($courseCode)
    {
        $scrollPosition = session()->get('position');
        echo view('template/header');   
        echo view($courseCode,['position' => $scrollPosition]);
        echo view('template/footer');
    }

    public function getSearchValue()
    {
        $model = model('App\Models\Search_model');
        $search = $this->request->getVar('search');
        $data = $model->getSearchResults($search);
        echo json_encode($data);
    }
    
    public function getcourse()
    {
        $model = model('App\Models\Search_model');
        $search = $this->request->getPost('search');
        $data = $model->getSearchResults($search);
        $try = ['results' => $data];
        return view('Views/courses', $try);
    }

    public function addCourse()
    {
        $model = model('App\Models\Search_model');
        $data =[
            'courseCode' => $this->request->getVar('courseCode'),
            'username' => session()->get('username')
        ];
        $check = $model -> check($this->request->getVar('courseCode'),session()->get('username'));
        if ($check) {
            echo "Already enrolled, change course";
        } else {
            $model->Enrol($data);
            echo "Enroll successfully";
        }
    }

    public function addWish()
    {
        $model = model('App\Models\cartModel');
        $courseCode = $this->request->getVar('courseCode');
        $check = $model->check($courseCode, session()->get('username'));
        if ($check) {
            echo "Already in your wishlist";
        } else {
            $course = $model -> getCoursePrice($courseCode);
            $data =[
                'courseCode' => $courseCode,
                'Price' => $course->price,
                'username' => session()->get('username')
            ];
            $model->addWish($data);
            echo "Add successfully";
        }
    }
}
