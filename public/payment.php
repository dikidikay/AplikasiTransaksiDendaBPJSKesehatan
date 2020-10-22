<?php 
$databaseHost = 'localhost';
$databaseName = 'data';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

// $result = mysqli_query($mysqli,"SELECT * FROM data48");
// $num_rows = mysqli_num_rows($result);
// $idd = $num_rows-1;
// $ko = mysqli_query($mysqli,"SELECT data, total, data11 FROM data48 WHERE 'id'=0");
// while ($row = $ko->fetch_assoc()) {
// 	 $kmm = $row['data']."<br>";
// 	 $knn = $row['total']."<br>";
// 	 $knt = $row['data11']."<br>";
// // 	 $knkt = $row['data37']."<br>";
// }

Zend_Session::start();

$data489 = $_SESSION['data']['dat48'];
$data111 = $_SESSION['data']['dat11'];
$data44 = $_SESSION['data']['dat4'];






// $kmm = $row['ikan'];
// echo $kmm;
// $kn = join((array)$row);
// $kmm = substr($row,1,0);



// $bit48          = str_pad($kn, 16, " ", STR_PAD_LEFT);

// session_start();

// $kn=$_SESSION['wow'];

	error_reporting(E_ALL);
	ini_set('display_error',1);
	include('parser.php');
	include('builder.php');
	$socket = socket_create(AF_INET, SOCK_STREAM, 0);	
	socket_bind($socket, '');
	socket_connect($socket, '10.254.254.12', 1423);/*** IP dan PORT **/
	$acceptor_id	= '200900100800000';
	$jaks	= new JAK8583BUILDER();
	$settledate  	= str_pad(date("d")+1, 2, "0", STR_PAD_LEFT);
	$Rand           = '88'; /** 12 DIGIT **/
	$bit37          = str_pad($Rand, 12, "0", STR_PAD_LEFT);

    $jaks->addMTI('0200');
	$jaks->addData(2,'134004');
	$jaks->addData(3,'170000');
	$jaks->addData(4,$data44);
	$jaks->addData(7,date("mdhis"));
	$jaks->addData(11, $data111);
	$jaks->addData(12,date("his"));
	$jaks->addData(13,date("md"));
	$jaks->addData(15,date("m").$settledate);
	$jaks->addData(18,'6012');
	$jaks->addData(32, substr($acceptor_id,7,3));
	$jaks->addData(37, str_pad($Rand, 12, "0", STR_PAD_LEFT));
	$jaks->addData(41,'TESTDEV1');
	$jaks->addData(42, '200900100800000');
	$jaks->addData(48, $data489);
	$jaks->addData(49,'360');
	
	


	$kaki		= '03';
	$message 	= $jaks->getISO();
	$jumlah 	= strlen($message)+1;
	$conn 		= pack("n*",$jumlah);
	$cunn 		= pack("H*",$kaki);

// 	$jak = implode("|",(array)$jaks);
	
// 	echo $message;
	
	$cumi 		= $conn.$message.$cunn; 

	
	socket_write($socket,$cumi);
	
    //JAVA SERVER RECEIVES AND DISPLAYS
 
    //BLOCKS HERE
	$response = socket_read($socket, 1024);
	
	socket_close($socket);
	
	 // echo strlen($response);

	// CUT SERVER RESPONSE 2 BYTE
	$jum = strlen($response)-2;
	$res_srv = substr($response,2,$jum);
	
	$jaks	= new JAK8583PARSER();
	
	$jaks->addISO($res_srv);
	?>