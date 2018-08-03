<?php 
	class Pgsql_model extends CI_Model{
		public function __construct(){
			parent::__construct();
		}
		public function insertData($data){		
			for($i = 0; $i < count($data['accountname']); $i++){
				$value[] = array("name" => $data['accountname'][$i],"external_id__c" =>  'Acc-'.$this->gen_uuid());
			}
			if($this->db->insert_batch("account",$value)){
				return true;
			}
		}
		public function insertContact($data){	
			$index = 0;
			$count = count($data['accountname']);
			$query = $this->db->query("SELECT name,external_id__c FROM account ORDER BY ID DESC LIMIT '$count'");
			$res = $query->row();
			$res = $query->result_array();
			//$id = $res[0]['sfid'];
			foreach ($res as $key => $value) {
				
				for ($i=0; $i <count($data['lastname'.$index]); $i++) {
					$entries[] = array(
						"lastname" => $data['lastname'.$index][$i],
						 "username__c" => $data['username'.$index][$i],
						 "password__c" => $data['pass'.$index][$i],
						 "external_id__c" =>  $this->gen_uuid(),
						 "account__external_id__c" => $value['external_id__c']
					);
				}
				$index++;	
			}
			$this->db->insert_batch('contact', $entries);
			/*if(!empty($attch)){				
				$qry = $this->db->query("insert into attachment (parentid,name,body,contenttype) values('$id','$attch')");
			}*/
			//$this->db->query("INSERT INTO contact (lastname,username__c,password__c,accountid) VALUES ('$data[lastname]','$data[username__c]','$data[password__c]','$res->sfid')");
			return True;
		}

		public function deleteData($data){
			$this->db->where("id",$data);
			$this->db->delete('contact');
			return true;
		}
		public function gen_uuid() {
		    return sprintf( '%04x%04x',
		        // 32 bits for "time_low"
		        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		    );
		}
	}
?>