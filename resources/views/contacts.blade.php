@extends('layouts.index')
@section('title', 'Контакты')
@section('center')

<div id="contact-page" class="container">
<div class="bg">
	<div class="row">    		
		<div class="col-sm-12">    			   			
			<h2 class="title text-center">Мы на карте</h2>    			    				    				
			<div id="gmap" class="contact-map">
				<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A793775e96a846fd4c67486a48334224505351acd50144c155a1d351fc7503903&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
			</div>
		</div>			 		
	</div>    	
	<div class="row">  	
		<div class="col-sm-8">
			<div class="contact-form" id="contact-form">
				<h2 class="title text-center">Задайте вопрос</h2>
				@if ($errors->all())
					@foreach ($errors->all() as $message)
	                    <div class="status alert alert-warning">
	                        <strong>{{ $message }}</strong>
	                    </div>
                    @endforeach
            	@endif
            	@if (session('success'))
            	@include('alert')
            	@endif	
		    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="{{ route('contactsAskForm') }}">
		    		{{ csrf_field() }}
		    		<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
		            <div class="form-group col-md-6">
		                <input type="text" name="name" class="form-control" required="required" placeholder="Имя *">
		            </div>
		            <div class="form-group col-md-6">
		                <input type="email" name="email" class="form-control" required="required" placeholder="Почта *">
		            </div>
		            <div class="form-group col-md-12">
		                <input type="text" name="subject" class="form-control" placeholder="Тема вопроса">
		            </div>
		            <div class="form-group col-md-12">
		                <textarea name="message" id="message" class="form-control" required="required" rows="8" placeholder="Ваш вопрос *"></textarea>
		            </div>                        
		            <div class="form-group col-md-12">
		                <input type="submit" name="submit" class="btn btn-primary pull-right" id="contactsAsksubmit" value="Отправить">
		            </div>
		            @section('ajax')
                    @parent
                    grecaptcha.ready(function() {
					grecaptcha.execute('<?php echo config("myconsts.captcha_site_key"); ?>', {action: 'contactsAskForm'})
					.then(function(token) {
					    //console.log(token);
					    document.getElementById('g-recaptcha-response').value=token;
					});
					});                    
                    $('#contactsAsksubmit').click(function(e){
                        e.preventDefault();
                        $.ajax({
                           type:'POST',
                           data: $("#main-contact-form").serialize(),
                           url:"{{ route('contactsAskForm') }}",
                           success:function(data){
                              $( "#contact-form h2" ).after('<div class="alert alert-success">'+data+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							  //Очищаем форму	
                              $('#main-contact-form').trigger('reset');
                           }
                        });
                      });
                    @endsection 
		        </form>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="contact-info">
				<h2 class="title text-center">Наши контакты</h2>
				<address>
					<p>E-Shopper</p>
					<p>Екатеринбург, ул. Лермонтова 17, 3 этаж, офис 4</p>
					<p><a href="tel:+70000000010">+7 000 000-00-10</a></p>
					<p><a href="mailto:info@domain.com">info@domain.com</a></p>
				</address>
				<div class="social-networks">
					<h2 class="title text-center">Мы в соцсетях</h2>
					<ul>
                        <li><a href="#"><i class="fa fa-vk"></i></a></li>
                        <li><a href="#"><i class="fa fa-odnoklassniki"></i></a></li>                               
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
				</div>
			</div>
		</div>    			
	</div>  
</div>	
</div><!--/#contact-page-->

@endsection