<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-beta.1.css" type="text/css">
	<link rel="stylesheet" href="/css/sass.css" type="text/css">
	<script src="/js/bootstrap.js"></script>
</head>
<body>
<div class="container">
<h1>Register</h1>

<form method="post" action="/Login/validateSignup" class="form-horizontal" id="signupForm">
	<div class="form-group">
	<label for="first_name">First Name</label>
	<input type="text" class="form-control" name="first_name" id="first_name" />
	</div>
	<div class="form-group">
	<label for="last_name">Last Name</label>
	<input type="text" class="form-control" name="last_name" id="last_name" />
	</div>
	<div class="form-group">
	<label for="email">Email</label>
	<input type="text" class="form-control" name="email" id="email" required/>
	<div id="email_feedback" class="form-control-feedback"></div>
	</div>
	<div class="form-group">
	<label for="display_name">Display Name</label>
	<input type="text" class="form-control" name="display_name" id="display_name"/>
	<div id="name_feedback" class="form-control-feedback"></div>
	</div>
	<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" id="password" required/>
	</div>
	<div class="form-group">
	<label for="phone_number">Phone Number (Format: 999-999-9999)</label>
	<input type="text" class="form-control" name="phone_number" id="phone_number" />
	</div>
	<div class="form-group">
	<label for="street_address">Street Address</label>
	<input type="text" class="form-control" name="street_address" id="street_address" />
	</div>
	<div class="form-group">
	<label for="postal_code_address">Postal Code (Format: A1A1A1 or A1A 1A1)</label> 
	<input type="text" class="form-control" name="postal_code_address" id="postal_code_address" required/>
	</div>
	<div class="form-group">
	<label for="city_address">City</label>
	<input type="text" class="form-control" name="city_address" id="city_address" required/>
	</div>
	<div class="form-group">
	<label for="province_address">Province</label>
	<select class="form-control" name="province_address" required="true" id="province_address">
  		<option value="AB">AB</option>
  		<option value="BC">BC</option>
 		<option value="MB">MB</option>
  		<option value="NB">NB</option>
		<option value="NL">NL</option>
		<option value="NT">NT</option>
  		<option value="NS">NS</option>
 		<option value="NU">NU</option>
  		<option value="ON">ON</option>
		<option value="PE">PE</option>
		<option value="QC">QC</option>
  		<option value="SK">SK</option>
  		<option value="YT">YT</option>
	</select>
	</div>
	<div class="form-group">
	<input type="submit" class="btn btn-default" name="action" value="Register" id="submit_button"/>
	</form>
	<a href="/Login" class="btn btn-default" >Back to Login</a>
	</div>
<div>
</body>

<script>
  $('#signupForm').submit(function() {
    resetErrors();
    var data = {};
    $.each($('form input, form select'), function(i, v) {
      if (v.type !== 'submit') {
          data[v.name] = v.value;
      }
	  data["action"] = "submit";
    });
    console.log(data);
    $.ajax({
          type: 'POST',
          url: "/Login/validateSignup?callback=?",
          data: data,
          success: function(resp) {
              resp = JSON.parse(resp);
              console.log(resp);
              if (resp === true) {
                  	//successful validation
                    window.location = "/Login"
              } else {
                  $.each(resp, function(i, v) {
	                    console.log(i + " => " + v); // view in console for error messages
                      var msg = '<label class="error" for="'+i+'">'+v+'</label>';
                      $('input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
                  });
                  var keys = Object.keys(resp);
                  $('input[name="'+keys[0]+'"]').focus();
              }
              return false;
          },
          error: function(xhr, status, error) {
            console.log("readyState: " + xhr.readyState);
            console.log("responseText: "+ xhr.responseText);
            console.log("status: " + xhr.status);
            console.log("text status: " + status);
            console.log("error: " + error);
          }
      });
      return false;
  });

  function resetErrors() {
      $('form input, form select').removeClass('inputTxtError');
      $('label.error').remove();
  }
</script>


</html>