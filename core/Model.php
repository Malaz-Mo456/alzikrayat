 <?php
 require_once 'config/database.php';
abstract class Model{
protected $db; 
public function __construct(){
    $this->db= Database::getInstance()->getConnection();
}

}

?>