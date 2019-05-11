<?php
    class Follow
    {
        private $followerId;
        private $followsId;
        private $type;

        /**
         * Get the value of followerId.
         */
        public function getFollowerId()
        {
            return $this->followerId;
        }

        /**
         * Set the value of followerId.
         *
         * @return self
         */
        public function setFollowerId($followerId)
        {
            $this->followerId = $followerId;

            return $this;
        }

        /**
         * Get the value of followsId.
         */
        public function getFollowsId()
        {
            return $this->followsId;
        }

        /**
         * Set the value of followsId.
         *
         * @return self
         */
        public function setFollowsId($followsId)
        {
            $this->followsId = $followsId;

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

        public static function getFollowers($id)
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select count(*) as cntFollowers from follower where type = 1 and follows = :followsId');
            $stmnt->bindValue(':followsId', $id);
            $stmnt->execute();
            $result = $stmnt->fetch(PDO::FETCH_OBJ);

            return $result;
        }

        public static function checkIfFollows($followerId, $followsId)
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select type from follower where follower = :followerId and follows = :followsId');
            $stmnt->bindValue(':followerId', $followerId);
            $stmnt->bindValue(':followsId', $followsId);
            $stmnt->execute();
            $result = $stmnt->fetch(PDO::FETCH_OBJ);

            return $result->type;
        }

        public function saveFollower()
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select count(*) as checkIfFollow from follower where follower = :followerId and follows = :followsId');
            $stmnt->bindValue(':followerId', $this->getFollowerId());
            $stmnt->bindValue(':followsId', $this->getFollowsId());
            $stmnt->execute();
            $result = $stmnt->fetch(PDO::FETCH_OBJ);
            date_default_timezone_set('Europe/Brussels'); //set timezone for correct date
            $dateTime = date('Y-m-d H:i:s');
            $followCheck = $result->checkIfFollow;
            if ($followCheck == 0) {
                $insertStmnt = $conn->prepare('insert into follower (`follower`,`follows`,`type`,`date_created`) VALUES (:followerId, :followsId, :type, :time)');
                $insertStmnt->bindValue(':followerId', $this->getFollowerId());
                $insertStmnt->bindValue(':followsId', $this->getFollowsId());
                $insertStmnt->bindValue(':type', $this->getType());
                $insertStmnt->bindValue(':time', $dateTime);

                $insertStmnt->execute();
            } else {
                $updateStmnt = $conn->prepare('update follower set type = :type, date_created = :time where follower = :followerId and follows= :followsId');
                $updateStmnt->bindValue(':followerId', $this->getFollowerId());
                $updateStmnt->bindValue(':followsId', $this->getFollowsId());
                $updateStmnt->bindValue(':type', $this->getType());
                $updateStmnt->bindValue(':time', $dateTime);
                $updateStmnt->execute();
            }
        }
    }
