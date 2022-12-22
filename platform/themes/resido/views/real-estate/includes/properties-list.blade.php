@php
    $layout = theme_option('properties_page_layout');
    $requestLayout = request()->input('layout');
    if ($requestLayout && in_array($requestLayout, array_keys(get_properties_page_layout()))) {
        $layout = $requestLayout;
    }

    $layout = ($layout && in_array($layout, array_keys(get_properties_page_layout()))) ? $layout : 'sidebar';
    $viewType = request()->input('view', 'grid');
    $gridClass = 'col-lg-12 col-md-12';
    $gridItemClass = 'col-lg-6 col-md-12';

    if ($layout !== 'full' && $layout !== 'grid_full') {
        $gridClass = 'col-lg-8 col-md-12';
    }

    switch ($layout) {
        case 'grid_sidebar':
        case 'grid_map':
        case 'sidebar':
        case 'map':
            if($viewType == 'list') {
                 $gridItemClass = 'col-lg-12 col-md-12';
            }
            break;

        case 'full':
            $viewType = 'list';
            break;

        case 'grid_full':
            if ($viewType == 'list') {
                $gridItemClass = 'col-lg-6 col-md-12';
            } else {
                $gridItemClass = 'col-lg-4 col-md-6 col-sm-12';
            }
            break;
    }
@endphp

@if ($layout == 'half_map')
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
    <div class="half-map container-fluid max-w-screen-2xl">
        <div class="fs-content">
            <form action="{{ route('public.properties') }}" method="get" id="ajax-filters-form">
                <input type="hidden" name="page" data-value="{{ $properties->currentPage() }}">
                <input type="hidden" name="layout" value="{{ request()->input('layout') }}">
                <div class="row">
                    <div class="fs-inner-container1 col-md-7" id="properties-list">
                        @include(Theme::getThemeNamespace('views.real-estate.includes.filters-halfmap'))
                        <div class="list-layout data-listing position-relative">
                            {!! Theme::partial('real-estate.properties.items', compact('properties')) !!}
                        </div>
                    </div>
                    <div class="fs-left-map-box1 col-md-5">
                        <div class="rightmap h-100">
                            <div id="mapAdvance" data-type="{{ request()->input('type') }}"
                                 data-url="{{ route('public.ajax.properties.map') }}"
                                 data-center="{{ json_encode([24.72227, 46.771884]) }}"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
@else
    <!-- ============================ All Property ================================== -->
    <section class="gray">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="filter_search_opt">
                        <a href="javascript:void(0);" class="open_search_menu">{{ __('Search Property') }}<i
                                class="ml-2 ti-menu"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                @if ($layout !== 'full' && $layout !== 'grid_full')
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="simple-sidebar sm-sidebar" id="filter_search" style="left: -310px;">
                            @include(Theme::getThemeNamespace('views.real-estate.includes.search-sidebar'))
                        </div>
                    </div>
                @endif

                <div class="{{ $gridClass }} list-layout">
                    <div class="row justify-content-center">
                        @include(Theme::getThemeNamespace('views.real-estate.includes.sorting-box'))
                    </div>

                    <div class="row">
                        @foreach ($properties as $property)
                            <div class="{{ $gridItemClass }}">
                                @if (strpos($viewType, 'grid') !== false)
                                    {!! Theme::partial('real-estate.properties.item-grid', compact('property')) !!}
                                @else
                                    {!! Theme::partial('real-estate.properties.item-list', compact('property')) !!}
                                @endif
                            </div>
                            <!-- End Single Property -->
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <nav class="d-flex justify-content-center pt-3" aria-label="Page navigation">
                                {!! $properties->withQueryString()->onEachSide(1)->links() !!}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- changes -->

