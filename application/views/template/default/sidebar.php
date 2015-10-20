<ul class="nav nav-sidebar">
	<li class="disabled">
		<a href=""><i class="fa fa-shopping-cart"></i> Penjualan</a>
		<ul class="nav sub-menu">
			<li class="">
				<a href="<?php echo base_url(); ?>"><i class="fa fa-file-text-o"></i> Delivery Order</a>
			</li>
		</ul>
	</li>
</ul>
<ul class="nav nav-sidebar">
	<li class="disabled">
		<a href=""><i class="fa fa-paperclip"></i> Konsinyasi</a>
		<ul class="nav sub-menu">
			<li class="">
				<a href="<?php echo base_url(); ?>"><i class="fa fa-file-text"></i> Surat Jalan Konsinyasi</a>
			</li>
		</ul>
	</li>
</ul>
<ul class="nav nav-sidebar">
	<li class="disabled"><a href=""><i class="fa fa-bar-chart"></i> Laporan</a></li>
</ul>
<ul class="nav nav-sidebar">
	<li class="">
		<a href="<?php echo base_url('purchasing'); ?>"><i class="fa fa-dollar"></i> Pembelian</a>
	</li>
</ul>
<ul class="nav nav-sidebar">
	<li class="">
		<a href="<?php echo base_url('product'); ?>"><i class="fa fa-align-justify"></i> Inventory</a>
		<ul class="nav sub-menu">
			<li class="">
				<a href="<?php echo base_url('inventory/product'); ?>"><i class="fa fa-cube"></i> Produk</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('inventory/productset'); ?>"><i class="fa fa-cubes"></i> Set Produk</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('inventory/instrument'); ?>"><i class="fa fa-gavel"></i> Instrumen</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('inventory/instrumentset'); ?>"><i class="fa fa-scissors"></i> Set Instrumen</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('inventory/category'); ?>"><i class="fa fa-cogs"></i> Kategori Produk</a>
			</li>
		</ul>
	</li>
</ul>
<ul class="nav nav-sidebar">
	<li class="">
		<a href="<?php echo base_url('product'); ?>"><i class="fa fa-database"></i> Katalog</a>
		<ul class="nav sub-menu">
			<li class="">
				<a href="<?php echo base_url('hospital'); ?>"><i class="fa fa-hospital-o"></i> Rumah Sakit</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('doctor'); ?>"><i class="fa fa-stethoscope"></i> Dokter</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('medicalassistant'); ?>"><i class="fa fa-user-secret"></i> Tenaga Ahli Medis</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('salesagent'); ?>"><i class="fa fa-male"></i> Agen Penjualan</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('patient'); ?>"><i class="fa fa-wheelchair"></i> Pasien</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('vendor'); ?>"><i class="fa fa-truck"></i> Supplier</a>
			</li>
			<li class="">
				<a href="<?php echo base_url('employee'); ?>"><i class="fa fa-medkit"></i> Instrumen</a>
			</li>
			<?php if($auth_level>=7) { ?>
				<li class="">
					<a href="<?php echo base_url('employee'); ?>"><i class="fa fa-female"></i> Pegawai</a>
				</li>
				<li class="">
					<a href="<?php echo base_url('user'); ?>"><i class="fa fa-users"></i> User</a>
				</li>
			<?php } ?>
		</ul>
	</li>
	
</ul>