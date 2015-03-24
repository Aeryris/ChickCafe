<?php

class Staff_Controller extends Base_Controller {
	public function staff() {
		$this->template->test = "Test var";

		$this->view = "staff";
	}

	public function e() {
		$this->view = "staff";
	}
}