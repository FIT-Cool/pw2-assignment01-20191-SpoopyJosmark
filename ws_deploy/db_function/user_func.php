<?php
function login($username, $password)
{
    $link = DBHelper::createMySQLConnection();
    $query = "SELECT id, username, name FROM user WHERE username = ? AND password = md5(?)";
    $statement = $link->prepare($query);
    $statement->bindParam(1, $username);
    $statement->bindParam(2, $password);
    $statement->execute();
    $result = $statement->fetch();
    $link = null;

    return $result;
}
?>