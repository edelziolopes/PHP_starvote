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
            SELECT v.id, u.nome AS usuario, p.projeto AS projeto, e.equipe AS equipe, v.voto
            FROM tb_voto v
            JOIN tb_usuario u ON v.id_usuario = u.id
            JOIN tb_projeto p ON v.id_projeto = p.id
            JOIN tb_equipe e ON p.id_equipe = e.id
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
    public static function createOrUpdate(int $id_usuario, int $id_projeto, int $voto)
    {
        $conn = new Database();
        $query = '
            INSERT INTO tb_voto (id_usuario, id_projeto, voto)
            VALUES (:ID_USUARIO, :ID_PROJETO, :VOTO)
            ON DUPLICATE KEY UPDATE voto = :VOTO';
        
        $result = $conn->executeQuery($query, [
            ':ID_USUARIO' => $id_usuario,
            ':ID_PROJETO' => $id_projeto,
            ':VOTO' => $voto
        ]);

        return $result->rowCount();
    }

    public static function somaVotosPorProjeto()
{
    $conn = new Database();
    $result = $conn->executeQuery('
        SELECT p.id AS projeto_id, p.projeto, SUM(v.voto) AS soma_votos
        FROM tb_projeto p
        LEFT JOIN tb_voto v ON p.id = v.id_projeto
        GROUP BY p.id
        ORDER BY soma_votos DESC, p.projeto;
    ');
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

    public static function findByUserAndProject(int $id_usuario, int $id_projeto)
    {
        $conn = new Database();
        $result = $conn->executeQuery('
            SELECT voto 
            FROM tb_voto 
            WHERE id_usuario = :ID_USUARIO AND id_projeto = :ID_PROJETO LIMIT 1', 
            array(':ID_USUARIO' => $id_usuario, ':ID_PROJETO' => $id_projeto)
        );
        return $result->fetch(PDO::FETCH_ASSOC);
    }


}
