
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" style="font-size: 18px">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand " style="color: #e1ff67;" href="index.php"><i class="fa fa-fw fa-user-md text-success"></i><?php echo $_SESSION['username'];?> <span style="color: #ffffff">ADMIN HOME</span></a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav" style="font-size: 18px">
<!--        <li> <a class="navbar-brand btn btn-info" style="color:black" href="">User Online:--><?php //echo user_online();?><!--</a></li>-->
<!--        <li><a class="btn btn-info" style="color:black" href="">User Online : <span class="useronline"></span></a></li>-->
        <li><a  class="" href="">User Online : <span class="useronline"><?php user_onlin(); ?></span></a></li>
        <li style="padding-top:14px;padding-right: 10px"><div id="txt" style="color: #55ff00;"></div></li></li>

        <li> <a class=" navbar-brand btn btn-success" style="color:black" href="../index.php">Home</a></li>


        <li class="dropdown">
            <a href="#" class="dropdown-toggle" style="color: #deb400" data-toggle="dropdown"><i class="fa fa-fw fa-user text-warning"></i><?php echo $_SESSION['username'];?><b class="caret"></b></a>
            <ul class="dropdown-menu" style="background-color: #e9a294">


                <li>
                    <a href="../profile.php"><i class="text-primary fa fa-fw fa-user"></i> Profile</a>
                </li><li class="divider"></li>
                <li>
                    <a href="profile_update.php"><i class="text-primary fa fa-fw fa-edit"></i>Edit Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../include/logout.php"><i class="text-info fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse " style="font-size: 16px">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="index.php"><i class="fa fa-fw fa-dashboard fa-2x text-info"></i> Dashboard</a>
            </li>
            <li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#post"><i class="text-primary fa fa-fw fa-file-excel-o fa-2x"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="post" class="collapse">
                    <li>
                        <a href="posts.php"><i class="fa fa-fw fa-list text-primary"></i>View All Posts</a>
                    </li>
                    <li>
                        <a href="add_post.php"><i class="fa fa-fw fa-plus text-primary"></i>Add Posts</a>
                    </li>
                </ul>
            </li>
            </li>
            <li>
                <a href="categories.php"><i class="fa fa-fw fa-list fa-2x text-success"></i> Categories</a>
            </li>

            <li class="">
                <a href="comments.php"><i class="fa fa-fw fa-comment fa-2x text-info"></i> Comments</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="text-info fa fa-fw fa-users fa-2x"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="users.php"><i class="fa fa-fw fa-users text-primary"></i>View all Users</a>
                    </li>
                    <li>
                        <a href="add_user.php"><i class="fa fa-fw fa-plus text-primary"></i>Add User</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="profile.php"><i class="fa fa-fw fa-user-md fa-2x text-success"></i> Profile </a>
            </li>


        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>