<?php
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM movie WHERE id = ?";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["title"];
                $address = $row["link"];
                $salary = $row["poster"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
    echo '
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <center><label><h3><strong>'.$row["title"].'</strong></h3></label></center><br>
                        <center><label><h3><i class="fab fa-imdb "></i> IMDB | <span class="badge badge-warning"><strong>'.$row['point'].'</strong>/10</span></h3></label></center><br>
                        <center><img class="img-thumbnail" src="'.$row["poster"].'" alt=""></center>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="img-thumbnail" src="'.$row["link"].'" allowfullscreen=""></iframe>
                        </div>
                        <a href="index.php" class="btn btn-danger mt-2" role="button" aria-pressed="true">กลับ</a>
                </div>
            </div>
        </div>
    </body>
    </html>
    
    ';
}else {
    header( "refresh: 0; url=.$redirect" );
    exit(0);
}
?>    