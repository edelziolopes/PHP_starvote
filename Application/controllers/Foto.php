<?php
use Application\core\Controller;

class Foto extends Controller
{
    public function index()
    {
        $Fotos = $this->model('Fotos');
        $Projetos = $this->model('Projetos');
        
        $data = $Fotos::findAll();
        $projetos = $Projetos::findAll();

        $this->view('foto/index', ['fotos' => $data, 'projetos' => $projetos]);
    }

    public function delete($id = null)
    {
        if (is_numeric($id)) {
            $Fotos = $this->model('Fotos');
            $foto = $Fotos::findById($id);

            if ($foto) {
                $filePath = '../public/fotos/' . $foto['foto'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $Fotos::deleteById($id);
            }
            $this->redirect('foto/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
            $projetoId = $_POST['id_projeto'];
            $fotoFile = $_FILES['foto'];
            
            if ($fotoFile['error'] == UPLOAD_ERR_OK && $fotoFile['type'] == 'image/jpeg') {
                $timestamp = date('YmdHis');
                $fotoName = $timestamp . '.jpg';
                $uploadPath = '../public/fotos/' . $fotoName;

                if (move_uploaded_file($fotoFile['tmp_name'], $uploadPath)) {
                    $Fotos = $this->model('Fotos');
                    $Fotos::create($projetoId, $fotoName);
                    $this->redirect('foto/index');
                } else {
                    $this->pageNotFound();
                }
            } else {
                $this->pageNotFound();
            }
        } else {
            $this->pageNotFound();
        }
    }

    public function edit()
    {
        $this->pageNotFound();
    }
}
