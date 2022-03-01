<?php 

//get all books 
function getAllBooks($db) {

    $sql = 'Select * FROM books '; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

//get book by id 
function getBook($db, $bookId) {

    $sql = 'Select b.bookTitle, b.author, b.ISBN, b.bookCopies, b.publisherName, b.genres FROM books b  ';
    $sql .= 'Where b.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $bookId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

//add new book 
function createBook($db, $form_data) { 
    
    $sql = 'Insert into books (bookTitle, author, ISBN, bookCopies, publisherName, genres)'; 
    $sql .= 'values (:bookTitle, :author, :ISBN, :bookCopies, :publisherName, :genres)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':bookTitle', $form_data['bookTitle']); 
    $stmt->bindParam(':author', $form_data['author']);  
    $stmt->bindParam(':ISBN', ($form_data['ISBN']));  
    $stmt->bindParam(':bookCopies', ($form_data['bookCopies']));  
    $stmt->bindParam(':publisherName', $form_data['publisherName']); 
    $stmt->bindParam(':genres', $form_data['genres']); 
    $stmt->execute(); 
    return $db->lastInsertID();
}


//delete book by id 
function deleteBook($db,$bookId) { 

    $sql = ' Delete from books where id = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$bookId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

//update book by id 
function updateBook($db,$form_dat,$bookId) { 

    $sql = 'UPDATE books SET bookTitle = :bookTitle , author = :author , ISBN = :ISBN , bookCopies = :bookCopies , publisherName = :publisherName , genres = :genres '; 
    $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$bookId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->bindParam(':bookTitle', $form_dat['bookTitle']); 
    $stmt->bindParam(':author', $form_dat['author']); 
    $stmt->bindParam(':ISBN', ($form_dat['ISBN'])); 
    $stmt->bindParam(':bookCopies',($form_dat['bookCopies']));  
    $stmt->bindParam(':publisherName',($form_dat['publisherName']));  
    $stmt->bindParam(':genres',($form_dat['genres'])); 
    $stmt->execute(); 
}