<?php 
$counter=1;
$offer_arr=array();
foreach( $offers->result()  as $row) {
	$location=explode(",",$row->location);
	$offer_arr[]=array(
			'offer_id' => $row->offer_id,
			'offer_title' => $row->title,
			'is_featured' => $row->featured,
			'offer_img_path'  => base_url()."image_upload/".$row->main_img,
			'normal_price' => $row->price,
			'offer_price' => $row->off_price,
			'offer_longitude' => $location[0],
			'offer_latitude' => $location[1],
			'small_description' => implode(' ', array_slice(str_word_count(strip_tags($row->offer_desc), 2), 0, 15)),
			'offer_points' => $row->offer_points
	);
	$counter++;  
} 

if($counter > 1) {
	$data_res = array(
			'message' => "Offers found",
			'status'  => "success",
			'offers' => $offer_arr
	);
  
} else {
		$data_res = array(
			'message' => "No offers available",
			'status'  => "failed"
		);
}

echo json_encode($data_res);
?>