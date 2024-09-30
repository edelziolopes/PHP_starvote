<?php

use Application\core\Controller;

class Grafico extends Controller
{
    public function index()
    {
        $Votos = $this->model('Votos');
        $soma_votos = $Votos::somaVotosPorProjeto();
        $this->view('grafico/index', ['soma_votos' => $soma_votos]);
    }

    public function data()
    {
        $Votos = $this->model('Votos');
        $soma_votos = $Votos::somaVotosPorProjeto();
        $top3 = array_slice($soma_votos, 0, 3);
        header('Content-Type: application/json');
        echo json_encode($top3);
        exit();
    }
}
