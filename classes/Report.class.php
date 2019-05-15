<?php

<<<<<<< HEAD
    Class Report{

        private $userId;
        private $postId;

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
=======
    class Report{
        private $postId;
        private $userId;
        

        /**
         * Get the value of postId
         */ 
        public function getPostId()
        {
                return $this->postId;
        }

        /**
         * Set the value of postId
         *
         * @return  self
         */ 
        public function setPostId($postId)
        {
                $this->postId = $postId;
>>>>>>> 9d5ae5407c1460dd534d4b65c3c5f3bcf364fd2f

                return $this;
        }

        /**
<<<<<<< HEAD
         * Get the value of postId
         */ 
        public function getPostId()
        {
                return $this->postId;
        }

        /**
         * Set the value of postId
         *
         * @return  self
         */ 
        public function setPostId($postId)
        {
                $this->postId = $postId;
=======
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
>>>>>>> 9d5ae5407c1460dd534d4b65c3c5f3bcf364fd2f

                return $this;
        }

<<<<<<< HEAD


        public function reportStatus(){
            $conn = Db::getInstance();
            $stmnt = $conn->prepare("insert into reports (post_id, user_id) values (:postId, :userId)");
            $stmnt->bindValue(":postId", $this->getPostId());
            $stmnt->bindValue(":userId", $this->getUserId());
            $stmnt->execute();
        }
            

        public static function isReported(){
            $conn = Db::getInstance();
            $stmnt = $conn->prepare("select report_status from posts where id = :postId");
            $stmnt->bindValue(":postId", $postId);
            $stmnt->execute();
            $result = $stmnt->fetchAll();
            return $result;
        }

    
=======
        public function saveReport()
        {
            $conn = Db::getInstance();

            //var_dump($hasReported());

            if($this->hasReported())
            {
                $updateStmnt = $conn->prepare('delete from reports where user_id = :userId and post_id = :postId');
                $updateStmnt->bindValue(':userId', $this->getUserId());
                $updateStmnt->bindValue(':postId', $this->getPostId());
                $updateStmnt->execute();
            }
            else
            {
                date_default_timezone_set('Europe/Brussels'); //set timezone for correct date
                $dateTime = date('Y-m-d H:i:s');

                $insertStmnt = $conn->prepare('insert into reports (`user_id`,`post_id`,`date_created`) VALUES (:userId, :postId, :time)');
                $insertStmnt->bindValue(':userId', $this->getUserId());
                $insertStmnt->bindValue(':postId', $this->getPostId());
                $insertStmnt->bindValue(':time', $dateTime);

                $insertStmnt->execute();
            }
            // return $stmnt->execute();
        }

        public function hasReported()
        {
            $conn = Db::getInstance();

            $stmnt = $conn->prepare('select * from reports where user_id = :userId and post_id = :postId');
            $stmnt->bindValue(':userId', $this->getUserId());
            $stmnt->bindValue(':postId', $this->getPostId());
            $stmnt->execute();

            if($stmnt->rowCount() === 0){
                return false;
            }
            else{
                return true;
            }
        }
>>>>>>> 9d5ae5407c1460dd534d4b65c3c5f3bcf364fd2f
    }