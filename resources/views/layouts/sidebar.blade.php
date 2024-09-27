<ul class="navbar-nav accordion bgside sidebar sidebar-dark" id="accordionSidebar">

    <a class="d-flex align-items-center justify-content-center sidebar-brand" href="/">
        <div class="sidebar-brand-icon">
            <img class="logo img-fluid d-block auto p-2 p-md-4" src="{{asset('/logo/artxpro.png')}}" alt="Avon Logo">
        </div>
    </a>
    
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('media-manager') }}">
            <i class="fa-solid fa-photo-film"></i>
            <span>Media Manager</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" aria-expanded="true" data-toggle="collapse" aria-controls="collapseTwo"
            data-target="#blogs">
            <i class="fas fa-file-alt"></i> <span>Blogs</span>
        </a>
        <div class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" id="blogs">
            <div class="bg-white collapse-inner py-2 rounded">
                <h6 class="collapse-header">Blogs</h6>
                <a class="collapse-item" href="{{ route('blogs.index') }}">Blogs</a>
                <a class="collapse-item" href="{{ route('blogs.create') }}">Add Blog</a>
                <a class="collapse-item" href="{{ route('blogCat.index') }}">Blogs Categroies</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" aria-expanded="true" data-toggle="collapse" aria-controls="collapseTwo"
            data-target="#Queries">
            <i class="fas fa-phone-square-alt"></i> <span>Queries</span>
        </a>
        <div class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" id="Queries">
            <div class="bg-white collapse-inner py-2 rounded">
                <h6 class="collapse-header">Blogs</h6>
                <a class="collapse-item" href="{{ route('contact-queries.index') }}">Contact Queries</a>
                <a class="collapse-item" href="{{ route('brief-queries.index') }}">Brief Queries</a>
                <a class="collapse-item" href="{{ route('job-queries.index') }}">Job Queries</a>
            </div>
        </div>

    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" aria-expanded="true" data-toggle="collapse" aria-controls="collapseTwo"
            data-target="#Case">
            <i class="fa-solid fa-file-signature"></i> <span>Case Studies</span>
        </a>
        <div class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" id="Case">
            <div class="bg-white collapse-inner py-2 rounded">
                <h6 class="collapse-header">Case Studies</h6>
                <a class="collapse-item" href="{{ route('case-studies.index') }}">Case Studies</a>
                <a class="collapse-item" href="{{ route('case-studies.create') }}">Add Case</a>
                <a class="collapse-item" href="{{ route('case-categories.index') }}">Case Category</a>
            </div>
        </div>

    </li>
        
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" aria-expanded="true" data-toggle="collapse" aria-controls="collapseTwo"
            data-target="#Videos">
            <i class="fa-solid fa-video"></i><span>Videos</span>
        </a>
        <div class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" id="Videos">
            <div class="bg-white collapse-inner py-2 rounded">
                <h6 class="collapse-header">Videos</h6>
                <a class="collapse-item" href="{{ route('videos.index') }}">Videos</a>
                <a class="collapse-item" href="{{ route('videos.create') }}">Add Videos</a>
            </div>
        </div>

    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" aria-expanded="true" data-toggle="collapse" aria-controls="collapseTwo"
            data-target="#Tags">
            <i class="fa-solid fa-tag"></i><span>Tags</span>
        </a>
        <div class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" id="Tags">
            <div class="bg-white collapse-inner py-2 rounded">
                <h6 class="collapse-header">Case Studies</h6>
                <a class="collapse-item" href="{{ route('tags.index') }}">Tags</a>
                <a class="collapse-item" href="{{ route('tags.create') }}">Add Tags</a>
            </div>
        </div>

    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" aria-expanded="true" data-toggle="collapse" aria-controls="collapseTwo"
            data-target="#Pages">
            <i class="fa-solid fa-file-lines"></i><span>Pages</span>
        </a>
        <div class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" id="Pages">
            <div class="bg-white collapse-inner py-2 rounded">
                <h6 class="collapse-header">Pages</h6>
                <a class="collapse-item" href="{{ route('pages.index') }}">Pages</a>
                <a class="collapse-item" href="{{ route('pages.create') }}">Add Page</a>
            </div>
        </div>

    </li>
    <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('jobs.index') }}">
            <i class="fa-solid fa-briefcase"></i> <span>Jobs</span>
        </a>
    </li>
    <hr class="d-none d-md-block sidebar-divider">
    <div class="d-none d-md-inline text-center">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>