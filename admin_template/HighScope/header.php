<?php
// Your existing header PHP code
?>
<!DOCTYPE html>
<html lang="<?php echo $sysconf['default_lang']; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title; ?></title>
    <link href="<?php echo JWB; ?>/admin_template/HighScope/css/style.css" rel="stylesheet" type="text/css" />
    <!-- Other necessary CSS and JS includes -->
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><img src="<?php echo JWB; ?>/admin_template/HighScope/images/logo.png" alt="HighScope Indonesia"></a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- Your top navigation links here -->
        </ul>
        <!-- /.navbar-top-links -->

        <?php include 'left_menu.php'; ?>
    </nav>
