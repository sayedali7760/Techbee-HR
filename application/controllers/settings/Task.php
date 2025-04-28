<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['ecomm_login'])) {
            redirect('login');
        }
        $this->load->model('general_settings/Task_model', 'TModel');
    }

    public function schedule_task()
    {
        $data['title'] = 'Task';
        $data['subtitle'] = 'Schedule Task';
        $id = $this->session->userdata['id'];
        $data['staffs'] = $this->TModel->get_staff_details($id);
        $data['template'] = 'modules/general_settings/task/schedule_task';
        $this->load->view('template/dashboard_template', $data);
    }
    public function schedule_task_save()
    {
        $data['priority'] = $this->input->post('priority');
        $data['staff_id'] = $this->input->post('staff');
        $date_input = $this->input->post('kt_daterangepicker_3');
        if (!empty($date_input)) {
            $data['due_date'] = date('Y-m-d', strtotime($date_input));
        } else {
            $data['due_date'] = NULL;
        }

        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['created_by'] = $this->session->userdata['id'];

        $uploadPath = 'uploads';
        $receipt = 'receipt';
        $receipt = $this->fileUpload($uploadPath, $receipt);
        if ($receipt != null) {
            $data['file'] = $receipt;
        }
        if ($this->TModel->schedule_task_save($data)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function assigned_tasks()
    {
        $data['title'] = 'Task';
        $data['subtitle'] = 'Assigned Tasks';
        $id = $this->session->userdata['id'];
        $data['task_details'] = $this->TModel->get_tasks_details_unique($id);
        $data['template'] = 'modules/general_settings/task/assigned_tasks_unique';
        $this->load->view('template/dashboard_template', $data);
    }

    public function change_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data['status'] = $status;
        if ($this->TModel->change_status($data, $id)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function view_task()
    {
        $onload =  $this->input->post('load');
        $task_id = $this->input->post('task_id');

        if ($onload == 1) {
            $data['task_details_single'] = $this->TModel->task_details_single($task_id);
            $view = $this->load->view('modules/general_settings/task/view_tasks', $data, TRUE);
            echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
            return;
        }
    }
    public function scheduled_tasks()
    {
        $data['title'] = 'Task';
        $data['subtitle'] = 'Scheduled Tasks';
        $id = $this->session->userdata['id'];
        $data['task_details'] = $this->TModel->get_tasks_details($id);
        $data['template'] = 'modules/general_settings/task/scheduled_tasks';
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
