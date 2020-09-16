<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_Model extends CI_Model
{

    function __construct(){
        parent::__construct();
        $this->cvsu = $this->load->database('cvsu', TRUE);
        $this->hr = $this->load->database('hr', TRUE);
    }


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
        $dbtype = array();

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

            $currentSYS = $this->db->get('legend');
            if($currentSYS->num_rows() == 1){
                $data =  $currentSYS->row();
                $schoolyear = $data->schoolyear;
                $semester = $data->semester;
            }

            $dbtype = 1;

        } else {

            $userName = $this->input->post("username", TRUE);
            $userPass = md5($this->input->post("password", TRUE));

            $this->cvsu->where('StudentNumber', $userName);
            $this->cvsu->where('portalPassword', $userPass);

            $admin_account_old = $this->cvsu->get('studentinfo');


            if ($admin_account_old->num_rows() == 1) {

                $rs_old = $admin_account_old->row();
                $result = true;
                $student_id = $rs_old->StudentNumber;
                $student_fn = $rs_old->FirstName;
                $student_mn = $rs_old->MiddleName;
                $student_ln = $rs_old->LastName;
                $student_course = $rs_old->CourseCode;
                $student_image = $rs_old->image;
                $curriculum = $rs_old->curriculumid;
                $yearAdmitted = $rs_old->AdmittedYear;
                $semesterAdmitted = $rs_old->AdmittedSemester;

            }

            $currentSYS = $this->cvsu->get('legend');
            if($currentSYS->num_rows() == 1){
                $data =  $currentSYS->row();
                $schoolyear = $data->schoolyear;
                $semester = $data->semester;
            }

            $dbtype = 2;
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
            'semesterAdmitted' => $semesterAdmitted,
            'dbtype' => $dbtype
        );

    }


    public function checkBday(){
        $result = array();
        $studentNumber = $this->session->student_id;

        if($this->session->dbtype == 1){
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

        }else {

            $postDate = date_create($this->input->post('dob', true));
            $postDOB = date_format($postDate,'m/d/Y');;

            $this->cvsu->where('StudentNumber', $studentNumber);

            $admin_account = $this->cvsu->get("studentinfo");

            if ($admin_account->num_rows() == 1) {
                $rs = $admin_account->row();

                $date = date_create($rs->Birthday);
                $dob = date_format($date,'m/d/Y');

                if($postDOB == $dob) {
                    $result = true;
                } else {
                    $result = false;
                }

            }

        }

        return array(
            'success' => $result,
        );

    }

    public function update_password(){

        $studentNumber = $this->session->student_id;
        $n_password = md5($this->input->post("newPassword",TRUE));

        if($this->session->dbtype == 1){
            $this->db->set('web_password', $n_password);
            $this->db->where('studentNumber', $studentNumber);
            $this->db->update('enrollstudentinformation');
            $result = ($this->db->affected_rows() != 1) ? false : true;
        }else {
            $this->cvsu->set('portalPassword', $n_password);
            $this->cvsu->where('StudentNumber', $studentNumber);
            $this->cvsu->update('studentinfo');
            $result = ($this->cvsu->affected_rows() != 1) ? false : true;
        }

        return array(
            'result'    => $result
        );
    }


    public function loadStudentInfo($currentStudent){
        if($this->session->dbtype == 1){
            $this->db->select('*');
            $this->db->from('enrollstudentinformation');
            $this->db->where('studentNumber', $currentStudent);
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('StudentNumber as studentNumber, FirstName as firstName, LastName as lastName, MiddleName as middleName, Street as street, Barangay as barangay, Municipality as municipality, Province as province, Birthday as dateOfBirth, Sex as gender, Status as status, Citizenship as citizenship, Religion as religion, Guardian as guardian, Phone as mobilePhone, "N/A" as email, "" as suffix');
            $this->cvsu->from('studentinfo');
            $this->cvsu->where('StudentNumber', $currentStudent);
            $query = $this->cvsu->get();
            return $query->result();
        }

    }

    public function loadStudentEnroll($currentStudent){
        if($this->session->dbtype == 1){
            $this->db->select('MAX(yearLevel) AS ylevel, enrollcoursetbl.courseTitle, enrollstudentenroll.majorCourse');
            $this->db->from('enrollstudentenroll');
            $this->db->join('enrollcoursetbl','enrollcoursetbl.courseCode = enrollstudentenroll.coursenow');
            $this->db->where('enrollstudentenroll.studentNumber', $currentStudent);
            $query = $this->db->get();
            return $query->result();
        }else{


            $this->db->select('MAX(yearLevel) AS ylevel, enrollcoursetbl.courseTitle, enrollstudentenroll.majorCourse');
            $this->db->from('enrollstudentenroll');
            $this->db->join('enrollcoursetbl','enrollcoursetbl.courseCode = enrollstudentenroll.coursenow');
            $this->db->where('enrollstudentenroll.studentNumber', $currentStudent);
            $query = $this->db->get();
            return $query->result();

        }

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

        $this->db->where('provCode', $provCode);
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

        if($this->session->dbtype == 1){
            $this->db->set('firstName', $this->input->post('student_fn', true));
            $this->db->set('middleName', $this->input->post('student_mn', true));
            $this->db->set('lastName', $this->input->post('student_ln', true));
            $this->db->where('studentNumber', $studentNumber);
            $this->db->update('enrollstudentinformation');
            $result = ($this->db->affected_rows() != 1) ? false : true;
        }else {
            $this->cvsu->set('FirstName', $this->input->post('student_fn', true));
            $this->cvsu->set('MiddleName', $this->input->post('student_mn', true));
            $this->cvsu->set('LastName', $this->input->post('student_ln', true));
            $this->cvsu->where('StudentNumber', $studentNumber);
            $this->cvsu->update('studentinfo');
            $result = ($this->cvsu->affected_rows() != 1) ? false : true;
        }

        return array(
            'result'    => $result
        );

    }

    public function updatePersonalInfoData(){

        $studentNumber = $this->session->student_id;

        if($this->session->dbtype == 1){
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
        }else {
            $this->cvsu->set('Province', $this->input->post('province', true));
            $this->cvsu->set('Municipality', $this->input->post('municipality', true));
            $this->cvsu->set('Barangay', $this->input->post('barangay', true));
            $this->cvsu->set('Street', $this->input->post('street', true));
            $this->cvsu->set('Birthday', date(dateformatdb, strtotime($this->input->post('dob', true))));
            $this->cvsu->set('Sex', $this->input->post('gender', true));
            $this->cvsu->set('Status', $this->input->post('status', true));
            $this->cvsu->set('Citizenship', $this->input->post('citizenship', true));
            $this->cvsu->set('Religion', $this->input->post('religion', true));
            $this->cvsu->where('StudentNumber', $studentNumber);
            $this->cvsu->update('studentinfo');
            $result = ($this->cvsu->affected_rows() != 1) ? false : true;
        }

        return array(
            'result'    => $result
        );
    }

    public function updateGuardianInfoData(){
        $studentNumber = $this->session->student_id;

        if($this->session->dbtype == 1){
            $this->db->set('guardian', $this->input->post('guardian', true));
            $this->db->set('mobilePhone', $this->input->post('mobilePhone', true));
            $this->db->where('studentNumber', $studentNumber);
            $this->db->update('enrollstudentinformation');
            $result = ($this->db->affected_rows() != 1) ? false : true;
        }else {
            $this->cvsu->set('Guardian', $this->input->post('guardian', true));
            $this->cvsu->set('Phone', $this->input->post('mobilePhone', true));
            $this->cvsu->where('StudentNumber', $studentNumber);
            $this->cvsu->update('studentinfo');
            $result = ($this->cvsu->affected_rows() != 1) ? false : true;
        }



        return array(
            'result'    => $result
        );
    }



    public function loadEnrolledSubject($currentSY, $currentSem, $currentUser){

        if($this->session->dbtype == 1){
            $this->db->select('enrollsubjectenrolled.schedcode, enrollscheduletbl.subjectCode, enrollsubjectstbl.subjectTitle, enrollscheduletbl.units, enrollscheduletbl.instructor');
            $this->db->from('enrollsubjectenrolled');
            $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollsubjectenrolled.schedcode', 'left');
            $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = enrollscheduletbl.subjectCode');
            $this->db->where('enrollsubjectenrolled.studentnumber', $currentUser);
            $this->db->where('enrollsubjectenrolled.schoolyear', $currentSY);
            $this->db->where('enrollsubjectenrolled.semester', $currentSem);
            $query = $this->db->get();
            return $query->result();
        }else{
            $this->cvsu->select('enrolledsubject.SchedCode as schedcode, enrollscheduletbl.subjectCode, coursecode.Title as subjectTitle, enrollscheduletbl.units, enrollscheduletbl.instructor');
            $this->cvsu->from('enrolledsubject');
            $this->cvsu->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrolledsubject.SchedCode', 'left');
            $this->cvsu->join('coursecode', 'coursecode.Code = enrollscheduletbl.subjectCode');
            $this->cvsu->where('enrolledsubject.StudentNumber', $currentUser);
            $this->cvsu->where('enrolledsubject.Schoolyear', $currentSY);
            $this->cvsu->where('enrolledsubject.semester', $currentSem);
            $query = $this->cvsu->get();
            return $query->result();
        }


    }

    public function loadStudentSY($studentID){
        if($this->session->dbtype == 1){
            $this->db->select('schoolyear');
            $this->db->distinct();
            $this->db->from('enrollgradestbl');
            $this->db->where('studentnumber', $studentID);
            $this->db->order_by('schoolyear', 'ASC');
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('Schoolyear as schoolyear');
            $this->cvsu->distinct();
            $this->cvsu->from('grades');
            $this->cvsu->where('StudentNumber', $studentID);
            $this->cvsu->order_by('Schoolyear', 'ASC');
            $query = $this->cvsu->get();
            return $query->result();
        }
    }

    public function loadStudentSem($currentStudent){
        if($this->session->dbtype == 1){
            $this->db->select('semester');
            $this->db->distinct();
            $this->db->from('enrollgradestbl');
            $this->db->where('studentnumber', $currentStudent);
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('Semester as semester');
            $this->cvsu->distinct();
            $this->cvsu->from('grades');
            $this->cvsu->where('StudentNumber', $currentStudent);
            $query = $this->cvsu->get();
            return $query->result();
        }
    }

    public function loadStudentGrades($sy, $sem, $currentStudent){
        if($this->session->dbtype == 1){
            $this->db->select('schedcode, subjectcode, units, mygrade');
            $this->db->distinct();
            $this->db->from('enrollgradestbl');
            $this->db->where('studentnumber', $currentStudent);
            $this->db->where('schoolyear', $sy);
            $this->db->where('semester', $sem);
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('SchedCode as schedcode, CourseCode as subjectcode, CreditUnits as units, Grade as mygrade');
            $this->cvsu->distinct();
            $this->cvsu->from('grades');
            $this->cvsu->where('StudentNumber', $currentStudent);
            $this->cvsu->where('Schoolyear', $sy);
            $this->cvsu->where('Semester', $sem);
            $query = $this->cvsu->get();
            return $query->result();
        }
    }

    public function getSemesterData($currentStudent, $schoolyear){
        if($this->session->dbtype == 1){
            $this->db->select('semester');
            $this->db->distinct();
            $this->db->from('enrollgradestbl');
            $this->db->where('studentnumber', $currentStudent);
            $this->db->where('schoolyear', $schoolyear);
            $query = $this->db->get();
            return $query->result();
        }else {
            $this->cvsu->select('semester');
            $this->cvsu->distinct();
            $this->cvsu->from('grades');
            $this->cvsu->where('StudentNumber', $currentStudent);
            $this->cvsu->where('Schoolyear', $schoolyear);
            $query = $this->cvsu->get();
            return $query->result();
        }
    }

    public function getYearLevelandSection($sy, $sem, $currentStudent){
        if($this->session->dbtype == 1){
            $this->db->select('DISTINCT(enrollscheduletbl.section), COUNT(enrollscheduletbl.section) AS NoOfSubject');
            $this->db->from('enrollsubjectenrolled');
            $this->db->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrollsubjectenrolled.schedcode');
            $this->db->where('enrollsubjectenrolled.studentnumber', $currentStudent);
            $this->db->where('enrollsubjectenrolled.schoolyear', $sy);
            $this->db->where('enrollsubjectenrolled.semester', $sem);
            $this->db->order_by('NoOfSubject', 'ASC');
            $query = $this->db->get();
            return $query->result();
        }else {

            $this->cvsu->select('DISTINCT(schedcode.Section) as section, COUNT(schedcode.Section) AS NoOfSubject');
            $this->cvsu->from('enrolledsubject');
            $this->cvsu->join('schedcode', 'schedcode.SubjectCode = enrolledsubject.SchedCode');
            $this->cvsu->where('enrolledsubject.StudentNumber', $currentStudent);
            $this->cvsu->where('enrolledsubject.Schoolyear', $sy);
            $this->cvsu->where('enrolledsubject.semester', $sem);
            $this->cvsu->order_by('NoOfSubject', 'ASC');
            $query = $this->cvsu->get();
            return $query->result();

            //$this->cvsu->select('DISTINCT(enrollscheduletbl.section) as section, COUNT(enrollscheduletbl.section) AS NoOfSubject');
            //$this->cvsu->from('enrolledsubject');
            //$this->cvsu->join('enrollscheduletbl', 'enrollscheduletbl.schedcode = enrolledsubject.SchedCode');
            //$this->cvsu->where('enrolledsubject.StudentNumber', $currentStudent);
            //$this->cvsu->where('enrolledsubject.Schoolyear', $sy);
            //$this->cvsu->where('enrolledsubject.semester', $sem);
            //$this->cvsu->order_by('NoOfSubject', 'ASC');
            //$query = $this->cvsu->get();
            //return $query->result();
        }
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

    public function resetPasswordData($studentNumber){

        $resetPassword = '81dc9bdb52d04dc20036dbd8313ed055';

        $this->db->set('web_password', $resetPassword);
        $this->db->where('studentNumber', $studentNumber);
        $this->db->update('enrollstudentinformation');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );

    }

    public function resetPasswordData2($studentNumber){

        $resetPassword = '81dc9bdb52d04dc20036dbd8313ed055';

        $this->cvsu->set('portalPassword', $resetPassword);
        $this->cvsu->where('StudentNumber', $studentNumber);
        $this->cvsu->update('studentinfo');
        $result = ($this->cvsu->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );

    }

    public function displayBirthdateData($studentNumber){

        $birthdate = array();
        $this->db->where('studentNumber', $studentNumber);
        $admin_account = $this->db->get("enrollstudentinformation");

        if ($admin_account->num_rows() == 1) {
            $rs = $admin_account->row();
            $birthdate = $rs->dateOfBirth;
        }

        return array(
            'dateOfBirth' => $birthdate
        );

    }

    public function displayBirthdateData2($studentNumber){

        $birthdate = array();
        $this->cvsu->where('StudentNumber', $studentNumber);
        $admin_account = $this->cvsu->get("studentinfo");

        if ($admin_account->num_rows() == 1) {
            $rs = $admin_account->row();
            $birthdate = $rs->Birthday;
        }

        return array(
            'dateOfBirth' => $birthdate
        );

    }


    public function displayMissingGrades(){
        $this->db->select('*');
        $this->db->distinct();
        $this->db->from('requestedgradestbl');
        $this->db->join('enrollsubjectstbl', 'enrollsubjectstbl.subjectcode = requestedgradestbl.subjectCode');
        $this->db->where('requestedgradestbl.section Like', '%BM%');
        $query = $this->db->get();
        return $query->result();
    }

    public function gradesOnNewDB(){
        $this->db->select('*');
        $this->db->from('enrollgradestbl');
        $query = $this->db->get();
        return $query->result();
    }




    public function searchGradesOldDB($studentnumber, $subjectcode, $schoolyear, $semester){
        $this->cvsu->select('*');
        $this->cvsu->from('grades');
        $this->cvsu->where('StudentNumber', $studentnumber);
        $this->cvsu->where('CourseCode', $subjectcode);
        $this->cvsu->where('Schoolyear', $schoolyear);
        $this->cvsu->where('Semester', $semester);
        $query = $this->cvsu->get();
        return $query->result();
    }

    public function addGradesNewDB(){
        $data = array(
            'subjectcode'      =>  $this->input->post('subjectcode', true),
            'studentnumber'    =>  $this->input->post('studentNumber', true),
            'schedcode'        =>  $this->input->post('schedulecode', true),
            'mygrade'          =>  $this->input->post('grade', true),
            'units'            =>  $this->input->post('unit', true),
            'semester'         =>  $this->input->post('semester', true),
            'schoolyear'       =>  $this->input->post('schoolyear', true),
            'graded'           =>  'Y'
        );

        $result = $this->db->insert('enrollgradestbl', $data);
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }

    public function deleteOnRequestData($studentNumber, $schoolyear, $semester, $subjectcode){
        $this->db->where('studentNumber', $studentNumber);
        $this->db->where('schoolyear', $schoolyear);
        $this->db->where('semester', $semester);
        $this->db->where('subjectCode', $subjectcode);
        $this->db->delete('requestedgradestbl');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }

    public function resetEnrollmentManualData($studentNumber){
        $this->db->where('studentNumber', $studentNumber);
        $this->db->delete('enrollment_tracker');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }

    public function resetEnrollmentSubjectData($studentNumber){
        $this->db->where('studentNumber', $studentNumber);
        $this->db->delete('enrollment_subjectlist');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }

    public function getFacultyName(){
        $this->hr->select('*');
        $this->hr->from('employee');
        $query = $this->hr->get();
        return $query->result();
    }

    public function loadLMSData($currentUser){

        if($this->session->dbtype == 1){
            $this->db->select('*');
            $this->db->from('cvsu_lmsinfo');
            $this->db->where('profile_field_studentno', $currentUser);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->cvsu->select('*');
            $this->cvsu->from('cvsu_lmsinfo');
            $this->cvsu->where('profile_field_studentno', $currentUser);
            $query = $this->cvsu->get();
            return $query->result();
        }

    }

    public function getYearCurriculumInfo($curriculum){
        $this->db->select('*');
        $this->db->from('enrollcurriculum');
        $this->db->where('id', $curriculum);
        $query = $this->db->get();
        return $query->result();
    }


}