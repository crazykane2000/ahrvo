<!DOCTYPE html>
<html lang="en">
<head>
  <title>Block Scanner</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <style type="text/css">
        /* 
    Max width before this PARTICULAR table gets nasty
    This query will take effect for any screen smaller than 760px
    and also iPads specifically.
    */
    @media 
    only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px)  {

      /* Force table to not be like tables anymore */
      table, thead, tbody, th, td, tr { 
        display: block; 
      }
      
      /* Hide table headers (but not display: none;, for accessibility) */
      thead tr { 
        position: absolute;
        top: -9999px;
        left: -9999px;
      }
      
      tr { border: 1px solid #ccc; }
      
      td { 
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee; 
        position: relative;
        padding-left: 50%; 
      }
      
      td:before { 
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 45%; 
        padding-right: 10px; 
        white-space: nowrap;
      }
      
      
    }
  </style>
</head>
<body style="background-color: #f4f4f4">
  
    <?php include 'header.php'; ?>

  <div style="background-color: #111;box-shadow: 0px 0px 10px #eee;">
    <div class="container-fluid">
       <div class="row">
         <div class="col-sm-6" style="background-image: url(https://tokyotechie.com/images/slide3elem.png);">
           <div style="padding: 30px"></div>
         </div>
         <div class="col-sm-6">
           <div style="padding: 13px;background-color: #222;margin-top: 30px;border-top-left-radius: 10px">
             <div class="row">
              <div class="col-sm-1"></div>
               <div class="col-sm-5">
                  <div style="padding: 25px;">
                    <div style="border-left: solid 4px #444;padding: 10px">
                      <div style="color: #77b711">Total Transactions</div>
                      <div style="color: #fff;font-size: 24px;">234</div>
                    </div>
                  </div>
               </div>
               <div class="col-sm-5">
                  <div style="padding: 25px;">
                    <div style="border-left: solid 4px #444;padding: 10px">
                      <div style="color: #77b711">Total Blocks</div>
                      <div style="color: #fff;font-size: 24px;">234</div>
                    </div>
                  </div>
               </div>
             </div>
           </div>
         </div>
       </div>
    </div>
  </div>
<div style="padding: 30px"></div>
<div class="container">
  
   <div style="padding: 10px;"></div>
</div>
<div class="container" style="font-family: 'Poppins', sans-serif;background-color: #fff;box-shadow: 0px 0px 10px #eee;">
   <div style="padding:20px;">
    <div class="row">
      <div class="col-sm-6">
        <h6>Block Scanner</h6>
      </div>
      <div class="col-sm-6">
        <a href="show_all_blocks.php" class="btn btn-success btn-sm" style="float: right;">Show All Blocks</a>
      </div>
    </div>
    
    <div style="padding: 10px;"></div>

    <div class="row">
      <?php
      $j=1;
        function relativeTime($time) {
            $d[0] = array(1,"Sec");
            $d[1] = array(60,"Min");
            $d[2] = array(3600,"hr");
            $d[3] = array(86400,"Day");
            $d[4] = array(604800,"W");
            $d[5] = array(2592000,"Mon");
            $d[6] = array(31104000,"Yr");

            $w = array();

            $return = "";
            $now = time();
            $diff = ($now-$time);
            $secondsLeft = $diff;

            for($i=6;$i>-1;$i--)
            {
                 $w[$i] = intval($secondsLeft/$d[$i][0]);
                 $secondsLeft -= ($w[$i]*$d[$i][0]);
                 if($w[$i]!=0)
                 {
                    $return.= abs($w[$i]) . " " . $d[$i][1] . (($w[$i]>1)?'s':'') ." ";
                 }

            }
            $return .= ($diff>0)?"ago":"left";
            return $return;
        }
        $data = file_get_contents("http://13.233.7.230:3003/api/dataManager/explorer");
        $data = json_decode($data,true);
        foreach ($data as $key => $value) {
          if ($j>4) {
              continue;
            }
            $time = "";
            $count = count($value['transactions']);
          echo '<div class="col-sm-3">
                  <div style="padding: 10px;border:solid 1px #eee;border-radius: 4px;border-left: solid 4px #77b711;font-size: 12px;">
                    <div style="padding: 6px;">
                      <a href="show_block.php?block_id='.$value['number'].'" style="color:#333"><h6>Block : '.$value['number'].'</h6></a>
                    </div>
                    <div style="padding: 10px;background-color: #f5f5f5;font-family: arial;color: #888">
                      '.$count.' Transaction, '.relativeTime($value['timestamp']/1000000000).'
                    </div>
                  </div>
                </div>';
                $j++;
        }
       ?>
      
    </div>
    
    
  </div>
  <div style="padding:30px;"></div>
</div>

<div class="container">
   <div style="padding: 20px;"></div>
</div>
<div class="container" style="font-family: 'Poppins', sans-serif;background-color: #fff;box-shadow: 0px 0px 10px #eee;">
   <div style="padding:20px;">
    <div class="row">
      <div class="col-sm-6">
        <h6>Transactions</h6>
      </div>
      <div class="col-sm-6">
        <a href="show_all_tx.php" class="btn btn-success btn-sm" style="float: right;">Show All Transactions</a>
      </div>
    </div>
    
    <div style="padding: 10px;"></div>

    <div class="row">
      <?php
      $j=1;
        
        foreach ($data as $key => $value) {
          if ($j>10) {
              continue;
            }
            $time = 
            $count = count($value['transactions']);
            //print_r($value);

            $data = file_get_contents("http://13.233.7.230:3003/api/dataManager/get/transactionDetails?_txhash=".$value['transactions'][0]);
            $data = json_decode($data,true);
            //print_r($data);

          echo '<div class="col-sm-12" style="margin-top:13px;">
                  <div style="padding: 10px;border:solid 1px #eee;border-radius: 4px;border-left: solid 4px #b1cffd;font-size: 12px;">
                    <div class="row">
                      <div class="col-sm-9">
                        <div style="padding: 6px;">
                          <a href="show_tx_2.php?id='.$data['result']['transactionHash'].'"><h6 style="cursor:pointer;color:#007bff;word-break: break-all;font-size:15px;" class="openBtn" data-id="'.$value['number'].'" >'.$value['blockHash'].'</h6></a>
                        </div>
                        <div style="padding: 10px;background-color: #f5f5f5;font-family: arial;color: #888">
                          '.$data['result']['from'].' >  '.$data['result']['to'].'<br/>

                          <b>Gas Used </b> : '.$data['result']['gasUsed'].', <b>Tx Fees </b> : '.$data['result']['cumulativeGasUsed'].'
                        </div>
                      </div>
                      <div class="col-sm-3" style="text-align:right">
                        <h6><span style="color:#999">Block # : </span>'.$value['number'].'</h6> '.relativeTime($value['timestamp']/1000000000).'
                      </div>
                    </div>
                  </div>
                </div>';
                $j++;
        }
       ?>
      
    </div>
    
    
  </div>
  <div style="padding:30px;"></div>
</div>

<div class="modal" id="myModal" style="font-family: 'Poppins'">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" style="font-size: 14px;">Block Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="font-size: 12px;">
        <img src="jui.gif" style="width: 90%">
      </div>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>


<script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
        "order": [[ 3, "desc" ]]
    } );
  } );
</script>



<script>
$('.openBtn').on('click',function(){
    var id = $(this).data("id");
    //alert(id);
    $('.modal-body').load('data2.php',{"data":id}, function(){
        $('#myModal').modal({show:true});
    });
});
</script>
</body>
</html>
