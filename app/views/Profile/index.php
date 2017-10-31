<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<h1>Your Profile</h1>
<br>

<form method="POST" action="/Profile/save">
  <div class="form-group">
    <label for="display_name">Display Name:</label>
    <?php
      $user = $data['user'];
      echo "<input type='text' class='form-control' id='display_name' name='display_name' value='$user->display_name' required>";
    ?>
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
      echo "<input type='text' class='form-control' id='city_address' name='city_address' value='$user->city_address'>";
    ?>
  </div>
  <div class="form-group">
    <label for="province_address">Province:</label>
    <?php
      echo "<input type='text' class='form-control' id='province_address' name='province_address' value='$user->province_address'>";
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
          echo "<input type='checkbox' name ='show_phone'>";
        }else{
          echo "<input type='checkbox' name ='show_phone' checked>";
        }
      ?>Show Phone Number</label>
  </div>
  <div class="checkbox">
    <label>
      <?php
        if($user->show_email == 0){
          echo "<input type='checkbox' name ='show_email'>";
        }else{
          echo "<input type='checkbox' name ='show_email' checked>";
        }
      ?> Show Email Address</label>
  </div>
  <div class="checkbox">
    <label>
    <?php
        if($user->show_address == 0){
          echo "<input type='checkbox' name ='show_address'>";
        }else{
          echo "<input type='checkbox' name ='show_address' checked>";
        }
    ?> Show Street Address</label>
  </div>
  <h6>Change Your Password: </h6>
  <div class="form-group">
    <label for="old_password">Old Password:</label>
    <input type="text" class="form-control" id="old_password" name="old_password">
  </div>
  <div class="form-group">
    <label for="new_password">New Password:</label>
    <input type="text" class="form-control" id="new_password" name="new_password">
  </div>
  <div class="form-group">
    <label for="confirm_password">Confirm New Password:</label>
    <input type="text" class="form-control" id="confirm_password" name="confirm_password">
  </div>
  <button type="submit" class="btn btn-default">Save Changes</button>
</form>
</body>
</html>