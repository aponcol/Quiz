$(document).ready(function () {
	
});
function PostToWall(id,user_token) {
	var message = $(id).val();
	var data = "message="+message+"&user_token="+user_token; 
	$.ajax  ({
		type: "POST",
		data: data,
		url: "PostMessage.php",
		async: false,
		success: function (msg) {
			alert(msg);
		},
		error: function (xhr) {
			alert(xhr.responseText);
		}
	});
	return false;
}

function validate(formCheck) {
                    //var emailtest=formCheck.email.value;
                   var password = hex_sha1(formCheck.password.value);
                   var email = formCheck.email.value;
				   var data = "email="+email+"&password="+password;
				   var connection_token = $('#connection_token').val();
				   if (connection_token=="") { RetrieveIDFromEmail(email);}
				   else {
				   $.ajax  ({
						type: "POST",
						data: data,
						url: "/php_access.php",
						async: false,
						success: function (msg) {
							if(msg=="success") {
								window.location.href="index.php?connection_token="+connection_token;
							} else { alert(msg); }
						},
						error: function (xhr) {
							alert(xhr.responseText);
						}
					});
				}
}
function register(formCheck) {
	var errCount = 0;
	$('input[type="text"]').each(function() {
		if($(this).val()== "") {
			errCount++;
		}
	});
	$('input[type="password"]').each(function() {
		if($(this).val()== "") {
			errCount++;
		}
	});
	$('input[type="email"]').each(function() {
		if($(this).val()== "") {
			errCount++;
		}
	});
	if (errCount==0) {
		var password = hex_sha1($('#password').val());
		data = "username="+$('#username').val()+"&favteam="+$('#favteam').val()+"&user_token="+$('#user_token').val()+"&email="+$('#email').val()+"&password="+password;
		$.ajax  ({
			type: "POST",
			data: data,
			url: "/registerToDB.php",
			async: false,
			success: function (msg) {
				alert("You are now registered!");
				window.location.href="index.php?connection_token="+$('#connection_token').val();
			},
			error: function (xhr) {
				alert(xhr.responseText);
			}
		});
		
	} else {
		alert("Please fill out all the fields");
	}
	return false;
}

function RetrieveIDFromEmail(email) {
		$.ajax  ({
			type: "GET",
			data: "email="+email,
			url: "RetrieveID.php",
			async: false,
			success: function (msg) {
				if(msg!="error") {
					window.location.href="index.php?id="+msg;
				} else { alert(msg);}
			},
			error: function (xhr) {
				alert(xhr.responseText);
			}
		});
		return false;
}

function Logoff() {
		$.get("logoff.php", function(){window.location.href="index.php";});
		return false;
	}
