<?php

function getAllBook()
{
    $link = DBHelper::createMySQLConnection();
    $query = 'SELECT * FROM book b INNER JOIN genre g ON g.id=b.genre_id';
    $result = $link->query($query);
    return $result;

}

function addBook($isbn,$title,$author,$publisher,$publish_date,$genre, $synopsis = null, $cover = null){
    $link = DBHelper::createMySQLConnection();
    $link->beginTransaction();
    $query='INSERT INTO book(isbn,title,author,publisher,publish_date,genre_id, synopsis, cover) VALUES (?,?,?,?,?,?,?,?)';
    $statement = $link->prepare($query);
    $statement->bindParam(1,$isbn,PDO::PARAM_STR);
    $statement->bindParam(2,$title,PDO::PARAM_STR);
    $statement->bindParam(3,$author,PDO::PARAM_STR);
    $statement->bindParam(4,$publisher,PDO::PARAM_STR);
    $statement->bindParam(5,$publish_date,PDO::PARAM_STR);
    $statement->bindParam(6,$genre,PDO::PARAM_STR);
    $statement->bindParam(7,$synopsis,PDO::PARAM_STR);
    $statement->bindParam(8,$cover,PDO::PARAM_STR);
    if ($statement->execute()){
        $link->commit();
    }else{
        $link->rollBack();
    }
    $link=null;
}