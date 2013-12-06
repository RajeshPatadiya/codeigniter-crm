var oldHtml = '';
var idPattern = '';

function isset () {
// !No description available for isset. @php.js developers: Please update the function summary text file.
// 
// version: 1109.2015
// discuss at: http://phpjs.org/functions/isset    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
// +   improved by: FremyCompany
// +   improved by: Onno Marsman
// +   improved by: Rafał Kukawski
// *     example 1: isset( undefined, true);    // *     returns 1: false
// *     example 2: isset( 'Kevin van Zonneveld' );
// *     returns 2: true
var a = arguments,
    l = a.length,        i = 0,
    undef;

if (l === 0) {
    throw new Error('Empty isset');    }

while (i !== l) {
    if (a[i] === undef || a[i] === null) {
        return false;        }
    i++;
}
return true;
}

$.fn.flash = function(duration, iterations) {
    duration = duration || 1000; // Default to 1 second
    iterations = iterations || 1; // Default to 1 iteration
    var iterationDuration = duration / iterations;

    for (var i = 0; i < iterations; i++) {
        this.fadeOut(iterationDuration).fadeIn(iterationDuration);
    }
}

function addNewTab(id, title, tabContent) {
	var $nav=$('.nav');
	$nav.find('li').removeClass('active');
    $nav.append(
        $('<li class="active" id="tab_'+id+'" data="'+id+'"><a href="#tab_content_'+id+'" data-toggle="tab">'+title+' <i class="icon-remove" onClick="closeCustomer(\''+id+'\');"></i></a></li>') //class="active"
    );
	var $tab=$('.tab-content');
    $tab.find('.tab-pane').removeClass('active');
	closetab = '<div class="span6 pull-right" style="text-align:right;"><!--a href="#" class="btn btn-info btn-mini" onClick="closeCustomer(\''+id+'\');">close tab</a--></div>';
	$tab.append(
        $('<div class="tab-pane active" id="tab_content_'+id+'">'+closetab+'<p>'+tabContent+'</p></div>')
    );
}

function saveTab(uId, cId, tabName) {
var ret;
	$.ajax({
		type: 'POST',
		async: false,
		url: '/welcome/savetab/',
		data: 'uId='+uId+'&customerId='+cId,
		success: function (data) { 
			ret = data=='true';
		}          
	});
 	return ret;
}

function openCustomer(uId,cId) {
	if($('li[data='+cId+']').length){
		//remove all active
		var $nav=$('.nav');
		$nav.find('li').removeClass('active');
		var $tab=$('.tab-content');
		$tab.find('.tab-pane').removeClass('active');
		//set active
		$('#tab_'+cId). addClass("active");
		$("#tab_content_"+cId).addClass("active");
		//alert(cId);
	return;
	}
	$.ajax({
		url: '/customers/getcustomer/'+cId+'/',
		dataType : "json",
		success: function (data) {
			var stRes = saveTab(uId, cId, 'customer');
			if(stRes) {
				 addNewTab(cId, data.customer.name, data.details);
			}
		}               
	});
}

function loadUserTabs(uId, cId) {
	$.ajax({
		url: '/customers/getcustomer/'+cId+'/',
		dataType : "json",
		success: function (data) { 
			addNewTab(cId, data.customer.name, data.details);
		}               
	});
}

function openUserTabs(jTabs, uId) {
	if(jTabs == null) {
		console.log('tabs is null');
	} else {
		console.log(jTabs);
		customersIds = jTabs.customer;
		var length = customersIds.length;
		for (var i = 0; i < length; i++) {
			loadUserTabs(uId,customersIds[i]);
		}
	}
}

function closeTab(cId) { 
	var $tab = $("#tab_"+cId).remove();
	$("#tab_content_"+cId).remove();
	$('#tab_dashboard'). addClass("active");
	$("#tab_dashboard_content"  ).addClass("active");
}

function closeCustomer(cId) {
	a = cId.split('_');
	if(a[0] == 'search') {
		$("#tab_"+cId).remove();
		$("#tab_content_"+cId).remove();
		$('#tab_dashboard'). addClass("active");
		$("#tab_dashboard_content"  ).addClass("active");
	} else {
		$.ajax({
			type: 'POST',
			async: false,
			url: '/welcome/removetab/',
			data: 'cId='+cId,
			success: function (data) {  
				closeTab(cId);
			}          
		});
	}
}

function reloadCustomer(uId, cId) {
	closeCustomer(cId);
	openCustomer(uId,cId);
}

function openModal(template, variable, title) {
	$.ajax({
		type: 'POST',
		async: false,
		url: '/customers/loadmodal/',
		data: 'template='+template+'&variable='+variable,
		success: function (data) {  
			$('#myModalLabel').text(title);
			$('#modal-body').html(data);
			$('#myModal').modal('show');
		}          
	});
}

