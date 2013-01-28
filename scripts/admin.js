/* 
 * Custom js function
 * @author: Jun Zhang
 */

/**
 * Generate array including the value of slotNumber, useName, isActive and 
 * password
 * @param string index: row number (1 to 10)
 */
function generateRecord(index) {
    var slotId = '#textSlotNumber' + index;
    var userId = '#textUserName' + index;
    var isActiveId = '#tbIsActive' + index + '_label';
    var passwordId = '#textPassword' + index; 
    
    var daten = new Array();
//    daten['slotNumber'] = $(slotId).val();
//    daten['userName'] = $(userId).val();
    daten[0] = $(slotId).val();
    daten[1] = $(userId).val();
    if($(isActiveId).text() == 'Active') {
//        daten['isActive'] = 1;
        daten[2] = 1;
    } else {
//        daten['isActive'] = 0;
        daten[2] = 0;
    }
//    daten['password'] = $(passwordId).val();
    daten[3] = $(passwordId).val();
    return daten;
}

/**
 * Validate if the current contains blank field
 * @param string index: index from 1 to 10(slot)
 * return: true if non empty; otherwise empty
 */
function validateEmpty(index) {
    // slot number
    var tmpId = '#textSlotNumber' + index;
    if($(tmpId).val().localeCompare('') == 0) {
        return false;
    }
    // user name
    tmpId = '#textUserName' + index;
    if($(tmpId).val().localeCompare('') == 0) {
        return false;
    }
    // password
    tmpId = '#textPassword' + index;
    if($(tmpId).val().localeCompare('') == 0) {
        return false;
    }    
    
    return true;
}

/**
 * Update row in db
 */
function processDB(datas, action) {
    // Add action 
//    datas['action'] = action;
    datas[4] = action;
    
    $.ajax({
        type: "POST",
        url: "http://"+location.host+"/admin/controllers/adminService.php",
        data: {datas:datas},
//        data: JSON.stringify({jun:'albrecht'}),        
//        processData: false,
//        contentType: false,
//        dataType: 'json',
//        contentType: "application/json",
        error: function(jqXHR, textStatus, errorMessage) {
            console.log(errorMessage);
        },
        success: function(data) {
            alert(action + " successful!");
        } 
    });
}

/**
 * get last character from the given str
 * @param string str: e.g. abc1
 * return: last character e.g. 1
 */
function getLastChar(str) {
    var index = str[str.length - 1];
    return index;
}


