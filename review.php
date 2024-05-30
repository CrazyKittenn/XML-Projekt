<!DOCTYPE html>
<html lang="en">

<?php
$index = 0;
if (isset($_GET["index"])) {
    $index = intval($_GET["index"]);
}
if (file_exists("reviews.xml")) {
    $xml = simplexml_load_file("reviews.xml");
    $numberOfReviews = count($xml->Review);
} else {
    exit("Failed to open reviews.xml.");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Game Reviews">
    <meta name="keywords" content="Games, Reviews">
    <meta name="author" content="Filip Gredelj">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/zajednici.css">
    <link rel="stylesheet" href="CSS/review.css">
    <?php
    $title = $xml->Review[$index]->Title;
    echo "<title>$title - Game Reviews</title>";
    ?>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-sm bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Game Reviews</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="xmlValidatorForm.html">XML Validator</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center">
        <h1><?php echo $title; ?></h1>
        <div>
            <?php
            $imagePath = $xml->Review[$index]->Image;
            echo "<img src='$imagePath' alt='$title' width=30%>";
            ?>
        </div>
        <div class="descriptionMargin">
            <p><?php echo $xml->Review[$index]->Description; ?></p>
        </div>
        <h2>Platforms</h2>
        <?php
        $platforms =  $xml->Review[$index]->Platforms;
        echo "<p>$platforms</p>"; ?>
        <h2>Release Date</h2>
        <?php
        $dateTimeObject = DateTime::createFromFormat('Y-m-d', $xml->Review[$index]->ReleaseDate);
        $dateString = $dateTimeObject->format('M j Y');
        echo "<p>$dateString</p>";
        ?>
        <h2>Developer</h2>
        <?php
        $developer = $xml->Review[$index]->Developer;
        echo "<p>$developer</p>";
        ?>
        <h2>Publisher</h2>
        <?php
        $publisher =  $xml->Review[$index]->Publisher;
        echo "<p>$publisher</p>";
        ?>
        <h2>Genres</h2>
        <?php
        $genres =  $xml->Review[$index]->Genres;
        echo "<p>$genres</p>";
        ?>
        <div class="d-flex justify-content-center flex-column">
            <h2>Metascore</h2>
            <?php
            $metascore = $xml->Review[$index]->Scores->Score[0];
            $metascoreColor = "redScore";
            if ($metascore >= 80) {
                $metascoreColor = "greenScore";
            } else if ($metascore >= 50) {
                $metascoreColor = "yellowScore";
            }
            echo "<div class='rounded $metascoreColor score'>
                    <p>$metascore</p>
                 </div>";
            ?>
        </div>
        <div class="d-flex justify-content-center flex-column">
            <h2>User score</h2>
            <?php
            $userScore = $xml->Review[$index]->Scores->Score[1];
            $userScoreColor = "redScore";
            if ($userScore >= 8.0) {
                $userScoreColor = "greenScore";
            } else if ($userScore >= 5.0) {
                $userScoreColor = "yellowScore";
            }
            echo "<div class='rounded-circle $userScoreColor score'>
                    <p>$userScore</p>
                 </div>";
            ?>
        </div>
    </div>
    <nav aria-label="...">
        <ul class="pagination justify-content-center m-5">
            <?php
            //Previous button
            if ($index == 0) {
                echo "<li class='page-item disabled'>
                <a class='page-link' href='#' tabindex='-1'>Previous</a>
                </li>";
            } else {
                $prevoiusIndex = $index - 1;
                echo "<li class='page-item'>
                <a class='page-link' href='review.php?index=$prevoiusIndex'>Previous</a>
                </li>";
            }
            //Middle
            $startIndex = 0;
            $endIndex = $numberOfReviews;
            if ($numberOfReviews > 5) {
                if ($index > 2) {
                    $startIndex = $index - 2;
                    $endIndex = $index + 3;
                } else {
                    $endIndex = 5;
                }
            }
            if ($index > $numberOfReviews - 4) {
                $startIndex = $numberOfReviews - 5;
                $endIndex = $numberOfReviews;
            }
            for ($i = $startIndex; $i < $endIndex; $i++) {
                $displayIndex = $i + 1;
                if ($i == $index) {
                    echo "<li class='page-item active'>
                        <a class='page-link' href='#'>$displayIndex</a>
                        </li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='review.php?index=$i'>$displayIndex</a></li>";
                }
            }
            //Next button
            if ($index ==  $numberOfReviews - 1) {
                echo "<li class='page-item disabled'>
                <a class='page-link' href='#' tabindex='-1'>Next</a>
                </li>";
            } else {
                $nextIndex = $index + 1;
                echo "<li class='page-item'>
                <a class='page-link' href='review.php?index=$nextIndex'>Next</a>
                </li>";
            }
            ?>
        </ul>
    </nav>
</body>
<footer class="bg-body-tertiary mt-auto">
    <div class="d-flex justify-content-center align-items-center">
        <p>Filip Gredelj 2024</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</footer>

</html>