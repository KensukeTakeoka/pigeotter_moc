<?php
 // アクセスカウンタ１

$fp = @fopen("counter1.txt", "r+") or die("Counter Error");
 flock($fp, LOCK_EX);
 $count = fgets($fp);
 $count++;
 rewind($fp);
 fputs($fp, $count);
 fclose($fp);

 $sql = sprintf('INSERT INTO members SET count=%d',
 	mysqli_real_escape_string($db, $count)
			);

 		mysqli_query($db, $sql) or die(mysqli_error($db));

		// echo $sql;

 print $count;
 ?>