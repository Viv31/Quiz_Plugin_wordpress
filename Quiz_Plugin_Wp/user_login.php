<?php 
include('../../../wp-config.php');
if(isset($_SESSION['user_email'])){
	$path = site_url();
	unset($_SESSION['user_email']);
	session_destroy();
	wp_redirect($path);
}
/* 
Above code used if there is no user_email in session it will redirect to login page here $path is used for making dynamic path of this quiz website so wherever you run it will get base path of that website.
*/

?>

<?php 
if(isset($_POST['login'])){

	$user_email = $_POST['user_email'];
	$user_password =md5($_POST['user_password']);

	/*echo $user_email;
	echo $user_password;

	 die;*/

if(!empty($user_email && $user_password)){
	global $wpdb;
 $sql = "SELECT id,user_email,user_password FROM  user_registration WHERE user_email='".$user_email."' and user_password = '".$user_password."'";
$user_login_query = $wpdb->get_results($sql);
//print_r($user_login_query);//die;

/* GET id by indexing from array */
 $user_id = $user_login_query[0]->id;//die;

 /* Another method for fetching id */
/*foreach ($user_login_query as $key => $user_data) {

	//echo $user_data->id;

}*/

if($user_login_query){

	/*Storeing email and id in session*/

	$_SESSION['user_email'] = $user_email;
	 $_SESSION['user_id'] = $user_id;
//die;

$path = plugins_url();
	wp_redirect($path.'/viv-quiz-plugin/dashboard.php');
	/* if login success it will redirect to dashboard  */	
	//echo  $login_success =  "<p style='color:green;'>Login Success</p>";

}else{
	$error = "<p style='color:red;text-align:center;'>login failed</p>";
}

}
else{
	 $error =  "<p style='color:#CC0000;'>All Fields are Required</p>";
}

}
?>