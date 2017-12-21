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
    <link href="../dist/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../dist/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../dist/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        #logo{
            margin:0 0 0 125px;
            width: 20%;
        }
        .login-panel{
            margin-top:200px;
        }
        #hasil{
            top: 150px;
            position: absolute;
            width: 100%;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">            
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div id="hasil"></div>
                    <div class="panel-heading">
                        <img src="../dist/img/logo.png" id="logo">
                        <p>-----------------------------------------------------------------</p>
                        <h3 class="panel-title" style="text-align:center;font-weight:bold;">Presensi Karyawan</h3>
                    </div>
                    <div class="panel-body">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Masukkan Kode Karyawan disini" name="kdk" id="kdk" type="text" maxlength="6" autofocus required style="text-transform:uppercase;">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!--<a href="dashboard.php" class="btn btn-lg btn-success btn-block">Masuk</a>-->
                            </fieldset>
                        <h2 id="jam" style="text-align:center;"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../dist/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../dist/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../dist/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/sb-admin/dist/js/sb-admin-2.js"></script>

    <!-- JS Presensi -->
    <script type="text/javascript">
        window.onload = function(){ wkt(); }
        function wkt(){
            var e = document.getElementById('jam'),
            wktskrg = new Date(), j, m, d;
            j = wktskrg.getHours();
            m = set(wktskrg.getMinutes());
            d = set(wktskrg.getSeconds());
            x = wktskrg.getDate() +"-"+ (wktskrg.getMonth()+1) +"-" +wktskrg.getFullYear();
            e.innerHTML = x + " | " + j + ":" + m + ":" + d;

            setTimeout('wkt()',1000);
        }
        
        function set(e){
            e = e < 10 ? '0' + e : e;
            return e;
        }
        $("#kdk").keydown(function(e){
            var kC = e.keyCode || e.which;
            var isi = $("#kdk").val();
            var url = "cek_pres.php";
            if (kC == 13 && isi!="") {
                $.post(url, {kdk:isi} ,function(data) {
                    $("#hasil").hide();
                    $("#hasil").html(data).fadeIn('slow');
                    setTimeout(function(){$("#hasil").fadeOut('slow');}, 1500);
                    document.getElementById("kdk").value = "";
                });    
            }
        })
    </script>
</body>

</html>
