<?php 
/***
* Plugin name: Quiz website
* Plugin URI:
* Description: Plugin for developing Quiz with multiple category.
* version:1.0
* Author:Vaibhav Gangrade
* Author URI:
*/

include('admin_options.php');
/* Table for user registration  */
	
	global $wpdb;
	//global $table_name;
	//$table_name ='user_registration';

	$charset_collate = $wpdb->get_charset_collate();

	$create_userregistration = "CREATE TABLE IF NOT EXISTS user_registration(
  		id mediumint(11) NOT NULL AUTO_INCREMENT,
  		first_name varchar(100) NOT NULL,
  		last_name varchar(100) NOT NULL,
  		user_email varchar(100) NOT NULL,
  		user_password varchar(100) NOT NULL,
 		PRIMARY KEY  (id)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $create_userregistration );

/* Table for  category */
//$charset_collate = $wpdb->get_charset_collate();

	$category_table = "CREATE TABLE IF NOT EXISTS category(
  		id mediumint(11) NOT NULL AUTO_INCREMENT,
  		category_name varchar(100) NOT NULL,
 		PRIMARY KEY  (id)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $category_table );


/* Table for  questions */

$questions_table = "CREATE TABLE IF NOT EXISTS questions(
  		id mediumint(11) NOT NULL AUTO_INCREMENT,
  		question varchar(255) NOT NULL,
  		ans1 varchar(100) NOT NULL,
  		ans2 varchar(100) NOT NULL,
  		ans3 varchar(100) NOT NULL,
  		ans4 varchar(100) NOT NULL,
  		ans varchar(100) NOT NULL,
  		category_id int(10) NOT NULL,
  		no_answer varchar(100) NOT NULL,
  		
 		PRIMARY KEY  (id)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $questions_table );


/* Table for User answer*/
$user_ans_details_table = "CREATE TABLE IF NOT EXISTS user_ans_details(
  		id mediumint(11) NOT NULL AUTO_INCREMENT,
  			name varchar(55) NOT NULL,
  			question_id int(10) NOT NULL,
  			answer varchar(100) NOT NULL,
  		category_id int(10) NOT NULL,
  		session_id int(20) NOT NULL,
  		date datetime(6) NOT NULL,
  		PRIMARY KEY  (id)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $user_ans_details_table );


/* table for  Result  */

$user_ans_details_table = "CREATE TABLE IF NOT EXISTS result(
  		id mediumint(11) NOT NULL AUTO_INCREMENT,
  			name varchar(55) NOT NULL,
  			category_id int(10) NOT NULL,
  			total_questions int(100) NOT NULL,
  		right_ans int(10) NOT NULL,
  		wrong_ans int(20) NOT NULL,
  		percentage int(20) NOT NULL,
  		status varchar(20) NOT NULL,
  		date datetime(6) NOT NULL,
  		
  		
 		PRIMARY KEY  (id)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $user_ans_details_table );

/* Table for Graph */

$graph_table = "CREATE TABLE IF NOT EXISTS graph(
  		id mediumint(11) NOT NULL AUTO_INCREMENT,
  			category_name varchar(55) NOT NULL,
  			percentage int(10) NOT NULL,
  			user_id int(100) NOT NULL,
  			PRIMARY KEY  (id)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $graph_table );

function register_session(){
    if( !session_id() )
        session_start();
}
add_action('init','register_session');

include('Quiz_shortcode.php');

?>