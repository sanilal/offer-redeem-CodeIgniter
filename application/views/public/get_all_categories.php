<?php 
$counter=1;
$cat_arr=array();
foreach( $categories->result()  as $row) {
	$cat_arr[]=array(
			'category_id' => $row->category_id,
			'category_name' => $row->cat_name
	);
	$counter++;  
} 

if($counter > 1) {
	$data_res = array(
			'message' => "Categories found",
			'status'  => "success",
			'categories' => $cat_arr
	);
  
} else {
		$data_res = array(
			'message' => "No Categories available",
			'status'  => "failed"
		);
}

echo json_encode($data_res);
?>