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
            $sType = Field::post('type')->required();

            $oLoginForm = new Form_Core(array($sEmail, $sPassword, $sConfirmPassword, $sFirstName, $sLastName));

            if($oLoginForm->validate()){
                $oUser = new User_Model();
                $oUser->attr(['email' => $sEmail->value(), 'password' => $oUser->passwordSecure($sPassword->value())]);
                if(!$oUser->exists()){
                    $oUser->add()
                          ->setType($oStaff = new Staff_Model($sType->value()))
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

    public function get_all_staff() {
        $this->db->beginTransaction();
        $sQuery = 'SELECT * from staff';
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function get_single_staff() {
        $sID = Field::post('staff_id')->required();
        $sID = $sID->value();
        $this->db->beginTransaction();
        $sQuery = "SELECT * FROM staff WHERE staff_user_id = :id LIMIT 1";

        $oStmt = $this->db->prepare($sQuery);
        $oStmt->bindParam(':id', $sID, PDO::PARAM_INT);

        $oExecute = $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

	public function modify_staff() {
        $sID = Field::post('staff_id')->required();
		if ($sID != null) {
            $sRole = Field::post('role')->required();
            $sSalary = Field::post('salary')->required();
            $sPhoneNumber = Field::post('phone')->required();
			
            $sQuery = 'UPDATE staff SET staff_role = :role,
                                        staff_salary = :salary,
                                        staff_phone_number = :number
                                         WHERE staff_user_id = :id';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindParam(':role', $sRole->value(), PDO::PARAM_STR);
            $oStmt->bindParam(':salary', $sSalary->value(), PDO::PARAM_STR);
            $oStmt->bindParam(':number', $sPhoneNumber->value(), PDO::PARAM_STR);
            $oStmt->bindParam(':id', $sID->value(), PDO::PARAM_INT);

            $oExecute = $oStmt->execute();

            $this->view = 'manager';
		} 
	}

	public function delete_staff() {
    $sID = Field::post('staff_id')->required();
		if ($sID != null) {
            $sRole = 'Unemployed';
            $sSalary = '0';
            $sPassword = ' ';

            $this->db->beginTransaction();
            $sQuery = 'UPDATE staff SET staff_role = :role
                                        WHERE staff_user_id = :id';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindParam(':role', $sRole, PDO::PARAM_STR);
            $oStmt->bindParam(':id', $sID->value(), PDO::PARAM_INT);

            $oExecute = $oStmt->execute();
            $this->db->commit();

            $this->db->beginTransaction();
            $sQuery = 'UPDATE user SET user_password = :password
                                    WHERE user_id = :id';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindParam(':password', $sPassword, PDO::PARAM_STR);
            $oStmt->bindParam(':id', $sID->value(), PDO::PARAM_STR);

            $oExecute = $oStmt->execute();
            $this->db->commit();

            $this->view = 'manager';
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
        // Auth_Core::init()->isAuth(true);
        // $oAcl = new Acl_Core(array(ACL::ACL_ADMIN | ACL::ACL_MANAGER | ACL::ACL_OWNER | ACL::ACL_STAFF)); 
        $this->template->profile = $this->get_profile();
        $this->template->stock = $this->get_stock();
        $this->view = 'staff';
    }

    public function report() {
	    // Auth_Core::init()->isAuth(true);
     //    $oAcl = new Acl_Core(array(ACL::ACL_ADMIN | ACL::ACL_MANAGER | ACL::ACL_OWNER)); 
    	$this->view = 'report';
    }

    public function manager() {
    	// $oAcl = new Acl_Core(ACL::ACL_MANAGER);
        // Auth_Core::init()->isAuth(true);
        // $oAcl = new Acl_Core(array(ACL::ACL_ADMIN | ACL::ACL_MANAGER)); 
    	$this->template->create_staff = $this->create_staff();
        $this->template->get_staff = $this->get_all_staff();
    	$this->view = 'manager';
    }
} 