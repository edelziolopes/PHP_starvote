<?php
namespace Application\models;
use Application\core\Database;
use PDO;

class Equipes
{
    public static function findAll()
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT e.id, e.equipe, e.id_categoria, c.categoria
            FROM tb_equipe e
            JOIN tb_categoria c ON e.id_categoria = c.id
        ');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT e.id, e.equipe, e.id_categoria, c.categoria
            FROM tb_equipe e
            JOIN tb_categoria c ON e.id_categoria = c.id
            WHERE e.id = :ID LIMIT 1', array(':ID' => $id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('DELETE FROM tb_equipe WHERE id = :ID', array(':ID' => $id));
        return $result->rowCount();
    }

    public static function editById(int $id, string $equipe, int $id_categoria)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'UPDATE tb_equipe SET equipe = :EQUIPE, id_categoria = :ID_CATEGORIA WHERE id = :ID',
            array(':EQUIPE' => $equipe, ':ID_CATEGORIA' => $id_categoria, ':ID' => $id)
        );
        return $result->rowCount();
    }

    public static function create(string $equipe, int $id_categoria)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'INSERT INTO tb_equipe (equipe, id_categoria) VALUES (:EQUIPE, :ID_CATEGORIA)',
            array(':EQUIPE' => $equipe, ':ID_CATEGORIA' => $id_categoria)
        );
        return $result->rowCount();
    }
}
