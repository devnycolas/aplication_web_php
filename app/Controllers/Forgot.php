<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\Users;
use App\Libraries\Mail;
use App\Models\Forgot as ModelsForgot;
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

        $forgot = new ModelsForgot();
        $forgot->save([
            'token' => $token,
            'user_id' => $userFound['user_id'],
            'validate' => $date->format('Y-m-d H:i:s'),
        ]);

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

    private function tokenIsValid($token) {

        $forgot = new ModelsForgot();
        $forgotFound = $forgot->where('token', $token)->first();

        if (!$forgotFound) {
            session()->setFlashdata('token_not_found', 'Token não existe ou não é válido');

            return false;
        }

        $expiration = new DateTime($forgotFound['validate']);
        $now = new DateTime('now');

        if ($now > $expiration) {
            session()->setFlashdata('token_not_found', 'Token não existe ou não é válido');

            return false;
        }

        return $forgotFound;
    }

    public function edit($token) {
        
        if(!$token) {
            session()->setFlashdata('token_not_found', 'O token não existe ou não é válido.');

            return redirect()->route('forgot');
        }

        if (!$this->tokenIsValid($token)) {
            return redirect()->route('forgot');
        }

        return view('login/recover', ['token' => $token]);

    }

    public function update($token) {

        $validated = $this->validate(
            [
                'password' => 'required|min_length[6]|max_length[20]',
                'confirmPassword' => 'required|matches[password]',
            ],
            [
                'password' => [
                    'required' => 'A senha é obrigatória',
                    'min_length' => 'Número de caracteres insuficiente! Mínimo 6!',
                    'max_length' => 'Limite de caracteres ultrapassado! Máximo 20!',
                ],
                'confirmPassword' => [
                    'required' => 'A senha é obrigatória',
                    'matches' => 'As senhas não coincidem',
                ],
            ]
        );
        
        if (!$validated) {
            
            session()->setFlashdata('errors', $this->validator->getErrors());
            return view('login/recover', ['token' => $token]);
        }

        $password = $this->request->getGetPost('password');

        $forgotFound = $this->tokenIsValid($token);

        if (!$forgotFound) {
            return redirect()->route('forgot');
        }

        $user = new UsersModel();
        $saved = $user->save([
            'user_id' => $forgotFound['user_id'],
            'password' => password_hash((string)$password, PASSWORD_DEFAULT),
        ]);

        ($saved) ?
            session()->setFlashdata('updated', 'Senha alterada com sucesso!') :
            session()->setFlashdata('not_updated', 'Não foi possível alterar sua senha, tente novamente em alguns segundos!');

        return redirect()->route('login');
    }
}
