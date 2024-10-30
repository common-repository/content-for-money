<?php
/*Plugin Name: Content For Money
Plugin URI:http://panoswebsites.com/contentformoney
Description: With this plugin you can hide a part or the entire content of your posts and pages. The hidden content can be seen by members, non members must pay a price you set.
Author: Panagiotis Angelidis (paaggeli)
Author URI: http://panoswebsites.com
Version: 1.1.4
License: GPL version 2 or later
*/

if (!class_exists("Contentformoney")){
class Contentformoney{
	var $adminOptionsName = 'contentformoneyadminoption';
	function Contentformoney(){}//constructor
	function init() {
            $this->getAdminOptions();
        }
	
	function getAdminOptions(){
		$ppAdminOption=array(
			'paypal_email'=>'your@paypalmail.com',
			'sandbox_email'=>'your@sandboxmail.com',
			'test'=>'yes',
			'd_amount'=>'10',
			'currency'=>'USD',
			'message'=>'You must pay to see the content'
			);
		$tmpOption=get_option($this->adminOptionsName);
		if (!empty($tmpOption)){
			foreach ($tmpOption as $key => $value) {
				$ppAdminOption[$key]=$value;
			}//foreach	
		}//if
		update_option($this->adminOptionsName,$ppAdminOption);
		return $ppAdminOption;
	}//end method getAdminOption
	/*Create an admin page */
	function printAdminPanel(){
		$tmpOption=$this->getAdminOptions();
		if(isset($_POST['Submit'])) { 
			if(is_email(trim($_POST['paypal_email'])) && is_email(trim($_POST['sandbox_email'])) && is_numeric($_POST['d_amount'])){
				$tmpOption['paypal_email'] = $_POST['paypal_email'];
			    $tmpOption['sandbox_email'] = $_POST['sandbox_email'];
			    $tmpOption['test'] = $_POST['test'];
			    $tmpOption['d_amount'] = $_POST['d_amount'];
			    $tmpOption['currency'] =$_POST['currency'];
			    $tmpOption['message'] =$_POST['message'];
			    update_option($this->adminOptionsName, $tmpOption);		    	
			    	?>
			    	<div class="updated"><p><strong><?php _e("Settings Updated.", "Contentformoney"); ?></strong></p></div>
			    	<?php		    	
    		}//inner if
    		else { ?>
    			<div class="error"><p><strong><?php _e("You have inserted invalid data.", "Contentformoney"); ?></strong></p></div>
    		<?php } 
    } //first if  	
    	 ?>					
	    	<div class="wrap">  
			<h1>Content For Money</h1>
			<form name="panospay_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>"/>  
			<table border="0">
			<tr>
			<td><label>Enter your PayPal email:</label></td>
			<td><input type="text" name="paypal_email" id='paypal_email' value="<?php echo $tmpOption['paypal_email']; ?>" size="20"/></td>
			</tr>
			<tr>
			<td><label>Enter your SandBox email:</label></td>
			<td><input type="text" name="sandbox_email" id='sandbox_email' value="<?php echo $tmpOption['sandbox_email']; ?>" size="20"/></td>
			</tr>
			<tr>
			<td><label>Test Mode:</label></td>
			<td>Yes   <input type="radio" name="test" value="true" <?php if ($tmpOption['test'] == "true") { _e('checked="checked"', "Contentformoney"); }?>/>
			   No   <input type="radio" name="test" value="faulse" <?php if ($tmpOption['test'] == "faulse") { _e('checked="checked"', "Contentformoney"); }?>/></td>
			</tr>
			<tr>
			<td><label>Default Price:</label></td>
			<td><input type="text" name="d_amount" value="<?php echo $tmpOption['d_amount']; ?>" size="20"/></td>
			</tr>
			<tr>
			<td>Currency:</td>
			<td><select name="currency">
				<?php
				$currency=array('AUD'=>'Australian Dollar', 'BRL'=>'Brazilian Real', 'CAD'=>'Canadian Dollar', 'CZK'=>'Czech Koruna', 'DKK'=>'Danish Krone', 'EUR'=>'Euro', 'HKD'=>'Hong Kong Dollar', 'HUF'=>'Hungarian Forint', 'ILS'=>'Israeli New Sheqel', 'JPY'=>'Japanese Yen', 'MYR'=>'Malaysian Ringgit', 'MXN'=>'Mexican Peso', 'NOK'=>'Norwegian Krone', 'NZD'=>'New Zealand Dollar', 'PHP'=>'Philippine Peso', 'PLN'=>'Polish Zloty', 'GBP'=>'UK Pound Sterling', 'SGD'=>'Sigapore Dollar', 'SEK'=>'Swedish Krona', 'CHF'=>'Swiss Franc', 'TWD'=>'Taiwan New Dollar', 'THB'=>'Thai Baht', 'TRY'=>'Turkish Lira', 'USD'=>'U.S. Dollar');
				foreach($currency as $code=>$currencies){
					$selected=($tmpOption['currency']==$code)?"selected='selected'":'';
					echo '<option value="'.$code.'"'.$selected.'>'.$currencies.'</option>';
				}?>
				</select><td><b>NOTE:</b><dfn> <u>Brazilian Real</u>, <u>Malaysian Ringgit</u>, <u>Turkish Lira</u>.</dfn><br/>These currencies are supported as a payment currency and a currency balance for in-country PayPal accounts only.</td>
			</td>
			</tr>
			<tr>
			<td><label>Message:</label></td>
			<td><input type="text" name="message" value="<?php echo $tmpOption['message']; ?>" size="40"/></td>
			</tr>
			</table>
			<div class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php _e('Update Options','Contentformoney') ?>" /></div>
			</form>
			<h2>Help Section</h2>
			<fieldset>
				<legend><h3>Option Description:</h3></legend>
				<p><ul>
				<li>'<i>Enter your PayPal email</i>' - just write your PayPal e-mail</li> 
				<li>'<i>Enter your SandBox email</i>' - enter the Pay Pal SandBox e-mail. <a href="https://developer.paypal.com/"> Pay Pal SandBox </a> is a test account for testing only.</li>
				<li>'<i>Test Mode</i>' - Select 'YES' to enable test mode. Otherwise check 'NO'</li>
				<li>'<i>Default Price</i>'- Set a default price for the hidden content.</li>
				<li>'<i>Currency</i>'- Choose the currency you want.</li>
				<li>'<i>Message</i>' - Enter a message you like appearing insisted the hidden content</li>
				<li>Now click 'Update Options' button to save your settings</li>
				</ul></p>
			</fieldset>
			<fieldset>
				<legend><h3>How to hide some content:</h3></legend>
				<p><ul>
				<li>Go to the Edit Post in WordPress</li>
				<li>To hide content, the plugin use the shortcode <b>[paycontent][/ paycontent]</b>.</li></ul> 
				<p>Here is an example (without parameter):</p>
				<p><b>[paycontent]</b> <i>Here Goes The Content<i> <b>[/paycontent]</b></p>
				<p>With this shortcode the nested content will be hide and the message you wrote in the settings area will appear with a PayPal button.</br> The price for this content will be the default price you set in the settings area.
				</p>

				 <p>Other example (with parameter):</p>

				<p><b>[paycontent amount='11']</b> <i> Here Goes The Content <i> <b>[/paycontent]</b></p>

				<p>With the parameter <strong>amount</strong> you set the price for the hidden content, in this example the price is 11$.</p>

				<h4>Parameters:</h4>
				<p><b>amount:</b> With the parameter <u>amount</u> you set the price for the hidden content like the example above.</p>
				<p><b>display_comments:</b> With the parameter <u>display_comments</u> you can hide the comments giving to this parameter the value 'no'.
				<br/>E.g. <b>[paycontent display_comments='no']</b> <i> Here Goes The Content <i> <b>[/paycontent]</b></p>
			</fieldset></div>
    <?php 
	}//end method printAdminPanel

	function HideContent($atts, $content=null){
	   extract(shortcode_atts( array(
		'amount' => '16',
		'display_comments' => ''
      ), $atts ));

	   $tmpOption=$this->getAdminOptions(); 
	   $atts['paypal_url']='https://www.paypal.com/';
	   $atts['sandbox_url']='https://www.sandbox.paypal.com/';
	   
	   //$atts['email']=$tmpOption['test']?$tmpOption['sandbox_email']:$tmpOption['paypal_email'];
	   if ($tmpOption['test'] == 'true'){
	   		$atts['email'] = $tmpOption['sandbox_email'];
	   } else {
	   		$atts['email'] = $tmpOption['paypal_email'];
	   }
	   //$atts['url']=$tmpOption['test']?$atts['sandbox_url']:$atts['paypal_url'];
		if ($tmpOption['test'] == 'true'){
	   		$atts['url'] = $atts['sandbox_url'];
	   } else {
	   		$atts['url'] = $atts['paypal_url'];
	   }
	
		if( null != $content && (current_user_can('read') || ($_GET['id']+600)>time())){
     	   return $content; 
    	}
    	else {
    			if($display_comments == no){
    			//hide the comments
				function hide_comments(){
					return "You are not allowed to read this comment!";
				}
    			add_filter( 'comment_text', 'hide_comments' );
    			}//if
    			//display the paypal button instead the content
    			$message=$this->genButton($atts);
					 return  $message ;
    		 }
	}//end method HideContent
	
	/*Now we create the PayPal button*/
	function genButton($a){
		$tmpOption=$this->getAdminOptions(); 
		if($a['amount']=="" || !is_numeric($a['amount'])){$a['amount']=$tmpOption['d_amount'];}
		$button='<div>'.$tmpOption['message'].'</div> 
    				</br>
    				<form name="_xclick" action="'.$a['url'].'cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="'.$a['email'].'">
					<input type="hidden" name="currency_code" value="'.$tmpOption['currency'].'">
					<input type="hidden" name="return" value="http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'&id='.time().'">
					<input type="hidden" name="amount" value="'.$a['amount'].'">
					<input type="hidden" name="item_name" value="'.get_the_title().'">
					<input type="hidden" name="item_number" value="'.get_the_ID().'">
					<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form></br>
					</br>'; 
					return $button;
				}//end method genButton

}//end class Contentformoney
}//end if

if (class_exists("Contentformoney")){
	$contentspay=new Contentformoney();
}
//Initialize the admin panel
if (!function_exists("Contentformoney_ap")){
	function Contentformoney_ap(){
		global $contentspay;
		if(!isset($contentspay)) {return;} 

		if (function_exists('add_options_page')) {
			add_options_page('Content For Money', 'Content For Money', 9, basename(__FILE__), array(&$contentspay, 'printAdminPanel'));
		}
	}
}
//Actions 
if(isset($contentspay)){
add_action('admin_menu','Contentformoney_ap');
add_action('activate_contentformoney/contentformoney.php',  array(&$contentspay, 'init'));
add_shortcode('paycontent',array(&$contentspay,'HideContent'));
}
?>