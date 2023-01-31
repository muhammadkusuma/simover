(function($) {

	$(document).ready(function(e) {

		
		var id_pej = 0;
		var main = "pej/pej.data.php";

		
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

			var url = "pej/pej.form.php";
			
			id_pej = this.id;

			if(id_pej != 0) {
				
				$("#myModalLabel3").html("Ubah Data Pejabat");
			} else {
				$("#myModalLabel").html("Tambah Data Pejabat");
			}

			$.post(url, {id: id_pej} ,function(data) {
			
				$(".modal-body").html(data).show();
			});
		});

		
		$('.hapus').live("click", function(){
			var url = "pej/pej.input.php";
		
			id_pej = this.id;

			
			var answer = confirm("Apakah anda ingin mengghapus data ini?");

			
			if (answer) {
			
				$.post(url, {hapus: id_pej} ,function() {
					
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
			var url = "pej/pej.input.php";

			
			var v_pejabat= $('input:text[name=pejabat]').val();
			
			$.post(url, {pejabat: v_pejabat, id_pej: id_pej} ,function() {
			
				
				$("#data-abs").load(main);

			
				$('#dialog-abs').modal('hide');

				
				$("#myModalLabel3").html("Tambah Data Pejabat");
			});
		});
	});
}) (jQuery);
