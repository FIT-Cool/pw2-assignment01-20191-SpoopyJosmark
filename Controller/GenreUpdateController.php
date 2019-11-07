<?php


class GenreUpdateController
{
    private  $genreDao;

    public function __construct()
    {
        $this->genreDao = new GenreDao();
    }

    public function index()
    {
        $id = filter_input(INPUT_GET, 'id');
        if(isset($id)){
            $genre = $this->genreDao->getGenre($id);
        }

// Block below for update
        $submitted =filter_input(INPUT_POST,'btnUpdate');
        if(isset($submitted)){
            $name=filter_input(INPUT_POST,'txtName');
            $genre = new Genre();
            $genre->setId($id);
            $genre->setName($name);
            $this->genreDao->updateGenre($genre);
            header("location:index.php?menu=gr");
//  updateGenre($id, $name);
        }
        include_once 'view/Genre_Update.php';
    }
}