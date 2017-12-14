<br>

<!-- The common search bar for the Listings and Favorites pages -->
<script type="text/javascript">
	var marker = null;
	var map;
	var markerPC;
	var geocoder;
	var initialToggle = false;
	
	//Initiate the map 
	function initMap(){
		//Set the map view
		map = new google.maps.Map(document.getElementById('mapDiv'), {
    		zoom: 11,
    		center: {lat: 45.480999, lng: -73.652415}
  		});
		
		map.addListener('click', function(event){
			placeMarker(event.latLng);
		});
		geocoder = new google.maps.Geocoder;	
		//Reset the marker if existing
		if(marker != null){
			marker = new google.maps.Marker({
        		position: marker.getPosition(), 
        		map: map
    		});
		}
	}

	//Place a marker on the map at the specified coordinates 
	function placeMarker(latlng) {
		//Reset the existing marker
		if(marker != null){
			marker.setMap(null);
		}
    	marker = new google.maps.Marker({
        	position: latlng, 
        	map: map
    	});
		//Get the postal code corresponding to the marker coordinates using Google Maps Geocoding
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
				//Get the address postal code
				var searchAddressComponents = results[0].address_components,
    				searchPostalCode="";

				$.each(searchAddressComponents, function(){
    				if(this.types[0]=="postal_code"){
        				searchPostalCode=this.short_name;
					}
				});
				//Set the postal code values on the page
				var toggleHtml = document.getElementById("locationButton").innerHTML;
				var spanHtml = toggleHtml.substring(toggleHtml.indexOf("&nbsp;"));
              	document.getElementById("locationButton").innerHTML = searchPostalCode + spanHtml;
			  	getNearbyPostalCodes(searchPostalCode);
            } else {
              window.alert('No results found');
            }
          } else {
			  //If geocoding fails
            window.alert('Invalid location');
          }
        });
	}

	//Retrieves the postal code in a radius of the provided parameter with the Geonames API
	//The API restricts the number of postal codes returned to 5 for a free account. 
	//A large radius in a dense area will not return all included postal codes.
	//A large radius in a lower density area might return less than 5.
	//To change from the default radius parameter (4km), change the radius value, then select a location
	function getNearbyPostalCodes(postalCodeValue){
		//Retrieve the marker address and radius value
		document.getElementById("locationString").value = postalCodeValue;
		var splitPostalCode = postalCodeValue.split(" ");
		postalCodeValue = splitPostalCode[0] + splitPostalCode[1];
		var radius = document.getElementById("radius").value;
		//Set an appropriate radius vaue (roughly convert to miles, API supports max 30)
		if(radius == "" || radius < 0) {
			radius = 1;
		} else {
			radius = Math.round(radius / 1.609);
			if(radius < 1){
				radius = 1;
			}else{
				if(radius > 15) {
					radius = 15;
				}
			}
		}
		//Get nearby postal codes with an ajax call to the API.
		$.ajax({
			type: "GET",
			url: "http://api.geonames.org/findNearbyPostalCodesJSON?postalcode=" + postalCodeValue + "&country=CA&radius=" + radius + "&username=rentmything",
     		dataType: "json"
		}).done(function (data){
			//Process the JSON data
			var results = "";
			for(var i = 0; i < data.postalCodes.length - 1; i ++){
				results += data.postalCodes[i].postalCode + "-";
			}
			//Set the value of the hidden locations input field to the processed result
			results += data.postalCodes[data.postalCodes.length - 1].postalCode;
			document.getElementById("locations").value = results;
		});
	}

	//Changes the chevron icon on the map collapse toggle
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
		//If the map has not yet been initialized
		if(!initialToggle){
			initMap();
			initialToggle = true;
		}
	}

	//Clear the user's location selection
	function clearSelection(){
		//Reset the marker
		if(marker != null){
			marker.setMap(null);
			marker = null;
		}
		//Reset the location values in the search form
		var toggleHtml = document.getElementById("locationButton").innerHTML;
		var spanHtml = toggleHtml.substring(toggleHtml.indexOf("&nbsp;"));
		spanHtml = "&nbsp;<i class='fa d-inline fa-lg fa-chevron-up'></i>";
		toggleHtml = "choose location" + spanHtml;
		document.getElementById("locationButton").innerHTML = toggleHtml;
		document.getElementById("locations").value = "";
		document.getElementById("locationString").value = "";
	}
