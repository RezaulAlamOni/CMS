<?php
if (isset($_GET['edite'])) {
    $edit_id = $_GET['edite'];
    $sql = "SELECT * FROM `categories` WHERE id={$edit_id}";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row['id'];
        $cat_title = $row['cat_title'];
        ?>

        <form action="" method="get">

            <div class="form-group">
                <label for="cat-title">Update Category</label>
                <input type="text" class="form-control" name="cat_title" autofocus value="<?php if (isset($cat_title)) {
                    echo $cat_title;}; ?> ">


            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="id" VALUE="<?php echo $cat_id; ?>;">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="update" VALUE="Update Category">
            </div>
        </form>
        <?php
    }
}

        update_category();//Update category function
?>
