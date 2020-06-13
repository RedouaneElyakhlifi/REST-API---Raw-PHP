<!DOCTYPE html>
<html>

<head>
    <title>Find by Author</title>
</head>

<body>

    <h1>Choose the author that you want to see all his posts from.</h1>

    <?php
    //include getAuthors class
    include_once('../Controllers/GetAuthors.php');

    //initiate getAuthors class
    $getAuthors = new GetAuthors();

    //use function to get all authors
    $getAuthors = $getAuthors->readAuthors();

    //check if authors exist
    if ($getAuthors == null) {
        echo 'Message: there are no authors so we cant print the form.';
        die();
    }
    ?>

    <form method="get" action="../Api/Posts/Read_sameAuthor.php" id="form">
        <label for="author">Choose an author:</label><br>
        <select id="author" name="author" required>
            <option disabled selected > -- select an option -- </option>
            <?php if ($getAuthors != null) {
                //loop through the data and post the authors as options in the form
                foreach ($getAuthors as $value) {
                    ?><option value="<?php echo $value ?>"> <?php echo $value ?></option><?php
                }
            }
            ?>
        </select><br><br>
        <input type="submit">
    </form>

</body>

</html>