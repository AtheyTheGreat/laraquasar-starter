<template>
    <q-page class="q-pa-md q-gutter-md">
        <q-table :rows="projects" :columns="columns" title="Projects" hide-bottom :pagination="pagination"
            :separator="separator" flat>
            <template v-slot:top-right>
                <q-btn color="secondary" icon-right="add" label="Add New Projects" no-caps @click="form = true" />
            </template>
            <template v-slot:body-cell-cover="props">
                <q-td :props="props">
                    <q-img :src="props.row.cover_image" />
                </q-td>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props">
                    <q-btn icon="edit" rounded dense flat color="positive"
                        @click="$router.push(`/admin/projects/${props.row.id}/edit`)" />
                    <q-btn icon="delete" rounded dense flat color="negative" @click="onDelete(props)" />
                </q-td>
            </template>
        </q-table>
        <q-dialog v-model="form">
            <q-card class="q-pa-md" style="width: 900px; max-width: 100vw;">
                <q-form @submit="onSubmit" class="q-gutter-md">
                    <q-file single filled v-model="formData.cover_image" label="Upload Cover Image" lazy-rules
                        :headers="[{ name: 'X-XSRF-TOKEN', value: getCookie('XSRF-TOKEN') }]" />
                    <q-input filled v-model="formData.title" label="Project Name" lazy-rules />
                    <q-input filled v-model="formData.project_year" mask="date" :rules="['date']">
                        <template v-slot:append>
                            <q-icon name="event" class="cursor-pointer">
                                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                    <q-date v-model="formData.project_year">
                                        <div class="row items-center justify-end">
                                            <q-btn v-close-popup label="Close" color="primary" flat />
                                        </div>
                                    </q-date>
                                </q-popup-proxy>
                            </q-icon>
                        </template>
                    </q-input>
                    <q-input filled v-model="formData.project_area" label="Project Area" lazy-rules />
                    <q-input filled v-model="formData.client_name" label="Client Name" lazy-rules />
                    <q-select filled :options="tagOptions" label="Select Type Of Project" v-model="formData.tag_id" />
                    <q-input type="textarea" filled v-model="formData.desc" label="Project Description" lazy-rules />
                    <q-file single filled v-model="formData.images" label="Upload Project 3D's" lazy-rules
                        :headers="[{ name: 'X-XSRF-TOKEN', value: getCookie('XSRF-TOKEN') }]" multiple />
                    <div class="row justify-end">
                        <q-btn label="Submit" type="submit" color="primary" v-close-popup />
                    </div>
                </q-form>
            </q-card>
        </q-dialog>
    </q-page>
</template>

<script setup>
import { onMounted, ref, computed } from 'vue'
import { useRouter, useRoute } from "vue-router"
import { useQuasar } from 'quasar'

const $q = useQuasar()
const route = useRoute()
const router = useRouter()
const form = ref(false)
const projects = ref([])
const tags = ref([])
const tagOptions = ref([])
const separator = ref("none");

const formData = ref({
});

const onDelete = async (props) => {
    try {
        const id = props.row.id
        const res = await axios.delete(`/api/projects/${id}`)
        $q.notify({
            color: 'positive',
            message: 'Project Deleted',
            position: 'center'
        });
        getProjects('/api/projects')
    } catch (error) {
        $q.notify({
            color: 'negative',
            message: 'Failed to Delete Project',
            position: 'center'
        });
    }
}


const pagination = ref({
    rowsPerPage: 10,
    next_page_url: null,
    prev_page_url: null,
    current_page: null,
})

const nextPage = () => {
    const nextPageNumber = pagination.value.next_page_url.match(/page=(\d+)/)[1];
    getProjects(pagination.value.next_page_url)
    router.push({ path: '', query: { page: nextPageNumber } })
}

const prevPage = () => {
    const prevPageNumber = pagination.value.prev_page_url.match(/page=(\d+)/)[1];
    getProjects(pagination.value.prev_page_url)
    router.push({ path: '', query: { page: prevPageNumber } })
}

const getProjects = async (endpoint = null, params = {}) => {
    if (!endpoint)
        return;

    const res = await axios.get(endpoint, { params: { ...params }, })

    projects.value = res.data.data
    pagination.value.rowsPerPage = res.data.per_page
    pagination.value.next_page_url = res.data.next_page_url
    pagination.value.prev_page_url = res.data.prev_page_url

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
        const res = await axios.post('/api/projects', formData.value, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
        $q.notify({
            color: 'positive',
            message: 'Project Created',
            position: 'center'
        });
        getProjects('/api/projects')
    } catch (error) {
        $q.notify({
            color: 'negative',
            message: 'Failed to Create Project',
            position: 'center'
        });
    }
}

const columns = [
    {
        name: "id",
        label: "No",
        field: "id",
        required: true,
        align: "left",
        format: (val) => `${val}`,
    },
    {
        name: "title",
        label: "Project Name",
        field: "title",
        required: true,
        align: "left",
        format: (val) => `${val}`,
    },
    {
        name: "cover",
        label: "Project Cover",
        field: "cover",
        required: true,
        align: "left",
        format: (val) => `${val}`,
    },
    {
        name: "actions",
        label: "Actions",
        field: "actions",
        required: true,
        align: "center",
    },
]

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

const onLoad = (done) => {
    if (nextPage.value === null) {
        done(true)
        return;
    }
    try {
        getTags();
        getProjects('/api/projects', { page: route.query.page });
    } catch (err) {
        console.error(err);
        done(true);
    }
}

onLoad();

</script>
