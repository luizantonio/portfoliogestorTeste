@if (count($errors) > 0)
	<!-- form Error List -->
	<div class="alert alert-danger">
		<strong>@php echo  utf8_encode('Problemas na execu��o do C�digo:'); @endphp </strong>
		<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>@php echo  utf8_encode($error); @endphp</li>
			@endforeach
		</ul>
	</div>
@endif
           