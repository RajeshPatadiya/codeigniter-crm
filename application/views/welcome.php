<div class="navbar navbar-static-top">
	<a class="brand" href="#">Referral CRM Tracking System</a>
	<ul class="breadcrumb pull-right" class="span4">
		<li>Welcome <?= $loggedIn?><input type="hidden" name="loggenInId" id="loggenInId" value="<?=$loggedId?>"></li>
		<li class="active">(<a href="auth/logout/">logout</a> | <a href="/auth/change_password/" target="_blank">Change password</a>)</li>
	</ul>
  
</div>  

<br/>
<br/>
<div class="container">

<div class="row-fluid">
    <div class="span4">
		<form class="form-search">
			<div class="input-append">
				<input type="text" class="input-xlarge" id="searchText">
				<button type="button" class="btn" onClick="trySearch();">Search</button>
			</div>
		</form>
	</div>
	
	<div class="span6">
		<form class="form-search">
			<div class="input-append">
				<select class="span3" id="searchUserID">
					<option value="MyLeads">My Leads</option>
					<option value="All">All Leads</option>
				</select>
				<select class="span3" id="searchLeadStatus">
					<option value="0">- Lead Status -</option>
					<option value="brand new">BRAND NEW</option>
					<option value="working lead">Working Lead</option>
					<option value="good lead">GOOD Lead</option>
					<option value="bad lead">BAD Lead</option>
					<option value="not interested">Not Interested</option>
					<option value="call back">Call Back</option>
					<option value="do not call">Do Not Call</option>
					<option value="sale made">SALE MADE</option>
				</select>
				<select class="span3" id="searchQuality">
					<option value="0">- Quality -</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				<select class="span3" id="searchLastCalled">
					<option value="0">- Last Called -</option>
					<option value="-24h">Over 24 hours</option>
					<option value="-7d">Over 7 days</option>
					<option value="-14d">Over 14 days</option>
					<option value="-30d">Over 30 days</option>
					<option value="-60d">Over 60 days</option>
					<option value="-90d">Over 90 days</option>
				</select>
				<button type="button" class="btn" onClick="tryReports();">Filter / Report</button>
			</div>
		</form>
	</div>
</div>

 <div class="tabbable">
  <ul class="nav nav-tabs" id="tabs">
    <li class="active" id="tab_dashboard"><a href="#tab_dashboard_content" data-toggle="tab">Dashboard</a></li>
    <!--li><a href="#tab2" data-toggle="tab">Customer name 1</a></li-->
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_dashboard_content">
      <p>
		<table id="dashboardCustomers">
			<tr><td>Customer name</td></tr>
			<?for($i=0; $i<count($customers);$i++) {
				echo'<tr><td><a href="#" onClick="openCustomer('.$loggedId.','.$customers[$i]->id.');">'.$customers[$i]->name.'</a></td></tr>';
			}?>
		</table>
	  </p>
    </div>
  </div>
</div>
<script language="javascript">
		$( document ).ready(function() {
			openUserTabs(<?=$tabs?>, <?=$loggedId?>);
			$("#new_phone").mask("(999).999-99-99");
		});

	</script>
</div>