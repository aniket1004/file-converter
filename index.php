<?php

//import the converter class
require('image_converter.php');
if($_FILES){
	$obj = new Image_converter();
	
	//call upload function and send the $_FILES, target folder and input name
	$upload = $obj->upload_image($_FILES, 'uploads', 'fileToUpload');
	if($upload){
		$imageName = urlencode($upload[0]);
		$imageType = urlencode($upload[1]);
		
		if($imageType == 'jpeg'){
			$imageType = 'jpg';
		}
		header('Location: convert.php?imageName='.$imageName.'&imageType='.$imageType);
	}
}	
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>File Converter</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="">
		<meta name="Keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script>
	function checkEmpty(){
		var img = document.getElementById('fileToUpload').value;
		if(img == ''){
			alert('Please upload an image');
			return false;
		}
		return true;
	}
</script>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
									 
									 <table width="500" align="center">
		<tr><td align="center" style="background-color:thistle;">	<h2 align="center">Image Converter</h2></td></tr>
		<tr><td align="center"><h4>Convert Any image to JPG, PNG, GIF</h4></td></th>
		<tr>
			<td align="center">
				<form action="" enctype="multipart/form-data" method="post" onsubmit="return checkEmpty()" />
					<input type="file" name="fileToUpload" id="fileToUpload" />
					<input type="submit" value="Upload" />
				</form>
			</td>
		</tr>
	</table>
									</div>
								</section>

						

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner"  style="background-color:antiquewhite;">

							<!-- Search -->
								<section id="search" class="alt">
								<h1> Tools</h1>
								</section>

							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Converter</h2>
									</header>
									<ul>
										<li><a href="index.php">Image</a></li>
									</ul>
									<ul>
										<li><a href="doc.php">Document</a></li>
									</ul>
								</nav>

						

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright"><b>&copy; 2021</b></p>
								</footer>

						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>