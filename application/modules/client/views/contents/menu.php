<div class="container">
	<div class="jumbotron">
		<button class="btn btn-primary float-right" id="tombol_tambah_menu">Tambah Menu</button>
	</div>
	<div id="daftar_menu" class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>No</th>
					<th>Item</th>
					<th>Jenis</th>
					<th>Harga</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="table_menu">
			</tbody>
		</table>
	</div>
</div>

<div class="modal" id="hapus_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Hapus Menu?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Apakah anda yakin akan menghapus item ini ?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" id="konfirm_hapus_menu" value="">Hapus</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="tambah_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah item</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form id="form_tambah_menu">
				<div class="modal-body">
					<div class="form-group">
						<label>Item</label>
						<input type="text" name="nama_menu" required="">
					</div>
					<div class="form-group">
						<label>Jenis</label>
						<select name="tipe" required="">
							<option value="" selected="">Pilih Jenis Menu</option>
							<option value="makanan">Makanan</option>
							<option value="minuman">Minuman</option>
						</select>
					</div>
					<div class="form-group">
						<label>Harga</label>
						<input type="number" name="harga" required="" placeholder="Rp">
					</div>
				</div>				
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="update_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Update Item</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div id="set_form_update_menu"></div>
		</div>
	</div>
</div>