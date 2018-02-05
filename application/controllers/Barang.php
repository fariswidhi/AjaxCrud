<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_barang');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function get($id = null){

		if ($id !=null) {
		$data = $this->M_barang->getData($id);
		}
		else{
			$data = $this->M_barang->getData();
		}

		echo json_encode($data->result_object());

	}

	public function edit($id){
		$data = $this->M_barang->getData($id)->result_object();

		// }
		// else{

			$this->load->view('edit',array('data'=>$data));
		// }
	}
	function add(){
					$this->load->view('insert');
	}

	public function update($id){
				if ($this->input->post()) {
			$barang = $this->input->post('barang');
			$harga = $this->input->post('harga');
			// echo $barang;
			$insert = $this->M_barang->update($id,$barang,$harga);
			if ($insert > 0) {
				$result = 200;
			}
			else{
				$result = 0;
			}
			echo json_encode(array("result"=>$result));
	}
}

	public function insert(){
				if ($this->input->post()) {
			$barang = $this->input->post('barang');
			$harga = $this->input->post('harga');
			// echo $barang;
			$insert = $this->M_barang->insert($barang,$harga);
			if ($insert > 0) {
				$result = 200;
			}
			else{
				$result = 0;
			}
			echo json_encode(array("result"=>$result));
	}
}
	public function delete($id){

			$delete = $this->M_barang->delete($id);
			if ($delete > 0) {
				$result = 200;
			}
			else{
				$result = 0;
			}
			echo json_encode(array("result"=>$result));
	}


}
