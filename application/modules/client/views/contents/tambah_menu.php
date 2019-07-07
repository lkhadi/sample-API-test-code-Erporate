<div class="container">
	<div class="jumbotron">
		<h3 class="text-center">Tambah Menu</h3>
		<form method="POST">
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
			<input type="submit" value="Submit" class="btn btn-primary btn-sm">
		</form>
	</div>
</div>