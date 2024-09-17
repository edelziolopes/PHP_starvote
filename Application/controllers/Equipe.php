<?php
use Application\core\Controller;

class Equipe extends Controller
{
    public function index()
    {
        $Equipes = $this->model('Equipes');
        $Categorias = $this->model('Categorias');
        $data = $Equipes::findAll();
        $categorias = $Categorias::findAll();
        $this->view('equipe/index', ['equipes' => $data, 'categorias' => $categorias]);
    }

    public function delete($id = null)
    {
        if (is_numeric($id)) {
            $Equipes = $this->model('Equipes');
            $Equipes::deleteById($id);
            $this->redirect('equipe/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $equipe = $_POST['equipe'];
            $id_categoria = $_POST['id_categoria'];
            $Equipes = $this->model('Equipes');
            $Equipes::create($equipe, $id_categoria);

            $this->redirect('equipe/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $equipe = $_POST['equipe'];
            $id_categoria = $_POST['id_categoria'];
            if (is_numeric($id)) {
                $Equipes = $this->model('Equipes');
                $Equipes::editById($id, $equipe, $id_categoria);
                $this->redirect('equipe/index');
            } else {
                $this->pageNotFound();
            }
        } else {
            $this->pageNotFound();
        }
    }
}
