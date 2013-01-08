<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Instagram API Intergation With PHP</title>
<?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php')=="publicationsmap") { ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php }?>

</head>

<body <?php  if(basename($_SERVER["SCRIPT_FILENAME"], '.php')=="publicationsmap")
	echo 'onload="initialize()"';
	?>>
<div id="container" >
		<div id="header">
		<br>
        	<img src="<?php echo $_SESSION['Thumbnail'];?>" alt="User Profile Image" width="60" height="60">
            <h2>Welcome <?php echo $_SESSION['FullName']; ?></h2>
        </div>   
       
        <br><br>