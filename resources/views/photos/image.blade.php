@extends('layouts.front')
@section('content')

<div class="container-fluid">
	<br>
	<h1 class="text-center"> Upload Images</h1><br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title">Select Image</h2>
		</div>
		<div class="panel-body">
			<form method="post" action="{{route('image.upload')}}" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<input type="file" class="form-control-file" id="image" name="image" onchange="previewFile(this)">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
					<div class="col-12 col-md-9">
						<img id="previewImg" style="max-width:150px; margin-top:20px">
					</div>
				</div>
			</form>
		</div>
	</div>

	
  	<div class="panel panel-default mt-5">
        <div class="panel-heading">
          <h2 class="panel-title">Uploaded Image</h2>
        </div>
        <div class="panel-body" id="uploaded_image">
        	<div class="row">
        		@foreach($images as $image)
        		<div class="col-6 col-md-3 align-items-center text-center">
        			<img class="img-thumbnail" src="{{asset('images/photos/'.$image->getFilename())}}" width="192" height="108" >
        			<button type="button" class="btn btn-link remove_image" id="'.$image->getFilename().'">Remove</button>
        		</div>
        		@endforeach
        	</div>
        </div>
  	</div>
</div>

<script>
	function previewFile(input) {
		var file=$("input[type=file]").get(0).files[0];
		if(file) {
			var reader = new FileReader();
			reader.onload = function () {
				$("#previewImg").attr("src",reader.result);

			}
			reader.readAsDataURL(file);
		}
	}

	$(document).on('click', '.remove_image', function(){
		var name = $(this).attr('id');
		$.ajax({
			url:"{{ route('image.delete') }}",
			data:{name : name},
			success:function(data){
				load_images();
			}
		})
  	});

</script>
@endsection