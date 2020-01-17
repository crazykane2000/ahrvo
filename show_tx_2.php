<!DOCTYPE html>
<html lang="en">
<head>
  <title>Transaction Radar Scanner</title>
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
<div style="padding: 30px"></div>

<div class="container" style="font-family: 'Poppins', sans-serif;background-color: #fff;box-shadow: 0px 0px 10px #eee;min-height: 700px;">
   <div style="padding:30px;">
    <h6>Transaction Radar Scanner</h6>
    <hr/><div style="padding: 20px;"></div>
    <?php
      $data = file_get_contents("http://13.233.7.230:3003/api/dataManager/get/transactionDetails?_txhash=".$_REQUEST['id']);
      $data = json_decode($data,true);
     // print_r($data);
       ?>
    <table class="table table-striped" style="font-size: 13px" >

      <tr>
        <td sty><b>blockHash</b></td>
        <td><?php echo $data['result']['blockHash']; ?></td>
      </tr>

      <tr>
        <td sty><b>blockNumber</b></td>
        <td><?php echo $data['result']['blockNumber']; ?></td>
      </tr>

      <!-- <tr>
        <td sty><b>contractAddress</b></td>
        <td><?php echo $data['result']['contractAddress']; ?></td>
      </tr> -->

      <tr>
        <td sty><b>cumulativeGasUsed</b></td>
        <td><?php echo $data['result']['cumulativeGasUsed']; ?></td>
      </tr>

      <tr>
        <td sty><b>from</b></td>
        <td><?php echo $data['result']['from']; ?></td>
      </tr>

      <tr>
        <td sty><b>gasUsed</b></td>
        <td><?php echo $data['result']['gasUsed']; ?></td>
      </tr>

      <!-- <tr>
        <td sty><b>logsBloom</b></td>
        <td><div style="word-break: break-word"><?php echo $data['result']['logsBloom']; ?></div></td>
      </tr> -->

      <tr>
        <td sty><b>root</b></td>
        <td><?php echo $data['result']['root']; ?></td>
      </tr>

      <tr>
        <td sty><b>to</b></td>
        <td><?php echo $data['result']['to']; ?></td>
      </tr>

      <tr>
        <td sty><b>transactionHash</b></td>
        <td><?php echo $data['result']['transactionHash']; ?></td>
      </tr>

      <!-- <tr>
        <td sty><b>transactionIndex</b></td>
        <td><?php echo $data['result']['transactionIndex']; ?></td>
      </tr> -->
    </table>
  </div>
  <div style="padding:30px;"></div>
</div>

<div class="modal" id="myModal" style="font-family: 'Poppins'">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" style="font-size: 14px;">Transaction Details</h4>
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
    $('.modal-body').load('data.php',{"data":id}, function(){
        $('#myModal').modal({show:true});
    });
});
</script>
</body>
</html>
