<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Register extends BaseController
{
    public function index() {

        if ($this->estaLogado()) {
            
            return redirect()->to('/produtos/listar');
            
        }

        return view('register/index');

    }

    public function autenticar() {

        $validated = $this->validate(
            [
                'fullname' => 'required|min_length[2]|max_length[50]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[20]',
                'retryPassword' => 'required|matches[password]',
            ],
            [
                'fullname' => [
                    'required' => 'O campo nome é obrigatório',
                    'min_length' => 'Número de caracteres insuficiente! Mínimo 2!',
                    'max_length' => 'Limite de caracteres ultrapassado! Máximo 50!',
                ],
                'email' => [
                    'required' => 'O e-mail é obrigatório',    
                    'valid_email' => 'Por favor coloque um e-mail válido',
                    'is_unique' => 'E-mail já cadastrado no sistema',
                ],
                'password' => [
                    'required' => 'A senha é obrigatória',
                    'min_length' => 'Número de caracteres insuficiente! Mínimo 6!',
                    'max_length' => 'Limite de caracteres ultrapassado! Máximo 20!',
                ],
                'retryPassword' => [
                    'required' => 'A senha é obrigatória',
                    'matches' => 'As senhas não coincidem',
                ],
            ]
        );
        
        if (!$validated) {

            return redirect()->route('register')->with('errors', $this->validator->getErrors());

        }

        $fullname = $this->request->getPost('fullname');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        if (!empty($fullname) && !empty($email) && !empty($password) && is_string($password)) {
    
            $usersModel = new UsersModel();
    
            $existingUser = $usersModel->where('email', $email)->first();
    
            if ($existingUser) {
                return redirect()->to('/register')->with('errorEmailExists', 'Já existe um usuário cadastrado com o e-mail fornecido!');
            }
    
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
            $data = [
                'fullname' => $fullname,
                'email' => $email,
                'password' => $passwordHash,
            ];
    
            $usersModel->insert($data);
    
            return redirect()->to('/login');
        } 
    
        return redirect()->to('/register')->with('errorFieldsEmpty', 'Por favor preencha todos os campos');
    }

    private function estaLogado() {

        $session = session();


        return $session->has('user_id');
    }
}
