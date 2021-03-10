<?php
	if(isset($this->session->userdata['logged_in'])) {
		$username = ($this->session->userdata['logged_in']['first_name']);

		$email = ($this->session->userdata['logged_in']['email']);

		$mobile = ($this->session->userdata['logged_in']['mobile']);

		$emp_id = ($this->session->userdata['logged_in']['id']);
	}else {
		header("location: login");
	}
?>

<html>
 <head>
	    <title>Dashboard</title>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
		<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>




		<style type="text/css">
			
			.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

			small {
				display: block;
				line-height: 1.428571429;
				color: #999;
			}
			.verticalhorizontal {
			    /*display: table-cell;*/
			    display: inline-block;
			    height: 300px;
			    text-align: center;
			    width: 250px;
			    vertical-align: middle;
			}
			/* Fixes dropdown menus placed on the right side */
		    .ml-auto {
		      left: auto !important;
		      right: 5px;
		    }

		    .message{
				position: absolute;
			    font-weight: bold;
			    font-size: 20px;
			    color: #126555;
			    left: 232px;
			    width: 500px;
			    text-align: left;
			}
		</style>
	</head>
	<!------ Include the above in your HEAD tag ---------->

	<body>
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">Dashboard</a>
		    </div>
		    <ul class="nav navbar-nav ml-auto">
		      <li class="dropdown right" style="float:right">
		        <a href="<?=site_url('login/logout')?>"><strong>Logout</strong></a>
		      </li>
		    </ul>
		  </div>
		</nav>

		

		<div class="container">
			<h2>Employee Management System </h2>
			<br>
			<a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-product" data-toggle="modal" data-target="#exampleModalCentered">Add New</a>
			<br><br>
			<table class="table table-bordered table-striped" id="product_list">
				<thead>
					<tr>
						<th>Sr.no</th>
						<!-- <th>emp_id</th> -->
						<th>Name</th>
						<th>salary</th>
						<th>Action</th>
					</tr>
				</thead>
			    <tbody>
					<?php if(isset($employee_details)): $i =1;?>   
					<?php foreach($employee_details as $details):?>
					<tr id="emp_id_<?php echo $details->id;?>">
						<td><?php echo $i++;?></td>
						<!-- <td><?php echo $details->id;?></td> -->
						<td><?php echo $details->name;?></td>
						<td><?php echo $details->salary;?></td>
						<td>
					<a href="javascript:void(0)"  data-id="<?php echo $details->id;?>" class="btn btn-info edit-product">Edit</a>
					<a href="javascript:void(0)" data-id="<?php echo $details->id;?>" class="btn btn-danger delete-user delete-product">Delete</a>
					</td>
					</tr>
					<?php endforeach;?>
					<?php endif; ?> 
				</tbody>
			</table>
		</div>

		<!-- Modal -->
		<div class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalCenteredLabel">Add Employee Data</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form id="productForm" name="productForm" class="form-horizontal" method="post">
					<input type="hidden" name="emp_id" id="emp_id">
					<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-12">
					<input type="text" class="form-control" id="name" name="name" placeholder="Enter Tilte" value="" maxlength="50" required>
					</div>
					</div>
					<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Salary</label>
					<div class="col-sm-12">
					<input type="text" class="form-control" id="salary" name="salary" placeholder="Enter Salary" value="" maxlength="10" required>
					</div>
					</div>
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary" name="action" id="btn-save" value="create">Save changes
					</button>

					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
		      </div>
		    </div>
		  </div>
		</div>
	</body>
</html>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


        <script type="text/javascript">
            
            //initializing datatable
            $(document).ready(function () {
                $('#product_list').DataTable();
            });

            //submitting form
            $("#productForm").submit(function (event) {
                event.preventDefault();
                var str = $("#productForm").serialize();
                //var action = $('#btn-save').val();
                $.ajax({
                    url: "<?php echo base_url('login/save_emp_details'); ?>",
                    data: $("#productForm").serialize(),
                    // data: {str:str, action:action},
                    type: "post",
                    async: true,
                    dataType: 'json',
                    success: function (response) {
                    	alert(response.msg);

                        $('#exampleModalCentered').modal('hide');
                        $('#productForm')[0].reset();
                        window.location.href="http://test.com/dashboard";
                    },
                    error: function ()
                    {
                        alert("error"); //error occurs
                    }
                });
            });

            $('body').on('click', '.delete-product', function() {
		        var emp_id = $(this).data("id");
		        // console.log(emp_id);
		        if (confirm("Are You sure want to delete !")) {
		            $.ajax({
		                type: "Post",
		                url: "<?php echo base_url('login/delete'); ?>",
		                data: {
		                    emp_id: emp_id
		                },
		                dataType: "json",
		                success: function(data) {
		                    $("#emp_id_" + emp_id).remove();
		                },
		                error: function(data) {
		                    console.log('Error:', data);
		                }
		            });
		        }
		    });

		    $('body').on('click', '.edit-product', function() {
		        var emp_id = $(this).data("id");
		        console.log(emp_id);
		        $.ajax({
		            type: "Post",
		             url: "<?php echo base_url('login/get_product_by_id'); ?>",
		            data: {
		                emp_id: emp_id
		            },
		            dataType: "json",
		            success: function(res) {
		                if (res.success == true) {		                    
		                    $('#exampleModalCenteredLabel').html("Edit Emp Data");
		                    $('#btn-save').val("edit-data");
		                    $('#btn-save').html("Update changes");
		                    $('#exampleModalCentered').modal('show');
		                    $('#emp_id').val(res.data.id);
		                    $('#name').val(res.data.name);
		                    $('#salary').val(res.data.salary);
		                }
		            },
		            error: function(data) {
		                console.log('Error:', data);
		            }
		        });
		    });

            
        </script>