<?php
    require_once("Db.class.php");
    require_once("Upload.class.php");
    
        class Post extends Upload {
            private $description;

            
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

            public function uploadPost() {
                if( $_SERVER['REQUEST_METHOD'] == "POST" ){
                    //request aanwezig, kijken of er files zijn om up te loaden
                    if( isset($_FILES['imageFile']) ){
                        //var_dump($_FILES['imageFile']);
                        //echo "test ". $this->targetDir;
                        parrent::$this->fileName = preg_replace('/\s+/', '_', parrent::$this->fileName);
                        
                        if( move_uploaded_file(parrent::$this->fileTempName, parrent::$this->targetDir.parrent::$this->fileName) ){
                            $fullPath = parrent::$this->targetDir.parrent::$this->fileName;
                            //connect db
                            $conn = Db::getInstance();
                            $stmnt = $conn->prepare('UPDATE posts set img_dir = :dir, description = :desc');
                            $stmnt->bindParam(":dir", $fullPath);
                            $stmnt->bindParam(":desc", $this->description);
                            $result = $stmnt->execute();
                            return $result;
                        }else{
                            echo "file could not be uploaded";
                        }
                    }
                }

            }


        }