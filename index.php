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
        <h2>แผงควบคุม</h2><a name="" id="" class="btn btn-success" href="./create.php" role="button">เพิ่มหนัง</a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
      <div class="table-responsive">
            <?php 
                  include('./config.php');

                  // Create connection
                  $conn = new mysqli($servername, $username, $password, $dbname);
                  // Check connection
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT id, title, link, poster, point FROM movie";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    echo "<table class='table table-bordered'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Title</th>";
                            echo "<th>IMDB</th>";
                            echo "<th>Link</th>";
                            echo "<th>Player</th>";
                            echo "<th>Action</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                      while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td><strong>" . $row['title'] . "</strong></td>";
                        echo '<td><span class="badge badge-warning"><strong>'.$row['point'].'</strong>/10</span></td>';
                        echo "<td><a href='". $row['link'] ."' title='View Record' data-toggle='tooltip'><i class='far fa-eye'></i></a></td>";
                        echo "<td><a href='do.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><i class='far fa-eye'></i></a></td>";
                        echo "<td><a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'>  <i class='fas fa-trash-alt'></i></a></td>";
                    echo "</tr>";
                      }
                      echo "</tbody>";                            
                            echo "</table>";
                  } else {
                      echo "0 results";
                  }

                  $conn->close();

                  ?>
            </div>
      </div>
    </div>
  </div>
</body>
</html>