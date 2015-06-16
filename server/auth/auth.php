<?php
  session_start();
  $_SESSION['userid'];
  $_SESSION['username'];
  $_SESSION['forename'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="../css/global.css" />
	<link rel="stylesheet" type="text/css" href="../css/nav.css" />
	<link rel="stylesheet" type="text/css" href="../css/login.css" />
	<link rel="stylesheet" type="text/css" href="../css/booking.css" />
	<title>TS&#38;SC | Auth</title>
</head>
<body>
	<div id="innerPage">
		<div id="logoHolder">
			<img id="logoBanner" src="../images/mainBanner.jpg" alt="Main Banner Image"></img>
		</div>
		<div id="navBarOne">
		  <div id="navBarOneWrapper">
			<ul class="nav">
			  <li class="nav">
				<a class="nav" href="../../">Home</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../membersbar/">Members Bar</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../functions/">Function Hall</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../booking/">Book Online</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../membership/">Membership</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../whatson/">Whats On</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../contact/">Contact Us</a>
			  </li>
			</ul>
		  </div>
		</div>
		<div id="contentContainer1" class="contentContainer">
			<?php

	          $userid = $_SESSION['userid'];
	          $username = $_SESSION['username'];
	          $forename = $_SESSION['forename'];

			if (isset($_SESSION['username'])) {
				header('location: ../../booking/');
			}
			else {
				if ($_POST['loginbtn']) {

					$getUsername = $_POST['username'];
					$getPass = $_POST['password'];

					//checking if username was entered
					if ($getUsername) {

						//checking if password was entered
						if ($getPass) {

							//open db connection
							require ("hdhfhgadgag/connect.php");

							//encript input password to match database.
							$encpass = md5(md5('f3n4ls' . $password . 'a6g5af'));

							//setting query
							$passQry = mysql_query("SELECT * FROM users WHERE username='$getUsername'");

							//taking number of results from db
							$numouts = mysql_num_rows($passQry);

							//checkig if the username was found in db
							if ($numouts >= 1) {
								$row = mysql_fetch_assoc($passQry);
								$dbUserId = $row['userID'];
								$dbUser = $row['username'];
								$dbPass = $row['password'];
								$dbForename = $row['forename'];

								//checking if password was correct
								if ($encpass == $dbPass) {

									//set session info
									$_SESSION['username'] = $dbUser;
									$_SESSION['userid'] = $dbUserId;
									$_SESSION['forename'] = $dbForename;

									header('location: ../../booking/');
								}

								else {
									echo '<p class="contentText center">Sorry, your username or password was incorrect, please try to login again. <a href="../../server/auth/login.php" class="loginLink">Login/Register</a></p>';
								}
							}

							else {
								echo '<p class="contentText center">Sorry, your username or password was incorrect, please try to login again. <a href="../../server/auth/login.php" class="loginLink">Login/Register</a></p>';
							}

							//close connection
							mysql_close();
						}
						else {
							echo '<p class="contentText center">Sorry, you did not enter a password, please try to login again. <a href="../../server/auth/login.php" class="loginLink">Login/Register</a></p>';
						}
					}
					else {
						echo '<p class="contentText center">Sorry, you did not enter a username, please try to login again. <a href="../../server/auth/login.php" class="loginLink">Login/Register</a></p>';
					}
				}

				//if the user wants to register
				elseif ($_POST['registerbtn'] or $_POST['registernewbtn']) {

					header('location: register.php');

				}

				else {
					echo '<p class="contentText center">Sorry, something went wrong, please try to register again. <a href="../../server/auth/login.php" class="loginLink">Login/Register</a></p>';
				}
			}
			?>
		</div>
		<div id="footerBar">
		  <p id="tinyText" class="tinyText">
			All content on this page is &#169; Copyright 2012 to <a class="cont" href="http://www.trimleysportsandsocialclub.co.uk/">Trimley Sports and Social Club</a> and Design mimics <a class="cont" href="http://www.jrgwebdesign.co.uk/">JRG Web Design's</a> original design. This webpage was created by Daniel Sarracayo for personal and/or school use.
		  </p>
		</div>
	</div>
</body>
</html>