<?php

class Owner_Controller extends Manager_Controller {
	public function owner() {
		$this->template->test = "Test var";
		if(Acl_Core::allow([ACL::ACL_OWNER,ACL::ACL_ADMIN])){
			$this->view = "owner_backup";
        } else {
            header('Location: /error403'); //Forbidden
            exit();
        }
	}

	public function e() {
		$this->view = "owner";
	}

    public function restore(){

        $error = '';
        if($_POST){




            if($_FILES['dbbackup']['name'])
            {
                //if no errors...
                if(!$_FILES['dbbackup']['error'])
                {
                    $valid_file = true;
                    //var_dump($_FILES);
                    //now is the time to modify the future file name and validate the file
                    $new_file_name = strtolower($_FILES['dbbackup']['tmp_name']); //rename file


                    //if the file has passed the test
                    if($valid_file)
                    {
                        //move it to where we want it to be
                        //move_uploaded_file($_FILES['dbbackup']['tmp_name'], \System\System_Core::$sRootPath.DIRECTORY_SEPARATOR.'food_images'.DIRECTORY_SEPARATOR.strtolower($_FILES['food_image']['name']));
                        $error = 'Congratulations!  Your file was accepted. Database was restored';


                    }
                }
                //if there is an error...
                else
                {
                    //set that to be the returned message
                    $error = 'Ooops!  Your upload triggered the following error:  '.$_FILES['dbbackup']['error'];
                }
            }



            exec('/Applications/MAMP/Library/bin/mysql -u root -ptesttest -e "drop database chickcafe"');
            exec('/Applications/MAMP/Library/bin/mysql -u root -ptesttest -e "create database chickcafe"');
            $command = "/Applications/MAMP/Library/bin/mysql -u root -ptesttest chickcafe < ".$_FILES['dbbackup']['tmp_name'];
            exec($command);

        }

       // var_dump($_POST);
       // var_dump($output);
       // var_dump($return_var);

        $this->template->error = $error;

        $this->view = 'owner_restore';
    }
}