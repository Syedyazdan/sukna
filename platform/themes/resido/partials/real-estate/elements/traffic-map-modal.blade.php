<div id="zxcvbnm">
    @if (!empty($location))
        <p>{{ $location }}</p>
    @endif
    <div class="traffic-map-container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div id="trafficMapAdvance" class="w-100 h-100"></div>
            </div>
        </div>
    </div>
</div>
<!-- changes -->
@php
    $propertyMap = [
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
@endphp
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ setting('google_geo_api_key', '') }}&libraries=places&callback=initMap">
</script>
<script>
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

    function initMap() {
        var propertyMap = <?=json_encode($propertyMap)  ?>;

        var count, marker;

        // Init map
        var mapOptions = {
            zoom: 13,
            center: new google.maps.LatLng(propertyMap.latitude, propertyMap.longitude),
            scrollwheel: true,
        };

        var map = new google.maps.Map(document.getElementById("trafficMapAdvance"), mapOptions);

        // Create info window
        var infowindow = new google.maps.InfoWindow({
            maxWidth: 350,
            pixelOffset: new google.maps.Size(-10,-25)
        });

        var infoFn = function () {
            return function (e) {
                var popup = templateReplace(propertyMap, $('#traffic-popup-map-template').html());
                infowindow.setContent(popup);
                infowindow.open(map);
                infowindow.setPosition(new google.maps.LatLng(propertyMap.latitude, propertyMap.longitude));
            }
        };

        // Add markers
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(propertyMap.latitude, propertyMap.longitude),
            map: map,
            title:propertyMap.name
        });
        marker.setMap(map);

        let fn = infoFn();
        google.maps.event.addListener(marker, 'click', fn);
        google.maps.event.trigger(marker,'click');
    }
</script>
