<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'newdb';

try {
    $conn = new PDO("mysql:host=$HOSTNAME;dbname=$DATABASE", $USERNAME, $PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$uploadMessage = ""; // Initialize the message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"])) {
        $image = $_FILES["image"];
        $destine = ".images/".$image['name'];
        
        if (move_uploaded_file($image['tmp_name'],$destine)) {
            $imageData = $image["tmp_name"];
            $imageType = $image["type"];
            $uploadedBy = 1;
            $caption = $_POST['caption'];
            
            try {
                $stmt = $conn->prepare("INSERT INTO gallery (imageID, caption, imagePath ,uploadedBy, timeUploaded) VALUES (:imagepath, :image_type, :uploadedBy, :caption)");
                $stmt->bindParam(':imagepath', $image['name'], PDO::PARAM_LOB);
                $stmt->bindParam(':image_type', $imageType);
                $stmt->bindParam(':uploadedBy', $uploadedBy);
                $stmt->bindParam(':caption', $caption);
                $stmt->execute();
                $uploadMessage = "Image uploaded successfully";
            } catch (PDOException $e) {
                $uploadMessage = "Error uploading image: " . $e->getMessage();
            }
        } else {
            $uploadMessage = "Image upload failed";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Result</title>
    <style>
        body {
            background-color: #f0f8ff; /* Pale blue background */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            text-align: center;
            margin: 20px auto;
            padding: 20px;
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        label, input {
            display: block;
            margin: 10px 0;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="file"] {
            display: block;
            margin-top: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #33cc33; /* Green background */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        p.alert-message {
            background-color: #33cc33;
            color: #fff;
            text-align: center;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Image Upload Result</h2>
    
    <?php if (!empty($uploadMessage)): ?>
        <p class="alert-message"><?php echo $uploadMessage; ?></p>
    <?php endif; ?>
    
    <form method="post" action="" enctype="multipart/form-data">
    <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image">
        <label for="caption">Caption:</label>
        <input type="text" name="caption" id="caption">
        <input type="submit" value="Upload">
    </form>
</body>
</html>
