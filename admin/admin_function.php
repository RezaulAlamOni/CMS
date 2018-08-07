<?php
//Show all category
function escape($string){
    global $con;
    return mysqli_real_escape_string($con,trim(strip_tags($string)));

}


function all_Categry_find(){
    global $con;
    $sql= "SELECT * FROM `categories`";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_assoc($result)){
        $cat_id = $row['id'];
        $cat_title = $row['cat_title'];
        echo "<tr></tr><td>{$cat_id}</td></li>";
        echo "<td>{$cat_title}</td></li>";
        echo "<td><a class='btn btn-danger' onclick='javascript: return confirm(\"Are you ure you want to delete the Category !!\");' href='categories.php?delete={$cat_id}' style='color: darkred;'>Delete</a>";
        echo "<a class='btn btn-info' href='categories.php?edite={$cat_id}'>Edite</a></td>";
        echo  "</tr>";
    }
}

//insert category
function insert_categories(){
    global $con;
    if (isset($_REQUEST['submit'])){
        $cat_title = $_REQUEST['cat_title'];

        if ($cat_title=="" || empty($cat_title)){
            echo "Hello this field can not be empty !!!";
        }else{
            $sql = "INSERT INTO categories (`cat_title`) ";
            $sql .= "VALUES ('$cat_title') ";
            $cat_title_insert = mysqli_query($con,$sql);

            if (!$cat_title_insert){
                die('Query Faild' . mysqli_error($con));
            }
        }
    }
}

//Delete actegory
function delete_categories(){
    global  $con;
    if (isset($_GET['delete'])){
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin') {
                $delete = $_GET['delete'];
                $sql = "DELETE FROM `categories` WHERE id = {$delete}";
                $rslt = mysqli_query($con, $sql);
                confirm($rslt, $con);
                header("Location:categories.php");
            }
        }
    }
}

//Show all post
function all_posts(){
    global $con;
    $sql= "SELECT * FROM `posts` ORDER BY post_id DESC ";
    $result = mysqli_query($con,$sql);
    confirm($result,$con);

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
        $post_view = $row['post_view_count'];


        echo "<tr>";
        echo "<td><input class='checkbox' type=\"checkbox\" name='checkboxArray[]' value='{$post_id}'> </td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_id}</a></td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
        echo "<td><a href=\"../category.php?cat='{$post_cat}'\">{$post_cat}</a></td>";
        echo "<td><a href='user_posts.php?p_author={$post_author}'>{$post_author}</a></td>";
        echo "<td><a href='../post.php?p_id={$post_id}'><img class='img-responsive img-circle'width='150' height='100' src='../img/$post_img' alt='Image'></a></td>";
        echo "<td>{$post_tag}</td>";
        echo "<td>{$post_content}</td>";
        echo "<td>{$post_status}</td>";

                            comments($post_id);

        echo "<td>{$post_date}</td>";
        echo "<td><a href='update_post.php?edite={$post_id}' class='btn btn-success'>Edite</a></td>";

//        echo "<td><a class= 'btn btn-danger' rel='{$post_id}' href='javascript:void(0)' class='delete_link'>Delete</a> </td>";

        echo "<td><a class='btn btn-danger' onclick='javascript: return confirm(\"Are you ure you want to delete the post !!\"); ' href='posts.php?delet={$post_id}'>Delete</a> </td>";

        echo "<td><a href='posts.php?reset={$post_id}'>{$post_view}</a></td>";
        echo "</tr>";
//        delete_post();

    }
}
function all_user_posts(){
    global $con;
    if (isset($_REQUEST['p_author'])){
        $p_author = $_REQUEST['p_author'];

    $sql= "SELECT * FROM `posts` WHERE post_author = '{$p_author}' ORDER BY post_id DESC ";
    $result = mysqli_query($con,$sql);
    confirm($result,$con);

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
        $post_view = $row['post_view_count'];

        echo "<tr>";
        echo "<td><input class='checkbox' type=\"checkbox\" name='checkboxArray[]' value='{$post_id}'> </td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_id}</a></td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
        echo "<td><a href=\"../category.php?cat='{$post_cat}'\">{$post_cat}</a></td>";
        echo "<td>{$post_author}</td>";
        echo "<td><a href='../post.php?p_id={$post_id}'><img class='img-responsive img-circle'width='150' height='100' src='../img/$post_img' alt='Image'></a></td>";
        echo "<td>{$post_tag}</td>";
        echo "<td>{$post_content}</td>";
        echo "<td>{$post_status}</td>";

                            comments($post_id);

        echo "<td>{$post_date}</td>";
        echo "<td><a onclick='javascript: return confirm(\"Are you ure you want to delete the post !!\"); ' href='user_posts.php?delete={$post_id}'>Delete</a> || ";
        echo "<a href='update_post.php?edite={$post_id}'>Edite</a></td>";
        echo "<td><a href='posts.php?reset={$post_id}'>{$post_view}</a></td>";
        echo "</tr>";
        }

    }
}

    function comments($post_id){
        global $con;
        $sq = "SELECT COUNT(comnt_stts) AS t_count FROM `comments` WHERE comnt_post_id = $post_id";
        $result = mysqli_query($con,$sq);
        $r = mysqli_fetch_assoc($result);
        $comnt_count = $r['t_count'];
        echo "<td><a href='post_comments.php?p_id={$post_id}'>{$comnt_count}</a></td>";
        $sql = "UPDATE `posts` SET `post_cmnt_coount`=$comnt_count WHERE post_id=$post_id";
        mysqli_query($con,$sql);
    }

