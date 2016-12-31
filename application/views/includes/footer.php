<script type="text/javascript">
	$(document).ready(function(){
		// $('#messages').hide();
		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('manage/get_userDetails')?>",
			dataType: "json",			
			success : function (objResult) {
				$('#userData').html(objResult.userData);
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
					$('#messages').html(objResult.message);
				}


			}
		});
	});

	// $('.deleteUser').click(function () {
	// 	var a=$('this').val();
	// 	alert(a);
	// });

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

	function EditUser(id = null){
		$.ajax({

			type 	: "POST",
			url 	: "<?=site_url('manage/edit_userDetails/')?>"+id,
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




</script>