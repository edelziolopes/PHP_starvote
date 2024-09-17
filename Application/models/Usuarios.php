<?php
namespace Application\models;
use Application\core\Database;
use PDO;

class Usuarios
{
    public static function findAll()
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT u.id, u.nome, u.email, u.id_equipe, e.equipe
            FROM tb_usuario u
            JOIN tb_equipe e ON u.id_equipe = e.id
        ');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT u.id, u.nome, u.email, u.id_equipe, e.equipe
            FROM tb_usuario u
            JOIN tb_equipe e ON u.id_equipe = e.id
            WHERE u.id = :ID LIMIT 1', array(':ID' => $id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('DELETE FROM tb_usuario WHERE id = :ID', array(':ID' => $id));
        return $result->rowCount();
    }

    public static function editById(int $id, string $nome, string $email, int $id_equipe)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'UPDATE tb_usuario SET nome = :NOME, email = :EMAIL, id_equipe = :ID_EQUIPE WHERE id = :ID',
            array(':NOME' => $nome, ':EMAIL' => $email, ':ID_EQUIPE' => $id_equipe, ':ID' => $id)
        );
        return $result->rowCount();
    }

    public static function create(string $nome, string $email, int $id_equipe)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'INSERT INTO tb_usuario (nome, email, id_equipe) VALUES (:NOME, :EMAIL, :ID_EQUIPE)',
            array(':NOME' => $nome, ':EMAIL' => $email, ':ID_EQUIPE' => $id_equipe)
        );
        return $result->rowCount();
    }
}
