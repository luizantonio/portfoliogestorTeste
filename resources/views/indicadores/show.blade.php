@extends('layouts.app')

@section('content')  
<head>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="   asset('css/bootstrap-theme.min.css')"> -->
        <!-- <script src="{{asset('js/jquery.min.js')}}"></script> -->

    <link rel="shortcut icon" type="image/png" href="http://portifoliogestor.com/public/images/portfolio-logo4.png" sizes="16x16">
    <!-- 15/09/2016 menu toggle fluid and colappse -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet"> -->
    <!-- 15/09/2016 menu toggle fluid and colappse -->
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- Luiz -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <script>
        // $(document).on('click','#app-navbar-collapse',function(e) {
  //           if( $(e.target).is('a') && $(e.target).attr('class') != 'navbar-toggle' ) {
  //               $(this).collapse('hide');
  //           }
  //       });
    </script>
    <style type="text/css">
            body {
                background-color: lightgray;
                widith: 100%;
                higth:100%;
            }
            
         
        
        h1 {
            font-size: 30px;
            font-weight: 600!important;
            color: #333;
        }
        h2 {
            font-size: 24px;
            font-weight: 600;
        }
        h3 {
            font-size: 22px;
            font-weight: 600;
            line-height: 28px;
        }*/
        hr {
            margin-top: 35px; 
            margin-bottom: 35px;
            border: 0;
            border-top: 1px solid #bfbebe;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        li {
            display: inline-block;
            float: right;
            margin-left: 20px;
            line-height: 35px;
            font-weight: 100;
        }
        a {
            text-decoration: none;
            cursor: pointer;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }
        li a {
            color: white;
            margin-left: 3px;
        }
        li > i {
            color: white; 
        }
        .column-wrap a {
            color: #5c34c2;
            font-weight: 600;
            font-size:16px;
            line-height:24px;
        }
        .column-wrap p {
            color: #717171;
            font-size:16px;
            line-height:24px;
            font-weight:300;
        }
        .container {
            margin-top: 100px;
        }
    



        .congratz {
            margin: 0 auto;
            text-align: center;
        }
        .message::before {
            content: " ";
           /* background: url(https://...);*/
            width: 141px;
            height: 175px;
            position: absolute;
            left: -150px;
            top: 0;
        }
        .message {
            width: 50%;
            margin: 0 auto;
            height: auto;
            padding: 40px;
            background-color: #eeecf9;
            margin-bottom: 100px;
            border-radius: 5px;
            position:relative;
        }
        .message p {
            font-weight: 300;
            font-size: 16px;
            line-height: 24px;
        }
        #pathName {
            margin: 20px 10px;
            color: grey;
            font-weight: 300;
            font-size:18px;
            font-style: italic;
        }
        .column-custom {
            border-radius: 5px;
            background-color: #eeecf9;
            padding: 35px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 13px;
            color: gray !important;
            margin-top: 25px;
            line-height: 1.4;
            margin-bottom: 45px;
        }
        .footer a {
            cursor: pointer;
            color: #646464 !important;
            font-size: 12px;
        }
        .copyright {
            color: #646464 !important;
            font-size: 12px;
        }
        
        .column-custom-wrap{
            padding-top: 10px 20px;
        }
        @media screen and (max-width: 768px) {
            .message {
                width: 50%;
                padding: 35px;
            }
            .container {
                margin-top: 30px;
            }
        }
        @media screen and (max-width: 650px) {
            .message {
                width: 100%;
                padding: 35px;
            }
            .message::before {
                width: 100px;
                height: 123px;
                position: relative;
                left: auto;
                top: 0;
                float: left;
                margin-right: 15px;
                background-size: 100px;
            }
            .container {
                margin-top: 30px;

                margin-bottom: 45px;
                margin-height: 25px;
                margin-left: 25px;
                
            }

        }
    
</style>
</head>


