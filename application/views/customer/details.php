<div class="row-fluid">
<div class="span8" id="servicesBlock_<?=$customer->id?>">
<table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th>Service Offered<button class="btn btn-link" onClick="$('#addService_<?=$customer->id?>').show();">Add new</button></th>
			<th>Lead status</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($c_services AS $c_service){ ?>
		<tr>
			<td><?=$c_service['id']?> <?=word_limiter($c_service['service_title'],5)?></td>
			<td><a id="s_block_<?=$c_service['id']?>" onDblClick="openLeadStatusEdit(this.id);"><?=$c_service['leadStatus']?></a></td>
			<td><?=time_elapsed_string($c_service['postedDate'])?></td>
		</tr>
		<?}?>
		<tr id="addService_<?=$customer->id?>" style="display:none;">
			<td>
				<select name="ServiceOffered" id="ServiceOffered_<?=$customer->id?>" class="input-medium">
					<option selected="selected">-- Select --</option>
					<?foreach($services AS $service){?>
					<option value="<?=$service['id']?>"><?=$service['title']?></option>
					<?}?>
				</select>
			</td>
			<td><select name="ServiceStatus" id="ServiceStatus_<?=$customer->id?>" class="input-medium">
					<option selected="selected">-- Select --</option>
					<option value="brand new">BRAND NEW</option>
					<option value="working lead">Working Lead</option>
					<option value="good lead">GOOD Lead</option>
					<option value="bad lead">BAD Lead</option>
					<option value="not interested">Not Interested</option>
					<option value="call back">Call Back</option>
					<option value="do not call">Do Not Call</option>
					<option value="sale made">SALE MADE</option>
					</select></td>
			<td><button type="button" class="btn" onClick="saveCustomerService(<?=$customer->id?>);">Save</button></td>
		</tr>
	</tbody>
</table>
</div>
</div>

