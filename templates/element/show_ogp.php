<?php $ogpInfo = $this->DubOgp->ogpInfo(); ?>
<meta property="og:title" content="<?= $ogpInfo->title; ?>" />
<meta property="og:type" content="<?= $ogpInfo->type; ?>" />
<meta property="og:description" content="<?= $ogpInfo->description; ?>" />
<meta property="og:url" content="<?= $ogpInfo->url; ?>" />
<meta property="og:site_name" content="<?= $ogpInfo->site_name; ?>" />
<?php if (!empty($ogpInfo->locale)) : ?>
	<meta property="og:locale" content="<?= $ogpInfo->locale; ?>" />
<?php endif; ?>
<?php if (!empty($ogpInfo->locale_alternate)) : ?>
	<meta property="og:locale:alternate" content="<?= $ogpInfo->locale_alternate; ?>" />
<?php endif; ?>
<?php if (!empty($ogpInfo->img_url)) : ?>
	<meta property="og:image" content="<?= $ogpInfo->img_url; ?>" />
	<meta property="og:image:width" content="<?= $ogpInfo->img_width; ?>" />
	<meta property="og:image:height" content="<?= $ogpInfo->img_height; ?>" />
<?php endif; ?>
<?php if (!empty($ogpInfo->twitter_id)) : ?>
	<meta name="twitter:site" content="@<?= $ogpInfo->twitter_id; ?>">
<?php endif; ?>
<?php if (!empty($ogpInfo->twitter_card)) : ?>
	<meta name="twitter:card" content="<?= $ogpInfo->twitter_card; ?>">
<?php endif; ?>
<?php if (!empty($ogpInfo->facebook_app_id)) : ?>
	<meta property="fb:app_id" content="<?= $ogpInfo->facebook_app_id; ?>" />
<?php endif; ?>