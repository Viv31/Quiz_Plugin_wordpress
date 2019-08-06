<?php
include('../../../wp-config.php');
if(!isset($_SESSION['user_email'])){
	$path = site_url();
	wp_redirect($path);
} 
$TOTAL=$_SESSION['Right']+$_SESSION['Wrong']+$_SESSION['NoANS'];

							$per=($_SESSION['Right']*100)/($TOTAL);
		 					$per."%";
		 					$_SESSION['percent']=$per;

		 					/*echo $_SESSION['percent'];
		 					die;*/

include('cdnfiles.php');


?>


<div class="container"><center><h4><?php  echo $_SESSION['user_email']; ?></h4></center><hr>
<center><h4>Selected Category:<span><mark>
	<?php global $wpdb;
	$select_category_name ="SELECT * FROM category WHERE id ='".$_SESSION['cat_id']."'";
	$categoryName = $wpdb->get_results($select_category_name); 
	//print_r($categoryName);
	$cat_name = $categoryName[0]->category_name;
	echo $cat_name;
	$_SESSION['category_name'] = $cat_name;

	?>
</mark>
</span></h4>
<h4>Marks:<span><mark>
	<?php global $wpdb;
	$select_marks ="SELECT * FROM result WHERE id ='".$_SESSION['cat_id']."'";
	$usermarks = $wpdb->get_results($select_marks); 
	//print_r($categoryName);
	echo   $_SESSION['Right'];
	echo "/";
	echo $TOTAL;
	echo "</mark><br><br>";
	echo "Percentage :"."<mark>".$per.'%'."</mark>";

	?>
	

</span></h4>
</center>
<hr>
<center>
<table class="table table-bordered table-responsive">
	<thead>
		<tr>
			<th>
				Sno
				<?php  $no=1;?>
			</th>
			<th>
				Question
			</th>
			
			<th>
				Right Answer
			</th>
			
			<th class="rans">
				Your Answer
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		global $wpdb;


$fetch_result = "SELECT * FROM user_ans_details WHERE category_id='".$_SESSION['cat_id']."'and session_id ='".$_SESSION['session_ID']."'";
$rightans = $wpdb->get_results($fetch_result);
//print_r($rightans);

foreach ($rightans as $key => $user_given_rightans) {

	?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td width="400px;">
				<?php
		global $wpdb;


$select_question = "SELECT question FROM questions WHERE id = '".$user_given_rightans->question_id."'";
$Que = $wpdb->get_results($select_question);
//print_r($rightans);
foreach ($Que as $key => $Question) {
	echo $Question->question;
	
}

?>

			</td>
			<td><?php 
			global $wpdb;
 $select_user_ans = "SELECT ans FROM questions WHERE id = '".$user_given_rightans->question_id."'";
$Ansbyuser = $wpdb->get_results($select_user_ans);
//print_r($Ansbyuser);
foreach ($Ansbyuser as $key => $AnsBYUser) {
	echo $AnsBYUser->ans;
	
}



			?>
			</td>
			<?php 
			global $wpdb;
 $select_user_ans_details = "SELECT answer FROM  user_ans_details WHERE question_id = '".$user_given_rightans->question_id."' AND session_id='".$_SESSION['session_ID']."'";
$Ansbyuseris = $wpdb->get_results($select_user_ans_details);
//print_r($Ansbyuser);
foreach ($Ansbyuseris as $key => $AnsBYUserIS) {
	

	if($AnsBYUser->ans==$AnsBYUserIS->answer){
		//echo $AnsBYUserIS->answer;
		$answer_color = 'style="color:#98FB98;"';

	}
	if($AnsBYUser->ans!=$AnsBYUserIS->answer){
		$answer_color = 'style="color:#FF6347;"';

	}
	
}



			?>
		<td <?php echo $answer_color; ?>><?php echo $AnsBYUserIS->answer; ?></td>
		</tr>

	<?php 
	
}

?>
		
	</tbody>
</table>

<?php 
global $wpdb;

$insert_data_into_graph = $wpdb->insert('graph',
	array(
		'category_name'=>$_SESSION['category_name'],
		'percentage'=>$_SESSION['percent'],
		'user_id'=>$_SESSION['user_id']


));
if(is_wp_error($insert_data_into_graph)){

	echo "Failed to insert";
}
else{
	//echo "Inserted into graph";
}


?>
<a href="<?php echo site_url(); ?>"><button class="btn btn-primary">Back</button></a>




<a href="<?php echo site_url(); ?>/graph"><button class="btn btn-primary">Graph</button></a>
</div>



