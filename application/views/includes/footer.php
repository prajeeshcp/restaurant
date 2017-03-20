<script type="text/javascript">
	$(document).ready(function(){
		// $('#messages').hide();
		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('manage/get_userDetails')?>",
			dataType: "json",			
			success : function (objResult) {
				$('#userData').html(objResult.userData);
				// $.each(objResult.userGroups,function(index,value){
				// 	//alert(index+":"+value);
				// });

			}
		});

		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('manage/editUserProfile/')?>",
			dataType: "json",			
			success : function (objResult) {
				//$('#myModalListUsers').modal('hide');				
				$('#myModalEditProfileBody').html(objResult.userData);
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
		
		var user_name 		= 	$('#user_name').val();
		var current_pass 	= 	$('#current_pass').val();
		var new_password 	= 	$('#new_password').val();
		var con_password 	= 	$('#con_password').val();

		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('auth/change_password')?>",
			dataType: "json",
			data 	: {'user_name':user_name,'current_pass':current_pass,'new_password':new_password,'con_password':con_password},
			success : function (objResult) {
				if (objResult.message_type == 'danger') {
					$('#changePasswordMessages').show();
					$('#changePasswordMessages').html(objResult.message);
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
			url 	: "<?=site_url('manage/edit_userDetails/')?>"+id,
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




</script>