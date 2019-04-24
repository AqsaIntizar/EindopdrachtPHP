<?php
class Comment{
    private $text;

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public static function getAll(){
        $conn = Db::getInstance();
        $result = $conn->query("select * from comments order by id asc");

        // fetch all records from db and return as object
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }
    public function saveComment(){
        $conn = Db::getInstance();
        $stmnt = $conn->prepare("insert into comments (post_id, user_id, text) values (1,11, :comment)");
        $stmnt->bindValue(":comment", $this->getText());
        return $stmnt->execute();
    }
}
