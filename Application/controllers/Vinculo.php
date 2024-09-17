<?php
use Application\core\Controller;

class Vinculo extends Controller
{
    public function index()
    {
        $Vinculos = $this->model('Vinculos');
        $Usuarios = $this->model('Usuarios');
        $Projetos = $this->model('Projetos');
        
        $data = $Vinculos::findAll();
        $usuarios = $Usuarios::findAll();
        $projetos = $Projetos::findAll();

        $this->view('vinculo/index', ['vinculos' => $data, 'usuarios' => $usuarios, 'projetos' => $projetos]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $id_projeto = $_POST['id_projeto'];
            $Vinculos = $this->model('Vinculos');
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
