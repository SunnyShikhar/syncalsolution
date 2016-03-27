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
					
					// View Template
					$query2= "SELECT *" .
						"FROM syntool";
					
					// Prepare statement
					$query2stmt = $conn->prepare($query2);
					
					// Bind result parameters
					$query2stmt->bind_result($synNum, $serialNum, $comment, $cal_pm, $lastupdatedFirst, $lastupdatedLast, $modelNum, $prodOwnerEmail);
		?>
		
				<!-- One -->
			<section id="One" class="wrapper style3 special">
				<div class="container">
					<header class="major">
						<h2>The following table was added:</h2>
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
				$conn->close();
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
