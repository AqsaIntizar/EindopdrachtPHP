<?php
    class User
    {
        private $firstname;
        private $lastname;
        private $username;
        private $email;
        private $password;
        private $passwordConfirmation;

        /**
         * Get the value of email.
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email.
         *
         * @return self
         */
        public function setEmail($email)
        {
            if (empty($email)) {
                throw new Exception('Email cannot be empty.');
            }

            // todo: valid email ? -> filter_var()

            $this->email = $email;

            return $this;
        }

        /**
         * Get the value of password.
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * Set the value of password.
         *
         * @return self
         */
        public function setPassword($password)
        {
            $this->password = $password;

            return $this;
        }

        /**
         * Get the value of passwordConfirmation.
         */
        public function getPasswordConfirmation()
        {
            return $this->passwordConfirmation;
        }

        /**
         * Set the value of passwordConfirmation.
         *
         * @return self
         */
        public function setPasswordConfirmation($passwordConfirmation)
        {
            $this->passwordConfirmation = $passwordConfirmation;

            return $this;
        }

        /**
         * Get the value of firstname.
         */
        public function getFirstname()
        {
            return $this->firstname;
        }

        /**
         * Set the value of firstname.
         *
         * @return self
         */
        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;

            return $this;
        }

        /**
         * Get the value of lastname.
         */
        public function getLastname()
        {
            return $this->lastname;
        }

        /**
         * Set the value of lastname.
         *
         * @return self
         */
        public function setLastname($lastname)
        {
            $this->lastname = $lastname;

            return $this;
        }

        /**
         * Get the value of username.
         */
        public function getUsername()
        {
            return $this->username;
        }

        /**
         * Set the value of username.
         *
         * @return self
         */
        public function setUsername($username)
        {
            $this->username = $username;

            return $this;
        }

        /**
         * Get the value of description.
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * Set the value of description.
         *
         * @return self
         */

        /*
        ./@return boolean - true if registration successful, false if unsuccessful
        */
        public function setDescription($description)
        {
            $this->description = $description;

            return $this;
        }

        public function register()
        {
            try {
                $conn = Db::getInstance();
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $firstname = htmlspecialchars($_POST['firstname']);
                $lastname = htmlspecialchars($_POST['lastname']);

                //var_dump($conn->errorCode());
                $statement = $conn->prepare('INSERT INTO users (firstname, lastname, username, email, password, img_dir) values (:firstname, :lastname, :username, :email, :password, "default.png")');
                $statement->bindParam(':email', $email);
                $statement->bindParam(':firstname', $firstname);
                $statement->bindParam(':lastname', $lastname);
                $statement->bindParam(':username', $username);
                $hash = password_hash($this->password, PASSWORD_BCRYPT);
                $statement->bindParam(':password', $hash);

                $result = $statement->execute();

                self::setDetails();

                return $result;
            } catch (Throwable $t) {
                return false;
            }
        }

        public function login()
        {
            $conn = Db::getInstance();
            $username = htmlspecialchars($_POST['username']);
            $password = $_POST['password'];

            $statement = $conn->prepare('select * from users where username = :username');
            $statement->bindParam(':username', $username);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if (password_verify($this->password, $user['password'])) {
                // als wachtwoorden overeen komen -> alles van user ophalen uit db en in session steken
                self::setDetails();

                return true;
            } else {
                $error = 'Username/Password incorrect';
                $_SESSION['error'] = $error;

                return false;
            }
        }

        private function setDetails()
        {
            // Getting database connection in class DB
            $conn = Db::getInstance();
            // Query for getting the user
            $statement = $conn->prepare('SELECT * FROM users WHERE username = :username');
            $statement->bindParam(':username', $this->username);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            $userDetails = [
                'id' => $user['id'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'email' => $user['email'],
                'username' => $user['username'],
                'img_dir' => $user['img_dir'],
            ];
            $_SESSION['user'] = $userDetails;
        }

        public static function findByEmail($email)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from users where email = :email limit 1');
            $statement->bindValue(':email', $email);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        /* Check if a user exists based on a give email address */
        public static function isAccountAvailable($email)
        {
            $u = self::findByEmail($email);

            // PDO returns false if no records are found so let's check for that
            if ($u == false) {
                return true;
            } else {
                return false;
            }
        }

        public static function saveDiscription($userName)
        {
            //echo "test";
            $myDiscr = htmlspecialchars($_POST['myDiscr'], ENT_QUOTES);

            try {
                $conn = Db::getInstance();
                $stmntDisc = $conn->prepare('update users set description = :disc where username = :userName ');
                $stmntDisc->bindParam(':disc', $myDiscr);
                $stmntDisc->bindParam(':userName', $userName);
                $result = $stmntDisc->execute();

                return $result;
            } catch (Throwable $t) {
                echo $t;
            }
        }

        public static function changePass($old, $new, $newComf, $userName)
        {
            try {
                $conn = Db::getInstance();
                $stmntPass = $conn->prepare('select * from users where username = :userName');
                $stmntPass->bindParam(':userName', $userName);
                $stmntPass->execute();
                $user = $stmntPass->fetch(PDO::FETCH_ASSOC);

                if (password_verify($old, $user['password'])) {
                    //echo "binnen";
                    if ($new == $newComf) {
                        //echo "hetzelfde";
                        $newPass = Security::hash($new);

                        //$conn = Db::getInstance();
                        $stmntPassCh = $conn->prepare('update users set `password` = :newPass where username = :userName');
                        $stmntPassCh->bindParam(':newPass', $newPass);
                        $stmntPassCh->bindParam(':userName', $userName);
                        $resultPass = $stmntPassCh->execute();

                        return $resultPass;
                    } else {
                        //echo "Wachtwoorden komen niet overeen";
                    }
                } else {
                    //echo "Foutief wachtwoord";
                }
            } catch (Throwable $t) {
                echo $t;
            }
        }

        public static function changeEmail($passwordVer, $newEmail, $userName)
        {
            try {
                $conn = Db::getInstance();
                $stmntEmail = $conn->prepare('select * from users where username = :userName');
                $stmntEmail->bindParam(':userName', $userName);
                $stmntEmail->execute();
                $userMail = $stmntEmail->fetch(PDO::FETCH_ASSOC);

                if (password_verify($passwordVer, $userMail['password'])) {
                    //echo "wachtwoord klopt";
                    $stmntEmailCh = $conn->prepare('update users set `email` = :newEmail where username = :userName');
                    $stmntEmailCh->bindParam(':newEmail', $newEmail);
                    $stmntEmailCh->bindParam(':userName', $userName);
                    $resultEmail = $stmntEmailCh->execute();

                    $_SESSION['user']['email'] = $newEmail;

                    return $resultEmail;
                } else {
                    //echo "wachtwoord foutief";
                    $error = true;
                }
            } catch (Throwable $t) {
                echo $t;
            }
        }

        public static function getProfile($id)
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select * from users where id = :id');
            $stmnt->bindValue(':id', $id);
            $stmnt->execute();
            $user = $stmnt->fetch(PDO::FETCH_ASSOC);

            return $user;
        }

        public static function canEdit($sessionId, $userPostId)
        {
            if ($sessionId == $userPostId) {
                $style = 'block';
            } else {
                $style = 'none';
            }

            return $style;
            // get session user_id compare to user_id from post if true display block if false display none
        }

        // public static function getProfileByUsername($search)
        // {
        //     $conn = Db::getInstance();
        //     $stmnt = $conn->prepare('select * from users where username = :username');
        //     $stmnt->bindValue(':username', $search);
        //     $stmnt->execute();
        //     $result = $stmnt->fetchAll(PDO::FETCH_ASSOC);

        //     return $result;
        // }
    }
