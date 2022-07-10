<?php
/** Include PHPExcel */
require_once dirname(dirname(__FILE__)) . '/PHPExcel/PHPExcel.php';

$servername = "localhost";
$username = "sunwebs2_erp";
$password = "_Bou^0%Oip87";
$dbname = "sunwebs2_erp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$filename = dirname(dirname(__FILE__)).'/upload/responses.xlsx';



$tm = time();
$response_id = $tm.mt_rand(10,99);
$idea1 = '';
$idea2 = '';
$idea3 = '';
$idea4 = '';

if($_POST['task'] == 'firsttask'){
    $idea1 = mysqli_real_escape_string($conn,$_POST['idea1']);
    $idea2 = mysqli_real_escape_string($conn,$_POST['idea2']);
    $idea3 = mysqli_real_escape_string($conn,$_POST['idea3']);
    $idea4 = mysqli_real_escape_string($conn,$_POST['idea4']);
    
    $sql="INSERT INTO survey_respones (response_id)
    VALUES
    ('".$response_id."')";
    if ($conn->query($sql) === TRUE) {
       $last_insertId =  $conn -> insert_id;
       $step = 1;
       $sql2="INSERT INTO response_steps (survey_responseid,steps,idea1, idea2, idea3,idea4)
            VALUES
            ('".$last_insertId."','".$step."','".$idea1."','".$idea2."','".$idea3."','".$idea4."')";
        if ($conn->query($sql2) === TRUE) {
               $data = ['last_insertId' => $last_insertId,'response_id' => $response_id];
            echo json_encode($data);
        }

    }else{
      echo "error ". $conn->error;
    }
    die();
    }
    
    //store second task
    if($_POST['task'] == 'secondtask'){
        $lastid = $_POST['last_insertId'];
        $idea1 = mysqli_real_escape_string($conn,$_POST['idea1']);
        $idea2 = mysqli_real_escape_string($conn,$_POST['idea2']);
        $idea3 = mysqli_real_escape_string($conn,$_POST['idea3']);
        $idea4 = mysqli_real_escape_string($conn,$_POST['idea4']);
        $sql="SELECT * FROM survey_respones where id='".$lastid."' and deleted=0";
    if ($result = $conn->query($sql)) {
       if($result->num_rows > 0){
          $step = 2;
          $sql3="INSERT INTO response_steps (survey_responseid,steps,idea1, idea2, idea3,idea4)
            VALUES
            ('".$lastid."','".$step."','".$idea1."','".$idea2."','".$idea3."','".$idea4."')";
        if ($conn->query($sql3) === TRUE) {
               $data = ['last_insertId' => $lastid];
            echo json_encode($data);
            
        }
       }

    }else{
      echo "error ". $conn->error;
    }
    die();
    }
    
    //store third task
    if($_POST['task'] == 'thirdtask'){
        $lastid = $_POST['last_insertId'];
        $idea1 = mysqli_real_escape_string($conn,$_POST['idea1']);
        $idea2 = mysqli_real_escape_string($conn,$_POST['idea2']);
        $idea3 = mysqli_real_escape_string($conn,$_POST['idea3']);
        $idea4 = mysqli_real_escape_string($conn,$_POST['idea4']);
        $sql3="SELECT * FROM survey_respones where id='".$lastid."' and deleted=0";
    if ($result3 = $conn->query($sql3)) {
       if($result3->num_rows > 0){
          $step = 3;
          while($row3 = $result3->fetch_assoc()) {
            $response_id = $row3["response_id"];
          }
          $sql3="INSERT INTO response_steps (survey_responseid,steps,idea1, idea2, idea3,idea4)
            VALUES
            ('".$lastid."','".$step."','".$idea1."','".$idea2."','".$idea3."','".$idea4."')";
        if ($conn->query($sql3) === TRUE) {
               $data = ['last_insertId' => $lastid,'response_id'=>$response_id];
                  $objPHPExcel = new PHPExcel;
    $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
    $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
    $numberFormat = '#,#0.##;[Red]-#,#0.##';
    $objSheet = $objPHPExcel->getActiveSheet();
    $objSheet->setTitle('RESPONSES');
    $objSheet->mergeCells('B2:E2');
    $objSheet->getCell('B2')->setValue('TASK 1');
    $objSheet->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objSheet->getStyle('B2')->getFont()->setBold(true)->setSize(12);
    $objSheet->mergeCells('F2:I2');
    $objSheet->getCell('F2')->setValue('TASK 2');
    $objSheet->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objSheet->getStyle('F2')->getFont()->setBold(true)->setSize(12);
    $objSheet->mergeCells('J2:M2');
    $objSheet->getCell('J2')->setValue('TASK 3');
    $objSheet->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objSheet->getStyle('J2')->getFont()->setBold(true)->setSize(12);
    $objSheet->getCell('A3')->setValue('IDs');
    $objSheet->mergeCells('B3:E3');
    $objSheet->getCell('B3')->setValue('Step 4');
    $objSheet->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objSheet->getStyle('B3')->getFont()->setBold(true)->setSize(12);
    $objSheet->mergeCells('F3:J3');
    $objSheet->getCell('F3')->setValue('Step 4');
    $objSheet->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objSheet->getStyle('F3')->getFont()->setBold(true)->setSize(12);
    $objSheet->mergeCells('I3:M3');
    $objSheet->getCell('I3')->setValue('Step 4');
    $objSheet->getStyle('I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objSheet->getStyle('I3')->getFont()->setBold(true)->setSize(12);
    
       $sqldata="SELECT * FROM survey_respones where deleted=0";
        if ($resultsurvey = $conn->query($sqldata)) {
           if($resultsurvey->num_rows > 0){
               $cell = 4;
               while($rowsurvey = $resultsurvey->fetch_assoc()) {
                 $id=  $rowsurvey["id"];
                $response_id = $rowsurvey["response_id"];
               // $objSheet->getCell("A$cell")->setValue($response_id);
                $objSheet->getCellByColumnAndRow(A, $cell)->setValueExplicit($response_id, PHPExcel_Cell_DataType::TYPE_STRING);
                $objSheet->getColumnDimension("A$cell")->setAutoSize(true);
                //get child table
                $sqlres="SELECT * FROM response_steps where survey_responseid='".$id."' and deleted=0";
                 $sqlres="SELECT * FROM response_steps where survey_responseid='".$id."' and deleted=0";
                if($resultres = $conn->query($sqlres)) {
                    if($resultres->num_rows > 0){
                         while($rowideas = $resultres->fetch_assoc()) {
                             if($rowideas['steps'] == 1){
                                $objSheet->getCell("B$cell")->setValue($rowideas['idea1']);
                                $objSheet->getColumnDimension("B$cell")->setAutoSize(true);
                                $objSheet->getCell("C$cell")->setValue($rowideas['idea2']);
                                $objSheet->getColumnDimension("C$cell")->setAutoSize(true);
                                $objSheet->getCell("D$cell")->setValue($rowideas['idea3']);
                                $objSheet->getColumnDimension("D$cell")->setAutoSize(true);
                                $objSheet->getCell("E$cell")->setValue($rowideas['idea4']);
                                $objSheet->getColumnDimension("E$cell")->setAutoSize(true);
                             }else if($rowideas['steps'] == 2){
                                 $objSheet->getCell("F$cell")->setValue($rowideas['idea1']);
                                $objSheet->getColumnDimension("F$cell")->setAutoSize(true);
                                $objSheet->getCell("G$cell")->setValue($rowideas['idea2']);
                                $objSheet->getColumnDimension("G$cell")->setAutoSize(true);
                                $objSheet->getCell("H$cell")->setValue($rowideas['idea3']);
                                $objSheet->getColumnDimension("H$cell")->setAutoSize(true);
                                $objSheet->getCell("I$cell")->setValue($rowideas['idea4']);
                                $objSheet->getColumnDimension("I$cell")->setAutoSize(true);
                             }else if($rowideas['steps'] == 3){
                                 $objSheet->getCell("J$cell")->setValue($rowideas['idea1']);
                                $objSheet->getColumnDimension("J$cell")->setAutoSize(true);
                                $objSheet->getCell("K$cell")->setValue($rowideas['idea2']);
                                $objSheet->getColumnDimension("K$cell")->setAutoSize(true);
                                $objSheet->getCell("L$cell")->setValue($rowideas['idea3']);
                                $objSheet->getColumnDimension("L$cell")->setAutoSize(true);
                                $objSheet->getCell("M$cell")->setValue($rowideas['idea4']);
                                $objSheet->getColumnDimension("M$cell")->setAutoSize(true);
                             }
                          
                         }
                    }
                }
                $cell++;
              }
           }
        }

   // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   // header('Content-Disposition: attachment;filename="file.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter->save($filename);
            echo json_encode($data);
            
        }
       }

    }else{
      echo "error ". $conn->error;
    }
    die();
    }
    
   $conn->close();
    die();
?>