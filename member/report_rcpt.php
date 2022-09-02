<?php
session_start();
require('fpdf/fpdf.php'); //เรียกใช้งานการแปลงไฟล์ php เป็น pdf ด้วย fpdf
require_once '../config/connectdb.php'; //ทำการเชื่อมต่อฐานข้อมูล
// ------------------ ส่วนดึงข้อมูลมาแสดงผล ------------------ 
if (isset($_POST['RcptButton'])) {
    // รับค่า POST ที่ต้องการมาเก็บไว้ที่ตัวแปร 
    $id = mysqli_real_escape_string($conn, $_POST["rcpt_idfinish"]);
    //ติดต่อฐานข้อมูลที่ต้องการ
    $sql = "SELECT *  FROM rcpt LEFT JOIN rental ON rcpt.r_id=rental.r_id LEFT JOIN crane ON rental.c_id=crane.c_id LEFT JOIN payment_type ON rental.pm_id=payment_type.pm_id LEFT JOIN users ON rental.users_id=users.users_id where rcpt.rcpt_id ='$id' ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
    // เก็บข้อมูลที่ได้ไว้ในตัวแปร
        $rcpt_id =  $row["rcpt_id"];
        $r_id =  $row["r_id"];
        $rcpt_date =  $row["rcpt_date"];
        $fullname =  $row["fullname"];
        $phonenumber =  $row["phonenumber"];
        $urole =  $row["urole"];
        $r_numdate =  $row["r_numdate"];
        $c_name =  $row["c_name"];
        $r_place =  $row["r_place"];
        $rcpt_num =  $row["rcpt_num"];
        $rcpt_allnum =  $row["rcpt_allnum"];
    }
}
// ------------------ ส่วนดึงข้อมูลมาแสดงผล ------------------ 

// ------------------ ฟังก์ชั่นสำหรับแปลงวันที่ ------------------ 
$thai_day_arr = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
$thai_month_arr = array(
    "0" => "",
    "1" => "มกราคม",
    "2" => "กุมภาพันธ์",
    "3" => "มีนาคม",
    "4" => "เมษายน",
    "5" => "พฤษภาคม",
    "6" => "มิถุนายน",
    "7" => "กรกฎาคม",
    "8" => "สิงหาคม",
    "9" => "กันยายน",
    "10" => "ตุลาคม",
    "11" => "พฤศจิกายน",
    "12" => "ธันวาคม"
);

function thai_date($time)
{
    global $thai_day_arr, $thai_month_arr;
    $thai_date_return =    date("j", $time);
    $thai_date_return .= "   " . $thai_month_arr[date("n", $time)];
    $thai_date_return .=    "   " . (date("Y", $time) + 543);

    return $thai_date_return;
}
// ------------------ ฟังก์ชั่นสำหรับแปลงวันที่ ------------------ 

$pdf = new FPDF("P");   // P= แนวตั้ง, L=แนวนอน
$pdf->AddPage();
$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php'); //เพิ่มฟอนต์ภาษาไทยเข้ามา  กำหนด ชื่อ เป็น THSarabunNew
$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew Bold.php'); //เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น THSarabunNew
$pdf->AddFont('THSarabunNew', 'I', 'THSarabunNew Italic.php'); //เพิ่มฟอนต์ภาษาไทยเข้ามา ต้วเอียง  กำหนด ชื่อ เป็น THSarabunNew
$pdf->AddFont('THSarabunNew', 'BI', 'THSarabunNew BoldItalic.php');// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนาและเอียง  กำหนด ชื่อ เป็น THSarabunNew


// ------------------ กำหนดสีพื้นหลังทั้งหมด ------------------ 
$pdf->SetFillColor(220, 220, 220);
$pdf->SetXY(10, 20);
$pdf->SetFont('THSarabunNew', 'B', 18);
$pdf->MultiCell(190, 180, "", 1, 'C', true);
// ------------------ กำหนดสีพื้นหลังทั้งหมด ------------------  



// ------------------ กำหนดสีพื้นหลังส่วนหัว ------------------ 
$pdf->SetFillColor(169, 169, 169);
// ------------------ กำหนดสีพื้นหลังส่วนหัว ------------------ 


// ------------------ ข้อความส่วนหัว ------------------ 
$pdf->SetXY(10, 10);
$pdf->SetFont('THSarabunNew', 'B', 18);
$pdf->MultiCell(190, 12, iconv('UTF-8', 'tis620', 'สัญญาจ้าง '), 1, 'C', true);
$pdf->SetXY(15, 10);
$pdf->SetFont('THSarabunNew', '', 18);
$pdf->Cell(60, 12, iconv('UTF-8', 'tis620', 'รหัสใบเสร็จ ') . $rcpt_id, 0, 0, 'L');
$pdf->SetXY(130, 10);
$pdf->SetFont('THSarabunNew', '', 18);
$pdf->Cell(60, 12, iconv('UTF-8', 'tis620', 'รหัสการเช่า ' . $r_id), 0, 0, 'R');
// ------------------ ข้อความส่วนหัว ------------------ 


