<?php
/* 
* Template Name: Payment
*/
if(!is_user_logged_in()){   
    $login = get_permalink( get_page_by_path( 'login' ) );
    wp_redirect( $login ); 
    exit;
}
$user_id = get_current_user_id();
$role = get_role_by_id($user_id);

if($role == 'company_user'){
    global $wpdb;
    $tablename = $wpdb->prefix . 'payment';
    $sql = "SELECT *  FROM ".$tablename." WHERE `user_id` = ".$user_id."  AND `end_date` > '".date('Y-m-d')."'";
    $results = $wpdb->get_results($sql);    
    if(empty($results)){
        $packages = get_permalink( get_page_by_path( 'packages' ) );
        ?>
        <script type="text/javascript">
          location.replace(<?php echo $packages; ?>);
        </script>
        <?php        
    }
}else{
  $dashboard = get_permalink( get_page_by_path( 'dashboard' ) );
  wp_redirect( $dashboard ); 
  exit;
}
if(isset($_REQUEST['card_pay'])){
	$payment_method = $_POST['paymentMethod'];
	global $wpdb;
	$arr = array();
	$card_number = $_POST['txt_card_no'];
	$month = $_POST['txt_month'];
	$year = $_POST['txt_year'];
	$cvv = $_POST['txt_cvv'];
	$arr = array(
		'card_number' => $card_number,
		'month' => $month,
		'year' => $year,
		'cvv' => $cvv,
	);	
	$tablename = $wpdb->prefix . "payment";
	$transaction_id = time().uniqid(mt_rand(),true);
	$amount = $_POST['amount'];
	$currency = $_POST['currency'];
	$during = $_POST['during'];
	$last_date = strtotime($_POST['last_date']);
	$subscribe = $_POST['package_name'];
	$payment_details = maybe_serialize($arr);
	$user_id = get_current_user_id();
	$today = date("Y-M-d");
	$purchased_date = strtotime($today);
	$wpdb->insert($tablename, array(   
		'transaction_id' => $transaction_id,
		'subscribe' => $subscribe,
		'during' => $during,
		'during' => $during,
		'currency' => $currency,
		'amount' => $amount,
		'payment_method' => $payment_method,
		'payment_details' => $payment_details,
		'user_id' => $user_id,     
		'end_date' => date('Y-m-d',$last_date),
	));
	$thankyou = get_permalink( get_page_by_path( 'thanks' ) );
	wp_redirect($thankyou);
}
if(isset($_REQUEST['online_banking_pay'])){
    $payment_method = $_POST['paymentMethod'];
    $arr = array();    
	$bankname = $_POST['bank_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$arr = array(
	 'bankname' => $bankname,
	 'username' => $username,
	 'password' => $password,
	);
    global $wpdb;
    $tablename = $wpdb->prefix . "payment";
    $transaction_id = time().uniqid(mt_rand(),true);
    $amount = $_POST['amount'];
    $currency = $_POST['currency'];
    $during = $_POST['during'];
    $last_date = strtotime($_POST['last_date']);
    $subscribe = $_POST['package_name'];
    $payment_details = maybe_serialize($arr);
    $user_id = get_current_user_id();
    $today = date("Y-M-d");
    $purchased_date = strtotime($today);
   
    $wpdb->insert($tablename, array(   
      'transaction_id' => $transaction_id,
      'subscribe' => $subscribe,
      'during' => $during,
      'currency' => $currency,
      'amount' => $amount,
      'payment_method' => $payment_method,
      'payment_details' => $payment_details,
      'user_id' => $user_id,     
      'end_date' => date('Y-m-d',$last_date),
   ));
    $thankyou = get_permalink( get_page_by_path( 'thanks' ) );
    wp_redirect($thankyou);
}
if(isset($_REQUEST['online_upi_pay'])){
    $payment_method = $_POST['paymentMethod'];
	$arr = array();
	$upi_id = $_POST['upi-id'];
	$arr = array(
	 'upi_id' => $upi_id,
	);
    global $wpdb;
    $tablename = $wpdb->prefix . "payment";
    $transaction_id = time().uniqid(mt_rand(),true);
    $amount = $_POST['amount'];
    $currency = $_POST['currency'];
    $during = $_POST['during'];
    $last_date = strtotime($_POST['last_date']);
    $subscribe = $_POST['package_name'];
    $payment_details = maybe_serialize($arr);
    $user_id = get_current_user_id();
    $today = date("Y-M-d");
    $purchased_date = strtotime($today);
   
    $wpdb->insert($tablename, array(   
      'transaction_id' => $transaction_id,
      'subscribe' => $subscribe,
      'during' => $during,
      'currency' => $currency,
      'amount' => $amount,
      'payment_method' => $payment_method,
      'payment_details' => $payment_details,
      'user_id' => $user_id,     
      'end_date' => date('Y-m-d',$last_date),
   ));
    $thankyou = get_permalink( get_page_by_path( 'thanks' ) );
    wp_redirect($thankyou);
}
if(isset($_REQUEST['online_paytm_pay'])){
	$payment_method = $_POST['paymentMethod'];
	$paytm = $_POST['paytm-id'];
	global $wpdb;
	$arr = array();
	$arr = array(
		'paytm_number' => $paytm,
	);    
    $tablename = $wpdb->prefix . "payment";
    $transaction_id = time().uniqid(mt_rand(),true);
    $amount = $_POST['amount'];
    $currency = $_POST['currency'];
    $during = $_POST['during'];
    $last_date = strtotime($_POST['last_date']);
    $subscribe = $_POST['package_name'];
    $payment_details = maybe_serialize($arr);
    $user_id = get_current_user_id();
    $today = date("Y-M-d");
    $purchased_date = strtotime($today);   
    $wpdb->insert($tablename, array(   
      'transaction_id' => $transaction_id,
      'subscribe' => $subscribe,
      'during' => $during,
      'currency' => $currency,
      'amount' => $amount,
      'payment_method' => $payment_method,
      'payment_details' => $payment_details,
      'user_id' => $user_id,     
      'end_date' => date('Y-m-d',$last_date),
   ));
    $thankyou = get_permalink( get_page_by_path( 'thanks' ) );
    wp_redirect($thankyou);
}
get_header();
?> 
<div class="container-fluid">
   <div class="auth-page-wrap">
      <div class="auth-left">
         <h1 class="page-title">Payment Method</h1>
         <div class="mb-3 inner-form registraion-form" >
            <table class="table table-bordered">
               <tr>
                  <td>
                     <input type="radio" id="credit_card" name="payment_method" value="credit_card" checked required>
                     <label for="credit_card">Debit Card/Credit Card</label>
                  </td>
                  <td>
                     <input type="radio" id="online_banking" name="payment_method" value="online_banking" required>
                     <label for="online_banking">Online Banking</label>
                  </td>
               </tr>
               <tr>
                  <td>
                     <input type="radio" id="upi" name="payment_method" value="upi" required>
                     <label for="upi">UPI Payment</label>
                  </td>
                  <td>
                     <input type="radio" id="Paytm" name="payment_method" value="paytm" required>
                     <label for="Paytm">Paytm</label>
                  </td>
               </tr>
               <tr>
                  <td colspan="2">
                     <div id="credit_card_form" style="display:block;">
                        <form id="user_registration0" method="post" action="">
                           <table>
                              <tr>
                                 <td colspan="3">
                                    <input type="text" class="form-control cardNumber" placeholder="Card Number" id="txt_card_no" name="txt_card_no" minlength="16" maxlength="16" required>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="number" class="form-control" placeholder="Month" id="txt_month" name="txt_month" min="1" max="12" required>
                                 </td>
                                 <td>
                                    <input type="number" class="form-control" placeholder="Year" id="txt_year" name="txt_year" min="2023" max="2030" required>
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" placeholder="CVV" id="txt_cvv" name="txt_cvv" minlength="3" required>
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="3">
                                    <div class="w-100 text-center mb-3">
                                    	<input type="hidden" name="paymentMethod" id="paymentMethod" value="credit_card">
                                    	<input type="hidden" name="during" id="during" value="<?php echo $_POST['during']; ?>">
                                    	<input type="hidden" name="package_name" id="package_name" value="<?php echo $_POST['package_name']; ?>">
                                       <input type="hidden" name="amount" id="amount" value="<?php echo $_POST['amount']; ?>">
                                       <input type="hidden" name="currency" id="currency" value="INR">
                                       <input type="hidden" name="last_date" id="last_date" value="<?php echo $_POST['last_date']; ?>">                                       
                                       <input type="submit" name="card_pay" class="btn btn-dark" value="Pay Vai the Card">
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </form>
                     </div>
                     <div id="online_banking-form" style="display:none">
                        <form id="user_registration1" method="post" action="">
                           <table>
                              <tr>
                                 <td colspan="2">
                                    <select name="bank_name" id="bank_name" class="form-control">
                                       <option value="SBI">SBI</option>
                                       <option value="HDFC">HDFC</option>
                                       <option value="ICICI">ICICI</option>
                                       <option value="OTHER">OTHER</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" minlength="3" maxlength="255" required>
                                 </td>
                                 <td>
                                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" minlength="3" maxlength="255" required>
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="2">
                                    <div class="w-100 text-center mb-3">
                                    	<input type="hidden" name="paymentMethod" id="paymentMethod" value="online_banking">
                                    	<input type="hidden" name="during" id="during" value="<?php echo $_POST['during']; ?>">
                                       <input type="hidden" name="package_name" id="package_name" value="<?php echo $_POST['package_name']; ?>">
                                       <input type="hidden" name="amount" id="amount" value="<?php echo $_POST['amount']; ?>">
                                       <input type="hidden" name="currency" id="currency" value="INR">
                                       <input type="hidden" name="last_date" id="last_date" value="<?php echo $_POST['last_date']; ?>">
               
                                       <input type="submit" name="online_banking_pay" class="btn btn-dark" value="Pay Vai Online Banking">
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </form>
                     </div>
                     <div id="upi-payment-form" style="display:none">
                        <form id="user_registration2" method="post" action="">
                           <table width="100%">
                              <tr>
                                 <td>
                                    <input type="text" class="form-control" placeholder="Enter Upi ID" id="upi-id" name="upi-id" minlength="4" maxlength="20" required>
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="2">
                                    <div class="w-100 text-center mb-3">
                                    	<input type="hidden" name="paymentMethod" id="paymentMethod" value="upi">
                                    	<input type="hidden" name="during" id="during" value="<?php echo $_POST['during']; ?>">
                                       <input type="hidden" name="package_name" id="package_name" value="<?php echo $_POST['package_name']; ?>">
                                       <input type="hidden" name="amount" id="amount" value="<?php echo $_POST['amount']; ?>">
                                       <input type="hidden" name="currency" id="currency" value="INR">
                                       <input type="hidden" name="last_date" id="last_date" value="<?php echo $_POST['last_date']; ?>">
               
                                       <input type="submit" name="online_upi_pay" class="btn btn-dark" value="Pay Vai the UPI">
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </form>
                     </div>
                     <div id="paytm-form" style="display:none">
                        <form id="user_registration3" method="post" action="">
                           <table width="100%">
                              <tr>
                                 <td>
                                    <input type="text" class="form-control" placeholder="Paytm Number" id="paytm-id" name="paytm-id" minlength="4" maxlength="20" required>
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="2">
                                    <div class="w-100 text-center mb-3">
                                       <input type="hidden" name="paymentMethod" id="paymentMethod" value="paytm">
                                       <input type="hidden" name="during" id="during" value="<?php echo $_POST['during']; ?>">
                                       <input type="hidden" name="package_name" id="package_name" value="<?php echo $_POST['package_name']; ?>">
                                       <input type="hidden" name="amount" id="amount" value="<?php echo $_POST['amount']; ?>">
                                       <input type="hidden" name="currency" id="currency" value="INR">
                                       <input type="hidden" name="last_date" id="last_date" value="<?php echo $_POST['last_date']; ?>">                                       
                                       <input type="submit" name="online_paytm_pay" class="btn btn-dark" value="Pay Vai the PayTM">
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </form>
                     </div>
                  </td>
               </tr>
            </table>
         </div>
      </div>
      <div class="auth-right">
         <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pay.png" width="500px" height="500px">
      </div>
   </div>
</div>
</div> 
<?php get_footer(); ?> 
<script>
   jQuery(document).ready(function($) {
     $("input[name='payment_method']").click(function() {
       if ($(this).val() == "credit_card") {
         $("#credit_card_form").show();
         $("#online_banking-form").hide();
         $("#upi-payment-form").hide();
         $("#paytm-form").hide();
       } else if ($(this).val() == "online_banking") {
         $("#credit_card_form").hide();
         $("#online_banking-form").show();
         $("#upi-payment-form").hide();
         $("#paytm-form").hide();
       } else if ($(this).val() == "upi") {
         $("#credit_card_form").hide();
         $("#online_banking-form").hide();
         $("#upi-payment-form").show();
         $("#paytm-form").hide();
       } else if ($(this).val() == "paytm") {
         $("#credit_card_form").hide();
         $("#online_banking-form").hide();
         $("#upi-payment-form").hide();
         $("#paytm-form").show();
       }
     });
   });
</script>