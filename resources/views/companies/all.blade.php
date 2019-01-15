@extends('layouts.master')
@section('title') View Companies @endsection
@section('content')
<table class="table table-hover table-striped" id="tbl1">
    <thead>
        <tr>
            <th>@lang('fields.logo')</th>
            <th>@lang('fields.name')</th>            
            <th></th>
        </tr>        
    </thead>
    <tbody>
        @foreach($all as $item)
        @if($item->id != 1)
        <tr>
            <td><img src="{{asset('uploads')}}/{{$item->logo}}" class="tbl-img"/></td>
            <td>{{$item->name}}</td>            
            <th>                
                <a href="{{url('companies/edit')}}/{{$item->id}}"><i class="fa fa-edit"></i></a>
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
        var itemId = $(this).next().val();
        var _token = "{{ csrf_token() }}"; 
        if (confirm('Are you sure you want to delete this company?')) {
            $.ajax({
                type: 'POST',
                url: "{{ url('companies/delete') }}",
                data: {  _token:_token ,itemId : itemId},
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