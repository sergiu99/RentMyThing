<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<br>
<form method="post" action="/Profile/search" class="form-inline" id="searchAction">
	<div class="form-group" id="searchForm">
		<label for="type">Search for &nbsp;</label>
        <select class="form-control" id="type" name="type" onchange="selectChange()">
			<option value="users">Users</option>
			<option value="listings">Listings</option>
		</select>&nbsp;&nbsp;with keyword&nbsp;
		<input style="margin-left: 10px;" type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword"/>
</div>
<div class="form-group">
<input style="margin-left: 10px;" type="submit" class="btn btn-default" name="submit" value='Search'/>
</div>
</form>
<br><h2>Users</h2><br>
</br>
	<?php
	$count = count($data['users']);
	if($count > 0){
		echo "<table class='table table-striped'>
				<tr>
					<th>Name</th>
					<th>Joined On</th>
					<th>Listings posted</th>
					<th>Phone Number</th>
					<th>Address</th>
					<th>Postal Code</th>
				</tr>";
		foreach($data['users'] as $user){
			echo "<tr><td><a href='/Profile/viewUser/$user->id'>$user->display_name</a></td>";
			echo "<td>$user->join_date</td>";
			echo "<td>$user->count</td>";
			if($user->phone_number == ""){
				echo "<td>Not Available</td>";
			}else{
				echo "<td>$user->phone_number</td><tr>";
			}
			$address = "";
			if($user->street_address != ""){
				$address = $user->street_address;
			}
			if($address == ""){
				$address ==  $user->city_address . ', ' . $user->province_address;
			}else{
				$address .=  ', ' . $user->city_address . ', ' . $user->province_address;
			}
			echo "<tr><td>$user->postal_code_address</td>";
		}
		echo "</table>";
	}else{
		echo "<h3>No users were found!</h3>";
	}
	?>
</div>
</body>

<script type="text/javascript">
	var categories = "<?php 
						$categories = "";
						foreach($data['categories'] as $aCategory){
							$categories .= "<option value='$aCategory->name'>$aCategory->name</option>";
						}
						echo $categories;
					?>";
	function selectChange(){
		if(document.getElementById("type").value == "listings"){
			console.log(document.getElementById("searchAction").action);
			document.getElementById("searchAction").action="/Listings/search";
			document.getElementById("searchForm").innerHTML="<label for='type'>Search for &nbsp;</label>";
			document.getElementById("searchForm").innerHTML+="<select class='form-control' id='type' name='type' onchange='selectChange()'><option value='listings'>Listings</option><option value='users'>Users</option></select>&nbsp;&nbsp;with keyword&nbsp;";
			document.getElementById("searchForm").innerHTML+="<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>&nbsp;&nbsp;in&nbsp;&nbsp;";
			var selectCategoryList = "<select class='form-control' id='category' name='category'><option disabled selected>Category</option>" + categories + "</select>";
			document.getElementById("searchForm").innerHTML+= selectCategoryList;
		}else{
			document.getElementById("searchForm").innerHTML='';
			document.getElementById("searchAction").action="/Profile/search";
			document.getElementById("searchForm").innerHTML="<label for='type'>Search for &nbsp;</label>";
			document.getElementById("searchForm").innerHTML+="<select class='form-control' id='type' name='type' onchange='selectChange()'><option value='users'>Users</option><option value='listings'>Listings</option></select>&nbsp;&nbsp;with keyword&nbsp;";
			document.getElementById("searchForm").innerHTML+="<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>";
		}
	}
</script>

</html>