<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            <div class="mb-4">
              <label for="birthday">Start Date:</label>
              <input class="w-full rounded border-gray-200" type="date" id="start-time" name="startTime" value="{{date("Y-m-d")}}">
            </div>
            <div class="mb-4">
              <label for="birthday">End Date:</label>
              <input class="w-full rounded border-gray-200" type="date" id="end-time" name="endTime" value="{{date("Y-m-d")}}">
            </div>
            <div class="mb-4 pt-6">
              <button type="submit" id="search" class="bg-green-500 p-2 hover:bg-green-700 text-white rounded">Search</button>
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" id="my-chart-1">
                  <canvas id="myChart"></canvas> 
              </div>
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" id="my-chart-2">
                  <canvas id="myChart2"></canvas> 
              </div>
          </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>

<script>
    $(document).ready(function(){
      $("#search").click()
    });

    $("#search").click(function() {
      $.ajax({
        type:'POST',
        url: '/dashboard/filter-report',
        data: {
          startTime: $("#start-time").val(),
          endTime: $("#end-time").val()
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (response) => {
          $('#myChart').remove();
          $('#myChart2').remove();
          $('#my-chart-1').append('<canvas id="myChart"><canvas>');
          $('#my-chart-2').append('<canvas id="myChart2"><canvas>');

          var options = {
            layout: {
                padding:10
            },
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }

          const ctx = document.getElementById('myChart');
          var chartIn = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: response.resultIn.label,
              datasets: [{
                label: 'Total Uang masuk',
                data: response.resultIn.value,
                borderWidth: 1
              }]
            },
            options: options
          });

          const ctx2 = document.getElementById('myChart2');
          var chartOut = new Chart(ctx2, {
            type: 'bar',
            data: {
              labels: response.resultOut.label,
              datasets: [{
                label: 'Total Uang Keluar',
                data: response.resultOut.value,
                borderWidth: 1
              }]
            },
            options: options
          });
        },
        error: function(response){

        }
      });
    })
</script>