<div class="container">

 


	@if(Session::has('message_error_indicador_show'))
		<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message_error_indicador_show') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message_succes_indicador_show'))
		<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message_succes_indicador_show') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">
				<div class="panel-heading"><center><b><h3>Indicadores Cadastrados</h3></b></center></div>
    @if(!is_null($indicadores) && count($indicadores) > 0)  
                    <div id="ativabusca"  class="navbar-form">
						<form action="{{ route('indicador.ordenarPor') }}" method="POST">
							{!! csrf_field() !!}
							<div class="form-group">
								Ordenar Indicadores:
							</div> 
							<select class="form-control m-b" name="ordenarIndicadorPor" onchange="this.form.submit()">
							   <option value="" disabled="" selected="">Ordenar por...</option>
							   <option value="NOMEDOINDICADOR">Nome</option>							  
							 </select>
						</form>
                        <form class="navbar-form " id="buscarindicador" role="form" action="{{ route('indicador.buscar') }}" method="POST">
							{!! csrf_field() !!}

                            <div class="form-group">
                                Filtrar:
								<input type="text" value="" placeholder="Nome do Indicador" name="nomeIndicadorBusca" id="nomeIndicadorBusca" class="form-control">
                            </div>          
                            <button type="submit" class="btn btn-sm btn-default" id="button_search"  onclick="this.form.submit()"><span class="glyphicon glyphicon-search active">&nbsp;Buscar</span></button>
                        </form>
                    </div>
        @else
		        	<br/>
		            <div class="alert-warning">
		                <center><span class="glyphicon glyphicon-alert"> 
		                <b> N&atilde;o existem Indicadores Cadastradas&#33;</b></span></center>
		            </div>
		@endif
		
		@if(!is_null($indicadores) && count($indicadores) > 0) 
			<div class="panel panel-default">
				<div class="panel-heading">
					Indicadores Cadastrados: {{count($indicadores)}}
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
						<!--  Table Headings -->
						<thead>
							<th>nome do Indicador</th>							
							<th>&nbsp;</th>
							<th>&nbsp;</th>																
						</thead>
						<!--  Table Body -->
						<tbody>
							@foreach ($indicadores as $indicador)
								<tr>								
									<!-- Atributos -->
									<td class="table-text">
										<div>{{ $indicador->nome }}</div>
									</td>
									<td>
									<!-- Atualizar -->
										<form id="form_idUP-{{ $indicador->id }}" action="{{ url('indicador/update/'.$indicador->id)}}" method="POST" enctype="multipart/form-data">
											{!! csrf_field() !!}
											{{ method_field('PUT') }}
											<button type="submit" id="update-indicador-{{ $indicador->id }}" class="btn btn-primary">
												<i class="fa fa-pencil" aria-hidden="true"> Atualizar</i>
											</button>					
										</form>
									</td>
									<td>
										<!-- Deletar -->
										<form id="form_idDEL-{{ $indicador->id }}" action="{{ url('indicador/'.$indicador->id)}}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" id="delete-indicador-{{ $indicador->id }}" class="btn btn-danger">
												<i class="fa fa-trash-o" aria-hidden="true"> Delete</i>
											</button>			
										</form>
									</td>									
							</tr>
							@endforeach 
						</tbody>
					</table>
				</div>
			</div> 
			<script type="text/javascript">
						$(document).ready(function () {
							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-primary').click(function (event) {
								event.preventDefault();
								var button = confirm("Quer atualizar os dados?");	// return true or false	
								if(button == true)
								{
									var form_id = $(this).closest('form').attr('id');	
									//alert('form_id : ' + form_id);
									$('#'+form_id).submit();
								}
							});;/* FIM click*/

							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-danger').click(function (event) {								
								event.preventDefault();
								var button = confirm("Quer APAGAR os dados?");	// return true or false	
								if(button == true)
								{
									var form_id = $(this).closest('form').attr('id');
									/**alert('form_id : ' + form_id);**/
									$('#'+form_id).submit();
								}
							});;/* FIM click*/
						 }); /* end jquerry */
					</script>
			@endif
		</div>
	</div>
</div>
@endsection