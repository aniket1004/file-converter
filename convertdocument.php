<?php 

//import the converter class
require('document_converter.php');

$imageType = '';
$download = false;

//handle get method, when page redirects
if($_GET){	
	$imageType = urldecode($_GET['imageType']);
	$imageName = urldecode($_GET['imageName']);
   
}else{
	header('Location:index.php');
}

//handle post method when the form submitted
if($_POST){
	
	$convert_type = $_POST['convert_type'];
	
	//create object of image converter class
	$obj = new Document_converter();
	$target_dir = 'uploads';
	//convert image to the specified type
	$doc = $obj->convert_document($convert_type, $target_dir, $imageName);
	
	//if converted activate download link 
	if($doc){
		$download = true;
	}
}


//convert types
$types = array(
	'docx' => 'DOC',
	'pdf' => 'PDF',
	'pptx' => 'PPT',
);
// $type = array(
// 	'pdf' => 'PDF',
// );
?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Image Converter</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="">
		<meta name="Keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="index.html" class="logo"><strong>Document Converter</strong></a>
							
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
									 
									 	<?php if(!$download) {?>
		<form method="post" action="">
			<table width="500" align="center">
				<tr>
					<td align="center"  style="background-color:thistle;">
					<b>
						File Uploaded, Select below option to convert!
						<?php echo "<br>File name : $imageName";  ?>
					</b>
					</td>
				</tr>
				<tr>
					<td align="center">
						Convert To: 
							<select name="convert_type">
								<?php foreach($types as $key=>$type) {?>
									<?php if($key != $imageType){?>
									<option value="<?=$key;?>"><?=$type;?></option>
									<?php } ?>
								<?php } ?>
							</select>
							<br /><br />
					</td>
				</tr>
				<tr>
					<td align="center" ><input type="submit" value="convert" /></td>
				</tr>
			</table>
		</form>
	<?php } ?>
	<?php if($download) {?>
		<table width="500" align="center">
				<tr>
					<td align="center">
						file Converted to <?php echo ucwords($convert_type); ?>
						<?php echo "Download : ".$doc; ?>
					</td>
				</tr>
				<td align="center">
				
					<a class="button icon solid fa-download" href="download.php?filepath=<?php echo $target_dir.'/'.$doc; ?>" />Download Converted file</a>
				</td>
			</tr>
			<tr>
				<td align="center"><a href="doc.php">Convert Another</a></td>
			</tr>
		</table>
	<?php } ?>
									</div>
								</section>

						

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner" style="background-color:antiquewhite;">

							<!-- Search -->
								<section id="search" class="alt">
								<h1>Tools</h1>
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