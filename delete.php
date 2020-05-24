<?php
include('./config.php');
                    if ($_GET) {
                        $id = $_GET['id'];
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                            }

                            // sql to delete a record
                            $sql = "DELETE FROM movie WHERE id=$id";

                            if ($conn->query($sql) === TRUE) {
                            header( "refresh: 0; url=.$redirect" );
                            } else {
                            echo "Error deleting record: " . $conn->error;
                            }

                            $conn->close();
                    }else{
                        echo '
                            ID ไม่ถูกต้อง.......
                        ';
                    header( "refresh: 1; url=.$redirect" );
                    }
?>