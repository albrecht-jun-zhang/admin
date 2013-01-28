<?php
/**
 * 
 * Create pdo connection in controler, so data can be fetched using
 * this created pdo connection when needed in view.
 * 
 */
require_once(dirname(__FILE__)."/../models/adminModel.php");

$adminModel = new AdminModel();
$tableName = 'user';
$userDatas = $adminModel->getAllData($tableName);



/**
 * admin controller used to redirect to adminView.
 * 
 */
require_once(dirname(__FILE__)."/../views/adminView.php");
?>