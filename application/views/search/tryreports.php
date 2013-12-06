<?//rd($results);?>

<table class="table">
	<tr>
		<th>Customer</th>
		<th>Service</th>
		<th>Lead status</th>
		<th>Quality</th>
		<th>Date</th>
		<th>User ID</th>
	</tr>
	<?foreach($results AS $result){?>
	<tr>
		<td><a href="#" onClick="openCustomer(<?=$uId?>,<?=$result['c_id']?>);"><?=$result['c_name']?></a></td>
		<td><?=$result['s_title']?></td>
		<td><?=$result['leadStatus']?></td>
		<td><?=$result['c_quality']?></td>
		<td><?=time_elapsed_string($result['postedDate'])?></td>
		<td><?=$result['ref_user_id']?></td>
	</tr>
	<?}?>
</table>