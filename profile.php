<?php
include("include/db.php");
include("include/cms_header.php");
include("include/cms_nav.php");

?>
<!-- Page Content -->
<?php
if (isset($_REQUEST['p_author']) && isset($_SESSION['role'])) {
    $username= $_REQUEST['p_author'];


    $sql = "SELECT * FROM `users` WHERE username = '{$username}'";
    $resut = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($resut);
    $user_name  =$row['username'];
    $firstname  =$row['user_firstname'];
    $lastname   =$row['user_lastname'];
    $mail       =$row['user_email'];
    $role       =$row['user_role'];
    $pic        =$row['user_img'];
    $date        =$row['user_create_date'];
    $id         =escape($row['user_id']);

    ?>
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8" style="background-color:#bcfff8">
            <div class="row" style="background-color:#ff8ef1">
                <div class="row col-xs-4" >
                    <img style="padding-left: 20px;padding-top: 25px" class='img-responsive img-circle' src='img/<?php echo $pic;?>' alt=''>
                </div>
                <div class="divider col-xs-1" style="background-color:#0002ff"></div>
                <div class="container col-xs-7" style="background-color:#9dff8d">
                    <h1 class="">Name : <span class="text-success"><?php echo $firstname."  ".$lastname;?></span></h1>
                    <h2 class=""> User Name : <span class=""><?php echo $user_name;?></span></h2>
                    <h3 class=""> Email : <span class=""><?php echo $mail;?></span></h3>
                    <h3 class=""> Join On : <span class="text-primary"><?php echo $date;?></span></h3>
                    <?php
                    if ($username == $_SESSION['username']){
                    ?>
                   <div class="row text-right">
                       <a class="btn btn-primary" href="user_profile_update.php">Edit Profile</a>
                   </div>
                        <?php }?>
                </div>
            </div>
            <div class="row">
                <h1 class="text-center">Published Posts </h1>
            </div>
            <?php
            if ($username == $_SESSION['username']){
                ?>
            <div class="row">
                <table class="table table-bordered">
                     <th class="text-center"><a href="add_user_post.php" class="btn btn-success">Add Your Idea</a></th>
                </table>
            </div>
            <?php }



                $sql = "SELECT * FROM `posts` WHERE post_author = '{$username}' ORDER BY post_id DESC";
                $result = mysqli_query($con, $sql);
                //                        = $con->query($sql);
                if (mysqli_num_rows($result)===0){
                    echo "<h1 class='text-danger text-center'> No post Found</h1>";
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_img = $row['post_img'];
                    $post_stts = $row['post_stts'];
                    $cat       = $row['post_cat_id'];
                    $post_content = substr($row['post_content'], 0, 100);

                    if ($post_stts == 'Published' || $_SESSION['role']=='admin' ) {

                        ?>


                        <!-- First Blog Post -->
                        <h2>
                            Post Title :<a href="post.php?p_id=<?php echo $post_id; ?>"> <?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            Category : <a class="" style="font-family: Rockwell; color: #a90083" href="category.php?cat=<?php echo $cat; ?>"><?php echo $cat; ?></a>

                        </p>
                        <p class="lead">
                            All Posts By: <b style="color: darkblue; font-family:'Rage Italic';"><?php echo $post_author; ?></b>
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
                        <?php
                    }
                }
            }else{
                header("Location:index.php");
            }
            ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include("include/cms_sidebar.php"); ?>
        <!-- /.row -->
        <hr>
        <!-- Footer -->
        <?php include("include/cms_footer.php"); ?>


