<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_frontend_settings($type) {
        $result = $this->db->get_where('frontend_settings', array(
            'type' => $type
        ))->row()->description;

        return $result;
    }

    function get_departments() {
        $this->db->order_by('name', 'asc');
        $result = $this->db->get('department')->result_array();

        return $result;
    }

    function get_department_info($department_id) {
        $result = $this->db->get_where('department', array(
            'department_id' => $department_id
        ))->row();

        return $result;
    }

    function get_department_facilities($department_id) {
        $result = $this->db->get_where('facility', array('department_id'=>$department_id))->result_array();
        return $result;
    }

    function add_department_facility($department_id) {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['department_id'] = $department_id;

        $this->db->insert('facility', $data);
    }

    function edit_department_facility($facility_id) {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');

        $this->db->where('facility_id', $facility_id);
        $this->db->update('facility', $data);
    }

    function delete_department_facility($facility_id) {
        $this->db->where('facility_id', $facility_id);
        $this->db->delete('facility');
    }

    function get_doctors($department_id = '') {
        if ($department_id != '') {
            $this->db->where('department_id', $department_id);
        }
        $this->db->order_by('name', 'asc');

        return $this->db->get('doctor')->result_array();
    }

    function get_doctor_info($doctor_id) {
        $result = $this->db->get_where('doctor', array(
            'doctor_id' => $doctor_id
        ))->row();

        return $result;
    }

    function get_random_doctors($limit = '') {
        $this->db->order_by('doctor_id', 'rand');
        if ($limit != '') {
            $this->db->limit($limit);
        }
        $result = $this->db->get('doctor')->result_array();

        return $result;
    }

    function get_blogs($published = '') {
        if ($published != '') {
            $this->db->where('published', 1);
        }
        $this->db->order_by('timestamp', 'desc');
        $result = $this->db->get('frontend_blog')->result_array();

        return $result;
    }

    function get_blog_details($blog_id) {
        $this->db->where('frontend_blog_id', $blog_id);
        $result = $this->db->get('frontend_blog')->row();

        return $result;
    }

    function get_user_from_type_id($user_type_id) {
        $user = explode('-', $user_type_id);
        $user_type = $user[0];
        $user_id   = $user[1];

        $result = $this->db->get_where($user_type, array(
            $user_type.'_id' => $user_id
        ))->row();

        return $result;
    }

    function update_slider() {
        $sliders = $this->get_frontend_settings('slider');
        $slider = json_decode($sliders);
        $slider_infos = array();

            for ($i=0; $i < count($slider); $i++) {
                $image = $slider[$i]->image;
                $data['title']  = $this->input->post('title_'.$i);
                $data['description']  = $this->input->post('description_'.$i);

                if ($_FILES['slider_image_'.$i]['name'] != '') {
                    $data['image']  = $_FILES['slider_image_'.$i]['name'];
                } else {
                    $data['image']  = $image;
                }

                array_push($slider_infos, $data);
                move_uploaded_file($_FILES['slider_image_'.$i]['tmp_name'], 'uploads/frontend/slider_images/'. $_FILES['slider_image_'.$i]['name']);
            }

        $images['description']  = json_encode($slider_infos);
        $this->db->where('type', 'slider');
        $this->db->update('frontend_settings', $images);
    }

    function update_welcome_section_content() {
        $welcome_section = $this->get_frontend_settings('homepage_welcome_section');
        $welcome = json_decode($welcome_section);
        $infos = array();

        $image                  = $welcome[0]->image;
        $data['title']          = $this->input->post('title');
        $data['description']    = $this->input->post('message');

        if ($_FILES['left_image']['name'] != '') {
            $data['image']  = $_FILES['left_image']['name'];
        } else {
            $data['image']  = $image;
        }

        array_push($infos, $data);
        move_uploaded_file($_FILES['left_image']['tmp_name'], 'uploads/frontend/'. $_FILES['left_image']['name']);

        $welcome_section_data['description']  = json_encode($infos);
        $this->db->where('type', 'homepage_welcome_section');
        $this->db->update('frontend_settings', $welcome_section_data);
    }

    function update_service_section() {
        $infos = array();
        $data['title']          = $this->input->post('title');
        $data['description']    = $this->input->post('description');

        array_push($infos, $data);

        $service_section['description']  = json_encode($infos);
        $this->db->where('type', 'service_section');
        $this->db->update('frontend_settings', $service_section);
    }

    function get_services() {
        $result = $this->db->get('service')->result_array();
        return $result;
    }

    function add_new_service() {
        $data['title']          =   $this->input->post('title');
        $data['description']    =   $this->input->post('description');

        $this->db->insert('service', $data);

        $service_id = $this->db->insert_id();
        move_uploaded_file($_FILES['icon']['tmp_name'], 'uploads/frontend/service_images/'. $service_id.'.png');
    }

    function update_service($service_id) {
        $data['title']          =   $this->input->post('title');
        $data['description']    =   $this->input->post('description');

        $this->db->where('service_id', $service_id);
        $this->db->update('service', $data);

        move_uploaded_file($_FILES['icon']['tmp_name'], 'uploads/frontend/service_images/'. $service_id.'.png');
    }

    function delete_service($service_id) {
        if (file_exists(base_url('uploads/frontend/service_images/'.$service_id.'.png'))) {
            unlink(base_url('uploads/frontend/service_images/'.$service_id.'.png'));
        }
        $this->db->where('service_id', $service_id);
        $this->db->delete('service');
    }

    function add_new_blog() {
        $data['title']             = $this->input->post('title');
        $data['short_description'] = $this->input->post('short_description');
        $data['blog_post']         = $this->input->post('blog_post');
        $posted_user               = $this->session->userdata('login_type');
        $posted_user_id            = $this->session->userdata('login_user_id');
        $data['posted_by']         = $posted_user.'-'.$posted_user_id;
        $data['timestamp']         = strtotime(date('Y-m-d'));
        if ($posted_user == 'admin') {
            $data['published']     = $this->input->post('published');
        }

        $this->db->insert('frontend_blog', $data);

        $blog_id = $this->db->insert_id();
        move_uploaded_file($_FILES['blog_image']['tmp_name'], 'uploads/frontend/blog_images/'. $blog_id.'.jpg');
    }

    function update_blog($blog_id) {
        $data['title']             = $this->input->post('title');
        $data['short_description'] = $this->input->post('short_description');
        $data['blog_post']         = $this->input->post('blog_post');
        if ($this->session->userdata('login_type') == 'admin') {
            $data['published']     = $this->input->post('published');
        }

        $this->db->where('frontend_blog_id', $blog_id);
        $this->db->update('frontend_blog', $data);
        move_uploaded_file($_FILES['blog_image']['tmp_name'], 'uploads/frontend/blog_images/'. $blog_id.'.jpg');
    }

    function delete_blog($blog_id) {
        if (file_exists('uploads/frontend/blog_images/'.$blog_id.'.jpg')) {
            unlink('uploads/frontend/blog_images/'.$blog_id.'.jpg');
        }
        $this->db->where('frontend_blog_id', $blog_id);
        $this->db->delete('frontend_blog');
    }

    function update_about_us() {
        $data['description']   = $this->input->post('about_us');
        $this->db->where('type', 'about_us');
        $this->db->update('frontend_settings', $data);
    }

    function update_frontend_settings() {
        $data['description']    =   $this->input->post('hospital_name');
        $this->db->where('type', 'hospital_name');
        $this->db->update('frontend_settings', $data);

        $data['description']    =   $this->input->post('emergency_contact');
        $this->db->where('type', 'emergency_contact');
        $this->db->update('frontend_settings', $data);

        $data['description']    =   $this->input->post('email');
        $this->db->where('type', 'email');
        $this->db->update('frontend_settings', $data);

        $data['description']    =   $this->input->post('copyright_text');
        $this->db->where('type', 'copyright_text');
        $this->db->update('frontend_settings', $data);

        $opening_hours = array();
        $opening_hours_data['monday_friday'] =  $this->input->post('monday_friday');
        $opening_hours_data['saturday'] =  $this->input->post('saturday');
        $opening_hours_data['sunday'] =  $this->input->post('sunday');
        array_push($opening_hours, $opening_hours_data);
        $data['description']    =   json_encode($opening_hours);
        $this->db->where('type', 'opening_hours');
        $this->db->update('frontend_settings', $data);

        $social_links = array();
        $social_links_data['facebook'] =  $this->input->post('facebook');
        $social_links_data['twitter'] =  $this->input->post('twitter');
        $social_links_data['google_plus'] =  $this->input->post('google_plus');
        $social_links_data['youtube'] =  $this->input->post('youtube');
        array_push($social_links, $social_links_data);
        $data['description']    =   json_encode($social_links);
        $this->db->where('type', 'social_links');
        $this->db->update('frontend_settings', $data);

        $recaptcha_keys = array();
        $recaptcha_data['site_key'] =   $this->input->post('site_key');
        $recaptcha_data['secret_key'] =   $this->input->post('secret_key');
        array_push($recaptcha_keys, $recaptcha_data);
        $data['description']    =   json_encode($recaptcha_keys);
        $this->db->where('type', 'recaptcha');
        $this->db->update('frontend_settings', $data);

    }

    function send_contact_message() {
        if ($this->validate_recaptcha_response() == true) {

            $data['name']      =   $this->input->post('name');
            $data['email']     =   $this->input->post('email');
            $data['phone']     =   $this->input->post('phone');
            $data['address']   =   $this->input->post('address');
            $data['message']   =   $this->input->post('message');
            $data['timestamp'] =   time();

            $this->db->insert('contact_email', $data);
            $this->email_model->contact_email($data['message'], $data['name'], $data['email'], $data['phone'], $data['address']);

            return true;
        } else {
            return false;
        }
    }

    function validate_recaptcha_response() {
        $recaptcha_keys = $this->get_frontend_settings('recaptcha');
        $captcha = json_decode($recaptcha_keys);

        if (isset($_POST["g-recaptcha-response"])) {
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = array(
                'secret' => $captcha[0]->secret_key,
                'response' => $_POST["g-recaptcha-response"]
            );
            $query = http_build_query($data);
            $options = array(
                'http' => array (
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                        "Content-Length: ".strlen($query)."\r\n".
                        "User-Agent:MyAgent/1.0\r\n",
                    'method' => 'POST',
                    'content' => $query
                )
            );
            $context  = stream_context_create($options);
            $verify = file_get_contents($url, false, $context);
            $captcha_success = json_decode($verify);
            if ($captcha_success->success == false) {
                return false;
            } else if ($captcha_success->success == true) {
                return true;
            }
        } else {
            return false;
        }
    }

    function get_contact_emails() {
        $this->db->order_by('timestamp', 'desc');
        $result = $this->db->get('contact_email')->result_array();
        return $result;
    }

    function set_an_appointment() {
        if ($this->validate_recaptcha_response() == true) {
            $patient_type = $this->input->post('patient_type');
            if ($patient_type == 'new') {
                // create a random password
                $new_password = substr( md5( rand(100000000,20000000000) ) , 0,7);

                // create an entry to patient table
                $data['code']  = substr(md5(rand(0, 1000000)), 0, 7);
                $data['name']  = $this->input->post('name');
                $data['email']  = $this->input->post('email');
                $data['phone']  = $this->input->post('phone');
                $data['password'] = sha1($new_password);

                $validation = email_validation_on_create($data['email']);
                if ($validation == 1) {
                    $returned_array = null_checking($data);
                    $this->db->insert('patient',$returned_array);
                    $patient_id = $this->db->insert_id();
                    $this->email_model->account_opening_email('patient', $data['email'], $new_password);
                }
                else {
                    return 'email_exists';
                }

            } else {
                $code = $this->input->post('code');
                $query = $this->db->get_where('patient', array('code' => $code));
                if ($query->num_rows() > 0) {
                    $patient_id = $query->row()->patient_id;
                } else {
                    return 'code_failed';
                }
            }
            // create the appointment
            $appointment_data['patient_id'] =   $patient_id;
            $appointment_data['doctor_id']  =   $this->input->post('doctor_id');
            $appointment_data['status']     =   'pending';
            $appointment_data['message']    =   $this->input->post('message');
            $appointment_data['timestamp']  =   strtotime($this->input->post('timestamp'));

            $this->db->insert('appointment', $appointment_data);
            return 'success';
        } else {
            return 'captcha_failed';
        }
    }

}
