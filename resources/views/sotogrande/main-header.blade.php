
<!-- main header start -->
<header class="main-header sticky-header header-with-top" id="main-header-2">
  <div class="container">
      <div class="row">
          <div class="col-12">
              <nav class="navbar navbar-expand-lg navbar-light rounded">
                {{-- <a class="navbar-brand logo navbar-brand d-flex w-50 mr-auto" href="{{ route('home', ['language' => $language == 'en' ? '' : $language]) }}"> --}}
                <a class="navbar-brand logo navbar-brand d-flex w-50 mr-auto" href="{{ url_home($language) }}">
                      {{-- <img src="/sg_assets/img/logos/black-logo.png" alt="logo"> --}}
                      <img src="{{ URL::asset('assets/images/home').'/'.get_setting('site_logo', 'site') }}" alt="logo">
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="fa fa-bars"></span>
                  </button>
                  <div class="navbar-collapse collapse w-100" id="navbar">
                      <ul class="navbar-nav ml-auto">
                          <li class="nav-item">
                            <a 
                                href="{{ url_home($language) }}" 
                                class="nav-link">
                                    Home
                            </a>
                          </li>
                          <li class="nav-item">
                            <a 
                                href="{{ url_sale($language) }}" 
                                class="nav-link"
                            >
                                Sale
                            </a>
                          </li>
                          <li class="nav-item">
                            <a 
                                href="{{ url_rent($language) }}" 
                                class="nav-link"
                            >
                                Rent
                            </a>
                          </li>
                          <li class="nav-item">
                            <a 
                                href="{{ url_all_blogs($language) }}" 
                                class="nav-link">
                                    Blog
                            </a>
                          </li>
                            @if(isset($pages) && count($pages) > 0)
                                @foreach($pages as $page)
                                    <li class="nav-item">
                                        {{-- <a href="{{ route('page', ['alias' => $page->alias] ) }}" class="nav-link"> --}}
                                        <a href="{{ url_page($page->alias, $language) }}" class="nav-link">
                                            {{ $page->contentload->title }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                          {{-- <li class="nav-item dropdown active">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Index
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <li><a class="dropdown-item" href="index.html">Index 1</a></li>
                                  <li><a class="dropdown-item" href="index-2.html">Index 2</a></li>
                                  <li><a class="dropdown-item" href="index-3.html">Index 3 (Map)</a></li>
                                  <li><a class="dropdown-item" href="index-4.html">Index 4</a></li>
                                  <li><a class="dropdown-item" href="index-5.html">Index 5</a></li>
                                  <li><a class="dropdown-item" href="index-6.html">Index 6</a></li>
                                  <li><a class="dropdown-item" href="index-7.html">Index 7</a></li>
                                  <li><a class="dropdown-item" href="index-8.html">Index 8 (Video)</a></li>
                              </ul>
                          </li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Properties
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">List Layout</a>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="properties-list-rightside.html">Right Sidebar</a></li>
                                          <li><a class="dropdown-item" href="properties-list-leftside.html">Left Sidebar</a></li>
                                          <li><a class="dropdown-item" href="properties-list-fullwidth.html">Fullwidth</a></li>
                                      </ul>
                                  </li>
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Grid Layout</a>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="properties-grid-rightside.html">Right Sidebar</a></li>
                                          <li><a class="dropdown-item" href="properties-grid-leftside.html">Left Sidebar</a></li>
                                          <li><a class="dropdown-item" href="properties-grid-fullwidth.html">Fullwidth</a></li>
                                      </ul>
                                  </li>
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Map View</a>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="properties-map-rightside-list.html">Map List Right Sidebar</a></li>
                                          <li><a class="dropdown-item" href="properties-map-leftside-list.html">Map List Left Sidebar</a></li>
                                          <li><a class="dropdown-item" href="properties-map-rightside-grid.html">Map Grid Right Sidebar</a></li>
                                          <li><a class="dropdown-item" href="properties-map-leftside-grid.html">Map Grid Left Sidebar</a></li>
                                          <li><a class="dropdown-item" href="properties-map-full.html">Map FullWidth</a></li>
                                      </ul>
                                  </li>
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Property Detail</a>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="properties-details.html">Property Detail 1</a></li>
                                          <li><a class="dropdown-item" href="properties-details-2.html">Property Detail 2</a></li>
                                          <li><a class="dropdown-item" href="properties-details-3.html">Property Detail 3</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item dropdown megamenu-li">
                              <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                              <div class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                                  <div class="megamenu-area">
                                      <div class="row">
                                          <div class="col-sm-6 col-lg-3">
                                              <div class="megamenu-section">
                                                  <h6 class="megamenu-title">Pages</h6>
                                                  <a class="dropdown-item" href="about-1.html">About 1</a>
                                                  <a class="dropdown-item" href="about-2.html">About 2</a>
                                                  <a class="dropdown-item" href="properties-comparison.html">Properties Comparison</a>
                                                  <a class="dropdown-item" href="search-brand.html">Properties Brands</a>
                                                  <a class="dropdown-item" href="properties-list-rightside.html">Properties List</a>
                                                  <a class="dropdown-item" href="properties-grid-rightside.html">Properties Grid</a>
                                                  <a class="dropdown-item" href="services-1.html">Services 1</a>
                                                  <a class="dropdown-item" href="services-2.html">Services 2</a>
                                                  <a class="dropdown-item" href="coming-soon.html">Coming Soon</a>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 col-lg-3">
                                              <div class="megamenu-section">
                                                  <h6 class="megamenu-title">Pages</h6>
                                                  <a class="dropdown-item" href="agent-list.html">Agent List 1</a>
                                                  <a class="dropdown-item" href="agent-list-2.html">Agent List 2</a>
                                                  <a class="dropdown-item" href="agent-grid.html">Agent Grid 1</a>
                                                  <a class="dropdown-item" href="agent-grid-2.html">Agent Grid 2</a>
                                                  <a class="dropdown-item" href="agent-grid-3.html">Agent Grid 3</a>
                                                  <a class="dropdown-item" href="agent-detail.html">Agent Detail</a>
                                                  <a class="dropdown-item" href="pricing-tables-1.html">Pricing Tables 1</a>
                                                  <a class="dropdown-item" href="pricing-tables-2.html">Pricing Tables 2</a>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 col-lg-3">
                                              <div class="megamenu-section">
                                                  <h6 class="megamenu-title">Pages</h6>
                                                  <a class="dropdown-item" href="gallery-2column.html">Gallery 2 column</a>
                                                  <a class="dropdown-item" href="gallery-3column.html">Gallery 3 column</a>
                                                  <a class="dropdown-item" href="gallery-4column.html">Gallery 4 column</a>
                                                  <a class="dropdown-item" href="faq-1.html">Faq 1</a>
                                                  <a class="dropdown-item" href="faq-2.html">Faq 2</a>
                                                  <a class="dropdown-item" href="pages-404.html">Pages 404</a>
                                                  <a class="dropdown-item" href="typography.html">Typography</a>
                                                  <a class="dropdown-item" href="typography-2.html">Typography 2</a>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 col-lg-3">
                                              <div class="megamenu-section">
                                                  <h6 class="megamenu-title">Pages</h6>
                                                  <a class="dropdown-item" href="user-profile.html">User profile</a>
                                                  <a class="dropdown-item" href="my-properties.html">My Properties</a>
                                                  <a class="dropdown-item" href="favorited-properties.html">Favorited Properties</a>
                                                  <a class="dropdown-item" href="submit-property.html">Submit Property</a>
                                                  <a class="dropdown-item" href="login.html">Login</a>
                                                  <a class="dropdown-item" href="login-2.html">Login 2</a>
                                                  <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
                                                  <a class="dropdown-item" href="register.html">Register</a>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-3 col-lg-3">
                                              <div class="megamenu-section">
                                                  <h6 class="megamenu-title">Others</h6>
                                                  <p>
                                                      Lorem ipsum dolor sit amet, consectetu radipisi cing elitBeatae autem aperiam
                                                      nequ quaera molestias voluptatibus harum.
                                                  </p>
                                              </div>
                                          </div>
                                          <div class="col-sm-9 col-lg-9">
                                              <div class="megamenu-section">
                                                  <h6 class="megamenu-title">Others</h6>
                                                  <p>
                                                      Lorem ipsum dolor sit amet, consectetu radipisi cing elitBeatae autem aperiam nequ
                                                      quaera molestias voluptatibus harum. Lorem ipsum dolor sit amet, consectetu
                                                      radipisi cing elitBeatae autem aperiam nequ quaera molestias voluptatibus harum.
                                                  </p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Blog
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Classic</a>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="blog-classic-sidebar-right.html">Right Sidebar</a></li>
                                          <li><a class="dropdown-item" href="blog-classic-sidebar-left.html">Left Sidebar</a></li>
                                          <li><a class="dropdown-item" href="blog-classic-fullwidth.html">FullWidth</a></li>
                                      </ul>
                                  </li>
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Columns</a>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="blog-columns-2col.html">2 Columns</a></li>
                                          <li><a class="dropdown-item" href="blog-columns-3col.html">3 Columns</a></li>
                                      </ul>
                                  </li>
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Masonry</a>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="blog-masonry-2col.html">2 Masonry</a></li>
                                          <li><a class="dropdown-item" href="blog-masonry-3col.html">3 Masonry</a></li>
                                      </ul>
                                  </li>
                                  <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Blog Details</a>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="blog-single-sidebar-right.html">Right Sidebar</a></li>
                                          <li><a class="dropdown-item" href="blog-single-sidebar-left.html">Left Sidebar</a></li>
                                          <li><a class="dropdown-item" href="blog-single-fullwidth.html">Fullwidth</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Shop
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                  <a class="dropdown-item" href="shop-list.html">Shop List</a>
                                  <a class="dropdown-item" href="shop-cart.html">Shop Cart</a>
                                  <a class="dropdown-item" href="shop-checkout.html">Shop Checkout</a>
                                  <a class="dropdown-item" href="shop-single.html">Shop Details</a>
                              </div>
                          </li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Contact
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                  <a class="dropdown-item" href="contact-1.html">Contact 1</a>
                                  <a class="dropdown-item" href="contact-2.html">Contact 2</a>
                                  <a class="dropdown-item" href="contact-3.html">Contact 3</a>
                              </div>
                          </li> --}}
                          {{-- <li class="nav-item dropdown">
                              <a href="#full-page-search" class="nav-link">
                                  <i class="fa fa-search"></i>
                              </a>
                          </li> --}}
                          {{-- <li class="nav-item dropdown">
                              <a class="open-offcanvas nav-link" href="#">
                                  <span></span>
                                  <span class="fa fa-bars"></span>
                              </a>
                          </li> --}}
                      </ul>
                  </div>
              </nav>
          </div>
      </div>
  </div>
</header>
<!-- main header end -->