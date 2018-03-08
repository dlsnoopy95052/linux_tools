<html>
	<head>
		<title>Mailcow Bulk SQL Generator for Mailboxes</title>
	</head>
	<body>
		<?php
			include 'inc/functions.inc.php';
			include 'mcb_user_array.php'; /* Contains an array with the user data */

			/* Mysql Strings */
			$mysql_mailbox = 'INSERT INTO `mailbox` VALUES ';
			$mysql_alias = 'INSERT INTO `alias` VALUES ';
			$mysql_quota2 = 'INSERT INTO `quota2` VALUES ';
			$mysql_user_acl = 'INSERT INTO `user_acl` VALUES ';
			
			$date = date("Y-m-d H:i:s");
			$dir_size = 512 * 1024 * 1024; /* 512 MB */
			$fullname = ''; /* Created automaticly */
			$password_hash = ''; /* Hashed password */
			$i = 0;
			
			$name = ''; /* From Array */
			$surname = ''; /* From Array */
			$user = ''; /* From Array */
			$password = ''; /* From Array */
			$email = ''; /* From Array */
			$domain = ''; /* From Array */
			
			$array_len = count($user_array);
			/* Read in Array */
			foreach($user_array as list($name, $surname, $user, $password, $email, $domain)) {
				$i++;
				$fullname = "$name $surname";
				$password_hash = hash_password($password);
				
				/* Insert information for mysql string */
				$mysql_mailbox .= "('$email','$password_hash','$fullname','$domain/$user/',$dir_size,'$user','$domain','{\"force_pw_update\": \"0\", \"tls_enforce_in\": \"0\", \"tls_enforce_out\": \"0\"}','',0,'$date',NULL,1)";
				$mysql_alias .= "('$email','$email','$domain','$date',NULL,1)";
				$mysql_user_acl .= "('$email',1,1,1,1,1,1,1,1,1,1,0)";
				$mysql_quota2 .= "('$email',0,0)";
				
				if ($i == $array_len) {
					$mysql_mailbox .=";";
					$mysql_quota2 .=";";
					$mysql_alias .=";";
					$mysql_user_acl .=";";
				} else if ($i > 0) {
					$mysql_mailbox .=",";
					$mysql_alias .=",";
					$mysql_quota2 .=",";
					$mysql_user_acl .=",";
				}
			}
			
			/* Print result */
			echo "<h5>alias | Around Line 71</h5>$mysql_alias"; /* Around Line 71 */
			echo "<h5>Mailbox | Around Line 334</h5>$mysql_mailbox"; /* Around Line 334 */
			echo "<h5>quota2 | Around Line 359</h5>$mysql_quota2"; /* Around Line 359 */
			echo "<h5>user_acl | Around Line 856</h5>$mysql_user_acl"; /* Around Line 856 */
		?>
	</body>
</html>

