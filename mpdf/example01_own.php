<?php
require_once  dirname(dirname( __FILE__ )) . '/wp-load.php';

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$user_email = $current_user->user_email;
$user_firstname = $current_user->user_firstname;
$mname = get_user_meta($user_id, 'mname', true);
$user_lastname = $current_user->user_lastname;
$txt_email = get_user_meta($user_id, 'txt_email', true);
$mobile = get_user_meta($user_id, 'mobile', true);
$txt_nationality = get_user_meta($user_id, 'txt_nationality', true);
$txt_language = get_user_meta($user_id, 'txt_language', true);
$date_of_birth = get_user_meta($user_id, 'date_of_birth', true);
$txt_gender = get_user_meta($user_id, 'txt_gender', true);
$txt_address = get_user_meta($user_id, 'txt_address', true);
$txt_permanent_address = get_user_meta($user_id, 'txt_permanent_address', true);
$txt_marital_status = get_user_meta($user_id, 'txt_marital_status', true);
$txt_interest = get_user_meta($user_id, 'txt_interest', true);
$education_table = get_user_meta($user_id, 'education_table', true);
$skill = get_user_meta($user_id, 'skill', true);
$wordk_exp_arr = get_user_meta($user_id, 'wordk_exp_arr', true);
$certificates = get_user_meta($user_id, 'certificates', true);
$awards = get_user_meta($user_id, 'awards', true);



$html= '<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1252"/>
    <title>'.$user_firstname .' '.$mname.'</title>
    <style type="text/css">
        @page { size: 21cm 29.7cm; margin: 2cm }
        p { line-height: 120%; text-align: justify; background: transparent }
    </style>
    <style>
	#customers {
	  font-family: Arial, Helvetica, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	#customers td, #customers th {
	  border: 1px solid #ddd;
	  padding: 8px;
	}

	#customers tr:nth-child(even){background-color: #f2f2f2;}

	#customers tr:hover {background-color: #ddd;}

	#customers th {
	  padding-top: 12px;
	  padding-bottom: 12px;
	  text-align: left;
	  background-color: #04AA6D;
	  color: white;
	}
	</style>
</head>
<body>
<h2>'.$user_firstname.' '.$mname.' '.$user_lastname.'</h2>
<h4>  '.$txt_email.' | '.$mobile.'</h4>
<hr>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
aliquip ex ea commodo consequat. 
</p>
<hr><br>';
if($education_table){
$html .= '<h2>Eduction Details</h2>
<table id="customers">
  <tr>
    <th>STD</th>
    <th>Institute</th>
    <th>University / Board</th>
    <th>Year</th>
    <th>Percentage</th>
  </tr>';  
     foreach ($education_table as $education) {
        $html .= '<tr >
            <td>'.$education['std'].'</td>
            <td>'.$education['institute'].'</td>
            <td>'.$education['university'].'</td>
            <td>'.$education['year'].'</td>
            <td>'.$education['percentage'].'</td>
         </tr>';
     $i++; } 
  $html .= '
</table>';
}
if($skill){
$html .= '<h2>My skill</h2>
<table id="customers">
  <tr>
    <th>Skills</th>
  </tr>';  
     foreach ($skill as $skills) {
        $html .= '<tr >
            <td>'.$skills.'</td>
         </tr>';
     $j++; } 
  $html .= '
</table>';
}
if($wordk_exp_arr){
$html .= '<br><h2>Work Experience</h2>
<table id="customers">
  <tr>
    <th>Company Name</th>
    <th>Emp Number</th>
    <th>Joining Date</th>
    <th>End Date</th>
    <th>Designation</th>  
  </tr>';  
     foreach ($wordk_exp_arr as $wordkexparr) {
        $html .= '<tr >
            <td>'.$wordkexparr['company_name'].'</td>
            <td>'.$wordkexparr['emp_number'].'</td>
            <td>'.$wordkexparr['joining_date'].'</td>
            <td>'.$wordkexparr['end_date'].'</td>
            <td>'.$wordkexparr['designation'].'</td>
         </tr>';
     $j++; } 
  $html .= '
</table>';
}
if($certificates){
$html .= '<br><h2>Certificates</h2>
<table id="customers">
  <tr>
    <th>Certificates Name</th>
    <th>Certificates URL</th>
    <th>Grade</th>
  </tr>';  
     foreach ($certificates as $certificate) {
        $html .= '<tr >
            <td>'.$certificate['name'].'</td>
            <td>'.$certificate['url'].'</td>
            <td>'.$certificate['grade'].'</td>
         </tr>';
     $j++; } 
  $html .= '
</table>';
}
if($awards){
$html .= '<br><h2>Awards</h2>
<table id="customers">
  <tr>
    <th>Awards Name</th>
    <th>Awards Short Details</th>
  </tr>';  
     foreach ($awards as $award) {
        $html .= '<tr >
            <td>'.$award['name'].'</td>
            <td>'.$award['detail'].'</td>
         </tr>';
     $j++; } 
  $html .= '
</table>';
}
$html .= '<h2>Personal Information</h2>
<table id="customers">  
  <tr>
    <td>Name: </td>
    <td>'.$user_firstname.' '. $mname .' '. $user_lastname.'</td>
  </tr>
  <tr>
    <td>Permanent Address: </td>
    <td>'.$txt_permanent_address.'</td>    
  </tr>
  <tr>
    <td>Address: </td>
    <td>'.$txt_address.'</td>    
  </tr>
  <tr>
    <td>Contact No: </td>
    <td>'.$mobile.'</td>    
  </tr>
  <tr>
    <td>Email: </td>
    <td>'.$txt_email.'</td>    
  </tr>
  <tr>
    <td>Date Of Birth: </td>
    <td>'.$date_of_birth.'</td>    
  </tr>
  <tr>
    <td>Gender: </td>
    <td>'.$txt_gender.'</td>    
  </tr>
  <tr>
    <td>Marital Status: </td>
    <td>'.$txt_marital_status.'</td>    
  </tr>
  <tr>
    <td>Nationality: </td>
    <td>'.$txt_nationality.'</td>    
  </tr>
  <tr>
    <td>Languages Known: </td>
    <td>'.$txt_language.'</td>    
  </tr>
  <tr>
    <td>Area of Interest: </td>
    <td>'.$txt_interest.'</td>    
  </tr>
</table>
<br>
<hr>
<h3>DECLARATION</h3>
<p>I hereby declare that the above written particulars are true to the best of my knowledge and Belief.</p>
<h4>Yours sincerely, </h4>
<h5>'.$user_firstname.' '.$user_lastname.'</h5>
</body>
</html>';



require_once __DIR__ . '/bootstrap.php';

$mpdf = new \Mpdf\Mpdf(['mode' => 'c']);
$mpdf->WriteHTML($html);
$mpdf->Output();
