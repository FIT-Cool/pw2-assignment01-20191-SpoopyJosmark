<?php
include_once '../entity/Genre.php';
include_once '../db_function/DBHelper.php';
include_once '../db_function/GenreDao.php';


$genreDao = new GenreDao();
$genres = $genreDao->getAllGenre();
header('Content-type:application/json');
echo json_encode($genres->fetchAll());
