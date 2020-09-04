<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Student_Model");
        $this->load->model("Enrollment_Model");

    }
    
    public function index(){
        $this->load->view('Student/Login');
    }

    public function validate_login(){

        $this->form_validation->set_rules('username','Username','trim|required|max_length[9]');
        $this->form_validation->set_rules('password','Password','trim|required|max_length[16]');

        if($this->input->post("username", TRUE)=='evaluatorDIT'){
            if($this->input->post("password", TRUE)=='1234'){
                $account_data = array(
                    'department'         => 'DIT',
                    'logged_in' 	     => TRUE
                );
                $this->session->set_userdata($account_data);
                redirect("student/evaluation","refresh");
            }
        } elseif($this->input->post("username", TRUE)=='evaluatorDM'){
            if($this->input->post("password", TRUE)=='1234'){
                if($this->input->post("password", TRUE)=='1234'){
                    $account_data = array(
                        'department'         => 'DM',
                        'logged_in' 	     => TRUE
                    );
                    $this->session->set_userdata($account_data);
                    redirect("student/evaluation","refresh");
                }
            }
        } elseif($this->input->post("username", TRUE)=='evaluatorDAS'){
            if($this->input->post("password", TRUE)=='1234'){
                if($this->input->post("password", TRUE)=='1234'){
                    $account_data = array(
                        'department'         => 'DAS',
                        'logged_in' 	     => TRUE
                    );
                    $this->session->set_userdata($account_data);
                    redirect("student/evaluation","refresh");
                }
            }
        } elseif($this->input->post("username", TRUE)=='evaluatorDTEL'){
            if($this->input->post("password", TRUE)=='1234'){
                if($this->input->post("password", TRUE)=='1234'){
                    $account_data = array(
                        'department'         => 'DTEL',
                        'logged_in' 	     => TRUE
                    );
                    $this->session->set_userdata($account_data);
                    redirect("student/evaluation","refresh");
                }
            }
        } else{
            if($this->form_validation->run() == TRUE){

                $defaultPass = 0;

                $passVal = $this->input->post("password", TRUE);

                $result = $this->Student_Model->validate_login();

                if($result['success']==TRUE){

                    if($passVal == '8cN8GpmMJ99rPJyy') {
                        $defaultPass = 1;
                    }
                    
                    $enrollment_status = 'OPEN';

                    $account_data = array(
                        'student_id'         => $result['student_id'],
                        'student_fn'         => $result['student_fn'],
                        'student_mn'         => $result['student_mn'],
                        'student_ln' 	     => $result['student_ln'],
                        'student_course' 	 => $result['student_course'],
                        'student_image'      => $result['student_image'],
                        'schoolyear'         => $result['schoolyear'],
                        'semester'           => $result['semester'],
                        'curriculum'         => $result['curriculum'],
                        'yearAdmitted'       => $result['yearAdmitted'],
                        'semesterAdmitted'   => $result['semesterAdmitted'],
                        'dbtype'             => $result['dbtype'],
                        'defaultPass'        => $defaultPass,
                        'enrollment'         => $enrollment_status,
                        'logged_in' 	     => TRUE
                    );

                    $this->session->set_userdata($account_data);

                    $this->session->set_flashdata("success","login sucess");


                    redirect("student/dashboard","refresh");


                }else{

                    $this->session->set_flashdata("error","invalid username/password.");
                }

                if($result['success']==FALSE){
                    redirect("Student","refresh");
                }


            }
            else{
                $this->session->set_flashdata("error","invalid username/password.");
                redirect("Student","refresh");
            }
        }

    }

    public function evaluation(){
        $department = $this->session->department;
        $query = $this->Enrollment_Model->loadEvalList($department);
        $module['evalData'] = $query;
        $module['standingYear'] = 0;
        $this->load->view('Enrollment/EvaluationList', $module);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect("Student","refresh");
    }


    public function password(){
        $this->load->view('Student/Password');
    }

    public function changepassword(){

        $newPassword = $this->input->post("newPassword",TRUE);
        $confirmPassword = $this->input->post("confirmPassword",TRUE);

        $query = $this->Student_Model->checkBday();

        if($query['success']==true){

            if($newPassword == $confirmPassword) {
                $result = $this->Student_Model->update_password();

                if($result['result']==true){
                    $message = "Password successfully updated. You will be automatically logout on our portal.";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    $this->session->sess_destroy();
                    redirect("Student","refresh");
                } else {
                    $this->session->set_flashdata("error", "Error on changing the password.");
                    redirect("student/password", "refresh");
                }
            } else {
                $this->session->set_flashdata("error", "Password didn't matched.");
                redirect("student/password", "refresh");
            }
        } else {
            $this->session->set_flashdata("error", "Wrong birthdate provided.");
            redirect("student/password", "refresh");
        }

    }


    public function dashboard(){
        $this->load->view('Student/Dashboard');
    }

    public function information(){
        $currentUser = $this->session->student_id;
        $currentSY = $this->session->schoolyear;
        $currentSem = $this->session->semester;

        $query = $this->Student_Model->loadStudentInfo($currentUser);
        $module['sfData'] = $query;

        $query = $this->Student_Model->getYearLevelandSection($currentSY, $currentSem, $currentUser);
        $module['YLSData'] = $query;

        $query = $this->Student_Model->loadStudentEnroll($currentUser);
        $module['siData'] = $query;

        $query = $this->Student_Model->loadProvinceData();
        $module['provData'] = $query;

        $query = $this->Student_Model->loadReligionData();
        $module['religionData'] = $query;



        $this->load->view('Student/Information', $module);
    }

    public function updateStudentInfo(){
        $result = $this->Student_Model->updateStudentInfoData();

        if($result['result']==true){
            $this->session->set_flashdata("success", "Data updated successfully.");
        } else {
            $this->session->set_flashdata("error", "Error on updating data.");
        }
        redirect("student/information", "refresh");

    }

    public function updatePersonalInfo(){
        $result = $this->Student_Model->updatePersonalInfoData();

        if($result['result']==true){
            $this->session->set_flashdata("success", "Data updated successfully.");
        } else {
            $this->session->set_flashdata("error", "Error on updating data.");
        }
        redirect("student/information", "refresh");
    }

    public function updateGuardianInfo(){
        $result = $this->Student_Model->updateGuardianInfoData();

        if($result['result']==true){
            $this->session->set_flashdata("success", "Data updated successfully.");
        } else {
            $this->session->set_flashdata("error", "Error on updating data.");
        }
        redirect("student/information", "refresh");
    }


    public function getMunicipality(){
        $provinceCode = $this->input->post('provCode',TRUE);
        $query = $this->Student_Model->getMunicipalityData($provinceCode);
        echo json_encode($query);
    }

    public function getBarangay(){
        $provinceCode = $this->input->post('provCode',TRUE);
        $municipalityCode = $this->input->post('munCode',TRUE);
        $query = $this->Student_Model->getBarangayData($provinceCode, $municipalityCode);
        echo json_encode($query);
    }

    public function subject(){

        $currentUser = $this->session->student_id;

        if($this->session->enrollment=='OPEN'){

            $OldSY = $this->session->schoolyear;
            $ldSem = $this->session->semester;

            if($ldSem=='FIRST') {
                $currentSY = $OldSY;
                $currentSem = 'SECOND';
            } else {
                $currentSY = (intval(substr($OldSY, 0, 4)) + 1) . "-" . (intval(substr($OldSY, 5, 4)) + 1);
                $currentSem = 'FIRST';
            }

        }else{

            $currentSY = $this->session->schoolyear;
            $currentSem = $this->session->semester;

        }


        $module['sY'] = $currentSY;
        $module['seM'] = $currentSem;

        $query = $this->Student_Model->loadEnrolledSubject($currentSY, $currentSem, $currentUser);
        $module['subjData'] = $query;

        $query = $this->Student_Model->getYearLevelandSection($currentSY, $currentSem, $currentUser);
        $module['YLSData'] = $query;

        $this->load->view('Student/Subject', $module);

    }


    public function schedule(){

        $currentUser = $this->session->student_id;

        if($this->session->enrollment=='OPEN'){

            $OldSY = $this->session->schoolyear;
            $ldSem = $this->session->semester;

            if($ldSem=='FIRST') {
                $currentSY = $OldSY;
                $currentSem = 'SECOND';
            } else {
                $currentSY = (intval(substr($OldSY, 0, 4)) + 1) . "-" . (intval(substr($OldSY, 5, 4)) + 1);
                $currentSem = 'FIRST';
            }

        }else{

            $currentSY = $this->session->schoolyear;
            $currentSem = $this->session->semester;

        }

        $module['studentid'] = $currentUser;
        $module['schoolyear'] = $currentSY;
        $module['semester'] = $currentSem;

        $query = $this->Student_Model->getYearLevelandSection($currentSY, $currentSem, $currentUser);
        $module['YLSData'] = $query;

        $this->load->view('Student/Schedule', $module);
    }


    public function grades(){
        $currentUser = $this->session->student_id;
        $currentSY = $this->session->schoolyear;
        $currentSem = $this->session->semester;

        $query = $this->Student_Model->loadStudentSY($currentUser);
        $module['syData'] = $query;

        $query = $this->Student_Model->loadStudentSem($currentUser);
        $module['semData'] = $query;

        $query = $this->Student_Model->loadStudentGrades($currentSY, $currentSem, $currentUser);
        $module['gradesData'] = $query;

        $query = $this->Student_Model->getYearLevelandSection($currentSY, $currentSem, $currentUser);
        $module['YLSData'] = $query;


        $module['SY'] = $currentSY;
        $module['Sem'] = $currentSem;

        $this->load->view('Student/Grades', $module);
    }


    public function view_grades(){

        $currentUser = $this->session->student_id;
        $currentSY = $this->input->post('schoolyear', true);
        $currentSem = $this->input->post('semester', true);

        $query = $this->Student_Model->loadStudentSY($currentUser);
        $module['syData'] = $query;

        $query = $this->Student_Model->loadStudentGrades($currentSY, $currentSem, $currentUser);
        $module['gradesData'] = $query;

        $query = $this->Student_Model->getYearLevelandSection($currentSY, $currentSem, $currentUser);
        $module['YLSData'] = $query;

        $module['SY'] = $currentSY;
        $module['Sem'] = $currentSem;

        $this->load->view('Student/Grades', $module);

    }

    public function checklist($studentID){

        $gCurriculum = $this->Enrollment_Model->getCurriculumID($studentID);

        $cID = $gCurriculum['curriculumID'];

        $module['studentNum'] = $gCurriculum['studentNumber'];
        $module['studentName'] = $gCurriculum['firstName'] ." ". $gCurriculum['lastName'];
        $module['course'] = $gCurriculum['course'];

        $query = $this->Student_Model->loadStudentSY($studentID);
        $module['schoolYearData'] = $query;

        $module['Curriculum'] = $cID;

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


    public function getSemester(){
        $currentStudent = $this->session->student_id;
        $schoolyear = $this->input->post('schoolyear',TRUE);
        $query = $this->Student_Model->getSemesterData($currentStudent, $schoolyear);
        echo json_encode($query);
    }

    public function color($i){
        $color = array("#06214c","#ff8000","#00b33c","#002db3","#cc8800","#0000cc","#803300","#00802b","#990099","#34d26");
        return $color[$i];
    }


    public function loadSchedules(){

        $schoolyear = $this->input->post('schoolyear1');
        $semester = $this->input->post('semester1');
        $studentNumber = $this->input->post('studentid1');

        $fresult = array();
        $result = $this->Student_Model->getScheduleBySectionWithTitle($schoolyear, $semester, $studentNumber);
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

    public function gradesRequest(){

        $studentNumber = $this->input->post('studentID', true);

        $result = $this->Student_Model->addGradesRequest();

        if($result['result']==true){
            $message = "Request was sent successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = "Error on sending request.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        redirect("student/checklist/".$studentNumber, "refresh");
    }

    public function resetPassword($studentNumber){
        $result = $this->Student_Model->resetPasswordData($studentNumber);

        if($result['result']==true){
            $message = "Successful";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = "Error";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    public function resetPassword2($studentNumber){
        $result = $this->Student_Model->resetPasswordData2($studentNumber);

        if($result['result']==true){
            $message = "Successful";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = "Error";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    public function displayBirthdate($studentNumber){
        $result = $this->Student_Model->displayBirthdateData($studentNumber);
        $message = "Date of birth : ".$result['dateOfBirth'];
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    public function displayBirthdate2($studentNumber){
        $result = $this->Student_Model->displayBirthdateData2($studentNumber);
        $message = "Date of birth : ".$result['dateOfBirth'];
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    public function missingGrades(){

        $query = $this->Student_Model->displayMissingGrades();
        $module['missingData'] = $query;
        $query = $this->Student_Model->gradesOnNewDB();
        $module['gradesNew'] = $query;

        $this->load->view('Student/MissingGrades', $module);
    }

    public function searchGradesToOld(){
        $studentnumber = $this->input->post('studentnumber',TRUE);
        $schoolyear = $this->input->post('schoolyear',TRUE);
        $semester = $this->input->post('semester',TRUE);
        $subjectcode = $this->input->post('subjectcode',TRUE);

        $query = $this->Student_Model->searchGradesOldDB($studentnumber, $subjectcode, $schoolyear, $semester);
        echo json_encode($query);
    }

    public function addGradesCvSUdatabase(){
        $result = $this->Student_Model->addGradesNewDB();

        if($result['result']==true){
            $studentNumber = $this->input->post('studentNumber', true);
            $schoolyear = $this->input->post('schoolyear', true);
            $semester = $this->input->post('semester', true);
            $subjectcode = $this->input->post('subjectcode', true);

            $deleteRequest = $this->Student_Model->deleteOnRequestData($studentNumber, $schoolyear, $semester, $subjectcode);

            $message = "Successful";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = "Error";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        redirect("student/missingGrades", "refresh");
    }

    public function resetEnrollmentManual($studentNumber){
        $result = $this->Student_Model->resetEnrollmentManualData($studentNumber);

        if($result['result']==true){

            $subjectData = $this->Student_Model->resetEnrollmentSubjectData($studentNumber);

            $message = "Reset Successful";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = "Error";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }


}
