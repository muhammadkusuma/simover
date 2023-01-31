(function($) {

	$(document).ready(function(e) {

		
		var id_gol = 0;
		var main = "gol/gol.data.php";

		
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

			var url = "gol/gol.form.php";
			
			id_gol = this.id;

			if(id_gol != 0) {
				
				$("#myModalLabel3").html("Ubah Data Golongan");
			} else {
				$("#myModalLabel").html("Tambah Data Golongan");
			}

			$.post(url, {id: id_gol} ,function(data) {
			
				$(".modal-body").html(data).show();
			});
		});

		
		$('.hapus').live("click", function(){
			var url = "gol/gol.input.php";
		
			id_gol = this.id;

			
			var answer = confirm("Apakah anda ingin mengghapus data ini?");

			
			if (answer) {
			
				$.post(url, {hapus: id_gol} ,function() {
					
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
			var url = "gol/gol.input.php";

			
			var v_golongan= $('input:text[name=golongan]').val();
			var v_pangkat = $('input:text[name=pangkat]').val();

			$.post(url, {golongan: v_golongan, pangkat: v_pangkat, id_gol: id_gol} ,function() {
			
				
				$("#data-abs").load(main);

			
				$('#dialog-abs').modal('hide');

				
				$("#myModalLabel3").html("Tambah Data Golongan");
			});
		});
	});
}) (jQuery);
