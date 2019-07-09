<!DOCTYPE html>
<html>
<head>
	<title>coba</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<div id="#coba">
</div>
<form id="form" method="POST">
	<input type="text" name="nama1">
	<input type="text" name="nama2">
	<input type="text" name="nama1">
	<input type="submit" value="Submit">
</form>
<body>
	<script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$("#form").submit(function(e){
			e.preventDefault();
			console.log(JSON.stringify($(this).coba()));
			return false;
		});
		$.fn.coba = function(){
 
	    var o = {};
	    var a = this.serializeArray();
	    $.each(a, function() {
	        if (o[this.name] !== undefined) {
	            if (!o[this.name].push) {
	                o[this.name] = [o[this.name]];
	            }
	            o[this.name].push(this.value || '');
	        } else {
	            o[this.name] = this.value || '';
	        }
	    });
    	return o;
		}
	</script>
</body>
</html>