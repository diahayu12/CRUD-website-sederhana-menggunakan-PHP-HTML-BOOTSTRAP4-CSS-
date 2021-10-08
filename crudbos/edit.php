<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>POLITEKNIK KAMPAR</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tambah.php">Tambah
						</a>
					</li>
					<img src="logo.png" width="45" height="45" alt="">
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="container" style="margin-top:20px">
		<div class="card-header bg-warning text-white">
		<h5>Edit Mahasiswa</h5>
		</div>
		<hr>
		
		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['id'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$id = $_GET['id'];
			
			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));
			
			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
			//jika hasil query > 0
			}else{
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>
		
		<?php
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit'])){
			$nim            = $_POST['nim'];
			$nama			= $_POST['nama'];
			$jenis_kelamin	= $_POST['jenis_kelamin'];
			$jurusan		= $_POST['jurusan'];
			
			$sql = mysqli_query($koneksi, "UPDATE mahasiswa SET nim='$nim', nama='$nama', jenis_kelamin='$jenis_kelamin', jurusan='$jurusan' WHERE id='$id'") or die(mysqli_error($koneksi));
			
			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="index.php?id='.$id.'";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>
		
		<div class="row">
		  <div class="col-7">
			<form action="edit.php?id=<?php echo $id; ?>" method="post">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">NIM</label>
					<div class="col-sm-10">
						<input type="text" name="nim" class="form-control" size="4" value="<?php echo $data['nim']; ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">NAMA MAHASISWA</label>
					<div class="col-sm-10">
						<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">JENIS KELAMIN</label>
					<div class="col-sm-10">
						<div class="form-check">
							<input type="radio" class="form-check-input" name="jenis_kelamin" value="LAKI-LAKI" <?php if($data['jenis_kelamin'] == 'LAKI-LAKI'){ echo 'checked'; } ?> required>
							<label class="form-check-label">LAKI-LAKI</label>
						</div>
						<div class="form-check">
							<input type="radio" class="form-check-input" name="jenis_kelamin" value="PEREMPUAN" <?php if($data['jenis_kelamin'] == 'PEREMPUAN'){ echo 'checked'; } ?> required>
							<label class="form-check-label">PEREMPUAN</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">JURUSAN</label>
					<div class="col-sm-10">
						<select name="jurusan" class="form-control" required>
							
							<option value="D3 TEKNIK INFORMATIKA" <?php if($data['jurusan'] == 'D3 TEKNIK INFORMATIKA'){ echo 'selected'; } ?>>D3 TEKNIK INFORMATIKA</option>
							<option value="D3 TEKNIK PENGOLAHAN SAWIT" <?php if($data['jurusan'] == 'D3 TEKNIK PENGOLAHAN SAWIT'){ echo 'selected'; } ?>>D3 TEKNIK PENGOLAHAN SAWIT</option>
							<option value="D3 TEKNIK PERAWATAN DAN PERBAIKAN MESIN" <?php if($data['jurusan'] == 'D3 TEKNIK PERAWATAN DAN PERBAIKAN MESIN'){ echo 'selected'; } ?>>D3 TEKNIK PERAWATAN DAN PERBAIKAN MESIN</option>
							<option value="D4 ADMINISTRASI BISNIS INTERNASIONAL" <?php if($data['jurusan'] == 'D4 ADMINISTRASI BISNIS INTERNASIONAL'){ echo 'selected'; } ?>>D4 ADMINISTRASI BISNIS INTERNASIONAL</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">&nbsp;</label>
					<div class="col-sm-10">
						<input type="submit" name="submit" class="btn btn-success" value="SIMPAN">
						<a href="index.php" class="btn btn-primary">KEMBALI</a>
					</div>
				</div>
			</form>
		</div>
			<div class="col-5"></div>
		</div>
		
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
</body>
