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
          //print_r($value);
          
            $time = "";
            $count = count($value['transactions']);
          echo '<div class="col-sm-12">
                  <div style="padding: 10px;border:solid 1px #eee;border-radius: 4px;border-left: solid 4px #77b711;font-size: 12px;margin-bottom:15px;">
                    <div class="row">
                      <div class="col-sm-2">
                      <div style="padding: 6px;text-align:center;background-color:#f6ffe7;">
                        <h6 style="font-weight:bold"> '.$value['number'].'</h6>
                        Block No.
                      </div>                    
                      </div>
                      <div class="col-sm-7">
                        <h6 style="font-weight:bold;font-size:13px;"> '.$value['transactions'][0].'</h6>
                         '.$value['gasUsed'].' Gas Used,<br/> <b>Difficulty : </b>'.$value['totalDifficulty'].'
                      </div>
                      <div class="col-sm-3">
                        <div style="padding: 10px;font-family: arial;color: #888">
                          '.$count.' Transaction,<br/> <b>Time : </b>'.relativeTime($value['timestamp']/1000000000).'
                        </div>
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

<div class="container">
   <div style="padding: 20px;"></div>
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
