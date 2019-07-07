
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript">
	var jwt = "<?php echo $this->session->userdata("jwt");?>";	
	<?php if($title=="Daftar Menu"): ?>
		show_data();
		$(document).on('click','.hapus_menu',function(){
			$("#hapus_modal").modal("show");
			$("#konfirm_hapus_menu").val($(this).val());
			
		});
		$(document).on('click','#konfirm_hapus_menu',function(){
			$("#hapus_modal").modal("hide");
			delete_data($(this).val());
		});
		$(document).on('click','.edit_menu',function(){
			get_a_data($(this).val());
		});
		$(document).on('click','#tombol_tambah_menu',function(){
			$("#tambah_modal").modal('show');
		});
		$(document).on('submit','#form_tambah_menu',function(e){
			$("#tambah_modal").modal('hide');
			e.preventDefault();
			var o = {};
			var a = $(this).serializeArray();
			$.each(a,function(){
				if(o[this.name]===undefined){
					o[this.name] = this.value || '';
				}
			});
			o['jwt'] = jwt;
			tambah_data(o);
		});
		$(document).on('submit','#form_update_menu',function(e){
			$("#update_modal").modal('hide');
			e.preventDefault();
			var o = {};
			var a = $(this).serializeArray();
			$.each(a,function(){
				if(o[this.name]===undefined){
					o[this.name] = this.value || '';
				}
			});
			o['jwt'] = jwt;
			update_data(o);
		});
		function delete_data(id){
			$.ajax({
		    url: "<?php echo base_url("api/hapus_menu");?>/"+id+"/"+jwt,
		    type: "DELETE",
		    contentType: "application/json",
		    success: function () {
		    	show_data();
		    }
			});
		}
		function show_data(){
			$.ajax({
		    url: "<?php echo base_url("api/tampil_menu");?>",
		    type: "GET",
		    data: {jwt: jwt},
		    contentType: "application/json",
		    success: function (data) {
		    	var table = "";
		    	var i=0;
		    	$.each(data,function(){
		    		status = (parseInt(this.status)==1 ? "Ready" : "Kosong");
		    		i = parseInt(i)+1;
		    		table = table+'<tr><td>'+i+'</td><td>'+this.nama_menu+'</td><td>'+this.tipe+'</td><td>Rp '+this.harga+'</td><td>'+status+'</td><td><button class="btn btn-sm btn-primary edit_menu" value="'+this.id_menu+'">Edit</button> <button class="btn btn-sm btn-danger hapus_menu" value="'+this.id_menu+'">Hapus</button></td></tr>';
		    	});
		    	$("#table_menu").html(table);
		    }
			});		
		}

		function get_a_data(id){
			$.ajax({
		    url: "<?php echo base_url("api/tampil_menu/");?>"+id,
		    type: "GET",
		    data: {jwt: jwt},
		    contentType: "application/json",
		    success: function (data) {
		    	var option = '';
		    	if(data.tipe==='makanan'){
		    		option1 = '<option value="makanan" selected>Makanan</option><option value="minuman">Minuman</option>';		    		
		    	}else{
		    		option1 = '<option value="makanan">Makanan</option><option value="minuman" selected>Minuman</option>';
		    	}
		    	if(data.status==='1'){
		    		option2 = '<option value="1" selected>Ready</option><option value="0">Kosong</option>';
		    	}else{
		    		option2 = '<option value="1">Ready</option><option value="0" selected>Kosong</option>';
		    	}
		    	form = '<form id="form_update_menu"><div class="modal-body"><input name="id_menu" type="hidden" value="'+id+'" required /><div class="form-group"><label>Item</label><input type="text" name="nama_menu" required="" value="'+data.nama_menu+'"></div><div class="form-group"><label>Jenis</label><select name="tipe" required=""><option value="">Pilih Jenis Menu</option>'+option1+'</select></div><div class="form-group"><label>Harga</label><input type="number" name="harga" required="" placeholder="Rp" value="'+data.harga+'"><div class="form-group"><label>Status</label><select name="status" required>'+option2+'</select></div></div></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button></div></form>';
		    	$("#set_form_update_menu").html(form);
		    	$("#update_modal").modal("show");
		    }
			});		
		}

		function tambah_data(formdata){
			$.ajax({
		    url: "<?php echo base_url("api/tambah_menu");?>",
		    type: "POST",
		    data: formdata,
		    contentType: "application/x-www-form-urlencoded",
		    success: function () {
		    	show_data();
		    }
			});
		}
		function update_data(formdata){
			$.ajax({
		    url: "<?php echo base_url("api/update_menu");?>",
		    type: "PUT",
		    data: formdata,
		    contentType: "application/x-www-form-urlencoded",
		    success: function () {
		    	show_data();
		    }
			});
		}
	<?php endif;?>
</script>
</body>
</html>