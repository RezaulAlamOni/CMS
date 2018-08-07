<?php  include "include/db.php"; ?>
<?php  include "include/cms_header.php"; ?>
    <!-- Navigation -->
<?php  include "include/cms_nav.php"; ?>
<?php

    if (isset($_REQUEST['submit'])){

        $to         ='rezaul.oni@gmail.com';
        $sub        =wordwrap($_REQUEST['submit'], 80);
        $body       =$_REQUEST['body'];
        $header     ="From: ".$_REQUEST['email'];

        mail($to,$sub,$body,$header);

    }
?>

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-primary"><i class="fa fa-mail-reply-all"></i>  Contact With Us</h1>
                    <form class="" role="form" action="contact.php" method="post" id="login-form" autocomplete="on">

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your email">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject">
                        </div>
                         <div class="form-group">
                             <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/cms_footer.php";?>
