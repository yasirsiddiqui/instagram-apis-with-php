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
/**
 * 
 * This script servers two main functionalities
 * If user has not been autheticated by Instagram then it will redirect user to Instagram server
 * Once Instagram authrizes user then it will get code returned by instagram, get Access Token and save it into the session
 * 
 */

session_start();

require_once 'config.php';
require_once 'Class.Instagram.php';


if(isset($_GET['error'])&&$_GET['error']!="") {
	
	echo "You Need to grant access to the application in order to continue!";
	exit;	
}

if(isset($_GET['code'])&&$_GET['code']!="") {
	
	/**
	 * InstaGram redirected to our URL with Code
	 * So use this code to get Access Token from InstaGram for further opeartions
	 */
	$instgram  = new Instagram();
	$accesstoken = $instgram->getAccessTokenFromCode($_GET['code']);

	if($accesstoken!="") {
		
		$_SESSION['AccessToken'] = $accesstoken;
		$_SESSION['UserId'] 	 = $instgram->getUserId();
		$_SESSION['FullName']	 = $instgram->getUserFullName();
		$_SESSION['Thumbnail'] 	 = $instgram->getUserThumb();
		
		header("Location: index.php");
		exit;

	}
	
}

/**
 * If op is set to "getauth" it means user has not been authorized so we need to redirect user to Instagram server
 * and get authorization code
 *
 */
if(isset($_GET['op']) && $_GET['op']=="getauth") {
	
	header("Location: ".sprintf($urlconfig['authorization_url'],$appconfig['client_id'],$appconfig['redirect_url']));
	exit;
	
}




