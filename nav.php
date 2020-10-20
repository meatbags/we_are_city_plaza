<?php
	$clang = pll_current_language();
	$menu = "Menu";
	$home = "Home";
	$about = "About the project";
	$photos = "Photographers";
	$exhibs = "Exhibitions";
	$support = "Support";

	if ($clang == "de") {
		$menu = "Menü";
		$home = "Home";
		$about = "über Das Projekt";
		$photos = "Fotografen";
		$exhibs = "Ausstellungen";
		$support = "Spenden";
	} elseif ($clang == "fr") {
		$menu = "Menu";
		$home = "Accueil";
		$about = "Le Projet";
		$photos = "Photographes";
		$exhibs = "Expositions";
		$support = "Soutien";
	}

	if (is_home()) :
?>
<div class="nav">
	<ul>
		<li><a href="#top"><?php echo $home; ?></a></li>
		<li><a href="#about"><?php echo $about; ?></a></li>
		<li><a href="#photographers"><?php echo $photos; ?></a></li>
		<li><a href="#exhibitions"><?php echo $exhibs; ?></a></li>
		<li><a target="_blank" href="https://www.youcaring.com/refugeeaccommodationandsolidarityspacecityplaza-716186"><?php echo $support; ?></a></li>
	</ul>
</div>
<div id="nav-button"><?php echo $menu; ?></div>
<div id="nav-lang">
	<ul>
		<?php $langs = pll_the_languages(array('raw'=>1));
			$i = 0;
			$len = count($langs);
			foreach ($langs as $lang => $args):
				$i++; ?>
			
			<li class="<?php if ($args["current_lang"]){ echo "active";} ?>">
				<a href="<?php echo $args["url"]; ?>"><?php echo $lang; ?></a>
			</li><?php if ($i != $len) { echo " |"; }?>
		<?php endforeach; ?>
	</ul>
</div>
<?php else : ?>
<div style="color: black;" class="hover-underline">
	<a href="<?php echo site_url(); ?>/#photographers"><?php echo $photos; ?></a>
</div>
<?php endif; ?>