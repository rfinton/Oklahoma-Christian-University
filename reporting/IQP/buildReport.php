<?php
$fileList = scandir('.');
$setHeader = false;

foreach ($fileList as $file) {
  try {
    if (strpos($file, 'zip')) {
      $fileOut = fopen('inquiries(2).csv', 'a+');
      $zip = zip_open($file);
      $zipEntry = zip_read($zip);
      $contents = zip_entry_read($zipEntry, zip_entry_filesize($zipEntry));
      $stringArray = explode("\n", $contents);
  
      if (!$setHeader) {
        $setHeader = true;
        fwrite($fileOut, $stringArray[0]);
      }
  
      for ($n = 1; $n < count($stringArray); $n++) {
        fwrite($fileOut, $stringArray[$n]);
      }
  
      zip_entry_close($zipEntry);
      zip_close($zip);
      fclose($fileOut);
    }
  } catch (Exception $e) {
    //echo $e;
  }
}
?>