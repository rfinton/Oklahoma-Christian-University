<?php
  include '../../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
  include '../../PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';
  include 'record.php';

  $zipfiles = glob('*.zip');

  if (!$zipfiles) {
    exit();
  }

  $zip = new ZipArchive;
  
  if ($zip -> open($zipfiles[0]) === true) {
    $zip -> extractTo('.');
    $zip -> close();
  }
  
  // Variables
  $records = array ();    //create an empty array for storage
  $targetFile = fopen ('output.csv', 'w');  //create output file


  // open the source data file
  $sourceFile = fopen ("data.csv", 'r') or die ('Unable to open file');

  while ($data = fgetcsv ($sourceFile, 1000, ',')) {
    array_push ($records, new Record ($data));
  }

  //sort the records array by date property
  usort ($records, function ($a, $b) {
    $date1 = strtotime ($a -> dateTime);
    $date2 = strtotime ($b -> dateTime);
    if ($date1 < $date2) return 1;
    if ($date1 > $date2) return -1;
  });
        
  fwrite ($targetFile, "efcid,purl,firstname,lastname,email,address,city,state,zip,phone,mobile,date,event,gender,highschool,gradyear,ceeb,gpa,listsource,browserCodeName,browserName,platform,points\n");


  //Loop through the records array and write to output file.
  for ($counter = 0; $counter < count ($records) - 1; $counter++) {
    fwrite ($targetFile, $records[$counter] -> efcid . ",");
    fwrite ($targetFile, $records[$counter] -> purl . ",");
    fwrite ($targetFile, $records[$counter] -> firstname . ",");
    fwrite ($targetFile, '"' . $records[$counter] -> lastname . '",');
    fwrite ($targetFile, $records[$counter] -> email . ",");
    fwrite ($targetFile, $records[$counter] -> address . ",");
    fwrite ($targetFile, $records[$counter] -> city . ",");
    fwrite ($targetFile, $records[$counter] -> state . ",");
    fwrite ($targetFile, $records[$counter] -> zip . ",");
    fwrite ($targetFile, $records[$counter] -> phone . ",");
    fwrite ($targetFile, $records[$counter] -> mobile . ",");
    fwrite ($targetFile, $records[$counter] -> dateTime . ",");
    fwrite ($targetFile, '"' . $records[$counter] -> eventInfo . '",');
    fwrite ($targetFile, $records[$counter] -> gender . ",");
    fwrite ($targetFile, $records[$counter] -> highSchool . ",");
    fwrite ($targetFile, $records[$counter] -> gradYear . ",");
    fwrite ($targetFile, $records[$counter] -> ceeb . ",");
    fwrite ($targetFile, $records[$counter] -> gpa . ",");
    fwrite ($targetFile, $records[$counter] -> listSource . ",");
    fwrite ($targetFile, $records[$counter] -> browserCodeName . ",");
    fwrite ($targetFile, $records[$counter] -> browserName . ",");
    fwrite ($targetFile, $records[$counter] -> platform . ",");
    fwrite ($targetFile, "5\n");
  }

  //The rest of the code coverts the destination csv file into an excel spreadsheet
  $objReader = PHPExcel_IOFactory::createReader ('CSV');
  $objReader -> setDelimiter (",");
  $objReader -> setInputEncoding ('UTF-8');
  $objPHPExcel = $objReader -> load ('output.csv');

  $range = $objPHPExcel -> getActiveSheet () -> calculateWorksheetDimension ();
  $objPHPExcel -> getActiveSheet () -> setAutoFilter ($range);

  for ($col = 'A'; $col !== 'N'; $col++) {
    $objPHPExcel -> getActiveSheet () -> getColumnDimension ($col) -> setAutoSize (true);
  }

  $objPHPExcel -> getDefaultStyle () -> getAlignment () -> setHorizontal (PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

  $objWriter = PHPExcel_IOFactory::createWriter ($objPHPExcel, 'Excel2007');
  $objWriter -> save ('report.xlsx');

  fclose ($sourceFile);
  fclose ($targetFile);
  unlink('config.csv');
  unlink('data.csv');
  unlink('output.csv');
?>
