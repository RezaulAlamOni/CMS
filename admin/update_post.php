<?php
include("include/admin_header.php");

?>
<?php include("include/admin_nav.php");?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="container">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-header">
                        Edite your post :)
                        <small>_______</small>
                    </h1>

                    <?php
                    update_post();//Update category function

                    if (isset($_GET['edite'])) {
                    $edit_post_id = $_GET['edite'];
                    $sql = "SELECT * FROM `posts` WHERE post_id={$edit_post_id}";
                    $result = mysqli_query($con, $sql);
                    //    confirm($result,$con);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_cat = $row['post_cat_id'];
                        $post_img = $row['post_img'];
                        $post_date = $row['post_date'];
                        $post_content = $row['post_content'];
                        $post_tag = $row['post_tag'];
                        $post_status = $row['post_stts'];
                        $post_c_c = $row['post_cmnt_coount'];

                    ?>


                    <form action="" class="text-success" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="post-title">Post Title :</label>
                            <input type="text" class="form-control" name="post_title" value="<?php echo $post_title;?>">
                        </div>
                        <div class="form-group">
                            <label for="post_category">Post category :</label>

                            <select name="post_category" id="">

                                <?php
                                    echo "<option value='{$post_cat}'>{$post_cat}</option>";
                                    category_show_in_post_edite();
                                ?>

                            </select>
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label for="post-title">Post Author :</label>-->
<!--                            <input type="text" class="form-control" name="post_author" value="--><?php //echo $post_author;?><!--">-->
<!--                        </div>-->
                        <div class="form-group">
                            <label for="post">Post Author :</label>
                            <select name="post_author" id="">
                                <option value="<?php echo $post_author;?>"><?php echo $post_author; ?></option>
                                <?php

                                $sql= "SELECT * FROM `users`";
                                $result = mysqli_query($con,$sql);
                                while ($row = mysqli_fetch_assoc($result)){
                                    $author = $row['username'];
                                    echo "<option value='$author'>{$author}</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="post-title">Post Status :</label>
                            <select name="post_status" id="">
<!--                                <option value='--><?php //echo $post_status;?><!--'>--><?php //echo $post_status;?><!--</option>-->
                                <?php

                                if ($post_status == 'Published'){
                                    echo "<option selected value='Published'>Published</option>";
                                    echo "<option value='Drft'>Drft</option>";
                                }else{

                                    echo "<option value='Published'>Published</option>";
                                    echo "<option selected value='Drft'>Drft</option>";
                                }

                                ?>

                            </select>
<!--                            <input type="text" class="form-control" name="post_status" value="--><?php //echo $post_status;?><!--">-->
                        </div>
                        
                        <div class="form-group">
                            <label for="post-title">Post Image</label>
                            <img width="100" src="../img/<?php echo $post_img;?>" alt="">
                            <input type="file" name="img">
                        </div>
                        <div class="form-group">
                            <label for="post-title">Post Tag :</label>
                            <input type="text" class="form-control" name="post_tag" value="<?php echo $post_tag;?>">
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label for="post-title">Post Comment Count :</label>-->
<!--                            <input type="text" class="form-control" name="post_c_c" value="--><?php //echo $post_c_c;?><!--">-->
<!--                        </div>-->
                        <div class="form-group">
                            <label for="post-title">Post Content :</label>
                            <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo str_replace('r/n','<br>',$post_content);?></textarea>
                        </div>

                        <input type="hidden" name="post_id" value="<?php echo $post_id;?>">

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update" value="Update Post">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
        <?php
                }
            }


    include("include/admin_footer.php");
    ?>



    //////////////
