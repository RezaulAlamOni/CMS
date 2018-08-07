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
                        Welcome to all comments
                        <small>Subheading</small>
                    </h1>

                    <table class="table table-bordered table-hover table-responsive"  style="background-color: #bce8f1">
                        <thead class="text-primary text-uppercase text-center" style="background-color: #d9534f;color: white;">
                            <tr>
<!--                                <th><input class="checkbox" id="selectAllBox" type="checkbox"></th>-->
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
                        <tbody>

<!--                        //View All cmnt  :) -->
                    <?php
                    all_post_cmnt();
                    delete_post_comment();
                    approve_post_comment();
                    unapprove_post_comment();

                   ?>

<!--             //View All cmnt :) -->


                        </tbody>
                    </table>

                    <?php
                    include("include/admin_footer.php");?>
