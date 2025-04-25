<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['ecomm_login'])) {
            redirect('login');
        }
        $this->load->model('general_settings/Payment_model', 'PModel');
        $this->load->model('general_settings/Client_crm_model', 'CModel');
    }


    public function refund()
    {
        $data['title'] = 'Refund';
        $data['subtitle'] = 'Refund';
        $data['template'] = 'modules/general_settings/refund';
        $this->load->view('template/dashboard_template', $data);
    }
    public function fileUpload($uploadPath, $uploadfile = '')
    {
        $uploadData = array(); // Store uploaded file names

        if (!isset($_FILES[$uploadfile])) {
            log_message('error', "File input {$uploadfile} not found in \$_FILES array.");
            return null;
        }

        $filesCount = count($_FILES[$uploadfile]['name']);

        if ($filesCount > 0) {
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|pdf';
            $this->load->library('upload', $config);

            for ($i = 0; $i < $filesCount; $i++) {
                if (!empty($_FILES[$uploadfile]['name'][$i])) {
                    $_FILES['file']['name'] = $_FILES[$uploadfile]['name'][$i];
                    $_FILES['file']['type'] = $_FILES[$uploadfile]['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES[$uploadfile]['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES[$uploadfile]['error'][$i];
                    $_FILES['file']['size'] = $_FILES[$uploadfile]['size'][$i];

                    if ($this->upload->do_upload('file')) {
                        $fileData = $this->upload->data();
                        $uploadData[] = $fileData['file_name'];
                    } else {
                        log_message('error', "File upload failed: " . $this->upload->display_errors());
                    }
                }
            }
        }

        return !empty($uploadData) ? implode(',', $uploadData) : null;
    }
}
