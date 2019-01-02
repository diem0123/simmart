<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class api_tinh_cuoc_ghtkController extends Controller
{

	public function tinhcuoc(Request $req){
		if (isset($_POST["send"])) {
			$pick_province = $req->pick_province;
			$pick_district = $req->pick_district;
			$province = $req->province;
			$district = $req->district;
			$address = $req->address;
			$weight = $req->weight;

			$data = array(
				"pick_province" => $pick_province,
				"pick_district" => $pick_district,
				"province" => $province,
				"district" => $district,
				"address" => $address,
				"weight" => $weight,
			);
			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_HTTPHEADER => array(
					"Token: 2e6F18B676Db18ffEF95304ED8eae05e83e6086d",
				),
			));

			$response = curl_exec($curl);
			curl_close($curl);

			echo $response;
		}
	}

}

