<?php
use Application\core\Controller;

class Comentario extends Controller
{

    /*
    public function index()
    {
        $Comentarios = $this->model('Comentarios');
        $Usuarios = $this->model('Usuarios');
        $Projetos = $this->model('Projetos');
    
        $data = $Comentarios::findAll();
        $usuarios = $Usuarios::findAll();
        $projetos = $Projetos::findAll();
    
        $this->view('voto/index', ['comentarios' => $data,'usuarios' => $usuarios,'projetos' => $projetos]);
    }*/

    public function create($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $id_projeto = $_POST['id_projeto'];
            $comentario = $_POST['comentario'];
            $Comentarios = $this->model('Comentarios');
            $Comentarios::create($id_usuario, $id_projeto, $comentario);
            if (is_numeric($id)) { $this->redirect('home/show/'.$id); }
            else { $this->redirect('comentario/index'); }
            $this->redirect('comentario/index');
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
    
}
