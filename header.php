<!DOCTYPE html>
<!--
	Made by xavier-burrow.com
-->
<html>
<head>
	<meta charset="utf-8" />
	<title><?php wp_title("|", true, "right"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<!--<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">-->
	<link href="https://fonts.googleapis.com/css?family=Oswald:400,500,600" rel="stylesheet">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/lib/icon/favicon.png">
	<?php wp_head(); ?>
	<script>
		var baseUrl = "<?php echo get_template_directory_uri(); ?>/";
		var siteUrl = "<?php echo get_site_url(); ?>/";
		var isHome = <?php if (is_home()) { echo "true"; } else { echo "false"; } ?>
	</script>
</head>
<body <?php body_class(); ?>>
	
	<?php get_template_part("nav"); ?>
	
	<div class="loading-screen"></div>
	
	<script>
	window.fadeIn = function(obj) {
		$(obj).css({opacity: 0.75});
	}
	</script>