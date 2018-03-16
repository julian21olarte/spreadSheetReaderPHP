<?php
require 'vendor/autoload.php';
require 'models/Entity.php';
require 'models/Person.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function getResponse() {
  $rows = Person::getAll();
  $content = '' ;
  while($row = $rows->fetch_array()) {
    $name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
    $address = $row['address'];
    $content .= 
    "
      <tr>
        <td class='text-center'>
          $name
        </td>
        <td class='text-center'>
          $phone
        </td>
        <td class='text-center'>
          $email
        </td>
        <td class='text-center'>
          $address
        </td>
      </tr>
    ";
  }
  if($content == '') {
    $content = 
    "
    <tr>
      <h1>
        No hay datos en la tabla
      </h1>
    </tr>
    ";
  }
  $response = file_get_contents('index.html');
  $response = str_replace('{{all_persons}}', $content, $response);
  return $response;
}

  if(isset($_POST['clear-table'])) {
    Person::deleteAll();
  }
  if(isset($_FILES['excel-reader'])) {
    $file_name = 'uploads/spreadsheet.xlsx';
    move_uploaded_file($_FILES['excel-reader']['tmp_name'], $file_name);

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_name);

    foreach ($spreadsheet->getActiveSheet()->getRowIterator() as $row) {
      $cellIterator = $row->getCellIterator();
      $cellIterator->setIterateOnlyExistingCells(FALSE);
      $array_data = array();
      foreach ($cellIterator as $cell) {
        array_push($array_data, $cell->getValue());
      }
      $person = new Person(...$array_data);
      $person->save();
    }
  }
  echo getResponse();
?>