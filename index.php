<!DOCTYPE html>
<html>
<head>
	<title>Crud Application Using Ajax</title>
	<style type="text/css">
		th{
			font-size: 20px;

		}
		#delete{
			background-color: red;
			color: white;
			padding: 10px;
			border-radius: 10px;
			font-weight: bold;
		}
		#edit{
			background-color: blue;
			color: white;
			padding: 10px;
			border-radius: 10px;
			font-weight: bold;
		}
	</style>
	<script type="text/javascript">
		// alert("ok");
		setInterval(function(){
			document.getElementById("message").innerHTML = "";
			showUsers();
		},5000);

		showForm();
		showUsers();
	/*-----<< Show Form >>-----*/
		function showForm(){
			var obj;
			if (window.ActiveXObject) {
				obj = new ActiveXObject('Microsoft.XMLHTTP');
			}else{
				obj = new XMLHttpRequest();
			}

			obj.onreadystatechange = function(){

				if (obj.readyState == 4 && obj.status == 200) {
					document.getElementById('show_form').innerHTML = obj.responseText;
				}
			}

			obj.open("GET","ajax_process.php?action=show_form");
			obj.send();
		}
	/*-----<< Reset Form >>-----*/
	    function reset(){
	    	 document.getElementById("first_name").value = "";
			 document.getElementById("last_name").value = "";
			 document.getElementById("email").value = "";
			 document.getElementById("address").value = "";
	    }
    /*-----<< Add User >>-----*/
		function addUser(){

			var first_name = document.getElementById("first_name").value;
			var last_name  = document.getElementById("last_name").value;
			var email      = document.getElementById("email").value;
			var address    = document.getElementById("address").value;

			// document.write(first_name+" "+last_name+" "+email+" "+address);
			if (first_name == "" || last_name == "" || email == "" || address == "") {

				return document.getElementById('message').innerHTML = "<span style='color:red'> *All Fields Are Required...<span>";
			}	
			var obj;
			if (window.ActiveXObject) {
				obj = new ActiveXObject('Microsoft.XMLHTTP');
			}else{
				obj = new XMLHttpRequest();
			}

			obj.onreadystatechange = function(){

				if (obj.readyState == 4 && obj.status == 200) {
					document.getElementById('message').innerHTML = obj.responseText;
					reset();
					showUsers();
					// console.log(obj.responseText);
				}
			}

			obj.open("POST","ajax_process.php");
			obj.setRequestHeader("content-type","application/x-www-form-urlencoded");
			obj.send("action=add_user&first_name="+first_name+"&last_name="+last_name+"&email="+email+"&address="+address);
		}
	/*-----<< Show Users >>-----*/
		function showUsers(){
			var obj;
			if (window.ActiveXObject) {
				obj = new ActiveXObject('Microsoft.XMLHTTP');
			}else{
				obj = new XMLHttpRequest();
			}

			obj.onreadystatechange = function(){

				if (obj.readyState == 4 && obj.status == 200) {
					document.getElementById('show_users').innerHTML = obj.responseText;
				}
			}

			obj.open("GET","ajax_process.php?action=show_users");
			obj.send();
		}
	/*-----<< Delete User >>-----*/
		function deleteUser(user_id){

			var flag = confirm("Are Sure Want To Delete User Record With User Id "+user_id);
			if (!flag) {
				return 1;
			}

			var obj;
			if (window.ActiveXObject) {
				obj = new ActiveXObject('Microsoft.XMLHTTP');
			}else{
				obj = new XMLHttpRequest();
			}

			obj.onreadystatechange = function(){

				if (obj.readyState == 4 && obj.status == 200) {
					document.getElementById('message').innerHTML = obj.responseText;
					// console.log(obj.responseText);
					showUsers();
				}
			}

			obj.open("POST","ajax_process.php");
			obj.setRequestHeader("content-type","application/x-www-form-urlencoded");
			obj.send("action=delete_user&user_id="+user_id);
		}
	/*-----<< Edit User >>-----*/
		function editUser(user_id){

			// alert(user_id);
			// return 1;

			var obj;
			if (window.ActiveXObject) {
				obj = new ActiveXObject('Microsoft.XMLHTTP');
			}else{
				obj = new XMLHttpRequest();
			}

			obj.onreadystatechange = function(){

				if (obj.readyState == 4 && obj.status == 200) {
					document.getElementById('show_form').innerHTML = obj.responseText;
					// console.log(obj.responseText);

				}
			}

			obj.open("POST","ajax_process.php");
			obj.setRequestHeader("content-type","application/x-www-form-urlencoded");
			obj.send("action=edit_user&user_id="+user_id);
		}
	/*-----<< Update User >>-----*/
		function updateUser(user_id){

		    var first_name = document.getElementById("first_name").value;
			var last_name  = document.getElementById("last_name").value;
			var email      = document.getElementById("email").value;
			var address    = document.getElementById("address").value;

			var obj;
			if (window.ActiveXObject) {
				obj = new ActiveXObject('Microsoft.XMLHTTP');
			}else{
				obj = new XMLHttpRequest();
			}

			obj.onreadystatechange = function(){

				if (obj.readyState == 4 && obj.status == 200) {
					document.getElementById('message').innerHTML = obj.responseText;
					// console.log(obj.responseText);
					showUsers();
					showForm();

				}
			}

			obj.open("POST","ajax_process.php");
			obj.setRequestHeader("content-type","application/x-www-form-urlencoded");
			obj.send("action=update_user&user_id="+user_id+"&first_name="+first_name+"&last_name="+last_name+"&email="+email+"&address="+address);
		}
	
		
	</script>
</head>
<body>
<center>
	<h1 style="text-align: center;background-color: black;color: white;width: 50%;padding: 10px;border-radius: 5px;">~Crud Application Using Ajax~</h1>
	<div id="message"></div>
	<div id="show_form"></div><br/>
	<div id="show_users"></div>
	</center>

</body>
</html>