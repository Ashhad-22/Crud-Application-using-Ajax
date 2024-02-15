<?php
require("require/connection.php");

if (isset($_GET['action']) && $_GET['action'] == "show_form" ) { ?>
	
		<fieldset style="width: 50%;">
			<legend>Add User</legend>
				
			<table>
				<tr>
					<th>First Name :</th>
					<td><input type="text" id="first_name"></td>
				</tr>
				<tr>
					<th>Last Name :</th>
					<td><input type="text" id="last_name"></td>
				</tr>
				<tr>
					<th>Email :</th>
					<td><input type="email" id="email"></td>
				</tr>
				<tr>
					<th>Address:</th>
					<td>
						<textarea id="address"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<button onclick="addUser()">Add User</button>
						<button onclick="reset()">Reset</button>
					</td>
				</tr>
			</table>
		</fieldset>
	
<?php }
elseif (isset($_POST['action']) && $_REQUEST['action'] == "add_user") {
	// echo "<pre>";
	//  print_r($_POST);
	// echo "</pre>";
	extract($_POST);

	 $query = "INSERT INTO user (first_name,last_name,email,address) VALUES('{$first_name}','{$last_name}','{$email}','{$address}')";

	 $result = mysqli_query($connect,$query);

	 if ($result) {
	 	
	 	  echo "<h2 style='color:green;'> User Record Added Successfully!...</h2>";
	 }
}
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'show_users') {
	
	$query = "SELECT * FROM user ORDER BY user_id DESC";

	$result = mysqli_query($connect,$query);

	if ($result->num_rows>0) { ?>
		
			<table border="1" style="width: 100%;text-align: center;">
				<tr>
					<th>S.No</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
		<?php $count = 0; 
		    while ($row = mysqli_fetch_assoc($result)) {?>

				<tr>
					<td><?php echo ++$count; ?></td>
					<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
					<td><?php echo $row['email'];?></td>
					<td><?php echo $row['address'];?></td>
					<td>
						<button id="edit" onclick="editUser(<?php echo $row['user_id']; ?>)">Edit</button>
						<button id="delete" onclick="deleteUser(<?php echo $row['user_id']; ?>)">Delete</button>
					</td>
				</tr>
			

	 <?php	} ?>
			</table>
	<?php }
	else{

		echo "<h1 style='color:red;'>Sorry No User Record Found!...</h1>";
	}
}
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete_user') {
	
	// echo $_REQUEST['user_id'];
	$query = "DELETE FROM user WHERE user_id=".$_REQUEST['user_id'];
	$result = mysqli_query($connect,$query);

	if ($result) {
		
		echo "<h2 style='color:green;'>User Record With User Id ".$_REQUEST['user_id']." Deleted Successfully!...;</h2>";
	}
}

elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_user') {
	// echo $_REQUEST['user_id'];
	$query = "SELECT * FROM user WHERE user_id=".$_REQUEST['user_id'];

	$result = mysqli_query($connect,$query);

	if ($result->num_rows>0) {
		
		$row = mysqli_fetch_assoc($result);

		// echo "<pre>";
		//  print_r($row);
		// echo "</pre>";
		?>
		<fieldset style="width: 50%;">
			<legend>Update User</legend>
			
			<table>
				<tr>
					<th>First Name :</th>
					<td><input type="text" id="first_name" value="<?php echo $row['first_name']; ?>"></td>
				</tr>
				<tr>
					<th>Last Name :</th>
					<td><input type="text" id="last_name" value="<?php echo $row['last_name']; ?>"></td>
				</tr>
				<tr>
					<th>Email :</th>
					<td><input type="email" id="email" value="<?php echo $row['email']; ?>"></td>
				</tr>
				<tr>
					<th>Address:</th>
					<td>
						<textarea id="address"><?php echo $row['address'];?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<button onclick="updateUser(<?php echo $row['user_id'];?>)">Update User</button>
						<button onclick="reset()">Reset</button>
					</td>
				</tr>
			</table>
		</fieldset>


	<?php }
}
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_user') {
	
	// echo "<pre>";
	//  print_r($_POST);
	// echo "</pre>";
	extract($_POST);
	$query = "UPDATE user SET first_name='{$first_name}',last_name='{$last_name}',email='{$email}',address='{$address}' WHERE user_id=".$user_id;

	$result = mysqli_query($connect,$query);
	if ($result) {
		
		echo "<h2 style='color:green;'>User Record With User Id ".$user_id." Updated Successfully!...</h2>";
	}
}

?>