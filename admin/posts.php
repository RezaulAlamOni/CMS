<?php include("include/admin_header.php");?>

<div id="wrapper">
    <?php include("include/admin_nav.php");?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Posts
                        <small>Subheading</small>
                    </h1>
                    <?php
                    include("delete_model.php");
                    if (isset($_POST['checkboxArray'])){
                        foreach ($_POST['checkboxArray'] as $checkboxid){
                        $block_option = $_POST['block_option'];

                        switch ($block_option){

                            case 'Published':
                                $sql = "UPDATE `posts` SET `post_stts`='{$block_option}' WHERE `post_id`={$checkboxid}";
                                $updatetopublished = mysqli_query($con,$sql);

                                break;
                            case 'Drft':
                                $sql = "UPDATE `posts` SET `post_stts`='{$block_option}' WHERE `post_id`={$checkboxid}";
                                $updatetodrft = mysqli_query($con,$sql);
                                break;

                            case 'delete':
                                $sql = "DELETE FROM `posts` WHERE `post_id`={$checkboxid}";
                                $delete = mysqli_query($con,$sql);
                                break;
                            case 'clone':

                                $sql= "SELECT * FROM `posts` WHERE `post_id`={$checkboxid}";
                                $result = mysqli_query($con,$sql);
                                confirm($result,$con);

                                while ($row = mysqli_fetch_assoc($result)) {
//                                    $post_id        = $row['post_id'];
                                    $post_title     = $row['post_title'];
                                    $post_author    = $row['post_author'];
                                    $post_cat       = $row['post_cat_id'];
                                    $post_img       = $row['post_img'];
                                    $post_date      = $row['post_date'];
                                    $post_content   = $row['post_content'];
                                    $post_tag       = $row['post_tag'];
                                    $post_status    = $row['post_stts'];


                                    $sql = "INSERT INTO `posts`(`post_cat_id`, `post_title`, `post_author`, `post_date`, `post_img`, `post_content`, `post_tag`, `post_cmnt_coount`, `post_stts`)";
                                    $sql .= "VALUES ('$post_cat','{$post_title}','{$post_author}','{$post_date}','{$post_img}','{$post_content}','{$post_tag}',0,'Drft' ) ";

                                    $clone_post_query = mysqli_query($con,$sql);
                                    confirm($clone_post_query,$con);
                                }

                                break;
                            }
                        }
                    }

                    if (isset($_REQUEST['reset'])) {
                        $post_id = $_REQUEST['reset'];
                        $sql = "UPDATE `posts` SET post_view_count = 0 WHERE post_id = {$post_id}";
                        $rslt = mysqli_query($con, $sql);
                        confirm($rslt, $con);
                        header("Location:posts.php");
                    }
                    ?>

                    <form action="" method="post">
                    <table class="table table-bordered table-hover">

                        <div id="bulkOptionContainer" class="col-xs-4" style="padding: 0px;background-color: darkblue">

                            <select class="form-control" name="block_option" id="">
                                <option class="text-info" value="">Select Option</option>
                                <option value="Drft">Draft</option>
                                <option value="Published">Publish</option>
                                <option value="delete">Delete</option>
                                <option value="clone">Clone</option>

                            </select>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><input class="btn btn-success" type="submit" name="submit" value="Apply"></a>
                            <a class="btn btn-info" href="add_post.php">Add Post</a>
                        </div>
<!--                        <div class="col-xs-4">-->
<!--                            <button class="btn btn-success" style="counter-reset: black;height: 40px;width: 150px;"><h4 class="text-primary"><a href="add_post.php">Add Post</a></h4></button>-->
<!---->
<!--                        </div>-->

                        <thead>
                            <tr class="text-justify text-uppercase" style="background-color: #ff7daa">
                                <th><input class="checkbox" id="selectAllBox" type="checkbox"></th>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Image</th>
                                <th>tags</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Comment Count</th>
                                <th>Date</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Post Views</th>
                            </tr>
                        </thead >
                        <tbody class="text-justify" style="background-color: #bce8f1; text-align: center">

<!--                        //View All post :) -->
             <?php all_posts();?>
             <?php delete_post();?>
<!--             //View All post :) -->



<script>
    $(document).ready(function () {

        $(".delete_link").on('click', function () {
           var id = $(this).attr("rel");
           var delete_url = "posts.php?delete="+ id +"";
            $(".model_delete_link").attr("href", delete_url);
            $("#myModal").modal('show');
        });

    });
</script>
                    </form>
                        </tbody>
                    </table>
                </div>
                    <?php
                    include("include/admin_footer.php");?>
