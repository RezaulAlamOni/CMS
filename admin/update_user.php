<?php
include("include/admin_header.php");

?>

<div id="wrapper">
    <?php include("include/admin_nav.php");?>


    <div id="page-wrapper">

        <div class="container">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-header">
                        Update User :)
                        <small>_______</small>
                    </h1>

                    <?php
                    if (isset($_GET['update'])) {
                        $edit_user_id = $_GET['update'];
                        $sql = "SELECT * FROM `users` WHERE user_id={$edit_user_id}";
                        $result = mysqli_query($con, $sql);
                        confirm($result,$con);

                    while ($row = mysqli_fetch_assoc($result)) {

                        $user_firstname = $row['user_firstname'];
                        $user_lastname  = $row['user_lastname'];
                        $user_role      = $row['user_role'];
                        $user_email     = $row['user_email'];
                        $username       = $row['username'];
                        $password       = $row['password'];
                        $user_img       = $row['user_img'];
                        $id             = $row['user_id'];
                    }
                    ?>


                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="post">First Name</label>
                            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname;?>">
                        </div>
                        <div class="form-group">
                            <label for="post">Last Name</label>
                            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname;?>">
                        </div>
                        <div class="form-group">
                            <label for="user_role">User Role</label>
                            <select name="select_role" id="Select_role">
                                <option value='<?php echo $user_role;?>'><?php echo $user_role;?></option>";
                                <option value="admin">Admin</option>
                                <option value="subscriber">Subscriber</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="post">User Name</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username;?>" disabled >
                        </div>
                        <div class="form-group">
                            <label for="post">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $user_email;?>" disabled>
                        </div>
                        <?php
                        if ($_SESSION['id']==$id) {
                        ?>
                        <div class="form-group">
                            <label for="post">Password</label>
                            <input type="password" name="pass" class="form-control" value="<?php ?>" >
                        </div>
                        <?php
                        }

                        ?>

<!--                        <div class="form-group">-->
<!--                            <label for="post">Confirm Password</label>-->
<!--                            <input type="password" name="cpass" class="form-control">-->
<!--                        </div>-->

                        <div class="form-group">
                            <label for="img">Usre Image</label>
                            <img width="100" src="../img/<?php echo $user_img;?>" alt="">
                            <input type="file" name="pic">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update" value="update_User">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
        <?php

            }

        update_user();//Update category function

    include("include/admin_footer.php");?>

