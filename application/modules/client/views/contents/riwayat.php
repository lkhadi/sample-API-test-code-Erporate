<div class="container">
	<div class="jumbotron">
		<button class="btn btn-sm btn-primary" onclick='window.print()'>Print</button>
		<div class="table-responsive" id="riwayat">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Riwayat</th>
						<th>Tanggal</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($riwayat as $key => $rw): ?>
						<tr>
							<td><?php echo ++$key;?></td>
							<td><?php echo $rw->log;?></td>
							<td><?php echo $rw->updated_at;?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>