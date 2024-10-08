@extends('backEnd.master')
@section('title') 
@lang('fees.fees_discount')
@endsection
@section('mainContent')
@php  $setting = generalSetting(); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } @endphp

<section class="sms-breadcrumb mb-20">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('fees.fees_discount')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('fees.fees_collection')</a>
                <a href="#">@lang('fees.fees_discount')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($fees_discount))
        @if(userPermission("fees_discount_store"))
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('fees_discount')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('common.add')
                </a>
            </div>
        </div>
        @endif
        
        @endif
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        @if(isset($fees_discount))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' =>
                        'fees_discount_update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @else
                        @if(userPermission("fees_discount_store"))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees_discount_store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="main-title">
                                <h3 class="mb-15">
                                    @if(isset($fees_discount))
                                        @lang('fees.edit_fees_discount')
                                    @else
                                        @lang('fees.add_fees_discount')
                                    @endif
                                  
                                </h3>
                            </div>
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('common.name') <span class="text-danger"> *</span></label>
                                            <input class="primary_input_field form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" autocomplete="off" value="{{isset($fees_discount)? $fees_discount->name: ''}}">
                                            <input type="hidden" name="id" value="{{isset($fees_discount)? $fees_discount->id: ''}}">
                                           
                                            
                                            @if ($errors->has('name'))
                                            <span class="text-danger" >
                                                {{ $errors->first('name') }}
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('fees.discount_code') <span class="text-danger"> *</span></label>
                                            <input class="primary_input_field form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                                type="text" name="code" autocomplete="off"
                                                value="{{isset($fees_discount)? $fees_discount->code: ''}}">
                                                @if ($errors->has('code'))
                                                <span class="text-danger">
                                                    {{ $errors->first('code') }}
                                                </span>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                @if(!moduleStatusCheck('University') && directFees() == false)
                                <div class="row mt-40">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500">@lang('common.type')</p>
                                        <div class="radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="type" id="once" value="once" class="common-radio relationButton" {{isset($fees_discount)? ($fees_discount->type == "once"? 'checked':''):'checked'}}>
                                                <label for="once">@lang('fees.once')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="type" id="year" value="year" class="common-radio relationButton" {{isset($fees_discount)? ($fees_discount->type == "year"? 'checked':''):''}}>
                                                <label for="year">@lang('fees.year')</label>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                                @endif 
                                <div class="row mt-20">
                                    <div class="col-lg-12">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('fees.amount')  <span class="text-danger"> *</span></label>
                                            <input oninput="numberCheckWithDot(this)" class="primary_input_field form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                                type="number" name="amount" autocomplete="off"
                                                value="{{isset($fees_discount)? $fees_discount->amount: ''}}">
                                            @if ($errors->has('amount'))
                                            <span class="text-danger" >
                                                {{ $errors->first('amount') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">@lang('common.description') <span></span></label>
                                            <textarea class="primary_input_field form-control" cols="0" rows="4"
                                                name="description">{{isset($fees_discount)? $fees_discount->description: ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            	@php 
                                  $tooltip = "";
                                  if(userPermission("fees_discount_store")){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($fees_discount))
                                                @lang('fees.update_discount')
                                            @else
                                                @lang('fees.save_discount')
                                            @endif
                                            
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="white-box">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-15"> @lang('fees.fees_discount_list')</h3>
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-12">
                            <x-table>
                                <table id="table_id" class="table" cellspacing="0" width="100%">
    
                                    <thead>
                                        
                                        <tr>
                                            <th> @lang('common.name')</th>
                                            <th> @lang('fees.discount_code')</th>
                                            @if(!moduleStatusCheck('University') && directFees()==false)
                                            <th> @lang('fees.discount_type')</th>
                                            @endif 
                                            <th>@lang('fees.amount')</th>
                                            <th>@lang('common.action')</th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                        @foreach($fees_discounts as $fees_discount)
                                        <tr>
                                            <td data-toggle="tooltip" data-placement="top" title="{{ $fees_discount->description }}">{{$fees_discount->name}}</td>
                                            <td>{{$fees_discount->code}}</td>
                                            @if(! moduleStatusCheck('University') && directFees()==false )
                                            <td>{{$fees_discount->type}}</td>
                                            @endif 
                                            <td>{{$fees_discount->amount}} </td>
                                            <td>
                                                <x-drop-down>
                                                        @if(userPermission('fees_discount_assign'))
        
                                                        <a class="dropdown-item" href="{{route('fees_discount_assign', [$fees_discount->id])}}">@lang('fees.assign')</a>
                                                        @endif
                                                        @if(userPermission('fees_discount_edit'))
        
                                                        <a class="dropdown-item" href="{{route('fees_discount_edit', [$fees_discount->id])}}">@lang('common.edit')</a>
                                                        @endif
                                                        @if(userPermission('fees_discount_delete'))
        
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#deleteFeesDiscountModal{{$fees_discount->id}}"
                                                            href="#">@lang('common.delete')</a>
                                                   @endif
                                                        </x-drop-down>
                                                        </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteFeesDiscountModal{{$fees_discount->id}}" >
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">@lang('fees.delete_fees_discount')</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
        
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4>@lang('common.are_you_sure_to_delete')</h4>
                                                        </div>
        
                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.cancel')</button>
                                                            <a href="{{route('fees_discount_delete', [$fees_discount->id])}}"><button class="primary-btn fix-gr-bg" type="submit">@lang('common.delete')</button></a>
                                                        </div>
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </x-table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@include('backEnd.partials.data_table_js')

