        <!-- Layout navigation-->
        <div id="layoutDrawer_nav">
            <!-- Drawer navigation-->
            <nav class="drawer accordion drawer-light bg-white" id="drawerAccordion">
                <div class="drawer-menu">
                    <div class="nav">
                        <!-- Drawer section heading (Account)-->
                        <div class="drawer-menu-heading d-sm-none">Account</div>
                        <!-- Drawer link (Notifications)-->
                        <a class="nav-link d-sm-none" href="#!">
                            <div class="nav-link-icon"><i class="material-icons">notifications</i></div>
                            Notifications
                        </a>
                        <!-- Drawer link (Messages)-->
                        <a class="nav-link d-sm-none" href="#!">
                            <div class="nav-link-icon"><i class="material-icons">mail</i></div>
                            Zpravy
                        </a>
                        <!-- Divider-->
                        <div class="drawer-menu-divider d-sm-none"></div>
                        <!-- Drawer section heading (Interface)-->
                        <div class="drawer-menu-heading">ГОЛОВНЕ МЕНЮ</div>
                        <!-- Drawer link (Overview)-->
                        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                            <div class="nav-link-icon"><i class="material-icons">dashboard</i></div>
                            Дошка
                        </a>
                        <!-- Drawer link (Dashboards)-->
                        {{-- <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                            <div class="nav-link-icon"><i class="material-icons">dashboard</i></div>
                            Dashboards
                            <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                        </a> --}}
                        <!-- Nested drawer nav (Dashboards)-->
                        <div class="collapse" id="collapseDashboards" aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">
                            <nav class="drawer-menu-nested nav">
                                <a class="nav-link" href="app-dashboard-default.html">Default</a>
                                <a class="nav-link" href="app-dashboard-minimal.html">Minimal</a>
                                <a class="nav-link" href="app-dashboard-analytics.html">Analytics</a>
                                <a class="nav-link" href="app-dashboard-accounting.html">Accounting</a>
                                <a class="nav-link" href="app-dashboard-orders.html">Orders</a>
                                <a class="nav-link" href="app-dashboard-projects.html">Projects</a>
                            </nav>
                        </div>
                        <!-- Drawer link (Layouts)-->
                        {{-- <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="nav-link-icon"><i class="material-icons">mail</i></div>
                            Zprávy
                            <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                        </a> --}}
                        <!-- Nested drawer nav (Layouts)-->
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">
                            <nav class="drawer-menu-nested nav">
                                {{-- <a class="nav-link" href="{{ route('admin.contacts.index') }}">Seznam zpráv</a> --}}
                            </nav>
                        </div>
                        <!-- Drawer link (Pages)-->
                        {{-- <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="nav-link-icon"><i class="material-icons">layers</i></div>
                            Pages
                            <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                        </a> --}}
                        <!-- Nested drawer nav (Pages)-->
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#drawerAccordion">
                            <nav class="drawer-menu-nested nav accordion" id="drawerAccordionPages">
                                <!-- Drawer link (Pages -> Account)-->
                                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAccount" aria-expanded="false" aria-controls="pagesCollapseAccount">
                                    Account
                                    <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                                </a>
                                <!-- Nested drawer nav (Pages -> Account)-->
                                <div class="collapse" id="pagesCollapseAccount" aria-labelledby="headingOne" data-bs-parent="#drawerAccordionPages">
                                    <nav class="drawer-menu-nested nav">
                                        <a class="nav-link" href="app-account-billing.html">Billing</a>
                                        <a class="nav-link" href="app-account-notifications.html">Notifications</a>
                                        <a class="nav-link" href="app-account-profile.html">Profile</a>
                                        <a class="nav-link" href="app-account-security.html">Security</a>
                                    </nav>
                                </div>
                                <!-- Drawer link (Pages -> Authentication)-->
                                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                                </a>
                                <!-- Nested drawer nav (Pages -> Authentication)-->
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#drawerAccordionPages">
                                    <nav class="drawer-menu-nested nav">
                                        <a class="nav-link" href="app-auth-login-basic.html">Login 1</a>
                                        <a class="nav-link" href="app-auth-login-styled-1.html">Login 2</a>
                                        <a class="nav-link" href="app-auth-login-styled-2.html">Login 3</a>
                                        <a class="nav-link" href="app-auth-register-basic.html">Register</a>
                                        <a class="nav-link" href="app-auth-password-basic.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <!-- Drawer link (Pages -> Blank Pages)-->
                                <a class="nav-link" href="app-blank-page.html">Blank Page</a>
                                <!-- Drawer link (Pages -> Error)-->
                                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                                </a>
                                <!-- Nested drawer nav (Pages -> Error)-->
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#drawerAccordionPages">
                                    <nav class="drawer-menu-nested nav">
                                        <a class="nav-link" href="app-error-400.html">400 Error Page</a>
                                        <a class="nav-link" href="app-error-401.html">401 Error Page</a>
                                        <a class="nav-link" href="app-error-403.html">403 Error Page</a>
                                        <a class="nav-link" href="app-error-404.html">404 Error Page</a>
                                        <a class="nav-link" href="app-error-429.html">429 Error Page</a>
                                        <a class="nav-link" href="app-error-500.html">500 Error Page</a>
                                        <a class="nav-link" href="app-error-503.html">503 Error Page</a>
                                        <a class="nav-link" href="app-error-504.html">504 Error Page</a>
                                    </nav>
                                </div>
                                <!-- Drawer link (Pages -> Pricing)-->
                                <a class="nav-link" href="app-invoice.html">Invoice</a>
                                <!-- Drawer link (Pages -> Knowledgebase)-->
                                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseKnowledgebase" aria-expanded="false" aria-controls="pagesCollapseKnowledgebase">
                                    Knowledgebase
                                    <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                                </a>
                                <!-- Nested drawer nav (Pages -> Knowledgebase)-->
                                <div class="collapse" id="pagesCollapseKnowledgebase" aria-labelledby="headingOne" data-bs-parent="#drawerAccordionPages">
                                    <nav class="drawer-menu-nested nav">
                                        <a class="nav-link" href="app-knowledgebase-home.html">Home</a>
                                        <a class="nav-link" href="app-knowledgebase-categories.html">Categories</a>
                                        <a class="nav-link" href="app-knowledgebase-article.html">Article</a>
                                    </nav>
                                </div>
                                <!-- Drawer link (Pages -> Pricing)-->
                                <a class="nav-link" href="app-pricing.html">Pricing</a>
                            </nav>
                        </div>
                        <!-- Divider-->
                        <div class="drawer-menu-divider"></div>
                        <!-- Drawer section heading (UI Toolkit)-->
                        <div class="drawer-menu-heading">КРАМНИЦЯ</div>
                        <!-- Drawer link (Components)-->
                        {{-- <a class="nav-link" href="{{ route('admin.orders.index') }}"></a> --}}
                        <a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="bi bi-journal-bookmark-fill"></i>
                            <div class="nav-link-icon"></div>
                            Замовлення
                        </a>

                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseComponents" aria-expanded="false" aria-controls="collapseComponents">
                            <div class="nav-link-icon"><i class="material-icons">widgets</i></div>
                            Види товарів
                            <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                        </a>
                        <!-- Nested drawer nav (Components)-->
                        <div class="collapse" id="collapseComponents" aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">
                            <nav class="drawer-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.productTypes.index')}}">Список виду товарів</a>
                                <a class="nav-link" href="{{ route('admin.productTypes.create')}}">Створити вид товарів</a>
                                {{-- <a class="nav-link" href="{{ route('admin.services.index') }}">Služby</a>
                                <a class="nav-link" href="{{ route('admin.services.create') }}">Vytvořit službu</a> --}}
                            </nav>
                        </div>
                        <!-- Drawer link (Content)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseContent" aria-expanded="false" aria-controls="collapseContent">
                            <div class="nav-link-icon"><i class="material-icons">amp_stories</i></div>
                            Категорії товарів
                            <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                        </a>
                        <!-- Nested drawer nav (Content)-->
                        <div class="collapse" id="collapseContent" aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">
                            <nav class="drawer-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.productCategories.index') }}">Список категорій товарів</a>
                                <a class="nav-link" href="{{ route('admin.productCategories.create') }}">Cтворити категорію товарів</a>
                            </nav>
                        </div>
                        <!-- Drawer link (Forms)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseForms" aria-expanded="false" aria-controls="collapseForms">
                            <div class="nav-link-icon">
                                {{-- <i class="material-icons">directions_car</i> --}}
                                <i class="bi bi-boxes"></i>
                            </div>
                            Товари
                            <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                        </a>
                        <!-- Nested drawer nav (Forms)-->
                        <div class="collapse" id="collapseForms" aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">
                            <nav class="drawer-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.products.index') }}">Список товарів</a>
                                <a class="nav-link" href="{{ route('admin.products.create') }}">Створити товар</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="javascript:void(0);"  data-bs-toggle="collapse" data-bs-target="#collapsePromoCode" aria-expanded="false" aria-controls="collapsePromoCode">
                            <div class="nav-link-icon"><i class="material-icons">discount</i></div>
                            Промо код
                            <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                        </a>
                        <div class="collapse" id="collapsePromoCode" aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">
                            <nav class="drawer-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.promoCode.index') }}">Список промо кодів</a>
                                <a class="nav-link" href="{{ route('admin.promoCode.create') }}">Створити промо код</a>
                            </nav>
                        </div>
                        <!-- Drawer link (Utilities)-->
                        {{-- <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
                            <div class="nav-link-icon"><i class="material-icons">price_change</i></div>
                            Ceny
                            <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                        </a> --}}
                        <!-- Nested drawer nav (Utilities)-->
                        <div class="collapse" id="collapseUtilities" aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">
                            <nav class="drawer-menu-nested nav">
                                {{-- <a class="nav-link" href="{{ route('admin.prices.index') }}">Ceny seznam</a>
                                <a class="nav-link" href="{{ route('admin.prices.create') }}">Vytvořit cenu</a> --}}
                            </nav>
                        </div>
                        <!-- Divider-->
                        <div class="drawer-menu-divider"></div>
                        <!-- Drawer section heading (Plugins)-->
                        <div class="drawer-menu-heading">НАЛАШТУВАННЯ</div>
                        <!-- Drawer link (Charts)-->
                        <a class="nav-link collapsed" href="javascript:void(0);"  data-bs-toggle="collapse" data-bs-target="#collapseUzers" aria-expanded="false" aria-controls="collapseUzers">
                            <div class="nav-link-icon"><i class="material-icons">person</i></div>
                            Користувачі
                            <div class="drawer-collapse-arrow"><i class="material-icons">expand_more</i></div>
                        </a>
                        <div class="collapse" id="collapseUzers" aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">
                            <nav class="drawer-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.users.index') }}">Список користувачів</a>
                                <a class="nav-link" href="{{ route('admin.users.create') }}">Створити нового користувача</a>
                            </nav>
                        </div>

                        {{-- <!-- Drawer link (Code Blocks)-->
                        <a class="nav-link" href="plugins-code-blocks.html">
                            <div class="nav-link-icon"><i class="material-icons">code</i></div>
                            Code Blocks
                        </a>
                        <!-- Drawer link (Data Tables)-->
                        <a class="nav-link" href="plugins-data-tables.html">
                            <div class="nav-link-icon"><i class="material-icons">filter_alt</i></div>
                            Data Tables
                        </a>
                        <!-- Drawer link (Date Picker)-->
                        <a class="nav-link" href="plugins-date-picker.html">
                            <div class="nav-link-icon"><i class="material-icons">date_range</i></div>
                            Date Picker
                        </a> --}}
                    </div>
                </div>
                <!-- Drawer footer        -->
                <div class="drawer-footer border-top">
                    <div class="d-flex align-items-center">
                        <i class="material-icons text-muted">account_circle</i>
                        <div class="ms-3">
                            <div class="caption">Logged in as:</div>
                            <div class="small fw-500">Start Bootstrap</div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
