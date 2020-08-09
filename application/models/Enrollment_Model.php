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

        $this->db->where('studentNumber', $currentUser);
        $enrollPhase = $this->db->get("enrollment_tracker");

        if ($enrollPhase->num_rows() == 0) {

            $data = array(
                'studentNumber'     =>  $currentUser,
                'process'           =>  "PRE-EVALUATION"
            );

            $result = $this->db->insert('enrollment_tracker', $data);
            $result = ($this->db->affected_rows() != 1) ? false : true;

            $status = "PRE-EVALUATION";

            return array(
                'result'    =>  $result,
                'status'    =>  $status
            );
        }

        else{

            $rs = $enrollPhase->row();
            $status = $rs->process;
            $student = $rs->status;
            $result = "Existing";
            return array(
                'result'    =>  $result,
                'status'    =>  $status,
                'student'   =>  $student
            );
        }


    }

    public function loadStudentGrades($sy, $sem, $currentStudent){
        $this->db->select('schedcode, subjectcode, units, mygrade');
        $this->db->distinct();
        $this->db->from('enrollgradestbl');
        $this->db->where('studentnumber', $currentStudent);
        $this->db->where('schoolyear', $sy);
        $this->db->where('semester', $sem);
        $query = $this->db->get();
        return $query->result();
    }


    public function getYearLevelandSection($sy, $sem, $currentStudent){
        $this->db->select('DISTINCT(enrollscheduletbl.section), COUNT(enrollscheduletbl.section) AS NoOfSubject');
        $this->db->from('enrollgradestbl');
        $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollgradestbl.schedcode');
        $this->db->where('enrollgradestbl.studentnumber', $currentStudent);
        $this->db->where('enrollgradestbl.schoolyear', $sy);
        $this->db->where('enrollgradestbl.semester', $sem);
        $this->db->order_by('NoOfSubject', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function courselist(){
        if($this->session->dbtype == 1){
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
            'status'            =>  $this->input->post('status', true)
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

    public function updateEvalProcess($studentNumber, $process, $status){

        $this->db->set('process', $process);
        $this->db->set('status', $status);

        $this->db->where('studentNumber', $studentNumber);
        $this->db->update('enrollment_tracker');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );

    }




    //For Department Head

    public function loadEvalList(){
        $this->db->select('*');
        $this->db->from('enrollment_evaluation');
        $query = $this->db->get();
        return $query->result();
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


    public function getSubjectData($subjectCode){
        $this->db->select('*');
        $this->db->from('enrollsubjectstbl');
        $this->db->where('subjectcode', $subjectCode);
        $query = $this->db->get();
        return $query->result();
    }

    public function addEvaluationData(){

        $data = array();

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
        $this->db->select('DISTINCT(enrollscheduletbl.section), COUNT(enrollscheduletbl.section) AS NoOfSubject');
        $this->db->from('enrollevaluatesubjectstbl');
        $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollevaluatesubjectstbl.schedcode');
        $this->db->where('enrollevaluatesubjectstbl.studentNumber', $currentStudent);
        $this->db->where('enrollevaluatesubjectstbl.schoolyear', $sy);
        $this->db->where('enrollevaluatesubjectstbl.semester', $sem);
        $this->db->order_by('NoOfSubject', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getSubjectlistEvaluation($sy, $sem, $currentStudent){
        $this->db->select('enrollscheduletbl.*, enrollsubjectstbl.subjectTitle');
        $this->db->from('enrollevaluatesubjectstbl');
        $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollevaluatesubjectstbl.schedcode');
        $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
        $this->db->where('enrollevaluatesubjectstbl.studentNumber', $currentStudent);
        $this->db->where('enrollevaluatesubjectstbl.schoolyear', $sy);
        $this->db->where('enrollevaluatesubjectstbl.semester', $sem);
        $query = $this->db->get();
        return $query->result();
    }

    public function getScheduleBySectionWithTitle($schoolyear, $semester, $studentNumber){
        $this->db->select('enrollscheduletbl.subjectcode, enrollscheduletbl.section, enrollscheduletbl.instructor, enrollscheduletbl.room1, enrollscheduletbl.room2, enrollscheduletbl.room3, enrollscheduletbl.room4, enrollscheduletbl.timein1, enrollscheduletbl.timeout1, enrollscheduletbl.day1, enrollscheduletbl.timein2, enrollscheduletbl.timeout2, enrollscheduletbl.day2, enrollscheduletbl.timein3, enrollscheduletbl.timeout3, enrollscheduletbl.day3, enrollscheduletbl.timein4, enrollscheduletbl.timeout4, enrollscheduletbl.day4, enrollsubjectstbl.subjectTitle');
        $this->db->from('enrollscheduletbl');
        $this->db->join('enrollevaluatesubjectstbl', 'enrollevaluatesubjectstbl.schedcode = enrollscheduletbl.schedcode');
        $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
        $this->db->where('enrollscheduletbl.schoolyear', $schoolyear);
        $this->db->where('enrollscheduletbl.semester', $semester);
        $this->db->where('enrollevaluatesubjectstbl.studentNumber', $studentNumber);
        $query = $this->db->get();
        return $query->result();
    }

}