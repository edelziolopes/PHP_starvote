<?php
use Application\core\Controller;

class Vinculo extends Controller
{

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_projeto = $_POST['id_projeto'];
            $Vinculos = $this->model('Vinculos');
            $equipe = $Vinculos::findEquipeByProjeto($id_projeto);
            if ($equipe) {
                $usuarios = $Vinculos::findUsuariosByEquipe($equipe['id_equipe']);
                $Projetos = $this->model('Projetos');
                $projetos = $Projetos::findAll();
                $vinculos = $Vinculos::findAll();
                $this->view('vinculo/index', ['vinculos' => $vinculos, 'projetos' => $projetos, 'usuarios' => $usuarios]);
            } else {
                $this->view('vinculo/index', ['projetos' => [], 'usuarios' => []]);
            }
        } else {                
            $Vinculos = $this->model('Vinculos');
            $Projetos = $this->model('Projetos');
            $vinculos = $Vinculos::findAll();
            $projetos = $Projetos::findAll();
            $this->view('vinculo/index', ['vinculos' => $vinculos, 'projetos' => $projetos, 'usuarios' => []]);
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $id_projeto = $_POST['id_projeto'];
            $Vinculos = $this->model('Vinculos');

            // Criação do vínculo
            $Vinculos::create($id_usuario, $id_projeto);
            $this->redirect('vinculo/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function delete($id = null)
    {
        if (is_numeric($id)) {
            $Vinculos = $this->model('Vinculos');
            $Vinculos::deleteById($id);
            $this->redirect('vinculo/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function edit()
    {
        $this->pageNotFound();
    }
}
