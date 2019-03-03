<?php
  $page_name = 'Sign Up';
  $error = $_GET['e'];

  $url =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
  $utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : null;
  $utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : null;

  $reff = isset($_GET['reff']) ? $_GET['reff'] : null;
?>

<?php include '../templates/header.php'; ?>

<article class="main subscribe-page">
  <section class="hero" style="background-image: url(/img/chalkup_bg.jpg); background-position: top left; background-size: cover;">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-cell mdl-cell--8-col form">
          <div class="mdl-grid">
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-cell mdl-cell--10-col">
              
              <h2 class="headline">Become an Ambassador</h2>

              <p>The Morning Chalk Up is an email newsletter for people who treat CrossFit as a lifestyle. If you love the Morning Chalk Up as much as we do, then apply to join our Ambassador program and earn cool swag for spreading the word.</p>

              <?php if (isset($error)): ?>
                <div class="mdl-grid">

                  <div class="mdl-cell mdl-cell--12-col error" style="border-radius: 5px; border: 1px solid #ebccd1; padding: 5px; background: #f2dede; color: #a94442; text-align: center;">
                    <?php if ($error['email-exists']): ?>
                      <p><strong>That Email Is Already Suigned Up</strong></p>
                    <?php endif ?>
                    <?php if ($error['no-signup']): ?>
                      <p><strong>Sorry, but we have not opened signups to you yet</strong></p>
                    <?php endif ?>
                    <?php if ($error['no-match']): ?>
                      <p><strong>Your Passwords Do Not Match</strong></p>
                    <?php endif ?>
                    <?php if ($error['username-exists']): ?>
                      <p><strong>That Username Is Taken, Plese Try Another</strong></p>
                    <?php endif ?>
                    <?php if ($error['username-format']): ?>
                      <p><strong>Only Letters, Numbers, '-', And '_' are Valid Username Charicters</strong></p>
                    <?php endif ?>
                    <?php if ($error['full-name'] || $error['email'] || $error['password'] || $error['conf-password'] ||  $error['username']): ?>
                      <p><strong>The below fields are required:</strong></p>
                      <?php
                        foreach ($error as $e => $v) {
                          switch ($e) {
                            case 'full-name':
                              echo 'Name<br>';
                              break;
                            case 'first-name':
                              echo 'First Name<br>';
                              break;
                            case 'last-name':
                              echo 'Last Name<br>';
                              break;
                            case 'address':
                              echo 'Address<br>';
                              break;
                            case 'city':
                              echo 'City<br>';
                              break;
                            case 'state':
                              echo 'State<br>';
															break;
														case 'state_text':
                              echo 'State<br>';
															break;
                            case 'zip':
                              echo 'ZIP<br>';
                              break;
                            case 'email':
                              echo 'Email<br>';
                              break;
                            case 'username':
                              echo 'Username<br>';
                              break;
                            case 'password':
                              echo 'Password<br>';
                              break;
                            case 'conf-password':
                              echo 'Confirm Password<br>';
                              break;
                          }
                        }
                      ?>
                    <?php endif ?>
                  </div>
                </div>
              <?php endif; ?>

              <div class="mdl-grid fields">
                <form style="width: 100%" action="process.php" method="post">
                  
                  <?php include '../templates/hidden-fields.php'; ?>
                  <div class="mdl-grid">
                    <!-- <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="full-name" name="full-name">
                        <label class="mdl-textfield__label" for="full-name">Full Name *</label>
                      </div>
                    </div> -->
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="first-name" name="first-name">
                        <label class="mdl-textfield__label" for="first-name">First Name *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="last-name" name="last-name">
                        <label class="mdl-textfield__label" for="last-name">Last Name *</label>
                      </div>
                    </div>

										<div class="mdl-cell mdl-cell--12-col" style="padding-bottom: 20px;">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label select-container" style="padding-bottom: 0px;">
                        <select class="mdl-textfield__input" id="country" name="country">
                          <option value="Afganistan">Afghanistan</option>
													<option value="Albania">Albania</option>
													<option value="Algeria">Algeria</option>
													<option value="American Samoa">American Samoa</option>
													<option value="Andorra">Andorra</option>
													<option value="Angola">Angola</option>
													<option value="Anguilla">Anguilla</option>
													<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
													<option value="Argentina">Argentina</option>
													<option value="Armenia">Armenia</option>
													<option value="Aruba">Aruba</option>
													<option value="Australia">Australia</option>
													<option value="Austria">Austria</option>
													<option value="Azerbaijan">Azerbaijan</option>
													<option value="Bahamas">Bahamas</option>
													<option value="Bahrain">Bahrain</option>
													<option value="Bangladesh">Bangladesh</option>
													<option value="Barbados">Barbados</option>
													<option value="Belarus">Belarus</option>
													<option value="Belgium">Belgium</option>
													<option value="Belize">Belize</option>
													<option value="Benin">Benin</option>
													<option value="Bermuda">Bermuda</option>
													<option value="Bhutan">Bhutan</option>
													<option value="Bolivia">Bolivia</option>
													<option value="Bonaire">Bonaire</option>
													<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
													<option value="Botswana">Botswana</option>
													<option value="Brazil">Brazil</option>
													<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
													<option value="Brunei">Brunei</option>
													<option value="Bulgaria">Bulgaria</option>
													<option value="Burkina Faso">Burkina Faso</option>
													<option value="Burundi">Burundi</option>
													<option value="Cambodia">Cambodia</option>
													<option value="Cameroon">Cameroon</option>
													<option value="Canada">Canada</option>
													<option value="Canary Islands">Canary Islands</option>
													<option value="Cape Verde">Cape Verde</option>
													<option value="Cayman Islands">Cayman Islands</option>
													<option value="Central African Republic">Central African Republic</option>
													<option value="Chad">Chad</option>
													<option value="Channel Islands">Channel Islands</option>
													<option value="Chile">Chile</option>
													<option value="China">China</option>
													<option value="Christmas Island">Christmas Island</option>
													<option value="Cocos Island">Cocos Island</option>
													<option value="Colombia">Colombia</option>
													<option value="Comoros">Comoros</option>
													<option value="Congo">Congo</option>
													<option value="Cook Islands">Cook Islands</option>
													<option value="Costa Rica">Costa Rica</option>
													<option value="Cote DIvoire">Cote D'Ivoire</option>
													<option value="Croatia">Croatia</option>
													<option value="Cuba">Cuba</option>
													<option value="Curaco">Curacao</option>
													<option value="Cyprus">Cyprus</option>
													<option value="Czech Republic">Czech Republic</option>
													<option value="Denmark">Denmark</option>
													<option value="Djibouti">Djibouti</option>
													<option value="Dominica">Dominica</option>
													<option value="Dominican Republic">Dominican Republic</option>
													<option value="East Timor">East Timor</option>
													<option value="Ecuador">Ecuador</option>
													<option value="Egypt">Egypt</option>
													<option value="El Salvador">El Salvador</option>
													<option value="Equatorial Guinea">Equatorial Guinea</option>
													<option value="Eritrea">Eritrea</option>
													<option value="Estonia">Estonia</option>
													<option value="Ethiopia">Ethiopia</option>
													<option value="Falkland Islands">Falkland Islands</option>
													<option value="Faroe Islands">Faroe Islands</option>
													<option value="Fiji">Fiji</option>
													<option value="Finland">Finland</option>
													<option value="France">France</option>
													<option value="French Guiana">French Guiana</option>
													<option value="French Polynesia">French Polynesia</option>
													<option value="French Southern Ter">French Southern Ter</option>
													<option value="Gabon">Gabon</option>
													<option value="Gambia">Gambia</option>
													<option value="Georgia">Georgia</option>
													<option value="Germany">Germany</option>
													<option value="Ghana">Ghana</option>
													<option value="Gibraltar">Gibraltar</option>
													<option value="Great Britain">Great Britain</option>
													<option value="Greece">Greece</option>
													<option value="Greenland">Greenland</option>
													<option value="Grenada">Grenada</option>
													<option value="Guadeloupe">Guadeloupe</option>
													<option value="Guam">Guam</option>
													<option value="Guatemala">Guatemala</option>
													<option value="Guinea">Guinea</option>
													<option value="Guyana">Guyana</option>
													<option value="Haiti">Haiti</option>
													<option value="Hawaii">Hawaii</option>
													<option value="Honduras">Honduras</option>
													<option value="Hong Kong">Hong Kong</option>
													<option value="Hungary">Hungary</option>
													<option value="Iceland">Iceland</option>
													<option value="India">India</option>
													<option value="Indonesia">Indonesia</option>
													<option value="Iran">Iran</option>
													<option value="Iraq">Iraq</option>
													<option value="Ireland">Ireland</option>
													<option value="Isle of Man">Isle of Man</option>
													<option value="Israel">Israel</option>
													<option value="Italy">Italy</option>
													<option value="Jamaica">Jamaica</option>
													<option value="Japan">Japan</option>
													<option value="Jordan">Jordan</option>
													<option value="Kazakhstan">Kazakhstan</option>
													<option value="Kenya">Kenya</option>
													<option value="Kiribati">Kiribati</option>
													<option value="Korea North">Korea North</option>
													<option value="Korea Sout">Korea South</option>
													<option value="Kuwait">Kuwait</option>
													<option value="Kyrgyzstan">Kyrgyzstan</option>
													<option value="Laos">Laos</option>
													<option value="Latvia">Latvia</option>
													<option value="Lebanon">Lebanon</option>
													<option value="Lesotho">Lesotho</option>
													<option value="Liberia">Liberia</option>
													<option value="Libya">Libya</option>
													<option value="Liechtenstein">Liechtenstein</option>
													<option value="Lithuania">Lithuania</option>
													<option value="Luxembourg">Luxembourg</option>
													<option value="Macau">Macau</option>
													<option value="Macedonia">Macedonia</option>
													<option value="Madagascar">Madagascar</option>
													<option value="Malaysia">Malaysia</option>
													<option value="Malawi">Malawi</option>
													<option value="Maldives">Maldives</option>
													<option value="Mali">Mali</option>
													<option value="Malta">Malta</option>
													<option value="Marshall Islands">Marshall Islands</option>
													<option value="Martinique">Martinique</option>
													<option value="Mauritania">Mauritania</option>
													<option value="Mauritius">Mauritius</option>
													<option value="Mayotte">Mayotte</option>
													<option value="Mexico">Mexico</option>
													<option value="Midway Islands">Midway Islands</option>
													<option value="Moldova">Moldova</option>
													<option value="Monaco">Monaco</option>
													<option value="Mongolia">Mongolia</option>
													<option value="Montserrat">Montserrat</option>
													<option value="Morocco">Morocco</option>
													<option value="Mozambique">Mozambique</option>
													<option value="Myanmar">Myanmar</option>
													<option value="Nambia">Nambia</option>
													<option value="Nauru">Nauru</option>
													<option value="Nepal">Nepal</option>
													<option value="Netherland Antilles">Netherland Antilles</option>
													<option value="Netherlands">Netherlands (Holland, Europe)</option>
													<option value="Nevis">Nevis</option>
													<option value="New Caledonia">New Caledonia</option>
													<option value="New Zealand">New Zealand</option>
													<option value="Nicaragua">Nicaragua</option>
													<option value="Niger">Niger</option>
													<option value="Nigeria">Nigeria</option>
													<option value="Niue">Niue</option>
													<option value="Norfolk Island">Norfolk Island</option>
													<option value="Norway">Norway</option>
													<option value="Oman">Oman</option>
													<option value="Pakistan">Pakistan</option>
													<option value="Palau Island">Palau Island</option>
													<option value="Palestine">Palestine</option>
													<option value="Panama">Panama</option>
													<option value="Papua New Guinea">Papua New Guinea</option>
													<option value="Paraguay">Paraguay</option>
													<option value="Peru">Peru</option>
													<option value="Phillipines">Philippines</option>
													<option value="Pitcairn Island">Pitcairn Island</option>
													<option value="Poland">Poland</option>
													<option value="Portugal">Portugal</option>
													<option value="Puerto Rico">Puerto Rico</option>
													<option value="Qatar">Qatar</option>
													<option value="Republic of Montenegro">Republic of Montenegro</option>
													<option value="Republic of Serbia">Republic of Serbia</option>
													<option value="Reunion">Reunion</option>
													<option value="Romania">Romania</option>
													<option value="Russia">Russia</option>
													<option value="Rwanda">Rwanda</option>
													<option value="St Barthelemy">St Barthelemy</option>
													<option value="St Eustatius">St Eustatius</option>
													<option value="St Helena">St Helena</option>
													<option value="St Kitts-Nevis">St Kitts-Nevis</option>
													<option value="St Lucia">St Lucia</option>
													<option value="St Maarten">St Maarten</option>
													<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
													<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
													<option value="Saipan">Saipan</option>
													<option value="Samoa">Samoa</option>
													<option value="Samoa American">Samoa American</option>
													<option value="San Marino">San Marino</option>
													<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
													<option value="Saudi Arabia">Saudi Arabia</option>
													<option value="Senegal">Senegal</option>
													<option value="Serbia">Serbia</option>
													<option value="Seychelles">Seychelles</option>
													<option value="Sierra Leone">Sierra Leone</option>
													<option value="Singapore">Singapore</option>
													<option value="Slovakia">Slovakia</option>
													<option value="Slovenia">Slovenia</option>
													<option value="Solomon Islands">Solomon Islands</option>
													<option value="Somalia">Somalia</option>
													<option value="South Africa">South Africa</option>
													<option value="Spain">Spain</option>
													<option value="Sri Lanka">Sri Lanka</option>
													<option value="Sudan">Sudan</option>
													<option value="Suriname">Suriname</option>
													<option value="Swaziland">Swaziland</option>
													<option value="Sweden">Sweden</option>
													<option value="Switzerland">Switzerland</option>
													<option value="Syria">Syria</option>
													<option value="Tahiti">Tahiti</option>
													<option value="Taiwan">Taiwan</option>
													<option value="Tajikistan">Tajikistan</option>
													<option value="Tanzania">Tanzania</option>
													<option value="Thailand">Thailand</option>
													<option value="Togo">Togo</option>
													<option value="Tokelau">Tokelau</option>
													<option value="Tonga">Tonga</option>
													<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
													<option value="Tunisia">Tunisia</option>
													<option value="Turkey">Turkey</option>
													<option value="Turkmenistan">Turkmenistan</option>
													<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
													<option value="Tuvalu">Tuvalu</option>
													<option value="Uganda">Uganda</option>
													<option value="Ukraine">Ukraine</option>
													<option value="United Arab Erimates">United Arab Emirates</option>
													<option value="United Kingdom">United Kingdom</option>
													<option value="United States" selected>United States</option>
													<option value="Uraguay">Uruguay</option>
													<option value="Uzbekistan">Uzbekistan</option>
													<option value="Vanuatu">Vanuatu</option>
													<option value="Vatican City State">Vatican City State</option>
													<option value="Venezuela">Venezuela</option>
													<option value="Vietnam">Vietnam</option>
													<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
													<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
													<option value="Wake Island">Wake Island</option>
													<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
													<option value="Yemen">Yemen</option>
													<option value="Zaire">Zaire</option>
													<option value="Zambia">Zambia</option>
													<option value="Zimbabwe">Zimbabwe</option>
												</select>
												<label class="mdl-textfield__label" for="country">Country *</label>
                        <i class="mdl-icon-toggle__label material-icons" style="top:15px;">keyboard_arrow_down</i>
                      </div>
                    </div>

                    <div class="mdl-cell mdl-cell--12-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="address" name="address">
                        <label class="mdl-textfield__label" for="address">Address *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--5-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="city" name="city">
                        <label class="mdl-textfield__label" for="city">City *</label>
                      </div>
                    </div>
										<div class="mdl-cell mdl-cell--3-col state--text" style="display: none">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="state_text" name="state_text">
                        <label class="mdl-textfield__label" for="state_text">State/Provence *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col state--select">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label select-container" style="padding-bottom: 0px;">
                        <select class="mdl-textfield__input" id="state" name="state">
                          <option value="" selected=""></option>
                          <option value="AL">AL</option>
                          <option value="AK">AK</option>
                          <option value="AZ">AZ</option>
                          <option value="AR">AR</option>
                          <option value="CA">CA</option>
                          <option value="CO">CO</option>
                          <option value="CT">CT</option>
                          <option value="DE">DE</option>
                          <option value="FL">FL</option>
                          <option value="GA">GA</option>
                          <option value="HI">HI</option>
                          <option value="ID">ID</option>
                          <option value="IL">IL</option>
                          <option value="IN">IN</option>
                          <option value="IA">IA</option>
                          <option value="KS">KS</option>
                          <option value="KY">KY</option>
                          <option value="LA">LA</option>
                          <option value="ME">ME</option>
                          <option value="MD">MD</option>
                          <option value="MA">MA</option>
                          <option value="MI">MI</option>
                          <option value="MN">MN</option>
                          <option value="MS">MS</option>
                          <option value="MO">MO</option>
                          <option value="MT">MT</option>
                          <option value="NE">NE</option>
                          <option value="NV">NV</option>
                          <option value="NH">NH</option>
                          <option value="NJ">NJ</option>
                          <option value="NM">NM</option>
                          <option value="NY">NY</option>
                          <option value="NC">NC</option>
                          <option value="ND">ND</option>
                          <option value="OH">OH</option>
                          <option value="OK">OK</option>
                          <option value="OR">OR</option>
                          <option value="PA">PA</option>
                          <option value="RI">RI</option>
                          <option value="SC">SC</option>
                          <option value="SD">SD</option>
                          <option value="TN">TN</option>
                          <option value="TX">TX</option>
                          <option value="UT">UT</option>
                          <option value="VT">VT</option>
                          <option value="VA">VA</option>
                          <option value="WA">WA</option>
                          <option value="WV">WV</option>
                          <option value="WI">WI</option>
                          <option value="WY">WY</option>
                          <option value="AS">AS</option>
                          <option value="DC">DC</option>
                          <option value="FM">FM</option>
                          <option value="GU">GU</option>
                          <option value="MH">MH</option>
                          <option value="MP">MP</option>
                          <option value="PW">PW</option>
                          <option value="PR">PR</option>
                          <option value="VI">VI</option>
                          <option value="AA">AA</option>
                          <option value="AE">AE</option>
                          <option value="AP">AP</option>
                        </select>
                        
                        <label class="mdl-textfield__label" for="state">State *</label>
                        <i class="mdl-icon-toggle__label material-icons" style="top:15px;">keyboard_arrow_down</i>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="zip" name="zip">
                        <label class="mdl-textfield__label" for="zip">ZIP/Postal Code *</label>
                      </div>
                    </div>
                  </div>
                  

                  
                  <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="email" name="email">
                        <label class="mdl-textfield__label" for="email">Email *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="username" name="username" pattern="^[a-zA-Z0-9_-]+[a-zA-Z0-9]">
                        <label class="mdl-textfield__label" for="username">Username *</label>
                        <span class="mdl-textfield__error">Please only use letters, numbers, - or _ (but end with a letter or number)</span>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" id="password" name="password">
                        <label class="mdl-textfield__label" for="password">Password *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" id="conf-password" name="conf-password">
                        <label class="mdl-textfield__label" for="conf-password">Confirm Password *</label>
                      </div>
                    </div>
                  </div>

                  <div class="hidden" style="display:none;">
                    <input type="hidden" name="URL" id="URL" value="">
                    <input type="hidden" name="UTM_SOURCE" id="UTM_SOURCE" value="">
                    <input type="hidden" name="UTM_MEDIUM" id="UTM_MEDIUM" value="">
                    <input type="hidden" name="UTM_CAMP" id="UTM_CAMP" value="">
                    <input type="hidden" name="GCLID" id="GCLID" value="">
                    <input type="hidden" name="reff" id="reff" value="<?php echo $reff != null ? $reff : ''; ?>">
                  </div>
                  
                  <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label select-container">
                        <select class="mdl-textfield__input" id="shirt_size" name="shirt_size">
                          <option value="XS">XS</option>
                          <option value="S">S</option>
                          <option value="M">M</option>
                          <option value="L">L</option>
                          <option value="XL">XL</option>
                          <option value="2XL">2XL</option>
                        </select>
                        
                        <label class="mdl-textfield__label" for="shirt_size">Shirt Size</label>
                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label select-container">
                        <select class="mdl-textfield__input" type="text" id="shirt_type" name="shirt_type">
                          <option>T-Shirt</option>
                          <option>Tank / Racerback</option>
                        </select>
                        <label class="mdl-textfield__label" for="shirt_type">Shirt Type</label>
                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                      </div>
                    </div>
                  </div>

                  <div class="hidden" style="display:none;">
                    <input type="hidden" name="URL" id="URL" value="<?php echo $url != null ? $url : ''; ?>">
                    <input type="hidden" name="UTM_SOURCE" id="UTM_SOURCE" value="<?php echo $utm_source != null ? $utm_source : ''; ?>">
                    <input type="hidden" name="UTM_MEDIUM" id="UTM_MEDIUM" value="<?php echo $utm_medium != null ? $utm_medium : ''; ?>">
                    <input type="hidden" name="UTM_CAMP" id="UTM_CAMP" value="<?php echo $utm_campaign != null ? $utm_campaign : ''; ?>">
                    <input type="hidden" name="reff" id="reff" value="<?php echo $reff != null ? $reff : ''; ?>">
                  </div>
                  
                  <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                      <button style="width: 100%" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit">
                        Sign Up
                      </button>
                    </div>
                  </div>


                </form>

                <div class="mdl-cell mdl-cell--12-col">
                  <div class="center">
                    <small>Have An Account? <a href="/login/">Login</a></small>
                  </div>
                </div>
              </div>

            </div>
            <div class="mdl-layout-spacer"></div>
          </div>
        </div>
        <div class="mdl-layout-spacer"></div>
      </div>
    </div>
  </section>
</article>

<?php include '../templates/footer.php'; ?>