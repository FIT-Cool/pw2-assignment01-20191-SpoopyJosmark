<?php


class GenreDao
{
    public function getAllGenre()
    {
        $link = DBHelper::createMySQLConnection();
        $query = 'SELECT * FROM genre ORDER BY id ';
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Genre");
        return $result;

    }

    public function addGenre(Genre $genre)
    {
        $link = DBHelper::createMySQLConnection();
        $link->beginTransaction();
        $query = 'INSERT INTO genre(name) VALUES (?)';
        $statement = $link->prepare($query);
        $statement->bindValue(1, $genre->getName(), PDO::PARAM_STR);
        if ($statement->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
            $result = 0;
        }
        $link = null;
        return $result;
    }

    public function deleteGenre(Genre $genre)
    {
        $link = DBHelper::createMySQLConnection();
        $link->beginTransaction();
        $query = 'DELETE FROM genre WHERE id = ?';
        $statement = $link->prepare($query);
        $statement->bindValue(1, $genre->getId(), PDO::PARAM_INT);
        if ($statement->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        $link = null;
    }

    public function updateGenre(Genre $genre)
    {
        $link = DBHelper::createMySQLConnection();
        $link->beginTransaction();
        $query = 'UPDATE genre SET name = ? WHERE id = ?';
        $statement = $link->prepare($query);
        $statement->bindValue(1, $genre->getName(), PDO::PARAM_STR);
        $statement->bindValue(2, $genre->getId(), PDO::PARAM_INT);
        if ($statement->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        $link = null;
    }

    /**
     *@param $id
     *@return Genre
     */
    public function getGenre($id)
    {
        $link = DBHelper::createMySQLConnection();
        $query = "SELECT * from genre WHERE id = ? LIMIT 1";
        $statement = $link->prepare($query);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchObject('Genre');
        $link = null;
        return $result;
    }
}