<?php ob_start(); ?>
<?php include "../include/db.php"; ?>
<?php include ("admin_function.php"); ?>

<?php session_start();

if (isset($_SESSION['role'])){
    if ($_SESSION['role']!=='admin'){
        header("Location: ../index.php");
    }
    else if ($_SESSION['role']=='subscriber'){
        if (isset($_GET['edite'])){
            header("location:include/update.php");
        }
    }
}else if (!isset($_SESSION['role'])){
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom SS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="../js/time.js"></script>


</head>

<body onload="startTime()">

<!--<div id='load-screen'>-->
<!--<div id='loading'> </div>-->
<!--</div>-->

