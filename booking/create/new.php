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
        <a href="#" class="showBarText">Create</a>
      </div>
      <?php
      $userid = $_SESSION['userid'];
      $username = $_SESSION['username'];
      $forename = $_SESSION['forename'];

      if ($username) {
        if ($_POST['newBookingBtn']) {
          $getBookName = $_POST['bookName'];
          $getServiceID = $_POST['service'];
          $getLocationID = $_POST['location'];
          $getsYear = $_POST['syear'];
          $getsMonth = $_POST['smonth'];
          $getsDay = $_POST['sday'];
          $getsHour = $_POST['shour'];
          $getsMinute = $_POST['sminute'];
          $getStartDate = $getsYear . '-' . $getsMonth . '-' . $getsDay;
          $getStartTime = $getsHour . '.' . $getsMinute . '.00';
          $geteYear = $_POST['eyear'];
          $geteMonth = $_POST['emonth'];
          $geteDay = $_POST['eday'];
          $geteHour = $_POST['ehour'];
          $geteMinute = $_POST['eminute'];
          $getEndDate = $geteYear . '-' . $geteMonth . '-' . $geteDay;
          $getEndTime = $geteHour . ':' . $geteMinute . ':00';
          $getNoGuests = $_POST['noGuests'];
          $errorMsg;

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
                if (strlen($getsYear) === 4 && $getsYear >= 2015) {
                  if (strlen($getsMonth) <= 2 && $getsMonth <=12 && $getsMonth >= 1) {
                    if (strlen($getsDay) <= 2 && $getsDay >= 1 && $getsDay <= 31) {
                      if (strlen($getsHour) <=2 && $getsHour <= 24 && $getsHour >=0) {
                        if (strlen($getsMinute) <=2 && $getsMinute <= 59 && $getsMinute >=0) {
                          if (strlen($geteYear) === 4 && $geteYear >= 2015) {
                            if (strlen($geteMonth) <= 2 && $geteMonth <=12 && $geteMonth >= 1) {
                              if (strlen($geteDay) <= 2 && $geteDay >= 1 && $geteDay <= 31) {
                                if (strlen($geteHour) <=2 && $geteHour <= 24 && $geteHour >=0) {
                                  if (strlen($geteMinute) <=2 && $geteMinute <= 24 && $geteMinute >=0) {
                                    if ($getNoGuests <=1000){
                                      //processing time :D
                                      $toDBbookingName = $getBookName;
                                      $toDBuserID = $userid;
                                      $toDBserviceID = $getServiceID;
                                      $toDBlocationID = $getLocationID;
                                      $toDBstartDate = $getStartDate;
                                      $toDBstartTime = $getStartTime;
                                      $toDBendDate = $getEndDate;
                                      $toDBendTime = $getEndTime;
                                      $toDBcost;
                                      $toDBnoGuests = $getNoGuests;
                                      //ADD TO DEM DATABASE
                                      require ("../../server/auth/hdhfhgadgag/connect.php");
                                      mysql_query("INSERT INTO bookings(bookingName, userID, serviceID, locationID, startDate, startTime, endDate, endTime, cost, noGuests) VALUES('$toDBbookingName', '$toDBuserID', '$toDBserviceID', '$toDBlocationID', '$toDBstartDate', '$toDBstartTime', '$toDBendDate', '$toDBendTime', '$toDBcost', '$toDBnoGuests')");
                                      mysql_close();
                                      header('location: ../');
                                    }
                                    else {
                                      $errorMsg = 'Please enter a valid number of guests, the max is 1000.';
                                    }
                                  }
                                  else {
                                    $errorMsg = 'Please enter a valid end minute, e.g. 5 or 45.';
                                  }
                                }
                                else {
                                  $errorMsg = 'Please enter a valid end hour, e.g. 1 or 16.';
                                }
                              }
                              else {
                                $errorMsg = 'Please enter a valid end day, e.g. 1 or 21.';
                              }
                            }
                            else {
                              $errorMsg = 'Please enter a valid end month, e.g 1 or 11.';
                            }
                          }
                          else {
                            $errorMsg = 'Please Enter a valid end year, e.g. 2016.';
                          }
                        }
                        else {
                          $errorMsg = 'Please enter a valid start minute, e.g. 5 or 45.';
                        }
                      }
                      else {
                        $errorMsg = 'Please enter a valid start hour, e.g. 1 or 16.';
                      }
                    }
                    else {
                      $errorMsg = 'Please enter a valid start day, e.g. 1 or 21.';
                    }
                  }
                  else {
                    $errorMsg = 'Please enter a valid start month, e.g 1 or 11.';
                  }
                }
                else {
                  $errorMsg = 'Please Enter a valid start year, e.g. 2016.';
                }
              }
            }
          }
          else {
            $errorMsg = 'Please Enter a Name for your new booking, this will help you remember which one it is.';
          }
        }
        echo '
        <h1 id="contentTitle" class="contentTitle">Create a new Booking</h1><p class="contentText center">Hi, ' . $forename . '. You can now create a new booking. If you get anything wrong, you can edit this booking from your dashboard.</p>
        <div class="formWrapper">
          <p class="errorMessage">'. $errorMsg .'</p>
          <form name="register" class="form" action="new.php" method="POST">
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
              <option value="1">Food (£25)</option>
              <option value="2">Drinks (£25)</option>
              <option value="3">Food and Drinks (£40)</option>
              <option value="4">None</option>
            </select>
            <p class="tinyText">
              Please Choose a Service.
            </p>
            <br />
            <p class="fieldName">
              Location
            </p>
            <select class="formSelect" name="location" value="' . $getLocation . '">
              <option value="null">-- Please Choose One --</option>
              <option value="1">BBQ Area (£25)</option>
              <option value="2">Main Bar (£10)</option>
              <option value="3">Function Hall (£50)</option>
              <option value="4">Sports Field (£150)</option>
              <option value="5">Gym (£30)</option>
            </select>
            <p class="tinyText">
              Please Choose a Location.
            </p>
            <br />
            <p class="fieldName">
              Start Date
            </p>
            <table class="dateTable">
              <tr class="dateTable">
                <td class="dateTable">Year</td>
                <td class="dateTable">Month</td>
                <td class="dateTable">Day</td>
                <td class="dateTable" colspan="2">Time</td>
              </tr>
              <tr class="dateTable">
                <td class="dateTable"><input class="dateInput" name="syear" value="2015"></input></td>
                <td class="dateTable"><input class="dateInput" name="smonth" value="' . $getsMonth . '"></input></td>
                <td class="dateTable"><input class="dateInput" name="sday" value="' . $getsDay . '"></input></td>
                <td class="dateTable"><input class="timeInput" name="shour" value="' . $getsHour . '"></input></td>
                <td class="dateTable"><input class="timeInput" name="sminute" value="00"></input></td>
              </tr>
              <tr class="dateTable">
                <td class="dateTable" colspan="5"><p class="tinyText">Please enter the start date, time must be in 24 format.</p></td>
              </tr>
            </table>
            <br />
            <p class="fieldName">
              End Date
            </p>
            <table class="dateTable">
              <tr class="dateTable">
                <td class="dateTable">Year</td>
                <td class="dateTable">Month</td>
                <td class="dateTable">Day</td>
                <td class="dateTable" colspan="2">Time</td>
              </tr>
              <tr class="dateTable">
                <td class="dateTable"><input class="dateInput" name="eyear" value="2015"></input></td>
                <td class="dateTable"><input class="dateInput" name="emonth" value="' . $geteMonth . '"></input></td>
                <td class="dateTable"><input class="dateInput" name="eday" value="' . $geteDay . '"></input></td>
                <td class="dateTable"><input class="timeInput" name="ehour" value="' . $geteHour . '"></input></td>
                <td class="dateTable"><input class="timeInput" name="eminute" value="00"></input></td>
              </tr>
              <tr class="dateTable">
                <td class="dateTable" colspan="5"><p class="tinyText">Please enter the end date, time must be in 24 format.</p></td>
              </tr>
            </table>
            <br />
            <p class="fieldName">
              Expected Number of Guests
            </p>
            <input id="repassfield" class="formField" type="number" name="noGuests" value="' . $getNoGuests . '"></input>
            <p class="tinyText">
              Please Enter a rough number of guests.
            </p>
            <br />
            <input id="helpBut" class="button left" name="helpbtn" type="button" value="Help" />
            <input id="registerBut" class="button right" name="newBookingBtn" type="submit" value="Confirm" />
          </form>
          <div class="clear"></div>
        </div>
        ';
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