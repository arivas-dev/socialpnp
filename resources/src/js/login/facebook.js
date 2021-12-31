function notify(tipo, msg) {
  Lobibox.notify(tipo, {
    size: 'mini',
    rounded: true,
    delayIndicator: false,
    msg: msg,
    soundPath: base_urlft+"sounds/",
    title: 'SocialPNP dice:'
  });
}

$(document).ready(function() {

  	var app_id = '847893949055246';
  	var scopes = 'public_profile, email';
  	var btn_login = '<a id="facebook-login" class="fb"><i class="fa fa-facebook"></i>Iniciar Sesión con Facebook</a>'
  	var div_session = "<div id='facebook-session'>"+
					  "<strong></strong>"+
					  "<img>"+
					  "<a id='logout' class='btn btn-danger'>Cerrar sesión</a>"+
					  "</div>";
  	window.fbAsyncInit = function() {

	  	FB.init({
	    	appId      : app_id,
	    	status     : true,
	    	cookie     : true, 
	    	xfbml      : true, 
	    	version    : 'v7.0'
	  	});


	  	FB.getLoginStatus(function(response) {
	    	statusChangeCallback(response, function() {});
	  	});
  	};

  	var statusChangeCallback = function(response, callback) {
  		console.log(response);
    	if (response.status === 'connected') {
        //$(".login-resources ul li").html(div_session);

      		// getFacebookData();
          // window.location = "login_fb/type_account";
    	} else {
     		callback(false);
    	}
  	}

  	var checkLoginState = function(callback) {
    	FB.getLoginStatus(function(response) {
      		callback(response);
    	});
  	}

  	var getFacebookData =  function() {
  		FB.api('/me', function(response) {
  			//console.log(response);
        // if (!logged_in) {
           $.ajax({
            url: base_urlft+'login_fb/create_data_session',
            type: 'POST',
            dataType: 'JSON',
            data: {tokenfb: response.id,
                   namefb: response.name,
                   photofb: 'https://graph.facebook.com/'+response.id+'/picture?type=large'
                  },
          })
          .done(function(data) {
            //console.log(data)
            notify('info', data.msg);
            setTimeout(function() {window.location = data.path;}, 2000);
           
          })
          .fail(function() {
            notify('error', 'Error Interno');
            $('#facebook-login').removeAttr('disabled');
          });
        // }        

	  		// $('#facebook-login').after(div_session);
	  		// $('#facebook-login').remove();
	  		// $('#facebook-session strong').text("Bienvenido: "+response.name);
	  		// $('#facebook-session img').attr('src','https://graph.facebook.com/'+response.id+'/picture?type=large');
	  	});
  	}

  	var facebookLogin = function() {
  		checkLoginState(function(data) {
  			if (data.status !== 'connected') {
  				FB.login(function(response) {
  					if (response.status === 'connected'){
  						getFacebookData();
            }else{
              notify("info", "No se ha iniciado sesión");
              $("#facebook-login").removeAttr("disabled");
              //console.log("cuchon");
            }
            
  				}, {scope: scopes});
  			}
  		})
  	}

  	function facebookLogout(ruta) {
      cont = 1;
  		checkLoginState(function(data) {
  			if (data.status === 'connected') {
				FB.logout(function(response) {
					// $('#facebook-session').before(btn_login);
					//$('#facebook-session').remove();
          if (cont == 1) {
            $.ajax({
              url: base_urlft+ruta,
              type: 'POST',
              dataType: 'JSON',
              data: {fb: 'logout'},
            })
            .done(function(data) {
              if (data.status === true) {
                $("#cancel-register").removeAttr('disabled');
                if (cont == 1) {
                  notify('info', 'Redireccionando...');
                  window.location = base_urlft;
                  // setTimeout(function() {}, 1000);                
                }
                
                cont += 1;
              }
            })
            .fail(function() {
              // notify('error', 'Error Interno');
            });
          }         
          
				})
			}
  		})

  	}



  	$(document).on('click', '#facebook-login', function(e) {
  		e.preventDefault();
      $(this).attr('disabled', 'disabled');
  		facebookLogin();
  	})

  	$(document).on('click', '#logout', function(e) {
  		e.preventDefault();
      title = $(this).attr('texto');
      Lobibox.confirm({
            title: "SocialPNP",
            msg: title,
            buttons: {
            yes: {
                'class': 'lobibox-btn lobibox-btn-yes',
                text: 'Si',
                closeOnClick: true
            },
            no: {
                'class': 'lobibox-btn lobibox-btn-no',
                text: 'No',
                closeOnClick: true
            }
        },
            callback: function(lobibox, type){
                if(type == "yes"){
                  notify('info', 'Finalizando. Espere un momento...');
                  facebookLogout('login/logOut');
                }else{
                  return false;
                }
            }
        });
  	
  	});

    $(document).on('click', '#cancel-register', function(e) {
      e.preventDefault();
      $(this).attr('disabled', 'disabled');
      $("#sendInfo").attr('disabled', 'disabled');
      Lobibox.confirm({
            title: "SocialPNP",
            msg: "¿Está seguro de cancelar el proceso?",
            buttons: {
            yes: {
                'class': 'lobibox-btn lobibox-btn-yes',
                text: 'Si',
                closeOnClick: true
            },
            no: {
                'class': 'lobibox-btn lobibox-btn-no',
                text: 'No',
                closeOnClick: true
            }
        },
            callback: function(lobibox, type){
                if(type == "yes"){
                  notify('info', 'Finalizando. Espere un momento...');
                  facebookLogout('login_fb/destroy_session_temporal');
                }else{
                  $("#cancel-register").removeAttr('disabled');
                  return false;
                }
            }
        });
    
    });

  });