</script>

	<?php
		if($data['type'] == "Listings"){
			//Show the form to search for listings
			echo "<form method='get' action='/Listings/search' class='form-inline' id='searchAction'>
					<div class='form-group' id='searchForm'>
						<label for='type'>Search for &nbsp;</label>";
			echo "<select class='form-control' id='type' name='type' onchange='selectChange()'>
					<option value='listings'>Listings</option>
					<option value='users'>Users</option>
				</select>&nbsp;&nbsp;with keyword&nbsp;";
			//Set the value of the keyboard field
			if(isset($data['keyword']) && $data['keyword'] != ""){
				$keyword = $data['keyword'];
				echo "<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' value='$keyword'/>&nbsp;&nbsp;in&nbsp;&nbsp;";				
			}else{
				echo "<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>&nbsp;&nbsp;in&nbsp;&nbsp;";				
			}
			//Set the values of the category select list
			echo "<select class='form-control' id='category' name='category'>";
			if(isset($data['category']) && $data['category'] != ""){
				$category = $data['category'];
				echo "<option disabled>Category</option>";
				echo "<option value='All'>All</option>";
				foreach($data['categories'] as $aCategory){
					if($aCategory->name == $category){
						echo "<option value='$aCategory->name' selected>$aCategory->name</option>";
					}else{
						echo "<option value='$aCategory->name'>$aCategory->name</option>";
					}
				}
			}else{
				echo "<option disabled selected>Category</option>";
				echo "<option value=''>All</option>";
				foreach($data['categories'] as $aCategory){
					echo "<option value='$aCategory->name'>$aCategory->name</option>";
				}
			}
			
			//Set the value of the location input
			echo "<input name='locations' id='locations' value='' hidden/><input name='locationString' id='locationString' value='' hidden/>";
			echo "</select>";
			if(isset($data['location']) && $data['location'] != ""){
				$location = $data['location'];
				echo "&nbsp;&nbsp;near&nbsp;&nbsp;<button type='button' id='locationButton' class='form-control btn-primary' data-toggle='collapse' data-target='#searchMapDiv' onclick='clickMapToggle();'/>$location&nbsp;<i class='fa d-inline fa-lg fa-chevron-down'></i></button>";								
			}else{
				echo "&nbsp;&nbsp;near&nbsp;&nbsp;<button type='button' id='locationButton' class='form-control btn-primary' data-toggle='collapse' data-target='#searchMapDiv' onclick='clickMapToggle()'/>choose location&nbsp;<i class='fa d-inline fa-lg fa-chevron-down'></i></button>";				
			}
		}else{
			//Show the form to search for users
			echo "<form method='get' action='/Profile/search' class='form-inline' id='searchAction'>
					<div class='form-group' id='searchForm'>
						<label for='type'>Search for &nbsp;</label>";
			echo "<select class='form-control' id='type' name='type' onchange='selectChange()'>
					<option value='listings'>Listings</option>
					<option value='users' selected>Users</option>
				</select>&nbsp;&nbsp;with keyword&nbsp;";
			//Set the value of the keyword field 
			if(isset($data['keyword']) && $data['keyword'] != ""){
				$keyword = $data['keyword'];
				echo "<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' value='$keyword'/>";				
			}else{
				echo "<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>";				
			}
		}
	?>
</div>
<div class="form-group">
	<input style="margin-left: 10px;" type="submit" class="btn btn-default" name="submit" value='Search'/>
</div>
</form></br>

<!-- Container for the collapsible map -->
<div id="searchMapDiv" class="collapse">
	<h6>
		Find listings inside a &nbsp;
		<input type="number" id="radius" value="4" max="15" min="1" class="form-control" style="width:70px; display:inline;"/>&nbsp;&nbsp;km radius.&nbsp;&nbsp;
		Click on the map to select a location.&nbsp;&nbsp;
		<input type="button" class="btn btn-primary" onclick="clearSelection()" value="Clear Selection"/>
		<?php
			//Get the nearby location if a search location already exists
			if(isset($data['location'])){
				echo "<script>getNearbyPostalCodes(\"$location\");</script>";
			}
		?>
	</h6>
	<div id="mapDiv">
	
	</div>
</div>

<script type="text/javascript">
	//initialize the map when first toggled
	$('#searchMapDiv').on('shown.bs.collapse', function() {
		if(!initialToggle){
			initMap();
		}
	});

	var categories = "<?php 
						$categories = "";
						foreach($data['categories'] as $aCategory){
							$categories .= "<option value='$aCategory->name'>$aCategory->name</option>";
						}
						echo $categories;
					?>";

	//Change the search form type from Listings to Users or Users to Listings
	function selectChange(){
		if(document.getElementById("type").value == "listings"){
			//Set the form to listings search
			if(marker != null){
				marker.setMap(null);
				marker = null;
			}
			document.getElementById("searchAction").action="/Listings/search";
			document.getElementById("searchForm").innerHTML="<label for='type'>Search for &nbsp;</label>";
			document.getElementById("searchForm").innerHTML+="<select class='form-control' id='type' name='type' onchange='selectChange()'><option value='listings'>Listings</option><option value='users'>Users</option></select>&nbsp;&nbsp;with keyword&nbsp;";
			document.getElementById("searchForm").innerHTML+="<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>&nbsp;&nbsp;in&nbsp;&nbsp;";
			var selectCategoryList = "<select class='form-control' id='category' name='category'><option disabled selected>Category</option>" + categories + "</select>";
			document.getElementById("searchForm").innerHTML+= selectCategoryList;
            document.getElementById("searchForm").innerHTML+= "&nbsp;&nbsp;near&nbsp;&nbsp;<button type='button' id='locationButton' class='form-control btn-primary' data-toggle='collapse' data-target='#searchMapDiv' onclick='clickMapToggle()'/>choose location&nbsp;<i class='fa d-inline fa-lg fa-chevron-down'></i></button>";
			document.getElementById("searchForm").innerHTML+= "<input name='locations' id='locations' value='' hidden/><input name='locationString' id='locationString' value='' hidden/>";
		}else{
			//Set the form to users search
			document.getElementById("searchMapDiv").className = "collapse";
			document.getElementById("searchForm").innerHTML='';
			document.getElementById("searchAction").action="/Profile/search";
			document.getElementById("searchForm").innerHTML="<label for='type'>Search for &nbsp;</label>";
			document.getElementById("searchForm").innerHTML+="<select class='form-control' id='type' name='type' onchange='selectChange()'><option value='users'>Users</option><option value='listings'>Listings</option></select>&nbsp;&nbsp;with keyword&nbsp;";
			document.getElementById("searchForm").innerHTML+="<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>";
		}
	}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9J8N8owe_ytoIftmgjWsYonoqfRTD7oc">//&callback=initMap</script>