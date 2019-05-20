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

        public static function getLikes($id)
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select count(*) as cntLikes from likes where type = 1 and post_id = :postId');
            $stmnt->bindValue(':postId', $id);
            $stmnt->execute();
            $result = $stmnt->fetch(PDO::FETCH_OBJ);

            return $result;
        }

        public static function checkIfLiked($userId, $postId)
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select type from likes where user_id = :userId and post_id = :postId');
            $stmnt->bindValue(':userId', $userId);
            $stmnt->bindValue(':postId', $postId);
            $stmnt->execute();
            $result = $stmnt->fetch(PDO::FETCH_ASSOC);

            //return $result['type'];
            if ($result['type'] < 1) {
                return 0;
            } else {
                return $result['type'];
            }
        }

        public function saveLike()
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select count(*) as checkLikes from likes where user_id = :userId and post_id= :postId');
            $stmnt->bindValue(':userId', $this->getUserId());
            $stmnt->bindValue(':postId', $this->getPostId());
            $stmnt->execute();
            $result = $stmnt->fetch(PDO::FETCH_OBJ);
            date_default_timezone_set('Europe/Brussels'); //set timezone for correct date
            $dateTime = date('Y-m-d H:i:s');
            $likeCheck = $result->checkLikes;
            if ($likeCheck == 0) {
                $insertStmnt = $conn->prepare('insert into likes (`user_id`,`post_id`,`type`,`date_created`) VALUES (:userId, :postId, :type, :time)');
                $insertStmnt->bindValue(':userId', $this->getUserId());
                $insertStmnt->bindValue(':postId', $this->getPostId());
                $insertStmnt->bindValue(':type', $this->getType());
                $insertStmnt->bindValue(':time', $dateTime);

                $insertStmnt->execute();
            } else {
                $updateStmnt = $conn->prepare('update likes set type = :type, date_created = :time where user_id = :userId and post_id= :postId');
                $updateStmnt->bindValue(':userId', $this->getUserId());
                $updateStmnt->bindValue(':postId', $this->getPostId());
                $updateStmnt->bindValue(':type', $this->getType());
                $updateStmnt->bindValue(':time', $dateTime);
                $updateStmnt->execute();
            }
            // return $stmnt->execute();
        }
        // checks most liked
        public static function checkMostLiked() {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select post_id, count(*) as magnitude from likes where type = 1 group by post_id order by magnitude desc limit 1 ');
            $stmnt->execute();

            return $result = $stmnt->fetch(PDO::FETCH_ASSOC);
        }



    }
