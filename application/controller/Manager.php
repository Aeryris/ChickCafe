<?php

class Manager_Controller extends Staff_Controller {
	public function manager() {
        Auth_Core::init()->isAuth(true);
		$this->template->test = "Test var";

		$this->view = "manager";
	}

	public function e() {
		$this->view = "manager";
	}
}