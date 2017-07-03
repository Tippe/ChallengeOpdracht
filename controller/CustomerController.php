<?php

require(ROOT . "model/CustomerModel.php");

function login() {
	render('customer/login');
}

// This function logs out the user and ends the session
function logout() {
	$_SESSION = array();

	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}

	session_destroy();

	header('location: ' . URL . '/');
	exit;
}

function loginProcess()
{
    if ( isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = checkUser($username, $password); //check usernodig voor DB

        if ($user == false) {
            $_SESSION['errors'][] = 'Kon niet inloggen. Probeer het opnieuw.';
            header('location: ' . URL . 'customer/login');
            exit;
        } else {
            $_SESSION['username'] = $user['username'];
            $_SESSION['useradmin'] = $user['barber'];
            $_SESSION['userid'] = $user['id'];
        }
    } else {
        $_SESSION['errors'][] = 'Vul alstublieft een gebruikersnaam en wachtwoord in.';
        header('location: ' . URL . 'customer/login');
        exit;
    }

    header('location: ' . URL . 'home/index');
}

function register()
{
	render("customer/register");
}

function createSave()
{
	if (!createCustomer()) {
		header("Location:" . URL . "error/index");
		exit();
	}

	header("Location:" . URL . "home/index");
}

function viewinfo($id)
{
	render("customer/viewinfo", array(
		'customer' => getUser($id)
	));
}

function delete($id)
{
	if (!deleteStudent($id)) {
		header("Location:" . URL . "error/index");
		exit();
	}

	header("Location:" . URL . "home/index");
}

function isAdmin() {
    return (isset($_SESSION['useradmin']) && $_SESSION['useradmin'] == 1 );
}