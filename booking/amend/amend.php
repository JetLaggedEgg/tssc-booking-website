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
	<link rel="stylesheet" type="text/css" href="../../server/css/global.css" />
	<link rel="stylesheet" type="text/css" href="../../server/css/nav.css" />
	<link rel="stylesheet" type="text/css" href="../../server/css/login.css" />
	<link rel="stylesheet" type="text/css" href="../../server/css/booking.css" />
	<title>TS&#38;SC | Amend</title>
</head>
<body>
	<div id="innerPage">
		<div id="logoHolder">
			<img id="logoBanner" src="../../server/images/mainBanner.jpg" alt="Main Banner Image"></img>
		</div>
		<div id="navBarOne">
		  <div id="navBarOneWrapper">
			<ul class="nav">
			  <li class="nav">
				<a class="nav" href="../../">Home</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../membersbar">Members Bar</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../functions">Function Hall</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../">Book Online</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../membership">Membership</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../whatson">Whats On</a>
			  </li>
			  <li class="nav">
				<a class="nav" href="../../contact">Contact Us</a>
			  </li>
			</ul>
		  </div>
		</div>
		<div id="contentContainer1" class="contentContainer">
      <div class="showBar">
        <a href="../" class="showBarText">Booking ></a>
        <a href="#" class="showBarText">Amend</a>
      </div>
		<?php
		//session variables
		$userid = $_SESSION['userid'];
		$username = $_SESSION['username'];
		$forename = $_SESSION['forename'];

		$getBookingID = $_GET['bookingId'];
		$getUserID = $_GET['userId'];

		//logged in
		if ($username) {
			if ($_GET['bookingId']) {
				require ("../../server/auth/hdhfhgadgag/connect.php");
				$bookingQry = mysql_query("SELECT * FROM bookings WHERE bookingID='$getBookingID'");
				$bookRow = mysql_fetch_assoc($bookingQry);
				$getBookName = $bookRow['bookingName'];
	          	$getServiceID = $bookRow['serviceID'];
	          	$getLocationID = $bookRow['locationID'];
	          	$getStartDate = $bookRow['startDate'];
	          	$getStartTime = $bookRow['startTime'];
	          	$getEndDate = $bookRow['endDate'];
	          	$getEndTime = $bookRow['endTime'];
	          	$getCost = $bookRow['cost'];
	          	$getNoGuests = $bookRow['noGuests'];
				mysql_close();

				if ($getServiceID == 1) {
					$serv1 = 'selected';
				}
				else {
					if ($getServiceID == 2) {
						$serv2 = 'selected';
					}
					else {
						if ($getServiceID == 3) {
							$serv3 = 'selected';
						}
						else {
							if ($getServiceID == 4) {
								$serv4 = 'selected';
							}
							else {
								$errorMsg = 'Booking is corrupt!';
							}
						}
					}
				}
				if ($getLocationID == 1) {
					$loc1 = 'selected';
				}
				else {
					if ($getLocationID == 2) {
						$loc2 = 'selected';
					}
					else {
						if ($getLocationID == 3) {
							$loc3 = 'selected';
						}
						else {
							if ($getLocationID == 4) {
								$loc4 = 'selected';
							}
							else {
								if ($getLocationID == 5) {
									$loc5 = 'selected';
								}
								else {
									$errorMsg = 'Booking is corrupt!';
								}
							}
						}
					}
				}
			}

			if ($_POST['amendBookingBtn']) {
	          $getBookName = $_POST['bookName'];
	          $getServiceID = $_POST['service'];
	          $getLocationID = $_POST['location'];
	          $getStartDate = $_POST['startDate'];
	          $getStartTime = $_POST['startTime'];
	          $getEndDate = $_POST['endDate'];
	          $getEndTime = $_POST['endTime'];
	          $getNoGuests = $_POST['noGuests'];
	          $errorMsg = '';

	          $toDBcost = '';

	          if ($getServiceID == '0') {
	            if ($getLocationID == 1) {
	              $toDBcost = '25';
	            }
	            elseif ($getLocationID == 2) {
	              $toDBcost = '10';
	            }
	            elseif ($getLocationID == 3) {
	              $toDBcost = '50';
	            }
	            elseif ($getLocationID == 4) {
	              $toDBcost = '150';
	            }
	            elseif ($getLocationID == 5) {
	              $toDBcost = '30';
	            }
	          }
	          if ($getServiceID == 1) {
	            if ($getLocationID == 1) {
	              $toDBcost = '50';
	            }
	            elseif ($getLocationID == 2) {
	              $toDBcost = '35';
	            }
	            elseif ($getLocationID == 3) {
	              $toDBcost = '75';
	            }
	            elseif ($getLocationID == 4) {
	              $toDBcost = '175';
	            }
	            elseif ($getLocationID == 5) {
	              $toDBcost = '55';
	            }
	          }
	          if ($getServiceID == 2) {
	            if ($getLocationID == 1) {
	              $toDBcost = '50';
	            }
	            elseif ($getLocationID == 2) {
	              $toDBcost = '35';
	            }
	            elseif ($getLocationID == 3) {
	              $toDBcost = '75';
	            }
	            elseif ($getLocationID == 4) {
	              $toDBcost = '175';
	            }
	            elseif ($getLocationID == 5) {
	              $toDBcost = '55';
	            }
	          }
	          if ($getServiceID == 3) {
	            if ($getLocationID == 1) {
	              $toDBcost = '65';
	            }
	            elseif ($getLocationID == 2) {
	              $toDBcost = '50';
	            }
	            elseif ($getLocationID == 3) {
	              $toDBcost = '90';
	            }
	            elseif ($getLocationID == 4) {
	              $toDBcost = '190';
	            }
	            elseif ($getLocationID == 5) {
	              $toDBcost = '70';
	            }
	          }
	          if ($getServiceID == 4) {
	            if ($getLocationID == 1) {
	              $toDBcost = '25';
	            }
	            elseif ($getLocationID == 2) {
	              $toDBcost = '10';
	            }
	            elseif ($getLocationID == 3) {
	              $toDBcost = '50';
	            }
	            elseif ($getLocationID == 4) {
	              $toDBcost = '150';
	            }
	            elseif ($getLocationID == 5) {
	              $toDBcost = '30';
	            }
	          }
	          if ($getBookName) {
	            if ($getservice === 'null') {
	              $errorMsg = 'Please choose from one of our services.';
	            }
	            else {
	              if ($getLocation === 'null') {
	                $errorMsg = 'Please choose from one of our locations.';
	              }
	              else {
					if ($getStartDate && strstr($getStartDate, '-') && strlen($startDate) <= 10) {
						if ($getStartTime && strlen($startDate) <= 8) {
							if ($getEndDate && strstr($getEndDate, '-') && strlen($getEndDate) <= 10) {
								if ($getEndTime && strlen($getEndTime) <= 10) {
									if ($getNoGuests <= 1000 && $getNoGuests >= 1){
										require ("../../server/auth/hdhfhgadgag/connect.php");
										mysql_query("UPDATE bookings SET bookingName='$getBookName', serviceID='$getServiceID', locationID='$getLocationID', startDate='$getStartDate', startTime='$getStartTime', endDate='$getEndDate', endTime='$getEndTime', cost='$toDBcost', noGuests='$getNoGuests' WHERE bookingID='$getBookingID'");
										header("location: ../");
										mysql_close();
									}
				                    else {
				                    	$errorMsg = 'Please enter a valid number of guests, the max is 1000.';
				                    }
								}
								else {
									$errorMsg = 'Please enter a valid end time.';
								}
							}
							else {
								$errorMsg = 'Please enter a valid end date.';
							}
						}
						else {
							$errorMsg = 'Please enter a valid start time.';
						}
					}
					else {
						$errorMsg = 'Please enter a valid start date.';
					}
                  }
	            }
	          }
	          else {
	            $errorMsg = 'Please Enter a Name for your new booking, this will help you remember which one it is.';
	          }
	        }
	        echo '
	        <h1 id="contentTitle" class="contentTitle">Amend Booking</h1><p class="contentText center">Hi, ' . $forename . '. You can now amend your selected booking. Anything you change will be changed on our database, only change what you wish to be changed.</p>
	        <div class="formWrapper">
	          <p class="errorMessage">'. $errorMsg .'</p>
	          <form name="register" class="form" action="amend.php" method="POST">
	            <br />
	            <p class="fieldName">
	              Booking Name
	            </p>
	            <input id="titlefield" class="formField" type="text" name="bookName" value="' . $getBookName . '"></input>
	            <p class="tinyText">
	              The name of this booking. e.g. 1st Birthday.
	            </p>
	            <br />
	            <p class="fieldName">
	              Service
	            </p>
	            <select class="formSelect" name="service" value="' . $getService . '">
	              <option value="null">-- Please Choose One --</option>
	              <option value="1" ' . $serv1 . '>Food (£25)</option>
	              <option value="2" ' . $serv2 . '>Drinks (£25)</option>
	              <option value="3" ' . $serv3 . '>Food and Drinks (£40)</option>
	              <option value="4" ' . $serv4 . '>None</option>
	            </select>
	            <p class="tinyText">
	              You can change you service in the dropdown list.
	            </p>
	            <br />
	            <p class="fieldName">
	              Location
	            </p>
	            <select class="formSelect" name="location" value="' . $getLocation . '">
	              <option value="null">-- Please Choose One --</option>
	              <option value="1" ' . $loc1 . '>BBQ Area (£25)</option>
	              <option value="2" ' . $loc2 . '>Main Bar (£10)</option>
	              <option value="3" ' . $loc3 . '>Function Hall (£50)</option>
	              <option value="4" ' . $loc4 . '>Sports Field (£150)</option>
	              <option value="5" ' . $loc5 . '>Gym (£30)</option>
	            </select>
	            <p class="tinyText">
	              You can change you location in the dropdown list.
	            </p>
	            <br />
	            <p class="fieldName">
	              Start Date
	            </p>
	            <table class="dateTable">
	              <tr class="dateTable">
	                <td class="dateTable">Date</td>
	                <td class="dateTable">Time</td>
	              </tr>
	              <tr class="dateTable">
	                <td class="dateTable"><input class="dateInput" name="startDate" value="' . $getStartDate . '"></input></td>
	                <td class="dateTable"><input class="timeInput" name="startTime" value="' . $getStartTime . '"></input></td>
	              </tr>
	              <tr class="dateTable">
	                <td class="dateTable"><p class="tinyText">YYYY-MM-DD</p></td>
	                <td class="dateTable"><p class="tinyText">HH:MM:SS</p></td>
	              </tr>
	              <tr class="dateTable">
	                <td class="dateTable" colspan="2"><p class="tinyText">Change the start date if you wish, time must be in 24 format.</p></td>
	              </tr>
	            </table>
	            <br />
	            <p class="fieldName">
	              End Date
	            </p>
	            <table class="dateTable">
	              <tr class="dateTable">
	                <td class="dateTable">Date</td>
	                <td class="dateTable">Time</td>
	              </tr>
	              <tr class="dateTable">
	                <td class="dateTable"><input class="dateInput" name="endDate" value="' . $getEndDate . '"></input></td>
	                <td class="dateTable"><input class="timeInput" name="endTime" value="' . $getEndTime . '"></input></td>
	              </tr>
	              <tr class="dateTable">
	                <td class="dateTable"><p class="tinyText">YYYY-MM-DD</p></td>
	                <td class="dateTable"><p class="tinyText">HH:MM:SS</p></td>
	              </tr>
	              <tr class="dateTable">
	                <td class="dateTable" colspan="2"><p class="tinyText">Change the start date if you wish, time must be in 24 format.</p></td>
	              </tr>
	            </table>
	            <br />
	            <p class="fieldName">
	              Cost
	            </p>
	            <input id="repassfield" class="formField" type="number" name="cost" value="' . $getCost . '" readonly />
	            <p class="tinyText">
	              This will be calculated upon confirmation.
	            </p>
	            <br />
	            <p class="fieldName">
	              Expected Number of Guests
	            </p>
	            <input id="repassfield" class="formField" type="number" name="noGuests" value="' . $getNoGuests . '"></input>
	            <p class="tinyText">
	              Here you can change the number of guests.
	            </p>
	            <br />
	            <input class="smallInput" name="passedBookingID" value="' . $getBookingID . '" readonly />
	            <input class="smallInput" name="passedUserID" value="' . $getUserID . '" readonly />
	            <input id="registerBut" class="button right" name="amendBookingBtn" type="submit" value="Confirm" />
	          </form>
	          <div class="clear"></div>
	        </div>
	        ';
	      }
		//not logged in
		else {
			header("location: ../");
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