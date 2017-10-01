<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A multiplayer voxel game about world creation.">

		<title>Manic Digger <?php if (isset($page_title)) { echo "&ndash; $page_title"; } ?></title>
		<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
		<?php// if( $_SERVER['PHP_SELF']=='/skin.php'){ ?>
		<script src="js/2dskin.js" type="text/javascript"></script>
		<script src="js/three.min.js" type="text/javascript"></script>
		<?php// } ?>
		<link rel="stylesheet" href="css/pure-min.css">
		<link rel="stylesheet" href="css/grids-responsive-min.css">
		<link rel="stylesheet" href="css/layout.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
		<!--<style>
		.serverlist-entry {background-color: white; border-radius: 20px; }
		</style>-->
		<script>
		function timeSince(date) {

    var seconds = Math.floor((new Date() - date) / 1000);

    var interval = Math.floor(seconds / 31536000);

    if (interval > 1) {
        return interval + " years";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) {
        return interval + " months";
    }
    interval = Math.floor(seconds / 86400);
    if (interval > 1) {
        return interval + " days";
    }
    interval = Math.floor(seconds / 3600);
    if (interval > 1) {
        return interval + " hours";
    }
    interval = Math.floor(seconds / 60);
    if (interval > 1) {
        return interval + " minutes";
    }
    return Math.floor(seconds) + " seconds";
}
		</script>
	</head>
	<body>