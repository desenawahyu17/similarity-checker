<?php
ob_start();
include "models/m_preprocessing.php";
$preprocessing = new preprocessing($connection);
if(@$_GET['act'] == ''){
?>

<main class="main">
<div class="row">
    <div class="col-lg-12">  
		<form class="w-100" enctype="multipart/form-data" action="" method="POST"><h3 class="offset-md-3"></h3>
			<div class="custom-file">
				<button name="" type="submit" class="btn btn-warning mt-2 offset-md-5"><i class="fa fa-tag"></i> Labeling</button>
			</div>
		</form>       		
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="datatables">
	            <thead>
	               <tr>
		                <th>No.</th>
		                <th>Nim</th>
		                <th>Upload Date</th>
                        <th>Title</th>
		                <th>File Size</th>
						<th>Content</th>
	            	</tr>
	       		</thead>
        		<tbody>
        		<?php 
		            $no= 1;
		            $tampil= $preprocessing->tampil();
		            while($data = $tampil->fetch_object()){
		               ?>
		               <tr>
		                  <td align="center"><?php echo $no++.".";?></td>
		                  <td><?php echo $data->nim ?></td>
		                  <td><?php echo $data->uploaddate ?></td>
                          <td><?php echo $data->title ?></td>
		                  <td><?php echo $data->file_size ?> byte</td>
		                  <td><?php echo $data->content ?></td>
		                </tr> 
		                <?php
            	 }
				?>
        		</tbody>
     		</table>	
		</div>
	</div>
</div>
<?php
} 
?>
</main>