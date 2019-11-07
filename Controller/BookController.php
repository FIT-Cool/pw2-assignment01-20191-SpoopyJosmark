<?php


class BookController
{
    private $bookDao;
    private $genreDao;
    private $viewUtil;

    public function __construct()
    {
        $this->genreDao = new GenreDao();
        $this->bookDao = new BookDao();
        $this->viewUtil = new ViewUtil();
    }

    public function index()
    {
        $submitted = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($submitted)) {
            $isbn = filter_input(INPUT_POST, 'txtISBN');
            $title = filter_input(INPUT_POST, 'txtTitle');
            $author = filter_input(INPUT_POST, 'txtAuthor');
            $publisher = filter_input(INPUT_POST, 'txtPublisher');
            $publish_date = filter_input(INPUT_POST, 'txtPublishDate');
            $synopsis = filter_input(INPUT_POST, 'txtSynopsis');
            $genre = filter_input(INPUT_POST, 'genre');

            if($this->viewUtil->fieldNotEmpty(array($isbn,$synopsis,$author,$publisher,$publish_date,$genre))){
                if(isset($_FILES['txtCover']['name']))
                {
                    $targetDirectory = 'uploads/';
                    $targetFile = $targetDirectory . $isbn . '.' . pathinfo($_FILES['txtCover']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['txtCover']['tmp_name'], $targetFile);
                    $book = new Book();
                    $book->setIsbn($isbn);
                    $book->setTitle($title);
                    $book->setAuthor($author);
                    $book->setPublisher($publisher);
                    $book->setPublishDate($publish_date);
                    $book->setGenre($genre);
                    $book->setSynopsis($synopsis);
                    $book->setCover($targetFile);
                    $this->bookDao->addBook($book);
                }
                else
                {
                    $book = new Book();
                    $book->setIsbn($isbn);
                    $book->setTitle($title);
                    $book->setAuthor($author);
                    $book->setPublisher($publisher);
                    $book->setPublishDate($publish_date);
                    $book->setGenre($genre);
                    $book->setSynopsis($synopsis);
                    $this->bookDao->addBook($book);
                }
                header('location:index.php?menu=bk');
            } else {
                $errMessage = 'Please check your input';
            }

            if (isset($errMessage))
            {
                echo '<div class="err-msg">' . $errMessage . '</div>';
            }
        }

        $genres = $this->genreDao->getAllGenre();
        $books = $this->bookDao->getAllBook();
        include_once 'view/Book.php';
    }
}