<?php
/**
 * Update, Insert or Delete data in db
 *
 * @author Jun
 */
require_once(dirname(__FILE__)."/../models/adminModel.php");

$adminModel = new AdminModel();
$tableName = 'user';
$array = $_POST['datas'];
if($array[4] == "UPDATE") {
    try {
    $sql = "UPDATE $tableName SET slotNumber = :slotNumber, 
    userName = :userName, isActive = :isActive, password = :password
    WHERE userName = :userName";    
    $sth = $adminModel->mDBH->prepare($sql);
    $sth->bindParam(':slotNumber', $array[0]);
    $sth->bindParam(':userName', $array[1]);
    $sth->bindParam(':isActive', $array[2]);
    $sth->bindParam(':password', $array[3]);
    $sth->execute();
    } catch(PDOException $e) {
        echo "Exception caught when updating data() --- ", 
            $e->getMessage(), "\n";
        die;
    }    
}

?>
