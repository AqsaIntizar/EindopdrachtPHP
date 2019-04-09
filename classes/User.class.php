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
        public static function saveDiscription($userEmail){
                //echo "test";
                $myDiscr = $_POST['myDiscr'];

                try{
                $conn = Db::getInstance();
                $stmntDisc = $conn->prepare("update users set description = :disc where email = :userEmail ");
                $stmntDisc->bindParam(":disc", $myDiscr);
                $stmntDisc->bindParam(":userEmail", $userEmail);
                $result = $stmntDisc->execute();
                return $result;
                }catch(Throwable $t){
                echo $t;
                }
        }


    }
