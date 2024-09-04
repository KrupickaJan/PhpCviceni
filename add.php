<?php

    include('DbConnect.php');
    require_once('Book.php');

    $conn = new DbConnect();
    $dbConnection = $conn->connect();

    $instanceBook = new Book($dbConnection);

    if(isset($_POST['add'])){
        $isbn = $_POST['isbn'];
        $autFirstName = $_POST['author_first_name'];
        $autLastName = $_POST['author_last_name'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $instanceBook->addBook($isbn, $autFirstName, $autLastName, $name, $description);
        header("Location: index.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Books</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="index.php">Search</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add.php">Add book</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
        <h2>Add book</h2>
        <form action="add.php" method="post">
            <input type="text" name="isbn" class="form-control my-2" placeholder="ISBN" required>
            <input type="text" name="name" class="form-control my-2" placeholder="Name" required>
            <input type="text" name="author_first_name" class="form-control my-2" placeholder="Author's first name" required>
            <input type="text" name="author_last_name" class="form-control my-2" placeholder="Author's last name" required>
            <textarea type="text" name="description" rows="10" class="form-control my-2" placeholder="Description" required></textarea>
            <input class="btn btn-primary my-2" type="submit" value="Add" name="add">
        </form>
    </div>
</body>
</html>