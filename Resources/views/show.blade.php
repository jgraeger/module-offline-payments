<div>
    <div>
        @if (!empty($setting['name']))
            <h2>{{ $setting['name'] }}</h2>
        @endif

        @if (!empty($setting['description']))
	    <div class="card card-body">
            <p class="card-text">
                @markdown($setting['description'])
            </p>
        </div>
        @endif
    </div>
    <br>
    
    @if ($confirm_url)
        <div class="buttons">
            <div class="pull-right">
                {!! Form::open([
                    'url' => $confirm_url,
                    'id' => 'redirect-form',
                    'role' => 'form',
                    'autocomplete' => "off",
                    'novalidate' => 'true'
                ]) !!}
                    <button @click="onRedirectConfirm" type="button" id="button-confirm" class="btn btn-success">
                        {{ trans('general.confirm') }}
                    </button>
                    {!! Form::hidden('payment_method', $setting['code']) !!}
                    {!! Form::hidden('type', 'income') !!}

                {!! Form::close() !!}
            </div>
        </div>
    @endif
</div>
