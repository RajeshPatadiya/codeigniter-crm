<table class="table table-hover table-condensed">
		<caption><b>Customer phones</b><button class="btn btn-link" onClick="$('#addPhone_<?=$cId?>').show();">Add new</button></caption>
		<?foreach($c_phones AS $key=>$phone) {
			//echo '<tr>';
			//echo '<td><strong>Phone '.($key+1).': </strong></td><td>'.numberFixAULocal($phone['phone']).'</td>';
			//echo '</tr>';
			echo '<tr id="customerPhonesBlockEditNumber_'.$phone['id'].'">';
			echo '<td><strong>Phone '.($key+1).': </strong></td><td><a id="customerPhonesBlockEditNumberVal_'.$phone['id'].'" onClick="changePhoneNumber('.$phone['id'].');">'.numberFixAULocal($phone['phone']).'</a></td>';
			echo '</tr>';
		}?>
		<tr id="addPhone_<?=$cId?>" style="display:none;">
			<td>Phone: <input type="text" name="phone" id="new_phone_<?=$cId?>" maxlength="11"></td>
			<td><button class="btn" id="savePhoneNumberButton_<?=$cId?>" onClick="savePhoneNumber(<?=$cId?>);" style="display:none;">Save</button></td>
		</tr>
</table>
<script language="javascript">
	pnPattern<?=$cId?> = 'new_phone_<?=$cId?>';
	$( "#"+pnPattern<?=$cId?> ).keyup(function() {
		phone = $("#"+pnPattern<?=$cId?>).val();
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
			res = validatePhoneNumer(phone, pnPattern<?=$cId?>)
			console.log(res);
			if(res == true) {
				//$('#savePhoneNumberButton_<?=$cId?>').attr("disabled", "disabled");
				//$('#savePhoneNumberButton_<?=$cId?>').removeAttr("disabled");
				$('#savePhoneNumberButton_<?=$cId?>').show();
			} else {
				$('#savePhoneNumberButton_<?=$cId?>').hide();
			}
		} else {
			console.log(phone);
		}
	});
</script>