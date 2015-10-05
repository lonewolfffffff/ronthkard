<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Ronthkard Inti Alkesindo</title>
		<meta charset="UTF-8">
		<meta name="description" content="Ronthkard"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css"); ?>">
		<link rel="stylesheet" href="<?php echo base_url("assets/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"); ?>" />
		<link rel="stylesheet" href="<?php echo base_url("assets/font-awesome-4.4.0/css/font-awesome.min.css"); ?>" />
		<link rel="stylesheet" href="<?php echo base_url("assets/js/jquery-ui/jquery-ui.theme.min.css"); ?>">
		<link rel="stylesheet" href="<?php echo base_url("assets/select2/select2.min.css"); ?>">
		<link rel="stylesheet" href="<?php echo base_url("assets/css/style.css?version=1.0"); ?>">
		<?php foreach($css_files as $file): ?>
			<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
	</head>
	<body>
		<nav class="navbar navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php echo base_url(); ?>" class="navbar-brand">
						<img id="logo" title="logo" alt="Ronthkard" src="<?php echo base_url('assets/img/logo-ronthkard.png'); ?>" class="img-responsive"/>
					</a>
				</div>
				<div class="navbar-collapse collapse" id="navbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Dashboard</a></li>
						<li><a href="#">Settings</a></li>
						<li><a href="#">Profile</a></li>
						<li><a href="#">Help</a></li>
					</ul>
					<form class="navbar-form navbar-right">
						<input type="text" placeholder="Search..." class="form-control">
					</form>
				</div>
			</div>
		</nav>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<?php $this->load->view('template/default/sidebar'); ?>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h4 class="page-header"><?php echo $page_title; ?></h4>
					<div><?php $this->load->view('page/'.$page); ?></div>
				</div>
			</div>
		</div>
		<?php
			echo isset($extra_footer)?$extra_footer:"";
		?>
		<script>
			var base_url = '<?php echo base_url() ?>';
		</script>
		<script src="<?php echo base_url("assets/js/jquery-1.11.3.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/js/jquery-ui/jquery-ui.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/bootstrap/js/bootstrap.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/bower_components/moment/min/moment.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/select2/select2.min.js"); ?>"></script>

		<script src="<?php echo base_url("assets/js/utils.js"); ?>"></script>
		<script src="<?php echo base_url("assets/js/datetime_helper.js"); ?>"></script>
		<?php foreach($js_files as $file): ?>
			<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>
		<?php if(isset($custom_script)) { ?>
			<script src="<?php echo base_url("assets/js/$custom_script"); ?>"></script>
		<?php } ?>
	</body>
</html>