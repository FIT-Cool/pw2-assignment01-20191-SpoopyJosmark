<?php
// Block below for delete
$deleteCommand = filter_input(INPUT_GET, 'delcom');
if(isset($deleteCommand) && $deleteCommand == 1){
    $id = filter_input(INPUT_GET, 'id');
    deleteGenre($id);
}

// Block below for insert
$submitted =filter_input(INPUT_POST,'btnSubmit');
if(isset($submitted)){
    $name=filter_input(INPUT_POST,'txtName');
    addGenre($name);
}
?>
<form method="post">
    <fieldset>
        <legend>New Genre</legend>
        <label for="txtNameIdx" class="form-label">Name</label>
        <input type="text" id="txtNameIdx" name="txtName" placeholder="Name (e.g Cooking)" autofocus required
               class="form-input">
        <input type="submit" name="btnSubmit" value="Add Genre" class="button button-primary">
    </fieldset>
</form>

<table id="myTable" class="display">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $genres = getAllGenre();
    foreach ($genres as $genre) {
        echo '<tr>';
        echo '<td>' . $genre['id'] . '</td>';
        echo '<td>' . $genre['name'] . '</td>';
        echo '<td><button onclick="updateGenre('.$genre['id'].')">Edit</button><button onclick="deleteGenre('.$genre['id'].')">Delete</button></td>';
    }
    ?>
    </tbody>
</table>