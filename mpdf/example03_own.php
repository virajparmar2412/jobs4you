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
    <title>'.$user_firstname .' '.$mname.' '.$user_lastname.'| '.$user_email.'</title>
    <style type="text/css">
        @page { size: 21cm 29.7cm; margin: 2cm }
        p { line-height: 120%; text-align: justify; background: transparent }
    </style>
     * {
  box-sizing: border-box
}

html {
  background: url(//css-tricks.com/examples/OnePageResume/images/noise.jpg)
}

body {
  margin: 2.2rem
}

div#resume {
  min-width: 310px;
  font: 16px Helvetica, Avernir, sans-serif;
  line-height: 24px;
  color: #000
}

div#resume h1 {
  margin: 0 0 16px 0;
  padding: 0 0 16px 0;
  font-size: 42px;
  font-weight: bold;
  letter-spacing: -2px;
  border-bottom: 1px solid #999;
  line-height: 50px
}

div#resume h2 {
  font-size: 20px;
  margin: 0 0 6px 0;
  position: relative
}

div#resume h2 span {
  position: absolute;
  bottom: 0;
  right: 0;
  font-style: italic;
  font-family: Georgia, serif;
  font-size: 16px;
  color: #999;
  font-weight: normal
}

div#resume p {
  margin: 0 0 16px 0
}

div#resume a {
  color: #999;
  text-decoration: none;
  border-bottom: 1px dotted #999
}

div#resume a:hover {
  border-bottom-style: solid;
  color: #000
}

div#resume p.objective {
  font-family: Georgia, serif;
  font-style: italic;
  color: #666
}

div#resume dt {
  font-style: italic;
  font-weight: bold;
  font-size: 18px;
  text-align: right;
  padding: 0 26px 0 0;
  width: 150px;
  border-right: 1px solid #999
}

div#resume dl {
  display: table-row
}

div#resume dl dt,
div#resume dl dd {
  display: table-cell;
  padding-bottom: 20px
}

div#resume dl dd {
  width: 500px;
  padding-left: 26px
}

div#resume img {
  float: right;
  padding: 10px;
  background: #fff;
  margin: 0 30px;
  transform: rotate(-4deg);
  box-shadow: 0 0 4px rgba(0, 0, 0, .3);
  width: 30%;
  max-width: 220px
}

@media screen and (max-width:1100px) {
  div#resume h2 span {
    position: static;
    display: block;
    margin-top: 2px
  }
}

@media screen and (max-width:550px) {
  body {
    margin: 1rem
  }
  div#resume img {
    transform: rotate(0deg)
  }
}

@media screen and (max-width:400px) {
  div#resume dl dt {
    border-right: none;
    border-bottom: 1px solid #999
  }
  div#resume dl,
  div#resume dl dd,
  div#resume dl dt {
    display: block;
    padding-left: 0;
    margin-left: 0;
    padding-bottom: 0;
    text-align: left;
    width: 100%
  }
  div#resume dl dd {
    margin-top: 6px
  }
  div#resume h2 {
    font-style: normal;
    font-weight: 400;
    font-size: 18px
  }
  div#resume dt {
    font-size: 20px
  }
  h1 {
    font-size: 36px;
    margin-right: 0;
    line-height: 0
  }
  div#resume img {
    margin: 0
  }
}

@media screen and (max-width:320px) {
  body {
    margin: 0
  }
  img {
    margin: 0;
    margin-bottom: -40px
  }
  div#resume {
    width: 320px;
    padding: 12px;
    overflow: hidden
  }
  p,
  li {
    margin-right: 20px
  }
}
    <style>
	</style>
</head>
<body>
<div id="resume">';
$html .='<h1>'.$user_firstname.' '.$mname.' '.$user_lastname.'</h1>
<p>Cell: <a href=#>'.$mobile.'</a>
<p>Email: <a href=#>'.$txt_email.'</a>
 <dl>
    <h2>Education</h2>
    <dd>';
    if($education_table){
      foreach ($education_table as $education) {
        $html .= '<h3>'.$education['institute'].'</h3>
        <p><strong>'.$education['std'].'</strong> '.$education['percentage'].'<br/>
        <strong>Year:</strong> '.$education['year'].'</p><hr>';
      $i++; 
    } 
    }
    $html .= '</dd></dl>';
    if($skill){
    $html .= '<dl>
    <h2>Skills</h2>
    <dd>';
      foreach ($skill as $skills) {
        $html .= '<p>'.strtoupper($skills).'</p>';
      $i++; } 
    $html .= '</dd></dl>';
    }
    if($wordk_exp_arr){
      $html .='<dl>
      <h2>Experience</h2>
      <dd>';
      foreach ($wordk_exp_arr as $wordkexparr) {
        $html .='<h3>'.$wordkexparr['company_name'].'  <span>'.$wordkexparr['joining_date'].' to '.$wordkexparr['end_date'].'</span></h3>
        <ul>
        <li>'.$wordkexparr['designation'].'
        </ul>';
      }
      $html .='</dd>
      </dl>';
    }
    if($certificates){
      $html .='<dl>
      <h2>Certificates</h2>
      <dd>';
      foreach ($certificates as $certificate) {
        if($certificate['name'] != '-'){
          $html .='<h3>'.$certificate['name'].'  <span>'.$certificate['url'].' '.$certificate['grade'].'</span></h3>';
        }
      }
      $html .='</dd>
      </dl>';
    }
    if($awards){
      $html .='<dl>
      <h2>Awards</h2>
      <dd>';
      foreach ($awards as $award) {
        if($award['name'] != '-'){
          $html .='<h3>'.$award['name'].'  </h3><span>'.$award['detail'].'</span><hr>';
        }
      }
      $html .='</dd>
      </dl>';
    }
$html .='
<hr>
<h3>DECLARATION</h3>
<p>I hereby declare that the above written particulars are true to the best of my knowledge and Belief.</p>
<h4>Yours sincerely, </h4>
<h5>'.$user_firstname.' '.$user_lastname.'</h5>
</div>
</body>
</html>';



require_once __DIR__ . '/bootstrap.php';

$mpdf = new \Mpdf\Mpdf(['mode' => 'c']);
$mpdf->WriteHTML($html);
$mpdf->Output();
