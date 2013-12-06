<?//rd($customers);?>
<button onclick="addNewCustomerWithoutReferalForm(<?=$uId?>);" class="btn" type="button">Add new customer</button>
<?include('addnewcustomer.php');?>

<table class="table">
	<tr>
		<th>Name</th>
		<th>State</th>
		<th>Sex</th>
		<th>Called</th>
		<th>Quality</th>
		<!--th>User ID</th-->
	</tr>
	<?foreach($customers AS $customer){?>
	<tr>
		<td><a href="#" onclick="openCustomer(<?=$uId?>,<?=$customer['id']?>);"><?=$customer['name']?></a></td>
		<td><?=$customer['state']?></td>
		<td><?if($customer['sex']=='m')echo'Male'; else echo'Female';?></td>
		<td><?=$customer['called']?></td>
		<td><?=$customer['customerQuality']?></td>
		<!--td><?//=$result['ref_user_id']?></td-->
	</tr>
	<?}?>
</table>