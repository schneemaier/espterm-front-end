<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">
	<title><?= $_GET['PAGE_TITLE'] ?></title>
	<link href="/css/app.<?= GIT_HASH . '-' . LOCALE ?>.css" rel="stylesheet">
	<script src="/js/app.<?= GIT_HASH . '-' . LOCALE ?>.js"></script>
	<script>
		var _root = <?= JS_WEB_ROOT ?>;
		var _demo = <?= (int)ESP_DEMO ?>;
		<?php if($_GET['page']=='cfg_wifi'): ?>var _demo_aps = <?= ESP_DEMO ? json_encode(DEMO_APS) : '""' ?>;<?php endif; ?>
	</script>
</head>
<body class="<?= $_GET['BODYCLASS'] ?>">
<div id="outer">
<?php
$cfg = false;
if (strpos($_GET['BODYCLASS'], 'cfg') !== false) {
	$cfg = true;
	require __DIR__ . '/_cfg_menu.php';
}
?>

<div id="content">
<img src="/img/loader.gif" alt="Loading…" id="loader">
<?php if ($cfg): ?>
<h1><?= tr('menu.' . $_GET['page']) ?></h1>

<div class="Box errors hidden">
	<span class="lead"><?= tr('form_errors') ?></span>&nbsp;<span class="list"></span>
</div>

<div class="Box message hidden"></div>
<div class="Box errmessage hidden"></div>

<?php endif; ?>
