<script>
  // var googleUser = {};
  // var startApp = function() {
  //   gapi.load('auth2', function(){
  //     // Retrieve the singleton for the GoogleAuth library and set up the client.
  //     auth2 = gapi.auth2.init({
  //       client_id: '1058358629596-g4u9j540pt7vq8n4a2ogshrj80uis7ve.apps.googleusercontent.com'
  //     });
  //     // attachSignin(document.getElementById('customBtn'));
  //     auth2.attachClickHandler(document.getElementById('customBtn'), {}, onSuccess, onFailure);
  //   });
  // };

  // function attachSignin(element) {
  //   console.log(element.id);
  //   auth2.attachClickHandler(element, {},
  //       function(googleUser) {
  //         console.log('ID: ' + googleUser.getBasicProfile().getId()); // Do not send to your backend! Use an ID token instead.
  //         console.log('Name: ' + googleUser.getBasicProfile().getName());
  //         console.log('Image URL: ' + googleUser.getBasicProfile().getImageUrl());
  //         console.log('Email: ' + googleUser.getBasicProfile().getEmail());
  //       }, function(error) {
  //         alert(JSON.stringify(error, undefined, 2));
  //       });
  // }

  // var auth2;

  // /**
  //  * Initializes the Sign-In client.
  //  */
  // var initClient = function() {
  //     gapi.load('auth2', function(){
  //         /**
  //          * Retrieve the singleton for the GoogleAuth library and set up the
  //          * client.
  //          */
  //         auth2 = gapi.auth2.init({
  //             client_id: '1058358629596-g4u9j540pt7vq8n4a2ogshrj80uis7ve.apps.googleusercontent.com'
  //         });

  //         // Attach the click handler to the sign-in button
  //         // auth2.attachClickHandler(document.getElementById('customBtn'), {}, onSuccess, onFailure);

          
  //     });
  // };

  /**
   * Handle successful sign-ins.
   */
  // var onSuccess = function(user) {
  //     console.log('Signed in as ' + user.getBasicProfile().getName());
  //  };

  // /**
  //  * Handle sign-in failures.
  //  */
  // var onFailure = function(error) {
  //     console.log(error);
  // };

  

  // if (auth2.isSignedIn.get()) {
  //           var profile = auth2.currentUser.get().getBasicProfile();
  //           console.log('ID: ' + profile.getId());
  //           console.log('Name: ' + profile.getName());
  //           console.log('Image URL: ' + profile.getImageUrl());
  //           console.log('Email: ' + profile.getEmail());
  //         }

// initClient();

// function onSignIn(googleUser) {
//   var profile = googleUser.getBasicProfile();
//   console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
//   console.log('Name: ' + profile.getName());
//   console.log('Image URL: ' + profile.getImageUrl());
//   console.log('Email: ' + profile.getEmail());
// }

  function onSuccess(googleUser) {
    console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
    var profile = googleUser.getBasicProfile();
    var name = profile.getName();
    var id = profile.getId();
    var id_token = googleUser.getAuthResponse().id_token;
    
    loadXMLDoc(name, id, id_token);
  }
  function onFailure(error) {
    console.log(error);
  }
  function renderButton() {
    gapi.signin2.render('my-signin2', {
      'scope': 'https://www.googleapis.com/auth/plus.login',
      'width': 120,
      'height': 50,
      'longtitle': false,
      'theme': 'dark',
      'onsuccess': onSuccess,
      'onfailure': onFailure
    });
  }

  function loadXMLDoc(name, id, id_token) {
    var metas = document.getElementsByName('_token');
    var csrf_token = ""; 

    for (i=0; i<metas.length; i++) { 
      csrf_token = metas[i].content; 
    } 
    // alert(csrf_token);
    var xmlhttp = null;
    
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    else {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        window.location = "/home";
      }
    }

    xmlhttp.open("POST","/glogin_session",true);
    xmlhttp.setRequestHeader('X-CSRF-Token', csrf_token);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("idtoken="+ id_token +"&name="+name+"&id="+id);
    // xmlhttp.send();
  }
</script>