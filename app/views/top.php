<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
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
      <a class="navbar-brand" href="/Listings"><i class="fa d-inline fa-lg fa-cloud"></i><b>&nbsp;RentMyThing</b></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false"
        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
        
        <ul class="navbar-nav">
           <li class="dropdown">
 <a data-toggle="dropdown" href="#" class="btn navbar-btn ml-2 text-white btn-secondary dropdown-toggle"><i class="fa d-inline fa-lg fa-flash"></i> Notifications</a>    

          <ul id='view_ajax' class="dropdown-menu">

          </ul>


<script type="text/javascript">


function getNotifications() {
  $.ajax({
    type: "GET",
    url: "/Notifications/getNotifs"
  }).done( function( data )
  {
    console.log(data);
    var messages = JSON.parse(data);
    messages = JSON.parse(messages);
    mesages = messages;
    var jsonLength = messages.results.length;
    var html = "";
    for (var i = 0; i < jsonLength; i++) {
      var message = messages.results[i];

        html += "<li><a href="+ message.redirect + ">"+message.content+"</a></li>";
     
    }
    //console.log(html);
    $('#view_ajax').append(html);
  });
}
getNotifications();
</script>

	   </li>
		<li class="nav-item">
            <a class="nav-link" href="/Listings"><i class="fa d-inline fa-lg fa-bookmark-o"></i> Listings</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="/Rentals"><i class="fa d-inline fa-lg fa-bookmark-o"></i> Rentals</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="/Items"><i class="fa d-inline fa-lg fa-bookmark-o"></i> Items</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="/Profile"><i class="fa d-inline fa-lg fa-bookmark-o"></i> Profile</a>
          </li>
        </ul>
        <a href="/Login/logout" class="btn navbar-btn ml-2 text-white btn-secondary"><i class="fa d-inline fa-lg fa-sign-out"></i> Sign out</a>
      </div>
    </div>
  </nav>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
