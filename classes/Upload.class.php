<?php
    require_once("Db.class.php");

    class Upload{
        private $fileName;
        private $fileType;
        private $fileTempName;
        private $fileSize;
        private $targetDir;
        

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

        public function uploadImage($userName){
            if( $_SERVER['REQUEST_METHOD'] == "POST" ){
                //request aanwezig, kijken of er files zijn om up te loaden
                if( isset($_FILES['imageFile']) ){
                    //var_dump($_FILES['imageFile']);
                    //echo "test ". $this->targetDir;
                    $this->fileName = preg_replace('/\s+/', '_', $this->fileName);
                    
                    if( move_uploaded_file($this->fileTempName, $this->targetDir.$this->fileName) ){
                        $fullPath = $this->targetDir.$this->fileName;
                        //connect db
                        try{
                                $conn = Db::getInstance();
                                $stmnt = $conn->prepare('update users set img_dir = :dir where username = :userName');
                                $stmnt->bindParam(":dir", $fullPath);
                                $stmnt->bindParam(":userName", $userName);
                                $result = $stmnt->execute();
                                return $result;
                        }catch(Throwable $t){
                                return false;
                        }
                        
                    }else{
                        echo "file could not be uploaded";
                    }
                }
            }
        }

    }
?>