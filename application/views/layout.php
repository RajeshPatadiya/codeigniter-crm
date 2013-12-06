<!DOCTYPE html>
<html>
  <head>
    <title>Referral CRM Tracking System</title>
    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="<?=site_url()?>public/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" media="all" />
  </head>
  <body class="preview" id="top" data-spy="scroll" data-target=".subnav" data-offset="80">
	<script type="text/javascript" src="<?=site_url()?>public/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>public/js/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>public/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?=site_url()?>public/js/main.js"></script>
	<?= $contents ?>

	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Modal header</h3>
		</div>
		<div class="modal-body" id="modal-body">
			<p>One fine body…</p>
		</div>
	</div>
  </body>
</html>
