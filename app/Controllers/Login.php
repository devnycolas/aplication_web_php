<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index() {
        
        
        if ($this->estaLogado()) {
            
            return redirect()->to('/produtos/listar');
            
        }

        return view('login/index');
    }

    public function autenticar() {


        $validated = $this->validate(
            [
                'email' => 'required|valid_email',
                'password' => 'required',
            ],
            [
                'email' => [
                    'required' => 'O e-mail é obrigatório',    
                    'valid_email' => 'Por favor coloque um e-mail válido',    
                ],
                'password' => [
                    'required' => 'A senha é obrigatória',
                ],
            ]
        );
        
        if (!$validated) {

            return redirect()->route('login')->with('errors', $this->validator->getErrors());

        }

        $dados = $this->request->getVar();

        $login_model = new UsersModel();

        $user = $login_model
            ->where('email', $dados['email'])
            ->first();

        if (!empty($user) && password_verify($dados['password'], $user['password'])) {

            $this->criarSessaoUsuario($user);

            return redirect()->to('/produtos/listar');
        }

        return redirect()->to('/login')->with('errorUserNotFound', 'E-mail ou senha incorreto!');
    }

    private function estaLogado() {

        $session = session();


        return $session->has('user_id');
    }

    private function criarSessaoUsuario($user) {

        $session = session();

        $sessionData = [
            'user_id' => $user['user_id'],
            'fullname' => $user['fullname'],
            'email' => $user['email'],
        ];

        $session->set($sessionData);
    }

    public function sair() {

        $session = session();

        $session->destroy();

        return redirect()->to('/login');
    }
}