function saveReferrals(cId) {
	for (var i = 1; i <= 9; i++) {
		var phone = $('#ref_phone_'+cId+'_'+i).val();
		var name = $('#ref_name_'+cId+'_'+i).val();
		var relation = $('#ref_relation_'+cId+'_'+i).val();
		var state = $('#ref_state_'+cId+'_'+i).val();
		var sex = $('#ref_sex_'+cId+'_'+i).val();
		var ref_cId = $('#ref_cId_'+cId+'_'+i).val();
		//console.log(phone);console.log(name);alert('cl');
		
		if( (phone.length<1) && (name.length<1) ) {
			console.log('phone & name is empty');
			updateReferralBlock(cId);
			return;
		}
		$.ajax({
			type: 'POST',
			async: false,
			url: '/customers/savereferral/',
			data: 'cId='+cId+'&ref_cId='+ref_cId+'&phone='+phone+'&name='+name+'&relation='+relation+'&state='+state+'&sex='+sex, 
			success: function (data) {
				//updateReferralBlock(cId);
				console.log('save referrals JS: '+data);
			}          
		});
	}
}

function addMoreReferalFields(cId) {
	//referralSectionBlockTr_
	for (var i = 1; i <= 8; i++) {
		var idd = 'referralSectionBlockTr_'+cId+'_'+i;
		//alert(idd);
		$('#'+idd).show();
	}
}

function updateReferralBlock(cId) {
	$.ajax({
		type: 'POST',
		async: false,
		url: '/customers/getreferrals/',
		data: 'cId='+cId,
		success: function (data) {
			$("#referralSectionBlock_"+cId).html(data);
		}          
	});
}

function loadCustomerDetailsBlock(cId) {
	$.ajax({
		type: 'POST',
		async: false,
		dataType : "json",
		url: '/customers/getcustomerdetailsblock/',
		data: 'cId='+cId,
		success: function (data) {
			$("#customerDetailsBlock_"+cId).html(data.html);
		}          
	});
}

function closeModal() {
	$('#myModal').modal('hide');
}



function trySearch() {
	searchText = $('#searchText').val();
	searchLeadStatus = $('#searchLeadStatus').val();
	searchQuality = $('#searchQuality').val();
	searchLastCalled = $('#searchLastCalled').val();
	var randomnumber=Math.floor(Math.random()*11);
	$.ajax({
		type: 'POST',
		async: false,
		//dataType : "json",
		url: '/welcome/trysearch/',
		data: 'searchText='+searchText+'&searchLeadStatus='+searchLeadStatus+'&searchQuality='+searchQuality+'&searchLastCalled='+searchLastCalled,
		success: function (data) {
			addNewTab('search_'+randomnumber, 'search: '+searchText, data);
			//alert(data.html);
		}          
	});
}

