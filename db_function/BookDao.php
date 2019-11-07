<?php


class BookDao
{
    public function getAllBook()
    {
        $link = DBHelper::createMySQLConnection();
        $query = 'SELECT * FROM book b INNER JOIN genre g ON g.id=b.genre_id ORDER BY id';
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Book");
        return $result;

    }

    public function addBook(Book $book){
        $link = DBHelper::createMySQLConnection();
        $link->beginTransaction();
        $query='INSERT INTO isbn,title,author,publisher,publish_date,genre_id, synopsis, cover VALUES (?,?,?,?,?,?,?,?)';
        $statement = $link->prepare($query);
        $statement->bindValue(1,$book->getIsbn(),PDO::PARAM_STR);
        $statement->bindValue(2,$book->getTitle(),PDO::PARAM_STR);
        $statement->bindValue(3,$book->getAuthor(),PDO::PARAM_STR);
        $statement->bindValue(4,$book->getPublisher(),PDO::PARAM_STR);
        $statement->bindValue(5,$book->getPublishDate(),PDO::PARAM_STR);
        $statement->bindValue(6,$book->getGenre(),PDO::PARAM_STR);
        $statement->bindValue(7,$book->getSynopsis(),PDO::PARAM_STR);
        $statement->bindValue(8,$book->getCover(),PDO::PARAM_STR);
        if ($statement->execute()){
            $link->commit();
        }else{
            $link->rollBack();
        }
        $link=null;
    }
}