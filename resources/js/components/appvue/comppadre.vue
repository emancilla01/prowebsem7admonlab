<template>
<header>
    <h1>Componente Padre</h1>
</header>
<nav>
    <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Acerca de</a></li>
        <li><a href="#">Contacto</a></li>
        <li><a href="" @click.prevent="ver(1)">Ver Usuarios</a></li>
        <li><a href="" @click.prevent="ver(2)">Ver Posts</a></li>
        <li><a href="" @click.prevent="ver(3)">Ver Personal</a></li>
    </ul>
</nav>
<main>
    <section>
        <compusuarios v-if="mostrar == 1" />
        <compposts v-if="mostrar == 2" />
        <comppersonal v-if="mostrar == 3" />
    </section>
</main>
<footer>
    <p>2024 mi aplicacion Vue.js</p>
</footer>
</template>

<script setup>
import compusuarios from './compusuarios.vue';
import compposts from './compposts.vue';
import comppersonal from './comppersonal.vue';
import {ref} from "vue";
const mostrar = ref(0);
const etiqueta = ref(1);

function ver(op){
    mostrar.value = op;
}


// const mostrar = ref(0);
// const etiqueta = ref("Ver Usuarios");
// function ver(op){
//     mostrar.value = op;
//     mostrarusuarios.value = !mostrarusuarios.value;
//     etiqueta.value = mostrarusuarios.value ? "Ocultar Usuarios" : "Ver Usuarios";
// }
</script>