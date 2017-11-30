<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">

<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/search.php'); ?>

<h2>Users</h2>
</br>
	<?php
	$count = count($data['users']);
	if($count > 0){
		echo "<table class='table table-striped'>
				<tr>
					<th>Name</th>
					<th>Joined On</th>
					<th>Listings Posted</th>
					<th>Phone Number</th>
					<th>Address</th>
					<th>Postal Code</th>
				</tr>";
		foreach($data['users'] as $user){
			echo "<tr><td><a href='/Profile/viewUser/$user->id'>$user->display_name</a></td>";
			echo "<td>$user->join_date</td>";
			echo "<td>$user->count</td>";
			if($user->phone_number == "" || $user->show_phone == 0){
				echo "<td>Not Available</td>";
			}else{
				echo "<td>$user->phone_number</td>";
			}
			$address = "";
			if($user->street_address == "" || $user->show_address == 0){
				$address = "Not Available";
			}else{
				$address = $user->street_address;
			}
			if($address == ""){
				$address ==  $user->city_address . ', ' . $user->province_address;
			}else{
				$address .=  ', ' . $user->city_address . ', ' . $user->province_address;
			}
			echo "<td>$address</td>";
			echo "<td>$user->postal_code_address</td></tr>";
		}
		echo "</table>";
	}else{
		echo "<h3>No users were found!</h3>";
	}
	?>
</div>
</body>

</html>