var pesan	= "";
var judul	= "";
var stsP 	= "";

//===============================================================================================================================
//JABATAN
var tj = $("#jabatan").DataTable({
	"ajax"		: "../admin/dt_jabatan.php",
	"order"		: [[1, "asc"]],
	"columns"	: 
		[
			{
				"data"		: null, //penomoran
				"width"		: "40px",
				"sClass"	: "text-center",
				"orderable"	: false,
			},/*
			{
				"data"		: "ID_JABATAN",
				"width"		: "120px",
			},*/
			{
				"data"		: "NAMA_JABATAN"
			},
			{
				"data"		: "STATUS_JABATAN",
				"width"		: "200px",
				"mRender"	: function(data){
					if (data=='1') {
						return '<button type="button" class="btn btn-success btn-xs">Aktif</button>';
					}else{
						return '<button type="button" class="btn btn-warning btn-xs">Tidak Aktif</button>';
					}
				},
			},
			{
                "data": "ID_JABATAN",
                "width": "150px",
                "sClass": "text-center",
                "orderable": false,
                "mRender": function (data) {
                	return '<button type="button" class="btn btn-info btn-circle ubahJ" id="'+ data +'" data-target="#ModalJab"><i class="fa fa-pencil"></i></button>\n\
                	<button type="button" class="btn btn-danger btn-circle hapusJ" id="'+ data +'"><i class="fa fa-trash-o"></i></button>';
                    //return '<a href="#" id="edit">Edit</a> | \n\
                    //<a href="http://localhost/delete.php?id='+ data +'" onclick="javascript:return confirm(\'Anda yakin?\');">Delete</a>';
                },
            },
		]
});
tj.on("order.dt search.dt",function(){
	tj.column(0,{search:"applied",order:"applied"}).nodes().each(function(cell,i){
		cell.innerHTML=i+1;
	});
}).draw();

//refresh dataTables
$(document).on('click','.refresh',function(e){tj.ajax.reload();});

//aksi tombol tambah/ubah
$(document).on('click','.tambah , .ubahJ',function(e){
	var url = "mdl_jabatan.php";
	var id_jabatan = this.id; // ambil id prodi dari button
	if (id_jabatan !== "") {$('#myModalLabelJ').html('Ubah Data Jabatan');}else{$('#myModalLabelJ').html('Tambah Data Jabatan');}
	$.post(url, {id: id_jabatan} ,function(data) {
		$(".Jabatan").html(data).show();
	});
	$('#ModalJab').modal('show');
});

$(document).on('click','#simpanjab',function(e){
	
	var url = "crud.php";
	var v_kodeJ = $('input:hidden[name=kodeJ]').val();
	var v_namaJ = $('input:text[name=namaJ]').val();
	var v_stsJ  = $('select[name=stsJ]').val();
	
	$.post(url, {kodeJ: v_kodeJ, namaJ: v_namaJ, stsJ: v_stsJ}, function(){
		if (v_kodeJ==""||v_namaJ==""||v_stsJ=="") {
			judul = "Tidak Berhasil!"; 
			pesan = "Data Tidak Berhasil Disimpan"; 
			stsP  = "error";
		}else{
			judul = "Berhasil!";
			pesan = "Data Berhasil Disimpan";
			stsP  = "success";
			$('#ModalJab').modal('hide'); //hide modal
		}
		swal({ //muncul pesan
			title: judul,
			text: pesan,
			type:stsP,
		  	timer: 1500,
		  	showConfirmButton: false
		});tj.ajax.reload(); //refresh dataTables
	});
});

$(document).on('click','.hapusJ',function(e){
	var url = "crud.php";
	var id_jabatan = this.id; // amibl id prodi dari button

	swal({
        title: "Anda Yakin Menghapus Data ini?",
        type: "warning",
        confirmButtonColor: "#DD6B55",
  		confirmButtonText: "Ya!",
  		cancelButtonText: "Batal",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    },
    function () {
    	$.post(url,{id: id_jabatan},function(e){
    		setTimeout(function(){
        		swal({title: "Berhasil!", text: "Data Sudah Terhapus.", type: "success",timer: 1500 ,showConfirmButton: false});	
        	},1000);tj.ajax.reload(); //refresh dataTables
    	});
    });
	
});


//===============================================================================================================================
//GAJI

