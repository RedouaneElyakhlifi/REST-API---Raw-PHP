<!DOCTYPE html>
<html>

<head>
    <title>Add post</title>
</head>

<body>

    <h1>Here you can add post by filling out the form.</h1>

    <?php
    //include getCategories class
    include_once('../Controllers/GetCategories.php');

    //initiate getCategories class
    $categorie = new GetCategories();

    //use function to get all categories
    $categories = $categorie->readCategories();

    //check if categories exist

    if ($categories == null) {
        echo 'Message: there are no categories so we cant print the form.';
        die();
    }
    ?>

    <form method="post" action="../Api/Posts/Write.php" id="form">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" maxlength="255" required><br><br>
        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author" maxlength="255" required><br><br>
        <label for="category">Category:</label><br>
        <select id="category" name="category" required>
            <option disabled selected > -- select an option -- </option>
            <?php if ($categories != null) {
                //loop through the data and post the categories as options in the form
                for ($i = 0; $i <= count($categories['data']) - 1; $i++) {
                    ?><option value="<?php echo $categories['data'][$i]['name'] ?>"> <?php echo $categories['data'][$i]['name'] ?></option><?php
                }
            }
            ?>
        </select><br><br>
        <label for="body">Body:</label><br>
        <textarea type="text" id="body" name="body" rows="10" cols="50" maxlength="1000" required></textarea><br><br>
        <input type="submit">
    </form>

</body>

</html>