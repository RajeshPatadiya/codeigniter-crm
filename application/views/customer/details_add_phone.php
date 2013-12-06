<form name="" action="/customers/savephone/" method="POST">
	<input type="hidden" name="variable" id="variable" value="<?=$variable?>">
	Phone: <br>
	<input type="text" name="phone" id="new_phone"><br>
	<input type="button" value="Save !" onClick="savePhoneNumber();">
</form>
<script>
function savePhoneNumber() {
	num = $('#new_phone').val();
	cId = $('#variable').val();
	uId = $('#loggenInId').val();
	$.ajax({
		type: 'POST',
		url: '/customers/savephone/',
		data: 'num='+num+'&cId='+cId,
		success: function (data) {  
			$('#modal-body').html(data);
			$('#myModal').modal('hide');
			reloadCustomer(uId, cId);
		}          
	});
}
</script>