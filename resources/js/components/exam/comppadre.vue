<template>
<header>
    <h1>Programacion web</h1>
    <h2>Examen Practico unidad 3</h2>
    <hr>
</header>
<nav>
    <ul class="links-row">
        <li><a href="" @click.prevent="ver(0)">Inicio</a></li>
        <li><a href="" @click.prevent="ver(1)">Ver foto</a></li>
        <li><a href="" @click.prevent="ver(2)">Fotos repetidas</a></li>
        <li><a href="" @click.prevent="ver(3)">Contador de mensajes</a></li>
        <li><a href="" @click.prevent="ver(4)">Lista de personal</a></li>
    </ul>
</nav>

<main>
    <section>
        <div v-if="mostrar === 0">
            <h2>Bienvenido al examen practico de la unidad 3</h2>
        </div>
        <compverfoto v-if="mostrar === 1" />
        <compfotos v-if="mostrar === 2" />
        <compcontador v-if="mostrar === 3" />
        <complista v-if="mostrar === 4" />
    </section>
</main>
<footer>
    <p>No. de control: 22430208</p><br>
    <p>Ezequiel Mancilla Martinez</p>
</footer>
</template>

<script setup>
import compverfoto from './verfoto.vue';
import compfotos from './fotos.vue';
import compcontador from './contador.vue';
import complista from './lista.vue';
import { ref } from 'vue';

const mostrar = ref(0);

function ver(op) {
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

<style scoped>
.links-row {
    display: flex;
    gap: 12px;
    list-style: none;
    padding: 0;
    margin: 0 0 1rem 0;
}
.links-row li {
    margin: 0;
}
.links-row a {
    color: #0d6efd;
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 4px;
}
.links-row a:hover {
    background: rgba(13,110,253,0.08);
}

main section p {
    margin: 1rem 0;
}
</style>