<?php $base_link_url = $this->config->item('base_url').$this->config->item('index_page');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-3">
					<h1><?= $title; ?></h1>
				</div>
				<div class="col-sm-1">
					<a href="<?php echo $base_link_url; ?>mapplication/add" class="btn btn-block bg-gradient-success btn-flat">Add New</a>
				</div>
				<div class="col-sm-8">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Manage</a></li>
						<li class="breadcrumb-item active"><?= $title; ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?= $title; ?> Lists</h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
						<i class="fas fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body">

				<?php //
				//           if ($this->session->userdata('cur_add') == 1) {
				//                    echo anchor('country/add/', 'add new', array('class' => 'btn btn-success'));
				//           }?>
				<br><br>
				<table id='m_application' class="table table-striped table-bordered">
					<thead>
					<tr>
						<th>#</th>
						<th>Applicant Name</th>
						<th>Applicant Current City</th>
						<th>Applicant Current Province</th>
						<th>Applicant Current Postal Code</th>
						<th>Applicant Current Address Type</th>
						<th>&nbsp;</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if (count($applications)) {
						$i = 1;

						foreach ($applications as $g) {
							echo "<tr>";
							echo "<td>" . $i . "</td>";
							echo "<td> " . $g->applicant_name . " </td>";
							echo "<td>" . $g->applicant_current_city . "</td>";
							echo "<td>" . $g->applicant_current_province . "</td>";
							echo "<td>" . $g->applicant_current_postal_code . "</td>";
							echo "<td>" . $g->applicant_current_address_type . "</td>";
							echo "<td>
									<a  href='javascript:void(0)' onclick='deleteApplication($g->id)' ><span class='fa fa-trash-o' style='color: red'></span></a>
									<a href='" . $base_link_url . "mapplication/view/".$g->id."'><span class='fa fa-eye'></span></a>
									<a href='" . $base_link_url . "mapplication/edit/".$g->id."'><span class='fa fa-edit'></span></a>
									</td>";
							echo "</tr>";
							$i++;
						}
					}
					?></tbody>
				</table>
			</div>
			<!-- /.card -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
	$(document).ready(function () {
		$('#m_application').DataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bInfo": false,
			"bAutoWidth": false,
			"sPaginationType": "full_numbers",
			"iDisplayLength": 5,
		});
	});

	function deleteApplication(application_id) {
		var val = confirm('Are you sure want to delete this  country ?');
		var base_url = "<?php echo base_url(); ?>";
		if (val) {
			$.ajax({
				type: 'POST',
				url: base_url + 'mapplication/delete/',
				data: {application_id: application_id},
				success: function (data) {

					if (data == 'Success') {
						alert(" Application Successfully Removed");
						location.reload();
					} else {
						alert(data);
					}
					//$('#transport_table').html(data);
				}
			});
		} else {
			return false;
		}
	}

	$("#p6").addClass('active');
</script>
