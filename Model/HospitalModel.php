
<?php
class HospitalModel extends CI_Model {
    public function getTotalPatients() {
        return $this->db->count_all('patients');
    }
    
    public function getTotalAdmissions() {
        return $this->db->where('status', 'admitted')->count_all_results('admissions');
    }
    
    public function getAdmissionsByDepartment() {
        $this->db->select('department, COUNT(*) as total');
        $this->db->group_by('department');
        return $this->db->get('admissions')->result_array();
    }
    
    public function getDynamicData($startDate, $endDate) {
        $this->db->select('date, department, COUNT(*) as total');
        $this->db->where('date >=', $startDate);
        $this->db->where('date <=', $endDate);
        $this->db->group_by(['date', 'department']);
        return $this->db->get('admissions')->result_array();
    }
}