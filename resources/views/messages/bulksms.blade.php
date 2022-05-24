@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justified-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    BULK SMS
                </div>
                <div class="card-body">
                    {!! Form::open(['method' => 'post',
                    'route' => ['bulksms'],
                    'class' => 'form-horizontal'])
                    !!}

                    <div class="form-group row">
                        {!! Form::label('sender_id', 'Sender:', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {{Form::select('sender_id', $senders, null, ['class' => 'form-control col-md-7 col-xs-12'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('phone', 'Phone Number(s):', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('phone',null,['class'=>'form-control col-md-7 col-xs-12
                            ','placeholder'=>'Phone Number(s)', 'required']) !!}
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        {!! Form::label('body', 'Excel File:', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::textArea('body',null,['class'=>'form-control col-md-7 col-xs-12
                            ','placeholder'=>'Excel file path']) !!}
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="offset-sm-2">
                            <button type="submit"
                                class="btn btn-dark">Send Bulk SMS</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection