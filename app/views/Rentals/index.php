<?php  include($_SERVER['DOCUMENT_ROOT'] . '/app/views/top.php'); ?>
<div class="container">
<br>
<h1>Rentals</h1>

<br>

<div class="container-fluid">
	<div class="row">

<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#home">Renting from others</a>
  </li>
  <li class="nav-item">
    <a class="nav-link"  data-toggle="tab" href="#menu2">Renting to others</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Proposals to you</a>
  </li>
</ul>

<br>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
  	<br>
 <h3>Items that you are renting from others</h3>

<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Total Price</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Status</th>
		<th>Action</th>
		<th></th>
	</tr>
	
		
	<?php
	foreach($data['myRentals'] as $item){
		

echo "		<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$item->status</td>";
		echo "<td><a href='/Rentals/chat/$item->id'>Chat</a></td>";

        echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='complete'/>";
		echo "<td><button class='btn btn-default'  type='submit'>Complete</button></td></tr>";
		echo "</form>";
		
	}
	?>
</table>
  </div>
  <div id="menu1" class="tab-pane fade">
  	<br>
			<h3>Item rental proposals to you</h3>
<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Total Price</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Status</th>
		<th>Action</th>
		<th></th>
		<th></th>
	</tr>
	
	<?php
	foreach($data['myRentalProposals'] as $item){
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$item->status</td>";
		echo "<td><a href='/Rentals/chat/$item->id'>Chat</a></td>";

		echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='accept'/>";
		echo "<td><button class='btn btn-default' type='submit'>Accept</button></td>";
		echo "</form>";

	    echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='delete'/>";
		echo "<td><button class='btn btn-default' type='submit'>Decline</button></td></tr>";
		echo "</form>";
	}
	?>
</table>
  </div>
  <div id="menu2" class="tab-pane fade">
  	<br>
			<h3>Items that you are renting to others</h3>
			<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Image</th>
		<th>Description</th>
		<th>Total Price</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Status</th>
		<th>Action</th>
		<th></th>
	</tr>
	
	<?php
	foreach($data['getMyRentingItems'] as $item){
		echo "<tr><td>$item->name</td>";
		echo "<td><img src='/$item->image_path' width='100' height='100'></td>";
		echo "<td>$item->description</td>";
		echo "<td>$ $item->total</td>";
		echo "<td>$item->start_date</td>";
		echo "<td>$item->end_date</td>";
		echo "<td>$item->status</td>";
		echo "<td><a href='/Rentals/chat/$item->id'>Chat</a></td>";       

		echo "<form method='post' action='/Rentals/Action'>";
        echo "<input id='rentalId' name='rentalId' type='hidden' value='$item->id'/>";
        echo "<input id='actionType' name='actionType' type='hidden' value='complete'/>";
		echo "<td><button class='btn btn-default'  type='submit'>Complete</button></td></tr>";
		echo "</form>";
	}
	?>
</table>
  </div>
</div>

		
</div>

</div>
</body>
</html>