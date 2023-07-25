<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Email\Email;
use TCPDF;

class Receipt extends Controller
{
    public function index()
    {
        helper(['form']);
        $username = 'in';
        $receiver = 'vy.ho18032002@gmail.com';
        $model = $model = model('App\Models\EmailModel');
        $check = true;
        if ($check) {
            $token = rand(100000, 999999);
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
            $pdf->Write(0, 'This is my receipt!');
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
}