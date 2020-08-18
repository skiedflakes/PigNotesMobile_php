<?php   
include 'config.php';
// $company_code = $_REQUEST['company_code'];
$username = $_POST['username'];
$password = $_POST['password'];

// $new_database = 'notes_'.$company_code;
 set_database('main');

$response_array['response_'] = array();
$md5pass = md5($password);

$fetch_user_details = mysql_query("SELECT * from tbl_users where username='$username' and password ='$md5pass'");
$count = mysql_num_rows($fetch_user_details);
$user_details = mysql_fetch_array($fetch_user_details);

if($count==1){

$fetch2 = mysql_query("SELECT * from tbl_company where company_id = '$user_details[company_id]'");
$company_code = mysql_fetch_array($fetch2);
$response["company_code"] = $company_code['company_code'];
$response["response_login"] = "login success";
$response["company_id"] = $user_details['company_id'];
$response["user_id"] = $user_details['user_id'];
$response["user_code"] =  $user_details['user_code'];
$response["category_id"] =  $user_details['category_id'];
$response["company_name"] =  $company_code['company_name'];
$response["user_name"] =  $user_details['name'];
$response["status"] = "1";
array_push($response_array['response_'], $response);

}else{
	
$response["company_code"] = "";
$response['response_login'] = "user not found";
$response["status"] = "0";
$response["company_id"] = "";
$response["user_id"] = "";
array_push($response_array['response_'], $response);

}

echo json_encode($response_array);