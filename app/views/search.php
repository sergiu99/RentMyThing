<br>


<script type="text/javascript">
	var marker = null;
	var map;
	var markerPC;
	var geocoder;
	
	function initMap(){
		map = new google.maps.Map(document.getElementById('mapDiv'), {
    		zoom: 11,
    		center: {lat: 45.480999, lng: -73.652415}
  		});

		map.addListener('click', function(event){
			placeMarker(event.latLng);
		});
		geocoder = new google.maps.Geocoder;	
		if(marker != null){
			marker = new google.maps.Marker({
        		position: marker.getPosition(), 
        		map: map
    		});
		}
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
		document.getElementById("locationString").value = postalCodeValue;
		var splitPostalCode = postalCodeValue.split(" ");
		postalCodeValue = splitPostalCode[0] + splitPostalCode[1];
		$.ajax({
			type: "GET",
			url: "http://api.geonames.org/findNearbyPostalCodesJSON?postalcode=" + postalCodeValue + "&country=CA&radius=4&username=rentmything",
     		dataType: "json"
		}).done(function (data){
			var results = "";
			for(var i = 0; i < data.postalCodes.length - 1; i ++){
				results += data.postalCodes[i].postalCode + "-";
			}
			results += data.postalCodes[data.postalCodes.length - 1].postalCode;
			document.getElementById("locations").value = results;
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
		if(!initialToggle){
			initMap();
			initialToggle = true;
		}
	}

	function clearSelection(){
		if(marker != null){
			marker.setMap(null);
			marker = null;
			var toggleHtml = document.getElementById("locationButton").innerHTML;
			var spanHtml = toggleHtml.substring(toggleHtml.indexOf("&nbsp;"));
			if(spanHtml == "&nbsp;<i class=\"fa d-inline fa-lg fa-chevron-down\"></i>"){
				spanHtml = "&nbsp;<i class='fa d-inline fa-lg fa-chevron-up'></i>";
			}else{
				spanHtml = "&nbsp;<i class='fa d-inline fa-lg fa-chevron-down'></i>";
			}
			toggleHtml = "choose location" + spanHtml;
			document.getElementById("locationButton").innerHTML = toggleHtml;
			document.getElementById("locations").value = "";
			document.getElementById("locationString").value = "";
		}
	}
</script>


<form method='post' action='/Listings/search' class='form-inline' id='searchAction'>
	<div class='form-group' id='searchForm'>
		<label for='type'>Search for &nbsp;</label>
		<select class='form-control' id='type' name='type' onchange='selectChange()'>
			<option value='listings'>Listings</option>
			<option value='users'>Users</option>
		</select>&nbsp;&nbsp;with keyword&nbsp;
	<?php
			if(isset($data['keyword']) && $data['keyword'] != ""){
				$keyword = $data['keyword'];
				echo "<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' value='$keyword'/>&nbsp;&nbsp;in&nbsp;&nbsp;";				
			}else{
				echo "<input style='margin-left: 10px;' type='text' class='form-control' name='keyword' id='keyword' placeholder='Keyword'/>&nbsp;&nbsp;in&nbsp;&nbsp;";				
			}

			echo "<select class='form-control' id='category' name='category'>";
			if(isset($data['category']) && $data['category'] != ""){
				$category = $data['category'];
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
			
			echo "<input name='locations' id='locations' value='' hidden/><input name='locationString' id='locationString' value='' hidden/>";
			echo "</select>";
			if(isset($data['location']) && $data['location'] != ""){
				$location = $data['location'];
				echo "&nbsp;&nbsp;near&nbsp;&nbsp;<button type='button' id='locationButton' class='form-control btn-primary' data-toggle='collapse' data-target='#searchMapDiv' onclick='clickMapToggle();'/>$location&nbsp;<i class='fa d-inline fa-lg fa-chevron-down'></i></button><script>getNearbyPostalCodes(\"$location\"); console.log('UPDATED')</script>";								
			}else{
				echo "&nbsp;&nbsp;near&nbsp;&nbsp;<button type='button' id='locationButton' class='form-control btn-primary' data-toggle='collapse' data-target='#searchMapDiv' onclick='clickMapToggle()'/>choose location&nbsp;<i class='fa d-inline fa-lg fa-chevron-down'></i></button>";				
			}
	?>
</div>
<div class="form-group">
<input style="margin-left: 10px;" type="submit" class="btn btn-default" name="submit" value='Search'/>
</div>
</form></br>

<div id="searchMapDiv" class="collapse">
	<h6>Click on the map to select a location&nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-primary" onclick="clearSelection()" value="Clear Selection"/></h6>
	<div id="mapDiv">
	
	</div>
</div>

<script type="text/javascript">
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
	function selectChange(){
		if(document.getElementById("type").value == "listings"){
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