<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "perpustakaan";
$con = mysqli_connect($server, $username, $password) or die("<h1>Koneksi Mysqli Error : </h1>" .mysqli_connect_error());
mysqli_select_db($con, $database) or die("<h1>Koneksi Kedatabase Error : </h1>" . mysqli_error($con));

@$operasi = $_GET["operasi"];

switch ($operasi) {

    case "view":
        $query_tampil_biodata = mysqli_query($con, "SELECT * FROM kategori") or die (mysqli_error($con));
        $data_array = array();

        while ($data = mysqli_fetch_assoc($query_tampil_biodata)){
            $data_array[]=$data;
        }
        echo json_encode($data_array);

    break;

    case "insert":
        @$id_kategori = $_POST['id_kategori']; //ini itu membuat sebuah variable dengan nama $id_kategori yang mengambli data dari url dan dijadikan sebagai array ['id_kategori']
        @$nama_kategori = $_POST['nama_kategori'];

        $query_insert_data = mysqli_query($con, "INSERT INTO kategori(id_kategori,nama_kategori) VALUES('$id_kategori', '$nama_kategori')");

        if ($query_insert_data) {
            echo "Data berhasil Disimpan";
        } 
        else {
            echo "Maaf Insert Ke Dalam Database Error" . mysqli_error($con);
        }

    break;

    case "get_data_by_id":
        @$id =(int)$_GET['id']; //ini itu membuat sebuah variable $id dengan get(mengambil) data dari url sebagai id_kategori dan dimasukan ke dalam $id sebagai array
        $query_tampil_biodata = mysqli_query($con, "SELECT * FROM kategori WHERE id_kategori='$id'") or die (mysqli_error($con));
        $data_array = array();
        $data_array = mysqli_fetch_assoc($query_tampil_biodata);
        echo "[" .json_encode ($data_array) . "]";

    break;

    case "update":
        @$id =(int)$_GET['id_kategori']; //jadi disini 
                                                 //mengambil(get) parameter yang sama dan di simpan sebagai array ['id_kategori'], tapi dijadikan argument pada variable yang berbeda yaitu $id dan $id_kategori
        @$id_kategori = $_GET['id_kategori']; //dan disini
        @$nama_kategori = $_GET['nama_kategori'];

        $query_update_biodata = mysqli_query($con, "UPDATE kategori SET id_kategori = '$id_kategori', nama_kategori='$nama_kategori' WHERE id_kategori='$id'");

        if ($query_update_biodata) {
            echo "Update Data Berhasil";
        }
        else {
            echo mysqli_error($con);
        }

    break;

    case "delete":
        @$id = $_GET['id_kategori'];
        $query_delete_biodata = mysqli_query($con, "DELETE FROM kategori WHERE id_kategori='$id'");
        if ($query_delete_biodata) {
            echo "Data Berhasil Dihapus";
        }
        else{
            echo mysqli_error($con);
        }
    break;

    default;
    break;

}

?>