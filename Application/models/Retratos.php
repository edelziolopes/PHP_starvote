<?php
namespace Application\models;
use Application\core\Database;
use PDO;

class Retratos
{
    public static function findAll()
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT r.id, r.retrato, u.nome
            FROM tb_retrato r
            JOIN tb_usuario u ON r.id_usuario = u.id
        ');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT r.id, r.retrato, u.nome
            FROM tb_retrato r
            JOIN tb_usuario u ON r.id_usuario = u.id
            WHERE r.id = :ID LIMIT 1', array(':ID' => $id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('DELETE FROM tb_retrato WHERE id = :ID', array(':ID' => $id));
        return $result->rowCount();
    }

    public static function create(int $id_usuario, string $retrato)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'INSERT INTO tb_retrato (id_usuario, retrato) VALUES (:ID_USUARIO, :RETRATO)
            ON DUPLICATE KEY UPDATE retrato = :RETRATO',
            array(':ID_USUARIO' => $id_usuario, ':RETRATO' => $retrato)
        );
        return $result->rowCount();
    }
}
