<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*     
 *     @author : Creativeitem
 *     30th July, 2014
 *     Creative Item
 *     www.creativeitem.com
 *     http://codecanyon.net/user/creativeitem
 */

class Login extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->model('email_model');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }
    
    //Default function, redirects to logged in user area
    public function index()
    {
        
        if ($this->session->userdata('admin_login') == 1)
            redirect(site_url('admin/dashboard'), 'refresh');
        
        else if ($this->session->userdata('doctor_login') == 1)
            redirect(site_url('doctor'), 'refresh');
        
        else if ($this->session->userdata('patient_login') == 1)
            redirect(site_url('patient'), 'refresh');
        
        else if ($this->session->userdata('nurse_login') == 1)
            redirect(site_url('nurse'), 'refresh');
        
        else if ($this->session->userdata('pharmacist_login') == 1)
            redirect(site_url('pharmacist'), 'refresh');
        
        else if ($this->session->userdata('laboratorist_login') == 1)
            redirect(site_url('laboratorist'), 'refresh');
        
        else if ($this->session->userdata('accountant_login') == 1)
            redirect(site_url('accountant'), 'refresh');
        
        else if ($this->session->userdata('receptionist_login') == 1)
            redirect(site_url('receptionist'), 'refresh');

        else if ($this->session->userdata('normal_login') == 1)
            redirect(site_url('normal'), 'refresh');
        
        $this->load->view('backend/login');
    }
    
    //Ajax login function 
    function do_login()
    {
        
        //Recieving post input of email, password from ajax request
        $email    = $_POST["email"];
        $password = $_POST["password"];
        
        //Validating login
        $login_status = $this->validate_login($email, $password);
        if ($login_status == 'success') {
            redirect(site_url('login'), 'refresh');
        } else {
            $this->session->set_flashdata('error_message', get_phrase('login_failed'));
            redirect(site_url('login'), 'refresh');
        }
    }
    
    //Validating login from ajax request
    function validate_login($email = '', $password = '')
    {
        $credential = array(
            'email' => $email,
            'password' => sha1($password)
        );
        
        // Checking login credential for admin
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin');
            $this->session->set_userdata('email', $row->email);
            return 'success';
        }
        
        
        $query = $this->db->get_where('doctor', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('doctor_login', '1');
            $this->session->set_userdata('login_user_id', $row->doctor_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'doctor');
            $this->session->set_userdata('email', $row->email);
            return 'success';
        }
        
        $query = $this->db->get_where('patient', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('patient_login', '1');
            $this->session->set_userdata('login_user_id', $row->patient_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'patient');
            $this->session->set_userdata('email', $row->email);
            return 'success';
        }
        
        $query = $this->db->get_where('nurse', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('nurse_login', '1');
            $this->session->set_userdata('login_user_id', $row->nurse_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'nurse');
            $this->session->set_userdata('email', $row->email);
            return 'success';
        }
        
        $query = $this->db->get_where('pharmacist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('pharmacist_login', '1');
            $this->session->set_userdata('login_user_id', $row->pharmacist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'pharmacist');
            $this->session->set_userdata('email', $row->email);
            return 'success';
        }
        
        $query = $this->db->get_where('laboratorist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('laboratorist_login', '1');
            $this->session->set_userdata('login_user_id', $row->laboratorist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'laboratorist');
            $this->session->set_userdata('email', $row->email);
            return 'success';
        }
        
        $query = $this->db->get_where('accountant', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('accountant_login', '1');
            $this->session->set_userdata('login_user_id', $row->accountant_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'accountant');
            $this->session->set_userdata('email', $row->email);
            return 'success';
        }
        
        $query = $this->db->get_where('receptionist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('receptionist_login', '1');
            $this->session->set_userdata('login_user_id', $row->receptionist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'receptionist');
            $this->session->set_userdata('email', $row->email);
            return 'success';
        }

        $query = $this->db->get_where('normal', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('normal_login', '1');
            $this->session->set_userdata('login_user_id', $row->normal_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'normal');
            $this->session->set_userdata('is_normal', TRUE);
            $this->session->set_userdata('email', $row->email);
            return 'success';
        }
        
        return 'invalid';
    }
    
    /*     * *DEFAULT NOT FOUND PAGE**** */
    
    function four_zero_four()
    {
        $this->load->view('four_zero_four');
    }
    
    /*     * *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */
    
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }
    
    function reset_password()
    {
        $email              = $this->input->post('email');
        $reset_account_type = '';
        $new_password       = substr(md5(rand(100000000, 20000000000)), 0, 7);
        // checking credential for admin
        $query              = $this->db->get_where('admin', array(
            'email' => $email
        ));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'admin';
            $this->db->where('email', $email);
            $this->db->update('admin', array(
                'password' => sha1($new_password)
            ));
        }
        // checking credential for doctor
        $query = $this->db->get_where('doctor', array(
            'email' => $email
        ));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'doctor';
            $this->db->where('email', $email);
            $this->db->update('doctor', array(
                'password' => sha1($new_password)
            ));
        }
        // checking credential for patient
        $query = $this->db->get_where('patient', array(
            'email' => $email
        ));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'patient';
            $this->db->where('email', $email);
            $this->db->update('patient', array(
                'password' => sha1($new_password)
            ));
        }
        // checking credential for nurse
        $query = $this->db->get_where('nurse', array(
            'email' => $email
        ));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'nurse';
            $this->db->where('email', $email);
            $this->db->update('nurse', array(
                'password' => sha1($new_password)
            ));
        }
        // checking credential for pharmacist
        $query = $this->db->get_where('pharmacist', array(
            'email' => $email
        ));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'pharmacist';
            $this->db->where('email', $email);
            $this->db->update('pharmacist', array(
                'password' => sha1($new_password)
            ));
        }
        // checking credential for laboratorist
        $query = $this->db->get_where('laboratorist', array(
            'email' => $email
        ));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'laboratorist';
            $this->db->where('email', $email);
            $this->db->update('laboratorist', array(
                'password' => sha1($new_password)
            ));
        }
        // checking credential for accountant
        $query = $this->db->get_where('accountant', array(
            'email' => $email
        ));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'accountant';
            $this->db->where('email', $email);
            $this->db->update('accountant', array(
                'password' => sha1($new_password)
            ));
        }
        // checking credential for receptionist
        $query = $this->db->get_where('receptionist', array(
            'email' => $email
        ));
        if ($query->num_rows() > 0) {
            $reset_account_type = 'receptionist';
            $this->db->where('email', $email);
            $this->db->update('receptionist', array(
                'password' => sha1($new_password)
            ));
        }
        
        $result = $this->email_model->password_reset_email($reset_account_type, $email, $new_password);
        if ($result == true) {
            $this->session->set_flashdata('success_message', 'Please check your email for the new password');
        } else {
            $this->session->set_flashdata('error_message', 'Could not find the email that you have entered');
        }
        redirect(site_url('login/forgot_password'), 'refresh');
    }
    
    /*     * *****LOGOUT FUNCTION ****** */
    
    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(site_url('login'), 'refresh');
    }
}
