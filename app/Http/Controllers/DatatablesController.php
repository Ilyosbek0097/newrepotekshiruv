<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\BarchaTovar;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Utilities\Request;

class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('datatables.users');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers(Request $request)
    {
        
        
        
        if ($request->ajax()) {
            
            $params = $request->params;
            $filiali = $params['filial_name']."_tovar";
            
            // $data = DB::select('SELECT barcha_tovarlar.*, buvayda_tovar.kirimnarx_uzs as uzs, buvayda_tovar.kirimnarx_usd as usd,buvayda_tovar.miqdori as miqdori FROM barcha_tovarlar LEFT JOIN buvayda_tovar ON barcha_tovarlar.tovar_kodi = buvayda_tovar.tovar_kodi order by barcha_tovarlar.tovar_nomi asc');
            $data = DB::table('barcha_tovarlar')
                                    ->leftJoin($filiali, 'barcha_tovarlar.tovar_kodi', '=', $filiali.'.tovar_kodi')                                   
                                    ->select('barcha_tovarlar.id','barcha_tovarlar.tovar_nomi','barcha_tovarlar.tovar_kodi',$filiali.'.miqdori',$filiali.'.kirimnarx_uzs',$filiali.'.kirimnarx_usd')
                                    ->get();
            // $data = DB::table('qoshilgan_tovar')->get(['id','tovar_kodi','tovar_nomi','miqdori','kirimnarx_uzs','kirimnarx_usd']);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $actionBtn = '<a href="#tkodi=' . $data->tovar_kodi . '"  class="edit btn btn-success btn-sm"><i class="dw dw-add"> Qoshish</i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

            
        }                      

        
    }
}