<?php

class Book{
    private $dbConn;

    public function __construct($p_dbConn)
    {
        $this->dbConn = $p_dbConn; 
    }

    public function getBooks() {
        $query = 'SELECT * FROM books';
        $stmt = $this->dbConn->prepare($query);
        $stmt->execute();
        return $stmt->fetchALl(PDO::FETCH_ASSOC);
    }

    public function filterBooks($p_isbn, $p_name, $p_autFirstName, $p_autLastName){
        $sql ='SELECT * FROM books WHERE 1=1';
        $params = [];

        if (!empty($p_isbn) || $p_isbn == "0"){
            $sql .= " AND isbn LIKE :isbn";
            $params[':isbn'] = '%' . $p_isbn . "%";
        }
        if (!empty($p_name) || $p_name == "0"){
            $sql .= " AND name LIKE :name";
            $params[':name'] = '%' . $p_name . "%";
        }
        if (!empty($p_autFirstName) || $p_autFirstName == "0"){
            $sql .= " AND author_first_name LIKE :author_first_name";
            $params[':author_first_name'] = '%' . $p_autFirstName . "%";
        }
        if (!empty($p_autLastName) || $p_autLastName == "0"){
            $sql .= " AND author_last_name LIKE :author_last_name";
            $params[':author_last_name'] = '%' . $p_autLastName . "%";
        }

        $stmt = $this->dbConn->prepare($sql);

        foreach($params as $param => $value){
            $stmt->bindValue($param, $value, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBook($p_isbn,  $p_autFirstName, $p_autLastName, $p_name, $p_description){
        $sql = 'INSERT INTO books (isbn, author_first_name, author_last_name, name, description) VALUES (:isbn, :author_first_name, :author_last_name, :name, :description)';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':isbn', $p_isbn, PDO::PARAM_STR);
        $stmt->bindParam(':author_first_name', $p_autFirstName, PDO::PARAM_STR);
        $stmt->bindParam(':author_last_name', $p_autLastName, PDO::PARAM_STR);
        $stmt->bindParam(':name', $p_name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $p_description, PDO::PARAM_STR);
        return $stmt->execute();
    }
}