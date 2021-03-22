<?php 
    $cn = new mysqli("localhost","root","","postdata");
    //get auto id
    $sql = "SELECT id FROM tbl_customer ORDER BY id DESC";
    $result = $cn->query($sql);
    $num=$result->num_rows;
if ($num == 0) 
  {
	$id=1;
  }
else
  {
	 $row = $result->fetch_array();
	 $id = $row[0]+1;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style/style.css">
	<!-- script font -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="font-icon/js/fontawesome.js"></script>
	<!-- script jquery --> 
	<script src="jquery/jquery-3.5.1.min.js"></script>
	<!-- link font icon -->
	<title>Hi Post Data</title>
</head>
<body>
	<div class="frm">
		<form method="post" class="upl">
		     <input type="text" name="txt-edit-id" id="txt-edit-id" value='0'>  <!--if in box value !0 it is means that us edit but if in value = 0 it is a means that us click on button save -->
			<label for="">ID:</label>
			<input type="text" name="txt-id" id="txt-id" value="<?php echo $id; ?>" class="frm-control">
			<label for="">Name:</label>
			<input type="text" name="txt-name" id="txt-name" class="frm-control">
			<label for="">Price:</label>
			<input type="text" name="txt-price" id="txt-price" class="frm-control">
		    <label for="">Status</label>
			<select name="txt-status" id="txt-status" class="frm-control">
			<option value="1">1</option>
			<option value="2">2</option>
			</select>
			<label for="">Photo</label>
			<div class="img-box">
			   <input type="file" name="txt-file" id="txt-file">
			</div>
			<input type="hidden" name="txt-photo" id="txt-photo">
			<a class="btn btn-post right"  id="btn-post">save</a>

		</form>
	</div>
	<table id="tblData">
		<tr>
			<th width="50">ID</th>
			<th>Name</th>
			<th width="50">Price</th>
			<th width="50">Photo</th>
			<th width="50">Status</th>
			<th width="50">Action</th>
		</tr>
		<?php
			$sql="SELECT * FROM tbl_customer ORDER BY id DESC";
			$result = $cn->query($sql);
			$num = $result->num_rows;
			if ($num > 0) 
			   {
			     while ($row = $result->fetch_array()) 
				   {
		              ?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['price']; ?></td>
					        <td>
							   <img src="assets/image/<?php echo $row['photo']; ?>" alt="<?php echo $row['photo']; ?>">
							</td>
							<td><?php echo $row['status']; ?></td>
							<td><input type="button" value='Edit' class='btn-edit'></td>
						</tr>
			         <?php
			       }
		       }
		    ?>
	</table>
</body>
	<script>
	    $(document).ready(function()
		{
	        var ind;
			var tbl = $('#tblData');
			var EditID = $('#txt-edit-id');
			//case of enter value empty
			var id=$('#txt-id');
			var name=$('#txt-name');
			var price=$('#txt-price');
			var imgBox=$('.img-box');
			var status=$('#txt-status');
			var photo=$('#txt-photo');
			var loadingBox = "<div class='loading-icon'></div>"
           //upload img
           $('#txt-file').change(function()
		    {
				var eThis = $(this);
				var frm = eThis.closest('form.upl');
				var frm_data = new FormData(frm[0]);
        	
                $.ajax(
				   { 
				     // Usage ajax to don't be it refresh page just us click on button save it is proccess enter to server
					 url:'upl-img.php', //save-data.php it is execute when us click file save-data.php
					 type: 'POST',
					 data:frm_data,
					 contentType:false,
					 cache:false,
					 processData:false,
					 dataType:"json",
                     beforeSend:function()
					    {
              	           imgBox.append(loadingBox);
                           //work before success
                           // eThis.html("<i class='fa fa-spinner' aria-hidden='true'></i>  wait....");
                           // eThis.css({"pointer-events": "none","opacity":"0.8"});
                        },  
                     success:function(data)
					    {
            	            alert(data.imgName);
							imgBox.css({"background-image":"url(assets/image/"+data.imgName+")"});
							$('.loading-icon').remove();
							photo.val(data.imgName);
                        }
                   });
            });
			//save data
         $("#btn-post").click(function()
		    {
        	  var eThis = $(this);
              if (name.val()=='') 
			    { 
					//This condition it is execute when user not input value(it is equl empty)
            	    alert("input value.");
            	    name.focus();
            	    return;
                }
			  else if(price.val()=='')
			    {
				   //This condition it is execute when user not input value(it is equl empty)
            	   alert("input value");
            	   price.focus();
            	   return;
                }
                   var frm = eThis.closest('form.upl');
                   var frm_data = new FormData(frm[0]);
            
             $.ajax(
				{ 
						// Usage ajax to don't be it refresh page just us click on button save it is proccess enter to server
						url:'save-data.php', //save-data.php it is execute when us click file save-data.php
						type: 'POST',
						data:frm_data,
						contentType:false,
						cache:false,
						processData:false,
						dataType:"json",
                     beforeSend:function()
					   {
                          //work before success
						  eThis.html("<i class='fa fa-spinner' aria-hidden='true'></i>  wait....");
						  eThis.css({"pointer-events": "none","opacity":"0.8"});
                        },
                     success:function(data)
					{
					   if (data.edit==true) {
						  tbl.find("tr:eq("+ind+") td:eq(1)").text(name.val());
						  tbl.find("tr:eq("+ind+") td:eq(2)").text(price.val());
						  tbl.find("tr:eq("+ind+") td:eq(3) img").attr("src","assets/image/"+photo.val()+"");
						  tbl.find("tr:eq("+ind+") td:eq(3) img").attr("alt","assets/image/"+photo.val()+"");
						  tbl.find("tr:eq("+ind+") td:eq(4)").text(status.val());
						  imgBox.css({"background-image":"url(assets/image/11.jpg)"});
						  name.val(''); //when us success it is catch data from to entering
						  price.val(''); //when us success it is catch data from to entering
						  name.focus();
						  photo.val('');
						  eThis.html("save");
                          eThis.css({"pointer-events": "auto","opacity":"1"});
						   return;
					   }
                       // work after sucess
                      if (data.dpl==true)
			            {
               	           alert("Duplicate name");
                        }
			          else
			            {
							id.val(data.autoid + 1 );
							var tr = "<tr> "+
							" <td>"+data.autoid+"</td> "+
							" <td>"+name.val()+"</td> "+
							" <td>"+price.val()+"</td> "+
							" <td> <img src='assets/image/"+photo.val()+"' alt='"+photo.val()+"' ></td> "+" <td>"+status.val()+"</td> "+
							" <td><input type='button' value='Edit' class='btn-edit'></td>"+ // button: it is happened when us refresh page if us not refresh page that it is not edit
							" </tr>";
							tbl.find('tr:eq(0)').after(tr); //method: eq(index)it is equal to select and after(insert from index)
							// tbl.append(tr);method: append() use for it load under line
							// tbl.prepend(tr);method: prepend() use for it load on line
							imgBox.css({"background-image":"url(assets/image/11.jpg)"});
							name.val(''); //when us success it is catch data from to entering
							price.val(''); //when us success it is catch data from to entering
							name.focus();
							photo.val('');
							//val(): Use for catch data
                        } 
                            eThis.html("save");
                            eThis.css({"pointer-events": "auto","opacity":"1"});
                    },
                });
            });
			 //get edit data
			 //$('.btn-edit').click(function()
            $('body').on("click","#tblData .btn-edit",function()
		    {
				var eThis = $(this);
				var tr=eThis.parents('tr'); 
				var id2=tr.find('td:eq(0)').text();
				var name2=tr.find('td:eq(1)').text();
				var price2=tr.find('td:eq(2)').text();
				var img2=tr.find('td:eq(3) img').attr('src'); 
				var imgName = tr.find('td:eq(3) img').attr('alt'); //it is caght alert
				var status2=tr.find('td:eq(4)').text();
				//methos eq(): Usage for index 0 to ...
				//img: It is a tag of html and att: It is a attribute
				// alert(img2);
				ind=tr.index();
				// alert(ind);
				EditID.val(id2);
				id.val(id2);
				name.val(name2);
				price.val(price2);
				imgBox.css({"background-image":"url("+img2+")"});
                photo.val(imgName);
				status.val(status2);
		    });
        });
</script>
</html>