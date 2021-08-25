<form action="" method="post" enctype="multipart/form-data">
    <label for="name">Name</label>
    <input type="text" name="name">
    <label for="price">Price</label>
    <input type="number" step="0.01" name="price">
    <label for="description">Description</label>
    <textarea name="description" cols="30" rows="10"></textarea>
    <label for="active">Active</label>
    <input type="checkbox" name="active" value="1">
    <label for="image">Image</label>
    <input type="file" name="image">
    <select name="category">
        <?php foreach( $this->categories as $category ) : ?>
            <option value="<?= $category[ 'categoryId' ] ?>"><?= $category[ 'categoryName' ] ?></option>
        <?php endforeach ?>
    </select>
    <button type="submit">Submit</button>
</form>