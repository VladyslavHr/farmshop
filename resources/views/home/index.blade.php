@extends('layouts.app')
@section('title', 'Wildfarm.com.ua')
@section('description', 'Еко ферма для всієї родини, Farm, фермерські продукти, еко продукти, купити продукти,')
@section('keywords', 'ферма, мясо, органіка, томати, яйцяБ молокоБ олія, яблоко, кавун, екзотичні фрукти, екзотика,')

@section('content')

<div class="main-bg-image"></div>


<div class="container py-3">

    <h1 class="text-center">Ласкаво просимо до родинної ферми <span class="home-brand-title">Wildfarm.com.ua</span></h1>

    <div class="row py-5">
            <div class="product-type-wrap col-lg-4 pb-4">
                <a href="{{ route('products.index') }}">
                    <div class="product-type-img" style="background-image: url('/images/kram-log.jpeg')">
                        <div class="home-type-title">
                            <h2>
                                Крамниця
                            </h2>
                        </div>
                        <div class="home-type-desc">Переглянути усі товари</div>
                    </div>
                </a>
            </div>
        @foreach ($productsType as $type)
            <div class="product-type-wrap col-lg-4 pb-4">
                <a href="{{ route('productTypes.show', $type->slug) }}">
                    <div class="product-type-img" style="background-image: url('{{ $type->logo }}')">
                        <div class="home-type-title">
                            <h2>
                                {{ $type->name }}
                            </h2>
                        </div>
                        <div class="home-type-desc"></div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="location-info pt-3">
        <h3>Знайти нас можете за адресою: <a href="https://goo.gl/maps/L6uoThWfC2Rr35By6" target="_blank" class="home-link-map"><strong>Вул. Гагаріна 17, с. Соколово, Новомосковський район, Дніпропетровська область</strong></a></h3>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.15.1/build/ol.js"></script>
<div id="map" class="map"></div>
<script type="text/javascript">
        var map = new ol.Map({
                interactions: ol.interaction.defaults({
                doubleClickZoom: true,
                dragAndDrop: true,
                dragPan: true,
                keyboardPan: true,
                keyboardZoom: true,
                mouseWheelZoom: false,
                pointer: true,
                select: true
            }),
            target: 'map',
            layers: [
            new ol.layer.Tile({
                // source: new ol.source.TileImage({ url: 'http://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}' }),
                source: new ol.source.TileImage({ url: 'https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}' }),
                // source: new ol.source.OSM()
            })
            ],
            view: new ol.View({
            // center: ol.proj.fromLonLat([14.39449747352899,50.000841226042056]),
            center: ol.proj.fromLonLat([35.312033, 48.528032 ]),
            zoom: 17
            })
        });

        var markers = new ol.layer.Vector({
            source: new ol.source.Vector(),
            style: new ol.style.Style({
                image: new ol.style.Icon({
                anchor: [0.5, 1],
                name: 'Name',
                text: 'TEXT',
                src: 'logo/marker.png'
                }),
                text: new ol.style.Text({
                    text: "Wildfarm.com.ua",
                    scale: 1.8,
                    offsetX: 100,
                    offsetY: -30,
                    fill: new ol.style.Fill({
                        color: "#d0312d"
                    }),
                    stroke: new ol.style.Stroke({
                        color: "#fff",
                        width: 2
                    }),

                }),

            })
            });
            map.addLayer(markers);



            var marker = new ol.Feature(new ol.geom.Point(ol.proj.fromLonLat([35.312033, 48.528032])));
            markers.getSource().addFeature(marker);

</script>
@endsection
