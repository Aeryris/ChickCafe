<?php

class Manager_Controller extends Staff_Controller {
	public function staff() {
		$this->template->test = "Test var";

		$this->view = "manager";
	}

	public function e() {
		$this->view = "manager";
	}
}