// ------------------ ข้อความของบริษัท ------------------ 
$pdf->SetXY(20, 22);
$pdf->SetFont('THSarabunNew', 'B', 26);
$pdf->MultiCell(170, 10, iconv('UTF-8', 'tis620', 'ปรีชาเครน '), 0, 'C');

$pdf->SetXY(20, 29);
$pdf->SetFont('THSarabunNew', '', 16);
$pdf->MultiCell(170, 10, iconv('UTF-8', 'tis620', '445/25 ม.9 ตำบลสุรนารี อำเภอเมือง จังหวัดนครราชสีมา 30000 '), 0, 'C');
$pdf->SetXY(20, 34);
$pdf->SetFont('THSarabunNew', '', 16);
$pdf->MultiCell(170, 10, iconv('UTF-8', 'tis620', 'โทร. 085-9281308, 097-3287508 '), 0, 'C');
// ------------------ ข้อความของบริษัท ------------------ 


// ------------------  กำหนดสีพื้นหลังส่วนวันที่ ------------------ 
$pdf->SetFillColor(192, 192, 192);
$pdf->SetXY(20, 44);
$pdf->MultiCell(170, 110, iconv('UTF-8', 'tis620', ""), 1, 'C', true);
// ------------------  กำหนดสีพื้นหลังส่วนวันที่ ------------------ 


// ------------------ ข้อความส่วนวันที่และผู้ว่าจ้าง ------------------ 
$pdf->SetXY(110, 44);
$pdf->SetFont('THSarabunNew', 'B', 18);
$pdf->MultiCell(80, 10, iconv('UTF-8', 'tis620', 'วันที่ออกใบเสร็จ : ' . thai_date(strtotime($rcpt_date))."  "), 0, 'R');
$pdf->SetXY(20, 54);
$pdf->SetFont('THSarabunNew', 'B', 18);
$pdf->MultiCell(170, 10, iconv('UTF-8', 'tis620', '  ผู้ว่าจ้าง :    ' . $fullname), 1, 'L');
$pdf->SetXY(110, 54);
$pdf->SetFont('THSarabunNew', 'B', 18);
$pdf->MultiCell(80, 10, iconv('UTF-8', 'tis620', 'สถานะ :   ' . $urole."  "), 0, 'R');
// ------------------ ข้อความส่วนวันที่และผู้ว่าจ้าง ------------------ 


// ------------------ กำหนดสีพื้นหลังส่วนรายละเอียด ------------------ 
$pdf->SetFillColor(240, 248, 255);
$pdf->SetXY(20, 64);
$pdf->MultiCell(170, 100, iconv('UTF-8', 'tis620', ""), 1, 'C', true);
// ------------------ กำหนดสีพื้นหลังส่วนรายละเอียด ------------------ 


// ------------------ ส่วนหัวของตาราง ------------------ 
$pdf->SetFont('THSarabunNew', 'B', 18);
$pdf->SetXY(20, 64);
$pdf->MultiCell(30, 10, iconv('UTF-8', 'tis620', "ลำดับที่"), 1, 'C');
$pdf->SetXY(50, 64);
$pdf->MultiCell(140, 10, iconv('UTF-8', 'tis620', "รายละเอียด"), 1, 'C');
// ------------------ ส่วนหัวของตาราง ------------------ 


//------------------ ส่วนหัวข้อของตาราง ------------------  
$pdf->SetFont('THSarabunNew', 'B', 16);
$pdf->SetXY(20, 74);
$pdf->MultiCell(30, 10, iconv('UTF-8', 'tis620', "1"), 1, 'C');
$pdf->SetXY(20, 84);
$pdf->MultiCell(30, 10, iconv('UTF-8', 'tis620', "2"), 1, 'C');
$pdf->SetXY(20, 94);
$pdf->MultiCell(30, 10, iconv('UTF-8', 'tis620', "3"), 1, 'C');
$pdf->SetXY(20, 104);
$pdf->MultiCell(30, 10, iconv('UTF-8', 'tis620', "4"), 1, 'C');
$pdf->SetXY(20, 114);
$pdf->MultiCell(30, 10, iconv('UTF-8', 'tis620', "5"), 1, 'C');
$pdf->SetXY(20, 124);
$pdf->MultiCell(30, 10, iconv('UTF-8', 'tis620', "6"), 1, 'C');
$pdf->SetXY(20, 134);
$pdf->MultiCell(30, 10, iconv('UTF-8', 'tis620', "7"), 1, 'C');
$pdf->SetXY(20, 144);
$pdf->MultiCell(30, 10, iconv('UTF-8', 'tis620', "8"), 1, 'C');
$pdf->SetXY(20, 154);
$pdf->MultiCell(30, 10, iconv('UTF-8', 'tis620', ""), 1, 'C');
//------------------ ส่วนหัวข้อของตาราง ------------------  


