<?php

	class jobSearch{
		public $keyword;
		public $location;

		function __construct() {
       		$this->keyword = "";
       		$this->location = "";
   		}
	}

	class organization_info{
		public $Name;
		public $HeadQuaters;
		public $Industry;
		public $Department;

		public function getName(){
			return $this->Name;
		}
		public function getHeadquarters(){
			return $this->HeadQuaters;
		}
		public function getIndustry(){
			return $this->Industry;
		}
		public function getDepartment(){
			return $this->Department;
		}
	}

	class job_info{

		// public $Name;
		// public $Department;
		// public $OrgID;
		public $JobID;
		public $Role;
		public $Type;
		public $JobDescription;
		public $MinSalary;
		public $MaxSalary;
		public $company_name;

		// public function getName(){
		// 	return $this->Name;
		// }
		// // public function getDeptName(){
		// // 	return $this->Department;
		// // }
		// public function getOrgID(){
		// 	return $this->OrgID;
		// }
		public function getjobID(){
			return $this->JobID;
		}
		public function getRole(){
			return $this->Role;
		}
		public function getType(){
			return $this->Type;
		}
		public function getDescription(){
			return $this->JobDescription;
		}
		public function getMinSalary(){
			return $this->MinSalary;
		}
		public function getMaxSalary(){
			return $this->MaxSalary;
		}
		public function getCompanyName(){
			return $this->company_name;
		}
	}
?>
