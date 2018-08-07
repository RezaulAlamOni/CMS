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
                        Welcome to User
                        <small><?php
                            echo $_SESSION['username'];
                            ?></small>
                    </h1>

                    <?php

                        $username = $_SESSION['username'];
                        $sql = "SELECT * FROM `users` WHERE username= '{$username}' ";
                        $result = mysqli_query($con, $sql);
                        confirm($result, $con);

                        while ($row = mysqli_fetch_assoc($result)) {

                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_role = $row['user_role'];
                            $user_email = $row['user_email'];
                            $username = $row['username'];
                            $pass = $row['password'];
                            $user_img = $row['user_img'];
                            $id       = $row['user_id'];
                        }
                        ?>


                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="post">First Name</label>
                                <input type="text" class="form-control" name="user_firstname"
                                       value="<?php echo $user_firstname; ?>">
                            </div>
                            <div class="form-group">
                                <label for="post">Last Name</label>
                                <input type="text" class="form-control" name="user_lastname"
                                       value="<?php echo $user_lastname; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_role">User Role</label>
                                <select name="select_role" id="Select_role">
                                    <option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>
                                    ";
                                    <option value="admin">Admin</option>
                                    <option value="subscriber">Subscriber</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="post">User Name</label>
                                <input type="text" class="form-control" name="username"
                                       value="<?php echo $username; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="post">Email</label>
                                <input type="email" class="form-control" name="email"
                                       value="<?php echo $user_email; ?>" disabled>
                            </div>


                            <div class="form-group">
                                <label for="post">Password</label>
                                <input type="password" name="pass" class="form-control" value="">
                            </div>

<!--                            <div class="form-group">-->
<!--                                <label for="post">Confirm Password</label>-->
<!--                                <input type="password" name="cpass" class="form-control" value="--><?php //echo $pass;?><!--">-->
<!--                            </div>-->

                            <div class="form-group">
                                <label for="img">Usre Image</label>
                                <img width="100" src="../img/<?php echo $user_img; ?>" alt="">
                                <input type="file" name="pic">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="update" value="update_Profile">
                            </div>

                        </form>


                        <?php
                        update_profile();
                        include("include/admin_footer.php");

                    ?>
