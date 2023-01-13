<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        $this->db->where($type . '_id', $type_id);
        $query = $this->db->get($type);
        $result = $query->result_array();
        foreach ($result as $row)
            return $row[$field];
        //return	$this->db->get_where($type,array($type.'_id'=>$type_id))->row()->$field;
    }



    // Create a new invoice.
    function create_invoice()
    {
        $data['title']              = $this->input->post('title');
        $data['invoice_number']     = $this->input->post('invoice_number');
        $data['patient_id']         = $this->input->post('patient_id');
        $data['creation_timestamp'] = $this->input->post('creation_timestamp');
        $data['due_timestamp']      = $this->input->post('due_timestamp');
        $data['vat_percentage']     = $this->input->post('vat_percentage');
        $data['discount_amount']    = $this->input->post('discount_amount');
        $data['status']             = $this->input->post('status');

        $invoice_entries            = array();
        $descriptions               = $this->input->post('entry_description');
        $amounts                    = $this->input->post('entry_amount');
        $number_of_entries          = sizeof($descriptions);

        for ($i = 0; $i < $number_of_entries; $i++)
        {
            if ($descriptions[$i] != "" && $amounts[$i] != "")
            {
                $new_entry          = array('description' => $descriptions[$i], 'amount' => $amounts[$i]);
                array_push($invoice_entries, $new_entry);
            }
        }
        $data['invoice_entries']    = json_encode($invoice_entries);
        $returned_array = null_checking($data);
        $this->db->insert('invoice', $returned_array);
    }

    function select_invoice_info()
    {
        return $this->db->get('invoice')->result_array();
    }

    function select_invoice_info_by_patient_id()
    {
        $patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('invoice', array('patient_id' => $patient_id))->result_array();
    }

    function update_invoice($invoice_id)
    {
        $data['title']              = $this->input->post('title');
        $data['invoice_number']     = $this->input->post('invoice_number');
        $data['patient_id']         = $this->input->post('patient_id');
        $data['creation_timestamp'] = $this->input->post('creation_timestamp');
        $data['due_timestamp']      = $this->input->post('due_timestamp');
        $data['vat_percentage']     = $this->input->post('vat_percentage');
        $data['discount_amount']    = $this->input->post('discount_amount');
        $data['status']             = $this->input->post('status');

        $invoice_entries            = array();
        $descriptions               = $this->input->post('entry_description');
        $amounts                    = $this->input->post('entry_amount');
        $number_of_entries          = sizeof($descriptions);

        for ($i = 0; $i < $number_of_entries; $i++)
        {
            if ($descriptions[$i] != "" && $amounts[$i] != "")
            {
                $new_entry          = array('description' => $descriptions[$i], 'amount' => $amounts[$i]);
                array_push($invoice_entries, $new_entry);
            }
        }
        $data['invoice_entries']    = json_encode($invoice_entries);
        $returned_array = null_checking($data);
        $this->db->where('invoice_id', $invoice_id);
        $this->db->update('invoice', $returned_array);
    }

    function delete_invoice($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice');
    }

    function calculate_invoice_total_amount($invoice_number)
    {
        $total_amount           = 0;
        $invoice                = $this->db->get_where('invoice', array('invoice_number' => $invoice_number))->result_array();
        foreach ($invoice as $row)
        {
            $invoice_entries    = json_decode($row['invoice_entries']);
            foreach ($invoice_entries as $invoice_entry)
                $total_amount  += $invoice_entry->amount;

            $vat_amount         = $total_amount * $row['vat_percentage'] / 100;
            $grand_total        = $total_amount + $vat_amount - $row['discount_amount'];
        }

        return $grand_total;
    }



    //////system settings//////
    function update_system_settings() {
        $data['description'] = $this->input->post('system_name');
        $returned_array = null_checking($data);
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('system_title');
        $returned_array = null_checking($data);
        $this->db->where('type', 'system_title');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('address');
        $returned_array = null_checking($data);
        $this->db->where('type', 'address');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('phone');
        $returned_array = null_checking($data);
        $this->db->where('type', 'phone');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('paypal_email');
        $returned_array = null_checking($data);
        $this->db->where('type', 'paypal_email');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('currency');
        $returned_array = null_checking($data);
        $this->db->where('type', 'currency');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('system_email');
        $returned_array = null_checking($data);
        $this->db->where('type', 'system_email');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('buyer');
        $returned_array = null_checking($data);
        $this->db->where('type', 'buyer');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('purchase_code');
        $returned_array = null_checking($data);
        $this->db->where('type', 'purchase_code');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('language');
        $returned_array = null_checking($data);
        $this->db->where('type', 'language');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('text_align');
        $returned_array = null_checking($data);
        $this->db->where('type', 'text_align');
        $this->db->update('settings', $returned_array);

        move_uploaded_file($_FILES['logo']['tmp_name'], 'uploads/logo.png');
    }

    // SMS settings.
    function update_sms_settings() {

        $data['description'] = $this->input->post('clickatell_user');
        $returned_array = null_checking($data);
        $this->db->where('type', 'clickatell_user');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('clickatell_password');
        $returned_array = null_checking($data);
        $this->db->where('type', 'clickatell_password');
        $this->db->update('settings', $returned_array);

        $data['description'] = $this->input->post('clickatell_api_id');
        $returned_array = null_checking($data);
        $this->db->where('type', 'clickatell_api_id');
        $this->db->update('settings', $returned_array);
    }

    /////creates log/////
    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    ////////BACKUP RESTORE/////////
    function create_backup($type) {
        $this->load->dbutil();


        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if ($type == 'all') {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => array($type));
            $file_name = 'backup_' . $type;
        }

        $backup = & $this->dbutil->backup(array_merge($options, $tables));


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    /////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
    function restore_backup() {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();


        $prefs = array(
            'filepath' => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );
        $restore = & $this->dbutil->restore($prefs);
        unlink($prefs['filepath']);
    }

    /////////DELETE DATA FROM TABLES///////////////
    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    function save_department_info()
    {
        $data['name'] 		   = $this->input->post('name');
        $data['description']   = $this->input->post('description');
        $returned_array        = null_checking($data);
        $this->db->insert('department',$returned_array);

        $department_id = $this->db->insert_id();
        move_uploaded_file($_FILES['dept_icon']['tmp_name'], 'uploads/frontend/department_images/'. $department_id.'.png');
    }

    function select_department_info()
    {
        return $this->db->get('department')->result_array();
    }

    function update_department_info($department_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['description'] 	= $this->input->post('description');
        $returned_array = null_checking($data);
        $this->db->where('department_id',$department_id);
        $this->db->update('department',$returned_array);
        move_uploaded_file($_FILES['dept_icon']['tmp_name'], 'uploads/frontend/department_images/'. $department_id.'.png');
    }

    function delete_department_info($department_id)
    {
        if (file_exists(base_url('uploads/frontend/department_images/'.$department_id.'.png'))) {
            unlink(base_url('uploads/frontend/department_images/'.$department_id.'.png'));
        }
        $this->db->where('department_id',$department_id);
        $this->db->delete('department');
    }

    function save_doctor_info()
    {
        $data['name'] 		      = $this->input->post('name');
        $data['email'] 		      = $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['address'] 	      = $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        $data['department_id'] 	= $this->input->post('department_id');
        $data['profile'] 	      = $this->input->post('profile');

        $social_links = array();
        $social_links_data['facebook'] =  $this->input->post('facebook');
        $social_links_data['twitter'] =  $this->input->post('twitter');
        $social_links_data['google_plus'] =  $this->input->post('google_plus');
        $social_links_data['linkedin'] =  $this->input->post('linkedin');
        array_push($social_links, $social_links_data);

        $data['social_links'] = json_encode($social_links);

        $returned_array = null_checking($data);
        $this->db->insert('doctor',$returned_array);

        $doctor_id  =   $this->db->insert_id();

		$this->email_model->account_opening_email('doctor', $data['email'], $this->input->post('password'));

        move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/doctor_image/' . $doctor_id . '.jpg');
    }

    function select_doctor_info()
    {
        return $this->db->get('doctor')->result_array();
    }

    function update_doctor_info($doctor_id)
    {
        $type = $this->session->userdata('login_type');
        $data['name'] 		      = $this->input->post('name');
        $data['email'] 		      = $this->input->post('email');
        $data['address'] 	      = $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        $data['department_id'] 	= $this->input->post('department_id');
        $data['profile'] 	      = $this->input->post('profile');

        $social_links = array();
        $social_links_data['facebook'] =  $this->input->post('facebook');
        $social_links_data['twitter'] =  $this->input->post('twitter');
        $social_links_data['google_plus'] =  $this->input->post('google_plus');
        $social_links_data['linkedin'] =  $this->input->post('linkedin');
        array_push($social_links, $social_links_data);

        $data['social_links'] = json_encode($social_links);

        $validation = email_validation_on_edit($data['email'], $doctor_id, 'doctor');
        if ($validation == 1){
          $returned_array = null_checking($data);
          $this->db->where('doctor_id',$doctor_id);
          $this->db->update('doctor',$returned_array);
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/doctor_image/' . $doctor_id . '.jpg');
          $this->session->set_flashdata('message', get_phrase('updated_successfuly'));
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
        }
    }

    function delete_doctor_info($doctor_id)
    {
        $this->db->where('doctor_id',$doctor_id);
        $this->db->delete('doctor');
    }


    function save_case_info()
    {
        $data = [];
        $type = $this->session->userdata('login_type');
        if (isset($_FILES['sickleave_attach']) && $_FILES['sickleave_attach']['name'] != '') {
            $filename = $_FILES['sickleave_attach']['name'];
            $temp = $_FILES['sickleave_attach']['tmp_name'];
            $file_type=$_FILES['sickleave_attach']['type'];

            $file_ext = pathinfo($_FILES['sickleave_attach']['name'], PATHINFO_EXTENSION);
            $doc1_file = 'sickleave_attach_'.md5('sickleave_attach').rand().'.'.$file_ext;
            $path = './uploads/patient_doc/'.$doc1_file;
            move_uploaded_file($temp,$path);
            $data['doc1']            = $doc1_file;
    
        }

        if (isset($_FILES['injury_report']) && $_FILES['injury_report']['name'] != ''){
                        
            $filename = $_FILES['injury_report']['name'];
            $temp = $_FILES['injury_report']['tmp_name'];
            $file_type=$_FILES['injury_report']['type'];
            

            $file_ext = pathinfo($_FILES['injury_report']['name'], PATHINFO_EXTENSION);
            $doc2_file = 'injury_report_'.md5('injury_report').rand().'.'.$file_ext;
            $path = './uploads/patient_doc/'.$doc2_file;
            move_uploaded_file($temp,$path);
            $data['doc2']            = $doc2_file;
    
        } 

        if (isset($_FILES['unit_letter']) && $_FILES['unit_letter']['name'] != ''){
                        
            $filename = $_FILES['unit_letter']['name'];
            $temp = $_FILES['unit_letter']['tmp_name'];
            $file_type=$_FILES['unit_letter']['type'];
            

            $file_ext = pathinfo($_FILES['unit_letter']['name'], PATHINFO_EXTENSION);
            $doc1_file = 'unit_letter_'.md5('unit_letter').rand().'.'.$file_ext;
            $path = './uploads/patient_doc/'.$doc1_file;
            move_uploaded_file($temp,$path);
            $data['doc3']            = $doc1_file;

        }

        if (isset($_FILES['medical_report']) && $_FILES['medical_report']['name'] != ''){
                    
            $filename = $_FILES['medical_report']['name'];
            $temp = $_FILES['medical_report']['tmp_name'];
            $file_type=$_FILES['medical_report']['type'];
            

            $file_ext = pathinfo($_FILES['medical_report']['name'], PATHINFO_EXTENSION);
            $doc3_file = 'medical_report_'.md5('medical_report').rand().'.'.$file_ext;
            $path = './uploads/patient_doc/'.$doc3_file;
            move_uploaded_file($temp,$path);
            $data['doc4']            = $doc3_file;

        } 

		  
        $data['work_type'] 		= $this->input->post('work_type');
        $data['unitname']          = $this->input->post('unitname');
        $data['name'] 		= $this->input->post('name');
        $data['sname'] 		= $this->input->post('sname');
        $data['tname'] 		= $this->input->post('tname');
        $data['lname'] 		= $this->input->post('lname');
        $data['position'] 		= $this->input->post('position');
        $data['emp_no']          = $this->input->post('Emp_NO');
        $data['civil_no']          = $this->input->post('Civil_No');
        $data['start_date']     = $this->input->post('start_date');
        $data['work_place']          = $this->input->post('work_place');
        $data['work_stay']          = $this->input->post('work_stay');
        $data['phone']          = $this->input->post('Phone_No');
        $data['direct_name'] = $this->input->post('Direct_director_name');
        $data['direct_number'] = $this->input->post('Director_Phone_No');
        $data['treat_number'] = $this->input->post('treatment_card_number');
        $data['injury_date']     = $this->input->post('injury_date');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['display_status']       = "New case";
        $data['created_by'] = $this->session->userdata('email');
        
        //echo "<pre>";print_r($data);die;
     
        $table = 'work_injury';
        if($this->input->post('tableName') == "work_suitability") {
            $table = 'work_suitability';
            $data['source'] = "work_suitability";
            
            if (isset($_FILES['sickleave_fullsalary']) && $_FILES['sickleave_fullsalary']['name'] != ''){
                                
                $filename = $_FILES['sickleave_fullsalary']['name'];
                $temp = $_FILES['sickleave_fullsalary']['tmp_name'];
                $file_type=$_FILES['sickleave_fullsalary']['type'];
            

                $file_ext = pathinfo($_FILES['sickleave_fullsalary']['name'], PATHINFO_EXTENSION);
                $doc4_file = 'sickleave_fullsalary_'.md5('sickleave_fullsalary').rand().'.'.$file_ext;
                $path = './uploads/patient_doc/'.$doc4_file;
                move_uploaded_file($temp,$path);
                $data['doc1']            = $doc4_file;

            } 

            if (isset($_FILES['Sickleave_three_quarters']) && $_FILES['Sickleave_three_quarters']['name'] != ''){
                            
                $filename = $_FILES['Sickleave_three_quarters']['name'];
                $temp = $_FILES['Sickleave_three_quarters']['tmp_name'];
                $file_type=$_FILES['Sickleave_three_quarters']['type'];
               
    
                $file_ext = pathinfo($_FILES['Sickleave_three_quarters']['name'], PATHINFO_EXTENSION);
                $doc4_file = 'Sickleave_three_quarters_'.md5('Sickleave_three_quarters').rand().'.'.$file_ext;
                $path = './uploads/patient_doc/'.$doc4_file;
                move_uploaded_file($temp,$path);
                $data['doc2']            = $doc4_file;
    
            } 

            if (isset($_FILES['Sickleave_half']) && $_FILES['Sickleave_half']['name'] != ''){
                            
                $filename = $_FILES['Sickleave_half']['name'];
                $temp = $_FILES['Sickleave_half']['tmp_name'];
                $file_type=$_FILES['Sickleave_half']['type'];
            

                $file_ext = pathinfo($_FILES['Sickleave_half']['name'], PATHINFO_EXTENSION);
                $doc4_file = 'Sickleave_half_'.md5('Sickleave_half').rand().'.'.$file_ext;
                $path = './uploads/patient_doc/'.$doc4_file;
                move_uploaded_file($temp,$path);
                $data['doc5']            = $doc4_file;

            } 

        }

        $returned_array = null_checking($data);
        if ($this->input->post('update') == "isUpdate") {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update($table, $returned_array);
        } else {
            $this->db->insert($table, $returned_array);
        }
        
      
    }
    
    
    function save_patient_info()
    {
        $type = $this->session->userdata('login_type');
         if (isset($_FILES['unit_letter']) && $_FILES['unit_letter']['name'] != ''){
                            
                            $filename = $_FILES['unit_letter']['name'];
                            $temp = $_FILES['unit_letter']['tmp_name'];
                            $file_type=$_FILES['unit_letter']['type'];
                           

                            $file_ext = pathinfo($_FILES['unit_letter']['name'], PATHINFO_EXTENSION);
                            $doc1_file = 'doc_1_'.md5('doc_1').rand().'.'.$file_ext;
                            $path = './uploads/patient_doc/'.$doc1_file;
                            move_uploaded_file($temp,$path);
                                                                    $data['doc_1']            = $doc1_file;
        
          }
               if (isset($_FILES['injury_report']) && $_FILES['injury_report']['name'] != ''){
                            
                            $filename = $_FILES['injury_report']['name'];
                            $temp = $_FILES['injury_report']['tmp_name'];
                            $file_type=$_FILES['injury_report']['type'];
                           

                            $file_ext = pathinfo($_FILES['injury_report']['name'], PATHINFO_EXTENSION);
                            $doc2_file = 'doc_2_'.md5('doc_2').rand().'.'.$file_ext;
                            $path = './uploads/patient_doc/'.$doc2_file;
                            move_uploaded_file($temp,$path);
        $data['doc_2']            = $doc2_file;
        
          } 
    
         if (isset($_FILES['medical_report']) && $_FILES['medical_report']['name'] != ''){
                            
                            $filename = $_FILES['medical_report']['name'];
                            $temp = $_FILES['medical_report']['tmp_name'];
                            $file_type=$_FILES['medical_report']['type'];
                           

                            $file_ext = pathinfo($_FILES['medical_report']['name'], PATHINFO_EXTENSION);
                            $doc3_file = 'doc_3_'.md5('doc_3').rand().'.'.$file_ext;
                            $path = './uploads/patient_doc/'.$doc3_file;
                            move_uploaded_file($temp,$path);
        $data['doc_3']            = $doc3_file;
        
          } 
    
        
        $data['code']       = substr(md5(rand(0, 1000000)), 0, 7);
 $data['Emp_NO']          = $this->input->post('Emp_NO');
 
        $data['name'] 		= $this->input->post('name');
		 $data['sname'] 		= $this->input->post('sname');
		 	 $data['tname'] 		= $this->input->post('tname');
			 	 $data['lname'] 		= $this->input->post('lname');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
		 $data['unitname']          = $this->input->post('unitname');
        $data['sex']            = $this->input->post('sex');
        $data['birth_date']     = strtotime($this->input->post('birth_date'));
        $data['age']            = $this->input->post('age');
        $data['blood_group'] 	= $this->input->post('blood_group');
        
        $validation = email_validation_on_create($data['email']);
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->insert('patient',$returned_array);
          $patient_id  =   $this->db->insert_id();
		  $this->email_model->account_opening_email('patient', $data['email'], $this->input->post('password'));
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/patient_image/' . $patient_id . '.jpg');
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
          redirect(site_url($type.'/patient'), 'refresh');
        }
    }
    
    function select_patient_info()
    {
        return $this->db->get('patient')->result_array();
    }

    function select_patient_info_by_patient_id( $patient_id = '' )
    {
        return $this->db->get_where('patient', array('patient_id' => $patient_id))->result_array();
    }












 function update_patient_info($patient_id)
    {
        $type             = $this->session->userdata('login_type');
        
        
        
        
        
         if (isset($_FILES['doc_1']) && $_FILES['doc_1']['name'] != ''){
                            
                            $filename = $_FILES['doc_1']['name'];
                            $temp = $_FILES['doc_1']['tmp_name'];
                            $file_type=$_FILES['doc_1']['type'];
                           

                            $file_ext = pathinfo($_FILES['doc_1']['name'], PATHINFO_EXTENSION);
                            $doc1_file = 'doc_1_'.md5('doc_1').rand().'.'.$file_ext;
                            $path = './uploads/patient_doc/'.$doc1_file;
                            move_uploaded_file($temp,$path);
                            $data['doc_1']            = $doc1_file;
          }
               if (isset($_FILES['doc_2']) && $_FILES['doc_2']['name'] != ''){
                            
                            $filename = $_FILES['doc_2']['name'];
                            $temp = $_FILES['doc_2']['tmp_name'];
                            $file_type=$_FILES['doc_2']['type'];
                           

                            $file_ext = pathinfo($_FILES['doc_2']['name'], PATHINFO_EXTENSION);
                            $doc2_file = 'doc_2_'.md5('doc_2').rand().'.'.$file_ext;
                            $path = './uploads/patient_doc/'.$doc2_file;
                            move_uploaded_file($temp,$path);
                            $data['doc_2']            = $doc2_file;
          } 
    
         if (isset($_FILES['doc_3']) && $_FILES['doc_3']['name'] != ''){
                            
                            $filename = $_FILES['doc_3']['name'];
                            $temp = $_FILES['doc_3']['tmp_name'];
                            $file_type=$_FILES['doc_3']['type'];
                           

                            $file_ext = pathinfo($_FILES['doc_3']['name'], PATHINFO_EXTENSION);
                            $doc3_file = 'doc_3_'.md5('doc_3').rand().'.'.$file_ext;
                            $path = './uploads/patient_doc/'.$doc3_file;
                            move_uploaded_file($temp,$path);
                            $data['doc_3']            = $doc3_file;
          } 
    
        
        

        
        
        
        
        $data['name'] 		= $this->input->post('name');
		       $data['sname'] 		= $this->input->post('sname');
			          $data['tname'] 		= $this->input->post('tname');
					         $data['lname'] 		= $this->input->post('lname');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
		       $data['unitname'] 		= $this->input->post('unitname');
        $data['phone']          = $this->input->post('phone');
        $data['sex']            = $this->input->post('sex');
        $data['birth_date']     = strtotime($this->input->post('birth_date'));
        $data['age']            = $this->input->post('age');
        $data['blood_group'] 	= $this->input->post('blood_group');
        $validation = email_validation_on_edit($data['email'], $patient_id, 'patient');
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->where('patient_id',$patient_id);
          $this->db->update('patient',$returned_array);
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/patient_image/' . $patient_id . '.jpg');
          $this->session->set_flashdata('message', get_phrase('updated_successfuly'));
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
        }

    }




    function delete_patient_info($patient_id)
    {
        $this->db->where('patient_id',$patient_id);
        $this->db->delete('patient');
    }

    function save_nurse_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');

        $validation = email_validation_on_create($data['email']);
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->insert('nurse',$returned_array);
          $nurse_id  =   $this->db->insert_id();
		  $this->email_model->account_opening_email('nurse', $data['email'], $this->input->post('password'));
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/nurse_image/' . $nurse_id . '.jpg');
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
          redirect(site_url('admin/nurse'), 'refresh');
        }

    }

    function select_nurse_info()
    {
        return $this->db->get('nurse')->result_array();
    }

    function update_nurse_info($nurse_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');

        $validation = email_validation_on_edit($data['email'], $nurse_id, 'nurse');
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->where('nurse_id',$nurse_id);
          $this->db->update('nurse',$returned_array);
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/nurse_image/' . $nurse_id . '.jpg');
          $this->session->set_flashdata('message', get_phrase('updated_successfuly'));
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
        }

    }

    function delete_nurse_info($nurse_id)
    {
        $this->db->where('nurse_id',$nurse_id);
        $this->db->delete('nurse');
    }

    function save_pharmacist_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');

        $validation = email_validation_on_create($data['email']);
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->insert('pharmacist',$returned_array);
          $pharmacist_id  =   $this->db->insert_id();
		  $this->email_model->account_opening_email('pharmacist', $data['email'], $this->input->post('password'));
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/pharmacist_image/' . $pharmacist_id . '.jpg');
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
          redirect(site_url('admin/pharmacist'), 'refresh');
        }
    }

    function select_pharmacist_info()
    {
        return $this->db->get('pharmacist')->result_array();
    }

    function update_pharmacist_info($pharmacist_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');

        $validation = email_validation_on_edit($data['email'], $pharmacist_id, 'pharmacist');
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->where('pharmacist_id',$pharmacist_id);
          $this->db->update('pharmacist',$returned_array);
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/pharmacist_image/' . $pharmacist_id . '.jpg');
          $this->session->set_flashdata('message', get_phrase('updated_successfuly'));
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
        }

    }

    function delete_pharmacist_info($pharmacist_id)
    {
        $this->db->where('pharmacist_id',$pharmacist_id);
        $this->db->delete('pharmacist');
    }

    function save_laboratorist_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');

        $validation = email_validation_on_create($data['email']);
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->insert('laboratorist',$returned_array);
          $laboratorist_id  =   $this->db->insert_id();
		  $this->email_model->account_opening_email('laboratorist', $data['email'], $this->input->post('password'));
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/laboratorist_image/' . $laboratorist_id . '.jpg');
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
          redirect(site_url('admin/laboratorist'), 'refresh');
        }

    }

    function select_laboratorist_info()
    {
        return $this->db->get('laboratorist')->result_array();
    }

    function update_laboratorist_info($laboratorist_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        $validation = email_validation_on_edit($data['email'], $laboratorist_id, 'laboratorist');
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->where('laboratorist_id',$laboratorist_id);
          $this->db->update('laboratorist',$returned_array);
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/laboratorist_image/' . $laboratorist_id . '.jpg');
          $this->session->set_flashdata('message', get_phrase('updated_successfuly'));
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
        }

    }

    function delete_laboratorist_info($laboratorist_id)
    {
        $this->db->where('laboratorist_id',$laboratorist_id);
        $this->db->delete('laboratorist');
    }

    function save_accountant_info()
    {
        $type = $this->session->userdata('login_type');
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');

        $validation = email_validation_on_create($data['email']);
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->insert('accountant',$returned_array);
          $accountant_id  =   $this->db->insert_id();
		  $this->email_model->account_opening_email('accountant', $data['email'], $this->input->post('password'));
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/accountant_image/' . $accountant_id . '.jpg');
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
          redirect(site_url($type.'/accountant'), 'refresh');
        }

    }

    function select_accountant_info()
    {
        return $this->db->get('accountant')->result_array();
    }

    function update_accountant_info($accountant_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');

        $validation = email_validation_on_edit($data['email'], $accountant_id, 'accountant');
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->where('accountant_id',$accountant_id);
          $this->db->update('accountant',$returned_array);
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/accountant_image/' . $accountant_id . '.jpg');
          $this->session->set_flashdata('message', get_phrase('updated_successfuly'));
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
        }

    }

    function delete_accountant_info($accountant_id)
    {
        $this->db->where('accountant_id',$accountant_id);
        $this->db->delete('accountant');
    }

    function save_receptionist_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');

        $validation = email_validation_on_create($data['email']);
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->insert('receptionist',$returned_array);
          $receptionist_id  =   $this->db->insert_id();
		  $this->email_model->account_opening_email('receptionist', $data['email'], $this->input->post('password'));
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/receptionist_image/' . $receptionist_id . '.jpg');
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
          redirect(site_url('admin/receptionist'), 'refresh');
        }

    }

    function select_receptionist_info()
    {
        return $this->db->get('receptionist')->result_array();
    }

    function update_receptionist_info($receptionist_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']    = $this->input->post('phone');

        $validation = email_validation_on_edit($data['email'], $receptionist_id, 'receptionist');
        if ($validation == 1) {
          $returned_array = null_checking($data);
          $this->db->where('receptionist_id',$receptionist_id);
          $this->db->update('receptionist',$returned_array);
          move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/receptionist_image/' . $receptionist_id . '.jpg');
          $this->session->set_flashdata('message', get_phrase('updated_successfuly'));
        }
        else{
          $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
        }

    }

    function delete_receptionist_info($receptionist_id)
    {
        $this->db->where('receptionist_id',$receptionist_id);
        $this->db->delete('receptionist');
    }

    function save_bed_allotment_info()
    {
        $data['bed_id']                 = $this->input->post('bed_id');
        $data['patient_id'] 		    = $this->input->post('patient_id');
        $data['allotment_timestamp'] 	= strtotime($this->input->post('allotment_timestamp'));
        $data['discharge_timestamp']    = strtotime($this->input->post('discharge_timestamp'));
        $returned_array = null_checking($data);
        $this->db->insert('bed_allotment',$returned_array);
    }

    function select_bed_allotment_info()
    {
        return $this->db->get('bed_allotment')->result_array();
    }

    function update_bed_allotment_info($bed_allotment_id)
    {
        $data['bed_id']                 = $this->input->post('bed_id');
        $data['patient_id'] 		= $this->input->post('patient_id');
        $data['allotment_timestamp'] 	= strtotime($this->input->post('allotment_timestamp'));
        $data['discharge_timestamp']    = strtotime($this->input->post('discharge_timestamp'));
        $returned_array = null_checking($data);
        $this->db->where('bed_allotment_id',$bed_allotment_id);
        $this->db->update('bed_allotment',$returned_array);
    }

    function delete_bed_allotment_info($bed_allotment_id)
    {
        $this->db->where('bed_allotment_id',$bed_allotment_id);
        $this->db->delete('bed_allotment');
    }

    function select_blood_bank_info()
    {
        return $this->db->get('blood_bank')->result_array();
    }

    function update_blood_bank_info($blood_group_id)
    {
        $data['status']    = $this->input->post('status');

        $returned_array = null_checking($data);
        $this->db->where('blood_group_id',$blood_group_id);
        $this->db->update('blood_bank',$returned_array);
    }

    function save_report_info()
    {
        $data['type'] 		= $this->input->post('type');
        $data['description']    = $this->input->post('description');
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['patient_id']     = $this->input->post('patient_id');

        $login_type             = $this->session->userdata('login_type');
        if($login_type=='nurse')
            $data['doctor_id']  = $this->input->post('doctor_id');
        else $data['doctor_id'] = $this->session->userdata('login_user_id');

        // Multiple File Upload
        $file_names = array();
        for ($i = 0; $i < count($_FILES['userfile']['name']); $i++)
            if($_FILES['userfile']['name'][$i] != '') {
                array_push($file_names, $_FILES['userfile']['name'][$i]);
                move_uploaded_file($_FILES['userfile']['tmp_name'][$i], 'uploads/report_file/' . $_FILES['userfile']['name'][$i]);
            }

        if(!empty($file_names))
            $data['files']  = json_encode($file_names);

        $returned_array = null_checking($data);
        $this->db->insert('report',$returned_array);
    }

    function select_report_info()
    {
        return $this->db->get('report')->result_array();
    }

    function update_report_info($report_id)
    {
        $data['type'] 		= $this->input->post('type');
        $data['description']    = $this->input->post('description');
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['patient_id']     = $this->input->post('patient_id');

        $login_type             = $this->session->userdata('login_type');
        if($login_type=='nurse')
            $data['doctor_id']  = $this->input->post('doctor_id');
        else $data['doctor_id'] = $this->session->userdata('login_user_id');

        $returned_array = null_checking($data);
        $this->db->where('report_id',$report_id);
        $this->db->update('report',$returned_array);
    }

    function delete_report_info($report_id)
    {
        $files = $this->db->get_where('report', array('report_id' => $report_id))->row()->files;

        if($files != '') {
            $files = json_decode($files);

            foreach ($files as $file_name)
                unlink(base_url('uploads/report_file/' . $file_name));
        }

        $this->db->where('report_id',$report_id);
        $this->db->delete('report');
    }

    function delete_report_file($report_id = '', $file_serial = '')
    {
        $files = $this->db->get_where('report', array('report_id' => $report_id))->row()->files;

        $counter    = 1;
        $file_names = array();
        $files      = json_decode($files);
        foreach ($files as $file_name) {
            if($counter == $file_serial)
                unlink(base_url('uploads/report_file/' . $file_name));
            else
                array_push($file_names, $file_name);
            $counter++;
        }

        $data['files']  = json_encode($file_names);

        $this->db->where('report_id', $report_id);
        $this->db->update('report', $data);
    }

    function save_bed_info()
    {
        $data['bed_number']     = $this->input->post('bed_number');
        $data['type'] 		= $this->input->post('type');
        $data['description']    = $this->input->post('description');
        $returned_array = null_checking($data);
        $this->db->insert('bed',$returned_array);
    }

    function select_bed_info()
    {
        return $this->db->get('bed')->result_array();
    }

    function update_bed_info($bed_id)
    {
        $data['bed_number']     = $this->input->post('bed_number');
        $data['type'] 		= $this->input->post('type');
        $data['description']    = $this->input->post('description');
        $returned_array = null_checking($data);
        $this->db->where('bed_id',$bed_id);
        $this->db->update('bed',$returned_array);
    }

    function delete_bed_info($bed_id)
    {
        $this->db->where('bed_id',$bed_id);
        $this->db->delete('bed');
    }

    function save_blood_donor_info()
    {
        $data['name']                       = $this->input->post('name');
        $data['email']                      = $this->input->post('email');
        $data['address']                    = $this->input->post('address');
        $data['phone']                      = $this->input->post('phone');
        $data['sex']                        = $this->input->post('sex');
        $data['age']                        = $this->input->post('age');
        $data['blood_group']                = $this->input->post('blood_group');
        $data['last_donation_timestamp']    = strtotime($this->input->post('last_donation_timestamp'));

        $returned_array = null_checking($data);
        $this->db->insert('blood_donor',$returned_array);
    }

    function select_blood_donor_info()
    {
        return $this->db->get('blood_donor')->result_array();
    }

    function update_blood_donor_info($blood_donor_id)
    {
        $data['name']                       = $this->input->post('name');
        $data['email']                      = $this->input->post('email');
        $data['address']                    = $this->input->post('address');
        $data['phone']                      = $this->input->post('phone');
        $data['sex']                        = $this->input->post('sex');
        $data['age']                        = $this->input->post('age');
        $data['blood_group']                = $this->input->post('blood_group');
        $data['last_donation_timestamp']    = strtotime($this->input->post('last_donation_timestamp'));

        $returned_array = null_checking($data);
        $this->db->where('blood_donor_id',$blood_donor_id);
        $this->db->update('blood_donor',$returned_array);
    }

    function delete_blood_donor_info($blood_donor_id)
    {
        $this->db->where('blood_donor_id',$blood_donor_id);
        $this->db->delete('blood_donor');
    }

    function save_medicine_category_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['description']    = $this->input->post('description');
        $returned_array = null_checking($data);
        $this->db->insert('medicine_category',$returned_array);
    }

    function select_medicine_category_info()
    {
        return $this->db->get('medicine_category')->result_array();
    }

    function update_medicine_category_info($medicine_category_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['description'] 	= $this->input->post('description');
        $returned_array = null_checking($data);
        $this->db->where('medicine_category_id',$medicine_category_id);
        $this->db->update('medicine_category',$returned_array);
    }

    function delete_medicine_category_info($medicine_category_id)
    {
        $this->db->where('medicine_category_id',$medicine_category_id);
        $this->db->delete('medicine_category');
    }

    function save_medicine_info()
    {
        $data['name']                   = $this->input->post('name');
        $data['medicine_category_id']   = $this->input->post('medicine_category_id');
        $data['description']            = $this->input->post('description');
        $data['price']                  = $this->input->post('price');
        $data['manufacturing_company']  = $this->input->post('manufacturing_company');
        $data['total_quantity']         = $this->input->post('total_quantity');
        $data['sold_quantity']          = 0;
        $returned_array = null_checking($data);
        $this->db->insert('medicine',$returned_array);
    }

    function select_medicine_info()
    {
        return $this->db->get('medicine')->result_array();
    }

    function select_work_injury_byid($id) {
        $this->db->where('id', $id);
        return $this->db->get('work_injury')->result();
    }

    function select_work_suitability_byid($id) {
        $this->db->where('id', $id);
        return $this->db->get('work_suitability')->result();
    }


    function select_awaiting_info($status = "", $active = "", $searchVal = "", $displayStatus = "")
    {
        if($status){
            $this->db->where('status', $status);
        }
        if($active){
            $this->db->where('appointment_date is NOT NULL');
        }
        if($displayStatus){
            $this->db->where('display_status', $displayStatus);
        }
        $this->db->where('is_deleted', 0);
        if($searchVal){
            $this->db->group_start();
            $this->db->where('emp_no', $searchVal);
            $this->db->or_where('phone', $searchVal);
            $this->db->or_where('civil_no', $searchVal);
            $this->db->group_end();
        }
        if($this->session->userdata('is_normal')) {
            $this->db->join('normal', 'normal.email = work_injury.created_by', 'RIGHT');
        }
        return $this->db->get('work_injury')->result_array();
    }

    function select_suitable_awaiting_info($status = "", $active = "", $searchVal = "", $displayStatus = "")
    {
        if($status){
            $this->db->where('status', $status);
        }
        if($active){
            $this->db->where('appointment_date is NOT NULL');
        }
        if($displayStatus){
            $this->db->where('display_status', $displayStatus);
        }
        $this->db->where('is_deleted', 0);
        if($searchVal){
            $this->db->group_start();
            $this->db->where('emp_no', $searchVal);
            $this->db->or_where('phone', $searchVal);
            $this->db->or_where('civil_no', $searchVal);
            $this->db->group_end();
        }
        if($this->session->userdata('is_normal')) {
            $this->db->join('normal', 'normal.email = work_suitability.created_by');
        }
        return $this->db->get('work_suitability')->result_array();
    }


    function update_medicine_info($medicine_id)
    {
        $data['name']                   = $this->input->post('name');
        $data['medicine_category_id']   = $this->input->post('medicine_category_id');
        $data['description']            = $this->input->post('description');
        $data['price']                  = $this->input->post('price');
        $data['manufacturing_company']  = $this->input->post('manufacturing_company');
        $data['total_quantity']         = $this->input->post('total_quantity');
        $returned_array = null_checking($data);
        $this->db->where('medicine_id',$medicine_id);
        $this->db->update('medicine',$returned_array);
    }

    function delete_medicine_info($medicine_id)
    {
        $this->db->where('medicine_id',$medicine_id);
        $this->db->delete('medicine');
    }

    function save_appointment_info()
    {
        $data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['status']     = 'approved';
        $data['patient_id'] = $this->input->post('patient_id');

        if($this->session->userdata('login_type') == 'doctor')
            $data['doctor_id']  = $this->session->userdata('login_user_id');
        else
            $data['doctor_id']  = $this->input->post('doctor_id');

        $returned_array = null_checking($data);
        $this->db->insert('appointment',$returned_array);

        // Notify patient with sms.
        $notify = $this->input->post('notify');
        if($notify != '') {
            $patient_name   =   $this->db->get_where('patient',
                                array('patient_id' => $data['patient_id']))->row()->name;
            $doctor_name    =   $this->db->get_where('doctor',
                                array('doctor_id' => $data['doctor_id']))->row()->name;
            $date           =   date('l, d F Y', $data['timestamp']);
            $time           =   date('g:i a', $data['timestamp']);
            $message        =   $patient_name . ', you have an appointment with doctor ' . $doctor_name . ' on ' . $date . ' at ' . $time . '.';
            $receiver_phone =   $this->db->get_where('patient',
                                array('patient_id' => $data['patient_id']))->row()->phone;

            $this->sms_model->send_sms($message, $receiver_phone);
        }
    }

    function save_requested_appointment_info()
    {
        $data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['doctor_id']  = $this->input->post('doctor_id');
        $data['patient_id'] = $this->session->userdata('login_user_id');
        $data['status']     = 'pending';

        $returned_array = null_checking($data);
        $this->db->insert('appointment',$returned_array);
    }

    function select_appointment_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');

        $this->db->order_by('timestamp' , 'desc');
        $this->db->where('doctor_id' , $doctor_id);
        $this->db->where('status' , 'approved');

        return $this->db->get('appointment')->result_array();
    }
    
    function get_all_comments($out){
      $data = [];
      foreach($out as $row){
        $source = !empty($row['source']) ? $row['source'] : "work_injury";
        $this->db->where('table_name' , $source);
        $this->db->where('map_id' , $row['id']);
        $data = array_merge($data, $this->db->get('work_comments')->result_array());
      }
      return $data;
    }

    function select_appointment_info_by_patient_id()
    {
        $patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('appointment', array('patient_id' => $patient_id, 'status' => 'approved'))->result_array();
    }

    function select_appointment_info($doctor_id = '', $start_timestamp = '', $end_timestamp = '')
    {
        $response = array();
        if($doctor_id == 'all') {
            $this->db->order_by('doctor_id', 'asc');
            $this->db->order_by('timestamp', 'desc');
            $appointments = $this->db->get_where('appointment', array('status' => 'approved'))->result_array();
            foreach ($appointments as $row) {
                if($row['timestamp'] >= $start_timestamp && $row['timestamp'] <= $end_timestamp)
                    array_push ($response, $row);
            }
        }
        else {
            $this->db->order_by('timestamp', 'desc');
            $appointments = $this->db->get_where('appointment', array('doctor_id' => $doctor_id, 'status' => 'approved'))->result_array();
            foreach ($appointments as $row) {
                if($row['timestamp'] >= $start_timestamp && $row['timestamp'] <= $end_timestamp)
                    array_push ($response, $row);
            }
        }
        return $response;
    }

    function select_pending_appointment_info_by_patient_id()
    {
        $patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('appointment', array('patient_id' => $patient_id, 'status' => 'pending'))->result_array();
    }

    function select_requested_appointment_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('appointment', array('doctor_id' => $doctor_id, 'status' => 'pending'))->result_array();
    }

    function select_requested_appointment_info()
    {
        $this->db->order_by('doctor_id', 'asc');
        return $this->db->get_where('appointment', array('status' => 'pending'))->result_array();
    }

    function select_patient_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');

        //$this->db->group_by('patient_id');
        return $this->db->get_where('appointment', array(
            'doctor_id' => $doctor_id, 'status' => 'approved'))->result_array();
    }

    function select_appointments_between_loggedin_patient_and_doctor()
    {
        $patient_id = $this->session->userdata('login_user_id');

        $this->db->group_by('doctor_id');
        return $this->db->get_where('appointment', array('patient_id' => $patient_id, 'status' => 'approved'))->result_array();
    }

    function update_appointment_info($appointment_id)
    {
        $data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['patient_id'] = $this->input->post('patient_id');
        $returned_array = null_checking($data);
        $this->db->where('appointment_id',$appointment_id);
        $this->db->update('appointment',$returned_array);

        // Notify patient with sms.
        $notify = $this->input->post('notify');
        if($notify != '') {
            $doctor_id      =   $this->session->userdata('login_user_id');
            $patient_name   =   $this->db->get_where('patient',
                                array('patient_id' => $data['patient_id']))->row()->name;
            $doctor_name    =   $this->db->get_where('doctor',
                                array('doctor_id' => $doctor_id))->row()->name;
            $date           =   date('l, d F Y', $data['timestamp']);
            $time           =   date('g:i a', $data['timestamp']);
            $message        =   $patient_name . ', your appointment with doctor ' . $doctor_name . ' has been updated to ' . $date . ' at ' . $time . '.';
            $receiver_phone =   $this->db->get_where('patient',
                                array('patient_id' => $data['patient_id']))->row()->phone;

            $this->sms_model->send_sms($message, $receiver_phone);
        }
    }

    function approve_appointment_info($appointment_id)
    {
        $data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['status']     = 'approved';

        if($this->session->userdata('login_type') == 'receptionist')
            $data['doctor_id'] = $this->input->post('doctor_id');

        $returned_array = null_checking($data);
        $this->db->where('appointment_id',$appointment_id);
        $this->db->update('appointment',$returned_array);

        // Notify patient with sms.
        $notify = $this->input->post('notify');
        if($notify != '') {
            $doctor_id      =   $this->db->get_where('appointment',
                                array('appointment_id' => $appointment_id))->row()->doctor_id;
            $patient_id     =   $this->db->get_where('appointment',
                                array('appointment_id' => $appointment_id))->row()->patient_id;
            $patient_name   =   $this->db->get_where('patient',
                                array('patient_id' => $patient_id))->row()->name;
            $doctor_name    =   $this->db->get_where('doctor',
                                array('doctor_id' => $doctor_id))->row()->name;
            $date           =   date('l, d F Y', $data['timestamp']);
            $time           =   date('g:i a', $data['timestamp']);
            $message        =   $patient_name . ', your requested appointment with doctor ' . $doctor_name . ' on ' . $date . ' at ' . $time . ' has been approved.';
            $receiver_phone =   $this->db->get_where('patient',
                                array('patient_id' => $patient_id))->row()->phone;

            $this->sms_model->send_sms($message, $receiver_phone);
        }
    }

    function delete_appointment_info($appointment_id)
    {
        $this->db->where('appointment_id',$appointment_id);
        $this->db->delete('appointment');
    }

    function save_prescription_info()
    {
        $data['timestamp']      = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['patient_id']     = $this->input->post('patient_id');
        $data['case_history']   = $this->input->post('case_history');
        $data['medication']     = $this->input->post('medication');
        $data['note']           = $this->input->post('note');
        $data['doctor_id']      = $this->session->userdata('login_user_id');
        $returned_array = null_checking($data);
        $this->db->insert('prescription',$returned_array);
    }

    function select_prescription_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prescription', array('doctor_id' => $doctor_id))->result_array();
    }

    function select_medication_history( $patient_id = '' )
    {
        return $this->db->get_where('prescription', array('patient_id' => $patient_id))->result_array();
    }

    function select_prescription_info_by_patient_id()
    {
        $patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prescription', array('patient_id' => $patient_id))->result_array();
    }

    function update_prescription_info($prescription_id)
    {
        $data['timestamp']      = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['patient_id']     = $this->input->post('patient_id');
        $data['case_history']   = $this->input->post('case_history');
        $data['medication']     = $this->input->post('medication');
        $data['note']           = $this->input->post('note');
        $data['doctor_id']      = $this->session->userdata('login_user_id');
        $returned_array = null_checking($data);
        $this->db->where('prescription_id',$prescription_id);
        $this->db->update('prescription',$returned_array);
    }

    function delete_prescription_info($prescription_id)
    {
        $this->db->where('prescription_id',$prescription_id);
        $this->db->delete('prescription');
    }

    function save_diagnosis_report_info()
    {
        $data['timestamp']          = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['report_type']        = $this->input->post('report_type');
        $data['file_name']          = $_FILES["file_name"]["name"];
        $data['document_type']      = $this->input->post('document_type');
        $data['description']        = $this->input->post('description');
        $data['prescription_id']    = $this->input->post('prescription_id');

        $this->db->insert('diagnosis_report',$data);

        $diagnosis_report_id        = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], 'uploads/diagnosis_report/' . $_FILES["file_name"]["name"]);
    }

    function select_diagnosis_report_info()
    {
        return $this->db->get('diagnosis_report')->result_array();
    }

    function delete_diagnosis_report_info($diagnosis_report_id)
    {
        $this->db->where('diagnosis_report_id',$diagnosis_report_id);
        $this->db->delete('diagnosis_report');
    }

    function save_notice_info()
    {
        $data['title']              = $this->input->post('title');
        $data['description']        = $this->input->post('description');
        if($this->input->post('start_timestamp') != '')
            $data['start_timestamp']    = strtotime($this->input->post('start_timestamp'));
        else
            $data['start_timestamp']    = '';
        if($this->input->post('end_timestamp') != '')
            $data['end_timestamp']      = strtotime($this->input->post('end_timestamp'));
        else
            $data['end_timestamp']      = $data['start_timestamp'];

        $returned_array = null_checking($data);
        $this->db->insert('notice',$returned_array);
    }

    function select_notice_info()
    {
        return $this->db->get('notice')->result_array();
    }

    function update_notice_info($notice_id)
    {
        $data['title']              = $this->input->post('title');
        $data['description']        = $this->input->post('description');
        if($this->input->post('start_timestamp') != '')
            $data['start_timestamp']    = strtotime($this->input->post('start_timestamp'));
        else
            $data['start_timestamp']    = '';
        if($this->input->post('end_timestamp') != '')
            $data['end_timestamp']      = strtotime($this->input->post('end_timestamp'));
        else
            $data['end_timestamp']      = $data['start_timestamp'];

        $returned_array = null_checking($data);
        $this->db->where('notice_id',$notice_id);
        $this->db->update('notice',$returned_array);
    }

    function delete_notice_info($notice_id)
    {
        $this->db->where('notice_id',$notice_id);
        $this->db->delete('notice');
    }

    function curl_request($code = '') {

        $product_code = $code;

        $personal_token = "FkA9UyDiQT0YiKwYLK3ghyFNRVV9SeUn";
        $url = "https://api.envato.com/v3/market/author/sale?code=".$product_code;
        $curl = curl_init($url);

        //setting the header for the rest of the api
        $bearer   = 'bearer ' . $personal_token;
        $header   = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:'.$product_code.'.json';
        $ch_verify = curl_init( $verify_url . '?code=' . $product_code );

        curl_setopt( $ch_verify, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch_verify, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch_verify, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch_verify, CURLOPT_CONNECTTIMEOUT, 5 );
        curl_setopt( $ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec( $ch_verify );
        curl_close( $ch_verify );

        $response = json_decode($cinit_verify_data, true);

        if (count($response['verify-purchase']) > 0) {
            return true;
        } else {
            return false;
        }

    }

    ////////private message//////
    function send_new_private_message() {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));

        $reciever   = $this->input->post('reciever');
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();
        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['reciever']            = $reciever;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);

        return $message_thread_code;
    }

    function send_reply_message($message_thread_code) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);
    }

    function mark_thread_messages_read($message_thread_code) {
        // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }

    //CREATE MEDICINE SALE
    function create_medicine_sale() {
        $data['patient_id']     = $this->input->post('patient_id');
        $data['total_amount']   = $this->input->post('total_amount');
        $medicines              = array();
        $medicine_ids           = $this->input->post('medicine_id');
        $medicine_quantities    = $this->input->post('medicine_quantity');
        $number_of_entries      = sizeof($medicine_ids);

        for($i = 0; $i < $number_of_entries; $i++)
        {
            if($medicine_ids[$i] != "" && $medicine_quantities[$i] != "")
            {
                $new_entry = array('medicine_id' => $medicine_ids[$i], 'quantity' => $medicine_quantities[$i]);
                array_push($medicines, $new_entry);

                // UPDATE MEDICINE INVENTORY
                $sold_quantity = $this->db->get_where('medicine', array('medicine_id' => $medicine_ids[$i]))->row()->sold_quantity;

                $data2['sold_quantity'] = $sold_quantity + $medicine_quantities[$i];

                $this->db->update('medicine', $data2, array('medicine_id' => $medicine_ids[$i]));
            }
        }
        $data['medicines']     = json_encode($medicines);
        $returned_array = null_checking($data);
        $this->db->insert('medicine_sale', $returned_array);
    }

    //upload pathology_report
    function save_pathology_report($param1 = ""){
      if (!file_exists('uploads/pathology_reports/')) {
        $oldmask = umask(0);  // helpful when used in linux server
        mkdir ('uploads/pathology_reports/', 0777);
      }

      $data['code']       = substr(md5(rand(0, 1000000000)), 0, 10);
      $data['patient_id'] = $param1;
      $data['test_name']  = $this->input->post('pathology_test_name');
      $file_name = $_FILES['pathology_report']['name'];
      $extension = pathinfo($file_name, PATHINFO_EXTENSION);
      $modified_file_name = $data['code'].'.'.$extension;
      move_uploaded_file($_FILES['pathology_report']['tmp_name'], 'uploads/pathology_reports/'. $modified_file_name);
      $data['pathology_report'] = $modified_file_name;
      $this->db->insert('pathology_report', $data);
    }
}
