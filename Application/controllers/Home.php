<?php
use Application\core\Controller;
class Home extends Controller
{
    public function index()
    {
      $Projetos = $this->model('Projetos');
      $Projeto = $Projetos::findAllWithDetails();
      $this->view('home/index', ['projetos' => $Projeto]);
    }

    public function show($id = null)
{
    if (is_numeric($id)) {
        $Projetos = $this->model('Projetos');
        $Projeto = $Projetos::findByIdAllDetails($id);

        $Comentarios = $this->model('Comentarios');
        $comentarios = $Comentarios::findByProjectId($id); // Buscar todos os comentários do projeto

        // Verificar se o usuário está logado
        if (isset($_COOKIE['usuario_id'])) {
            $usuarioId = $_COOKIE['usuario_id'];
            $Votos = $this->model('Votos');
            $votoExistente = $Votos::findByUserAndProject($usuarioId, $id);
        } else {
            $votoExistente = null;
        }

        $this->view('home/show', [
            'projeto' => $Projeto,
            'votoExistente' => $votoExistente,
            'comentarios' => $comentarios // Enviar os comentários para a view
        ]);

    } else {
        $this->pageNotFound();
    }
}

    
  

}
