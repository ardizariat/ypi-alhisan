 <div id="sidebar" class="active">
     <div class="sidebar-wrapper active">
         <div class="sidebar-header position-relative">
             <div class="d-flex justify-content-between align-items-center">
                 <div class="logo">
                     <a href="/"><img src="{{ asset('storage/alhisan/' . alhisan()->logo) }}" alt="Logo"
                             srcset=""></a>
                 </div>
                 <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                     <div class="form-check form-switch fs-6">
                         <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                     </div>
                 </div>
                 <div class="sidebar-toggler  x">
                     <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                 </div>
             </div>
         </div>
         <div class="sidebar-menu">
             <ul class="menu">
                 <li class="sidebar-title">Menu</li>
                 <li class="sidebar-item {{ activeClass('admin.dashboard.index') }}">
                     <a href="{{ route('admin.dashboard.index') }}" class='sidebar-link'>
                         <i class="bi bi-grid-fill"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
                 <li class="sidebar-item {{ activeClass('admin.alhisan.index') }}">
                     <a href="{{ route('admin.alhisan.index') }}" class='sidebar-link'>
                         <i class="bi bi-gear-wide-connected"></i>
                         <span>Alhisan</span>
                     </a>
                 </li>
                 <li
                     class="sidebar-item {{ activeClass('admin.artikel.index') }} {{ activeClass('admin.artikel.create') }} {{ activeClass('admin.artikel.edit') }} ">
                     <a href="{{ route('admin.artikel.index') }}" class='sidebar-link'>
                         <i class="bi bi-pen"></i>
                         <span>Artikel</span>
                     </a>
                 </li>
                 <li class="sidebar-item {{ activeClass('admin.kalimat-hikmah.index') }}">
                     <a href="{{ route('admin.kalimat-hikmah.index') }}" class='sidebar-link'>
                         <i class="bi bi-vector-pen"></i>
                         <span>Kalimat Hikmah</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a href="application-gallery.html" class="sidebar-link">
                         <i class="bi bi-image-fill"></i>
                         <span>Poster Dakwah</span>
                     </a>
                 </li>
                 <li
                     class="sidebar-item {{ activeClass('admin.rapat-yayasan.index') }} {{ activeClass('admin.rapat-yayasan.show') }} {{ activeClass('admin.rapat-yayasan.create') }}">
                     <a href="{{ route('admin.rapat-yayasan.index') }}" class='sidebar-link'>
                         <i class="bi bi-border-width"></i>
                         <span>Rapat Yayasan</span>
                     </a>
                 </li>
                 <li
                     class="sidebar-item has-sub {{ activeClass('admin.kas-keluar.index') }} {{ activeClass('admin.kas-masuk.index') }}">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-currency-exchange"></i>
                         <span>Kas</span>
                     </a>
                     <ul
                         class="submenu {{ activeClass('admin.kas-keluar.index') }} {{ activeClass('admin.kas-masuk.index') }}">
                         <li class="submenu-item {{ activeClass('admin.kas-masuk.index') }}">
                             <a href="{{ route('admin.kas-masuk.index') }}">Kas Masuk</a>
                         </li>
                         <li class="submenu-item {{ activeClass('admin.kas-keluar.index') }}">
                             <a href="{{ route('admin.kas-keluar.index') }}">Kas Keluar</a>
                         </li>
                     </ul>
                 </li>
             </ul>
         </div>
     </div>
 </div>
