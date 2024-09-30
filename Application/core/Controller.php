<?php

namespace Application\core;

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
        $baseURL = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        $fullURL = rtrim($baseURL, '/') . '/' . ltrim($url, '/');
        header('Location: ' . $fullURL);
        exit();
    }

    public function checkAccess(array $requiredTeamIds)
    {
        if (isset($_COOKIE['usuario_id'])) {
            $Usuarios = $this->model('Usuarios');
            $usuario = $Usuarios::findById($_COOKIE['usuario_id']);
            if ($usuario && in_array($usuario['id_equipe'], $requiredTeamIds)) {
                return true;
            }
        }
        $this->pageNotFound();
        exit();
    }
}
