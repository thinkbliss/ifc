<?php
/*
Template Name: Search
*/

get_header();

?>

<div id="primary" class="content-area span8">
	<main id="main" class="site-main" role="main">
		<div id='cse' style='width: 100%; clear:both; position:relative; padding-top:20%;'>
			<script>
			  (function() {
			    var cx = '003455568539175376762:zbumysmbpdg';
			    var gcse = document.createElement('script');
			    gcse.type = 'text/javascript';
			    gcse.async = true;
			    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
			        '//cse.google.com/cse.js?cx=' + cx;
			    var s = document.getElementsByTagName('script')[0];
			    s.parentNode.insertBefore(gcse, s);
			  })();
			</script>
			<gcse:search></gcse:search>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php	
get_sidebar();
get_footer();
?>