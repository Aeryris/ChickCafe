<?php

class Manager_Controller extends Staff_Controller {
	public function manager() {
        Auth_Core::init()->isAuth(true);
        /**
         * Set access to the /manager/manager
         */
        $oAcl = new Acl_Core(array(ACL::ACL_ADMIN | ACL::ACL_MANAGER));




		$this->template->test = "Test var";

		$this->view = "manager";
	}

	public function e() {
		$this->view = "manager";
	}
}