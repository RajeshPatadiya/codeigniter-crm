<table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th>Service Offered</th>
			<th>Lead status</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<select name="ServiceOffered" id="ServiceOffered">
					<option selected="selected">-- Select --</option>
				</select>
			</td>
			<td><select name="ServiceStatus" id="ServiceStatus">
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
			<td><?=date('Y-m-d')?></td>
		</tr>
	</tbody>
</table>
<button type="button" class="btn btn-primary" onClick="saveCustomerService();">Save</button>
<script language="javascript">
	$.ajax({
		type: 'POST',
		async: false,
		dataType : "json",
		url: '/customers/getservices/',
		success: function (data) {
			$.each(data.services, function(index, value) {
				$("#ServiceOffered").append('<option value='+value.id+'>'+value.title+'</option>');
			});
		}          
	});
	
	function updateServicesBlock(cId) {
		$.ajax({
			type: 'POST',
			async: false,
			dataType : "json",
			data: 'cId='+cId,
			url: '/customers/getcustomerservices/',
			success: function (data) {
				$('#servicesBlock_'+cId).html(data.html);
				closeModal();
			}          
		});
	}
	
	function saveCustomerService() {
		cId = $('#tabs li.active').attr('data');
		status = $('#ServiceStatus').val();
		sId = $('#ServiceOffered').val();
		$.ajax({
			type: 'POST',
			async: false,
			data: 'cId='+cId+'&status='+status+'&sId='+sId,
			url: '/customers/saveservice/',
			success: function (data) {
				console.log(data);
				if(data == 'true') {
					updateServicesBlock(cId);
				} else {
					alert('Could not save.');
				}
			}          
		});
	}
</script>