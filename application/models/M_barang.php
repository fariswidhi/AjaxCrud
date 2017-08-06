<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {


	function getData($id =null){
		if ($id ==null) {
		$data = $this->db->get('tb_barang');
		}
		else{
		$data = $this->db->get_where('tb_barang',array('id_barang'=>$id));
		}
		return $data;
	}

	function insert($barang,$harga){
		$data = array('barang'=>$barang,'harga'=>$harga);

		return $this->db->insert('tb_barang', $data);
	}
	function update($id,$barang,$harga){
		$data = array('barang'=>$barang,'harga'=>$harga);
		$where = array('id_barang'=>$id);
		return $this->db->update('tb_barang', $data,$where);
	}
	function delete($id){
		$where = array('id_barang'=>$id);
		return $this->db->delete('tb_barang',$where);
	}

}

/* End of file M_barang.php */
/* Location: ./application/models/M_barang.php */