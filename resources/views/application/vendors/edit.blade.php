@extends('layouts.app', ['page' => 'vendors'])

@section('title', __('messages.update_vendor'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('vendors', ['company_uid' => $currentCompany->uid]) }}">{{ __('messages.vendors') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('vendors.details', ['vendor' => $vendor->id, 'company_uid' => $currentCompany->uid]) }}">{{ $vendor->display_name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.edit') }}</li>
                </ol>
            </nav>
            <h1 class="m-0 h3">{{ __('messages.update_vendor') }}</h1>
        </div>
        <a href="{{ route('vendors.delete', ['vendor' => $vendor->id, 'company_uid' => $currentCompany->uid]) }}" class="btn btn-danger ml-3 delete-confirm">
            <i class="material-icons">delete</i> 
            {{ __('messages.delete_vendor') }}
        </a>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('vendors.update', ['vendor' => $vendor->id, 'company_uid' => $currentCompany->uid]) }}" method="POST">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.vendors._form')

        <div class="form-group text-center mt-5">
            <button type="submit" class="btn btn-primary">{{ __('messages.save_vendor') }}</button>
        </div>
    </form>
@endsection