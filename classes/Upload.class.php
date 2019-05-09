<?php
    require_once("bootstrap.php");

    class Upload
    {
        private $fileName;
        private $fileType;
        private $fileTempName;
        private $fileSize;
        private $targetDir;

        private $description;
        private $userId;
        

        /**
         * Get the value of fileName
         */
        public function getFileName()
        {
            return $this->fileName;
        }

        /**
         * Set the value of fileName
         *
         * @return  self
         */
        public function setFileName($fileName)
        {
            $this->fileName = $fileName;

            return $this;
        }

        /**
         * Get the value of fileType
         */
        public function getFileType()
        {
            return $this->fileType;
        }

        /**
         * Set the value of fileType
         *
         * @return  self
         */
        public function setFileType($fileType)
        {
            $this->fileType = $fileType;

            return $this;
        }

        /**
         * Get the value of fileTempName
         */
        public function getFileTempName()
        {
            return $this->fileTempName;
        }

        /**
         * Set the value of fileTempName
         *
         * @return  self
         */
        public function setFileTempName($fileTempName)
        {
            $this->fileTempName = $fileTempName;

            return $this;
        }

        /**
         * Get the value of fileSize
         */
        public function getFileSize()
        {
            return $this->fileSize;
        }

        /**
         * Set the value of fileSize
         *
         * @return  self
         */
        public function setFileSize($fileSize)
        {
            $this->fileSize = $fileSize;

            return $this;
        }
        
        /**
         * Get the value of targetDir
         */
        public function getTargetDir()
        {
            return $this->targetDir;
        }

        /**
         * Set the value of targetDir
         *
         * @return  self
         */
        public function setTargetDir($targetDir)
        {
            $this->targetDir = $targetDir;

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
        public function setDescription($description)
        {
            $this->description = $description;

            return $this;
        }
            
        /**
        * Get the value of userId
        */
        public function getUserId()
        {
            return $this->userId;
        }

        /**
        * Set the value of userId
        *
        * @return  self
        */
        public function setUserId($userId)
        {
            $this->userId = $userId;

            return $this;
        }
       
        public function uploadProfPic($userName)
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                //request aanwezig, kijken of er files zijn om up te loaden
                if (isset($_FILES['imageFile'])) {
                    //var_dump($_FILES['imageFile']);
                    //echo "test ". $this->targetDir;
                    $extension = Image::checkExt($this->fileName);                
                    $newName = Image::rename($this->userId,$extension);
                    
                    if (move_uploaded_file($this->fileTempName, $this->targetDir.$newName)) {
                        
                        //connect db
                        try {
                            $conn = Db::getInstance();
                            $stmnt = $conn->prepare('update users set img_dir = :dir where username = :userName');
                            $stmnt->bindParam(":dir", $newName);
                            $stmnt->bindParam(":userName", $userName);
                            $result = $stmnt->execute();
                            return $result;
                        } catch (Throwable $t) {
                            return false;
                        }
                    } else {
                        echo "file could not be uploaded";
                    }
                }
            }
        }
        public function uploadPost($userName)
        {
    
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                //request aanwezig, kijken of er files zijn om up te loaden
                if (isset($_FILES['imageFile'])) {
                    $extension = Image::checkExt($this->fileName);                
                    $newName = Image::rename($this->userId,$extension);
                   
                    // Image::resize();
                    // var_dump($this->fileTempName);
                    // exit();
                    
                    // $image_resized = imagescale(imagecreatefromjpeg($this->fileTempName), 300);
                    // imagejpeg($image_resized, $this->targetDir."mini-".$newName);
                    
                    // resize("rightImg");

                    if (move_uploaded_file($this->fileTempName, $this->targetDir.$newName)) {
                        
                        $myPostDiscr = htmlspecialchars($this->description, ENT_QUOTES);
                        //connect db
                        try {
                            $conn = Db::getInstance();
                            $stmnt = $conn->prepare('insert posts (`user_id`,`post_img_dir`,`post_description`) VALUES (:userId, :dir,:descr)');
                            $stmnt->bindParam(":userId", $this->userId);
                            $stmnt->bindParam(":dir", $newName);
                            $stmnt->bindParam(":descr", $myPostDiscr);
                            $result = $stmnt->execute();
                            return $result;
                        } catch (Throwable $t) {
                            return false;
                        }
                    } else {
                        echo "file could not be uploaded";
                    }
                }
            }
        }
    }
