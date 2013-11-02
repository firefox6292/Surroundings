<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 90% }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmlGm7p4JOqM1qADyk6ghjFKjXRI9hd3s&sensor=true">
    </script>
    <script type="text/javascript">
      var T = {};
      function initialize() {
        navigator.geolocation.getCurrentPosition(function (loc) {
            var coords = loc.coords;
            T.myPosition = new google.maps.LatLng(coords.latitude, coords.longitude);
            var mapOptions =
            {
              center: new google.maps.LatLng(coords.latitude, coords.longitude),
              zoom: 19,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"),
                mapOptions);
            var myMarker = new google.maps.Marker({
                position: T.myPosition,
                map: map,
                title: "You are here.",
                icon: "/Surroundings/currentLoc.jpg"
            });
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
    <div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '154379824751249', // App ID
    //channelUrl : '//localhost/Surroundings/channel.php', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login();
    }
  });
  };

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Good to see you, ' + response.name + '.');
      //FBQuery("select uid from user where uid = me()", function (res) {
         // alert(JSON.stringify(res));
      //});
    });
  }
</script>
<script>
    function FBQuery(str, cb) {
      FB.api("?fql?q=" + encodeURIComponent(str), cb);
    }
    function workingFBQuery()
    {
        //FB.api('/me?fields=name,photos.limit(10).fields(id, picture)', function(response) {
            //console.log(JSON.stringify(response));
        //});
        FB.api('/me/locations?limit=10', function(response) {
            console.log(JSON.stringify(response));
        });
    }
    $(document).ready(function(){
        console.log("ready");
    });
    function logout()
    {
        FB.logout(function(response){
            console.log(response);
            location.reload();
        });
    }
    function fqlquery()
    {
        /*
        var query = FB.Data.query("SELECT pid, src_big, place_id FROM photo WHERE pid IN(SELECT pid FROM photo_tag WHERE subject = me()) AND place_id > 1 order by created desc");
        query.wait(function(rows)
        {
            console.log(rows);
        })
        */
        
        var query = "SELECT+pid,src_big,place_id+FROM+photo+WHERE+pid+IN(SELECT+pid+FROM+photo_tag+WHERE+subject=me())+AND+place_id>1+order+by+created+desc"; //SELECT latitude, longitude FROM place WHERE place_id IN (SELECT place_id FROM Query1)"
        FB.api("/fql?q="+ query + "", function(e){
          console.log("Well here goes nothing: \n" + e);  
        } );
        
    }
</script>

<!--
  Below we include the Login Button social plugin. This button uses the JavaScript SDK to
  present a graphical Login button that triggers the FB.login() function when clicked.

  Learn more about options for the login button plugin:
  /docs/reference/plugins/login/ -->
    <fb:login-button show-faces="true" width="200" max-rows="1" ></fb:login-button>
    <input id="fblogout" type="button" value="Logout" onclick="logout()"/>
  </body>
</html>
