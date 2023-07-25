<?php
namespace App\Controllers;
class Upload extends BaseController
{
	public function index() {
        $data['errors'] = "";
        echo view('template/header');
        echo view('upload', $data);
        echo view('template/footer');
    }

    public function upload_file() {
        $data['errors'] = "";
        $title = $this->request->getPost('title');
        $files = $this->request->getFiles();
        $username = session()->get('username');
        $comments = $this -> request -> getPost('comments');
        $uploadedFiles = [];
        foreach ($files['userfile'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                // Move the file to the upload directory
                $file->move(WRITEPATH . 'upload');
                $filename = $file->getName();
                $uploadedFiles[] = $filename;
            } else {
                Echo "Fail to Upload";
            }
        }
    
        $model = model('App\Models\Upload_model');
        $check = $model->upload($username, $title, $uploadedFiles, $comments);
    
        if ($check) {
            echo view('template/header');
            echo "upload_success!";
            echo view('template/footer');
        } else {
            $data['errors'] .= "<div class=\"alert alert-danger\" role=\"alert\"> Database upload failed!! </div> ";
            echo view('template/header');
            echo view('upload', $data);
            echo view('template/footer');
        }
    }    
}

