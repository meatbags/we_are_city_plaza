<?php get_header(); ?>
<div class="single">
	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	$thumb = get_the_post_thumbnail($post, "large", array("alt"=>"Photographer :" . get_the_title()));
	$link = get_the_permalink();
	$name = get_the_title();
	$content = get_the_content();
	$images = get_field("photographer_gallery");
	$lastSlide = get_field("photographer_quote");
	?>

	<div class="single__photographer">
		<div class="slick-gallery-main">
			<?php if ($images) :
			$index = 0;
			$end = count($images) - 1;
			foreach($images as $img) :?>
				<?php if ($index == 0): ?>
					<div>
						<div class="gallery-img">
							<?php echo $thumb; ?>
						</div>
					</div>
					<?php if ($content) : ?>
						<div>
							<div class="gallery-img">
								<h2 class="<?php if (strlen($content) > 140) {echo "smaller";} ?>">
									<?php the_content(); ?>
								</h2>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				<div>
					<div class="gallery-img"><img src="<?php echo $img["sizes"]["large"]; ?>" alt=""></div>
				</div>
				<?php if ($index == $end && $lastSlide): ?>
				<div>
					<div class="gallery-img">
						<h2 class="<?php if (strlen($lastSlide) > 140) {echo "smaller";} ?>">
							<?php echo $lastSlide; ?>
						</h2>
					</div>
				</div>
				<?php endif; ?>
			<?php $index++; endforeach; endif; ?>
		</div>
		
		<!-- mobile -->
		<div class="gallery-mobile">
			<?php if ($images) :
			$index = 0;
			$end = count($images) - 1;
			foreach($images as $img) :?>
				<?php if ($index == 0): ?>
					<div class="mobile-gallery-img">
						<?php echo $thumb; ?>
					</div>
					<?php if ($content) : ?>
					<div class="mobile-gallery-img">
						<h2 class="<?php if (strlen($content) > 140) {echo "smaller";} ?>">
							<?php the_content(); ?>
						</h2>
					</div>
					<?php endif; ?>
				<?php endif; ?>
				<div class="mobile-gallery-img">
					<img src="<?php echo $img["sizes"]["large"]; ?>" alt="">
				</div>
				<?php if ($index == $end && $lastSlide): ?>
				<div class="mobile-gallery-img">
					<h2 class="<?php if (strlen($lastSlide) > 140) {echo "smaller";} ?>">
						<?php echo $lastSlide; ?>
					</h2>
				</div>
				<?php endif; ?>
			<?php $index++; endforeach; endif; ?>
			<h1><?php echo $name; ?></h1>
	</div>

	<h1><?php echo $name; ?></h1>
	
	<?php endwhile; endif; ?>

	<script type="text/javascript">
		function resetSlider() {
			$(".slick-gallery-main").slick({
				slidesToShow: 1,
				arrows: true,
				centerMode: true
			});
		}
		
		resetSlider();
	</script>
</div>
<?php get_footer(); ?>