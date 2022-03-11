<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $meta_title ?></title>
	<link href="/images/favicon.svg" rel="shortcut icon" type="image/x-icon" />
	<!-- Meta -->
	<meta name="robots" content="noindex,nofollow" />
    <meta name="keywords" content="<?= $meta_key ?>" />
    <meta name="description" content="<?= $meta_desc ?>" />
    <link rel="canonical" href="<?= $canonical ?>" />

    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $meta_title ?>" />
    <meta property="og:description" content="<?= $meta_desc ?>" />
    <meta property="og:site_name" content="Timviec365.com" />
    <meta property="og:image" content="/images/logo.png" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?= $meta_desc ?>" />
    <meta name="twitter:title" content="<?= $meta_title ?>" />

    <!-- preload css -->

	<link rel="preload" as="style" href="/assets/css/bootstrap.min.css">
	<link rel="preload" as="style" href="/assets/css/icon.css">
	<link rel="preload" as="style" href="/assets/css/home.css">
	<?= (isset($css))?'<link rel="preload" as="style" href="'.$css.'">':'' ?>
	
    <!--    Libs CSS-->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/icon.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <?= (isset($css))?'<link rel="stylesheet" href="'.$css.'">':'' ?>
</head>
<body>
	<?php
		$this->load->view('include/header');
		$this->load->view($content);
		$this->load->view('include/footer');
		$this->load->view('include/modal_form');
	?>

	<script type="text/javascript" src="/assets/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="/assets/js/home.js"></script>
	<script type="text/javascript" src="/assets/js/search_advance.js"></script>
	<script type="text/javascript" src="/assets/js/lazysizes.min.js"></script>
	<?= (isset($js))?'<script type="text/javascript" src="'.$js.'"></script>':'' ?>
</body>
</html>