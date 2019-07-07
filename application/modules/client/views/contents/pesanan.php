<div class="container">
	<div class="jumbotron">
		<button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambah_pesanan">Tambah Pesanan</button>
	</div>
	<div id="daftar_menu" class="table-responsize">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>No. Pesanan</th>
					<th>No. Meja</th>
					<th>Item</th>
					<th>Harga</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="table_pesanan">
			</tbody>
		</table>
	</div>
</div>

<div class="modal" id="tambah_pesanan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Pesanan</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form id="form_tambah_pesanan">
				<div class="modal-body">
					<div class="form-group">
						<label>No Meja</label>
						<input type="text" name="nomor_meja" required="" class="form-control">
					</div>
					<div class="form-group">
						<label>Makanan</label>
						<select name="makanan[]" multiple="" class="form-control">
							<option value="" selected="">Pilih Menu</option>
							<?php foreach($daftar_makanan as $df): ?>
							<option value="<?php echo $df->id_menu;?>"><?php echo $df->nama_menu;?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<label>Minuman</label>
						<select name="minuman[]" multiple="" class="form-control">
							<option value="" selected="">Pilih Menu</option>
							<?php foreach($daftar_minuman as $df): ?>
							<option value="<?php echo $df->id_menu;?>"><?php echo $df->nama_menu;?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<label>Harga</label>
						<input type="number" name="harga" required="" placeholder="Rp" class="form-control">
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