var tg = $("#gaji").DataTable({
	"ajax"		: "../admin/dt_gaji.php",
	"order"		: [[1, "asc"]],
	"columns"	: 
		[
			{
				"data"		: null, //penomoran
				"width"		: "40px",
				"sClass"	: "text-center",
				"orderable"	: false,
			},
			{
				"data"		: "NOMINAL",
				"render"	: $.fn.dataTable.render.number(',', '', 0, 'Rp ') //ganti format uang
			},
			{
				"data"		: "STS_GAJI",
				"width"		: "200px",
				"mRender"	: function(data){
					if (data=='1') {
						return '<button type="button" class="btn btn-success btn-xs">Aktif</button>';
					}else{
						return '<button type="button" class="btn btn-warning btn-xs">Tidak Aktif</button>';
					}
				},
			},
			{
                "data": "ID_GAJI",
                "width": "150px",
                "sClass": "text-center",
                "orderable": false,
                "mRender": function (data) {
                	return '<button type="button" class="btn btn-info btn-circle ubahG" id="'+ data +'" data-target="#ModalJab"><i class="fa fa-pencil"></i></button>\n\
                	<button type="button" class="btn btn-danger btn-circle hapusG" id="'+ data +'"><i class="fa fa-trash-o"></i></button>';
                },
            },
		]
});

tg.on("order.dt search.dt",function(){
	tg.column(0,{search:"applied",order:"applied"}).nodes().each(function(cell,i){
		cell.innerHTML=i+1;
	});
}).draw();

//refresh dataTables
$(document).on('click','.refresh',function(e){tg.ajax.reload();});

//aksi tombol tambah/ubah
$(document).on('click','.tambah , .ubahG',function(e){
	var url = "mdl_gaji.php";
	var id_gaji = this.id; // ambil id prodi dari button
	if (id_gaji !== "") {$('#myModalLabelG').html('Ubah Data Gaji');}else{$('#myModalLabelG').html('Tambah Data Gaji');}
	$.post(url, {id: id_gaji} ,function(data) {
		$(".Gaji").html(data).show();
	});
	$('#Modalgaj').modal('show');
});

$(document).on('click','#simpangaj',function(e){
	
	var url = "crud.php";
	var v_kodeG = $('input:hidden[name=kodeG]').val();
	var v_nominalG = $('input:text[name=nominalG]').val().replace(/[,]/g,'').toString();
	var v_stsG  = $('select[name=stsG]').val();
	$.post(url, {kodeG: v_kodeG, nominalG: v_nominalG, stsG: v_stsG}, function(){
		if (v_kodeG==""||v_nominalG==""||v_stsG=="") {
			judul = "Tidak Berhasil!"; 
			pesan = "Data Tidak Berhasil Disimpan"; 
			stsP  = "error";
		}else{
			judul = "Berhasil!";
			pesan = "Data Berhasil Disimpan";
			stsP  = "success";
			$('#Modalgaj').modal('hide'); //hide modal
		}
		swal({ //muncul pesan
			title: judul,
			text: pesan,
			type:stsP,
		  	timer: 1500,
		  	showConfirmButton: false
		});tg.ajax.reload(); //refresh dataTables
	});
});

$(document).on('click','.hapusG',function(e){
	var url = "crud.php";
	var id_gaji = this.id; // amibl id prodi dari button

	swal({
        title: "Anda Yakin Menghapus Data ini?",
        type: "warning",
        confirmButtonColor: "#DD6B55",
  		confirmButtonText: "Ya!",
  		cancelButtonText: "Batal",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    },
    function () {
    	$.post(url,{id: id_gaji},function(e){
    		setTimeout(function(){
        		swal({title: "Berhasil!", text: "Data Sudah Terhapus.", type: "success",timer: 1500 ,showConfirmButton: false});	
        	},1000);tg.ajax.reload(); //refresh dataTables
    	});
    });
	
});

//=================================================================================================================================
//KARYAWAN
var tk = $("#karyawan").DataTable({
	"ajax"		: "../admin/dt_karyawan.php",
	"order"		: [[1, "asc"]],
	"columns"	: 
		[
			{
				"data"		: null, //penomoran
				"width"		: "20px",
				"sClass"	: "text-center",
				"orderable"	: false,
			},
			{
				"data"		: "NAMA_KAR",
				"width"		: "150px",
			},
			{
				"data"		: "JABATAN",
				"width"		: "150px",
			},
			{
				"data"		: "ALAMAT_KAR",
				"width"		: "150px",
			},
			/*{
				"data"		: "NO_TELP_KAR",
				"width"		: "100px",
			},*/
			{
				"data"		: "KODE_KAR",
				"width"		: "50px",
			},
			{
				"data"		: "STS_KAR",
				"width"		: "100px",
				"mRender"	: function(data){
					if (data=='1') {
						return '<button type="button" class="btn btn-success btn-xs">Aktif</button>';
					}else{
						return '<button type="button" class="btn btn-warning btn-xs">Tidak Aktif</button>';
					}
				},
			},
			{
                "data": "ID_KAR",
                "width": "130px",
                "sClass": "text-center",
                "orderable": false,
                "mRender": function (data) {
                	return '<button type="button" class="btn btn-info btn-circle ubahK" id="'+ data +'" data-target="#ModalJab"><i class="fa fa-pencil"></i></button>\n\
                	<button type="button" class="btn btn-circle cetakK" id="'+ data +'" ><i class="fa fa-print"></i></button>\n\
                	<button type="button" class="btn btn-danger btn-circle hapusK" id="'+ data +'"><i class="fa fa-trash-o"></i></button>';
                },
            },
		],
		"bDestroy" : true
});

