<?php

namespace App\Controllers;

class UserProfile extends BaseController
{
    public function index()
    {
        $model = model('App\Models\User_model');
        $data['user']=$model->getUser(session()->get('username'));
        echo view('template/header');
        echo view('Views/userProfile', $data);
        echo view('template/footer');
    }

    public function update()
    {
        $model = model('App\Models\User_model');
        $password = $this->request->getVar('password');
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if (password_verify($password, $hash)) {
            $data = [
                'password' => $hash,
                'firstName' => $this->request->getVar('firstName'),
                'lastName' => $this->request->getVar('lastName'),
                'email' => $this->request->getVar('email'),
                'address' => $this->request->getVar('address'),
                'payment' => $this->request->getVar('payment')
            ];
    
            $model->updateUser(session()->get('username'), $data);
            echo view('template/header');
            echo "upload_success!";
            echo view('template/footer');
        } else {
            echo 'Password did not hash correctly.';
        }
    }

    public function update_image() {
        $file = $this->request->getFile('image');
        $file->move(WRITEPATH . 'uploads');
        $cropX = $this->request->getPost('cropX');
        $cropY = $this->request->getPost('cropY');
        $cropWidth = $this->request->getPost('cropWidth');
        $cropHeight = $this->request->getPost('cropHeight');
        $filename = $file->getName();

        $image = \Config\Services::image()
            ->withFile(WRITEPATH . 'uploads/' . $filename)
            ->crop($cropWidth, $cropHeight, $cropX, $cropY)
            ->save(WRITEPATH . 'uploads/' . $filename);
        
        $model = model('App\Models\User_model');
        $model->update_image(session()->get('username'), $filename);
        $data['user'] = $model->getUser(session()->get('username'));
        
        echo view('template/header');
        echo view('Views/userProfile', $data);
        echo view('template/footer');
    }
}


