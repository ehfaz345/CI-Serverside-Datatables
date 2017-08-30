<?php

  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  // error_reporting(0);

  class Datatables_model extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

    public function dataList($data){

      $column_order = $data['column_order'];
      $column_search = $data['column_search'];
      $order = $data['order'];

      $this->db->select($data['query']['select']);
      $this->db->from($data['query']['from']);
      if(isset($data['query']['join'])){
        if(isset($data['query']['join']['type'])){
          $this->db->join($data['query']['join']['tbl'], $data['query']['join']['cond'], $data['query']['join']['type']);
        }else{
          $this->db->join($data['query']['join']['tbl'], $data['query']['join']['cond']);
        }
      }
      if(isset($data['query']['where'])){
        $this->db->where($data['query']['where']);
      }
      if(isset($data['query']['limit'])){
        $this->db->limit($data['query']['limit']);
      }
      $i = 0;

      foreach ($column_search as $item) // loop column
      {
        if($_POST['search']['value']) // if datatable send POST for search
        {

            if($i===0) // first loop
            {
                $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                $this->db->like($item, $_POST['search']['value']);
            }
            else
            {
                $this->db->or_like($item, $_POST['search']['value']);
            }

            if(count($column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
        }
        $i++;
      }

      if(isset($_POST['order'])) // here order processing
      {
          $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      }
      else if(isset($order))
      {
          $dataOrder = $order;
          $this->db->order_by(key($dataOrder), $dataOrder[key($dataOrder)]);
      }

    }

    function get_datatables($data)
    {
        $this->dataList($data);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
        // echo $this->db->get_compiled_select();
    }

    function count_filtered($data)
    {
        $this->dataList($data);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($data)
    {
        // $this->db->from($this->table);
        // $this->transactionList();
        $this->db->select('*');
        $this->db->from($data['query']['from']);
        if(isset($data['query']['join'])){
          if(isset($data['query']['join']['type'])){
            $this->db->join($data['query']['join']['tbl'], $data['query']['join']['cond'], $data['query']['join']['type']);
          }else{
            $this->db->join($data['query']['join']['tbl'], $data['query']['join']['cond']);
          }
        }
        if(isset($data['query']['where'])){
          $this->db->where($data['query']['where']);
        }
        if(isset($data['query']['limit'])){
          $this->db->limit($data['query']['limit']);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

  }
 ?>
