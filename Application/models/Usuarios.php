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
            SELECT u.id, u.nome, u.email, u.id_equipe, e.equipe, c.categoria
            FROM tb_usuario u
            JOIN tb_equipe e ON u.id_equipe = e.id
            JOIN tb_categoria c ON e.id_categoria = c.id
            ORDER BY u.nome ASC
        ');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT u.id, u.nome, u.email, u.id_equipe, e.equipe, r.retrato
            FROM tb_usuario u
            JOIN tb_equipe e ON u.id_equipe = e.id
            LEFT JOIN tb_retrato r ON u.id = r.id_usuario
            WHERE u.id = :ID LIMIT 1', 
            array(':ID' => $id)
        );
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    

    public static function deleteById(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('DELETE FROM tb_usuario WHERE id = :ID', array(':ID' => $id));
        return $result->rowCount();
    }

    public static function editById(int $id, string $nome, string $email, int $id_equipe, string $senha = null)
    {
        $conn = new Database();
        $query = 'UPDATE tb_usuario SET nome = :NOME, email = :EMAIL, id_equipe = :ID_EQUIPE';
        $params = array(':NOME' => $nome, ':EMAIL' => $email, ':ID_EQUIPE' => $id_equipe, ':ID' => $id);

        if ($senha) {
            $query .= ', senha = :SENHA';
            $params[':SENHA'] = password_hash($senha, PASSWORD_DEFAULT);
        }

        $query .= ' WHERE id = :ID';
        $result = $conn->executeQuery($query, $params);
        return $result->rowCount();
    }

    public static function create(string $nome, string $email, string $senha, int $id_equipe)
    {
        $conn = new Database();
        $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);
        $result = $conn->executeQuery(
            'INSERT INTO tb_usuario (nome, email, senha, id_equipe) VALUES (:NOME, :EMAIL, :SENHA, :ID_EQUIPE)',
            array(':NOME' => $nome, ':EMAIL' => $email, ':SENHA' => $hashedPassword, ':ID_EQUIPE' => $id_equipe)
        );
        return $result->rowCount();
    }

    public static function findByEmail($email)
    {
        $conn = new Database();
        $result = $conn->executeQuery('SELECT * FROM tb_usuario WHERE email = :EMAIL', array(':EMAIL' => $email));
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}