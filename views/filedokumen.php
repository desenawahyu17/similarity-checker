<?php
ob_start();
include "models/m_document.php";
$dokumen = new dokumen($connection);
if(@$_GET['act'] == ''){
?>

<main class="main">
<div class="row">
    <div class="col-lg-12">        		
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
        		<tbody>
        		<?php 
		            $no= 1;
		            $tampil= $dokumen->tampil();
		            while($data = $tampil->fetch_object()){
		               ?>
		               <tr>
		                  <td align="center"><?php echo $no++.".";?></td>
		                  <td><?php echo $data->nim ?></td>
		                  <td><?php echo $data->uploaddate ?></td>
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