<?php
namespace Application\models;
use Application\core\Database;
use PDO;

class Fotos
{
    public static function findAll()
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT f.id, f.foto, p.projeto
            FROM tb_foto f
            JOIN tb_projeto p ON f.id_projeto = p.id
        ');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT f.id, f.foto, p.projeto
            FROM tb_foto f
            JOIN tb_projeto p ON f.id_projeto = p.id
            WHERE f.id = :ID LIMIT 1', array(':ID' => $id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('DELETE FROM tb_foto WHERE id = :ID', array(':ID' => $id));
        return $result->rowCount();
    }

    public static function create(int $id_projeto, string $foto)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'INSERT INTO tb_foto (id_projeto, foto) VALUES (:ID_PROJETO, :FOTO)',
            array(':ID_PROJETO' => $id_projeto, ':FOTO' => $foto)
        );
        return $result->rowCount();
    }
}
