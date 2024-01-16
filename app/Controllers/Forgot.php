<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Mail;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;

class Forgot extends BaseController
{
    public function index()
    {
        return view('login/forgot');
    }

    public function store() {
        $email = $this->request->getGetPost('email');
        
        $user = new UsersModel();
        $userFound = $user->where('email', $email)->first();

        if(!$userFound) {
            session()->setFlashdata('error', 'Nenhum usuário cadastrado no e-mail informado!');

            return redirect()->route('forgot');
        }

        $date = new DateTime();
        $date->modify('+5 minutes');

        $token = md5(uniqid());

        $mail = new Mail();
        $mail->setFrom([
            'name' => 'Nycolas Nascimento',
            'email' => 'nycolasbrito2003@gmail.com',
        ]);
        $mail->setTo((string)$email);
        $mail->setSubject('Reset Password');
        $mail->setTemplate('emails/reset', [
            'name' => $userFound['fullname'],
            'token' => $token,
        ]);
        
        ($mail->send()) ?
            session()->setFlashdata('forgot_sent', 'Enviamos por email seu link para resetar sua senha.') :
            session()->setFlashdata('forgot_not_sent', 'Ocorreu um erro ao enviar o email, tente novamente em alguns segundos.');

        return redirect()->route('forgot');
    }
}
