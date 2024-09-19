<?php
use Application\core\Controller;

class Voto extends Controller
{
    public function index()
    {
        $Votos = $this->model('Votos');
        $Usuarios = $this->model('Usuarios');
        $Projetos = $this->model('Projetos');
        
        $data = $Votos::findAll();
        $usuarios = $Usuarios::findAll();
        $projetos = $Projetos::findAll();

        $this->view('voto/index', ['votos' => $data, 'usuarios' => $usuarios, 'projetos' => $projetos]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $id_projeto = $_POST['id_projeto'];
            $voto = $_POST['voto'];
            $Votos = $this->model('Votos');
            $Votos::createOrUpdate($id_usuario, $id_projeto, $voto);
            
            $this->redirect('voto/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function delete($id = null)
    {
        if (is_numeric($id)) {
            $Votos = $this->model('Votos');
            $Votos::deleteById($id);
            $this->redirect('voto/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function edit()
    {
        $this->pageNotFound();
    }
}
