@extends('layouts.master')
@section('title') Add User @endsection
@section('content')
<form method="post" action="{{url('/users/store')}}">
     @csrf
      @foreach($cols as $col)   
        @if($col != 'id' & $col != 'updated_at' & $col != 'created_at' & $col != 'email_verified_at' & $col != 'role_id'
        & $col != 'remember_token' & $col != 'active')
        <div class="form-group">
            <label>{{__('fields.'.$col)}}</label>
            @if($col == 'first_name')
            <input type="text" name="{{$col}}" id="{{$col}}" class="form-control" required="" value="{{old($col)}}"/>
            @elseif($col == 'password')
            <input type="password" name="{{$col}}" id="{{$col}}" class="form-control" required=""/>
            @elseif ($col == 'phone')
            <input type="tel" name="{{$col}}" id="{{$col}}" class="form-control" value="{{old($col)}}"/>
            @elseif($col == 'email')
            <input type="email" name="{{$col}}" id="{{$col}}" class="form-control" required="" value="{{old($col)}}"/>
            @elseif ($col == 'company_id')
                <select name="{{$col}}" id="{{$col}}" class="form-control">
                    <option value="0">@lang('fields.choose')</option>
                    @foreach($companies as $company)
                    <option value="{{$company->id}}" @if(old($col)) selected @endif>{{$company->name}}</option>
                    @endforeach
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
