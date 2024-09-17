<?php

use Application\core\Controller;

class Categoria extends Controller
{
  /*
  * chama a view index.php do  /categoria   ou somente   /
  */
  public function index()
  {
    $this->view('categoria/index');
  }

}
