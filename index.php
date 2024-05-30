<!DOCTYPE html>
<html lang="en">
<?php
if (file_exists("reviews.xml")) {
    $xml = simplexml_load_file("reviews.xml");
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
    <link rel="stylesheet" href="CSS/index.css">
    <title>Game Reviews</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-sm bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Game Reviews</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="review.php">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="xmlValidatorForm.html">XML Validator</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr class="fs-3">
                    <th class="text-center">Title</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Metascore</th>
                    <th class="text-center">User Score</th>
                    <th class="text-center">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($xml->Review); $i++) : ?>
                    <tr class="fs-4">
                        <td class="text-center align-middle">
                            <?php
                            $title = $xml->Review[$i]->Title;
                            echo $title; ?>
                        </td>
                        <td class="text-center align-middle tdWidth">
                            <?php
                            $imagePath = $xml->Review[$i]->Image;
                            echo "<img src='$imagePath' alt='$title' width=80%>";
                            ?>
                        </td>
                        <td class=" text-center align-middle">
                            <?php
                            $metascore = $xml->Review[$i]->Scores->Score[0];
                            $metascoreColor = "redScore";
                            if ($metascore >= 80) {
                                $metascoreColor = "greenScore";
                            } else if ($metascore >= 50) {
                                $metascoreColor = "yellowScore";
                            }
                            echo "<div class='rounded $metascoreColor score'>
                                    $metascore
                                 </div>";
                            ?>

                        </td>
                        <td class="text-center align-middle">
                            <?php
                            $userScore = $xml->Review[$i]->Scores->Score[1];
                            $userScoreColor = "redScore";
                            if ($userScore >= 8.0) {
                                $userScoreColor = "greenScore";
                            } else if ($userScore >= 5.0) {
                                $userScoreColor = "yellowScore";
                            }
                            echo "<div class='rounded-circle $userScoreColor score'>
                                    $userScore
                                </div>";
                            ?>
                        </td>
                        <td class="text-center align-middle"><?php echo "<a href='review.php?index=$i' class='btn btn-primary'>Details</a>"; ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</body>
<footer class="bg-body-tertiary mt-auto">
    <div class="d-flex justify-content-center align-items-center">
        <p>Filip Gredelj 2024</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</footer>

</html>