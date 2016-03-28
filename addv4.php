<!DOCTYPE html>
<!--
	MSCI 444 - Snap Solutions Project
	Built using HTML, PHP, CSS and JS
	Template: Transit by TEMPLATED
	templated.co @templatedco
-->
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Synaptive Calibration</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header">
				<h1><a href="homepage.html">Snap Solutions</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="homepage.html">Home</a></li>
						<li><a href="insert.html">Insert Tool</a></li>
						<li><a href="searchcalDue.php">Search CAL or PM Duedate</a></li>
						<li><a href="searchDEPT.php">Search Manufacturer and Department</a></li>
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

					// Insert Template
					$sql1= "INSERT INTO manuftool " .
						"VALUES (?, ?, ?)";				
					// Prepare statement
					$sql1stmt = $conn->prepare($sql1);
					// Bind input parameters
					$sql1stmt->bind_param("sss", $_POST['modelNum'], $_POST['manuName'], $_POST['toolName']);			
					$sql1stmt->execute();	
					$sql1stmt->close();

					// Insert Template
					$sql2= "INSERT INTO prodOwner " .
						"VALUES (?, ?, ?, ?)";				
					// Prepare statement
					$sql2stmt = $conn->prepare($sql2);
					// Bind input parameters
					$sql2stmt->bind_param("ssss", $_POST['prodOwnerEmail'], $_POST['prodOwnerFirst'], $_POST['prodOwnerLast'], $_POST['deptName']);			
					$sql2stmt->execute();	
					$sql2stmt->close();

					// Insert Template
					$query1= "INSERT INTO syntool " .
						"VALUES (?, ?, ?, ?, ?, ?, ?, ?)";				
					// Prepare statement
					$query1stmt = $conn->prepare($query1);
					// Bind input parameters
					$query1stmt->bind_param("ssssssss", $_POST['synNum'], $_POST['serialNum'], $_POST['comment'], $_POST['calpm'], $_POST['lastupdatedFN'], $_POST['lastupdatedLN'], $_POST['modelNum'], $_POST['prodOwnerEmail']);			
					$query1stmt->execute();	
					$query1stmt->close();

					// Insert Template
					$sql3= "INSERT INTO caliInfo " .
						"VALUES (?, ?, ?, ?, ?)";				
					// Prepare statement
					$sql3stmt = $conn->prepare($sql3);
					// Bind input parameters
					$sql3stmt->bind_param("sssss", $_POST['lengthCal'], $_POST['synNum'], $_POST['dueCal'], $_POST['lastCal'], $_POST['calCompany']);			
					$sql3stmt->execute();	
					$sql3stmt->close();



					$synNum = $_POST['synNum'];
					$modelNum = $_POST['modelNum'];
					$prodOwnerEmail = $_POST['prodOwnerEmail'];
					
					// View Template
					$query2= "SELECT * " .
						"FROM syntool " .
						"WHERE synNum = '$synNum'";
					
					// Prepare statement
					$query2stmt = $conn->prepare($query2);
					
					// Bind result parameters
					$query2stmt->bind_result($synNum, $serialNum, $comment, $cal_pm, $lastupdatedFirst, $lastupdatedLast, $modelNum, $prodOwnerEmail);

					// View Template
					$query3= "SELECT *" .
						"FROM manuftool " .
						"WHERE modelNum = '$modelNum'";
					
					// Prepare statement
					$query3stmt = $conn->prepare($query3);
					
					// Bind result parameters
					$query3stmt->bind_result($modelNum, $manuName, $toolName);

					// View Template
					$query4= "SELECT *" .
						"FROM prodOwner " .
						"WHERE prodOwnerEmail = '$prodOwnerEmail'";
					
					// Prepare statement
					$query4stmt = $conn->prepare($query4);
					
					// Bind result parameters
					$query4stmt->bind_result($prodOwnerEmail, $prodOwnerFirst, $prodOwnerLast, $deptName);

					// View Template
					$query5= "SELECT *" .
						"FROM caliInfo " .
						"WHERE synNum = '$synNum'";
					
					// Prepare statement
					$query5stmt = $conn->prepare($query5);
					
					// Bind result parameters
					$query5stmt->bind_result($lengthCal, $synNum, $dueCal, $lastCal, $calCompany);


		?>
		
				<!-- One -->
			<section id="One" class="wrapper style3 special">
				<div class="container">
					<header class="major">
						<h2>The following rows were added to each of the following tables:</h2>
						<h3>Synaptive Tool Table</h3>
					</header>
				</div>				
				<table border="1">
				<tr>
					<td> <b>SynNum</b> </td>
					<td> <b>SerialNum</b> </td>
					<td> <b>Comment</b> </td>
					<td> <b>Calibration or PM</b> </td>
					<td> <b>First Name</b> </td>
					<td> <b>Last Name</b> </td>
					<td> <b>Model Number</b> </td>
					<td> <b>Product Owner Email</b> </td>
				</tr>
		
				<?php
					$query2stmt->execute();
					while($query2stmt->fetch()){
						echo "<tr>";
							echo "<td>";
							echo $synNum;
							echo "</td>";

							echo "<td>";
							echo $serialNum;
							echo "</td>";

							echo "<td>";
							echo $comment;
							echo "</td>";

							echo "<td>";
							echo $cal_pm;
							echo "</td>";
							
							echo "<td>";
							echo $lastupdatedFirst;
							echo "</td>";

							echo "<td>";
							echo $lastupdatedLast;
							echo "</td>";

							echo "<td>";
							echo $modelNum;
							echo "</td>";

							echo "<td>";
							echo $prodOwnerEmail;
							echo "</td>";
						echo "</tr>";
					}
				?>

			</table>

			<?php
				$query2stmt->close();
			?>

			<div class="container">
				<header class="major">
					<h3>Manufacturer Tool Table</h3>
				</header>
			</div>		
			<table border="1">
				<tr>
					<td> <b>Model Number</b> </td>
					<td> <b>Manufacturer</b> </td>
					<td> <b>Tool Name</b> </td>
				</tr>
		
				<?php
					$query3stmt->execute();
					while($query3stmt->fetch()){
						echo "<tr>";
							echo "<td>";
							echo $modelNum;
							echo "</td>";

							echo "<td>";
							echo $manuName;
							echo "</td>";

							echo "<td>";
							echo $toolName;
							echo "</td>";
						echo "</tr>";
					}
				?>
			</table>

			<?php
				$query3stmt->close();
			?>

			<div class="container">
				<header class="major">
					<h3>Product Owner Tool Table</h3>
				</header>
			</div>		
			<table border="1">
				<tr>
					<td> <b>Product Owner Email</b> </td>
					<td> <b>Product Owner First Name</b> </td>
					<td> <b>Product Owner Last Name</b> </td>
					<td> <b>Department Name</b> </td>
				</tr>
		
				<?php
					$query4stmt->execute();
					while($query4stmt->fetch()){
						echo "<tr>";
							echo "<td>";
							echo $prodOwnerEmail;
							echo "</td>";

							echo "<td>";
							echo $prodOwnerFirst;
							echo "</td>";

							echo "<td>";
							echo $prodOwnerLast;
							echo "</td>";

							echo "<td>";
							echo $deptName;
							echo "</td>";
						echo "</tr>";
					}
				?>
			</table>

			<?php
				$query4stmt->close();
			?>

			<div class="container">
				<header class="major">
					<h3>Calibration Table</h3>
				</header>
			</div>		
			<table border="1">
				<tr>
					<td> <b>Calibration Length</b> </td>
					<td> <b>Synaptive Number</b> </td>
					<td> <b>Last Calibrated Date</b> </td>
					<td> <b>Calibration Due Date</b> </td>
					<td> <b>Calibration Company</b> </td>
				</tr>
		
				<?php
					$query5stmt->execute();
					while($query5stmt->fetch()){
						echo "<tr>";
							echo "<td>";
							echo $lengthCal;
							echo "</td>";

							echo "<td>";
							echo $synNum;
							echo "</td>";

							echo "<td>";
							echo $lastCal;
							echo "</td>";

							echo "<td>";
							echo $dueCal;
							echo "</td>";

							echo "<td>";
							echo $calCompany;
							echo "</td>";
						echo "</tr>";
					}
				?>
			</table>

			<?php
				$query5stmt->close();
			?>
		</section>
		
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
