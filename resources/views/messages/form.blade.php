@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justified-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $message->exists ? "Editing '".$message->title."'" : "New message" }}
                    {{-- <span class="float-right"><a href="{{ route('messages.index') }}"
                            class="btn btn-sm btn-dark">Back</a></span> --}}
                </div>
                <div class="card-body">
                    {!! Form::model($message, ['method' => $message->exists ? 'put' : 'post',
                    'route' => $message->exists ? ['messages.update', $message] :
                    ['messages.store'],
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

                    <div class="form-group row">
                        {!! Form::label('body', 'Body:', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::textArea('body',null,['class'=>'form-control col-md-7 col-xs-12
                            ','placeholder'=>'Message', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="offset-sm-2">
                            <button type="submit"
                                class="btn btn-dark">{{ $message->exists ? @"Update" : @"Send SMS" }}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection