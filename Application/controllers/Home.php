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
            
            // Verificar se o usuário está logado
            if (isset($_COOKIE['usuario_id'])) {
                $usuarioId = $_COOKIE['usuario_id'];
                
                // Consultar o modelo de votos para verificar o voto existente
                $Votos = $this->model('Votos');
                $votoExistente = $Votos::findByUserAndProject($usuarioId, $id);
            } else {
                $votoExistente = null;
            }
    
            // Passar o projeto e o voto existente (se houver) para a view
            $this->view('home/show', [
                'projeto' => $Projeto,
                'votoExistente' => $votoExistente
            ]);
        } else {
            $this->pageNotFound();
        }
    }
    
  

}
