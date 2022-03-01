<?php 

use Slim\Http\Request; //namespace 
use Slim\Http\Response; //namespace 

//include booksProc.php file 
include __DIR__ . '/function/booksProc.php'; 


//read table books 
$app->get('/books', function (Request $request, Response $response, array $arg){

    return $this->response->withJson(array('data' => 'success'), 200); });  
 
// read all data from table books 
$app->get('/allbooks',function (Request $request, Response $response,  array $arg) { 

    $data = getAllBooks($this->db); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 

//request table books by condition (book id) 
$app->get('/books/[{id}]', function ($request, $response, $args){   
    $bookId = $args['id']; 
    if (!is_numeric($bookId)) { 

        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);  
} 
    $data = getBook($this->db, $bookId); 
    if (empty($data)) { 

        return $this->response->withJson(array('error' => 'no data'), 500); 
} 

return $this->response->withJson(array('data' => $data), 200);});

//post method books
$app->post('/books/add', function ($request, $response, $args) { 

    $form_data = $request->getParsedBody(); 
    $data = createBook($this->db, $form_data); 
    if (is_null($data)) {

        return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200); 
    }  );


//delete row books
$app->delete('/books/del/[{id}]', function ($request, $response, $args){   
    $bookId = $args['id']; 
    
   if (!is_numeric($bookId)) { 

       return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
       $data = deleteBook($this->db,$bookId); 
       if (empty($data)) { 

           return $this->response->withJson(array($bookId=> 'is successfully deleted'), 202);}; }); 
 
   
//put table books 
$app->put('/books/put/[{id}]', function ($request, $response, $args){
    $bookId = $args['id']; 
    
    if (!is_numeric($bookId)) { 
        
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
        $form_dat=$request->getParsedBody(); 
        $data=updateBook($this->db,$form_dat,$bookId); if ($data <=0)
        return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});


   