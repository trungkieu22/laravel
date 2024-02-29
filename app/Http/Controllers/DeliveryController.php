<?php

namespace App\Http\Controllers;
use App\Models\city;
use App\Models\province;
use App\Models\wards;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\feeship;


class DeliveryController extends Controller
{
	public function update_delivery(Request $request){
		$data = $request->all();
		$fee_ship = Feeship::find($data['feeship_id']);
		$fee_value = rtrim($data['fee_value'],'.');
		$fee_ship->fee_feeship = $fee_value;
		$fee_ship->save();
	}
   



   public function select_feeship(){
	$feeship = feeship::orderBy('fee_id', 'desc')->get();
	$output = '';
	$output .= '<div class="table-responsive">  
		<table class="table table-bordered">
			<thread> 
				<tr>
					<th>Tên thành phố</th>
					<th>Tên quận huyện</th> 
					<th>Tên xã phường</th>
					<th>Phí ship</th>
				</tr>  
			</thread>
			<tbody>
			';

			foreach($feeship as $key => $fee){

			$output.='
				<tr>
					<td>'.$fee->city->name_city.'</td>
					<td>'.$fee->province->name_quanhuyen.'</td>
					<td>'.$fee->wards->name_xaphuong.'</td>
					<td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
				</tr>
				';
			}

			$output.='		
			</tbody>
			</table></div>
			';

			echo $output;
   }



    public function insert_delivery(Request $request){
		$data = $request->all();
		$fee_ship = new FeeShip();
		$fee_ship->fee_matp = $data['city'];
		$fee_ship->fee_maqh = $data['province'];
		$fee_ship->fee_xaid = $data['wards'];
		$fee_ship->fee_feeship = $data['fee_ship'];
		$fee_ship->save();


	}




    public function delivery(Request $request){

        $city = DB::table('tbl_tinhthanhpho')->orderBy('matp', 'asc')->get();
        return View('admin.delivery.add_delivery')->with(compact('city'));

 
    }
    public function select_delivery(Request $request){
		$data = $request->all();
		if($data['action']){
			$output = '';
			if($data['action'] == "city"){
				
				$select_province = province::where('matp',$data['ma_id'])->orderBy('maqh','asc')->get();
				$output.='<option>--Chọn Quận Huyện---</option>';
				foreach($select_province as $key => $province){
				$output.= '<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
				}
			}else{
				$select_wards = wards::where('maqh',$data['ma_id'])->orderBy('maqh','asc')->get();
				$output.='<option>--chon Phường Xã---</option>';
				foreach($select_wards as $key => $ward){
				$output.= '<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
				}

			}
		}
        echo $output;
	}
}
