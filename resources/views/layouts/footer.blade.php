<footer class="site-footer mt-5" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>About The YogaFun</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <ul class="list-unstyled footer-link d-flex footer-social">
                    <li><a href="#" class="p-2"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="p-2"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="p-2"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="p-2"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>

            </div>
            <div class="col-md-5 pl-md-5">
                <h3>Contact Info</h3>
                <ul class="list-unstyled footer-link">
                    <li class="d-block">
                        <b class="d-block">Address:</b>
                        <span>34 Street Name, City Name Here, United States</span>
                    </li>
                    <li class="d-block">
                        <b class="d-block">Telephone:</b>
                        <span>+1 242 4942 290</span>
                    </li>
                    <li class="d-block">
                        <b class="d-block">Email:</b>
                        <span>info@yourdomain.com</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Quick Links</h3>
                <ul class="list-unstyled footer-link">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Disclaimers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-3">

            </div>
        </div>
        <div class="row">
            <div class="col-12 text-md-center text-left">
                <p>
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All Rights Reserved
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js') }}"></script>
<script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') }}"></script>
<script src="{{ asset('/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('/vendor/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/web-main.js') }}"></script>
<script src="{{ asset('/js/dashboards-analytics.js') }}"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
@yield('js')
</body>

</html>
