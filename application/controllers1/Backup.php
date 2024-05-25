<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Backup
 *
 * @author thusitha
 */
class Backup extends CI_Controller {
    
    public function index(){
        // Load the DB utility class
$this->load->dbutil();
 $this->load->helper('date');
// Backup your entire database and assign it to a variable
//$backup = $this->dbutil->backup();
$prefs = array(
        'tables'        => array('orders'),   // Array of tables to backup.
        'ignore'        => array(),                     // List of tables to omit from the backup
        'format'        => 'zip',                       // gzip, zip, txt
        'filename'      => 'db_backup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
        'newline'       => "\n"                         // Newline character used in backup file
);

$backup=$this->dbutil->backup();
// Load the file helper and write the file to your server
$this->load->helper('file');
write_file('./assets/backup/'.now().'_backup.gz', $backup);
$infile=now().'_backup.gz';

// Load the download helper and send the file to your desktop
$this->load->helper('download');
force_download(now().config_item('company_name').'.backup', $backup);


    }
}
