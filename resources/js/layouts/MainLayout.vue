<template>
    <q-layout view="hHh lpR fFf">

        <q-header elevated class="">
            <q-toolbar>
                <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />

                <q-toolbar-title>
                    Portal
                </q-toolbar-title>
                <q-btn label="logout" icon="logout" flat rounded @click="authStore.logout()" />
            </q-toolbar>
        </q-header>

        <q-drawer show-if-above v-model="leftDrawerOpen" side="left" bordered>
            <MenuItems />
        </q-drawer>

        <q-page-container>
            <router-view />
        </q-page-container>

    </q-layout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '../stores/auth';
import MenuItems from '../components/MenuItems.vue'


const authStore = useAuthStore()

const user = ref({})

onMounted(async () => {
    user.value = await authStore.getUser();
})

const leftDrawerOpen = ref(false)

const toggleLeftDrawer = () => {
    leftDrawerOpen.value = !leftDrawerOpen.value
}

</script>
