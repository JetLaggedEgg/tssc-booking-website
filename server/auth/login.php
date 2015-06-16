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
	<title>TS&#38;SC | Login</title>
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
	      <div class="showBar">
	        <a href="../../booking" class="showBarText">Booking ></a>
	        <a href="#" class="showBarText">login</a>
	      </div>
			<?php

	          $userid = $_SESSION['userid'];
	          $username = $_SESSION['username'];
	          $forename = $_SESSION['forename'];

			//if already logged in...
			if ($username) {
				header('location: ../../booking');
			}

			elseif ($_POST['registernewbtn']) {
				header('location: register.php');
			}

			//otherwise...
			else {
				if ($_POST['loginbtn']) {
					$getUsername = $_POST['username'];
					$getPassword = $_POST['password'];

					$errMsg;

					if ($getUsername) {
						if ($getPassword) {
							require ("hdhfhgadgag/connect.php");
							$userQry = mysql_query("SELECT * FROM users WHERE username='$getUsername'");
							$numUsers = mysql_num_rows($userQry);
							$userRow = mysql_fetch_assoc($userQry);
							$dBusername = $userRow['username'];
							$dBpassword = $userRow['password'];
							$dBforename = $userRow['forename'];
							$dBID = $userRow['userID'];
							mysql_close();
							if ($numUsers >= 1) {
								$getPasswordEcr =  md5(md5('f3n4ls' . $getPassword . 'a6g5af'));
								if ($getPasswordEcr == $dBpassword) {

									$_SESSION['userid'] = $dBID;
							        $_SESSION['username'] = $dBusername;
							        $_SESSION['forename'] = $dBforename;

							        header('location: ../../booking');

								}
								else {
									$errMsg = 'Your username or password is incorrect.';
								}
							}
							else {
								$errMsg = 'Your username or password is incorrect.';
							}
						}
						else {
							$errMsg = 'You have not entered your password.';
						}
					}
					else {
						$errMsg = 'You have not entered your username.';
					}
				}
				echo '
				<h1 id="contentTitle" class="contentTitle">Login</h1>
				<p class="contentText center">
					Welcome. If you already you already have an account, please login, otherwise please register in order to use our online booking system.
				</p>
				<div class="formWrapper">
					<form name="login" class="form" action="login.php" method="POST">
						<p class="errorMessage">' . $errMsg . '</p>
						<p class="fieldName">
							Username
						</p>
						<input id="loguserfield" class="formField" type="text" name="username" value="' . $getUsername . '"></input>
						<p class="tinyText">
							Please your username.
						</p>
						<br />
						<p class="fieldName">
							Password
						</p>
						<input id="logpassfield" class="formField" type="password" name="password"></input>
						<p class="tinyText">
							Please enter your password.<br />Remember not to tell anyone else this.
						</p>
						<br />
						<input class="button left" name="forgotbtn" type="submit" value="Forgot?" />
						<input class="button" name="registernewbtn" type="submit" value="Register" />
						<input class="button right" name="loginbtn" type="submit"  value="Login" />
					</form>
					<div class="clear"></div>
				</div>
				';
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