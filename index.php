<?php

/**
 * Instagram PHP implementation
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

session_start();

if (!isset($_SESSION['AccessToken'])) {
	header('Location: redirect.php?op=getauth');
	die();
}
else {
	
	///Welcome message to the user links to all other files
	//echo "Well Come ".$_SESSION['FullName']."<br> Your Profile Picture:<img src='".$_SESSION['Thumbnail']."'>";
	
	include_once 'header.php';
	include_once 'leftmenu.php';
?>
	
	
	<div id="content">
        
        
        <div id="content_top"></div>
        <div id="content_main">
        	<h2>Use the links in the left menu to navigate through the API integration with PHP.</h2>
        	<p>&nbsp;</p>
           	<p>&nbsp;</p>
       	  
<p>&nbsp;</p>
        </div>
	
	
	

<?php 
	include_once 'footer.php';
}
?>