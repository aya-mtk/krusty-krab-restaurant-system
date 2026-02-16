<?php
session_start();
require_once('dbconnect.php');

if (!isset($_SESSION['admin'])) {
    header("Location: logout.php");
}

// Retrieve the documents from the MongoDB database
$collection = $db->Reviews;
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

    <title>Review Data</title>
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
			<a href="adminReservation.php">Reservation</a>
			<a href="#">Review</a>
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
        headerRow.append($('<th>').text('UserName'));
        headerRow.append($('<th>').text('User Review'));
        headerRow.append($('<th>').text('Date'));
        headerRow.append($('<th>').text('Action'));
        table.append(headerRow);

        // Loop through each document and create a row for the table
        $.each(jsonData, function(index, doc) {
            var row = $('<tr>');
            row.append($('<td class="edit id" data-id="' + doc._id.$oid + '">').text(doc._id.$oid));
            row.append($('<td class="edit username">').text(doc.username));
            row.append($('<td class="edit body">').text(doc.body));
            row.append($('<td class="edit date">').text(doc.Date));
            row.append($('<td>').html('<button class="delete-btn" data-id="' + doc._id.$oid + '"></button>'));
    
			table.append(row);
        });

        // Add the table to the HTML document
        $('#my-table').append(table);

		$('.delete-btn').click(function() {
			var row = $(this).closest('tr');
			var reviewId = row.find('.id').data('id');
			if (confirm("Are you sure you want to delete this Review?")) {
				$.ajax({
					url: 'delete-review.php',
					type: 'POST',
					data: {id: reviewId},
					success: function(response) {
						row.remove();
					}
				});
			}
		});

	});

	</script>

