<?php
use Application\core\Controller;

class Retrato extends Controller
{
    public function index()
    {
        $Retrato = $this->model('Retratos');
        $Retratos = $Retrato::findAll();
        
        $Usuario = $this->model('Usuarios');
        $Usuarios = $Usuario::findAll();

        $this->view('retrato/index', ['retratos' => $Retratos, 'usuarios' => $Usuarios]);
    }

    public function delete($id = null)
    {
        if (is_numeric($id)) {
            $Retratos = $this->model('Retratos');
            $retrato = $Retratos::findById($id);

            if ($retrato) {
                $filePath = '../public/retratos/' . $retrato['retrato'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $Retratos::deleteById($id);
            }
            $this->redirect('retrato/index');
        } else {
            $this->pageNotFound();
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['retrato'])) {
            $usuarioId = $_POST['id_usuario'];
            $retratoFile = $_FILES['retrato'];
            
            if ($retratoFile['error'] == UPLOAD_ERR_OK && $retratoFile['type'] == 'image/jpeg') {
                $timestamp = date('YmdHis');
                $retratoName = $timestamp . '.jpg';
                $uploadPath = '../public/retratos/' . $retratoName;

                if (move_uploaded_file($retratoFile['tmp_name'], $uploadPath)) {
                    $retratos = $this->model('Retratos');
                    $retratos::create($usuarioId, $retratoName);
                    $this->redirect('retrato/index');
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