<script id="traffic-popup-google-map-template" type="text/x-custom-template">
    @php
        $propertiesMap = [];
        foreach ($properties->items() as $property) {
            $propertiesMap[] = [
                'id' => $property->id,
                'name' => $property->name,
                'type_name' => $property->type_name,
                'type_slug' => $property->type_slug,
                'url' => $property->url,
                'city_name' => $property->city_name,
                'square_text' => $property->square_text,
                'number_bedroom' => $property->number_bedroom,
                'number_bathroom' => $property->number_bathroom,
                'image_thumb' => $property->image_thumb,
                'price_html' => $property->price_html,
                'latitude' => $property->latitude,
                'longitude' => $property->longitude
            ];
        }
    @endphp
    {!! Theme::partial('real-estate.properties.map-popup', ['property' => get_object_property_map()]) !!}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ setting('google_geo_api_key', '') }}"></script>
<script src="https://rawgit.com/googlemaps/js-rich-marker/gh-pages/src/richmarker.js"></script>
<script>
    var propertiesData = <?= count($propertiesMap) > 0 ? json_encode($propertiesMap) : '{}' ?>;
    $(document).ready(function () {
        var prev_infowindow =false;

        $('#mapAdvance')
            .on('click', '.marker_google_map', function () {
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

            // Init map
            var mapOptions = {
                zoom: 7,
                center: new google.maps.LatLng(propertiesData[0] !== undefined ? propertiesData[0].latitude : 24.72227, propertiesData[0] !== undefined ? propertiesData[0].longitude : 46.771884),
                scrollwheel: true,
                styles: [
                    {
                        featureType: "poi.business",
                        stylers: [{visibility: "off"}],
                    },
                    {
                        featureType: "transit",
                        elementType: "labels.icon",
                        stylers: [{visibility: "off"}],
                    },
                    {
                        featureType: "administrative",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#727272"}]
                    }, {
                        featureType: "administrative.locality",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#2f3c4b"}]
                    }, {featureType: "poi", elementType: "labels", stylers: [{visibility: "off"}]}, {
                        featureType: "poi",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#727272"}]
                    }, {
                        featureType: "poi",
                        elementType: "labels.icon",
                        stylers: [{color: "#7b7b7b"}, {lightness: "48"}]
                    }, {
                        featureType: "poi.park",
                        elementType: "geometry.fill",
                        stylers: [{color: "#c9e3ad"}]
                    }, {
                        featureType: "poi.sports_complex",
                        elementType: "geometry.fill",
                        stylers: [{color: "#bed7a4"}]
                    }, {
                        featureType: "road",
                        elementType: "geometry.stroke",
                        stylers: [{visibility: "off"}, {saturation: "0"}]
                    }, {
                        featureType: "road.highway",
                        elementType: "geometry.fill",
                        stylers: [{saturation: "0"}, {color: "#dddddd"}]
                    }, {
                        featureType: "road.highway",
                        elementType: "geometry.stroke",
                        stylers: [{color: "#b0b0b0"}]
                    }, {
                        featureType: "road.highway",
                        elementType: "labels",
                        stylers: [{visibility: "on"}]
                    }, {featureType: "road.highway", elementType: "labels.icon", stylers: [{lightness: "38"}]}]
            };

            var map = new google.maps.Map(document.getElementById("mapAdvance"), mapOptions);

            // Create info window
            var infowindow = new google.maps.InfoWindow({
                maxWidth: 300,
                pixelOffset: new google.maps.Size(-10, -25)
            });

            var $templatePopup = $('#traffic-popup-google-map-template').html();

            var infoFn = function (count) {
                return function (e) {
                    if( prev_infowindow ) {
                        prev_infowindow.close();
                    }

                    var popup = templateReplace(propertiesData[count], $templatePopup);
                    infowindow.setContent(popup);
                    infowindow.open(map);
                    infowindow.setPosition(new google.maps.LatLng(propertiesData[count].latitude, propertiesData[count].longitude));

                    if( prev_infowindow == infowindow) {
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
            }

            setInterval(function () {
                if (!infowindow.getMap()) {
                    $('.marker_google_map').removeClass('selected');
                }
            }, 1000);
        }

        google.maps.event.addDomListener(window, "load", initMap(propertiesData));
    })
</script>
