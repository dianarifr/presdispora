//fungsi load halaman
	$(document).ready(function()
	{
		window.onload = loadhome();
		$(" li.peg").click(function(){loadpeg();});
		$(" li.gaj").click(function(){loadgaj();});
		$(" li.jab").click(function(){loadjab();});
		$(" li.izi").click(function(){loadizi();});
		$(" li.pre").click(function(){loadpre();});
		$(" li.pen").click(function(){loadpen();});
	});

	function loading(){
		$(".main").html('<div style="padding-top:25%"><center><img src="../dist/img/loading.gif"/><i>  Mohon Tunggu ..</i></center></div>');
		 $(".main").hide();
		 $(".main").fadeIn("slow");
	};
	function loadhome(){loading();$(".main").load('../admin/v_dash.php');};
	function loadpeg(){loading();$(".main").load('../admin/v_karyawan.php');};
	function loadgaj(){loading();$(".main").load('../admin/v_gaji.php');};
	function loadjab(){loading();$(".main").load('../admin/v_jabatan.php');};
	function loadizi(){loading();$(".main").load('../admin/v_izin.php');};
	function loadpre(){loading();$(".main").load('../admin/v_presensi.php');};
	function loadpen(){loading();$(".main").load('../admin/v_penggajian.php');};