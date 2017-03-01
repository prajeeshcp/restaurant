<script type="text/javascript">
	$(document).ready(function(){
		// $('#messages').hide();
		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('manage/get_userDetails')?>",
			dataType: "json",			
			success : function (objResult) {
				$('#userData').html(objResult.userData);

             	options = '<option selected="selected" value="0">Select A Type</option>';

             	$.each(objResult.userGroups, function(index, value) {
             	  if(value["id"] != 1){
             	  	options = options + '<option value="' + value["id"] + '">' + value["name"] + '</option>';
             	  }	
                  
             	 });
              	closeSelect = '</select>';

              	selectHtml = options + closeSelect;
              	$( "#userType" ).html( selectHtml ); 
			}
		});
		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('manage/loadeditUserProfile/')?>",
			dataType: "json",			
			success : function (objResult) {
				//$('#myModalListUsers').modal('hide');				
				$('#myModalEditProfileBody').html(objResult.editUserData);
				//$('#myModalEdit').modal('show');	
				
			}			
		});

	});

	


	$('#register').click(function () {
		
		var firstName 	= 	$('#firstName').val();
		var lastName 	= 	$('#lastName').val();
		var userName 	= 	$('#userName').val();
		var phone 		= 	$('#phone').val();
		var password 	= 	$('#password').val();
		var confPassword= 	$('#confPassword').val();
		var email 		= 	$('#email').val();
		var address 	= 	$('#address').val();
		var userType	= 	$('#userType').val();

		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('auth/create_user')?>",
			dataType: "json",
			data 	: {'firstName':firstName,'lastName':lastName,'userName':userName,'phone':phone,'password': password, 'confpassword':confPassword,'email':email,'address':address,'userType':userType},
			success : function (objResult) {
				if (objResult.message_type == 'danger') {
					$('#messages').show();
					$('#messages').html(objResult.message);
				}

				if (objResult.message_type == 'success') {
					//$('#messages').show();
					$('#successMessages').show();
					$('#successMessages').html(objResult.message);
					$("#userData").append(objResult.userData);
					$('#myModalRegister').modal('hide');					
					$('#myModalListUsers').modal('show');
					
				}


			}
		});
	});


	$('#changePassword').click(function () {
		
		var user_email 		= 	$('#user_email').val();
		var current_pass 	= 	$('#current_pass').val();
		var new_password 	= 	$('#new_password').val();
		var con_password 	= 	$('#con_password').val();

		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('auth/change_password')?>",
			dataType: "json",
			data 	: {'user_email':user_email,'current_pass':current_pass,'new_password':new_password,'con_password':con_password},
			success : function (objResult) {
				if (objResult.message_type == 'danger') {
					$('#changePasswordMessages').show();
					$('#changePasswordMessages').html(objResult.message);
				}

				if (objResult.message_type == 'success') {
					//$('#messages').show();
					$('#changePasswordMessages').show();
					$('#changePasswordMessages').html(objResult.message);
				
					
				}


			}
		});
	});



	function deleteUser(id = null){
		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('auth/remove_user/')?>"+id,
			dataType: "json",			
			success : function (objResult) {
				if (objResult.message_type == 'success') {
					$('#successMessages').show();
					$('#successMessages').html(objResult.message);
					$('#td_id_'+id).closest('tr').remove();

				}

			}			
		});
	}

	function edit_userDetails(id = null){


		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('manage/loadEditUserDetails/')?>"+id,
			dataType: "json",			
			success : function (objResult) {
				$('#myModalListUsers').modal('hide');				
				$('#myModalEditBody').html(objResult.userData);
				$('#myModalEdit').modal('show');

					

				
			}			
		});
	}

	$('#editUser').click(function () {

		var user_id		=	$('#edituser_id').val();		
		var firstName 	= 	$('#editfirstName').val();
		var lastName 	= 	$('#editlastName').val();
		var userName 	= 	$('#edituserName').val();
		var phone 		= 	$('#editphone').val();
		//var password 	= 	$('#editpassword').val();
		//var confPassword= 	$('#editconfPassword').val();
		var email 		= 	$('#editemail').val();
		var address 	= 	$('#editaddress').val();
		var userType	= 	$('#edituserType').val();

		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('manage/edit_user')?>",
			dataType: "json",
			data 	: {'firstName':firstName,'lastName':lastName,'userName':userName,'phone':phone,'email':email,'address':address,'userType':userType,'user_id':user_id},
			success : function (objResult) {
				if (objResult.message_type == 'danger') {
					$('#editsuccessMessages').show();
					$('#editsuccessMessages').html(objResult.message);
				}

				if (objResult.message_type == 'success') {
					//$('#messages').show();
					$('#successMessages').show();
					$('#successMessages').html(objResult.message);
					$('#td_id_'+user_id).parent().replaceWith(objResult.userData);
					//("#userData").append(objResult.userData);
					$('#myModalEdit').modal('hide');					
					$('#myModalListUsers').modal('show');
					
				}


			}
		});
	});

	$('#editUserProfile').click(function () {

		var user_id		=	$('#editProfileuser_id').val();		
		var firstName 	= 	$('#editProfilefirstName').val();
		var lastName 	= 	$('#editProfilelastName').val();
		var userName 	= 	$('#editProfileuserName').val();
		var phone 		= 	$('#editProfilephone').val();		
		var email 		= 	$('#editProfileemail').val();
		var address 	= 	$('#editProfileaddress').val();
		

		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('manage/edit_user/')?>"+1,
			dataType: "json",
			data 	: {'firstName':firstName,'lastName':lastName,'userName':userName,'phone':phone,'email':email,'address':address,'user_id':user_id},
			success : function (objResult) {
				if (objResult.message_type == 'danger') {
					$('#editProfilesuccessMessage').show();
					$('#editProfilesuccessMessage').html(objResult.message);
				}

				if (objResult.message_type == 'success') {
					//$('#messages').show();
					$('#editProfilesuccessMessage').show();
					$('#editProfilesuccessMessage').html(objResult.message);
					// $('#td_id_'+user_id).parent().replaceWith(objResult.userData);
					// //("#userData").append(objResult.userData);
					// $('#myModalEdit').modal('hide');					
					// $('#myModalListUsers').modal('show');
					
				}


			}
		});
	});

	function print_bill_cashier(orderId=null) {
		// var orderId			= $('#order-id').val();
		// var kotId			= $('#kot-id').val(); 		
		if (orderId) {
			var dataString    	= "order_id="+orderId;
			$.ajax({ 
				type : "POST",
				url : "<?=site_url()?>manage/print_bill_cashier",
				data : dataString,
				dataType : 'html',
				cache : false, // (warning: this will cause a timestamp and will call the request twice)
				beforeSend : function() {
			// cog placed
			
					// $('#create-new').addClass('disabled');
					// $('#content').css({opacity : '0.5'});
					// 	// scroll up
					// 	$("html, body").animate({
					// 		scrollTop : 0
					// 	}, "fast");
				},
				success : function(data) {
					// $('#kot-details').html(data);
					// $('#create-new').removeClass('disabled');
					// $('.kot-button').removeClass('disabled');
					// $('#content').css({opacity : '1'});
					var divContents = $("#print_kot_div").html();
					var newWin = window.open('','print-window');
					newWin.document.open();
					newWin.document.write('<html><body onload="window.print()"><table>'+divContents+'</table></body></html>');
					newWin.document.close();
					setTimeout(function(){
						newWin.close();
					},10); 
					$('#processing_order_'+orderId).closest('tr').remove();
					if(data.success == true){ // if true (1)
					    setTimeout(function(){// wait for 2 secs(2)
					        location.reload(); // then reload the page.(3)
					    }, 2000); 
					}

				},
				error : function(xhr, ajaxOptions, thrownError) {
					container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4> <br>Or you are running this page from your hard drive. Please make sure for all ajax calls your page needs to be hosted in a server');
				},
				async : false
			});
		}
	}




</script>