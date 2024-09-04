<?php

    include('DbConnect.php');
    require_once('Book.php');

    $conn = new DbConnect();
    $dbConnection = $conn->connect();

    $instanceBook = new Book($dbConnection);
    $books = $instanceBook->getBooks();

    if (isset($_GET['isbn']) || isset($_GET['name']) || isset($_GET['author_first_name']) || isset($_GET['author_last_name'])){
        $isbn = $_GET['isbn'];
        $name = $_GET['name'];
        $autFirstName = $_GET['author_first_name'];
        $autLastName = $_GET['author_last_name'];
        $filteredBooks = $instanceBook->filterBooks($isbn, $name, $autFirstName, $autLastName);
    }
    else{
        $filteredBooks = $books;
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
        <h2>Search</h2>
        <form action="index.php" method="get">
            <input type="text" name="isbn" class="form-control my-2" placeholder="ISBN">
            <input type="text" name="name" class="form-control my-2" placeholder="Name">
            <input type="text" name="author_first_name" class="form-control my-2" placeholder="Author's first name">
            <input type="text" name="author_last_name" class="form-control my-2" placeholder="Author's last name">
            <input class="btn btn-primary my-2" type="submit" value="Filter">
        </form>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Author's first name</th>
                <th>Author's last name</th>
                <th>Description</th>
                <th>ISBN</th>
            </tr>
            <?php
            foreach($filteredBooks as $item):
            ?>
            <tr>
                <td><?php echo $item['id']?></td>
                <td><?php echo $item['name']?></td>
                <td><?php echo $item['author_first_name']?></td>
                <td><?php echo $item['author_last_name']?></td>
                <td><?php echo $item['description']?></td>
                <td><?php echo $item['isbn']?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </table>
    </div>
</body>
</html>