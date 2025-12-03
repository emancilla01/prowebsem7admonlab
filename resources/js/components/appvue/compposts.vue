<template>
<!-- <ul v-for="usuario in usuarios" :key="usuario.id">
    <li>{{ usuario.id }}</li>
    <li>{{ usuario.name }}</li>
    <li>{{ usuario.email }}</li>
</ul> -->
<table>
    <tr>
        <th>ID Usuario</th>
        <th>ID</th>
        <th>Titulo</th>
        <th>Descripcion</th>
    </tr>
    <tr v-for="post in posts" :key="post.id">
        <td> {{ post.userId }}</td>
        <td> {{ post.id }}</td>
        <td> {{ post.title }}</td>
        <td> {{ post.body }}</td>
    </tr>
</table>
</template>

<script setup>
import {ref, onMounted} from "vue";
const usuarios = ref([]);

const ObtenerUsuarios = () => {
    fetch('https://jsonplaceholder.typicode.com/users/')
    .then(response => {return response.json()})
    .then(data => {usuarios.value = data;})

};
    
onMounted(() => {
    ObtenerUsuarios();
});
</script>