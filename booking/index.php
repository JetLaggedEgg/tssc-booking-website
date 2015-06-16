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
  <link rel="stylesheet" type="text/css" href="../server/css/global.css" />
  <link rel="stylesheet" type="text/css" href="../server/css/nav.css" />
  <link rel="stylesheet" type="text/css" href="../server/css/login.css" />
  <link rel="stylesheet" type="text/css" href="../server/css/booking.css" />
  <title>TS&#38;SC | Booking</title>
  <style>
    
  </style>
</head>
<body>
  <div id="innerPage">
    <div id="logoHolder">
      <img id="logoBanner" src="../server/images/mainBanner.jpg" alt="Main Banner Image"></img>
    </div>
    <div id="navBarOne">
      <div id="navBarOneWrapper">
        <ul class="nav">
          <li class="nav">
            <a class="nav" href="../">Home</a>
          </li>
          <li class="nav">
            <a class="nav" href="../membersbar/">Members Bar</a>
          </li>
          <li class="nav">
            <a class="nav" href="../functions/">Function Hall</a>
          </li>
          <li class="nav">
            <a class="nav" href="#">Book Online</a>
          </li>
          <li class="nav">
            <a class="nav" href="../membership/">Membership</a>
          </li>
          <li class="nav">
            <a class="nav" href="../whatson/">Whats On</a>
          </li>
          <li class="nav">
            <a class="nav" href="../contact/">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
    <div id="contentContainer1" class="contentContainer">
      <div class="showBar">
        <a href="#" class="showBarText">Booking</a>
      </div>
    <?php

      $userid = $_SESSION['userid'];
      $username = $_SESSION['username'];
      $forename = $_SESSION['forename'];

      //if user is session logged
      if (isset($username)) {
        //give ui
        echo '
        <h1 id="contentTitle" class="contentTitle">Booking Dashboard</h1><p class="contentText center">Welcome to your dashboard ' . $forename . '. From here, you can create, amend and delete your bookings. If you need assistance please check out our help page, if that doesn&#8217;t help then please contact us.</p>
        <div class="dashBarWrapper">
          <div class="dashBar">
            <p class="dashHead center">User Tools</p>
            <p class="dashSmall center">Account</p>
            <table class="tools">
            <tr>
            <td><form name="logout" action="../server/auth/account.php" method="POST">
              <input class="button" name="logoutbtn" type="submit" value="Logout" />
            </form></td>
            <td><form name="account" action="../server/auth/account.php" method="POST">
              <input class="button" name="accountbtn" type="submit" value="Info" />
            </form></td>
            </tr>
            </table>
            <p class="dashSmall center">Booking</p>
            <table class="tools">
            <tr>
            <td><form name="createBook" action="create/new.php" method="POST">
              <input class="button" name="createBookbtn" type="submit" value="Create" />
            </form><td>
            </tr>
            </table>
          </div>
          <div class="dashBar">
            <p class="dashHead center">News</p>
            <p class="dashSmall center">Latest news here.</p>
            <p class="dashSmall">- Amend is currently not working, a solution is in seek.</p>
          </div>
          <div class="clear" />
        </div>
        ';
        //pull bookings from database
        require ("../server/auth/hdhfhgadgag/mysqli_connect.php");
        $query = "SELECT * FROM bookings WHERE userID='$userid'";
        $result = $link->query($query);

        echo '
          <table class="bookingsTable">
            <p class="dashHead center">Your Bookings</p>
            <tr class="bookingsRow">
            <td class="bookingsColumn"><b>BookingName</b></td>
            <td class="bookingsColumn"><b>BookingID</b></td>
            <td class="bookingsColumn"><b>Service</b></td>
            <td class="bookingsColumn"><b>Location</b></td>
            <td class="bookingsColumn"><b>Start Date</b></td>
            <td class="bookingsColumn"><b>Start Time</b></td>
            <td class="bookingsColumn"><b>End Date</b></td>
            <td class="bookingsColumn"><b>End Time</b></td>
            <td class="bookingsColumn"><b>Cost</b></td>
            <td class="bookingsColumn"><b>Number of Guests</b></td>
            <td class="bookingsColumn" colspan="2"><b>Tools</b></td>
            </tr>
        ';
        while ($row = mysqli_fetch_array($result)) {
          $prntServiceName;
          $prntLocationName = "";
          if ($row['serviceID'] == 1) {
            $prntServiceName = 'Food';
          }
          else {
            if ($row['serviceID'] == 2) {
              $prntServiceName = 'Drinks';
            }
            else {
              if ($row['serviceID'] == 3) {
                $prntServiceName = 'Food and Drinks';
              }
              else {
                if ($row['serviceID'] == 4) {
                  $prntServiceName = 'None';
                }
                else {
                  $prntServiceName = 'Error';
                }
              }
            }
          }
          if ($row['locationID'] == 1) {
            $prntLocationName = 'BBQ Area';
          }
          else {
            if ($row['locationID'] == 2) {
              $prntLocationName = 'Main Bar';
            }
            else {
              if ($row['locationID'] == 3) {
                $prntLocationName = 'Function Hall';
              }
              else {
                if ($row['locationID'] == 4) {
                  $prntLocationName = 'Sports Field';
                }
                else {
                  if ($row['locationID'] == 5) {
                    $prntLocationName = 'Gym';
                  }
                  else {
                    $prntLocationName = 'Error';
                  }
                }
              }
            }
          }
          echo '
            <tr class="bookingsRow">
            <td class="bookingsColumn">' . $row['bookingName'] . '</td>
            <td class="bookingsColumn">' . $row['bookingID'] . '</td>
            <td class="bookingsColumn">' . $prntServiceName . '</td>
            <td class="bookingsColumn">' . $prntLocationName . '</td>
            <td class="bookingsColumn">' . $row['startDate'] . '</td>
            <td class="bookingsColumn">' . $row['startTime'] . '</td>
            <td class="bookingsColumn">' . $row['endDate'] . '</td>
            <td class="bookingsColumn">' . $row['endTime'] . '</td>
            <td class="bookingsColumn">£' . $row['cost'] . '</td>
            <td class="bookingsColumn">' . $row['noGuests'] . '</td>
            <td class="bookingsColumn"><a class="bksBtn" href="amend/amend.php?bookingId=' . $row['bookingID'] . '&userId=' . $userid . '"><input class="button center bksBtn" value="Amend"></input></a></td>
            <td class="bookingsColumn"><a class="bksBtn" href="delete/delete.php?bookingId=' . $row['bookingID'] . '&userId=' . $userid . '"><input class="button center bksBtn" value="Delete"></input></a></td>
            </tr>
        ';
        }
        echo '
          </table>
        ';
        mysql_close();
      }
      //if user is not session logged
      else {

        //send user to login
        header('location: ../server/auth/login.php');
      }
    ?>
    <div class="clear" />
    </div>
    <div id="footerBar">
      <p id="tinyText" class="tinyText">
        All content on this page is &#169; Copyright 2012 to <a class="cont" href="http://www.trimleysportsandsocialclub.co.uk/">Trimley Sports and Social Club</a> and Design mimics <a class="cont" href="http://www.jrgwebdesign.co.uk/">JRG Web Design's</a> original design. This webpage was created by Daniel Sarracayo for personal and/or school use.
      </p>
    </div>
  </div>
</body>
</html>