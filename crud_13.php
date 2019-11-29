<?php

    //Koneksi
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "perpustakaan";
    $con = mysqli_connect($server, $username, $password) or die("<h1>Koneksi Mysqli Error : </h1>" .mysqli_connect_error());
    mysqli_select_db($con, $database) or die("<h1>Koneksi Kedatabase Error : </h1>" . mysqli_error($con));

    @$operasi = $_GET["operasi"];
    @$tabel = $_GET["tabel"];
    $array_skip = ["operasi","tabel"];
    $arrKeys = array_keys($_GET);

    switch ($operasi) {
        case "view":
            case "view":

                $query_tampil_biodata = mysqli_query($con, "SELECT * FROM " . $tabel) or die (mysqli_error($con));
                $data_array = array();
        
                while ($data = mysqli_fetch_assoc($query_tampil_biodata)){
                    $data_array[]=$data;
                }
                echo json_encode($data_array);
        
            break;           

            case "insert":
                $namakolom = array();
                $isikolom = array();
                $insertquery = "";
                
                foreach ($arrKeys as $key){
                    if (in_array($key,$array_skip)) continue;
                    $namakolom[] = $key;
                    $isikolom[] = $_GET[$key];
                } 

                if (sizeof($namakolom)>0){
                    $insertquery = "INSERT INTO " .$tabel . " (" .join(",",$namakolom). ") VALUES ('" . join("','",$isikolom). "')";
                } else {
                    echo "Harap masukkan nama kolom";
                }
                /*
                if($tabel = "kategori")
                {
                    @$id_kategori = $_GET['id_kategori']; //ini itu membuat sebuah variable dengan nama $id_kategori yang mengambli data dari url dan dijadikan sebagai array ['id_kategori']
                    @$nama_kategori = $_GET['nama_kategori'];
            
                    $query_insert_data = mysqli_query($con, "INSERT INTO kategori(id_kategori,nama_kategori) VALUES('$id_kategori', '$nama_kategori')");
                }
                else if($tabel = "anggota")
                {
                    @$
                }

                if ($query_insert_data) {
                    echo "Data berhasil Disimpan";
                } 
                else {
                    echo "Maaf Insert Ke Dalam Database Error" . mysqli_error($con);
                }    
                    */
        break;
    }

    //     @$id_buku = $_GET["id_buku"];
                //     @$id_kategori = $_GET["id_kategori"];
                //     @$judul_buku = $_GET["judul_buku"];
                //     @$pengarang = $_GET["pengarang"];
                //     @$thn_terbit = $_GET["tahun_terbit"];
                //     @$penerbit = $_GET["penerbit"];
                //     @$isbn = $_GET["isbn"];
                //     @$jumlah_buku = $_GET["jumlah_buku"];
                //     @$lokasi = $_GET["lokasi"];
                //     @$gambar = $_GET["gambar"]
            
                //     $query_insert_data = mysqli_query($con, "INSERT INTO buku(id_buku,nama_kategori) VALUES('$id_kategori', '$nama_kategori')");
                //
?>

