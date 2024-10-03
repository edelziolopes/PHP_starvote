<?php
namespace Application\models;
use Application\core\Database;
use PDO;

class Comentarios
{
    public static function create(int $id_usuario, int $id_projeto, string $comentario)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'INSERT INTO tb_comentario (id_usuario, id_projeto, comentario) VALUES (:ID_USUARIO, :ID_PROJETO, :COMENTARIO)',
            array(':ID_USUARIO' => $id_usuario, ':ID_PROJETO' => $id_projeto, ':COMENTARIO' => $comentario)
        );
        return $result->rowCount();
    }

    public static function findAll()
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT c.id, c.comentario, u.nome 
            FROM tb_comentario c 
            JOIN tb_usuario u ON c.id_usuario = u.id 
        ');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT c.id, c.comentario, u.nome 
            FROM tb_comentario c 
            JOIN tb_usuario u ON c.id_usuario = u.id 
            WHERE c.id_projeto = :ID', array(':ID' => $id)
        );
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('DELETE FROM tb_comentario WHERE id = :ID', array(':ID' => $id));
        return $result->rowCount();
    }

    public static function findByProjectId(int $id_projeto)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT c.id, c.comentario, u.nome 
            FROM tb_comentario c 
            JOIN tb_usuario u ON c.id_usuario = u.id 
            WHERE c.id_projeto = :ID_PROJETO', array(':ID_PROJETO' => $id_projeto)
        );
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


}
