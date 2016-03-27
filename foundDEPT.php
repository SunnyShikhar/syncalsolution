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
				if ($conn->connect_error) {
  					die("Connection failed: " . $conn->connect_error);
				}

				// Query Template
				$query = "SELECT DISTINCT S.synNum, M.toolName, M.modelNum, M.manuName, P.deptName " .
						 "FROM syntool S, manuftool M, prodOwner P " .
						 "WHERE M.manuName=? AND P.deptName=? AND M.modelNum = S.modelNum AND P.prodOwnerEmail = S.prodOwnerEmail";
					
				// Prepare statement
				$stmt = $conn->prepare($query);
				
				// Bind input parameters
				$stmt->bind_param("ss", $_GET["manuName"], $_GET["deptName"]);
				
				// Bind result parameters
				$stmt->bind_result($synNum, $toolName, $modelNum, $manuName, $deptName);
		?>

				<!-- One -->
			<section id="One" class="wrapper style3 special">
				<div class="container">
					<header class="major">
						<h2>The following tools were found:</h2>
					</header>
				</div>	
	
			<table border="1">
			<tr>
				<td> <b>Synaptive Number</b> </td>
				<td> <b>Tool Name</b> </td>
				<td> <b>Model Number</b> </td>
				<td> <b>Manufacturer</b> </td>
				<td> <b>Department Name</b> </td>

			</tr>
	
			<?php
				$stmt->execute();
				while($stmt->fetch()){
					echo "<tr>";
						echo "<td>";
						echo $synNum;
						echo "</td>";

						echo "<td>";
						echo $toolName;
						echo "</td>";

						echo "<td>";
						echo $modelNum;
						echo "</td>";

						echo "<td>";
						echo $manuName;
						echo "</td>";

						echo "<td>";
						echo $deptName;
						echo "</td>";
					
					echo "</tr>";
				}
			?>

		</table>

		<?php
			$stmt->close();
			$conn->close();
		?>
		</section>
