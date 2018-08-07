<?php include("include/admin_header.php"); ?>
<div id="wrapper">
    <?php include("include/admin_nav.php");?>
    <div id="page-wrapper">
        <div class="container-fluid">
           <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to all comments
                        <small>Subheading</small>
                    </h1>
                    <?php
                    if (isset($_POST['checkboxArray'])){
                        foreach ($_POST['checkboxArray'] as $checkboxid){
                            $block_option = $_POST['block_option'];

                            switch ($block_option){

                                case 'approved':
                                    $sql = "UPDATE `comments` SET `comnt_stts`='{$block_option}' WHERE `comnt_id`={$checkboxid}";
                                    $updatetopublished = mysqli_query($con,$sql);

                                    break;
                                case 'unapproved':
                                    $sql = "UPDATE `comments` SET `comnt_stts`='{$block_option}' WHERE `comnt_id`={$checkboxid}";
                                    $updatetodrft = mysqli_query($con,$sql);
                                    break;

                                case 'delete':
                                    $sql = "DELETE FROM `comments` WHERE `comnt_id`={$checkboxid}";
                                    $delete = mysqli_query($con,$sql);
                                    break;

                            }
                        }
                    }
                    ?>

<!--                    <table class="table table-bordered table-hover table-responsive"  style="background-color: #bce8f1">-->
                        <form action="" method="post">
                            <table class="table table-bordered table-hover">

                                <div id="bulkOptionContainer" class="col-xs-4" style="padding: 0px;background-color: darkblue">

                                    <select class="form-control" name="block_option" id="">
                                        <option class="text-info" value="">Select Option</option>
                                        <option value="approved">Approve</option>
                                        <option value="unapproved">Unapproved</option>
                                        <option value="delete">Delete</option>

                                    </select>
                                </div>
                                <div class="col-xs-4">
                                    <a href=""><input class="btn btn-success" type="submit" name="submit" value="Apply"></a>
<!--                                    <a class="btn btn-info" href="add_post.php">Add Post</a>-->
                                </div>


                        <thead class="text-primary text-uppercase text-center" style="background-color: #d9534f;color: white;">
                            <tr>
                                <th><input class="checkbox" id="selectAllBox" type="checkbox"></th>
                                <th>Id</th>
<!--                            <th>Cmnt Post id</th>-->
                                <th>Comment Author</th>
                                <th>Email</th>
                                <th>In Response to</th>
                                <th>Date</th>
                                <th>Comment Content</th>
                                <th>Comment Status</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <form>

<!--                        //View All cmnt  :) -->
                    <?php
                    all_cmnt();
                    delete_comment();
                    approve_comment();
                    unapprove_comment();

                   ?>

<!--             //View All cmnt :) -->

                        </form>
                        </tbody>
                    </table>

                    <?php
                    include("include/admin_footer.php");?>
