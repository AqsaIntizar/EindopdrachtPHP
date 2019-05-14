<?php

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
    }