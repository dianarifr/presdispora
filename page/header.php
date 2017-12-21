<?php 
    include('../koneksi.php');
    session_start();
    if(empty($_SESSION['username'])){
        echo "<script> location.href = \".\" </script>";
        //echo "<script> alert('".$_SESSION['kdk']."') </script>";
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
    <style type="text/css">
      /*  .sidebar .nav-second-level .Myside {
            padding-left: 37px;
        }
        .nav .Myside {
            position: relative;
            display: block;
            padding: 10px 15px;
        }
        .Myside {
            color: #337ab7;
            text-decoration: none;
        }
        .nav .Myside:focus, .nav .Myside:hover {
            text-decoration: none;
            background-color: #eee;
            cursor: pointer;
        }*/
    </style>
    <title>DINAS KEPEMUDAAN DAN KEOLAHRAGAAN PROVINSI JAWA TIMUR</title>

    <!-- Bootstrap Core CSS -->
    <link href="../dist/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../dist/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../dist/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="../dist/datatables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" >

    <!-- DateTimePicker CSS -->
    <link href="../dist/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" >Presensi dan Penggajian Pegawai Non PNS</a>
                <img src="../dist/img/logo.png" width="7%;">
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
            
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="../auth/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <label class="btn btn-social">Code with</label><i class="fa fa-heart"></i>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li><a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                        <li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Data Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level ">
                                <li class="Myside"><a href="karyawan_list.php">Karyawan</a></li>
                                <li class="Myside"><a href="gaji_list.php">Gaji</a></li>
                                <li class="Myside"><a href="jabatan_list.php">Jabatan</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Transaksi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="Myside"><a href="izin_list.php">Izin</a></li>
                                <li class="Myside"><a href="penggajian_list.php">Penggajian</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="Myside"><a href="lappresensi_list.php">Laporan Presensi</a></li>
                                <li class="Myside"><a href="lapkaryawan_list.php">Laporan Karyawan</a></li>
                                <li class="Myside"><a href="lappenggajian_list.php">Laporan Penggajian</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row main">
                    