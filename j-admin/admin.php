<?php



$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "sparkshop"; 

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // If the connection is successful, send a confirmation message
  
} catch(PDOException $e) {
    // If an error occurs during connection, display the error message
    echo "Connection failed: " . $e->getMessage();
}





$db = mysqli_connect('localhost', 'root', '', 'sparkshop2');
$sid = $_POST['id'];
$query = "SELECT id FROM products WHERE sid='$sid'";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];
$query = "SELECT name FROM products WHERE id='$id'";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$category_name = $row['name'];
$pid = rand(9999,1000);
$brand = $_POST['brand'];
$productname = $_POST['name'];
$qty = $_POST['qty']; //add quanitity in db
$price = $_POST['price'];
date_default_timezone_set("Asia/Kolkata");
$t=time(); 
$created_date = date("Y-m-d:h-i-s",$t);
$updated_date = date("Y-m-d:h-i-s",$t);
$total = count($_FILES["fileToUpload"]["name"]);
$target_dir = "products-images/";
for($i = 0 ; $i < $total; $i++){
    $target_file[$i] = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file[$i],PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
        if($check !== false) {
        
        $uploadOk = 1;
        } else {
        
        $uploadOk = 2;
        }
    
    
    // Check if file already exists
    if (file_exists($target_file[$i])) {
        
        $uploadOk = 3;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"][$i] > 500000) {
        
        $uploadOk = 4;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp" ) {
        
        $uploadOk = 5;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 5) {
        echo 5; exit();
    } 
    else 
        if($uploadOk == 4){
            echo 4; exit();
        }
        else
            if($uploadOk == 3){
                echo 3; exit();
            }
            else
                if($uploadOk == 2){
                    echo 2; exit();
                }
            else{
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file[$i]);
                
                
            }
}
$query= "INSERT INTO products (id,category_id,category_name,product_name,subcategory_id,price,brand,qty,image,created_date,updated_date) VALUES('$pid','$id','$category_name','$productname','$sid','$price','$brand','$qty','$target_file[0]','$created_date','$updated_date')";
$result = mysqli_query($db,$query);
if(!$result){
    die(mysqli_error());
    echo 0;
    exit();
}
else{
    for($i = 0 ; $i < $total ; $i++)
    {
            $query = "INSERT INTO product_images (pid,image) VALUES('$pid','$target_file[$i]')";
            $result = mysqli_query($db,$query);
    }
    echo 1;
}


