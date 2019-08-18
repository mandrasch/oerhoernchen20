<?php defined('BASEPATH') OR exit('No direct script access allowed');

$general_js_files = array(
	'jquery.min.js',
	'popper.min.js',
	'bootstrap.bundle.min.js',
	'bootstrap.show-modal.js',
	'sweetalert.js',
	'jquery.serializejson.min.js',
	'cookiealert.js',
	'pace.min.js',
	'clean-blog.min.js',
	'oerhoernchen.js',

);

?>


<!-- START Bootstrap-Cookie-Alert -->
<div class="alert text-center cookiealert" role="alert">
  Es handelt sich um eine private und nicht-öffentliche Prototyp-Version. Für die Sicherheit von personenbezogenen Daten kann keine umfassende Haftung übernommen werden, die Benutzung erfolgt auf eigenes Risiko. Zudem werden externe Dienste wie Appbase.io, Google Fonts, Imgur, etc. eingebunden - eingegebene Daten werden also ggf. an Drittanbieter übermittelt. Mit der Nutzung des Prototypens stimmen Sie einer möglichen Übermittlung zu.
    <button type="button" class="btn-primary btn-sm acceptcookies" aria-label="Close">
        Ich stimme zu
    </button>
</div>
<!-- END Bootstrap-Cookie-Alert -->

<footer>
<div class="row">
  <div class="col-12 text-center">
<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-item nav-link" href="<?php echo site_url('backoffice'); ?>">Backoffice</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" target="_blank" href="https://blog.matthias-andrasch.de/impressum">Impressum</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url("oerhoernchen/privacy");?>">Datenschutz</a>
  </li>
</ul>

  </div>
</div>
</footer>

  <script type="text/javascript">
    var BASE_URL = '<?php echo base_url(); ?>';
  </script>

    <?php foreach ($general_js_files as $file): ?>
        <script src="<?php echo base_url(); ?>assets/js/<?php echo $file; ?>"></script>
      <?php endforeach;?>


    <?php if (isset($js_files)): ?>
        <?php foreach ($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
      <?php endforeach;?>
    <?php endif;?>

    <!-- font awesome 5 free -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/fontawesome5-free/js/all.js"></script>
</body>

</html>
