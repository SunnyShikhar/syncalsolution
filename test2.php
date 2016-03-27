<!DOCTYPE html>
<!--
	MSCI 346 All About Database Project
	Built using HTML, PHP, CSS and JS
	Template: Transit by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>MSCI 444 - Snap Solutions</title>
	</head>
	
	<body class="landing">
	<!-- Header -->
			<header id="header">
				<h1><a href="homepage.html">Snap Solutions - Synaptive Calibration</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="homepage.html">Home</a></li>
						<li><a href="Insert.php">Insert Tool</a></li>
						<li><a href="SearchOne.php">Search Tool</a></li>
						<li><a href="SearchLatest.php">Search Most Calibrated</a></li>
					</ul>
				</nav>
			</header>

		<?php
					$servername = "localhost";
					$username = "root";
					$password = "Nbc444";
					$dbname = "syncal";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					
					// Check connection
					if ($conn->connect_error) 
					{
						die("Connection failed: " . $conn->connect_error);
					}

					$comment = mysqli_escape_string($_POST['comment']);
					$lastupdatedFirst = $_POST['lastupdatedFN'];
					$lastupdatedLast = $_POST['lastupdatedLN'];
					$synNum = mysqli_escape_string($_POST['synNum']);
					$serialNum = $_POST['serialNum'];
					$calpm = $_POST['calpm'];

					//Insert values
					$query1 = "INSERT INTO syntool ". "(synNum, serialNum, comment, calpm, lastupdatedFirst,
					 lastupdatedLast) ". "VALUES('$synNum', '$serialNum', '$comment', '$calpm', '$lastupdatedFirst', '$lastupdatedLast')";	
					
					$insert = $conn->query($query1);
				
		?>
		
		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<div class="row">
						<div class="8u 12u$(medium)">
							<ul class="copyright">
							</ul>
						</div>
					</div>
				</div>
			</footer>
	</body>
</html>
