<?php 
	//gets response from DB success = true or false
	echo $_POST["success"];

	$url = 'http://web.njit.edu/~ep85/login.php';
	$fields = array(
		'success' => urlencode($_POST['success']),
	);

	//url-ify the data for the POST
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

	//execute post
	$result = curl_exec($ch);
	print_r($result);
	print_r($curl_getinfo($ch))
	//close connection
	curl_close($ch);
	
?>