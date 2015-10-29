<?php
//conection: 
//$link = mysqli_connect("itmo544-db.c4bvwzwqz1hy.us-west-2.rds.amazonaws.com","guhaotian","909690ght","3306") or die("Error " . mysqli_error($link));
echo "Hello world";
//$link = mysqli_connect("itmo544grh-mp1.ckh0wwv6itjw.us-west-2.rds.amazonaws.com","rui","110224Fish","") or die("Error " . mysqli_error($link)); 
echo "Hello world";
//$link = mysqli_connect("itmo544-ght-db.c4bvwzwqz1hy.us-west-2.rds.amazonaws.com","guhaotian","909690ght","guhaotiandb") or die("Error " . mysqli_error($link));
$link = mysqli_connect("itmo544grh-mp1.ckh0wwv6itjw.us-west-2.rds.amazonaws.com","rui","110224Fish","itmoruidb") or die("Error " . mysqli_error($link));
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
//echo "Here is the result: " . $link;
$sql = "CREATE TABLE comments 
(
ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
PosterName VARCHAR(32),
Title VARCHAR(32),
Content VARCHAR(500)
)";
$con=$link->query($sql);
?>
~                                                                                                                                                                                                            
~                                                                                                                                                                                                            
~       