<?php
    require 'vendor/autoload.php';

    // use League\ColorExtractor\Color;
    class Upload
    {
        private $fileName;
        private $fileType;
        private $fileTempName;
        private $fileSize;
        private $targetDir;

        private $description;
        private $userId;
        private $dateTime;

        /**
         * Get the value of fileName.
         */
        public function getFileName()
        {
            return $this->fileName;
        }

        /**
         * Set the value of fileName.
         *
         * @return self
         */
        public function setFileName($fileName)
        {
            $this->fileName = $fileName;

            return $this;
        }

        /**
         * Get the value of fileType.
         */
        public function getFileType()
        {
            return $this->fileType;
        }

        /**
         * Set the value of fileType.
         *
         * @return self
         */
        public function setFileType($fileType)
        {
            $this->fileType = $fileType;

            return $this;
        }

        /**
         * Get the value of fileTempName.
         */
        public function getFileTempName()
        {
            return $this->fileTempName;
        }

        /**
         * Set the value of fileTempName.
         *
         * @return self
         */
        public function setFileTempName($fileTempName)
        {
            $this->fileTempName = $fileTempName;

            return $this;
        }

        /**
         * Get the value of fileSize.
         */
        public function getFileSize()
        {
            return $this->fileSize;
        }

        /**
         * Set the value of fileSize.
         *
         * @return self
         */
        public function setFileSize($fileSize)
        {
            $this->fileSize = $fileSize;

            return $this;
        }

        /**
         * Get the value of targetDir.
         */
        public function getTargetDir()
        {
            return $this->targetDir;
        }

        /**
         * Set the value of targetDir.
         *
         * @return self
         */
        public function setTargetDir($targetDir)
        {
            $this->targetDir = $targetDir;

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
        public function setDescription($description)
        {
            $this->description = $description;

            return $this;
        }

        /**
         * Get the value of userId.
         */
        public function getUserId()
        {
            return $this->userId;
        }

        /**
         * Set the value of userId.
         *
         * @return self
         */
        public function setUserId($userId)
        {
            $this->userId = $userId;

            return $this;
        }

        /**
         * Get the value of dateTime.
         */
        public function getDateTime()
        {
            return $this->dateTime;
        }

        /**
         * Set the value of dateTime.
         *
         * @return self
         */
        public function setDateTime($dateTime)
        {
            $this->dateTime = $dateTime;

            return $this;
        }

        public function uploadProfPic($userName)
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //request aanwezig, kijken of er files zijn om up te loaden
                if (isset($_FILES['imageFile'])) {
                    //var_dump($_FILES['imageFile']);
                    //echo "test ". $this->targetDir;
                    $extension = Image::checkExt($this->fileName);
                    $newName = Image::rename($this->userId, $extension);

                    if (move_uploaded_file($this->fileTempName, $this->targetDir.$newName)) {
                        //connect db
                        try {
                            $conn = Db::getInstance();
                            $stmnt = $conn->prepare('update users set img_dir = :dir where username = :userName');
                            $stmnt->bindParam(':dir', $newName);
                            $stmnt->bindParam(':userName', $userName);
                            $result = $stmnt->execute();

                            $_SESSION['user']['img_dir'] = $newName;

                            return $result;
                        } catch (Throwable $t) {
                            return false;
                        }
                    } else {
                        echo 'file could not be uploaded';
                    }
                }
            }
        }

        public function uploadPost($userName)
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //request aanwezig, kijken of er files zijn om up te loaden
                if (isset($_FILES['imageFile'])) {
                    $extension = Image::checkExt($this->fileName);
                    $newName = Image::rename($this->userId, $extension);

                    Image::resize($this->fileTempName, $extension, $newName, $this->targetDir);

                    if (move_uploaded_file($this->fileTempName, $this->targetDir.$newName)) {
                        // wanneer de foto verplaatst is wordt er een array met variable namen aangemaakt
                        $colorVars = array('color1', 'color2', 'color3', 'color4');
                        // kleuren extracten van de verplaatste foto -> returned een array van 4
                        $colors = Image::extractColors($this->targetDir.$newName);
                        // koppel de variable namen aan de verkregen kleurwaardes
                        extract(array_combine($colorVars, $colors));

                        $myPostDiscr = htmlspecialchars($this->description, ENT_QUOTES);
                        //connect db
                        try {
                            $conn = Db::getInstance();
                            $stmnt = $conn->prepare('insert posts (`user_id`,`post_img_dir`,`post_description`,`date_created`, `color1`, `color2`, `color3`, `color4`) VALUES (:userId, :dir,:descr, :time, :color1, :color2, :color3, :color4)');
                            $stmnt->bindParam(':userId', $this->userId);
                            $stmnt->bindParam(':dir', $newName);
                            $stmnt->bindParam(':descr', $myPostDiscr);
                            $stmnt->bindParam(':time', $this->dateTime);
                            $stmnt->bindParam(':color1', \League\ColorExtractor\Color::fromIntToHex($color1)); // kleuren omzetten naar hex en versturen
                            $stmnt->bindParam(':color2', \League\ColorExtractor\Color::fromIntToHex($color2)); // kleuren omzetten naar hex en versturen
                            $stmnt->bindParam(':color3', \League\ColorExtractor\Color::fromIntToHex($color3)); // kleuren omzetten naar hex en versturen
                            $stmnt->bindParam(':color4', \League\ColorExtractor\Color::fromIntToHex($color4)); // kleuren omzetten naar hex en versturen
                            $result = $stmnt->execute();

                            return $result;
                        } catch (Throwable $t) {
                            return false;
                        }
                    } else {
                        echo 'file could not be uploaded';
                    }
                }
            }
        }
    }
