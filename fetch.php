<?php
session_start();
//fetch.php;
if(isset($_POST["view"]))
{
 $connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE alerts SET alertStatus=1 WHERE alertStatus=0";
  mysqli_query($connect, $update_query);
 }
 $query = "SELECT * FROM alerts ORDER BY alertID DESC LIMIT 5";
 $result = mysqli_query($connect, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <li>
    <a href="" style="text-decoration:none; color:black;">
     <strong>Subject: '.$row["alertSubject"].'</strong><br />
     <small><em>Text: '.$row["alertDescription"].'</em></small><br />
     <small><em>Sent on: '.$row["alertDate"].' At: '.$row["alertTime"].'</em></small><br />
     <small>From: '.$row["farmerName"].'</small><br />
    </a>
   </li>
   <li class="dropdown-divider"></li>
   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic" style="text-decoration:none; color:black;">No Notification Found</a></li>';
 }
 
 $query_1 = "SELECT * FROM alerts WHERE alertStatus=0";
 $result_1 = mysqli_query($connect, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>