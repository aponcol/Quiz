function validate(formCheck) {
                    //var emailtest=formCheck.email.value;
                   var passwordnew = hex_sha1(formCheck.password.value);
                   var emailinput = formCheck.email.value;
				   if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                   } 
                   else {
                        // code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                   }
				   xmlhttp.onreadystatechange=function()   {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200)   {
                                document.getElementById("login").innerHTML=xmlhttp.responseText;
                        }
                   }
					
				   xmlhttp.open("GET","http://aponcol.co.cc/php_access.php?email="+emailinput+"&password="+passwordnew,true);
                   xmlhttp.send();


}
				   

