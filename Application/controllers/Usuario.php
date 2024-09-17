<?php
use Application\core\Controller;

class Usuario extends Controller
{
    public function index()
    {
        $Usuarios = $this->model('Usuarios');
        $Equipes = $this->model('Equipes');
        $data = $Usuarios::findAll();
        $equipes = $Equipes::findAll();
        $this->view('usuario/index', ['usuarios' => $data, 'equipes' => $equipes]);
    }

    public function delete($id = null)
    {
        if (is_numeric($id)) {
            $Usuarios = $this->model('Usuarios');
            $Usuarios::deleteById($id);
            $this->redirect('usuario/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $id_equipe = $_POST['id_equipe'];
            $Usuarios = $this->model('Usuarios');
            $Usuarios::create($nome, $email, $id_equipe);

            $this->redirect('usuario/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $id_equipe = $_POST['id_equipe'];
            if (is_numeric($id)) {
                $Usuarios = $this->model('Usuarios');
                $Usuarios::editById($id, $nome, $email, $id_equipe);
                $this->redirect('usuario/index');
            } else {
                $this->pageNotFound();
            }
        } else {
            $this->pageNotFound();
        }
    }
    
}
