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
	@if(Session::has('message_error_informar'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message_success_informar'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message'))
		{{ Session::get('message') }}
	@endif




	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">	


            <div class="panel panel-heading">
                <div class="col-sm-offset-0 col-sm-0">                          
                     <a href ="{{ url('indicadores/informar') }}">  <button title="Voltar para a tela Anterior" type="button" id="btnvoltar" class="btn btn-success">
                                <i class="fa fa-chevron-left"> Voltar </i> 
                    </button></a>
                </div>
                <center><h3><b>Informar Valores do Indicador</b></h3></center>

             </div>

             <center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>	
                  

		@if ( is_null($projeto) )	
			<center><div style="background-color: white;"><b><p class="danger"><b>@php utf8_encode('Projeto n�o foi encontrado!'); @endphp </b></p></div></center>	
		@endif
		@if (!is_null($projeto) > 0)
			<div class="panel panel-default">
				<div class="panel alert-info">
					@php echo '<center>Projeto:&nbsp;<p><b>'.$projeto->nome.'</b></p></center>'; @endphp				
				</div>
				<div class="panel-body">
				
			
				<div class="form-group navbar-form">
					@if (count($fases) == 1)
						<output><b>@php echo utf8_encode('Possui Indicador Associado � Fase?'); @endphp</b></output>
					@elseif (count($fases) > 1)
						<output><b>@php echo utf8_encode('Possui Indicadores Associados �s Fases?'); @endphp</b></output>
					@endif

					<!-- Fase Associada com indicadorSim ou n�o  -->
					@if( $projeto->isQualIndicador( $projeto->id) )
						<label for="1ch-associado" class="col-md-4 control-label"><b style="color:green;">@php echo utf8_encode('Sim'); @endphp</b></label>
						<hr/>
					@else
						<label for="1ch-associado" class="col-md-4 control-label"><b style="color:red;">@php echo utf8_encode('N�o'); @endphp</b></label>
						<hr/>
					@endif
					<br>
				  </div>
				  <div class="">			
					@if($projeto->isQualIndicador( $projeto->id))													  
							<!-- Indicador  -->
							<div class="form-group navbar-form">
								<output><b>@php echo utf8_encode('Fase - Indicador:'); @endphp</b></output>								
								@php
									$contadorIndicador = 0;
									$indicadores = $projeto->indicadoresDoProjeto( $projeto->id); 
								@endphp												
								@foreach($indicadores as $indic)
									@if($projeto->isQualIndicador( $projeto->id))
										@php if($contadorIndicador%2===0){ echo '<output style="background-color:lightgray;">';}else{echo '<output style="background-color:lien;">';} @endphp		
											 {{ $indic->nomeFase($indic->fase_id) }} - {{ $indic->nome }}
										@php echo '</output> '; $contadorIndicador = $contadorIndicador + 1; @endphp
									@endif										
								@endforeach
							</div>							  
					@endif
				 </div>

				<div class="panel-body">
				<!-- Display Validation Errors -->
				@include('common.erros')

				<!-- New Projeto Form -->
				<form id="form-cadastro" action="{{ url('indicadores/valores/'.$projeto->id) }}"  method="POST">
					{!! csrf_field() !!}
					{{ method_field('PUT') }}
					<div class="form-group navbar-form">
						    <label for="fasedoProjeto" class="control-label">@php echo utf8_encode('Atual Fase do Projeto:'); @endphp </label>
							@php
								$contadorIndicador = 0;
								$indicadores = $projeto->indicadoresDoProjeto( $projeto->id);							
							@endphp
							@if((!is_null($indicadores)) && (count($indicadores) > 0))
							
								@foreach($indicadores as $indic)
									@if($projeto->isQualIndicador( $projeto->id))
										<input type="hidden" name="relacaoFaseProjeto" id="relacaoFaseProjeto" value="{{$indic->id}}" class="form-control">
									@endif										
								@endforeach				  
								<select  disabled class="form-control m-b" name="fasedoProjetoDisabled" id="fasedoProjetoDisabled" >
									<option value="" disabled="" selected="">Selecione a Fase</option>
										@foreach($indicadores as $indic)
											@if($projeto->isQualIndicador( $projeto->id))
												<option selected="" value="{{ $indic->fase_id }}">{{ $indic->nomeFase($indic->fase_id)  }}</option>
											@else
												<option value="{{  $indic->fase_id }}" >{{ $indic->nomeFase($indic->fase_id) }}{{$indic->id}}</option>
											@endif
										@endforeach				  
								</select>
							
							@endif	
							
					</div>
					<div class="form-group navbar-form">
						    <label for="indicadorProjeto" class="control-label">Selecionar Indicador: </label>						
							<select class="form-control m-b" name="indicadorProjeto">
									@foreach($indicadores as $indicador)	
										
										<option value="{{ $indicador->id }}">{{ $indicador->nome }} - {{ $projeto->faseDoProjetoFaseNome($projeto->id, $indicador->fase_id) }}</option>
									
									@endforeach				  
							 </select>
					</div>
					 <div class="form-group navbar-form">
                            <label for="valormaximo" class="control-label">Informar Valor:</label>

                       
                                <input id="valormaximo" type="number" class="form-control" name="valormaximo" value="{{ old('valormaximo') }}" min="0" max="99999999999" required autofocus="true"a onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" onclick="this.value=this.value.replace(/[^0-9]/g,'');">

                                @if ($errors->has('valormaximo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valormaximo') }}</strong>
                                    </span>
                                @endif
                          
                        </div>
				<!--
                        <div class="form-group navbar-form">
                            <label for="valorminimo" class="control-label">@php echo utf8_encode('Valor M�nimo:'); @endphp</label>

                  
                                <input id="valorminimo" type="number" class="form-control" name="valorminimo" value="{{ old('valorminimo') }}" min="0" max="99999999999" required onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" onclick="this.value=this.value.replace(/[^0-9]/g,'');">

                                @if ($errors->has('valorminimo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valorminimo') }}</strong>
                                    </span>
                                @endif
                          
                        </div>
					-->
					<!-- Add Task Button -->
					
					<div class="form-group navbar-form">
						<div class="col-sm-offset-3 col-sm-6">
						
						     <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" class="form-control">
							 <input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
							<a href="{{ url('indicadores/valores/'.$projeto->id)}}">
								<button  title="@php echo utf8_encode('Informar Valor do Indicador');@endphp" type="submite" class="btn btn-primary" id="'btn-{{$projeto->id}}'">
									<i class="fa fa-bar-chart"> @php echo utf8_encode('Informar Valore'); @endphp</i> 
								</button></a>
						</div>
					</div>
				</form>
			</div>

			
			   <!-- Add Task Button -->
				
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-6">
							<button title="@php echo utf8_encode('Cancelar Opera��es');@endphp" type="button" id="btn-cancelar" class="btn btn-warning">
								<i class="fa fa-minus"> <b>Cancelar</b></i> 
							</button>
						</div>
					</div>

				</div>
			</div> 
			<script type="text/javascript">
						$(document).ready(function () {
							//$("#btnvoltar").attr("disabled", true);
							$('#btn-cancelar').click(function () {
								$("* :button").attr("disabled", true);
								$("* :checkbox").attr("disabled", true);
								$("#atualizar :input").attr("disabled", true);
								$("#buscarusuario :input").prop("disabled", true);
								
								$("#form-cadastro :input").prop("disabled", true);
								var texto = "";
								//$( "#mensagemCancelar" ).val() = '';
								$( "#mensagemCancelar" ).text('@php echo utf8_encode("Opera��o cancelada!"); @endphp');
								$( "#mensagemCancelar" ).css( "color", "red" ).find( ".special" ).css( "color", "green" );

								$( "#mensagemVoltar" ).text('@php echo utf8_encode("Clique no bot�o [Volta] para retornar a tela anterior!"); @endphp');
								$( "#mensagemVoltar" ).css( "color", "green" );
								
								$("#btnvoltar").attr("disabled", false);
							});
							
							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-primary').click(function (event) {
				
								event.preventDefault();
								var button = confirm("Quer enviar os dados?");	// return true or false								
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
										}; //FIM FUN��O
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