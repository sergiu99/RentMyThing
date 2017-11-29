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
			echo "&nbsp;&nbsp;near&nbsp;&nbsp;<button type='button' id='locationButton' class='form-control btn-primary' data-toggle='collapse' data-target='#searchMapDiv' onclick='clickMapToggle()'/>choose location&nbsp;<i class='fa d-inline fa-lg fa-chevron-down'></i></button>";
			echo "<input name='location' id='location' value='' hidden/>";
	?>
</div>
<div class="form-group">
<input style="margin-left: 10px;" type="submit" class="btn btn-default" name="submit" value='Search'/>
</div>
</form></br>

<div id="searchMapDiv" class="collapse">
	<h6>Click on the map to select a location</h6>
	<div id="mapDiv">
	
	</div>
</div>

<script type="text/javascript">
	//http://www.geonames.org/export/web-services.html#findNearbyPostalCodes
	var marker;
	var map;
	var markerPC;
	var geocoder;
	
	function initMap(){
		map = new google.maps.Map(document.getElementById('mapDiv'), {
    		zoom: 5,
    		center: {lat: 45.731, lng: -73.997}
  		});

		map.addListener('click', function(event){
			console.log("map click");
			placeMarker(event.latLng);
		});
		geocoder = new google.maps.Geocoder;
	}

	function placeMarker(latlng) {
		if(marker != null){
			marker.setMap(null);
		}
    	marker = new google.maps.Marker({
        	position: latlng, 
        	map: map
    	});
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
				var searchAddressComponents = results[0].address_components,
    				searchPostalCode="";

				$.each(searchAddressComponents, function(){
    				if(this.types[0]=="postal_code"){
        				searchPostalCode=this.short_name;
					}
				});
				var toggleHtml = document.getElementById("locationButton").innerHTML;
				var spanHtml = toggleHtml.substring(toggleHtml.indexOf("&nbsp;"));
              	document.getElementById("locationButton").innerHTML = searchPostalCode + spanHtml;
			  	getNearbyPostalCodes(searchPostalCode);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Invalid location');
          }
        });
	}

	function getNearbyPostalCodes(postalCodeValue){
		var splitPostalCode = postalCodeValue.split(" ");
		postalCodeValue = splitPostalCode[0] + splitPostalCode[1];
		console.log(postalCodeValue);
		$.ajax({
			type: "GET",
			url: "http://api.geonames.org/findNearbyPostalCodesJSON?postalcode=" + postalCodeValue + "&country=CA&radius=3&username=rentmything",
     		dataType: "json"
		}).done(function (data){
			console.log(data);
			var results = "";
			for(var i = 0; i < data.postalCodes.length - 1; i ++){
				results += data.postalCodes[i].postalCode + "-";
			}
			results += data.postalCodes[data.postalCodes.length - 1].postalCode;
			document.getElementById("location").value = results;
		});
	}

	function clickMapToggle(){
		var toggleHtml = document.getElementById("locationButton").innerHTML;
		var buttonText = toggleHtml.substring(0, toggleHtml.indexOf("&nbsp;"));
		var spanHtml = toggleHtml.substring(toggleHtml.indexOf("&nbsp;"));
		if(spanHtml == "&nbsp;<i class=\"fa d-inline fa-lg fa-chevron-down\"></i>"){
			spanHtml = "&nbsp;<i class='fa d-inline fa-lg fa-chevron-up'></i>";
		}else{
			spanHtml = "&nbsp;<i class='fa d-inline fa-lg fa-chevron-down'></i>";
		}
		toggleHtml = buttonText + spanHtml;
		document.getElementById("locationButton").innerHTML = toggleHtml;
	}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9J8N8owe_ytoIftmgjWsYonoqfRTD7oc&callback=initMap"></script>

<br><h2>Your Favorites</h2><br>
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
		echo "<h3>You have no favorites!</h3>";
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