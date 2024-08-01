<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'newdb';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Search function
function searchImagesByCaption($keyword) {
    global $conn;
    
    $keyword = "%" . $keyword . "%";
    
    $sql = "SELECT imageID, caption, imagePath, timeUploaded, uploadedBy FROM gallery WHERE caption LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $keyword);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $images = $result->fetch_all(MYSQLI_ASSOC);
    
    $stmt->close();
    
    return $images;
}

// Get the search query from the user
if (isset($_GET['q'])) {
    $searchQuery = $_GET['q'];
    $searchResults = searchImagesByCaption($searchQuery);
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
body {
            background-color: #f0f8ff; /* Pale blue background */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin: 0;
        }

        form {
            text-align: center;
            margin: 20px 0;
        }

        input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 5px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        h2 {
            margin-top: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 20px auto;
        }

        div.image-details {
            text-align: center;
            margin-top: 20px;
        }
    </style>
    <title>Image Search and View</title>
</head>
<body>
    <h1>WOOGLE</h1>
    
    <form method="GET" action="">
        <input type="text" name="q" placeholder="Enter caption to search">
        <input type="submit" value="Search">
    </form>
    
    <?php if (isset($searchResults) && !empty($searchResults)): ?>
        <h2>Search Results</h2>
        <?php foreach ($searchResults as $image): ?>
            <div style="margin: 20px;">
                <a href="combined.php?image_id=<?php echo $image['imageID']; ?>">
                    <h3><?php echo $image['caption']; ?></h3>
                    <img src="./images/<?php echo $image['imagePath']; ?>" alt="<?php echo $image['caption']; ?>" style="max-width: 300px;">
                </a>
            </div>
        <?php endforeach; ?>
    <?php elseif (isset($searchQuery)): ?>
        <p>No images matching the caption were found.</p>
    <?php endif; ?>
    
    <?php if (isset($_GET['imageID']) && isset($searchResults)): ?>
        <?php
        $selectedImageId = $_GET['imageID'];
        $selectedImage = null;
        foreach ($searchResults as $image) {
            if ($image['imageID'] == $selectedImageId) {
                $selectedImage = $image;
                break;
            }
        }
        ?>
        
        <?php if ($selectedImage): ?>
            <div style="margin-top: 20px;">
                <h2><?php echo $selectedImage['caption']; ?></h2>
                <img src="./images/<?php echo $selectedImage['imagePath']; ?>" alt="<?php echo $selectedImage['caption']; ?>" style="max-width: 800px;">
                <p>Time Uploaded: <?php echo $selectedImage['timeUploaded']; ?></p>
                <p>Uploaded By: <?php echo $selectedImage['uploadedBy']; ?></p>
            </div>
        <?php else: ?>
            <p>Image not found.</p>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php $conn->close(); ?>
</body>
</html>
