<?php

namespace App\Controllers;

class CourseProfile
 extends BaseController
{
    public function index()
    {
        echo view('template/header2');
        echo view('Views/courseProfile');
        echo view('template/footer');
    }
}
