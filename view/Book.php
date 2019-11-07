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
            echo '<td>' . $book->getGenre()->getName() . '</td>';
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