<?php
session_start();

if (!isset($_SESSION['AccessToken'])) {
	header('Location: redirect.php?op=getauth');
	die();
}


require_once 'Class.Instagram.php';

$instgram  = new Instagram();
$followedbydata = json_decode($instgram->getFollowedBy(20));

include_once 'header.php';
include_once 'leftmenu.php';
?>
<div id="content">
<div id="content_top"></div>
<div id="content_main">
<?php 
foreach ($followedbydata->data as $feeddata) {

?>
		<h2>&nbsp; </h2>
        <p>&nbsp;</p>
       	<h3><img src="<?php echo $feeddata->profile_picture; ?>" width="60" height="60" caption="Profile Image">&nbsp;&nbsp;<?php echo $feeddata->username; ?> </h3>
        <p>&nbsp;</p>
        <p><strong>Full Name: </strong><?php echo $feeddata->full_name; ?></p>
        <p>&nbsp;</p>

<?php 
}

if(count($followedbydata->data)==0) {
	
	echo "<h2>Right Now No One Is Following You. </h2>";
}

?>



</div>

<?php 
include_once 'footer.php';
?>