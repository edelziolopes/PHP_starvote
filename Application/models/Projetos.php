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
        SELECT p.id, p.projeto, p.descricao, p.id_equipe, e.equipe, c.categoria
        FROM tb_projeto p
        JOIN tb_equipe e ON p.id_equipe = e.id
        JOIN tb_categoria c ON e.id_categoria = c.id
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
    public static function findByIdAllDetails(int $id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT 
            p.id AS projeto_id, 
            p.projeto AS projeto_nome, 
            p.descricao, 
            e.equipe AS equipe_nome, 
            u.nome AS usuario_nome, 
            f.foto
            FROM tb_projeto p
            JOIN tb_equipe e ON p.id_equipe = e.id
            JOIN tb_vinculo v ON p.id = v.id_projeto
            JOIN tb_usuario u ON v.id_usuario = u.id
            LEFT JOIN tb_foto f ON p.id = f.id_projeto
            WHERE p.id = :ID', array(':ID' => $id));
        return $result->fetchAll(PDO::FETCH_ASSOC);
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

    public static function findAllWithDetails($id = null)
    {
        $conn = new Database();
        if ($id) {
            $result = $conn->executeQuery('
            SELECT 
                p.id AS projeto_id, 
                p.projeto AS projeto_nome, 
                p.descricao, 
                e.id AS equipe_id, 
                e.equipe AS equipe_nome, 
                u.nome AS usuario_nome, 
                f.foto
            FROM tb_projeto p
            JOIN tb_equipe e ON p.id_equipe = e.id
            JOIN tb_vinculo v ON p.id = v.id_projeto
            JOIN tb_usuario u ON v.id_usuario = u.id
            LEFT JOIN tb_foto f ON p.id = f.id_projeto
            WHERE e.id = :ID', array(':ID' => $id));
        } else {
        $result = $conn->executeQuery('
            SELECT 
                p.id AS projeto_id, 
                p.projeto AS projeto_nome, 
                p.descricao, 
                e.equipe AS equipe_nome, 
                u.nome AS usuario_nome, 
                f.foto
            FROM tb_projeto p
            JOIN tb_equipe e ON p.id_equipe = e.id
            JOIN tb_vinculo v ON p.id = v.id_projeto
            JOIN tb_usuario u ON v.id_usuario = u.id
            LEFT JOIN tb_foto f ON p.id = f.id_projeto
        ');
        }
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findAllWithDetailsByEquipe(int $id)
    {
        $conn = new Database();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
