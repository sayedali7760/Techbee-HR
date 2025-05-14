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
        $data['refund_data'] = $this->PModel->get_refund_data_client();
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

        $start_date = date('Y-m-01', strtotime($data['date']));
        $end_date = date('Y-m-t', strtotime($data['date']));
        $exist_payment = $this->db->select('P.*')
            ->from('payroll_payment as P')
            ->where('P.staff_id', $data['staff_id'])
            ->where('P.date >=', $start_date)
            ->where('P.date <=', $end_date)
            ->get();

        if ($exist_payment->num_rows() > 0) {
            echo json_encode(array('status' => 3, 'message' => 'Salary already released for this month'));
            return false;
        }

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
    public function payroll_payment_save()
    {
        $data['staff_id'] = $this->input->post('staff');
        $data['amount'] = $this->input->post('amount');
        $data['bonus'] = $this->input->post('bonus');
        $data['bank_id'] = $this->input->post('bank');
        $data['date'] = date('Y-m-d', strtotime($this->input->post('kt_month_picker')));
        $start_date = date('Y-m-01', strtotime($data['date']));
        $end_date = date('Y-m-t', strtotime($data['date']));
        $data['description'] = $this->input->post('description');
        $data['created_by'] = $this->session->userdata('id');
        $uploadPath = 'uploads';

        $staff_refund_details = $this->CModel->staff_refund_details($data['staff_id'], $start_date, $end_date);
        $staff_last_month_balance = $this->PModel->get_out_standing_balance($data['staff_id']);
        if (!empty($staff_last_month_balance)) {
            $staff_last_month_balance = $staff_last_month_balance->balance;
        } else {
            $staff_last_month_balance = 0;
        }

        $staff_details = $this->CModel->get_client_details($data['staff_id']);

        if (!empty($staff_refund_details)) {
            $total_refund = 0;
            foreach ($staff_refund_details as $list) {
                if ($list->approved == 1) {
                    $total_refund += $list->amount;
                }
            }
            $total_refund_amount = $total_refund;
        } else {
            $total_refund_amount = 0;
        }
        $data['total_refund'] = $total_refund_amount;
        $total_amount_this_month = $staff_last_month_balance + $total_refund_amount + $staff_details['salary'];

        $data['balance'] = $total_amount_this_month - $data['amount'];

        $exist_payment = $this->db->select('P.*')
            ->from('payroll_payment as P')
            ->where('P.staff_id', $data['staff_id'])
            ->where('P.date >=', $start_date)
            ->where('P.date <=', $end_date)
            ->get();

        if ($exist_payment->num_rows() > 0) {
            echo json_encode(array('status' => 3, 'message' => 'Payment already exist for this month'));
            return false;
        } else {

            $receipt = 'receipt';
            $receipt = $this->fileUpload($uploadPath, $receipt);
            if ($receipt != null) {
                $data['file'] = $receipt;
            }
            if ($this->PModel->payroll_payment_save($data)) {
                echo json_encode(array('status' => 1));
                return;
            } else {
                return false;
            }
        }
    }
    public function payroll_added()
    {
        $data['title'] = 'Payroll';
        $data['subtitle'] = 'Payroll Details';
        $staff_id = $this->session->userdata('id');
        $data['payroll_data'] = $this->PModel->get_payroll_details_added($staff_id);
        $data['template'] = 'modules/general_settings/payment/payroll_added';
        $this->load->view('template/dashboard_template', $data);
    }
    public function client_salary_history()
    {
        $data['title'] = 'Payroll';
        $data['subtitle'] = 'Salary History';
        $staff_id = $this->session->userdata('id');
        $data['payroll_data'] = $this->PModel->get_payroll_details_added_client($staff_id);
        $data['template'] = 'modules/general_settings/payment/client_salary_history';
        $this->load->view('template/dashboard_template', $data);
    }
    public function payroll()
    {
        $data['title'] = 'Payroll';
        $data['subtitle'] = 'Payroll Payment';
        $staff_id = $this->session->userdata('id');
        $data['staff_details'] = $this->CModel->get_staff_details($staff_id);
        $data['template'] = 'modules/general_settings/payment/payroll';
        $this->load->view('template/dashboard_template', $data);
    }
    public function get_staff_refund_details()
    {
        $staff_id = $this->input->post('staff_id');
        $month = $this->input->post('month');
        $start_date = date('Y-m-01', strtotime($month));
        $end_date = date('Y-m-t', strtotime($month));
        $data['staff_refund_details'] = $this->CModel->staff_refund_details($staff_id, $start_date, $end_date);
        $data['out_standing_balance'] = $this->PModel->get_out_standing_balance($staff_id);
        $bank_details = $this->CModel->get_bank_details($staff_id);
        if (!empty($data['out_standing_balance'])) {
            $data['out_standing_balance'] = $data['out_standing_balance']->balance;
        } else {
            $data['out_standing_balance'] = 0;
        }
        $data['staff_details'] = $this->CModel->get_client_details($staff_id);
        $view = $this->load->view('modules/general_settings/payment/staff_refund_details', $data, TRUE);
        echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view, 'bank_details' => $bank_details));
        return;
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
