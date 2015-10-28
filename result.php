<?php
//start the session
session_start();
//echo $_FILES;
echo $_POST['useremail'];
$uploaddir='/tmp/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile)){
	echo "File is calid, and was successfully uploaded.\n";
}else{
	echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";
require 'vendor/autoload.php';
use Aws\s3\s3client;

$client = S3lient::factory();
$buchet = uniqid("php-jrh-",false);

$result = $client->createBucket(array(
	'Bucket'=> $bucket
));

$client->waitUntiBucketExists(array('Bucket'=> $bucket));
$key = $uploadfile;
$result = $client->putObject(array(
	'ACL'=>'public-read',
	'Bucket'=>$bucket,
	'Key'=>$key,
	'SourceFile'=> $uploadfile
));

$url = $result['ObjectURL'];
echo $url;

use Aws\Rds\RdsClient;
$client = RdsClient::factory(array(
	'region' => 'us-west-2'
));

$result = $client->describeDBInstances(array(
	'DBInstanceIdentifier'=>'itmo544grh-mp1',
));

$endpoint = "";

foreach ($result->getPath('DBInstances/*/Endpoint/Address')as $ep){
	//do something with the meessage
	echo "==========". $ep ."========";
	$endpoint = $ep;
}

	//echo "begin database";
$link = mysqli_connect($endpoint,"rui","110224Fish","customerresech") or die("Error " . mysqli_error($link));

//check connection
if (mysqli_connect_error()){
	printf("Connect failed: %s\n",mysqli_connect_error());
	exit();
}
//prepared statement, stage1:prepare
if(!($stmt =$link->prepare("INSERT INTO items (id,email,phone,filename,s3rawurl,s3finishedurl,status,issubscribed)VALUES(NULL,?,?,?,?,?,?,?)"))){
	echo "Prepare failed:(" . $link->errno . ")" . $link->error;
}

$email = $_POST['useremail'];
$phone = $_post['phone'];
$s3rawurl = $url;//$result['ObjectURL'];from above
$filename = basename($_FILES['userfile']['name']);
$s3finishedurl = "none";
$status=0;
$issubscribed=0;
$stmt->bind_param("sssssii",email,$phone,$filename,$s3rawrul,$s3finishedurl,$status,$issbuscribed);

if(!$stmt->execute()){
	echo "Execute failed:(" . $stmt->errno . ")" . $stmt->error;
}

printf("%d Row inserted.\n", $stmt->affected_rows);

$stmt->close();

$link->real_query("SELECT * FROM items");
$res = $link->use_result();

echo "Result set order...\n";
while ($row = $res->fetch_assoc()){
	echo $row['id'] . " " .$row['email']. " " .$row['phone'];
}

$link->close();







?>