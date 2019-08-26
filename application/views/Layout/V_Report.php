<h2 style="text-align: center;">Employee Data</h2>
<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover " style="border-style: solid;border-width: 1px" >
		<thead>
			<tr style="border-style: solid;border-width: 1px" >
				<th style="border-style: solid;border-width: 1px" >No</th>
				<th style="border-style: solid;border-width: 1px" >Name</th>
				<th style="border-style: solid;border-width: 1px" >Gender</th>
				<th style="border-style: solid;border-width: 1px" >Date Of Birth</th>
				<th style="border-style: solid;border-width: 1px" >Place Of Birth</th>
				<th style="border-style: solid;border-width: 1px" >Religion</th>
				<th style="border-style: solid;border-width: 1px" >Address</th>
				<th style="border-style: solid;border-width: 1px" >Phone</th>
				<th style="border-style: solid;border-width: 1px" >Email</th>
				<th style="border-style: solid;border-width: 1px" >Notes</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$iterator = 1;
			if ($Employee && isset($Employee)) {
												# code...

				foreach ($Employee as $key) {?>
					<tr style="border-style: solid;border-width: 1px" >
						<td style="border-style: solid;border-width: 1px" ><?php echo $iterator; ?></td>
						<td style="border-style: solid;border-width: 1px" ><?php echo $key['NAME']; ?></td>
						<td style="border-style: solid;border-width: 1px" ><?php echo $key['GENDER']; ?></td>
						<td style="border-style: solid;border-width: 1px" ><?php echo $key['DATE_OF_BIRTH']; ?></td>
						<td style="border-style: solid;border-width: 1px" ><?php echo $key['PLACE_OF_BIRTH']; ?></td>
						<td style="border-style: solid;border-width: 1px" ><?php echo $key['RELIGION']; ?></td>
						<td style="border-style: solid;border-width: 1px" ><?php echo $key['ADDRESS']; ?></td>
						<td style="border-style: solid;border-width: 1px" ><?php echo $key['PHONE']; ?></td>
						<td style="border-style: solid;border-width: 1px" ><?php echo $key['EMAIL']; ?></td>
						<td style="border-style: solid;border-width: 1px" ><?php echo $key['NOTES']; ?></td>

					</tr>
					<?php 
					$iterator++;
				}
			} ?>
		</tbody>
	</table>
</div>