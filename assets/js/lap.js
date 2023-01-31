(function($) {

	$(document).ready(function(e) {

		
		var id_lap = 0;
		var main = "lap/lap.data.php";

		
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

			var url = "kgb/kgb.form.php";
			
			id_lap = this.id;

			if(id_lap != 0) {
				
				$("#myModalLabel3").html("Ubah Data KGB");
			} else {
					// saran
				$("#myModalLabel").html("Tambah Data KGB");
			}

			$.post(url, {id: id_lap} ,function(data) {
			
				$(".modal-body").html(data).show();
			});
		});

		
		$('.hapus').live("click", function(){
			var url = "lap/lap.input.php";
		
			id_lap = this.id;

			
			var answer = confirm("Apakah anda ingin mengghapus data ini?");

			
			if (answer) {
			
				$.post(url, {hapus: id_lap} ,function() {
					
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
			var url = "lap/lap.input.php";

			var v_id_gol= $('select[name=id_gol]').val();
			var vtahun_kgb = $('input:text[name=tahun_kgb]').val();
			var vgaji_kgb = $('input:text[name=gaji_kgb]').val();

			$.post(url, {id_gol: v_id_gol, tahun_kgb: vtahun_kgb, gaji_kgb: vgaji_kgb, id_kgb: id_kgb} ,function() {
			
				
				$("#data-abs").load(main);

			
				$('#dialog-abs').modal('hide');

				
				$("#myModalLabel3").html("Tambah Data KGB");
			});
		});
	});
}) (jQuery);
