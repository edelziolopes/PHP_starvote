<?php
namespace Application\models;
use Application\core\Database;
use PDO;

class Vinculos
{
    // Método para buscar todos os vínculos
    public static function findAll()
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT v.id, u.nome AS usuario, p.projeto AS projeto
            FROM tb_vinculo v
            JOIN tb_usuario u ON v.id_usuario = u.id
            JOIN tb_projeto p ON v.id_projeto = p.id
        ');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar vínculo por ID
    public static function findById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT v.id, u.nome AS usuario, p.projeto AS projeto
            FROM tb_vinculo v
            JOIN tb_usuario u ON v.id_usuario = u.id
            JOIN tb_projeto p ON v.id_projeto = p.id
            WHERE v.id = :ID LIMIT 1', array(':ID' => $id)
        );
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Método para deletar vínculo por ID
    public static function deleteById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('DELETE FROM tb_vinculo WHERE id = :ID', array(':ID' => $id));
        return $result->rowCount();
    }

    // Método para editar vínculo por ID
    public static function editById(int $id, int $id_usuario, int $id_projeto)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'UPDATE tb_vinculo SET id_usuario = :ID_USUARIO, id_projeto = :ID_PROJETO WHERE id = :ID',
            array(':ID_USUARIO' => $id_usuario, ':ID_PROJETO' => $id_projeto, ':ID' => $id)
        );
        return $result->rowCount();
    }

    // Método para criar um novo vínculo
    public static function create(int $id_usuario, int $id_projeto)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'INSERT INTO tb_vinculo (id_usuario, id_projeto) VALUES (:ID_USUARIO, :ID_PROJETO)
             ON DUPLICATE KEY UPDATE id_projeto = :ID_PROJETO',
            array(':ID_USUARIO' => $id_usuario, ':ID_PROJETO' => $id_projeto)
        );
        return $result->rowCount();
    }

    // Método para buscar projetos
    public static function findProjetos()
    {
        $conn = new Database();
        $result = $conn->executeQuery('SELECT * FROM tb_projeto');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar equipe associada a um projeto
    public static function findEquipeByProjeto(int $id_projeto)
    {
        $conn = new Database();
        $result = $conn->executeQuery('SELECT id_equipe FROM tb_projeto WHERE id = :ID_PROJETO', array(':ID_PROJETO' => $id_projeto));
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Método para buscar usuários de uma equipe
    public static function findUsuariosByEquipe(int $id_equipe)
    {
        $conn = new Database();
        $result = $conn->executeQuery('SELECT * FROM tb_usuario WHERE id_equipe = :ID_EQUIPE', array(':ID_EQUIPE' => $id_equipe));
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
