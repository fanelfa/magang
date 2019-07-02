var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

manageData();

function fsearch() {
    $('#pagination').twbsPagination({ totalPages: 1 });
    $('#pagination').twbsPagination('destroy');
    manageData();
}

function search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("txsearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("tblomba");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

/* manage data list */
function manageData() {
    var input, filter, key;
    input = document.getElementById("jenjangsearch");
    filter = input.options[input.selectedIndex].value;
    key = filter.toLowerCase();
    txword = document.getElementById("txsearch");
    word = txword.value.toLowerCase();
    $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page, key:key, word:word}
    }).done(function(data){
        total_page = data.contests.last_page;
        current_page = data.contests.current_page;
        jumlahdata = data.contests.total;
        document.getElementById("jmldata").innerHTML = 'Jumlah data = ' + jumlahdata;

    	$('#pagination').twbsPagination({
	        totalPages: total_page,
	        visiblePages: 7,
	        onPageClick: function (event, pageL) {
	        	page = pageL;
                if(is_ajax_fire != 0){
	        	  getPageData();
                }
	        }
	    });

    	manageRow(data.contests.data);
        is_ajax_fire = 1;
    });
}

$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

/* Get Page Data*/
function getPageData() {
    var input, filter, key;
    input = document.getElementById("jenjangsearch");
    filter = input.options[input.selectedIndex].value;
    key = filter.toLowerCase();
    txword = document.getElementById("txsearch");
    word = txword.value.toLowerCase();
	$.ajax({
    	dataType: 'json',
    	url: url,
    	data: {page:page, key:key, word:word}
	}).done(function(data){
		manageRow(data.contests.data);
	});
}

/* Add new Item table row */
function manageRow(data) {
	var	rows = '';
	$.each( data, function( key, value ) {
	  	rows = rows + '<tr>';
	  	rows = rows + '<td style="vertical-align: middle; width: 37%;"><b>Nama : </b>'+value.nama+'<br>';
	  	rows = rows + '<b>Maksimal Umur : </b>'+value.umur+'<br>';
	  	rows = rows + '<b>Maksimal Peserta : </b>'+value.max_pes+'</td>';
	  	rows = rows + '<td style="vertical-align: middle; text-align: center; width: 18%;">'+value.jenjang+'</td>';
	  	rows = rows + '<td style="vertical-align: middle; width: 15%;">Rp '+(value.biaya/1000).toFixed(3)+'</td>';
	  	rows = rows + '<td style="vertical-align: middle; text-align: center; width: 10%;">'+value.urutan+'</td>';
        if (value.is_active == 1) {
            rows = rows + '<td style="text-align: center; vertical-align: middle; width: 10%;">';
            rows = rows + '<div class="padd_' + value.id + '" id="padd_' + value.id + '">';
            rows = rows + '<div data-id="' + value.id + '" style="text-align: center;">';
            rows = rows + '<div style="color: green; font-weight: bold;">Aktif</div>';
            rows = rows + '<button type="button" class="btn btn-danger btn-xs btn-nonactive" title="Tidak Aktif">Tidak Aktif</button>';
            rows = rows + '</div>';
            rows = rows + '</div>';
            rows = rows + '</td>';
        }
        if (value.is_active == 0) {
            rows = rows + '<td style="text-align: center; vertical-align: middle; width: 10%;">';
            rows = rows + '<div class="padd_' + value.id + '" id="padd_' + value.id + '">';
            rows = rows + '<div data-id="' + value.id + '" style="text-align: center;">';
            rows = rows + '<div style="color: red; font-weight: bold;">Tidak Aktif</div>';
            rows = rows + '<button type="button" class="btn btn-success btn-xs btn-active" title="Active">Aktif</button>';
            rows = rows + '</div>';
            rows = rows + '</div>';
            rows = rows + '</td>';
        }
	  	rows = rows + '<td style="text-align:center; vertical-align: middle; width: 20%;" data-id="'+value.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-lomba" class="btn btn-warning btn-xs btn-edit-lomba"><i class="fa fa-pencil" title="Ubah"></i></button> ';
        rows = rows + '<button class="btn btn-danger btn-xs remove-lomba"><i class="fa fa-trash-o" title="Hapus"></i></button>';
        rows = rows + '</td>';
	  	rows = rows + '</tr>';
	});

	$("tbody").html(rows);
}

/* Create new Item */
$(".btn-create-submit").click(function(e){
    e.preventDefault();
    var form_action = $("#create-lomba").find("form").attr("action");
    var data=$('#createlomba').serialize();

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:data
    }).done(function(data){
        getPageData();
        $(".modal").modal('hide');

        // swal("Tersimpan","Data berhasil disimpan", "success");
        toastr.success('Data berhasil disimpan', 'Informasi', { timeOut: 5000 });
    });
});

/* Remove Item */
$("body").on("click",".remove-lomba",function(){
    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");

    swal({
      title             : "Apakah Anda Yakin?",
      text              : "Anda akan menghapus data ini!",
      type              : "warning",
      showCancelButton  : true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText : "Yes",
      cancelButtonText  : "No",
      closeOnConfirm    : false,
      closeOnCancel     : false
    },
    function(isConfirm){
      if(isConfirm){
        setTimeout(function() {
          $.ajax({
              dataType: 'json',
              type:'DELETE',
              url: url + '/' + id
          }).done(function(data){
              c_obj.remove();
              getPageData();
            //   swal("Terhapus","Data berhasil dihapus", "success");
              swal.close();
              toastr.success('Data berhasil dihapus', 'Informasi', { timeOut: 5000 });
          });
        }, 1000); // 1 second delay
      }
      else{
        swal("Dibatalkan","Data batal dihapus", "error");
      }
    }
);});

/* Edit Item */
$("body").on("click",".btn-edit-lomba",function(){
    var id = $(this).parent("td").data('id');
    var request = $.ajax ({
        url : url + "/" + id + "/edit",
        type : "get",
        dataType: "html"
    });

    request.done(function(output) {
        var JSONObject = JSON.parse(output);
        var id = JSONObject.contest["id"];
        var biaya = JSONObject.contest["biaya"];
        var jenjang = JSONObject.contest["jenjang"];
        var max_pes = JSONObject.contest["max_pes"];
        var nama = JSONObject.contest["nama"];
        var umur = JSONObject.contest["umur"];
        var urutan = JSONObject.contest["urutan"];

        $("#edit-lomba").find("input[name='biaya']").val(biaya);
        $("#edit-lomba").find("select[name='jenjang']").val(jenjang);
        $("#edit-lomba").find("input[name='max_pes']").val(max_pes);
        $("#edit-lomba").find("input[name='nama']").val(nama);
        $("#edit-lomba").find("input[name='umur']").val(umur);
        $("#edit-lomba").find("input[name='urutan']").val(urutan);

        document.editlomba.action = url + '/' + id;
    });
});

/* Updated new Item */
$(".btn-submit-edit").click(function(e){
    e.preventDefault();
    var form_action = $("#edit-lomba").find("form").attr("action");
    var data=$('#editlomba').serialize();

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:data
    }).done(function(data){
        getPageData();
        $(".modal").modal('hide');
        // swal("Tersimpan","Data berhasil diubah", "success");
        toastr.success('Data berhasil diubah', 'Informasi', { timeOut: 5000 });
    });
});

var url = "<?php echo route('contestjs.index')?>";
{{Html::script('inseojs/lomba.js')}}

{{Html::script('admin/js/jquery.twbsPagination.min.js')}}