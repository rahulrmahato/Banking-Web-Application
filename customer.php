<?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <?php
        if(isset($_SESSION['message'])){
            ?>
                <div class="alert alert-success d-flex align-items-center" role="alert" style="width: 59%; margin: 20px auto">
                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                  <div>
                    <?php echo $_SESSION['message']; ?>
                  </div>
                </div>
            <?php
            unset($_SESSION['message']);
        }
    ?>

    <div class="container">
    <!-- navbar starts here  -->
    <div class="icon">
      <img style="margin-left: 700px" src="https://img.icons8.com/ios/100/000000/bank-building.png" />
      <div class="but">
        <h1>The Sparks Bank</h1>
      </div>
    </div>
    <nav class="navbar navbar-light bg-light">
      <form class="form-inline">
        <a href="index.php"><button  class="btn btn-outline-secondary" type="button">Home</button></a>
        <button class="btn btn-outline-success mx-4" type="button">Customers</button>
      </form>
    </nav>
    <!-- navbar ends here  -->
    <section id="main" class="coloured-section">    
    <?php require_once('transaction.php'); ?>
    <div class="" style="margin: 28px 370px">
        <button name='sendMoney' class="btn btn-outline-success" id="btn-3" type="submit">Send Money</button>
        <a href="history.php"><button class="btn btn-outline-secondary mx-4"
            type="button">Transaction History</button></a>
    </div>
    <div class="create box" id="create">
    </div>

    <?php
        $mysqli=new mysqli('localhost','root','','users') or die(mysqli_error($mysqli));
        $result=$mysqli->query("SELECT * FROM user") or die(mysqli_error($mysqli));
    ?>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th scope="col">SR. No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail ID</th>
                        <th scope="col">Bank Balance</th>
                    </tr>
                </thead>

                <tbody>

                    <?php while($row=$result->fetch_assoc()): ?>

                    <tr class="">
                        <td scope="row"> <?php echo $row['srno'] ?> </td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td>
                            <p id="shreyasBankBalance"><?php echo $row['balance'] ?></p>
                        </td>
                    </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>
        </div>
    </div>

    <?php
        function pre_r($array){
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }
    ?>

    </section>
</div>

<script>
    let btn3 = document.getElementById('btn-3').addEventListener('click', form1);
    function form1() {
      var y = document.getElementById('create');
        let str= `
                <form action="transaction.php" method="POST" style="margin-bottom: 30px">
                            <div class="input-group mb-3">
                            <input type="text" name="enterSName" class="form-control" placeholder="Sender's username"
                                aria-label="Sender's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">@email.com</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="enterName" class="form-control" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">@email.com</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend" style="margin-right:10px">
                                <span class="input-group-text">Rs</span>
                            </div>
                            <input type="text" name="enterAmount" class="form-control" placeholder=" Enter Amount"
                                aria-label="Amount">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <button style="float: center" name='submit' type="submit" onclick="myfunc()" class="btn btn-primary">Submit</button>
                    </form>
        `
      y.innerHTML = str;
    }

  </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"></script>
</body>
</html>