<?php


class GenreController
{
//    private $genreDao;
//
//    public function __construct()
//    {
//        $this->genreDao = new GenreDao();
//    }

    public function index()
    {
// Block below for delete
        $deleteCommand = filter_input(INPUT_GET, 'delcom');
        if (isset($deleteCommand) && $deleteCommand == 1) {
            $id = filter_input(INPUT_GET, 'id');
            $genre = new Genre();
            $genre->setId($id);
            $this->genreDao->deleteGenre($genre);
        }

// Block below for insert
        $submitted = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($submitted)) {
            $name = filter_input(INPUT_POST, 'txtName');
            Utility::curl_post('http://localhost/ws_deploy/service/add_genre_service.php', array('txtName' => $name));
//            $genre = new Genre();
//            $genre->setName($name);
//            $this->genreDao->addGenre($genre);
        }
        $dataFromWS = Utility::curl_get('http://localhost/ws_deploy/service/get_all_genre_service.php', array());
        $genres = json_decode($dataFromWS);
        var_dump($genres);
        include_once 'view/Genre.php';
    }
}