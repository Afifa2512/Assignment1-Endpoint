<?php
use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace


// read table books
$app->get('/hello/{name}', function (Request $request, Response $response,
array $arg){
$name = $arg['name'];
$response->getBody() -> write ("Hello World, $name");
return $response; //dye akan response yg at write tu
});