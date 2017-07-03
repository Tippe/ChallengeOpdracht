<?php
function getEmployee($id) {
    $db = openDatabaseConnection();

    $sql = "SELECT firstname FROM customers WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(array(
        ":id" => $id,
    ));

    $db = null;

    return $query->fetch();
}

function getCustomer($id) {
    $db = openDatabaseConnection();

    $sql = "SELECT firstname, lastname FROM customers WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(array(
        ":id" => $id,
    ));

    $db = null;

    return $query->fetch();
}


function checkUser($username, $password)
{
    $db = openDatabaseConnection();

    $sql = "SELECT * FROM customers WHERE username = :username AND password= :password";
    $query = $db->prepare($sql);
    $query->execute(array(
        ":username" => $username,
        ":password" => sha1($password),
    ));

    $db = null;

    $error_info = $query->errorInfo();
    if ( $error_info[0] != '00000') {
        $_SESSION['errors'][] = $error_info[2];
        return false;
    }

    if ( $query->rowCount() != 1 ) {
        $_SESSION['errors'][] = 'user/password combination not found';
        return false;
    }
    return $query->fetch();
}


function getUser($id) 
{
	$db = openDatabaseConnection();

	$sql = "SELECT * FROM customers WHERE id = :id";
	$query = $db->prepare($sql);
	$query->execute(array(
		":id" => $id));

	$db = null;

	return $query->fetch();
}

function deleteCustomer($id = null) 
{
	if (!$id) {
		return false;
	}
	
	$db = openDatabaseConnection();

	$sql = "DELETE FROM customers WHERE id=:id ";
	$query = $db->prepare($sql);
	$query->execute(array(
		':id' => $id));

	$db = null;
	
	return true;
}

function createCustomer() 
{
	$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
	$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
	$username = isset($_POST['username']) ? $_POST['username'] : null;
	$password = isset($_POST['password']) ? $_POST['password'] : null;
	$email = isset($_POST['email']) ? $_POST['email'] : null;
	$address = isset($_POST['address']) ? $_POST['address'] : null;
	$postalcode = isset($_POST['postalcode']) ? $_POST['postalcode'] : null;
	$city = isset($_POST['city']) ? $_POST['city'] : null;
	$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : null;
	
	if (strlen($firstname) == 0 || strlen($lastname) == 0 || strlen($username) < 6 || strlen($password) < 6 || strlen($email) == 0 || strlen($address) == 0 || strlen($postalcode) == 0 || strlen($city) == 0 || strlen($mobile) == 0) {
		return false;
	}
	
	$db = openDatabaseConnection();

	$sql = "SELECT id FROM customers WHERE username = :username";
    $query = $db->prepare($sql);
    $query->execute(array(
        ":username" => $username,
    ));

    $error_info = $query->errorInfo();
    if ( $error_info[0] != '00000') {
        // something went wrong
        $_SESSION['errors'][] = $error_info[2];
        return false;
    }

    // check if user was found. if so, return false
    if ( $query->rowCount() > 0 ) {
    	$_SESSION['errors'][] = 'Deze gebruikersnaam bestaat al.';
    	$db = null;
    	return false;
    }

	$sql = "INSERT INTO customers(firstname, lastname, username, password, email, address, postalcode, city, mobile) VALUES (:firstname, :lastname, :username, :password, :email, :address, :postalcode, :city, :mobile)";
	$query = $db->prepare($sql);
	$query->execute(array(
		':firstname' => $firstname,
		':lastname' => $lastname,
		':username' => $username,
		':password' => sha1($password),
		':email' => $email,
		':address' => $address,
		':postalcode' => $postalcode,
		':city' => $city,
		':mobile' => $mobile));

	$db = null;
	
	return true;
}
