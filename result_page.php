<?php

include("database.php");

$serch = $_POST['picture'];
$query = "SELECT imagePath FROM gallery WHERE caption LIKE '%$serch%'";
$result = mysqli_query($conn,$query);

if($result)
{
    if(mysqli_num_rows($result)>0)
    {
        while($x=mysqli_fetch_assoc($result))
        {
            ?>
            <img src="image/<?php echo $x['imagePath'];?>" alt="" width="200px" height="200px" class="image">
            <?php
        }

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body
        {
            margin-left: 600px;
            margin-top:200px;
        }
        img.enlarged {
            transform: scale(1.7); /* Adjust the scale factor as needed */
}
    </style>
</head>
<body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
  const image = document.querySelector("img");
  
  image.addEventListener("click", function () {
    image.classList.toggle("enlarged");
  });
});

    </script>
</body>
</html>