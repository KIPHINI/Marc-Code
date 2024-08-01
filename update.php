<?php

include('database.php');


if (isset($_POST['submit'])) {

    $caption = $_POST['caption'];
    $uploadedby = "1";

    $from = $_FILES["file"]["tmp_name"]; 
    $go = "image/".basename($_FILES["file"]["name"]);
    $imagepath = basename($_FILES["file"]["name"]);

    $sql = "INSERT INTO gallery (caption, imagePath, uploadedBy) VALUES ('$caption', '$imagepath', '$uploadedby')";
    // mysqli_query($conn,$sql);

    move_uploaded_file($from, $go);
    // if (move_uploaded_file($from, $go)) {
    //     echo "File uploaded successfully.";}

         if( mysqli_query($conn,$sql)){
            print "<div><p>
            Image uploaded successiful.
            </p></div>";

         }
        else {
            print "<div><p>
            Sorry, image does't uploaded.
            </p></div>";
    }
}

mysqli_close($conn);

print "
<style>
    p
    {
        background-color:  rgb(145, 251, 88);;
        padding: 5px;
        border-radius: 7px;
    }
    div
    {
        margin-left: 690px;
        width: 300px;
    }
</style>
";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="uploadstyle.css">
</head>
<body>
    <h1 id="upload_head">Upload Image</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file"><br>
        <input type="text" name="caption" id="caption" placeholder="Image Caption" required><br>
        <input type="submit" name="submit" value="upload" id="upload">
    </form>
</body>
</html>

