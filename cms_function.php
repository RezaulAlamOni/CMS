<?php

function confirm($result,$con){
    if (!$result){
        die("Query Failed .". mysqli_error($con));

    }
}
function user_exist($username){
    global $con;
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $rslt = mysqli_query($con,$sql);
    confirm($rslt,$con);

    if (mysqli_num_rows($rslt)>0){
        return true;
    }else{
        return false;
    }
}
function email_exist($email){
    global $con;
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $rslt = mysqli_query($con,$sql);
    confirm($rslt,$con);

    if (mysqli_num_rows($rslt)>0){
        return true;
    }else{
        return false;
    }
}

function category_show_in_post_edite(){
    global $con;
//    global $post_cat;
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
//        $cat_id = $row['id'];
        $cat_title = $row['cat_title'];
        echo "<option name='' value='{$cat_title}'>{$cat_title}</option>";
    }
    confirm($result, $con);
}

function insert_post_comnt(){
    global $con;
    if (isset($_REQUEST['comment'])) {
        $post_id = $_GET['p_id'];
        $author = $_REQUEST['author'];
        $comnt_email = $_REQUEST['email'];
        $comnt_content = $_REQUEST['content'];
        if (!empty($author) && !empty($author) && !empty($comnt_content)){
            $sqli = "INSERT INTO `comments`(comnt_post_id, `comnt_author`, `comnt_email`, `comnt_content`, `comnt_stts`, `comnt_date`)";
            $sqli .= "VALUES ($post_id,'{$author}','{$comnt_email}','{$comnt_content}','Unapproved',now() )";

            $result = mysqli_query($con, $sqli);
            confirm($result,$con);
        }else{
            echo "<script> alert('The Require feild can Not Empty !!!');</script>";
        }



    }
}
function user_registration($f,$l,$username,$email,$password){
    global $con;

        if (user_exist($username)){
            echo $msg="<h3 class='text-danger'>Username or email is exist!! please user another username or email!! </h3>";
        }else if (email_exist($email)){
            echo $msg="<h3 class='text-danger'>Username or email is exist!! please user another username or email!! </h3>";
        }else{

                $first_name   = mysqli_real_escape_string($con,$f);
                $last_name   = mysqli_real_escape_string($con,$l);
                $username   = mysqli_real_escape_string($con,$username);
                $email      = mysqli_real_escape_string($con,$email);
                $password   = mysqli_real_escape_string($con,$password);

                $password = password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));


                $sql = "INSERT INTO users(user_firstname,user_lastname,username,user_email,password,user_role,user_create_date) ";
                $sql .="VALUES('{$first_name}','{$last_name}','{$username}','{$email}','{$password}','subscriber',now())";

                $insert_user = mysqli_query($con,$sql);
                echo $msg="Registration Complete !!! ";
    }
}
function escape($string){
    global $con;
    return mysqli_real_escape_string($con,trim(strip_tags($string)));

}
function update_user_profile(){
    global $con;
    if (isset($_SESSION['role'])) {
        if (isset($_REQUEST['update'])) {
            $first_name = escape($_REQUEST['user_firstname']);
            $last_name  = escape($_REQUEST['user_lastname']);
//            $email      = $_REQUEST['email'];
            $pass       = escape($_REQUEST['pass']);
            $id         = escape($_REQUEST['id']);

            if (!empty($pass) && strlen($pass)>= 6) {
                $hash_pass = password_hash($pass, PASSWORD_BCRYPT, array('cost' => 12));

                $user_pic = $_FILES['pic']['name'];
                $user_img_tempp = $_FILES['pic']['tmp_name'];

                move_uploaded_file($user_img_tempp, "img/$user_pic");

                if (empty($user_pic)) {

                    $sql = "SELECT `user_img` FROM `users` WHERE user_id={$id}";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_pic = $row['user_img'];
                    }
                }
                $sql = "UPDATE `users` SET `password`='{$hash_pass}',`user_firstname`='{$first_name}',`user_lastname`='{$last_name}',`user_img`='{$user_pic}' WHERE user_id = $id ";
                $add_post_query = mysqli_query($con, $sql);
                confirm($add_post_query, $con);
                header('Location:user_profile_update.php');
            } else {
                echo "<script>alert('please Enter password !!! You can add new password .!! Please try again!! your password might be longer then 6 Character!!! ');</script>";
            }
        }
    }
}
function add_post(){
    global $con;
    if (isset($_POST['submit'])){

        $post_title     = $_POST['post_title'];
        $post_cat       = $_POST['post_category'];
        $post_author    = $_SESSION['username'];
        $post_img       =$_FILES['post_img']['name'];
        $post_img_temp  =$_FILES['post_img']['tmp_name'];

        $post_content   =$_POST['post_content'];
        $post_tag       = $_POST['post_tag'];

        if (!empty($post_title) && !empty($post_cat) && !empty($post_content) && !empty($post_tag)) {

            move_uploaded_file($post_img_temp, "img/{$post_img}");

            $sql = "INSERT INTO `posts`(`post_cat_id`, `post_title`, `post_author`, `post_date`, `post_img`, `post_content`, `post_tag`, `post_cmnt_coount`, `post_stts`)";
            $sql .= "VALUES ('{$post_cat}','{$post_title}','{$post_author}',now(),'{$post_img}','{$post_content}','{$post_tag}',0,'Drft' ) ";

            $add_post_query = mysqli_query($con, $sql);
            confirm($add_post_query, $con);

            $post_id = mysqli_insert_id($con);

//            echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>Edit Post</a></p>";
        header('Location:index.php');

        }
    }
}
function update_post(){
    global $con;
    if (isset($_POST['update'])) {
        $post_id        = $_POST['post_id'];
        $post_title     = $_POST['post_title'];
        $post_author    = $_POST['post_author'];
        $post_cat_id    = $_POST['post_category'];

        $post_img       = $_FILES['img']['name'];
        $post_img_temp  = $_FILES['img']['tmp_name'];

        $post_content   = $_POST['post_content'];
        $post_tag       = $_POST['post_tag'];
//        $post_status = $_POST['post_status'];

        move_uploaded_file($post_img_temp,"img/$post_img");

        if (empty($post_img)) {
            $edit_post_id = $_GET['edite'];
            $sql = "SELECT * FROM `posts` WHERE post_id={$edit_post_id}";
            $result = mysqli_query($con, $sql);
            //    confirm($result,$con);
            while ($row = mysqli_fetch_assoc($result)) {
                $post_img = $row['post_img'];
            }
        }
        $sql = "UPDATE `posts` SET `post_id`='" . $post_id . "',`post_cat_id`='" . $post_cat_id . "',`post_title`='" . $post_title . "',`post_img`='{$post_img}',`post_date`= now() ,`post_content`='{$post_content}',`post_tag`='{$post_tag}' WHERE post_id = $post_id";
        $add_post_query = mysqli_query($con, $sql);
        confirm($add_post_query, $con);
        echo "<p class='bg-success'>Post Updated . <a class='btn' href='post.php?p_id={$post_id}'>View Post</a>Or<a class='btn' href='profile.php?p_author={$post_author}'>Edit More Post</a></p>";
    }
}
