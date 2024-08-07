<template>
    <q-page>
        <q-form @submit="onSubmit" class="justify-center q-gutter-md q-pa-md">
            <div>
                <q-img :src="project.cover_image" />
            </div>
            <q-file single filled v-model="project.cover_image" label="Update Cover Image" lazy-rules
                :headers="[{ name: 'X-XSRF-TOKEN', value: getCookie('XSRF-TOKEN') }]" />
            <q-input filled v-model="project.title" label="Project Name" lazy-rules />
            <q-input filled v-model="project.project_year" mask="date" :rules="['date']">
                <template v-slot:append>
                    <q-icon name="event" class="cursor-pointer">
                        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                            <q-date v-model="project.project_year">
                                <div class="row items-center justify-end">
                                    <q-btn v-close-popup label="Close" color="primary" flat />
                                </div>
                            </q-date>
                        </q-popup-proxy>
                    </q-icon>
                </template>
            </q-input>
            <q-input filled v-model="project.project_area" label="Project Area" lazy-rules />
            <q-input filled v-model="project.client_name" label="Client Name" lazy-rules />
            <q-select filled :options="tagOptions" label="Select Type Of Project" v-model="project.tag_id" />
            <q-input type="textarea" filled v-model="project.desc" label="Project Description" lazy-rules />
            <div class="row">
                <div class="q-pa-md q-gutter-md">
                    <q-img v-for="image in project.images" :key="image" :src="image" style="width: 220px; height: 220px"/>
                </div>
            </div>
            <q-file single filled v-model="project.images" label="Upload Project 3D's" lazy-rules
                :headers="[{ name: 'X-XSRF-TOKEN', value: getCookie('XSRF-TOKEN') }]" multiple />

            <div class="row justify-end q-gutter-sm">
                <q-btn label="Go Back" color="primary" @click="router.push('/admin/projects')" />
                <q-btn label="Update" type="submit" color="primary" />
            </div>
        </q-form>
    </q-page>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter, useRoute } from "vue-router"
import { useQuasar } from 'quasar'

const $q = useQuasar()
const router = useRouter()
const route = useRoute()
const project = ref([])
const tags = ref([])
const tagOptions = ref([])

const getProject = async () => {
    const id = route.params.id
    const res = await axios.get(`/api/projects/${id}`)
    project.value = res.data
    project.value.tag_id = res.data.tags[0].tags
}

const getTags = async () => {
    const res = await axios.get('/api/tags')
    tags.value = res.data.data
    tagOptions.value = tags.value.map(tags => ({
        label: tags.tags,
        value: tags.id,
    }))
}

const onSubmit = async () => {
    try {
        const id = route.params.id
        // console.log(project.value)
        const res = await axios.post(`/api/projects/${id}`, project.value, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-HTTP-Method-Override': 'PATCH'
            },
        })
        $q.notify({
            color: 'positive',
            message: 'Project Updated',
            position: 'center'
        });
        router.push('/admin/projects');
    } catch (error) {
        $q.notify({
            color: 'negative',
            message: 'Failed to Update',
            position: 'center'
        });
    }
}

const getCookie = computed(() => (key) => {
    var value =
        decodeURIComponent(
            document.cookie.replace(
                new RegExp(
                    "(?:(?:^|.*;)\\s*" +
                    encodeURIComponent(key).replace(/[\-\.\+\*]/g, "\\$&") +
                    "\\s*\\=\\s*([^;]*).*$)|^.*$"
                ),
                "$1"
            )
        ) || null;
    if (
        value &&
        ((value.substring(0, 1) === "{" &&
            value.substring(value.length - 1, value.length) === "}") ||
            (value.substring(0, 1) === "[" &&
                value.substring(value.length - 1, value.length) === "]"))
    ) {
        try {
            value = JSON.parse(value);
        } catch (e) {
            return value;
        }
    }
    return value;
});

onMounted(() => {
    getProject();
    getTags();
})

</script>