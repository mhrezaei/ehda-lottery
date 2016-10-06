<?php
class Names_model extends CI_Model
{
	private	$tName	= 'names' 		;

	public function __construct()
	{
		$this->load->database() ;
	}

	public function insert($code , $name)
	{
		$data = compact('name','code');

		$this->db->where('code', $code);
		$data['repeated'] = $this->db->get($this->tName)->num_rows();
		$this->db->insert($this->tName,$data);

		return $data['repeated'] ;
	}

	public function dropAll()
	{
		$tName = $this->tName;
		$this->db->query("DELETE FROM `$tName`");
	}

	public function find($code)
	{
		$this->db->where('code', $code);
		return $this->db->get($this->tName);
	}

	public function save($code){
		$this->db->where('code', $code);
		$this->db->update($this->tName,['chosen'=>1]) ;
	}
}
?>