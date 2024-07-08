<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of country
 *
 * @author Thusitha
 */
class MyDrive extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('url');
		$this->load->model('car_model');
		$this->load->helper('directory');
	}

	public function index()
	{
		//load view
		$data['user'] = $this->session->userdata('first_name');
		$data['title'] = "My Drive";
		$this->load->view('layout/header', $data);
		$this->load->view('layout/menu_bar');
		$this->load->view('my_drive/index', $data);
		$this->load->view('layout/footer', $data);
	}

	/**
	 * This function used to create new folder
	 * @return void
	 */
	public function create_folder()
	{
		$user_id = $this->session->userdata('user_id');
		$folderName = $this->input->post('folderName');
		$dir = $this->input->post('fileNames');
		$filePath = $dir;
		if (!empty($folderName)) {
			if (!empty($filePath)) {
				$folderPath = './upload/drives/' . $user_id . '/' . $filePath . '/' . $folderName;
			} else {
				$folderPath = './upload/drives/' . $user_id . '/' . $folderName;
			}
			if (!file_exists($folderPath)) {
				mkdir($folderPath, 0777, true);
				echo 'Folder created successfully.';
			} else {
				echo 'Folder already exists.';
			}
		} else {
			echo 'Folder name cannot be empty.';
		}
	}


	public function upload_file()
	{
		$folder = $this->input->post('folder');
		$config['upload_path'] = './uploads/' . $folder;
		$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|txt|xlsx';
		$config['max_size'] = 2048; // 2MB

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file')) {
			echo $this->upload->display_errors();
		} else {
			$data = $this->upload->data();
			echo 'File uploaded successfully: ' . $data['file_name'];
		}
	}

	public function fetch_folders()
	{
		$user_id = $this->session->userdata('user_id');
		$files = scandir('./upload/drives');
		$output = '';
		foreach ($files as $file) {
			if (!is_dir('./uploads/drives/' . $file)) {
				$fileSize = filesize('./upload/drives/' . $file);
				$output .= '<div class="col-md-3">
                            <div class="card card-secondary">
                                <div class="card-body">
                                    <h5 class="card-title">' . $file . '</h5>
                                    <p class="card-text">Size: ' . $this->format_size_units($fileSize) . '</p>
                                </div>
                            </div>
                        </div>';
			}
		}
		echo $output;
	}

	public function fetch_files()
	{
		$files = directory_map('./uploads', 1);
		$output = '';
		foreach ($files as $file) {
			if (!is_dir('./uploads/' . $file)) {
				$fileSize = filesize('./uploads/' . $file);
				$output .= '<div class="col-md-3">
                                <div class="card card-secondary">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $file . '</h5>
                                        <p class="card-text">Size: ' . $this->format_size_units($fileSize) . '</p>
                                    </div>
                                </div>
                            </div>';
			}
		}
		echo $output;
	}

	private function get_folder_size($dir)
	{
		$size = 0;
		foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
			$size += is_file($each) ? filesize($each) : $this->get_folder_size($each);
		}
		return $size;
	}

	private function format_size_units($bytes)
	{
		if ($bytes >= 1073741824) {
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		} elseif ($bytes >= 1048576) {
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		} elseif ($bytes >= 1024) {
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		} elseif ($bytes > 1) {
			$bytes = $bytes . ' bytes';
		} elseif ($bytes == 1) {
			$bytes = $bytes . ' byte';
		} else {
			$bytes = '0 bytes';
		}
		return $bytes;
	}


	/**
	 * This function used to get all files the user folder
	 * @return void
	 */
	public function fetch()
	{
		$user_id = $this->session->userdata('user_id');
		if (!empty($_GET['dir'])) {
			$directory = './upload/drives/' . $user_id . '/' . $_GET['dir'];

		} else {
			$directory = './upload/drives/' . $user_id;
		}

		$files = scandir($directory);
		$fileList = [];
		foreach ($files as $file) {
			if ($file !== '.' && $file !== '..') {
				$path = $directory . '/' . $file;
				$fileList[] = [
					'name' => $file,
					'type' => is_dir($path) ? 'folder' : 'file',
					'path' => base_url() . '/' . $directory . '/' . $file
				];
			}
		}
		echo json_encode($fileList);
	}

	/**
	 * This function used to upload files
	 * @return void
	 */
	public function uploadFile()
	{
		$user_id = $this->session->userdata('user_id');
		// File upload path
		$dirName = isset($_POST['dirName']) ? $_POST['dirName'] : '';
		var_dump($dirName);

		if (!empty($dirName)) {
			$targetDir = './upload/drives/' . $user_id . '/' . $dirName . '/';
		} else {
			$targetDir = './upload/drives/' . $user_id . '/';
		}


		$targetFile = $targetDir . basename($_FILES["filepond"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

		// Check file size (optional)
// if ($_FILES["file"]["size"] > 500000) {
//     echo json_encode(["error" => "Sorry, your file is too large."]);
//     $uploadOk = 0;
// }

// Allow certain file formats (optional)
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//     echo json_encode(["error" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."]);
//     $uploadOk = 0;
// }


		if (file_exists($targetFile)) {
			echo json_encode(array("error" => "Sorry, file already exists."));
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo json_encode(array("error" => "Sorry, your file was not uploaded."));
		} else {
			if (move_uploaded_file($_FILES["filepond"]["tmp_name"], $targetFile)) {
				echo json_encode(array("success" => "The file has been uploaded."));
			} else {
				echo json_encode(array("error" => "Sorry, there was an error uploading your file."));
			}
		}
	}

}

/* End of file country.php */
/* Location: ./application/controllers/country.php */
?>
