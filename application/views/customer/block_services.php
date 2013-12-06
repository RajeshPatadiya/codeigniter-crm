<table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th>Service Offered<button class="btn btn-link" onClick="$('#addService_<?=$cId?>').show();">Add new</button></th>
			<th>Lead status</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($c_services AS $c_service){ ?>
		<tr>
			<td><?=word_limiter($c_service['service_title'],5)?></td>
			<td><?=$c_service['leadStatus']?></td>
			<td><?=time_elapsed_string($c_service['postedDate'])?></td>
		</tr>
		<?}?>
		<tr id="addService_<?=$cId?>" style="display:none;">
			<td>
				<select name="ServiceOffered" id="ServiceOffered_<?=$cId?>" class="input-medium">
					<option selected="selected">-- Select --</option>
					<?foreach($services AS $service){?>
					<option value="<?=$service->id?>"><?=$service->title?></option>
					<?}?>
				</select>
			</td>
			<td><select name="ServiceStatus" id="ServiceStatus_<?=$cId?>" class="input-medium">
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
			<td><button type="button" class="btn" onClick="saveCustomerService(<?=$cId?>);">Save</button></td>
		</tr>
	</tbody>
</table>