// Controller: Dashboard.php
<?php
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('HospitalModel');
    }
    
    public function index() {
        $data['totalPatients'] = $this->HospitalModel->getTotalPatients();
        $data['totalAdmissions'] = $this->HospitalModel->getTotalAdmissions();
        $data['admissionsByDept'] = $this->HospitalModel->getAdmissionsByDepartment();
        
        $this->load->view('dashboard_view', $data);
    }
    
    public function fetchDynamicData() {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $data = $this->HospitalModel->getDynamicData($startDate, $endDate);
        echo json_encode($data);
    }
}
