<?php 
	class Pgsql_controller extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->database();
		}
		function index(){
			$query = $this->db->order_by('id', 'DESC')->get("contact");
			$data['records'] = $query->result();
			$this->load->helper('url');
			$this->load->view("heroku_view",$data);
		}
		function insertRecords(){
			$this->load->model('Pgsql_model');
			$this->load->helper('form');
			$file = isset($_FILES['image']) ? $_FILES['image'] : '';
			if($file["error"] == 0){
				$content = file_get_contents($file["tmp_name"]);
				$base64 = base64_encode($content);
				$filetype = $file["type"];
				$body = str_split($base64,1000);
				 foreach ($body as $bodybase64) {
					$attachment = pg_escape_string($file['name'])."','$bodybase64','$filetype'";
				}
			}
			 //$attachment = rtrim($attachment," ' ");			 
			//$data = array("name" => $this->input->post("accountname"));
			$this->Pgsql_model->insertData($_REQUEST);
			$this->Pgsql_model->insertContact($_REQUEST);
			$this->index();
		}
		function deleteRecords($id=''){		
			$this->load->model('Pgsql_model');
			$this->load->helper('form');		
			$this->Pgsql_model->deleteData($id);
			$this->index();
		}
	}
?>