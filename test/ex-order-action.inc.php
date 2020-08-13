<?php
include('ex-order-fetch.inc.php');
$exOrder = new ExRecord();
if(!empty($_POST['action']) && $_POST['action'] == 'listRecords') {
	$exOrder->listRecords();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addRecord') {
	$exOrder->addRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getRecord') {
	$exOrder->getRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateRecord') {
	$exOrder->updateRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$exOrder->deleteRecord();
}
?>