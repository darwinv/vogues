<?php
include_once "clases/publicaciones.php";
if(isset($_GET["tipo"])){
	if($_GET["tipo"]=='activas' or $_GET["tipo"]=='admin')
	$tipo=1;
	if($_GET["tipo"]=='pausadas')
	$tipo=2;
	if($_GET["tipo"]=='finalizadas')
	$tipo=3;
}else{
	$tipo=1;
}
$pagina=1;
$total=$usua->getCantidadPub($tipo); 
switch($tipo){
	case 1:
		$clasesP1="active pesta";
		$clasesP2="pesta";
		$clasesP3="pesta";
		break;
	case 2:
		$clasesP1="pesta";
		$clasesP2="active pesta";
		$clasesP3="pesta";
		?>
		<script>
		loadingAjax(true);
		tipo=2;
		$.ajax({
			url:"paginas/venta/fcn/f_ventas.php",
			data:{metodo:"buscarPublicaciones",tipo:tipo},
			type:"POST",
			dataType:"html",
			success:function(data){
				console.log(data);
				$("#publicaciones").html(data);
				loadingAjax(false);
			}
		});	
		</script>
		<?php		
		break;
	case 3:
		$clasesP1="pesta";
		$clasesP2="pesta";
		$clasesP3="active pesta";
		?>
		<script>
		loadingAjax(true);
		tipo=3;
		$.ajax({
			url:"paginas/venta/fcn/f_ventas.php",
			data:{metodo:"buscarPublicaciones",tipo:tipo},
			type:"POST",
			dataType:"html",
			success:function(data){
				console.log(data);
				$("#publicaciones").html(data);
				loadingAjax(false);
			}
		});	
		</script>
		<?php				 		
		break;
}
?>
<script type="text/javascript">
    var id;
	function pasavalores(b){
		 id = $("#b" + b).data('id');
 		 $('#titulo').val($("#b" + b).data('titulo'));
 		 $('#monto').val($("#b" + b).data('monto'));
 		 $('#stock').val($("#b" + b).data('stock'));
 		 $("#btn-social-act").data("id",$("#b" + b).data('id'));
 		 $("#btn-social-act").data("url_video",$("#b" + b).data('url_video'));
 		 $("#btn-social-act").data("metodo","actualizar");
 		 $("#tituloVentana").html("Editar Publicaci&oacute;n");
         $("#masDetalles").css("display","block");
         $("#comando").text("Actualizar");         
	}
	function republicarPublicacion(elId,categ){
        id = $("#b" + elId).data('id');
 		$('#titulo').val($("#b" + elId).data('titulo'));
 		$('#monto').val($("#b" + elId).data('monto'));
 		$('#stock').val($("#b" + elId).data('stock'));
 		$("#btn-social-act").data("id",$("#b" + elId).data('id'));
 		$("#btn-social-act").data("metodo","republicar");
        $("#tituloVentana").html("Republicar");
        $("#masDetalles").css("display","none");
        $("#comando").text("Guardar");        
        
       // actualizarTitulo(3,1,3); /**no se quien programo esto, pero si puedes, borralo y construyelo <-- si te sientes igual, comenta abajo */
        
       eliminarPublicacion(elId,categ,1);
       actualizarTitulo(1,1,4);
        
	}	
	function modificarOpciones(elId,tipo,origen,categ){
		var bandera=0;
		if(tipo!=origen){
			$("#btnOpciones" + elId).addClass("hidden");
			$("#b" + elId).addClass("hidden");
		}else{
			$("#btnOpciones" + elId).removeClass("hidden");
			$("#b" + elId).removeClass("hidden");
			if(!$("#menFin" + elId).hasClass("hidden")){
				bandera=3;
			}else if(!$("#menPau" + elId).hasClass("hidden")){
				bandera=2;
			}else if(!$("#menAct" + elId).hasClass("hidden")){
				bandera=1;
			}						
		}
		
		if(origen==1){
			if(origen!=tipo){
				$("#btnReactivar" + elId).removeClass("hidden");
			}else{
				$("#btnReactivar" + elId).addClass("hidden");
				$("#menPau" + elId).addClass("hidden");
				$("#menFin" + elId).addClass("hidden");
				$("#menAct" + elId).addClass("hidden");
			}	
			if(tipo==2){
				if(origen!=tipo){
					$("#menPau" + elId).removeClass("hidden");
				}else{
					$("#menPau" + elId).addClass("hidden");
					$("#menFin" + elId).addClass("hidden");
					$("#menAct" + elId).addClass("hidden");
				}
			}else if(tipo==3){
				if(origen!=tipo){
					$("#menFin" + elId).removeClass("hidden");
				}else{
					$("#menPau" + elId).addClass("hidden");
					$("#menFin" + elId).addClass("hidden");
					$("#menAct" + elId).addClass("hidden");
				}
			}
		}else if(origen==2){
			if(origen!=tipo){
				$("#btnPausar" + elId).removeClass("hidden");
			}else{
				$("#btnPausar" + elId).addClass("hidden");
			}
			if(tipo==1){
				if(origen!=tipo){
					$("#menAct" + elId).removeClass("hidden");
				}else{
					$("#menPau" + elId).addClass("hidden");
					$("#menFin" + elId).addClass("hidden");
					$("#menAct" + elId).addClass("hidden");
				}
			}else if(tipo==2){
				if(origen!=tipo){
					$("#menAct" + elId).removeClass("hidden");
				}else{
					$("#menPau" + elId).addClass("hidden");
					$("#menFin" + elId).addClass("hidden");
					$("#menAct" + elId).addClass("hidden");
				}				
			}else if(tipo==3){
				if(origen!=tipo){
					$("#menFin" + elId).removeClass("hidden");
				}else{
					$("#menPau" + elId).addClass("hidden");
					$("#menFin" + elId).addClass("hidden");
					$("#menAct" + elId).addClass("hidden");
				}
			}
		}else if(origen==3){
			if(origen!=tipo){
				$("#btnFinalizar" + elId).removeClass("hidden");
			}else{
				$("#btnFinalizar" + elId).addClass("hidden");
			}
			if(tipo==1){
				if(origen!=tipo){
					$("#menRep" + elId).removeClass("hidden");
					$("#menEli" + elId).removeClass("hidden");
				}else{
					$("#menPau" + elId).addClass("hidden");
					$("#menFin" + elId).addClass("hidden");
					$("#menAct" + elId).addClass("hidden");
				}
			}
			if(tipo==3){
				if(origen!=tipo){
					$("#menRep" + elId).removeClass("hidden");
					$("#menEli" + elId).removeClass("hidden");
				}else{
					$("#menPau" + elId).addClass("hidden");
					$("#menFin" + elId).addClass("hidden");
					$("#menAct" + elId).addClass("hidden");
					$("#menRep" + elId).addClass("hidden");
					$("#menEli" + elId).addClass("hidden");
				}
			}
		}
		$.ajax({
			url:"paginas/venta/fcn/f_ventas.php",
			data:{metodo:"cambiarStatus",id:elId,tipo:tipo,anterior:origen,categ:categ},
			type:"POST",
			dataType:"html",
			success:function(data){
				//console.log(data);	
				actualizarTitulo(origen,tipo,bandera);
			}
		});
	}	
	
	function actualizarTitulo(origen,destino,bandera){
		if(destino!=4){
			var t1=parseInt($("#titulo" + destino).text());console.log(t1);
			$("#titulo" + destino).text(t1+1);
			if(origen!=destino){
				var t2=parseInt($("#titulo" + origen).text());			
				$("#titulo" + origen).text(t2-1);
			}else{	
				var t2=parseInt($("#titulo" + bandera).text());			
				$("#titulo" + bandera).text(t2-1);
			}
		}else{
			var t1=parseInt($("#titulo3").text());			
			$("#titulo3").text(t1-1);		
		}
	}
	
	function eliminarPublicacion(elId,categ,tipo){
		$.ajax({
			url:"paginas/venta/fcn/f_ventas.php",
			data:{metodo:"cambiarStatus",id:elId,tipo:tipo,anterior:3,categ:categ},
			type:"POST",
			dataType:"html",
			success:function(data){
				var pagina=1;
				$.ajax({
					url:"paginas/venta/fcn/f_ventas.php",
					data:{metodo:"buscarPublicaciones",tipo:3,pagina:pagina},
					type:"POST",
					dataType:"html",
					success:function(data){
						$("#publicaciones").html(data);
						actualizarTitulo(3,4,0);
					}
				});					
			}
		});		
	}
	
