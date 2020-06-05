<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Enrollment_Model extends CI_Model
{

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

    public function loadSchedule(){

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