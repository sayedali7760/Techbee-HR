<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of caste_model
 *
 * @author Seyad ali N
 */
class Client_crm_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_details($id)
    {
        $this->db->from('clients');
        $this->db->where('id', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function update_password($id, $data)
    {
        $this->db->update('clients', $data, 'id=' . $id . '');
        return true;
    }

    public function add_client($data)
    {
        if ($this->db->insert('clients', $data)) {
            return true;
        }
    }
    public function thumbnail_update($data, $id)
    {
        $this->db->update('clients', $data, 'id=' . $id . '');
        return true;
    }
    public function doc_upload($data)
    {
        if ($this->db->insert('documents', $data)) {
            return true;
        }
    }

    public function upload_document_update($data, $id)
    {
        $this->db->update('documents', $data, 'client_id=' . $id . '');
        return true;
    }
    public function update_document_status($client_id, $data)
    {
        $this->db->update('documents', $data, 'client_id=' . $client_id . '');
        return true;
    }
    public function activate_client($client_id, $data)
    {
        $this->db->update('documents', $data, 'client_id=' . $client_id . '');
        return true;
    }

    public function get_documents_details($id)
    {
        $this->db->from('documents');
        $this->db->where('client_id', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    public function get_notverified_clients()
    {
        $this->db->from('clients');
        $this->db->order_by('id', "desc");
        $query = $this->db->get()->result();
        return $query;
    }

    public function add_bank_data($data)
    {
        if ($this->db->insert('bank_data', $data)) {
            return true;
        }
    }

    public function add_wallet($data)
    {
        if ($this->db->insert('wallet_address', $data)) {
            return true;
        }
    }

    public function get_wallet_details($id)
    {
        $this->db->from('wallet_address');
        $this->db->where('client_id', $id);
        $this->db->order_by('id', "desc");
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function get_bank_data($id)
    {
        $this->db->from('bank_data');
        $this->db->where('client_id', $id);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function reject_data($client_id, $id)
    {
        $this->db->update('bank_data', ['status' => '2'], ['client_id' => $client_id, 'id' => $id]);
        return true;
    }

    public function approve_data($client_id, $id)
    {
        $this->db->update('bank_data', ['status' => '1'], ['client_id' => $client_id, 'id' => $id]);
        return true;
    }
}
