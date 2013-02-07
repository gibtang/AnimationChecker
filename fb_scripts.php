<div id="fb-root"></div>
<script>
  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '138311089650718', // App ID
      channelUrl : '//www.azukisoft.com/OSC/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });
    FB.Event.subscribe('auth.login', function() {
        window.location.reload();
    });
    FB.Event.subscribe('auth.logout', function() {
        folder = '';
        imagesList();
        $('#your_fb').html('You are not authorized, so use common heap of files');
    });
    function notAuthorized() {
        folder = '';
        imagesList();
    }
    function authorized() {
        FB.api('/me', function(response) {
            $('#your_fb').html('Nice to see you, '+response.name);
            folder = response.id;
            imagesList();
        });
    }
    FB.getLoginStatus(function(response) {
    if (response.status === 'connected') {
      authorized();
    } else if (response.status === 'not_authorized') {
      notAuthorized();
    } else {
      notAuthorized();
    }
   });

  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>
  
</script> 