<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'pdoposts';

// Set DSN
$dsn = 'mysql:host='.$host.';dbname='.$dbname;

// Create a Pdo instance
$pdo = new PDO($dsn, $user, $pass);

// ***Pdo Query****
$stmt = $pdo->query('SELECT * FROM posts');

// Ca array
/*
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $row['title'].'<br>';
}
*/
// Ca object

while($row = $stmt->fetch(PDO::FETCH_OBJ)){
    echo $row->title.'<br>';
}

// alta modalitate cea mai buna

$pdo-> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
// deseable emultation for limit
$pdo-> setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
/*
while($row = $stmt->fetch()){
    echo $row['title'].'<br>';
}
*/ 

// *****Prepared statemen******
$author = 'Vlad';
$is_published = true;
$id = 1;
// Unsafe
// $sql = "SELECT * FROM posts  WHERE author = '$author' "
// author vine de la user se se faciliteaza sql injection


# ***Positional params***
$limit = 1;
$sql = 'SELECT * FROM posts WHERE author = ? && is_published = ? LIMIT ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$author, $is_published, $limit]);
$posts = $stmt->fetchAll();

foreach($posts as $post){
    echo $post->title.'<br>';
}

# ****Named Params*****
// $sql = 'SELECT * FROM posts WHERE author = :author && is_published= :is_published';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['author'=>$author,'is_published'=> $is_published]);
// $posts = $stmt->fetchAll();

// // var_dump($posts);
// foreach($posts as $post){
//     echo $post->title.'<br>';
// }

// ***FETCH SINGLE POST****
// $sql = 'SELECT * FROM posts WHERE id = :id';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['id'=>$id]);
// $posts = $stmt->fetch();

// ***get row count****
// $stmt = $pdo->prepare('SELECT * FROM posts WHERE author = ?');
// $stmt->execute([$author]);
// $postCount = $stmt->rowCount();

// echo $postCount;


// ****Insert DATA*****
// $title = 'Post five';
// $body = 'This is post five';
// $author = 'Maria';

// $sql = 'INSERT INTO posts(title, body, author) VALUES(:title, :body, :author)';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['title'=>$title, 'body'=>$body, 'author'=>$author]);

// echo 'Post Added';

// ****update date*****
// $id = 1;
// $body = 'This is post ';


// $sql = 'UPDATE posts SET body= :body WHERE id= :id';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['body'=>$body, 'id'=>$id]);
// echo 'Post update';

// ****Delete data*****
// $id = 3;

// $sql = 'DELETE FROM posts WHERE id= :id';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['id'=>$id]);
// echo 'Post deleted';

// ****Search data****

// $search = "%post%";
// $sql = 'SELECT * FROM posts WHERE title LIKE ?';
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$search]);
// $posts = $stmt->fetchALL();

// foreach($posts as $post){
//     echo $post->title.'<br>';
// }

?>

<!-- <h1><?php echo $posts->title; ?></h1>
<p><?php echo $posts->body; ?> </p> -->