<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\BarchaTovar;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TekshiruvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('tekshiruvchi.thome');
    }
    public function add_products()
    {
        $filials = DB::select('select * from filial');

        return view('tekshiruvchi.add_products',['filials'=>$filials]);
    }
    public function filial_ajax(Request $request)
    {
        $filiali = $request->filiali;
        // $filial_tovar = DB::select("SELECT barcha_tovarlar.tovar_kodi as tkodi,barcha_tovarlar.tovar_nomi as tnomi, $filiali.* FROM barcha_tovarlar LEFT JOIN $filiali ON barcha_tovarlar.tovar_kodi = $filiali.tovar_kodi order by barcha_tovarlar.tovar_nomi asc");
       
        // return $barcha_tovar;
        // session()->pul('filial_nomi');
        // session()->put('filial_nomi',$filiali);
        // return response()->json(['mess'=>$filiali.' Ushbu Filial Tanlandi']);
    }

    // Filial Keladi va Add_productsga malumot yuboriladi
    public function filial_name_send(Request $req)
    {
        $filial_nomi = $req->input('filial_nomi');

        $f_id = DB::table('qoshilgan_tovar')
                        ->where('qoshilgan_sana', '>','2021-12-12')
                        ->latest('faktura_id')                        
                        ->first();
        if($f_id)
        {
            $faktura_id = $f_id->faktura_id +1;
        }
        else{
            $faktura_id = 1;
        }
                               
        $tovar_turi = DB::select("Select * From Tovar_Turi"); 
        $filiali = $filial_nomi.'_tovar';
        // $filial_tovar = DB::select("SELECT barcha_tovarlar.tovar_kodi as tkodi,
        //                             barcha_tovarlar.tovar_nomi as tnomi, $filiali.* FROM 
        //                             barcha_tovarlar 
        //                             LEFT JOIN $filiali ON barcha_tovarlar.tovar_kodi = $filiali.tovar_kodi 
        //                             order by barcha_tovarlar.tovar_nomi asc")->paginate(50);
                                    
                                    $notices = DB::table('barcha_tovarlar')
                                    ->Leftjoin($filiali, 'barcha_tovarlar.tovar_kodi', '=', $filiali.'.tovar_kodi')                                   
                                    ->select('barcha_tovarlar.tovar_nomi','barcha_tovarlar.tovar_kodi',$filiali.'.miqdori',$filiali.'.kirimnarx_uzs',$filiali.'.kirimnarx_usd')
                                    ->paginate(10000);
                                    // $notices = DB::table('barcha_tovarlar')->select('barcha_tovarlar.*')->paginate(99999);
        return view('tekshiruvchi.add_products',['filial_nomi'=>$filial_nomi,'filial_tovar'=>$notices,'tovar_turi'=>$tovar_turi,'faktura_id' => $faktura_id]);
    }

    // Filialni Tanlash Viewga 
    public function filial_change()
    {
        $filials = DB::select('select * from filial');    
       

        return view('tekshiruvchi.filial_change',['filials'=>$filials]);
    }

    public function getProduct(Request $request)
    {
        if ($request->ajax()) {
            
            $params = $request->params;
            $filiali = $params['filial_name']."_tovar";
            
            $data = DB::table('barcha_tovarlar')
                                    ->leftJoin($filiali, 'barcha_tovarlar.tovar_kodi', '=', $filiali.'.tovar_kodi')                                   
                                    ->select('barcha_tovarlar.id','barcha_tovarlar.tovar_nomi','barcha_tovarlar.tovar_kodi',$filiali.'.miqdori',$filiali.'.kirimnarx_uzs',$filiali.'.kirimnarx_usd')
                                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $actionBtn = '<a type="button" class="btn btn-primary text-light btn-sm add_product_btn"  data-id="' . $data->tovar_kodi . '"><i class="dw dw-add"> Qoshish</i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

            
        }                      

        
    }

    public function tur_brend_ajax(Request $req)
    {
        
        $tur_id = $req->tur_id;
        $brend = DB::table('Tovar_Turi')
                    ->leftJoin('Tovar_Brendi','Tovar_Turi.id','=','Tovar_Brendi.tur_id')
                    ->where('Tovar_Turi.id','=',$tur_id)
                    ->select('Tovar_Brendi.b_id','Tovar_Brendi.firma_nomi')                    
                    ->get();
        return $brend;
    }
    public function old_tur_brend_ajax(Request $req)
    {
        $tur_id = $req->tur_qiymati;
        $brend_id=$req->brend_qiymati;
        $marka = $req->marka_qiymati;
        $tovar_kodi = DB::table('barcha_tovarlar')        
        ->latest('tovar_kodi')->first();
        $last_tovar_kodi = $tovar_kodi->tovar_kodi + 1;

        $tur_brend = DB::table('Tovar_Turi')
                        ->leftJoin('Tovar_Brendi','Tovar_Turi.id','=','Tovar_Brendi.tur_id')
                        ->where('Tovar_Turi.id','=',$tur_id)
                        ->where('Tovar_Brendi.b_id','=',$brend_id)   
                        ->select('Tovar_Turi.turi as turi','Tovar_Brendi.firma_nomi as brendi')                     
                        ->get();
        $tovar_nomi = $tur_brend[0]->turi. " " .$tur_brend[0]->brendi. " " .$marka;
        $insert = DB::table('barcha_tovarlar')->insert(
            ['tovar_kodi' => $last_tovar_kodi, 'tovar_nomi' => $tovar_nomi],           
        );
        if($insert)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function old_tur_new_brend_ajax(Request $req)
    {
        
        $tur_id = $req->tur_qiymati;
        $new_brend = $req->new_brend_qiymati;
        $marka = $req->marka_qiymati;
        $insert_new_brend_id = DB::table('Tovar_Brendi')->insertGetId(
            ['firma_nomi' => $new_brend, 'tur_id' => $tur_id]
        );

        if($insert_new_brend_id)
        {
            $tovar_kodi = DB::table('barcha_tovarlar')        
            ->latest('tovar_kodi')->first();
            $last_tovar_kodi = $tovar_kodi->tovar_kodi + 1;


            $tur_brend = DB::table('Tovar_Turi')
            ->leftJoin('Tovar_Brendi','Tovar_Turi.id','=','Tovar_Brendi.tur_id')
            ->where('Tovar_Turi.id','=',$tur_id)
            ->where('Tovar_Brendi.b_id','=',$insert_new_brend_id)   
            ->select('Tovar_Turi.turi as turi','Tovar_Brendi.firma_nomi as brendi')                     
            ->get();
            $tovar_nomi = $tur_brend[0]->turi. " " .$tur_brend[0]->brendi. " " .$marka;
            $insert = DB::table('barcha_tovarlar')->insert(
                ['tovar_kodi' => $last_tovar_kodi, 'tovar_nomi' => $tovar_nomi],           
            );
            if($insert)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    }

    public function new_tur_new_brend_ajax(Request $req)
    {
        // return $req->new_tur_qiymati." ".$req->new_brend_qiymati." ".$req->marka_qiymati;
        $new_tur = $req->new_tur_qiymati;
        $new_brend = $req->new_brend_qiymati;
        $marka = $req->marka_qiymati;
        $insert_tur_id = DB::table('Tovar_Turi')
                            ->insertGetId(
                                ['turi' => $new_tur]
                            );
        if($insert_tur_id)
        {
            $insert_new_brend = DB::table('Tovar_Brendi')
                                ->insert(
                                ['firma_nomi' => $new_brend, 'tur_id'=>$insert_tur_id]
                                );
            if($insert_new_brend)
            {
                $tovar_kodi = DB::table('barcha_tovarlar')        
                                ->latest('tovar_kodi')->first();
                $last_tovar_kodi = $tovar_kodi->tovar_kodi + 1;
                $insert_all = DB::table('barcha_tovarlar')
                                ->insert(
                                [
                                    'tovar_kodi' => $last_tovar_kodi,
                                    'tovar_nomi' => $new_tur. " " .$new_brend. " " .$marka,
                                ]
                                );
                if($insert_all)
                {
                    return response()->json(['tur_id' => $insert_tur_id, 'tur_nomi' => $new_tur]);
                }
                else
                {
                    return false;
                }
            }
        }

    }
    // Qoshilgan Tovar Insert Ajax
    public function qoshilgan_tovar_insert_ajax(Request $req)
    {
        $kirituvchi = Auth::user()->name;
        $arrId = [];

        // $sql = "SELECT SUM(logins_sun + logins_mon) FROM users_stats WHERE id = :ID";
        // $result = DB::select($sql,['ID'=>7]);

       
        $tovar_tartibi = DB::table('qoshilgan_tovar')
                            ->where('filial_nomi', '=', $req->filial_nomi)
                            ->where('faktura_id', '=', $req->faktura_id)
                            ->where('qoshilgan_sana', '>', '2021-12-12')
                            ->latest('tovar_tartibi')
                            ->first();
            $tovar_tartibi_1 = $tovar_tartibi->tovar_tartibi ?? 0;
            $latest_tartib = $tovar_tartibi_1 + 1;
        $arrId['tartibi'] = $latest_tartib;
        
        DB::beginTransaction();

            try {
                $last_id = DB::table('qoshilgan_tovar')
                ->insertGetId([
                    'kelgan_sana'       =>  date('Y-m-d', strtotime($req->kelgan_sana)),
                    'qoshilgan_sana'    =>  date('Y-m-d', strtotime($req->qoshilgan_sana)),
                    'filial_nomi'       =>  $req->filial_nomi,
                    'yetkazib_beruvchi' =>  $req->yetkazib_beruvchi,
                    'tovar_nomi'        =>  $req->tovar_nomi,
                    'tovar_kodi'        =>  $req->tovar_kodi,
                    'miqdori'           =>  $req->miqdori,
                    'kirimnarx_uzs'     =>  $req->narxi_uzs,
                    'kirimnarx_usd'     =>  $req->narxi_usd,
                    'kirituvchi'        =>  $kirituvchi,
                    'faktura_id'        =>  $req->faktura_id,
                    'izox'              =>  $req->izox,  
                    'tovar_tartibi'     =>  $latest_tartib, 
                ]);      
                DB::commit();
                $jami =  DB::table('qoshilgan_tovar')
                            ->select(\DB::raw('SUM(miqdori) as jami_miqdori, SUM(kirimnarx_uzs) as jami_uzs, SUM(kirimnarx_usd) as jami_usd, SUM(miqdori*kirimnarx_uzs) as miq_uzs, SUM(miqdori*kirimnarx_usd) as miq_usd'))
                            ->where('filial_nomi', '=', $req->filial_nomi)
                            ->where('faktura_id', '=', $req->faktura_id)
                            ->where('qoshilgan_sana', '>', '2021-12-12')
                            ->first();
                $arrId['jami_miqdor'] = $jami->jami_miqdori;
                $arrId['jami_uzs']    = $jami->jami_uzs;
                $arrId['jami_usd']    = $jami->jami_usd;   
                $arrId['jami_miqdor_uzs'] = $jami->miq_uzs; 
                $arrId['jami_miqdor_usd'] = $jami->miq_usd; 
                $arrId['last_id'] = $last_id;

                return $arrId;
            } catch (\Exception $e) {
                DB::rollback();
                return false;
            }
        

    }
    // *********Filiallarga Qo'shilgan Tovardan Olib Insert Qilish
    public function filial_tovar_insert_ajax(Request $req)
    {
        $filial_nomi = $req->filial_nomi;
        $faktura_id = $req->faktura_id;
        DB::beginTransaction();
        try 
        {  
            $insert_tovar = DB::table('qoshilgan_tovar')
                    ->where('filial_nomi', '=', $filial_nomi)
                    ->where('faktura_id', '=', $faktura_id)
                    ->where('qoshilgan_sana', '>', '2021-12-12')
                    ->select('qoshilgan_sana','tovar_nomi','tovar_kodi','miqdori','kirimnarx_uzs','kirimnarx_usd')
                    ->get();
                    // $arrTovar = [];
            foreach($insert_tovar as $tkey)
            {
                
                $tekshirish = DB::table($filial_nomi."_tovar")
                                ->where('tovar_kodi', '=',  $tkey->tovar_kodi)
                                ->select('nomi','miqdori','tovar_kodi','sana','kirimnarx_uzs','kirimnarx_usd')
                                ->first();
                if($tekshirish)
                {
                    // Update
                    $update = DB::table($filial_nomi."_tovar") 
                    ->where('tovar_kodi', $tekshirish->tovar_kodi) 
                    ->limit(1) 
                    ->update( [ 
                        'sana' => $tkey->qoshilgan_sana,
                        'miqdori' =>$tekshirish->miqdori + $tkey->miqdori,
                        'kirimnarx_uzs' => $tkey->kirimnarx_uzs,
                        'kirimnarx_usd' => $tkey->kirimnarx_usd,                        
                    ]); 
                    $update_tasdiq1 = DB::table("qoshilgan_tovar") 
                    ->where('tovar_kodi', '=', $tkey->tovar_kodi) 
                    ->where('filial_nomi', '=', $filial_nomi)
                    ->where('faktura_id', '=', $faktura_id)
                    ->where('qoshilgan_sana', '>', '2021-12-12')
                    ->limit(1) 
                    ->update( [ 
                        'tasdiq_status' => 1,
                                               
                    ]); 
                }
                else
                {
                    //Insert
                    $insert = DB::table($filial_nomi."_tovar")
                        ->insert([
                            'sana' => $tkey->qoshilgan_sana,
                            'nomi' => $tkey->tovar_nomi,
                            'miqdori' =>$tkey->miqdori,
                            'tovar_kodi' => $tkey->tovar_kodi,
                            'kirimnarx_uzs' => $tkey->kirimnarx_uzs,
                            'kirimnarx_usd' => $tkey->kirimnarx_usd,
                        ]);
                        
                    $update_tasdiq2 = DB::table("qoshilgan_tovar") 
                    ->where('tovar_kodi', '=', $tkey->tovar_kodi) 
                    ->where('filial_nomi', '=', $filial_nomi)
                    ->where('faktura_id', '=', $faktura_id)
                    ->where('qoshilgan_sana', '>', '2021-12-12')
                    ->limit(1) 
                    ->update( [ 
                        'tasdiq_status' => 1,
                                               
                    ]); 
                }

            }    

            DB::commit();
            return true;
        }         
        catch (\Exception $e) {
            DB::rollback();
            return false;
        }

     }
    // Delete Qo'shilgan Tovar Row
    public function delete_add_tovar_row_ajax(Request $req)
    {
        $row_id = $req->row_id;
        $arrSum = [];
        $delete_query = DB::table('qoshilgan_tovar')
                        ->where('id','=',$row_id)
                        ->delete();
        $jami =  DB::table('qoshilgan_tovar')
        ->select(\DB::raw('SUM(miqdori) as jami_miqdori, SUM(kirimnarx_uzs) as jami_uzs, SUM(kirimnarx_usd) as jami_usd, SUM(miqdori*kirimnarx_uzs) as miq_uzs, SUM(miqdori*kirimnarx_usd) as miq_usd'))
        ->where('filial_nomi', '=', $req->filial_nomi)
        ->where('faktura_id', '=', $req->faktura_id)
        ->where('qoshilgan_sana', '>', '2021-12-12')
        ->first();

        $arrSum['jami_miqdor'] = $jami->jami_miqdori;
        $arrSum['jami_uzs']    = $jami->jami_uzs;
        $arrSum['jami_usd']    = $jami->jami_usd;   
        $arrSum['jami_miqdor_uzs'] = $jami->miq_uzs; 
        $arrSum['jami_miqdor_usd'] = $jami->miq_usd; 

        if($delete_query)
        {
            return $arrSum;
        }
        else
        {
            return false;
        }
    }
}
