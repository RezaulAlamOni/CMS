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
                        Welcome to all User
                        <small>Subheading</small>
                    </h1>
                    <a class="btn btn-primary" href="add_user.php"> Add User</a>
                    <table class="table table-bordered table-hover table-responsive"  style="background-color: #bce8f1">
                        <thead class="text-primary text-uppercase text-center" style="background-color: #a489d9;color: white;">
                            <tr>
                                <th>User ID</th>
                                <th>Profile Pic</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>User Role</th>
                                <th>Date</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Make Admin</th>
                                <th>Make Subscriber</th>
                            </tr>
                        </thead>
                        <tbody>

<!--                        //View All cmnt  :) -->
                    <?php
                        all_users();
                        remove_user();
                        make_subscriber();
                        make_admin();

                   ?>

<!--             //View All cmnt :) -->


                        </tbody>
                    </table>

                    <?php
                    include("include/admin_footer.php");?>
