<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdutoModel;
use CodeIgniter\HTTP\ResponseInterface;

class Produtos extends BaseController {

    // public function listar() {

    //     $produto_model = new ProdutoModel();

    //     $produtos = $produto_model->findAll();

    //     $data['produtos'] = $produtos;

    //     echo view('templates/header');
    //     echo view('produtos/listar', $data);
    //     echo view('templates/footer');
    // }

    public function listar() {

        if (!$this->estaLogado()) {

            return redirect()->to('/login');
            
        }

        $produto_model = new ProdutoModel();
        $produtos = $produto_model->findAll();
        $data['produtos'] = $produtos;

        echo view('templates/header');
        echo view('produtos/listar', $data);
        echo view('templates/footer');
    }

    private function estaLogado() {
        
        $session = session();

        return $session->has('user_id');
    }
    
    public function cadastrar() {

        $dados = $this->request->getVar();

        $produto_model = new ProdutoModel();

        $produto_model->insert($dados);

        return redirect()->to('/produtos/listar')->with('messageSuccessCreate', 'Produto cadastrado com sucesso!');

    }

    public function excluir($ProdutoId) {

        $produto_model = new ProdutoModel();

        $produto_model->where('ProdutoId', $ProdutoId)->delete();

        return redirect()->to('/produtos/listar')->with('messageSuccessDelete', 'Produto excluído com sucesso!');
    }

    public function editar() {

        $dados = $this->request->getVar();

        $produto_model = new ProdutoModel();

        $produto_model->where('ProdutoId', $dados['ProdutoId'])->set($dados)->update();

        return redirect()->to('/produtos/listar')->with('messageSuccessEdit', 'Produto editado com sucesso!');

    }

}
