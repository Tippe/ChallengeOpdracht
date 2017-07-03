<?php
require(ROOT . "model/PlanningModel.php");
require(ROOT . "model/CustomerModel.php");

function all() {
    if ( isAdmin() == true ) {
    	render("planning/view-admin", array(
	        'planning' => getFullPlanning()
	    ));
    } else{
    	render("planning/view", array(
	        'planning' => getRestrictedPlanning()
	    ));
    }
}

function planned() {
	render("planning/ingepland", array(
        'planning' => getOwnPlanning()
    ));
}

function create() {
    render("planning/create");
}

function createSave() {
    $_SESSION['previous_post_data'] = $_POST;

    if (!createPlanning() ) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location:" . URL . 'planning/all');
    }
}

function inplannen($id) {
    $previous_url = $_SERVER['HTTP_REFERER'];

    if (confirmPlanning($id, $_SESSION["userid"])) {
        $_SESSION['info'][] = 'You are scheduled for given time.';
    } else {
        $_SESSION['errors'][] = 'Error: Could not save.';
    }
    header("Location:" . $previous_url);
}

function cancel($id) {
    $previous_url = $_SERVER['HTTP_REFERER'];

    if (confirmPlanning($id)) {
        $_SESSION['info'][] = 'This appointment has been cancelled.';
    } else {
        $_SESSION['errors'][] = 'Error: Could not save.';
    }

    header("Location:" . $previous_url);
}

function success($id) {
    $previous_url = $_SERVER['HTTP_REFERER'];

    if (updatePlanning($id, 1)) {
        $_SESSION['info'][] = 'Customer has visited.';
    } else {
        $_SESSION['errors'][] = 'Error: Could not save.';
    }

    header("Location:" . $previous_url);
}

function fail($id) {
    $previous_url = $_SERVER['HTTP_REFERER'];

    if (updatePlanning($id, 2)) {
        $_SESSION['info'][] = 'Customer did not come.';
    } else {
        $_SESSION['errors'][] = 'Error: Could not save.';
    }

    header("Location:" . $previous_url);
}

function delete($id) {
	$previous_url = $_SERVER['HTTP_REFERER'];

    if (deletePlanning($id)) {
        $_SESSION['info'][] = 'The available date has been deleted.';
    } else {
        $_SESSION['errors'][] = 'Error: Could not save.';
    }

    header("Location:" . $previous_url);
}

function isAdmin() {
    return (isset($_SESSION['useradmin']) && $_SESSION['useradmin'] == 1 );
}

function sendRedirectWithError($message) {
    $_SESSION['errors'][] = $message;
    header("Location:" . URL . 'home/index');
}