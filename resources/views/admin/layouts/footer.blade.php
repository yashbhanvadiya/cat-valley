    <footer class="content-footer footer bg-footer-theme">

    </footer>
    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
    
    <script src="{{ asset('/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/js/config.js') }}"></script>
    <script src="{{ asset('/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') }}"></script>
    <script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js')}}"></script>
    <script src="{{ asset('/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/dashboards-analytics.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
      $(document).ready(function() {
          toastr.options.timeOut = 2000;
          @if(Session::has('error'))
              toastr.error('{{ Session::get('error') }}');
          @elseif(Session::has('success'))
              toastr.success('{{ Session::get('success') }}');
          @elseif(Session::has('warning'))
              toastr.warning('{{ Session::get('warning') }}');
          @endif
      });
    </script>
  
    @yield('js')
  </body>
</html>