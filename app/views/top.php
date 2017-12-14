<!DOCTYPE html>
<html>

<!-- The common navigation bar for all pages -->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-beta.1.css" type="text/css">
  <link rel="stylesheet" href="/css/sass.css" type="text/css">
  <title>RentMyThing</title>
</head>

<style type="text/css">
</style>
<body>
<div id="contactdiv">
  <a href="/Profile/contactUs" class="btn btn-danger" role="button">Need Help?</a>
</div>

  <nav id="navbar" class="navbar navbar-expand-md bg-primary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="/Listings"><i class="fa d-inline fa-lg fa-adjust"></i><b>&nbsp;RentMyThing</b></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false"
        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
        
        <ul class="navbar-nav">
           <li class="dropdown">
 <a data-toggle="dropdown" href="#" class="btn navbar-btn ml-2 text-white btn-secondary dropdown-toggle"><span id="notifCount" class="badge badge-light"></span></i> Notifications</a>    

          <ul id='view_ajax2' style="padding-left: 5px; padding-right: 5px; background-color: #e9ecef; overflow-x:hidden; overflow-y: scroll;" class="dropdown-menu ">
          
          </ul>


<script type="text/javascript">
var lastId = 0;

//Get a users new notifications in an ajax request
function getNotifications() {
  $.getJSON({
    type: "GET",
    url: "/Notifications/getNotifs/" + lastId
  }, function( data )
  {
    var jsonLength = data.length;
    var html = "";
    if(jsonLength == 0){
      if(lastId == 0){
        document.getElementById("view_ajax2").innerHTML = "<div class='text-center'><b>No notifications</b></div>";
        document.getElementById("notifCount").innerHTML = 0;
      }
    } else {
        //Display the new notifications
        document.getElementById("view_ajax2").innerHTML = "";
        if(lastId == 0){
          document.getElementById("notifCount").innerHTML = jsonLength;
        }
        for (var i = 0; i < jsonLength; i++) {
          var message = data[i];
          html = "<li style='padding-top:5px; margin-left:5px;'></li><form method='post' action='/Notifications/deleteNotif'><input id='notifId' name='notifId' type='hidden' value="+message.id+"/><input id='redirect' name='redirect' type='hidden' value='"+message.redirect+"'/><button class='btn notification' type='submit'>"+message.content+"</button></form>" + html;
        }
        var lastNotif = data[data.length - 1];
        lastId = lastNotif.id; //Update the last id value
        html = "<div style='' class='text-center'><b><i>Newest First</i></b><p onclick='clearNotifications()' class='openChat' style='display:inline; float:right !important; margin-right: 10px;'>Clear</p></div>" + html;
      $('#view_ajax2').append(html);
    }
  });
}
getNotifications();

  //Clear a user's notifications (mark them as all viewed)
  function clearNotifications(){
    $.ajax({
		  type: "GET",
		  url: "/Notifications/clearNotifs"
    }).done(function (data){
      lastId = 0;
      document.getElementById("view_ajax2").innerHTML = "<div class='text-center'><b>No notifications</b></div>";
      document.getElementById("notifCount").innerHTML = 0;
	  });
  };

  //Set an interval for automatically fetching new notifications 
  var notifInterval = setInterval(function() { getNotifications(); }, 10000);
</script>

	   </li>
		<li class="nav-item">
            <a class="nav-link" href="/Listings"><i class="fa d-inline fa-lg fa-home"></i> Listings</a>
          </li>
      <li class="nav-item">
        <a class="nav-link" href="/Favorites"><i class="fa d-inline fa-lg fa-star-o"></i> Favorites</a>
      </li>
		  <li class="nav-item">
            <a class="nav-link" href="/Rentals"><i class="fa d-inline fa-lg fa-calendar-o"></i> Rentals</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="/Items"><i class="fa d-inline fa-lg fa-hdd-o"></i> Items</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="/Profile"><i class="fa d-inline fa-lg fa-user-o"></i> Profile</a>
          </li>
        </ul>
        <a href="/Login/logout" class="btn navbar-btn ml-2 text-white btn-secondary"><i class="fa d-inline fa-lg fa-sign-out"></i> Sign out</a>
      </div>
    </div>
  </nav>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