function update_category(){
    global $con;
    if (isset($_REQUEST['update'])){
        $cat_title = $_REQUEST['cat_title'];
        $id = $_REQUEST['id'];

        if ($cat_title == "  " || empty($cat_title)){
            echo "Hello this field can not be empty !!!";
        }else{
            $sql="UPDATE `categories` SET `cat_title`='".$cat_title."' WHERE id=$id";

            $update = mysqli_query($con,$sql);
            header('Location:categories.php');
            confirm($update,$con);
        }

    }
}
//Add post
function add_post(){
    global $con;
    if (isset($_POST['submit'])){

        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_cat_id = $_POST['post_category'];

        $post_img =$_FILES['post_img']['name'];
        $post_img_temp =$_FILES['post_img']['tmp_name'];

        $post_date = date("d-m-y");
        $post_content =$_POST['post_content'];
        $post_tag = $_POST['post_tag'];
//        $post_status = $_POST['post_stts'];


        move_uploaded_file($post_img_temp,"../img/{$post_img}");

        if(move_uploaded_file($post_img_temp,"../img/$post_img")){
            echo "yes file uploded ";
        }


        $sql = "INSERT INTO `posts`(`post_cat_id`, `post_title`, `post_author`, `post_date`, `post_img`, `post_content`, `post_tag`, `post_cmnt_coount`, `post_stts`)";
        $sql .= "VALUES ('{$post_cat_id}','{$post_title}','{$post_author}',now(),'{$post_img}','{$post_content}','{$post_tag}',0,'Drft' ) ";

        $add_post_query = mysqli_query($con,$sql);
        confirm($add_post_query,$con);

        $post_id = mysqli_insert_id($con);

        echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>Edit Post</a></p>";
//        header('Location:posts.php');


    }
}
    function confirm($result,$con){
        if (!$result){
            die("Query Failed .". mysqli_error($con));
        }
    }

    function delete_post(){
        global $con;
        if (isset($_REQUEST['delet'])) {
            if (isset($_SESSION['role'])){
                if ($_SESSION['role']=='admin') {
                    $post_id = $_REQUEST['delet'];
                    $post_id = mysqli_real_escape_string($con, $post_id);
                    $sql = "DELETE FROM `posts` WHERE post_id = {$post_id}";
                    $rslt = mysqli_query($con, $sql);
                    confirm($rslt, $con);

                    header("Location:posts.php");
                }

            }
        }
    }
    function delete_user_post(){
        global $con;
        if (isset($_REQUEST['delete'])) {
            $post_id = $_REQUEST['delete'];
            if (isset($_SESSION['role'])){

                if ($_SESSION['role']=='admin') {

                    $sq = "SELECT * FROM `posts` WHERE post_id ={$post_id}";
                    $row = mysqli_fetch_assoc(mysqli_query($con, $sq));
                    $post_author = $row['post_author'];


                    $sql = "DELETE FROM `posts` WHERE post_id ={$post_id}";
                    mysqli_query($con, $sql);
                    header("Location:user_posts.php?p_author={$post_author}");
                }
            }
        }
    }
    function update_post()
    {
        global $con;
        if (isset($_POST['update'])) {
            $post_id = $_POST['post_id'];
            $post_title = $_POST['post_title'];
            $post_author = $_POST['post_author'];
            $post_cat_id = $_POST['post_category'];

            $post_img = $_FILES['img']['name'];
            $post_img_temp = $_FILES['img']['tmp_name'];

            $post_content = $_POST['post_content'];
            $post_tag = $_POST['post_tag'];
            $post_status = $_POST['post_status'];
//            $post_c_c = $_POST['post_c_c'];

            move_uploaded_file($post_img_temp,"../img/$post_img");

//            if(move_uploaded_file($post_img_temp,"../img/$post_img")){
//                echo "yes file uploded ";
//            }else echo "file not uploded";

            if (empty($post_img)) {
                $edit_post_id = $_GET['edite'];

                $sql = "SELECT * FROM `posts` WHERE post_id={$edit_post_id}";
                $result = mysqli_query($con, $sql);
                //    confirm($result,$con);

                while ($row = mysqli_fetch_assoc($result)) {
                    $post_img = $row['post_img'];
                }

            }

            $sql = "UPDATE `posts` SET `post_id`='" . $post_id . "',`post_cat_id`='" . $post_cat_id . "',`post_title`='" . $post_title . "',`post_img`='{$post_img}',`post_author`='" . $post_author . "',`post_date`= now() ,`post_content`='{$post_content}',`post_tag`='{$post_tag}',`post_stts`='{$post_status}' WHERE post_id = $post_id";

            $add_post_query = mysqli_query($con, $sql);
            confirm($add_post_query, $con);

            echo "<p class='bg-success'>Post Updated . <a class='btn' href='../post.php?p_id={$post_id}'>View Post</a>Or<a class='btn' href='posts.php'>Edit More Post</a></p>";
//            if ($_SESSION['role']=='admin') {
//                header('Location:posts.php');
//            }else{
//                header('Location:../posts.php?p_id={$post_id}');
//            }

        }


    }

    function category_show_in_post_edite()
    {
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

    function all_cmnt()
    {
        global $con;
        $sql = "SELECT * FROM `comments` ORDER BY comnt_id DESC";
        $result = mysqli_query($con, $sql);
        confirm($result, $con);

        while ($row = mysqli_fetch_assoc($result)) {
            $cmnt_id = $row['comnt_id'];
            $cmnt_post_id = $row['comnt_post_id'];
            $cmnt_author = $row['comnt_author'];
            $cmnt_content = $row['comnt_content'];
            $cmnt_status = $row['comnt_stts'];
            $cmnt_date = $row['comnt_date'];
            $cmnt_email = $row['comnt_email'];

            echo "<tr>";
            echo "<td><input class='checkbox' type=\"checkbox\" name='checkboxArray[]' value='{$cmnt_id}'> </td>";
            echo "<td>{$cmnt_id}</td>";
//            echo "<td>{$cmnt_post_id}</td>";
            echo "<td>{$cmnt_author}</td>";
            echo "<td>{$cmnt_email}</td>";
            $sqli = "SELECT * FROM `posts` WHERE post_id={$cmnt_post_id}";
            $resulti = mysqli_query($con, $sqli);
            //    confirm($result,$con);

            while ($rowe = mysqli_fetch_assoc($resulti)) {
                $post_idd = $rowe['post_id'];
                $post_titlee = $rowe['post_title'];
                echo "<td><a href='../post.php?p_id={$post_idd}'>$post_titlee</a></td>";
            }

            echo "<td>{$cmnt_date}</td>";
            echo "<td>{$cmnt_content}</td>";
            echo "<td>{$cmnt_status}</td>";

            echo "<td><a href='comments.php?approve={$cmnt_id}' class='btn-primary btn'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove={$cmnt_id}' class='btn btn-success'>Unapprove</a></td>";
            echo "<td><a onclick='javascript: return confirm(\"Are you ure you want to delete the Comment !!\"); ' href='comments.php?delete={$cmnt_id}' class='btn btn-danger'>Delete</a>";
            echo "</tr>";
        }
    }
function all_post_cmnt()
    {
        global $con;
        $post_id = $_REQUEST['p_id'];
        $post_id = mysqli_real_escape_string($con,$post_id);
        $sql = "SELECT * FROM `comments` WHERE comnt_post_id={$post_id} ORDER BY comnt_id DESC";
        $result = mysqli_query($con, $sql);
        confirm($result, $con);
        while ($row = mysqli_fetch_assoc($result)) {
            $cmnt_id = $row['comnt_id'];
            $cmnt_post_id = $row['comnt_post_id'];
            $cmnt_author = $row['comnt_author'];
            $cmnt_content = $row['comnt_content'];
            $cmnt_status = $row['comnt_stts'];
            $cmnt_date = $row['comnt_date'];
            $cmnt_email = $row['comnt_email'];
            echo "<tr>";
            echo "<td>{$cmnt_id}</td>";
//            echo "<td>{$cmnt_post_id}</td>";
            echo "<td>{$cmnt_author}</td>";
            echo "<td>{$cmnt_email}</td>";

            $sqli = "SELECT * FROM `posts` WHERE post_id={$cmnt_post_id}";
            $resulti = mysqli_query($con, $sqli);
            //    confirm($result,$con);
            while ($rowe = mysqli_fetch_assoc($resulti)) {
                $post_idd = $rowe['post_id'];
                $post_titlee = $rowe['post_title'];
                echo "<td><a href='../post.php?p_id={$post_idd}'>$post_titlee</a></td>";
            }
            echo "<td>{$cmnt_date}</td>";
            echo "<td>{$cmnt_content}</td>";

            echo "<td>{$cmnt_status}</td>";
            echo "<td><a class='btn btn-primary' href='post_comments.php?approve={$cmnt_id}&p_id={$post_id}'>Approve</a></td>";
            echo "<td><a class='btn btn-success' href='post_comments.php?unapprove={$cmnt_id}&p_id={$post_id}'>Unapprove</a></td>";
            echo "<td><a class='btn btn-danger' onclick='javascript: return confirm(\"Are you ure you want to delete the Comment !!\"); ' href='post_comments.php?delete={$cmnt_id}&p_id={$post_id}'>Delete</a>";
            echo "</tr>";
        }
    }

    function delete_comment(){
        global $con;
        if (isset($_REQUEST['delete'])) {
            if (isset($_SESSION['role'])){
                if ($_SESSION['role']=='admin') {
                    $cmnt_id = $_REQUEST['delete'];
                    $sql = "DELETE FROM `comments` WHERE comnt_id = {$cmnt_id}";
                    $rslt = mysqli_query($con, $sql);
                    confirm($rslt, $con);

                    header("Location:comments.php");
                }
            }
        }
    }
    function delete_post_comment(){
        global $con;
        if (isset($_REQUEST['delete'])) {
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'admin') {
                    $cmnt_id = $_REQUEST['delete'];
                    $sql = "DELETE FROM `comments` WHERE comnt_id = {$cmnt_id}";
                    $rslt = mysqli_query($con, $sql);
                    confirm($rslt, $con);

                    header("Location:post_comments.php?p_id={$_REQUEST['p_id']}");
                }
            }

        }
    }
