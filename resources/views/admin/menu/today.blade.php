@extends('admin.layout.layout')

@section('title','Menu Items Food | Restro')

@section('main')

<h2>Today Menu</h2>
<form action="{{ route('today_edit') }}" method="POST">
{{ csrf_field() }}
 <table class="table">
   <thead>
	 <tr>
	   <th>On Today</th>
	   <th>ID</th>
	   <th>Name</th>
	   <th>Price</th>
	   <th>Special</th>
	 </tr>
   </thead>
	<tbody>
		  @if(count($food) == 0)
			<tr><td><h3 style="position: absolute; text-align:center; width: 100%; padding-top: 30px">No Food !!</h3></td></tr>
		  @endif
		  
		  <?php $cname = ""?>
		  
		  @foreach($food as $key => $data)
			<?php if($cname != $data->cname){
			echo '<tr><td><h6>'.$data->cname.'</h6></td></tr>';
			$cname = $data->cname;
			}
			?>
			<tr>    
			  <td><input style="-ms-transform: scale(1.6); -moz-transform: scale(1.6); -webkit-transform: scale(1.6); -o-transform: scale(1.6); padding: 10px;" type="checkbox"
				@if($data->today == 1)
					checked
				@endif
			  name="today[]" value="{{$data->iid}}" ></td>
			  <td>{{$data->iid}}</td>
			  <td>{{$data->iname}}</td>
			  <td>{{$data->price}}</td>                                       
			  <td>
				@if($data->special == 1)
					Yes
				@else
					No
				@endif
			  </td>
			</tr>
			@endforeach
			
		</tbody>
 </table>   
 
 <input type="submit" class="btn btn-success" value="Update Today's Menu">
 
 </form>
<br/>
 

@endsection