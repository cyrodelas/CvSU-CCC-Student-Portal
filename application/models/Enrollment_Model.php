<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Enrollment_Model extends CI_Model
{

    public function CheckEnrollmentProcess($currentUser){

        $result = array();
        $status = array();

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
            $result = "Existing";
            return array(
                'result'    =>  $result,
                'status'    =>  $status
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
        $this->db->select('*');
        $this->db->from('enrollcoursetbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function addEvaluationRequest(){

        $data = array(
            'studentNumber'     =>  $this->input->post('studentNumber', true),
            'studentName'       =>  $this->input->post('studentName', true),
            'course'            =>  $this->input->post('course', true),
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

    public function updateEvalProcess(){

        $studentNumber = $this->input->post('studentNumber', true);

        $this->db->set('process', "EVALUATION");
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

        return array(
            'curriculumID'   =>  $curriculumID,
            'studentNumber'  =>  $studentNumber,
            'firstName'      =>  $firstName,
            'lastName'       =>  $lastName,
            'course'         =>  $course
        );

    }

    public function loadYearAndSemester($cID){
        $this->db->select('yearlevel, semester');
        $this->db->from('enrollcurriculumcontent2');
        $this->db->where('curriculumnid', $cID);
        $this->db->group_by('yearlevel, semester');
        $this->db->order_by('yearlevel, semester');
        $query = $this->db->get();
        return $query->result();
    }


    public function loadSubject($cID){
        $this->db->select('enrollcurriculumcontent2.subjectcode, enrollcurriculumcontent2.yearlevel, enrollcurriculumcontent2.semester, enrollsubjectstbl.*');
        $this->db->from('enrollcurriculumcontent2');
        $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollcurriculumcontent2.subjectcode');
        $this->db->where('enrollcurriculumcontent2.curriculumnid', $cID);
        $query = $this->db->get();
        return $query->result();
    }


    public function loadSubjectCode(){
        $this->db->select('*');
        $this->db->from('enrollsubjectstbl');
        $query = $this->db->get();
        return $query->result();
    }


    public function loadStudentGrade($studentID){
        $this->db->select('*');
        $this->db->from('enrollgradestbl');
        $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollgradestbl.schedcode');
        $this->db->where('enrollgradestbl.studentnumber', $studentID);
        $query = $this->db->get();
        return $query->result();
    }


}