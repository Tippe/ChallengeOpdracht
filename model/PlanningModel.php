<?php

function getFullPlanning() {
    $db = openDatabaseConnection();

    $sql = "SELECT * FROM appointments";
    $query = $db->prepare($sql);
    $query->execute(array());

    $db = null;

    return $query->fetchAll();
}

function getRestrictedPlanning()
{
	$db = openDatabaseConnection();

    $sql = "SELECT * FROM appointments WHERE reserved='No'";
    $query = $db->prepare($sql);
    $query->execute(array());

    $db = null;

    return $query->fetchAll();
}

function getOwnPlanning()
{
	$db = openDatabaseConnection();

    $sql = "SELECT * FROM appointments WHERE reserved='Yes' AND customer='".$_SESSION["userid"]."'";
    $query = $db->prepare($sql);
    $query->execute(array());

    $db = null;

    return $query->fetchAll();
}

function getPlanning($id)
{
    $db = openDatabaseConnection();

    $sql = "SELECT id FROM appointments WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(array(
        ':id' => $id,
    ));
    $db = null;

    return $query->fetch();
}

function confirmPlanning($id, $userid = null) {
    $plan = getPlanning($id);

    if (!$plan) return false;

    $db = openDatabaseConnection();

    if ($userid == null) {
    	$sql = "UPDATE appointments SET customer = :customer,  reserved = :reserved WHERE id = :id";
	    $query = $db->prepare($sql);
	    $query->execute(array(
	        ':id' => $id,
	        ':customer' => $userid,
	        ':reserved' => "No",
	    ));
    } else{
	    $sql = "UPDATE appointments SET customer = :customer,  reserved = :reserved WHERE id = :id";
	    $query = $db->prepare($sql);
	    $query->execute(array(
	        ':id' => $id,
	        ':customer' => $userid,
	        ':reserved' => "Yes",
	    ));
	}

    $error_info = $query->errorInfo();
    if ( $error_info[0] != '00000') {
        $_SESSION['errors'][] = $error_info[2];
        return false;
    }

    $db = null;

    return true;
}

function updatePlanning($id, $newstatus) {
    $plan = getPlanning($id);

    if (!$plan) return false;

    $db = openDatabaseConnection();

    $sql = "UPDATE appointments SET status = :status WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(array(
        ':id' => $id,
        ':status' => $newstatus,
    ));

    $error_info = $query->errorInfo();
    if ( $error_info[0] != '00000') {
        $_SESSION['errors'][] = $error_info[2];
        return false;
    }

    $db = null;

    return true;
}

function deletePlanning($id) {
    $plan = getPlanning($id);

    if (!$plan) return false;

    $db = openDatabaseConnection();

    $sql = "DELETE FROM appointments WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(array(
        ':id' => $id,
    ));

    $error_info = $query->errorInfo();
    if ( $error_info[0] != '00000') {
        $_SESSION['errors'][] = $error_info[2];
        return false;
    }

    $db = null;

    return true;
}

function createPlanning() {
    $employee = isset($_POST['employee']) ? $_POST['employee'] : null;
	$date = isset($_POST['date']) ? $_POST['date'] : null;
	$start_time = isset($_POST['start_end']) ? $_POST['start_time'] : null;
	$end_time = isset($_POST['end_time']) ? $_POST['end_time'] : null;
	$customer = isset($_POST['`customer']) ? $_POST['customer'] : null;
	$reserved = isset($_POST['reserved']) ? $_POST['reserved'] : null;
	$status = isset($_POST['status']) ? $_POST['status'] : null;
	
	if (strlen($employee) == 0 || strlen($date) == 0 || strlen($start_time) < 6 || strlen($end_time) < 6 || strlen(customer) == 0 || strlen($reserved) == 0 || strlen($status) == 0) {
		return false;
	}
	
	$db = openDatabaseConnection();

    $error_info = $query->errorInfo();
    if ( $error_info[0] != '00000') {
        // something went wrong
        $_SESSION['errors'][] = $error_info[2];
        return false;
    }

    // check if user was found. if so, return false
    if ( $query->rowCount() > 0 ) {
    	$_SESSION['errors'][] = 'This planning already exists.';
    	$db = null;
    	return false;
    }

	$sql = "INSERT INTO appointments(employee, date, start_time, end_time, customer, reserved, status) VALUES (:employee, :date, :start_time, :end_time, :customer, :reserved, :status)";
	$query = $db->prepare($sql);
	$query->execute(array(
		':employee' => $employee,
		':date' => $date,
		':start_time' => $start_time,
		':end_time' => $end_time,
		':customer' => $customer,
		':reserved' => $reserved,
		':status' => $status
    ));

	$db = null;
	
	return true;
}