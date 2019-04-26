<?php
class Post
{
	public static function getAll(){
        $conn = Db::getInstance();
        $result = $conn->prepare('select user_id, post_img_dir,post_description,username from posts, users where posts.user_id = users.id');
        $result->execute();
        // fetch all records from the database and return them as objects of this __CLASS__ (Post)
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);


    }

    public function getLikes(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("select count(*) as count from likes where post_id = :postid");
        $statement->bindValue(":postid", $this->id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
}
?>