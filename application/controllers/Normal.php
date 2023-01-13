<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Normal extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('crud_model');
        $this->load->model('email_model');
        $this->load->model('sms_model');
        $this->load->model('frontend_model');
    }
    
    function index()
    {
        if ($this->session->userdata('normal_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }

        $data['approval_info'] = $this->crud_model->select_awaiting_info();

        $suitable_info = $this->crud_model->select_suitable_awaiting_info();
        if($suitable_info){
          $data['approval_info'] = array_merge($data['approval_info'], $suitable_info);
        }
        
        $data['page_name']  = 'dashboard';
        $data['page_title'] = get_phrase('normal_dashboard');
        $this->load->view('backend/index', $data);
    }

    function updatecase() {
        if ($this->session->userdata('normal_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }

        $this->crud_model->save_case_info();
        $this->session->set_flashdata('message', get_phrase('patient_info_updated_successfuly'));
        redirect(site_url('normal'), 'refresh');
    }
    
    function patient($task = "", $patient_id = "")
    {
    
        if ($this->session->userdata('normal_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }

        if ($task == "create") {
            //$this->crud_model->save_patient_info();
            $this->crud_model->save_case_info();
            $this->session->set_flashdata('message', get_phrase('patient_info_saved_successfuly'));
            redirect(site_url('normal'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_patient_info($patient_id);
            redirect(site_url('normal'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_patient_info($patient_id);
            redirect(site_url('normal'), 'refresh');
        }
        
        $data['patient_info'] = $this->crud_model->select_patient_info();
        $data['page_name']    = 'dashboard';
        $data['page_title']   = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }

    function deleteAppointment(){
        if ($this->session->userdata('normal_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $source = isset($_POST['source']) ? $_POST['source'] : "";
        
        if(!$id || !$source){
          echo get_phrase('Error');
        }
        else{
          $this->db->update($source, ["is_deleted" => 1], ["id" => $id]);
          $this->session->set_flashdata('message', get_phrase('deleted_successfuly'));
          echo get_phrase('Success');
        }                  
    }

    function saveAppointment() {
        if ($this->session->userdata('normal_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }

        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $source = isset($_POST['source']) ? $_POST['source'] : "";
        $decision = isset($_POST['decision']) ? $_POST['decision'] : "";
        
        if(!$id || !$source) {
            echo get_phrase('Error');
        }
        else {
            if(!empty($_FILES['newfile']) && !empty($_FILES['newfile']['name'])) {
                $query = $this->db->query("SELECT final_decision FROM $source WHERE id = $id");
                $p_fileName = $query->result()[0]->final_decision;
                unlink("uploads/final_decision/$p_fileName");

                $fileName = "";
                $fileType = strtolower(pathinfo($_FILES['newfile']['name'], PATHINFO_EXTENSION));
                if($fileType != "pdf") {
                  $this->session->set_flashdata('error_message', get_phrase('Sorry, only PDF files are allowed.'));
                  redirect(site_url().'admin/readycases');
                  return false;
                }
                $fileName = date("Ymdhis")."_$id.".$fileType;
                move_uploaded_file($_FILES["newfile"]["tmp_name"], "uploads/final_decision/$fileName");

                $this->db->update($source, ["decision" => $decision, "final_decision" => $fileName], ["id" => $id]);
            } else {
                $this->db->update($source, ["decision" => $decision], ["id" => $id]);
            }
            $this->session->set_flashdata('message', get_phrase('saved_successfuly'));
            echo get_phrase('Success');
        }
    }
   
}