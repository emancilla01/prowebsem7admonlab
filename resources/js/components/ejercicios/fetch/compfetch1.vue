<template>
<ul v-for="usuario in usuarios" :key="usuario.id">
    <li>{{ usuario.id }}</li>
    <li>{{ usuario.name }}</li>
    <li>{{ usuario.email }}</li>
</ul>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <tr v-for="usuario in usuarios" :key="usuario.id">
        <td> {{ usuario.id }}</td>
        <td> {{ usuario.name }}</td>
        <td> {{ usuario.email }}</td>
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