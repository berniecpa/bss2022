@extends('layouts.app', ['page' => 'customers'])

@section('title', __('messages.create_customer'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('customers', ['company_uid' => $currentCompany->uid]) }}">{{ __('messages.customers') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('customers.details', ['customer' => $customer->id,'company_uid' => $currentCompany->uid]) }}">{{ $customer->display_name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.edit') }}</li>
                </ol>
            </nav>
            <h1 class="m-0 h3">{{ __('messages.update_customer') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('customers.update', ['customer' => $customer->id, 'company_uid' => $currentCompany->uid]) }}" method="POST" enctype="multipart/form-data">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.customers._form')
    </form>
@endsection