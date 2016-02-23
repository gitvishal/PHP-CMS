<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
    <script>
      var recaptcha1;
      var recaptcha2;
      var myCallBack = function() {
        //Render the recaptcha1 on the element with ID "recaptcha1"
        recaptcha1 = grecaptcha.render('recaptcha1', {
          'sitekey' : '6Lff3BgTAAAAAAFwqIlnVCxCq2iAZrQK-4XLDukS', //Replace this with your Site key
          'theme' : 'light'
        });
        
        //Render the recaptcha2 on the element with ID "recaptcha2"
        recaptcha2 = grecaptcha.render('recaptcha2', {
          'sitekey' : '6Lff3BgTAAAAAAFwqIlnVCxCq2iAZrQK-4XLDukS', //Replace this with your Site key
          'theme' : 'light'
        });
      };
    </script>