tk.on("order.dt search.dt",function(){
	tk.column(0,{search:"applied",order:"applied"}).nodes().each(function(cell,i){
		cell.innerHTML=i+1;
	});
}).draw();

//refresh dataTables
$(document).on('click','.refresh',function(e){tk.ajax.reload();});
//button kembali ata batal
$(document).on('click', '#kembaliK , #batal', function(){$('.main').load('v_karyawan.php');});
//button tambah baru atau edit data
$(document).on('click','.tambahK , .ubahK',function(e){
	$('#no_edit').css('display','none');
	$('#edit').css('display','block');
	var url	= "edit_karyawan.php";
	var id_kar = this.id; // ambil id prodi dari button
	if (id_kar !== "") {
		$('#label_kar').html('Ubah Data Karyawan');
	}else{
		$('#label_kar').html('Tambah Data Karyawan');
	}
	$.post(url, {id: id_kar} ,function(data) {
		$(".karyawan").html(data).show();
	});
});

$(document).on('click','#simpankar',function(e){
	
	var url = "crud.php";
	var v_idK = $('input:hidden[name=idK]').val();
	var v_namaK = $('input:text[name=NmK]').val();
	var v_almtK = $('textarea#AlmtK').val();
	var v_tlK = $('input:text[name=Tlk]').val();
	var v_tglK = $('input:text[name=tglK]').val();
	var v_telpK = $('input:text[name=TelpK]').val();
	var v_stsK  = $('select[name=stsK]').val();
	var v_agamaK  = $('select[name=AgamaK]').val();
	var v_jkelK = $('#jkel:checked').val();
	var v_jabatanK  = $('select[name=jabatan]').val();
	var v_gajiK  = $('select[name=gaji]').val();
	var v_kodeK = $('#KodeK').html();
	var v_pwdK = $('input:text[name=pwd]').val();

	$.post(url, {idK: v_idK, namaK: v_namaK, almtK: v_almtK, tlK:v_tlK, tglK:v_tglK, telpK:v_telpK, stsK:v_stsK, agamaK:v_agamaK, jkelK:v_jkelK, jabatanK:v_jabatanK, gajiK:v_gajiK, kodeK:v_kodeK, pwdK:v_pwdK}, function(){

		if (v_idK==""||v_namaK==""||v_almtK==""||v_tlK==""||v_tglK==""||v_telpK==""||v_stsK==""||v_agamaK==""||v_jkelK==""||v_jabatanK==""||v_gajiK==""||v_kodeK=="") {
			judul = "Tidak Berhasil!"; 
			pesan = "Data Tidak Berhasil Disimpan"; 
			stsP  = "error";
		}else{
			judul = "Berhasil!";
			pesan = "Data Berhasil Disimpan";
			stsP  = "success";
			$('.main').load('v_karyawan.php');
		}
		swal({ //muncul pesan
			title: judul,
			text: pesan,
			type:stsP,
		  	timer: 1500,
		  	showConfirmButton: false
		});tk.ajax.reload(); //refresh dataTables 
	});
});

$(document).on('click','.hapusK',function(e){
	var url = "crud.php";
	var id_kary = this.id; // amibl id prodi dari button
	swal({
        title: "Anda Yakin Menghapus Data ini?",
        type: "warning",
        confirmButtonColor: "#DD6B55",
  		confirmButtonText: "Ya!",
  		cancelButtonText: "Batal",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    },
    function () {
    	$.post(url,{id: id_kary},function(e){
    		setTimeout(function(){
        		swal({title: "Berhasil!", text: "Data Sudah Terhapus.", type: "success",timer: 1500 ,showConfirmButton: false});	
        	},1000);tk.ajax.reload(); //refresh dataTables
    	});
    });
	
});

