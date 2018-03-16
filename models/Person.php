<?php 

class Person extends Entity{
  /**
   * Fields (add or replace this fields to match the excel format loaded)
   *
   */
  private $name;
  private $phone;
  private $email;
  private $address;

  /**
   * Constructor
   */
  public function __construct($name, $phone, $email, $address) {
    parent::__construct();
    $this->name = $name;
    $this->phone = $phone;
    $this->email = $email;
    $this->address = $address;
  }



  /**
   * Save a new Person
   */
  public function save() {
    $name = $this->name;
    $phone = $this->phone;
    $email = $this->email;
    $address = $this->address;
    $query = "INSERT INTO Person(`name`, phone, email, `address`) VALUES('$name', $phone, '$email', '$address')";
    $this->connection()->query($query);
  }




  /**
   * Get all rows in Person table
   */
  public static function getAll() {
    $entity = new Entity();
    return $entity->connection()
    ->query("SELECT * FROM Person");
  }

  /**
   * Delete all rows in Table
   */
  public function deleteAll() {
    $entity = new Entity();
    $entity->connection()
    ->query("DELETE FROM Person");
  }


}

?>