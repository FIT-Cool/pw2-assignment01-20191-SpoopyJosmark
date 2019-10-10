<?php
$bookDao = new BookDao();
$genreDao = new GenreDao();

$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $isbn = filter_input(INPUT_POST, 'txtISBN');
    $title = filter_input(INPUT_POST, 'txtTitle');
    $author = filter_input(INPUT_POST, 'txtAuthor');
    $publisher = filter_input(INPUT_POST, 'txtPublisher');
    $publish_date = filter_input(INPUT_POST, 'txtPublishDate');
    $synopsis = filter_input(INPUT_POST, 'txtSynopsis');
    $genre = filter_input(INPUT_POST, 'genre');

    if(fieldNotEmpty(array($isbn,$synopsis,$author,$publisher,$publish_date,$genre))){
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
            $book->setGenreId($genre);
            $book->setSynopsis($synopsis);
            $book->setCover($targetFile);
            $bookDao->addBook($book);
        }
        else
        {
            $book = new Book();
            $book->setIsbn($isbn);
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setPublisher($publisher);
            $book->setPublishDate($publish_date);
            $book->setGenreId($genre);
            $book->setSynopsis($synopsis);
            $bookDao->addBook($book);
        }
//        var_dump($targetFile);
//        $cover = filter_input(INPUT_POST, 'txtCover');
//        var_dump($cover);
        header('location:index.php?menu=bk');
    } else {
        $errMessage = 'Please check your input';
    }

    if (isset($errMessage))
    {
        echo '<div class="err-msg">' . $errMessage . '</div>';
    }
}
?>
<form method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>New Book</legend>

        <label class="form-label">ISBN</label>
        <input type="text" id="txtISBNIdx" name="txtISBN" placeholder="ISBN" autofocus required
               class="form-input">
        <br>
        <label class="form-label">Title</label>
        <input type="text" id="txtTitleIdx" name="txtTitle" placeholder="Title" autofocus required
               class="form-input">
        <br>
        <label class="form-label">Author</label>
        <input type="text" id="txtAuthorIdx" name="txtAuthor" placeholder="Author" autofocus required
               class="form-input">
        <br>
        <label class="form-label">Publisher</label>
        <input type="text" id="txtPublisherIdx" name="txtPublisher" placeholder="Publisher" autofocus required
               class="form-input">
        <br>
        <label class="form-label">Publish_Date</label>
        <input type="date" id="txtPublishDateIdx" name="txtPublishDate" placeholder="Publish_Date" autofocus required
               class="form-input">
        <br>
        <label class="form-label">Synopsis</label>
        <textarea id="txtSynopsisIdx" rows="5" cols="20" name="txtSynopsis" placeholder="Synopsis for your book" autofocus required
                  class="form-input"> </textarea>
        <br>
        <label class="form-label">Cover</label>
        <input type="file" id="txtCoverIdx" name="txtCover" placeholder="Cover" autofocus required
               class="form-input">
        <br>
        <label  class="form-label">Genre</label>
        <select name="genre" id="">
            <?php
            $genres = $genreDao->getAllGenre();
            /* @var $genre Genre*/
            foreach ($genres as $genre) {
                echo '<option value="'.$genre->getId().'">' . $genre->getName() . '</option>';
            }
            ?>
        </select>
        <br>
        <input type="submit" name="btnSubmit" value="Add Book" class="button button-primary">

    </fieldset>
</form>

<table id="myTable" class="display">
    <thead>
    <tr>
        <th>ISBN</th>
        <th>Title</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Publish_Date</th>
        <th>Genre</th>
        <th>Cover</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $books = $bookDao->getAllBook();
        /* @var $book Book*/
        foreach ($books as $book) {
            echo '<tr>';
            echo '<td>' . $book->getIsbn() . '</td>';
            echo '<td>' . $book->getTitle() . '</td>';
            echo '<td>' . $book->getAuthor() . '</td>';
            echo '<td>' . $book->getPublisher() . '</td>';

            echo '<td>' .
                DateTime::createFromFormat('Y-m-d', $book->getPublishDate())->format('d M Y')
                . '</td>';
            echo '<td>' . $book->getGenreId() . '</td>';
//            if(isset($book['cover']) && file_exists($book['cover']))
//            {
                echo '<td> <img src="'. $book->getCover() . '" width="50" alt="Cover" class="cover-list"> </td>';
//            }
//            else
//            {
//                echo '<td> </td>';
//            }
        }
        ?>
    </tbody>
</table>