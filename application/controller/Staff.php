<?php

class Staff_Controller extends Base_Controller{

	public function get_stock() {
		$this->template->oMenuItems = MenuItems_Model::menu()->getByMenuId(1)->data();
		$this->view = "staff";
	}

	public function get_orders() {

		$this->view="staff";
	}

	public function approve_refund() {

	}

    public function get_staff() {
        
    }

	public function create_staff() {
		if(Input_Core::getPost()){
            $sEmail = Field::post('email')->required()->validation('/@/i');
            $sPassword = Field::post('password')->required();
            $sConfirmPassword = Field::post('passwordconfirm')->required()->equalsTo('password');
            $sFirstName = Field::post('firstname')->required();
            $sLastName = Field::post('lastname')->required();
            $sRole = Field::post('role')->required();
            $sSalary = Field::post('salary')->required();
            $sPhoneNumber = Field::post('phonenumber')->required();

            $oLoginForm = new Form_Core(array($sEmail, $sPassword, $sConfirmPassword, $sFirstName, $sLastName));

            if($oLoginForm->validate()){
                $oUser = new User_Model();
                $oUser->attr(['email' => $sEmail->value(), 'password' => $oUser->passwordSecure($sPassword->value())]);
                if(!$oUser->exists()){
                    $oUser->add()
                          ->setType($oStaff = new Staff_Model('S'))
                          ->setEmail($sEmail->value())
                          ->setPassword($oUser->passwordSecure($sPassword->value()))
                          ->setFirstName($sFirstName->value())
                          ->setLastName($sLastName->value())
        
                          ->setSalary($sSalary->value())
                          ->setRole($sRole->value())
                          ->setPhoneNumber($sPhoneNumber->value())
                          ->save();
                    header('Location: /staff/manager');
                    exit();
                }else{
                    $oLoginForm->sErrors .= 'User already exists in our system. <br />';
                }

            }
            $this->template->errors = $oLoginForm->sErrors;
        }

        $this->view = 'manager';
	}

	public function modify_staff($sID) {
		if ($sID != null) {
			$sQuery = 'UPDATE staff SET staff_role = :role,
                                        staff_salary = :salary,
                                        staff_phone_number = :number
                                         WHERE staff_user_id = :id';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindParam(':role', $this->type->role, PDO::PARAM_STR);
            $oStmt->bindParam(':salary', $this->type->salary, PDO::PARAM_STR);
            $oStmt->bindParam(':number', $this->type->phoneNumber, PDO::PARAM_STR);
            $oStmt->bindParam(':id', $lastId, PDO::PARAM_INT);

            $oExecute = $oStmt->execute();
		} 
	}

	public function delete_staff($sID) {
		if ($sID != null) {

		} 
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
    	$this->template->create_staff = $this->create_staff();
    	$this->view = 'manager';
    }

    public function owner() {
    	// $oAcl = new Acl_Core(ACL::ACL_OWNER);

    	$this->view = 'owner';
    }

} 