
<?php

include "config.php";
include "index.php";

// Fungsi untuk menampilkan progress bar
function set_progress($val=0){

	$data = "<div class='progress-container' style='display:none'>
			
				<div class='progress'>
					  <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: ". $val. "%'>
					  </div>
				</div>

			</div>";

	return $data;

}

?>

<div class="container">
  <div class="">
	
		<h2><center>Halaman tambah data transaksi</center></h2>
		<hr />
	
		<div class="col-md-offset-1 col-md-10 col-md-offset-1">			
			<button class="btn btn-xs pull-right" data-id='0' data-toggle="modal" data-target="#tambah-data">+ Tambah Data</button> <br /><br />

			<!-- Pesan jika telah melakukan aksi -->
			<?php if ( isset( $_SESSION['info'] ) ) { ?>

				<div style="width:320px;background:#eee;border-left:5px solid #46b8da;padding:10px;"> 
					Berhasil <?php echo $_SESSION['info'] ?> Data
				</div>

			<?php unset( $_SESSION['info'] ); } ?>

			<!-- Pesan jika gagal melakukan aksi -->

			
			<table class="table table-bordered">
				<tr>
					<th>Jumlah</th>
					<th>No Tujuan</th>
					<th>Operator</th>
				
					<th style="text-align:center">Aksi</th>
				</tr>

				<?php $sql = $conn->query("SELECT * FROM transaksi"); ?>
                    <!-- tampilkan data transaksi -->
					<?php while ( $r = $sql->fetch_assoc() ) { ?>

						<tr>
							<td><?php echo $r['jumlah'] ?></td>
							<td><?php echo $r['no_tujuan'] ?></td>
							<td style="text-align:center"><?php echo $r['operator'] ?></td>
							
							<td style="text-align:center;width:160px">

								<a  class="btn btn-xs btn-warning" href="javascript:;"
									data-id="<?php echo $r['id'] ?>"
									data-jumlah="<?php echo $r['jumlah'] ?>"
									data-notujuan="<?php echo $r['no_tujuan'] ?>"
									data-operator="<?php echo $r['operator'] ?>"	
									data-toggle="modal" data-target="#edit-data">
									<i class="fa fa-pencil"></i> Sunting
								</a>

								<a class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $r['id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-trash"></i> Hapus</a>
							</td>
						</tr>

				<?php } ?>

			</table>

			<ul class="pagination pagination-sm">
				<li><a href="#">&laquo;</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>

		</div>

	</div>

<br>
	<!-- Modal tambah data -->
	<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="transaksi.php?g=tambah">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="jumlah">Jumlah</label>
						      <input type="text" name="jumlah" class="form-control" placeholder="Rp__">
						    </div>

						    <div class="form-group">
						      <label for="no_tujuan">No Tujuan</label>
						      <input type="text" name="no_tujuan" class="form-control" placeholder="Masukkan Nomer Tujuan">
						    </div>

                             <div class="form-group">
						      <label for="operator">Operator</label>
						      <select name="operator" class="form-control">
						        <option value="operator">Pilih Operator</option>
						        <option value="xl">xl</option>
						        <option value="3">3</option>
						        <option value="telkomsel">Telkomsel</option>
						      </select>
						    </div>

						  </fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit"><i class="fa fa-save"></i> Simpan</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>

	<!-- Modal edit data -->
	<div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="transaksi.php?g=update">

					<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="jumlah">Jumlah</label>
						      <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Masukkan Jumlah">
						    </div>

						    <div class="form-group">
						      <label for="no_tujuan">No Tujuan</label>
						      <input type="text" id="no_tujuan" name="no_tujuan" class="form-control" placeholder="Masukkan No Tujuan">
						    </div>

						     <div class="form-group">
						      <label for="operator">Operator</label>
						      <select id="operator" name="operator" class="form-control">
						        <option value="">Pilih Operator</option>
						        <option value="xl">xl</option>
						        <option value="3">3</option>
						        <option value="telkomsel">Telkomsel</option>
						      </select>
						    </div>


						  </fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit"><i class="fa fa-save"></i> Simpan</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>

	<!-- modal konfirmasi-->
	<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Konfirmasi</h4>
				</div>

				<div class="modal-body" style="background:#d9534f;color:#fff">
					Apakah Anda yakin ingin menghapus data ini?
				</div>

				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-danger" id="hapus-true">Ya</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				</div>

			</div>
		</div>
	</div>

	<!-- Modal peringatan jika field belum terisi sempurna -->
	<div id="modal-peringatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-warning">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="title">Peringatan</h4>
				</div>

				<div class="modal-body" style="background: #d9534f; color: #fff;">
					<div id="pesan-required-field"></div>
				</div>

				<div class="modal-footer">

					<center><button type="button" class="btn btn-default" data-dismiss="modal">OK</button></center>

				</div>

			</div>
		</div>
	</div>

<script>

	// Fungsi untuk pengiriman form baca dokumentasinya di https://github.com/malsup/form/
	function set_ajax(identifier){
		
		var options = {
			beforeSend: function() {

				$(".progress-container").show();
				$(".btn-submit").attr("disabled",""); // Membuat button submit jadi tidak bisa terklik
			 
			},
			uploadProgress: function(event, position, total, percentComplete) {

				$(".progress-bar").attr('style','width'+percentComplete+'%');

			},
			success:function(data, textStatus, jqXHR,ui) {

				if ( data.trim() == "Sukses" ) {

					$(".progress-bar").attr('style','width:100%');
					setTimeout(function(){ location.reload() }, 2000);

				} else {

					$(".progress-container").hide();
					$("#pesan-required-field").html(data);
					$("#modal-peringatan").modal('show');
					$(".btn-submit").removeAttr('disabled','');
				}

			},
			error: function(jqXHR, textStatus, errorThrown){

				$(".progress-container").hide();
				$("#pesan-required-field").html('Gagal Memproses data<br/> textStatus='+textStatus+', errorThrown='+errorThrown);
				$("#modal-peringatan").modal('show');
			}
		 
		};
		 
		// kirim form dengan opsi yang telah dibuat diatas
		$("#"+identifier).ajaxForm(options);
	}

	$(function(){

		// Untuk pengiriman form tambah
		set_ajax('tambah-data');

		// Untuk pengiriman form sunting
		set_ajax('edit-data');

		// Hapus
		$('#modal-konfirmasi').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
			var id = div.data('id') 

			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
			modal.find('#hapus-true').attr("href","transaksi.php?g=hapus&id="+id); 

		});


		// Untuk sunting data 
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			var id 		    = div.data('id');
			var jumlah 	    = div.data('jumlah');
			var no_tujuan 	= div.data('notujuan');
			var operator 	    = div.data('operator');
            var created_at  = div.data('created_at');
			var modal 	    = $(this)

			// Isi nilai pada field
			modal.find('#id').attr("value",id);
			modal.find('#jumlah').attr("value",jumlah);
			modal.find('#no_tujuan').attr("value",no_tujuan);
			modal.find('#operator').attr("value",operator);
			modal.find('#created_at').attr("value",created_at);

			// Membuat combobox terpilih berdasarkan jenis kelamin yg tersimpan saat pengeditan
			modal.find('#operator option').each(function(){
				  if ($(this).val() == operator )
				    $(this).attr("selected","selected");
			});

		});

	});

</script>
