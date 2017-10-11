<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet">

        <title>Book Shop</title>
    </head>
    <body>
        <div class="col-md-offset-4 col-md-7">
            <h2>Book Shop</h2>
        </div>
        <div class="container center-block">
            <form method="post"  action="index.php">
                <div class="col-md-offset-4 col-md-7">
                    <p><input type="text" name="text1" value="Input Data"> </p>
                    <p><input type="text" name="text2" value="Input Data"> </p>
                    <p><input type="text" name="text3" value="Input Data"> </p>
                </div>
                <div class="col-md-offset-4 col-md-8">
                    <p><input type="radio" name="table" value="new_author" checked>New Author
                    <span class="col-md-offset-1">  <input type="radio" name="table" value="new_book">New Book</p></span>
                </div>
                <div class="col-md-offset-3 col-md-9">
                    <br><p><input type="radio" name="flag" value="select" checked> Select</p>
                    <p><input type="radio" name="flag" value="insert"> Insert</p>
                    <p><input type="radio" name="flag" value="delete"> Delete</p>
                    <p><input type="radio" name="flag" value="update"> Update</p>
                    <div class="col-md-offset-3 col-md-8"> 
                        <p><input type="submit" value="Send"></p><br>
                    </div>
                </div>
            </form>
            <?php
            if (isset($selectMyPDO))
            {
                foreach ($selectMyPDO as $value)
                {
                    echo
                    '<div class="col-md-offset-4 col-md-4 output">'
                    . $value['name']
                    . "</div>";
                }
            } elseif (isset($report))
                {
                    echo
                    '<div class="col-md-offset-4 col-md-4 output">'
                    . $report
                    . "</div>";
            }
            ?>
        </div>
    </body>
</html>
