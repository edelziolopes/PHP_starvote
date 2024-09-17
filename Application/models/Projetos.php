<?php
namespace Application\models;
use Application\core\Database;
use PDO;

class Projetos
{
    public static function findAll()
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT p.id, p.projeto, p.descricao, p.id_equipe, e.equipe
            FROM tb_projeto p
            JOIN tb_equipe e ON p.id_equipe = e.id
        ');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT p.id, p.projeto, p.descricao, p.id_equipe, e.equipe
            FROM tb_projeto p
            JOIN tb_equipe e ON p.id_equipe = e.id
            WHERE p.id = :ID LIMIT 1', array(':ID' => $id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('DELETE FROM tb_projeto WHERE id = :ID', array(':ID' => $id));
        return $result->rowCount();
    }

    public static function editById(int $id, string $projeto, string $descricao, int $id_equipe)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'UPDATE tb_projeto SET projeto = :PROJETO, descricao = :DESCRICAO, id_equipe = :ID_EQUIPE WHERE id = :ID',
            array(':PROJETO' => $projeto, ':DESCRICAO' => $descricao, ':ID_EQUIPE' => $id_equipe, ':ID' => $id)
        );
        return $result->rowCount();
    }

    public static function create(string $projeto, string $descricao, int $id_equipe)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'INSERT INTO tb_projeto (projeto, descricao, id_equipe) VALUES (:PROJETO, :DESCRICAO, :ID_EQUIPE)',
            array(':PROJETO' => $projeto, ':DESCRICAO' => $descricao, ':ID_EQUIPE' => $id_equipe)
        );
        return $result->rowCount();
    }
}
