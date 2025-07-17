<!doctype html>
<html>
<head>
    <title><?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" />
    <meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT" />
    <meta name="env" content="<?= isDev() ? 'dev' : 'prod' ?>"/>

    <?php
    $icon = SWB . 'webicon.ico';
    if (isset($sysconf['webicon']) && !empty($sysconf['webicon']) && file_exists(SB . 'images/default/' . $sysconf['webicon']))
    {
        $icon = SWB . 'images/default/' . $sysconf['webicon'];
    }
    ?>

    <link rel="icon" href="<?= $icon ?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= $icon ?>" type="image/x-icon" />
    <link href="<?php echo SWB; ?>css/bootstrap.min.css?<?php echo date('this') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo JWB; ?>colorbox/colorbox.css?<?php echo date('this') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo JWB; ?>chosen/chosen.css?<?php echo date('this') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo JWB; ?>toastr/toastr.min.css?<?php echo date('this') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo JWB; ?>jquery.imgareaselect/css/imgareaselect-default.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo JWB; ?>datepicker/css/datepicker-bs4.min.css" rel="stylesheet" />
    <link href="<?php echo $sysconf['admin_template']['css'].'?v='.date('this'); ?>" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo JWB; ?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo AWB; ?>admin_template/<?php echo $sysconf['admin_template']['theme']?>/vendor/slimscroll/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>updater.js?v=<?php echo date('this') ?>"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>gui.js??v=<?php echo date('this') ?>"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>form.js?v=<?php echo date('this') ?>"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>calendar.js?v=<?php echo date('this') ?>"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>chosen/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>chosen/ajax-chosen.min.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>ckeditor5/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>tooltipsy.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>colorbox/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>jquery.imgareaselect/scripts/jquery.imgareaselect.pack.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>webcam.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>scanner.js"></script>
    <script type="text/javascript" src="<?php echo SWB; ?>js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo SWB; ?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>toastr/toastr.min.js"></script>
    <script type="text/javascript" src="<?php echo JWB; ?>datepicker/js/datepicker-full.min.js"></script>
    <?php if (file_exists(SB . 'js/datepicker/js/locales/' . substr($sysconf['default_lang'], 0,2) . '.js')): ?>
    <script type="text/javascript" src="<?php echo JWB; ?>datepicker/js/locales/<?= substr($sysconf['default_lang'], 0,2) ?>.js"></script>
    <?php endif; ?>
    <script type="text/javascript" src="<?php echo $sysconf['admin_template']['dir'].'/'.$sysconf['admin_template']['theme']; ?>/js/smooth-scrollbar.js"></script>
    <script type="text/javascript" src="<?php echo $sysconf['admin_template']['dir'].'/'.$sysconf['admin_template']['theme']; ?>/js/overscroll.js"></script>
    <?php if($sysconf['chat_system']['enabled']) : ?>
    <script src="<?php echo JWB; ?>fancywebsocket.js"></script>
    <?php endif; ?>
</head>
<body>

<nav id="sidepan">
    <div class="s-user" id="profile">
        <a href="<?php echo MWB.'system/app_user.php?changecurrent=true&action=detail'; ?>" class="subMenuItem">
            <div class="s-user-photo">
                <?php
                if (filter_var($_SESSION['upict'], FILTER_VALIDATE_URL)) {
                    $user_image_url = $_SESSION['upict'];
                } else {
                    $user_image = $_SESSION['upict'] && file_exists(IMGBS . 'persons/' . $_SESSION['upict']) ? $_SESSION['upict'] : 'person.png';
                    $user_image_url = '../lib/minigalnano/createthumb.php?filename=' . IMG . '/persons/' . urlencode(urlencode($user_image)) . '&width=80';
                }
                ?>
                <img src="<?= $user_image_url ?>" alt="Photo <?php echo $_SESSION['realname'] ?>">
            </div>
            <div class="s-user-name-container">
                <span class="s-user-name"><?php echo $_SESSION['realname']?></span>
                <span class="s-user-role"><?php echo isset($_SESSION['nname']) ? $_SESSION['nname'] : __('Librarian'); ?></span>
            </div>
        </a>
    </div>

    <?php echo $sub_menu; ?>
</nav>

<div class="main-container">
    <header id="header">
        <div id="page-title-container"></div>
        <div class="header-right">
            <!-- Additional header content can go here -->
        </div>
    </header>

    <nav id="mainMenu">
        <?php echo $main_menu; ?>
    </nav>

    <div class="loader">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>

    <main id="mainContent">
        <?php echo $main_content; ?>
    </main>

    <footer id="footer">
        <div class="row">
            <div class="col-md-6"><?php echo SENAYAN_VERSION; ?></div>
            <div class="col-md-6 text-right"><?php echo $sysconf['page_footer']; ?></div>
        </div>
    </footer>
</div>


<!-- fake submit iframe for search form, DONT REMOVE THIS! -->
<iframe name="blindSubmit" style="display: none; visibility: hidden; width: 0; height: 0;"></iframe>

<script>
$(document).ready(function() {
    $('.loader').hide();

    // Move the page title to the header
    let pageTitle = $('#mainContent .per_title h2').first();
    if (pageTitle.length) {
        $('#page-title-container').append(pageTitle.clone());
        pageTitle.closest('.per_title').hide();
    }


    // Initialize custom scrollbar on sidebar
    if (document.querySelector('#sidepan')) {
        let Scrollbar = window.Scrollbar;
        if (Scrollbar) {
            Scrollbar.use(window.OverscrollPlugin);
            Scrollbar.init(document.querySelector('#sidepan'), {
                alwaysShowTracks: <?= $sysconf['admin_template']['always_show_tracks']??'false' ?>,
                continuousScrolling: false,
                plugins: {
                  overscroll: {
                    effect: 'glow'
                  },
                }
            });
        }
    }
});
</script>
<?php if($sysconf['chat_system']['enabled']) { include "chat.php"; } ?>
</body>
</html>