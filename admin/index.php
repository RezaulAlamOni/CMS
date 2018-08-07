<?php include("include/admin_header.php");?>
<div id="wrapper">
<?php include("include/admin_nav.php");?>

    <?php


    ?>


        <div id="page-wrapper" >

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
                        <h1>
                            <?php
//                            echo user_online();
                            ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                        </ol>


                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file-text fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class='huge'>
                                                <?php

                                                            $sql ="SELECT * FROM `posts`";
                                                            $result = mysqli_query($con,$sql);
                                                            $post_count = mysqli_num_rows($result);
                                                            echo $post_count;


                                                ?>
                                                </div>
                                                <div>Posts</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="posts.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comments fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class='huge'>
                                                    <?php

                                                        $sql ="SELECT * FROM `comments`";
                                                        $result = mysqli_query($con,$sql);
                                                        $comnt_count = mysqli_num_rows($result);
                                                        echo $comnt_count;


                                                    ?>

                                                </div>
                                                <div>Comments</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="comments.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class='huge'>
                                                    <?php

                                                    $sql ="SELECT * FROM `users`";
                                                    $result = mysqli_query($con,$sql);
                                                    $user_count = mysqli_num_rows($result);
                                                    echo $user_count;


                                                    ?>

                                                </div>
                                                <div> Users</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="users.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class='huge'>
                                                    <?php

                                                    $sql ="SELECT * FROM `categories`";
                                                    $result = mysqli_query($con,$sql);
                                                    $cat_count = mysqli_num_rows($result);
                                                    echo $cat_count;
                                                    ?>

                                                </div>
                                                <div>Categories</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="categories.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php

                    $sql ="SELECT * FROM `posts` WHERE post_stts = 'Published'";
                    $result = mysqli_query($con,$sql);
                    $published_post_count = mysqli_num_rows($result);

                    $sqli ="SELECT * FROM `posts` WHERE post_stts = 'Drft'";
                    $resul = mysqli_query($con,$sqli);
                    $drft_post_count = mysqli_num_rows($resul);

                    $sqlii ="SELECT * FROM `comments` WHERE comnt_stts = 'unapproved'";
                    $cmnt_approve_q = mysqli_query($con,$sqlii);
                    $unapprove_comnt_count = mysqli_num_rows($cmnt_approve_q);

                    $sqlii ="SELECT * FROM `comments` WHERE comnt_stts = 'approved'";
                    $cmnt_approve_q = mysqli_query($con,$sqlii);
                    $approve_comnt_count = mysqli_num_rows($cmnt_approve_q);

                    $sql ="SELECT * FROM `users` WHERE user_role = 'admin'";
                    $result = mysqli_query($con,$sql);
                    $admin_count = mysqli_num_rows($result);

                    ?>
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data','Count'],
                                <?php
                                    $title = ['Published Post','Pending Post','Approved Comments','Pending Comments','Admin','Subscriber','category'];
                                    $count = [$published_post_count,$drft_post_count,$approve_comnt_count,$unapprove_comnt_count,$admin_count,($user_count-$admin_count),$cat_count];
                                    for ($i=0;$i<=6;$i++){
                                        echo "['{$title[$i]}'".","."{$count[$i]}],";
                                    }
                                ?>

                            ]);

                            var options = {
                                chart: {
                                    title: 'CMS Performance',
                                    subtitle: 'User,Posts,Comment,Category: 2014-2017',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>

                    <div id="columnchart_material" style="width: 1000px; height: 500px;"></div>
                </div>

<?php
include("include/admin_footer.php");?>
