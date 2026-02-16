<?php
session_start();
require_once('dbconnect.php');

if (!isset($_SESSION['admin'])) {
    header("Location: logout.php");
}

// Retrieve the documents from the MongoDB database
$collection = $db->Reservations;
$data = $collection->find();

// Convert the data to an array
$dataArray = iterator_to_array($data);

// Encode the array as JSON
$jsonData = json_encode($dataArray);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style(1).css">
	<link rel="stylesheet" href="neon.css">
	<link rel="stylesheet" href="slideshow.css">

    <title>Reservation Data</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
		html{
			overflow-x:visible!important;
		}
        table {
            border-collapse: collapse;
            width: 1300px;
			font-family: 'Tempus Sans ITC';
			font-size: 15px;
        }
		
		.board {
			margin-top:80px;
			margin-left: -90px;
		}
		
		th {
			font-family: 'ALgerian';
			font-size: 20px;
			background: url(images/sheldon.png);
/*			background-position: center;*/
/*			background-size: cover;*/
			
		}

        th, td {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #ddd;
			padding: 10px 5px;
        }

        tr:nth-child(even) {
            background: rgba(0,0,0,0.9) url(images/picture12.jpeg);   
			background-blend-mode: color-dodge;
			color: white;
        }
		 tr:nth-child(odd) {
			background: url(images/picture12.jpeg);        
		}
		
		.id{
			display: none;
		}
		
		.save-btn,
		.cancel-btn {
		  display: none;
		}
		
		button {
			font-family: papyrus;
			font-size: 13px;
		}
		
		.edit-btn {
			background: url(images/edit.png);
			background-position: center;
			background-size: cover;
			width: 30px;
			height: 25px;
			cursor: pointer;
		}
		
		.delete-btn {
			background: url(images/delete.png);
			background-position: center;
			background-size: cover;
			width: 25px;
			height: 23px;
			cursor: pointer;
		}
		
		.save-btn:hover, .cancel-btn:hover{
			background-color: darkslategrey;
			color: white;
			cursor: pointer;
		}
		
		input {
			background: pink;
			font-family: 'Tempus Sans ITC';
			font-size: 15px;
			padding: 5px 4px;
		}
    </style>
</head>
<body>
	<header>
		<div class="wrapper">
		<h1><a href="#" class="logo"><img src="icons/krab1.jpg" style="width: 70px; height: 70px; vertical-align: middle; position: fixed; top: 0;" alt="">The .. The Krusty Krab</a></h1>
		</div>
		<div id="menu-bar" class="fas fa-bars"></div>

		<nav class="navbar">
			<a href="AdminHome.php">home</a>
			<a href="AdminMenuPage.php">menu</a>
			<a href="#">Reservation</a>
			<a href="adminReview.php">Review</a>
			<a href="logout.php">Logout</a>
			<a href="AdminProfile.php"><img width="20px" height="20px" style="width: 50px; height: 50px; vertical-align: middle; position: fixed; top: 8px;" src="images/mrkrabsmoneybag.webp"></a>
		</nav>

	</header>
    <section class="board">
		<div id="my-table"></div>
	</section>
<script>
    $(document).ready(function() {
        // Retrieve the JSON data from the PHP script
        var jsonData = <?php echo $jsonData; ?>;

        // Create a new table element
        var table = $('<table>');

        // Create a header row for the table
        var headerRow = $('<tr>');
        headerRow.append($('<th>').text('Full Name'));
        headerRow.append($('<th>').text('Email'));
        headerRow.append($('<th>').text('Phone'));
        headerRow.append($('<th>').text('Date'));
        headerRow.append($('<th>').text('Start Time'));
        headerRow.append($('<th>').text('End Time'));
        headerRow.append($('<th>').text('Guest#'));
        headerRow.append($('<th>').text('Comments'));
        headerRow.append($('<th>').text('createdAt'));
        headerRow.append($('<th>').text('Actions'));
        table.append(headerRow);

        // Loop through each document and create a row for the table
        $.each(jsonData, function(index, doc) {
            var row = $('<tr>');
            row.append($('<td class="edit id" data-id="' + doc._id.$oid + '">').text(doc._id.$oid));
            row.append($('<td class="edit fullName">').text(doc.fullName));
            row.append($('<td class="edit email">').text(doc.email));
            row.append($('<td class="edit phone">').text(doc.phone));
            row.append($('<td class="edit date">').text(doc.date));
            row.append($('<td class="edit startTime">').text(doc.startTime));
            row.append($('<td class="edit endTime">').text(doc.endTime));
            row.append($('<td class="edit numGuests">').text(doc.numGuests));
            row.append($('<td class="edit comments">').text(doc.comments));
            row.append($('<td>').text(doc.createdAt));
            row.append($('<td>').html('<button class="edit-btn" data-id="' + doc._id.$oid + '"></button> <button class="save-btn hidden" data-id="' + doc._id.$oid + '">Save</button> <button class="cancel-btn hidden" data-id="' + doc._id.$oid + '">Cancel</button> <button class="delete-btn" data-id="' + doc._id.$oid + '"></button>'));
    
			table.append(row);
        });

        // Add the table to the HTML document
        $('#my-table').append(table);
		
		// Edit button click event
		$('.edit-btn').click(function() {
			$('#my-table').css({
				'width': '700px',
				'font-size': '10px'
			});

			var row = $(this).closest('tr');
			row.find('.edit').each(function() {
				var value = $(this).text();
				$(this).attr('data-value', value);
				$(this).html('<input type="text" class="edit-input" value="' + value + '">');
			});
			$(this).hide();
			row.find('.save-btn, .cancel-btn').show();    
			row.find('.delete-btn').hide();    
		});


		// Save button click event
		$('.save-btn').click(function() {
			var row = $(this).closest('tr');
			var reservationId = row.find('.id').find('input').val();
			var fullName = row.find('.fullName').find('input').val();
			var email = row.find('.email').find('input').val();
			var phone = row.find('.phone').find('input').val();
			var date = row.find('.date').find('input').val();
			var startTime = row.find('.startTime').find('input').val();
			var endTime = row.find('.endTime').find('input').val();
			var numGuests = row.find('.numGuests').find('input').val();
			var comments = row.find('.comments').find('input').val();
			$.ajax({
				url: 'update-reservation.php',
				type: 'POST',
				data: {id: reservationId, fullName: fullName, email: email, phone: phone, date: date, startTime: startTime, endTime: endTime, numGuests: numGuests, comments: comments},
				success: function(response) {
					row.find('.edit').each(function() {
						var value = $(this).find('input').val();
						$(this).text(value);
					});
					$('.edit-btn').show();
					$('.save-btn, .cancel-btn').hide();
				}
			});
		});
	
	
		// Cancel button click event
		$('.cancel-btn').click(function() {
			var row = $(this).closest('tr');
			row.find('.edit').each(function() {
				var value = $(this).attr('data-value');
				$(this).text(value);
			});
			$('.edit-btn, .delete-btn').show();
			$('.save-btn, .cancel-btn').hide();
		});

		$('.delete-btn').click(function() {
			var row = $(this).closest('tr');
			var reservationId = row.find('.id').data('id');
//			var reservationId = row.find('.id').find('input').val();
			if (confirm("Are you sure you want to delete this reservation?")) {
				$.ajax({
					url: 'delete-reservation.php',
					type: 'POST',
					data: {id: reservationId},
					success: function(response) {
						row.remove();
					}
				});
			}
		});

	});

	</script>

