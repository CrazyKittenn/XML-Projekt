<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="XML Validator">
    <meta name="keywords" content="XML, Validator">
    <meta name="author" content="Filip Gredelj">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>XML Validator</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-sm bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="xmlValidatorForm.html">XML Validator</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="review.php">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="xmlValidatorForm.html">XML Validator</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center">
        <?php
        if ($_FILES["xml_file"]["name"] != "" && $_FILES["schema_file"]["name"] != "") {
            $xml_file = $_FILES['xml_file'];
            $schema_file = $_FILES['schema_file'];
            echo "<h3>XML File</h3>";
            echo "<pre>";
            print_r($xml_file);
            echo "</pre>";
            echo "<h3>Schema File</h3>";
            echo "
            <pre>";
            print_r($schema_file);
            echo "</pre>";
            $xml = new DOMDocument();
            $xml->load($xml_file['tmp_name']);
            if ($xml->schemaValidate($schema_file['tmp_name'])) {
                echo "The XML file is valid";
            } else {
                echo "The XML file is invalid";
            }
        } else {
            echo "<h1>Files are empty</h1>";
        }
        ?>
    </div>
</body>
<footer class="bg-body-tertiary mt-auto">
    <div class="d-flex justify-content-center align-items-center">
        <p>Filip Gredelj 2024</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</footer>

</html>