<?foreach($c_referral AS $referral) {?>
		<tr>
			<td><?=numberFixAULocal($referral['phone'])?></td>
			<td><a onClick="openCustomer(<?=$uId?>,<?=$referral['id']?>);"><?=$referral['name']?></a></td>
			<td><?=$referral['relationship']?></td>
			<td><?=$referral['state']?></td>
			<td><?if($referral['sex'] == 'm') echo'Male'; else echo'Female';?></td>
			<td><?=time_elapsed_string($referral['called'])?></td>
		</tr>
		<?}?>
		<?for($i=1;$i<=3;$i++){?>
		<tr>
			<td><input type="text" id="ref_phone_<?=$cId?>_<?=$i?>" value=""></td>
			<td id="ref_phf_<?=$cId?>_<?=$i?>"><input type="text" id="ref_name_<?=$cId?>_<?=$i?>" value=""></td>
			<td>
				<select class="span9" id="ref_relation_<?=$cId?>_<?=$i?>">
					<option selected="selected">---</option>
					<?foreach($relationships AS $relationship){?>
					<option value="<?=$relationship['id']?>"><?=$relationship['title']?></option>
					<?}?>
				</select>
			</td>
			<td>
				<select class="span9" id="ref_state_<?=$cId?>_<?=$i?>">
					<option selected="selected">---</option>
					<?foreach($states AS $state){?>
					<option value="<?=$state['state']?>"><?=$state['state']?></option>
					<?}?>
				</select>
			</td>
			<td>
				<select class="span9" id="ref_sex_<?=$cId?>_<?=$i?>">
					<option selected="selected">---</option>
					<option value="m">Male</option>
					<option value="f">Female</option>
				</select>
			</td>
			<td>Calling now</td>
		</tr>
		<script language="javascript">
			$( "#"+"ref_phone_<?=$cId?>_<?=$i?>" ).keyup(function() {
				text = $("#"+"ref_phone_<?=$cId?>_<?=$i?>").val();
				fieldsIdPattern = "<?=$cId?>_<?=$i?>";
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
				//if(text.length >=8){
					tryToFindUser(text, fieldsIdPattern);
				} else {
					console.log(text);
				}
			});
		</script>
		<?}?>
				<tr>
			<td colspan="5">&nbsp;</td>
			<td><button type="button" class="btn" onClick="saveReferrals(<?=$cId?>);">Save Referrals</button></td>
		</tr>