$(document).on('click','.cetakK',function(e){
	var id = this.id;
	var url = "cetak_kar.php?id_kar="+id;
	e.stopImmediatePropagation(); //mencegah tidak open tab 2x
	var win = window.open(url,"_blank")
	win.focus();
});

//===============================================================================================================================
//IZIN
var ti = $("#izin").DataTable({
	"ajax"		: "../admin/dt_izin.php",
	"order"		: [[1, "asc"]],
	"columns"	: 
		[
			{
				"data"		: null, //penomoran
				"width"		: "20px",
				"sClass"	: "text-center",
				"orderable"	: false,
			},
			{
				"data"		: "ID_IZIN",
				"width"		: "100px",
			},
			{
				"data"		: "NAMA",
				"width"		: "150px",
			},
			{
				"data"		: "KET_IZIN",
				"width"		: "150px",
				"mRender"	: function(data){
					if (data=='Tanpa Keterangan') {
						return '<button type="button" class="btn btn-danger btn-xs">'+data+'</button>';
					}else{
						return data;
					}
				}
			},
			{
				"data"		: "TGL_IZIN",
				"width"		: "150px",
			},
			/*{
				"data"		: "IZIN",
				"width"		: "100px",
				"mRender"	: function(data){
					switch 
					if (data=='1') {
						return '<button type="button" class="btn btn-success btn-xs">Di Setujui</button>';
					}
					{
						return '<button type="button" class="btn btn-info btn-xs">Tunggu Persetujuan</button>';
					}
				},
			},*/
			{
                "data": "ID_IZIN",
                "width": "130px",
                "sClass": "text-center",
                "orderable": false,
                "mRender": function (data) {
                	return '<button type="button" class="btn btn-info btn-circle ubahI" id="'+ data +'" data-target="#ModalJab"><i class="fa fa-pencil"></i></button>\n\
                	<button type="button" class="btn btn-danger btn-circle hapusI" id="'+ data +'"><i class="fa fa-trash-o"></i></button>';
                	//<button type="button" class="btn btn-circle cetakI" onclick="bukapage();" id="'+ data +'" ><i class="fa fa-print"></i></button>\n\
                },
            },
		]
});

ti.on("order.dt search.dt",function(){
	ti.column(0,{search:"applied",order:"applied"}).nodes().each(function(cell,i){
		cell.innerHTML=i+1;
	});
}).draw();

//refresh dataTables
$(document).on('click','.refresh',function(e){ti.ajax.reload();});
//button kembali ata batal
$(document).on('click', '#kembaliI , #batalI', function(){$('.main').load('v_izin.php');});
//button tambah baru atau edit data
$(document).on('click','.tambahI , .ubahI',function(e){
	$('#no_edit').css('display','none');
	$('#edit').css('display','block');
	var url	= "edit_izin.php";
	var id_izin = this.id; // ambil id izin
	if (id_izin !== "") {
		$('#label_izin').html('Ubah Data Izin');
	}else{
		$('#label_izin').html('Tambah Data Izin');
	}
	$.post(url, {id: id_izin} ,function(data) {
		$(".izin").html(data).show();
	});
});

$(document).on('click','#simpaniz',function(e){
	var url = "crud.php";
	var v_idI = $('input:hidden[name=idI]').val();
	var v_namaI = $('input:text[name=namaI]').val();
	var v_tglI = $('input:text[name=tglI]').val();
	var v_ketI  = $('textarea#ketI').val();
	/*alert(v_idI);
	alert(v_namaI);
	alert(v_tglI);
	alert(v_ketI);*/
	$.post(url, {idI: v_idI, namaI: v_namaI, ketI: v_ketI, tglI: v_tglI}, function(){
		if (v_idI==""||v_namaI==""||v_ketI==""||v_tglI=="") {
			judul = "Tidak Berhasil!"; 
			pesan = "Data Tidak Berhasil Disimpan"; 
			stsP  = "error";
		}else{
			judul = "Berhasil!";
			pesan = "Data Berhasil Disimpan";
			stsP  = "success";
			$('.main').load('v_izin.php');
		}
		swal({ //muncul pesan
			title: judul,
			text: pesan,
			type:stsP,
		  	timer: 1500,
		  	showConfirmButton: false
		});ti.ajax.reload(); //refresh dataTables
	});
});

