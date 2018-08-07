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
                        Welcome to users
                        <small>Subheading</small>
                    </h1>

                    <?php
                        add_user();

                    ?>


        <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="post">First Name</label>
                    <input type="text" class="form-control" name="user_firstname" autofocus>
                  </div>
                <div class="form-group">
                    <label for="post">Last Name</label>
                    <input type="text" class="form-control" name="user_lastname">
                </div>
                <div class="form-group">
                    <select name="select_role" id="Select_role">
                        <option value="subscriber"> Select User Role</option>
                        <option value="admin">Admin</option>
                        <option value="subscriber">Subscriber</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="post">User Name</label>
                    <input type="text" class="form-control" name="username" >
                </div>
                <div class="form-group">
                    <label for="post">Email</label>
                    <input type="email" class="form-control" name="email" autofocus>
                </div>
                <div class="form-group">
                    <label for="post">Password</label>
                    <input type="password" name="pass" class="form-control">
                </div>
<!--                <div class="form-group">-->
<!--                    <label for="post">Confirm Password</label>-->
<!--                    <input type="password" name="cpass" class="form-control">-->
<!--                </div>-->

                <div class="form-group">
                        <label for="post">Post Image</label>
                    <input type="file" name="user_img">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Add User">
                </div>

            </form>

                </div>
            </div>
        </div>
    </div>

<?php
include("include/admin_footer.php");?>