<style>
	* {
		margin: 0;
		padding: 0;
	}

	html {
		height: 100%;
	}

	#grad1 {
		/* Background color if needed */
	}

	#msform {
		text-align: center;
		position: relative;
		margin-top: 20px;
	}

	#msform fieldset .form-card {
		background: white;
		border: 0 none;
		border-radius: 0px;
		box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
		padding: 20px 40px 30px 40px;
		box-sizing: border-box;
		width: 94%;
		margin: 0 3% 20px 3%;
		position: relative;
	}

	#msform fieldset {
		background: white;
		border: 0 none;
		border-radius: 0.5rem;
		box-sizing: border-box;
		width: 100%;
		margin: 0;
		padding-bottom: 20px;
		position: relative;
	}

	#msform fieldset:not(:first-of-type) {
		display: none;
	}

	#msform fieldset .form-card {
		text-align: left;
		color: #9E9E9E;
	}

	#msform input,
	#msform textarea {
		padding: 0px 8px 4px 8px;
		border: none;
		border-bottom: 1px solid #ccc;
		border-radius: 0px;
		margin-bottom: 25px;
		margin-top: 2px;
		width: 100%;
		box-sizing: border-box;
		font-family: montserrat;
		color: #2C3E50;
		font-size: 16px;
		letter-spacing: 1px;
	}

	#msform input:focus,
	#msform textarea:focus {
		box-shadow: none !important;
		border: none;
		font-weight: bold;
		border-bottom: 2px solid skyblue;
		outline-width: 0;
	}

	#msform .action-button {
		width: 120px;
		background: skyblue;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 0px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 5px;
	}

	#msform .action-button:hover,
	#msform .action-button:focus {
		box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
	}

	#msform .action-button-previous {
		width: 120px;
		background: #616161;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 0px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 5px;
	}

	#msform .action-button-previous:hover,
	#msform .action-button-previous:focus {
		box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
	}

	select.list-dt {
		border: none;
		outline: 0;
		border-bottom: 1px solid #ccc;
		padding: 2px 5px 3px 5px;
		margin: 2px;
	}

	select.list-dt:focus {
		border-bottom: 2px solid skyblue;
	}

	.card {
		z-index: 0;
		border: none;
		border-radius: 0.5rem;
		position: relative;
	}

	.fs-title {
		font-size: 25px;
		color: #2C3E50;
		margin-bottom: 10px;
		font-weight: bold;
		text-align: left;
	}

	#progressbar {
		margin-bottom: 30px;
		overflow: hidden;
		color: lightgrey;
	}

	#progressbar .active {
		color: #000000;
	}

	#progressbar li {
		list-style-type: none;
		font-size: 12px;
		width: 12.5%;
		float: left;
		position: relative;
		cursor: pointer;
	}

	#progressbar #account:before {
		font-family: FontAwesome;
		content: "\f015";
		width: 40px;
		height: 40px;
	}

	#progressbar #personal:before {
		font-family: FontAwesome;
		content: "\f007";
		width: 40px;
		height: 40px;
	}

	#progressbar #payment:before {
		font-family: FontAwesome;
		content: "\f155";
		width: 40px;
		height: 40px;
	}

	#progressbar #financial:before {
		font-family: FontAwesome;
		content: "\f073";
		width: 40px;
		height: 40px;
	}

	#progressbar #confirm:before {
		font-family: FontAwesome;
		content: "\f00c";
		width: 40px;
		height: 40px;
	}

	#progressbar #employment:before {
		font-family: FontAwesome;
		content: "\f0f2";
		width: 40px;
		height: 40px;
	}

	#progressbar #income:before {
		font-family: FontAwesome;
		content: "\f0d6";
		width: 40px;
		height: 40px;
	}

	#progressbar #loan:before {
		font-family: FontAwesome;
		content: "\f155";
		width: 40px;
		height: 40px;
	}

	#progressbar #property:before {
		font-family: FontAwesome;
		content: "\f15c";
		width: 40px;
		height: 40px;
	}

	#progressbar #mortgage:before {
		font-family: FontAwesome;
		content: "\f018";
		width: 40px;
		height: 40px;
	}

	#progressbar #financial:before {
		font-family: FontAwesome;
		content: "\f080";
		width: 40px;
		height: 40px;
	}

	#progressbar #general:before {
		font-family: FontAwesome;
		content: "\f087";
		width: 40px;
		height: 40px;
	}

	#progressbar li:before {
		font-family: FontAwesome;
		width: 50px;
		height: 50px;
		line-height: 40px;
		display: block;
		font-size: 18px;
		color: #ffffff;
		background: lightgray;
		border-radius: 50%;
		margin: 0 auto 10px auto;
		padding: 2px;
	}

	#progressbar li:after {
		content: '';
		width: 100%;
		height: 2px;
		background: lightgray;
		position: absolute;
		left: 0;
		top: 25px;
		z-index: -1;
	}

	#progressbar li.active:before,
	#progressbar li.active:after {
		background: skyblue;
	}

	.radio-group {
		position: relative;
		margin-bottom: 25px;
	}

	.radio {
		display: inline-block;
		width: 100px;
		height: 50px;
		border-radius: 0;
		background: lightblue;
		box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
		box-sizing: border-box;
		cursor: pointer;
		margin: 8px 2px;
	}

	.radio:hover {
		box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
	}

	.radio.selected {
		box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
	}

	.fit-image {
		width: 100%;
		object-fit: cover;
	}

	.span-font {
		font-size: 12px;
		font-weight: lighter
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $title; ?></h1>
				</div>
				<div class="col-sm-6">
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
				<h3 class="card-title"><?= $title; ?></h3>
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
				<!-- MultiStep Form -->
				<div class="container-fluid" id="grad1">
					<div class="row justify-content-center mt-0">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
							<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
								<h2><strong>Complete Your Mortgage Application</strong></h2>
								<p>Fill all form fields to proceed to the next step</p>
								<div class="row">
									<div class="col-md-12 mx-0">
										<form  class="well form-horizontal" id="msform" action="<?php echo base_url(); ?>Mapplication/save" method="post">
											<!-- progressbar -->
											<ul id="progressbar">
												<li class="active" id="personal"><strong>APPLICANT DETAILS</strong></li>
												<li id="employment"><strong>EMPLOYMENT</strong></li>
												<li id="income"><strong>TYPE AND INCOME</strong></li>
												<li id="loan"><strong>LOAN</strong></li>
												<li id="property"><strong>PROPERTY</strong></li>
												<li id="mortgage"><strong>MORTGAGE</strong></li>
												<li id="financial"><strong>FINANCIAL</strong></li>
												<li id="general"><strong>GENERAL</strong></li>
											</ul>
											<!-- fieldsets -->


											<fieldset>
												<div class="form-card">
													<h2 class="fs-title">Primary Applicant Details</h2>
													<div class="row" style="margin-top: 30px">
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">Initial</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="applicant_initial">
																	<option value="">Select Initial</option>
																	<option value="mr">Mr.</option>
																	<option value="mrs">Mrs.</option>
																	<option value="ms">Ms.</option>
																	<option value="dr">Dr.</option>
																	<option value="other">Other</option>
																</select>
															</div>
														</div>

														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">Initial <span
																		class="span-font">(If initial other)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_other_initial"
																	   placeholder="Enter initial">
															</div>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<label for="exampleInputEmail1">Name</label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_name"
																	   placeholder="Enter name(First, Middle, Last)">
															</div>
														</div>
														<div class="col-md-12">
															<h5><b style="color: skyblue"> Current Address</b></h5>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">City</label>
																<input type="email" class="form-control"
																	   id="exampleInputEmail1" placeholder="Enter city"
																	   name="applicant_current_city">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Province</label>
																<input type="email" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter province"
																	   name="applicant_current_province">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Postal Code</label>
																<input type="email" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter postal code"
																	   name="applicant_current_postal_code">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Current Address</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="applicant_current_address_type">
																	<option value="">Select Address Type</option>
																	<option value="own">Own</option>
																	<option value="parent">Parent</option>
																	<option value="rent">Rent</option>
																</select>
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Rent<span
																		class="span-font">(If address is rent)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputName" name="applicant_rent"
																	   placeholder="Enter rent">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Year
																	<span
																		class="span-font">(Time Spent at thisAddress)</span>
																</label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_current_address_spend_year">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Month
																	<span
																		class="span-font">(Time Spent at thisAddress)</span>
																</label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_current_address_spend_month">
															</div>
														</div>

														<div class="col-md-12">
															<h5><b style="color: skyblue"> Prior Address </b> <span
																	class="span-font">(If less than 3 years at current)</span>
															</h5>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">City</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1" placeholder="Enter city"
																	   name="applicant_prior_city">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Province</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter province"
																	   name="applicant_prior_province">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Postal Code</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter postal code"
																	   name="applicant_prior_postal_code">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Prior Address</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="applicant_prior_address_type">
																	<option value="">Select Address Type</option>
																	<option value="own">Own</option>
																	<option value="parent">Parent</option>
																	<option value="rent">Rent</option>
																</select>
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Rent <span
																		class="span-font">(If address is rent)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputName" name="applicant_prior_rent"
																	   placeholder="Enter rent">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Year<span
																		class="span-font">(Time Spent at thisAddress)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_prior_address_spend_year">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Month<span
																		class="span-font">(Time Spent at thisAddress)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_prior_address_spend_month">
															</div>
														</div>

														<div class="col-md-12">
															<h5><b style="color: skyblue"> Other Details </b></h5>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Home#</label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_home_number">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Cell#</label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_cell_number">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Birth Date</label>
																<input type="date" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_birth_date">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">S.I.N</label>
																<input type="number" class="form-control"
																	   id="exampleInputName" name="applicant_sin">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Gender</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="applicant_gender">
																	<option value="">Select Gender</option>
																	<option value="male">Male</option>
																	<option value="female">Female</option>
																</select>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Number of
																	Dependents</label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_number_of_dependents">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Marital Status</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="applicant_marital_status">
																	<option value="">Select Marital Status</option>
																	<option value="single">Single</option>
																	<option value="married">Married</option>
																	<option value="widowed">Widowed</option>
																	<option value="separated">Separated</option>
																	<option value="divorced">Divorced</option>
																	<option value="common_law">Common Law</option>
																</select>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label for="exampleInputEmail1">Email</label>
																<input type="email" class="form-control"
																	   id="exampleInputName" name="applicant_email"
																	   placeholder="Enter email">
															</div>
														</div>

													</div>


													<h2 class="fs-title">CO-Applicant Details</h2>
													<div class="row" style="margin-top: 30px">
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">Initial</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="co_applicant_initial">
																	<option value="">Select Initial</option>
																	<option value="mr">Mr.</option>
																	<option value="mrs">Mrs.</option>
																	<option value="ms">Ms.</option>
																	<option value="dr">Dr.</option>
																	<option value="other">Other</option>
																</select>
															</div>
														</div>

														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">Initial <span
																		class="span-font">(If initial other)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_other_initial"
																	   placeholder="Enter initial">
															</div>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<label for="exampleInputEmail1">Name</label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_name"
																	   placeholder="Enter name(First, Middle, Last)">
															</div>
														</div>
														<div class="col-md-12">
															<h5><b style="color: skyblue"> Current Address</b></h5>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">City</label>
																<input type="email" class="form-control"
																	   id="exampleInputEmail1" placeholder="Enter city"
																	   name="co_applicant_current_city">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Province</label>
																<input type="email" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter province"
																	   name="co_applicant_current_province">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Postal Code</label>
																<input type="email" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter postal code"
																	   name="co_applicant_current_postal_code">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Current Address</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="co_applicant_current_address_type">
																	<option value="">Select Address Type</option>
																	<option value="own">Own</option>
																	<option value="parent">Parent</option>
																	<option value="rent">Rent</option>
																</select>
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Rent<span
																		class="span-font">(If address is rent)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputName" name="co_applicant_rent"
																	   placeholder="Enter rent">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Year
																	<span
																		class="span-font">(Time Spent at thisAddress)</span>
																</label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_current_address_spend_year">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Month
																	<span
																		class="span-font">(Time Spent at thisAddress)</span>
																</label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_current_address_spend_month">
															</div>
														</div>

														<div class="col-md-12">
															<h5><b style="color: skyblue"> Prior Address </b> <span
																	class="span-font">(If less than 3 years at current)</span>
															</h5>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">City</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1" placeholder="Enter city"
																	   name="co_applicant_prior_city">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Province</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter province"
																	   name="co_applicant_prior_province">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Postal Code</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter postal code"
																	   name="co_applicant_prior_postal_code">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Prior Address</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="co_applicant_prior_address_type">
																	<option value="">Select Address Type</option>
																	<option value="own">Own</option>
																	<option value="parent">Parent</option>
																	<option value="rent">Rent</option>
																</select>
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Rent <span
																		class="span-font">(If address is rent)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_prior_rent"
																	   placeholder="Enter rent">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Year<span
																		class="span-font">(Time Spent at thisAddress)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_prior_address_spend_year">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Month<span
																		class="span-font">(Time Spent at thisAddress)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_prior_address_spend_month">
															</div>
														</div>

														<div class="col-md-12">
															<h5><b style="color: skyblue"> Other Details </b></h5>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Home#</label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_home_number">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Cell#</label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_cell_number">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Birth Date</label>
																<input type="date" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_birth_date">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">S.I.N</label>
																<input type="number" class="form-control"
																	   id="exampleInputName" name="co_applicant_sin">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Gender</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="co_applicant_gender">
																	<option value="">Select Gender</option>
																	<option value="male">Male</option>
																	<option value="female">Female</option>
																</select>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Number of
																	Dependents</label>
																<input type="number" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_number_of_dependents">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Marital Status</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="co_applicant_marital_status">
																	<option value="">Select Marital Status</option>
																	<option value="single">Single</option>
																	<option value="married">Married</option>
																	<option value="widowed">Widowed</option>
																	<option value="separated">Separated</option>
																	<option value="divorced">Divorced</option>
																	<option value="common_law">Common Law</option>
																</select>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label for="exampleInputEmail1">Email</label>
																<input type="email" class="form-control"
																	   id="exampleInputName" name="co_applicant_email"
																	   placeholder="Enter email">
															</div>
														</div>

													</div>

												</div>
												<input type="button" name="next" class="next action-button"
													   value="Next Step"/>
											</fieldset>


											<fieldset>
												<div class="form-card">


													<h2 class="fs-title">Primary Applicant Employment Details <span
															class="span-font">(provide previous employment if less than 3 years at current employment)</span>
													</h2>
													<div class="row" style="margin-top: 30px">

														<div class="col-md-12">
															<h5><b style="color: skyblue"> Current Details</b></h5>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Employer</label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_current_employer"
																	   placeholder="Enter current employer">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Job Title</label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_current_job_title"
																	   placeholder="Enter current job title">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">City</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1" placeholder="Enter city"
																	   name="applicant_employment_current_city">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Province</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter province"
																	   name="applicant_employment_current_province">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Postal Code</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter postal code"
																	   name="applicant_employment_current_postal_code">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Income</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter income"
																	   name="applicant_current_income">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Phone</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter phone number"
																	   name="applicant_employment_current_phone">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Fax</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter fax number"
																	   name="applicant_employment_current_fax">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Year <span
																		class="span-font">(How long)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter value"
																	   name="applicant_employment_current_year">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Month <span
																		class="span-font">(How long)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter value"
																	   name="applicant_employment_current_month">
															</div>
														</div>


														<div class="col-md-12">
															<h5><b style="color: skyblue"> Previous Details</b></h5>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Employer</label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_previous_employer"
																	   placeholder="Enter previous employer">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Job Title</label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="applicant_previous_job_title"
																	   placeholder="Enter previous job title">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">City</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1" placeholder="Enter city"
																	   name="applicant_employment_previous_city">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Province</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter province"
																	   name="applicant_employment_previous_province">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Postal Code</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter postal code"
																	   name="applicant_employment_previous_postal_code">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Income</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter income"
																	   name="applicant_previous_income">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Phone</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter phone number"
																	   name="applicant_employment_previous_phone">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Fax</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter fax number"
																	   name="applicant_employment_previous_fax">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Year <span
																		class="span-font">(How long)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter value"
																	   name="applicant_employment_previous_year">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Month <span
																		class="span-font">(How long)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter value"
																	   name="applicant_employment_previous_month">
															</div>
														</div>

													</div>


													<h2 class="fs-title">CO-Applicant Employment Details <span
															class="span-font">(provide previous employment if less than 3 years at current employment)</span>
													</h2>
													<div class="row" style="margin-top: 30px">

														<div class="col-md-12">
															<h5><b style="color: skyblue"> Current Details</b></h5>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Employer</label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_current_employer"
																	   placeholder="Enter current employer">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Job Title</label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_current_job_title"
																	   placeholder="Enter current job title">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">City</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1" placeholder="Enter city"
																	   name="co_applicant_employment_current_city">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Province</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter province"
																	   name="co_applicant_employment_current_province">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Postal Code</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter postal code"
																	   name="co_applicant_employment_current_postal_code">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Income</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter income"
																	   name="co_applicant_current_income">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Phone</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter phone number"
																	   name="co_applicant_employment_current_phone">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Fax</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter fax number"
																	   name="co_applicant_employment_current_fax">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Year <span
																		class="span-font">(How long)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter value"
																	   name="co_applicant_employment_current_year">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Month <span
																		class="span-font">(How long)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter value"
																	   name="co_applicant_employment_current_month">
															</div>
														</div>


														<div class="col-md-12">
															<h5><b style="color: skyblue"> Previous Details</b></h5>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Employer</label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_previous_employer"
																	   placeholder="Enter previous employer">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Job Title</label>
																<input type="text" class="form-control"
																	   id="exampleInputName"
																	   name="co_applicant_previous_job_title"
																	   placeholder="Enter previous job title">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">City</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1" placeholder="Enter city"
																	   name="co_applicant_employment_previous_city">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Province</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter province"
																	   name="co_applicant_employment_previous_province">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Postal Code</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter postal code"
																	   name="co_applicant_employment_previous_postal_code">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Income</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter income"
																	   name="co_applicant_previous_income">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Phone</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter phone number"
																	   name="co_applicant_employment_previous_phone">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Fax</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter fax number"
																	   name="co_applicant_employment_previous_fax">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Year <span
																		class="span-font">(How long)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter value"
																	   name="co_applicant_employment_previous_year">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Month <span
																		class="span-font">(How long)</span></label>
																<input type="number" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter value"
																	   name="co_applicant_employment_previous_month">
															</div>
														</div>

													</div>


												</div>
												<input type="button" name="previous"
													   class="previous action-button-previous" value="Previous Step"/>
												<input type="button" name="next" class="next action-button"
													   value="Next Step"/>
											</fieldset>
											<fieldset>
												<div class="form-card">


													<div>
														<h2 class="fs-title">Applicant Types And Amount Of Income
															Details</h2>
														<div class="row" style="margin-top: 30px">

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Full Time($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_income_full_time"
																		   placeholder="Enter full time income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Self
																		Employed($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_income_self_employed"
																		   placeholder="Enter self-employed income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Contract($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_income_contract"
																		   placeholder="Enter contract income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label
																		for="exampleInputEmail1">Commission($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_income_commission"
																		   placeholder="Enter commission income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Part-time
																		W/Guaranteed Hrs($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_income_part_time_w_guaranteed"
																		   placeholder="Enter part time W/Guaranteed Hrs income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Part-time W/O
																		Guaranteed Hrs($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_income_part_time_w_o_guaranteed"
																		   placeholder="Enter part time W/O Guaranteed Hrs income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Rental($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_income_rental"
																		   placeholder="Enter rental income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label
																		for="exampleInputEmail1">Investment($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_income_investment"
																		   placeholder="Enter investment income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Other($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_income_other"
																		   placeholder="Enter other income">
																</div>
															</div>

															<div class="col-md-12">
																<div class="form-group">
																	<label for="exampleInputEmail1">Total($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_income_total"
																		   placeholder="Enter total income">
																</div>
															</div>
														</div>
													</div>


													<div>
														<h2 class="fs-title">CO-Applicant Types And Amount Of Income
															Details</h2>
														<div class="row" style="margin-top: 30px">

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Full Time($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="co_applicant_income_full_time"
																		   placeholder="Enter full time income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Self
																		Employed($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="co_applicant_income_self_employed"
																		   placeholder="Enter self-employed income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Contract($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="co_applicant_income_contract"
																		   placeholder="Enter contract income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label
																		for="exampleInputEmail1">Commission($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="co_applicant_income_commission"
																		   placeholder="Enter commission income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Part-time
																		W/Guaranteed Hrs($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="co_applicant_income_part_time_w_guaranteed"
																		   placeholder="Enter part time W/Guaranteed Hrs income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Part-time W/O
																		Guaranteed Hrs($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="co_applicant_income_part_time_w_o_guaranteed"
																		   placeholder="Enter part time W/O Guaranteed Hrs income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Rental($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="co_applicant_income_rental"
																		   placeholder="Enter rental income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label
																		for="exampleInputEmail1">Investment($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="co_applicant_income_investment"
																		   placeholder="Enter investment income">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Other($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="co_applicant_income_other"
																		   placeholder="Enter other income">
																</div>
															</div>

															<div class="col-md-12">
																<div class="form-group">
																	<label for="exampleInputEmail1">Total($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="co_applicant_income_total"
																		   placeholder="Enter total income">
																</div>
															</div>
														</div>
													</div>

												</div>
												<input type="button" name="previous"
													   class="previous action-button-previous" value="Previous Step"/>
												<input type="button" name="next" class="next action-button"
													   value="Next Step"/>
											</fieldset>
											<fieldset>
												<div class="form-card">


													<div>
														<h2 class="fs-title">PURPOSE OF LOAN</h2>
														<div class="row" style="margin-top: 30px">


															<div class="col-md-8">
																<div class="form-group">
																	<label for="exampleInputEmail1">Purpose of
																		loan</label>
																	<select class="custom-select form-control-border"
																			id="exampleSelectBorder"
																			name="purpose_of_loan">
																		<option value="">Select Purpose of Loan</option>
																		<option value="pre_approval">Pre-Approval
																		</option>
																		<option value="home_purchase">Home Purchase
																		</option>
																		<option value="transfer_of_mortgage">Transfer Of
																			Mortgage
																		</option>
																		<option value="refinance_or_equity">
																			Refinance/Equity
																		</option>
																	</select>
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="exampleInputEmail1">Reason <span
																			class="span-font">(If yes, for what reason)</span></label>
																	<input type="text" class="form-control"
																		   id="exampleInputName"
																		   name="applicant_loan_reason"
																		   placeholder="Enter the reason">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="exampleInputEmail1">Sales
																		Price($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="sales_price"
																		   placeholder="Enter sales price">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="exampleInputEmail1">Down
																		Payment($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="down_payment"
																		   placeholder="Enter down payment">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="exampleInputEmail1">Mortgage
																		Amount($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="mortgage_amount"
																		   placeholder="Enter mortgage amount">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="exampleInputEmail1">Date funds are
																		required</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="date_fund"
																		   placeholder="Enter date funds">
																</div>
															</div>

															<div class="col-md-12">
																<p> Sources of Down Payment</p>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="exampleInputEmail1">Gift($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="loan_gift"
																		   placeholder="Enter gift amount">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label
																		for="exampleInputEmail1">Investment($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="loan_investment"
																		   placeholder="Enter investment amount">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="exampleInputEmail1">Bank
																		Account($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="loan_bank_account"
																		   placeholder="Enter bank account amount">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="exampleInputEmail1">Borrowed
																		Funds($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="loan_borrowed_funds"
																		   placeholder="Enter borrowed funds">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="exampleInputEmail1">Sweat
																		Equity($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="loan_sweat_equity"
																		   placeholder="Enter sweat equity">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="exampleInputEmail1">Other($)</label>
																	<input type="number" class="form-control"
																		   id="exampleInputName"
																		   name="loan_other"
																		   placeholder="Enter other equity">
																</div>
															</div>

														</div>
													</div>

												</div>
												<input type="button" name="previous"
													   class="previous action-button-previous" value="Previous Step"/>
												<input type="button" name="next" class="next action-button"
													   value="Next Step"/>
											</fieldset>
											<fieldset>
												<div class="form-card">

													<h2 class="fs-title">PROPERTY DETAILS</h2>
													<div class="row" style="margin-top: 30px">

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Street</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter street"
																	   name="property_street">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">City</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1" placeholder="Enter city"
																	   name="property_city">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Province</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter province"
																	   name="property_province">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Postal Code</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter postal code"
																	   name="property_postal_code">
															</div>
														</div>

														<div class="col-md-12">
															<h5><b style="color: skyblue"> Legal Description </b></h5>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">LOT</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter LOT"
																	   name="property_lot">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Plan</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter plan"
																	   name="property_plan">
															</div>
														</div>


														<div class="col-md-12">
															<h5><b style="color: skyblue"> Other Details </b></h5>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Type of Heating</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="property_type_of_heating">
																	<option value="">Select Type of Heating</option>
																	<option value="electric_baseboard">Electric
																		Baseboard
																	</option>
																	<option value="water_heating">Water Heating</option>
																	<option value="force_air">Force Air</option>
																	<option value="other">Other</option>
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Other <span
																		class="span-font">(If type of heating is other)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter other type of heating"
																	   name="property_type_of_heating_other">
															</div>
														</div>


														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Property Type</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="property_type">
																	<option value="">Select Property Type</option>
																	<option value="detached">Detached</option>
																	<option value="semi_detached">Semi-Detached</option>
																	<option value="high_rise_apartment">High Rise
																		Apartment
																	</option>
																	<option value="bungalow">Bungalow</option>
																	<option value="row_house_or_townhouse">Row
																		House/Townhouse
																	</option>
																	<option value="other">Other</option>
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Other <span
																		class="span-font">(If property type is other)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter other property type"
																	   name="property_type_other">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Zoning</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="property_zoning">
																	<option value="">Select Zoning</option>
																	<option value="residential">Residential</option>
																	<option value="commercial">Commercial</option>
																	<option value="farm">Farm</option>
																	<option value="other">Other</option>
																</select>
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Other <span
																		class="span-font">(If zoning is other)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter other zoning"
																	   name="property_zoning_other">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Property Title</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="property_title">
																	<option value="">Select Property Title</option>
																	<option value="freehold">Freehold</option>
																	<option value="leasehold">Leasehold</option>
																	<option value="condominium_or_state">
																		Condominium/State
																	</option>
																</select>
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Garage Type</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="property_garage_type">
																	<option value="">Select Garage Type</option>
																	<option value="attached">Attached</option>
																	<option value="owner_occupied">Owner Occupied
																	</option>
																	<option value="detached">Detached</option>
																	<option value="rental_property">Rental Property
																	</option>
																</select>
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Garage Size</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="property_garage_size">
																	<option value="">Select Garage Size</option>
																	<option value="single">Single</option>
																	<option value="double">Double</option>
																	<option value="triple">Triple</option>
																	<option value="specify">Specify</option>
																</select>
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Specify <span
																		class="span-font">(If garage size is specify)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter other zoning"
																	   name="property_garage_size_specify">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Number of Storey</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter number of storey"
																	   name="property_number_of_storey">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Insurance Cost <span
																		class="span-font">(per month)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter insurance cost"
																	   name="property_insurance_cost_per_month">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Heating Cost <span
																		class="span-font">(per month)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter heating cost"
																	   name="property_heating_cost_per_month">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Hydro Cost <span
																		class="span-font">(per month)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter hydro cost"
																	   name="property_hydro_cost_per_month">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Maintenance Fee <span
																		class="span-font">(per month)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter maintenance fee"
																	   name="property_maintenance_fee_per_month">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Property Tax</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter property tax"
																	   name="property_tax">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Lot Size</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter lot size"
																	   name="property_lot_size">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Liveable Space <span>(sq ft)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter liveable space"
																	   name="property_liveable_space">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Current Estimated
																	Value</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter current estimated value"
																	   name="property_current_estimated_value">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Age of Property</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter age of property"
																	   name="property_age">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Date of Purchase</label>
																<input type="date" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter age of property"
																	   name="property_date_of_purchase">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Original Purchase
																	Price</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter original purchase price"
																	   name="property_original_purchase_price">
															</div>
														</div>


													</div>

												</div>
												<input type="button" name="previous"
													   class="previous action-button-previous" value="Previous Step"/>
												<input type="button" name="next" class="next action-button"
													   value="Next Step"/>
											</fieldset>
											<fieldset>
												<div class="form-card">

													<h2 class="fs-title">MORTGAGE INFORMATION</h2>
													<div class="row" style="margin-top: 30px">

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Mortgage Type</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter mortgage type"
																	   name="mortgage_type">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Original Mtg
																	Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter original mtg amount"
																	   name="mortgage_original_mtg_amount">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Mortgage Balance</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter mortgage balance"
																	   name="mortgage_balance">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Mortgage Payment</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter mortgage payment"
																	   name="mortgage_payment">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Payment
																	Frequency</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter payment frequency"
																	   name="mortgage_payment_frequency">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Maturity Date</label>
																<input type="date" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter maturity date"
																	   name="mortgage_maturity_date">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Term Type</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter term type"
																	   name="mortgage_term_type">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Amortization</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amortization"
																	   name="mortgage_amortization">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Remaining
																	Amortization</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter remaining amortization"
																	   name="mortgage_remaining_amortization">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Rate Type</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter rate type"
																	   name="mortgage_rate_type">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Interest Rate</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter interest rate"
																	   name="mortgage_interest_rate">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Insurer (CMHC)
																	Number</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter insurer (CMHC) number"
																	   name="mortgage_insurer_cmhc_number">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Mortgage Holder</label>
																<select class="custom-select form-control-border"
																		id="exampleSelectBorder"
																		name="mortgage_holder">
																	<option value="">Select Mortgage Holder</option>
																	<option value="1">1st</option>
																	<option value="2">2nd</option>
																	<option value="3">3rd</option>
																	<option value="other">Other</option>
																</select>
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Other <span
																		class="span-font">(If mortgage holder is other)</span></label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter mortgage other"
																	   name="mortgage_holder_other">
															</div>
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="exampleInputEmail1">Mortgage Number</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter mortgage number"
																	   name="mortgage_number">
															</div>
														</div>


													</div>

												</div>
												<input type="button" name="previous"
													   class="previous action-button-previous" value="Previous Step"/>
												<input type="button" name="next" class="next action-button"
													   value="Next Step"/>
											</fieldset>
											<fieldset>
												<div class="form-card">

													<h2 class="fs-title">FINANCIAL INFORMATION</h2>
													<div class="row" style="margin-top: 30px">

														<div class="col-md-12">
															<h5><b style="color:skyblue;">ASSETS</b></h5>
														</div>


														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Value of
																	Property</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_value_of_property_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_value_of_property_amount">
															</div>
														</div>


														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Cash in bank</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_cash_in_bank_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_cash_in_bank_amount">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Deposit on Purchase</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_deposit_on_purchase_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_deposit_on_purchase_amount">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Other Real Estates</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_other_real_estates_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_other_real_estates_amount">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Household Goods</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_household_goods_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_household_goods_amount">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Cars</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_car_1_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_car_1_amount">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Cars</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_car_2_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_car_2_amount">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">RRSP(contributed)</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_rrsp_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_rrsp_amount">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Stock, Bonds, etc</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_stock_bonds_etc_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_stock_bonds_etc_amount">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Other</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_other_1_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_other_1_amount">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Other</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_other_2_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_other_2_amount">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Other</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Name of
																	Institution</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter name of institution"
																	   name="financial_other_3_institution">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Amount</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter amount"
																	   name="financial_other_3_amount">
															</div>
														</div>

														<div class="col-md-12">
															<h5><b style="color:skyblue;">LIABILITIES/LENDERS</b></h5>
														</div>


														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1"> Mortgage(s) on home</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Monthly Payments</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter monthly payment"
																	   name="financial_monthly_payment_mortgage_on_home">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Balance Owing</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter balance owing"
																	   name="financial_balance_owing_mortgage_on_home">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1"> Personal Loan(s)</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Monthly Payments</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter monthly payment"
																	   name="financial_monthly_payment_personal_loans">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Balance Owing</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter balance owing"
																	   name="financial_balance_owing_personal_loans">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1"> Other Loans</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Monthly Payments</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter monthly payment"
																	   name="financial_monthly_payment_other_loans">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Balance Owing</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter balance owing"
																	   name="financial_balance_owing_other_loans">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1"> Car Loan/Leases</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Monthly Payments</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter monthly payment"
																	   name="financial_monthly_payment_car_loan">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Balance Owing</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter balance owing"
																	   name="financial_balance_owing_car_loan">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1"> Credit Cards</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Monthly Payments</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter monthly payment"
																	   name="financial_monthly_payment_credit_cards">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Balance Owing</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter balance owing"
																	   name="financial_balance_owing_credit_cards">
															</div>
														</div>

														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1"> Child Support/Alimony</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Monthly Payments</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter monthly payment"
																	   name="financial_monthly_payment_child_supports">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="exampleInputEmail1">Balance Owing</label>
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter balance owing"
																	   name="financial_balance_owing_child_supports">
															</div>
														</div>



													</div>
												</div>
												<input type="button" name="previous"
													   class="previous action-button-previous" value="Previous Step"/>
												<input type="button" name="next" class="next action-button"
													   value="Next Step"/>
											</fieldset>
											<fieldset>
												<div class="form-card">
													<h2 class="fs-title">GENERAL INFORMATION</h2>
													<div class="row" style="margin-top: 30px">

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Are there any suits or judgements against you or pending against you?</label>
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">YES</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_judgements" value="yes" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">NO</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_judgements" value="no" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter your point"
																	   name="general_judgements">
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Have you ever gone through bankruptcy?</label>
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">YES</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_bankruptcy" value="yes" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">NO</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_bankruptcy" value="no" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter your point"
																	   name="general_bankruptcy">
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Are any of your assets pledged or in any other manner unavailable for payment of your debts?</label>
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">YES</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_assets_pledged" value="yes" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">NO</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_assets_pledged" value="no" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter your point"
																	   name="general_assets_pledged">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Are any of your assets presently involved in marriage or separation agreement?</label>
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">YES</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_marriage_agreement" value="yes" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">NO</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_marriage_agreement" value="no" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter your point"
																	   name="general_marriage_agreement">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Are you the endorser or guarantor of anyone else's debt?</label>
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">YES</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_guarantor" value="yes" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">NO</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_guarantor" value="no" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter your point"
																	   name="general_guarantor">
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail1">Are you the endorser or guarantor of any lease or contracts?</label>
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">YES</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_guarantor_for_lease" value="yes" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label for="exampleInputEmail1">NO</label>
																<input type="radio" class="form-control" id="exampleInputEmail1"
																	   name="general_is_guarantor_for_lease" value="no" style="margin-top: -37px">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<input type="text" class="form-control"
																	   id="exampleInputEmail1"
																	   placeholder="Enter your point"
																	   name="general_guarantor_for_lease">
															</div>
														</div>

													</div>
													</div>
												<input type="button" name="previous"
													   class="previous action-button-previous" value="Previous Step"/>
<!--												<input type="button" name="submit" class="submit action-button"-->
<!--													   value="Submit"/>-->

												<button type="submit" class="submit action-button"> Submit </button>

											</fieldset>
										</form>

										<div class="row">
											<div class="col-sm-12">
												<div class="alert "  role="alert" id="results"> </div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.MultiStep Form -->
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script type="text/javascript">
	$(document).ready(function () {
		var current_fs, next_fs, previous_fs; // fieldsets
		var opacity;
		var current = 1;
		var steps = $("fieldset").length;

		setProgressBar(current);

		$(".next").click(function () {
			current_fs = $(this).parent();
			next_fs = $(this).parent().next();

			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			next_fs.show();
			current_fs.animate({opacity: 0}, {
				step: function (now) {
					opacity = 1 - now;
					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					next_fs.css({'opacity': opacity});
				},
				duration: 500
			});
			setProgressBar(++current);
		});

		$(".previous").click(function () {
			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();

			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

			previous_fs.show();
			current_fs.animate({opacity: 0}, {
				step: function (now) {
					opacity = 1 - now;
					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					previous_fs.css({'opacity': opacity});
				},
				duration: 500
			});
			setProgressBar(--current);
		});

		$("#progressbar li").click(function () {
			var stepIndex = $(this).index();
			current_fs = $('fieldset:visible');
			next_fs = $('fieldset').eq(stepIndex);

			$("#progressbar li").removeClass("active");
			for (var i = 0; i <= stepIndex; i++) {
				$("#progressbar li").eq(i).addClass("active");
			}

			next_fs.show();
			current_fs.animate({opacity: 0}, {
				step: function (now) {
					opacity = 1 - now;
					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					next_fs.css({'opacity': opacity});
				},
				duration: 500
			});
			setProgressBar(stepIndex + 1);
			current = stepIndex + 1;
		});

		function setProgressBar(curStep) {
			var percent = parseFloat(100 / steps) * curStep;
			percent = percent.toFixed();
			$(".progress-bar").css("width", percent + "%")
		}

		// $(".submit").click(function () {
		// 	let form = $("#msform");
		// 	$.ajax({
		// 		url: $(form).attr('action'),
		// 		type: $(form).attr('method'),
		// 		data: $(form).serialize(), // Serialize the form data
		// 		success: function(response){
		// 			$('#response').html(response); // Display the response
		// 		},
		// 		error: function(xhr, status, error){
		// 			console.error(error); // Log any error
		// 		}
		// 	});
		// });
	});


	//    $(document).ready(function () {
	//        var base_url = "<?php echo base_url(); ?>";
	//
	//        $('#country-form').validate({
	//            rules: {
	//                country_name: {
	//                    required: true
	//                }
	//            }, messages: {
	//                country_name: {
	//                    required: "Please enter country name",
	//                }
	//            },
	//
	//            submitHandler: function (form) {
	//                $.ajax({
	//                    type: $(form).attr('method'),
	//                    url: $(form).attr('action'),
	//                    data: $(form).serialize(),
	//                    success: function (data)
	//                    {
	//                        //$("#user-form").hide('slow');
	//                        if (data == "success") {
	//                            $('#results').removeClass('alert alert-danger');
	//                            $('#results').addClass('alert alert-success');
	//                            $('#results').html('country successfully saved');
	//                            var URL = "<?php echo base_url(); ?>country/";
	//                            setTimeout(function () {
	//                                window.location = URL;
	//                            }, 1000);
	//                        } else {
	//                            $('#results').addClass('alert alert-danger');
	//                            $('#results').html(data);
	//                        }
	//
	//                    }
	//                });
	//
	//                return false; // required to block normal submit since you used ajax
	//            }
	//
	//        });
	//    }); // end document.ready
</script>

<script type="text/javascript">
	$(document).ready(function () {
		var base_url = "<?php echo base_url(); ?>";

		$('#msform').validate({
			rules: {
				applicant_initial: {
					required: true
				}
			}, messages: {
				applicant_initial: {
					required: "Please enter a initial",
				}
			},
			highlight: function (element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},

			submitHandler: function (form) {
				$.ajax({
					type: $(form).attr('method'),
					url: $(form).attr('action'),
					data: $(form).serialize(),
					success: function (data)
					{
						//$("#company-form").hide('slow');
						if ($.trim(data) == "success") {
							$('#results').addClass('alert alert-success');
							$('#results').html('Application successfully saved');
							var URL = "<?php echo base_url(); ?>mapplication/";
							setTimeout(function () {
								window.location = URL;
							}, 1000);
						} else {
							$('#results').addClass('alert alert-danger');
							$('#results').html('error');
						}

					}
				});

				return false; // required to block normal submit since you used ajax
			}

		});
	}); // end document.ready
</script>
