<?php include_once 'header.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Add / Edit Sub Category</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<a href="sub-category-list.php" class="btn btn-primary rounded" ><i class="fa fa-list" aria-hidden="true"></i> Sub Category List</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php 
							if(isset($_GET['maincat'])):
								$mysqli->where('id',$_GET['maincat']);
								$getDepart = $mysqli->getOne(MAINCAT);
								$name = $getDepart['category_name'];
								$action = 'update';
							else:
								$name = '';
								$action = 'add';
							endif;
							?>

							<form method="post" action="ajax.php?action=subcat&type=<?=$action?>">
								<?php if(isset($_GET['maincat'])): ?>
									<input class="form-control" required="" type="hidden" value="<?=$_GET['maincat']?>" name="id">
								<?php endif;?>

								<div class="form-group">
									<label>Sub Category Name <span class="text-danger">*</span></label>
									<input class="form-control" required="" type="text" value="<?=$name?>" name="department" id="department">
									<p id="errorCopy" style="color:red"></p>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit">Create Sub Category</button>
								</div>
							</form>
						</div>
					</div>
                </div>
				<?php include 'messages.php';?>
            </div>
        </div>
		<?php include_once 'footer.php';?>
		<script>
		    $("#department").blur(function(){
		       var depart = $(this).val();
		       var action = "subCatDup";
		       $.ajax({
		          type: "POST",
		          url: "ajax.php",
		          data:{depart:depart, action:action},
		          success:function(data){
		                  $("#errorCopy").html(data);
		          }
		       });
		    });
		</script>