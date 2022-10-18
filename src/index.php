<?php
session_start();
if(!isset($_SESSION['products']))
{
    $_SESSION['products']=[];
    $sum=0;
  $income = 0;
} 

// $name = $_POST["name"];
// $price = $_POST["price"];
// $groceries = $_POST['groceries'];
// $groceries1 = $_POST['groceries1'];

$_SESSION["name"]= $_POST["name"];
$_SESSION["groceries"]=$_POST["groceries"];
$_SESSION["price"]=$_POST["price"];

if(isset($_POST["submit"]))
{
//  $name = $_POST['name'];
//  $price = $_POST['price'];
//  $groceries = $_POST['groceries'];
//  $income = (int)$_POST['income'];
//  var_dump($income);
//  echo "Income is " .$income. "";
//  if(empty($name) || empty($price) || empty($groceries))
//  {
//     echo "";
//  }
//  else
//  {

 array_push($_SESSION['products'],array('name'=>$_SESSION["name"],'price'=>$_SESSION["price"],'groceries'=>$_SESSION["groceries"]));
//  }
 }

if (isset($_POST["remove"])) {
    $y1 = $_POST["deleting"];
     array_splice($_SESSION['products'],$y1 ,1);
    //  print_r($_SESSION['products']);
   
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
<?php 
if(isset($_POST["update"]))
{
     $y5 = $_POST["updating"];
     $_SESSION['products'][$y5]["price"] = $_POST["price"];
     $_SESSION['products'][$y5]["groceries"] = $_POST["groceries"];
     echo $_SESSION['products'][$y5]["price"];
     echo $_SESSION['products'][$y5]["groceries"];
  
   
}
?>
    <form action ="" method="post">
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
echo "
<input type='hidden' name='updating' value='$k3'>
<button type='submit' name='update' class='delete'>update</button>
" ;
  }
  }
 
} 
?>
    <label for="expense"><h2>Add Expenses</h2></label>
    <p>
    <input type="text" name="name"  placeholder="item" value="<?php echo $pr1;?>">
    <input type="number" name="price" placeholder="price" value="<?php echo $pr2;?>">
 
<select name="groceries">
<option <?php if ($pr3 == "grocery") echo "selected";?>>grocery</option>
<option <?php if ($pr3 == "veggies") echo "selected";?>>veggies</option>
<option <?php if ($pr3 == "travelling") echo "selected";?>>travelling</option>
<option <?php if ($pr3 == "miscallneous") echo "selected";?>>miscallneous</option>
</select>


<input type="number" name="income"  placeholder="Add Income">


<input type="submit" name="submit" class="submit">

</form>


                                             
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

$balancee = $income - $sum;
}
echo "Total Expenses is:" .$sum. "";
echo "<br>";
echo "New Income is:". $income. "";
echo "<br>";
echo "Balance is". $balancee."";
// if($balancee <=0)
// {
//     echo "<script>alert('you have zero savings')</script>";
// }

?>

</form>
</body>
</html>