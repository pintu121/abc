<?php use_helper('Javascript') ?>
<table>
<tbody>
<tr>
	<td>Server Time</td>
	<td><?php echo date('d M,Y H:i:s',time()); ?></td>
</tr>
<tr>
	<td>Downloads Today</td>
	<td><?php
	$con = Propel::getConnection();
  $sql = "SELECT SUM(today) FROM files";
  $rs = $con->executeQuery($sql, ResultSet::FETCHMODE_NUM);
  $rs->next();
  echo $rs->getString(1);
	?></td>
</tr>
</tbody>
</table>