<?php
	$db = new PDO("mysql:dbname=pos", "root", "root");

	$month = $_GET["month"];
		$year = $_GET["year"];
		$tmp = $year.$month;
		$count = 1;
		$rows = $db->query("select date_format(date, '%d') as year, sum(sale) as price from sales where date_format(date, '%Y%m') = '201711' group by year order by year asc");
		
		header("Content-type: application/json");

		echo "{\n  \"list\": [\n";

		foreach($rows as $res){
			if($count == $rows->rowcount()){
				$arr = array();
				$arr["day"] = $res["year"];
				$arr["price"] = $res["price"];
				echo "\t".json_encode($arr)."\n";
				$count++;
			}else{
				$arr = array();
				$arr["day"] = $res["year"];
				$arr["price"] = $res["price"];
				echo "\t".json_encode($arr).",\n";
				$count++;
			}
		}
		
		echo "  ]\n}\n";
?>