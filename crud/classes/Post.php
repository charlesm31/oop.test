<?php

/**
 * This is a class for Posting which includes CRUD functionality
 * @author JEREMY
 */
class Post {

    private $database;

    //  Open Database connection
    public function __construct() {
        //  Open database connection
        require 'Database.php';

        //  Create db instance
        $this->database = new Database;
    }

    public function singlePost($id) {
        //  Prepare mysql query
        $this->database->query("SELECT a.*, CONCAT(b.first_name, ' ', b.last_name) as author
                FROM posts a 
                LEFT JOIN users b on b.user_id = a.post_by
                WHERE a.post_id = :id");

        //  Bind data and assign proper datatype
        $this->database->bind(':id', $id);

        //  Fetch Results in array value 
        return $this->database->resultset();
    }

    public function AllPosts() {
        //  Prepare mysql query
        $this->database->query("SELECT a.*, CONCAT(b.first_name, ' ', b.last_name) as author
                FROM posts a 
                LEFT JOIN users b on b.user_id = a.post_by");

        //  Fetch Results in array value
        return $this->database->resultset();
    }

    public function CreatePost($post) {
        $title = $post['title'];
        $body = $post['body'];
        $post_by = 1;

        //  Prepare mysql query
        $this->database->query('INSERT INTO posts (post_title, post_body, post_by) VALUES(:title, :body, :post_by)');

        //  Bind data and assign proper datatype
        $this->database->bind(':title', $title);
        $this->database->bind(':body', $body);
        $this->database->bind(':post_by', $post_by);

        //  Excecute Query
        $this->database->execute();

        //  Check if insert is successful
        if ($this->database->lastInsertId()) {
            return $msg = 'Post Added.';
        } else {
            return $msg = 'Failed adding Post.';
        }
    }

    public function EditPost($post) {
        $id = $post['id'];
        $title = $post['title'];
        $body = $post['body'];
        $post_by = 1;

        //  Prepare mysql query
        $this->database->query('UPDATE posts SET post_title = :title, post_body = :body, post_by  = :post_by WHERE post_id = :id ');

        //  Bind data and assign proper datatype
        $this->database->bind(':id', $id);
        $this->database->bind(':title', $title);
        $this->database->bind(':body', $body);
        $this->database->bind(':post_by', $post_by);

        //  Excecute Query
        $this->database->execute();

        return $msg = 'Post Edited.';
    }

    public function DeletePost($id) {
        $this->database->query("DELETE FROM posts WHERE post_id = :id");
        $this->database->bind(':id', $id);
        $this->database->execute();

        return $msg = 'Post Deleted.';
    }

}
