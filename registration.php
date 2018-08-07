<?php  include "include/db.php"; ?>
<?php  include "include/cms_header.php"; ?>
<?php  include "include/cms_nav.php"; ?>
<?php  include "cms_function.php"; ?>

<?php
    if (isset($_SESSION['username'])){
        if ($_SESSION['role']=='admin'){
            header("Location:admin");
        }else{
            header("Location:index.php");
        }
    }
?>

<div class="container">
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6" style="padding-top: 40px">
                <div class="form-wrap">
                <h1 class="text-success"><i class="glyphicon glyphicon-import"></i> Registration</h1>
                <?php
                if (isset($_REQUEST['submit'])){
                    $username   =trim($_REQUEST['username']);
                    $email      =trim($_REQUEST['email']);
                    $password   =trim($_REQUEST['password']);
                    $error =[
                      'username'=>'',
                      'email'=>'',
                      'pass'=>''

                    ];

                    if (strlen($username)<5){
                        $error['username'] = "Username needs to be longer";
                    }
                    if ($username == ''){
                        $error['username'] = "Username can not be empty!!";
                    }
                    if ($email == ''){
                        $error['email'] = "Email can not be empty!!";
                    }
                    if (strlen($password)<6){
                        $error['pass']= "Password needs to be longer the 6 character ";
                    }
                    if ($password==''){
                        $error['pass']= "Password can not be empty!! ";
                    }

                    foreach ($error as $key=>$value){
                        if (empty($value)){
                            unset($error[$key]);
                        }
                    }
                    if (empty($error)){
                        user_registration($username,$email,$password);
                    }

               }

                ?>

                    <form role="form" action="registration.php" method="post" id="login-form" style="padding-top: 25px" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username"
                                   value="<?php echo isset($username)? $username :''?>"
                            ><?php echo isset($error['username'])? $error['username'] :''?>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"
                                   value="<?php echo isset($email)?$email:'' ?>"
                            ><?php echo isset($error['email'])? $error['email'] :''?>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                             <?php echo isset($error['pass'])? $error['pass'] :''?>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block btn-primary" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
            <div class="container col-md-5" style="padding-top:60px">
                <div class="well" style="background-color: #faf4bc">
                    <h2 class="text-info" style="padding-left: 40px"><i class="glyphicon glyphicon-log-in "></i>  Log-In</h2>
                    <form action="include/login.php" method="post" style="padding-top: 25px">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Enter Username">
                        </div>

                        <div class="input-group">
                            <input name="password" type="password" class="form-control" placeholder="Enter Password">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit" name="login">Log-in</button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
<?php include "include/cms_footer.php";?>
