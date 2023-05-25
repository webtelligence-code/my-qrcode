<?php

include 'DatabaseConnect.php';
include 'session.php';

$databaseObj = new DatabaseConnect;
$conn = $databaseObj->connect();

///////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////GET////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

// Function that will user's session data
function getUser()
{
  session_start();

  if (isset($_SESSION['id'])) {
    // User is logged in
    $sessionData = array(
      'id' => $_SESSION['id'],
      'username' => $_SESSION['username'],
      'fullName' => $_SESSION['fullName'],
      'firstName' => $_SESSION['firstName'],
      'lastName' => $_SESSION['lastName'],
      'email' => $_SESSION['email'],
      'password' => $_SESSION['password'],
      'dateOfBirth' => $_SESSION['dateOfBirth'],
      'isAdmin' => $_SESSION['isAdmin'],
      'address' => $_SESSION['address'],
      'phone' => $_SESSION['phone'],
      'avatar' => $_SESSION['avatar'],
      'bio' => $_SESSION['bio'],
      'gender' => $_SESSION['gender'],
      'country' => $_SESSION['country'],
      'city' => $_SESSION['city'],
      'state' => $_SESSION['state'],
      'postalCode' => $_SESSION['postalCode'],
      'website' => $_SESSION['website'],
      'lastModified' => $_SESSION['lastModified'],
      'accountStatus' => $_SESSION['accountStatus'],
      'emailVerified' => $_SESSION['emailVerified'],
      'dateCreated' => $_SESSION['dateCreated'],
      'lastLoginDate' => $_SESSION['lastLoginDate'],
      'lastLoginTime' => $_SESSION['lastLoginTime'],
    );
  } else {
    // User is not logged in
    $sessionData = null;
  }

  return $sessionData;
}

function login($username, $password)
{
  global $conn;

  // Prepare the SQL statement to fetch user data from the database
  $sql = "SELECT * FROM users WHERE username = ?";

  // Prepare and execute the statement
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();

  // Fetch the user data
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  // Check if the user exists and the password is correct
  if ($user && password_verify($password, $user['password'])) {
    // Set the session variables
    session_start();
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['fullName'] = $user['fullName'];
    $_SESSION['firstName'] = $user['firstName'];
    $_SESSION['lastName'] = $user['lastName'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['password'] = $user['password'];
    $_SESSION['dateOfBirth'] = $user['dateOfBirth'];
    $_SESSION['isAdmin'] = $user['isAdmin'];
    $_SESSION['address'] = $user['address'];
    $_SESSION['phone'] = $user['phone'];
    $_SESSION['avatar'] = $user['avatar'];
    $_SESSION['bio'] = $user['bio'];
    $_SESSION['gender'] = $user['gender'];
    $_SESSION['country'] = $user['country'];
    $_SESSION['city'] = $user['city'];
    $_SESSION['state'] = $user['state'];
    $_SESSION['postalCode'] = $user['postalCode'];
    $_SESSION['website'] = $user['website'];
    $_SESSION['lastModified'] = $user['lastModified'];
    $_SESSION['accountStatus'] = $user['accountStatus'];
    $_SESSION['emailVerified'] = $user['emailVerified'];
    $_SESSION['dateCreated'] = $user['dateCreated'];
    $_SESSION['lastLoginDate'] = $user['lastLoginDate'];
    $_SESSION['lastLoginTime'] = $user['lastLoginTime'];
    // Set other session variables as needed

    // Return true to indicate successful login
    return true;
  }

  // Return false if login fails
  return false;
}

