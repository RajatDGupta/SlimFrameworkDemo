<?php



   //slim_api_fremwork

   //Get All user from databse
   //url is "http://localhost/Projects/slim_api_fremwork/v1/users"
   $app->get('/users', function () {
    
   require_once('dbConnect.php');
   
   $sql = "SELECT * FROM `users` ORDER BY id";

   $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
   	  $data[]=$row;
    }

    if(isset($data)){
      echo json_encode($data);   	
    }

    mysqli_close($conn);
   
   });


   //Get sepcific user
   //url is "http://localhost/Projects/slim_api_fremwork/v1/users/2"
   //in retrofit use @path you can increse parameter ........ or multiple ex. /users/{id}/{}
   $app->get('/users/{id}', function ($request) {
    
    require_once('dbConnect.php');

    $id =$request-> getAttribute('id');

    $sql = "SELECT * FROM `users` WHERE id=$id";
  
    $result = $conn->query($sql);

   	$data[]=$result->fetch_assoc();
   
    if(isset($data)){
      echo json_encode($data);   	
    }

    mysqli_close($conn);

   });

  
    //Post data and create a new record
    //if you use post than body is form encoded
    //url is "http://localhost/Projects/slim_api_fremwork/v1/users/insert"
    //in retrofit use POST with @field or @body.....
    $app->post('/users/insert', function ($request,$response) {
    
      require_once('dbConnect.php');

      $name = $request->getParsedBody()['name'];
      $username = $request->getParsedBody()['username'];
      $password = $request->getParsedBody()['password'];
      $api_key = $request->getParsedBody()['api_key'];
      

   $sql="INSERT INTO users(name,username,password,api_key) VALUES (
                              '$name','$username','$password','$api_key')";
  
      $insert=mysqli_query($conn,$sql);
  
        if($insert){
    
          echo json_encode(array('response' =>"sucessfull" ));
        }
        else{
          echo json_encode(array('response' =>"Unsucessfull" ));
        }
         mysqli_close($conn);

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
    $app->post('/users/body', function ($request,$response) {
    
      require_once('dbConnect.php');

      $name = $request->getParsedBody()['name'];
      $id = $request->getParsedBody()['id'];
   
      echo $request->getBody();
      //

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



		