$(document).on('click','.hapusI',function(e){
	var url = "crud.php";
	var id_izin = this.id; // amibl id prodi dari button
	swal({
        title: "Anda Yakin Menghapus Data ini?",
        type: "warning",
        confirmButtonColor: "#DD6B55",
  		confirmButtonText: "Ya!",
  		cancelButtonText: "Batal",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    },
    function () {
    	$.post(url,{id: id_izin},function(e){
    		setTimeout(function(){
        		swal({title: "Berhasil!", text: "Data Sudah di Batalkan.", type: "success",timer: 1500 ,showConfirmButton: false});	
        	},1000);ti.ajax.reload(); //refresh dataTables
    	});
    });
	
});


//=====================================================================================
//PRESENSI
var tp = $("#presensi").DataTable({
	"ajax"		: "../admin/dt_presensi.php",
	"order"		: [[1, "asc"]],
	"columns"	: 
		[
			{
				"data"		: null, //penomoran
				"width"		: "20px",
				"sClass"	: "text-center",
				"orderable"	: false,
			},
			{
				"data"		: "NAMA_KAR",
				"width"		: "200px",
			},
			{
				"data"		: "NAMA_JABATAN",
				"width"		: "100px",
			},
			{
                "data": "ID_KAR",
                "width": "130px",
                "sClass": "text-center",
                "orderable": false,
                "mRender": function (data) {
                	return '<button type="button" class="btn btn-circle cetakP" id="'+ data +'" ><i class="fa fa-print"></i></button>';
                },
            },
		]
});

tp.on("order.dt search.dt",function(){
	tp.column(0,{search:"applied",order:"applied"}).nodes().each(function(cell,i){
		cell.innerHTML=i+1;
	});
}).draw();
//refresh dataTables
$(document).on('click','.refresh',function(e){tp.ajax.reload();});

$(document).on('click','.cetakP',function(e){
	var tgl = $("#tglK").val();
	if (tgl!="") {
		var id = this.id;
		var url = "cetak_pre.php?id_kar="+id+"&tgl="+tgl;
		e.stopImmediatePropagation(); //mencegah tidak open tab 2x
		var win = window.open(url,"_blank")
		win.focus();
	}else{
		//$("#tglK").focus();
		judul = "Tidak Berhasil!";
		pesan = "Harap Isi Bulan dan Tahun Terlebih Dahulu";
		stsP  = "error";
		swal({ //muncul pesan
			title: judul,
			text: pesan,
			type:stsP,
		  	timer: 1500,
		  	showConfirmButton: false
		}); 
	}
	
});

//=====================================================================================
//PENGGAJIAN
var tpen = $("#penggajian").DataTable({
	"ajax"		: "../admin/dt_penggajian.php",
	"order"		: [[1, "asc"]],
	"columns"	: 
		[
			{
				"data"		: null, //penomoran
				"width"		: "20px",
				"sClass"	: "text-center",
				"orderable"	: false,
			},
			{
				"data"		: "NO_SLIP",
				"width"		: "200px",
			},
			{
				"data"		: "NAMA_KAR",
				"width"		: "200px",
			},
			{
				"data"		: "TGL_PENGGAJIAN",
				"width"		: "100px",
			},
			{
				"data"		: "periode",
				"width"		: "100px",
			},
			{
				"data"		: "TOTAL_GAJI",
				"width"		: "100px",
			},
			{
                "data": "NO_SLIP",
                "width": "130px",
                "sClass": "text-center",
                "orderable": false,
                "mRender": function (data) {
                	return '<button type="button" class="btn btn-info btn-circle ubahPEN" id="'+ data +'" ><i class="fa fa-pencil"></i></button>\n\
                	<button type="button" class="btn btn-danger btn-circle hapusPEN" id="'+ data +'"><i class="fa fa-trash-o"></i></button>';
                },
            },
		]
});

tpen.on("order.dt search.dt",function(){
	tpen.column(0,{search:"applied",order:"applied"}).nodes().each(function(cell,i){
		cell.innerHTML=i+1;
	});
}).draw();
//refresh dataTables
$(document).on('click','.refresh',function(e){tpen.ajax.reload();});

$(document).on('click','.hapusPEN',function(e){
	var url = "crud.php";
	var id_gaji = this.id; // amibl id prodi dari button

	swal({
        title: "Anda Yakin Menghapus Data ini?",
        type: "warning",
        confirmButtonColor: "#DD6B55",
  		confirmButtonText: "Ya!",
  		cancelButtonText: "Batal",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    },
    function () {
    	$.post(url,{id: id_gaji},function(e){
    		setTimeout(function(){
        		swal({title: "Berhasil!", text: "Data Sudah Terhapus.", type: "success",timer: 1500 ,showConfirmButton: false});	
        	},1000);tg.ajax.reload(); //refresh dataTables
    	});
    });
	
});
