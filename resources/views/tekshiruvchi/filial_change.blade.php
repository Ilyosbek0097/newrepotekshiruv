@extends('layouts.tekshiruv')
@section('title','Filialni Tanlash')
@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Filialni Tanlang</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Bosh Sahifa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tovar Qo'shish</li>
                            </ol>
                        </nav>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="offset-md-4">
                        
                    </div>
                    <div class="col-md-6 col-sm-12 text-right mt-5">
                        <form method="POST" action="{{ route('tekshiruv.filial_name_send') }}" id="filial_form"> 
                            @csrf                       
                            <div class="form-group">
                                {{-- <label for="filial" class="">Filialni Tanlang:</label> --}}
                                <select required="1" name="filial_nomi" class="form-control mb-3" id="filial">										
                                <option style="text-indent: 15px;" value="">----- Filialni Tanlang -----</option>   
                                @foreach ($filials as $filial)
                                <option style="text-indent: 15px;" value="{{ strtolower($filial->filial_nom) }}">{{ $filial->nomi }} {{ 'Filiali' }}</option> 
                                @endforeach        
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-info">Tasdiqlash</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>           
        </div>
        
</div>
@endsection
@section('scripts')
    
@endsection