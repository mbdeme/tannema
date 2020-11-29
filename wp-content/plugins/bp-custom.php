<?php
 
if ( !defined( 'BP_AVATAR_THUMB_WIDTH' ) )
define( 'BP_AVATAR_THUMB_WIDTH', 120 ); //change this with your desired thumb width
 
if ( !defined( 'BP_AVATAR_THUMB_HEIGHT' ) )
define( 'BP_AVATAR_THUMB_HEIGHT', 120 ); //change this with your desired thumb height
 
if ( !defined( 'BP_AVATAR_FULL_WIDTH' ) )
define( 'BP_AVATAR_FULL_WIDTH', 580 ); //change this with your desired full size,weel I changed it to 260 <img src="http://buddydev.com/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> 
 
if ( !defined( 'BP_AVATAR_FULL_HEIGHT' ) )
define( 'BP_AVATAR_FULL_HEIGHT', 580 ); //change this to default height for full avatar
 
add_filter('bp_get_send_public_message_button', '__return_false');
add_filter('bp_current_user_can', '__return_false');
?>