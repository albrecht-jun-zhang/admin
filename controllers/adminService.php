<?php
/**
 * Update, Insert or Delete data in db
 *
 * @author Jun
 */
require_once(dirname(__FILE__)."/../models/adminModel.php");

$adminModel = new AdminModel();
$tableName = 'user';
// Retrieve posted value via ajax
$array = $_POST['datas'];

if($array[4] == "UPDATE") {
    try {
        // Precheck if there is the userName you typed in existing
        $sql = "SELECT userName FROM $tableName WHERE userName = :userName";
        $sth = $adminModel->mDBH->prepare($sql);
        $sth->bindParam(':userName', $array[1]);
        $sth->execute();
        $results = $sth->fetch(PDO::FETCH_ASSOC);
        if($results == false) {
            echo '0';
            return;
        }
        
        $sql = "UPDATE $tableName SET slotNumber = :slotNumber, 
        userName = :userName, isActive = :isActive, password = :password
        WHERE userName = :userName";    
        $sth = $adminModel->mDBH->prepare($sql);
        $sth->bindParam(':slotNumber', $array[0]);
        $sth->bindParam(':userName', $array[1]);
        $sth->bindParam(':isActive', $array[2]);
        $sth->bindParam(':password', $array[3]);
        $isSuccess = $sth->execute();    
        echo $isSuccess;
    } catch(PDOException $e) {
        echo "Exception caught when updating data() --- ", 
            $e->getMessage(), "\n";
        die;
    }    
} else if($array[4] == 'DELETE') {
    try {
        // Precheck if there is the userName you typed in existing
        $sql = "SELECT userName FROM $tableName WHERE userName = :userName";
        $sth = $adminModel->mDBH->prepare($sql);
        $sth->bindParam(':userName', $array[1]);
        $sth->execute();
        $results = $sth->fetch(PDO::FETCH_ASSOC);
        if($results == false) {
            echo '0';
            return;
        }
        
        $sql = "DELETE FROM $tableName WHERE userName = :userName";    
        $sth = $adminModel->mDBH->prepare($sql);
        $sth->bindParam(':userName', $array[1]);
        $isSuccess = $sth->execute();
        echo $isSuccess;
    } catch(PDOException $e) {
        echo "Exception caught when delete data() --- ", 
            $e->getMessage(), "\n";
        die;
    }   
} else if($array[4] == 'INSERT') {
    try {
        // Precheck if there is already a same user name typed in
        // the database, if yes, stop insert; otherwise insert
        $sql = "SELECT userName FROM $tableName WHERE userName=:userName";
        $sth = $adminModel->mDBH->prepare($sql);
        $sth->bindParam(':userName', $array[1]);
        $sth->execute();
        $results = $sth->fetch(PDO::FETCH_ASSOC);
        if($results != false) {
            echo "0";
            return;
        }        
        // Insert
        $sql = "INSERT INTO $tableName VALUES(:slotNumber, :userName, 
            :isActive, :password)";    
        $sth = $adminModel->mDBH->prepare($sql);
        $sth->bindParam(':slotNumber', $array[0]);
        $sth->bindParam(':userName', $array[1]);
        $sth->bindParam(':isActive', $array[2]);
        $sth->bindParam(':password', $array[3]);
        $isSuccess = $sth->execute();
        echo $isSuccess;
    } catch(PDOException $e) {
        echo "Exception caught when delete data() --- ", 
            $e->getMessage(), "\n";
        die;
    }  
}

?>
