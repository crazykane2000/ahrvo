<?php
	$data = file_get_contents("http://13.233.7.230:3003/api/dataManager/explorer");
    $data = json_decode($data,true);
    //print_r($data);
    $datav = array();
    foreach ($data as $key => $value) {
    	if ($_REQUEST['data']==$value['number']) {
    		$datav = $value;
    	}
    }
 ?>

 <table class="table">
 	<tr>
 		<td style="background-color: #f5f5f5">Block No.</td>
 		<td><?php echo $datav['number']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">Block Difficulty</td>
 		<td><?php echo $datav['blockDifficulty']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">Tx Hash</td>
 		<td><a href="show_tx_2.php?id=<?php echo $datav['transactions'][0]; ?>"><?php echo $datav['transactions'][0]; ?></a></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">GasLimit</td>
 		<td><?php echo $datav['gasLimit']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">blockHash</td>
 		<td style="word-break: break-all"><?php echo $datav['blockHash']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">parentHash</td>
 		<td><?php echo $datav['parentHash']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">receiptsRoot</td>
 		<td><?php echo $datav['receiptsRoot']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">sha3Uncles</td>
 		<td><?php echo $datav['sha3Uncles']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">size</td>
 		<td><?php echo $datav['size']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">stateRoot</td>
 		<td><?php echo $datav['stateRoot']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">totalDifficulty</td>
 		<td><?php echo $datav['totalDifficulty']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">transactionsRoot</td>
 		<td><?php echo $datav['transactionsRoot']; ?></td>
 	</tr>

 	<tr>
 		<td style="background-color: #f5f5f5">time</td>
 		<td><?php echo $datav['time']; ?></td>
 	</tr>


 </table>