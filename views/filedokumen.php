<?php
ob_start();
include "models/m_document.php";
$dokumen = new dokumen($connection);
if(@$_GET['act'] == ''){
?>

<main class="main">
<div class="row">
    <div class="col-lg-12">    
		<form class="w-100" enctype="multipart/form-data" action="controllers/prosespreprocessing.php" method="POST"><h3 class="offset-md-3"></h3>
			<div class="custom-file">
				<button name="savepreprocessing" type="submit" class="btn btn-success mt-2 offset-md-5"><i class="fa fa-file-text"></i> Preprocessing</button>
			</div>
		</form>     		
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="datatables">
	            <thead>
	               <tr>
		                <th>No.</th>
		                <th>Nim</th>
		                <th>Upload Date</th>
		                <th>File Size</th>
						<th>Content</th>
	            	</tr>
	       		</thead>
        		<tbody class="read-more-less" data-id="200">
        		<?php 
		            $no= 1;
		            $tampil= $dokumen->tampil();
		            while($data = $tampil->fetch_object()){
		               ?>
		               <tr>
		                  <td width="5%" align="center"><?php echo $no++.".";?></td>
		                  <td width="15%"><?php echo $data->nim ?></td>
		                  <td width="15%"><?php echo $data->uploaddate ?></td>
		                  <td width="15%"><?php echo $data->file_size ?> byte</td>
		                  <td width="50%" class="read-toggle" data-id="<?php echo $data->nim ?>"><?php echo $data->content ?></td>
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