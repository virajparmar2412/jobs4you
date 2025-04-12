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
    <title>'.$user_firstname .' '.$mname.' '.$user_lastname.'| '.$user_email.'</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" media="all" /> 
    <link rel="stylesheet" type="text/css" href="resume.css" media="all" />

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
    .msg { padding: 10px; background: #222; position: relative; }
    .msg h1 { color: #fff;  }
    .msg a { margin-left: 20px; background: #408814; color: white; padding: 4px 8px; text-decoration: none; }
    .msg a:hover { background: #266400; }

    /* //-- yui-grids style overrides -- */
    body { font-family: Georgia; color: #444; }
    #inner { padding: 10px 80px; margin: 80px auto; background: #f5f5f5; border: solid #666; border-width: 8px 0 2px 0; }
    .yui-gf { margin-bottom: 2em; padding-bottom: 2em; border-bottom: 1px solid #ccc; }

    /* //-- header, body, footer -- */
    #hd { margin: 2.5em 0 3em 0; padding-bottom: 1.5em; border-bottom: 1px solid #ccc }
    #hd h2 { text-transform: uppercase; letter-spacing: 2px; }
    #bd, #ft { margin-bottom: 2em; }

    /* //-- footer -- */
    #ft { padding: 1em 0 5em 0; font-size: 92%; border-top: 1px solid #ccc; text-align: center; }
    #ft p { margin-bottom: 0; text-align: center;   }

    /* //-- core typography and style -- */
    #hd h1 { font-size: 48px; text-transform: uppercase; letter-spacing: 3px; }
    h2 { font-size: 152% }
    h3, h4 { font-size: 122%; }
    h1, h2, h3, h4 { color: #333; }
    p { font-size: 100%; line-height: 18px; padding-right: 3em; }
    a { color: #990003 }
    a:hover { text-decoration: none; }
    strong { font-weight: bold; }
    li { line-height: 24px; border-bottom: 1px solid #ccc; }
    p.enlarge { font-size: 144%; padding-right: 6.5em; line-height: 24px; }
    p.enlarge span { color: #000 }
    .contact-info { margin-top: 7px; }
    .first h2 { font-style: italic; }
    .last { border-bottom: 0 }


    /* //-- section styles -- */

    a#pdf { display: block; float: left; background: #666; color: white; padding: 6px 50px 6px 12px; margin-bottom: 6px; text-decoration: none;  }
    a#pdf:hover { background: #222; }

    .job { position: relative; margin-bottom: 1em; padding-bottom: 1em; border-bottom: 1px solid #ccc; }
    .job h4 { position: absolute; top: 0.35em; right: 0 }
    .job p { margin: 0.75em 0 3em 0; }

    .last { border: none; }
    .skills-list {  }
    .skills-list ul { margin: 0; }
    .skills-list li { margin: 3px 0; padding: 3px 0; }
    .skills-list li span { font-size: 152%; display: block; margin-bottom: -2px; padding: 0 }
    .talent { width: 32%; float: left }
    .talent h2 { margin-bottom: 6px; }

    #srt-ttab { margin-bottom: 100px; text-align: center;  }
    #srt-ttab img.last { margin-top: 20px }

    /* --// override to force 1/8th width grids -- */
    .yui-gf .yui-u{width:80.2%;}
    .yui-gf div.first{width:12.3%;}
    </style>
</head>
<body>
    <div id="doc2" class="yui-t7">
        <div id="inner">
            <div id="hd">
                <div class="yui-gc">
                    <div class="yui-u first">
                        <h1>'.$user_firstname .' '.$user_lastname.'</h1>
                    </div>
                    <div class="yui-u">
                        <div class="contact-info">
                            <h3>
                                <a href="mailto:'.$user_email.'">'.$user_email.'</a>
                            </h3>
                            <h3>'.$mobile.'</h3>
                        </div>
                        <!--// .contact-info -->
                    </div>
                </div>
                <!--// .yui-gc -->
            </div>
            <!--// hd -->
            <div id="bd">
                <div id="yui-main">
                    <div class="yui-b">
                        <div class="yui-gf">
                            <div class="yui-u first">
                                <h2>Profile</h2>
                            </div>
                            <div class="yui-u">
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
                            </div>
                        </div> <!--// .yui-gf -->';

if($skill){
    $html .= '<div class="yui-gf">
                    <div class="yui-u first">
                        <h2>Skills</h2>
                    </div>
                    <div class="yui-u">';
                        $j = 0;
                        foreach ($skill as $skills) {
                            $html .= '<div class="talent">
                                <h5>'.strtoupper($skills).'</h5>
                            </div>';
                            $j++;
                        } 
    $html .= '</div>
                </div><!--// .yui-gf -->';
}

if($wordk_exp_arr){
    $html .= '<div class="yui-gf">
                    <div class="yui-u first">
                        <h2>Work Experience</h2>
                    </div>
                    <div class="yui-u">';
                        $j = 0;
                        foreach ($wordk_exp_arr as $wordkexparr) {
                            $html .= '<div class="job">
                                <h2>'.$wordkexparr['company_name'].'</h2>
                                <h3>'.$wordkexparr['emp_number'].'</h3>
                                <h3>'.$wordkexparr['joining_date'].'</h3>
                                <h3>'.$wordkexparr['end_date'].'</h3>
                                <h3>'.$wordkexparr['designation'].'</h3>
                            </div>';
                            $j++;
                        } 
    $html .= '</div></div><br>';
}

if($education_table){
    $html .= '<div class="yui-gf">
                    <div class="yui-u first"><br>
                        <h2>Eduction Details</h2>
                    </div><br>';
                        $j = 0;
                        foreach ($education_table as $education) {
                            $html .= '<br><div class="yui-u"><h2>'.$education['institute'].'</h2> <h3>'.$education['university'].'<strong> '.$education['std'].' </strong>&mdash; <strong>'.$education['percentage'].'</strong> - '.$education['year'].' </h3><hr></div>';
                            $j++;
                        } 
    $html .= '</div>';
}

if($certificates){
    $html .= '<div class="yui-gf">
                    <div class="yui-u first"><br>
                        <h2>Certificates</h2>
                    </div><div class="yui-u"><ul>';
                        $j = 0;
                        foreach ($certificates as $certificate) {
                            if($certificate['name'] != '-'){
                                $html .= '<li>'.$certificate['name'].' '.$certificate['url'].' '.$certificate['grade'].'</li>';
                            }
                            $j++;
                        }
    $html .= '</ul></div></div>';
}

if($awards){
    $html .= '<div class="yui-gf">
                    <div class="yui-u first"><br>
                        <h2>Awards</h2>
                    </div><div class="yui-u"><ul>';
                        $j = 0;
                        foreach ($awards as $award) {
                            if($award['name'] != '-'){
                                $html .= '<li>'.$award['name'].''.$award['detail'].'</li>';
                            }
                            $j++;
                        }
    $html .= '</ul></div></div>';
}

$html .= '</div>
            </div>
        </div>
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
?>
