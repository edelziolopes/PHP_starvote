<?php
use Application\core\Controller;

class Projeto extends Controller
{
    //public function __construct() { $this->checkAccess([1, 2, 3, 4]); }
    
    public function index()
    {
        $Projetos = $this->model('Projetos');
        $Projeto = $Projetos::findAll();        
        $Equipes = $this->model('Equipes');
        $Equipe = $Equipes::findAll();
        $this->view('projeto/index', ['projetos' => $Projeto, 'equipes' => $Equipe]);
    }

    public function delete($id = null)
    {
        if (is_numeric($id)) {
            $Projetos = $this->model('Projetos');
            $Projetos::deleteById($id);
            $this->redirect('projeto/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $projeto = $_POST['projeto'];
            $descricao = $_POST['descricao'];
            $id_equipe = $_POST['id_equipe'];
            $Projetos = $this->model('Projetos');
            $Projetos::create($projeto, $descricao, $id_equipe);

            $this->redirect('projeto/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $projeto = $_POST['projeto'];
            $descricao = $_POST['descricao'];
            $id_equipe = $_POST['id_equipe'];
            if (is_numeric($id)) {
                $Projetos = $this->model('Projetos');
                $Projetos::editById($id, $projeto, $descricao, $id_equipe);
                $this->redirect('projeto/index');
            } else {
                $this->pageNotFound();
            }
        } else {
            $this->pageNotFound();
        }
    }
}