</script>
<div class="row" id="principal" data-tipo="<?php echo $tipo;?>">
	<!-- inicion del row principal  -->

	<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 maB10  " >
		<!-- inicio contenido  -->

		<div class=" contenedor">
			<!-- inicio contenido conte1-1 -->

			<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 marB10 marT10   ">
				<!-- inicio titulo y p  -->

				<h4 class=" marL20 marR20 t20 negro" style="padding:10px;"><span class="marL10 titulo">Mis publicaciones</span></h4>
				<center>
					<hr class='ancho95'>
				</center>
				<br>

		<ul class="nav nav-tabs marL30 marR30 t14 " >
					<li role="presentation" class="<?php echo $clasesP1;?>" id="irActivas">
						<a class="point" class="grisO">Activas <span class="badge badge-publicar-antes" id="titulo1" name="titulo1"><?php echo $usua->getCantidadPub(1);?></span></a>
					</li>
					<li role="presentation" class="<?php echo $clasesP2;?>" id="irPausadas">
						<a class="point" class="grisO">Pausadas <span class="badge badge-publicar-antes" id="titulo2" name="titulo2"><?php echo $usua->getCantidadPub(2);?></span></a>
					</li>
					<li role="presentation" class="<?php echo $clasesP3;?>" id="irFinalizadas">
						<a class="point" class="grisO">Finalizadas <span class="badge badge-publicar-antes" id="titulo3" name="titulo3"><?php echo $usua->getCantidadPub(3);?></span></a>
					</li>
				</ul>

			</div>

			<div class='col-sm-12 col-md-5 col-lg-4 marB10 '>

				<form action="" method="GET"
				class="navbar-form navbar-left  marT15 marL30 " role="search">
				<div class="input-group" style="">
					<span class="input-group-btn">
						<button class="btn-header btn-default-header" style="border: #ccc 1px solid; border-right:transparent;"
							>
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</span> <input style="margin-left: -10px; border: #ccc 1px solid; border-left:1px solid #FFF;  "
						 type="text" class="form-control-header " placeholder="Buscar" id="txtBusqueda" name="txtBusqueda">						 
				</div>
				<div id="busqueda" name="busqueda" class="hidden  pad10  " style="   width: 308px; background: #FAFAFA;" data-usuario='<?php echo $_SESSION["id"]; ?>'>Publicaciones:</div>
			</form>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 marB10 marT15" >
				<div class=" btn-group marL30 ">
					<button type="button" class="btn btn-default">
						Filtrar
					</button>
					<button type="button" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a class="point">Mas ventas</a>
						</li>
						<li>
							<a class="point">Menos ventas </a>
						</li>

					</ul>
				</div>

			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marB10 marT10">

				<div class="marL30 marR20" style="background: #F2F2F2;">

					<table width="100%" class="alto50" border="0" cellspacing="0" cellpadding="0" >
						<tr>
						
						<td  width="75%"  align="right">
							<span class="marR10">Publicaciones <?php if($total==0){ echo "0 - 0"; }else{ if($total>=25) echo "25"; else echo $total;}?> de <b><?php echo $total;?></b>		
							</span>
						</td>
							
							
									
									
							
							<td   width="15%"  align="right" height="40px;" >
							<select id="filtro" class="form-control  input-sm " style="width:auto; margin-right:20px;">
								<option value="desc" >Mas Recientes</option>
								<option value="asc" >Menos Recientes </option>
							</select></td>
						</tr>
					</table>

				</div>

			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marB10 marT10"></div>

			<div class='row  marB10 marT10 marL50 marR30'>
				<!--<div class='hidden-xs hidden-sm  col-md-1 col-lg-1 t12  ' >
					<div class=' marR10 pull-right'  style='  width: 18px; height:18px; border: 0px;   '>
						<INPUT TYPE=CHECKBOX  style=' width:100% ; height:100%;  '>
					</div>
				</div>-->
 

				<!-- INICIO de detalle del listado de publicaciones -->
			<div id="noresultados" name="noresultados" class="container center-block col-xs-12 col-sm-12 col-md-12 col-lg-12 " <?php if($total>0) echo 'style="display:none"';?>  >	
			<br>
				<br>
			<div class='alert alert-warning2  text-center' role='alert'  >                                        	
	              	<span class="t16  "><i class="fa fa-info-circle"></i> No se encontraron publicaciones.</span>
	         </div>
	         <br>  
	        </div>				
			<div id="publicaciones">
				<?php
				
				
				$contador=0;
				//foreach ($hijos as $key => $valor) {}
				echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 marB10 marT10'>
				<nav class='text-center'>
				  <ul class='pagination'>";
								
								$totalPaginas=floor($ac/25);
								$restantes=$ac-($totalPaginas*25);
								if($restantes>0){
									$totalPaginas++;
								}
								echo"</div><div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 ' id='paginas' name='paginas' data-metodo='buscarPublicaciones' data-tipo='1' data-id='" . $usua->id . "' > <center><nav><ul class='pagination'>";
								$contador=0;
								if($pagina<=10){
									$inicio=1;
								}else{
									$inicio=floor($pagina/10);
									if($pagina % 10!=0){
										$inicio=($inicio*10)+1;
									}else{
										$inicio=($inicio*10)-9;
									}									
								}
								 								 
								for($i=$inicio;$i<=$totalPaginas;$i++){
									$contador++;
									if($i==1){
										echo "<li class='active' style='cursor:pointer'><a class='botonPagina' data-pagina='" . $i ."'>$i</a></li>";
									}else{
										echo "<li class='' style='cursor:pointer'><a class='botonPagina' data-pagina='" . $i ."'>$i</a></li>";
									}
									if($contador==10){
										break;
									}
								}
				 if($totalPaginas>0){
				 echo "<li>
				      <a href='#' aria-label='Next'>
				        <span aria-hidden='true'>&raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
				</div>";
				}
				if($contador==0){
					?>
					<script>
			  		$("#noresultados").removeClass("hidden");
			  		$("#publicaciones").addClass("hidden");
			  		</script>		  	
				<?php
				}else{
					?>
					<script>
			  		$("#noresultados").addClass("hidden");
			  		$("#publicaciones").removeClass("hidden");
			  		</script>
			  		<?php		  						
				}
				?>
				</div>
				<!-- FIN del detalle del listado -->

			</div>

		</div>
		<!-- fin contenido conte1-1 -->

	</div >
	<!-- fin de contenido -->

</div>
<!-- fin de row principal  -->

