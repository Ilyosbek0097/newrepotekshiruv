@extends('layouts.tekshiruv')
@section('title','Add Products')
@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Tovar Qo'shish</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Bosh Sahifa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tovar Qo'shish</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <input type="hidden" id="filiali_nomi" value="{{ $filial_nomi }}" name="fil">
                       <span  class="btn btn-success text-uppercase">Filial :</span>
                       <a id="filial_change" type="button" class="btn btn-primary text-light" role="{{ $filial_nomi ?? '' }}">{{ strtoupper($filial_nomi ?? '') }}</a>
                    </div>
                </div>
            </div>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <h4 class="text-blue h4">Tovar Qo'shish</h4>
                    {{-- <p class="mb-30">E'tiborli bo'ling</p> --}}
                </div>
                <div class="wizard-content">
                    <form class="tab-wizard wizard-circle wizard">
                        <h5>Faktura Ma'lumoti</h5>
                        <section>
                            <div class="row">
                                <div class="offset-md-4"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Faktura ID:</label>
                                        <input id="faktura_id" name="faktura_id" required="1" class="form-control" value="{{ $faktura_id }}" readonly='1'>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-md-2"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Faktura Kelgan Sana:</label>
                                        <input id="kelgan_sana" name="kelgan_sana" required="1" readonly="1" class="datepicker-here form-control" data-language="ru">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Kiririlayotgan Sana:</label>
                                        <input id="qoshilgan_sana" type="text" class="form-control" name="qoshilgan_sana" value="<?=Date('d.m.Y')?>" readonly='1'>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5 mt-5"></div>
                            <div class="row">
                                <div class="offset-md-4"></div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Yetkazib Beruvchi:</label>
                                        <input id="yetkazib_beruvchi" type="text" class="form-control" name="yetkazib_beruvchi">
                                    </div>
                                </div>                            
                            </div>                            
                        </section>
                        <!-- Step 2 -->
                        <h5>Tovar Qo'shish</h5>
                        <section>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">                                   
                                    <button type="button" class="btn btn-primary text-center form-control text-light" id="new_product_button">Yangi Tovar Qo'shish</button>
                                </div>
                                <div class="col-md-12 mt-4" style="display: none" id="new_product_blog">
                                    <div class="container">
                                        <div class="row">                                               
                                            <div class="col-sm-6"> 
                                                <div class="input-group"> 
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text bg-info text-light" for="inputGroupSelect04">Tovar Turi</label>
                                                      </div> 
                                                    <select class="custom-select2 tovar_turi" style="width: 50%"  name="tur"  id="inputGroupSelect04">
                                                        <option selected value="">---Tovar Turi---</option>
                                                        @foreach ($tovar_turi as $turi)
                                                            <option value="{{ $turi->id }}">{{ $turi->turi }}</option>                                                            
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="new_tur_add" type="button"><span class="dw dw-add"></span></button>
                                                    </div>                                                                                                      
                                                </div>
                                                {{-- New Tur Input --}}
                                                <div class="input-group mb-3" style="display: none" id="new_tur_block">    
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text bg-success text-light">Yangi Tovar Turi</label>
                                                    </div>                                                 
                                                    <input type="text" class="form-control" placeholder="Yangi Tur Qo'shish" aria-label="" aria-describedby="basic-addon1" id="new_tur_id">
                                                    {{-- <div class="input-group-append" id="brend_ptichka">
                                                         <button class="btn btn-success" type="button"><i class="icon-copy dw dw-tick"></i></button>
                                                    </div> --}}
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-6" id="t_brend"> 
                                                <div class="input-group" id="brend_div"> 
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text bg-info text-light" for="inputGroupSelect03">Tovar Brendi</label>
                                                      </div> 
                                                    <select class="custom-select2 tovar_brendi" style="width: 50%" name="brend"  id="inputGroupSelect03">
                                                        <option value="">---Tovar Brendi---</option>                                                        
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="new_brend_add" type="button"><span class="dw dw-add"></span></button>
                                                    </div>                                                                                                      
                                                </div>
                                                {{-- New Brend Input --}}
                                                <div class="input-group mb-3" style="display: none" id="new_brend_block"> 
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text bg-success text-light">Yangi Tovar Brendi</label>
                                                      </div>                                                    
                                                    <input type="text" class="form-control"  aria-describedby="basic-addon1" id="new_brend_id" placeholder="Yangi Brend Qo'shish"> 
                                                    {{-- <div class="input-group-append" id="brend_ptichka">
                                                        <button class="btn btn-success" type="button"><i class="icon-copy dw dw-tick"></i></button>
                                                      </div> --}}
                                                  </div>
                                                                                           
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="offset-sm-3 col-sm-6" id="t_marka">
                                                <div class="input-group mb-3">   
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text bg-info text-light">Tovar Markasi</label>
                                                      </div>                                                  
                                                    <input type="text" class="form-control tovar_markasi" placeholder="Tovar Markasini Kiriting" aria-label="" aria-describedby="basic-addon1">                                                    
                                                  </div>
                                            </div>											
                                        </div>	
                                        <div class="row mt-1">
                                            <div class="offset-sm-2">

                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <button type="button" id="new_product_insert" class="btn btn-success text-light form-control">Tasdiqlash</button>
                                                </div>
                                            </div>                                                                                  
                                        </div>									
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped datatable" id="myTable" style="width:100%!important">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Tovar Kodi</th>
                                                <th>Nomi</th>
                                                <th>Miqdori</th>
                                                <th>USD</th>
                                                <th>UZS</th>
                                                <th>Action</th>                                           
                                            </tr>
                                        </thead> 
                                        <tbody>
                                        </tbody>
                                    </table>                                    
                                </div>      
                            </div>
                        </section>
                       
                        <h5>Tekshiruv</h5>
                        <section>
                            <div class="row">
                                <div class="offset-md-3">
                                </div>
                                <div class="col-md-6">
                                    <h4  class="text-success text-center alert alert-info">
                                        Faktura Nomeri:                                    
                                        <span id="tekshir_faktura_id"></span>
                                    </h4>
                                    
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table" id="tekshiruv_table">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Nomi</th>
                                                <th>Miqdori</th>
                                                <th>Narxi $</th>
                                                <th>Narxi UZS</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- <tr>
                                                <td>1</td>
                                                <td>Telefon Samsung A10 S</td>
                                                <td>5</td>
                                                <td>258 $</td>
                                                <td>0 UZS</td>
                                                <td><button class="btn btn-danger">Delete</button></td>
                                            </tr> --}}
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                               <td>#</td>
                                               <td id="jami_muzs"></td>
                                               <td id="jami_miqdori"></td>
                                               <td id="jami_usd"></td>
                                               <td id="jami_uzs"></td>
                                               <td id="jami_musd"></td>
                                            </tr>
                                        </tfoot> 
                                    </table>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>

          

            <!-- success Popup html Start -->
            <div class="modal fade" id="success_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center font-18">                            
                            <h3 class="mb-20">Ma'lumotlarni Tasdiqlash!</h3>
                            <div class="mb-30 text-center"><img src="vendors/images/success.png"></div>
                            Kiritilgan Malumotlarni To'g'riligiga Ishonchingiz Komilmi!
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-primary" id="btnsuccess">Tasdiqlash</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- success Popup html End -->
            {{-- Add Product Large Modal --}}           
                 
            <div class="col-md-4 col-sm-12 mb-30">				
                <div class="modal fade bs-example-modal-lg" id="add_tovar_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Tovar Qo'shish Oynasi</h4>
                                <button title="Chiqish" onclick="ClearElementValue()" type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="dw dw-exit"></span></button>
                            </div>
                            <div class="modal-body">
                                
                                <div class="container" id="modal_element">
                                    <div class="row">
                                        <div class=" offset-sm-4 col-sm-4">
                                            <div class="form-group">
                                                <label style="text-transform: uppercase; color: green; text-indent: 15px; font-family: monospace; font-weight: 800;">Tovarning Shtrix Kodi</label>
                                                <input required="1" type="text" id="tovar_code" class="form-control text-sm-center text-danger font-weight-bold" readonly="1" readonly="1"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tovarning To'liq Nomi</label>
                                                <input required="1" type="text" id="tovar_nomi" class="form-control text-sm-center font-weight-bold" readonly="1" readonly="1"> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Kirim Narxi: <span class="text-danger font-weight-bold">So'mda</span> <span id="uzs_null" class="badge badge-warning">125</span></label>													
                                                <input required="1" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="narx_uzs" required="required" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Kirim Narxi: <span class="text-success font-weight-bold">Dollorda</span> <span id="usd_null" class="badge badge-success">0</span></label>													
                                                <input required="1" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  id="narx_usd" required="required" class="form-control">																
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tovar Qoldig'i <span id="qoldiq_null" class="badge badge-info"></span></label>
                                                <input readonly="1" required="1" class="form-control" type="text" id="tovar_qoldiq">
                                            </div>
                                        </div>	
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Qo'shilayotgan miqdor</label>
                                                <input required="1" class="form-control text-uppercase"  type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="add_miqdor">
                                            </div>
                                        </div>										
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Izox</label>
                                                <textarea class="form-control border border-primary" id="izox"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" id="chiq1" onclick="ClearElementValue()" class="btn btn-secondary" data-dismiss="modal">Chiqish</button>
                                <button type="button" id="saqlash" class="btn btn-primary">Saqlash</button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
            {{-- Large Modal End --}}
        </div>
        
