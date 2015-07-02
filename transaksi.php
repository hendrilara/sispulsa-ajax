<?php

//mempercepat loading page
ob_start();

//tangkap variabel dan eksekusi proses
include"config.php";

switch ( $_GET['g'] ) {

    //jika halaman tidak ada arahkan ke default 
	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":
   		$jumlah 	= $_POST['jumlah'];
		$no_tujuan 	= $_POST['no_tujuan'];
		$operator   = $_POST['operator'];
		

		empty( $jumlah ) 	 ? $err[] = "<h5>* Jumlah Masih Kosong</h5>" : "";
		empty( $no_tujuan )  ? $err[] = "<h5>* No Tujan Masih Kosong</h5>" : "";
		empty( $operator )   ? $err[] = "<h5>* Pilih Jenis Operator</h5>" : "";
		
		//cek kondisi jika kosong 

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {
          //tambah data transaksi
			$conn->query("INSERT INTO transaksi VALUES ('','$jumlah','$no_tujuan','$operator')");
			$_SESSION['info'] = "Menyimpan";
			echo "Sukses";

		}

	break;

	case "update":

		$id 	    = $_POST['id'];
		$jumlah 	= $_POST['jumlah'];
		$no_tujuan 	= $_POST['no_tujuan'];
		$operator   = $_POST['operator'];

		empty( $jumlah ) 	 ? $err[]     = "<h5>* Jumlah Masih Kosong</h5>" : "";
		empty( $no_tujuan ) 	 ? $err[] = "<h5>* No Tujuan Masih Kosong</h5>" : "";
		empty( $operator ) ? $err[]       = "<h5>* Pilih Operator</h5>" : "";
		
        //cek jika kondisi kosong
        if (isset($err)) {
        	foreach ($err as $val) {
        		echo $val;
        	}
        }else{

         //update data transaksi berdasarkan id
        	$sql = $conn->query("UPDATE transaksi set jumlah = '$jumlah', no_tujuan = '$no_tujuan', operator = '$operator'
							WHERE id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";

        }
		
	break;

	case "hapus" :

  //hapus data transaksi berdasarkan id
   if (isset($_GET['id'])) {
       $sql = $conn->query("DELETE FROM transaksi WHERE id = '$_GET[id]'");
       $_SESSION['info'] = "hapus";
       echo "sukses";
      }else

      {
      	echo "gagal";
      }
		header("location:trans.php");

	break;
}

ob_end_flush();

?>