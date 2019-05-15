<?php
    class Comment
    {
        private $postId;
        private $text;
        private $userId;

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
         * Get the value of text.
         */
        public function getText()
        {
            return $this->text;
        }

        /**
         * Set the value of text.
         *
         * @return self
         */
        public function setText($text)
        {
            $this->text = $text;

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

        public static function getAll($id)
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select * from comments where post_id = :postId order by id asc');
            $stmnt->bindValue(':postId', $id);
            $stmnt->execute();
            $result = $stmnt->fetchAll();
            //var_dump($result);
            // fetch all records from db and return as object
            return $result;
        }

        public function saveComment()
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('insert into comments (post_id, user_id, text) values (:postId, :userId, :comment)');
            $stmnt->bindValue(':comment', $this->getText());
            $stmnt->bindValue(':postId', $this->getPostId());
            $stmnt->bindValue(':userId', $this->getUserId());

            return $stmnt->execute();
        }
    }
