(function($) {

	$(document).ready(function(e) {

		
		var id_tpt = 0;
		var main = "tpt/tpt.data.php";

		
		$("#data-abs").load(main);

		
		
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
				
					$("#data-abs").html(data).show();
				});
			} else {
				
				$("#data-abs").load(main);
			}
		});

		
		$('.ubah3,.tambah3').live("click", function(){

			var url = "tpt/tpt.form.php";
			
			id_tpt = this.id;

			if(id_tpt != 0) {
				
				$("#myModalLabel3").html("Ubah Data Kantor / Tempat");
			} else {
				$("#myModalLabel").html("Tambah Data kantor / Tempat");
			}

			$.post(url, {id: id_tpt} ,function(data) {
			
				$(".modal-body").html(data).show();
			});
		});

		
		$('.hapus').live("click", function(){
			var url = "tpt/tpt.input.php";
		
			id_tpt = this.id;

			
			var answer = confirm("Apakah anda ingin mengghapus data ini?");

			
			if (answer) {
			
				$.post(url, {hapus: id_tpt} ,function() {
					
					$("#data-abs").load(main);
				});
			}
		});

	
		$('.halaman').live("click", function(event){
		
			kd_hal = this.id;

			$.post(main, {halaman: kd_hal} ,function(data) {
			
				$("#data-abs").html(data).show();
			});
		});
		
		
		$("#simpan-abs").bind("click", function(event) {
			var url = "tpt/tpt.input.php";

			
			var v_nama_tempat= $('input:text[name=nama_tempat]').val();
			
			$.post(url, {nama_tempat: v_nama_tempat, id_tpt: id_tpt} ,function() {
			
				
				$("#data-abs").load(main);

			
				$('#dialog-abs').modal('hide');

				
				$("#myModalLabel3").html("Tambah Data Kantor / Tempat");
			});
		});
	});
}) (jQuery);
