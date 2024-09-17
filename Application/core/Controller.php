<?php

namespace Application\core;

use Application\models\Users;

class Controller
{
  public function model($model)
  {
    require '../Application/models/' . $model . '.php';
    $classe = 'Application\\models\\' . $model;
    return new $classe();

  }

  public function view(string $view, $data = [])
  {
    require '../Application/views/' . $view . '.php';

  }

  public function pageNotFound()
  {
    $this->view('erro404');
  }

  public function redirect(string $url)
  {
      $baseURL = 'http://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
      $fullURL = $baseURL . ltrim($url, '/');
      header('Location: ' . $fullURL);
      exit();
  }
}