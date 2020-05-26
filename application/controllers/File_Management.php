<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_Management extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("File_Management_Model");
    }


    public function index(){
        $this->load->view('Masterfile/Login');
    }

    public function validate_login(){

        $this->form_validation->set_rules('username','Username','trim|required|max_length[9]');
        $this->form_validation->set_rules('password','Password','trim|required|max_length[16]');

        if($this->form_validation->run() == TRUE){

            $result = $this->File_Management_Model->validate_login();

            if($result['success']==TRUE){

                $account_data = array(
                    'employee_fn'        => $result['student_fn'],
                    'employee_mn'        => $result['student_mn'],
                    'employee_ln' 	     => $result['student_ln'],
                    'employee_dept' 	 => $result['student_course'],
                    'employee_des'       => $result['student_image'],
                    'logged_in' 	     => TRUE
                );

                $this->session->set_userdata($account_data);

                $this->session->set_flashdata("success","login sucess");

               // redirect("file_management/subject_information","refresh");


            }else{

               // $this->session->set_flashdata("error","invalid username/password.");
            }

            if($result['success']==FALSE){
               // redirect("File_Management","refresh");
            }


        }
        else{
            $this->session->set_flashdata("error","invalid username/password.");
            redirect("File_Management","refresh");
        }

    }


    public function curriculum(){
        $query = $this->File_Management_Model->loadCurriculum();
        $module['cData'] = $query;

        $this->load->view('Masterfile/Curriculum/Curriculum', $module);
    }

    public function programs($sy){
        $query = $this->File_Management_Model->loadPrograms($sy);
        $module['pData'] = $query;
        $query = $this->File_Management_Model->loadCourse();
        $module['csData'] = $query;

        $module['schoolyear'] = $sy;

        $this->load->view('Masterfile/Curriculum/Programs', $module);
    }

    public function getCourseMajor(){
        $major_id = $this->input->post('coursecode',TRUE);
        $query = $this->File_Management_Model->getCourseMajorData($major_id);
        echo json_encode($query);
    }

    public function add_course(){

        $sYear = $this->input->post('schoolyear', true);

        $result = $this->File_Management_Model->add_course_data();

        if($result['result']==true){

            $this->session->set_flashdata("success", "Course added to the curriculum.");

        } else {
            $this->session->set_flashdata("error", "Error on saving data to the database.");
        }

        redirect("file_management/programs/".$sYear, "refresh");
    }




    public function subject($sy, $cID){
        $module['schoolyear'] = $sy;
        $query = $this->File_Management_Model->getCourseName($cID);
        $module['course'] = $query['course_name'];
        $module['code'] = $query['code_name'];
        $module['major'] = $query['major_name'];
        $module['cID'] = $cID;


        $query = $this->File_Management_Model->loadYearAndSemester($cID);
        $module['ysData'] = $query;
        $query = $this->File_Management_Model->loadSubject($cID);
        $module['sData'] = $query;
        $query = $this->File_Management_Model->loadSubjectCode();
        $module['scData'] = $query;


        $this->load->view('Masterfile/Curriculum/Subject', $module);
    }

    public function add_subject(){

        $curID = $this->input->post('curriculumnid', true);
        $sYear = $this->input->post('schoolyear', true);

        $result = $this->File_Management_Model->add_subject_data();

        if($result['result']==true){

            $this->session->set_flashdata("success", "Subject added to the curriculum list.");

        } else {
            $this->session->set_flashdata("error", "Error on saving data to the database.");
        }

        redirect("file_management/subject/".$sYear."/".$curID, "refresh");
    }



    public function subject_information(){
        $query = $this->File_Management_Model->subject_information_data();
        $module['siData'] = $query;

        $this->load->view('Masterfile/Subject/Information', $module);
    }

    public function add_subject_information(){

        $result = $this->File_Management_Model->subject_information_add();

        if($result['result']==true){
            $this->session->set_flashdata("success", "Subject added to the subject list.");
        } else {
            $this->session->set_flashdata("error", "Error on saving data to the database.");
        }

        redirect("file_management/subject_information", "refresh");
    }

    public function edit_subject_information(){
        $result = $this->File_Management_Model->subject_information_edit();

        if($result['result']==true){
            $this->session->set_flashdata("success", "Subject information successfully updated.");
        } else {
            $this->session->set_flashdata("error", "Error on updating data to the database.");
        }

        redirect("file_management/subject_information", "refresh");
    }

    public function delete_subject_information($delete_value){
        $result = $this->File_Management_Model->subject_information_delete($delete_value);

        if($result['result']==true){
            $this->session->set_flashdata("success", "Subject added to the subject list.");
        } else {
            $this->session->set_flashdata("error", "Error on saving data to the database.");
        }

        redirect("file_management/subject_information", "refresh");
    }


    public function pre_requisites($subjectCode){
        $query = $this->File_Management_Model->subject_information_data();
        $module['siData'] = $query;
        $query = $this->File_Management_Model->pre_requisites_data($subjectCode);
        $module['prData'] = $query;

        $this->load->view('Masterfile/Subject/PreRequisites', $module);
    }

    public function getSubName(){
        $subjectcode = $this->input->post('subjectcode',TRUE);
        $query = $this->File_Management_Model->getSubNameData($subjectcode);
        echo json_encode($query);
    }

    public function updatePreRequisite(){
        $sCode = $this->input->post('subjectcode', true);
        $result = $this->File_Management_Model->updatePreRequisiteData();

        if($result['result']==true){
            $this->session->set_flashdata("success", "Pre-requisites successfully updated.");
        } else {
            $this->session->set_flashdata("error", "Error on updating data to the database.");
        }

        redirect("file_management/pre_requisites/".$sCode, "refresh");
    }

}