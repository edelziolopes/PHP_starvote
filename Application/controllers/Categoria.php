<?php
use Application\core\Controller;

class Categoria extends Controller
{
    public function index()
    {
        $Categorias = $this->model('Categorias');
        $data = $Categorias::findAll();
        $this->view('categoria/index', ['categorias' => $data]);
    }

    public function delete($id = null)
    {
        if (is_numeric($id)) {
            $Categorias = $this->model('Categorias');
            $Categorias::deleteById($id);
            $this->redirect('categoria/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoria = $_POST['categoria'];
            $peso = $_POST['peso'];
            $Categorias = $this->model('Categorias');
            $Categorias::create($categoria, $peso);

            $this->redirect('categoria/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $categoria = $_POST['categoria'];
            $peso = $_POST['peso'];
            if (is_numeric($id)) {
                $Categorias = $this->model('Categorias');
                $Categorias::editById($id, $categoria, $peso);
                $this->redirect('categoria/index');
            } else {
                $this->pageNotFound();
            }
        } else {
            $this->pageNotFound();
        }
    }
}
