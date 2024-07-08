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

			<div class="card-body">
				<div class="text-center">


					<!--This is create new folder modal-->
					<div class="modal fade" id="modal-default">
						<div class="modal-dialog">
							<div class="modal-content">
								<form action="" id="createFolderForm" method="post">
									<div class="modal-header">
										<h4><b>Create folder</b></h4>
									</div>
									<div class="modal-body">
										<h5 class="text-left" style="margin: 10px 0px"><b>Name</b></h5>
										<div class="form-group" style="margin: 10px 0px">
											<input type="text" name="folderName" id="folderName" class="form-control"
												   placeholder="Folder name">
										</div>
									</div>
									<div class="text-right" style="padding: 20px">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel
										</button>
										<button type="submit" class="btn btn-primary">Create</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--End create new folder modal-->

					<!--This is upload file modal-->
					<div class="modal fade" id="modal-file-upload">
						<div class="modal-dialog">
							<div class="modal-content">
								<form action="" id="createFolderForm" method="post">
									<div class="modal-header">
										<h4><b>Upload file</b></h4>
									</div>
									<div class="modal-body">
										<div class="form-group" style="margin: 10px 0px">
											<input type="file" class="filepond" name="filepond" multiple
												   data-max-file-size="3MB" data-max-files="5">
										</div>
									</div>
									<div class="text-right" style="padding: 20px">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--End create new folder modal-->

					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<form action="simple-results.html">
									<div class="input-group input-group-md">
										<input type="search" class="form-control form-control"
											   placeholder="Type your keywords here">
										<div class="input-group-append">
											<button type="submit" class="btn btn-md btn-default">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</form>
							</div>

							<div class="col-md-6 d-flex justify-content-end">
								<!-- Button 1 -->
								<div class="btn-group">
									<a class="nav-link text-right" data-toggle="dropdown" href="#"
									   id="dropdownMenuButton1"
									   style="padding: 10px;border: 1px solid black;border-radius: 10px">
										<i class="fas fa-plus"></i>
										New
									</a>
									<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
										 aria-labelledby="dropdownMenuButton1">
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item" data-toggle="modal"
										   data-target="#modal-default">
											<i class="fas fa-folder mr-2"></i> New folder
										</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item" data-toggle="modal"
										   data-target="#modal-file-upload">
											<i class="fas fa-file-upload mr-2"></i> File Upload
										</a>
										<div class="dropdown-divider"></div>
									</div>
								</div>

								<!-- Button 2 -->
								<!--				<div class="btn-group ml-3">-->
								<!--					<a class="nav-link text-right" data-toggle="dropdown" href="#" id="dropdownMenuButton2">-->
								<!--						<i class="fas fa-cog"></i>-->
								<!--						Settings-->
								<!--					</a>-->
								<!--					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="dropdownMenuButton2">-->
								<!--						<div class="dropdown-divider"></div>-->
								<!--						<a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-settings">-->
								<!--							<i class="fas fa-user-cog mr-2"></i> Account Settings-->
								<!--						</a>-->
								<!--						<div class="dropdown-divider"></div>-->
								<!--						<a href="#" class="dropdown-item">-->
								<!--							<i class="fas fa-lock mr-2"></i> Privacy Settings-->
								<!--						</a>-->
								<!--						<div class="dropdown-divider"></div>-->
								<!--						<a href="#" class="dropdown-item">-->
								<!--							<i class="fas fa-wrench mr-2"></i> System Settings-->
								<!--						</a>-->
								<!--						<div class="dropdown-divider"></div>-->
								<!--					</div>-->
								<!--				</div>-->
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-12 mt-3">
						<div class="row">
							<div class="col-5 col-sm-3" style="height: 100%">
								<div class="nav flex-column nav-tabs h-100 text-left" id="vert-tabs-tab" role="tablist"
									 aria-orientation="vertical" style="height: 100%">
									<a class="nav-link active" onclick="loadFiles()" id="vert-tabs-home-tab"
									   data-toggle="pill"
									   href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home"
									   aria-selected="true">All files</a>
									<a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill"
									   href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile"
									   aria-selected="false">Photos</a>
									<a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill"
									   href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages"
									   aria-selected="false">Deleted files</a>
								</div>
							</div>
							<div class="col-7 col-sm-9">
								<div class="tab-content" id="vert-tabs-tabContent">
									<div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
										 aria-labelledby="vert-tabs-home-tab">

										<p>All files</p>

										<h5><b id="fileName">All files</b></h5>

										<div id="file-table">

										</div>

									</div>
									<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
										 aria-labelledby="vert-tabs-profile-tab">
										<h1>Need to show photos</h1>
									</div>
									<div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
										 aria-labelledby="vert-tabs-messages-tab">
										<h1>Need to show deleted files</h1>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script type="text/javascript">

	let dirName = '';

	/**
	 * This function used to upload file
	 */
	FilePond.registerPlugin();
	FilePond.parse(document.body);
	const pond = FilePond.create(document.querySelector('.filepond'));
	pond.setOptions({
		server: {
			url: '<?php echo base_url('myDrive/'); ?>',
			process: {
				url: 'uploadFile',
				headers: {
					'x-customheader': 'CustomHeaderValue'
				},
				ondata: (formData) => {
					formData.append('dirName', dirName); // Add dirName here
					return formData;
				}
			}
		}
	});

	// Event listener for when a file has been successfully processed (uploaded)
	pond.on('processfile', (error, file) => {
		if (!error) {
			loadFiles(dirName);
		} else {
			console.error('File upload error:', error);
		}
	});

	/**
	 * End file upload function
	 */

	$(document).ready(function () {
		// Fetch folders and files on load
		loadFiles();

		// Create Folder
		$('#createFolderForm').on('submit', function (e) {
			e.preventDefault();
			let folderName = $('#folderName').val();
			$.ajax({
				url: '<?php echo base_url('myDrive/create_folder'); ?>',
				type: 'POST',
				data: {
					folderName: folderName,
					fileNames: dirName
				},
				success: function (response) {
					$('#folderName').val('');
					loadFiles();
					$('#modal-default').modal('hide');
					toastr.success('New folder created successfully!', 'Success!')
				},
				error: function () {
					alert('Folder creation failed, please try again.');
				}
			});
		});


		//// Upload File
		//$('#uploadForm').on('submit', function (e) {
		//	e.preventDefault();
		//	$.ajax({
		//		url: '<?php //echo base_url('upload/upload_file'); ?>//',
		//		type: 'POST',
		//		data: new FormData(this),
		//		processData: false,
		//		contentType: false,
		//		success: function (response) {
		//			$('#uploadStatus').html('<p class="alert alert-success">' + response + '</p>');
		//			fetchFiles();
		//		},
		//		error: function () {
		//			$('#uploadStatus').html('<p class="alert alert-danger">File upload failed, please try again.</p>');
		//		}
		//	});
		//});

		// Fetch Folders
		function fetchFolders() {
			$.ajax({
				url: '<?php echo base_url('myDrive/fetch_folders'); ?>',
				type: 'GET',
				success: function (response) {
					$('#foldersContainer').html(response);
				},
				error: function () {
					alert('Failed to fetch folders, please try again.');
				}
			});
		}

		// Fetch Files
		//function fetchFiles() {
		//	$.ajax({
		//		url: '<?php //echo base_url('upload/fetch_files'); ?>//',
		//		type: 'GET',
		//		success: function (response) {
		//			$('#filesContainer').html(response);
		//		},
		//		error: function () {
		//			alert('Failed to fetch files, please try again.');
		//		}
		//	});
		//}


		$(function () {
			$("#example1").DataTable({
				"responsive": true, "lengthChange": false, "autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
	});




	function loadFiles(dir = '') {

		if (dir !== '') {
			dirName = dir;
		}

		console.log(dirName);

		// PHP base URL provided as a variable
		const baseUrl = '<?php echo $base_url; ?>';
		let fullUrl = `${baseUrl}fetch?dir=${dir}`;
		fetch(fullUrl)
			.then(response => response.json())
			.then(data => {
				const fileTable = document.getElementById('file-table');
				let tableHTML = '<table id="example2" class="table table-hover"><thead><tr><th>Name</th> <th>Who can access</th> <th>Modified</th></tr></thead><tbody>';
				data.forEach(file => {
					if (file.type === 'folder') {
						tableHTML += `<tr><td><a href="#" onclick="loadFiles('${dir}/${file.name}')"><i class="fas fa-folder mr-2"></i>${file.name}</a></td> <td>-</td> <td>--</td></tr>`;
					} else {
						let fileDisplay = '';
						const fileExtension = file.name.split('.').pop().toLowerCase();
						if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
							// Display image thumbnail
							const baseUrl = '<?php echo $base_url; ?>';
							fileDisplay = `<img src="${file.path}" style="width: 30px; height: auto;" class="mr-2"> <a href="${file.path}" target="_blank">${file.name}</a>`;
						} else {
							// Display file icon
							fileDisplay = `<i class="fas fa-file mr-2"></i> ${file.name}`;
						}
						tableHTML += `<tr><td>${fileDisplay}</td> <td>-</td> <td>--</td></tr>`;
					}
				});
				tableHTML += '</tbody></table>';
				fileTable.innerHTML = tableHTML;
			})
			.catch(error => console.error('Error:', error));
	}
</script>
