<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {
    public function __construct() {
        parent::__construct();
        ini_set('memory_limit', '2048M'); // Increase memory limit
        $this->load->dbutil();
        $this->load->helper(array('file', 'download'));
    }

    public function index() {
        // Create a backup of the entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Define the file name and path
        $file_name = 'database_backup_' . date('Y-m-d_H-i-s') . '.gz';
        $save_path = FCPATH . 'D:\CodeLibrary\Backups' . $file_name; // Ensure the 'backups' folder is writable

        // Write the file to the server
        if (!write_file($save_path, $backup)) {
            echo 'Unable to write the file';
        } else {
            // Download the file to your local machine
            force_download($file_name, $backup);
        }
    }
}