function approve_comment(){
        global $con;
        if (isset($_REQUEST['approve'])) {
            $cmnt_id = $_REQUEST['approve'];
            $sql="UPDATE `comments` SET `comnt_stts`='approved' WHERE comnt_id=$cmnt_id";
            $rslt = mysqli_query($con, $sql);


//            $sqli = "SELECT `comnt_post_id` FROM `comments` WHERE comnt_id=$cmnt_id";
//            $rslt = mysqli_query($con, $sqli);
//            $row = mysqli_fetch_assoc($rslt,$con);
//            $cmnt_post_id = $row['comnt_post_id'];
//
//            $sql = "UPDATE `posts` SET comnt_cmnt_count = comnt_cmnt_count+1 WHERE post_id=$cmnt_post_id";
//            mysqli_query($con, $sql);
            confirm($rslt, $con);
            header("Location:comments.php");


        }
    }
    function approve_post_comment(){
        global $con;
        if (isset($_REQUEST['approve'])) {
            $cmnt_id = $_REQUEST['approve'];
            $sql="UPDATE `comments` SET `comnt_stts`='approved' WHERE comnt_id=$cmnt_id";
            $rslt = mysqli_query($con, $sql);
            confirm($rslt, $con);

            header("Location:post_comments.php?p_id={$_REQUEST['p_id']}");


        }
    }
