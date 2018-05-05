<?php
class Record {
    public $efcid;
    public $purl;
    public $firstname;
    public $lastname;
    public $email;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $phone;
    public $mobile;
    public $dateTime;
    public $eventInfo;
    public $gender;
    public $highSchool;
    public $gradYear;
    public $ceeb;
    public $gpa;
    public $listSource;
    public $browserCodeName;
    public $browserName;
    public $platform;
    
    public function __construct ($d) {
      $this -> efcid           = $d[0];
      $this -> purl            = $d[1];
      $this -> firstname       = $d[2];
      $this -> lastname        = $d[3];
      $this -> email           = $d[4];
      $this -> address         = $d[5];
      $this -> city            = $d[6];
      $this -> state           = $d[7];
      $this -> zip             = $d[8];
      $this -> phone           = $d[9];
      $this -> mobile          = $d[10];
      $this -> dateTime        = $d[11];
      $this -> eventInfo       = $d[12];
      $this -> gender          = $d[13];
      $this -> highSchool      = $d[14];
      $this -> gradYear        = $d[15];
      $this -> ceeb            = $d[16];
      $this -> gpa             = $d[17];
      $this -> listSource      = $d[18];
      $this -> browserCodeName = $d[19];
      $this -> browserName     = $d[20];
      $this -> platform        = $d[21];
    }
  }
?>