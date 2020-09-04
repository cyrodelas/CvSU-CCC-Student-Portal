<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enrollment extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Enrollment_Model");
        $this->load->model("Student_Model");
        date_default_timezone_set('Asia/Manila');
    }


    public function process(){

        $currentUser = $this->session->student_id;

        $query = $this->Enrollment_Model->CheckEnrollmentProcess($currentUser);

        $module['status'] = $query['student'];
        $module['standingYear'] = $query['standingYear'];

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

        } elseif($query['status'] == 'EVALUATION'){
            $this->load->view('Enrollment/EvalPending');

        } elseif($query['status'] == 'MANUAL-EVALUATION'){

            $currentUser = $this->session->student_id;
            $databaseType = $this->session->dbtype;
            $query = $this->Enrollment_Model->displayManualEvaluation($currentUser);
            $module['meData'] = $query;
            $query = $this->Enrollment_Model->displayManualSubjectDetail($databaseType);
            $module['sdData'] = $query;

            $this->load->view('Enrollment/Manual', $module);


        }elseif($query['status'] == 'POST-EVALUATION') {
            $currentUser = $this->session->student_id;
            $currentSem = $this->session->semester;

            if($currentSem=='FIRST') {
                $nextSchoolyear = $this->session->schoolyear;
                $nextSemester = 'SECOND';
            } else {
                $nextSchoolyear = (intval(substr($this->session->schoolyear, 0, 4)) + 1) . "-" . (intval(substr($this->session->schoolyear, 5, 4)) + 1);
                $nextSemester = 'FIRST';
            }

            $query = $this->Enrollment_Model->getYearLevelandSectionEval($nextSchoolyear, $nextSemester, $currentUser);
            $module['YLSData'] = $query;
            $query = $this->Enrollment_Model->getSubjectlistEvaluation($nextSchoolyear, $nextSemester, $currentUser);
            $module['seData'] = $query;

            $this->load->view('Enrollment/Schedule', $module);

        }elseif($query['status'] == 'CHEDBILLING'){

            $query = $this->Student_Model->loadStudentInfo($currentUser);
            $module['sfData'] = $query;

            $query = $this->Student_Model->loadProvinceData();
            $module['provData'] = $query;

            $query = $this->Student_Model->loadReligionData();
            $module['religionData'] = $query;

            $query = $this->Enrollment_Model->courselist();
            $module['courseData'] = $query;

            $this->load->view('Enrollment/Chedbilling', $module);

        }elseif($query['status'] == 'ASSESSMENT') {

            $currentUser = $this->session->student_id;
            $currentSem = $this->session->semester;

            if($currentSem=='FIRST') {
                $nextSchoolyear = $this->session->schoolyear;
                $nextSemester = 'SECOND';
            } else {
                $nextSchoolyear = (intval(substr($this->session->schoolyear, 0, 4)) + 1) . "-" . (intval(substr($this->session->schoolyear, 5, 4)) + 1);
                $nextSemester = 'FIRST';
            }

            $query = $this->Enrollment_Model->getYearLevelandSectionEval($nextSchoolyear, $nextSemester, $currentUser);
            $module['YLSData'] = $query;
            $query = $this->Enrollment_Model->getSubjectlistEvaluation($nextSchoolyear, $nextSemester, $currentUser);
            $module['seData'] = $query;

            $query = $this->Enrollment_Model->getScholarship();
            $module['schData'] = $query;

            if($this->session->dbtype == 1){
                $schoolyear = $nextSchoolyear;
                $semester = $nextSemester;
                $course = $this->session->student_course;

                if($course == 'BEE'){ $course = 'BECED';}

                $yearAdmitted = $this->session->yearAdmitted;
                $semAdmitted = $this->session->semesterAdmitted;
            } else {
                $schoolyear = $nextSchoolyear;
                $semester = $nextSemester;
                $course = $this->session->student_course;

                if($course == 'BEE'){ $course = 'BECED';}

                $yearAdmitted = $this->session->yearAdmitted .'-'. (intval($this->session->yearAdmitted) + 1);
                $semAdmitted = $this->session->semesterAdmitted;
            }

            if(strlen($this->session->yearAdmitted)==4){
                $newYearAdmitted = $this->session->yearAdmitted. '-' . (intval($this->session->yearAdmitted) + 1);
            } else{
                $newYearAdmitted = $this->session->yearAdmitted;
            }

            $module['yearAdmitted']= $yearAdmitted;
            $module['semAdmitted']= $semAdmitted;

            $query = $this->Enrollment_Model->getFeeList($schoolyear, $semester, $course, $newYearAdmitted, $semAdmitted);
            $module['feeData'] = $query;

            $this->load->view('Enrollment/Assessment', $module);

        }elseif($query['status'] == 'REGISTRY') {
            $currentUser = $this->session->student_id;
            $currentSem = $this->session->semester;

            if($currentSem=='FIRST') {
                $nextSchoolyear = $this->session->schoolyear;
                $nextSemester = 'SECOND';
            } else {
                $nextSchoolyear = (intval(substr($this->session->schoolyear, 0, 4)) + 1) . "-" . (intval(substr($this->session->schoolyear, 5, 4)) + 1);
                $nextSemester = 'FIRST';
            }

            $query = $this->Enrollment_Model->getYearLevelandSectionEval($nextSchoolyear, $nextSemester, $currentUser);
            $module['YLSData'] = $query;
            $query = $this->Enrollment_Model->getSubjectlistEvaluation($nextSchoolyear, $nextSemester, $currentUser);
            $module['seData'] = $query;

            $query = $this->Enrollment_Model->getScholarship();
            $module['schData'] = $query;

            if($this->session->dbtype == 1){
                $schoolyear = $nextSchoolyear;
                $semester = $nextSemester;
                $course = $this->session->student_course;
                $yearAdmitted = $this->session->yearAdmitted;
                $semAdmitted = $this->session->semesterAdmitted;
            } else {
                $schoolyear = $nextSchoolyear;
                $semester = $nextSemester;
                $course = $this->session->student_course;
                $yearAdmitted = $this->session->yearAdmitted .'-'. (intval($this->session->yearAdmitted) + 1);
                $semAdmitted = $this->session->semesterAdmitted;
            }

            $module['yearAdmitted']= $yearAdmitted;
            $module['semAdmitted']= $semAdmitted;

            $query = $this->Enrollment_Model->getFeeList($schoolyear, $semester, $course, $yearAdmitted, $semAdmitted);
            $module['feeData'] = $query;

            $this->load->view('Enrollment/Registry', $module);
        }

    }

    public function evaluation(){

        $result = $this->Enrollment_Model->addEvaluationRequest();

        if($result['result']==true){
            $studentNumber = $this->input->post('studentNumber', true);
            $process = 'EVALUATION';
            $status = 'N/A';
            $standingYear = 0;
            $updateProcess = $this->Enrollment_Model->updateEvalProcess($studentNumber, $process, $status, $standingYear);
            $this->session->set_flashdata("success", "Student evaluation successfully sent.");
        } else {
            $this->session->set_flashdata("error", "Error on evaluating the student.");
        }
        redirect("enrollment/process", "refresh");

    }


    public function getScholarship(){
        $scholarship_id = $this->input->post('scholarshipID',TRUE);
        $query = $this->Enrollment_Model->getScholarshipData($scholarship_id);
        echo json_encode($query);
    }





    //For Department Head

    public function evaluation_list(){

        $query = $this->Enrollment_Model->loadEvalList();
        $module['evalData'] = $query;

        $module['standingYear'] = 0;

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
        $module['standingYear'] = $this->input->post('standingYear', true);
        $module['dbtype'] = $this->input->post('dbtype', true);


        $semester = $this->input->post('semester', true);
        $schoolyear = $this->input->post('schoolyear', true);
        $course = $this->input->post('course', true);
        $major = $this->input->post('major', true);
        $yearlevel = $this->input->post('yearLevel', true);
        $section = $this->input->post('section', true);
        $status = $this->input->post('status', true);
        $dbtype = $this->input->post('dbtype', true);

        $UpdateEvaluatedStatus = $this->Enrollment_Model->changeEvaluatedStatus($studentID);

        if($semester=='FIRST'){
            $nextSchoolYear = $schoolyear;
            $nextSemester = 'SECOND';

            if(strlen($course)==3){
                $nextCourse = substr($course, 1, 2);
                $nextMajor = substr($major, 3, 1);;
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
                $nextMajor = substr($major, 3, 1);;
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

        $module['YCS'] = $YCS;

        $gCurriculum = $this->Enrollment_Model->getCurriculumIDv2($studentID, $dbtype);
        $cID = $gCurriculum['curriculumID'];

        if($status == "REGULAR"){
            $query = $this->Enrollment_Model->courselistv2($dbtype);
            $module['courseData'] = $query;
            $query = $this->Enrollment_Model->loadYearAndSemesterv2($cID, $dbtype);
            $module['ysData'] = $query;
            $query = $this->Enrollment_Model->loadSubjectv2($cID, $dbtype);
            $module['sData'] = $query;
            $query = $this->Enrollment_Model->loadSubjectCodev2($dbtype);
            $module['scData'] = $query;
            $query = $this->Enrollment_Model->loadStudentGradev2($studentID, $dbtype);
            $module['sgData'] = $query;

            $query = $this->Enrollment_Model->loadSchedCodesv2($nextSchoolYear, $nextSemester, $YCS, $dbtype);
            $module['sccData'] = $query;
        } else{
            $query = $this->Enrollment_Model->courselistv2($dbtype);
            $module['courseData'] = $query;
            $query = $this->Enrollment_Model->loadYearAndSemesterv2($cID, $dbtype);
            $module['ysData'] = $query;

            $module['sData'] = '';
            $module['scData'] = '';
            $module['sgData'] = '';
            $module['sccData'] = '';
        }

        $this->load->view('Enrollment/EvaluationForm', $module);
    }

    public function getSectionSchedule(){
        $cCode = $this->input->post('coursecode',TRUE);
        $mID = $this->input->post('major',TRUE);
        $yl = $this->input->post('yl',TRUE);
        $query = $this->Enrollment_Model->getSectionDataSchedule($cCode, $mID, $yl);
        echo json_encode($query);
    }

    public function getScheduleRegular(){

        $schoolyear = $this->input->post('schoolyear',TRUE);
        $semester = $this->input->post('semester',TRUE);

        $coursename = $this->input->post('coursecode',TRUE);
        $major= $this->input->post('major',TRUE);
        $yearlevel = $this->input->post('yearlevel',TRUE);
        $yearsection = $this->input->post('section',TRUE);
        $dbtype = $this->input->post('dbtype');

        if(strlen($coursename)==3){

            $nextCourse = substr($coursename, 1, 2);
            $nextMajor = substr($major, 0, 1);
            $nextYearlevel = intval($yearlevel);
            $nextSection = $yearsection;

            $section = $nextCourse.$nextYearlevel.$nextSection.$nextMajor;

        } elseif(strlen($coursename)==5){

            $nextCourse = substr($coursename, 1, 4);
            $nextYearlevel = intval($yearlevel);
            $nextSection = $yearsection;

            $section = $nextCourse.$nextYearlevel.$nextSection;

        } else {

            $nextCourse = substr($coursename, 2, 2);
            $nextYearlevel = intval($yearlevel);
            $nextSection = $yearsection;

            $section = $nextCourse.$nextYearlevel.$nextSection;
        }

        $query = $this->Enrollment_Model->getScheduleRegularData($schoolyear, $semester, $section, $dbtype);
        echo json_encode($query);
    }

    public function evaluateStudent(){

        $dbtype = $this->input->post('databaseType');
        $status = $this->input->post('status');

        if($status=='REGULAR'){
            $result = $this->Enrollment_Model->addEvaluationData($dbtype);

            if($result['result']==true){
                $studentNumber = $this->input->post('studentNumber', true);
                $process ='POST-EVALUATION';
                $status = $this->input->post('status', true);
                $standingYear = $this->input->post('standingYear', true);
                $updateProcess = $this->Enrollment_Model->updateEvalProcess($studentNumber, $process, $status, $standingYear);
                $deleteOnList = $this->Enrollment_Model->deleteEvaluationListData($studentNumber);

                $this->session->set_flashdata("success", "Student evaluated successfully.");
            } else {
                $this->session->set_flashdata("error", "Evaluation failed.");
            }
        } else {

            $result = $this->Enrollment_Model->addEvaluationManual();

            if($result['result']==true){
                $studentNumber = $this->input->post('studentNumber', true);
                $process ='MANUAL-EVALUATION';
                $status = $this->input->post('status', true);
                $standingYear = $this->input->post('standingYear', true);
                $updateProcess = $this->Enrollment_Model->updateEvalProcess($studentNumber, $process, $status, $standingYear);
                $deleteOnList = $this->Enrollment_Model->deleteEvaluationListData($studentNumber);

                $this->session->set_flashdata("success", "Student evaluated successfully.");
            } else {
                $this->session->set_flashdata("error", "Evaluation failed.");
            }

        }


        redirect("student/evaluation", "refresh");

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

    public function eChecklist($studentID, $dbType){

        $gCurriculum = $this->Enrollment_Model->getCurriculumIDv2($studentID, $dbType);
        $cID = $gCurriculum['curriculumID'];
        $module['studentNum'] = $gCurriculum['studentNumber'];
        $module['studentName'] = $gCurriculum['firstName'] ." ". $gCurriculum['lastName'];
        $module['course'] = $gCurriculum['course'];

        $query = $this->Enrollment_Model->courselistv2($dbType);
        $module['courseData'] = $query;
        $query = $this->Enrollment_Model->loadYearAndSemesterv2($cID, $dbType);
        $module['ysData'] = $query;
        $query = $this->Enrollment_Model->loadSubjectv2($cID, $dbType);
        $module['sData'] = $query;
        $query = $this->Enrollment_Model->loadSubjectCodev2($dbType);
        $module['scData'] = $query;
        $query = $this->Enrollment_Model->loadStudentGradev2($studentID, $dbType);
        $module['sgData'] = $query;

        $this->load->view('Enrollment/EvaluationFormChecklist', $module);
    }

    public function getSubjectInfo(){
        $subjectCode = $this->input->post('subjectcode');
        $databaseType = $this->input->post('databaseType');
        $result = $this->Enrollment_Model->getSubjectData($subjectCode, $databaseType);
        echo json_encode($result);
    }

    public function viewschedSection($schoolyear, $semester, $studentid){
        $module['schoolyear'] = $schoolyear;
        $module['semester'] = $semester;
        $module['studentid'] = $studentid;
        $this->load->view('Enrollment/ViewSchedRegular', $module);
    }


    public function loadSchedules(){

        $schoolyear = $this->input->post('schoolyear1');
        $semester = $this->input->post('semester1');
        $studentNumber = $this->input->post('studentid1');

        $fresult = array();
        $result = $this->Enrollment_Model->getScheduleBySectionWithTitle($schoolyear, $semester, $studentNumber);
        $i1=0;

        $decodeData = json_decode(json_encode($result), true);

        foreach($decodeData as $res){
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

    public function color($i){
        $color = array("#06214c","#ff8000","#00b33c","#002db3","#cc8800","#0000cc","#803300","#00802b","#990099","#34d26");
        return $color[$i];
    }



    public function studentAssessment(){

        $result = $this->Enrollment_Model->addAssessmentData();

        if($result['result']==true){
            $studentNumber = $this->input->post('studentNumber', true);
            $process ='ASSESSMENT';
            $status = $this->input->post('status', true);
            $standingYear = $this->input->post('standingYear', true);
            $updateProcess = $this->Enrollment_Model->updateEvalProcess($studentNumber, $process, $status, $standingYear);

        } else {
            $this->session->set_flashdata("error", "Assessment failed.");
        }

        redirect("enrollment/process", "refresh");

    }

    public function studentFees(){

        $result = $this->Enrollment_Model->addSubjectEnrollData();

        if($result['result']==true){
            $studentEnroll = $this->Enrollment_Model->addStudentEnrollData();
            $studentDivFees = $this->Enrollment_Model->addDivisionOfFeeData();

            $studentNumber = $this->input->post('studentNumber', true);
            $process ='CHEDBILLING';
            $status = $this->input->post('status', true);
            $standingYear = $this->input->post('standingYear', true);
            $updateProcess = $this->Enrollment_Model->updateEvalProcess($studentNumber, $process, $status, $standingYear);
        } else {
            $this->session->set_flashdata("error", "Enrollment failed.");
        }

        redirect("enrollment/process", "refresh");

    }

    public function ChedBilling(){
        $result = $this->Enrollment_Model->addChedBilling();

        if($result['result']==true){
            $studentNumber = $this->input->post('student_id', true);
            $process ='REGISTRY';
            $status = $this->input->post('status', true);
            $standingYear = $this->input->post('standingYear', true);
            $updateProcess = $this->Enrollment_Model->updateEvalProcess($studentNumber, $process, $status, $standingYear);
        } else {
            $this->session->set_flashdata("error", "Enrollment failed.");
        }

        redirect("enrollment/process", "refresh");
    }


    public function displayRegForm(){
        $currentUser = $this->session->student_id;
        $currentSem = $this->session->semester;

        if($currentSem=='FIRST') {
            $nextSchoolyear = $this->session->schoolyear;
            $nextSemester = 'SECOND';
        } else {
            $nextSchoolyear = (intval(substr($this->session->schoolyear, 0, 4)) + 1) . "-" . (intval(substr($this->session->schoolyear, 5, 4)) + 1);
            $nextSemester = 'FIRST';
        }

        $query = $this->Enrollment_Model->getYearLevelandSectionEval($nextSchoolyear, $nextSemester, $currentUser);
        $module['YLSData'] = $query;
        $query = $this->Enrollment_Model->getSubjectlistEvaluation($nextSchoolyear, $nextSemester, $currentUser);
        $module['seData'] = $query;

        $query = $this->Enrollment_Model->getScholarship();
        $module['schData'] = $query;


        $schoolyear ='2019-2020';
        $semester ='SECOND';
        $course ='BSIT';
        $yearAdmitted ='2019-2020';
        $semAdmitted ='FIRST';

        $query = $this->Enrollment_Model->getFeeList($schoolyear, $semester, $course, $yearAdmitted, $semAdmitted);
        $module['feeData'] = $query;

        $this->load->view('Enrollment/RegForm', $module);
    }



}