<?php
namespace Application\models;
use Application\core\Database;
use PDO;

class Categorias
{
    public static function findAll()
    {
        $conn = new Database();
        $result = $conn->executeQuery('SELECT * FROM tb_categoria');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('SELECT * FROM tb_categoria WHERE id = :ID LIMIT 1', array(':ID' => $id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('DELETE FROM tb_categoria WHERE id = :ID', array(':ID' => $id));
        return $result->rowCount();
    }

    public static function editById(int $id, string $categoria, int $peso)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'UPDATE tb_categoria SET categoria = :CATEGORIA, peso = :PESO WHERE id = :ID',
            array(':CATEGORIA' => $categoria, ':PESO' => $peso, ':ID' => $id)
        );
        return $result->rowCount();
    }

    public static function create(string $categoria, int $peso)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'INSERT INTO tb_categoria (categoria, peso) VALUES (:CATEGORIA, :PESO)',
            array(':CATEGORIA' => $categoria, ':PESO' => $peso)
        );
        return $result->rowCount();
    }
}
