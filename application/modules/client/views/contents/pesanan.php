<div class="container">
	<div class="jumbotron">
		<button class="btn btn-primary float-right" id="tombol_tambah_pesanan" data-toggle="modal" data-target="#tambah_pesanan">Buat Pesanan Baru</button>
	</div>
	<div id="daftar_menu" class="table-responsive">
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
					<div class="table-responsive">
						<table class="table table-striped table-hover" style="height: 100px;overflow: scroll;">
							<thead>
								<tr>
									<th>Pilih</th>
									<th>Makanan</th>
									<th>Harga</th>
								</tr>
							</thead>
							<tbody id="tabel_makanan"></tbody>
						</table>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-hover" style="height: 100px;overflow: scroll;">
							<thead>
								<tr>
									<th>Pilih</th>
									<th>Minuman</th>
									<th>Harga</th>
								</tr>
							</thead>
							<tbody id="tabel_minuman"></tbody>
						</table>
					</div>
					<div class="form-group">
						<label>Harga</label>
						<p id="label_harga"></p>
						<input type="hidden" name="harga" required="" placeholder="Rp" class="form-control" id="total_harga">
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

<div class="modal" id="ubah_pesanan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Pesanan</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form id="form_ubah_pesanan">
				<div class="modal-body">
					<div class="form-group">
						<label>No Meja</label>
						<input type="text" name="nomor_meja" required="" class="form-control" id="unomor_meja">
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-hover" style="height: 100px;overflow: scroll;">
							<thead>
								<tr>
									<th>Pilih</th>
									<th>Makanan</th>
									<th>Harga</th>
								</tr>
							</thead>
							<tbody id="utabel_makanan"></tbody>
						</table>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-hover" style="height: 100px;overflow: scroll;">
							<thead>
								<tr>
									<th>Pilih</th>
									<th>Minuman</th>
									<th>Harga</th>
								</tr>
							</thead>
							<tbody id="utabel_minuman"></tbody>
						</table>
					</div>
					<div class="form-group">
						<label>Harga</label>
						<p id="ulabel_harga"></p>
						<input type="hidden" name="harga" required="" placeholder="Rp" class="form-control" id="utotal_harga">
					</div>
				</div>				
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="konfirm_ubah_psn">Simpan</button>
					<button type="button" class="btn btn-danger u_tutup" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="tutup_pesanan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tutup Pesanan</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form id="form_ubah_pesanan">
				<div class="modal-body">
					Lanjutkan tutup pesanan?
				</div>				
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="konfirm_tutup_psn">Ya</button>
					<button type="button" class="btn btn-danger u_tutup" data-dismiss="modal">Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>