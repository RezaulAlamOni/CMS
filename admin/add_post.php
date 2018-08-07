<?php
include("include/admin_header.php");

?>

<div id="wrapper">
    <?php include("include/admin_nav.php");?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Posts
                        <small>Subheading</small>
                    </h1>

                    <?php
                        add_post();
                    ?>


        <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="post">Post Title</label>
                    <input type="text" class="form-control" name="post_title" autofocus>
                </div>
                <div class="form-group">
                    <label for="post">Post Category :</label>
                    <select name="post_category" id="">
                        <option value="">Select Cetegory</option>

                        <?php

                        category_show_in_post_edite();
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post">User :</label>
                    <select name="post_author" id="">
                        <option value="<?php echo $_SESSION['username']; ?>"><?php echo $_SESSION['username']; ?></option>
                    </select>
                </div>

<!--                 <div class="form-group">-->
<!--                    <label for="post">Post Author</label>-->
<!--                    <input type="text" disabled="disabled" class="form-control" name="post_author" value="--><?php //echo $_SESSION['username']; ?><!--">-->
<!--                  </div>-->
                <div class="form-group">
                    <label for="post">Post date</label>
                    <input type="date" class="form-control" name="post_date">
                </div>
                <div class="form-group">
                    <label for="post">Post Image</label>
                    <input type="file" name="post_img">
                </div>
                <div class="form-group">
                    <label for="cat">Post Tag</label>
                    <input type="text" class="form-control" name="post_tag">
                </div>
                <div class="form-group">
                    <label for="cat">Post Content</label>
                    <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Add Post">
                </div>

            </form>

                </div>
            </div>
        </div>
    </div>

<?php
include("include/admin_footer.php");?>