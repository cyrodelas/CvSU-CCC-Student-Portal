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

    public function schedule(){


        $this->load->view('Student/Schedule');
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

    public function color($i){
        $color = array("#06214c","#ff8000","#00b33c","#002db3","#cc8800","#0000cc","#803300","#00802b","#990099","#34d26");
        return $color[$i];
    }

    public function getSchedule(){
        $currentStudent = $this->session->student_id;
        $schoolyear = $this->session->schoolyear;
        $semester = $this->session->semester;
        $fresult = array();
        $query = $this->Student_Model->getScheduleData($currentStudent, $schoolyear, $semester);
        $result = json_decode(json_encode($query), true);
        $i1=0;
        foreach($result as $res){
            $subj = array();
            $subj['title'] = $res['subjectcode'];
            $subj['subjtitle'] =$res['subjectTitle'];
            $subj['allday'] = false;
            $subj['color'] = $this->color($i1);
            $subj['schedules'] = array();
            if($res['day1'] != 'N/A'){
                $s1['room'] = $res['room1'];
                $s1['instructor'] = $res['instructor'];
                $s1['day'] = $res['day1'];
                $s1['start'] = $res['timein1'].':00';
                $s1['end'] = $res['timeout1'].':00';
                array_push($subj['schedules'],$s1);
            }
            if($res['day2'] != 'N/A'){
                $s1['room'] = $res['room2'];
                $s1['instructor'] = $res['instructor'];
                $s1['day'] = $res['day2'];
                $s1['start'] = $res['timein2'].':00';
                $s1['end'] = $res['timeout2'].':00';
                array_push($subj['schedules'],$s1);
            }
            if($res['day3'] != 'N/A'){
                $s1['room'] = $res['room3'];
                $s1['instructor'] = $res['instructor'];
                $s1['day'] = $res['day3'];
                $s1['start'] = $res['timein3'].':00';
                $s1['end'] = $res['timeout3'].':00';
                array_push($subj['schedules'],$s1);
            }
            if($res['day4'] != 'N/A'){
                $s1['room'] = $res['room4'];
                $s1['instructor'] = $res['instructor'];
                $s1['day'] = $res['day4'];
                $s1['start'] = $res['timein4'].':00';
                $s1['end'] = $res['timeout4'].':00';
                array_push($subj['schedules'],$s1);
            }
            array_push($fresult,$subj);

            $i1 ++;
        }
        echo json_encode($fresult);
    }




}
