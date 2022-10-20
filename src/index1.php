<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 

    <?php
    if(isset($_POST["reset"]))
    {
        $_SESSION['products']=[];
        (int)$sum=0;
        (int)$sum1 =0;
        $_SESSION["income"]=0;
    }
    ?>
</body>
</html>