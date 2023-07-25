<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Email\Email;
use TCPDF;

class EmailController extends Controller
{

    public function index()
    {
        helper(['form']);
        echo view('template/header');
        echo view('Email_handle/email_form');
        echo view('template/footer');
    }
    public function send()
    {
        helper(['form']);
        $username = $this->request->getPost('username');
        $receiver = $this->request->getVar('receiver');
        $model = $model = model('App\Models\EmailModel');
        $check = $model->checkUser($username, $receiver);
        if ($check) {
            $token = rand(100000, 999999);
            $model->setToken($username, $token);
            $sender = "vukhanhvy.ho@uqconnect.edu.au";
            $subject = "TechBridge reset password";
            $message = $token;
            $email = new Email();
            $emailConf = [
                'protocol' => 'smtp',
                'wordWrap' => true,
                'SMTPHost' => 'mailhub.eait.uq.edu.au',
                'SMTPPort' => 25
            ];
            $email->initialize($emailConf);
            
            $email->setTo($receiver);
            $email->setFrom($sender);
            $email->setSubject($subject);
            $email->setMessage($message);
            require_once('/var/www/htdocs/demo/app/TCPDF/tcpdf.php');
            $pdf = new TCPDF();
            $pdf->AddPage();
            $pdf->SetFont('times', '', 12);
            $pdf->Write(0, 'This is my token!');
            $pdfPath = WRITEPATH.'uploads/Receipt.pdf';
            $pdfContent = $pdf->Output($pdfPath, 'F');
            $email->attach($pdfPath, 'Receipt.pdf');
            if ($email->send()) {
                Echo 'Email sent successfully!';
                echo view('template/header');
                echo view('Views/Email_handle/resetPassword');
                echo view('template/footer');
            } else {
                Echo 'Error sending email. Please try again later.';
                echo view('template/header');
                echo view('Email_handle/email_form');
                echo view('template/footer');
            }
        } else {
            Echo 'this username did not register yet or the username does not match the provided email';
            echo view('template/header');
            echo view('email_form');
            echo view('template/footer');
        }
    }

    public function setPassword() {
        $username = $this->request->getPost('username');
        $token = $this->request->getPost('Token');
        $nPassword = $this->request->getPost('nPassword');
        $rPassword = $this->request->getPost('rPassword');
        if ($rPassword!=$nPassword) {
            Echo 'Newpassword and confirm password are different';
            echo view('template/header');
            echo view('Views/Email_handle/resetPassword');
            echo view('template/footer');
        } else {
            $model = model('App\Models\EmailModel');
            $check = $model -> getToken($username, $token);
            if ($check) {
                $hash = password_hash($nPassword, PASSWORD_DEFAULT);
                $model->resetPassword($username, $hash);
                echo view('template/header');
                $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> Reset password successfully, login again!! </div> ";
                echo view('Views/login', $data);
                echo view('template/footer');
            } else {
                Echo 'The token was wrong';
                echo view('template/header');
                echo view('Views/Email_handle/resetPassword');
                echo view('template/footer');
            }
        }
    }
}