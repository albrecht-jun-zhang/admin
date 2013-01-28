
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Admin Management</title>
		<link rel="stylesheet" href="../dijit/themes/claro/claro.css" media="screen">
		<script src="../scripts/jquery-1.8.3.js"></script>
	</head>
	<body class="claro">
		
		<div id='div1'>
			<label id="label2">xxxxxxxx</label>
			<button id="btn" data-dojo-type="dijit/form/Button"
				data-dojo-props="
					onClick:function(){ 
					console.log('First button was clicked!'); 
					$('label#label2').append('aaaaaaaaa');	
					this.set('label', 'do not click me');
					}">
				Click Me!
			</button>
			<button id="btn2" data-dojo-type="dijit/form/Button"
				data-dojo-props="
					iconClass:'dijitIconNewTask',
					showLabel:false,
					onClick:function(){ console.log('Second button was clicked!'); }">
				Click Me!
			</button>
			
		</div>
		<!-- load dojo and provide config via data attribute -->
		<script src="../dojo/dojo.js" data-dojo-config="isDebug: true, async: true, parseOnLoad: true"></script>
		<script>
			// load requirements for declarative widgets in page content
			require(["dojo/parser", "dijit/form/Button", "dojo/domReady!"]);
		</script>
	</body>
</html>
