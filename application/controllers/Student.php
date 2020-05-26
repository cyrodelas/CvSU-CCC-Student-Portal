<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Student_Model");
    }
    
    public function index(){
        $this->load->view('Student/Login');
    }

    public function validate_login(){

        $this->form_validation->set_rules('username','Username','trim|required|max_length[9]');
        $this->form_validation->set_rules('password','Password','trim|required|max_length[16]');

        if($this->form_validation->run() == TRUE){

            $result = $this->Student_Model->validate_login();

            if($result['success']==TRUE){

                $account_data = array(
                    'student_id'         => $result['student_id'],
                    'student_fn'         => $result['student_fn'],
                    'student_mn'         => $result['student_mn'],
                    'student_ln' 	     => $result['student_ln'],
                    'student_course' 	 => $result['student_course'],
                    'student_image'      => $result['student_image'],
                    'schoolyear'         => $result['schoolyear'],
                    'semester'           => $result['semester'],
                    'logged_in' 	     => TRUE
                );

                $this->session->set_userdata($account_data);

                $this->session->set_flashdata("success","login sucess");

                redirect("student/dashboard","refresh");


            }else{

                $this->session->set_flashdata("error","invalid username/password.");
            }

            if($result['success']==FALSE){
                redirect("Student","refresh");
            }


        }
        else{
            $this->session->set_flashdata("error","invalid username/password.");
            redirect("Student","refresh");
        }

    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect("Student","refresh");
    }


    public function dashboard(){
        $this->load->view('Student/Dashboard');
    }

    public function information(){
        $currentUser = $this->session->student_id;

        $query = $this->Student_Model->loadStudentInfo($currentUser);
        $module['sfData'] = $query;

        $query = $this->Student_Model->loadStudentEnroll($currentUser);
        $module['siData'] = $query;

        $this->load->view('Student/Information', $module);
    }

    public function subject(){
        $query = $this->Student_Model->loadEnrolledSubject();
        $module['subjData'] = $query;

        $this->load->view('Student/Subject', $module);
    }

    public function grades(){
        $currentUser = $this->session->student_id;
        $currentSY = $this->session->schoolyear;
        $currentSem = $this->session->semester;

        $query = $this->Student_Model->loadStudentSY($currentUser);
        $module['syData'] = $query;

        $query = $this->Student_Model->loadStudentSem($currentUser);
        $module['semData'] = $query;

        $query = $this->Student_Model->loadStudentGrades($currentSY, $currentSem, $currentUser);
        $module['gradesData'] = $query;
        $module['SY'] = $currentSY;
        $module['Sem'] = $currentSem;

        $this->load->view('Student/Grades', $module);
    }


    public function view_grades(){

        $currentUser = $this->session->student_id;
        $currentSY = $this->input->post('schoolyear', true);
        $currentSem = $this->input->post('semester', true);

        $query = $this->Student_Model->loadStudentSY($currentUser);
        $module['syData'] = $query;

        $query = $this->Student_Model->loadStudentGrades($currentSY, $currentSem, $currentUser);
        $module['gradesData'] = $query;
        $module['SY'] = $currentSY;
        $module['Sem'] = $currentSem;

        $this->load->view('Student/Grades', $module);

    }

    public function getSemester(){
        $currentStudent = $this->session->student_id;
        $schoolyear = $this->input->post('schoolyear',TRUE);
        $query = $this->Student_Model->getSemesterData($currentStudent, $schoolyear);
        echo json_encode($query);
    }




}
