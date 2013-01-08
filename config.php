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

$appconfig = array(
		
		'client_id' 	=> 'YOUR_CLIENT_ID',
		'client_secret' => 'YOUR_CLIENT_SECRET',
		'redirect_url' 	=> 'http://YOURWEBSITE.COM/instagram/redirect.php',
		'scope'         => 'comments+relationships+likes',
		);

$urlconfig = array(
		
		'authorization_url' 	=> 'https://api.instagram.com/oauth/authorize/?client_id=%s&redirect_uri=%s&response_type=code',
		'accesstoken_url'   	=> 'https://api.instagram.com/oauth/access_token',
		'userfeed_url'			=> 'https://api.instagram.com/v1/users/self/feed',
		'userpublications_url'	=> 'https://api.instagram.com/v1/users/%s/media/recent/?access_token=%s&count=%s',
		'following_url'			=> 'https://api.instagram.com/v1/users/%s/follows?access_token=%s&count=%s',
		'followed_by_url'		=> 'https://api.instagram.com/v1/users/%s/followed-by?access_token=%s&count=%s',
		'popular_url'			=> 'https://api.instagram.com/v1/media/popular?access_token=%s&count=%s',
		);

