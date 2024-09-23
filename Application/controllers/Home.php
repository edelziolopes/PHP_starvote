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
      $this->view('home/show', ['projetos' => $Projeto]);
    } else {
      $this->pageNotFound();
    }
  }

}
