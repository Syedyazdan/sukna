@php
Theme::asset()
->usePath()
->add('leaflet-css', 'plugins/leaflet.css');
Theme::asset()
->container('footer')
->usePath()
->add('leaflet-js', 'plugins/leaflet.js');
Theme::asset()
->container('footer')
->usePath()
->add('leaflet.markercluster-src-js', 'plugins/leaflet.markercluster-src.js');
@endphp

<div class="home-map-banner full-wrapious">
    <div class="hm-map-container fw-map">
        <div id="mapAdvance" data-type="{{ request()->input('type') }}" data-url="{{ route('public.ajax.properties.map') }}" data-center="{{ json_encode([24.72227, 46.771884]) }}"></div>
    </div>

    <!-- Advance Search -->
    <div class="advance-search-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button data-bs-toggle="collapse" hidden data-bs-target="#ad-search" class="btn adv-btn">{{ __('Advanced Search') }}
                    </button>

                    <div id="ad-search" class="collapse show" style="box-shadow: 0px 0px 9px 0px #c7684b, inset 0px 0px 9px 0px #c7684b;border: 2px solid;color: #c7684b;">
                        <div>

                            <div class="full-search-2 eclip-search italian-search hero-search-radius shadow-hard">
                                <div class="hero-search-content">
                                    <form action="{{ route('public.properties') }}" method="GET" id="frmhomesearch">
                                        <div class="row">

                                            <div class="col-lg-3 col-md-3 col-sm-12 b-r">
                                                <div class="form-group">
                                                    <div class="choose-property-type">
                                                        {!! Theme::partial('real-estate.filters.type') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-md-6 col-sm-12 p-0 elio">
                                                <div class="form-group">
                                                    <div class="input-with-icon">
                                                        {!! Theme::partial('real-estate.filters.input-search') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <button type="submit" id="btn" class="btn search-btn black">{{ __('Search') }}</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script id="traffic-popup-google-map-template" type="text/x-custom-template">
    {!! Theme::partial('real-estate.properties.map-popup', ['property' => get_object_property_map()]) !!}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ setting('google_geo_api_key', '') }}"></script>
<script src="https://rawgit.com/googlemaps/js-rich-marker/gh-pages/src/richmarker.js"></script>
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