<div class="row-fluid">
<div class="span12" id="customerDetailsBlock_<?=$customer->id?>">
	<table class="table table-hover table-condensed" style="" id="customerDetailsBlockTable_<?=$customer->id?>">
		<caption><b>Customer details</b><button type="button" class="btn btn-link" onClick="$('#customerDetailsEditBlock_<?=$customer->id?>').show();$('#customerDetailsBlockTable_<?=$customer->id?>').hide();">Edit</button></caption>
		<tr>
			<th>Name:</th>
			<td><?=$customer->name?></td>
			<th>Referred by:</th>
			<td>
			<?if(isset($c_referrals[0])){ foreach($c_referrals AS $ref){
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
				<option value="<?=$quality['quality']?>"<?if($customer->customerQuality == $quality['id'])echo'selected="selected"';?>><?=$quality['title']?></option>
				<?}?>
			</select></td>
		</tr>
		<!--tr>
			<th>Notes:</th>
			<td><textarea id="cd_notes_<?=$customer->id?>"><?=$customer->notes?></textarea></td>
		</tr-->
		<tr>
			<th><input type="button" class="btn" value="Save" onClick="saveCustomerDetails(<?=$customer->id?>);"></th>
			<td>&nbsp;</td>
		</tr>
	</table>
	</div>
</div>

<div class="row-fluid">
	<div class="span6" id="customerPhonesBlock_<?=$customer->id?>">
		<table class="table table-hover table-condensed">
		<caption><b>Customer phones</b><button class="btn btn-link" onClick="$('#addPhone_<?=$customer->id?>').show();">Add new</button></caption>
		<?foreach($c_phones AS $key=>$phone) {
			echo '<tr id="customerPhonesBlockEditNumber_'.$phone['id'].'">';
			echo '<td><strong>Phone '.($key+1).': </strong></td><td><a id="customerPhonesBlockEditNumberVal_'.$phone['id'].'" onClick="changePhoneNumber('.$phone['id'].');">'.numberFixAULocal($phone['phone']).'</a></td>';
			echo '</tr>';
		}?>
		<tr id="addPhone_<?=$customer->id?>" style="display:none;">
			<td>Phone: <input type="text" name="phone" id="new_phone_<?=$customer->id?>" maxlength="11"></td>
			<td><button class="btn" id="savePhoneNumberButton_<?=$customer->id?>" onClick="savePhoneNumber(<?=$customer->id?>);" style="display:none;">Save</button></td>
		</tr>
		</table>
	</div>
</div>
<script language="javascript">
	pnPattern<?=$customer->id?> = 'new_phone_<?=$customer->id?>';
	$( "#"+pnPattern<?=$customer->id?> ).keyup(function() {
		phone = $("#"+pnPattern<?=$customer->id?>).val();
		firstDigit = phone.substr(0,1);
		twoDigits = phone.substr(0,2);
		if(firstDigit =='0') {
			digits = 10;
		} else if(twoDigits == '61') {
			digits = 11;
		} else {
			digits = 9;
		}
		if(phone.length >=digits){
			res = validatePhoneNumer(phone, pnPattern<?=$customer->id?>)
			console.log(res);
			if(res == true) {
				//$('#savePhoneNumberButton_<?=$customer->id?>').attr("disabled", "disabled");
				//$('#savePhoneNumberButton_<?=$customer->id?>').removeAttr("disabled");
				$('#savePhoneNumberButton_<?=$customer->id?>').show();
				console.log('good number');
			} else {
				$('#savePhoneNumberButton_<?=$customer->id?>').hide();
				console.log('bad number');
			}
		} else {
			console.log(phone);
		}
	});
</script>

<div class="row-fluid">
	<div class="span12" id="referralWiewBlock_<?=$customer->id?>">
		<p>Add Referrals below given to you by <b><?=$customer->name?>:</b></p>
		<table class="table table-hover table-condensed">
		<thead>
		<tr>
			<th>Phone number</th>
			<th>Name</th>
			<th>Relationship</th>
			<th>State</th>
			<th>Sex</th>
			<th>Called</th>
		</tr>
		</thead>
		<tbody id="referralSectionBlock_<?=$customer->id?>">
		<?if(!isset($c_referral[0])){?>
			<tr><td colspan="6"><font style="color:red;">There are no referrals added</font></td></tr>
		<?} else {?>
		<?foreach($c_referral AS $referral) {?>
		<tr>
			<td><?=$referral['phone']?></td>
			<td><a onClick="openCustomer(<?=$uId?>,<?=$referral['id']?>);"><?=$referral['name']?></a></td>
			<td><?=$referral['relationship']?></td>
			<td><?=$referral['state']?></td>
			<td><?if($referral['sex'] == 'm') echo'Male'; else echo'Female';?></td>
			<td><?=time_elapsed_string($referral['called'])?></td>
		</tr>
		<?}?>
		<?}?>
		<?for($i=1;$i<=3;$i++){?>
		<tr>
			<td><input type="text" id="ref_phone_<?=$customer->id?>_<?=$i?>" value="" maxlength="11"></td>
			<td id="ref_phf_<?=$customer->id?>_<?=$i?>"><input type="text" id="ref_name_<?=$customer->id?>_<?=$i?>" value=""></td>
			<td>
				<select class="span9" id="ref_relation_<?=$customer->id?>_<?=$i?>">
					<option selected="selected">---</option>
					<?foreach($relationships AS $relationship){?>
					<option value="<?=$relationship['id']?>"><?=$relationship['title']?></option>
					<?}?>
				</select>
			</td>
			<td>
				<select class="span9" id="ref_state_<?=$customer->id?>_<?=$i?>">
					<option selected="selected">---</option>
					<?foreach($states AS $state){?>
					<option value="<?=$state['state']?>"><?=$state['state']?></option>
					<?}?>
				</select>
			</td>
			<td>
				<select class="span9" id="ref_sex_<?=$customer->id?>_<?=$i?>">
					<option selected="selected">---</option>
					<option value="m">Male</option>
					<option value="f">Female</option>
				</select>
			</td>
			<td><input type="hidden" id="ref_cId_<?=$customer->id?>_<?=$i?>" value="0">Calling now</td>
		</tr>
		<script language="javascript">
			$( "#"+"ref_phone_<?=$customer->id?>_<?=$i?>" ).keyup(function() {
				text = $("#"+"ref_phone_<?=$customer->id?>_<?=$i?>").val();
				fieldsIdPattern = "<?=$customer->id?>_<?=$i?>";
				//
				firstDigit = text.substr(0,1);
				twoDigits = text.substr(0,2);
				if(firstDigit =='0') {
					digits = 10;
				} else if(twoDigits == '61') {
					digits = 11;
				} else {
					digits = 9;
				}
				if(text.length >=digits){
				//
				//if(text.length >=9 && text.length <=11){
					tryToFindUser(text, fieldsIdPattern);
					validatePhoneNumer(text, 'ref_phone_'+fieldsIdPattern);
				} else {
					console.log(text);
				}
			});
		</script>
		<?}?>
		<?for($i=4;$i<=8;$i++){?>
		<tr style="display:none;" id="referralSectionBlockTr_<?=$customer->id?>_<?=$i?>">
			<td><input type="text" id="ref_phone_<?=$customer->id?>_<?=$i?>" value="" maxlength="11"></td>
			<td><input type="text" id="ref_name_<?=$customer->id?>_<?=$i?>" value=""></td>
			<td>
				<select class="span9" id="ref_relation_<?=$customer->id?>_<?=$i?>">
					<option selected="selected">---</option>
					<?foreach($relationships AS $relationship){?>
					<option value="<?=$relationship['id']?>"><?=$relationship['title']?></option>
					<?}?>
				</select>
			</td>
			<td>
				<select class="span9" id="ref_state_<?=$customer->id?>_<?=$i?>">
					<option selected="selected">---</option>
					<?foreach($states AS $state){?>
					<option value="<?=$state['state']?>"><?=$state['state']?></option>
					<?}?>
				</select>
			</td>
			<td>
				<select class="span9" id="ref_sex_<?=$customer->id?>_<?=$i?>">
					<option selected="selected">---</option>
					<option value="m">Male</option>
					<option value="f">Female</option>
				</select>
			</td>
			<td>Calling now</td>
		</tr>
		<?}?>
		<script language="javascript">
			$( "#"+"ref_phone_<?=$customer->id?>_<?=$i?>" ).keyup(function() {
				text = $("#"+"ref_phone_<?=$customer->id?>_<?=$i?>").val();
				fieldsIdPattern = "<?=$customer->id?>_<?=$i?>";
				if(text.length >=9 && text.length <=11){
					tryToFindUser(text, fieldsIdPattern);
				} else {
					console.log(text);
				}
			});
		</script>
		<tr>
			<td colspan="4">&nbsp;</td>
			<td><button type="button" class="btn" onClick="addMoreReferalFields(<?=$customer->id?>);">Add more</button></td><td><button type="button" class="btn" onClick="saveReferrals(<?=$customer->id?>);">Save Referrals</button></td>
		</tr>
		</tbody>
		</table>
	</div>
</div>