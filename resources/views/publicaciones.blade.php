
	@if (isset($articulos))
	    @foreach ($articulos as $art )
	    	@if(isset($art['medico'][0]['img']))
	        <div class="card card-widget border-0 ">
	            <div class="card-header">
	            	<div class="user-block text-dark">
	            		<a href="{{url('medico/info/'.encrypt($art['iduser']))}}" >
							<img class="img-circle" 
								src="
									@if(isset($art['medico'][0]['img']) && $art['medico'][0]['img']!=null)
										@if(\Storage::disk('diskDocumentosPerfilUser')->exists($art['medico'][0]['img'])) 
										  	{{ asset($art['medico'][0]['img'])}}
										@else 
										 	{{ \Storage::disk('wasabi')->temporaryUrl($art['medico'][0]['img'], now()->addMinutes(3600)  ) }}
										@endif
									@else 
										{{ asset('img/user.png')}}
									@endif
									" 
								alt="User Image">
	            		</a>
	            		<span class="username">{{$art['titulo']}}| <small><b>Tratamiento</b></small> </span>
	            		<span class="description text-dark"><a href="{{url('medico/info/'.encrypt($art['iduser']))}}">{{$art['medico'][0]['name']}} </a>- @if(isset($art->created_at)) {{$art->created_at->isoFormat('lll') }} @endif </span>
	            	</div>
	            	<div class="card-tools">
	            		{{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
	            			<i class="fas fa-minus"></i>
	            		</button> --}}
	            	</div> 
	            </div>
	          	<div class="card-body ">
					<p class="text-justify text-dark text-descript-publicaciones ">
				  		{{$art['descripcion']}} <a href="{{$art['vinculo_art']}}" target="_blank" onclick="acctionVermas('{{encrypt($art['idarticulo'])}}')">Ver más... </a>
				  	</p> 
					<div class="embed-responsive embed-responsive-16by9"  {{-- onmouseleave ="acctionVideo('{{encrypt($art['idarticulo'])}}',this)"  --}}>
				  	<iframe id=""  width="560" height="315" src="{{$art['url_video']}}"  frameborder="0" allowtransparency="true" allowfullscreen ></iframe>
					</div>
	          	</div>
	          
		        <div class="card-footer p-0">
		            <div class="row justify-content-end">
		              	<div class="col-lg-12 text-right p-0">
			                <button type="button"  onclick="putLike_poin('{{encrypt($art['idarticulo'])}}',this )" class=" btn btn-app border-0">
			                	<i class=" fa fa-heartbeat @if(isset($art['like'][0])) icon-info    @else   @endif  "></i>  {{-- {{$art['like_count']}} Me gusta --}}
			                  <span >{{$art['like_count']}} </span> Me gusta 
			                </button>
		               	
			               	<div class="dropdown text-right float-right mr-4">
			               	  <button class="btn border-0 btn-app dropdown-toggle  btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			               	  <i class=" fa fa-bookmark"></i>Guardar
			               	  </button>
			               	  <div class="dropdown-menu dropdown-menu-p-contact" aria-labelledby="dropdownMenu1">
			               	    <button class="dropdown-item" type="button" onclick="saveArtUser('{{encrypt($art['idarticulo'])}}')"> <i class="fa fa-save"></i> Guardar</button>
			               	    <button class="dropdown-item" type="button" onclick="acctionContacOnline('{{encrypt($art['idarticulo'])}}')"><i class="fa fa-phone"></i> Contacto Online</button>
			               	    <button class="dropdown-item" type="button" onclick="acctionContactW('{{encrypt($art['idarticulo'])}}')"><i class="fab fa-whatsapp"></i> Contacto Whatsapp</button>
			               	  </div>
			               	</div>
			               	<div class="dropdown text-right float-right ">
			               	  	<button class="btn btn-app border-0 dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
			               	  		<i class="fa fa-share-alt"></i>  Compartir
			               	  	</button>
			               	  	<div class="dropdown-menu dropdown-menu-p-share" aria-labelledby="dropdownMenu1">
			               	    	<a onclick="acctionCompartirF('{{encrypt($art['idarticulo'])}}')"  class="dropdown-item" type="button" href="https://www.facebook.com/sharer/sharer.php?u={{$art['url_video']}}" target="_blank">
			               	      		<i class="fab fa-facebook" ></i> Facebook
			               	    	</a>
			               	     	<a onclick="acctionCompartirW('{{encrypt($art['idarticulo'])}}')"  class="dropdown-item" type="button" href="https://api.whatsapp.com/send/?phone&text=Hola!.%20Te%20acabo%20de%20compartir%20*{{$art['titulo']}}*%20creo%20que%20te%20podria%20interesar.%20Rev%C3%ADsala:%20https://option2health.com/share.html?prodId={{ $art['idarticulo_encryp']}}%20%20*Option2health*.&app_absent=0" target="_blank">
			               	      		<i class="fab fa-whatsapp"></i> Whatsapp 
			               	    	</a>
			               	  	</div>
			               	</div>
		              	</div>
		              
		            </div>
		        </div>
	        </div>
	        @endif
	    @endforeach
		<div class="form-group text-center mx-auto ">
		   {{-- {{ $articulos->links() }} --}}
		</div>
	@endif


{{-- <div class="card card-widget ">
	<div class="card-header">
		<div class="user-block">
			<img class="img-circle" src="/img/user1-128x128.jpg" alt="User Image">
			<span class="username">Jonathan Burke Jr.</span>
			<span class="description"><a href="">Shared publicly </a>- 8:30 PM Today</span>
		</div>
		<div class="card-tools">
			
			<button type="button" class="btn btn-tool" data-card-widget="collapse">
				<i class="fas fa-minus"></i>
			</button>
			
		</div>
	</div>
	<div class="card-body">
		<img class="img-fluid pad" src="/img/photo2.png" alt="Photo">
		<p>I took this photo this morning. What do you guys think?</p>
		
	</div>
	<div class="card-footer">
		<button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
		<button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
		<span class="float-right text-muted">127 likes - 3 comments</span>
	</div>
	
</div> --}}