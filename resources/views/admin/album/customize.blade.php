@extends('admin.layout.layout')

@section('title','Customize Album | Restro')

@section('main')
<style>
	th img{
		transition: all 0.3s ease;
		cursor: zoom-in;
	}
	th img:hover{
		transform: scale(3);
		transition: all 0.5s 0.3s ease;
	}
</style>

<h2>Name: {{ $album[0]->name }}</h2>
<h4>{{ $album[0]->date }}</h4>
 
 <table class="table">
   <thead>
	 <tr>
	   <th>Name</th>
	   <th>Photo</th>
	   <th></th>
	 </tr>
   </thead>
	<tbody>
		  @foreach($photos as $key => $data)
			<tr>    
			  <td>{{$data->pname}}</td>
			  <td><img src="{{asset('images/gallery/'.$data->url)}}" style="width: 80px;"></td>			  
			  <td><button class="btn btn-danger" onclick="removePhoto(this,{{$data->aid}},{{$data->pid}})">Remove</button></td>			  
			</tr>
		@endforeach
		</tbody>
 </table>   
 
<hr/>
<h3>Upload New Photos</h3>
<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ route('upload_photo') }}">
	{{ csrf_field() }}
	<input type="hidden" name="album_id" value="{{ $album[0]->id }}">
	<input required type="file" class="form-control" name="images[]" placeholder="Photos To Upload" multiple>
	<br/>
	<input class="btn btn-primary" type="submit">
</form>
 
 <script>
	function removePhoto(item,aid,pid){
		if(confirm('Are You Sure?')){
			$.ajax({
				url: '../../remove_photo?aid='+aid+'&pid='+pid,
				type: "GET",
				dataType: "text",
				success: function (data) {
					if(data == "OK"){
						alert('Photo Removed Successfully.');
					}
					console.log('Photo Removed');
					item.parentElement.parentElement.style.display = 'none';
				},
				error: function () {
					alert('Could Not Remove The Photo.');
				}
			});
		}
	}
 </script>
 

@endsection