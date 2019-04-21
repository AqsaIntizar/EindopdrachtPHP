<?php
    //require_once("Db.class.php");
    require_once("bootstrap.php");

        class UploadPost extends Upload{
            private $description;
            //private $fileName;
            //private $fileType;
            //private $fileTempName;
            //private $fileSize;
            //private $targetDir;
            
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
       

            public function uploadPost() {
                if( $_SERVER['REQUEST_METHOD'] == "POST" ){
                    print_r($_SESSION['User']);
                    //request aanwezig, kijken of er files zijn om up te loaden
                    if( isset($_FILES['imageFile']) ){
                        //var_dump($_FILES['imageFile']);
                        print_r( $this->targetDir);
                        $this->fileName = preg_replace('/\s+/', '_', $this->fileName);
                    
                        if( move_uploaded_file($this->fileTempName, $this->targetDir.$this->fileName) ){
                            $fullPath = $this->targetDir.$this->fileName;
                            //connect db
                            $conn = Db::getInstance();
                            $stmnt = $conn->prepare('INSERT INTO `posts`(`description`, `img_dir`, `user_id`) VALUES (:desc,:dir,5)');
                            $stmnt->bindParam(":dir", $fullPath);
                            $stmnt->bindParam(":desc", $this->description);
                            print_r($stmnt);
                            $result = $stmnt->execute();
                            
                            header('Location: index.php');
                        }else{
                            echo "file could not be uploaded";
                        }
                    }
                }

            }

        }



            