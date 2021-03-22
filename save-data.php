<?php
        $cn = new mysqli("localhost","root","","postdata");
        $id = $_POST['txt-edit-id'];
        $name = $_POST['txt-name'];
        $name = trim($name); //function trim() use for caught before space can't enter 
        $price = $_POST['txt-price'];
        $photo = $_POST['txt-photo'];
        $status = $_POST['txt-status'];
        $res['edit']=false;
        //cehck duplicate
        
        $sql = "SELECT * FROM tbl_customer WHERE name ='$name' && id != $id";
        $result = $cn->query($sql);
        $num=$result->num_rows;
        if ($num == 0) 
          {
            if ($id == 0) 
              {
                $sql = "INSERT INTO tbl_customer VALUES(null,'$name','$price','$photo','$status')";
                $cn->query($sql);
                $res['autoid']=$cn->insert_id;
              }
            else
              {
                $sql = "UPDATE tbl_customer SET name='$name',price=$price,photo='$photo',status='$status' WHERE id = $id";
                //name,price,photo from tbl_customer
                $cn->query($sql);
                $res['edit']=true ;
              }
              $res['dpl'] =false;
          }
            else
              {
                  $res['dpl'] = true;
              }
            $res['class'] = "php";
            echo json_encode($res); //json_encode: use for return $res to $rest ['edit'] to make $res go to compare with condition in post-data
?>