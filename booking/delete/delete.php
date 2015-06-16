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
  <title>TS&#38;SC | New Booking</title>
  <style>
    
  </style>
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
            <a class="nav" href="../../membersbar/">Members Bar</a>
          </li>
          <li class="nav">
            <a class="nav" href="../../functions/">Function Hall</a>
          </li>
          <li class="nav">
            <a class="nav" href="../">Book Online</a>
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
        <a href="../" class="showBarText">Booking ></a>
        <a href="#" class="showBarText">Delete</a>
      </div>
      <?php
      //session variables
      $userid = $_SESSION['userid'];
      $username = $_SESSION['username'];
      $forename = $_SESSION['forename'];

      if ($_POST['DeleteBookCONF']) {
        $bookID = $_POST['bookingIDCONF'];
        require ("../../server/auth/hdhfhgadgag/connect.php");
        mysql_query("DELETE FROM bookings WHERE userID='$userid' AND bookingID='$bookID'");
        mysql_close();
        header('location: ../');
      }
      //Logged in check
      elseif ($username) {
        $getBookingId = $_GET['bookingId'];
        $getUserId = $_GET['userId'];
        require ("../../server/auth/hdhfhgadgag/connect.php");
        $cheBookQry = mysql_query("SELECT * FROM bookings WHERE bookingID='$getBookingId'");
        $numBooks = mysql_num_rows($cheBookQry);
        $bookRow = mysql_fetch_assoc($cheBookQry);
        $dBbookname = $bookRow['bookingName'];
        $dBserviceid = $bookRow['serviceID'];
        $dBlocationid = $bookRow['locationID'];
        $dBstartdate = $bookRow['startDate'];
        $dBstarttime = $bookRow['startTime'];
        $dBenddate = $bookRow['endDate'];
        $dBendtime = $bookRow['endTime'];
        $dBnoguests = $bookRow['noGuests'];
        $dBservice; //Resolved Service
        $dBlocation; //Resolve Location

        //Service Resolution Code BLock
        if ($dBserviceid == 1) {
          $dBservice = 'Food';
        }
        else {
          if ($dBserviceid == 2) {
            $dBservice = 'Drinks';
          }
          else {
            if ($dBserviceid == 3) {
              $dBservice = 'Food and Drinks';
            }
            else {
              if ($dBserviceid == 4) {
                $dBservice = 'None';
              }
              else {
                $dBservice = 'Error';
              }
            }
          }
        }

        //Location Resolution Code Block
        if ($dBlocationid == 1) {
          $dBlocation = 'BBQ Area';
        }
        else {
          if ($dBlocationid == 2) {
            $dBlocation = 'Main Bar';
          }
          else {
            if ($dBlocationid == 3) {
              $dBlocation = 'Function Hall';
            }
            else {
              if ($dBlocationid == 4) {
                $dBlocation = 'Sports Field';
              }
              else {
                if ($dBlocationid == 5) {
                  $dBlocation = 'Gym';
                }
                else {
                  $dBlocation = 'Error';
                }
              }
            }
          }
        }
        mysql_close();

        //Reloveing Location and Service
        if ($numBooks >= 1) {
          echo '
          <h1 id="contentTitle" class="contentTitle">Delete Booking</h1><p class="contentText center">Hi, ' . $forename . '. You can now confirm that you wishto delete this booking, please not that this cannot be un-done.</p>
          <div class="formWrapper">
            <br />
            <p class="fieldName">This is a static version of your booking as it stands. To confirm the deletion please click confirm below.</p>
            <br />
            ' . $errBook . '
            <p class="fieldName">
              Booking Name
            </p>
            <div class="amendFakeField"><p class="contentText fakeField">' . $dBbookname . '</p></div>
            <br />
            <p class="fieldName">
              Service
            </p>
            <div class="amendFakeField"><p class="contentText fakeField">' . $dBservice . '</p></div>
            <br />
            <p class="fieldName">
              Location
            </p>
            <div class="amendFakeField"><p class="contentText fakeField">' . $dBlocation . '</p></div>
            <br />
            <table class="delete">
            <tr>
            <td><p class="fieldName center">Start Date</p></td>
            <td><p class="fieldName center">Start Time</p></td>
            </tr>
            <tr class="delete">
            <td><p class="fakeField">' . $dBstartdate . '</p></td>
            <td><p class="fakeField">' . $dBstarttime . '</p></td>
            </tr>
            </table>
            <br />
            <table class="delete">
            <tr>
            <td><p class="fieldName center">End Date</p></td>
            <td><p class="fieldName center">End Time</p></td>
            </tr>
            <tr class="delete">
            <td><p class="fakeField">' . $dBenddate . '</p></td>
            <td><p class="fakeField">' . $dBendtime . '</p></td>
            </tr>
            </table>
            <br />
            <p class="fieldName">
              Expected Number of Guests
            </p>
            <div class="amendFakeField"><p class="contentText fakeField">' . $dBnoguests . '</p></div>
            <br />
            <form name="confirmDeletion" action="delete.php" method="POST">
              <input type="text" class="smallInput" name="bookingIDCONF" value="' . $getBookingId . '" readonly />
              <input type="submit" class="button right" name="" value="Cancel"></input>
              <input type="submit" class="button right" name="DeleteBookCONF" value="Confirm"></input>
            </form>
            <div class="clear"></div>
          </div>
          ';
        }
        else {
          header('location: ../');
        }
      }
      else {
        header('location: ../');
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