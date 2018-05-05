<?php
  class Contact {
    public $score;
    public $contactInfo;

    public function __construct($d) {
      $this -> contactInfo = $d;
      $this -> score = explode(",", $d)[2];
    }
  }

  $zipfiles = glob('*.zip');

  if (!$zipfiles) {
    exit();
  }

  $zip = new ZipArchive;
  if ($zip->open($zipfiles[0]) === true) {
    $zip->extractTo('.');
    $zip->close();
  }

  $csv = glob('*.csv');
  $inputFile = fopen($csv[0], 'r') or die ('Empty Report');
  $outputFile = fopen('scoring.csv', 'w');
  $arr = array();

  function sortByScore($a, $b) {
    if ($a -> score == $b -> score) return 0;
    return ($a > $b) ? -1 : 1;
  }

  while($val = fgets($inputFile)) {
    array_push($arr, new Contact($val));
  }

  usort($arr, 'sortByScore');

  for($i = 0; $i < count($arr); $i++) {
    fwrite($outputFile, $arr[$i] -> contactInfo);
  }

  fclose($inputFile);
  fclose($outputFile);
  unlink($csv[0]);
?>