</div>

@endsection
@section('scripts')
<script type="text/javascript">
   
    $(function () {  
        const vArr = {};
        // Ajax Setup Laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        });  
        // **************Yakunlash Ishlari Start********************
        // if ( window.history.replaceState ) {
        // window.history.replaceState( null, null, window.location.href );
        // }
       
        $("#btnsuccess").click(function(){
            $("#btnsuccess").attr("data-dismiss",'modal');
            $.ajax({
                type: "GET",
                url: "{{ route('tekshiruv.filial_tovar_insert_ajax') }}",
                data: {
                    'filial_nomi': $("#filiali_nomi").val(),
                    'faktura_id': $("#faktura_id").val(),
                },
                dataType: "JSON",
                success: function (response) {
                    if(response == true)
                    {
                        swal
                        ({
                            type: 'success',
                            title: 'Tabriklaymiz!',
                            text: "Malumotlar Bazaga Kiritildi!",
                            timer: 1500,
                        })
                        window.location.href = "{{ route('tekshiruv.filial_change')}}";
                    }
                    else
                    {
                        swal
                        ({
                            type: 'error',
                            title: 'Xatolik',
                            text: "Xatolik Sodir Bo'ldi!",
                            timer: 1700,
                        })

                    }
                }
            });

        });
        $('a[href="#finish"]').click(function(){
            $("#success-modal").removeClass('modal');
            var rowCount = $('#tekshiruv_table >tbody >tr').length;
            if(rowCount > 0)
            {
               
                var faktura_id = $("#faktura_id").val();
                var filiali_nomi= $("#filiali_nomi").val();
                
                if(faktura_id != "" && filiali_nomi != "")
                {
                    $("#success-modal").addClass('modal');
                    $('a[href="#finish"]').attr('data-toggle','modal');
                    $('a[href="#finish"]').attr('data-target','#success_modal');
                }
                else
                {
                    
                    swal
                    ({
                        type: 'error',
                        title: 'Xatolik',
                        text: "Filial Yoki Faktura ID Mavjud Emas!",
                        timer: 1700,
                    })
                }
            }
            else
            {
                
                swal(
                    {
                    type: 'error',
                    title: 'Xatolik',
                    text: "Siz Hali Tovar Kiritmadingiz!",
                    timer: 1700,
                    }
                )
            }
        
            
        });
        // **************Yakunlash Ishlari End********************



        //****************Add_Product_Modal******************

        //***************TEKSHIRUV_TABLE_Ishlar************       
        
        $(document).on('click','.del_btn',function(e){
            e.preventDefault();
            var row_id = $(this).data('id');
            swal({
            title: "E'tibor bering !",
            text: "Rostdan Ham Ushbu Qatorni O'chirmoqchimisiz!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Tasdiqlash',
            cancelButtonText: "Bekor Qilish",             
			})
			.then((willDelete) => {
			  if (willDelete['value'] == true ) 
              {
                    $.ajax({
                    type: "GET",
                    url: "{{ route('tekshiruv.delete_add_tovar_row_ajax') }}",
                    data: {
                        'row_id':row_id,
                        'filial_nomi': $("#filiali_nomi").val(),
                        'faktura_id': $("#faktura_id").val(),
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if(response)
                        { 
                            $('#tekshiruv_table tr[data-id="'+row_id+'"]').remove();
                            $("#jami_miqdori").html('Jami_Miqdori: '+response['jami_miqdor']);
                            $("#jami_usd").html('Jami_Dollarda: '+response['jami_usd']);
                            $("#jami_uzs").html("Jami_So'mda: "+response['jami_uzs']);
                            $("#jami_muzs").html("Miqdori*So'm: "+response['jami_miqdor_uzs']);
                            $("#jami_musd").html("Miqdori*Dollar: "+response['jami_miqdor_usd']);
                            swal({
                                type: 'success',
                                title: 'Bajarildi',
                                text: "Ma'lumot O'chirildi!",
                                timer: 1700,
                                })
                        }
                        else
                        {
                            swal({
                                type: 'error',
                                title: 'Xatolik',
                                text: "Xatolik Sodir Bo'ldi!",
                                timer: 1700,
                                })
                        }
                    }
                });

			  } 
              else
              {
                swal({
                    type: 'error',
                    title: 'Bekor',
                    text: "Siz Ushbu Qatorni O'chirmadingiz!",
                    timer: 1700,
                    })
                   return false; 
              }
			});
           
        });
        // $(document).on('click','.add_product_btn',function(){
        //     var tovar_kodi = $(this).data('id');
        //     var data = table.row( $(this).parents('tr') ).data();
        //     alert( data[0] +"'s salary is: "+ data[ 3 ] );
        // });
        $("#narx_uzs").keyup(function(){
            $("#narx_usd").val('0');
        });
        $("#narx_usd").keyup(function(){
            $("#narx_uzs").val('0');
        });
        $('#myTable tbody').on( 'click', '.add_product_btn', function () {
            
            var filial_change       = $("#filial_change").attr('role');
            var faktura_id          = $("#faktura_id").val();
            var kelgan_sana         = $("#kelgan_sana").val();
            var qoshilgan_sana      = $("#qoshilgan_sana").val();
            var yetkazib_beruvchi   = $("#yetkazib_beruvchi").val();
            if(filial_change != '' && faktura_id != '' && kelgan_sana != '' && qoshilgan_sana != '' && yetkazib_beruvchi != '')
            {
                $(this).attr('data-toggle','modal');
                $(this).attr('data-target','#add_tovar_modal');
                var data = table.row( $(this).parents('tr') ).data();           
                $('#tovar_code').val(data['tovar_kodi']);
                $('#tovar_nomi').val($('<div/>').html(data['tovar_nomi']).text());
                if(data['kirimnarx_uzs'] != null)
                {
                    $('#uzs_null').html(data['kirimnarx_uzs']);  
                                     
                }
                else
                {
                    $('#uzs_null').html('Mavjud Emas');

                }
                if(data['kirimnarx_uzs'] != null)
                {
                    $('#usd_null').html(data['kirimnarx_usd']);                    
                }
                else
                {
                    $('#usd_null').html('Mavjud Emas');
                }
                if(data['miqdori'] != null)
                {
                    $('#tovar_qoldiq').val(data['miqdori']);                                      
                    
                }
                else
                {
                    $('#tovar_qoldiq').val('0'); 
                    $("#qoldiq_null").html("Mavjud Emas");
                }               
                
                
               
                    vArr['filial_nomi'] = filial_change;
                    vArr['faktura_id'] = faktura_id;
                    vArr['kelgan_sana'] = kelgan_sana;
                    vArr['qoshilgan_sana'] = qoshilgan_sana;
                    vArr['yetkazib_beruvchi'] = yetkazib_beruvchi;                    

                

                
            }
            else
            {
                swal(
                    {
                    type: 'error',
                    title: 'Xatolik',
                    text: "Orqaga Qaytib Bo'sh Maydonlarni To'ldiring!",
                    timer: 1700,
                    }
                )
            }           
            
            
        });
        $(document).on('click','#saqlash',function(e){
            e.preventDefault();
            var tek = 0;    
            
            if($('#narx_usd').val() == 0 && $("#narx_uzs").val() == 0)
            {
                swal({
                        title:"Xatolik",
                        type:'error',
                        text:"Kirim Narxlarini To'g'irlang!",
                        timer:1500,
                    });
                    return false;
                
            }        
            $('#modal_element :input').each(
			    function(){  
			        var element = $(this);	
                    var element_val = element.val();		        
			        if(element_val == "")
			        {
                        tek ++;			        	
			        }                   

                });

                if(tek == 0)
                {
                    var tovar_nomi  = $("#tovar_nomi").val();
                    var narxi_uzs   = parseFloat($("#narx_uzs").val());
                    var narxi_usd   = parseFloat($("#narx_usd").val());
                    var add_miqdor  = parseFloat($("#add_miqdor").val());
                    var izox        = $("#izox").val();
                    var tovar_kodi        = $("#tovar_code").val();
                    vArr['izox'] = izox;
                    vArr['tovar_kodi'] = tovar_kodi;
                    vArr['miqdori'] = add_miqdor;
                    vArr['narxi_usd'] = narxi_usd;
                    vArr['narxi_uzs'] = narxi_uzs;
                    vArr['tovar_nomi'] = tovar_nomi;
                    
                    $.ajax({
                            type: "get",
                            url: "{{ route('tekshiruv.qoshilgan_tovar_insert_ajax') }}",
                            data: vArr,
                            dataType: "JSON",
                            success: function (response) {
                                if(response)
                                {
                                    
                                    
                                    $('#tekshir_faktura_id').html(vArr['faktura_id']);
                                    $('#tekshiruv_table > tbody:last').append($("<tr data-id="+response['last_id']+">")
                                        .append($('<td>').append(response['tartibi']))
                                        .append($('<td>').append(vArr['tovar_nomi']))
                                        .append($('<td>').append(vArr['miqdori']))
                                        .append($('<td>').append(vArr['narxi_usd']))
                                        .append($('<td>').append(vArr['narxi_uzs']))
                                        .append($('<td>').append("<button type='button' data-id="+response['last_id']+" class='btn btn-danger del_btn'>Delete</button>"))
                                            //№	Nomi	Miqdori	Narxi $	Narxi UZS	Action
                                    )
                                    $("#jami_miqdori").html('Jami_Miqdori: '+response['jami_miqdor']);
                                    $("#jami_usd").html('Jami_Dollarda: '+response['jami_usd']);
                                    $("#jami_uzs").html("Jami_So'mda: "+response['jami_uzs']);
                                    $("#jami_muzs").html("Miqdori*So'm: "+response['jami_miqdor_uzs']);
                                    $("#jami_musd").html("Miqdori*Dollar: "+response['jami_miqdor_usd']);
                                    swal(
                                        {
                                        type: 'success',
                                        title: 'Muvaffaqiyatli',
                                        text: "Ma'lumotlar Bazaga Kiritildi",
                                        timer: 1500,
                                        }
                                    )
                                }
                                else
                                {
                                    swal(
                                        {
                                        type: 'error',
                                        title: 'Xatolik',
                                        text: "Xatolik Sodir Bo'ldi! Iltimos Qaytadan Kiriting!",
                                        timer: 1500,
                                        }
                                    )
                                }
                            }
                        });
                        $('#modal_element :input').each(
                            function(){  
                                var element = $(this);	
                                var element_val = element.val('');   
                            });
                        $('#chiq1').click();
                }
                else
                {

                    swal({
			        	   title:"Xatolik",
			        	   type:'error',
			        	   text:"Bo'sh Maydonlarni To'ldiring",
			        	   timer:1500,
			        	});
                }
              
            
        });
        
        //****************END____Add_Product_Modal_END******************

        // New Tur Add Input
        $('.tovar_brendi').attr('disabled', false);

        $("#new_tur_add").click(function(e){
            if($('.tovar_turi').val()=="")
            {
                $("#new_tur_block").toggle();     
                $("#new_brend_block").toggle();  
                $('.tovar_brendi').attr('disabled', true);
                // $('.tovar_turi').html(' ');
            }
            else{

                swal(
                        {
                        type: 'warning',
                        title: 'Xatolik',
                        text: 'Sizda Tovar Turi Tanlangan!',
                        timer: 1500,
                        }
                    )    
            }
         });


        //  New Brend Add
        
              
        // New Product Div Show
        $('#new_product_button').click(function(){
            $("#new_product_blog").toggle(1000);   
            $("#new_tur_block").hide();     
            $("#new_brend_block").hide(); 
            $("#new_tur_id").val('');
            $("#new_brend_id").val('');
            $(".tovar_turi").prop("selectedIndex", 0).change();
            $(".tovar_brendi").prop("selectedIndex", 0).change();

        });
        // New Product Insert
        $("#new_product_insert").click(function(e){
            e.preventDefault();
            var tur_qiymati = $('.tovar_turi').val();
            var brend_qiymati = $('.tovar_brendi').val();
            var new_tur_qiymati = $("#new_tur_id").val();
            var new_brend_qiymati = $("#new_brend_id").val();
            var marka_qiymati = $('.tovar_markasi').val();
            var test = 0;
            if(tur_qiymati.length > 0)
            {
                if(brend_qiymati.length > 0 && marka_qiymati != "")
                {                
                    // ***********Eski Qiymatlar eski tur eski brend**************
                    $.ajax({
                        type: "get",
                        url: "{{ route('tekshiruv.old_tur_brend_ajax') }}",
                        data: {
                            'tur_qiymati':tur_qiymati,
                            'brend_qiymati':brend_qiymati,
                            'marka_qiymati':marka_qiymati,
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if(response == true)
                            {
                                swal(
                                        {
                                        type: 'success',
                                        title: 'Muvaffaqiyatli',
                                        text: "Ma'lumotlar Bazaga Kiritildi",
                                        timer: 1500,
                                        }
                                    )
                                    // Selectni Birinchi elementini Tanlab Qo'yish
                                    $(".tovar_turi").prop("selectedIndex", 0).change();
                                    $(".tovar_brendi").prop("selectedIndex", 0).change();
                                   
                                    $('.tovar_markasi').val('');
                                    $("#new_product_button").click();
                                    
                            }
                            else
                            {
                                swal(
                                    {
                                    type: 'error',
                                    title: 'Xatolik',
                                    text: "Xatolik Sodir Bo'ldi",
                                    timer: 1500,
                                    }
                                )
                            }
                        }
                    });
                }
                else if (new_brend_qiymati != "" && marka_qiymati != "")
                {
                    // Eski Tur Yangi Brend Insert
                    $.ajax({
                        type: "get",
                        url: "{{ route('tekshiruv.old_tur_new_brend_ajax') }}",
                        data: {
                            'tur_qiymati':tur_qiymati,
                            'new_brend_qiymati':new_brend_qiymati,
                            'marka_qiymati':marka_qiymati,
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if(response == true)
                            {
                                swal(
                                        {
                                        type: 'success',
                                        title: 'Muvaffaqiyatli',
                                        text: "Ma'lumotlar Bazaga Kiritildi",
                                        timer: 1500,
                                        }
                                    )

                                $(".tovar_turi").prop("selectedIndex", 0).change();                                
                                $("#new_brend_id").val('');                                
                                $('.tovar_markasi').val('');
                                $("#new_product_button").click();
                            }
                            else
                            {
                                 swal(
                                    {
                                    type: 'error',
                                    title: 'Xatolik',
                                    text: "Xatolik Sodir Bo'ldi",
                                    timer: 1500,
                                    }
                                )
                            }
                        }
                    });
                }
                else{

                    swal(
                        {
                        type: 'error',
                        title: 'Xatolik',
                        text: "Bo'sh Maydonlarni To'ldiring",
                        timer: 1500,
                        }
                    )
                }
            }
            else if (new_tur_qiymati != "")
            {
                if(new_brend_qiymati != "" && marka_qiymati != "")
                {
                   $.ajax({
                       type: "get",
                       url: "{{ route('tekshiruv.new_tur_new_brend_ajax') }}",
                       data: {
                            'new_tur_qiymati':new_tur_qiymati,
                            'new_brend_qiymati':new_brend_qiymati,
                            'marka_qiymati':marka_qiymati,
                       },
                       dataType: "JSON",
                       success: function (response) {
                           if(response)
                           {
                                tur_id = response.tur_id;
                                tur_nomi = response.tur_nomi;
                                $('.tovar_turi').append($('<option>', {
                                        value: tur_id,
                                        text: tur_nomi,
                                    }));
                            swal(
                                    {
                                    type: 'success',
                                    title: 'Muvaffaqiyatli',
                                    text: "Ma'lumotlar Bazaga Kiritildi",
                                    timer: 1500,
                                    }
                                )
                                $(".tovar_turi").prop("selectedIndex", 0).change();
                                $(".tovar_brendi").prop("selectedIndex", 0).change();
                                $("#new_brend_id").val('');                                
                                $("#new_tur_id").val('');                                
                                $('.tovar_markasi').val('');
                                $("#new_product_button").click();
                            }
                           else
                           {
                            swal(
                                    {
                                    type: 'error',
                                    title: 'Xatolik',
                                    text: "Bo'sh Maydonlarni To'ldiring",
                                    timer: 1500,
                                    }
                                )

                           }
                       }
                   });
                }
                else
                {
                    swal(
                        {
                        type: 'error',
                        title: 'Xatolik',
                        text: "Bo'sh Maydonlarni To'ldiring",
                        timer: 1500,
                        }
                    )
                }
            }
            else
            {
                swal(
                        {
                        type: 'error',
                        title: 'Xatolik',
                        text: "Bo'sh Maydonlarni To'ldiring",
                        timer: 1500,
                        }
                    )
            }
        });
        // Tovar Brend Change
        $(".tovar_brendi").change(function(){
            $("#new_brend_id").val('');
            $("#new_brend_block").hide(); 
        });

        // Add New Brend
        $("#new_brend_add").click(function(){
            if($('.tovar_brendi').val()=="")
            {
                $("#new_brend_id").val('');
                $("#new_brend_block").toggle(500);  
              
            }
            else{

                swal(
                        {
                        type: 'warning',
                        title: 'Xatolik',
                        text: 'Sizda Tovar Brendi Tanlangan!',
                        timer: 1500,
                        }
                    )    
            }
        }); 

        // Tovar Turi Change
        $(".tovar_turi").change(function(){
            $('.tovar_brendi').attr('disabled', false);
            $("#new_tur_id").val('');
            $("#new_brend_id").val('');
            $("#new_tur_block").hide();     
            $("#new_brend_block").hide();             
            var tur_val =  $(".tovar_turi").val();
            $(".tovar_brendi").html(' ');
            $('.tovar_brendi').append('<option value="">---Tovar Brendi---</option>');
            $.ajax({
                type: "get",
                url: "{{ route('tekshiruv.tur_brend_ajax') }}",
                data: {'tur_id':tur_val},
                dataType: "JSON",
                success: function (response) {               
                    $.each(response, function(i,item){
                                $('.tovar_brendi').append($('<option>', {
                                    value: item.b_id,
                                    text: item.firma_nomi,     
                                }));                    
                            });
                    }
            });
        });
      
        
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('tekshiruv.getproducts') }}",
                data: function(data){
                    data.params = {
                        filial_name:"{{ $filial_nomi }}"
                    }                   
                }                
            },         
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'tovar_kodi', name: 'tovar_kodi'},
                {data: 'tovar_nomi', name: 'tovar_nomi'},
                {data: 'miqdori', name: 'miqdori'},
                {data: 'kirimnarx_usd', name: 'kirimnarx_usd'},
                {data: 'kirimnarx_uzs', name: 'kirimnarx_uzs'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ]
        });
    });
    function ClearElementValue()
        {
            $('#modal_element :input').each(
                function(){  
                    var element = $(this);	
                    var element_val = element.val('');   
                });
        }
    </script>
@endsection