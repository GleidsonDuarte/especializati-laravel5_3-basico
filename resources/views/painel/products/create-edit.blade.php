@extends ('painel.templates.template')

@section('content')
	<h1 class="title-pg">Gestão Produto</h1>

	@if (isset($errors) && count($errors) > 0)
		<div class="alert alert-danger">
			@foreach($errors->all() as $error)
			<p>{{$error}}</p>
			@endforeach
		</div>
	@endif

	@if(isset($product))
		<form class="form" method="post" action="{{route('produtos.update', $product->id)}}">
			{!! method_field('PUT') !!}
	@else
		<form class="form" method="post" action="{{route('produtos.store')}}">
	@endif
		{!! csrf_field() !!}
		<div class="form-group">
			<input class="form-control" type="text" name="name" placeholder="Nome" value="{{$product->name or old('name')}}">
		</div>
		<div class="form-group">
			<input type="checkbox" name="active" value="1"
				@if(isset($product) && $product->active == '1') checked
				@endif
			> Ativo?
		</div>
		<div class="form-group">
			<input class="form-control" type="text" name="number" placeholder="Número" value="{{$product->number or old('number')}}">
		</div>
		<div class="form-group">
			<select class="form-control" name="category">
				<option value="">Escolha a Categoria</option>
				@foreach($categories as $category)
					<option value="{{$category}}"
						@if(isset($product) && $product->category == $category)
							selected
						@endif
					>{{strtoupper($category)}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<textarea class="form-control" name="description" placeholder="Descrição">{{$product->description or old('description')}}</textarea>
		</div>
		<button class="btn btn-primary" type="submit">Enviar</button>
	</form>
@endsection