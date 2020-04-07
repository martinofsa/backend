<?php
require_once "config.php";
if (isset($_GET['id'])) {
    $sql = "SELECT nazov, cena, pocet, popis, obrazok FROM produkty WHERE id = ?";
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("i", $_GET["id"]);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $param_nazov = $row["nazov"];
                $param_cena = $row["cena"];
                $param_pocet = $row["pocet"];
                $param_popis = $row["popis"];
                $param_obrazok = $row["obrazok"];
            } else {
                echo "Error! Data Not Found";
                exit();
            }
        } else {
            echo "Error! Please try again later.";
            exit();
        }
        $stmt->close();
    }
} else {
    header("location: index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nazov"]) && !empty($_POST["cena"]) && !empty($_POST["pocet"]) && !empty($_POST["popis"]) && !empty($_POST["obrazok"])) {
        $sql = "UPDATE produkty SET nazov = ?, cena = ?, pocet = ?, popis = ?, obrazok = ? WHERE id = ?";
        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("sssssi", $_POST["nazov"], $_POST["cena"], $_POST["pocet"], $_POST["popis"], $_POST["obrazok"], $_GET["id"]);
            $stmt->execute();
            if ($stmt->error) {
                echo "Error!" . $stmt->error;
                exit();
            } else {
                header("location: index.php");
                exit();
            }
            $stmt->close();
        }
    }
    $link->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upravenie produktu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        label{
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <div class="card" style="margin-top:20px;">
                   <div class="card-body">
                       <div class="page-header">
                           <h2>Upravenie produktov</h2>
                       </div>
                      
                       <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                           <div class="form-group">
                               <label>Nazov</label>
                               <input type="text" name="nazov" class="form-control" required value="<?php echo $param_nazov; ?>">
                           </div>
                           <div class="form-group">
                               <label>Cena</label>
                               <textarea name="cena" class="form-control" required ><?php echo $param_cena; ?></textarea>
                           </div>
                           <div class="form-group">
                               <label>Pocet</label>
                               <input type="text" name="pocet" class="form-control" value="<?php echo $param_pocet; ?>" required>
                           </div>
                           <div class="form-group">
                               <label>Popis</label>
                               <input type="text" name="popis" class="form-control" value="<?php echo $param_popis; ?>" required>
                           </div>
                           <div class="form-group">
                               <label>Obrazok</label>
                               <input type="text" name="obrazok" class="form-control" value="<?php echo $param_obrazok; ?>" required>
                           </div>
                           <input type="submit" class="btn btn-primary" value="Update">
                           <a href="index.php" class="btn btn-default">Cancel</a>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>