<nav
    class="navbar navbar-expand-sm navbar-dark bg-primary"
   >
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
        <img src="{{ asset('logo.png') }}" alt="Logo" style="height:56px;" />        
    </a>
    
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/categorias') }}" aria-current="page"
                    >Categorias <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/personal') }}" aria-current="page"
                    >Personal <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/periodos') }}" aria-current="page"
                    >Periodos <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/carreras') }}" aria-current="page"
                    >Carreras <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/espaciosdetrabajo') }}" aria-current="page"
                    >Espacios de Trabajo <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/software') }}" aria-current="page"
                    >Software <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="logout" aria-current="page"
                    >Logout <span class="visually-hidden">(current)</span></a
                >
            </li>
            
        </ul>
        <form class="d-flex my-2 my-lg-0">
            <input
                class="form-control me-sm-2"
                type="text"
                placeholder="Search"
            />
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                Search
            </button>
        </form>
    </div>
</nav>