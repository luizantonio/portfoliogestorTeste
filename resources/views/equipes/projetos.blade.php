@extends('layouts.app')
@section('content')

	<head>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="   asset('css/bootstrap-theme.min.css')"> -->


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
            /*.dropdown-submenu {
                position: relative;
            }
            .dropdown-submenu>.dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
                -webkit-border-radius: 0 6px 6px 6px;
                -moz-border-radius: 0 6px 6px 6px;
                border-radius: 0 6px 6px 6px;
            }
            .dropdown-submenu:hover>.dropdown-menu { 
				background-color: lightgreen;
                display: block;
            }
            .dropdown-submenu>a:after {
                display: block;
                content: " ";
                i: right;
                width: 0;
                height: 0;
                border-color: transparent;
                border-style: solid;
                border-width: 5px 0 5px 5px;
                border-left-color: #cccccc;
                margin-top: 5px;
                margin-right: -10px;
            }
            .dropdown-submenu:hover>a:after {
                border-left-color: #ffffff;
            }
            .dropdown-submenu.pull-left {
                float: none;
            }
            .dropdown-submenu.pull-left>.dropdown-menu {
                left: -100%;
                margin-left: 10px;
                -webkit-border-radius: 6px 0 6px 6px;
                -moz-border-radius: 6px 0 6px 6px;
                border-radius: 6px 0 6px 6px;
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
            float: left;
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
            color: red; /*    white;  */
            margin-left: 3px;
        }
        li > i {
            color: black;  /*  color: white;  */
        }
        .column-wrap a {
            color: #5c34c2;
            font-weight: 600;
            font-size:16px;
            line-height:24px;
        }
        .column-wrap p {
            color: gray;  /*     #717171; */
            font-size:16px;
            line-height:24px;
            font-weight:300;
        }
        .container {
            margin-top: 100px;
        }
        .navbar {
            background-color: black;
            position: relative;
            min-height: 45px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }
        .navbar-brand {
            float: left;
            height: auto;
            padding: 10px 10px;
            font-size: 18px;
            line-height: 20px;
        }
        .navbar-nav>li>a {
            padding-top: 11px;
            padding-bottom: 11px;
            font-size: 13px;
            padding-left: 5px;
            padding-right: 5px;
        }
        .navbar-nav>li>a:hover {
            text-decoration: none;
            color: #cdc3ea!important;
        }
        .navbar-nav>li>a i {
            margin-right: 5px;
        }
        .nav-bar img {
            position: relative;
            top: 3px;
        }
        .congratz {
            margin: 0 auto;
            text-align: center;
        }
        .message::before {
            content: " ";
           background: url();
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
            color: red !important; /*   color: #646464 !important; */
            font-size: 12px;
        }
        .copyright {
            color: yellow !important; /*  color: #646464 !important; */
            font-size: 12px;
        }
        .navbar a {
            color: color: white !important;
        }
        .navbar {
            border-radius: 0px !important;
        }
        .navbar-inverse {
            background-color: *#434343;
            border: none;
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
        }
    }
</style>
</head>
    
<div class="container">
@if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>';
@endif




	@php echo utf8_encode('<center><h3><b>Remover o membro da Equipe do Projeto</b></h3></center>'); @endphp
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">	
					<div class="form-group">
						<div class="col-sm-offset-0 col-sm-0">						    
							<a href ="{{ url('equipes/show') }}"> <button title="@php echo utf8_encode('Voltar para a tela Anterior');@endphp" type="button" id="btnvoltar" class="btn btn-success">
								<i class="fa fa-chevron-left"> Voltar</i> 
							</button></a>
						</div>
						<center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>
					</div>		
                  

		@if (count($projetos) <= 0 || $projetos == null)	
			<center><div style="background-color: white;"><h3><b><p class="danger"><b>@php utf8_encode('Projeto não foi encontrado!'); @endphp </b><h3></div></center>	
		@endif
		@if (count($projetos) > 0)
			<div class="panel panel-default">
				<div class="panel alert-info">Membro:
					@if(!is_null($membro)) 
							@php echo '<center><b>'.$membro->nome.'</b></center>'; @endphp					
					@endif				
				</div>
				<div class="panel-body">
				
				  <div class="">			
					<table class="table table-striped table-hover">
						<!--  Table Headings -->
						<thead>
							<th>Est&aacute; na equipe do projeto</th>							
							<th>&nbsp;</th>
					
						</thead>
						<!--  Table Body -->
						<tbody>
							@foreach ($projetos as $projeto)		
									
								<tr>								
									<!-- Atributos -->
									<td class="table-text">
										<div>{{ $projeto->nome }}</div>
									</td>

									<td>
										<!-- Deletar -->
										<form id="form_idDEL-{{ $membro->id }}" action="{{ url('equipe/'.$membro->id)}}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<input type="hidden" name="membro_id" id="membro_id" value="{{$membro->id}}" class="form-control">
											<input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
											<button type="submit" id="delete-projeto-{{ $membro->id }}" class="btn btn-danger" title="@php echo utf8_encode('remover membro da equipe deste projeto');@endphp">
												<span class="glyphicon glyphicon-remove" aria-hidden="true"> Remover da Equipe deste Projeto</ispan>
											</button>
														
										</form>
									</td>
																		
							</tr>
							@endforeach 
						</tbody>
					</table>

				</div>

				<div class="panel-body">
				<!-- Display Validation Errors -->
				@include('common.erros')


				</div>

			
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
							
							$('#btn-cancelar').click(function () {
								$("* :button").attr("disabled", true);
								$("* :checkbox").attr("disabled", true);
								$("#atualizar :input").attr("disabled", true);
								$("#buscarusuario :input").prop("disabled", true);
								
								$("#form-cadastro :input").prop("disabled", true);
								var texto = "";
								//$( "#mensagemCancelar" ).val() = '';
								$( "#mensagemCancelar" ).text('@php echo utf8_encode("Operação cancelada!"); @endphp');
								$( "#mensagemCancelar" ).css( "color", "red" ).find( ".special" ).css( "color", "green" );

								$( "#mensagemVoltar" ).text('@php echo utf8_encode("Clique no botão [Volta] para retornar a tela anterior!"); @endphp');
								$( "#mensagemVoltar" ).css( "color", "green" );
								
								$("#btnvoltar").attr("disabled", false);
							});
							
							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-danger').click(function (event) {
				
								event.preventDefault();
								var button = confirm("Quer realmente excluir o membro desta equipe?");	// return true or false								
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