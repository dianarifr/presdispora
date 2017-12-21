<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DINAS KEPEMUDAAN DAN KEOLAHRAGAAN PROVINSI JAWA TIMUR</title>

    <!-- Bootstrap Core CSS -->
    <link href="dist/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="dist/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="dist/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        #logo{
            margin:0 0 0 85px;
            width: 50%;
        }
        #hasil{
            top: 10px;
            right: 5px;
            position: absolute;
            width: 20%;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div id="hasil"></div>
    <div class="container">
        <div class="row">            
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <img src="dist/img/logo.png" id="logo">
                        <p>-----------------------------------------------------------------</p>
                        <h3 class="panel-title" style="text-align:center;font-weight:bold;">Login Admin</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" onsubmit="ajax_login();return false">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Kode Karyawan" name="kdk" id="kdk" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="pwd" id="pwd" type="password" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Masuk</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="dist/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="dist/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="dist/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/sb-admin/dist/js/sb-admin-2.js"></script>

    <!-- JS Login -->
    <script type="text/javascript">
        function ajax_login(){
            var kdk = $("#kdk").val();
            var pwd = $("#pwd").val();
            $.ajax({
                url: "auth/cek_login.php",
                type: "POST",
                data:{
                    kdk:kdk,
                    pwd:pwd
                },
                success:function(result){
                    $("#hasil").hide();
                    $(document).ready(function(){
                    setTimeout(function(){$("#hasil").html(result).fadeIn('slow');},10);});
                    setTimeout(function(){$("#hasil").fadeOut('slow');}, 1000);
                    document.getElementById("kdk").value = "";
                    document.getElementById("pwd").value = "";
                    $("#kdk").focus();
                }
            })
        }
    </script>
</body>

</html>