function saveCustomerService(cId) {
		status = $('#ServiceStatus_'+cId).val();
		sId = $('#ServiceOffered_'+cId).val();
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
	
function saveCustomerDetails(cId) {
		name = $('#cd_name_'+cId).val();
		state = $('#cd_state_'+cId).val();
		sex = $('#cd_sex_'+cId).val();
		qual = $('#cd_quality_'+cId).val();
		address = $('#cd_address_'+cId).val();
		notes = $('#cd_notes_'+cId).val();
		$.ajax({
			type: 'POST',
			async: false,
			data: 'cId='+cId+'&name='+name+'&state='+state+'&sex='+sex+'&quality='+qual+'&address='+address+'&notes='+notes,
			url: '/customers/savedetails/',
			success: function (data) {
				console.log(data);
				//closeModal();
				loadCustomerDetailsBlock(cId);
			}          
		});
	}
	
function updateCustomerPhonesBlock(cId) {
	$.ajax({
			type: 'POST',
			async: false,
			dataType : "json",
			data: 'cId='+cId,
			url: '/customers/getcustomerphones/',
			success: function (data) {
				$('#customerPhonesBlock_'+cId).html(data.html);
			}          
		});
}	
	
function savePhoneNumber(cId) {
	num = $('#new_phone_'+cId).val();
	$.ajax({
		type: 'POST',
		url: '/customers/savephone/',
		data: 'num='+num+'&cId='+cId,
		success: function (data) {  
			updateCustomerPhonesBlock(cId);
		}          
	});
}

function openLeadStatusEdit(lsId) {
	ht = '<select id="select_'+lsId+'"><option selected="selected">-- Select --</option><option value="brand new">BRAND NEW</option><option value="working lead">Working Lead</option><option value="good lead">GOOD Lead</option><option value="bad lead">BAD Lead</option><option value="not interested">Not Interested</option><option value="callback">Call Back</option><option value="do not call">Do Not Call</option><option value="sale made">SALE MADE</option></select>';
	$('#'+lsId).html(ht);
	$('#select_'+lsId).change(function() {
		arrWId = lsId.split('_'); //
		value = $('#select_'+lsId).val();
		$.ajax({
			type: 'POST',
			url: '/customers/editleadstatus/',
			data: '&lsId='+arrWId[2]+'&newStatus='+value,
			success: function (data) {  
				if(data == 'true') {
					$('#'+lsId).html(value);
				}else {
					alert('Could not edit status.');
				}
			}          
		});
	});
}

function tryToFindUser(num, fIdPattern) {
	//oldHtml = $('#ref_phf_'+fIdPattern).html();
	$.ajax({
		type: 'POST',
		async: true,
		dataType : "json",
		url: '/customers/getcustomersbynumber/',
		data: '&num='+num,
		success: function (data) {
			if(data !== 'false') {
				results = data.results;
				len = results.length;
				selectHtml = '<select id="ref_phs_'+fIdPattern+'">';
				selectHtml += '<option selected="selected">Select</option>';
				selectHtml += '<option value="0">NEW CUSTOMER</option>';
				for (var i = 0; i < len; i++) {
					selectHtml += '<option value="'+results[i].cDetails.id+'">'+results[i].cDetails.name+'</option>';
				}
				selectHtml += '</select>';
				$('#ref_phf_'+fIdPattern).html(selectHtml);

				var narr;
				$('#ref_phs_'+fIdPattern).change(function(){
					val = $('#ref_phs_'+fIdPattern).val();
					//
					if(val == '0') {
						$('#ref_phf_'+fIdPattern).html('<input type="text" value="" id="ref_name_'+fIdPattern+'">');
					} else {
						//
						for (var i = 0; i < len; i++) { //find needed id of array
							if(results[i].cDetails.id == val) {
								narr = i;
							}
						}
						console.log(results[narr]);
						$('#ref_phone_'+fIdPattern).val(results[narr].phone);
						$('#ref_name_'+fIdPattern).val(results[narr].cDetails.name);
						$('#ref_state_'+fIdPattern).val(results[narr].cDetails.state);
						$('#ref_sex_'+fIdPattern).val(results[narr].cDetails.sex);
						$('#ref_cId_'+fIdPattern).val(results[narr].cDetails.id);
						//
						$('#ref_phf_'+fIdPattern).html('<input type="text" value="" id="ref_name_'+fIdPattern+'">');
						$('#ref_name_'+fIdPattern).val(results[narr].cDetails.name);
					}
				});
			}
			//
		}          
	});
	
}

function tryReports(){
	searchLeadStatus = $('#searchLeadStatus').val();
	searchQuality = $('#searchQuality').val();
	searchLastCalled = $('#searchLastCalled').val();
	var randomnumber=Math.floor(Math.random()*12);
	$.ajax({
		type: 'POST',
		async: false,
		url: '/welcome/tryreports/',
		data: 'leadStatus='+searchLeadStatus+'&quality='+searchQuality+'&lastCalled='+searchLastCalled,
		success: function (data) {
			addNewTab('search_'+randomnumber, 'report: '+randomnumber, data);
			//alert(data.html);
		}          
	});
}

function changePhoneNumber(numId) {
	val = $('#customerPhonesBlockEditNumberVal_'+numId).html();
	//iHtml = '<td><strong>Phone : </strong></td><td><a href="#" onClick="changePhoneNumber('+numId+');">'+val+'</a></td>';
	iHtml = '<td><strong>Phone : </strong></td><td><input type="text" id="customerPhonesBlockEditNumberNewVal_'+numId+'" value="'+val+'"><button type="button"  class="btn btn-link" onClick="editPhoneNumber('+numId+');">Save</button></td>';
	$('#customerPhonesBlockEditNumber_'+numId).html(iHtml);
}

function editPhoneNumber(numId) {
	newVal = $('#customerPhonesBlockEditNumberNewVal_'+numId).val();
	$.ajax({
		type: 'POST',
		async: false,
		url: '/customers/editphonenumber/',
		data: 'numId='+numId+'&newVal='+newVal,
		success: function (data) {
			if(data == 'true') {
				var cId = $('#tabs li.active ').attr('data');
				updateCustomerPhonesBlock(cId);
			} else {
				alert('Could not change number');
			}
		}          
	});
}

function validatePhoneNumer(phone, pnPattern) {
	//console.log(pnPattern);
	var a=false;
	$.ajax({
		type: 'POST',
		async: true,
		url: '/welcome/validatephonenumber/',
		data: 'phone='+phone,
		success: function (data) {
			if(data == 'false') {
				a = false;
				$('#'+pnPattern).css("border-color","red");
				$('#'+pnPattern).flash(1000, 4);
			} else {
				a = true;
				$('#'+pnPattern).css("border-color","green");
			}
		}          
	});
	return a;
}

$(document).ready(function() {

});