<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "upload");

if (isset($_POST['submit'])) {
    $file = $_FILES['image']['name'];
    $name = $_POST['name'];
    $sql = "INSERT INTO image_upload(name,image) VALUES('$name','$file')";
    $result = (mysqli_query($con, $sql));
    if ($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], "$file");
        $_SESSION['suc'] = "inserted successfully";
        header("location:image.php?suc=$_SESSION[suc]");
        exit();
    } else {
        echo "not inserted";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload image</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

    <form method="post" enctype="multipart/form-data">
        <div class="container mt-4">
            <h2>upload image</h2>

            <div>
                <?php
                if (isset($_SESSION['suc'])) {
                    echo '<div class="alert alert-success w-25">' . htmlspecialchars($_SESSION['suc']) . '<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                unset($_SESSION['suc']);
                ?>
            </div>

            <div class="mb-3">
                <input type="text" class="form-control w-25" name="name" placeholder="Enter the name">
            </div>
            <div class="mb-3">
                Select image:<input type="file" class="form-control w-25" name="image" id="image"><br>
                <input type="submit" class="btn btn-primary" value="upload" name="submit">
            </div>


    </form>
    <table class="table">
        <tbody>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>image</th>
                </tr>
            </thead>



            <?php
            $con = mysqli_connect("localhost", "root", "", "upload");
            $sql = "SELECT * FROM image_upload ";
            $result = mysqli_query($con, $sql);

            $cnt = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo  $cnt++; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><img src="<?php echo $row['image']; ?>" width=200></td>
                </tr>
            <?php
            }
            ?>


        </tbody>
    </table>
    </div>
</body>

</html>