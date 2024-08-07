<header
    class="p-4 fixed flex flex-wrap bg-black/20 sm:justify-start sm:flex-nowrap z-50 w-full text-sm pl-4 md:pl-0 hover:bg-black dark:bg-slate-900 dark:border-gray-700 duration-500 transition-all ">
    <nav class="pr-8 pl-4 flex flex-wrap basis-full items-center w-full mx-auto sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-6 "
        aria-label="Global">
        <div class="">
            <a class="lg:pl-12 flex-none md:text-4xl text-2xl font-roboto text-white" href="/"
                aria-label="Local Arch Studio">Local Arch Studio</a>
        </div>

        <div class=" flex items-center ml-auto sm:ml-0 sm:order-3">
            <div onclick="openNav()">
                <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="18.853" height="18"
                    viewBox="0 0 18.853 12">
                    <g id="Icon_feather-menu" data-name="Icon feather-menu" transform="translate(-4.5 -8)">
                        <path id="Path_3" data-name="Path 3" d="M4.5,18H23.353" transform="translate(0 -4)"
                            fill="none" stroke="#fff" stroke-linejoin="round" stroke-width="2" />
                        <path id="Path_4" data-name="Path 4" d="M4.5,9H23.353" transform="translate(0)"
                            fill="none" stroke="#fff" stroke-linejoin="round" stroke-width="2" />
                        <path id="Path_5" data-name="Path 5" d="M4.5,27H23.353" transform="translate(0 -8)"
                            fill="none" stroke="#fff" stroke-linejoin="round" stroke-width="2" />
                    </g>
                </svg>
            </div>
        </div>

        <div onclick="exitNav()" id="sideBar"
            class="fixed top-0 right-0 bg-transparent w-0 h-full overflow-x-hidden duration-500 z-[90]">

            <!--navigation menu box-->
            <div id="sideNav"
                class="fixed top-0 right-0 text-black w-0 h-full flex justify-center items-center overflow-x-hidden duration-500 z-[90]"
                style="background-color: rgba(37, 37, 38);">
                <!--exit icon, will close navbar when clicked-->
                <a href="javascript:void(0)" onclick="exitNav()"
                    class="text-6xl absolute top-2 right-5 mr-3 mt-2 text-white">
                    <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </a>
                <!--menu links-->
                {{-- <ul class="text-3xl sm:text-3xl text-white ">
                <li class="p-2 hover:text-gray-400"><a href="{{ route('home') }}">Home</a></li>
                <li class="p-2"><a href="{{ route('project') }}">Projects</a></li>
                <li class="p-2"><a href="{{ route('services') }}">Services</a></li>
                <li class="p-2"><a href="{{ route('about') }}">About</a></li>
                <li class="p-2"><a href="{{ route('contact') }}">Contact</a></li>
            </ul> --}}
                <div _ngcontent-serverapp-c69="" class="offcanvas-content">
                    <div _ngcontent-serverapp-c69="" class="navbar-controls"><i _ngcontent-serverapp-c69=""
                            role="button" tabindex="0" class="fa-light icon fa-magnifying-glass"
                            aria-label="Open search"></i><i _ngcontent-serverapp-c69="" role="button" tabindex="0"
                            class="fa-light icon fa-xmark active" aria-label="Close Menu"></i></div>
                    <div _ngcontent-serverapp-c69="" class="body">
                        <div _ngcontent-serverapp-c69="" class="row">
                            <div _ngcontent-serverapp-c69="" id="main-links" class="col main-links">
                                <h4 _ngcontent-serverapp-c69="" class="text-grey-1">Menu</h4>
                                <ul _ngcontent-serverapp-c69="" class="navbar-nav">
                                    <li _ngcontent-serverapp-c69="" class="h1 nav-item d-flex align-items-center"><a
                                            _ngcontent-serverapp-c69="" role="link" class="nav-link active"
                                            aria-label="Projects" href="/projects/">Projects</a><i
                                            _ngcontent-serverapp-c69="" role="button" tabindex="0"
                                            class="fa-regular fa-arrow-up-right ms-2 nav-link visually-hidden-focusable"
                                            aria-label="Open Projects sub-menu"></i><!----></li><!----><!---->
                                    <li _ngcontent-serverapp-c69=""
                                        class="h1 nav-item d-flex align-items-center active"><a
                                            _ngcontent-serverapp-c69="" role="link" class="nav-link active"
                                            aria-label="Expertise" href="/expertise/">Expertise</a><i
                                            _ngcontent-serverapp-c69="" role="button" tabindex="0"
                                            class="fa-regular fa-arrow-up-right ms-2 nav-link visually-hidden-focusable"
                                            aria-label="Open Expertise sub-menu"></i><!----></li><!----><!---->
                                    <li _ngcontent-serverapp-c69="" class="h1 nav-item d-flex align-items-center"><a
                                            _ngcontent-serverapp-c69="" role="link" class="nav-link active"
                                            aria-label="Studio" href="/studio/">Studio</a><i
                                            _ngcontent-serverapp-c69="" role="button" tabindex="0"
                                            class="fa-regular fa-arrow-up-right ms-2 nav-link visually-hidden-focusable"
                                            aria-label="Open Studio sub-menu"></i><!----></li><!----><!---->
                                    <li _ngcontent-serverapp-c69="" class="h1 nav-item d-flex align-items-center"><a
                                            _ngcontent-serverapp-c69="" role="link" class="nav-link active"
                                            aria-label="People" href="/people/">People</a><i
                                            _ngcontent-serverapp-c69="" role="button" tabindex="0"
                                            class="fa-regular fa-arrow-up-right ms-2 nav-link visually-hidden-focusable"
                                            aria-label="Open People sub-menu"></i><!----></li><!----><!---->
                                    <li _ngcontent-serverapp-c69="" class="h1 nav-item d-flex align-items-center"><a
                                            _ngcontent-serverapp-c69="" role="link" class="nav-link active"
                                            aria-label="News" href="/news/">News</a><i _ngcontent-serverapp-c69=""
                                            role="button" tabindex="0"
                                            class="fa-regular fa-arrow-up-right ms-2 nav-link visually-hidden-focusable"
                                            aria-label="Open News sub-menu"></i><!----></li><!----><!---->
                                    <li _ngcontent-serverapp-c69="" class="h1 nav-item d-flex align-items-center"><a
                                            _ngcontent-serverapp-c69="" role="link" class="nav-link active"
                                            aria-label="Insights" href="/insights/">Insights</a><i
                                            _ngcontent-serverapp-c69="" role="button" tabindex="0"
                                            class="fa-regular fa-arrow-up-right ms-2 nav-link visually-hidden-focusable"
                                            aria-label="Open Insights sub-menu"></i><!----></li><!----><!---->
                                    <li _ngcontent-serverapp-c69="" class="h1 nav-item d-flex align-items-center"><a
                                            _ngcontent-serverapp-c69="" role="link" class="nav-link active"
                                            aria-label="Careers" href="/careers/">Careers</a><i
                                            _ngcontent-serverapp-c69="" role="button" tabindex="0"
                                            class="fa-regular fa-arrow-up-right ms-2 nav-link visually-hidden-focusable"
                                            aria-label="Open Careers sub-menu"></i><!----></li><!----><!---->
                                    <li _ngcontent-serverapp-c69="" class="h1 nav-item d-flex align-items-center"><a
                                            _ngcontent-serverapp-c69="" role="link" class="nav-link active"
                                            aria-label="Contact" href="/contact/">Contact</a><!----></li>
                                    <!----><!----><!---->
                                </ul>
                            </div>
                            <div _ngcontent-serverapp-c69="" id="internal-links" class="col internal-links">
                                <h4 _ngcontent-serverapp-c69="" class="text-grey-1">Expertise</h4>
                                <ul _ngcontent-serverapp-c69="" class="navbar-nav fw-bolder">
                                    <li _ngcontent-serverapp-c69="" class="h3 nav-item active"><a
                                            _ngcontent-serverapp-c69="" role="link"
                                            class="nav-link active d-flex align-items-center"
                                            aria-label="Architecture" href="/expertise/architecture/"><i
                                                _ngcontent-serverapp-c69=""
                                                class="fa-regular fa-arrow-up-right"></i>Architecture</a></li>
                                    <li _ngcontent-serverapp-c69="" class="h3 nav-item active"><a
                                            _ngcontent-serverapp-c69="" role="link"
                                            class="nav-link active d-flex align-items-center"
                                            aria-label="Climate and Sustainable Design"
                                            href="/expertise/climate-and-sustainable-design/"><i
                                                _ngcontent-serverapp-c69=""
                                                class="fa-regular fa-arrow-up-right"></i>Climate and Sustainable
                                            Design</a></li>
                                    <li _ngcontent-serverapp-c69="" class="h3 nav-item active"><a
                                            _ngcontent-serverapp-c69="" role="link"
                                            class="nav-link active d-flex align-items-center" aria-label="Engineering"
                                            href="/expertise/engineering/"><i _ngcontent-serverapp-c69=""
                                                class="fa-regular fa-arrow-up-right"></i>Engineering</a></li>
                                    <li _ngcontent-serverapp-c69="" class="h3 nav-item active"><a
                                            _ngcontent-serverapp-c69="" role="link"
                                            class="nav-link active d-flex align-items-center"
                                            aria-label="Industrial Design" href="/expertise/industrial-design/"><i
                                                _ngcontent-serverapp-c69=""
                                                class="fa-regular fa-arrow-up-right"></i>Industrial Design</a></li>
                                    <li _ngcontent-serverapp-c69="" class="h3 nav-item active"><a
                                            _ngcontent-serverapp-c69="" role="link"
                                            class="nav-link active d-flex align-items-center" aria-label="Interiors"
                                            href="/expertise/interiors/"><i _ngcontent-serverapp-c69=""
                                                class="fa-regular fa-arrow-up-right"></i>Interiors</a></li>
                                    <li _ngcontent-serverapp-c69="" class="h3 nav-item active"><a
                                            _ngcontent-serverapp-c69="" role="link"
                                            class="nav-link active d-flex align-items-center"
                                            aria-label="Technology and Research"
                                            href="/expertise/technology-and-research/"><i _ngcontent-serverapp-c69=""
                                                class="fa-regular fa-arrow-up-right"></i>Technology and Research</a>
                                    </li>
                                    <li _ngcontent-serverapp-c69="" class="h3 nav-item active"><a
                                            _ngcontent-serverapp-c69="" role="link"
                                            class="nav-link active d-flex align-items-center"
                                            aria-label="Urban and Landscape Design"
                                            href="/expertise/urban-and-landscape-design/"><i
                                                _ngcontent-serverapp-c69=""
                                                class="fa-regular fa-arrow-up-right"></i>Urban and Landscape Design</a>
                                    </li>
                                    <li _ngcontent-serverapp-c69="" class="h3 nav-item active"><a
                                            _ngcontent-serverapp-c69="" role="link"
                                            class="nav-link active d-flex align-items-center"
                                            aria-label="Workplace Consultancy"
                                            href="/expertise/workplace-consultancy/"><i _ngcontent-serverapp-c69=""
                                                class="fa-regular fa-arrow-up-right"></i>Workplace Consultancy</a></li>
                                    <!---->
                                </ul>
                            </div><!----><!----><!----><!---->
                        </div><!---->
                    </div>
                    <div _ngcontent-serverapp-c69="" class="footer">
                        <div _ngcontent-serverapp-c69="" class="btn-group"><app-button _ngcontent-serverapp-c69=""
                                _nghost-serverapp-c37=""><a _ngcontent-serverapp-c37="" role="button"
                                    class="btn btn-grey badge" id="Pintrest" target="_blank" title="Pintrest"
                                    aria-label="Pintrest" tabindex="0" aria-disabled="false"
                                    href="https://www.pinterest.co.uk/fosterpartners/"
                                    style="height: 32px; width: 32px; opacity: 1;"><!----><i
                                        _ngcontent-serverapp-c37=""
                                        class="fa-brands fa-pinterest fa-sm"></i><!----></a></app-button><app-button
                                _ngcontent-serverapp-c69="" _nghost-serverapp-c37=""><a _ngcontent-serverapp-c37=""
                                    role="button" class="btn btn-grey badge" id="Instagram" target="_blank"
                                    title="Instagram" aria-label="Instagram" tabindex="0" aria-disabled="false"
                                    href="https://www.instagram.com/fosterandpartners/?hl=en"
                                    style="height: 32px; width: 32px; opacity: 1;"><!----><i
                                        _ngcontent-serverapp-c37=""
                                        class="fa-brands fa-instagram fa-sm"></i><!----></a></app-button><app-button
                                _ngcontent-serverapp-c69="" _nghost-serverapp-c37=""><a _ngcontent-serverapp-c37=""
                                    role="button" class="btn btn-grey badge" id="Linkedin" target="_blank"
                                    title="Linkedin" aria-label="Linkedin" tabindex="0" aria-disabled="false"
                                    href="https://uk.linkedin.com/company/foster-&amp;-partners"
                                    style="height: 32px; width: 32px; opacity: 1;"><!----><i
                                        _ngcontent-serverapp-c37=""
                                        class="fa-brands fa-linkedin-in fa-sm"></i><!----></a></app-button><app-button
                                _ngcontent-serverapp-c69="" _nghost-serverapp-c37=""><a _ngcontent-serverapp-c37=""
                                    role="button" class="btn btn-grey badge" id="X / Twitter" target="_blank"
                                    title="X / Twitter" aria-label="X / Twitter" tabindex="0"
                                    aria-disabled="false" href="https://twitter.com/FosterPartners"
                                    style="height: 32px; width: 32px; opacity: 1;"><!----><i
                                        _ngcontent-serverapp-c37=""
                                        class="fa-brands fa-sm fa-x-twitter"></i><!----></a></app-button><app-button
                                _ngcontent-serverapp-c69="" _nghost-serverapp-c37=""><a _ngcontent-serverapp-c37=""
                                    role="button" class="btn btn-grey badge" id="Youtube" target="_blank"
                                    title="Youtube" aria-label="Youtube" tabindex="0" aria-disabled="false"
                                    href="https://www.youtube.com/@foster-partners"
                                    style="height: 32px; width: 32px; opacity: 1;"><!----><i
                                        _ngcontent-serverapp-c37=""
                                        class="fa-brands fa-sm fa-youtube"></i><!----></a></app-button><!----></div>
                        <div _ngcontent-serverapp-c69="" class="links"><a _ngcontent-serverapp-c69=""
                                aria-label="Subscribe to Foster + Partners" href=""
                                class="text-pure-black">Subscribe to Foster + Partners</a><a
                                _ngcontent-serverapp-c69="" aria-label="Legal and policies" href="/policy"
                                class="text-black opacity-75">Legal and policies</a></div>
                    </div><!---->
                </div>
            </div>
        </div>
    </nav>
</header>



<script>
    // function openNav() {
    //     document.getElementById("sideBar").style.width = "100%";
    //     document.getElementById("sideNav").style.width = "20%";
    // }

    // /*Close navigation*/
    // function exitNav() {
    //     document.getElementById("sideBar").style.width = "0";
    //     document.getElementById("sideNav").style.width = "0";
    // }
    function openNav() {
        // Check if the viewport width is less than or equal to 768px (usually considered a breakpoint for tablets and below)
        if (window.matchMedia("(max-width: 768px)").matches) {
            // Apply mobile styles
            document.getElementById("sideNav").style.width = "50%";
        } else {
            // Apply desktop styles
            document.getElementById("sideNav").style.width = "20%";
        }

        document.getElementById("sideBar").style.width = "100%";
    }

    function exitNav() {
        document.getElementById("sideBar").style.width = "0";
        document.getElementById("sideNav").style.width = "0";
    }

    // Optional: Close the nav when clicking outside of it
    document.getElementById("sideBar").addEventListener("click", function(event) {
        if (event.target === document.getElementById("sideBar")) {
            exitNav();
        }
    });
</script>
