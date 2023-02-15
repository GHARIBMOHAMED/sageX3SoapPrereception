<!DOCTYPE html>
<html lang="fr">

<!-- heade here -->
<?php include("includes/head.php");
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">

<body>
  <!-- page-->
  <div class="page page_simple">
    <div class="entry">
      <div class="entry__wrapper"><a class="entry__logo" href="#"><img class="some-icon" src="img/logo-dark.png" alt="Core"><img class="some-icon-dark" src="img/logo-light.png" alt="Core"></a>
        <div class="h2 entry__title">Connection</div>
        <div class="entry__top">
          <div class="entry__text">You must sign in to use this Web site.</div>
        </div>
        <div class="entry__text">Or continue with email address</div>
        <form class="form-horizontal" action="connexion_action.php" method="post">
          <div class="entry__fieldset">
            <div class="field field_icon">
              <div class="field__wrap">
                <input class="field__input" id="formlogin" name="formlogin" placeholder="Your email">
                <div class="field__icon">
                  <svg class="icon icon-mail">
                    <use xlink:href="#icon-mail"></use>
                  </svg>
                </div>
              </div>
            </div>
            <div class="field field_icon">
              <div class="field__wrap">
                <input class="field__input" type="password" id="formpasswd" name="formpasswd" placeholder="Password">
                <div class="field__icon">
                  <svg class="icon icon-lock">
                    <use xlink:href="#icon-lock"></use>
                  </svg>
                </div>
              </div>
            </div><button type="submit" class="button entry__button">Sign in</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include("includes/end_body.php"); ?>
  <script type="text/javascript">
    // c'est ici que l'on va tester jQuery
    $(function() {
      var isConnect = '<?PHP echo $isConnect; ?>';
      set_icon_connect(isConnect);
      // On peut accéder aux éléments.
      // $('#balise') marche.
      //$val = $('#sohnum').attr('placeholder');
      //$('#formsohnum').attr('value',$val);
    });
  </script>
</body>

</html>