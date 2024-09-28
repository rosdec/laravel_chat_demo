<script>
import { ref } from 'vue'
import axios from 'axios';

export default {
    data() {
        return {
            messages: [],
            newMessage: "",
        };
    },
    methods: {
        async postMessage(text) {
            try {
                await axios.post(`/message`, {
                    text,
                });
                // After posting, retrieve messages to include the new one
                this.getMessages();
            } catch (err) {
                console.log(err.message);
            }
        },
        async getMessages() {
            try {
                const response = await axios.get('/messages');
                this.messages = response.data;
                // Scroll to the bottom after messages are updated
                this.scrollToBottom();
            } catch (err) {
                console.log(err.message);
            }
        },
        sendMessage() {
            if (this.newMessage.trim() !== "") {
                this.postMessage(this.newMessage.trim());
                this.newMessage = "";
            } else {
                return;
            }
        },
        scrollToBottom() {
            this.$nextTick(() => {
                const messageList = document.getElementById('messagelist');
                if (messageList) {
                    messageList.scrollTop = messageList.scrollHeight;
                }
            });
        }
    },
    created() {
        this.getMessages();

        window.Echo.private("channel_for_everyone")
            .listen('GotMessage', (e) => {
                this.getMessages();
            });
    },
};
</script>

<template>
    <div class="container">
        <div class="chat-box" id="messagelist">
            <div v-for="(message, index) in messages" :key="index" class="message">
                <strong>{{ message.user.name }}:</strong> {{ message.text }}
                <small class="text-muted float-right">{{ message.time }}</small>
            </div>
        </div>
        <div class="input-area">
            <input v-model="newMessage" @keyup.enter="sendMessage" type="text"
                placeholder="Type your message here..." />
            <button @click="sendMessage">Send</button>
        </div>
    </div>
</template>

<style scoped>
.chat-box {
    border: 1px solid #ccc;
    padding: 10px;
    max-height: 300px;
    overflow-y: auto;
}

.message {
    margin-bottom: 10px;
}
</style>
