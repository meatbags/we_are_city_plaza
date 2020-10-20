<?php get_header();
	$clang = pll_current_language();
	$read = "Read More";
	$date = "Date";
	$upcoming = "Upcoming Exhibition";
	$support = "Support the project";

	if ($clang == "de") {
		$read = "Weiter";
		$date = "Datum";
		$upcoming = "Kommende Ausstellungen";
		$support = "Spenden";
	} elseif ($clang == "fr") {
		$read = "Lire la suite";
		$date = "Date";
		$upcoming = "Prochainement";
		$support = "Soutenir le projet";
	}
?>

<div class="background">
	<div class="bg-images">
		<?php
		$query = new WP_Query(array("post_type"=>"page", "posts_per_page"=>-1));
		
		if ($query->have_posts()) :
		while ($query->have_posts()): $query->the_post();
			$bgimgs = get_field("images");
			foreach($bgimgs as $img) : ?>
				<div class="image-wrapper">
					<img src="<?php echo $img["sizes"]["large"]; ?>" />
				</div>
		<?php endforeach;
		endwhile; endif; ?>
	</div>
	<canvas id="background__canvas"></canvas>
</div>
<div class="title">
	<?php wp_title(); ?>
</div>
<div class="scroll-down">
	↓&nbsp;
</div>

<div class="main">
	<div class="main__inner">
		<div class="wrapper">

<div id="top" class="section"></div>
<div id="about" class="section">
	<div class="flex--columns">

	<?php
	$query = new WP_Query(array("post_type"=>array("about"), "posts_per_page"=>-1, "order"=>"ASC", "orderby"=>"menu_order"));
	$index = 0;
	if ($query->have_posts()) :
		while ($query->have_posts()): $query->the_post();
		if ($index == 0) :
		$index++;
		?>

		<div class="item about-section">
			<div class="about__inner">
				<div class="about__title"></div>
				<div class="about__content">
					<?php echo the_content(); ?>
				</div>
				<a class="read-more" href="#read-more"><?php echo $read; ?></a>
			</div>
		</div>
		
		<?php endif; endwhile; endif; wp_reset_query(); ?>
		
	</div>
</div>	
			
<div id="photographers" class="section">
	<div class="flex--columns">

	<?php
		$query = new WP_Query(
			array(
				"post_type"=>array("photographer"),
				"posts_per_page"=>-1,
				"order"=>"ASC",
				"orderby"=>"menu_order"
			)
		);
	if ($query->have_posts()) :
		while ($query->have_posts()): $query->the_post();
		$thumb = get_the_post_thumbnail($post, "large", array("alt"=>"Photographer :" . get_the_title()));
		$link = get_the_permalink();
		$name = get_the_title(); ?>
		
		<div class="item photographer">
			<div class="photographer__inner">
				<a href="<?php echo $link; ?>">
					<div class="photographer__img">
						<?php echo $thumb; ?>
					</div>
					<div class="photographer__name"><h1><?php echo $name; ?></h1></div>
				</a>
			</div>
		</div>
		
		<?php endwhile; endif; ?>
	</div>
</div>

<div id="exhibitions" class="section">
	<div class="flex--columns">
		<div class="exhibition-list">
			<div class="item exhibition exhibition-title">
				<div class="left"><?php echo $date; ?></div>
				<div class="right"><?php echo $upcoming; ?></div>
			</div>
			<?php $query = new WP_Query(array("post_type"=>array("exhibition"), "posts_per_page"=>-1));
			if ($query->have_posts()) :
				while ($query->have_posts()): $query->the_post();
				$thumb = get_the_post_thumbnail($post, "large", array("alt"=>"Exhibition :" . get_the_title()));
				$permalink = get_the_permalink();
				$name = get_the_title();
				$content = get_the_content();
				$socMed = get_field("exhibition_social_media_links");
				$start = get_field("exhibition_start_date");
				$end = get_field("exhibition_end_date"); ?>
				
				<div class="item exhibition">
					<div class="left">
						<ul>
							<li><?php echo $start . " - " . $end; ?></li>
						</ul>
					</div>
					<div class="right">
						<ul>
							<li><?php echo $name; ?></li>
							<li><?php echo $content; ?></li>
							<li class="social-media__links">
								<?php
								if ($socMed) :
									foreach($socMed as $link) :?>
								
								<div class="social-media__link">
									<a href="<?php echo $link["social_media_link"]; ?>" target="_blank"><?php echo $link["social_media_platform"]; ?></a>
								</div>
								
								<?php endforeach; endif; ?>
							</li>
						</ul>
					</div>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>

<div id="read-more" class="section section-shorter">
	<div class="scroll-down">
		↓&nbsp;
	</div>
	<div class="flex--columns">
		
	<?php $query = new WP_Query(array("post_type"=>array("about"), "posts_per_page"=>-1, "order"=>"ASC", "orderby"=>"menu_order"));
	$index = 0;
	if ($query->have_posts()) :
		while ($query->have_posts()): $query->the_post();
		if ($index > 0) : ?>
		
		<div class="item about-section about-section-shorter">
			<div class="about__inner">
				<div class="about__title"></div>
				<div class="about__content">
					<?php echo the_content(); ?>
				</div>
			</div>
		</div>
		
		<?php endif; $index++; endwhile; endif; ?>
	</div>
</div>
	
<div class="footer">
	<a class="logo" target="_blank" href="https://www.facebook.com/sol2refugeesen/">
		<img src="<?php echo get_template_directory_uri(); ?>/lib/img/logo.png">
	</a>
	<a class="support" target="_blank" href="https://www.youcaring.com/refugeeaccommodationandsolidarityspacecityplaza-716186"><?php echo $support; ?>.</a>
</div>
		</div>
	</div>
</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60746754-2', 'auto');
  ga('send', 'pageview');
</script>
			
<?php get_footer(); ?>