<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>student view</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

		
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	</head>
	<body>
			<form action="insertRecords" method="POST"  accept-charset="utf-8" id="accfrm" enctype="multipart/form-data">
				<center><button type="submit" class="btn btn-primary">SAVE</button></center>
				<h1><button type="button" class="btn btn-info btn-md" style="margin-left: 20px" id="addAcc">Add</button></h1>
				<input type="file" id="image" name="image">
				<center><label>Account Name:</label>
				<input type="text" name="accountname[]" class="form-control" style="width:25%"></center><br>
				<center>
					<button type="button" class="btn btn-success" id="addRow">Add Row</button>
					<button type="button" class="btn btn-danger" id="delRow">Delete Row</button>
				</center><br/>
				<table border="1" class="table table-bordered" id="myTable">
					<tr>
						<th>Name</th>
						<th>UserName</th>
						<th>Password</th>
					</tr>
					<tr>
						<td><input type="text" name="lastname0[]" class="form-control"></td>
						<td><input type="text" name="username0[]" class="form-control"></td>
						<td><input type="Password" name="pass0[]" class="form-control"></td>
					</tr>
				</table>
				<br>
				
			</form>
		</div><br>
		<div class="container-fluid">
			<table border="1" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>Account</th>
						<th>Name</th>
						<th>UserName</th>
						<th>Passowrd</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php ?>
					
					<?php foreach($records as $r){ ?>
					<tr>
						<input type="hidden" value="<?php echo $r->id ?>" name="id" />
						<td><?php echo $r->accountid ;?></td>
						<td><?php echo $r->lastname ;?></td>
						<td><?php echo $r->username__c;?></td>
						<td><?php echo $r->password__c ;?></td>
						<td><a href="deleteRecords/<?php echo $r->id ?>">Delete</a></td>	
					</tr>
					<?php }?>
					
				</tbody>
			</table><br/>
		</div>
	</body>
	<script>
		$(document).ready(function(){
			var count =0;
			var index = 1;
			$("#addRow").click(function(){
				 count++;
				 var table = '<tr class='+count+'><td><input type="text" name="lastname0[]" class="form-control"></td><td><input type="text" name="username0[]" class="form-control"></td><td><input type="Password" name="pass0[]" class="form-control"></td></tr>';
				 $("#myTable").append(table);
			});
			$("#delRow").click(function(){
				if($('#myTable tr').length>2){
					$('#myTable tr:last').remove();
				}
				else{
					return false;
				}
			});
			$("#addAcc").click(function(){
				var newFrm ='<center style="margin-top:26px;"><label>Account Name:</label><input type="text" name="accountname[]" class="form-control" style="width:25%"></center>';
				newFrm+='<br /><center><button type="button" class="btn btn-success" style="margin-right:5px" onClick="addFunction('+index+');">Add Row</button><button type="button" class="btn btn-danger" onClick="delFunction('+index+');">Delete Row</button></center>';
				newFrm+='<br /><table border="1" class="table table-bordered" id="myTable'+index+'"><tr><th>Name</th><th>UserName</th><th>Password</th></tr><tr><td><input type="text" name="lastname'+index+'[]" class="form-control"></td><td><input type="text" name="username'+index+'[]" class="form-control"></td><td><input type="Password" name="pass'+index+'[]" class="form-control"></td></tr></table>';
				$("#accfrm").append(newFrm);
				index++;
			});	
		});
		function addFunction(index){
			var table = '<tr><td><input type="text" name="lastname'+index+'[]" class="form-control"></td><td><input type="text" name="username'+index+'[]" class="form-control"></td><td><input type="Password" name="pass'+index+'[]" class="form-control"></td></tr>';
			$("#myTable"+index).append(table);
		}
		function delFunction(index){
			if($('#myTable'+index+' tr').length>2){
					$('#myTable'+index+' tr:last').remove();
				}
				else{
					return false;
				}
		}
	</script>
</html>
