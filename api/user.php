<?php

      
   //slim_api_fremwork

   //Get All user from databse
   //url is "http://localhost/Projects/slim_api_fremwork/v1/users"

   $app->get('/users', function () {
    
   require_once('dbConnect.php');


   if ($conn->connect_error) {
        return $response->withJson(array('message' =>"unsucessfull" ),500, JSON_PRETTY_PRINT);      
   }

   $data=array();
   
   $sql = "SELECT * FROM `users` ORDER BY id";

   $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
   	  $data[]=$row;
    }

    mysqli_close($conn);

    return $response->withJson(array('message' =>"sucessfull",
                                      "User"=>$data ),200,   JSON_PRETTY_PRINT);
    
   });


   
    //Post data and create a new record
    //if you use post than body is form encoded
    //url is "http://localhost/Projects/slim_api_fremwork/v1/users/insert"
    //in retrofit use POST with @field or @body.....
    $app->post('/users/register', function ($request,$response) {
    
      require_once('dbConnect.php');

      if ($conn->connect_error) {
        return $response->withJson(array('message' =>"Unsucessfull" ),500, JSON_PRETTY_PRINT);      
      }

      $first_name = $request->getParsedBody()['first_name'];
      $last_name  = $request->getParsedBody()['last_name'];
      $email	    = $request->getParsedBody()['email'];
      $mobile_no = $request->getParsedBody()['mobile_no'];
      $password = $request->getParsedBody()['password'];
      $created_at = time();
      
      if(isset($first_name) && 
         isset($last_name) &&
         isset($email) &&
         isset($mobile_no) &&
         isset($password))

      {   
        $_sql = "SELECT * FROM `users` WHERE email='$email'";  
        $result = mysqli_query($conn, $_sql);

        if(mysqli_num_rows($result) == 0){
          
               $sql="INSERT INTO users(first_name,last_name,email,mobile_no,password,created_at) VALUES (
                                    '$first_name','$last_name','$email','$mobile_no','$password','$created_at')";
        
                $insert=mysqli_query($conn,$sql);
                mysqli_close($conn);

                if($insert){
                  return $response->withJson(array('message' =>"sucessfull" ),201,   JSON_PRETTY_PRINT);
                }
                else{
                  return $response->withJson(array('message' =>"Unsucessfull"),400 , JSON_PRETTY_PRINT);
                }
          }else{
               return $response->withJson(array('message' =>"Unsucessfull"),409 , JSON_PRETTY_PRINT);
          }
      }
      else{
          return $response->withJson(array('message' =>"Unsucessfull" ),400, JSON_PRETTY_PRINT);
      }
   });

 


	//PUT data and update a record
	//if you use put than body is form encoded
	//url is "http://localhost/Projects/slim_api_fremwork/v1/users/update"
	//in retrofit use PUT with @field or @body..
    $app->put('/users/update', function ($request,$response) {
    
      require_once('dbConnect.php');

      $name = $request->getParsedBody()['name'];
     
      echo $name;

   });



    //DELETE data and delete a record
	//if you use put than body is form encoded
	//url is "http://localhost/Projects/slim_api_fremwork/v1/users/delete"
	//in retrofit use DELETE with @field or @body...
    $app->delete('/users/delete', function ($request,$response) {
    
        require_once('dbConnect.php');	

        $name = $request->getParsedBody()['name'];
    
        echo $name;

   });


    //Post json data and create a new record
    //if you use post than body in row and text in json
    //url is "http://localhost/Projects/slim_api_fremwork/v1/users/body"
    //in retrofit use POST with @body...
    $app->post('/users/imap_body(imap_stream, msg_number)', function ($request,$response) {
    
      require_once('dbConnect.php');

      $name = $request->getParsedBody()['name'];
      $id = $request->getParsedBody()['id'];
   
      echo $request->getBody();
      

   });


    //Get query data and create a new record or else
    //url is "http://localhost/Projects/slim_api_fremwork/v1/users/query"
    //in retrofit use GET with @query or @queryMap as you wish......
    $app->get('/query', function ($request,$response) {
    
      require_once('dbConnect.php');
            
      $name = $request->getQueryParams()['name'];
      $id = $request->getQueryParams()['id'];

      echo $name."-".$id;

   });



		
//Get sepcific user
   //url is "http://localhost/Projects/slim_api_fremwork/v1/users/2"
   //in retrofit use @path you can increse parameter ........ or multiple ex. /users/{id}/{}
    $app->get('/users/{id}', function ($request) {
    
      require_once('dbConnect.php');
  
      $id =$request-> getAttribute('id');
  
      $sql = "SELECT * FROM `users` WHERE id=$id";
    
      $result = $conn->query($sql);
  
       $data=$result->fetch_assoc();
     
      if(isset($data)){
        echo json_encode(array("User"=>$data), JSON_PRETTY_PRINT);   	
      }
  
      mysqli_close($conn);
  
     });
  
    