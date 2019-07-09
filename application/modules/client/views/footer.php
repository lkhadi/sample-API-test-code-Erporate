
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript">
	var jwt = "<?php echo $this->input->cookie('jwt');?>";
	var url = "<?php echo base_url();?>";
</script>
	<?php if($script==="daftar_menu"): ?>	
<script type="text/javascript" src="<?php echo base_url('assets/js/menu_makanan.js');?>"></script>
	<?php elseif($script==="pesanan"): ?>
<script type="text/javascript">var role = "<?php echo $role;?>";</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/pesanan.js');?>"></script>
	<?php endif;?>
</body>
</html>