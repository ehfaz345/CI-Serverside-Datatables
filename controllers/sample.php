<?php

  class Sample extends CI_Controller{

    function __construct(){
  		parent::__construct();
  		$this->load->model('Datatables_model');
  	}

    public function datatablesServerSide(){

      $merchID = 1;
      //This array contains the data that is being passed into the datatables model
      //The indexes here are not all the conditions that the datatables model can handle,
      //viewing the model file itself will further explain the usage and indexes placed here

      $dataTable = array(
  			'column_order' => array('trxID', 'userID', 'userID', 'tStamp', 'amount', 'status'),
  			'column_search' => array('trxID', 'userID', 'userID', 'tStamp', 'amount', 'status'),
  			'order' => array('tStamp' => 'desc'),
  			'query' => array(
  				'select' => '*',
  				'from' => 'transactions',
  				'where' => "merchantID = ".$merchID
  			)
  		);

  		$list = $this->datatables_model->get_datatables($dataTable);
  		// echo $list;
  		$data = array();
      $no = $_POST['start'];
      $i = 0;

  		foreach($list as $item){
  			$no++;
        $row = array();
        //Here, the rows are the rows obtained from the datatables model,
        //where the output is a standard object output obtained from a CI active record
        //result() function
        
  			$row[] = $item->trxID;
  			$row[] = $item->userID;
  			$customerName = "John Smith";
  			$row[] = $customerName;
  			$row[] = $item->tStamp;
  			$row[] = "<strong>".$item->amount."</strong>";

  			$status = $item->status;
  			if($status == 1){
  				$row[] = "<i class = 'fa fa-check text-success'> Success</i>";
  			}else{
  				$row[] = "<i class = 'fa fa-times text-danger'> Fail</i>";
  			}

  			$data[] = $row;
        $i++;
  		}

  		$output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->datatables_model->count_all($dataTable),
                      "recordsFiltered" => $this->datatables_model->count_filtered($dataTable),
                      "data" => $data,
              );
      echo json_encode($output);

      //For viewing the exact JSON reponse required by the datatables plugin, the output can be
      //cleverly echoed out to a browser, for debugging and understanding reasons. However, following
      //the format laid out here exactly will definitely give the desired response.

    }

  }


 ?>
