<?php
// auto load classes
spl_autoload_register(function($class_name) {
    include 'classes/' . $class_name . '.php';
});

$post = new Post();

//  Substitute $_Post to a variable $form_action
$form_action = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

// Add Post
if (isset($form_action['create'])) {
    $msg = $post->CreatePost($form_action);
}

// Select Single Post
if (isset($form_action['select'])) {
    $selected = $post->singlePost($form_action['id']);

    foreach ($selected as $record) {
        $id = $record['post_id'];
        $title = $record['post_title'];
        $body = $record['post_body'];
    }
}

// Edit Post
if (isset($form_action['edit'])) {
    $msg = $post->EditPost($form_action);
}

// Delete Post
if (isset($form_action['delete'])) {
    $msg = $post->DeletePost($form_action['id']);
}

$posts = $post->AllPosts();
?>

<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>OOP Migration</title>
        <meta name="description" content="OOP Migration module">
        <meta name="author" content="DevJc">

        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>        
        <!-- Font Awesome -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <!-- Custom Styling -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>

        <!--[if lt IE 9]>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class='container'>
            <div class='row'>
                <div class='col-xs-6'>
                    <?php if (isset($form_action['select'])) : ?>
                        <h1>Edit Post</h1>
                    <?php else : ?>
                        <h1>Post Form</h1>
                    <?php endif; ?>


                    <form class='well clearfix' method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class='form-group'>
                            <label>Title</label><br>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class='glyphicon glyphicon-file'></i></span>
                                <input type="text" class="form-control" name='title' placeholder="Enter Title..." value='<?php
                                if (isset($form_action['select'])) {
                                    echo $title;
                                }
                                ?>'>
                            </div>
                        </div><!-- post_title -->

                        <div class="form-group">
                            <label>Content</label> <br>
                            <textarea name='body' class="form-control" placeholder="Type Content..." rows="5"><?php
                                if (isset($form_action['select'])) {
                                    echo $body;
                                }
                                ?></textarea>
                        </div><!-- post_body -->

                        <input type='hidden' name='id' value=" <?php
                        if (isset($form_action['select'])) {
                            echo $id;
                        }
                        ?>">


                        <?php if (isset($form_action['select'])) : ?>
                            <button  type='submit' class='btn btn-sm btn-primary pull-right' name='edit'><i class='glyphicon glyphicon-edit'></i> Edit</button>
                            <a href='index.php'  type='submit' class='btn btn-sm btn-warning pull-right' name='edit'><i class='glyphicon glyphicon-trash'></i> Cancel</a>
                        <?php else : ?>
                            <button  type='submit' class='btn btn-sm btn-success pull-right' name='create'><i class='glyphicon glyphicon-plus'></i> Add Post</button>
                        <?php endif; ?>


                    </form><!-- post form -->
                </div><!-- .col -->
            </div><!-- .row -->

            <hr>

            <?php if (!isset($form_action['select'])) : ?>
                <h1>POST PAGE</h1>

                <table class='table table-bordered table-striped table-responsive table-condensed table-hover'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TITLE</th>
                            <th>BODY</th>
                            <th>Update</th>
                        </tr>
                    </thead><!-- thead -->
                    <tbody>
                        <?php foreach ($posts as $post) : ?>
                            <tr>
                                <td><?php echo $post['post_id']; ?></td>
                                <td><?php echo $post['post_title']; ?></td>
                                <td><?php echo $post['post_body']; ?></td>
                                <td>
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name='id' value="<?php echo $post['post_id']; ?>">
                                        <button type='submit' class='btn btn-xs btn-danger pull-right' name='delete'><i class='glyphicon glyphicon-trash'></i></button>
                                        <button type='submit' class='btn btn-xs btn-primary pull-right' name='select' value='Edit'><i class='glyphicon glyphicon-edit'></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody><!-- tbody -->
                </table><!-- table -->

                <h4 class="text-success"><?php echo $msg; ?></h4>                        


            <?php endif; ?>
        </div><!-- .container -->

        <!-- ==============================================
        Scripts Loaded on bottom page for faster page load
        ================================================-->        
        <!-- jquery -->
        <script src="assets/js/jquery1.11.1.min.js" type="text/javascript"></script>
        <!-- bootstrap -->
        <script src="assets/js/bootstrap.js" type="text/javascript"></script>

    </body><!-- body -->
</html><!-- html -->

