<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
$weekDay = array( 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสฯ', 'ศุกร์', 'เสาร์');
$thaiMon = array( "01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม", "04" => "เมษายน",
      "05" => "พฤษภาคม","06" => "มิถุนายน", "07" => "กรกฎาคม", "08" => "สิงหาคม",
      "09" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม");



     
      


//Sun - Sat
$month = isset($_GET['month']) ? $_GET['month'] : date('m'); //ถ้าส่งค่าเดือนมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้เดือนปัจจุบัน
$year = isset($_GET['year']) ? $_GET['year'] : date('Y'); //ถ้าส่งค่าปีมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้ปีปัจจุบัน

//วันที่
$startDay ="01-" .$month.'-'.$year;   //วันที่เริ่มต้นของเดือน

$timeDate = strtotime($startDay);   //เปลี่ยนวันที่เป็น timestamp
$lastDay = date("t", $timeDate);   //จำนวนวันของเดือน

$endDay = $lastDay.'-'.$month."-".$year ;  //วันที่สุดท้ายของเดือน

$startPoint = date('w', $timeDate);   //จุดเริ่มต้น วันในสัปดาห์
include('../config/connectdb.php');

//echo $newyear;
//echo $newmonth;
$CraneArr = array();
$yearMonth = "$year-$month";
$sql = "SELECT DAY( `cr_date` ) AS crane_day, COUNT( * ) AS qty
        FROM cranerent
        WHERE DATE_FORMAT( `cr_date` , '%Y-%m' ) = '$yearMonth' and c_id = 1
        GROUP BY DAY( cr_date )";
$qry = mysqli_query($conn,$sql) or die('sql ผิด');
while($row = mysqli_fetch_assoc($qry)){
    $CraneArr[$row['crane_day']] = $row['qty'];
}


//echo "<br>\$data ";
//print_r($data);
//echo "<hr>";
?>
<html>
 <head>
 <title>ทดลองสร้างปฏิทินด้วย PHP</title>
 <style type="text/css">
    .crane_status1{ background-color : green;}
    .crane_status2{ background-color : red;}
</style>
 <script type='text/javascript'>
    function goTo(month, year){
   window.location.href = "test.php?year="+ year +"&month="+ month;
    }
 </script>
 <style>
 th,td{width:50px;height: 30px; text-align:center}
 th{background-color: #eeeeee;}
 #tb_calendar, #main{ width : 90%;}
 #main{ border : 20px solid #46A5E0;}
 #nav{
  background-color: #ff99ff;
  min-height: 20px;
  padding: 10px;
  text-align: center;
  color : black;
 }
 .navLeft{float: left; }
 .navRight{float: right;}
 .title{float: left; text-align: center; width: 300px;}
 </style>
 </head>
 <body>

<?php
//echo "<br/>ตำแหน่งของวันที่ $startDay คือ <strong>", $startPoint , " (ตรงกับ วัน" , $weekDay[$startPoint].")</strong>";

$title = "เดือน $thaiMon[$month] <strong>". $startDay. " : ". $endDay."</strong>";

//ลดเวลาลง 1 เดือน
$prevMonTime = strtotime ( '-1 month' , $timeDate  );
$prevMon = date('m', $prevMonTime);
$prevYear = date('Y', $prevMonTime);
//เพิ่มเวลาขึ้น 1 เดือน
$nextMonTime = strtotime ( '+1 month' , $timeDate  );
$nextMon = date('m', $nextMonTime);
$nextYear = date('Y', $nextMonTime);


$month = isset($_POST['month']) ? $_POST['month'] : date('m');    
$year = isset($_POST['year']) ? $_POST['year'] : date('Y');

echo '<div id="main">';
echo '<div id="nav">
  <button class="navLeft" onclick="goTo(\''.$prevMon.'\', \''.$prevYear.'\');"><< เดือนที่แล้ว</button>
  <div class="title">'.$title.'</div>
  <button class="navRight" onclick="goTo(\''.$nextMon.'\', \''.$nextYear.'\');">เดือนต่อไป >></button>
 </div>
 <div style="clear:both"></div>';
echo "<table id='tb_calendar' border='1'>"; //เปิดตาราง
echo "<tr>
  <th>อาทิตย์</th><th>จันทร์</th><th>อังคาร</th><th>พุธ</th><th>พฤหัสฯ</th><th>ศุกร์</th><th>เสาร์</th>
</tr>";
echo "<tr>";    //เปิดแถวใหม่
$col = $startPoint;          //ให้นับลำดับคอลัมน์จาก ตำแหน่งของ วันในสับดาห์ 
if($startPoint < 7){         //ถ้าวันอาทิตย์จะเป็น 7
 echo str_repeat("<td> </td>", $startPoint); //สร้างคอลัมน์เปล่า กรณี วันแรกของเดือนไม่ใช่วันอาทิตย์
}
for($i=1; $i <= $lastDay; $i++){ //วนลูป ตั้งแต่วันที่ 1 ถึงวันสุดท้ายของเดือน

 $col++;       //นับจำนวนคอลัมน์ เพื่อนำไปเช็กว่าครบ 7 คอลัมน์รึยัง
 $numcrane = isset($CraneArr[$i]) ? $CraneArr[$i] : 0;
 $tdStyle = "";
 if($numcrane ==1){
     $tdStyle = "crane_status2";
 }else{
     $tdStyle = "crane_status1";
 }

 echo "<td class='$tdStyle'> $i </td>";   //สร้างคอลัมน์ แสดงวันที่ 
 if($col % 7 == false){   //ถ้าครบ 7 คอลัมน์ให้ขึ้นบรรทัดใหม่
  echo "</tr><tr>";   //ปิดแถวเดิม และขึ้นแถวใหม่
  $col = 0;     //เริ่มตัวนับคอลัมน์ใหม่
 }
}
if($col < 7){         // ถ้ายังไม่ครบ7 วัน
 echo str_repeat("<td> </td>", 7-$col); //สร้างคอลัมน์ให้ครบตามจำนวนที่ขาด
}
echo '</tr>';  //ปิดแถวสุดท้าย
echo '</table>'; //ปิดตาราง
echo '</main>';

?>
</body>
</html>