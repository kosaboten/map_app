@extends('layouts.main')
@section('title', '店舗情報修正')
@section('content')
    <h1>店舗情報修正</h1>

    <form action="{{ route('shops.update', $shop) }}" method="post">
        @csrf
        @method('patch')
        <div>
            <label for="name">店舗名:</label>
            <input type="text" name="name" id="name" value="{{ old("name", $shop->name) }}">
        </div>
        <div>
            <label for="description">詳細:</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old("description", $shop->description) }}</textarea>
        </div>
        <div>
            <label for="address">住所:</label>
            <input type="text" name="address" id="address" value="{{ old("address", $shop->address) }}">
        </div>
        <input type="hidden" id="latitude" name="latitude" value="{{ $shop->latitude }}">
        <input type="hidden" id="longitude" name="longitude" value="{{ $shop->longitude }}">
        <div id="map" style="height:50vh;"></div>
        <div>
            <input type="submit" value="更新">
            <button type="button" onclick="location.href='{{ route('shops.show', $shop) }}'">詳細へ戻る</button>
        </div>
    </form>
@endsection

@section('script')
    @include('partial.map')
    <script>
        const lat = document.getElementById('latitude');
        const lng = document.getElementById('longitude');
        @if(!empty($shop))
            const marker = L.marker([{{ $shop->latitude }}, {{ $shop->longitude }}], {draggable: true})
                .bindPopup("{{ $shop->name }}", {closeButton: false})
                .addTo(map);
            marker.on('dragend', function(e) {
                // 座標は、e.target.getLatLng()で取得
                lat.value = e.target.getLatLng()['lat'];
                lng.value = e.target.getLatLng()['lng'];
            });
        @endif
    </script>
@endsection