?>
       
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .text-font{
            font-size: 35px;
            font-weight: bolder;
        }
        .height{
            height: 100vh   ;
        }
        .error{
                color: red;
                font-size: large;
            
            }
            .success{
                color: green;
                font-size: large;
          
            }
            .error1{
                color: red;
                font-size: large;
            
            }
            .success1{
                color: green;
                font-size: large;
          
            }
            .error2{
                color: red;
                font-size: large;
            
            }
            .success2{
                color: green;
                font-size: large;
          
            }
            .hide{
                display: none;
            }
    </style>
       
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 bg-dark height">
                <p class="pt-5 pb-5 text-center">
                    <a href="admin-panel.php" class="text-decoration-none"><span class="text-light text-font">Admin</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="admin-profile.php" class="text-decoration-none"><span class="text-light">Profile</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="categories.php" class="text-decoration-none"><span class="text-light">Categories</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="subcategories.php" class="text-decoration-none"><span class="text-light">Browse Categories</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="products-add.php" class="text-decoration-none"><span class="text-light">Add Products</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="products-display.php" class="text-decoration-none"><span class="text-light">View Products</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="new-user-requests.php" class="text-decoration-none"><span class="text-light">New user requests</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="view-users.php" class="text-decoration-none"><span class="text-light">View user</span></a>
                </p>                
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="display-orders.php" class="text-decoration-none"><span class="text-light">View Orders</span></a>
                </p>
  
            </div>
            <div class="col-sm-10 bg-light">
               <div class="row">
                   <div class="col-sm-2">
                       <p class="text-center pt-5">
                                    <img class="rounded" src="<?php echo ("C:\xampp\htdocs\SparkShop-main\img\SparkPadel.jpg") . ($_SESSION['email']) . "display-picture.jpg"; ?>" width="150px" height="140px">
                                </p>
                   </div>
                   <div class="col-sm-8">
                       <h1 class="text-center pt-4 pb-5"><strong>Add Products</strong></h1>
                       <hr class="w-25 mx-auto">
                   </div>
                   <div class="col-sm-2">
                       <p class="pt-5 text-center">
                            <a href="logout.php" class="btn btn-outline-primary">Logout</a>
                       </p>
                   </div>
               </div>
               <div class="container mx-auto">
                   <form action="products-add.php" id="the-form" class="form-control w-50 mx-auto" enctype="multipart/form-data" method="post">
                      
                        <label class="pt-4 pb-2 text-center">Enter product name</label>
                        <input type="text" class="form-control" value="<?php echo $_POST['name']?>" id="name" name="pname" placeholder="Enter Product name">
                        <label class="pt-4 pb-2 text-center">Enter Brand name</label>
                        <input type="text" class="form-control" value="<?php echo $_POST['brand']?>" id="brand" name="brand" placeholder="Enter brand name">
                        <label class="pt-4 pb-2 text-center">Enter product price</label>
                        <input type="text" class="form-control" value="<?php echo $_POST['price']?>" id="prprice" name="price" placeholder="Enter Product price">

                        
                         <label class="pt-4 pb-2 text-center" for="categories">Choose a category</label>
                            <select class="form-control" id="categories" name="categories" onchange="this.form.submit()">
                                <option value=""><?php if(isset($_POST['categories'])){
                                $id2 = $_POST['categories'];
                                $query2 = "SELECT * FROM category where id='$id2'";
                                $result2 = mysqli_query($db, $query2);
                                if(!$result2){
                                     die(mysqli_error());
                                     exit();
                                }
                                    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                    echo $row2['name'];
                                    
                                }
                                else
                                    echo ("-");
                                                         ?></option>
                             <?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
                                     <option value="<?php echo ($row['id']); ?>"><?php echo $row['name'];?></option>
                             <?php } ?>
                           
                             </select>
                             
                             <?php
                               
                                $id = $_POST['category'];
                                echo "<input type='hidden' value='$id' id='categoryid'>";
                                $query1 = "SELECT * FROM subcategory where id='$id'";
                                $result1 = mysqli_query($db, $query1);
                                if(!$result1){
                                     die(mysqli_error());
                                     exit();
                                }
                             ?>
                        <label class="pt-4 pb-2 text-center" for="subcategories">Choose a sub-category</label>
                            <select class="form-control" id="subcategories" name="subcategories">
                                <option value="">-</option>
                            <?php while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){ ?>
                                     <option value="<?php echo $row1['sid'];?>"><?php echo ($row1['name']); ?></option>
                             <?php } ?>
                             </select>
                             <br>
                       
                        
                            <p class="text-danger pt-2"><strong>Upload product images</strong></p>
                                    <input type="file" name="fileToUpload[]" class="form-control" multiple>
                             <p> 
                                       
                        </p><br>
                        <div class="container w-25 mx-auto">
                            <div class="hide"><img class="mx-auto" style="height: 50px; width: 50px;"src="/test123/products-images/ajax-loader.gif"></div>
                        </div>
                        <br>
                        <button type="button" class="btn btn-primary form-control" onclick="addproduct()" id="btnSubmit">Add product</button>
                        <br><br>
                        <div class="error"></div>
                        <div class="success"></div>
                         </form>
                        
                        <br><br>
                        
                    
                    
                    <script>
                                function addproduct(){
                                    event.preventDefault();
                                    var form = $('#the-form')[0];
                                    var data = new FormData(form);
                                    $('.hide').show();
                                    $.ajax({
                                        type: "POST",
                                        enctype: 'multipart/form-data',
                                        url: "product-upload.php",
                                        data: data,
                                        processData: false,
                                        contentType: false,
                                        cache: false,
                                        success: function (data) {
                                            if(data == 1){
                                                $('.success').html("Product uploaded").show();
                                                $('.error').hide();
                                            }
                                          
                                            if(data == 0)
                                            {
                                                 $('.error').html("Error uploading file. Pls try again.").show();
                                                    $('.success').hide();
                                            }
                                            if(data == 2)
                                            {
                                                 $('.error').html("File is not an image.").show();
                                                    $('.success').hide();
                                            }
                                            if(data == 3)
                                            {
                                                 $('.error').html("File already exist.").show();
                                                    $('.success').hide();
                                            }
                                            if(data == 4)
                                            {
                                                 $('.error').html("File too large. Keep file size below 200KB.").show();
                                                    $('.success').hide();
                                            }
                                            if(data == 5)
                                            {
                                                 $('.error').html("Uploaded file is not an image.").show();
                                                    $('.success').hide();
                                            }
                                            if(data == 6)
                                            {
                                                 $('.error').html("Uknown error occurs.").show();
                                                    $('.success').hide();
                                            }
                                            if(data == 0)
                                            {
                                                 $('.error').html("#######").show();
                                                    $('.success').hide();
                                            }
                                            
                                        },
                                        complete: function(){
                                            $('.hide').hide();
                                        },
                                        error: function (e) {
                                            $(".error").text(e.responseText);
                                            console.log("ERROR : ", e);
                                        }
                                    });
                                }
                    </script>
               </div>
                
            </div>
        </div>
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>