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

<<<<<<< HEAD
          <ul id='view_notifications' class="dropdown-menu ">

=======
          <ul id='view_ajax2' style="padding-left: 5px; padding-right: 5px; background-color: #e9ecef;" class="dropdown-menu ">
          
>>>>>>> 618bac8034801ced7417765c1897fcfc8a6aa0e1
          </ul>


<script type="text/javascript">


function getNotifications() {
  $.getJSON({
    type: "GET",
    url: "/Notifications/getNotifs"
<<<<<<< HEAD
  }).done( function( data )
=======
  }, function( data )
>>>>>>> 618bac8034801ced7417765c1897fcfc8a6aa0e1
  {
    console.log(data);
    var jsonLength = data.length;
    var html = "";
    //onsole.log(jsonLength+"  IS THE SIZE");
    if(jsonLength == 0){
      html = "<div class='text-center'><b>No notifications</b></div>";
    } else {
       
    for (var i = 0; i < jsonLength; i++) {
      var message = data[i];

<<<<<<< HEAD
        html = "<li class='list-group-item '><a class='submit-link' href=" + message.redirect + ">"+message.content+"</a></li><form method='post' action='/Rentals/Action'><form method='post' action='/Rentals/Action'><input id='notifId' name='notifId' type='hidden' value="+message.id+"/></form>" + html;
=======
        html = "<li style='padding-top:5px; margin-left:5px;'></li><form method='post' action='/Notifications/deleteNotif'><input id='notifId' name='notifId' type='hidden' value="+message.id+"/><input id='redirect' name='redirect' type='hidden' value="+message.redirect+"/><button class='btn' style='color:white; background-color: #007bff;' type='submit'>"+message.content+"</button></form>" + html;
>>>>>>> 618bac8034801ced7417765c1897fcfc8a6aa0e1
     
      }
       html = "<div style='' class='text-center'><b><i>Newest First</i></b></div>" + html;
      }
    //console.log(html);
<<<<<<< HEAD
    $('#view_notifications').append(html);
=======
    
    $('#view_ajax2').append(html);
>>>>>>> 618bac8034801ced7417765c1897fcfc8a6aa0e1
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
