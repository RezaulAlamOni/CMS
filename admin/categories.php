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
                        Welcome to Categories
                        <small>Subheading</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php
                            insert_categories();
                        ?>

                        <form action="" method="get">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add Categories">
                            </div>

                        </form>


                                <?php
                                  include ("include/update_category.php");
                                ?>

                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Catedory Title</th>
                                <th>Action</th>
                            </tr>
                            <tbody>

                            <?php
                                all_Categry_find();
                                delete_categories();
                            ?>

                            </tbody>
                            </thead>
                        </table>
                    </div>
            <!-- /.row -->

            <?php
            include("include/admin_footer.php");?>
