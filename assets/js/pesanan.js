show_pesanan();
$(document).on("click","#tombol_tambah_pesanan",function(){
	$.ajax({
		url: url+"api/tampil_menu",
		type: "GET",
		beforeSend: function(request) {
		    request.setRequestHeader("authorization", "Bearer "+jwt);
		},
		data: {jenis: "makanan"},
		success: function(result){
			var data = '';
			$.each(result,function(){
				data = data+"<tr><td class='start_td'><input type='checkbox' class='in_makanan' name='makanan[]' value='"+this.id_menu+"'></td><td>"+this.nama_menu+"</td><td class='td_harga'>"+this.harga+"<input class='in_harga' type='hidden' value='"+this.harga+"' disabled></td></tr>";
			});
			$("#tabel_makanan").html(data);
		}	
	});
	$.ajax({
		url: url+"api/tampil_menu",
		type: "GET",
		beforeSend: function(request) {
		    request.setRequestHeader("authorization", "Bearer "+jwt);
		},
		data: {jenis: "minuman"},
		success: function(result){
			var data = '';
			$.each(result,function(){
				data = data+"<tr><td class='start_td'><input type='checkbox' class='in_minuman' name='minuman[]' value='"+this.id_menu+"'></td><td>"+this.nama_menu+"</td><td class='td_harga'>"+this.harga+"<input class='in_harga' type='hidden' value='"+this.harga+"' disabled></td></tr>";
			});
			$("#tabel_minuman").html(data);
		}	
	});
});
var total_harga=0;
$(document).on("click",".in_makanan",function(){
	var harga = $(this).closest('.start_td').next('td').next('.td_harga').find('.in_harga').val();
	if($(this).prop("checked") == true){
		total_harga=parseInt(total_harga)+parseInt(harga);
	}else{
		total_harga=parseInt(total_harga)-parseInt(harga);
	}
	$("#total_harga").val(total_harga);
	$("#label_harga").html("Rp "+total_harga);
});
$(document).on("click",".in_minuman",function(){
	var harga = $(this).closest('.start_td').next('td').next('.td_harga').find('.in_harga').val();
	if($(this).prop("checked") == true){
		total_harga=parseInt(total_harga)+parseInt(harga);
	}else{
		total_harga=parseInt(total_harga)-parseInt(harga);
	}
	$("#total_harga").val(total_harga);
	$("#label_harga").html("Rp "+total_harga);
});
$(document).on("submit","#form_tambah_pesanan",function(e){
	e.preventDefault();
	var o = {};
	var a = $(this).serializeArray();
	var i = 0;
	$.each(a,function(){
		if(o[this.name]!==undefined){
			if(!o[this.name].push){
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		}else{
			o[this.name] = this.value || '';
		}
	});
	o['jwt']=jwt;
	formData = JSON.stringify(o);
	$.ajax({
		url: url+"api/buat_pesanan",
		type: "POST",
		contentType: "application/json",
		data: formData,
		success: function(result){
			$("#tambah_pesanan").modal('hide');
			show_pesanan();
		},
		error: function(xhr){
			message = JSON.parse(xhr.responseText);
			alert(message.message);
		}
	});
});
$(document).on("click",".u_tutup",function(){
	$("#utabel_makanan").html('');
	$("#utabel_minuman").html('');
});
$(document).on("click",".edit_pesanan",function(){
	var id = $(this).val();
	$("#konfirm_ubah_psn").val(id);
	$.ajax({
		url: url+"api/tampil_menu",
		type: "GET",
		beforeSend: function(request) {
		    request.setRequestHeader("authorization", "Bearer "+jwt);
		},
		data: {jenis: "makanan"},
		success: function(result){
			var data = '';
			$.each(result,function(){
				data = data+"<tr><td class='start_td'><input type='checkbox' class='uin_makanan' name='makanan[]' value='"+this.id_menu+"' id='id_menu"+this.id_menu+"'></td><td>"+this.nama_menu+"</td><td class='td_harga'>"+this.harga+"<input class='in_harga' type='hidden' value='"+this.harga+"' disabled></td></tr>";
			});
			$("#utabel_makanan").html(data);
		}	
	});
	$.ajax({
		url: url+"api/tampil_menu",
		type: "GET",
		beforeSend: function(request) {
		    request.setRequestHeader("authorization", "Bearer "+jwt);
		},
		data: {jenis: "minuman"},
		success: function(result){
			var data = '';
			$.each(result,function(){
				data = data+"<tr><td class='start_td'><input type='checkbox' class='uin_minuman' name='minuman[]' value='"+this.id_menu+"' id='id_menu"+this.id_menu+"'></td><td>"+this.nama_menu+"</td><td class='td_harga'>"+this.harga+"<input class='in_harga' type='hidden' value='"+this.harga+"' disabled></td></tr>";
			});
			$("#utabel_minuman").html(data);
		}	
	});
	$.ajax({
		url: url+"api/tampil_pesanan",
		type: "GET",
		beforeSend: function(request) {
		    request.setRequestHeader("authorization", "Bearer "+jwt);
		},
		data: {id_pesanan: id},
		success: function(result){
			$.each(result.data,function(){
				$("#id_menu"+this.id_menu).attr("checked","checked");
			});
			$("#utotal_harga").val(result.data[0].total_harga);
			$("#unomor_meja").val(result.data[0].nomor_meja);
			$("#ulabel_harga").html("Rp "+result.data[0].total_harga);
		}	
	});
	$("#ubah_pesanan").modal('show');
});
$(document).on("click",".uin_makanan",function(){
	var total_harga = $("#utotal_harga").val();
	var harga = $(this).closest('.start_td').next('td').next('.td_harga').find('.in_harga').val();
	if($(this).prop("checked") == true){
		total_harga=parseInt(total_harga)+parseInt(harga);
	}else{
		total_harga=parseInt(total_harga)-parseInt(harga);
	}
	$("#utotal_harga").val(total_harga);
	$("#ulabel_harga").html("Rp "+total_harga);
});
$(document).on("click",".uin_minuman",function(){
	var total_harga = $("#utotal_harga").val();
	var harga = $(this).closest('.start_td').next('td').next('.td_harga').find('.in_harga').val();
	if($(this).prop("checked") == true){
		total_harga=parseInt(total_harga)+parseInt(harga);
	}else{
		total_harga=parseInt(total_harga)-parseInt(harga);
	}
	$("#utotal_harga").val(total_harga);
	$("#ulabel_harga").html("Rp "+total_harga);
});
$(document).on("click",".btn_tutup_psn",function(){
	$("#tutup_pesanan").modal('show');
	var id = $(".btn_tutup_psn").val();
	$("#konfirm_tutup_psn").val(id);
});
$(document).on("click","#konfirm_tutup_psn",function(){
	var id = $(this).val();
		$.ajax({
			url: url+"api/tutup_pesanan",
			type: "POST",
			data: {id_pesanan: id,jwt: jwt},
			success: function(result){
				show_pesanan();
				$("#tutup_pesanan").modal('hide');
			},error: function(error){
				console.log(error);
			}	
		});
	});
$(document).on("submit","#form_ubah_pesanan",function(e){
	e.preventDefault();
	var o = {};
	var a = $(this).serializeArray();
	var i = 0;
	$.each(a,function(){
		if(o[this.name]!==undefined){
			if(!o[this.name].push){
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		}else{
			o[this.name] = this.value || '';
		}
	});
	o['jwt']=jwt;
	o['id_pesanan'] = $("#konfirm_ubah_psn").val();
	formData = JSON.stringify(o);
	$.ajax({
		url: url+"api/update_pesanan",
		type: "POST",
		contentType: "application/json",
		data: formData,
		success: function(result){
			$("#ubah_pesanan").modal('hide');
			show_pesanan();
		},
		error: function(xhr){
			console.log(xhr);
		}
	});
});
function show_pesanan(){
	$.ajax({
		url: url+"api/tampil_pesanan",
		type: "GET",
		beforeSend: function(request) {
		    request.setRequestHeader("authorization", "Bearer "+jwt);
		},
		success: function(result){
			var mark='';
			var tabel='';
			var i=0;
			var harga='';
			var status='';
			var tutup='';
			$.each(result.data,function(){
				if(mark!==this.nomor_pesanan){
					i = parseInt(i)+1;
					if(parseInt(i)>1){
						if(role==='kasir'){
							tutup=tutup+"<td><button class='btn btn-sm btn-warning btn_tutup_psn' value='"+mark+"' >Tutup</button></td>";
						}
						tabel = tabel+"</td><td>Rp "+harga+"</td><td>"+status+"</td><td><button class='btn btn-sm btn-primary edit_pesanan' value='"+mark+"'>Ubah</button>"+tutup+"</td></tr>";
					}
					tutup='';
					tabel = tabel+"<tr><td>"+this.nomor_pesanan+"</td><td>"+this.nomor_meja+"</td><td>";
					harga = this.total_harga;
					status = (this.status==1 ? "Aktif" : "Tidak Aktif");
					tabel=tabel+this.nama_menu+", ";
					mark=this.nomor_pesanan;
				}else{
					tabel=tabel+this.nama_menu+", ";
				}
			});
			if(role==='kasir'){
				tutup=tutup+"<td><button class='btn btn-sm btn-warning btn_tutup_psn' value='"+mark+"' >Tutup</button></td>";
			}
			tabel = tabel+"</td><td>Rp "+harga+"</td><td>"+status+"</td><td><button class='btn btn-sm btn-primary edit_pesanan' value='"+mark+"'>Ubah</button>"+tutup+"</td></tr>";
			$("#table_pesanan").html(tabel);
		}	
	});
}