function unapprove_comment()
{
    global $con;
    if (isset($_REQUEST['unapprove'])) {
        $cmnt_id = $_REQUEST['unapprove'];
        $sql = "UPDATE `comments` SET `comnt_stts`='unapproved' WHERE comnt_id=$cmnt_id";
        $rslt = mysqli_query($con, $sql);
        confirm($rslt, $con);
        header("Location:comments.php");



    }
}
function unapprove_post_comment()
{
    global $con;
    if (isset($_REQUEST['unapprove'])) {
        $cmnt_id = $_REQUEST['unapprove'];
        $sql = "UPDATE `comments` SET `comnt_stts`='unapproved' WHERE comnt_id=$cmnt_id";
        $rslt = mysqli_query($con, $sql);
        confirm($rslt, $con);

        header("Location:post_comments.php?p_id={$_REQUEST['p_id']}");
    }
}

function all_users(){
    global $con;
    $sql= "SELECT * FROM `users` ORDER BY user_id DESC ";
    $result = mysqli_query($con,$sql);
    confirm($result,$con);
    while ($row = mysqli_fetch_assoc($result)) {
        $userid = $row['user_id'];
        $username = $row['username'];
        $firstname = $row['user_firstname'];
        $lastname = $row['user_lastname'];
        $user_img = $row['user_img'];
        $usermail = $row['user_email'];
        $role = $row['user_role'];
        $date = $row['user_create_date'];

        echo "<tr>";
        echo "<td><a href=''>{$userid}</a></td>";
        echo "<td><a href='../profile.php?p_author={$username}'><img class='img-responsive img-circle'width='60' height='70' src='../img/$user_img' alt='Image'></a></td>";
        echo "<td><a href='../profile.php?p_author={$username}'>{$username}</a></td>";
        echo "<td>{$firstname}</td>";
        echo "<td>{$lastname}</td>";
        echo "<td>{$usermail}</td>";
        echo "<td>{$role}</td>";
        echo "<td>{$date}</td>";
//        comments($post_id);
        echo "<td><a class='btn btn-danger' onclick='javascript: return confirm(\"Are you ure you want to delete the user !!\"); ' href='users.php?delete={$userid}'>Delete</a></td>";
        echo "<td><a class='btn btn-success' href='update_user.php?update={$userid}'>Edit</a></td>";
        echo "<td><a class='btn btn-primary' href='users.php?admin={$userid}'>Admin</a></td> ";
        echo "<td><a class='btn btn-success' href='users.php?sub={$userid}'>Subscriber</a></td>";
        echo "</tr>";
    }
}
function add_user(){
    global $con;
    if (isset($_POST['submit'])){

        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname  = escape($_POST['user_lastname']);
        $user_role      = escape($_POST['select_role']);
        $user_email     = escape($_POST['email']);
        $username       = escape($_POST['username']);
        $pass           = escape($_POST['pass']);

        if (user_exist($username)){
            echo $msg="<h3 class='text-danger'>Username or email is exist!! please user another username or email!! </h3>";
        }else if (email_exist($user_email)){
            echo $msg="<h3 class='text-danger'>Username or email is exist!! please user another username or email!! </h3>";
        }else {

            $hash_pass = password_hash($pass, PASSWORD_BCRYPT, array('cost' => 12));

            if (!empty($username) && !empty($pass) && !empty($user_email) && strlen($pass)>=6){
                $user_img = $_FILES['user_img']['name'];
                $user_img_temp = $_FILES['user_img']['tmp_name'];

                move_uploaded_file($user_img_temp, "../img/$user_img");

                $sql = "INSERT INTO `users`(`username`, `password`, `user_firstname`, `user_lastname`, `user_email`, `user_img`, `user_role`,`user_create_date`)";
                $sql .= " VALUES ('{$username}','{$hash_pass}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_img}','{$user_role}',now())";
                $add_user_query = mysqli_query($con, $sql);
                confirm($add_user_query, $con);
                header('Location:users.php');

            } else {
                echo "<script>alert('Require Field can Not be empty !!!! or Password Might Be more then 6 Character!!!');</script>";
            }
        }
    }

}
function update_user()
{
    global $con;
    if (isset($_POST['update'])) {

        $user_firstname = $_POST['user_firstname'];
        $user_lastname  = $_POST['user_lastname'];
        $user_role      = $_POST['select_role'];
//        $user_email     = $_POST['email'];
//        $username       = $_POST['username'];

        $user_pic = $_FILES['pic']['name'];
        $user_img_tempp = $_FILES['pic']['tmp_name'];

//        if ($pass === $cpass) {
            move_uploaded_file($user_img_tempp, "../img/$user_pic");


            $edit_user_id = $_GET['update'];
            if (empty($user_pic)) {

                $sql = "SELECT `user_img` FROM `users` WHERE user_id={$edit_user_id}";
                $result = mysqli_query($con, $sql);
                //    confirm($result,$con);

                while ($row = mysqli_fetch_assoc($result)) {
                    $user_pic = $row['user_img'];
                }
            }
            if (isset($_POST['pass'])) {
                $pass = $_POST['pass'];
                if (!empty($pass) && strlen($pass) >= 6) {
                    $hash_pass = password_hash($pass, PASSWORD_BCRYPT, array('cost' => 12));

                    $sql = "UPDATE `users` SET `password`='{$hash_pass}',`user_firstname`='{$user_firstname}',`user_lastname`='{$user_lastname}',`user_img`='{$user_pic}',`user_role`='{$user_role}' WHERE user_id = $edit_user_id ";
                    $add_post_query = mysqli_query($con, $sql);
                    confirm($add_post_query, $con);
                    header('Location:users.php');
                }else{
                    echo "<script>alert('Please Enter password !!! You can add new password .!! Password More Then 6 Character!!');</script>";
                }
            }
            $sql = "UPDATE `users` SET `user_firstname`='{$user_firstname}',`user_lastname`='{$user_lastname}',`user_img`='{$user_pic}',`user_role`='{$user_role}' WHERE user_id = $edit_user_id ";
            $add_post_query = mysqli_query($con, $sql);
            confirm($add_post_query, $con);
            header('Location:users.php');


       }

}
    function remove_user(){
        global $con;
        if (isset($_GET['delete'])) {
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'admin') {
                    $user_id = $_GET['delete'];
                    $sql = "DELETE FROM `users` WHERE user_id = {$user_id}";
                    $rslt = mysqli_query($con, $sql);
                    confirm($rslt, $con);
                    header("Location:users.php");
                }
            }
        }
    }
        function make_admin(){
            global $con;
            if (isset($_GET['admin'])) {
                $user_id = $_GET['admin'];
                $sql = "UPDATE `users` SET user_role = 'admin' WHERE user_id = {$user_id}";
                $rslt = mysqli_query($con, $sql);
                confirm($rslt, $con);
                header("Location:users.php");
            }
        }
        function make_subscriber(){
            global $con;
            if (isset($_GET['sub'])) {
                $user_id = $_GET['sub'];
                $sql = "UPDATE `users` SET user_role = 'subscriber' WHERE user_id = {$user_id}";
                $rslt = mysqli_query($con, $sql);
                confirm($rslt, $con);
                header("Location:users.php");
            }
        }
