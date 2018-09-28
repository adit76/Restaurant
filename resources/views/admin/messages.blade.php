@extends('admin.layout.layout')

@section('title','Messages | Restro')

@section('main')
<h2>Messages</h2>
 <table class="table">
   <thead>
	 <tr>
	   <th>ID</th>
	   <th>Name</th>
	   <th>E-mail</th>
	   <th>Message</th>
	   <th>Date</th>
	 </tr>
   </thead>
	<tbody>
		  @if(count($all_messages) == 0)
			<tr><td><h3 style="position: absolute; text-align:center; width: 100%; padding-top: 30px">No Messages Received Yet !!</h3></td></tr>
		  @endif
		  
		  @foreach($all_messages as $key => $data)
			<tr>    
			  <td>{{$data->id}}</td>
			  <td>{{$data->name}}</td>
			  <td><a href="mailto:{{$data->email}}?subject=Restro has Replied to Your Message.&body=Replying To: {{$data->message}}" target="_blank">{{$data->email}}</a></td>                 
			  <td>{{$data->message}}</td>                 
			  <td>{{$data->date}}</td>                                               
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection