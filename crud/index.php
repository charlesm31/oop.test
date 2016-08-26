<?php
// auto load classes
spl_autoload_register(function($class_name) {
    include 'classes/' . $class_name . '.php';
});

$database = new Database;

//  Substitute $_Post to a variable $post
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

// Add Post on Form Submit
if (isset($post['submit'])) {
    $title = $post['title'];
    $body = $post['body'];
    $by = 1;
    
    $database->query('INSERT INTO posts (post_title, post_body, post_by) VALUES(:title, :body, :by)');
    $database->bind(':title', $title);
    $database->bind(':body', $body);
    $database->bind(':by', $by);    
    $database->execute();
    if ($database->lastInsertId()) {
        $error = 'Post Added.';
    }
}


// Select all POSTS
$database->query("SELECT a.*, CONCAT(b.first_name, ' ', b.last_name) as author
                FROM posts a 
                LEFT JOIN users b on b.user_id = a.post_by");
// WHERE a.post_id = :id
//$database->bind(':id', 1);

$posts = $database->resultset();
?>
<link href="../../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>

<div class='container'>
    <div class='row'>
        <div class='col-sm-6'>
            <h1>Add New Post</h1>

            <form class='well' method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>Post Title</label><br>
                <input type="text" name='title' placeholder="Add title..."><br><br>
                <label>Post Body</label> <br>
                <textarea name='body'></textarea><br><br>
                <input type='submit' name='submit' value='Submit'><br><br>
            </form>
        </div>

        <div class='col-sm-6'>
            <h1>Edit Post</h1>

            <form class='well' method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>Post Id</label><br>
                <input type="text" name='editID' placeholder="Specify ID..."><br><br>
                <label>Post Title</label><br>
                <input type="text" name='editTitle' placeholder="Add title..."><br><br>
                <label>Post Body</label> <br>
                <textarea name='editBody'></textarea><br><br>
                <input type='submit' name='edit' value='Edit'><br><br>
            </form>
        </div>
    </div>

    <h1>POST</h1>
    <table class='table table-bordered table-striped'>
        <thead>
            <tr>
                <th>ID</th>
                <th>TITLE</th>
                <th>BODY</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td><?php echo $post['post_id']; ?></td>
                    <td><?php echo $post['post_title']; ?></td>
                    <td><?php echo $post['post_body']; ?></td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name='deleteID' value="<?php echo $post['post_id']; ?>">
                            <input type='submit' name='delete' value='Delete'>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><?php echo $error; ?></p>
</div>