<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doctor extends CI_Controller
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
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['page_name']  = 'dashboard';
        $data['page_title'] = get_phrase('doctor_dashboard');
        $this->load->view('backend/index', $data);
    }
    
     function patient_rate_update($patient_id,$rate_id){
        $this->db->where('patient_id', $patient_id);
        $this->db->update('satisfy_rate', $rate_id);
    }
    
    function patient($task = "", $patient_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_patient_info();
            $this->session->set_flashdata('message', get_phrase('patient_info_saved_successfuly'));
            redirect(site_url('doctor/patient'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_patient_info($patient_id);
            $this->session->set_flashdata('message', get_phrase('patient_info_updated_successfuly'));
            redirect(site_url('doctor/patient'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_patient_info($patient_id);
            redirect(site_url('doctor/patient'), 'refresh');
        }
        
        $data['patients']   = $this->crud_model->select_patient_info_by_doctor_id();
        $data['page_name']  = 'manage_patient';
        $data['page_title'] = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }
    
    function medication_history($param1 = "", $prescription_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $patient_name              = $this->db->get_where('patient', array(
            'patient_id' => $param1
        ))->row()->name; // $param1 = $patient_id
        $data['prescription_info'] = $this->crud_model->select_medication_history($param1); // $param1 = $patient_id
        $data['menu_check']        = 'from_patient';
        $data['page_name']         = 'manage_prescription';
        $data['page_title']        = get_phrase('medication_history_of_:_') . $patient_name;
        $this->load->view('backend/index', $data);
    }
    
    function bed_allotment($task = "", $bed_allotment_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_bed_allotment_info();
            $this->session->set_flashdata('message', get_phrase('bed_allotment_info_saved_successfuly'));
            redirect(site_url('doctor/bed_allotment'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_bed_allotment_info($bed_allotment_id);
            $this->session->set_flashdata('message', get_phrase('bed_allotment_info_updated_successfuly'));
            redirect(site_url('doctor/bed_allotment'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_bed_allotment_info($bed_allotment_id);
            redirect(site_url('doctor/bed_allotment'), 'refresh');
        }
        
        $data['bed_allotment_info'] = $this->crud_model->select_bed_allotment_info();
        $data['page_name']          = 'manage_bed_allotment';
        $data['page_title']         = get_phrase('bed_allotment');
        $this->load->view('backend/index', $data);
    }
    
    function blood_bank($task = "", $blood_bank_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['blood_bank_info']  = $this->crud_model->select_blood_bank_info();
        $data['blood_donor_info'] = $this->crud_model->select_blood_donor_info();
        $data['page_name']        = 'show_blood_bank';
        $data['page_title']       = get_phrase('blood_bank');
        $this->load->view('backend/index', $data);
    }
    
    function report($task = "", $report_id = "", $param3 = '')
    {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_report_info();
            $this->session->set_flashdata('message', get_phrase('report_info_saved_successfuly'));
            redirect(site_url('doctor/report'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_report_info($report_id);
            $this->session->set_flashdata('message', get_phrase('report_info_updated_successfuly'));
            redirect(site_url('doctor/report'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_report_info($report_id);
            $this->session->set_flashdata('message', get_phrase('report_info_deleted_successfuly'));
            redirect(site_url('doctor/report'), 'refresh');
        }
        
        if ($task == "delete_report_file") {
            $this->crud_model->delete_report_file($report_id, $param3);
            $this->session->set_flashdata('message', get_phrase('file_deleted_successfuly'));
            redirect(site_url('doctor/report'), 'refresh');
        }
        
        $data['page_name']  = 'manage_report';
        $data['page_title'] = get_phrase('report');
        $this->load->view('backend/index', $data);
    }

    function operation_report_download(){
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $all_report = $this->db->get_where('report', array('type' => 'operation'))->result_array();
        $data = 'Type'.','.'Description'.','.'Patient'.','.'Doctor'.','.'Date'."\n";
        foreach($all_report as $row1){
            $doctor_id = $row1['doctor_id'];
            $patient_id = $row1['patient_id'];
            $date = date('M d Y',$row1['timestamp']);
            $doctor = $this->db->get_where('doctor', array('doctor_id' => $doctor_id))->row('name');
            $patient = $this->db->get_where('patient', array('patient_id' => $patient_id))->row('name');
            $data .= $row1['type'].','.$row1['description'].','.$patient.','.$doctor.','.$date."\n";
        }

        $file = file_put_contents('assets/report.xlsx', $data);
        redirect(base_url('assets/report.xlsx'));
    }

    function birth_report_download(){
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $all_report = $this->db->get_where('report', array('type' => 'birth'))->result_array();
        $data = 'Type'.','.'Description'.','.'Patient'.','.'Doctor'.','.'Date'."\n";
        foreach($all_report as $row1){
            $doctor_id = $row1['doctor_id'];
            $patient_id = $row1['patient_id'];
            $date = date('M d Y',$row1['timestamp']);
            $doctor = $this->db->get_where('doctor', array('doctor_id' => $doctor_id))->row('name');
            $patient = $this->db->get_where('patient', array('patient_id' => $patient_id))->row('name');
            $data .= $row1['type'].','.$row1['description'].','.$patient.','.$doctor.','.$date."\n";
        }

        $file = file_put_contents('assets/report.xlsx', $data);
        redirect(base_url('assets/report.xlsx'));
    }

    function death_report_download(){
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $all_report = $this->db->get_where('report', array('type' => 'death'))->result_array();
        $data = 'Type'.','.'Description'.','.'Patient'.','.'Doctor'.','.'Date'."\n";
        foreach($all_report as $row1){
            $doctor_id = $row1['doctor_id'];
            $patient_id = $row1['patient_id'];
            $date = date('M d Y',$row1['timestamp']);
            $doctor = $this->db->get_where('doctor', array('doctor_id' => $doctor_id))->row('name');
            $patient = $this->db->get_where('patient', array('patient_id' => $patient_id))->row('name');
            $data .= $row1['type'].','.$row1['description'].','.$patient.','.$doctor.','.$date."\n";
        }

        $file = file_put_contents('assets/report.xlsx', $data);
        redirect(base_url('assets/report.xlsx'));
    }
    
    function manage_profile($task = "")
    {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $doctor_id = $this->session->userdata('login_user_id');
        if ($task == "update") {
            $this->crud_model->update_doctor_info($doctor_id);
            redirect(site_url('doctor/manage_profile'), 'refresh');
        }
        
        if ($task == "change_password") {
            $password             = $this->db->get_where('doctor', array(
                'doctor_id' => $doctor_id
            ))->row()->password;
            $old_password         = sha1($this->input->post('old_password'));
            $new_password         = $this->input->post('new_password');
            $confirm_new_password = $this->input->post('confirm_new_password');
            
            if ($password == $old_password && $new_password == $confirm_new_password) {
                $data['password'] = sha1($new_password);
                
                $this->db->where('doctor_id', $doctor_id);
                $this->db->update('doctor', $data);
                
                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(site_url('doctor/manage_profile'), 'refresh');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(site_url('doctor/manage_profile'), 'refresh');
            }
        }
        
        $data['page_name']  = 'edit_profile';
        $data['page_title'] = get_phrase('profile');
        $this->load->view('backend/index', $data);
    }
    
    function appointment($task = "", $appointment_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_appointment_info();
            $this->session->set_flashdata('message', get_phrase('appointment_info_saved_successfuly'));
            redirect(site_url('doctor/appointment'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_appointment_info($appointment_id);
            $this->session->set_flashdata('message', get_phrase('appointment_info_updated_successfuly'));
            redirect(site_url('doctor/appointment'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_appointment_info($appointment_id);
            redirect(site_url('doctor/appointment'), 'refresh');
        }
        
        $data['appointment_info'] = $this->crud_model->select_appointment_info_by_doctor_id();
        $data['page_name']        = 'manage_appointment';
        $data['page_title']       = get_phrase('appointment');
        $this->load->view('backend/index', $data);
    }
    
    function appointment_requested($task = "", $appointment_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "approve") {
            $this->crud_model->approve_appointment_info($appointment_id);
            $this->session->set_flashdata('message', get_phrase('appointment_info_approved'));
            redirect(site_url('doctor/appointment_requested'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_appointment_info($appointment_id);
            redirect(site_url('doctor/appointment_requested'), 'refresh');
        }
        
        $data['requested_appointment_info'] = $this->crud_model->select_requested_appointment_info_by_doctor_id();
        $data['page_name']                  = 'manage_requested_appointment';
        $data['page_title']                 = get_phrase('requested_appointment');
        $this->load->view('backend/index', $data);
    }
    
    function prescription($task = "", $prescription_id = "", $menu_check = '', $patient_id = '')
    {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_prescription_info();
            $this->session->set_flashdata('message', get_phrase('prescription_info_saved_successfuly'));
            redirect(site_url('doctor/prescription'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_prescription_info($prescription_id);
            $this->session->set_flashdata('message', get_phrase('prescription_info_updated_successfuly'));
            if ($menu_check == 'from_prescription')
                redirect(site_url('doctor/prescription'), 'refresh');
            else
                redirect(site_url('doctor/medication_history/' . $patient_id), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_prescription_info($prescription_id);
            if ($menu_check == 'from_prescription')
                redirect(site_url('doctor/prescription'), 'refresh');
            else
                redirect(site_url('doctor/medication_history/' . $patient_id), 'refresh');
        }
        
        $data['prescription_info'] = $this->crud_model->select_prescription_info_by_doctor_id();
        $data['menu_check']        = 'from_prescription';
        $data['page_name']         = 'manage_prescription';
        $data['page_title']        = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }
    
    function diagnosis_report($task = "", $diagnosis_report_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_diagnosis_report_info();
            $this->session->set_flashdata('message', get_phrase('diagnosis_report_info_saved_successfuly'));
            redirect(site_url('doctor/prescription'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_diagnosis_report_info($diagnosis_report_id);
            $this->session->set_flashdata('message', get_phrase('diagnosis_report_info_deleted_successfuly'));
            redirect(site_url('doctor/prescription'), 'refresh');
        }
    }
    
    /* private messaging */
    
    function message($param1 = 'message_home', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('doctor_login') != 1)
            redirect(site_url(), 'refresh');
        
        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(site_url('doctor/message/message_read/' . $message_thread_code), 'refresh');
        }
        
        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2); //$param2 = message_thread_code
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(site_url('doctor/message/message_read/' . $param2), 'refresh');
        }
        
        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2; // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }
        
        $page_data['message_inner_page_name'] = $param1;
        $page_data['page_name']               = 'message';
        $page_data['page_title']              = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }
    
    function payroll_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('doctor_login') != 1)
            redirect(site_url(), 'refresh');
        
        $page_data['page_name']  = 'payroll_list';
        $page_data['page_title'] = get_phrase('payroll_list');
        $this->load->view('backend/index', $page_data);
    }
    
    function send_sms($message = '', $reciever_phone = '')
    {
        
        
        //$to = "[\"<$reciever_phone>\"]";
        echo $to = $reciever_phone;
        echo $text = $message;
        $authToken = "ZaD9vMp5S3imW39pM77PEg==";
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "https://api.clickatell.com/rest/message");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"text\":\"$text\",\"to\":$to}");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-Version: 1",
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Bearer $authToken"
        ));
        
        $result = curl_exec($ch);
        
        echo $result;
    }
    
}