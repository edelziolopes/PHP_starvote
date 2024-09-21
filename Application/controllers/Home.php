<?php
use Application\core\Controller;
class Home extends Controller
{
  public function index()
  {
      $Projetos = $this->model('Projetos');
      $data = $Projetos::findAllWithDetails();
      $this->view('home/index', ['projetos' => $data]);
  }

}
