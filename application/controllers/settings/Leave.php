<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['ecomm_login'])) {
            redirect('login');
        }
        $this->load->model('general_settings/Leave_model', 'LModel');
    }

    public function apply_leave()
    {
        $data['title'] = 'Leave';
        $data['subtitle'] = 'Apply Leave';
        $data['template'] = 'modules/general_settings/leave/add_leave';
        $this->load->view('template/dashboard_template', $data);
    }

    public function apply_leave_save()
    {
        $data['type'] = $this->input->post('leave_type');
        $data['staff_id'] =  $this->session->userdata['id'];
        $date_input = $this->input->post('kt_daterangepicker_3');
        if (!empty($date_input)) {
            $data['date'] = date('Y-m-d', strtotime($date_input));
        } else {
            $data['date'] = NULL;
        }
        $data['description'] = $this->input->post('description');
        $data['created_by'] = $this->session->userdata['id'];

        $uploadPath = 'uploads';
        $file = 'file';
        $filename = $this->fileUpload($uploadPath, $file);
        if ($filename != null) {
            $data['file'] = $filename;
        }
        if ($this->LModel->apply_leave_save($data)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }

    public function applied_leave()
    {
        $data['title'] = 'Leave';
        $data['subtitle'] = 'Leave Applied';
        $id = $this->session->userdata['id'];
        $data['leave_list'] = $this->LModel->get_applied_leave($id);
        $data['template'] = 'modules/general_settings/leave/applied_leave';
        $this->load->view('template/dashboard_template', $data);
    }
    public function approve_leave()
    {
        $id = $this->input->post('id');
        $data['status'] = 1;
        if ($this->LModel->approve_leave($data, $id)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function reject_leave()
    {
        $id = $this->input->post('id');
        $data['status'] = 2;
        $this->db->where('id', $id);
        if ($this->LModel->approve_leave($data, $id)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function applied_leave_admin()
    {
        $data['title'] = 'Leave';
        $data['subtitle'] = 'Leave Applied';
        $id = $this->session->userdata['id'];
        $data['leave_list'] = $this->LModel->get_applied_leave_admin($id);
        $data['template'] = 'modules/general_settings/leave/applied_leave_admin';
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
