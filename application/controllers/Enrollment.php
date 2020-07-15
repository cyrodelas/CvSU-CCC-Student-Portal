<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enrollment extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Enrollment_Model");
        date_default_timezone_set('Asia/Manila');
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

        if($query['status'] == 'POST-EVALUATION') {
            $this->load->view('Enrollment/Schedule');
        }

    }

    public function evaluation(){

        $result = $this->Enrollment_Model->addEvaluationRequest();

        if($result['result']==true){
            $studentNumber = $this->input->post('studentNumber', true);
            $process ='EVALUATION';
            $updateProcess = $this->Enrollment_Model->updateEvalProcess($studentNumber, $process);
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

    public function evaluate_student(){

        $studentID = $this->input->post('studentNumber', true);

        $module['studentNumber'] = $this->input->post('studentNumber', true);
        $module['studentName'] = $this->input->post('studentName', true);
        $module['course'] = $this->input->post('course', true);
        $module['major'] = $this->input->post('major', true);
        $module['yearLevel'] = $this->input->post('yearLevel', true);
        $module['section'] = $this->input->post('section', true);
        $module['schoolyear'] = $this->input->post('schoolyear', true);
        $module['semester'] = $this->input->post('semester', true);
        $module['status'] = $this->input->post('status', true);

        $semester = $this->input->post('semester', true);
        $schoolyear = $this->input->post('schoolyear', true);
        $course = $this->input->post('course', true);
        $major = $this->input->post('major', true);
        $yearlevel = $this->input->post('yearLevel', true);
        $section = $this->input->post('section', true);

        if($semester=='FIRST'){
            $nextSchoolYear = $schoolyear;
            $nextSemester = 'SECOND';

            if(strlen($course)==3){
                $nextCourse = substr($course, 1, 2);
                $nextMajor = substr($major, 0, 1);
                $nextYearlevel = $yearlevel;
                $nextSection = $section;
                $YCS = $nextCourse.$nextYearlevel.$nextSection.$nextMajor;
            } elseif(strlen($course)==5){
                $nextCourse = substr($course, 1, 4);
                $nextYearlevel = $yearlevel;
                $nextSection = $section;
                $YCS = $nextCourse.$nextYearlevel.$nextSection;
            } else {
                $nextCourse = substr($course, 2, 2);
                $nextYearlevel = $yearlevel;
                $nextSection = $section;
                $YCS = $nextCourse.$nextYearlevel.$nextSection;
            }


        } else {
            $nextSchoolYear = (intval(substr($schoolyear, 0, 4)) + 1) . "-" . (intval(substr($schoolyear, 5, 4)) + 1);
            $nextSemester = 'FIRST';

            if(strlen($course)==3){
                $nextCourse = substr($course, 1, 2);
                $nextMajor = substr($major, 0, 1);
                $nextYearlevel = intval($yearlevel) + 1;
                $nextSection = $section;
                $YCS = $nextCourse.$nextYearlevel.$nextSection.$nextMajor;
            } elseif(strlen($course)==5){
                $nextCourse = substr($course, 1, 4);
                $nextYearlevel = intval($yearlevel) + 1;
                $nextSection = $section;
                $YCS = $nextCourse.$nextYearlevel.$nextSection;
            } else {
                $nextCourse = substr($course, 2, 2);
                $nextYearlevel = intval($yearlevel) + 1;
                $nextSection = $section;
                $YCS = $nextCourse.$nextYearlevel.$nextSection;
            }

        }



        $query = $this->Enrollment_Model->courselist();
        $module['courseData'] = $query;

        $gCurriculum = $this->Enrollment_Model->getCurriculumID($studentID);
        $cID = $gCurriculum['curriculumID'];

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

        $query = $this->Enrollment_Model->loadSchedCodes($nextSchoolYear, $nextSemester, $YCS);
        $module['sccData'] = $query;


        $this->load->view('Enrollment/EvaluationForm', $module);
    }


    public function evaluateStudent(){
        $result = $this->Enrollment_Model->addEvaluationData();

        if($result['result']==true){
            $studentNumber = $this->input->post('studentNumber', true);
            $process ='POST-EVALUATION';
            $updateProcess = $this->Enrollment_Model->updateEvalProcess($studentNumber, $process);
            $deleteOnList = $this->Enrollment_Model->deleteEvaluationListData($studentNumber);

            $this->session->set_flashdata("success", "Course added to the curriculum.");
        } else {
            $this->session->set_flashdata("error", "Error on saving data to the database.");
        }
        redirect("enrollment/evaluation_list", "refresh");

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

    public function getSubjectInfo(){
        $subjectCode = $this->input->post('subjectcode');
        $result = $this->Enrollment_Model->getSubjectData($subjectCode);
        echo json_encode($result);
    }

}