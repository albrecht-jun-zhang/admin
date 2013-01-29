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
    daten[0] = $(slotId).val();
    daten[1] = $(userId).val();
    if($(isActiveId).text() == 'Active') {        
        daten[2] = 1;
    } else {        
        daten[2] = 0;
    }    
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
 * 
 * @param array datas: slotNumber, userName, isAcitve and password
 * @param string action: UPDATE, DELETE...
 * @param string index: combo's wrap div's id(only a number of row e.g. 1 or 7)
 */
function processDB(datas, action, index) {
    // Add action 
    datas[4] = action;
    
    $.ajax({
        type: "POST",
        url: "http://"+location.host+"/admin/controllers/adminService.php",
        data: {datas:datas},
        error: function(jqXHR, textStatus, errorMessage) {
            console.log(errorMessage);
        },
        success: function(data) {            
            if(action == 'UPDATE') {
                // Update success
                if(data == 1) {
                    alert(action + " successful!");
                // Update unsuccess
                } else {
                    alert(action + " unsuccessful! Make sure that you have clicked Insert first, before update the new record!");
                }
            } else if(action == 'DELETE') {  
                if(data == 1) {                    
                    // Delete success
                    // Get the biggest div id
                    var oldDivIndex = $('div:first').siblings('div:last').attr('id');
                    
                    
                    // If you delete the last div                    
                    oldDivIndex = oldDivIndex.replace('div', '');
                    if(oldDivIndex == index) {
                        var lastExistingDivJQueryId = $('div#div'+oldDivIndex).
                            siblings('div:last').attr('id');
                        lastExistingDivJQueryId = 'div#'+lastExistingDivJQueryId;
                    } else {
                        // If you are not deleting the last div                        
                        var lastExistingDivJQueryId = 'div#div' + oldDivIndex;
                    }
                    
                    // Delete the current div row
                    $('div#div'+index).remove();
                    
                    // Add a new div row at the bottom                    
                    newDivIndex = parseInt(oldDivIndex) + 1;
                    newDivId = 'div' + newDivIndex;
                    newButtonId = 'buttonAdd' + newDivIndex;
                    $(lastExistingDivJQueryId).after("<div id='" +newDivId+ "'>\n\
                        <label style='margin-right: 492px;'>\n\
                        Empty slot, new user can be added here.\n\
                        </label>\n\
                        <button id='"+newButtonId+"'></button></div>");
                    // Create a new dojo button programmatically
                    require(["dojo/ready", "dijit/form/Button", "dojo/dom"], function(ready, Button, dom){
                        ready(function(){
                            var newButton = new Button({
                                label: "Add",                                
                                onClick: function() {
                                    generateRowData(newDivIndex);
                                }
                            }, "buttonAdd"+newDivIndex);
                        });
                    });
                    
                    alert(action + " successful!");                    
                } else {
                    // Delete unsuccess
                    alert(action + " unsuccessful! Make sure that you have clicked Insert first, before delete the new record!");
                }
            } else if(action == 'INSERT') {
                // Insert success
                if(data == 1) {                    
                    $('#textUserName' + index).attr('disabled', 'disabled');
                    alert(action + " successful!");
                // Insert unsuccess
                } else {
                    alert(action + " unsuccessful! You have already inserted this user name before!");
                }
            }
            
        } 
    });
}

/**
 * After user clicked add button, generate a new row data, 
 * where user needs to fill in slotNumber, userName, isActive and password
 * 
 * @param string rowIndex: row number from 1 to infinite
 */