function update_profile()
{
    global $con;
    if (isset($_POST['update'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['select_role'];
        $user_email = $_POST['email'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $user_pic = $_FILES['pic']['name'];
        $user_img_tempp = $_FILES['pic']['tmp_name'];

        if (!empty($pass) && strlen($pass) >= 6) {

            move_uploaded_file($user_img_tempp, "../img/$user_pic");
            if (empty($user_pic)) {

                $sql = "SELECT `user_img` FROM `users` WHERE user_id='{$username}' ";
                $result = mysqli_query($con, $sql);
                confirm($result, $con);
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_pic = $row['user_img'];
                }
            }
            $sql = "UPDATE `users` SET `username`='{$username}',`password`='{$pass}',`user_firstname`='{$user_firstname}',`user_lastname`='{$user_lastname}',`user_email`='{$user_email}',`user_img`='{$user_pic}',`user_role`='{$user_role}' WHERE username = '{$username}' ";
            $add_post_query = mysqli_query($con, $sql);
            confirm($add_post_query, $con);
            header('Location:profile_update.php');
        }else{
            echo "<script>alert('Password can not be empty !!! Or Password more then 6 Character!!!');</script>";
        }
    }

}
function user_online(){

    if (isset($_REQUEST['onlineusers'])){
        global $con;
        if (!$con){
            session_start();
            include("../include/db.php");

            $session = session_id();
            $time    = time();
            $time_out_in_seconds = 30;
            $time_out    = $time - $time_out_in_seconds;

            $sql = "SELECT * FROM users_online WHERE session = '$session'";
            $rslt = mysqli_query($con,$sql);
            $online_user = mysqli_num_rows($rslt);

            if ($online_user== NULL){
                mysqli_query($con,"INSERT INTO users_online (session,time) values ('$session','$time')");
            }else{
                mysqli_query($con,"UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }
            $onlineUser = mysqli_query($con,"SELECT * FROM users_online WHERE time > '$time_out'");
            echo mysqli_num_rows($onlineUser);

        }

    }
}
function user_onlin(){

        global $con;


            $session = session_id();
            $time    = time();
            $time_out_in_seconds = 30;
            $time_out    = $time - $time_out_in_seconds;

            $sql = "SELECT * FROM users_online WHERE session = '$session'";
            $rslt = mysqli_query($con,$sql);
            $online_user = mysqli_num_rows($rslt);

            if ($online_user== NULL){
                mysqli_query($con,"INSERT INTO users_online (session,time) values ('$session','$time')");
            }else{
                mysqli_query($con,"UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }
            $onlineUser = mysqli_query($con,"SELECT * FROM users_online WHERE time > '$time_out'");
            echo mysqli_num_rows($onlineUser);

}
user_online();

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

?>