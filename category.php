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
                    if (isset($_GET['cat'])){
                        $cat= $_GET['cat'];
                    }

                    $sql = "SELECT * FROM posts WHERE `post_stts` = 'Published' AND post_cat_id = '{$cat}'";
                    $result = mysqli_query($con,$sql);
                    $post_count = mysqli_num_rows($result);
                    if ($post_count==0){
                        echo "<h1 class='text-danger'>There have no posts available !!!!!! </h1>";
                    }
                    $per_page = 3;

                    if (isset($_REQUEST['page'])){
                        $pag= $_REQUEST['page'];
                        $page = $pag*$per_page-$per_page;

                    }
                    else{
                        $page=1;
                        $pag = 1;
                    }



                    $sql= "SELECT * FROM `posts` WHERE `post_stts` = 'Published' AND post_cat_id = '{$cat}' LIMIT $page,$per_page";

                    $result = mysqli_query($con,$sql);
//                    $row = mysqli_fetch_assoc($result);
//

                    while ($row= mysqli_fetch_assoc($result)){
                        $post_id= $row['post_id'];
                        $cat= $row['post_cat_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = substr($row['post_content'],0,100);



                ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    Category : <a href="category.php?cat=<?php echo $cat;?>"><?php echo $cat;?></a>
                </p>
                <p class="lead">
                   Posted By : <a href="profile.php?p_author=<?php echo $post_author;?>&p_id=<?php echo $post_id;?>"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
                <hr>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="img/<?php echo $post_img;?>" alt="">
                        </a>
                <hr>
                <p><?php echo $post_content;?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <!-- Second Blog Post -->

                <!-- Pager -->

                    <?php } ?>
<!--                <ul class="pager">-->
<!--                    <li class="previous">-->
<!--                        <a href="#">&larr; Older</a>-->
<!--                    </li>-->
<!--                    <li class="next">-->
<!--                        <a href="#">Newer &rarr; </a>-->
<!--                    </li>-->
<!--                </ul>-->

            </div>


            <!-- Blog Sidebar Widgets Column -->
    <?php include("include/cms_sidebar.php"); ?>
        <!-- /.row -->

        <hr>
    <ul class="pager">

        <?php
        $post_count = ceil($post_count/$per_page);

        for ($i=1;$i<=$post_count;$i++){

            if ($i== $pag){
                echo "<li><a class='active_link' href=\"category.php?page={$i}&cat={$cat}\">{$i}</a></li>";
            }else{
                echo "<li><a href=\"category.php?page={$i}&cat={$cat}\">{$i}</a></li>";
            }


        }
        ?>

    </ul>

        <!-- Footer -->
        <?php include("include/cms_footer.php"); ?>