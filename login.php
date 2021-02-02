<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>   

      <style>

        div {
            padding-bottom:20px;
        }
        .card-body {
             padding: 0px 20px;
         }
    </style>
</head>
<body>



 <?php 
 session_start();
if(isset($_POST['useremail']) && isset($_POST['password'])) {  
    $useremail=$_POST['useremail'];  
    $password=$_POST['password']; 

 // $json_string = '{
 //                "email":"admin@rekko.com",
 //                "password":"Test@123"
 //                }';

//$my_array_data = json_decode($json_string, TRUE);
$json_string = array(
    'email'=>$useremail,
    'password'=> $password,
    
);

 $curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($json_string) );
curl_setopt($curl, CURLOPT_URL, 'https://insta.dmlabs.in/auth/login');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$result = curl_exec($curl);
if(!$result){die("Connection Failure");}
curl_close($curl);
//echo $result;
$arrvalue =Json_decode($result);
//print_r($arrvalue);
// print_r($arrvalue->response) ;
// die;
if(isset($arrvalue->response)){
  $tt  =$_SESSION['logged_user'] = $arrvalue->response;
  print_r($tt);
 // die;
    header("Location: Dashboard.php");
}else{ 
//header("Location: signup.php");
echo "login detail is not correct";
}


}

  ?>

    <div id="wrapper">


       <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-md-5">
                <h1 style="padding-left: 20px;">User login</h1>
                <div class="card">
                    <div class="card-body">
                        <form  class="" action="" method="post">
                            <div class="form-group">
                                <label> user email</label>
                                <input type="email" class="form-control" name="useremail">
                            </div>
                            <div class="form-group">
                                <label>password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                         <input type="submit" value="submit" />
                            <div><a href="signup.php">sing up</a></div>
                        </form>
                     
                    </div>
                </div>
            </div>
        </div>  
    </div>

</body>
</html>