<!DOCTYPE html>
<html lang="en">
<head>
  <title>Transaction Scanner</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
</head>
<body style="background-color: #f4f4f4">
<div style="padding: 30px"></div>
<div class="container">
   <img src="aa.png" style="width: 100px">
   <div style="padding: 10px;"></div>
</div>
<div class="container" style="font-family: 'Poppins', sans-serif;background-color: #fff;box-shadow: 0px 0px 10px #eee;">
   <div style="padding:30px;">
    <h3>Transaction Scanner</h3>
    <hr/><div style="padding: 20px;"></div>
    <?php
      $data = file_get_contents("http://13.233.7.230:3003/api/dataManager/explorer");
      $data = json_decode($data,true);
      //print_r($data);
       ?>
    <table class="table table-striped" style="font-size: 13px" id="example">
      <thead>
        <tr>
          <th>Tx Number</th>
          <th>Tx. Hash</th>
          <th>timestamp</th>
          <th>gas</th>
          <th>time</th>
        </tr>
      </thead>
      <tbody>
        <?php 
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

          foreach ($data as $key => $value) {
            echo '<tr>
                  <td>'.$value['number'].'</td>
                  <td><span style="color:#0276d2" title="'.$value['hash'].'">'.substr($value['hash'],30).'...</span></td>
                  <td>'.relativeTime($value['timestamp']/1000000000).'</td>
                  <td>'.$value['gas'].'</td>
                  <td>'.$value['time'].'</td>                
                </tr>';
          }
         ?>
        
       
      </tbody>
    </table>
  </div>
  <div style="padding:30px;"></div>
</div>
<script   src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script><script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</body>
</html>
