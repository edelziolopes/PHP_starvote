<?php
namespace Application\models;
use Application\core\Database;
use PDO;

class Votos
{
    public static function findAll()
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT v.id, u.nome AS usuario, p.projeto AS projeto, v.voto
            FROM tb_voto v
            JOIN tb_usuario u ON v.id_usuario = u.id
            JOIN tb_projeto p ON v.id_projeto = p.id
        ');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT v.id, u.nome AS usuario, p.projeto AS projeto, v.voto
            FROM tb_voto v
            JOIN tb_usuario u ON v.id_usuario = u.id
            JOIN tb_projeto p ON v.id_projeto = p.id
            WHERE v.id = :ID LIMIT 1', array(':ID' => $id)
        );
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('DELETE FROM tb_voto WHERE id = :ID', array(':ID' => $id));
        return $result->rowCount();
    }

    public static function editById(int $id, int $id_usuario, int $id_projeto, int $voto)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'UPDATE tb_voto SET id_usuario = :ID_USUARIO, id_projeto = :ID_PROJETO, voto = :VOTO WHERE id = :ID',
            array(':ID_USUARIO' => $id_usuario, ':ID_PROJETO' => $id_projeto, ':VOTO' => $voto, ':ID' => $id)
        );
        return $result->rowCount();
    }

    public static function create(int $id_usuario, int $id_projeto, int $voto)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'INSERT INTO tb_voto (id_usuario, id_projeto, voto) VALUES (:ID_USUARIO, :ID_PROJETO, :VOTO)',
            array(':ID_USUARIO' => $id_usuario, ':ID_PROJETO' => $id_projeto, ':VOTO' => $voto)
        );
        return $result->rowCount();
    }
}