<div id="content">
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> 
              <span class="icon"> 
                <i class="icon-info-sign">
                </i> 
              </span>
              <h3>Convert Long URL to Short
              </h3>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" id="longurl_form_id" method="post">
                <div class="control-group">
                  <label class="control-label">Enter Long URL
                  </label>
                  <div class="controls">
                    <input type="text" name="long_url" id="long_url" required />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" name="submit" id="submit" value="ShortURL" />
		  <button type="button" class="btn-default canclebtn">Reset</button> 
	      </div>
              </form>
              <div class="form-actions">
                <label class="control-label">Short URL
                </label>
                <textarea type="test" name="print_short_url" id="print_short_url" readonly >
                </textarea>
              </div>
            </div>
          </div>
          <div class="widget-box">
            <div class="widget-title"> 
              <span class="icon"> 
                <i class="icon-info-sign">
                </i> 
              </span>
              <h3>Convert Short URL to Long
              </h3>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" id="shorturl_form_id" method="post">
                <div class="control-group">
                  <label class="control-label">Enter short URL
                  </label>
                  <div class="controls">
                    <input type="text" name="short_url" id="short_url" required />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" name="submit" id="submit" value="Longurl" />
		  <button type="button" class="btn-default canclebtnshort">Reset</button> 
                </div>
              </form>
              <div class="form-actions">
                <label class="control-label">Long URL
                </label>
                <textarea type="test" name="print_long_url" id="print_long_url"readonly >
                </textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> 
            <span class="icon"> 
              <i class="icon-th">
              </i> 
            </span>
            <h5>Short URL Table
            </h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped" id="myTable">
              <thead>
                <tr>
                  <th>SL.NO
                  </th>
                  <th>Long URL
                  </th>
                  <th>Short URL
                  </th>
		  <th>Count Long URL Search
                  </th>
		  <th>Count Short URL Search
                  </th>
                  <th>Create Date
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php 
		$i =1;
		if(!empty($record)){
		 foreach ($record as $row){?>
                <tr class="odd gradeX tr-remove">
                  <td>
                    <?php echo $i++;?>
                  </td>
                  <td>
                    <?php echo $row->long_url;?>
                  </td>
                  <td class="center">
                    <?php echo $row->short_url;?>
                  </td>
		  <td class="center">
                    <?php echo $row->long_url_hit_count;?>
                  </td>
		  <td class="center">
                    <?php echo $row->short_url_hit_count;?>
                  </td>
                  <td class="center">
                    <?php echo $row->crt_date;?>
                  </td>
                </tr>
                <?php } }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('superadmin/footer');?>

<script type="text/javascript">
//function is use to send data to controller and after return the result echo in the textbox
    $(function() 
    {
        $("#longurl_form_id").submit(function(e) 
        {
			e.preventDefault();
			var long_url     = $("#long_url").val();
			
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url();?>superadmin/convertLONGURL',
				data: {
						 'long_url': long_url, 
					  },
				async: false,    
				success: function(result)
				{
					$('#print_short_url').val(result);
					$(".tr-remove").remove();
					refreshTable();
				}
			});
        });
    });
   
   //function is use to send data to controller to get the long url from database
  $(function() 
    {
		$("#shorturl_form_id").submit(function(e) 
		{
		  e.preventDefault();
		  var short_url     = $("#short_url").val();
		  $.ajax({
				type: 'POST',
				url: '<?php echo base_url();?>superadmin/getLongURL',
				data: 
				{
				  'short_url': short_url, 
				},
				async: false,    
				success: function(result)
				{
				  $('#print_long_url').val(result);
				  
				}
		    });
		});
    });
  function  refreshTable()//this function is use to auto refesh table and show resntly saved data
    {
		$.ajax({
		  type: 'GET',
		  url: '<?php echo base_url();?>superadmin/getAllDataAjax',
		  success: function(result)
			{
			  $("#myTable").append(result);
			}
		});
    }

	//to reset the form
      $('.canclebtn,.close').click(function(){
      $('#longurl_form_id')[0].reset();
      $('#print_short_url').val('');
      window.location.reload();
    });
	
      $('.canclebtnshort,.close').click(function(){
      $('#shorturl_form_id')[0].reset();
      $('#print_long_url').val('');
      window.location.reload();
  });
	
</script>
