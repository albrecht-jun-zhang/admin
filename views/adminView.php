<!-- Admin view @author: Jun Zhang-->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Management</title>
    <link rel="stylesheet" href="dijit/themes/claro/claro.css" media="screen">
    <link rel="stylesheet" href="stylesheets/adminControls.css">
    <script src="scripts/jquery-1.8.3.js"></script>
    <script src="scripts/admin.js"></script>
</head>
<body class="claro">
<form name="customForm" enctype="multipart/form-data" 
      method="post" action="controllers/adminService.php">
<?php for($counter = 1; $counter < 11; ++$counter) {  
      if(count($userDatas) >= $counter) {
?>
<div id="div<?php echo $counter; ?>">                        
    <input value="<?php echo $userDatas[$counter - 1]['slotNumber'];?>" 
        style="width:100px;" id="textSlotNumber<?php echo $counter; ?>" 
        data-dojo-type="dijit/form/TextBox"
        data-dojo-props="placeHolder:'Enter slot number here.'">
    <input disabled value="<?php echo $userDatas[$counter - 1]['userName'];?>" 
        style="width:200px;" id="textUserName<?php echo $counter; ?>" 
        data-dojo-type="dijit/form/TextBox"
        data-dojo-props="placeHolder:'Enter user name here.'">        
    <button value="<?php echo $userDatas[$counter - 1]['isActive'];?>" 
        style="width:68px;" id="tbIsActive<?php echo $counter; ?>" 
        data-dojo-type="dijit/form/ToggleButton"
        data-dojo-props="
        onChange:function(checked) {
            if(checked == true) {
                this.set('label', 'Inactive')
            } else {
                this.set('label', 'Active')
            }
        }">
        <?php
            $tmpVal = $userDatas[$counter - 1]['isActive'];
            if($tmpVal == 0) {
                echo 'Inactive';
            } else {
                echo 'Active';
            }
        ?>
    </button>
    <input value="<?php echo $userDatas[$counter - 1]['password'];?>" 
        style="width:200px;" id="textPassword<?php echo $counter; ?>" 
        data-dojo-type="dijit/form/TextBox"
        data-dojo-props="placeHolder:'Enter password here.'">

    <div style="width:200px;" id="comboUpdateDelete<?php echo $counter; ?>" 
        data-dojo-type="dijit/form/ComboButton"
        data-dojo-props="
            onClick:function(){
                comboButtonUdateDeleteInsert(this.id);
            }">
        <span>Update</span>
        <div id="menu<?php echo $counter; ?>" data-dojo-type="dijit/Menu">
            <div data-dojo-type="dijit/MenuItem"
                data-dojo-props="
                onClick:function(){                   
                    addSelectedIntoComboButton(this.getParent().id, 'Update');
                }">
                Update
            </div>
            <div data-dojo-type="dijit/MenuItem"
                data-dojo-props="
                onClick:function(){
                    addSelectedIntoComboButton(this.getParent().id, 'Delete');                    
                }">
                Delete
            </div>
        </div>
    </div>       
</div>
<?php } else { ?>        
        <div id="div<?php echo $counter; ?>">                     
            <label style="margin-right: 492px;">
                Empty slot, new user can be added here.
            </label>            
            <button id="buttonAdd<?php echo $counter; ?>" 
                data-dojo-type="dijit/form/Button"
                data-dojo-props="
                onClick:function() {
                    var rowIndex = this.id.replace('buttonAdd', '');
                    generateRowData(rowIndex);
                }">
                Add
            </button>
        </div>

<?php      }// if clause 
} // for clause ?>
</form>
<!-- load dojo and provide config via data attribute -->
<script src="dojo/dojo.js" data-dojo-config="isDebug: true, async: true, parseOnLoad: true"></script>
<script>
        // Load requirements for declarative widgets in page content
        require(["dojo/parser", "dijit/form/ToggleButton", 
            "dijit/form/ComboButton", "dijit/Menu", "dijit/MenuItem", 
            "dijit/form/TextBox", "dijit/form/Button", "dojo/domReady!"]);
</script>
</body>
</html>
