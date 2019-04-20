<?php
  require_once("Security.class.php");
  require_once("Db.class.php");

    class User {
        private $firstname;
        private $lastname;
        private $username;
        private $email;
        private $password;
        private $passwordConfirmation;



        /**
         * Get the value of email
         */
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of passwordConfirmation
         */
        public function getPasswordConfirmation()
        {
                return $this->passwordConfirmation;
        }

        /**
         * Set the value of passwordConfirmation
         *
         * @return  self
         */
        public function setPasswordConfirmation($passwordConfirmation)
        {
                $this->passwordConfirmation = $passwordConfirmation;

                return $this;
        }


        /**
         * Get the value of firstname
         */ 
        public function getFirstname()
        {
                return $this->firstname;
        }

        /**
         * Set the value of firstname
         *
         * @return  self
         */ 
        public function setFirstname($firstname)
        {
                $this->firstname = $firstname;

                return $this;
        }

        /**
         * Get the value of lastname
         */ 
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
                $this->lastname = $lastname;

                return $this;
        }

        /**
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }
         /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 

        /*
        ./@return boolean - true if registration successful, false if unsuccessful
        */
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }
        public function register(){
            $password = Security::hash($this->password);
  
              try{
                
                $conn = Db::getInstance();
                var_dump($conn->errorCode());
                $statement = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password) values (:firstname, :lastname, :username, :email, :password)");
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":firstname", $this->firstname);
                $statement->bindParam(":lastname", $this->lastname);
                $statement->bindParam(":username", $this->username);
                $statement->bindParam(":password", $password);
                $result = $statement->execute();
                return $result;
              }catch(Throwable $t){
                  return false;
              }
        }
        public static function saveDiscription($userName){
                //echo "test";
                $myDiscr = htmlspecialchars($_POST['myDiscr'], ENT_QUOTES);

                try{
                        $conn = Db::getInstance();
                        $stmntDisc = $conn->prepare("update users set description = :disc where username = :userName ");
                        $stmntDisc->bindParam(":disc", $myDiscr);
                        $stmntDisc->bindParam(":userName", $userName);
                        $result = $stmntDisc->execute();
                        return $result;
                }catch(Throwable $t){
                        echo $t;
                }
        }
        public static function changePass($old, $new, $newComf,$userName){
                try{
                        $conn = Db::getInstance();
                        $stmntPass = $conn->prepare('select * from users where username = :userName');
                        $stmntPass->bindParam(":userName", $userName);
                        $stmntPass->execute();
                        $user = $stmntPass->fetch(PDO::FETCH_ASSOC);
                        
                        if( password_verify($old, $user['password']) ){
                            echo "binnen";
                            if( $new == $newComf ){
                                echo "hetzelfde";
                                $newPass = Security::hash($new);
                                
                                //$conn = Db::getInstance();
                                $stmntPassCh = $conn->prepare('update users set `password` = :newPass where username = :userName');
                                $stmntPassCh->bindParam(":newPass", $newPass);
                                $stmntPassCh->bindParam(":userName", $userName);
                                $resultPass = $stmntPassCh->execute();
                                return $resultPass;
                            }else{
                                echo "niet hetzelfde";
                            }
                        }else{
                            echo "buiten";
                        }  
                }catch(Throwable $t){
                        echo $t;
                }
        }
        public static function changeEmail($passwordVer, $newEmail,$userName){
                try{
                        $conn = Db::getInstance();
                        $stmntEmail = $conn->prepare('select * from users where username = :userName');
                        $stmntEmail->bindParam(":userName", $userName);
                        $stmntEmail->execute();
                        $userMail = $stmntEmail->fetch(PDO::FETCH_ASSOC);

                        if( password_verify($passwordVer, $userMail['password']) ){
                                echo "wachtwoord klopt";
                                $stmntEmailCh = $conn->prepare('update users set `email` = :newEmail where username = :userName');
                                $stmntEmailCh->bindParam(":newEmail", $newEmail);
                                $stmntEmailCh->bindParam(":userName", $userName);
                                $resultEmail = $stmntEmailCh->execute();
                                return $resultEmail;

                        }else{
                                echo "wachtwoord foutief";
                        }
                }catch(Throwable $t){
                        echo $t;
                }
                
        }

    }
