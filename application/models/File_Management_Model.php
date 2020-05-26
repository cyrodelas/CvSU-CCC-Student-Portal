<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class File_Management_Model extends CI_Model
{
    private $cvsuhrdb;
    function __construct(){
        parent::__construct();
        $this->cvsuhrdb = $this->load->database('cvsu_hr', TRUE);
    }

    public function validate_login()
    {
        $result = array();
        $employee_fn = array();
        $employee_mn = array();
        $employee_ln = array();
        $employee_dept = array();
        $employee_des = array();

        $password = md5(1234);

        $this->db->where('employeecode', $this->input->post("username", TRUE));
        $admin_account = $this->cvsuhrdb->get("employee");

        if($admin_account->num_rows() > 0) {
            if($password == $this->input->post("password", TRUE)){
                $rs = $admin_account->row();
                $result = true;
                $employee_fn = $rs->employeefirstname;
                $employee_mn = $rs->employeemiddlename;
                $employee_ln = $rs->employeelastname;
                $employee_dept = $rs->departmentcode;
                $employee_des = $rs->designationname;
            } else {
                $result = false;
            }

        }

        return array(
            'success'       => $result,
            'employee_fn'   => $employee_fn,
            'employee_mn'   => $employee_mn,
            'employee_ln'   => $employee_ln,
            'employee_dept' => $employee_dept,
            'employee_des'  => $employee_des
        );

    }

    public function loadCurriculum(){
        $this->db->select('schoolyear');
        $this->db->distinct();
        $this->db->from('enrollcurriculum');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function loadPrograms($sy){
        $this->db->select('enrollcurriculum.id, enrollcurriculum.coursemajor, enrollcoursetbl.courseTitle');
        $this->db->from('enrollcurriculum');
        $this->db->join('enrollcoursetbl', 'enrollcoursetbl.courseCode = enrollcurriculum.course');
        $this->db->where('enrollcurriculum.schoolyear', $sy);
        $query = $this->db->get();
        return $query->result();
    }

    public function loadCourse(){
        $this->db->select('*');
        $this->db->from('enrollcoursetbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCourseMajorData($coursecode){
        $this->db->select('majorCourse');
        $this->db->from('enrollmajortbl');
        $this->db->where('course', $coursecode);
        $query = $this->db->get();
        return $query->result();
    }

    public function add_course_data(){
        $this->db->where('schoolyear', $this->input->post('schoolyear', true));
        $this->db->where('course', $this->input->post('coursecode', true));
        $this->db->where('coursemajor', $this->input->post('major', true));
        $data_checker = $this->db->get("enrollcurriculum");

        if ($data_checker->num_rows() == 0) {
            $data = array(
                'schoolyear'         =>  $this->input->post('schoolyear', true),
                'course'             =>  $this->input->post('coursecode', true),
                'coursemajor'        =>  $this->input->post('major', true)
            );

            $result = $this->db->insert('enrollcurriculum', $data);
            $result = ($this->db->affected_rows() != 1) ? false : true;
        } else {
            $result = false;
        }

        return array(
            'result'    => $result
        );
    }



    public function getCourseName($cID){

        $course = array();
        $code = array();
        $major = array();

        $this->db->select('enrollcoursetbl.courseTitle, enrollcurriculum.coursemajor, enrollcurriculum.course');
        $this->db->from('enrollcurriculum');
        $this->db->join('enrollcoursetbl', 'enrollcoursetbl.courseCode = enrollcurriculum.course');
        $this->db->where('enrollcurriculum.id', $cID);
        $courseName = $this->db->get();

        if ($courseName->num_rows() == 1) {
            $rs = $courseName->row();
            $course = $rs->courseTitle;
            $major = $rs->coursemajor;
            $code= $rs->course;
        }

        return array(
            'course_name' => $course,
            'code_name'   => $code,
            'major_name'  => $major
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

    public function add_subject_data(){

        if (isset($_POST['major'])) {
            $value = 1;
        } else {
            $value = 0;
        }

        $this->db->where('subjectcode', $this->input->post('subjectcode', true));
        $this->db->where('semester', $this->input->post('semester', true));
        $this->db->where('course', $this->input->post('course', true));
        $this->db->where('coursemajor', $this->input->post('coursemajor', true));
        $this->db->where('prerequisite', 'N/A');
        $this->db->where('yearlevel', $this->input->post('yearlevel', true));
        $this->db->where('isMajor', $value);
        $this->db->where('curriculumnid', $this->input->post('curriculumnid', true));
        $data_checker = $this->db->get("enrollcurriculumcontent2");

        if ($data_checker->num_rows() == 0) {
            $data = array(
                'subjectcode'         =>  $this->input->post('subjectcode', true),
                'semester'            =>  $this->input->post('semester', true),
                'course'              =>  $this->input->post('course', true),
                'coursemajor'         =>  $this->input->post('coursemajor', true),
                'prerequisite'        =>  'N/A',
                'yearlevel'           =>  $this->input->post('yearlevel', true),
                'isMajor'             =>  $value,
                'curriculumnid'       =>  $this->input->post('curriculumnid', true)
            );

            $result = $this->db->insert('enrollcurriculumcontent2', $data);
            $result = ($this->db->affected_rows() != 1) ? false : true;
        } else {
            $result = false;
        }


        return array(
            'result'    => $result
        );
    }



    public function subject_information_data(){
        $this->db->select('*');
        $this->db->from('enrollsubjectstbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function subject_information_add(){

        $this->db->where('subjectcode', $this->input->post('subjectcode', true));
        $this->db->where('subjectTitle', $this->input->post('subjectTitle', true));
        $this->db->where('lectUnits', $this->input->post('lectUnits', true));
        $this->db->where('labunits', $this->input->post('labunits', true));
        $this->db->where('description', $this->input->post('description', true));
        $data_checker = $this->db->get("enrollsubjectstbl");

        if ($data_checker->num_rows() == 0) {
            $data = array(
                'subjectcode'      =>  $this->input->post('subjectcode', true),
                'subjectTitle'     =>  $this->input->post('subjectTitle', true),
                'lectUnits'        =>  $this->input->post('lectUnits', true),
                'labunits'         =>  $this->input->post('labunits', true),
                'description'      =>  $this->input->post('description', true),
                'pr1'              =>  'N/A',
                'pr2'              =>  'N/A',
                'pr3'              =>  'N/A',
                'pr4'              =>  'N/A',
                'pr5'              =>  'N/A',
                'pr6'              =>  'N/A',
                'pr7'              =>  'N/A',
                'pr8'              =>  'N/A',
                'pr9'              =>  'N/A',
                'pr10'             =>  'N/A'
            );

            $result = $this->db->insert('enrollsubjectstbl', $data);
            $result = ($this->db->affected_rows() != 1) ? false : true;
        } else {
            $result = false;
        }


        return array(
            'result'    => $result
        );
    }

    public function subject_information_edit(){
        $sCode = $this->input->post('subjectcode', true);

        $this->db->set('subjectTitle', $this->input->post('subjectTitle', true));
        $this->db->set('lectUnits', $this->input->post('lectUnits', true));
        $this->db->set('description', $this->input->post('description', true));
        $this->db->set('labunits', $this->input->post('labunits', true));

        $this->db->where('subjectcode', $sCode);
        $this->db->update('enrollsubjectstbl');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }

    public function subject_information_delete($delete_value){

        $this->db->where('subjectcode', $delete_value);
        $this->db->delete('enrollsubjectstbl');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }


    public function pre_requisites_data($subjectCode){
        $this->db->select('*');
        $this->db->from('enrollsubjectstbl');
        $this->db->where('subjectcode', $subjectCode);
        $query = $this->db->get();
        return $query->result();
    }

    public function getSubNameData($subjectcode){
        $this->db->select('subjectTitle');
        $this->db->from('enrollsubjectstbl');
        $this->db->where('subjectcode', $subjectcode);
        $query = $this->db->get();
        return $query->result();
    }

    public function updatePreRequisiteData(){
        $sCode = $this->input->post('subjectcode', true);

        $this->db->set('pr1', $this->input->post('pr1', true));
        $this->db->set('pr2', $this->input->post('pr2', true));
        $this->db->set('pr3', $this->input->post('pr3', true));
        $this->db->set('pr4', $this->input->post('pr4', true));
        $this->db->set('pr5', $this->input->post('pr5', true));
        $this->db->set('pr6', $this->input->post('pr6', true));
        $this->db->set('pr7', $this->input->post('pr7', true));
        $this->db->set('pr8', $this->input->post('pr8', true));
        $this->db->set('pr9', $this->input->post('pr9', true));
        $this->db->set('pr10', $this->input->post('pr10', true));

        $this->db->where('subjectcode', $sCode);
        $this->db->update('enrollsubjectstbl');
        $result = ($this->db->affected_rows() != 1) ? false : true;

        return array(
            'result'    => $result
        );
    }

}