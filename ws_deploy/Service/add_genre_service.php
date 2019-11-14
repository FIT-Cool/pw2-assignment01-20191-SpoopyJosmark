<?php
include_once '../entity/Genre.php';
include_once '../db_function/DBHelper.php';
include_once '../db_function/GenreDao.php';

$name = filter_input(INPUT_POST, 'txtName');
// Validasi dibuat masing-masing
$genre = new Genre();
$genre->setName($name);
$genreDao = new GenreDao();
$result = $genreDao->addGenre($genre);
$data = array('status' => $result);
header('Content-type:application/json');
echo json_encode($data);