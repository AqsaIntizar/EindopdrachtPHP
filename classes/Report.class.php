<?php

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

                return $this;
        }

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

    
    }