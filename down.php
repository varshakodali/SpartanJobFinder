<?php

	class FileF {

		private $Name;
		private $Type;
		private $Size;
		private $Content;

		public function getContent() {
			return $this->Content;
		}
		public function getType() {
			return $this->Type;
		}
		public function getName() {
			return $this->Name;
		}
		public function getSize() {
			return $this->Size;
		}

	}

	$con = new PDO("mysql:host=localhost;dbname=test","root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $id    = $_GET['id'];

$query = "SELECT name AS Name, type AS Type, size AS Size, content AS Content FROM resumes WHERE id = $id ";

$result = $con->query($query);// or die('Error, query failed');
$result->setFetchMode(PDO::FETCH_CLASS, "FileF");
$op = $result->fetch();

$fname = $op->getName();
$fsize = $op->getSize();
$ftype = $op->getType();

header("Content-length: $fname");
header("Content-type: $fsize");
header("Content-Disposition: attachment; filename=$fname");
echo $op->getContent();
 
exit;

?>