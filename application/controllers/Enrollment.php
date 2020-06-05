<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enrollment extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Enrollment_Model");
    }


    public function evaluation(){

        $cID = $this->session->curriculum;

        $query = $this->Enrollment_Model->loadSubject($cID);
        $module['sData'] = $query;
        $query = $this->Enrollment_Model->loadSubjectCode();
        $module['scData'] = $query;

        $this->load->view('Enrollment/Evaluation', $module);
    }

    public function checklist(){
        $cID = $this->session->curriculum;
        $studentID = $this->session->student_id;

        $query = $this->Enrollment_Model->loadYearAndSemester($cID);
        $module['ysData'] = $query;
        $query = $this->Enrollment_Model->loadSubject($cID);
        $module['sData'] = $query;
        $query = $this->Enrollment_Model->loadSubjectCode();
        $module['scData'] = $query;
        $query = $this->Enrollment_Model->loadStudentGrade($studentID);
        $module['sgData'] = $query;


        $this->load->view('Enrollment/Checklist', $module);
    }

}