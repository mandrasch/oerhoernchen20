<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
    <div class="container">
        <div class="row">
<div class="mx-auto col-lg-12 col-sm-12">
	<div class="row" style="margin-top:20px;">
		<div class="col-12">
			<h3>Backoffice</h3>
		</div>
		<div class="col-12">
	<ul class="nav">
	  <li class="nav-item">
	    <a class="nav-link active" href="<?php echo site_url('backoffice/entries_awaiting_approval') ?>">Awaiting approval</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="<?php echo site_url('backoffice/log_submitted_entries') ?>">Submitted Entries</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="<?php echo site_url('backoffice/log_imgur_uploads') ?>">Imgur uploads (not submitted)</a>
	  </li>
	   <li class="nav-item">
	    <a class="nav-link active" href="<?php echo site_url('backoffice/entries_flagged') ?>">Flagged</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="<?php echo site_url('auth/') ?>">User Management</a>
	  </li>
    <li class="nav-item">
	    <a class="nav-link" href="<?php echo site_url('oerhoernchen/cli/import_scrapy_json_results') ?>">IMPORT SCRAPY RESULTS</a>
	  </li>
    <li class="nav-item">
	    <a class="nav-link" href="<?php echo site_url('oerhoernchen/cli/crawl_hoou') ?>">Crawl HOOU.de</a>
	  </li>
	</ul>
	</div>

	<div class="col-12">
		<div id="backoffice-output">
				<?php echo $output; ?>
		</div>
	</div>
</div>

</div><!-- eo row -->
</div><!-- eo container -->
