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
		  @foreach($all_messages as $key => $data)
			<tr>    
			  <th>{{$data->id}}</th>
			  <th>{{$data->name}}</th>
			  <th><a href="mailto:{{$data->email}}?subject=Restro has Replied to Your Message.&body=Replying To: {{$data->message}}" target="_blank">{{$data->email}}</a></th>                 
			  <th>{{$data->message}}</th>                 
			  <th>{{$data->date}}</th>                                               
			</tr>
		@endforeach
		</tbody>
 </table>   

@endsection