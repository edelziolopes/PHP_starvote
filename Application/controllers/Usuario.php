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
            $senha = $_POST['senha'];
            $Usuarios = $this->model('Usuarios');
            $Usuarios::create($nome, $email, $senha, $id_equipe);
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
            $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

            if (is_numeric($id)) {
                $Usuarios = $this->model('Usuarios');
                $Usuarios::editById($id, $nome, $email, $id_equipe, $senha);
                $this->redirect('usuario/index');
            } else {
                $this->pageNotFound();
            }
        } else {
            $this->pageNotFound();
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $Usuarios = $this->model('Usuarios');
            $usuario = $Usuarios::findByEmail($email);
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                setcookie('usuario_id', $usuario['id'], time() + (86400 * 30), "/");
                setcookie('usuario_equipe_id', $usuario['id_equipe'], time() + (86400 * 30), "/");
                $this->redirect('home/index');
            } else {
                $this->view('usuario/login', ['error' => 'Credenciais inválidas']);
            }
        } else {
            $this->view('usuario/login');
        }
    }
    
    
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $id_equipe = $_POST['id_equipe'];
            
            $Usuarios = $this->model('Usuarios');
            $Usuarios::create($nome, $email, $senha, $id_equipe);
    
            $this->redirect('usuario/login');
        } else {
            $Equipes = $this->model('Equipes');
            $equipes = $Equipes::findAll();
            $this->view('usuario/register', ['equipes' => $equipes]);            
        }
    }

    public function logout()
    {
        setcookie('usuario_id', '', time() - 3600, "/"); // Remove o cookie
        setcookie('usuario_equipe_id', '', time() - 3600, "/"); // Remove o cookie
        $this->redirect('home/index');
    }

    public function checkAccess($requiredTeam)
    {
        if (!isset($_COOKIE['usuario_id'])) {
            $this->redirect('usuario/login');
        }
        $Usuarios = $this->model('Usuarios');
        $usuarioLogado = $Usuarios::findById($_COOKIE['usuario_id']);
        if ($usuarioLogado['id_equipe'] != $requiredTeam) {
            $this->view('errors/forbidden'); 
            exit;
        }
    }
}
