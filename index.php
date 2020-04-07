<html >
    <head>
        <title>Backend_eshop</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body style="margin:10px;background-color:lightgreen; font-family:Arial black;">
        <?php
            $host = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "eshop";
            $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                         }
            
         ?>
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Zobrazenie prouktov</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Pridanie produktov</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Úprava produktov</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Mazanie produktov</a>
                </div>
            </div>
            <div class="col-9"> 
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        
                            <?php
                                $sql = "SELECT nazov, cena, pocet, obrazok FROM produkty";
                                 $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <div class="card" style="width: 200px;margin:10px;">
                                    <img class="card-img-top" src="<?php echo $row["obrazok"]; ?>" >
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Názov: <?php echo $row["nazov"]; ?></li>
                                        <li class="list-group-item">Cena: <?php echo $row["cena"]; ?></li>
                                        <li class="list-group-item">Počet ks: <?php echo $row["pocet"]; ?></li>
                                    </ul>
                                </div>
                                <br />                                                    
                            <?php
                                    }
                                }                         
                            
                            ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <form method="post" action="connect.php">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Názov produktu</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" name="nazov" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Cena produktu</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="cena" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Počet</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="pocet" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Popis</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="popis" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Obrázok</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="obrazok" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Pridaj produkt</button>
                        </form>
     
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">                   
                    <table class="table table-striped table-dark">
                              <thead>
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Nazov</th>
                                  <th scope="col">Cena</th>
                                  <th scope="col">Počet</th>
                                  <th scope="col">Popis</th>
                                  <th scope="col">Upravenie</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $sql = "SELECT id, nazov, cena, pocet, popis FROM Produkty";
                                  $result = $conn->query($sql);

                                 if ($result->num_rows > 0) {
    
                                while($row = $result->fetch_assoc()) {
                                
                                ?>
                                  <tr>                                 
                                  <td><?php echo $row["id"]; ?></td>
                                  <td><?php echo $row["nazov"]; ?></td>
                                  <td><?php echo $row["cena"]; ?></td>
                                  <td><?php echo $row["pocet"]; ?></td>
                                  <td><?php echo $row["popis"]; ?></td>
                                  <?php echo "<td><a href='update.php?id=" . $row['id'] . "' class='btn btn-info'>Update</a></td>";?>
                                  </tr>
                                <?php                               
                                }
                                } else {
                                echo "0 results";
                                }
                               
         
                                ?>

                              </tbody>
                            </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                      <table class="table table-striped table-dark">
                              <thead>
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Nazov</th>
                                  <th scope="col">Cena</th>
                                  <th scope="col">Počet</th>
                                  <th scope="col">Popis</th>
                                  <th scope="col">Zmazanie</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $sql = "SELECT id, nazov, cena, pocet, popis FROM Produkty";
                                  $result = $conn->query($sql);

                                 if ($result->num_rows > 0) {
    
                                while($row = $result->fetch_assoc()) {
                                
                                ?>
                                  <tr>                                 
                                  <td><?php echo $row["id"]; ?></td>
                                  <td><?php echo $row["nazov"]; ?></td>
                                  <td><?php echo $row["cena"]; ?></td>
                                  <td><?php echo $row["pocet"]; ?></td>
                                  <td><?php echo $row["popis"]; ?></td>
                                  <?php echo "<td><a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>"?>
                                  </tr>
                                <?php                               
                                }
                                } else {
                                echo "0 results";
                                }
                                $conn->close();
         
                                ?>

                              </tbody>
                            </table>  
                    </div>
                </div>
            </div>
        </div>




        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>