<?php
session_start();
session_destroy();

if(!isset($_SESSION['products']))
{
    $_SESSION['products']=[];
    (int)$sum=0;
    (int)$sum1 =0;
} 
if(!isset($_SESSION["income"]))
{
    $_SESSION["income"]=0;
    
} 
$_SESSION["name"]= $_POST["name"];
$_SESSION["groceries"]=$_POST["groceries"];
$_SESSION["price"]=$_POST["price"];

// code of products add 
if(isset($_POST["submit"]))
{
 if(empty($_SESSION["name"]) ||empty($_SESSION["groceries"]) || empty($_SESSION["price"]))
 {
     echo '<script>alert("please enter the values in textbox")</script>';
 }
 else
 {
 array_push($_SESSION['products'],array('name'=>$_SESSION["name"],'price'=>$_SESSION["price"],'groceries'=>$_SESSION["groceries"],'income'=>$_SESSION["income"]));
 }
 }

//  code for product remove
if (isset($_POST["remove"])) {
    $y1 = $_POST["deleting"];
     array_splice($_SESSION['products'],$y1 ,1);   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- code for product update -->
<?php 
if(isset($_POST["update"]))
{
     $y5 = $_POST["updating"];
     $_SESSION['products'][$y5]["name"]=$_POST["name"];
     $_SESSION['products'][$y5]["price"] = $_POST["price"];
     $_SESSION['products'][$y5]["groceries"] = $_POST["groceries"];
     $_SESSION['products'][$y5]["income"]=$_POST["income"];
     echo $_SESSION['products'][$y5]["price"];
     echo $_SESSION['products'][$y5]["groceries"];
     echo $_SESSION['products'][$y5]["income"];   
}
?>
    <form action ="" method="post" class="form1">
    <?php
if(isset($_POST["edits"]))
{
$y2 = $_POST["editing"];

foreach($_SESSION['products'] as $k3 => $v3)
 {
  if($k3 == $y2)
  {
     $pr1 =  $v3["name"];
    $pr2 =  $v3["price"];
    $pr3 = $v3["groceries"];
    $_SESSION["income"]= $_POST['incomes'];

echo "
<input type='hidden' name='updating' value='$k3'>
<button type='submit' name='update' class='update'>update</button>
" ;
  }
  }
} 
?>
<label for="expense"><h2>Add Expenses</h2></label>
<p>
<input type="text" name="name"  placeholder="Enter Item" value="<?php echo $pr1;?>">
<input type="number" name="price" placeholder="Enter price" value="<?php echo $pr2;?>">
<select name="groceries">
<option <?php if ($pr3 == "grocery") echo "selected";?>>grocery</option>
<option <?php if ($pr3 == "veggies") echo "selected";?>>veggies</option>
<option <?php if ($pr3 == "travelling") echo "selected";?>>travelling</option>
<option <?php if ($pr3 == "miscallneous") echo "selected";?>>miscallneous</option>
</select>
<br>
<br>
<input type="number" name="income"  placeholder="Enter Income" >
<br>
<br>
<input type="submit" name="submit" class="submit" value="AddExpenses">
<input type="submit" name="addincome" class="submitbtn" value="AddIncome">
<input type="submit" name="deleteincome" class="submitbtn" value="DeleteIncome">
</form>
<!-- code for add income -->
<?php
if(isset($_POST["addincome"]))
{
    if(empty($_POST["income"]))
    {
        echo '<script>alert("please enter your income")</script>';
    }
    else
    {
    $_SESSION["income"]=$_POST["income"]+$_SESSION["income"] ;
    }
}
// code for delete income
if(isset($_POST["deleteincome"]))
{
    $_SESSION["income"] =0;
}

?>
<?php 
echo "<table border='1px'>";

echo "<tr><th>Name</th><th>Price</th><th>Groceries</th><th>Edit Item</th><th>Delete Item</th></tr>";
foreach($_SESSION['products'] as $k => $v)
{
echo "<tr><td>".$v["name"]."</td>";
echo "<td>" .$v["price"]."</td>";
echo "<td>" .$v["groceries"]."</td>
<td>
<form action ='' method='post'>
<input type='hidden' name='editing' value='$k'>
<input type='hidden' name='incomes'  value='".$_SESSION['income']."'>

<button type='submit' name='edits'  class='edit'>Edit</button>

</form>
</td>
<td>
<form action='' method='post'>
<input type='hidden' name='deleting' value='$k'>
<button type='submit' name='remove' class='delete'>delete</button>
</form>
</td>
</tr>";
$sum = $sum + $v["price"]; 

// code for expenses calculate category wise
if($v["groceries"] == 'veggies')
{
    $sum1 = $sum1 + $v["price"];
  
}

if($v["groceries"] == 'travelling')
{
    $sum2 = $sum2 + $v["price"];
  
}

if($v["groceries"] == 'miscallneous')
{
    $sum3 = $sum3 + $v["price"];
  
}
if($v["groceries"]== 'grocery')
{
    $sum4 = $sum4 + $v["price"];
}
}
echo "<h3>Total Expenses is : " .$sum. "</h3>";
echo "<br>";
echo  "<h3>New income is :" .$_SESSION["income"]. "</h3>";
echo "<br>";
?>
<?php 
$balancee = $_SESSION["income"] - $sum;
echo "<h3>Total Balance is : ". $balancee."</h3>";


echo "<div class='main1'>";
echo "<h3 style='color:black;'>Category Wise Expenses Calculated</h3>";

echo "<h3>Grocery Expense : " .$sum4. "</h3>";

echo "<h3>Veggies Expense : " .$sum1. "</h3>";

echo "<h3>Travelling Expense : " .$sum2. "</h3>";

echo "<h3>Miscallneous Expense : " .$sum3. "</h3>";
echo "</div>";

?>

</form>
</body>
</html>
<!-- end -->