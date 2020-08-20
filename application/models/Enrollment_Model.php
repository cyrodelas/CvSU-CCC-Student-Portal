<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Enrollment_Model extends CI_Model
{

    function __construct(){
        parent::__construct();
        $this->cvsu = $this->load->database('cvsu', TRUE);
    }

    public function CheckEnrollmentProcess($currentUser){

        $result = array();
        $status = array();
        $student = array();
        $standingYear = array();

        $this->db->where('studentNumber', $currentUser);
        $enrollPhase = $this->db->get("enrollment_tracker");

        if ($enrollPhase->num_rows() == 0) {

            $currentSY = $this->session->schoolyear;
            $currentSem = $this->session->semester;

            if($this->session->dbtype == 1){

                $this->db->where('studentNumber', $currentUser);
                $this->db->where('schoolyear', $currentSY);
                $this->db->where('semester', $currentSem);
                $studentEnroll = $this->db->get("enrollstudentenroll");

                if ($studentEnroll->num_rows() > 0) {
                    $rs = $studentEnroll->row();
                    $status = $rs->status;
                }

                $student = $status;

            } else {

                $status = 'IRREGULAR';
                $student = $status;
            }


            $data = array(
                'studentNumber'     =>  $currentUser,
                'process'           =>  "PRE-EVALUATION",
                'status'            =>  $status,
                'standingYear'      =>  0
            );

            $result = $this->db->insert('enrollment_tracker', $data);
            $result = ($this->db->affected_rows() != 1) ? false : true;

            $status = "PRE-EVALUATION";
            $standingYear = 0;

            return array(
                'result'         =>  $result,
                'status'         =>  $status,
                'student'        =>  $student,
                'standingYear'   =>  $standingYear
            );
        }

        else{

            $rs = $enrollPhase->row();
            $status = $rs->process;
            $student = $rs->status;
            $result = "Existing";
            $standingYear = $rs->standingYear;

            return array(
                'result'         =>  $result,
                'status'         =>  $status,
                'student'        =>  $student,
                'standingYear'   =>  $standingYear
            );
        }


    }

    public function loadStudentGrades($sy, $sem, $currentStudent){

        if($this->session->dbtype == 1){

            $this->db->select('schedcode, subjectcode, units, mygrade');
            $this->db->distinct();
            $this->db->from('enrollgradestbl');
            $this->db->where('studentnumber', $currentStudent);
            $this->db->where('schoolyear', $sy);
            $this->db->where('Semester', $sem);
            $query = $this->db->get();
            return $query->result();

        } else {

            $this->cvsu->select('SchedCode as schedcode, CourseCode as subjectcode, CreditUnits as units, Grade as mygrade');
            $this->cvsu->distinct();
            $this->cvsu->from('grades');
            $this->cvsu->where('StudentNumber', $currentStudent);
            $this->cvsu->where('Schoolyear', $sy);
            $this->cvsu->where('semester', $sem);
            $query = $this->cvsu->get();
            return $query->result();

        }

    }


    public function getYearLevelandSection($sy, $sem, $currentStudent){

        if($this->session->dbtype == 1){
            $this->db->select('DISTINCT(enrollscheduletbl.section), COUNT(enrollscheduletbl.section) AS NoOfSubject');
            $this->db->from('enrollgradestbl');
            $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollgradestbl.schedcode');
            $this->db->where('enrollgradestbl.studentnumber', $currentStudent);
            $this->db->where('enrollgradestbl.schoolyear', $sy);
            $this->db->where('enrollgradestbl.semester', $sem);
            $this->db->order_by('NoOfSubject', 'ASC');
            $query = $this->db->get();
            return $query->result();
        } else {

            $this->cvsu->select('DISTINCT(schedcode.Section) as section, COUNT(schedcode.Section) AS NoOfSubject');
            $this->cvsu->from('grades');
            $this->cvsu->join('schedcode', 'schedcode.SubjectCode = grades.SchedCode');
            $this->cvsu->where('grades.StudentNumber', $currentStudent);
            $this->cvsu->where('grades.Schoolyear', $sy);
            $this->cvsu->where('grades.Semester', $sem);
            $this->cvsu->order_by('NoOfSubject', 'ASC');
            $query = $this->cvsu->get();
            return $query->result();

        }
    }

    public function courselist(){

        $this->db->select('*');
        $this->db->from('enrollcoursetbl');
        $query = $this->db->get();
        return $query->result();

    }

    public function courselistv2($dbType){
        if($dbType == 1){
            $this->db->select('*');
            $this->db->from('enrollcoursetbl');
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('CourseCode as courseCode, CourseTitle as courseTitle');
            $this->cvsu->from('course');
            $query = $this->cvsu->get();
            return $query->result();
        }
    }

    public function addEvaluationRequest(){

        $data = array(
            'studentNumber'     =>  $this->input->post('studentNumber', true),
            'studentName'       =>  $this->input->post('studentName', true),
            'course'            =>  $this->input->post('course', true),
            'major'             =>  $this->input->post('major', true),
            'schoolyear'        =>  $this->input->post('schoolyear', true),
            'semester'          =>  $this->input->post('semester', true),
            'yearLevel'         =>  $this->input->post('yearLevel', true),
            'section'           =>  $this->input->post('section', true),
            'status'            =>  $this->input->post('status', true),
            'dbtype'            =>  $this->input->post('dbtype', true)
        );

        $result = $this->db->insert('enrollment_evaluation', $data);
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );

    }


    public function getFeeList($schoolyear, $semester, $course, $yearAdmitted, $semAdmitted){
        $this->db->select('*');
        $this->db->from('enrollfeestbl');
        $this->db->where('schoolyear', $schoolyear);
        $this->db->where('semester', $semester);
        $this->db->where('course', $course);
        $this->db->where('yearadmitted', $yearAdmitted);
        $this->db->where('semesteradmitted', $semAdmitted);
        $query = $this->db->get();
        return $query->result();
    }

    public function getScholarship(){
        $this->db->select('*');
        $this->db->from('enrollscholarshiptbl');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getScholarshipData($scholarship_id){
        $this->db->select('*');
        $this->db->from('enrollscholarshiptbl');
        $this->db->where('id', $scholarship_id);
        $query = $this->db->get();
        return $query->result();
    }




    //General Usage

    public function updateEvalProcess($studentNumber, $process, $status, $standingYear){

        $this->db->set('process', $process);
        $this->db->set('status', $status);
        $this->db->set('standingYear', $standingYear);

        $this->db->where('studentNumber', $studentNumber);
        $this->db->update('enrollment_tracker');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );

    }




    //For Department Head

    public function loadEvalList($department){
        if($department=='DIT'){
            $this->db->select('*');
            $this->db->from('enrollment_evaluation');
            $this->db->where('evaluated', 0);
            $this->db->where('course', 'BSIT');
            $this->db->or_where('course', 'BSCS');
            $query = $this->db->get();
            return $query->result();
        } elseif($department=='DM'){
            $this->db->select('*');
            $this->db->from('enrollment_evaluation');
            $this->db->where('evaluated', 0);
            $this->db->where('course', 'BSBM');
            $this->db->or_where('course', 'BSHM');
            $query = $this->db->get();
            return $query->result();
        } elseif($department=='DAS'){
            $this->db->select('*');
            $this->db->from('enrollment_evaluation');
            $this->db->where('evaluated', 0);
            $this->db->where('course', 'BECED');
            $this->db->or_where('course', 'BSE');
            $this->db->or_where('course', 'BEE');
            $query = $this->db->get();
            return $query->result();
        } elseif($department=='DTEL'){
            $this->db->select('*');
            $this->db->from('enrollment_evaluation');
            $this->db->where('evaluated', 0);
            $this->db->where('course', 'BECED');
            $this->db->or_where('course', 'BSE');
            $this->db->or_where('course', 'BEE');
            $query = $this->db->get();
            return $query->result();
        }

    }

    public function changeEvaluatedStatus($studentID){
        $this->db->set('evaluated', 1);
        $this->db->where('studentNumber', $studentID);
        $this->db->update('enrollment_evaluation');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }


    public function getSectionDataSchedule($cCode, $mID, $yl){

        if($cCode=='BSBM'){
            $mID = 'MARKETING MANAGEMENT';
        }

        $this->db->select('sectioncount');
        $this->db->from('enrollsectiondetails');
        $this->db->where('coursecode', $cCode);
        $this->db->where('major', $mID);
        $this->db->where('yearlevel', $yl);
        $query = $this->db->get();
        return $query->result();
    }

    public function getScheduleRegularData($schoolyear, $semester, $section, $dbtype){

        if($dbtype==1){

            $this->db->select('enrollscheduletbl.*, enrollsubjectstbl.subjectTitle');
            $this->db->from('enrollscheduletbl');
            $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
            $this->db->where('enrollscheduletbl.schoolyear', $schoolyear);
            $this->db->where('enrollscheduletbl.semester', $semester);
            $this->db->where('enrollscheduletbl.section', $section);
            $query = $this->db->get();
            return $query->result();

        } else {

            $this->cvsu->select('enrollscheduletbl.*, enrollsubjectstbl.subjectTitle');
            $this->cvsu->from('enrollscheduletbl');
            $this->cvsu->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
            $this->cvsu->where('enrollscheduletbl.schoolyear', $schoolyear);
            $this->cvsu->where('enrollscheduletbl.semester', $semester);
            $this->cvsu->where('enrollscheduletbl.section', $section);
            $query = $this->cvsu->get();
            return $query->result();

        }
    }

    public function getCurriculumID($studentID){

        $curriculumID = array();
        $studentNumber = array();
        $firstName = array();
        $lastName = array();
        $course = array();

        if($this->session->dbtype == 1){
            $this->db->where('studentNumber', $studentID);
            $studentInfo = $this->db->get("enrollstudentinformation");

            if ($studentInfo->num_rows() > 0) {
                $rs = $studentInfo->row();
                $curriculumID = $rs->curriculumid;
                $studentNumber = $rs->studentNumber;
                $firstName = $rs->firstName;
                $lastName = $rs->lastName;
                $course = $rs->course;
            }
        } else{
            $this->cvsu->where('StudentNumber', $studentID);
            $studentInfo = $this->cvsu->get("studentinfo");

            if ($studentInfo->num_rows() > 0) {
                $rs = $studentInfo->row();
                $curriculumID = $rs->curriculumid;
                $studentNumber = $rs->StudentNumber;
                $firstName = $rs->FirstName;
                $lastName = $rs->LastName;
                $course = $rs->CourseCode;
            }
        }

        return array(
            'curriculumID'   =>  $curriculumID,
            'studentNumber'  =>  $studentNumber,
            'firstName'      =>  $firstName,
            'lastName'       =>  $lastName,
            'course'         =>  $course
        );

    }

    public function getCurriculumIDv2($studentID, $dbType){

        $curriculumID = array();
        $studentNumber = array();
        $firstName = array();
        $lastName = array();
        $course = array();

        if($dbType == 1){
            $this->db->where('studentNumber', $studentID);
            $studentInfo = $this->db->get("enrollstudentinformation");

            if ($studentInfo->num_rows() > 0) {
                $rs = $studentInfo->row();
                $curriculumID = $rs->curriculumid;
                $studentNumber = $rs->studentNumber;
                $firstName = $rs->firstName;
                $lastName = $rs->lastName;
                $course = $rs->course;
            }
        } else{
            $this->cvsu->where('StudentNumber', $studentID);
            $studentInfo = $this->cvsu->get("studentinfo");

            if ($studentInfo->num_rows() > 0) {
                $rs = $studentInfo->row();
                $curriculumID = $rs->curriculumid;
                $studentNumber = $rs->StudentNumber;
                $firstName = $rs->FirstName;
                $lastName = $rs->LastName;
                $course = $rs->CourseCode;
            }
        }

        return array(
            'curriculumID'   =>  $curriculumID,
            'studentNumber'  =>  $studentNumber,
            'firstName'      =>  $firstName,
            'lastName'       =>  $lastName,
            'course'         =>  $course
        );

    }

    public function loadYearAndSemester($cID){
        if($this->session->dbtype == 1){
            $this->db->select('yearlevel, semester');
            $this->db->from('enrollcurriculumcontent2');
            $this->db->where('curriculumnid', $cID);
            $this->db->group_by('yearlevel, semester');
            $this->db->order_by('yearlevel, semester');
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('yearlevel, semester');
            $this->cvsu->from('enrollcurriculumcontent');
            $this->cvsu->where('curriculumnid', $cID);
            $this->cvsu->group_by('yearlevel, semester');
            $this->cvsu->order_by('yearlevel, semester');
            $query = $this->cvsu->get();
            return $query->result();
        }

    }

    public function loadYearAndSemesterv2($cID, $dbType){
        if($dbType == 1){
            $this->db->select('yearlevel, semester');
            $this->db->from('enrollcurriculumcontent2');
            $this->db->where('curriculumnid', $cID);
            $this->db->group_by('yearlevel, semester');
            $this->db->order_by('yearlevel, semester');
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('yearlevel, semester');
            $this->cvsu->from('enrollcurriculumcontent');
            $this->cvsu->where('curriculumnid', $cID);
            $this->cvsu->group_by('yearlevel, semester');
            $this->cvsu->order_by('yearlevel, semester');
            $query = $this->cvsu->get();
            return $query->result();
        }

    }


    public function loadSubject($cID){
        if($this->session->dbtype == 1){
            $this->db->select('enrollcurriculumcontent2.subjectcode, enrollcurriculumcontent2.yearlevel, enrollcurriculumcontent2.semester, enrollsubjectstbl.*');
            $this->db->from('enrollcurriculumcontent2');
            $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollcurriculumcontent2.subjectcode');
            $this->db->where('enrollcurriculumcontent2.curriculumnid', $cID);
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('enrollcurriculumcontent.subjectcode, enrollcurriculumcontent.yearlevel, enrollcurriculumcontent.semester, coursecode.Title as subjectTitle,  coursecode.Lecture as lectUnits, coursecode.Laboratory as labunits, coursecode.prerequisite as pr1, "N/A" as pr2, "N/A" as pr3, "N/A" as pr4, "N/A" as pr5, "N/A" as pr6, "N/A" as pr7, "N/A" as pr8, "N/A" as pr9, "N/A" as pr10');
            $this->cvsu->from('enrollcurriculumcontent');
            $this->cvsu->join('coursecode', 'coursecode.Code = enrollcurriculumcontent.subjectcode');
            $this->cvsu->where('enrollcurriculumcontent.curriculumnid', $cID);
            $query = $this->cvsu->get();
            return $query->result();
        }

    }

    public function loadSubjectv2($cID, $dbType){
        if($dbType == 1){
            $this->db->select('enrollcurriculumcontent2.subjectcode, enrollcurriculumcontent2.yearlevel, enrollcurriculumcontent2.semester, enrollsubjectstbl.*');
            $this->db->from('enrollcurriculumcontent2');
            $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollcurriculumcontent2.subjectcode');
            $this->db->where('enrollcurriculumcontent2.curriculumnid', $cID);
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('enrollcurriculumcontent.subjectcode, enrollcurriculumcontent.yearlevel, enrollcurriculumcontent.semester, coursecode.Title as subjectTitle,  coursecode.Lecture as lectUnits, coursecode.Laboratory as labunits, coursecode.prerequisite as pr1, "N/A" as pr2, "N/A" as pr3, "N/A" as pr4, "N/A" as pr5, "N/A" as pr6, "N/A" as pr7, "N/A" as pr8, "N/A" as pr9, "N/A" as pr10');
            $this->cvsu->from('enrollcurriculumcontent');
            $this->cvsu->join('coursecode', 'coursecode.Code = enrollcurriculumcontent.subjectcode');
            $this->cvsu->where('enrollcurriculumcontent.curriculumnid', $cID);
            $query = $this->cvsu->get();
            return $query->result();
        }

    }


    public function loadSubjectCode(){
        if($this->session->dbtype == 1){
            $this->db->select('*');
            $this->db->from('enrollsubjectstbl');
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('*');
            $this->cvsu->from('coursecode');
            $query = $this->cvsu->get();
            return $query->result();
        }
    }

    public function loadSubjectCodev2($dbType){
        if($dbType == 1){
            $this->db->select('*');
            $this->db->from('enrollsubjectstbl');
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('*');
            $this->cvsu->from('coursecode');
            $query = $this->cvsu->get();
            return $query->result();
        }
    }


    public function loadStudentGrade($studentID){
        if($this->session->dbtype == 1){
            $this->db->select('enrollscheduletbl.*, enrollgradestbl.schedcode, enrollgradestbl.subjectcode, enrollgradestbl.units, enrollgradestbl.mygrade');
            $this->db->distinct();
            $this->db->from('enrollgradestbl');
            $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollgradestbl.schedcode');
            $this->db->where('enrollgradestbl.studentnumber', $studentID);
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('schedcode.Instructor as instructor, schedcode.year as schoolyear, schedcode.sem as semester, grades.SchedCode as schedcode, grades.CourseCode as subjectcode, grades.CreditUnits as units, grades.Grade as mygrade');
            $this->cvsu->distinct();
            $this->cvsu->from('grades');
            $this->cvsu->join('schedcode', 'schedcode.SubjectCode = grades.SchedCode');
            $this->cvsu->where('grades.StudentNumber', $studentID);
            $this->cvsu->order_by('schedcode.year, schedcode.sem', 'ASC');
            $query = $this->cvsu->get();
            return $query->result();
        }
    }

    public function loadStudentGradev2($studentID, $dbType){
        if($dbType == 1){
            $this->db->select('enrollscheduletbl.*, enrollgradestbl.schedcode, enrollgradestbl.subjectcode, enrollgradestbl.units, enrollgradestbl.mygrade');
            $this->db->distinct();
            $this->db->from('enrollgradestbl');
            $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollgradestbl.schedcode');
            $this->db->where('enrollgradestbl.studentnumber', $studentID);
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('schedcode.Instructor as instructor, schedcode.year as schoolyear, schedcode.sem as semester, grades.SchedCode as schedcode, grades.CourseCode as subjectcode, grades.CreditUnits as units, grades.Grade as mygrade');
            $this->cvsu->distinct();
            $this->cvsu->from('grades');
            $this->cvsu->join('schedcode', 'schedcode.SubjectCode = grades.SchedCode');
            $this->cvsu->where('grades.StudentNumber', $studentID);
            $this->cvsu->order_by('schedcode.year, schedcode.sem', 'ASC');
            $query = $this->cvsu->get();
            return $query->result();
        }
    }


    public function loadSchedCodes($schoolyear, $semester, $section){
        $this->db->select('enrollscheduletbl.*, enrollsubjectstbl.subjectTitle');
        $this->db->from('enrollscheduletbl');
        $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
        $this->db->where('enrollscheduletbl.schoolyear', $schoolyear);
        $this->db->where('enrollscheduletbl.semester', $semester);
        $this->db->where('enrollscheduletbl.section', $section);
        $query = $this->db->get();
        return $query->result();
    }

    public function loadSchedCodesv2($schoolyear, $semester, $section, $dbType){
        if($dbType == 1){
            $this->db->select('enrollscheduletbl.*, enrollsubjectstbl.subjectTitle');
            $this->db->from('enrollscheduletbl');
            $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
            $this->db->where('enrollscheduletbl.schoolyear', $schoolyear);
            $this->db->where('enrollscheduletbl.semester', $semester);
            $this->db->where('enrollscheduletbl.section', $section);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->cvsu->select('enrollscheduletbl.*, enrollsubjectstbl.subjectTitle');
            $this->cvsu->from('enrollscheduletbl');
            $this->cvsu->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
            $this->cvsu->where('enrollscheduletbl.schoolyear', $schoolyear);
            $this->cvsu->where('enrollscheduletbl.semester', $semester);
            $this->cvsu->where('enrollscheduletbl.section', $section);
            $query = $this->cvsu->get();
            return $query->result();
        }

    }


    public function getSubjectData($subjectCode){
        $this->db->select('*');
        $this->db->from('enrollsubjectstbl');
        $this->db->where('subjectcode', $subjectCode);
        $query = $this->db->get();
        return $query->result();
    }

    public function addEvaluationData($dbtype){

        $data = array();
        if($dbtype == 1){

            $studentNumber = $this->input->post('studentNumber');
            $schedcodes = $this->input->post('schedcode');
            $schoolyear = $this->input->post('schoolyear');
            $semester = $this->input->post('semester');

            foreach($schedcodes AS $schedcode)
            {
                $data[] = array(
                    'studentNumber'     => $studentNumber,
                    'schedcode'         => $schedcode,
                    'schoolyear'        => $schoolyear,
                    'semester'          => $semester,
                    'dateEvaluated'     => date('Y-m-d H:i:s')

                );
            }

            $result = $this->db->insert_batch('enrollevaluatesubjectstbl', $data);
            $result = ($this->db->affected_rows() > 0) ? true : false;

            return array(
                'result'    => $result
            );

        } else {

            $studentNumber = $this->input->post('studentNumber');
            $schedcodes = $this->input->post('schedcode');
            $schoolyear = $this->input->post('schoolyear');
            $semester = $this->input->post('semester');

            foreach($schedcodes AS $schedcode)
            {
                $data[] = array(
                    'studentNumber'     => $studentNumber,
                    'schedcode'         => $schedcode,
                    'schoolyear'        => $schoolyear,
                    'semester'          => $semester,
                    'dateEvaluated'     => date('Y-m-d H:i:s')

                );
            }

            $result = $this->cvsu->insert_batch('enrollevaluatesubjectstbl', $data);
            $result = ($this->cvsu->affected_rows() > 0) ? true : false;

            return array(
                'result'    => $result
            );

        }
    }

    public function addEvaluationManual(){
        $data = array();

        $studentNumber = $this->input->post('studentNumber');
        $subjectcodes = $this->input->post('subjectcode');
        $schoolyear = $this->input->post('schoolyear');
        $semester = $this->input->post('semester');

        foreach($subjectcodes AS $subjectcode)
        {
            $data[] = array(
                'studentNumber'     => $studentNumber,
                'subjectcode'       => $subjectcode,
                'schoolyear'        => $schoolyear,
                'semester'          => $semester,
                'dateEvaluated'     => date('Y-m-d H:i:s')

            );
        }

        $result = $this->db->insert_batch('enrollment_subjectlist', $data);
        $result = ($this->db->affected_rows() > 0) ? true : false;

        return array(
            'result'    => $result
        );
    }

    public function deleteEvaluationListData($studentNumber){
        $this->db->where('studentNumber', $studentNumber);
        $this->db->delete('enrollment_evaluation');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }


    public function getYearLevelandSectionEval($sy, $sem, $currentStudent){

        if($this->session->dbtype == 1){

            $this->db->select('DISTINCT(enrollscheduletbl.section), COUNT(enrollscheduletbl.section) AS NoOfSubject');
            $this->db->from('enrollevaluatesubjectstbl');
            $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollevaluatesubjectstbl.schedcode');
            $this->db->where('enrollevaluatesubjectstbl.studentNumber', $currentStudent);
            $this->db->where('enrollevaluatesubjectstbl.schoolyear', $sy);
            $this->db->where('enrollevaluatesubjectstbl.semester', $sem);
            $this->db->order_by('NoOfSubject', 'ASC');
            $query = $this->db->get();
            return $query->result();

        } else {

            $this->cvsu->select('DISTINCT(enrollscheduletbl.section), COUNT(enrollscheduletbl.section) AS NoOfSubject');
            $this->cvsu->from('enrollevaluatesubjectstbl');
            $this->cvsu->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollevaluatesubjectstbl.schedcode');
            $this->cvsu->where('enrollevaluatesubjectstbl.studentNumber', $currentStudent);
            $this->cvsu->where('enrollevaluatesubjectstbl.schoolyear', $sy);
            $this->cvsu->where('enrollevaluatesubjectstbl.semester', $sem);
            $this->cvsu->order_by('NoOfSubject', 'ASC');
            $query = $this->cvsu->get();
            return $query->result();

        }

    }

    public function getSubjectlistEvaluation($sy, $sem, $currentStudent){

        if($this->session->dbtype == 1){
            $this->db->select('enrollscheduletbl.*, enrollsubjectstbl.subjectTitle');
            $this->db->from('enrollevaluatesubjectstbl');
            $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollevaluatesubjectstbl.schedcode');
            $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
            $this->db->where('enrollevaluatesubjectstbl.studentNumber', $currentStudent);
            $this->db->where('enrollevaluatesubjectstbl.schoolyear', $sy);
            $this->db->where('enrollevaluatesubjectstbl.semester', $sem);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->cvsu->select('enrollscheduletbl.*, enrollsubjectstbl.subjectTitle');
            $this->cvsu->from('enrollevaluatesubjectstbl');
            $this->cvsu->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollevaluatesubjectstbl.schedcode');
            $this->cvsu->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
            $this->cvsu->where('enrollevaluatesubjectstbl.studentNumber', $currentStudent);
            $this->cvsu->where('enrollevaluatesubjectstbl.schoolyear', $sy);
            $this->cvsu->where('enrollevaluatesubjectstbl.semester', $sem);
            $query = $this->cvsu->get();
            return $query->result();
        }


    }

    public function getScheduleBySectionWithTitle($schoolyear, $semester, $studentNumber){

        if($this->session->dbtype == 1){
            $this->db->select('enrollscheduletbl.subjectcode, enrollscheduletbl.section, enrollscheduletbl.instructor, enrollscheduletbl.room1, enrollscheduletbl.room2, enrollscheduletbl.room3, enrollscheduletbl.room4, enrollscheduletbl.timein1, enrollscheduletbl.timeout1, enrollscheduletbl.day1, enrollscheduletbl.timein2, enrollscheduletbl.timeout2, enrollscheduletbl.day2, enrollscheduletbl.timein3, enrollscheduletbl.timeout3, enrollscheduletbl.day3, enrollscheduletbl.timein4, enrollscheduletbl.timeout4, enrollscheduletbl.day4, enrollsubjectstbl.subjectTitle');
            $this->db->from('enrollscheduletbl');
            $this->db->join('enrollevaluatesubjectstbl', 'enrollevaluatesubjectstbl.schedcode = enrollscheduletbl.schedcode');
            $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
            $this->db->where('enrollscheduletbl.schoolyear', $schoolyear);
            $this->db->where('enrollscheduletbl.semester', $semester);
            $this->db->where('enrollevaluatesubjectstbl.studentNumber', $studentNumber);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->cvsu->select('enrollscheduletbl.subjectcode, enrollscheduletbl.section, enrollscheduletbl.instructor, enrollscheduletbl.room1, enrollscheduletbl.room2, enrollscheduletbl.room3, enrollscheduletbl.room4, enrollscheduletbl.timein1, enrollscheduletbl.timeout1, enrollscheduletbl.day1, enrollscheduletbl.timein2, enrollscheduletbl.timeout2, enrollscheduletbl.day2, enrollscheduletbl.timein3, enrollscheduletbl.timeout3, enrollscheduletbl.day3, enrollscheduletbl.timein4, enrollscheduletbl.timeout4, enrollscheduletbl.day4, enrollsubjectstbl.subjectTitle');
            $this->cvsu->from('enrollscheduletbl');
            $this->cvsu->join('enrollevaluatesubjectstbl', 'enrollevaluatesubjectstbl.schedcode = enrollscheduletbl.schedcode');
            $this->cvsu->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
            $this->cvsu->where('enrollscheduletbl.schoolyear', $schoolyear);
            $this->cvsu->where('enrollscheduletbl.semester', $semester);
            $this->cvsu->where('enrollevaluatesubjectstbl.studentNumber', $studentNumber);
            $query = $this->cvsu->get();
            return $query->result();
        }

    }


    public function addAssessmentData(){

        $data = array();

        if($this->session->dbtype == 1){
            $studentNumber = $this->input->post('studentNumber');
            $schedcodes = $this->input->post('schedcodes');
            $schoolyear = $this->input->post('schoolyear');
            $semester = $this->input->post('semester');

            foreach($schedcodes AS $schedcode)
            {
                $data[] = array(
                    'studentNumber'     => $studentNumber,
                    'schedcode'         => $schedcode,
                    'schoolyear'        => $schoolyear,
                    'semester'          => $semester,
                    'dateAssess'        => date('Y-m-d H:i:s')

                );
            }

            $result = $this->db->insert_batch('enrollassesssubjectstbl', $data);
            $result = ($this->db->affected_rows() > 0) ? true : false;

            return array(
                'result'    => $result
            );
        } else {
            $studentNumber = $this->input->post('studentNumber');
            $schedcodes = $this->input->post('schedcodes');
            $schoolyear = $this->input->post('schoolyear');
            $semester = $this->input->post('semester');

            foreach($schedcodes AS $schedcode)
            {
                $data[] = array(
                    'StudentNumber'     => $studentNumber,
                    'SchedCode'         => $schedcode,
                    'schoolyear'        => $schoolyear,
                    'semester'          => $semester,
                    'dateassest'        => date('Y-m-d H:i:s')

                );
            }

            $result = $this->cvsu->insert_batch('assestsubjects', $data);
            $result = ($this->cvsu->affected_rows() > 0) ? true : false;

            return array(
                'result'    => $result
            );
        }

    }

    public function addSubjectEnrollData(){

        $data = array();

        if($this->session->dbtype == 1){
            $studentNumber = $this->input->post('studentNumber');
            $schedcodes = $this->input->post('schedcodes');
            $schoolyear = $this->input->post('schoolyear');
            $semester = $this->input->post('semester');

            foreach($schedcodes AS $schedcode)
            {
                $data[] = array(
                    'studentnumber'     => $studentNumber,
                    'schedcode'         => $schedcode,
                    'schoolyear'        => $schoolyear,
                    'semester'          => $semester,
                    'edate'             => date('Y-m-d H:i:s'),
                    'status'            => 'NOT GRADED'

                );
            }

            $result = $this->db->insert_batch('enrollsubjectenrolled', $data);
            $result = ($this->db->affected_rows() > 0) ? true : false;

            return array(
                'result'    => $result
            );
        } else {
            $studentNumber = $this->input->post('studentNumber');
            $schedcodes = $this->input->post('schedcodes');
            $schoolyear = $this->input->post('schoolyear');
            $semester = $this->input->post('semester');

            foreach($schedcodes AS $schedcode)
            {
                $data[] = array(
                    'StudentNumber'     => $studentNumber,
                    'SchedCode'         => $schedcode,
                    'Schoolyear'        => $schoolyear,
                    'semester'          => $semester,
                    'date'              => date('Y-m-d'),
                    'Status'            => 'NOT GRADED'

                );
            }

            $result = $this->cvsu->insert_batch('enrolledsubject', $data);
            $result = ($this->cvsu->affected_rows() > 0) ? true : false;

            return array(
                'result'    => $result
            );
        }

    }

    public function addStudentEnrollData(){

        if($this->session->dbtype == 1){
            $data = array(
                'studentnumber'      =>  $this->input->post('studentNumber', true),
                'semester'           =>  $this->input->post('semester', true),
                'schoolyear'         =>  $this->input->post('schoolyear', true),
                'edate'              =>  date('Y-m-d H:i:s'),
                'status'             =>  $this->input->post('status', true),
                'scholarship'        =>  $this->input->post('tscholarship', true),
                'majorCourse'        =>  $this->input->post('majorCourse', true),
                'yearLevel'          =>  $this->input->post('yearLevel', true),
                'statusII'           =>  'STUDENT',
                'coursenow'          =>  $this->input->post('coursenow', true),
                'notuitionenroll'    =>  'False'
            );

            $result = $this->db->insert('enrollstudentenroll', $data);
            $result = ($this->db->affected_rows() != 1) ? false : true;

            return array(
                'result'    => $result
            );
        } else {
            $data = array(
                'studentnumber'      =>  $this->input->post('studentNumber', true),
                'semester'           =>  $this->input->post('semester', true),
                'schoolyear'         =>  $this->input->post('schoolyear', true),
                'edate'              =>  date('Y-m-d H:i:s'),
                'status'             =>  $this->input->post('status', true),
                'scholarship'        =>  $this->input->post('tscholarship', true),
                'majorCourse'        =>  $this->input->post('majorCourse', true),
                'yearLevel'          =>  $this->input->post('yearLevel', true),
                'statusII'           =>  'STUDENT',
                'coursenow'          =>  $this->input->post('coursenow', true),
                'notuitionenroll'    =>  'False'
            );

            $result = $this->cvsu->insert('enrollstudentenroll', $data);
            $result = ($this->cvsu->affected_rows() != 1) ? false : true;

            return array(
                'result'    => $result
            );
        }

    }

    public function addDivisionOfFeeData(){

        if($this->session->dbtype == 1){
            $data = array(
                'studentnumber'      =>  $this->input->post('studentNumber', true),
                'semester'           =>  $this->input->post('semester', true),
                'schoolyear'         =>  $this->input->post('schoolyear', true),
                'ansci'              =>  $this->input->post('labAnSci', true),
                'pansci'             =>  $this->input->post('labAnSci', true),
                'biosci'             =>  $this->input->post('labBioSci', true),
                'pbiosci'            =>  $this->input->post('labBioSci', true),
                'cemds'              =>  $this->input->post('labCEMDS', true),
                'pcemds'             =>  $this->input->post('labCEMDS', true),
                'hrm'                =>  $this->input->post('labHRM', true),
                'phrm'               =>  $this->input->post('labHRM', true),
                'cropsci'            =>  $this->input->post('labCropSci', true),
                'pcropsci'           =>  $this->input->post('labCropSci', true),
                'engineering'        =>  $this->input->post('labEng', true),
                'pengineering'       =>  $this->input->post('labEng', true),
                'physci'             =>  $this->input->post('labPhySci', true),
                'pphysci'            =>  $this->input->post('labPhySci', true),
                'vetmed'             =>  $this->input->post('labVetMed', true),
                'pvetmed'            =>  $this->input->post('labVetMed', true),
                'speech'             =>  $this->input->post('labSpeech', true),
                'pspeech'            =>  $this->input->post('labSpeech', true),
                'english'            =>  $this->input->post('labEnglish', true),
                'penglish'           =>  $this->input->post('labEnglish', true),
                'nursing'            =>  $this->input->post('labNursing', true),
                'pnursing'           =>  $this->input->post('labNursing', true),
                'ccl'                =>  $this->input->post('ccl', true),
                'pccl'               =>  $this->input->post('ccl', true),
                'rle'                =>  $this->input->post('rle', true),
                'prle'               =>  $this->input->post('rle', true),
                'internet'           =>  $this->input->post('internet', true),
                'pinternet'          =>  $this->input->post('internet', true),
                'nstp'               =>  $this->input->post('NSTP', true),
                'pnstp'              =>  $this->input->post('NSTP', true),
                'ojt'                =>  $this->input->post('ojt', true),
                'pojt'               =>  $this->input->post('ojt', true),
                'thesis'             =>  $this->input->post('thesis', true),
                'pthesis'            =>  $this->input->post('thesis', true),
                'student'            =>  $this->input->post('studentTeaching', true),
                'pstudent'           =>  $this->input->post('studentTeaching', true),
                'late'               =>  $this->input->post('lateReg', true),
                'plate'              =>  $this->input->post('lateReg', true),
                'residency'          =>  $this->input->post('residency', true),
                'presidency'         =>  $this->input->post('residency', true),
                'foreignstudent'     =>  $this->input->post('foreignStudent', true),
                'pforeignstudent'    =>  $this->input->post('foreignStudent', true),
                'addedsubj'          =>  $this->input->post('addedSubj', true),
                'paddedsubj'         =>  $this->input->post('addedSubj', true),
                'petition'           =>  $this->input->post('petitionSubj', true),
                'ppetition'          =>  $this->input->post('petitionSubj', true),
                'tuition'            =>  $this->input->post('tuition', true),
                'ptuition'           =>  $this->input->post('tuition', true),
                'library'            =>  $this->input->post('miscLibrary', true),
                'plibrary'           =>  $this->input->post('miscLibrary', true),
                'medical'            =>  $this->input->post('miscMedical', true),
                'pmedical'           =>  $this->input->post('miscMedical', true),
                'publication'        =>  $this->input->post('miscPublication', true),
                'ppublication'       =>  $this->input->post('miscPublication', true),
                'registration'       =>  $this->input->post('miscRegistration', true),
                'pregistration'      =>  $this->input->post('miscRegistration', true),
                'guidance'           =>  $this->input->post('miscGuidance', true),
                'pguidance'          =>  $this->input->post('miscGuidance', true),
                'id'                 =>  $this->input->post('identification', true),
                'pid'                =>  $this->input->post('identification', true),
                'sfdf'               =>  $this->input->post('sfdf', true),
                'psfdf'              =>  $this->input->post('sfdf', true),
                'srf'                =>  $this->input->post('srf', true),
                'psrf'               =>  $this->input->post('srf', true),
                'athletic'           =>  $this->input->post('athletic', true),
                'pathletic'          =>  $this->input->post('athletic', true),
                'scuaa'              =>  $this->input->post('scuaa', true),
                'pscuaa'             =>  $this->input->post('scuaa', true),
                'deposit'            =>  $this->input->post('deposit', true),
                'pdeposit'           =>  $this->input->post('deposit', true),
                'cspear'             =>  $this->input->post('labcspear', true),
                'pcspear'            =>  $this->input->post('labcspear', true),
                'edfs'               =>  $this->input->post('edfs', true),
                'pedfs'              =>  $this->input->post('edfs', true),
                'psyc'               =>  $this->input->post('psyc', true),
                'ppsyc'              =>  $this->input->post('psyc', true),
                'trm'                =>  $this->input->post('trm', true),
                'ptrm'               =>  $this->input->post('trm', true),
                'fishery'            =>  $this->input->post('fishery', true),
                'pfishery'           =>  $this->input->post('fishery', true)

            );

            $result = $this->db->insert('enrolldivisionoffeestbl', $data);
            $result = ($this->db->affected_rows() != 1) ? false : true;

            return array(
                'result'    => $result
            );
        } else {
            $data = array(
                'studentnumber'      =>  $this->input->post('studentNumber', true),
                'semester'           =>  $this->input->post('semester', true),
                'schoolyear'         =>  $this->input->post('schoolyear', true),
                'ansci'              =>  $this->input->post('labAnSci', true),
                'pansci'             =>  $this->input->post('labAnSci', true),
                'biosci'             =>  $this->input->post('labBioSci', true),
                'pbiosci'            =>  $this->input->post('labBioSci', true),
                'cemds'              =>  $this->input->post('labCEMDS', true),
                'pcemds'             =>  $this->input->post('labCEMDS', true),
                'hrm'                =>  $this->input->post('labHRM', true),
                'phrm'               =>  $this->input->post('labHRM', true),
                'cropsci'            =>  $this->input->post('labCropSci', true),
                'pcropsci'           =>  $this->input->post('labCropSci', true),
                'engineering'        =>  $this->input->post('labEng', true),
                'pengineering'       =>  $this->input->post('labEng', true),
                'physci'             =>  $this->input->post('labPhySci', true),
                'pphysci'            =>  $this->input->post('labPhySci', true),
                'vetmed'             =>  $this->input->post('labVetMed', true),
                'pvetmed'            =>  $this->input->post('labVetMed', true),
                'speech'             =>  $this->input->post('labSpeech', true),
                'pspeech'            =>  $this->input->post('labSpeech', true),
                'english'            =>  $this->input->post('labEnglish', true),
                'penglish'           =>  $this->input->post('labEnglish', true),
                'nursing'            =>  $this->input->post('labNursing', true),
                'pnursing'           =>  $this->input->post('labNursing', true),
                'ccl'                =>  $this->input->post('ccl', true),
                'pccl'               =>  $this->input->post('ccl', true),
                'rle'                =>  $this->input->post('rle', true),
                'prle'               =>  $this->input->post('rle', true),
                'internet'           =>  $this->input->post('internet', true),
                'pinternet'          =>  $this->input->post('internet', true),
                'nstp'               =>  $this->input->post('NSTP', true),
                'pnstp'              =>  $this->input->post('NSTP', true),
                'ojt'                =>  $this->input->post('ojt', true),
                'pojt'               =>  $this->input->post('ojt', true),
                'thesis'             =>  $this->input->post('thesis', true),
                'pthesis'            =>  $this->input->post('thesis', true),
                'student'            =>  $this->input->post('studentTeaching', true),
                'pstudent'           =>  $this->input->post('studentTeaching', true),
                'late'               =>  $this->input->post('lateReg', true),
                'plate'              =>  $this->input->post('lateReg', true),
                'residency'          =>  $this->input->post('residency', true),
                'presidency'         =>  $this->input->post('residency', true),
                'foreignstudent'     =>  $this->input->post('foreignStudent', true),
                'pforeignstudent'    =>  $this->input->post('foreignStudent', true),
                'addedsubj'          =>  $this->input->post('addedSubj', true),
                'paddedsubj'         =>  $this->input->post('addedSubj', true),
                'petition'           =>  $this->input->post('petitionSubj', true),
                'ppetition'          =>  $this->input->post('petitionSubj', true),
                'tuition'            =>  $this->input->post('tuition', true),
                'ptuition'           =>  $this->input->post('tuition', true),
                'library'            =>  $this->input->post('miscLibrary', true),
                'plibrary'           =>  $this->input->post('miscLibrary', true),
                'medical'            =>  $this->input->post('miscMedical', true),
                'pmedical'           =>  $this->input->post('miscMedical', true),
                'publication'        =>  $this->input->post('miscPublication', true),
                'ppublication'       =>  $this->input->post('miscPublication', true),
                'registration'       =>  $this->input->post('miscRegistration', true),
                'pregistration'      =>  $this->input->post('miscRegistration', true),
                'guidance'           =>  $this->input->post('miscGuidance', true),
                'pguidance'          =>  $this->input->post('miscGuidance', true),
                'id'                 =>  $this->input->post('identification', true),
                'pid'                =>  $this->input->post('identification', true),
                'sfdf'               =>  $this->input->post('sfdf', true),
                'psfdf'              =>  $this->input->post('sfdf', true),
                'srf'                =>  $this->input->post('srf', true),
                'psrf'               =>  $this->input->post('srf', true),
                'athletic'           =>  $this->input->post('athletic', true),
                'pathletic'          =>  $this->input->post('athletic', true),
                'scuaa'              =>  $this->input->post('scuaa', true),
                'pscuaa'             =>  $this->input->post('scuaa', true),
                'deposit'            =>  $this->input->post('deposit', true),
                'pdeposit'           =>  $this->input->post('deposit', true),
                'cspear'             =>  $this->input->post('labcspear', true),
                'pcspear'            =>  $this->input->post('labcspear', true),
                'edfs'               =>  $this->input->post('edfs', true),
                'pedfs'              =>  $this->input->post('edfs', true),
                'psyc'               =>  $this->input->post('psyc', true),
                'ppsyc'              =>  $this->input->post('psyc', true),
                'trm'                =>  $this->input->post('trm', true),
                'ptrm'               =>  $this->input->post('trm', true),
                'fishery'            =>  $this->input->post('fishery', true),
                'pfishery'           =>  $this->input->post('fishery', true)

            );

            $result = $this->cvsu->insert('enrolldivisionoffeestbl', $data);
            $result = ($this->cvsu->affected_rows() != 1) ? false : true;

            return array(
                'result'    => $result
            );
        }


    }


    public function addChedBilling(){
        $data = array(
            'schoolyear'            =>  $this->input->post('schoolyear', true),
            'semester'              =>  $this->input->post('semester', true),
            'studNumber'            =>  $this->input->post('student_id', true),
            'lastN'                 =>  $this->input->post('student_ln', true),
            'firstN'                =>  $this->input->post('student_fn', true),
            'middleN'               =>  $this->input->post('student_mn', true),
            'suffixN'               =>  $this->input->post('suffix', true),
            'currentYearLevel'      =>  $this->input->post('yearlevel', true),
            'course'                =>  $this->input->post('coursename', true),
            'sex'                   =>  $this->input->post('gender', true),
            'dob'                   =>  date(dateformatdb, strtotime($this->input->post('dob', true))),
            'contactnumber'         =>  $this->input->post('mobilePhone', true),
            'email'                 =>  $this->input->post('email', true),
            'optprovince'           =>  $this->input->post('province', true),
            'optmunicipality'       =>  $this->input->post('municipality', true),
            'optbrgy'               =>  $this->input->post('barangay', true),
            'street'                =>  $this->input->post('street', true),
            'zipcode'               =>  $this->input->post('zip', true),
            'flastname'             =>  $this->input->post('flastname', true),
            'ffirstname'            =>  $this->input->post('ffirstname', true),
            'fmiddlename'           =>  $this->input->post('fmiddlename', true),
            'fsuffix'               =>  $this->input->post('fsuffix', true),
            'mlastname'             =>  $this->input->post('mlastname', true),
            'mfirstname'            =>  $this->input->post('mfirstname', true),
            'mmiddlename'           =>  $this->input->post('mmiddlename', true),
            'msuffix'               =>  $this->input->post('msuffix', true),
            'householdnum'          =>  $this->input->post('householdnum', true),
            'householdincome'       =>  $this->input->post('householdincome', true),
            'totalassesstment'      =>  $this->input->post('totalassesstment', true),
            'disability'            =>  $this->input->post('disability', true),
            'datetimeadded'         =>  date('Y-m-d H:i:s')

        );

        $result = $this->db->insert('chedbilling', $data);
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }





}