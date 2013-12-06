<table class="table table-hover table-condensed" style="" id="customerDetailsBlockTable_<?=$customer->id?>">
		<caption><b>Customer details</b><button type="button" class="btn btn-link" onClick="$('#customerDetailsEditBlock_<?=$customer->id?>').show();$('#customerDetailsBlockTable_<?=$customer->id?>').hide();">Edit</button></caption>
		<tr>
			<th>Name:</th>
			<td><?=$customer->name?></td>
			<th>Referred by:</th>
			<td><?if(isset($c_referrals[0])){ foreach($c_referrals AS $ref){
				echo '<a href="#" onClick="openCustomer('.$uId.','.$ref['id'].');">'.$ref['name'].'</a> ('.$ref['rel_title'].')<br>';
			} } else {echo'NOBODY';}?></td>
		</tr>
		<tr>
			<th>State:</th>
			<td><?=$customer->state?></td>
			<th>Notes:</th>
			<td rowspan="4"><?=$customer->notes?></td>
		</tr>
		<tr>
			<th>Sex:</th>
			<td><?if($customer->sex == 'm') echo'Male'; else echo'Female';?></td>
		</tr>
		<tr>
			<th>Address / Other notes:</th>
			<td><?=$customer->address?></td>
		</tr>
		<tr>
			<th>Customer quality:</th>
			<td><?=$customer->customerQuality?></td>
		</tr>
	</table>
	<table class="table table-hover table-condensed" id="customerDetailsEditBlock_<?=$customer->id?>" style="display:none;">
		<caption><b>Edit customer details</b></caption>
		<tr>
			<th>Name:</th>
			<td><input type="text" id="cd_name_<?=$customer->id?>" value="<?=$customer->name?>"></td>
			<th>Notes:</th>
			<td rowspan="4"><textarea id="cd_notes_<?=$customer->id?>"><?=$customer->notes?></textarea></td>
		</tr>
		<tr>
			<th>State:</th>
			<td><select id="cd_state_<?=$customer->id?>">
					<?foreach($states AS $state){?>
					<option value="<?=$state['state']?>"<?if($customer->state == $state['state'])echo'selected="selected"';?>><?=$state['state']?></option>
					<?}?>
			</select></td>
		</tr>
		<tr>
			<th>Sex:</th>
			<td><select id="cd_sex_<?=$customer->id?>">
					<option value="">-- Select --</option>
					<option value="m"<?if($customer->sex == 'm')echo' selected="selected"';?>>Male</option>
					<option value="f"<?if($customer->sex == 'f')echo' selected="selected"';?>>Female</option>
			</select></td>
		</tr>
		<tr>
			<th>Address / Other notes:</th>
			<td><textarea id="cd_address_<?=$customer->id?>"><?=$customer->address?></textarea></td>
		</tr>
		<tr>
			<th>Customer quality:</th>
			<td><select id="cd_quality_<?=$customer->id?>">
				<?foreach($qualities AS $quality){?>
				<option value="<?=$quality['quality']?>"<?if($customer->customerQuality == $quality['quality'])echo'selected="selected"';?>><?=$quality['title']?></option>
				<?}?>
			</select></td>
		</tr>
		<tr>
			<th><input type="button" class="btn" value="Save" onClick="saveCustomerDetails(<?=$customer->id?>);"></th>
			<td>&nbsp;</td>
		</tr>
	</table>