<?php
    include("include/db.php");
    include("include/cms_header.php");
    include("include/cms_nav.php");
    ?>
    <!-- Page Content -->
<?php
if (isset($_SESSION['username'])){


?>
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header" style="color: #02a66f;">
                Welcome Course Advertisement System<br>
                <small class="text-warning">You can make add for your course.</small>
            </h1>
            <div class="row text-right">
                <a href="add_user_post.php" class="btn btn-primary">Add Your Post what You went</a>
            </div>

            <?php
            $sql = "SELECT * FROM posts WHERE `post_stts` = 'Published' ORDER BY post_id DESC";
            $result = mysqli_query($con, $sql);
            $post_count = mysqli_num_rows($result);
            if ($post_count == 0) {
                echo "<h1 class='text-danger'>There have no posts available !!! </h1>";
            }

            $per_page = 3;

            if (isset($_REQUEST['page'])) {
                $pag = $_REQUEST['page'];
                $page = $pag * $per_page - $per_page;

            } else {
                $page = 1;
                $pag = 1;
            }
            $sql = "SELECT * FROM `posts` WHERE `post_stts` = 'Published' LIMIT $page,$per_page";
            $result = mysqli_query($con, $sql);
            //                        = $con->query($sql);


            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_img = $row['post_img'];
                $post_stts = $row['post_stts'];
                $post_cat = $row['post_cat_id'];
                $post_content = substr($row['post_content'], 0, 100);

                if ($post_stts == 'Published') {

                    ?>

                    <!-- First Blog Post -->
                    <h2>
                        Post Title : <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <h2>
                        Category : <a href="category.php?cat=<?php echo $post_cat; ?>"><?php echo $post_cat; ?></a>
                    </h2>
                    <p class="lead">
                        Posted By : <a
                                href="profile.php?p_author=<?php echo $post_author;?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                        <img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
                                class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                    <!-- Second Blog Post -->

                    <!-- Pager -->


                    <?php
                }
            }
            ?>
            <ul class="pager">
                <li class="previous">
                    <a href='index.php?pag=<?php
                    if (isset($_REQUEST['page'])) {
                        $pag = $_REQUEST['page'];
                        echo $pag = $pag - 1;
                    } else if ($_REQUEST['pag']) {
                        if ($_REQUEST['pag'])
                            $pag = $_REQUEST['pag'];
                        echo $pag = $pag - 1;
                    } else {
                        echo $pag = $page - 1;
                    }


                    ?>'>&larr; Older</a>
                </li>
                <li class="next">
                    <a href='index.php?pag=<?php
                    if (isset($_REQUEST['page'])) {
                        $pag = $_REQUEST['page'];
                        echo $pag = $pag + 1;
                    } else if ($_REQUEST['pag']) {
                        $pag = $_REQUEST['pag'];
                        echo $pag = $pag + 1;
                    } else {
                        echo $pag = $page + 1;
                    }

                    ?>'>Newer &rarr; </a>
                </li>
            </ul>

        </div>


        <!-- Blog Sidebar Widgets Column -->

        <?php include("include/cms_sidebar.php"); ?>
        <!-- /.row -->

        <hr>


        <ul class="pager">

            <?php
            $post_count = ceil($post_count / $per_page);

            for ($i = 1; $i <= $post_count; $i++) {

                if ($i == $pag - 1) {
                    echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                } else {
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                }
            }
            ?>

        </ul>

        <!-- Footer -->
        <?php
        }else{
//            include ("registration.php");
        ?>
<div class="container">
    <h1 class="text-center text-warning ">Welcome Course Advertisement System!!</h1>
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6" style="padding-top: 20px">
                    <div class="form-wrap">
                    <h1 class="text-success"><i class="glyphicon glyphicon-import"></i> Registration</h1>
                    <?php
                    if (isset($_REQUEST['submit'])){
                        $username   =trim($_REQUEST['username']);
                        $email      =trim($_REQUEST['email']);
                        $password   =trim($_REQUEST['password']);
                        $first_name   =trim($_REQUEST['first_name']);
                        $last_name   =trim($_REQUEST['last_name']);
                        $error =[
                          'username'=>'',
                          'email'=>'',
                          'pass'=>'',
                          'f_l_name'=>''

                        ];

                        if (strlen($username)<5){
                            $error['username'] = "Username needs to be longer";
                        }
                        if ($username == ''){
                            $error['username'] = "Username can not be empty!!";
                        }
                        if ($email == ''){
                            $error['email'] = "Email can not be empty!!";
                        }
                        if (strlen($password)<6){
                            $error['pass']= "Password needs to be longer the 6 character ";
                        }
                        if ($password==''){
                            $error['pass']= "Password can not be empty!! ";
                        }
                        if ($first_name=='' || $last_name ==''){
                            $error['f_l_name']= "First name Or Last Name can not be empty!! ";
                        }


                        foreach ($error as $key=>$value){
                            if (empty($value)){
                                unset($error[$key]);
                            }
                        }
                        if (empty($error)){
                            user_registration($first_name,$last_name,$username,$email,$password);
                        }

                   }

                    ?>

            <form role="form" action="index.php" method="post" id="login-form" style="padding-top: 25px" autocomplete="off">
                <div class="form-group">
                    <label for="username" class="sr-only">username</label>
                    <input type="text" name="first_name" id="username" class="form-control" placeholder="Enter First Name"                    >
                </div>
                <div class="form-group">
                    <label for="username" class="sr-only">username</label>
                    <input type="text" name="last_name" id="username" class="form-control" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                    <label for="username" class="sr-only">username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                </div>
                <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"                    >
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                </div>

                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block btn-primary" value="Register">
            </form>

        </div>
    </div> <!-- /.col-xs-12 -->
    <div class="container col-md-5" style="padding-top:40px">
        <div class="well" style="background-color: #faf4bc">
            <h2 class="text-info" style="padding-left: 40px"><i class="glyphicon glyphicon-log-in "></i>  Log-In</h2>
            <form action="include/login.php" method="post" style="padding-top: 25px">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Enter Username">
                </div>

                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
                         <button class="btn btn-success" type="submit" name="login">Log-in</button>
                    </span>

                </div>

            </form>
            <!-- /.input-group -->
        </div>
        <div class="well">
            <h3 class="text-center text-primary">About</h3>
            <p style="font-size: 16px">This is Content Management System Developed by <a href="https://rezauloni93.000webhostapp.com/">Rezaul Alam Oni.</a> He is a Web Developer!!
            YOu can hire him for develop your responsive and secure website.
            </p>
        </div>
    </div>
    </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
                <?php

}


        include("include/cms_footer.php");



        ?>

