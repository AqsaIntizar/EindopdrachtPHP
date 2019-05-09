<?php
    class Like
    {
        private $postId;
        private $userId;
        private $type;
        /**
         * Get the value of postId.
         */
        public function getPostId()
        {
            return $this->postId;
        }
        /**
         * Set the value of postId.
         *
         * @return self
         */
        public function setPostId($postId)
        {
            $this->postId = $postId;
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
         * Get the value of type.
         */
        public function getType()
        {
            return $this->type;
        }
        /**
         * Set the value of type.
         *
         * @return self
         */
        public function setType($type)
        {
            $this->type = $type;
            return $this;
        }
        // public static function getAll($id){
        //     $conn = Db::getInstance();
        //     $stmnt = $conn->prepare('');
        // }
        public function saveLike()
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('insert into likes (`user_id`,`post_id`,`type`,`date_created`) VALUES (:userId, :postId, :type, UTC_TIMESTAMP())');
            $stmnt->bindValue(':userId', $this->getUserId());
            $stmnt->bindValue(':postId', $this->getPostId());
            $stmnt->bindValue(':type', $this->getType());
            return $stmnt->execute();
        }
    }