<?php
$genreDao = new GenreDao();
// Block below for fetch data
$id = filter_input(INPUT_GET, 'id');
if(isset($id)){
    $genre = $genreDao->getGenre($id);
}

// Block below for update
$submitted =filter_input(INPUT_POST,'btnUpdate');
if(isset($submitted)){
    $name=filter_input(INPUT_POST,'txtName');
    $genre = new Genre();
    $genre->setId($id);
    $genre->setName($name);
    $genreDao->updateGenre($genre);
    header("location:index.php?menu=gr");
//  updateGenre($id, $name);
}
?>

<form method="post">
    <fieldset>
        <legend>Update Genre</legend>
        <label for="txtNameIdx" class="form-label">Name</label>
        <input type="text" id="txtNameIdx" name="txtName" placeholder="Name (e.g Cooking)" autofocus required
               class="form-input" value="<?php echo $genre->getName(); ?>">
        <input type="submit" name="btnUpdate" value="Update Genre" class="button button-primary">
    </fieldset>
</form>