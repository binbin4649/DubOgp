<?php 
	$ogpInfo = $this->Ogp->ogpInfo();
	extract($ogpInfo);
	
	$image_width = $image_height = $image_uri = '';
	$url = $this->BcBaser->getUri($this->BcBaser->getHere());
	
	if($this->BcBaser->isBlog() && !empty($post)){
		$ogp_blog = $this->Ogp->ogpBlog($post);
		extract($ogp_blog);
	}else{
		$ogp_page = $this->Ogp->ogpPage();
		extract($ogp_page);
	}
	
	if($this->BcBaser->isHome()){
		$type = 'website';
	}else{
		$type = 'article';
	}
?>
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:type" content="<?php echo $type; ?>" />
<meta property="og:description" content="<?php echo $description; ?>" />
<meta property="og:url" content="<?php echo $url; ?>" />
<?php if($image_uri): ?>
	<meta property="og:image" content="<?php echo $image_uri; ?>" />
	<meta property="og:image:width" content="<?php echo $image_width; ?>"/>
	<meta property="og:image:height" content="<?php echo $image_height; ?>"/>
<?php endif; ?>
<meta property="og:site_name" content="<?php echo $siteName; ?>" />
<?php if($locale): ?>
	<meta property="og:locale" content="<?php echo $locale; ?>" />
<?php else: ?>
	<meta property="og:locale" content="ja_JP" />
<?php endif; ?>
<?php if($locale_alternate): ?>
	<meta property="og:locale:alternate" content="<?php echo $locale_alternate; ?>" />
<?php else: ?>
	<meta property="og:locale:alternate" content="en_US" />
<?php endif; ?>
<?php if($twitter_id): ?>
	<?php if($twitter_card): ?>
		<meta name="twitter:card" content="<?php echo $twitter_card; ?>">
	<?php else: ?>
		<meta name="twitter:card" content="summary">
	<?php endif; ?>
	<meta name="twitter:site" content="@<?php echo $twitter_id; ?>">
<?php endif; ?>
<?php if($facebook_app_id): ?>
	<meta property="fb:app_id" content="<?php echo $facebook_app_id; ?>" />
<?php endif; ?>