<?php
//error_reporting(E_ALL);
//ini_set("display_errors", "On");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *     @author : Creativeitem
 *     date    : 1 August, 2014
 *     http://codecanyon.net/user/Creativeitem
 *     http://creativeitem.com
 */

//require 'vendor/mpdf/mpdf/mpdf.php';


class Admin extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('crud_model');
        $this->load->model('email_model');
        $this->load->model('sms_model');
        $this->load->model('frontend_model');
        
        // cache control
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
    
    // default function, redirects to login page if no admin logged in yet
    
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(site_url('admin/dashboard'), 'refresh');
    }
    
    // ADMIN DASHBOARD
    
    function dashboard()
    {
    
        //echo '<pre>';print_r($this->session->userdata);die;
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    
    //satishfy rate
    function patient_rate($patient_id,$rate_id){
        
        $this->db->where('patient_id', $patient_id);
        $data['satisfy_rate'] = $rate_id;
        $update = $this->db->update('patient', $data);
        if($update){
            redirect(site_url('admin/patient'), 'refresh');
        }
    }
    
    // LANGUAGE SETTINGS
    
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile'] = $param2;
        }
        // if ($param1 == 'update_phrase') {
        //     $language     = $param2;
        //     $total_phrase = $this->input->post('total_phrase');
        //     for ($i = 1; $i < $total_phrase; $i++) {
        //         //$data[$language]    =    $this->input->post('phrase').$i;
        //         $this->db->where('phrase_id', $i);
        //         $this->db->update('language', array(
        //             $language => $this->input->post('phrase' . $i)
        //         ));
        //     }
        //     redirect(site_url('admin/manage_language/edit_phrase/' . $language), 'refresh');
        // }
        if ($param1 == 'do_update') {
            $language        = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);
            
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        $page_data['page_name']  = 'manage_language';
        $page_data['page_title'] = get_phrase('manage_language');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    public function update_phrase_with_ajax() {
        $checker['phrase_id']                = $this->input->post('phraseId');
        $updater[$this->input->post('currentEditingLanguage')] = $this->input->post('updatedValue');

        $this->db->where('phrase_id', $checker['phrase_id']);
        $this->db->update('language', $updater);

        echo $checker['phrase_id'].' '.$this->input->post('currentEditingLanguage').' '.$this->input->post('updatedValue');
    }
    
    // SYSTEM SETTINGS
    
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == 'do_update') {
            $this->crud_model->update_system_settings();
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(site_url('admin/system_settings'), 'refresh');
        }
        
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    // SMS settings.
    function sms_settings($param1 = '')
    {
        
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == 'do_update') {
            $this->crud_model->update_sms_settings();
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(site_url('admin/sms_settings'), 'refresh');
        }
        
        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $this->load->view('backend/index', $page_data);
    }
    
    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */
    
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $validation    = email_validation_on_edit($data['email'], $this->session->userdata('login_user_id'), 'admin');
            if ($validation == 1) {
                $returned_array = null_checking($data);
                $this->db->where('admin_id', $this->session->userdata('login_user_id'));
                $this->db->update('admin', $returned_array);
                $this->session->set_flashdata('message', get_phrase('profile_info_updated_successfuly'));
                redirect(site_url('admin/manage_profile'), 'refresh');
            } else {
                $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
                redirect(site_url('admin/manage_profile'), 'refresh');
            }
            
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password           = sha1($this->input->post('new_password'));
            $confirm_new_password   = sha1($this->input->post('confirm_new_password'));
            
            $current_password_db = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('login_user_id')
            ))->row()->password;
            
            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('admin_id', $this->session->userdata('login_user_id'));
                $this->db->update('admin', array(
                    'password' => $new_password
                ));
                
                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(site_url('admin/manage_profile'), 'refresh');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(site_url('admin/manage_profile'), 'refresh');
            }
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('login_user_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    function department($task = "", $department_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_department_info();
            $this->session->set_flashdata('message', get_phrase('department_info_saved_successfuly'));
            redirect(site_url('admin/department'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_department_info($department_id);
            $this->session->set_flashdata('message', get_phrase('department_info_updated_successfuly'));
            redirect(site_url('admin/department'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_department_info($department_id);
            redirect(site_url('admin/department'), 'refresh');
        }
        
        $data['department_info'] = $this->crud_model->select_department_info();
        $data['page_name']       = 'manage_department';
        $data['page_title']      = get_phrase('department');
        $this->load->view('backend/index', $data);
    }
    
    function department_facilities($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == 'add') {
            $this->frontend_model->add_department_facility($param2);
            $this->session->set_flashdata('message', get_phrase('facility_saved_successfully'));
            redirect(site_url('admin/department_facilities/' . $param2), 'refresh');
        }
        
        if ($param1 == 'edit') {
            $this->frontend_model->edit_department_facility($param2);
            $this->session->set_flashdata('message', get_phrase('facility_updated_successfully'));
            redirect(site_url('admin/department_facilities/' . $param3), 'refresh');
        }
        
        if ($param1 == 'delete') {
            $this->frontend_model->delete_department_facility($param2);
            $this->session->set_flashdata('message', get_phrase('facility_deleted_successfully'));
            redirect(site_url('admin/department_facilities/' . $param3), 'refresh');
        }
        
        $data['department_info'] = $this->frontend_model->get_department_info($param1);
        $data['facilities']      = $this->frontend_model->get_department_facilities($param1);
        $data['page_name']       = 'department_facilities';
        $data['page_title']      = get_phrase('department_facilities') . ' | ' . $data['department_info']->name . ' ' . get_phrase('department');
        $this->load->view('backend/index', $data);
    }
    
    function doctor($task = "", $doctor_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        if ($task == "create") {
            $email      = $_POST['email'];
            $validation = email_validation_on_create($email);
            
            if ($validation == 1) {
                $this->crud_model->save_doctor_info();
                $this->session->set_flashdata('message', get_phrase('doctor_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
            }
            redirect(site_url('admin/doctor'), 'refresh');
        }
        if ($task == "update") {
            $this->crud_model->update_doctor_info($doctor_id);
            redirect(site_url('admin/doctor'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_doctor_info($doctor_id);
            redirect(site_url('admin/doctor'), 'refresh');
        }
        $data['doctor_info'] = $this->crud_model->select_doctor_info();
        $data['page_name']   = 'manage_doctor';
        $data['page_title']  = get_phrase('doctor');
        $this->load->view('backend/index', $data);
    }

    function newcases($task = "", $patient_id = "")
    {
    
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        $data['page_name']    = 'newcases';
        $data['page_title']   = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }
   
    function filesawaiting($table = "", $id = "", $status = "")
    {
    
        //var_dump($task, $patient_id);die;
    
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        if($table && $id && $status){
          if(in_array($table, ["work_injury", "work_suitability"])){
            $this->db->update($table, ["status" => $status], ["id" => $id]);
            $this->session->set_flashdata('message', get_phrase('updated_successfuly'));
            redirect(site_url('admin/filesawaiting'), 'refresh');
          }
        }
        
        $data['awaiting_info'] = $this->crud_model->select_awaiting_info();
        $suitable_info = $this->crud_model->select_suitable_awaiting_info();
        if($suitable_info){
          $data['awaiting_info'] = array_merge($data['awaiting_info'], $suitable_info);
        }
        
        $data['page_name']    = 'show_filesawaiting';
        $data['page_title']   = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }

    function readycases()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }

        $data['approval_info'] = $this->crud_model->select_awaiting_info("yes", "", "", "Ready case");

        $suitable_info = $this->crud_model->select_suitable_awaiting_info("yes", "", "", "Ready case");

        if($suitable_info){
          $data['approval_info'] = array_merge($data['approval_info'], $suitable_info);
        }
        
        $data['page_name']    = 'show_readycases';
        $data['page_title']   = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }

    function finishedcases()
    {
    
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        $data['approval_info'] = $this->crud_model->select_awaiting_info("yes", "", "", "Finished case");
        $suitable_info = $this->crud_model->select_suitable_awaiting_info("yes", "", "", "Finished case");
        if($suitable_info){
          $data['approval_info'] = array_merge($data['approval_info'], $suitable_info);
        }
        
        $data['page_name']    = 'show_finishedcases';
        $data['page_title']   = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }


    function filesprocessing($table = "", $id = "", $status = "")
    {
    
        //var_dump($task, $patient_id);die;
    
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        $data['approval_info'] = $this->crud_model->select_awaiting_info("yes", "", "", "New case");
        $suitable_info = $this->crud_model->select_suitable_awaiting_info("yes", "", "", "New case");
        if($suitable_info){
          $data['approval_info'] = array_merge($data['approval_info'], $suitable_info);
        }
        //print_r($data['approval_info']);die;
        
        $data['page_name']    = 'show_filesapproval';
        $data['page_title']   = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }
    
    
    function deleteAppointment(){
      if ($this->session->userdata('admin_login') != 1) {
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
        if ($this->session->userdata('admin_login') != 1) {
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
                if (file_exists("uploads/final_decision/$p_fileName"))
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

                $this->db->update($source, ["decision" => $decision, "final_decision" => $fileName, "final_decision_filename" => $_FILES['newfile']['name']], ["id" => $id]);
            } else {
                $this->db->update($source, ["decision" => $decision], ["id" => $id]);
            }
            $this->session->set_flashdata('message', get_phrase('saved_successfuly'));
            echo get_phrase('Success');
        }
    }

    function updateData(){
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $date = isset($_POST['date']) ? $_POST['date'] : "";
        $number = isset($_POST['number']) ? $_POST['number'] : "";
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $source = isset($_POST['source']) ? $_POST['source'] : "";
        
        if(!$date || !$id || !$source){
          echo get_phrase('Error');
        }
        else{
          if($date){
            $date = date("Y-m-d", strtotime($date));
          }
          $this->db->update($source, ["meeting_date" => $date, "meeting_number" => $number], ["id" => $id]);
          echo get_phrase('Success');
        }              
    }
        
    function makeAppointment(){
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $date = isset($_POST['date']) ? $_POST['date'] : "";
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $source = isset($_POST['source']) ? $_POST['source'] : "";
        
        if(!$date || !$id || !$source){
          echo get_phrase('Error');
        }
        else{
          $date = date("Y-m-d", strtotime($date));
          $this->db->update($source, ["appointment_date" => $date], ["id" => $id]);
          echo get_phrase('Success');
        }              
    }

    function editAppointment(){
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $status = isset($_POST['status']) ? $_POST['status'] : "";
        $vacation = isset($_POST['vacation']) ? $_POST['vacation'] : "";
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $source = isset($_POST['source']) ? $_POST['source'] : "";
        $this->db->where("id", $id);        
        $vac = $this->db->get($source)->row();
        
        $a = ($vac->vacation);                                                                            
        $sumv = $vacation + $a;                        
        if($sumv > 547){         
          //echo get_phrase('Limitreached');die;
          $this->session->set_flashdata('message', get_phrase('Limit_Reached'));die;
        }
                     
        if(!$id || !$source){
          //echo get_phrase('Error');
          $this->session->set_flashdata('message', get_phrase('Error'));
        }
        else{
          $this->db->update($source, ["active_status" => $status, "vacation" => $sumv], ["id" => $id]);
          //echo get_phrase('Success');
          $this->session->set_flashdata('message', get_phrase('added')); 
        }              
    }

    function editStatus(){
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $status = isset($_POST['status']) ? $_POST['status'] : "";
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $source = isset($_POST['source']) ? $_POST['source'] : "";
        
        if(!$id || !$source || !$status){
          echo get_phrase('Error');
        }
        else{
          $this->db->update($source, ["display_status" => $status], ["id" => $id]);
          echo get_phrase('Success');
        }              
    }



    function activecases()
    {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        $data['active_cases'] = $this->crud_model->select_awaiting_info("yes", $active);
        $suitable_info = $this->crud_model->select_suitable_awaiting_info("yes", $active);
        if($suitable_info){
          $data['active_cases'] = array_merge($data['active_cases'], $suitable_info);
        }
        //echo '<pre>';print_r($data['active_cases']);die;
        
        $data['page_name']    = 'show_active_cases';
        $data['page_title']   = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }


    function infocases()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $searchVal = !empty($_GET['searchVal']) ? $_GET['searchVal'] : "";
        $data['searchVal'] = $searchVal;
        $data['info'] = [];
        if ($searchVal) {
          $data['info'] = $this->crud_model->select_awaiting_info("", "", $searchVal);
          $suitable_info = $this->crud_model->select_suitable_awaiting_info("", "", $searchVal);
          if($suitable_info) {
            $data['info'] = array_merge($data['info'], $suitable_info);
          }
          $data['comments'] = $this->crud_model->get_all_comments($data['info']);
        } 
        //echo '<pre>';print_r($data['comments']);die;

        $data['page_name'] = 'info_cases';
        $data['page_title'] = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }


    function saveComments()
    {

        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $comments = !empty($_POST['newComment']) ? $_POST['newComment'] : "";
        $table = !empty($_POST['table']) ? $_POST['table'] : "";
        $id = !empty($_POST['id']) ? $_POST['id'] : "";
        $searchVal = !empty($_POST['searchVal']) ? $_POST['searchVal'] : "";
        
        if(!$comments || !$table || !$id){
          $this->session->set_flashdata('error_message', get_phrase('comment_cannot_be_empty'));
          redirect(site_url().'admin/infocases?searchVal='.$searchVal);
        }
        else{
          $fileName = "";
          if(!empty($_FILES['newfile']) && !empty($_FILES['newfile']['name'])){
            $fileType = strtolower(pathinfo($_FILES['newfile']['name'], PATHINFO_EXTENSION));
            if($fileType != "pdf") {
              $this->session->set_flashdata('error_message', get_phrase('Sorry, only PDF files are allowed.'));
              redirect(site_url().'admin/infocases?searchVal='.$searchVal);
              return false;
            }
            $fileName = date("Ymdhis")."_$id.".$fileType;
            move_uploaded_file($_FILES["newfile"]["tmp_name"], "uploads/comments/$fileName");
          }
          $insert = [
            'table_name' => $table,
            'map_id' => $id,
            'comments' => $comments,
            'filepath' => $fileName,
            'comment_filename' => $_FILES['newfile']['name']
          ];
          $this->db->insert('work_comments', $insert);
          
        $this->session->set_flashdata('message', get_phrase('comment_added'));
          redirect(site_url().'admin/infocases?searchVal='.$searchVal);
        }

    }
    
    function editcomment()
    {                          
        $searchVal = !empty($_POST['searchVal']) ? $_POST['searchVal'] : "";
        $id = !empty($_POST['id']) ? $_POST['id'] : "";   
        $newcomment = isset($_POST['editcomment']) ? $_POST['editcomment'] : "";
        $source = "work_comments";
        
        //echo($newcomment);die;
        
        
        $this->db->where("id", $id);        
        $ncom = $this->db->get($source)->row();        
        $comment = ($ncom->comments); 
        //print_r($newcomment);die;
        if(!$newcomment || !$source || !$id){
          $this->session->set_flashdata('error_message', get_phrase('comment_cannot_be_empty'));
          redirect(site_url().'admin/infocases?searchVal='.$searchVal);
        }
        else{
          $this->db->update($source, ["comments" => $newcomment], ["id" => $id]);
          //echo get_phrase('Success');
          $this->session->set_flashdata('message', get_phrase('Comment_Edited'));
          redirect(site_url().'admin/infocases?searchVal='.$searchVal); 
        }
     }
     
    function infoprint()
    {

        $source = isset($_POST['itable']) ? $_POST['itable'] : "";
        $id = isset($_POST['id']) ? $_POST['id'] : ""; 

        $this->db->where("id", $id);        
        $results = $this->db->get($source)->row();
        
        $output = $this->load->view('backend/infoprint', ["results" => $results], true);
         
        $mpdf = new mPDF();
        $mpdf->WriteHTML($output);
        $mpdf->Output(); 
         
    } 
  
    function deletecomments()
    { 
                  
      $did = !empty($_POST['id']) ? $_POST['id'] : "";
      
      //print_r($id);die;
      $this->db->where('id', $did);
      $this->db->delete('work_comments');
      $this->session->set_flashdata('message', get_phrase('comment_deleted'));                 
    }
    
    function patient($task = "", $patient_id = "")
    {
    
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }

        if ($task == "create") {
            //$this->crud_model->save_patient_info();
            $this->crud_model->save_case_info();
            $this->session->set_flashdata('message', get_phrase('patient_info_saved_successfuly'));
            redirect(site_url('admin/patient'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_patient_info($patient_id);
            redirect(site_url('admin/patient'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_patient_info($patient_id);
            redirect(site_url('admin/patient'), 'refresh');
        }
        
        $data['patient_info'] = $this->crud_model->select_patient_info();
        $data['page_name']    = 'manage_patient';
        $data['page_title']   = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }
    
    function nurse($task = "", $nurse_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_nurse_info();
            $this->session->set_flashdata('message', get_phrase('nurse_info_saved_successfuly'));
            redirect(site_url('admin/nurse'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_nurse_info($nurse_id);
            redirect(site_url('admin/nurse'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_nurse_info($nurse_id);
            redirect(site_url('admin/nurse'), 'refresh');
        }
        
        $data['nurse_info'] = $this->crud_model->select_nurse_info();
        $data['page_name']  = 'manage_nurse';
        $data['page_title'] = get_phrase('nurse');
        $this->load->view('backend/index', $data);
    }
    
    function pharmacist($task = "", $pharmacist_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_pharmacist_info();
            $this->session->set_flashdata('message', get_phrase('pharmacist_info_saved_successfuly'));
            redirect(site_url('admin/pharmacist'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_pharmacist_info($pharmacist_id);
            redirect(site_url('admin/pharmacist'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_pharmacist_info($pharmacist_id);
            redirect(site_url('admin/pharmacist'), 'refresh');
        }
        
        $data['pharmacist_info'] = $this->crud_model->select_pharmacist_info();
        $data['page_name']       = 'manage_pharmacist';
        $data['page_title']      = get_phrase('pharmacist');
        $this->load->view('backend/index', $data);
    }
    
    function laboratorist($task = "", $laboratorist_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_laboratorist_info();
            $this->session->set_flashdata('message', get_phrase('laboratorist_info_saved_successfuly'));
            redirect(site_url('admin/laboratorist'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_laboratorist_info($laboratorist_id);
            redirect(site_url('admin/laboratorist'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_laboratorist_info($laboratorist_id);
            redirect(site_url('admin/laboratorist'), 'refresh');
        }
        
        $data['laboratorist_info'] = $this->crud_model->select_laboratorist_info();
        $data['page_name']         = 'manage_laboratorist';
        $data['page_title']        = get_phrase('laboratorist');
        $this->load->view('backend/index', $data);
    }
    
    function accountant($task = "", $accountant_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_accountant_info();
            $this->session->set_flashdata('message', get_phrase('accountant_info_saved_successfuly'));
            redirect(site_url('admin/accountant'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_accountant_info($accountant_id);
            redirect(site_url('admin/accountant'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_accountant_info($accountant_id);
            redirect(site_url('admin/accountant'), 'refresh');
        }
        
        $data['accountant_info'] = $this->crud_model->select_accountant_info();
        $data['page_name']       = 'manage_accountant';
        $data['page_title']      = get_phrase('accountant');
        $this->load->view('backend/index', $data);
    }
    
    function receptionist($task = "", $receptionist_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_receptionist_info();
            $this->session->set_flashdata('message', get_phrase('receptionist_info_saved_successfuly'));
            redirect(site_url('admin/receptionist'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_receptionist_info($receptionist_id);
            redirect(site_url('admin/receptionist'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_receptionist_info($receptionist_id);
            redirect(site_url('admin/receptionist'), 'refresh');
        }
        
        $data['receptionist_info'] = $this->crud_model->select_receptionist_info();
        $data['page_name']         = 'manage_receptionist';
        $data['page_title']        = get_phrase('receptionist');
        $this->load->view('backend/index', $data);
    }
    
    function payment_history($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['invoice_info'] = $this->crud_model->select_invoice_info();
        $data['page_name']    = 'show_payment_history';
        $data['page_title']   = get_phrase('payment_history');
        $this->load->view('backend/index', $data);
    }
    
    function bed_allotment($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['bed_allotment_info'] = $this->crud_model->select_bed_allotment_info();
        $data['page_name']          = 'show_bed_allotment';
        $data['page_title']         = get_phrase('bed_allotment');
        $this->load->view('backend/index', $data);
    }
    
    function blood_bank($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['blood_bank_info'] = $this->crud_model->select_blood_bank_info();
        $data['page_name']       = 'show_blood_bank';
        $data['page_title']      = get_phrase('blood_bank');
        $this->load->view('backend/index', $data);
    }
    
    function blood_donor($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['blood_donor_info'] = $this->crud_model->select_blood_donor_info();
        $data['page_name']        = 'show_blood_donor';
        $data['page_title']       = get_phrase('blood_donor');
        $this->load->view('backend/index', $data);
    }
    
    function medicine($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['medicine_info'] = $this->crud_model->select_medicine_info();
        $data['page_name']     = 'show_medicine';
        $data['page_title']    = get_phrase('medicine');
        $this->load->view('backend/index', $data);
    }
    
    function operation_report($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['page_name']  = 'show_operation_report';
        $data['page_title'] = get_phrase('operation_report');
        $this->load->view('backend/index', $data);
    }
    
    function birth_report($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['page_name']  = 'show_birth_report';
        $data['page_title'] = get_phrase('birth_report');
        $this->load->view('backend/index', $data);
    }
    
    function death_report($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['page_name']  = 'show_death_report';
        $data['page_title'] = get_phrase('death_report');
        $this->load->view('backend/index', $data);
    }
    
    function notice($task = "", $notice_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_notice_info();
            $this->session->set_flashdata('message', get_phrase('notice_info_saved_successfuly'));
            redirect(site_url('admin/notice'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_notice_info($notice_id);
            $this->session->set_flashdata('message', get_phrase('notice_info_updated_successfuly'));
            redirect(site_url('admin/notice'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_notice_info($notice_id);
            redirect(site_url('admin/notice'), 'refresh');
        }
        
        $data['notice_info'] = $this->crud_model->select_notice_info();
        $data['page_name']   = 'manage_notice';
        $data['page_title']  = get_phrase('noticeboard');
        $this->load->view('backend/index', $data);
    }
    
    // PAYROLL
    function payroll()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $page_data['page_name']  = 'payroll_add';
        $page_data['page_title'] = get_phrase('create_payroll');
        $this->load->view('backend/index', $page_data);
    }
    
    function payroll_selector()
    {
        $user        = explode('-', $this->input->post('employee_id'));
        $user_type   = $user[0];
        $employee_id = $user[1];
        $month       = $this->input->post('month');
        $year        = $this->input->post('year');
        
        redirect(site_url('admin/payroll_view/' . $user_type . '/' . $employee_id . '/' . $month . '/' . $year), 'refresh');
    }
    
    function payroll_view($user_type = '', $employee_id = '', $month = '', $year = '')
    {
        $page_data['user_type']   = $user_type;
        $page_data['employee_id'] = $employee_id;
        $page_data['month']       = $month;
        $page_data['year']        = $year;
        $page_data['page_name']   = 'payroll_add_view';
        $page_data['page_title']  = get_phrase('create_payroll');
        $this->load->view('backend/index', $page_data);
    }
    
    function create_payroll()
    {
        $data['payroll_code']   = substr(md5(rand(100000000, 20000000000)), 0, 7);
        $data['user_id']        = $this->input->post('user_id');
        $data['user_type']      = $this->input->post('user_type');
        $data['joining_salary'] = $this->input->post('joining_salary');
        
        $allowances        = array();
        $allowance_types   = $this->input->post('allowance_type');
        $allowance_amounts = $this->input->post('allowance_amount');
        $number_of_entries = sizeof($allowance_types);
        
        for ($i = 0; $i < $number_of_entries; $i++) {
            if ($allowance_types[$i] != "" && $allowance_amounts[$i] != "") {
                $new_entry = array(
                    'type' => $allowance_types[$i],
                    'amount' => $allowance_amounts[$i]
                );
                array_push($allowances, $new_entry);
            }
        }
        $data['allowances'] = json_encode($allowances);
        
        $deductions        = array();
        $deduction_types   = $this->input->post('deduction_type');
        $deduction_amounts = $this->input->post('deduction_amount');
        $number_of_entries = sizeof($deduction_types);
        
        for ($i = 0; $i < $number_of_entries; $i++) {
            if ($deduction_types[$i] != "" && $deduction_amounts[$i] != "") {
                $new_entry = array(
                    'type' => $deduction_types[$i],
                    'amount' => $deduction_amounts[$i]
                );
                array_push($deductions, $new_entry);
            }
        }
        $data['deductions'] = json_encode($deductions);
        $data['date']       = $this->input->post('month') . ',' . $this->input->post('year');
        $data['status']     = $this->input->post('status');
        
        $this->db->insert('payroll', $data);
        
        $this->session->set_flashdata('message', get_phrase('data_created_successfully'));
        redirect(site_url('admin/payroll_list'), 'refresh');
    }
    
    function payroll_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == 'mark_paid') {
            $data['status'] = 1;
            
            $this->db->update('payroll', $data, array(
                'payroll_id' => $param2
            ));
            
            $this->session->set_flashdata('message', get_phrase('data_updated_successfully'));
            redirect(site_url('admin/payroll_list'), 'refresh');
        }
        
        $page_data['page_name']  = 'payroll_list';
        $page_data['page_title'] = get_phrase('payroll_list');
        $this->load->view('backend/index', $page_data);
    }
    
    // forntend management
    function frontend($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == '' || $param1 == 'home_page') {
            $page_data['inner_page']      = 'frontend_home_page';
            $page_data['sliders']         = $this->frontend_model->get_frontend_settings('slider');
            $page_data['welcome_content'] = $this->frontend_model->get_frontend_settings('homepage_welcome_section');
        }
        
        if ($param1 == 'about_us') {
            $page_data['inner_page'] = 'frontend_about_us';
        }
        
        if ($param1 == 'blog') {
            $page_data['inner_page'] = 'frontend_blog';
            $page_data['blogs']      = $this->frontend_model->get_blogs();
        }
        
        if ($param1 == 'blog_new') {
            $page_data['inner_page'] = 'frontend_blog_new';
        }
        
        if ($param1 == 'blog_edit') {
            $page_data['blog']       = $this->frontend_model->get_blog_details($param2);
            $page_data['inner_page'] = 'frontend_blog_edit';
        }
        
        if ($param1 == 'service') {
            $page_data['inner_page'] = 'frontend_service';
            $page_data['service']    = $this->frontend_model->get_frontend_settings('service_section');
            $page_data['services']   = $this->frontend_model->get_services();
        }
        
        if ($param1 == 'settings') {
            $page_data['inner_page'] = 'frontend_settings';
        }
        
        $page_data['page_name']  = 'frontend';
        $page_data['page_title'] = get_phrase('manage_hospital_website');
        $this->load->view('backend/index', $page_data);
    }
    
    // update frontend settings
    function frontend_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == 'slider') {
            $this->frontend_model->update_slider();
            $this->session->set_flashdata('message', get_phrase('changes_saved_successfully'));
            redirect(site_url('admin/frontend/home_page'), 'refresh');
        }
        
        if ($param1 == 'welcome_section') {
            $this->frontend_model->update_welcome_section_content();
            $this->session->set_flashdata('message', get_phrase('changes_saved_successfully'));
            redirect(site_url('admin/frontend/home_page'), 'refresh');
        }
        
        if ($param1 == 'service_section') {
            $this->frontend_model->update_service_section();
            $this->session->set_flashdata('message', get_phrase('changes_saved_successfully'));
            redirect(site_url('admin/frontend/service'), 'refresh');
        }
        
        if ($param1 == 'service_new') {
            $this->frontend_model->add_new_service();
            $this->session->set_flashdata('message', get_phrase('service_saved_successfully'));
            redirect(site_url('admin/frontend/service'), 'refresh');
        }
        
        if ($param1 == 'service_edit') {
            $this->frontend_model->update_service($param2);
            $this->session->set_flashdata('message', get_phrase('service_updated_successfully'));
            redirect(site_url('admin/frontend/service'), 'refresh');
        }
        
        if ($param1 == 'service_delete') {
            $this->frontend_model->delete_service($param2);
            $this->session->set_flashdata('message', get_phrase('service_deleted_successfully'));
            redirect(site_url('admin/frontend/service'), 'refresh');
        }
        
        if ($param1 == 'blog_new') {
            $this->frontend_model->add_new_blog();
            $this->session->set_flashdata('message', get_phrase('blogpost_saved_successfully'));
            redirect(site_url('admin/frontend/blog'), 'refresh');
        }
        
        if ($param1 == 'blog_edit') {
            $this->frontend_model->update_blog($param2);
            $this->session->set_flashdata('message', get_phrase('changes_saved_successfully'));
            redirect(site_url('admin/frontend/blog'), 'refresh');
        }
        
        if ($param1 == 'blog_delete') {
            $this->frontend_model->delete_blog($param2);
            $this->session->set_flashdata('message', get_phrase('blog_deleted'));
            redirect(site_url('admin/frontend/blog'), 'refresh');
        }
        
        if ($param1 == 'about_us') {
            $this->frontend_model->update_about_us();
            $this->session->set_flashdata('message', get_phrase('data_updated'));
            redirect(site_url('admin/frontend/about_us'), 'refresh');
        }
        
        if ($param1 == 'settings') {
            $this->frontend_model->update_frontend_settings();
            $this->session->set_flashdata('message', get_phrase('changes_saved_successfully'));
            redirect(site_url('admin/frontend/settings'), 'refresh');
        }
    }
    
    function contact_email($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == 'delete') {
            $this->db->where('contact_email_id', $param2);
            $this->db->delete('contact_email');
            $this->session->set_flashdata('message', get_phrase('email_deleted'));
            redirect(site_url('admin/contact_email'), 'refresh');
        }
        
        $page_data['page_name']      = 'contact_email';
        $page_data['page_title']     = get_phrase('contact_emails');
        $page_data['contact_emails'] = $this->frontend_model->get_contact_emails();
        $this->load->view('backend/index', $page_data);
    }
} 
