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

				// Query template
				$sql = 	"SELECT DISTINCT S.cal_pm
					 FROM syntool S";

				// Prepare statement
				$stmt = $conn->prepare($sql);
		
				// Bind result parameters
				$stmt->bind_result($cal_pm);
		?>
		
		<!-- One -->
			<section id="One" class="wrapper style3 special">
				<div class="container">
					<header class="major">
						<h2>Search all Calibration or Preventative Maintenance (PM) Tools</h2>
						<p>Please select Calibration or PM:</p>
					</header>
				</div>
			<form action="foundcaltoolname.php" method="GET" target="_blank">
				<table>
					<tr>
						<td> <b> CAL or PM: </b> </td>
						<td> 
						<select Name="cal_pm" type="text">
							<?php
							$stmt->execute();
							while($stmt->fetch()){
								echo "<option>$cal_pm</option>";
							}
							?>
						</select>
						</td>
					</tr>
						<td> </td>
						<td> <input type="submit" value="Search"> </td>
					</tr>
				</table>
			</form>
			</section>
	</body>
</html>