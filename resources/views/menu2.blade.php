<nav
    class="navbar navbar-expand-sm navbar-dark bg-primary"
   >
    <a class="navbar-brand" href="{{ url('/inicio2') }}">Comercializadora</a>
    
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/clientes') }}" aria-current="page"
                    >Clientes <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/ventas') }}" aria-current="page"
                    >Ventas <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/categorias') }}" aria-current="page"
                    >Categorias <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/productos') }}" aria-current="page"
                    >Productos <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/empleados') }}" aria-current="page"
                    >Empleados <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/departamentos') }}" aria-current="page"
                    >Departamentos <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/proveedores') }}" aria-current="page"
                    >Proveedores <span class="visually-hidden">(current)</span></a
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