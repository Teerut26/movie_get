<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มหหนัง</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">เพิ่มหหนัง</h2>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="my-input">ชื่อเรื่อง</label>
                            <input id="my-input" class="form-control" type="text" name="title">
                        </div>
                        <div class="form-group">
                            <label for="my-input">LinkPlayer</label>
                            <input id="my-input" class="form-control" type="url" name="link">
                        </div>
                        <div class="form-group">
                            <label for="my-input">UrlPoster</label>
                            <input id="my-input" class="form-control" type="url" name="poster" placeholder="ตัวอย่าง : https://www.imdb.com/title/tt6806448/">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" name="submit">เพิ่ม</button>
                            <a class="btn btn-danger" href="./index.php" role="button">กลับ</a>
                        </div>
                    </form>
                    <?php  
                        include('./config.php');

                        function curl_load($url){
                            curl_setopt($ch=curl_init(), CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $response = curl_exec($ch);
                            curl_close($ch);
                            return $response;
                        }

                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            
                            
                            $url = $_POST['poster'];
                            $curl = curl_load($url);

                            $pattern_point = '/ratingValue">.../';
                            preg_match($pattern_point, $curl, $matches_point);
                            $point = str_replace('ratingValue">','',$matches_point[0]);

                            $pattern = '/http....m.+._V1_.jpg/';
                            preg_match($pattern, $curl, $matches);
                            
                            $title = $_POST['title'];
                            $link = $_POST['link'];
                            $poster = $matches[0];

                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                            die('<div class="alert alert-danger" role="alert">
                                        Connection failed: '.$conn->connect_error.'
                                </div>');
                                }

                            $sql = "INSERT INTO movie (title, link, poster, point)
                            VALUES ('".$title."', '".$link."', '".$poster."','".$point."')";

                            if ($conn->query($sql) === TRUE) {
                            echo '<div class="alert alert-success" role="alert">
                                        เพิ่มข้อมูลสำเร็จ<br><strong>'.$title.'</strong>
                                  </div>';
                            header( "refresh: 1; url=.$redirect" );
                            } else {
                            echo '<div class="alert alert-danger" role="alert">
                            '. $sql .$conn->error.'
                            </div>';
                            }

                            $conn->close();
                        }
                        ?>
                </div>
            </div>
        </div>
</body>
</html>