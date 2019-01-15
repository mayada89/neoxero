@extends('layouts.master')
@section('title') Add Company @endsection
@section('content')
<form method="post" action="{{url('/companies/store')}}" enctype="multipart/form-data">
     @csrf
      @foreach($cols as $col)   
        @if($col != 'id' & $col != 'updated_at' & $col != 'created_at' & $col != 'email_verified_at' & $col != 'role_id'
        & $col != 'remember_token' & $col != 'active')
        <div class="form-group">
            <label>{{__('fields.'.$col)}}</label>
            @if($col == 'name')
            <input type="text" name="{{$col}}" id="{{$col}}" class="form-control" required="" value="{{old($col)}}"/>
            @elseif($col == 'logo')
            <input type="file" name="{{$col}}" id="{{$col}}" value="{{old($col)}}"/>
            @elseif ($col == 'website')
            <input type="url" name="{{$col}}" id="{{$col}}" class="form-control" value="{{old($col)}}"/>
            @elseif($col == 'email')
            <input type="email" name="{{$col}}" id="{{$col}}" class="form-control" required="" value="{{old($col)}}"/>
            @elseif ($col == 'company_id')
                <select name="{{$col}}" id="{{$col}}" class="form-control">
                    <option value="0">@lang('fields.choose')</option>
                </select>
            @else
            <input type="text" name="{{$col}}" id="{{$col}}" class="form-control" value="{{old($col)}}"/>
            @endif
        </div>
        @endif
      @endforeach
      <div class="form-group">
          <input type="submit" value="@lang('fields.submit')" class="btn btn-success"/>
          <input type="button" value="@lang('fields.cancel')" class="btn btn-primary"/>
      </div>
</form>

@endsection
