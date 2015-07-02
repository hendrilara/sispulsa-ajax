<?php

//mempercepat loading page 
ob_start();

include"config.php";

//tangkap variabel dan ekseskusi prosesnya
switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":
   		$nama 	= $_POST['nama'];
		$alamat 	= $_POST['alamat'];
		$phone  = $_POST['phone'];

		empty( $nama ) 	 ? $err[] = "<h5>* Nama Masih Kosong</h5>" : "";
		empty( $alamat ) 	 ? $err[] = "<h5>* Alamat Masih Kosong</h5>" : "";
		empty( $phone ) ? $err[] = "<h5>* Phone Masih Kosong</h5>" : "";
		
		//cek jika kondisi kosong 
		if (isset($err)) {
			foreach ($err as $val) {
				echo $val;
			}
		}else
		{
        //tambah data pelanggan
        if (isset($_POST)) {
         $sql = $conn->query("INSERT INTO pelanggan values('','$nama','$alamat','$phone')");
         $_SESSION['info'] = "Mengisi";
			echo "Sukses";
         }else{
         	echo "data gagal terisi";
         }

		}	

	break;

	case "update":

		$id 	= $_POST['id'];
		$nama 	= $_POST['nama'];
		$alamat 	= $_POST['alamat'];
		$phone  = $_POST['phone'];

		empty( $nama ) 	 ? $err[] = "<h5>* Nama Masih Kosong</h5>" : "";
		empty( $alamat ) 	 ? $err[] = "<h5>* Alamat Masih Kosong</h5>" : "";
		empty( $phone ) ? $err[] = "<h5>* Phone masih kosong</h5>" : "";
		
		//cek kondisi jika masih kosong
		if (isset($err)) {
			foreach ($err as $val) {
				echo $val;
			}
		}else

		{
		//update data berdasarkana id pelanggan
			$sql = $conn->query("UPDATE pelanggan set nama = '$nama', alamat = '$alamat', phone = '$phone'
							WHERE id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";
		}

	break;

	case "hapus" :

	//hapus data berdasarkan id pelanggan
   if (isset($_GET['id'])) {
       $conn = $conn->query("DELETE FROM pelanggan WHERE id = '$_GET[id]'");
       $_SESSION['info'] = "Hapus";
	    echo "Sukses";
      }else{
      	echo "gagal";
      }
		header("location:pelanggan.php");

	break;
}

ob_end_flush();

?>