<script>
    $(function() {
        $('#btn').on('click', function() {


            var topsearch = $('#top').val();
            //alert(topsearch);
            var model = {
                k: topsearch,
                _token: '{{csrf_token()}}'
            };

            $.ajax({
                type: "get",
                url: "{{url('/top_search')}}",
                data: model,
                contentType: "application/json; charset=utf-8",
                dataType: "text",
                success: function(data) {
                    //alert('yazdan');
                },
                failure: function(data) {
                    console.log('Failed');
                }

            });


        });
    });




    var propertiesData = [];
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    $(document).ready(function() {
        var totalPage = 0;
        var currentPage = 1;
        var params = {
            type: $('#mapAdvance').data('type'),
            page: currentPage
        };
        var prev_infowindow = false;

        $.ajax({
            url: $('#mapAdvance').data('url'),
            type: 'POST',
            data: params,
            success: function(res) {
                if (res.data.length > 0) {
                    res.data.forEach(property => {
                        propertiesData.push({
                            'id': property.id,
                            'name': property.name,
                            'type_name': property.type_name,
                            'type_slug': property.type_slug,
                            'url': property.url,
                            'city_name': property.city_name,
                            'square_text': property.square_text,
                            'number_bedroom': property.number_bedroom,
                            'number_bathroom': property.number_bathroom,
                            'image_thumb': property.image_thumb,
                            'price_html': property.price_html,
                            'latitude': property.latitude,
                            'longitude': property.longitude
                        });
                    })

                    google.maps.event.addDomListener(window, "load", initMap(propertiesData));
                }
            }
        });

        $('#mapAdvance')
            .on('click', '.marker_google_map', function() {
                $('.marker_google_map').removeClass('selected');
                $(this).addClass('selected');
            });

        function templateReplace(data, template) {
            const keys = Object.keys(data);
            for (const i in keys) {
                if (keys.hasOwnProperty(i)) {
                    const key = keys[i]
                    template = template.replace(new RegExp('__' + key + '__', 'gi'), data[key] || '')
                }
            }
            return template;
        }

        function initMap(propertiesData) {
            var count, marker;
            var startLat = '';
            var endLong = '';

            // Init map
            var mapOptions = {
                zoom: 12,
                center: new google.maps.LatLng(propertiesData[0] !== undefined ? propertiesData[0].latitude : 24.72227, propertiesData[0] !== undefined ? propertiesData[0].longitude : 46.771884),
                scrollwheel: true,
                styles: [{
                        featureType: "poi.business",
                        stylers: [{
                            visibility: "off"
                        }],
                    },
                    {
                        featureType: "transit",
                        elementType: "labels.icon",
                        stylers: [{
                            visibility: "off"
                        }],
                    },
                    {
                        featureType: "administrative",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#727272"
                        }]
                    }, {
                        featureType: "administrative.locality",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#2f3c4b"
                        }]
                    }, {
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [{
                            visibility: "off"
                        }]
                    }, {
                        featureType: "poi",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#727272"
                        }]
                    }, {
                        featureType: "poi",
                        elementType: "labels.icon",
                        stylers: [{
                            color: "#7b7b7b"
                        }, {
                            lightness: "48"
                        }]
                    }, {
                        featureType: "poi.park",
                        elementType: "geometry.fill",
                        stylers: [{
                            color: "#c9e3ad"
                        }]
                    }, {
                        featureType: "poi.sports_complex",
                        elementType: "geometry.fill",
                        stylers: [{
                            color: "#bed7a4"
                        }]
                    }, {
                        featureType: "road",
                        elementType: "geometry.stroke",
                        stylers: [{
                            visibility: "off"
                        }, {
                            saturation: "0"
                        }]
                    }, {
                        featureType: "road.highway",
                        elementType: "geometry.fill",
                        stylers: [{
                            saturation: "0"
                        }, {
                            color: "#dddddd"
                        }]
                    }, {
                        featureType: "road.highway",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#b0b0b0"
                        }]
                    }, {
                        featureType: "road.highway",
                        elementType: "labels",
                        stylers: [{
                            visibility: "on"
                        }]
                    }, {
                        featureType: "road.highway",
                        elementType: "labels.icon",
                        stylers: [{
                            lightness: "38"
                        }]
                    }
                ]


            };

            var map = new google.maps.Map(document.getElementById("mapAdvance"), mapOptions);

            // Create info window
            var infowindow = new google.maps.InfoWindow({
                maxWidth: 300,
                pixelOffset: new google.maps.Size(-10, -25),
                content: "",
                disableAutoPan: true,
            });

            var $templatePopup = $('#traffic-popup-google-map-template').html();

            var infoFn = function(count) {
                return function(e) {
                    if (prev_infowindow) {
                        prev_infowindow.close();
                    }

                    var popup = templateReplace(propertiesData[count], $templatePopup);
                    infowindow.setContent(popup);
                    infowindow.open(map);
                    infowindow.setPosition(new google.maps.LatLng(propertiesData[count].latitude, propertiesData[count].longitude));

                    if (prev_infowindow == infowindow) {
                        prev_infowindow.close();
                        prev_infowindow = false;
                        return;
                    }

                    prev_infowindow = infowindow;
                }
            };

            /**
             * A customized popup on the map.
             */
            // Add markers
            let markers = [];
            for (count = 0; count < propertiesData.length; count++) {
                marker = new RichMarker({
                    data_id: propertiesData[count].id,
                    position: new google.maps.LatLng(propertiesData[count].latitude, propertiesData[count].longitude),
                    map: map,
                    flat: true,
                    animation: google.maps.Animation.DROP,
                    content: '<div class="marker_google_map boxmarker" data-id="' + propertiesData[count].id + '">' + propertiesData[count].type_name + ': ' + propertiesData[count].price_html + '</div>',
                    optimized: false,
                    visible: true,
                    draggable: true,
                });


                marker.setMap(map);

                let fn = infoFn(count);
                google.maps.event.addListener(marker, 'click', fn);
                markers.push(marker);
            }

            const markerCluster = new markerClusterer.MarkerClusterer({
                map,
                markers
            });
            // new MarkerClusterer({ markers, map });

            setInterval(function() {
                if (!infowindow.getMap()) {
                    $('.marker_google_map').removeClass('selected');
                }
            }, 1000);
        }
    })
</script>