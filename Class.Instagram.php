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

require_once 'config.php';

Class Instagram {
	
	private $access_token = NULL;
	
	private $user_id = NULL;
	
	private $user_fullname = NULL;
	
	private $user_thumbnail = NULL;
	
	/**
	 * Getter method for access_token
	 */
	
	public function getAccessToken() {
		
		return $this->access_token;
	}
	
	/**
	 * Setter method for access_token
	 */
	
	private function setAccessToken ($token) {
		
		$this->access_token = $token;
	} 
	
	/**
	 * Getter method for user_id
	 */
	
	public function getUserId() {
			
		return $this->user_id;
	}
	
	/**
	 * Setter method for user_id
	 */
	
	private function setUserId($userid) {
	
		 $this->user_id = $userid;
	}
	
	
	/**
	 * Getter method for user_fullname
	 */
	
	public function getUserFullName() {
	
		return $this->user_fullname;
	}
	
	/**
	 * Setter method for user_fullname
	 */
	
	private function setUserFullName($name) {
	
		$this->user_fullname = $name;
	}
	
	/**
	 * Getter method for user_thumbnail
	 */
	
	public function getUserThumb() {
	
		return $this->user_thumbnail;
	}
	
	/**
	 * Setter method for user_thumbnail
	 */
	
	private function setUserThumb($thumb) {
	
		$this->user_thumbnail = $thumb;
	}
	
	/**
	 * Get Access token from Instagram
	 * @param Code $code   // Code returned by Instagram when redirectd to our redirect URL after user authorixation
	 */
	
	public function getAccessTokenFromCode ($code) {
		
		global $appconfig;
		global $urlconfig;
		
		$post_fields = array(
				'client_id'		=> $appconfig['client_id'],
				'client_secret' => $appconfig['client_secret'],
				'grant_type'	=> 'authorization_code',
				'redirect_uri'  => $appconfig['redirect_url'],
				'code'          => $code,
				);
		
		$responsedata = $this->makeHttpCall($urlconfig['accesstoken_url'],'post',$post_fields);
		
		$tokendata = json_decode($responsedata);

		if($tokendata->error_message!=""&&isset($tokendata->error_message)) {
			
			echo "Following Error Occured: ".$tokendata->error_message;
			exit;
		}
		
		$this->setAccessToken($tokendata->access_token);
		$this->setUserId($tokendata->user->id);
		$this->setUserFullName($tokendata->user->full_name);
		$this->setUserThumb($tokendata->user->profile_picture);
		
		return $tokendata->access_token;
		
	}
	
	/**
	 * Get User Feed
	 * @param Count $count   // Number of items in the feed to get. If no argument then it is set to 10
	 */
	
	public function getUserFeed ($count=10) {
		
		global $urlconfig;
		$acceestoken = "";

		if(($acceestoken=$this->getAccessToken())==NULL) {
			
			$acceestoken = $_SESSION['AccessToken'];
			$this->setAccessToken($acceestoken);
			
		}
		
		$feedurl = $urlconfig['userfeed_url']."?access_token=".$acceestoken."&count=".$count;
		$feeddata = $this->makeHttpCall($feedurl,'get');
		return $feeddata;
		
	}
	
	/**
	 * Get User Publications
	 * @param Count $count   // Number of items in the feed to get. If no argument then it is set to 10
	 */
	
	public function getUserPublications ($count=10) {
		
		global $urlconfig;
		$acceestoken = "";
		$userid = "";
		
		if(($acceestoken=$this->getAccessToken())==NULL) {
		
			$acceestoken = $_SESSION['AccessToken'];
			$this->setAccessToken($acceestoken);
		
		}
		if(($userid=$this->getUserId())==NULL) {
			
			$userid = $_SESSION['UserId'];
			$this->setUserId($userid);
		}
		
		
		$publicationurl = sprintf($urlconfig['userpublications_url'],$userid,$acceestoken,$count);
		$publicationdata = $this->makeHttpCall($publicationurl,'get');
		return $publicationdata;
		
	}
	
	/**
	 * Get the list of users this user follows
	 * @param Count $count   // Number of items in the feed to get. If no argument then it is set to 10
	 */
	
	public function getFollowing ($count=10) {
		
		global $urlconfig;
		$acceestoken = "";
		$userid = "";
		
		if(($acceestoken=$this->getAccessToken())==NULL) {
		
			$acceestoken = $_SESSION['AccessToken'];
			$this->setAccessToken($acceestoken);
		
		}
		if(($userid=$this->getUserId())==NULL) {
		
			$userid = $_SESSION['UserId'];
			$this->setUserId($userid);
		}
		
		$followingurl = sprintf($urlconfig['following_url'],$userid,$acceestoken,$count);
		$followingndata = $this->makeHttpCall($followingurl,'get');
		return $followingndata;
		
	}
	
	/**
	 * Get the list of users who are following this user
	 * @param Count $count   // Number of items in the feed to get. If no argument then it is set to 10
	 */
	public function getFollowedBy($count=10) {
		
		global $urlconfig;
		$acceestoken = "";
		$userid = "";
		
		if(($acceestoken=$this->getAccessToken())==NULL) {
		
			$acceestoken = $_SESSION['AccessToken'];
			$this->setAccessToken($acceestoken);
		
		}
		if(($userid=$this->getUserId())==NULL) {
		
			$userid = $_SESSION['UserId'];
			$this->setUserId($userid);
		}
		
		$followedbyurl = sprintf($urlconfig['followed_by_url'],$userid,$acceestoken,$count);
		$followedbydata = $this->makeHttpCall($followedbyurl,'get');
		return $followedbydata;
		
	}
	
	public function getMostPoular ($count=10) {
		
		global $urlconfig;
		$acceestoken = "";
		
		if(($acceestoken=$this->getAccessToken())==NULL) {
		
			$acceestoken = $_SESSION['AccessToken'];
			$this->setAccessToken($acceestoken);
		
		}
		
		$popularurl = sprintf($urlconfig['popular_url'],$acceestoken,$count);
		$populardata = $this->makeHttpCall($popularurl,'get');
		return $populardata;
		
	}
	
	
	public function makeHttpCall ($url, $method = 'get', $postfields = array()) {
		
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
		
		if($method=='post') {
			
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
			
		}
		else if($method=='get') {
			
			curl_setopt($ch, CURLOPT_HTTPGET, true);
		}
		
		$content = curl_exec( $ch );
		return $content;
		
	}
	
}