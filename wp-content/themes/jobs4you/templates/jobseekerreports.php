<?php
/* 
* Template Name: Jobseeker Reports
*/
get_header();
global $wpdb;
$table1 = $wpdb->prefix.'apply';
$table2 = $wpdb->prefix.'posts';
$user_id = get_current_user_id();
$results = $wpdb->get_results("select ".$table1.".*,".$table2.".post_title from ".$table1." left join ".$table2." on ".$table1.".jobID = ".$table2.".ID where ".$table2.".post_author = ".$user_id);
?>
<section class="job_section layout_padding">
    <div class="container">
		<div class="heading_container">
			<h2>
				Jobseeker Reports <br>
			</h2>
		</div>
		<table class="" id="jobseekerlist">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Contact</th>
				</tr>
			</thead>
			<tbody id="the-list">
				<?php foreach($results as $row){ ?>
					<tr>
						<td><?php echo $row->firstName.'  '.$row->LastName; ?></td>
						<td><?php echo $row->email; ?></td>
						<td><?php echo $row->contact; ?></td>				
					</tr>
				<?php } ?> 
			</tbody>
		</table>
	</div>
</section>
<?php get_footer(); ?>