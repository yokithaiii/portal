<script setup>
import { ref, onMounted, defineProps } from 'vue';
import axios from 'axios';

const props = defineProps(['messages', 'room']);
const messages = ref(props.messages || []);
const body = ref('');
const receiverPhoto = ref(props.room.receiver.photo);
const senderPhoto = ref(props.room.sender.photo);
const senderId = ref(props.room.sender.id);

const store = () => {
    axios.post('/chat/send', { body: body.value })
        .then((res) => {
            body.value = '';
        });
};

onMounted(() => {
    window.Echo.channel('chat').listen('.chat', (res) => {
        messages.value.push(res.message);
    });
});
</script>


<template>
    <div class="pt-3 pe-3 perfect-scrollbar ps ps--active-y" data-mdb-perfect-scrollbar="true" style="position: relative; height: 100%;">
        <div v-for="message in messages" :key="message">
            <template v-if="message.user_id_sender == senderId">
                <div class="d-flex flex-row" :class="['message', message.user_id_sender == senderId ? 'justify-content-end' : 'justify-content-start']">
                    <div>
                        <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary" style="background-color: #e9e9e9;">
                            {{ message.body }}
                        </p>
                        <p class="small ms-3 mb-3 rounded-3 text-muted float-end">{{ message.time }}</p>
                    </div>
                    <img class="rounded-circle" :src="'/storage/' + senderPhoto" alt="avatar 1" style="width: 45px; height: 45px">
                </div>
            </template>
            <template v-else>
                <div class="d-flex flex-row" :class="['message', message.user_id_sender == senderId ? 'justify-content-end' : 'justify-content-start']">
                    <img class="rounded-circle" :src="'/storage/' + receiverPhoto" alt="avatar 1" style="width: 45px; height: 45px">
                    <div>
                        <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #e9e9e9;">
                            {{ message.body }}
                        </p>
                        <p class="small ms-3 mb-3 rounded-3 text-muted float-end">{{ message.time }}</p>
                    </div>
                </div>
            </template>
        </div>

        <div class="text-muted d-flex justify-content-start align-items-center pt-3 mt-2" style="width: 100%; gap: 10px;">
            <img class="rounded-circle" :src="'/storage/' + senderPhoto" alt="avatar 3" style="width: 40px; height: 40px;">
            <input v-model="body" type="text" class="form-control" placeholder="Type message">
            <a @click.prevent="store" href="#" class="btn btn-primary">Send</a>
        </div>

    </div>
</template>


<style scoped>

</style>
