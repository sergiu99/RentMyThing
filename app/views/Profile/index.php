<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
</br><h1>Your Profile</h1>
<form method="POST" action="/Profile/save" id="profileForm">
  <div class="form-group">
    <label for="display_name">Display Name:</label>
    <?php
      $user = $data['user'];
      echo "<input type='text' class='form-control' id='display_name' name='display_name' value='$user->display_name'>";
    ?>
    <div id="name_feedback" class="form-control-feedback"></div>
  </div>
  <div class="form-group">
    <label for="first_name">First Name:</label>
    <?php
      echo "<input type='text' class='form-control' id='first_name' name='first_name' value='$user->first_name'>";
    ?>
  </div>
  <div class="form-group">
    <label for="last_name">Last Name:</label>
    <?php
      echo "<input type='text' class='form-control' id='last_name' name='last_name' value='$user->last_name'>";
    ?>
  </div>
  <div class="form-group">
    <label for="display_name">Joined On:</label>
    <?php
      echo "<input type='text' class='form-control' id='join_date' name='join_date' value='$user->join_date' readonly>";
    ?>
  </div>
  <div class="form-group">
  <h6>Your Contact Information</h6>
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <?php
      echo "<input type='email' class='form-control' id='email' name='email' value='$user->email' required>";
    ?>
    <div id="email_feedback" class="form-control-feedback"></div>
  </div>
  <div class="form-group">
    <label for="phone_number">Phone Number:</label>
    <?php
      echo "<input type='text' class='form-control' id='phone_number' name='phone_number' value='$user->phone_number'>";
    ?>
  </div>
  <div class="form-group">
    <label for="street_address">Street Address:</label>
    <?php
      echo "<input type='text' class='form-control' id='street_address' name='street_address' value='$user->street_address'>";
    ?>
  </div>
  <div class="form-group">
  <div class="form-group">
    <label for="city_address">City:</label>
    <?php
      echo "<input type='text' class='form-control' id='city_address' name='city_address' value='$user->city_address' required>";
    ?>
  </div>
  <div class="form-group">
    <label for="province_address">Province:</label>
    <select class="form-control" name="province_address" required="true" id="province_address" class="select_province">
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
    <?php
      $selectedProvince = $user->province_address;
      echo "<script>$('#province_address').val('$selectedProvince');</script>";
    ?>
  </div>
  <div class="form-group">
    <label for="postal_code_address">Postal Code:</label>
    <?php
      echo "<input type='text' class='form-control' id='postal_code_address' name='postal_code_address' value='$user->postal_code_address' required>";
    ?>
  </div>
  <h6>Your Privacy Settings</h6>
  <div class="checkbox">
    <label>
      <?php
        if($user->show_phone == 0){
          echo "<input type='checkbox' name ='show_phone' id='show_phone'>";
        }else{
          echo "<input type='checkbox' name ='show_phone' id='show_phone' checked>";
        }
      ?>Show Phone Number</label>
  </div>
  <div class="checkbox">
    <label>
      <?php
        if($user->show_email == 0){
          echo "<input type='checkbox' name ='show_email' id='show_email'>";
        }else{
          echo "<input type='checkbox' name ='show_email' id='show_email' checked>";
        }
      ?> Show Email Address</label>
  </div>
  <div class="checkbox">
    <label>
    <?php
        if($user->show_address == 0){
          echo "<input type='checkbox' name ='show_address' id='show_address'>";
        }else{
          echo "<input type='checkbox' name ='show_address' id='show_address' checked>";
        }
    ?> Show Street Address</label>
  </div>
  <h6>Change Your Password: </h6>
  <div class="form-group">
    <label for="old_password">Old Password:</label>
    <input type="password" class="form-control" id="old_password" name="old_password">
  </div>
  <div class="form-group">
    <label for="new_password">New Password:</label>
    <input type="password" class="form-control" id="new_password" name="new_password">
  </div>
  <div class="form-group">
    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
  </div>
  <button type="submit" class="btn btn-default" id="submit_button">Save Changes</button>
</form>
<a href="/Profile/deleteAccount" class="btn btn-danger pull-right" style="">Delete Account</a>

<script>
  //Validate the form server-side
  $('#profileForm').submit(function() {
    resetErrors();
    var data = {};
    //Get the input values
    $.each($('form input, form select'), function(i, v) {
      if (v.type !== 'submit') {
        if(v.id == "show_phone" || v.id == "show_email" || v.id == "show_address"){
          data[v.name] = v.checked;
        }else{
          data[v.name] = v.value;
        }
      }
    });
    console.log(data);
    $.ajax({
          type: 'POST',
          url: "/Profile/validateProfileChanges?callback=?",
          data: data,
          success: function(resp) {
              resp = JSON.parse(resp);
              if (resp === true) {
                  	//successful validation
                    window.location = "/Profile"
              } else {
                  //validation failed, set error hints
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

  //Reset form errors
  function resetErrors() {
      $('form input, form select').removeClass('inputTxtError');
      $('label.error').remove();
  }
</script>

</body>
</html>