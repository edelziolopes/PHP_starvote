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
    public function profile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_COOKIE['usuario_id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $id_equipe = $_POST['id_equipe'];
            $senha = isset($_POST['senha']) ? $_POST['senha'] : null;
    
            if (is_numeric($id)) {
                // Atualizar dados do usuário
                $Usuarios = $this->model('Usuarios');
                $Usuarios::editById($id, $nome, $email, $id_equipe, $senha);
    
                // Verifica e processa o upload do retrato
                if (isset($_FILES['retrato']) && $_FILES['retrato']['error'] == UPLOAD_ERR_OK) {
                    $retratoFile = $_FILES['retrato'];
                    $timestamp = date('YmdHis');
                    $retratoName = $timestamp . '.jpg';
                    $uploadPath = '../public/retratos/' . $retratoName;
    
                    if (move_uploaded_file($retratoFile['tmp_name'], $uploadPath)) {
                        $Retratos = $this->model('Retratos');
                        $Retratos::create($id, $retratoName);
                        setcookie('usuario_retrato', $retratoName, time() + (86400 * 30), "/");
                    }
                }
    
                $this->redirect('usuario/profile');
            } else {
                $this->pageNotFound();
            }
        } else {
            // Preenche a view com os dados do cookie
            $Equipes = $this->model('Equipes');
            $Equipe = $Equipes::findAll();

            $this->view('usuario/profile', [
                'nome' => $_COOKIE['usuario_nome'],
                'email' => $_COOKIE['usuario_email'],
                'id_equipe' => $_COOKIE['usuario_equipe'],
                'retrato' => $_COOKIE['usuario_retrato'],
                'equipes' => $Equipe
            ]);
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
                // Busca detalhes completos do usuário, incluindo o retrato
                $usuarioCompleto = $Usuarios::findById($usuario['id']);
    
                // Configurar cookies com os dados do usuário
                setcookie('usuario_id', $usuarioCompleto['id'], time() + (86400 * 30), "/");
                setcookie('usuario_equipe_id', $usuarioCompleto['id_equipe'], time() + (86400 * 30), "/");
                setcookie('usuario_nome', $usuarioCompleto['nome'], time() + (86400 * 30), "/");
                setcookie('usuario_email', $usuarioCompleto['email'], time() + (86400 * 30), "/");
                setcookie('usuario_equipe', $usuarioCompleto['equipe'], time() + (86400 * 30), "/");
                setcookie('usuario_retrato', $usuarioCompleto['retrato'], time() + (86400 * 30), "/");
    
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
        // Remover todos os cookies relacionados ao usuário
        setcookie('usuario_id', '', time() - 3600, "/");
        setcookie('usuario_equipe_id', '', time() - 3600, "/");
        setcookie('usuario_nome', '', time() - 3600, "/");
        setcookie('usuario_email', '', time() - 3600, "/");
        setcookie('usuario_equipe', '', time() - 3600, "/");
        setcookie('usuario_retrato', '', time() - 3600, "/");
    
        // Redirecionar para a página inicial
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
