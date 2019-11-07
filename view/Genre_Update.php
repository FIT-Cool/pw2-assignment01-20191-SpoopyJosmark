<form method="post">
    <fieldset>
        <legend>Update Genre</legend>
        <label for="txtNameIdx" class="form-label">Name</label>
        <input type="text" id="txtNameIdx" name="txtName" placeholder="Name (e.g Cooking)" autofocus required
               class="form-input" value="<?php echo $genre->getName(); ?>">
        <input type="submit" name="btnUpdate" value="Update Genre" class="button button-primary">
    </fieldset>
</form>