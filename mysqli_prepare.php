
<?php
session_start();
include("include/db.php");
if (isset($_REQUEST[''])){
    $post_id = $_REQUEST[''];
}

$post_id = 8;

    if (isset($_SESSION['username'])){

        if ($_SESSION['role']=='admin') {

            $stmt1 = mysqli_prepare($con, "SELECT `post_id`,`post_cat_id`, `post_title`, `post_author`, `post_date`, `post_img`, `post_content`, `post_tag`, `post_cmnt_coount`, `post_view_count`, `post_stts` FROM `posts` WHERE post_id = ?");
        }else{
            $stmt2 = mysqli_prepare($con, "SELECT `post_id`,`post_cat_id`, `post_title`, `post_author`, `post_date`, `post_img`, `post_content`, `post_tag`, `post_cmnt_coount`, `post_view_count`, `post_stts` FROM `posts` WHERE post_id = ? AND post_stts = ?");
            $publis = 'Published';


        }
        if (isset($stmt1)){
            mysqli_stmt_bind_param($stmt1,'i',$post_id);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_bind_result($stmt1,$post_id,$post_cat_id, $post_title,$post_author, $post_date, $post_img, $post_content,$post_tag, $post_cmnt_coount, $post_view_count, $post_stts);
            $stmt = $stmt1;
            if(mysqli_stmt_num_rows($stmt)===0){
                echo "<h1>No category Available!!!</h1>";
            }

            while (mysqli_stmt_fetch($stmt)){

                echo $post_title."<br>";
                echo $post_author."<br>";
                echo $post_cat_id;

            }
        }else{
            mysqli_stmt_bind_param($stmt2,'is',$post_id,$publis);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2,$post_id,$post_cat_id, $post_title,$post_author, $post_date, $post_img, $post_content,$post_tag, $post_cmnt_coount, $post_view_count, $post_stts);
            $stmt = $stmt2;
            if(mysqli_stmt_num_rows($stmt)===0){
                echo "<h1>No category Available!!!</h1>";
            }

            while (mysqli_stmt_fetch($stmt)){

                echo $post_title."<br>";
                echo $post_author."<br>";
                echo $post_cat_id;

            }
        }


//        echo "<br>".mysqli_stmt_num_rows($stmt);
        echo '<br>nice <br>'.$_SESSION['username'];
}else{
        echo "Session is not set !!!";
    }
