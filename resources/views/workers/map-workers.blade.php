<x-app-layout>
    @section('title')
        Xem vị trí thợ
    @endsection
    <style>
            #map {
    height: 100%;
    }
    #TooltipDemo{
        display: none;
    }

    </style>
    
    <div class="container-fluid">
        <div class="maps card m-1" style="height:80vh;">
            <div id="map"></div>

            <!-- 
             The `defer` attribute causes the callback to execute after the full HTML
             document has been parsed. For non-blocking uses, avoiding race conditions,
             and consistent behavior across browsers, consider loading using Promises
             with https://www.npmjs.com/package/@googlemaps/js-api-loader.
            -->
           
        </div>
        <div class="card m-1" style="height: 9vh; display:inherit">
            <div class="row">
                <div class="col-4">
                    <label for="" class="mt-3">Xem toàn bộ thợ</label>  <button class="btn btn-warning btn-sm ml-4" onclick="initMap()">Xem</button>
                </div>
                <div class="col-6">
                        <div class="form-row">
                          <div class="col-md-2"> 
                              <label for="" class="mt-3">Tìm vị trí thợ: </label>
                          </div>
                          <div class="col-7 mt-3">
                            <select name="search_tho" id="search_tho">
                              @foreach ($workers as $item)
                                
                                    <option value="{{$item->id}}"> {{$item->sort_name}} - {{$item->worker_name}}</option>
                                  
                              @endforeach
                            </select>
                                  {{-- <input type="text" name="search_tho" id="search_tho" class="form-control"> --}}
                          </div>
                          <div class="col-2 mt-3"> 
                              <button class="btn btn-sm btn-success" onclick="getOneWorker()"> Tìm Kiếm </button>
                          </div>
                        </div>
              </div>
              <div class="col-2">
              </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        
        function initMap(lat , log) {
          const myLatLng = { lat: 10.8231563, lng: 106.7016373 };
          const mapOptions = {
            zoom: 13,
            center: myLatLng,
            mapTypeId: "roadmap",
            styles: [{
                featureType: 'poi',
                stylers: [{ visibility: 'off' }]  // Turn off points of interest.
              }, {
                featureType: 'transit.station',
                stylers: [{ visibility: 'off' }]  // Turn off bus stations, train stations, etc.
              }],
            disableDoubleClickZoom: true,
            streetViewControl: false
          };
          
          var map = new google.maps.Map(document.getElementById("map"), mapOptions);
          
          const icon={
            url: "{{asset('userfiles/images/tholocal.png')}}", // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(0,0), // origin
          };
          var marker, i;
          var da123 = $.ajax({
          type: 'get',
          url: "{{url('map-workers/allLocal')}}",
          async: false,
          context: document.body,
          success: function (da123) {
            console.log(da123);
              return da123;
          },
          error: function (xhr, type, exception) {
              // Do your thing
          }
          });
          for (i = 0; i < da123.responseJSON.length; i++) {  
              marker = new google.maps.Marker({
              position: new google.maps.LatLng(da123.responseJSON[i].lat, da123.responseJSON[i].log),
              map: map,
              icon: icon,
              
              title:'- Thông tin thợ :' + da123.responseJSON[i].id_worker + ' \n- Lần cuối cập nhật :' +da123.responseJSON[i].last_active,
              
            });
           
          }
        }
       
//Get one user by id
        function getOneWorker(){
          const my1LatLng = { lat: 10.8231563, lng: 106.7016373 };
          const map1Options = {
            zoom: 13,
            center: my1LatLng,
            mapTypeId: "roadmap",
            styles: [{
                featureType: 'poi',
                stylers: [{ visibility: 'off' }]  // Turn off points of interest.
              }, {
                featureType: 'transit.station',
                stylers: [{ visibility: 'off' }]  // Turn off bus stations, train stations, etc.
              }],
            disableDoubleClickZoom: true,
            streetViewControl: false
          };
          // const iconBase ="https://developers.google.com/maps/documentation/javascript/examples/full/images/";
          const icon={
            url: "{{asset('userfiles/images/tholocal.png')}}", // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(0,0), // origin
          };
          var marker, i;
          var map1 = new google.maps.Map(document.getElementById("map"), map1Options);
          var id =  document.getElementById("search_tho").value;
          // console.log(id);

          var da1 = $.ajax({
          type: 'get',
          url: "{{url('map-workers/getOneWorker?id_worker=')}}"+id,
          async: false,
          context: document.body,
          
          success: function (da1) {
          
              return da1;
          },
          error: function (xhr, type, exception) {
              // Do your thing
          }
          });
          
          marker = new google.maps.Marker({
              position: new google.maps.LatLng(da1.responseJSON[0].lat, da1.responseJSON[0].log),
              map: map1,
              icon: icon,
              title:'- Thông tin thợ :' + da1.responseJSON[0].id_worker + ' \n- Lần cuối cập nhật :' +da1.responseJSON[0].last_active ,
              })
          
            // const myLatLng = { lat: 11.8231563, lng: 106.7016373 };
            // const map = new google.maps.Map(document.getElementById("map"), {
            //       zoom: 12,
            //       center: myLatLng,
            //   });
    
            // new google.maps.Marker({
            //       position: myLatLng,
            //       map,
            //       title: "Thợ Việt",
            // });
        } 
        window.initMap = initMap;    
</script>
    {{-- <script type="text/javascript"  src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&callback=initMap" ></script> --}}
    <script
      src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&callback=initMap&v=weekly"
      defer
    ></script>
</x-app-layout>
