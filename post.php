<?php
include("include/db.php");
include("include/cms_header.php");
include("include/cms_nav.php");
?>
    <!-- Page Content -->
    <div class="container">
    <div class="row">
    <!-- Blog Entries Column -->
    <div class="col-md-8">
        <h1 class="page-header">
            Welcome To Post :)
            <small>-----</small>
        </h1>

        <?php
        if (isset($_SESSION['role'])){
        if (isset($_GET['p_id'])) {
            $this_post_id = escape($_GET['p_id']);

            $query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = $this_post_id";
            if (!mysqli_query($con, $query)) {
                confirm(mysqli_query($con, $query), $con);
            }

            $sql = "SELECT * FROM `posts` WHERE post_id = $this_post_id";
            $result = mysqli_query($con, $sql);
            //                        = $con->query($sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $post_title     = $row['post_title'];
                $post_author    = $row['post_author'];
                $cat            = $row['post_cat_id'];
                $post_date      = $row['post_date'];
                $post_img       = $row['post_img'];
//                $post_content = substr($row['post_content'],0,100);
                $post_content   = $row['post_content'];
                ?>
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    Category : <a href="category.php?cat=<?php echo $cat; ?>"><?php echo $cat; ?></a>
                </p>
                <p class="lead">
                    Published By <a
                            href="profile.php?p_author=<?php echo $post_author; ?>&p_id=<?php echo $this_post_id; ?>"><?php echo $post_author; ?></a>
                </p>

                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="">
                <hr>
                <p class="text-success" style="font-size: 16px"><span
                            class="glyphicon glyphicon-arrow-right">  </span><?php echo " " . $post_content; ?></p>
                <!--            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->
                <hr>


                <!-- Second Blog Post -->
                <?php
            }
            if (isset($_SESSION['role'])){
                if (isset($_GET['p_id'])){
                    $pos_id=$_GET['p_id'];
                    $sql = "SELECT * from posts WHERE post_id = {$pos_id}";
                    $row = mysqli_fetch_assoc(mysqli_query($con,$sql));
                    $user=$row['post_author'];
                    if ($user==$_SESSION['username'] && $_SESSION['role'] == 'admin'){
                        echo "<a class='text-right' href='admin/update_post.php?edite={$pos_id}'><button class='btn btn-primary'>Edite Post</button></a>";

                    }
                    if ($user==$_SESSION['username']){
                        echo "<a class='text-right' href='update_user_post.php?edite={$pos_id}'><button class='btn btn-primary'>Edite Post</button></a>";

                    }
                }
            }
        }

        insert_post_comnt();
        ?>
        <!-- Comments Form -->

        <hr>
        <!-- Posted Comments -->
        <!-- Comment -->
        <?php
        $c_p_id = escape($_REQUEST['p_id']);
        $sql = "SELECT * FROM `comments` WHERE comnt_post_id = $c_p_id AND comnt_stts='approved'";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $cmnt_id = $row['comnt_id'];
            $cmnt_author = $row['comnt_author'];
            $cmnt_content = $row['comnt_content'];
            $cmnt_date = $row['comnt_date'];

            ?>
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <!--                    <img class="media-object" src="http://placehold.it/64x64" alt="">-->

                    <?php
                    $sqli = "SELECT * FROM users WHERE username ='{$cmnt_author}'";
                    $rslt = mysqli_query($con, $sqli);
                    confirm($rslt, $con);
                    while ($row = mysqli_fetch_assoc($rslt)) {
                        $user_img = $row['user_img'];
                    }
                    if (!empty($user_img)) {
                        echo "<img  style='height: 64px;width: 75px;' class='media-object img-circle' src='img/{$user_img}' alt=''>";
                    } else {
                        echo '<img class="media-object" src="http://placehold.it/64x64" alt="">';
                    }
                    ?>

                </a>
                <div class="media-body">
                    <h3 class="media-heading text-success" style="padding-left: 10px;padding-top: 10px"><?php echo $cmnt_author; ?>
                        <small class="" style="padding-left: 10px">On :<?php echo $cmnt_date; ?></small>
                    </h3>
                    <p class="" style="padding-left: 15px"><?php echo $cmnt_content; ?></p>
                </div>
            </div>

        <?php } ?>
        <!--                <!-- Nested Comment -->
        <!--                <div class="media">-->
        <!--                    <a class="pull-left" href="#">-->
        <!--                        <img class="media-object" src="http://placehold.it/64x64" alt="">-->
        <!--                    </a>-->
        <!--                    <div class="media-body">-->
        <!--                        <h4 class="media-heading">Nested Start Bootstrap-->
        <!--                            <small>August 25, 2014 at 9:30 PM</small>-->
        <!--                        </h4>-->
        <!--                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <!-- End Nested Comment -->
        <!--            </div>-->
        <!--        </div>-->
        <br> <br>
        <div class="well in" style="background-color: #cf7f94">
            <h4>Leave a Comment:</h4>
            <form role="form" action="" method="post" class="">
                <div class="form-group">
                    <label for="author">User Name :<b
                                class="text-info"><?php echo $_SESSION['username']; ?> </b></label>
                    <input type="hidden" name="author" class="form-control"
                           value="<?php echo $_SESSION['username']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email : <b class="text-info"> <?php echo $_SESSION['email']; ?></b></label>
                    <input type="hidden" name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>">
                </div>

                <div class="form-group">
                    <label for="content">Write Your Comment :</label>
                    <textarea class="form-control" rows="5" name="content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="comment">Submit</button>
            </form>
        </div>
    </div>
    <?php
    }else{
            header("Location:index.php");
    }
 ?>

    <!-- Blog Sidebar Widgets Column -->
    <?php include("include/cms_sidebar.php"); ?>
    <!-- /.row -->
    <hr>
  <!-- Footer -->
<?php include("include/cms_footer.php"); ?>