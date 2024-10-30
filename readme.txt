=== Content For Money  ===
Contributors: paaggeli
Donate link: 
Tags: paypal, hide content, pay to see content, free for members
Requires at least: 3.0.0
Tested up to: 4.9
Stable tag: 1.1.4
License: GPLv2 or later
With this plugin you can hide a part or the entire content of your posts and pages. The hidden content can be seen by members, non members must pay.
== Description ==
The Content For Money is a wordpress plugin that you can hide a specific content from your post or the whole post from non members. Although the non members can read the hidden content only if they pay, the amount you set, through PayPal.

*THE NON MEMBERS, WHO PAY TO READ THE HIDDEN CONTENT, ARE ABLE TO READ ONLY ONCE THE HIDDEN CONTENT. IF THEY VISIT AGAIN THEY MUST PAY AGAIN TO READ THE SAME HIDDEN CONTENT.OF COURSE YOU MUST HAVE BUSINESS PAYPAL ACCOUNT*

== Installation ==

1. Upload the folder `contentformoney` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

So you already have installed the plugin, now 

-Go to the Settings menu in WordPress and select 'Content For Money'

Option Description:

-'Enter your PayPal email' - just write your PayPal e-mail 

-'Enter your SandBox email' - enter the Pay Pal SandBox e-mail. Pay Pal SandBox is a test account for testing only (https://developer.paypal.com/).

-'Test Mode' - Select 'YES' to enable test mode. Otherwise check 'NO'

-'Default Price'- Set a default price for the hidden content.

-'Currency'- Choose the currency you want.

-'Message' - Enter a message you like appearing insisted the hidden content

-Now click 'Update Options' button to save your settings

You have finish with settings and now go to hide some content

-Go to the Posts menu in WordPress

-To hide content, the plugin use the shortcode [paycontent][/ paycontent].
 
Here is an example (without parameter):

-[paycontent] Here Goes The Content [/paycontent]

With this shortcode the nested content will be hide and the message you wrote in the settings area will appear with a PayPal button. The price for this content will be the default price you set in the settings area.

 An example (with parameter):

-[paycontent amount='11'] Here Goes The Content [/paycontent]

With the parameter amount you set the price for the hidden content, in this example the price is 11$.

Parameters:

'amount': With the parameter amount you set the price for the hidden content like the example above.

'display_comments': With the parameter display_comments you can hide the comments giving to this parameter the value 'no'.
-E.g. [paycontent display_comments='no'] Here Goes The Content [/paycontent]


[youtube http://www.youtube.com/watch?v=A9PIEoOQzc8]

== Frequently Asked Questions ==
How do I contact you?

email: info@panoswebsites.com

== Screenshots ==

1. Admin Panel
2. Post Page


== Changelog ==
= 1.1.3 =
-Fix paypal e-mail

= 1.1.2 =
-Added Shortcode Parameter 'display_comments'

= 1.1.1 =
-Added Help Section

= 1.1.0 =
-Added Currency Option

= 1.0 =
Initial Release

