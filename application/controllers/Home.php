<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *     @author : Creativeitem
 *     date    : 17 October, 2017
 *     http://codecanyon.net/user/Creativeitem
 *     http://creativeitem.com
 */

class Home extends CI_Controller
{
    
    protected $theme;
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('session');
        $this->load->model('crud_model');
        $this->load->model('email_model');
        $this->load->model('sms_model');
        $this->load->model('frontend_model');
        $this->theme = $this->frontend_model->get_frontend_settings('theme');
    }
    
    public function index()
    {
        $this->home();
    }
    
    function home()
    {
        $page_data['page_name']       = 'home';
        $page_data['page_title']      = get_phrase('home');
        $page_data['departments']     = $this->frontend_model->get_departments();
        $page_data['doctors']         = $this->frontend_model->get_random_doctors(4);
        $page_data['sliders']         = $this->frontend_model->get_frontend_settings('slider');
        $page_data['welcome_content'] = $this->frontend_model->get_frontend_settings('homepage_welcome_section');
        $page_data['opening_hours']   = $this->frontend_model->get_frontend_settings('opening_hours');
        $page_data['service_section'] = $this->frontend_model->get_frontend_settings('service_section');
        $page_data['services']        = $this->frontend_model->get_services();
        $this->load->view('frontend/' . $this->theme . '/index', $page_data);
    }
    
    function department($department_id)
    {
        $info                     = $this->frontend_model->get_department_info($department_id);
        $page_data['page_name']   = 'department';
        $page_data['page_title']  = $info->name;
        $page_data['department']  = $info;
        $page_data['departments'] = $this->frontend_model->get_departments();
        $page_data['doctors']     = $this->frontend_model->get_doctors($department_id);
        $page_data['facilities']  = $this->frontend_model->get_department_facilities($department_id);
        $this->load->view('frontend/' . $this->theme . '/index', $page_data);
    }
    
    function doctors($department_id = '')
    {
        if ($department_id == '') {
            $page_data['doctors'] = $this->frontend_model->get_doctors();
        } else {
            $page_data['doctors']    = $this->frontend_model->get_doctors($department_id);
            $page_data['department'] = $this->frontend_model->get_department_info($department_id);
        }
        $page_data['departments'] = $this->frontend_model->get_departments();
        $page_data['page_name']   = 'doctors';
        $page_data['page_title']  = get_phrase('doctors');
        $this->load->view('frontend/' . $this->theme . '/index', $page_data);
    }
    
    function get_doctor_details($doctor_id)
    {
        $page_data['doctor'] = $this->frontend_model->get_doctor_info($doctor_id);
        $this->load->view('frontend/' . $this->theme . '/slide_view', $page_data);
    }
    
    function about_us()
    {
        $page_data['page_name']       = 'about_us';
        $page_data['page_title']      = get_phrase('about_us');
        $page_data['service_section'] = $this->frontend_model->get_frontend_settings('service_section');
        $page_data['services']        = $this->frontend_model->get_services();
        $this->load->view('frontend/' . $this->theme . '/index', $page_data);
    }
    
    function appointment($doctor_id = '')
    {
        if ($doctor_id != '') {
            $page_data['doctor'] = $this->frontend_model->get_doctor_info($doctor_id);
        }
        $page_data['page_name']   = 'appointment';
        $page_data['page_title']  = get_phrase('appointment');
        $page_data['departments'] = $this->frontend_model->get_departments();
        $page_data['recaptcha']   = json_decode($this->frontend_model->get_frontend_settings('recaptcha'));
        $this->load->view('frontend/' . $this->theme . '/index', $page_data);
    }
    
    function make_an_appointment()
    {
        $result = $this->frontend_model->set_an_appointment();
        if ($result == 'success') {
            $this->session->set_flashdata('success_message', get_phrase('appointment_requested_successfully') . '. ' . get_phrase('log_in_to_your_account_to_see_whether_it_is_approved'));
            redirect(site_url('home/appointment'), 'refresh');
        } else if ($result == 'captcha_failed') {
            $this->session->set_flashdata('error_message', get_phrase('captcha_verification_failed'));
            redirect(site_url('home/appointment'), 'refresh');
        } else if ($result == 'code_failed') {
            $this->session->set_flashdata('error_message', get_phrase('invalid_patient_code'));
            redirect(site_url('home/appointment'), 'refresh');
        } else if ($result == 'email_exists') {
            $this->session->set_flashdata('error_message', get_phrase('email_already_exists'));
            redirect(site_url('home/appointment'), 'refresh');
        }
    }
    
    function check_patient_code($code)
    {
        $query = $this->db->get_where('patient', array(
            'code' => $code
        ))->num_rows();
        
        echo $query == 1 ? 1 : 0;
    }
    
    function get_doctors_of_department($department_id)
    {
        if ($department_id != 0) {
            $page_data['department'] = $this->frontend_model->get_department_info($department_id);
        }
        $page_data['doctors'] = $this->frontend_model->get_doctors($department_id);
        $this->load->view('frontend/' . $this->theme . '/doctors_of_department', $page_data);
    }
    
    function blog()
    {
        $total_blogs = $this->db->get_where('frontend_blog', array(
            'published' => 1
        ))->num_rows();
        
        $config             = array();
        $config             = pagination($total_blogs, 9);
        $config['base_url'] = site_url('home/blog/');
        $this->pagination->initialize($config);
        
        $page_data['page_name']  = 'blog';
        $page_data['page_title'] = get_phrase('blog');
        $page_data['per_page']   = $config['per_page'];
        $this->load->view('frontend/' . $this->theme . '/index', $page_data);
    }
    
    function blog_details($blog_id = '')
    {
        $page_data['page_name']  = 'blog_details';
        $page_data['page_title'] = get_phrase('blog_details');
        $page_data['blog']       = $this->frontend_model->get_blog_details($blog_id);
        $this->load->view('frontend/' . $this->theme . '/index', $page_data);
    }
    
    function contact_us($param1 = '')
    {
        if ($param1 == 'contact') {
            $result = $this->frontend_model->send_contact_message();
            if ($result == true) {
                $this->session->set_flashdata('success_message', get_phrase('your_message_was_sent') . '.' . get_phrase('we_will_be_in_touch_with_you_shortly'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('captcha_validation_failed'));
            }
            redirect(site_url('home/contact_us'), 'refresh');
        }
        
        $page_data['page_name']  = 'contact_us';
        $page_data['page_title'] = get_phrase('contact_us');
        $page_data['recaptcha']  = json_decode($this->frontend_model->get_frontend_settings('recaptcha'));
        $this->load->view('frontend/' . $this->theme . '/index', $page_data);
    }

}