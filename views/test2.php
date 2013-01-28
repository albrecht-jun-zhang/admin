<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Admin Management</title>
		<link rel="stylesheet" href="../dijit/themes/claro/claro.css" media="screen">
		<script src="../scripts/jquery-1.8.3.js"></script>
	</head>
	<body class="claro">
		
		<div>
			<button id="toggle" data-dojo-type="dijit/form/ToggleButton"
				data-dojo-props="
				onChange:function(checked) {
					this.set('label', 'aaaaaaaaaaaa')
				}">
				Toggle
			</button>

			<div id="combo" data-dojo-type="dijit/form/ComboButton"
				data-dojo-props="
					optionsTitle:'Save Options',
					iconClass:'dijitIconFile',
					onClick:function(){ console.log('Clicked ComboButton'); }">
				<span>Combo</span>
				<div id="saveMenu" data-dojo-type="dijit/Menu">
					<div data-dojo-type="dijit/MenuItem"
						data-dojo-props="
							iconClass:'dijitEditorIcon dijitEditorIconSave',
							onClick:function(){ console.log('Save'); }">
						Save
					</div>
					<div data-dojo-type="dijit/MenuItem"
						data-dojo-props="onClick:function(){ console.log('Save As'); }">
						Save As
					</div>
				</div>
			</div>
			

			<input id="text" data-dojo-type="dijit/form/TextBox"
				data-dojo-props="placeHolder:'Enter user here.'">


		</div>
		<!-- load dojo and provide config via data attribute -->
		<script src="../dojo/dojo.js" data-dojo-config="isDebug: true, async: true, parseOnLoad: true"></script>
		<script>
			// load requirements for declarative widgets in page content
			require(["dojo/parser", "dijit/form/ToggleButton", "dijit/form/ComboButton", 
			"dijit/Menu", "dijit/MenuItem", "dijit/form/TextBox", "dojo/domReady!"]);
		</script>
	</body>
</html>
