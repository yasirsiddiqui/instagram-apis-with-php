<?php
session_start();

if (!isset($_SESSION['AccessToken'])) {
	header('Location: redirect.php?op=getauth');
	die();
}

require_once 'Class.Instagram.php';

$instgram  = new Instagram();
$populardata = json_decode($instgram->getMostPoular(10));

include_once 'header.php';
include_once 'leftmenu.php';
?>

<div id="content">
<div id="content_top"></div>
<div id="content_main">
<?php 
foreach ($populardata->data as $feeddata) {

?>

        <h2>&nbsp; </h2>
        <p>&nbsp;</p>
       	<h3><img src="<?php echo $feeddata->user->profile_picture; ?>" width="60" height="60" caption="Profile Image">&nbsp;&nbsp;<?php echo $feeddata->user->username; ?> </h3>
       	<br><img src="<?php echo $feeddata->images->low_resolution->url; ?>" width="<?php echo $feeddata->images->low_resolution->width; ?>" height="<?php echo $feeddata->images->low_resolution->height; ?>" caption="Feed Image" >
        <p>&nbsp;</p>
        <p><strong>Caption: </strong><?php echo @$feeddata->caption->text; ?></p>
        <p><strong>Comments: </strong><br>
        <?php 
        foreach ($feeddata->comments->data as $commentsdata) {

        	echo  "<strong>".$commentsdata->from->username.":</strong> ". $commentsdata->text."<br>";
        }
        
         ?></p>
        <p>&nbsp;</p>
        	
        
<?php 
}

if(count($populardata->data)==0) {

	echo "<h2>No Data Available.</h2>";
}
?>
</div>

<?php 
include_once 'footer.php';
?>