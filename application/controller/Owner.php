<?php

class Owner_Controller extends Manager_Controller {
	public function owner() {
		$this->template->test = "Test var";

		$this->view = "owner";
	}

	public function e() {
		$this->view = "owner";
	}
}