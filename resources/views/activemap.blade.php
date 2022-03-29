<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    
    <title>Hello, world!</title>
</head>

<body>
    
  
    <style>
        ._submit {
            -webkit-appearance: none;
            cursor: pointer;
            font-family: arial, sans-serif;
            font-size: 14px;
            text-align: center;
            background: #004cff !important;
            border: 0 !important;
            -moz-border-radius: 7px !important;
            -webkit-border-radius: 7px !important;
            border-radius: 7px !important;
            color: #fff !important;
            padding: 12px !important;
            width: 100%;
        }
    </style>
    <script>
        var dis = 0;
    </script>
    <script>
        "use strict";



        function initMap() {
            const componentForm = [
                'sublocality_level_1', //colonia
                'street_number', //numero de la casa
                'location', //ciudad
                'route', //dirreccion
                'locality', //ciudad
                'administrative_area_level_1', //estado
                'postal_code', //codigo postal
            ];
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: {
                    lat: 25.542243,
                    lng: -103.384470
                },
                mapTypeControl: false,
                fullscreenControl: true,
                zoomControl: true,
                streetViewControl: false
            });
            const marker = new google.maps.Marker({
                map: map,
                draggable: false
            });
            const autocompleteInput = document.getElementById('location');
            const autocomplete = new google.maps.places.Autocomplete(autocompleteInput, {
                fields: ["address_components", "geometry", "name"],
                types: ["address"],
            });
            autocomplete.addListener('place_changed', function() {
                marker.setVisible(false);
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert('No details available for input: \'' + place.name + '\'');
                    return;
                }
                
                renderAddress(place);
                fillInAddress(place);
            });

            function fillInAddress(place) { // optional parameter

                const addressNameFormat = {
                    'sublocality_level_1': 'long_name',
                    'street_number': 'long_name',
                    'route': 'long_name',
                    'locality': 'long_name',
                    'administrative_area_level_1': 'long_name',
                    'postal_code': 'long_name',
                };

                const getAddressComp = function(type) {
                   
                    for (const component of place.address_components) {
                        if (component.types[0] === type) {
                            
                            return component[addressNameFormat[type]];
                        }
                    }
                    return '';
                };

                for (const component of componentForm) {
                    // segun el componente se llena su dato
                    if (component !== 'location') { 
                        document.getElementById(component).value = getAddressComp(component);
                    }
                }
                document.getElementById('dlatitud').value = place.geometry.location.lat()
                document.getElementById('dlongitud').value = place.geometry.location.lng()
                document.getElementById('lat').value = place.geometry.location.lat()
                document.getElementById('lng').value = place.geometry.location.lng()
                var ciudad = document.getElementById('locality').value
                var estado =document.getElementById('administrative_area_level_1').value
               var  estados=[{"Baja California":["Tijuana", "lipsi"]},{"Baja California2":["Tijuana2","lipsi 2"]}]
               var  ciudades=[,' de arroz']
               estados.forEach(s => {
                   console.log(s.value)
                    
                });
                console.log("Estado", estado);
                console.log("ciudad", ciudad);
                document.getElementById('field[17]').value = document.getElementById('route').value
                document.getElementById('field[18]').value = document.getElementById('street_number').value
                document.getElementById('field[23]').value = document.getElementById('sublocality_level_1').value
                document.getElementById('field[21]').value = document.getElementById('locality').value
                document.getElementById('field[25]').value = document.getElementById('administrative_area_level_1').value
                document.getElementById('field[22]').value = document.getElementById('postal_code').value
                console.log("aqui veremos que onda")
                console.log(document.getElementById('dlongitud').value);
                document.getElementById('nombre').value = place.name

            }

            function renderAddress(place) {
                map.setCenter(place.geometry.location);
                map.setZoom(14);
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            }
        }
    </script>
    <input type="hidden" readonly name="nombre" id="nombre" class="form-control">
    <input type="hidden" readonly name="dlatitud" id="dlatitud" class="form-control">
    <input type="hidden" readonly id="dlongitud" class="form-control" name="dlongitud">
    <input type="hidden" readonly class="form-control" name="ddireccion" id="route">
    <input type="hidden" readonly class="form-control" name="dnumero" id="street_number">
    <input type="hidden" readonly class="form-control" name="dcodigo" id="postal_code">
    <input type="hidden" readonly class="form-control" name="dcolonia" id="sublocality_level_1">
    <input type="hidden" readonly class="form-control" name="destado" id="administrative_area_level_1">
    <input type="hidden" readonly class="form-control" name="dmuni" id="locality">

    <div>
        <form method="POST" action="https://instatecommx.activehosted.com/proc.php" id="_form_25_" class="_form _form_25 _inline-form  _dark" novalidate>
            <input type="hidden" name="u" value="25" />
            <input type="hidden" name="f" value="25" />
            <input type="hidden" name="s" />
            <input type="hidden" name="c" value="0" />
            <input type="hidden" name="m" value="0" />
            <input type="hidden" name="act" value="sub" />
            <input type="hidden" name="v" value="2" />
            <input type="hidden" name="or" value="18515ce236be7e02f3893a5eb6284dcd" />



            <div class="_form-content">
                <section class="row">
                    <section class="col-md-6">
                        <link href="https://fonts.googleapis.com/css2?family=Lato&family=Montserrat&family=Roboto&display=swap" rel="stylesheet">

                        <div class="_form_element _x21160663 _full_width _clear">
                            <div class="_form-title">
                                <h4>Ayúdame a conocerte.</h4>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <div class="_form_element _x07957146 _full_width ">
                                <label for="fullname" class="_form-label">Nombre
                                </label>
                                <div class="_field-wrapper">
                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nombre" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="_form_element _field27 _full_width ">
                                <label for="field[27]" class="_form-label">Apellido
                                </label>
                                <div class="_field-wrapper">
                                    <input type="text" class="form-control" id="field[27]" name="field[27]" value="" placeholder="Apellido" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="_form_element _x84590067 _full_width ">
                                <label for="email" class="_form-label">E-mail
                                </label>
                                <div class="_field-wrapper">
                                    <input type="text" id="email" class="form-control" name="email" placeholder="E-mail" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="_form_element _field28 _full_width ">
                                <label for="field[28]" class="_form-label">Número de whatsapp
                                </label>
                                <div class="_field-wrapper">
                                    <input type="text" id="field[28]" class="form-control" name="field[28]" value="" placeholder="Número de whatsapp" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="_form_element _field24 _full_width ">
                                <label for="field[24]" class="_form-label">Tu ciudad de residencia
                                </label>
                                <div class="_field-wrapper">
                                    <input type="text" id="field[24]" class="form-control" name="field[24]" value="" placeholder="Tu ciudad de residencia" />
                                </div>
                            </div>
                        </div>

                        <h4>Ingrese la unicacion en la que desea trabajar</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group input-group">
                                    <img class="sb-title-icon" src="https://fonts.gstatic.com/s/i/googlematerialicons/location_pin/v5/24px.svg" alt="">
                                    <input type="text" id="location" class="form-control" placeholder="localizacion ">
                                    <div class="input-group-btn">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="map" id="map" style="width: 100%; height: 500px;  "></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="_form_element _x75767881 _full_width _clear">
                                    <div class="_form-title">
                                        <h4>Ahora hablemos del terreno de tu futuro negocio.</h4>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="_form_element _field17 _full_width ">
                                        <label for="field[17]" class="_form-label">
                                        </label>
                                        <div class="_field-wrapper">
                                            <input type="text" id="field[17]" class="form-control" readonly name="field[17]" value="" placeholder="Calle" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <div class="_form_element _field18 _full_width ">
                                            <label for="field[18]" class="_form-label">
                                            </label>
                                            <div class="_field-wrapper">
                                                <input type="text" id="field[18]" class="form-control" readonly name="field[18]" value="" placeholder="Número" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">

                                        <div class="_form_element _field23 _full_width ">
                                            <label for="field[23]" class="_form-label">
                                            </label>
                                            <div class="_field-wrapper">
                                                <input type="text" id="field[23]" class="form-control" readonly name="field[23]" value="" placeholder="Colonia" />
                                            </div>
                                        </div>




                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="_form_element _field21 _full_width ">
                                        <label for="field[21]" class="_form-label">
                                        </label>
                                        <div class="_field-wrapper">
                                            <input type="text" id="field[21]" class="form-control" readonly name="field[21]" value="" placeholder="Ciudad" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <div class="_form_element _field25 _full_width ">
                                            <label for="field[25]" class="_form-label">
                                            </label>
                                            <div class="_field-wrapper">
                                                <input type="text" id="field[25]" class="form-control" readonly name="field[25]" value="" placeholder="Estado" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="_form_element _field22 _full_width ">
                                            <label for="field[22]" class="_form-label">
                                            </label>
                                            <div class="_field-wrapper">
                                                <input type="text" id="field[22]" class="form-control" readonly class="form-control" name="field[22]" value="" placeholder="CP" />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="_form_element _field37 _full_width ">
                                    <input type="hidden" id="lng" name="field[37]" value="" />
                                </div>
                                <div class="_form_element _field36 _full_width ">
                                    <input type="hidden" id="lat" name="field[36]" value="" />
                                </div>

                                <div class="_form_element _field20 _full_width ">
                                    <fieldset class="_form-fieldset">
                                        <legend class="_form-label">
                                            Actualmente la propiedad está:
                                        </legend>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <div class="_row _checkbox-radio">
                                                <input id="field_20Terreno vacío" type="radio" name="field[20]" value="Terreno vacío">
                                                <span>
                                                    <label for="field_20Terreno vacío">
                                                        Terreno vacío
                                                </span>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <div class="_row _checkbox-radio">
                                                <input id="field_20Construcción en abandono" type="radio" name="field[20]" value="Construcción en abandono">
                                                <span>
                                                    <label for="field_20Construcción en abandono">
                                                        Construcción en abandono
                                                </span>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <div class="_row _checkbox-radio">
                                                <input id="field_20Construido" type="radio" name="field[20]" value="Construido">
                                                <span>
                                                    <label for="field_20Construido">
                                                        Construido
                                                </span>
                                            </div>
                                        </div>



                                    </fieldset>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <div class="_form_element _field30 _full_width ">
                                            <label for="field[30]" class="_form-label">
                                            </label>
                                            <div class="_field-wrapper">
                                                <input type="text" id="field[30]" class="form-control" name="field[30]" value="" placeholder="Frente" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="_form_element _field31 _full_width ">
                                            <label for="field[31]" class="_form-label">
                                            </label>
                                            <div class="_field-wrapper">
                                                <input type="text" id="field[31]" class="form-control" name="field[31]" value="" placeholder="Largo" />
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="_clear-element">
                                </div>

                                <div class="_form-thank-you" style="display:none;">
                                </div>
                                <div class="_form-branding" style="display: none;">
                                    <div class="_marketing-by">
                                        Marketing por
                                    </div>
                                    <a href="https://www.activecampaign.com/?utm_medium=referral&utm_campaign=acforms" class="_logo">
                                        <span class="form-sr-only">
                                            ActiveCampaign
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </section>
                </section>

                <section class="row">
                    <section class="col-md-3" style="margin-top: -20px;">
                        <div class="_form_element _x60140171 _full_width _clear">
                            <div class="_html-code">
                                <p style="color:#787878; opacity:0.7">
                                    <strong>
                                        <h4>Quiero conocer sus posibilidades de uso de suelo y
                                            oportunidades de negocio</h4>
                                    </strong>
                                </p>
                            </div>
                        </div>
                    </section>
                    <section class="col-md-3">
                        <div class="_button-wrapper _full_width">
                            <button id="_form_25_submit" class="_submit" type="submit">
                                Pagar USD$97 y recibelo en menos de 24 hrs.
                            </button>
                        </div>
                    </section>
                </section>
            </div>
        </form>

    </div>









    <script type="text/javascript">
        window.cfields = {
            "27": "apellido",
            "28": "nmero_de_whatsapp",
            "24": "city",
            "17": "calle",
            "18": "nmero",
            "23": "colonia",
            "21": "ciudad",
            "25": "residencia",
            "37": "lng",
            "36": "lat",
            "22": "cp",
            "20": "actualmente_la_propiedad_est",
            "30": "ancho",
            "31": "largo"
        };
        window._show_thank_you = function(id, message, trackcmp_url, email) {
            var form = document.getElementById('_form_' + id + '_'),
                thank_you = form.querySelector('._form-thank-you');
            form.querySelector('._form-content').style.display = 'none';
            thank_you.innerHTML = message;
            thank_you.style.display = 'block';
            const vgoAlias = typeof visitorGlobalObjectAlias === 'undefined' ? 'vgo' : visitorGlobalObjectAlias;
            var visitorObject = window[vgoAlias];
            if (email && typeof visitorObject !== 'undefined') {
                visitorObject('setEmail', email);
                visitorObject('update');
            } else if (typeof(trackcmp_url) != 'undefined' && trackcmp_url) {
                // Site tracking URL to use after inline form submission.
                _load_script(trackcmp_url);
            }
            if (typeof window._form_callback !== 'undefined') window._form_callback(id);
        };
        window._show_error = function(id, message, html) {
            var form = document.getElementById('_form_' + id + '_'),
                err = document.createElement('div'),
                button = form.querySelector('button'),
                old_error = form.querySelector('._form_error');
            if (old_error) old_error.parentNode.removeChild(old_error);
            err.innerHTML = message;
            err.className = '_error-inner _form_error _no_arrow';
            var wrapper = document.createElement('div');
            wrapper.className = '_form-inner';
            wrapper.appendChild(err);
            button.parentNode.insertBefore(wrapper, button);
            document.querySelector('[id^="_form"][id$="_submit"]').disabled = false;
            if (html) {
                var div = document.createElement('div');
                div.className = '_error-html';
                div.innerHTML = html;
                err.appendChild(div);
            }
        };
        window._load_script = function(url, callback) {
            var head = document.querySelector('head'),
                script = document.createElement('script'),
                r = false;
            script.type = 'text/javascript';
            script.charset = 'utf-8';
            script.src = url;
            if (callback) {
                script.onload = script.onreadystatechange = function() {
                    if (!r && (!this.readyState || this.readyState == 'complete')) {
                        r = true;
                        callback();
                    }
                };
            }
            head.appendChild(script);
        };
        (function() {
            if (window.location.search.search("excludeform") !== -1) return false;
            var getCookie = function(name) {
                var match = document.cookie.match(new RegExp('(^|; )' + name + '=([^;]+)'));
                return match ? match[2] : null;
            }
            var setCookie = function(name, value) {
                var now = new Date();
                var time = now.getTime();
                var expireTime = time + 1000 * 60 * 60 * 24 * 365;
                now.setTime(expireTime);
                document.cookie = name + '=' + value + '; expires=' + now + ';path=/';
            }
            var addEvent = function(element, event, func) {
                if (element.addEventListener) {
                    element.addEventListener(event, func);
                } else {
                    var oldFunc = element['on' + event];
                    element['on' + event] = function() {
                        oldFunc.apply(this, arguments);
                        func.apply(this, arguments);
                    };
                }
            }
            var _removed = false;
            var form_to_submit = document.getElementById('_form_25_');
            var allInputs = form_to_submit.querySelectorAll('input, select, textarea'),
                tooltips = [],
                submitted = false;

            var getUrlParam = function(name) {
                var params = new URLSearchParams(window.location.search);
                return params.get(name) || false;
            };

            for (var i = 0; i < allInputs.length; i++) {
                var regexStr = "field\\[(\\d+)\\]";
                var results = new RegExp(regexStr).exec(allInputs[i].name);
                if (results != undefined) {
                    allInputs[i].dataset.name = window.cfields[results[1]];
                } else {
                    allInputs[i].dataset.name = allInputs[i].name;
                }
                var fieldVal = getUrlParam(allInputs[i].dataset.name);

                if (fieldVal) {
                    if (allInputs[i].dataset.autofill === "false") {
                        continue;
                    }
                    if (allInputs[i].type == "radio" || allInputs[i].type == "checkbox") {
                        if (allInputs[i].value == fieldVal) {
                            allInputs[i].checked = true;
                        }
                    } else {
                        allInputs[i].value = fieldVal;
                    }
                }
            }

            var remove_tooltips = function() {
                for (var i = 0; i < tooltips.length; i++) {
                    tooltips[i].tip.parentNode.removeChild(tooltips[i].tip);
                }
                tooltips = [];
            };
            var remove_tooltip = function(elem) {
                for (var i = 0; i < tooltips.length; i++) {
                    if (tooltips[i].elem === elem) {
                        tooltips[i].tip.parentNode.removeChild(tooltips[i].tip);
                        tooltips.splice(i, 1);
                        return;
                    }
                }
            };
            var create_tooltip = function(elem, text) {
                var tooltip = document.createElement('div'),
                    arrow = document.createElement('div'),
                    inner = document.createElement('div'),
                    new_tooltip = {};
                if (elem.type != 'radio' && elem.type != 'checkbox') {
                    tooltip.className = '_error';
                    arrow.className = '_error-arrow';
                    inner.className = '_error-inner';
                    inner.innerHTML = text;
                    tooltip.appendChild(arrow);
                    tooltip.appendChild(inner);
                    elem.parentNode.appendChild(tooltip);
                } else {
                    tooltip.className = '_error-inner _no_arrow';
                    tooltip.innerHTML = text;
                    elem.parentNode.insertBefore(tooltip, elem);
                    new_tooltip.no_arrow = true;
                }
                new_tooltip.tip = tooltip;
                new_tooltip.elem = elem;
                tooltips.push(new_tooltip);
                return new_tooltip;
            };
            var resize_tooltip = function(tooltip) {
                var rect = tooltip.elem.getBoundingClientRect();
                var doc = document.documentElement,
                    scrollPosition = rect.top - ((window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0));
                if (scrollPosition < 40) {
                    tooltip.tip.className = tooltip.tip.className.replace(/ ?(_above|_below) ?/g, '') + ' _below';
                } else {
                    tooltip.tip.className = tooltip.tip.className.replace(/ ?(_above|_below) ?/g, '') + ' _above';
                }
            };
            var resize_tooltips = function() {
                if (_removed) return;
                for (var i = 0; i < tooltips.length; i++) {
                    if (!tooltips[i].no_arrow) resize_tooltip(tooltips[i]);
                }
            };
            var validate_field = function(elem, remove) {
                var tooltip = null,
                    value = elem.value,
                    no_error = true;
                remove ? remove_tooltip(elem) : false;
                if (elem.type != 'checkbox') elem.className = elem.className.replace(/ ?_has_error ?/g, '');
                if (elem.getAttribute('required') !== null) {
                    if (elem.type == 'radio' || (elem.type == 'checkbox' && /any/.test(elem.className))) {
                        var elems = form_to_submit.elements[elem.name];
                        if (!(elems instanceof NodeList || elems instanceof HTMLCollection) || elems.length <= 1) {
                            no_error = elem.checked;
                        } else {
                            no_error = false;
                            for (var i = 0; i < elems.length; i++) {
                                if (elems[i].checked) no_error = true;
                            }
                        }
                        if (!no_error) {
                            tooltip = create_tooltip(elem, "Seleccione una opción.");
                        }
                    } else if (elem.type == 'checkbox') {
                        var elems = form_to_submit.elements[elem.name],
                            found = false,
                            err = [];
                        no_error = true;
                        for (var i = 0; i < elems.length; i++) {
                            if (elems[i].getAttribute('required') === null) continue;
                            if (!found && elems[i] !== elem) return true;
                            found = true;
                            elems[i].className = elems[i].className.replace(/ ?_has_error ?/g, '');
                            if (!elems[i].checked) {
                                no_error = false;
                                elems[i].className = elems[i].className + ' _has_error';
                                err.push("Es necesario verificar %s".replace("%s", elems[i].value));
                            }
                        }
                        if (!no_error) {
                            tooltip = create_tooltip(elem, err.join('<br/>'));
                        }
                    } else if (elem.tagName == 'SELECT') {
                        var selected = true;
                        if (elem.multiple) {
                            selected = false;
                            for (var i = 0; i < elem.options.length; i++) {
                                if (elem.options[i].selected) {
                                    selected = true;
                                    break;
                                }
                            }
                        } else {
                            for (var i = 0; i < elem.options.length; i++) {
                                if (elem.options[i].selected && !elem.options[i].value) {
                                    selected = false;
                                }
                            }
                        }
                        if (!selected) {
                            elem.className = elem.className + ' _has_error';
                            no_error = false;
                            tooltip = create_tooltip(elem, "Seleccione una opción.");
                        }
                    } else if (value === undefined || value === null || value === '') {
                        elem.className = elem.className + ' _has_error';
                        no_error = false;
                        tooltip = create_tooltip(elem, "Este campo es obligatorio.");
                    }
                }
                if (no_error && elem.name == 'email') {
                    if (!value.match(/^[\+_a-z0-9-'&=]+(\.[\+_a-z0-9-']+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i)) {
                        elem.className = elem.className + ' _has_error';
                        no_error = false;
                        tooltip = create_tooltip(elem, "Introduzca una dirección de correo electrónico válida.");
                    }
                }
                if (no_error && /date_field/.test(elem.className)) {
                    if (!value.match(/^\d\d\d\d-\d\d-\d\d$/)) {
                        elem.className = elem.className + ' _has_error';
                        no_error = false;
                        tooltip = create_tooltip(elem, "Introduzca una fecha válida.");
                    }
                }
                tooltip ? resize_tooltip(tooltip) : false;
                return no_error;
            };
            var needs_validate = function(el) {
                if (el.getAttribute('required') !== null) {
                    return true
                }
                if (el.name === 'email' && el.value !== "") {
                    return true
                }
                return false
            };
            var validate_form = function(e) {
                var err = form_to_submit.querySelector('._form_error'),
                    no_error = true;
                if (!submitted) {
                    submitted = true;
                    for (var i = 0, len = allInputs.length; i < len; i++) {
                        var input = allInputs[i];
                        if (needs_validate(input)) {
                            if (input.type == 'text' || input.type == 'number' || input.type == 'time') {
                                addEvent(input, 'blur', function() {
                                    this.value = this.value.trim();
                                    validate_field(this, true);
                                });
                                addEvent(input, 'input', function() {
                                    validate_field(this, true);
                                });
                            } else if (input.type == 'radio' || input.type == 'checkbox') {
                                (function(el) {
                                    var radios = form_to_submit.elements[el.name];
                                    for (var i = 0; i < radios.length; i++) {
                                        addEvent(radios[i], 'click', function() {
                                            validate_field(el, true);
                                        });
                                    }
                                })(input);
                            } else if (input.tagName == 'SELECT') {
                                addEvent(input, 'change', function() {
                                    validate_field(this, true);
                                });
                            } else if (input.type == 'textarea') {
                                addEvent(input, 'input', function() {
                                    validate_field(this, true);
                                });
                            }
                        }
                    }
                }
                remove_tooltips();
                for (var i = 0, len = allInputs.length; i < len; i++) {
                    var elem = allInputs[i];
                    if (needs_validate(elem)) {
                        if (elem.tagName.toLowerCase() !== "select") {
                            elem.value = elem.value.trim();
                        }
                        validate_field(elem) ? true : no_error = false;
                    }
                }
                if (!no_error && e) {
                    e.preventDefault();
                }
                resize_tooltips();
                return no_error;
            };
            addEvent(window, 'resize', resize_tooltips);
            addEvent(window, 'scroll', resize_tooltips);
            var _form_serialize = function(form) {
                if (!form || form.nodeName !== "FORM") {
                    return
                }
                var i, j, q = [];
                for (i = 0; i < form.elements.length; i++) {
                    if (form.elements[i].name === "") {
                        continue
                    }
                    switch (form.elements[i].nodeName) {
                        case "INPUT":
                            switch (form.elements[i].type) {
                                case "text":
                                case "number":
                                case "date":
                                case "time":
                                case "hidden":
                                case "password":
                                case "button":
                                case "reset":
                                case "submit":
                                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                                    break;
                                case "checkbox":
                                case "radio":
                                    if (form.elements[i].checked) {
                                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value))
                                    }
                                    break;
                                case "file":
                                    break
                            }
                            break;
                        case "TEXTAREA":
                            q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                            break;
                        case "SELECT":
                            switch (form.elements[i].type) {
                                case "select-one":
                                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                                    break;
                                case "select-multiple":
                                    for (j = 0; j < form.elements[i].options.length; j++) {
                                        if (form.elements[i].options[j].selected) {
                                            q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].options[j].value))
                                        }
                                    }
                                    break
                            }
                            break;
                        case "BUTTON":
                            switch (form.elements[i].type) {
                                case "reset":
                                case "submit":
                                case "button":
                                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                                    break
                            }
                            break
                    }
                }
                return q.join("&")
            };
            var form_submit = function(e) {
                e.preventDefault();
                if (validate_form()) {
                    // use this trick to get the submit button & disable it using plain javascript
                    document.querySelector('#_form_25_submit').disabled = true;
                    var serialized = _form_serialize(document.getElementById('_form_25_')).replace(/%0A/g, '\\n');
                    var err = form_to_submit.querySelector('._form_error');
                    err ? err.parentNode.removeChild(err) : false;
                    _load_script('https://instatecommx.activehosted.com/proc.php?' + serialized + '&jsonp=true');
                }
                return false;
            };
            addEvent(form_to_submit, 'submit', form_submit);
        })();
    </script>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>

</body>

</html>
