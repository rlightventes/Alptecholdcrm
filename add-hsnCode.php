<?php include_once 'header.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Add / Edit HSN Code</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<a href="hsnCode.php" class="btn btn-primary rounded" ><i class="fa fa-list" aria-hidden="true"></i> HSN Code List</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php 
							if(isset($_GET['maincat'])):
								$mysqli->where('id',$_GET['maincat']);
								$getDepart = $mysqli->getOne(HSN);
								$name = $getDepart['hsn'];
								$cgst = $getDepart['cgst'];
								$sgst = $getDepart['sgst'];
								$igst = $getDepart['igst'];
								$action = 'update';
							else:
								$name = '';
								$cgst = '';
								$sgst = '';
								$igst = '';
								$action = 'add';
							endif;
							?>

							<form method="post" action="ajax.php?action=hsn&type=<?=$action?>">
								<?php if(isset($_GET['maincat'])): ?>
									<input class="form-control" required="" type="hidden" value="<?=$_GET['maincat']?>" name="id">
								<?php endif;?>

								<div class="form-group col-md-3">
									<label>HSN CODE<span class="text-danger">*</span></label>
									<input class="form-control" required="" type="text" value="<?=$name?>" name="department">
								</div>
								<div class="form-group col-md-3">
									<label>CGST%<span class="text-danger">*</span></label>
									<input class="form-control" required="" type="number" value="<?=$cgst?>" name="cgst">
								</div>
								<div class="form-group col-md-3">
									<label>SGST%<span class="text-danger">*</span></label>
									<input class="form-control" required="" type="number" value="<?=$sgst?>" name="sgst">
								</div>
								<div class="form-group col-md-3">
									<label>IGST%<span class="text-danger">*</span></label>
									<input class="form-control" required="" type="number" value="<?=$igst?>" name="igst">
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit">Create</button>
								</div>
							</form>
						</div>
					</div>
                </div>
				<?php include 'messages.php';?>
            </div>
        </div>
		<?php include_once 'footer.php';?>