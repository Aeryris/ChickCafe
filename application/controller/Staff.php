<?php

class Staff_Controller extends Base_Controller{

	public function get_stock() {
		

		$this->view = "staff";
	}

	public function get_orders() {

		$this->view="staff";
	}

	public function approve_refund() {

	}

	public function modify_staff($sID) {
		
	}

	public function delete_staff($sID) {

	}

	public function get_profile() {
		$oUser = new User_Model();
		$oUser->attr(['email' => $_SESSION['user']]);
        if($oUser->exists()) {
			$type = $oUser->aData['user_type'];
			$oStaff = new Staff_Model($type, $oUser);
		}
		return $oStaff;
	}

    public function staff(){
        $oAcl = new Acl_Core(ACL::ACL_STAFF); 
        // $oAcl::setAccess(ACL::ACL_MANAGER,ACL::)
        $this->template->profile = $this->get_profile();
        $this->template->stock = $this->get_stock();
        $this->view = 'staff';
    }

    public function report() {
    	// $oAcl = new Acl_Core(ACL::ACL_MANAGER);

    	$this->view = 'report';
    }

    public function manager() {
    	// $oAcl = new Acl_Core(ACL::ACL_MANAGER);

    	$this->view = 'manager';
    }

    public function owner() {
    	// $oAcl = new Acl_Core(ACL::ACL_OWNER);

    	$this->view = 'owner';
    }

} 