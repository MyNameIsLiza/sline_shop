<style>
    body {
        padding-top: 50px;
    }
    .starter-template {
        padding: 40px 15px;
        text-align: center;
    }
</style>
<!DOCTYPE html>
<html>
<head>
    <title>Facebook Login JavaScript Example</title>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script>
        var googleUser = {};
        var startApp = function() {
            gapi.load('auth2', function(){
                auth2 = gapi.auth2.init({
                    client_id: '350553799332-1jor1old8pc209cuicf0p0tkk1jiiklu.apps.googleusercontent.com',
                    cookiepolicy: 'single_host_origin',
                });
                attachSignin(document.getElementById('customBtn'));
            });
        };

        function attachSignin(element) {
            auth2.attachClickHandler(element, {},
                function(googleUser) {
                    var profile =googleUser.getBasicProfile();
                    var user_data = {};
                    user_data.id = profile.getId();
                    user_data.email = profile.getEmail();
                    user_data.first_name = profile.getGivenName();
                    user_data.second_name = profile.getFamilyName();
                    user_data.img = profile.getImageUrl();

                    $.post( "user_authentication/check", {user_data} ).done(function() {
                        window.location.href = '/shop';
                    });
                    console.log(user_data);
                }, function(error) {
                    alert(JSON.stringify(error, undefined, 2));
                });
        }
    </script>
    <style type="text/css">
        #customBtn {
            display: inline-block;
            background: white;
            color: #444;
            width: 190px;
            border-radius: 5px;
            border: thin solid #888;
            box-shadow: 1px 1px 1px grey;
            white-space: nowrap;
        }
        #customBtn:hover {
            cursor: pointer;
        }
        span.label {
            font-family: serif;
            font-weight: normal;
        }
        span.icon {
            background: url('src/img/google.png') transparent 5px 50% no-repeat;
            display: inline-block;
            vertical-align: middle;
            width: 42px;
            height: 42px;
        }
        span.buttonText {
            display: inline-block;
            vertical-align: middle;
            padding-left: 42px;
            padding-right: 42px;
            font-size: 14px;
            font-weight: bold;
            /* Use the Roboto font that is loaded in the <head> */
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body>
<script>

    function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
        //console.log('statusChangeCallback');
        //console.log(response);                   // The current login status of the person.

        if (response.status === 'connected') {   // Logged into your webpage and Facebook.
            FB.api('/me?fields=email,first_name,last_name', function(response) {
                $.post( "user_authentication/check", {response} );
            });

        } else {                                 // Not logged into your webpage or we are unable to tell.
            document.getElementById('status').innerHTML = 'Please log ' +
                'into this webpage.';
        }
    }


    function checkLoginState() {               // Called when a person is finished with the Login Button.
        FB.getLoginStatus(function(response) {   // See the onlogin handler
            statusChangeCallback(response);
        });
    }


    window.fbAsyncInit = function() {
        FB.init({
            appId      : '2198621950360446',
            xfbml      : true,
            version    : 'v7.0'
        });


/*        FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
            statusChangeCallback(response);        // Returns the login status.
        });*/
    };
    var user;
    function onSignIn(googleUser) {
        user = googleUser.getBasicProfile();
/*        $.post( "user_authentication/check", {profile} ).done(function( data ) {
            window.location.href = '/shop';
        });*/
    }
</script>
<style>
    .g-signin2 .abcRioButton {
        width: 50%;
        margin: 0 auto;
    }
</style>
<div class="starter-template">
    <!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>-->
    <div class="fb-login-button" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div>
    <br><br>
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
    <div id="gSignInWrapper">
        <div id="customBtn" class="customGPlusSignIn">
            <span class="icon"></span>
            <span class="buttonText">Google</span>
        </div>
    </div>
    <div id="name"></div>
    <script>startApp();</script>
    <div id="status">
    </div>
</div>
<!-- The JS SDK Login Button -->



<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</body>
</html>
