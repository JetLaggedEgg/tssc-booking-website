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
	<title>TS&#38;SC | Register</title>
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
	        <a href="#" class="showBarText">Register</a>
	      </div>
		<?php

          $userid = $_SESSION['userid'];
          $username = $_SESSION['username'];
          $forename = $_SESSION['forename'];

		//login check
		if ($userid && $username) {
			header('location: ../../booking');
		}

		//give form with previously entered values.
		elseif ($_POST['registerbtn']) {

			//saved info
			$getTitle = $_POST['title'];
			$getForename = $_POST['forename'];
			$getSurname = $_POST['surname'];
			$getUsername = $_POST['username'];
			$getEmail = $_POST['email'];
			$getPass = $_POST['password'];
			$getPassRetry = $_POST['passwordRetry'];
			$getTerms = $_POST['terms'];

			$errorMsg;

			//vaildationRules

			//forename
			if (isset($getTerms)) {
				if ($getForename) {
					//surname
						if ($getSurname) {
							//username
							if ($getUsername) {
								//email
								if ((strlen($getEmail) >= 6) && (strstr($getEmail, "@")) && (strstr($getEmail, "."))) {
									//first password
									if ($getPass) {
										//passwords missmatch
										if ($getPass === $getPassRetry) {
											//Registering the user
											require ("hdhfhgadgag/connect.php");

											$usernameQry = mysql_query("SELECT username FROM users WHERE username='$getUsername'");
											$emailQry = mysql_query("SELECT email FROM users WHERE email='$getEmail'");

											$numOutsUsername = mysql_num_rows($usernameQry);
											$numOutsEmail = mysql_num_rows($emailQry);

											if ($numOutsUsername >= 1) {
												$errorMsg = "Sorry, your username has be taken. Please try another one.";
											}

											elseif ($numOutsEmail >= 1) {
												$errorMsg = "Sorry, your email has already been registered to an account, please use another one or recover your account <a href='../../' class='cont'></a>Here.";
											}
											else {

												$encpass = md5(md5('f3n4ls' . $getPass . 'a6g5af'));

												//check for title
												if ($getTitle) {
													//add all of the collected information into the database INC TITLE
													mysql_query("INSERT INTO users(username, forename, surname, title, email, password, auth)
													VALUES('$getUsername', '$getForename', '$getSurname', '$getTitle', '$getEmail', '$encpass', '0')
												");
													$IDQry = mysql_query("SELECT * FROM users WHERE username='$getUsername'");

													$IDRows = mysql_fetch_assoc($IDQry);
													$dbUserId = $IDRows['userID'];


													$_SESSION['username'] = $getUsername;
													$_SESSION['userid'] = $dbUserId;

													header('location: ../../booking');

												}
												else {
													//add all of the collected information into the database EXC TITLE
													mysql_query("INSERT INTO users(username, forename, surname, title, email, password, 'auth')
													VALUES('$getUsername', '$getForename', '$getSurname', '$getEmail', '$encpass', '0')
												");
													$IDQry = mysql_query("SELECT * FROM users WHERE username='$getUsername'");

													$IDRows = mysql_fetch_assoc($IDQry);
													$dbUserId = $IDRows['userID'];
													$dbUserForename = $IDRows['forename'];


													$_SESSION['username'] = $getUsername;
													$_SESSION['userid'] = $dbUserId;
													$_SESSION['forename'] = $dbUserForename;

													header('location: ../../booking');
												}

											}

											mysql_close();
										}
										else {
											$errorMsg = "Your passwords must match.";
										}
									}
									//pass not
									else {
										$errorMsg = "You must enter a password in order to secure your account.";
									}
								}
								//email not
								else {
									$errorMsg = "You must enter an email in order to register.";
								}
							}
							//username not
							else {
								$errorMsg = "You must enter a username in order to register.";
							}
						}
					//surname not
					else {
						$errorMsg = "You must enter your last name in order to register.";
					}
				}
				//forename not
				else {
					$errorMsg = "You must enter your first name in order to register.";
				}
			}
			else{
				$errorMsg = "You must agree to the terms and conditions of this website to register.";
			}


			echo '
			<h1 id="contentTitle" class="contentTitle">Register</h1><p class="contentText center">Welcome, you can now register by filling the form below, once registered you will automatically be redirected to your dashboard.</p>
			<div class="formWrapper">
				<p class="errorMessage">'. $errorMsg .'</p>
				<form name="register" class="form" action="register.php" method="POST">
					<br />
					<p class="fieldName">
						Title
					</p>
					<input id="titlefield" class="formField" type="text" name="title" value="' . $getTitle . '"></input>
					<p class="tinyText">
						If you wish, Enter your title.
					</p>
					<br />
					<p class="fieldName">
						Forename
					</p>
					<input id="forenamefield" class="formField" type="text" name="forename" value="' . $getForename . '"></input>
					<p class="tinyText">
						Please enter your first name.
					</p>
					<br />
					<p class="fieldName">
						Surname
					</p>
					<input id="surnamefield"t class="formField" type="text" name="surname" value="' . $getSurname . '"></input>
					<p class="tinyText">
						Please enter your last name.
					</p>
					<br />
					<p class="fieldName">
						Username
					</p>
					<input id="usernamefield" class="formField" type="text" name="username" value="' . $getUsername . '"></input>
					<p class="tinyText">
						Please Enter a desired username.
					</p>
					<br />
					<p class="fieldName">
						Email Address
					</p>
					<input id="emailfield" class="formField" type="email" name="email" value="' . $getEmail . '"></input>
					<p class="tinyText">
						Enter a valid email address.
					</p>
					<br />
					<p class="fieldName">
						Password
					</p>
					<input id="passfield" class="formField" type="password" name="password" value="'. $getPass . '"></input>
					<p class="tinyText">
						Enter a desired password.
					</p>
					<br />
					<p class="fieldName">
						Re-enter Password
					</p>
					<input id="repassfield" class="formField" type="password" name="passwordRetry" value="' . $getPassRetry . '"></input>
					<p class="tinyText">
						Please enter your password.
					</p>
					<br />
					<table class="termsTable">
					<tr>
					<td>
					<p class="tinyText">
						To register you must agree to the <a class="cont" href="termsandconditions.html">terms and conditions</a> of this website. Click the checkbox to confirm your agreement.
					</p>
					</td>
					<td>
					<input id="termsBox" class="formCheckBox" type="checkbox" name="terms" value=""></input>
					</td>
					</tr>
					</table>
					<br />
					<input id="helpBut" class="button left" name="helpbtn" type="button" value="Help" />
					<input id="registerBut" class="button right" name="registerbtn" type="submit" value="Register" />
				</form>
				<div class="clear"></div>
			</div>
			';
		}

		//first attempt, no details.
		else {
			echo '
			<h1 id="contentTitle" class="contentTitle">Register</h1><p class="contentText center">Welcome, you can now register by filling the form below, once registered you will automatically be redirected to your dashboard.</p>
			<div class="formWrapper">
				<p class="errorMessage">'. $errorMsg .'</p>
				<form name="register" class="form" action="register.php" method="POST">
					<br />
					<p class="fieldName">
						Title
					</p>
					<input id="titlefield" class="formField" type="text" name="title" value="' . $getTitle . '"></input>
					<p class="tinyText">
						If you wish, Enter your title.
					</p>
					<br />
					<p class="fieldName">
						Forename
					</p>
					<input id="forenamefield" class="formField" type="text" name="forename" value="' . $getForename . '"></input>
					<p class="tinyText">
						Please enter your first name.
					</p>
					<br />
					<p class="fieldName">
						Surname
					</p>
					<input id="surnamefield"t class="formField" type="text" name="surname" value="' . $getSurname . '"></input>
					<p class="tinyText">
						Please enter your last name.
					</p>
					<br />
					<p class="fieldName">
						Username
					</p>
					<input id="usernamefield" class="formField" type="text" name="username" value="' . $getUsername . '"></input>
					<p class="tinyText">
						Please Enter a desired username.
					</p>
					<br />
					<p class="fieldName">
						Email Address
					</p>
					<input id="emailfield" class="formField" type="email" name="email" value="' . $getEmail . '"></input>
					<p class="tinyText">
						Enter a valid email address.
					</p>
					<br />
					<p class="fieldName">
						Password
					</p>
					<input id="passfield" class="formField" type="password" name="password" value="'. $getPass . '"></input>
					<p class="tinyText">
						Enter a desired password.
					</p>
					<br />
					<p class="fieldName">
						Re-enter Password
					</p>
					<input id="repassfield" class="formField" type="password" name="passwordRetry" value="' . $getPassRetry . '"></input>
					<p class="tinyText">
						Please enter your password.
					</p>
					<br />
					<table class="termsTable">
					<tr>
					<td>
					<p class="tinyText">
						To register you must agree to the <a class="cont" href="termsandconditions.html">terms and conditions</a> of this website. Click the checkbox to confirm your agreement.
					</p>
					</td>
					<td>
					<input id="termsBox" class="formCheckBox" type="checkbox" name="terms" value=""></input>
					</td>
					</tr>
					</table>
					<br />
					<input id="helpBut" class="button left" name="helpbtn" type="button" value="Help" />
					<input id="registerBut" class="button right" name="registerbtn" type="submit" value="Register" />
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