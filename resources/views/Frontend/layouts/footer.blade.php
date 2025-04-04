<footer class="py-5">
    <div class="container-lg">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6">
                <div class="footer-menu">
                    <img src="{{ asset('frontend/assets/images/logo.png') }}" width="240" height="70" alt="logo">
                    <div class="social-links mt-3">
                        <ul class="d-flex list-unstyled gap-2">
                            <li><a href="#" class="btn btn-outline-light"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="btn btn-outline-light"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="btn btn-outline-light"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="#" class="btn btn-outline-light"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Company</h5>
                    <ul class="menu-list list-unstyled">
                        <li><a href="#" class="nav-link">About us</a></li>
                        <li><a href="#" class="nav-link">Careers</a></li>
                        <li><a href="#" class="nav-link">Affiliate Programme</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Quick Links</h5>
                    <ul class="menu-list list-unstyled">
                        <li><a href="#" class="nav-link">Offers</a></li>
                        <li><a href="#" class="nav-link">Track Order</a></li>
                        <li><a href="#" class="nav-link">Shop</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Support</h5>
                    <ul class="menu-list list-unstyled">
                        <li><a href="#" class="nav-link">FAQ</a></li>
                        <li><a href="#" class="nav-link">Contact</a></li>
                        <li><a href="#" class="nav-link">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Subscribe</h5>
                    <p>Get updates about our latest offers.</p>
                    <form class="d-flex mt-3 gap-0">
                        <input class="form-control rounded-start bg-light" type="email" placeholder="Email Address">
                        <button class="btn btn-dark rounded-end" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="footer-bottom">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>© {{ date('Y') }} THULO🛒CART. All rights reserved.</p>
            </div>
            <div class="col-md-6 credit-link text-start text-md-end">
                <p><a href=""></a> Distributed By <a href="">Roman Thapa</a> </p>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('frontend/assets/js/jquery-1.11.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<script src="{{ asset('frontend/assets/js/plugins.js') }}"></script>
<script src="{{ asset('frontend/assets/js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function changeImage(event, src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
        event.target.classList.add('active');
    }
</script>

<script>
    function updateQuantity(productId, change) {
        const input = event.target.parentElement.querySelector('.quantity-input');
        let value = parseInt(input.value) + change;
        if (value >= 1) {
            input.value = value;
        }
    }
</script>


