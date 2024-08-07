<template>
    <div class="q-pa-md q-gutter-md" color="blue-grey-2">
        <q-list padding class="rounded-borders" style="max-width: 350px">
            <q-item-label header>Content Management</q-item-label>

            <div v-if="user.userType === 'SUPER_USER'">
                <q-item clickable v-ripple to="/admin/projects">
                    <q-item-section avatar top>
                        <q-avatar icon="article" color="secondary" text-color="white" />
                    </q-item-section>

                    <q-item-section class="text-uppercase">
                        <q-item-label lines="1">Projects</q-item-label>
                    </q-item-section>
                </q-item>
            </div>

            <div v-if="user.userType === 'SUPER_USER'">
                <q-item clickable v-ripple to="/admin/covers">
                    <q-item-section avatar top>
                        <q-avatar icon="image" color="secondary" text-color="white" />
                    </q-item-section>

                    <q-item-section class="text-uppercase">
                        <q-item-label lines="1">Cover Images</q-item-label>
                    </q-item-section>
                </q-item>
            </div>

            <div v-if="user.userType === 'SUPER_USER'">
                <q-item clickable v-ripple to="/admin/abouts">
                    <q-item-section avatar top>
                        <q-avatar icon="image" color="secondary" text-color="white" />
                    </q-item-section>

                    <q-item-section class="text-uppercase">
                        <q-item-label lines="1">Abouts Page</q-item-label>
                    </q-item-section>
                </q-item>
            </div>

            <div v-if="user.userType === 'SUPER_USER'">
                <q-item clickable v-ripple to="/admin/clients">
                    <q-item-section avatar top>
                        <q-avatar icon="image" color="secondary" text-color="white" />
                    </q-item-section>

                    <q-item-section class="text-uppercase">
                        <q-item-label lines="1">Clients</q-item-label>
                    </q-item-section>
                </q-item>
            </div>

            <div v-if="user.userType === 'SUPER_USER'">
                <q-item clickable v-ripple to="/admin/services">
                    <q-item-section avatar top>
                        <q-avatar icon="image" color="secondary" text-color="white" />
                    </q-item-section>

                    <q-item-section class="text-uppercase">
                        <q-item-label lines="1">Services</q-item-label>
                    </q-item-section>
                </q-item>
            </div>


            <q-separator spaced />
            <q-item-label header>App Settings</q-item-label>

            <div v-if="user.userType === 'SUPER_USER'">
                <q-item clickable v-ripple to="/admin/tags">
                    <q-item-section avatar top>
                        <q-avatar icon="sort" color="secondary" text-color="white" />
                    </q-item-section>
                    <q-item-section>
                        <q-item-label lines="1">Project Types</q-item-label>
                    </q-item-section>
                </q-item>
            </div>


            <!-- <div v-if="user.userType === 'SUPER_USER'">
                <q-item clickable v-ripple to="/admin/statuses">
                    <q-item-section avatar top>
                        <q-avatar icon="sort" color="secondary" text-color="white" />
                    </q-item-section>
                    <q-item-section>
                        <q-item-label lines="1">Status</q-item-label>
                    </q-item-section>
                </q-item>
            </div> -->

            <div v-if="user.userType === 'SUPER_USER'">
                <q-item clickable v-ripple to="/admin/users">
                    <q-item-section avatar top>
                        <q-avatar icon="person" color="secondary" text-color="white" />
                    </q-item-section>

                    <q-item-section>
                        <q-item-label lines="1">Users</q-item-label>
                    </q-item-section>

                </q-item>
            </div>

            <!-- <q-item clickable v-ripple to="/admin/medias">
                <q-item-section avatar top>
                    <q-avatar icon="image" color="secondary" text-color="white" />
                </q-item-section>

                <q-item-section>
                    <q-item-label lines="1">Media Gallery</q-item-label>
                </q-item-section>

            </q-item> -->

            <div v-if="user.userType === 'SUPER_USER'">
                <q-item clickable v-ripple to="/admin/roles">
                    <q-item-section avatar top>
                        <q-avatar icon="settings" color="secondary" text-color="white" />
                    </q-item-section>

                    <q-item-section>
                        <q-item-label lines="1">Permisions</q-item-label>
                    </q-item-section>

                </q-item>
            </div>

        </q-list>
    </div>
</template>

<script setup>
import { onMounted, ref, computed } from 'vue';
import { useAuthStore } from '../stores/auth.js';
import { useRoute } from 'vue-router';

const route = useRoute()

const authStore = useAuthStore()

const user = ref({})

onMounted(async () => {
    user.value = await authStore.getUser();
})

</script>

<style></style>
