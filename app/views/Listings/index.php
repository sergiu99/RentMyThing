<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container" onload="initMap">
<br>
	<?php
			echo "<form method='post' action='/Listings/search' class='form-inline' id='searchAction'>
					<div class='form-group' id='searchForm'>
						<label for='type'>Search for &nbsp;</label>";
			echo "<select class='form-control' id='type' name='type' onchange='selectChange()'>
					<option value='listings'>Listings</option>
					<option value='users'>Users</option>
				</select>&nbsp;&nbsp;with keyword&nbsp;";

			$keyword = $data['keyword'];
			if($keyword != ""){ 
				echo "<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='$keyword'/>&nbsp;&nbsp;in&nbsp;&nbsp;";
			}else{
				echo "<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>&nbsp;&nbsp;in&nbsp;&nbsp;";
			}

			echo "<select class='form-control' id='category' name='category'>";
			$category = $data['category'];
			if($category != ""){
				echo "<option disabled>Category $category</option>";
				foreach($data['categories'] as $aCategory){
					if($aCategory->name == $category){
						echo "<option value='$aCategory->name' selected>$aCategory->name</option>";
					}else{
						echo "<option value='$aCategory->name'>$aCategory->name</option>";
					}
				}
			}else{
				echo "<option disabled selected>Category</option>";
				foreach($data['categories'] as $aCategory){
					echo "<option value='$aCategory->name'>$aCategory->name</option>";
				}
			}
			echo "</select>";
			echo "&nbsp;&nbsp;near&nbsp;<input type='button' class='form-control' data-toggle='collapse' data-target='#searchMapDiv' value='location V'/>";
	
	?>
</div>
<div class="form-group">
<input style="margin-left: 10px;" type="submit" class="btn btn-default" name="submit" value='Search'/>
</div>
</form></br>

<div id="searchMapDiv" class="collapse">
	<div id="mapDiv">
	
	</div>
</div>

<script type="text/javascript">
	//http://www.geonames.org/export/web-services.html#findNearbyPostalCodes
	var marker;
	var map;
	function initMap(){
		map = new google.maps.Map(document.getElementById('mapDiv'), {
    		zoom: 8,
    		center: {lat: 40.731, lng: -73.997}
  		});

		map.addListener('click', function(event){
			console.log("map click");
			placeMarker(event.latLng);
		});
	}

	function placeMarker(location) {
		if(marker != null){
			marker.setMap(null);
		}
    	marker = new google.maps.Marker({
        	position: location, 
        	map: map
    	});
	}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9J8N8owe_ytoIftmgjWsYonoqfRTD7oc&callback=initMap"></script>

<br><h2>Listings</h2><br>
	<?php
	if(count($data['items']) > 0){
		echo "<table class='table table-striped'>
				<tr>
					<th>Name</th>
					<th>Image</th>
					<th>Description</th>
					<th>Price/Day</th>
					<th>Category</th>
					<th>Postal Code</th>
					<th>Rating</th>
					<th>Action</th>
				</tr>";
		foreach($data['items'] as $item){
			echo "<tr><td>$item->name</td>";
			echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
			echo "<td>$item->description</td>";
			echo "<td>$ $item->price</td>";
			echo "<td>$item->category</td>";
			$postalcode = strtoupper ($item->postal_code);
			echo "<td>$postalcode</td>";	
			echo "<td>$item->rating</td>";
			echo "<td><a href='/Listings/viewItem/$item->id'>View</a></td>";
		}
		echo "</table>";
	}else{
		echo "<h3>No listings were found!</h3>";
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