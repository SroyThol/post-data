<?php
     $cn = new mysqli("localhost","root","","postdata");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="menu-bar">
        <ul>
          <?php
                $sql = "SELECT * FROM tbl_customer where status = 1";
                $result = $cn->query($sql);
                $num=$result->num_rows;
                if ($num > 0) 
                {
                    while ($row=$result->fetch_array())
                        {
                        ?>
                        <li>
                            <a href="#"><?php echo $row[1]?></a>
                        </li>
                        <?php
                        }
                    }
            ?>
        </ul>
    </div>
</body>
</html>