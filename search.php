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
        <?php
        if (isset($_POST['submit'])){
            $search =  $_POST['search'];
            $sql = "SELECT * FROM posts WHERE post_tag LIKE '%$search%'";

            $result = mysqli_query($con,$sql);
            if (!$result){
                die("Search Faild : ".mysqli_error($con));
            }
            $count = mysqli_num_rows($result);
            if ($count==0){
                echo "<h1>No Data Found </h1>";
            }else{
//                  $sql= "SELECT * FROM `posts`";
//                  $result = mysqli_query($con,$sql);
        //                        = $con->query($sql);

        while ($row = mysqli_fetch_assoc($result)){
            $post_id= $row['post_id'];
            $post_title = $row['post_title'];
            $post_cat = $row['post_cat_id'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];
            $post_img = $row['post_img'];

            ?>

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                Category :<a href="category.php?cat='<?php echo $post_cat?>'"><?php echo $post_cat;?></a>
            </p>
            <p class="lead">
                Published by : <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_author;?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="img/<?php echo $post_img;?>" alt=""></a>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

           <!-- Second Blog Post -->
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr; </a>
                </li>
            </ul>

        <?php
                }
            }
        }
        ?>

    </div>
   <!-- Blog Sidebar Widgets Column -->
    <?php include("include/cms_sidebar.php"); ?>
    <!-- /.row -->
    <hr>
   <!-- Footer -->
<?php include("include/cms_footer.php"); ?>