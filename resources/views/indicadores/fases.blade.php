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

@if(Session::has('alert-danger') || Session::has('alert-success'))
	<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> 
@endif
@if(Session::has('message_error_associar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_associar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_success_associar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_associar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif




	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">	

			<div class="panel-heading">		
				<div class="form-group">
					<div class="col-sm-offset-0 col-sm-0">						    
						<a href ="{{  route('home') }}"> <button type="button" class="btn btn-success" title="Voltar para o início" id="btnvoltar">
							<i class="fa fa-chevron-left"> Voltar</i> 
						</button></a> <center><b><h3>Associar Indicador ao Projeto</h3></b></center>
					</div>
				</div>
			</div>
			<center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>
				
					
                    <div id="ativabusca" class="navbar-form">
						
						<form action="{{ route('indicador.ordenarPorInformar') }}" method="POST">
							{!! csrf_field() !!}
							<div class="form-group">
								Ordenar Projetos:
							</div> 
							<select class="form-control m-b" name="nomeProjetoOrdenar" onchange="this.form.submit()">
							   <option value="" disabled="" selected="">Ordenar por...</option>
							   <option value="NOMEDOPROJETO">Nome do Projeto</option>						  
							 </select>
						</form>
                        <form class="navbar-form " id="buscarprojeto" role="form" action="{{ route('indicador.buscarInformar') }}" method="POST">
							{!! csrf_field() !!}

                            <div class="form-group">
                                Filtrar Projetos:
								<input type="text" value="" placeholder="Nome do Projeto" name="nomeProjetoBusca" id="nomeProjetoBusca" class="form-control">                                
                            </div>          
                            <button type="submit" class="btn btn-sm btn-default" id="button_search"  onclick="this.form.submit()"><span class="glyphicon glyphicon-search active">&nbsp;Buscar</span></button>
                        </form>
                    </div>



		@if (count($projetos) <= 0 || $projetos == null)	
			<center><div style="background-color: white;"><h3><b><p class="danger"><b>@php utf8_encode('Usuário não foi encontrado!'); @endphp </b><h3></div></center>	
		@endif
		@if (count($projetos) > 0)
			<div class="panel panel-default">
				<div class="panel-heading">
				    @if (count($projetos) == 1)
						@php echo utf8_encode('Projeto Cadastrado:'); @endphp {{count($projetos)}}
					@elseif (count($projetos) > 1)
						@php echo utf8_encode('Projetos Cadastrados:'); @endphp {{count($projetos)}}
					@endif
					<br>
				</div>
				<div class="panel-body">
			 <table class="table table-condensed">
			    <thead>
					<tr>					
						<th>Projeto</th>
						<th>Fase&nbsp;do&nbsp;Projeto</th>						
						<th>Possui&nbsp;Indicador?</th>																				
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>	
				</thead>
				<tbody>
					@php 
					 $contadorFase = 1; 
					 $contadorIndicador= 0;
					 $contadorProjeto= 0;
					 @endphp
					 <!-- projetos início-->
					@foreach($projetos as $projeto)
						@if($projeto->user_id == Auth::user()->id  || $projeto->gerente_responsavel == Auth::user()->id )

						@if( $projeto->associadoAindicadorEmFase( $projeto->id) )
							<tr class="success">		
						@else
							<tr class="warning">			
						@endif	
						
							  <!--  Nome do Projeto -->
							  <td>{{ $projeto->nome }}<input type="hidden" name="name" value="{{ $projeto->name. $projeto->isQualIndicador( $projeto->id) }}"></td>
							  <td>
							   <div class="form-group navbar-form">

							   <!-- Fase  -->

								 @if(!is_null($projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) )) )
									{{$projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) )}}
								 @else
									@php
								    echo '<b style="color:red;">SEM FASE DEFINIDA!</b>';  
								   @endphp
								@endif
								</div>
							  </td>
							   <td>
							   <!-- Fase Associada com indicadorSim ou não  -->
								@if( $projeto->associadoAindicadorEmFase( $projeto->id) )
									<label for="1ch-associado" class="col-md-4 control-label"><b style="color:green;">@php echo utf8_encode('Sim'); @endphp</b></label>
								@else
									<label for="1ch-associado" class="col-md-4 control-label"><b style="color:red;">@php echo utf8_encode('Não'); @endphp</b></label>
								@endif								
								

								
							 </td>
							  <td class="left">
								<div class="text-left">
							   <form id="form-{{$projeto->id}}"action="{{ url('indicadores/associar/'.$projeto->id )}}" method="post">
								  {!! csrf_field() !!} 
								  {{ method_field('PUT') }}
								     <input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
									
									<a href="{{ url('indicadores/associar/'.$projeto->id)}}">
									  <button  title="@php echo utf8_encode('Associar Indicador / Visualizar Indicadores do Projeto');@endphp" type="submite" class="btn btn-info" id="'btn-{{$projeto->id}}'">
										<i class="fa fa-exchange"> @php echo utf8_encode('Associar Indicador'); @endphp</i> 
									  </button></a>
								  </form>
								</div>
							  </td>
						
					  </tr>

					  @php 
					 $contadorFase = 1; 
					 $contadorIndicador= 0;
					 $contadorProjeto= 0;
					 @endphp
					 @endif
					@endforeach
					<!-- projetos fim-->
				</tbody>
			  </table>
			
			   <!-- Add Task Button -->
				
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-6">
							<button title="@php echo utf8_encode('Cancelar Operações');@endphp" type="button" id="btn-cancelar" class="btn btn-warning">
								<i class="fa fa-minus"> <b>Cancelar</b></i> 
							</button>
						</div>
					</div>

				</div>
			</div> 
			<script type="text/javascript">
						$(document).ready(function () {

							$('select').on('change', function() {
								if (this.value == '-1') {
									$('optgroup option').prop('disabled', true);
								} else {
									$('optgroup option').prop('disabled', false);
								}
							});

							

							$('#btn-cancelar').click(function () {
								$("* :button").attr("disabled", true);

								$("#fasedoProjeto :input").prop("disabled", true);

								$("* :checkbox").attr("disabled", true);
								$("#atualizar :input").attr("disabled", true);
								$("#buscarusuario :input").prop("disabled", true);
								
								$("#formOrdenar :input").prop("disabled", true);
								var texto = "";
								//$( "#mensagemCancelar" ).val() = '';
								$( "#mensagemCancelar" ).text('@php echo utf8_encode("Operação cancelada!"); @endphp');
								$( "#mensagemCancelar" ).css( "color", "red" ).find( ".special" ).css( "color", "green" );

								$( "#mensagemVoltar" ).text('@php echo utf8_encode("Clique no botão [Voltar para o Início] para retornar a tela inicial!"); @endphp');
								$( "#mensagemVoltar" ).css( "color", "green" );
								
								$("#btnvoltar").attr("disabled", false);
							});
							
							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-info').click(function (event) {
				
								event.preventDefault();
								var button = confirm("Quer Associar Indicador?");	// return true or false								
								if(button == true)
								{
										var form_id = $(this).closest('form').attr('id');																									
										$('#'+form_id).submit();
								}
							});
							
							/**--------------------------------------------------------------
								  ALTER CHECKBOX VALUE by Luiz Silva 09/08/2017 11:00:00
							--------------------------------------------------------------***/
							$('input[type="checkbox"]').change(function () {
								var name = $(this).val();
								var check = $(this).prop('checked');																								
								var check_id = $(this).attr('id');

							    //console.log("checkbox id: " + check_id + " ");

								var tamanho = check_id.length;
								var inicioIDuser =  $(this).attr('id').indexOf('-') +1;
								var stringh = check_id.substring(inicioIDuser, tamanho);
								var iduser = parseInt(stringh);
								var indiceCHAVE = $(this).attr('id').indexOf('ch');
								var resURLstring = check_id.substring(0, indiceCHAVE) ;
								var numeroRole = parseInt(resURLstring);

								//console.log( " numeroRole: " + numeroRole + "  iduser : "+ iduser);
								
								var urlaction =  $('form[id="form-' + iduser +'"]').closest('form').attr('action');
								var form_id = $('form[id="form-' + iduser +'"]').closest('form').attr('id');	
																					
								//console.log('action: ' + urlaction);
							   // console.log('form_id: ' + form_id);

								var tamanhoIdform = form_id.length;
								var inicioIdform =  form_id.indexOf('-') +1;
								var stringIdform = form_id.substring(inicioIdform, tamanhoIdform);
								var idUserform = parseInt(stringIdform);

								//console.log('idUserform: ' + idUserform);


								var lenthURL = urlaction.length;																
								var indiceURLrole = urlaction.indexOf("role/") + ("role/").length + 2;									
								var resURL = urlaction.substring(indiceURLrole, lenthURL);

								//console.log("resURL: " + resURL);	

								var val= resURL.split('/');
								//console.log('val inicial: ' + val);
								//console.log(" resURL:" + val);
								var valorurl = null;

								/**--------------------------------------------------------------
								    AO MARCAR UM CHECKBOX by Luiz Silva 09/08/2017 11:00:00
							   ---------------------------------------------------------------**/
								if ($(this).is(':checked')) {
									this.checked = confirm("Quer Marcar o Tipo?");	// return true or false								
									if(this.checked)
									{
										$(this).prop("checked", true);
										$(this).val($(this).is(':checked'));
									}
									
									if(this.checked)
									{

										//console.log(' AO MARCAR UM CHECKBOX');


										/**-------------------------------------------
											   ALTER THE URL
									    -------------------------------------------**/
										var selecionado = function (grupo) { 																	
											var result = $('input:checked'); 
											if (result.length > 0 ) { 
												var contador = result.length + " selecionado(s)<br/>"; 
										
										
												result.each(function () { 
													if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {
												
														if(numeroRole == 1){
															val[0] = 1;												    													
														}
														if(numeroRole == 2){
															val[1] = 1;
														}
														if(numeroRole == 3){
															val[2] = 1;													
														}
														if(numeroRole == 4){
															val[3] = 1;													
														}
														if(numeroRole == 5){
															val[4] = 1;													
														}
													}

													/*
													const input = 'role/1/1/0/0/0/0';
													const [url, user, role_admin, role_gerentep, role_lider_esc, role_liderp, role_membroad] = input.split('/');
													console.log(url); // 
													console.log(user); // 
													console.log(role_admin); // 
													console.log(role_gerentep); // 
													console.log(role_lider_esc); // 
													console.log(role_liderp); //
													console.log(role_membroad); // 
													*/

													contador += $(this).val() + " "
													//console.log(contador);
												}); 
												//$('#divFiltros').html(contador); 
										
											} 
											else { 
												//$('#divFiltros').html("Nenhum selecionado"); 
											} 
											//console.log("REsult: ------------");
											//console.log(result);
											if( typeof idUserform != "undefined" && typeof iduser != "undefined"){
												if( iduser == idUserform){	
												    //console.log(' AO MARCAR UM CHECKBOX');
												    

													valorurl = val[0] +'/'+ val[1] +'/'+ val[2] +'/'+ val[3] +'/'+ val[4] ;
													//console.log(" valorurl------------------> " + valorurl);									
													var finalResultadoURL = urlaction.substring(0, indiceURLrole) + valorurl ;

													//$(form_id).attr( 'action', finalResultadoURL);
													$('#'+form_id).attr('action', finalResultadoURL);
													//console.log("finalResultadoURL: ------------");
													//console.log(finalResultadoURL);
												}									
											}									
										}; 

										selecionado($(this));

									}
								}
								/**---------------------------------------------------------------
								    AO DESMARCAR UM CHECKBOX by Luiz Silva 09/08/2017 11:00:00
							   ---------------------------------------------------------------**/
								if (!$(this).is(':checked')) {
									this.checked = confirm("Quer Desmarcar o Tipo?");  // return true or false								
									if(this.checked)
									{
										$(this).prop("checked", false);
										$(this).val(!$(this).is(':checked'));										
									}
									if(!this.checked)
									{
										//console.log(' AO DESMARCAR UM CHECKBOX');
										/**----------------------------------------------------------------------------
														ALTERA O URL
										----------------------------------------------------------------------------**/
										/***----------------------- by Luiz-----------------------------------------------------------
											   Case don't have marked checkbox, Don't pass in test  result.length (empty)
										-------------------------------------------------------------------------------------------**/
										if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {												
											if(numeroRole == 1){												
												val[0] = 0;																																							    													
											}
											if(numeroRole == 2){
												val[1] = 0;
											}
											if(numeroRole == 3){
															val[2] = 0;													
											}
											if(numeroRole == 4){
												val[3] = 0;													
											}
											if(numeroRole == 5){
												val[4] = 0;													
											}
											if(numeroRole == 6){
												val[5] = 0;													
											}
										}
										/***---------------------------by luiz --------------------------------------------------------
											   Case EXISTS one or more marked checkbox. Pass in test  result.length (don't empty)
										-------------------------------------------------------------------------------------------**/

										var selecionado = function (grupo) { 																	
											var result = $('input:checked'); 
											if (result.length > 0 ) { 
												var contador = result.length + " selecionado(s)<br/>"; 
																				
												result.each(function () { 
													if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {
												
														if(numeroRole == 1){											
															val[0] = 0;											    													
														}
														if(numeroRole == 2){
															val[1] = 0;
														}
														if(numeroRole == 3){
															val[2] = 0;													
														}
														if(numeroRole == 4){
															val[3] = 0;													
														}
														if(numeroRole == 5){
															val[4] = 0;													
														}
														if(numeroRole == 6){
															val[5] = 0;													
														}
													}


													contador += $(this).val() + " "
													//console.log(contador);
												}); 
												//$('#divFiltros').html(contador); 
										
											} 
											else { 
												//$('#divFiltros').html("Nenhum selecionado"); 
											} 
											//console.log("REsult: ------------");
											//console.log(result);
											if( typeof idUserform != "undefined" && typeof iduser != "undefined"){
												if( iduser == idUserform){	
													valorurl = val[0] +'/'+ val[1] +'/'+ val[2] +'/'+ val[3] +'/'+ val[4] ;
													//console.log(" valorurl------------------> " + valorurl);								
													var finalResultadoURL = urlaction.substring(0, indiceURLrole) + valorurl ;

													//$(form_id).attr( 'action', finalResultadoURL);
													$('#'+form_id).attr('action', finalResultadoURL);
													//console.log("finalResultadoURL: ------------");
													//console.log(finalResultadoURL);
												}									
											}									
										}; //FIM FUNÇÃO
										selecionado($(this));
									}//FIM IF DESCMARCAR
								}// FIM DESMARCAR

							});/* FIM input*/

						 }); /* end jquerry */
					</script>			
			@endif
		</div>
	</div>
</div>
	@endsection