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
        $curriculum = array();
        $yearAdmitted = array();
        $semesterAdmitted = array();


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
            $curriculum = $rs->curriculumid;
            $yearAdmitted = $rs->yearAdmitted;
            $semesterAdmitted = $rs->SemesterAdmitted;
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
            'semester' => $semester,
            'curriculum' => $curriculum,
            'yearAdmitted' => $yearAdmitted,
            'semesterAdmitted' => $semesterAdmitted
        );

    }


    public function checkBday(){

        $result = array();
        $studentNumber = $this->session->student_id;
        $postDate = date_create($this->input->post('dob', true));
        $postDOB = date_format($postDate,'m/d/Y');;

        $this->db->where('studentNumber', $studentNumber);

        $admin_account = $this->db->get("enrollstudentinformation");

        if ($admin_account->num_rows() == 1) {
            $rs = $admin_account->row();

            $date = date_create($rs->dateOfBirth);
            $dob = date_format($date,'m/d/Y');

            if($postDOB == $dob) {
                $result = true;
            } else {
                $result = false;
            }

        }

        return array(
            'success' => $result,
        );

    }

    public function update_password(){

        $studentNumber = $this->session->student_id;

        $n_password = md5($this->input->post("newPassword",TRUE));

        $this->db->set('web_password', $n_password);

        $this->db->where('studentNumber', $studentNumber);
        $this->db->update('enrollstudentinformation');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
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

    public function loadProvinceData(){
        $this->db->select('*');
        $this->db->from('refprovince');
        $this->db->order_by('provDesc', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getMunicipalityData($provinceCode){

        $provCode = array();

        $this->db->where('provDesc', $provinceCode);
        $provData = $this->db->get("refprovince");

        if ($provData->num_rows() == 1) {
            $rs = $provData->row();
            $provCode = $rs->provCode;
        }

        $this->db->select('*');
        $this->db->from('refcitymun');
        $this->db->where('provCode', $provCode);
        $this->db->order_by('citymunDesc', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getBarangayData($provinceCode, $municipalityCode){

        $provCode = array();
        $munCode = array();

        $this->db->where('provDesc', $provinceCode);
        $provData = $this->db->get("refprovince");

        if ($provData->num_rows() == 1) {
            $rs = $provData->row();
            $provCode = $rs->provCode;
        }

        $this->db->where('citymunDesc', $municipalityCode);
        $munData = $this->db->get("refcitymun");

        if ($munData->num_rows() == 1) {
            $rs = $munData->row();
            $munCode = $rs->citymunCode;
        }


        $this->db->select('*');
        $this->db->from('refbrgy');
        $this->db->where('provCode', $provCode);
        $this->db->where('citymunCode', $munCode);
        $this->db->order_by('brgyDesc', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function loadReligionData(){
        $this->db->select('*');
        $this->db->from('religiontbl');
        $this->db->order_by('religion', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }


    public function updateStudentInfoData(){

        $studentNumber = $this->session->student_id;

        $this->db->set('firstName', $this->input->post('student_fn', true));
        $this->db->set('middleName', $this->input->post('student_mn', true));
        $this->db->set('lastName', $this->input->post('student_ln', true));

        $this->db->where('studentNumber', $studentNumber);
        $this->db->update('enrollstudentinformation');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );

    }

    public function updatePersonalInfoData(){

        $studentNumber = $this->session->student_id;

        $this->db->set('province', $this->input->post('province', true));
        $this->db->set('municipality', $this->input->post('municipality', true));
        $this->db->set('barangay', $this->input->post('barangay', true));
        $this->db->set('street', $this->input->post('street', true));

        $this->db->set('dateOfBirth', date(dateformatdb, strtotime($this->input->post('dob', true))));
        $this->db->set('gender', $this->input->post('gender', true));
        $this->db->set('status', $this->input->post('status', true));
        $this->db->set('citizenship', $this->input->post('citizenship', true));
        $this->db->set('religion', $this->input->post('religion', true));


        $this->db->where('studentNumber', $studentNumber);
        $this->db->update('enrollstudentinformation');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }

    public function updateGuardianInfoData(){
        $studentNumber = $this->session->student_id;

        $this->db->set('guardian', $this->input->post('guardian', true));
        $this->db->set('mobilePhone', $this->input->post('mobilePhone', true));

        $this->db->where('studentNumber', $studentNumber);
        $this->db->update('enrollstudentinformation');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
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

    public function loadStudentSY($studentID){
        $this->db->select('schoolyear');
        $this->db->distinct();
        $this->db->from('enrollgradestbl');
        $this->db->where('studentnumber', $studentID);
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
        $this->db->select('schedcode, subjectcode, units, mygrade');
        $this->db->distinct();
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

    public function getScheduleBySectionWithTitle($schoolyear, $semester, $studentNumber){
        $this->db->select('enrollscheduletbl.subjectcode, enrollscheduletbl.section, enrollscheduletbl.instructor, enrollscheduletbl.room1, enrollscheduletbl.room2, enrollscheduletbl.room3, enrollscheduletbl.room4, enrollscheduletbl.timein1, enrollscheduletbl.timeout1, enrollscheduletbl.day1, enrollscheduletbl.timein2, enrollscheduletbl.timeout2, enrollscheduletbl.day2, enrollscheduletbl.timein3, enrollscheduletbl.timeout3, enrollscheduletbl.day3, enrollscheduletbl.timein4, enrollscheduletbl.timeout4, enrollscheduletbl.day4, enrollsubjectstbl.subjectTitle');
        $this->db->from('enrollscheduletbl');
        $this->db->join('enrollsubjectenrolled', 'enrollsubjectenrolled.schedcode = enrollscheduletbl.schedcode');
        $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
        $this->db->where('enrollscheduletbl.schoolyear', $schoolyear);
        $this->db->where('enrollscheduletbl.semester', $semester);
        $this->db->where('enrollsubjectenrolled.studentNumber', $studentNumber);
        $query = $this->db->get();
        return $query->result();
    }


    public function addGradesRequest(){
        $data = array(
            'studentNumber'     =>  $this->input->post('studentID', true),
            'schoolyear'        =>  $this->input->post('schoolyear', true),
            'semester'          =>  $this->input->post('semester', true),
            'subjectCode'       =>  $this->input->post('subjectCode', true),
            'section'           =>  $this->input->post('section', true)
        );

        $result = $this->db->insert('requestedgradestbl', $data);
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );

    }


}