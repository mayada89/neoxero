@extends('layouts.master')
@section('title') View Users @endsection
@section('content')
<table class="table table-hover table-striped" id="tbl1">
    <thead>
        <tr>
            <th>@lang('fields.name')</th>
            <th>@lang('fields.phone')</th>
            <th>@lang('fields.company')</th>
            <th>@lang('fields.active')</th>
            <th></th>
        </tr>        
    </thead>
    <tbody>
        @foreach($all as $item)
        @if($item->id != 1)
        <tr>
            <td>{{$item->first_name}} {{$item->last_name}}</td>
            <td>{{$item->phone}}</td>
            <td>{{$item->company['name']}}</td>
            <td>@if($item->active == 1) @lang('fields.yes') @else @lang('fields.no') @endif </td>
            <th>                
                <a href="{{url('users/edit')}}/{{$item->id}}"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" class="removeItm"><i class="fa fa-trash"></i></a>
                <input type="hidden" value="{{$item->id}}" />
            </th>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
    $(".removeItm").click(function (){
        var userId = $(this).next().val();
        var _token = "{{ csrf_token() }}"; 
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                type: 'POST',
                url: "{{ url('users/delete') }}",
                data: {  _token:_token ,userId : userId},
                success: function(response) {                    
                }
        });
        
        var curtr = $(this).closest("tr");    
        curtr.remove(); 
        
        } else {             
        }
    });
</script>
@endsection