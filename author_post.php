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
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php
            if (isset($_GET['p_author']) && isset($_SESSION['role'])) {
                $this_post_author = $_GET['p_author'];
                $this_post_id = $_GET['p_id'];

                $sql = "SELECT * FROM `posts` WHERE post_author = '{$this_post_author}'";
                $result = mysqli_query($con, $sql);
                //                        = $con->query($sql);


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
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
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

                        <!-- Second Blog Post -->

                        <!-- Pager -->
<!--                        <ul class="pager">-->
<!--                            <li class="previous">-->
<!--                                <a href="#">&larr; Older</a>-->
<!--                            </li>-->
<!--                            <li class="next">-->
<!--                                <a href="#">Newer &rarr; </a>-->
<!--                            </li>-->
<!--                        </ul>-->

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