//------------------   ส่วนรายละเอียด ------------------  
$pdf->SetFont('THSarabunNew', '', 16);
$pdf->SetXY(50, 74);
$pdf->MultiCell(140, 10, iconv('UTF-8', 'tis620', "  สถานที่ทำงาน : " . $r_place), 1, 'L');
$pdf->SetXY(50, 84);
$pdf->MultiCell(140, 10, iconv('UTF-8', 'tis620', "  รถที่เช่า : " . $c_name), 1, 'L');
$pdf->SetXY(50, 94);
$pdf->MultiCell(140, 10, iconv('UTF-8', 'tis620', "  เวลางานเริ่ม ...........................................น. ถึงเวลา ...........................................น."), 1, 'L');
$pdf->SetXY(50, 104);
$pdf->MultiCell(140, 10, iconv('UTF-8', 'tis620', "  งานล่วงเวลา เริ่ม ...........................................น. ถึงเวลา ...........................................น."), 1, 'L');
$pdf->SetXY(50, 114);
$pdf->MultiCell(140, 10, iconv('UTF-8', 'tis620', "  ค่าเช่าวันละ   " . number_format($rcpt_num, 2) . "  บาท" . "         " . "   เช่าทั้งหมด   " . $r_numdate . "  วัน"), 1, 'L');
$pdf->SetXY(50, 124);
$pdf->MultiCell(140, 10, iconv('UTF-8', 'tis620', "  รวมเป็นเงิน   " . number_format($rcpt_allnum, 2) . "  บาท"), 1, 'L');
$pdf->SetXY(50, 134);
$pdf->MultiCell(140, 10, iconv('UTF-8', 'tis620', "  สถานที่เก็บเงิน ......................................................."), 1, 'L');
$pdf->SetXY(50, 144);
$pdf->MultiCell(140, 10, iconv('UTF-8', 'tis620', "  หมายเหตุ"), 1, 'L');
$pdf->SetXY(50, 154);
$pdf->MultiCell(140, 10, iconv('UTF-8', 'tis620', ""), 1, 'L');
//------------------ ส่วนรายละเอียด ------------------  


//------------------ ส่วนลายเซ็นต์ ------------------ 
$pdf->SetFont('THSarabunNew', 'B', 16);
$pdf->SetXY(20, 172);
$pdf->MultiCell(180, 5, iconv('UTF-8', 'tis620', 'ผู้ว่าจ้าง ................................................................' . '     พนักงานขับรถ ................................................................'), 0, 'L');
//------------------ ส่วนลายเซ็นต์ ------------------ 


//------------------ ส่วนท้าย ------------------ 
$pdf->SetFont('THSarabunNew', 'B', 12);
$pdf->SetXY(45, 177);
$pdf->MultiCell(180, 5, iconv('UTF-8', 'tis620', 'ในการทำงานใด ๆ ก็ตาม หากทำโดยคำสั่งของผู้ว่าจ้าง หรือเพื่อผลประโยชน์ของผู้ว่าจ้าง หากเกิดความเสียหาย หรือผิดพลาด'), 0, 'L');
$pdf->SetXY(20, 182);
$pdf->MultiCell(180, 5, iconv('UTF-8', 'tis620', 'อันเกิดจากเกินความสามารถของเครื่องจักร ผู้ว่าจ้างต้องรับผิดชอบ'), 0, 'L');
$pdf->SetXY(45, 187);
$pdf->MultiCell(180, 5, iconv('UTF-8', 'tis620', 'หากท่านมีปัญหาเรื่อง พนักงานขับรถไม่สุภาพ พนักงานขับรถเรียกร้องเงิน พนักงานขับรถไม่เต็มใจทำงาน หรืออื่นๆ เกี่ยวกับ'), 0, 'L');
$pdf->SetXY(20, 192);
$pdf->MultiCell(180, 5, iconv('UTF-8', 'tis620', 'ผลประโยชน์ของท่าน โปรดแจ้งให้ทางผู้บริหารทราบ เพื่อทำการปรับปรุงแก้ไข และขอขอบคุณสำหรับการเรียกใช้บริการอย่างสูงยิ่ง'), 0, 'L');
//------------------ ส่วนท้าย ------------------ 

$pdf->Output();   // แสดงผล
