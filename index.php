<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<title>Similarity Checker</title>
</head>
<body>
	<div class="header">
  <a href="#" id="menu-action">
    <i class="fa fa-bars"></i>
    <span>Close</span>
  </a>
  <div class="logo">
    Similarity Checker
  </div>
</div>
<div class="sidebar">
  <ul>
    <li><a href="#"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
    <li><a href="#"><i class="fa fa-upload"></i><span>File Dokumen</span></a></li>
    <li><a href="#"><i class="fa fa-file-text"></i><span>Preprocessing</span></a></li>
    <li><a href="#"><i class="fa fa-book"></i><span>Similarity</span></a></li>
</div> 
<!-- Content -->
<main class="main">
<div class="row">
	<div class="col-lg-4">
      	<div class="card text-center">		  
			<div class="card-header bg-info text-light"><h2>Data Upload</h2></div>
        	<div class="card-body" align="center">
          		<i class="fa fa-upload fa-3x mb-3"></i>
          		<h2>Ada <?php echo 187; ?> Data</h2>
        	</div>
      	</div>
    </div>
    <div class="col-lg-4">
      	<div class="card text-center">		  
			<div class="card-header bg-info text-light"><h2>Data Preprocessing</h2></div>
        	<div class="card-body" align="center">
          		<i class="fa fa-file-text fa-3x mb-3"></i>
          		<h2>Ada <?php echo 187; ?> Data</h2>
        	</div>
      	</div>
    </div>
    <div class="col-lg-4">
      	<div class="card text-center">		  
			<div class="card-header bg-info text-light"><h2>Data Similarity</h2></div>
        	<div class="card-body" align="center">
          		<i class="fa fa-book fa-3x mb-3"></i>
          		<h2>Ada <?php echo 187; ?> Data</h2>
        	</div>
      	</div>
    </div> 
	<div class="col-lg-4 mt-5 pt-5 offset-md-4">
		<form action="">
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="customFile">
				<label class="custom-file-label" for="customFile">Choose file</label>
			</div>
		</form>
	</div>
</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/style.js"></script>
</main>
</body>
</html>