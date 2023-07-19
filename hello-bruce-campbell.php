<?php
/*
 * Plugin Name: Hello Bruce Campbell
 * Plugin URI: https://wordpress.org/plugins/hello-bruce-campbell/
 * Description: When activated you will randomly see a quote from a Bruce Campbell movie or TV show in the upper right of your admin screen on every page. A tip of the hat to Matt Mullenweg for the original code.
 * Author: Pete Nelson
 * Version: 1.0.3
 * Author URI: https://github.com/petenelson/hello-bruce-campbell
 * @package hello-bruce-campbell
 * @version 1.0.3
*/

function hello_bruce_campbell_get_quotes() {

	$quotes = array(
		"Shop smart. Shop S-Mart.",
		"Hail to the king, baby.",
		"Gimme some sugar, baby.",
		"Good. Bad. I'm the guy with the gun.",
		"Well hello Mister Fancypants.",
		"Groovy",
		"Come get some.",
		"That's just what we call pillow talk, baby, that's all.",
		"Good. Bad. I'm the guy with the gun.",
		"It's a trick. Get an axe.",
		"My name is Ash, and I am a slave.",
		"You bastards, why are you torturing me like this? Why?",
		"Give me back my hand... GIVE ME BACK MY HAND!",
		"Let's head on down into that cellar and carve ourselves a witch.",
		"You know spies... bunch of bitchy little girls.",
		"I think you know what I'm gettin' at Mr. President. We're gonna kill us a mummy.",
		"Your soul suckin' days are over, amigo!",
		"Gadzooks, if I were a woman I'd kiss myself!",
		"Never look too deep into the mind of a lawyer.",
		"Pizza Poppa always gets paid!",
		);

	return apply_filters( 'hello-bruce-campbell-quotes', $quotes );

}

function hello_bruce_campbell_get_quote() {

	$quotes = hello_bruce_campbell_get_quotes();

	// And then randomly choose a quote
	return trim( $quotes[ mt_rand( 0, count( $quotes ) - 1 ) ] );
}

/* This just echoes the chosen quote, we'll position it later */
function hello_bruce_campbell() {
	$quote = wptexturize( apply_filters( 'hello-bruce-campbell-quote', hello_bruce_campbell_get_quote() ) );
	?>
		<p id="hello-bruce-campbell-quote"><?php echo esc_html( $quote ); ?></p>
	<?php
}

/* We need some CSS to position the paragraph */
function hello_bruce_campbell_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	?>
	<style type="text/css">
		#hello-bruce-campbell-quote {
			float: <?php echo $x; ?>;
			padding-<?php echo $x; ?>: 15px;
			padding-top: 5px;		
			margin: 0;
			font-size: 11px;
		}
	</style>
	<?php
}

/* Output the quote */
add_action( 'admin_notices', 'hello_bruce_campbell' );

/* Output the CSS */
add_action( 'admin_head', 'hello_bruce_campbell_css' );
