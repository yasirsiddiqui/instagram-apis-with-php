instagram-apis-with-php
=======================

This sample project demonstrates the integration of instagram apis with PHP. It user oAuth authentication and can fetch verity of data.

It can show user’s Feed (user wall), User comments, Uploaded media by a user, 
Show user’s uploaded photos on Google map with Pins and information windows showing photo, 
List of users who are following current user, 
List of users followed by current user, Most popular photos on instagram with comments and users.

=============================================================================================================

Follow the following instructions:

1) First Of all Upload all the files to a publically access able web server so that instagram can redirect user to your server after authentication.

2) Register an application at http://instagram.com/developer/

3) On the registration form enter http://yourwebsite.com/instagram/redirect.php as redirect URI for "OAuth redirect_uri" field.

4) Please note that redirect uri should point to http://yourwebsite.com/instagram/redirect.php otherwise this application is not going to work. 

5) After creating the application you will get "CLIENT ID", "CLIENT SECRET" and "REDIRECT URI".

6) Copy those values and open config.php

7) Replace these values in appconfig array. Please note that redirect_url in appconfig should be same as "OAuth redirect_uri" value you entered while registering the App.

8) Hit index.php
