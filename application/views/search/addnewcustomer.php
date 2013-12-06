<div class="span6">
<table class="table" id="addNewCustomerWithoutReferalForm_<?=$uId?>" style="display:none;">
	<caption><b>Add new customer</b></caption>
	<tr>
		<th>Name</th>
		<th>State</th>
		<th>Sex</th>
		<th>&nbsp;</th>
	</tr>
	<tr>
		<td><input id="cus_name_<?=$uId?>" type="text" value=""></td>
		<td><select id="cus_state_<?=$uId?>">
					<option selected="selected">---</option>
					<?foreach($states AS $state){?>
					<option value="<?=$state['state']?>"><?=$state['state']?></option>
					<?}?>
				</select></td>
		<td><select id="cus_sex_<?=$uId?>">
					<option selected="selected">---</option>
					<option value="m">Male</option>
					<option value="f">Female</option>
				</select></td>
		<td><button onclick="saveCustomer(<?=$uId?>);" class="btn" type="button">Save</button></td>
	</tr>
</table>
<table class="table" id="addNewCustomerWithoutReferalRes_<?=$uId?>" style="display:none;">
	<tr><th><b>Added customer:</b></th><td id="addedCustomer">&nbsp;</td></tr>
</table>
</div>