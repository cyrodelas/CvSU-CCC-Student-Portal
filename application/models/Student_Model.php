<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_Model extends CI_Model
{
    public function validate_login()
    {
        $result = array();
        $student_id = array();
        $student_fn = array();
        $student_mn = array();
        $student_ln = array();
        $student_course = array();
        $student_image = array();
        $schoolyear = array();
        $semester = array();

        $password = md5($this->input->post("password", TRUE));

        /* ADMIN LOGIN VALIDATION */

        $this->db->where('studentNumber', $this->input->post("username", TRUE));
        $this->db->where('web_password', $password);

        $admin_account = $this->db->get("enrollstudentinformation");

        if ($admin_account->num_rows() == 1) {

            $rs = $admin_account->row();
            $result = true;
            $student_id = $rs->studentNumber;
            $student_fn = $rs->firstName;
            $student_mn = $rs->middleName;
            $student_ln = $rs->lastName;
            $student_course = $rs->course;
            $student_image = $rs->image;
        }

        $currentSYS = $this->db->get('legend');
        if($currentSYS->num_rows() == 1){
            $data =  $currentSYS->row();
            $schoolyear = $data->schoolyear;
            $semester = $data->semester;
        }


        return array(
            'success' => $result,
            'student_id' => $student_id,
            'student_fn' => $student_fn,
            'student_mn' => $student_mn,
            'student_ln' => $student_ln,
            'student_course' => $student_course,
            'student_image' => $student_image,
            'schoolyear' => $schoolyear,
            'semester' => $semester
        );

    }

    public function loadStudentInfo($currentStudent){
        $this->db->select('*');
        $this->db->from('enrollstudentinformation');
        $this->db->where('studentNumber', $currentStudent);
        $query = $this->db->get();
        return $query->result();
    }

    public function loadStudentEnroll($currentStudent){
        $this->db->select('MAX(yearLevel) AS ylevel, enrollcoursetbl.courseTitle, enrollstudentenroll.majorCourse');
        $this->db->from('enrollstudentenroll');
        $this->db->join('enrollcoursetbl','enrollcoursetbl.courseCode = enrollstudentenroll.coursenow');
        $this->db->where('enrollstudentenroll.studentNumber', $currentStudent);
        $query = $this->db->get();
        return $query->result();
    }


    public function loadEnrolledSubject(){
        $this->db->select('enrollsubjectenrolled.schedcode, enrollscheduletbl.subjectCode, enrollsubjectstbl.subjectTitle, enrollscheduletbl.units');
        $this->db->from('enrollsubjectenrolled');
        $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollsubjectenrolled.schedcode', 'left');
        $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
        $this->db->where('enrollsubjectenrolled.studentnumber', $this->session->student_id);
        $this->db->where('enrollsubjectenrolled.schoolyear', $this->session->schoolyear);
        $this->db->where('enrollsubjectenrolled.semester', $this->session->semester);
        $query = $this->db->get();
        return $query->result();
    }

    public function loadStudentSY($currentStudent){
        $this->db->select('schoolyear');
        $this->db->distinct();
        $this->db->from('enrollgradestbl');
        $this->db->where('studentnumber', $currentStudent);
        $query = $this->db->get();
        return $query->result();
    }

    public function loadStudentSem($currentStudent){
        $this->db->select('semester');
        $this->db->distinct();
        $this->db->from('enrollgradestbl');
        $this->db->where('studentnumber', $currentStudent);
        $query = $this->db->get();
        return $query->result();
    }

    public function loadStudentGrades($sy, $sem, $currentStudent){
        $this->db->select('*');
        $this->db->from('enrollgradestbl');
        $this->db->where('studentnumber', $currentStudent);
        $this->db->where('schoolyear', $sy);
        $this->db->where('semester', $sem);
        $query = $this->db->get();
        return $query->result();
    }

    public function getSemesterData($currentStudent, $schoolyear){
        $this->db->select('semester');
        $this->db->distinct();
        $this->db->from('enrollgradestbl');
        $this->db->where('studentnumber', $currentStudent);
        $this->db->where('schoolyear', $schoolyear);
        $query = $this->db->get();
        return $query->result();
    }


}