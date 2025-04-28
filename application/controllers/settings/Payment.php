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
        $data['title'] = 'Payroll';
        $data['subtitle'] = 'Refund';
        $data['template'] = 'modules/general_settings/payment/refund';
        $this->load->view('template/dashboard_template', $data);
    }
    public function admin_refund()
    {
        $data['title'] = 'Payroll';
        $data['subtitle'] = 'Refund Request';
        $data['refund_data'] = $this->PModel->get_refund_data();
        $data['template'] = 'modules/general_settings/payment/admin_refund_list';
        $this->load->view('template/dashboard_template', $data);
    }
    public function applied_refund()
    {
        $data['title'] = 'Payroll';
        $data['subtitle'] = 'Applied Refund';
        $data['refund_data'] = $this->PModel->get_refund_data();
        $data['template'] = 'modules/general_settings/payment/applied_refund';
        $this->load->view('template/dashboard_template', $data);
    }
    public function approve_refund()
    {
        $id = $this->input->post('id');
        $data['approved'] = 1;
        if ($this->PModel->approve_refund($data, $id)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function reject_refund()
    {
        $id = $this->input->post('id');
        $data['approved'] = 2;
        if ($this->PModel->approve_refund($data, $id)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function view_refund()
    {
        $onload =  $this->input->post('load');
        $refund_id = $this->input->post('refund_id');
        if ($onload == 1) {
            $data['refund_details_single'] = $this->PModel->refund_details_single($refund_id);
            $view = $this->load->view('modules/general_settings/payment/view_refund', $data, TRUE);
            echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
            return;
        }
    }
    public function refund_save()
    {
        $date_input = $this->input->post('kt_daterangepicker_3');
        if (!empty($date_input)) {
            $data['date'] = date('Y-m-d', strtotime($date_input));
        } else {
            $data['date'] = NULL;
        }
        $data['amount'] = $this->input->post('amount');
        $data['description'] = $this->input->post('description');
        $data['staff_id'] = $this->session->userdata('id');
        $data['created_by'] = $this->session->userdata('id');
        $uploadPath = 'uploads';

        $receipt = 'receipt';
        $receipt = $this->fileUpload($uploadPath, $receipt);
        if ($receipt != null) {
            $data['file'] = $receipt;
        }
        if ($this->PModel->refund_save($data)) {
            // $subject = "New Bank Data Verification Request - .'$id'.";
            // $mailto = 'seyad@smartfx.com';
            // $data['id'] = $id;
            // $mailcontent =  $this->load->view('mail_templates/notify_bank_verify_template', $data, true);
            // $cc = "";
            // send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
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
