<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class Signup extends BaseController
{
    public function index()
    {
        echo view('template/header');   
        echo view('Views/signup');
        echo view('template/footer');
    }

    public function check_signup()
    {
        helper(['form']);
        $data['errors'] = "";
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        if (strlen($password) < 8 || !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password)) {
            echo "Password too weak, do again";
            echo view('template/header');
            echo view('Views/signup');
            echo view('template/footer');

        }
        else {
            $email = $this->request->getPost('email');
            $model = model('App\Models\User_model');
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $check = $model->Signup($username, $hash, $email);
            if ($check) {
                $token = rand(100000, 999999);
                $sender = "vukhanhvy.ho@uqconnect.edu.au";
                $subject = "TechBridge sign up for new user";
                $message = $token;
                $mail = new Email();
                $emailConf = [
                    'protocol' => 'smtp',
                    'wordWrap' => true,
                    'SMTPHost' => 'mailhub.eait.uq.edu.au',
                    'SMTPPort' => 25
                ];
                $mail->initialize($emailConf);      
                $mail->setTo($email);
                $mail->setFrom($sender);
                $mail->setSubject($subject);
                $mail->setMessage($message);
                if ($mail->send()) {
                    $model -> Signupfirst($username, $hash, $email, $token);
                    Echo 'Email sent successfully!';
                    echo view('template/header');
                    echo view('Views/Email_handle/confirmEmail');
                    echo view('template/footer');
                } else {
                    Echo 'Error sending email. Please try again later.';
                    echo view('template/header');
                    echo view('Email_handle/signup');
                    echo view('template/footer');
                }
            } else {
                $data['errors'] = "<div class=\"alert alert-danger\" role=\"alert\"> Database upload failed!! </div> ";
                echo view('template/header');
                echo view('Views/signup', $data);
                echo view('template/footer');
            }
        }
    }

    public function Confirmed() {
        $username = $this->request->getPost('username');
        $token = $this->request->getPost('confirmToken');
        $model = model('App\Models\User_model');
        $check = $model -> Confirmation($username, $token);
        if ($check) {
            $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\">Register successfully, login now</div> ";
            echo view('template/header');
            echo view('Views/login', $data);
            echo view('template/footer');
        }
        else {
            $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\">You entered wrong token, sign up again</div> ";
            echo view('template/header');
            echo view('Views/signup', $data);
            echo view('template/footer');
        }
    }
}
