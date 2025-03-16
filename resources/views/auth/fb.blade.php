<a href="{{route("f")}}" class="btn btn-auth" >
  <button class="btn-facebook">
    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/2021_Facebook_icon.svg" alt="Facebook logo">
    <span>Ingresar con Facebook</span>
  </button>    
</a>
  
<script>
      window.fbAsyncInit = function() {
      FB.init({
        appId      : '1382676396235936', // Reemplaza con tu App ID de Facebook
        cookie     : true,
        xfbml      : true,
        version    : 'v17.0' // Versión actual de la API
      });

      FB.AppEvents.logPageView();   

    };

    function loginFacebook() {
      location.href="{{route('fbCallback')}}"

      return
      // FB.login(function(response) {
      //   if (response.authResponse) {
      //     console.log('Usuario logueado:', response);
      //   } else {
      //     console.log('El usuario canceló el inicio de sesión');
      //   }
      // }, {scope: 'email'});
    }
</script>


  