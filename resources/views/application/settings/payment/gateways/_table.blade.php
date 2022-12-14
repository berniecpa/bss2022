<div class="table-responsive mb-4" data-toggle="gateways">
    <table class="table table-xl mb-0 thead-border-top-0 table-striped">
        <thead>
            <tr>
                <th>{{ __('messages.name') }}</th> 
                <th>{{ __('messages.status') }}</th> 
                @can('update online payment gateway')
                    <th class="text-right">{{ __('messages.actions') }}</th>
                @endcan
            </tr>
        </thead>
        <tbody class="list" id="gateways">
            <tr>
                <td class="h6">
                    <a href="{{ route('settings.payment.gateway.edit', ['company_uid' => $currentCompany->uid, 'gateway' => 'paypal']) }}">
                        <strong class="h6">
                            {{ __('messages.paypal') }}
                        </strong>
                    </a>
                </td>
                <td class="h6">
                    @if($currentCompany->isPaypalActive())
                        <div class="badge badge-success fs-0-9-rem">
                            {{ __('messages.enabled') }}
                        </div>
                    @else
                        <div class="badge badge-danger fs-0-9-rem">
                            {{ __('messages.disabled') }}
                        </div>
                    @endif
                </td>
                @can('update online payment gateway')
                    <td class="h6 text-right">
                        <a href="{{ route('settings.payment.gateway.edit', ['company_uid' => $currentCompany->uid, 'gateway' => 'paypal']) }}" class="btn text-primary">
                            <i class="material-icons icon-16pt">edit</i>
                            {{ __('messages.edit') }}
                        </a>
                    </td>
                @endcan
            </tr>
            <tr>
                <td class="h6">
                    <a href="{{ route('settings.payment.gateway.edit', ['company_uid' => $currentCompany->uid, 'gateway' => 'stripe']) }}">
                        <strong class="h6">
                            {{ __('messages.stripe') }}
                        </strong>
                    </a>
                </td>
                <td class="h6">
                    @if($currentCompany->isStripeActive())
                        <div class="badge badge-success fs-0-9-rem">
                            {{ __('messages.enabled') }}
                        </div>
                    @else
                        <div class="badge badge-danger fs-0-9-rem">
                            {{ __('messages.disabled') }}
                        </div>
                    @endif
                </td>
                @can('update online payment gateway')
                    <td class="h6 text-right">
                        <a href="{{ route('settings.payment.gateway.edit', ['company_uid' => $currentCompany->uid, 'gateway' => 'stripe']) }}" class="btn text-primary">
                            <i class="material-icons icon-16pt">edit</i>
                            {{ __('messages.edit') }}
                        </a>
                    </td>
                @endcan
            </tr>
            <tr>
                <td class="h6">
                    <a href="{{ route('settings.payment.gateway.edit', ['company_uid' => $currentCompany->uid, 'gateway' => 'razorpay']) }}">
                        <strong class="h6">
                            {{ __('messages.razorpay') }}
                        </strong>
                    </a>
                </td>
                <td class="h6">
                    @if($currentCompany->isRazorpayActive())
                        <div class="badge badge-success fs-0-9-rem">
                            {{ __('messages.enabled') }}
                        </div>
                    @else
                        <div class="badge badge-danger fs-0-9-rem">
                            {{ __('messages.disabled') }}
                        </div>
                    @endif
                </td>
                @can('update online payment gateway')
                    <td class="h6 text-right">
                        <a href="{{ route('settings.payment.gateway.edit', ['company_uid' => $currentCompany->uid, 'gateway' => 'razorpay']) }}" class="btn text-primary">
                            <i class="material-icons icon-16pt">edit</i>
                            {{ __('messages.edit') }}
                        </a>
                    </td>
                @endcan
            </tr>
            <tr>
                <td class="h6">
                    <a href="{{ route('settings.payment.gateway.edit', ['company_uid' => $currentCompany->uid, 'gateway' => 'mollie']) }}">
                        <strong class="h6">
                            {{ __('messages.mollie') }}
                        </strong>
                    </a>
                </td>
                <td class="h6">
                    @if($currentCompany->isMollieActive())
                        <div class="badge badge-success fs-0-9-rem">
                            {{ __('messages.enabled') }}
                        </div>
                    @else
                        <div class="badge badge-danger fs-0-9-rem">
                            {{ __('messages.disabled') }}
                        </div>
                    @endif
                </td>
                @can('update online payment gateway')
                    <td class="h6 text-right">
                        <a href="{{ route('settings.payment.gateway.edit', ['company_uid' => $currentCompany->uid, 'gateway' => 'mollie']) }}" class="btn text-primary">
                            <i class="material-icons icon-16pt">edit</i>
                            {{ __('messages.edit') }}
                        </a>
                    </td>
                @endcan
            </tr>
        </tbody>
    </table>
</div>