<template>
    <h1>mensajes</h1>

    <div class="message-input">
        <label for="">mensaje</label>
        <input type="text" v-model="newMessage" @keyup.enter="insertar" placeholder="" />
        <button @click="insertar">Insertar</button>
        <span class="count"> {{ messages.length }}</span>
    </div>

    <div class="messages-box" v-if="messages.length">
        <div v-for="msg in messages" :key="msg.id" class="msg">{{ msg.text }}</div>
    </div>

    <hr />

    
</template>

<script setup>
import { ref, onMounted } from 'vue';

const posts = ref([]);

const ObtenerPost = () => {
    fetch('https://jsonplaceholder.typicode.com/posts')
        .then((response) => response.json())
        .then((data) => {
            posts.value = data;
        });
};

// Messages logic (persisted in localStorage)
const STORAGE_KEY = 'contador_messages_v1';
const messages = ref([]);
const newMessage = ref('');

function loadMessages() {
    try {
        const raw = localStorage.getItem(STORAGE_KEY);
        if (raw) messages.value = JSON.parse(raw);
    } catch (e) {
        messages.value = [];
    }
}

function saveMessages() {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(messages.value));
    } catch (e) {
        // ignore
    }
}

function insertar() {
    const text = (newMessage.value || '').trim();
    if (!text) return;
    messages.value.push({ id: Date.now(), text });
    newMessage.value = '';
    saveMessages();
}

onMounted(() => {
    ObtenerPost();
    loadMessages();
});
</script>

<style scoped>
.message-input{
    display:flex;
    gap:8px;
    align-items:center;
    margin-bottom:12px;
}
.message-input input[type="text"]{
    /* flex:1; */
    padding:6px 8px;
}
.message-input button{
    padding:6px 10px;
}
.count{
    margin-left:8px;
    font-weight:600;
}
.messages-box{
    border:1px solid #ddd;
    padding:8px;
    border-radius:6px;
    max-height:200px;
    overflow:auto;
    margin-bottom:12px;
}
.msg{
    padding:6px 4px;
    border-bottom:1px solid #f0f0f0;
}
.msg:last-child{border-bottom:none}
</style>