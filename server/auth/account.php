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
  <title>TS&#38;SC | Account</title>
  <style>
    
  </style>
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

          //if they wanted to log out
          if ($_POST['logoutbtn']) {

            //unsetting session variables.
            session_destroy();

            //saying fair well
            echo '
            <div class="showBar">
              <a href="#" class="showBarText">Account ></a>
              <a href="#" class="showBarText">Log Out</a>
            </div>
            <p class="contentText center">Thank you for returning we hope you prosperity. You can use the navigation bar above to go to our homepage.</p><br /><iframe src="//giphy.com/embed/tuvMgAPzxaQBq?html5=true" class="wavingCat" width="480" height="370" frameBorder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            ';
          }

          //if they wanted thier account info
          elseif ($_POST['accountbtn']) {

            require ("hdhfhgadgag/connect.php");
            require ("hdhfhgadgag/mysqli_connect.php");

            $accInfoQry = mysql_query("SELECT * FROM users WHERE userID='$userid'");
            $accRows = mysql_fetch_assoc($accInfoQry);

            $dBuID = $accRows['userID'];
            $dBtitle = $accRows['title'];
            $dBforename = $accRows['forename'];
            $dBsurname = $accRows['surname'];
            $dBemail = $accRows['email'];
            $dBauth = $accRows['auth'];

            $noBooksQry = mysqli_query($link, "SELECT * FROM bookings WHERE userID='userid'");
            $noBooks = mysqli_num_rows($noBooksQry);

            $accType;

            if ($dBauth == 0) {
              $accType = 'Member';
            }
            elseif ($dBauth == 1) {
              $accType = 'Moderator';
            }
            else {
              $accType = 'Admin';
            }

            mysql_close ();

            echo '
            <div class="showBar">
              <a href="../../booking" class="showBarText">Booking ></a>
              <a href="#" class="showBarText">Account Information</a>
            </div>
            <h1 id="contentTitle" class="contentTitle">Your Account</h1>
            <p class="contentText center">From this page you can maintain your account, change your password and delete your account.</p>
            <div class="accountInfoWrapper">
              <table class="accountInfo">
                <tr>
                <td>Account ID:</td>
                <td>' . $dBuID . '</td>
                </tr>
                <tr>
                <td>Title:</td>
                <td>' . $dBtitle . '</td>
                </tr>
                <td>Forename:</td>
                <td>' . $dBforename . '</td>
                </tr>
                <tr>
                <td>Surname:</td>
                <td>' . $dBsurname . '</td>
                </tr>
                <tr>
                <td>Username:</td>
                <td>' . $username . '</td>
                </tr>
                <tr>
                <td>Email:</td>
                <td>' . $dBemail . '</td>
                </tr>
                <tr>
                <td>Number of Bookings:</td>
                <td>' . $noBooks . '</td>
                </tr>
                <tr>
                <td>Account Type:</td>
                <td>' . $accType . '</td>
                </tr>
                <tr>
                <td><form name="updPass" action="account.php" method="POST"><input class="accBtn" name="updPassBtn" type="submit" value="Update Password"></input></form></td>
                <td><form name="delAccount" action="account.php" method="POST"><input class="accBtn" name="delAccountBtn" type="submit" value="Delete Account"></input></form></td>
                </tr>
              </table>
            </div>
            ';

          }

          elseif ($_POST['delAccountBtn']) {
            echo '
            <div class="showBar">
              <a href="account.php" class="showBarText">Account ></a>
              <a href="#" class="showBarText">Delete Account</a>
            </div>
            <div class="accountInfoWrapper">
              <p class="Content Title">Delete your Account</p>
              <p class="contentText">Are you sure that you wish to delete your account? This cannot be un-done.</p>
              <form name="delAccount" action="account.php" method="POST"><input class="accBtn" name="delAccountCONF" type="submit" value="Delete Account"></input></form>
            </div>
            ';
          }

          elseif ($_POST['delAccountCONF']) {
            require ("hdhfhgadgag/connect.php");
            mysql_query("DELETE FROM users WHERE userID='$userid'");
            mysql_close();
            session_destroy();
            echo '
            <div class="showBar">
              <a href="account.php" class="showBarText">Account ></a>
              <a href="#" class="showBarText">Deletion Confirmation</a>
            </div>
            <p class="contentText">Your Account has been deleted. Please use the navigation bar above if you wish to continue browsing our site.</p>
            ';
          }

          elseif ($_POST['updPassBtn']) {

            echo '
            <div class="showBar">
              <a href="account.php" class="showBarText">Account ></a>
              <a href="#" class="showBarText">Update Password</a>
            </div>
            <h1 id="contentTitle" class="contentTitle">Update your Password</h1>
            <p class="contentText center">Here you can change your password.</p>
            <div class="formWrapper">
              <p class="errorMessage"></p>
              <form name="updPass" action="account.php" method="POST">
              <p class="fieldName">Current Password</p>
              <input class="formField" name="pass" type="password" />
              <p class="tinyText">Please enter your current password.</p>
              <p class="fieldName">New Password</p>
              <input class="formField" name="newPass" type="password" />
              <p class="tinyText">Please enter a new password.</p>
              <p class="fieldName">Confirm New Password</p>
              <input class="formField" name="newPassRe" type="password" />
              <p class="tinyText">Please retype your new password.</p>
              <input class="accBtn right" name="updPassConfBtn" type="submit" value="Confirm"></input>
              </form>
              <div class="clear"></div>
            </div>
            ';
          }

          elseif ($_POST['updPassConfBtn']) {

            $getPass = $_POST['pass'];
            $getNewPass = $_POST['newPass'];
            $getNewPassRe = $_POST['newPassRe'];

            //require ("hdhfhgadgag/connect.php");
            //$newPass = md5(md5('f3n4ls' . $getNewPass . 'a6g5af'));

            if ($getPass) {
              if ($getNewPass) {
                if ($getNewPassRe) {
                  if ($getNewPass === $getNewPassRe) {
                    require ("hdhfhgadgag/connect.php");
                    $passCheckQry = mysql_query("SELECT * FROM users WHERE userID='$userid'");
                    $passCheckRow = mysql_fetch_assoc($passCheckQry);
                    $dBpass = $passCheckRow['password'];
                    mysql_close();
                    $entPass = md5(md5('f3n4ls' . $getPass . 'a6g5af'));
                    if ($entPass === $dBpass) {
                      require ("hdhfhgadgag/connect.php");
                      $newPassEnc = md5(md5('f3n4ls' . $getNewPass . 'a6g5af'));
                      mysql_query("UPDATE users SET password='$newPassEnc' WHERE userID='$userid'");
                      mysql_close();
                      header("location: ../../booking");
                    }
                    else {
                      $errMsg = 'Your current password is incorrect, please try again.';
                    }
                  }
                  else {
                    $errMsg = 'Your new password do not match, please re-enter them.';
                  }
                }
                else {
                  $errMsg = 'Please re-enter your new password.';
                }
              }
              else {
                $errMsg = 'Please enter a new password.';
              }
            }
            else {
              $errMsg = 'Please enter your old password.';
            }

            echo '
            <div class="showBar">
              <a href="account.php" class="showBarText">Account ></a>
              <a href="#" class="showBarText">Update Password</a>
            </div>
            <h1 id="contentTitle" class="contentTitle">Update your Password</h1>
            <p class="contentText center">Here you can change your password.</p>
            <div class="formWrapper">
              <form name="updPass" action="account.php" method="POST">
              <p class="errorMessage">' . $errMsg .  '</p>
              <p class="fieldName">Current Password</p>
              <input class="formField" name="pass" type="password" value="' . $getPass . '"/>
              <p class="tinyText">Please enter your current password.</p>
              <p class="fieldName">New Password</p>
              <input class="formField" name="newPass" type="password" />
              <p class="tinyText">Please enter a new password.</p>
              <p class="fieldName">Confirm New Password</p>
              <input class="formField" name="newPassRe" type="password" />
              <p class="tinyText">Please retype your new password.</p>
              <input class="accBtn right" name="updPassConfBtn" type="submit" value="Confirm"></input>
              </form>
              <div class="clear"></div>
            </div>
            ';

          }

          //if the came here by un-intentionally
          else {
            header('location: login.php');
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