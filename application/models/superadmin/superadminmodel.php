<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class superadminmodel extends CI_Model 
	{

		public function shortURL($url)//this function is use to generate short url
		{
		  $crt_date = date('Y-m-d H:i:s');
		  $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

			$key = 'abc'; // Salt 
			$urlhash = md5($key . $url);
			$len = strlen($urlhash);
		 
			// The encrypted string is divided into 4 paragraph ， Each section 4 byte ， Calculate each segment ， A total of four sets of short connections can be generated 
			for ($i = 0; $i < 4; $i++) 
			{
			  $urlhash_piece = substr($urlhash, $i * $len / 4, $len / 4);
			  
			  // Position and segment 0x3fffffff Make a bit ，0x3fffffff Representing a binary number 30 individual 1， That is 30 After the encryption string is zero 
			  // Here need to use hexdec() take 16 Hex string 10 Decimal numeric type ， Otherwise, the operation will not be normal 
			  $hex = hexdec($urlhash_piece) & 0x3fffffff;
		 
			  // Domain name based on demand 
			  $short_url = "http://url.cn/";
			  
			  // generate 6 Bit short URLs 
			  for ($j = 0; $j < 6; $j++) 
			    {
				
					// Will get the value of 0x0000003d,3d by 61， That is charset Coordinate maximum 
					$short_url .= $charset[$hex & 0x0000003d];
					
					// After the cycle. hex Right 5 position 
					$hex = $hex >> 5;
			    }
		 
			  $short_url_list[] = $short_url;
			  $short_url1 = $short_url_list[0];

			}
			//to check unique url
			$this->db->select('COUNT(0) as urls');
			$this->db->from('shorted_url');
			$this->db->where('long_url',$url);
			$query = $this->db->get();
			$row = $query->row();
			$count = $row->urls; 
			if($count ==0)
			{
		 
			$insert = array(
							"long_url"  =>$url,
							"short_url" =>$short_url1,
							"crt_date"  =>$crt_date
						   );
			    $this->db->insert("shorted_url",$insert);//insert to database
				$final_result = $this->db->trans_complete();
			    echo $short_url1;
			}
		 else
			{
				//update long url hit count and fetch short url from database
			   $query1 = $this->db->query("update shorted_url set long_url_hit_count=long_url_hit_count+1 where long_url='$url'");
			   $query = $this->db->query("SELECT url_id,short_url FROM shorted_url where long_url='$url'");
			   $row=$query->row();
			   echo $row->short_url;
			}
				
		}

		public function getlongURL($shorturl)//this function is use to update count and fetch long url
		{
			   $query1 = $this->db->query("update shorted_url set short_url_hit_count=short_url_hit_count+1 where short_url='$shorturl'");
				//query1 is for update count of short url.
			   $query = $this->db->query("SELECT url_id,long_url,short_url_hit_count FROM shorted_url where short_url='$shorturl'");
			   //query is for fetch long url.
			   $row=$query->row();
			   return $row->long_url;
		}

		public function getAllURL()//this function is use to fetch all values from database
			{
				$query = $this->db->query("SELECT * FROM shorted_url");
				return $query->result();
			}

    }