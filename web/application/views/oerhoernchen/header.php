<?php defined('BASEPATH') OR exit('No direct script access allowed');

// set SEO values
$site_title = 'OERhörnchen 2.0';
$meta_title = isset($meta_title) ? $meta_title : 'OERhörnchen 2.0';
$meta_description = isset($meta_description) ? $meta_title : 'OERhörnchen';
$meta_featured_image = isset($meta_featured_image) ? $meta_featured_image : ''; // 2DO: set default preview image
$header_title = isset($header_title) ? $header_title : 'OERhörnchen';
$header_subtitle = isset($header_subtitle) ? $header_subtitle : '';

$pages = array(
	'Alle Lesezeichen' => site_url('lesezeichen/') . '?licenseTypeFilter=' . urlencode('["CC0","CC BY","CC BY-SA"]'),
	'Playground-Lesezeichen' => site_url('lesezeichen/playground/') . '?licenseTypeFilter=' . urlencode('["CC0","CC BY","CC BY-SA"]'),
	'Hochschule'=> site_url('hochschule/') . '?licenseTypeFilter=' . urlencode('["CC0","CC BY","CC BY-SA"]'),
	'Klimakrise'=>'',
	'Hinzufügen' => site_url('lesezeichen/hinzufuegen'),
	'Feedback' => site_url('/#feedback'),
	//'Google-Suche' => 'suche/',
	//'Bildungsteiler' => 'bildungsteiler',
	//'Werkzeuge' => 'Werkzeuge', // 2DO: use dropdown
	//'Über' => 'about', // 2DO: take
);

$general_css_files = array(
	'bootstrap.min.css',
	'clean-blog.min.css',
	'cookiealert.css',
	'pace.css',
	'oerhoernchen.css',
	//'oerhoernchen-search.css',
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $meta_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="author" content="Matthias Andrasch">
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.ico" />
    <?php foreach ($general_css_files as $css_file): ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/<?php echo $css_file; ?>" />
    <?php endforeach;?>

    <!-- font awesome 5 free -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome5-free/css/all.css" />

    <?php if (isset($css_files)): ?>
       <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
            <?php endforeach;?>
    <?php endif;?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Fav and touch icons -->

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo $site_title; ?></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
     <?php foreach ($pages as $page_title => $page_url): ?>
     <?php // check if this page is active
//<li class="menu-item<?=r($item->isOpen(), ' is-active'); ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $page_url; ?>"><?php echo $page_title; ?></a>
            </li>
            <?php endforeach?>
                </ul>
            </div>
        </div>
    </nav>

    <header class="masthead" style="background-image: url('<?php echo base_url(); ?>assets/img/squirrel-2781394_1920_pixabay_annawaldl.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1><?php echo $header_title; ?></h1>
                        <span class="subheading"><?php echo $header_subtitle; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!--<div class="alert alert-danger" role="alert" style="font-size:12px;">
      Es handelt sich um eine private und nicht-öffentliche Prototyp-Version. Für die Sicherheit von personenbezogenen Daten kann keine Haftung übernommen werden, die Benutzung erfolgt auf eigenes Risiko. Zudem werden externe Dienste wie Appbase.io, Google Fonts, Imgur, etc. eingebunden - eingegebene Daten werden also ggf. an Drittanbieter übermittelt. Mit der Nutzung des Prototypens stimmen Sie einer möglichen Übermittlung zu. Die eingegeben Daten werden nach der Prototypphase ggf. gelöscht.
    </div>-->



<?php //var_dump(ENVIRONMENT);?>
