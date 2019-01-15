@extends('layouts.master')
@section('title') Edit company || {{$item->name}} @endsection
@section('content')
<form method="post" action="{{url('/companies/update')}}/{{$item->id}}" enctype="multipart/form-data">
     @csrf
      @foreach($cols as $col)   
        @if($col != 'id' & $col != 'updated_at' & $col != 'created_at' & $col != 'email_verified_at' & $col != 'role_id'
        & $col != 'remember_token')
        <div class="form-group">
            <label>{{__('fields.'.$col)}}</label>
            @if($col == 'name')
            <input type="text" name="{{$col}}" id="{{$col}}" class="form-control" value="{{$item->$col}}" required=""/>
           @elseif($col == 'logo')
            <input type="file" name="{{$col}}" id="{{$col}}" />
            @elseif ($col == 'website')
            <input type="url" name="{{$col}}" id="{{$col}}" class="form-control" value="{{$item->$col}}"/>
            @elseif($col == 'email')
            <input type="email" name="{{$col}}" id="{{$col}}" class="form-control" required="" value="{{$item->$col}}"/>
            @elseif ($col == 'company_id')
                <select name="{{$col}}" id="{{$col}}" class="form-control">
                    <option value="0">@lang('fields.choose')</option>
                </select>
            @elseif($col == 'active')
            <label><input type="radio" name="{{$col}}" id="{{$col}}" value="1" @if($item->$col == 1) checked @endif/> @lang('fields.yes')</label>
            <label><input type="radio" name="{{$col}}" id="{{$col}}" value="0" @if($item->$col == 0) checked @endif/> @lang('fields.no')</label>
            @else
            <input type="text" name="{{$col}}" id="{{$col}}" class="form-control" value="{{$item->$col}}"/>
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
