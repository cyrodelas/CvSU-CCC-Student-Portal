<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enrollment extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Enrollment_Model");
    }


    public function process(){

        $currentUser = $this->session->student_id;

        $query = $this->Enrollment_Model->CheckEnrollmentProcess($currentUser);

        if($query['status'] == 'PRE-EVALUATION'){
            $currentUser = $this->session->student_id;
            $currentSY = $this->session->schoolyear;
            $currentSem = $this->session->semester;

            $query = $this->Enrollment_Model->loadStudentGrades($currentSY, $currentSem, $currentUser);
            $module['gradesData'] = $query;
            $query = $this->Enrollment_Model->getYearLevelandSection($currentSY, $currentSem, $currentUser);
            $module['YLSData'] = $query;
            $query = $this->Enrollment_Model->courselist();
            $module['courseData'] = $query;

            $module['SY'] = $currentSY;
            $module['Sem'] = $currentSem;

            $this->load->view('Enrollment/Evaluation', $module);
        }

        if($query['status'] == 'EVALUATION'){
            $this->load->view('Enrollment/EvalPending');
        }

    }

    public function evaluation(){

        $result = $this->Enrollment_Model->addEvaluationRequest();

        if($result['result']==true){
            $updateProcess = $this->Enrollment_Model->updateEvalProcess();
            $this->session->set_flashdata("success", "Course added to the curriculum.");
        } else {
            $this->session->set_flashdata("error", "Error on saving data to the database.");
        }
        redirect("enrollment/process", "refresh");

    }





    //For Department Head

    public function evaluation_list(){
        $query = $this->Enrollment_Model->loadEvalList();
        $module['evalData'] = $query;

        $this->load->view('Enrollment/EvaluationList', $module);
    }


    public function checklist($studentID){

        $gCurriculum = $this->Enrollment_Model->getCurriculumID($studentID);
        $cID = $gCurriculum['curriculumID'];
        $module['studentNum'] = $gCurriculum['studentNumber'];
        $module['studentName'] = $gCurriculum['firstName'] ." ". $gCurriculum['lastName'];
        $module['course'] = $gCurriculum['course'];


        $query = $this->Enrollment_Model->courselist();
        $module['courseData'] = $query;
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