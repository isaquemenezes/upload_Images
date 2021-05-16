<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Anúncios</title>
</head>
<body>
    <?php 
        $ads = $objAds->selectAdsById($idAds);

        echo "<h1>$ads[title] </h1> <br> 
                  $ads[date]<hr>";
        echo "$ads[content] <hr>";

        foreach($files =$objUpload->selectFilesByFk($idAds) as $showImg) {
            echo "<img width='150' height='150' src='".DIRPAGE."$showImg[path]' alt='$ads[title]'>";
        }

        
    ?>
</body>
</html>