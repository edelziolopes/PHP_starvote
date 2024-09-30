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
        $soma_votos = $Votos::somaVotosPorProjeto();
    
        $this->view('voto/index', ['votos' => $data,'usuarios' => $usuarios,'projetos' => $projetos,'soma_votos' => $soma_votos]);
    }

    public function create($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $id_projeto = $_POST['id_projeto'];
            $voto = $_POST['voto'];
            $Votos = $this->model('Votos');
            $Votos::createOrUpdate($id_usuario, $id_projeto, $voto);
            if (is_numeric($id)) { $this->redirect('home/show/'.$id); }
            else { $this->redirect('voto/index'); }
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
