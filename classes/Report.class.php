<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
        
        /*
        public function saveReport()
        {
            $conn = Db::getInstance();
            //var_dump($hasReported());
            echo "here";
            ///*
            
            if($this->hasReported($this->getUserId(), $this->getPostId()) === 1)
            {
                $updateStmnt = $conn->prepare('update reports set reportStatus = :reportState where user_id = :userId and post_id = :postId');
                $updateStmnt->bindValue(':reportState', 0);
                $updateStmnt->bindValue(':userId', $this->getUserId());
                $updateStmnt->bindValue(':postId', $this->getPostId());
                $updateStmnt->execute();
                
            }
            /*
            else
            {
                
                //if column exist then update / else insert

                /*
                $existStmnt = $conn->prepare('select * from reports where exists(select * from reports where user_id = :userId and post_id = :postId)');
                $existStmnt->bindValue(':userId', $this->getUserId());
                $existStmnt->bindValue(':postId', $this->getPostId());
                $exists = $existStmnt->execute();

                if(!$exists){
                    $updateAgainStmnt = $conn->prepare('update reports set reportStatus = :reportState where user_id = :userId and post_id = :postId');
                    $updateAgainStmnt->bindValue(':reportState', 1);
                    $updateAgainStmnt->bindValue(':userId', $this->getUserId());
                    $updateAgainStmnt->bindValue(':postId', $this->getPostId());
                    $updateAgainStmnt->execute();
                } else{
                    
                    date_default_timezone_set('Europe/Brussels'); //set timezone for correct date
                    $dateTime = date('Y-m-d H:i:s');
                    $insertStmnt = $conn->prepare('insert into reports (`user_id`,`post_id`,`date_created`,`reportStatus`) VALUES (:userId, :postId, :time, :reportState)');
                    $insertStmnt->bindValue(':userId', $this->getUserId());
                    $insertStmnt->bindValue(':postId', $this->getPostId());
                    $insertStmnt->bindValue(':time', $dateTime);
                    $insertStmnt->bindValue(':reportState', 1);
                    $insertStmnt->execute();
                }
                
            }
            // return $stmnt->execute();
        }
        */

        public function saveReport(){
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select * from reports where user_id = :userId and post_id= :postId');
            $stmnt->bindValue(':userId', $this->getUserId());
            $stmnt->bindValue(':postId', $this->getPostId());
            $result = $stmnt->execute();
            date_default_timezone_set('Europe/Brussels'); //set timezone for correct date
            $dateTime = date('Y-m-d H:i:s');
            //$reportCheck = $result->checkReports;
            if (!$result) {
                $insertStmnt = $conn->prepare('insert into reports (`user_id`,`post_id`,`date_created`, `reportStatus`) VALUES (:userId, :postId, :time, :reportStatus)');
                $insertStmnt->bindValue(':userId', $this->getUserId());
                $insertStmnt->bindValue(':postId', $this->getPostId());
                $insertStmnt->bindValue(':reportStatus', 1);
                $insertStmnt->bindValue(':time', $dateTime);
                $insertStmnt->execute();

            } else {

                $existStmnt = $conn->prepare(/*'select * from reports where exists(select * from reports where user_id = :userId and post_id = :postId and reportStatus = :reportStatus)'*/'select * from reports where user_id = :userId and post_id= :postId and reportStatus = :reportStatus');
                $existStmnt->bindValue(':userId', $this->getUserId());
                $existStmnt->bindValue(':postId', $this->getPostId());
                $existStmnt->bindValue(':reportStatus', 1);
                $exists = $existStmnt->execute();

                if($exists){
                    $updateAgainStmnt = $conn->prepare('update reports set reportStatus = :reportState, date_created = :time where user_id = :userId and post_id = :postId');
                    $updateAgainStmnt->bindValue(':reportState', 1);
                    $updateAgainStmnt->bindValue(':time', $dateTime);
                    $updateAgainStmnt->bindValue(':userId', $this->getUserId());
                    $updateAgainStmnt->bindValue(':postId', $this->getPostId());
                    $updateAgainStmnt->execute();

                } else{
                    $updateStmnt = $conn->prepare('update reports set reportStatus = :reportState, date_created = :time where user_id = :userId and post_id = :postId');
                    $updateStmnt->bindValue(':reportState', 0);
                    $updateStmnt->bindValue(':time', $dateTime);
                    $updateStmnt->bindValue(':userId', $this->getUserId());
                    $updateStmnt->bindValue(':postId', $this->getPostId());
                    $updateStmnt->execute();
                }
            }



                /*
                $updateStmnt = $conn->prepare('update likes set reportStatus = :reportStatus, date_created = :time where user_id = :userId and post_id= :postId');
                $updateStmnt->bindValue(':userId', $this->getUserId());
                $updateStmnt->bindValue(':postId', $this->getPostId());
                $updateStmnt->bindValue(':reportStatus', $this->getType());
                $updateStmnt->bindValue(':time', $dateTime);
                $updateStmnt->execute();
                */
            
        }
        
        public static function hasReported($userId, $postId)
        {
            $conn = Db::getInstance();
            $stmnt = $conn->prepare('select reportStatus from reports where user_id = :userId and post_id = :postId');
            $stmnt->bindValue(':userId', $userId);
            $stmnt->bindValue(':postId', $postId);
            $stmnt->execute();
            $result = $stmnt->fetch(PDO::FETCH_ASSOC);

            if ($result['reportStatus'] < 1) {
                return 0;
            } else {
                return $result['reportStatus'];
            }


            /*
            $countstmnt = $conn->prepare('select count(*) from reports where post_id = :postId');
            $countstmnt->bindValue(':postId', $postId);
            $reportAmount = $countstmnt->execute();
            
            
            if($stmnt->rowCount() === 0){
                return false;
            }
            else if($stmnt->rowCount() === 0){
                
            } else{
                return true;
            }
            
            */
            /*
            if($reportAmount === 3){
                $statusStmnt = $conn->prepare('select reportStatus from posts where post_id = :postId');
                $statusStmnt->bindValue(':postId', $postId);
                $result = $statusStmnt->execute();
                if($result === 1){
                    return $reportAmount;
                } else{
                    $updateStmnt = $conn->prepare('update posts set reportStatus = :reportState where post_id = :postId');
                    $updateStmnt->bindValue(':postId', $postId);
                    $updateStmnt->bindValue(':reportState', 1);
                    $result = $updateStmnt->execute();
                    return $reportAmount;
                }
                
            }
            else if($postReport === 0){
                return false;
            } 
            else{
                return true;
            }
            */
            
        }
    }