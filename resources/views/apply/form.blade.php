@extends('layouts.app')

@section('content')

    <div class="h-screen bg-black text-white">

        <div class="hidden lg:flex items-center absolute bottom-0 left-0 px-10 py-5 text-xs">
            <img class="w-4 mr-3" src="{{ asset('img/foxsys-xyz [Icon] [Dark Back].png') }}" />
            <span class="text-xs">foxsys-xyz, {{ date('Y') }}. all rights reserved.</span>
        </div>

        <div class="hidden lg:flex items-center absolute bottom-0 right-0 px-10 py-5 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-folder inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2"></path>
            </svg>
            {{ $applicant->uuid }} {{ $applicant->vatsim != null ? '[ VATSIM Verified ]' : '[ Manual ]' }}
        </div>

        <!-- Laravel's Validation Errors -->

        @if ($errors->any())

            <div class="lg:flex justify-center absolute right-0 left-0 lg:top-0 text-center px-10 py-5 text-xs bg-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-minus inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="9" y1="12" x2="15" y2="12"></line>
                </svg>
                strange, an error. maybe retry entering the details correctly?
            </div>

        @endif

        <div class="container h-full mx-auto flex justify-center items-center">
            <div class="m-4 p-8 w-full lg:w-1/2 bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl">
                
                @include('layouts.sso.application.header')

                <form id="finalize-application" action="{{ route('apply.finalize') }}" method="post">

                    @csrf

                    <input type="hidden" name="uuid" value="{{ $applicant->uuid }}" />

                    <div class="mt-4 lg:flex w-full gap-2">
                        <div class="w-full lg:w-full mt-1 lg:mt-0">
                            <span class="text-xs lg:flex items-center {{ $errors->has('fname') ? 'text-red-500' : '' }}">
                                @if ($applicant->fname == null)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 8 17 17 8 17"></polyline>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                    </svg>
                                @endif
                                first name
                            </span>
                            <input name="fname" class="w-full mt-2 outline-none border-none px-4 py-2 rounded-full {{ $errors->has('fname') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-blue-500' }} bg-gray-800 bg-opacity-60 transition duration-500 {{ $applicant->fname == null ? '' : 'cursor-not-allowed' }}" placeholder="John" @if ($applicant->fname != null) value="{{ $applicant->fname }}" disabled @endif />
                        </div>
                        <div class="w-full lg:w-full mt-1 lg:mt-0">
                            <span class="text-xs lg:flex items-center {{ $errors->has('lname') ? 'text-red-500' : '' }}">
                                @if ($applicant->lname == null)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 8 17 17 8 17"></polyline>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                    </svg>
                                @endif
                                last name
                            </span>
                            <input name="lname" class="w-full mt-2 outline-none border-none px-4 py-2 rounded-full {{ $errors->has('lname') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-blue-500' }} bg-gray-800 bg-opacity-60 transition duration-500 {{ $applicant->lname == null ? '' : 'cursor-not-allowed' }}" placeholder="Doe" @if ($applicant->lname != null) value="{{ $applicant->lname }}" disabled @endif />
                        </div>
                    </div>
                    <div class="mt-2 w-full">
                        <div class="w-full lg:w-full mt-1 lg:mt-0">
                            <span class="text-xs lg:flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                                email
                            </span>
                            <input type="email" class="w-full mt-2 outline-none border-none px-4 py-2 rounded-full bg-gray-800 opacity-60 cursor-not-allowed" value="{{ $applicant->email }}" disabled />
                        </div>
                    </div>
                    <div class="mt-2 lg:flex w-full gap-2">
                        <div class="w-full lg:w-full mt-1 lg:mt-0">
                            <span class="text-xs lg:flex items-center {{ $errors->has('dob') ? 'text-red-500' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="7" y1="7" x2="17" y2="17"></line>
                                    <polyline points="17 8 17 17 8 17"></polyline>
                                </svg>
                                date of birth
                            </span>
                            <input name="dob" class="w-full mt-2 outline-none border-none px-4 py-2 rounded-full {{ $errors->has('dob') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-blue-500' }} bg-gray-800 bg-opacity-60 transition duration-500" placeholder="yyyy-mm-dd" value="{{ $applicant->dob }}" />
                        </div>
                        <div class="w-full lg:w-full mt-1 lg:mt-0">
                            <span class="text-xs lg:flex items-center {{ $errors->has('country') ? 'text-red-500' : '' }}">
                                @if ($applicant->country == null)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-right inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 8 17 17 8 17"></polyline>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                    </svg>
                                @endif
                                nationality
                            </span>
                            <select name="country" class="w-full mt-2 outline-none border-none px-4 py-2 rounded-full {{ $errors->has('country') ? 'focus:ring focus:ring-red-500' : 'focus:ring focus:ring-blue-500' }} bg-gray-800 bg-opacity-60 transition duration-500 {{ $applicant->country == null ? '' : 'cursor-not-allowed' }}" @if ($applicant->country != null) disabled @endif>
                                <option hidden>[select]</option>
                                <option {{ $applicant->country == "AF" ? "selected" : "" }} value="AF">Afghanistan</option>
                                <option {{ $applicant->country == "AX" ? "selected" : "" }} value="AX">Åland Islands</option>
                                <option {{ $applicant->country == "AL" ? "selected" : "" }} value="AL">Albania</option>
                                <option {{ $applicant->country == "DZ" ? "selected" : "" }} value="DZ">Algeria</option>
                                <option {{ $applicant->country == "AS" ? "selected" : "" }} value="AS">American Samoa</option>
                                <option {{ $applicant->country == "AD" ? "selected" : "" }} value="AD">Andorra</option>
                                <option {{ $applicant->country == "AO" ? "selected" : "" }} value="AO">Angola</option>
                                <option {{ $applicant->country == "AI" ? "selected" : "" }} value="AI">Anguilla</option>
                                <option {{ $applicant->country == "AQ" ? "selected" : "" }} value="AQ">Antarctica</option>
                                <option {{ $applicant->country == "AG" ? "selected" : "" }} value="AG">Antigua and Barbuda</option>
                                <option {{ $applicant->country == "AR" ? "selected" : "" }} value="AR">Argentina</option>
                                <option {{ $applicant->country == "AM" ? "selected" : "" }} value="AM">Armenia</option>
                                <option {{ $applicant->country == "AW" ? "selected" : "" }} value="AW">Aruba</option>
                                <option {{ $applicant->country == "AU" ? "selected" : "" }} value="AU">Australia</option>
                                <option {{ $applicant->country == "AT" ? "selected" : "" }} value="AT">Austria</option>
                                <option {{ $applicant->country == "AZ" ? "selected" : "" }} value="AZ">Azerbaijan</option>
                                <option {{ $applicant->country == "BS" ? "selected" : "" }} value="BS">Bahamas</option>
                                <option {{ $applicant->country == "BH" ? "selected" : "" }} value="BH">Bahrain</option>
                                <option {{ $applicant->country == "BD" ? "selected" : "" }} value="BD">Bangladesh</option>
                                <option {{ $applicant->country == "BB" ? "selected" : "" }} value="BB">Barbados</option>
                                <option {{ $applicant->country == "BY" ? "selected" : "" }} value="BY">Belarus</option>
                                <option {{ $applicant->country == "BE" ? "selected" : "" }} value="BE">Belgium</option>
                                <option {{ $applicant->country == "BZ" ? "selected" : "" }} value="BZ">Belize</option>
                                <option {{ $applicant->country == "BJ" ? "selected" : "" }} value="BJ">Benin</option>
                                <option {{ $applicant->country == "BM" ? "selected" : "" }} value="BM">Bermuda</option>
                                <option {{ $applicant->country == "BT" ? "selected" : "" }} value="BT">Bhutan</option>
                                <option {{ $applicant->country == "BO" ? "selected" : "" }} value="BO">Bolivia, Plurinational State of</option>
                                <option {{ $applicant->country == "BQ" ? "selected" : "" }} value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                <option {{ $applicant->country == "BA" ? "selected" : "" }} value="BA">Bosnia and Herzegovina</option>
                                <option {{ $applicant->country == "BW" ? "selected" : "" }} value="BW">Botswana</option>
                                <option {{ $applicant->country == "BV" ? "selected" : "" }} value="BV">Bouvet Island</option>
                                <option {{ $applicant->country == "BR" ? "selected" : "" }} value="BR">Brazil</option>
                                <option {{ $applicant->country == "IO" ? "selected" : "" }} value="IO">British Indian Ocean Territory</option>
                                <option {{ $applicant->country == "BN" ? "selected" : "" }} value="BN">Brunei Darussalam</option>
                                <option {{ $applicant->country == "BG" ? "selected" : "" }} value="BG">Bulgaria</option>
                                <option {{ $applicant->country == "BF" ? "selected" : "" }} value="BF">Burkina Faso</option>
                                <option {{ $applicant->country == "BI" ? "selected" : "" }} value="BI">Burundi</option>
                                <option {{ $applicant->country == "KH" ? "selected" : "" }} value="KH">Cambodia</option>
                                <option {{ $applicant->country == "CM" ? "selected" : "" }} value="CM">Cameroon</option>
                                <option {{ $applicant->country == "CA" ? "selected" : "" }} value="CA">Canada</option>
                                <option {{ $applicant->country == "CV" ? "selected" : "" }} value="CV">Cape Verde</option>
                                <option {{ $applicant->country == "KY" ? "selected" : "" }} value="KY">Cayman Islands</option>
                                <option {{ $applicant->country == "CF" ? "selected" : "" }} value="CF">Central African Republic</option>
                                <option {{ $applicant->country == "TD" ? "selected" : "" }} value="TD">Chad</option>
                                <option {{ $applicant->country == "CL" ? "selected" : "" }} value="CL">Chile</option>
                                <option {{ $applicant->country == "CN" ? "selected" : "" }} value="CN">China</option>
                                <option {{ $applicant->country == "CX" ? "selected" : "" }} value="CX">Christmas Island</option>
                                <option {{ $applicant->country == "CC" ? "selected" : "" }} value="CC">Cocos (Keeling) Islands</option>
                                <option {{ $applicant->country == "CO" ? "selected" : "" }} value="CO">Colombia</option>
                                <option {{ $applicant->country == "KM" ? "selected" : "" }} value="KM">Comoros</option>
                                <option {{ $applicant->country == "CG" ? "selected" : "" }} value="CG">Congo</option>
                                <option {{ $applicant->country == "CD" ? "selected" : "" }} value="CD">Congo, the Democratic Republic of the</option>
                                <option {{ $applicant->country == "CK" ? "selected" : "" }} value="CK">Cook Islands</option>
                                <option {{ $applicant->country == "CK" ? "selected" : "" }} value="CR">Costa Rica</option>
                                <option {{ $applicant->country == "CI" ? "selected" : "" }} value="CI">Côte d'Ivoire</option>
                                <option {{ $applicant->country == "HR" ? "selected" : "" }} value="HR">Croatia</option>
                                <option {{ $applicant->country == "CU" ? "selected" : "" }} value="CU">Cuba</option>
                                <option {{ $applicant->country == "CW" ? "selected" : "" }} value="CW">Curaçao</option>
                                <option {{ $applicant->country == "CY" ? "selected" : "" }} value="CY">Cyprus</option>
                                <option {{ $applicant->country == "CZ" ? "selected" : "" }} value="CZ">Czech Republic</option>
                                <option {{ $applicant->country == "DK" ? "selected" : "" }} value="DK">Denmark</option>
                                <option {{ $applicant->country == "DJ" ? "selected" : "" }} value="DJ">Djibouti</option>
                                <option {{ $applicant->country == "DM" ? "selected" : "" }} value="DM">Dominica</option>
                                <option {{ $applicant->country == "DO" ? "selected" : "" }} value="DO">Dominican Republic</option>
                                <option {{ $applicant->country == "EC" ? "selected" : "" }} value="EC">Ecuador</option>
                                <option {{ $applicant->country == "EG" ? "selected" : "" }} value="EG">Egypt</option>
                                <option {{ $applicant->country == "SV" ? "selected" : "" }} value="SV">El Salvador</option>
                                <option {{ $applicant->country == "GQ" ? "selected" : "" }} value="GQ">Equatorial Guinea</option>
                                <option {{ $applicant->country == "ER" ? "selected" : "" }} value="ER">Eritrea</option>
                                <option {{ $applicant->country == "EE" ? "selected" : "" }} value="EE">Estonia</option>
                                <option {{ $applicant->country == "ET" ? "selected" : "" }} value="ET">Ethiopia</option>
                                <option {{ $applicant->country == "FK" ? "selected" : "" }} value="FK">Falkland Islands (Malvinas)</option>
                                <option {{ $applicant->country == "FO" ? "selected" : "" }} value="FO">Faroe Islands</option>
                                <option {{ $applicant->country == "FJ" ? "selected" : "" }} value="FJ">Fiji</option>
                                <option {{ $applicant->country == "FI" ? "selected" : "" }} value="FI">Finland</option>
                                <option {{ $applicant->country == "FR" ? "selected" : "" }} value="FR">France</option>
                                <option {{ $applicant->country == "GF" ? "selected" : "" }} value="GF">French Guiana</option>
                                <option {{ $applicant->country == "PF" ? "selected" : "" }} value="PF">French Polynesia</option>
                                <option {{ $applicant->country == "TF" ? "selected" : "" }} value="TF">French Southern Territories</option>
                                <option {{ $applicant->country == "GA" ? "selected" : "" }} value="GA">Gabon</option>
                                <option {{ $applicant->country == "GM" ? "selected" : "" }} value="GM">Gambia</option>
                                <option {{ $applicant->country == "GE" ? "selected" : "" }} value="GE">Georgia</option>
                                <option {{ $applicant->country == "DE" ? "selected" : "" }} value="DE">Germany</option>
                                <option {{ $applicant->country == "GH" ? "selected" : "" }} value="GH">Ghana</option>
                                <option {{ $applicant->country == "GI" ? "selected" : "" }} value="GI">Gibraltar</option>
                                <option {{ $applicant->country == "GR" ? "selected" : "" }} value="GR">Greece</option>
                                <option {{ $applicant->country == "GL" ? "selected" : "" }} value="GL">Greenland</option>
                                <option {{ $applicant->country == "GD" ? "selected" : "" }} value="GD">Grenada</option>
                                <option {{ $applicant->country == "GP" ? "selected" : "" }} value="GP">Guadeloupe</option>
                                <option {{ $applicant->country == "GU" ? "selected" : "" }} value="GU">Guam</option>
                                <option {{ $applicant->country == "GT" ? "selected" : "" }} value="GT">Guatemala</option>
                                <option {{ $applicant->country == "GG" ? "selected" : "" }} value="GG">Guernsey</option>
                                <option {{ $applicant->country == "GN" ? "selected" : "" }} value="GN">Guinea</option>
                                <option {{ $applicant->country == "GW" ? "selected" : "" }} value="GW">Guinea-Bissau</option>
                                <option {{ $applicant->country == "GY" ? "selected" : "" }} value="GY">Guyana</option>
                                <option {{ $applicant->country == "HT" ? "selected" : "" }} value="HT">Haiti</option>
                                <option {{ $applicant->country == "HM" ? "selected" : "" }} value="HM">Heard Island and McDonald Islands</option>
                                <option {{ $applicant->country == "VA" ? "selected" : "" }} value="VA">Holy See (Vatican City State)</option>
                                <option {{ $applicant->country == "HN" ? "selected" : "" }} value="HN">Honduras</option>
                                <option {{ $applicant->country == "HK" ? "selected" : "" }} value="HK">Hong Kong</option>
                                <option {{ $applicant->country == "HU" ? "selected" : "" }} value="HU">Hungary</option>
                                <option {{ $applicant->country == "IS" ? "selected" : "" }} value="IS">Iceland</option>
                                <option {{ $applicant->country == "IN" ? "selected" : "" }} value="IN">India</option>
                                <option {{ $applicant->country == "ID" ? "selected" : "" }} value="ID">Indonesia</option>
                                <option {{ $applicant->country == "IR" ? "selected" : "" }} value="IR">Iran, Islamic Republic of</option>
                                <option {{ $applicant->country == "IQ" ? "selected" : "" }} value="IQ">Iraq</option>
                                <option {{ $applicant->country == "IE" ? "selected" : "" }} value="IE">Ireland</option>
                                <option {{ $applicant->country == "IM" ? "selected" : "" }} value="IM">Isle of Man</option>
                                <option {{ $applicant->country == "IL" ? "selected" : "" }} value="IL">Israel</option>
                                <option {{ $applicant->country == "IT" ? "selected" : "" }} value="IT">Italy</option>
                                <option {{ $applicant->country == "JM" ? "selected" : "" }} value="JM">Jamaica</option>
                                <option {{ $applicant->country == "JP" ? "selected" : "" }} value="JP">Japan</option>
                                <option {{ $applicant->country == "JE" ? "selected" : "" }} value="JE">Jersey</option>
                                <option {{ $applicant->country == "JO" ? "selected" : "" }} value="JO">Jordan</option>
                                <option {{ $applicant->country == "KZ" ? "selected" : "" }} value="KZ">Kazakhstan</option>
                                <option {{ $applicant->country == "KE" ? "selected" : "" }} value="KE">Kenya</option>
                                <option {{ $applicant->country == "KI" ? "selected" : "" }} value="KI">Kiribati</option>
                                <option {{ $applicant->country == "KP" ? "selected" : "" }} value="KP">Korea, Democratic People's Republic of</option>
                                <option {{ $applicant->country == "KR" ? "selected" : "" }} value="KR">Korea, Republic of</option>
                                <option {{ $applicant->country == "KW" ? "selected" : "" }} value="KW">Kuwait</option>
                                <option {{ $applicant->country == "KG" ? "selected" : "" }} value="KG">Kyrgyzstan</option>
                                <option {{ $applicant->country == "LA" ? "selected" : "" }} value="LA">Lao People's Democratic Republic</option>
                                <option {{ $applicant->country == "LV" ? "selected" : "" }} value="LV">Latvia</option>
                                <option {{ $applicant->country == "LB" ? "selected" : "" }} value="LB">Lebanon</option>
                                <option {{ $applicant->country == "LS" ? "selected" : "" }} value="LS">Lesotho</option>
                                <option {{ $applicant->country == "LR" ? "selected" : "" }} value="LR">Liberia</option>
                                <option {{ $applicant->country == "LY" ? "selected" : "" }} value="LY">Libya</option>
                                <option {{ $applicant->country == "LI" ? "selected" : "" }} value="LI">Liechtenstein</option>
                                <option {{ $applicant->country == "LT" ? "selected" : "" }} value="LT">Lithuania</option>
                                <option {{ $applicant->country == "LU" ? "selected" : "" }} value="LU">Luxembourg</option>
                                <option {{ $applicant->country == "MO" ? "selected" : "" }} value="MO">Macao</option>
                                <option {{ $applicant->country == "MK" ? "selected" : "" }} value="MK">Macedonia, the former Yugoslav Republic of</option>
                                <option {{ $applicant->country == "MG" ? "selected" : "" }} value="MG">Madagascar</option>
                                <option {{ $applicant->country == "MW" ? "selected" : "" }} value="MW">Malawi</option>
                                <option {{ $applicant->country == "MY" ? "selected" : "" }} value="MY">Malaysia</option>
                                <option {{ $applicant->country == "MV" ? "selected" : "" }} value="MV">Maldives</option>
                                <option {{ $applicant->country == "ML" ? "selected" : "" }} value="ML">Mali</option>
                                <option {{ $applicant->country == "MT" ? "selected" : "" }} value="MT">Malta</option>
                                <option {{ $applicant->country == "MH" ? "selected" : "" }} value="MH">Marshall Islands</option>
                                <option {{ $applicant->country == "MQ" ? "selected" : "" }} value="MQ">Martinique</option>
                                <option {{ $applicant->country == "MR" ? "selected" : "" }} value="MR">Mauritania</option>
                                <option {{ $applicant->country == "MU" ? "selected" : "" }} value="MU">Mauritius</option>
                                <option {{ $applicant->country == "YT" ? "selected" : "" }} value="YT">Mayotte</option>
                                <option {{ $applicant->country == "MX" ? "selected" : "" }} value="MX">Mexico</option>
                                <option {{ $applicant->country == "FM" ? "selected" : "" }} value="FM">Micronesia, Federated States of</option>
                                <option {{ $applicant->country == "MD" ? "selected" : "" }} value="MD">Moldova, Republic of</option>
                                <option {{ $applicant->country == "MC" ? "selected" : "" }} value="MC">Monaco</option>
                                <option {{ $applicant->country == "MN" ? "selected" : "" }} value="MN">Mongolia</option>
                                <option {{ $applicant->country == "ME" ? "selected" : "" }} value="ME">Montenegro</option>
                                <option {{ $applicant->country == "MS" ? "selected" : "" }} value="MS">Montserrat</option>
                                <option {{ $applicant->country == "MA" ? "selected" : "" }} value="MA">Morocco</option>
                                <option {{ $applicant->country == "MZ" ? "selected" : "" }} value="MZ">Mozambique</option>
                                <option {{ $applicant->country == "MM" ? "selected" : "" }} value="MM">Myanmar</option>
                                <option {{ $applicant->country == "NA" ? "selected" : "" }} value="NA">Namibia</option>
                                <option {{ $applicant->country == "NR" ? "selected" : "" }} value="NR">Nauru</option>
                                <option {{ $applicant->country == "NP" ? "selected" : "" }} value="NP">Nepal</option>
                                <option {{ $applicant->country == "NL" ? "selected" : "" }} value="NL">Netherlands</option>
                                <option {{ $applicant->country == "NC" ? "selected" : "" }} value="NC">New Caledonia</option>
                                <option {{ $applicant->country == "NZ" ? "selected" : "" }} value="NZ">New Zealand</option>
                                <option {{ $applicant->country == "NI" ? "selected" : "" }} value="NI">Nicaragua</option>
                                <option {{ $applicant->country == "NE" ? "selected" : "" }} value="NE">Niger</option>
                                <option {{ $applicant->country == "NG" ? "selected" : "" }} value="NG">Nigeria</option>
                                <option {{ $applicant->country == "NU" ? "selected" : "" }} value="NU">Niue</option>
                                <option {{ $applicant->country == "NF" ? "selected" : "" }} value="NF">Norfolk Island</option>
                                <option {{ $applicant->country == "MP" ? "selected" : "" }} value="MP">Northern Mariana Islands</option>
                                <option {{ $applicant->country == "NO" ? "selected" : "" }} value="NO">Norway</option>
                                <option {{ $applicant->country == "OM" ? "selected" : "" }} value="OM">Oman</option>
                                <option {{ $applicant->country == "PK" ? "selected" : "" }} value="PK">Pakistan</option>
                                <option {{ $applicant->country == "PW" ? "selected" : "" }} value="PW">Palau</option>
                                <option {{ $applicant->country == "PS" ? "selected" : "" }} value="PS">Palestinian Territory, Occupied</option>
                                <option {{ $applicant->country == "PA" ? "selected" : "" }} value="PA">Panama</option>
                                <option {{ $applicant->country == "PG" ? "selected" : "" }} value="PG">Papua New Guinea</option>
                                <option {{ $applicant->country == "PY" ? "selected" : "" }} value="PY">Paraguay</option>
                                <option {{ $applicant->country == "PE" ? "selected" : "" }} value="PE">Peru</option>
                                <option {{ $applicant->country == "PH" ? "selected" : "" }} value="PH">Philippines</option>
                                <option {{ $applicant->country == "PN" ? "selected" : "" }} value="PN">Pitcairn</option>
                                <option {{ $applicant->country == "PL" ? "selected" : "" }} value="PL">Poland</option>
                                <option {{ $applicant->country == "PT" ? "selected" : "" }} value="PT">Portugal</option>
                                <option {{ $applicant->country == "PR" ? "selected" : "" }} value="PR">Puerto Rico</option>
                                <option {{ $applicant->country == "QA" ? "selected" : "" }} value="QA">Qatar</option>
                                <option {{ $applicant->country == "RE" ? "selected" : "" }} value="RE">Réunion</option>
                                <option {{ $applicant->country == "RO" ? "selected" : "" }} value="RO">Romania</option>
                                <option {{ $applicant->country == "RU" ? "selected" : "" }} value="RU">Russian Federation</option>
                                <option {{ $applicant->country == "RW" ? "selected" : "" }} value="RW">Rwanda</option>
                                <option {{ $applicant->country == "BL" ? "selected" : "" }} value="BL">Saint Barthélemy</option>
                                <option {{ $applicant->country == "SH" ? "selected" : "" }} value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                <option {{ $applicant->country == "KN" ? "selected" : "" }} value="KN">Saint Kitts and Nevis</option>
                                <option {{ $applicant->country == "LC" ? "selected" : "" }} value="LC">Saint Lucia</option>
                                <option {{ $applicant->country == "MF" ? "selected" : "" }} value="MF">Saint Martin (French part)</option>
                                <option {{ $applicant->country == "PM" ? "selected" : "" }} value="PM">Saint Pierre and Miquelon</option>
                                <option {{ $applicant->country == "VC" ? "selected" : "" }} value="VC">Saint Vincent and the Grenadines</option>
                                <option {{ $applicant->country == "WS" ? "selected" : "" }} value="WS">Samoa</option>
                                <option {{ $applicant->country == "SM" ? "selected" : "" }} value="SM">San Marino</option>
                                <option {{ $applicant->country == "ST" ? "selected" : "" }} value="ST">Sao Tome and Principe</option>
                                <option {{ $applicant->country == "SA" ? "selected" : "" }} value="SA">Saudi Arabia</option>
                                <option {{ $applicant->country == "SN" ? "selected" : "" }} value="SN">Senegal</option>
                                <option {{ $applicant->country == "RS" ? "selected" : "" }} value="RS">Serbia</option>
                                <option {{ $applicant->country == "SC" ? "selected" : "" }} value="SC">Seychelles</option>
                                <option {{ $applicant->country == "SL" ? "selected" : "" }} value="SL">Sierra Leone</option>
                                <option {{ $applicant->country == "SG" ? "selected" : "" }} value="SG">Singapore</option>
                                <option {{ $applicant->country == "SX" ? "selected" : "" }} value="SX">Sint Maarten (Dutch part)</option>
                                <option {{ $applicant->country == "SK" ? "selected" : "" }} value="SK">Slovakia</option>
                                <option {{ $applicant->country == "SI" ? "selected" : "" }} value="SI">Slovenia</option>
                                <option {{ $applicant->country == "SB" ? "selected" : "" }} value="SB">Solomon Islands</option>
                                <option {{ $applicant->country == "SO" ? "selected" : "" }} value="SO">Somalia</option>
                                <option {{ $applicant->country == "ZA" ? "selected" : "" }} value="ZA">South Africa</option>
                                <option {{ $applicant->country == "GS" ? "selected" : "" }} value="GS">South Georgia and the South Sandwich Islands</option>
                                <option {{ $applicant->country == "SS" ? "selected" : "" }} value="SS">South Sudan</option>
                                <option {{ $applicant->country == "ES" ? "selected" : "" }} value="ES">Spain</option>
                                <option {{ $applicant->country == "LK" ? "selected" : "" }} value="LK">Sri Lanka</option>
                                <option {{ $applicant->country == "SD" ? "selected" : "" }} value="SD">Sudan</option>
                                <option {{ $applicant->country == "SR" ? "selected" : "" }} value="SR">Suriname</option>
                                <option {{ $applicant->country == "SJ" ? "selected" : "" }} value="SJ">Svalbard and Jan Mayen</option>
                                <option {{ $applicant->country == "SZ" ? "selected" : "" }} value="SZ">Swaziland</option>
                                <option {{ $applicant->country == "SE" ? "selected" : "" }} value="SE">Sweden</option>
                                <option {{ $applicant->country == "CH" ? "selected" : "" }} value="CH">Switzerland</option>
                                <option {{ $applicant->country == "SY" ? "selected" : "" }} value="SY">Syrian Arab Republic</option>
                                <option {{ $applicant->country == "TW" ? "selected" : "" }} value="TW">Taiwan, Province of China</option>
                                <option {{ $applicant->country == "TJ" ? "selected" : "" }} value="TJ">Tajikistan</option>
                                <option {{ $applicant->country == "TZ" ? "selected" : "" }} value="TZ">Tanzania, United Republic of</option>
                                <option {{ $applicant->country == "TH" ? "selected" : "" }} value="TH">Thailand</option>
                                <option {{ $applicant->country == "TL" ? "selected" : "" }} value="TL">Timor-Leste</option>
                                <option {{ $applicant->country == "TG" ? "selected" : "" }} value="TG">Togo</option>
                                <option {{ $applicant->country == "TK" ? "selected" : "" }} value="TK">Tokelau</option>
                                <option {{ $applicant->country == "TO" ? "selected" : "" }} value="TO">Tonga</option>
                                <option {{ $applicant->country == "TT" ? "selected" : "" }} value="TT">Trinidad and Tobago</option>
                                <option {{ $applicant->country == "TN" ? "selected" : "" }} value="TN">Tunisia</option>
                                <option {{ $applicant->country == "TR" ? "selected" : "" }} value="TR">Turkey</option>
                                <option {{ $applicant->country == "TM" ? "selected" : "" }} value="TM">Turkmenistan</option>
                                <option {{ $applicant->country == "TC" ? "selected" : "" }} value="TC">Turks and Caicos Islands</option>
                                <option {{ $applicant->country == "TV" ? "selected" : "" }} value="TV">Tuvalu</option>
                                <option {{ $applicant->country == "UG" ? "selected" : "" }} value="UG">Uganda</option>
                                <option {{ $applicant->country == "UA" ? "selected" : "" }} value="UA">Ukraine</option>
                                <option {{ $applicant->country == "AE" ? "selected" : "" }} value="AE">United Arab Emirates</option>
                                <option {{ $applicant->country == "GB" ? "selected" : "" }} value="GB">United Kingdom</option>
                                <option {{ $applicant->country == "US" ? "selected" : "" }} value="US">United States</option>
                                <option {{ $applicant->country == "UM" ? "selected" : "" }} value="UM">United States Minor Outlying Islands</option>
                                <option {{ $applicant->country == "UY" ? "selected" : "" }} value="UY">Uruguay</option>
                                <option {{ $applicant->country == "UZ" ? "selected" : "" }} value="UZ">Uzbekistan</option>
                                <option {{ $applicant->country == "VU" ? "selected" : "" }} value="VU">Vanuatu</option>
                                <option {{ $applicant->country == "VE" ? "selected" : "" }} value="VE">Venezuela, Bolivarian Republic of</option>
                                <option {{ $applicant->country == "VN" ? "selected" : "" }} value="VN">Viet Nam</option>
                                <option {{ $applicant->country == "VG" ? "selected" : "" }} value="VG">Virgin Islands, British</option>
                                <option {{ $applicant->country == "VI" ? "selected" : "" }} value="VI">Virgin Islands, U.S.</option>
                                <option {{ $applicant->country == "WF" ? "selected" : "" }} value="WF">Wallis and Futuna</option>
                                <option {{ $applicant->country == "EH" ? "selected" : "" }} value="EH">Western Sahara</option>
                                <option {{ $applicant->country == "YE" ? "selected" : "" }} value="YE">Yemen</option>
                                <option {{ $applicant->country == "ZM" ? "selected" : "" }} value="ZM">Zambia</option>
                                <option {{ $applicant->country == "ZW" ? "selected" : "" }} value="ZW">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="lg:flex items-center mt-4 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-pulse icon icon-tabler icon-tabler-urgent inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 16v-4a4 4 0 0 1 8 0v4"></path>
                        <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7"></path>
                        <rect x="6" y="16" width="12" height="4" rx="1"></rect>
                    </svg>
                    by continuing you agree to our&nbsp;
                    <a class="text-blue-500" href="{{ route('apply.privacy') }}" target="_blank">privacy policy</a>.
                </div>
                <div class="mt-4 lg:flex lg:float-right lg:gap-2">
                    <div x-data class="lg:mt-0 mt-3 w-full lg:w-auto">
                        <button x-on:click="document.getElementById('finalize-application').submit();" class="text-sm justify-center lg:text-base w-full lg:w-auto flex items-center focus:outline-none px-4 py-2 rounded-full focus:shadow-outline bg-blue-600 hover:bg-blue-700 text-white transition duration-500" placeholder="username">
                            submit
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right inline-block w-6 ml-3" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <line x1="13" y1="18" x2="19" y2="12"></line>
                                <line x1="13" y1="6" x2="19" y2="12"></line>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
