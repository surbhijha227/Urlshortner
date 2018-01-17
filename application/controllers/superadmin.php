<?php

class superadmin extends CI_Controller
    {
	
		public function __construct()
		{ // contructor is used to run default functions
			parent::__construct();
			$this->load->model('superadmin/superadminmodel');
		}
		
		
		public function dashboard()//load view page
		{

			$this->load->view('superadmin/header');
			$this->load->view('superadmin/side_menu');
			$data['record'] = $this->superadminmodel->getAllURL();

			$this->load->view('superadmin/form',$data);
		}

		public function convertLONGURL()//this function is used to convert long url to short url
		{
			$longurl = $this->input->post('long_url');//to get value which send by form
			$upload_result = $this->superadminmodel->shortURL($longurl);//call to model function
			//shortURL function is used to convert long url to short url
			echo $upload_result;//echo return functon which is comes from model
		}
		public function getLongURL()//to call model function for fetching long url from database
		{
			$shorturl = $this->input->post('short_url');//to get value which send by form
			$url = $this->superadminmodel->getlongURL($shorturl);
			echo $url;
		}

		public function getAllDataAjax()//getting the resntly saved data use to auto refesh table
		{
		   
			$data = $this->superadminmodel->getAllURL();
			$i=1;
			foreach($data as $row)
			{
				?>
					<tr class="odd gradeX">
					  <td><?php echo $i++;?></td>
					  <td><?php echo $row->long_url;?></td>
					  <td class="center"><?php echo $row->short_url;?></td>
					  <td class="center"><?php echo $row->long_url_hit_count;?></td>
					  <td class="center"><?php echo $row->short_url_hit_count;?></td>
					  <td class="center"><?php echo $row->crt_date;?></td>
					</tr>

				<?php	
			}
		}

    }	