function generateRowData(rowIndex) {
    // Clear the current div's content: one label and one button
    $('div#div' + rowIndex).html('');
    
    var curSlotNumber = 'textSlotNumber' + rowIndex;
    var curUserName = 'textUserName' + rowIndex;
    var curIsActive = 'tbIsActive' + rowIndex;
    var curPassword = 'textPassword' + rowIndex;
    var curComboUpdateDelete = 'comboUpdateDelete' + rowIndex;   
    // Add new row data into the current div
    $('div#div' + rowIndex).append(    
        "<input id='" +curSlotNumber+ "'/>\n\
         <input id='" +curUserName+ "'/>\n\
         <button id='" +curIsActive+ "'>\n\
         </button>\n\
         <input id='" +curPassword+ "'/>\n\
         <div id='"+curComboUpdateDelete+"'></div>"
    );
    // Render slotNumber textbox
    require(["dojo/ready", "dijit/form/TextBox", "dijit/form/ToggleButton", 
        "dijit/Menu", "dijit/MenuItem", "dijit/form/ComboButton"], 
        function(ready, TextBox, ToggleButton, Menu, MenuItem, ComboButton){
        ready(function(){
            // slotNumber textbox
            new dijit.form.TextBox({
                value: "" /* no or empty value! */,
                placeHolder: "Enter slot number here.",
                style: "width: 100px;"
            }, curSlotNumber);
            // user name text box
            new dijit.form.TextBox({
                value: "" /* no or empty value! */,
                placeHolder: "Enter user name here.",
                style: "width: 200px;"
            }, curUserName);
            // isActive toggle button
            new ToggleButton({               
                onChange: function(val){
                    if(val == true) {
                        this.set('label', 'Inactive')
                    } else {
                        this.set('label', 'Active')
                    }
                },
                label: "Inactive",
                style: "width:68px;"
            }, curIsActive);
            // password textbox
            new dijit.form.TextBox({
                value: "" /* no or empty value! */,
                placeHolder: "Enter password here.",
                style: "width: 200px;"
            }, curPassword);            
            // Combo Button
            // Update menu item
            var menuId = 'menu' + rowIndex;
            var menu = new Menu({ 
                style: "display: none;",
                id: menuId
            });
            var menuItem1 = new MenuItem({
                label: "Update",
                onClick: function(){ 
                    addSelectedIntoComboButton(this.getParent().id, 'Update');
                }
            });
            menu.addChild(menuItem1);
            // Delete menu item
            var menuItem2 = new MenuItem({
                label: "Delete",
                onClick: function(){
                    addSelectedIntoComboButton(this.getParent().id, 'Delete');
                }
            });
            menu.addChild(menuItem2);
            // Insert menu item
            var menuItem3 = new MenuItem({
                label: "Insert",
                onClick: function(){
                    addSelectedIntoComboButton(this.getParent().id, 'Insert');
                }
            });
            menu.addChild(menuItem3);
            // combo button
            var button = new ComboButton({
                label: "Insert",
                dropDown: menu,
                style: "width: 200px;",
                onClick: function(){                     
                    comboButtonUdateDeleteInsert(this.id);
                }
            }, curComboUpdateDelete);
        });
    }); 
}

/**
 * If you click on combo button, this function will be triggered.
 * @param string index: the current row number
 */
function comboButtonUdateDeleteInsert(index) {
    var tmpId = '#' + index + '_label';
    tmpText = $(tmpId).html();
    var isValid = false;
    // Get row number
    var index = index.replace('comboUpdateDelete', '');
    if(tmpText.localeCompare('Update') == 0) {
        // If update, first validate if empty                    
        isValid = validateEmpty(index);
        if(isValid == false) {
            alert('Please fill in all the blank field' + 
            ' in the current row.');
            return;
        }
        // Update db
        var daten = generateRecord(index);
        processDB(daten, 'UPDATE', index);

    } else if(tmpText.localeCompare('Delete') == 0) {
        // If delete, do not need validate if empty
        // Delete db directly
        var daten = generateRecord(index);
        processDB(daten, 'DELETE', index);                                        
    } else if(tmpText.localeCompare('Insert') == 0) {
        // If insert, first validate if empty
        isValid = validateEmpty(index);
        if(isValid == false) {
            alert('Please fill in all the blank field' + 
            ' in the current row');
            return;
        }
        var daten = generateRecord(index);
        processDB(daten, 'INSERT', index);
    }
}

/**
 * Save the selected menu item into the combo
 */
function addSelectedIntoComboButton(parentId, menuItemLabel) {                    
    parentId = parentId.replace('menu', 'comboUpdateDelete');
    parentId = '#' + parentId + '_label'; // actionx_label(x is from 1 to 10)   
    $(parentId).html(menuItemLabel);      
}


