<table class="table table-hover table-condensed">
		<caption><b>Customer details</b><input type="hidden" name="cId" id="cId" value="<?=$variable?>"></caption>
		<tr>
			<th>Name:</th>
			<td><input type="text" id="cd_name"></td>
		</tr>
		<tr>
			<th>State:</th>
			<td><select id="cd_state">
					<option>-- Select --</option>
					<option value="NSW">NSW</option>
					<option value="VIC">VIC</option>
					<option value="QLD">QLD</option>
					<option value="SA">SA</option>
					<option value="WA">WA</option>
					<option value="NT">NT</option>
					<option value="TAS">TAS</option>
				    <option value="ACT">ACT</option>
  
			</select></td>
		</tr>
		<tr>
			<th>Sex:</th>
			<td><select id="cd_sex">
					<option>-- Select --</option>
					<option value="m">Male</option>
					<option value="f">Female</option>
			</select></td>
		</tr>
		<tr>
			<th>Customer quality:</th>
			<td><select id="cd_quality">
					<option value="0">-- Select --</option>
					<option value="1">1 - BAD</option>
					<option value="2">2</option>
					<option value="3">3 - Average</option>
					<option value="4">4</option>
					<option value="5">5 - GOOD</option>
			</select></td>
		</tr>
		<tr>
			<th>Address / Other notes:</th>
			<td><textarea id="cd_address"></textarea></td>
		</tr>
		<tr>
			<th>Notes:</th>
			<td><textarea id="cd_notes"></textarea></td>
		</tr>
		<tr>
			<th><input type="button" class="btn" value="Save" onClick="saveCustomerDetails(<?=$variable?>);"></th>
			<td>&nbsp;</td>
		</tr>
	</table>
<script language="javascript">
	$.ajax({
		type: 'POST',
		async: false,
		dataType : "json",
		//data: 'cId='+<?=$variable?>,
		url: '/customers/getcustomer/'+<?=$variable?>+'/',
		success: function (data) {
			$('#cd_name').val(data.customer.name);
			$('#cd_state').val(data.customer.state);
			$('#cd_sex').val(data.customer.sex);
			$('#cd_quality').val(data.customer.customerQuality);
			$('#cd_address').val(data.customer.address);
			$('#cd_notes').val(data.customer.notes);
		}          
	});
	
	function saveCustomerDetails(cId) {
		name = $('#cd_name').val();
		state = $('#cd_state').val();
		sex = $('#cd_sex').val();
		qual = $('#cd_quality').val();
		address = $('#cd_address').val();
		notes = $('#cd_notes').val();
		$.ajax({
			type: 'POST',
			async: false,
			data: 'cId='+cId+'&name='+name+'&state='+state+'&sex='+sex+'&quality='+qual+'&address='+address+'&notes='+notes,
			url: '/customers/savedetails/',
			success: function (data) {
				console.log(data);
				closeModal();
				loadCustomerDetailsBlock(cId);
			}          
		});
	}
</script>