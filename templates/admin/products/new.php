<form action="" method="post" enctype="multipart/form-data" class="form">
    <div class="standard-input">
        <input id="name" type="text" name="name" placeholder=" ">
        <label for="name">Name</label>
        <span class="underline"></span>
    </div>
    <div class="standard-input">
        <input id="price" type="number" name="price" placeholder=" " step="0.01">
        <label for="price">Price</label>
        <span class="underline"></span>
    </div>
    <div class="standard-input">
        <input id="description" type="text" name="description" placeholder=" ">
        <label for="description">Description</label>
        <span class="underline"></span>
    </div>
    <label for="active" class="text-center">Active</label>
    <input type="checkbox" name="active" value="1" class="checkbox">
    <label for="image" class="text-center">Image</label>
    <input type="file" name="image" class="file">
    <label for="test">Category</label>
    <select name="category">
        <?php foreach( $this->categories as $category ) : ?>
            <option value="<?= $category[ 'categoryName' ] ?>"><?= $category[ 'categoryName' ] ?></option>
        <?php endforeach ?>
    </select>

    <!--
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
            <option value="<?= $category[ 'categoryName' ] ?>"><?= $category[ 'categoryName' ] ?></option>
        <?php endforeach ?>
    </select>
    -->
    <div class="form-buttons">
        <a href="/admin/products" class="form-button">Back</a>
        <button type="submit" class="form-submit-button form-button">Submit</button>
    </div>
</form>