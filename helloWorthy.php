<?php
/**
 * @package Hello_Worthy
 * @version 1.2
 */
/*
Plugin Name: Hello Worthy
Plugin URI: http://wordpress.org/extend/plugins/hello-worthy/
Description: This is based on the Hello Dolly plugin that comes as a standard install of all WordPress installations. Instead of lyrics to the song Hello, Dolly, this plugin will display a quote, reminder or other comment.
Author: Claire Worthington
Version: 1.0
Author URI: http://worthyontheweb.co.uk
*/

function hello_worthy_get_quote() {
	/** These are some simple pieces of advice for users using wordpress*/
	$lyrics = "Do not install Elementor
	Regularly Back up
	Use Akismet for spam
	Use readable fonts
	Use Mailchimp for newsletters
	Check that it is accessible on mobile
	Choose a theme that already has features that you are looking for
	Wordfence is a plugin that disables users from logging in to the admin panel";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a 
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_worthy() {
	$chosen = hello_worthy_get_quote();
	echo "<p id='worthy'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_worthy' );

// We need some CSS to position the paragraph
function worthy_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#worthy {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 13px;
	}
	</style>
	";
}

add_action( 'admin_head', 'worthy_css' );

?>