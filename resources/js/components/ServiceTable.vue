<template>
    <q-page class="q-pa-md q-gutter-md">
        <q-table :rows="services" :columns="columns" title="Services" hide-bottom :pagination="pagination"
            :separator="separator" flat>
            <template v-slot:top-right>
                <q-btn v-if="services.length === 0" color="secondary" icon-right="add" label="Add Services" no-caps
                    @click="form = true" />
            </template>
            <template v-slot:body-cell-service_cover="props">
                <q-td :props="props">
                    <q-img :src="props.row.service_cover" />
                </q-td>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props">
                    <q-btn icon="edit" rounded dense flat color="positive"
                        @click="$router.push(`/admin/services/${props.row.id}/edit`)" />
                    <q-btn icon="delete" rounded dense flat color="negative" @click="onDelete(props)" />
                </q-td>
            </template>
        </q-table>
        <q-dialog v-model="form">
            <q-card class="q-pa-md" style="width: 900px; max-width: 100vw;">
                <q-form @submit="onSubmit" class="q-gutter-md">
                    <q-input filled v-model="formData.service_name" label="Service Name" lazy-rules />
                    <q-input type="textarea" filled v-model="formData.service_desc" label="Service Description"
                        lazy-rules />
                    <q-file single filled v-model="formData.service_cover" label="Upload Service Cover Image" lazy-rules
                        :headers="[{ name: 'X-XSRF-TOKEN', value: getCookie('XSRF-TOKEN') }]" />
                    <q-btn label="Submit" type="submit" color="primary" v-close-popup />
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
const services = ref([])
const separator = ref("none");

const formData = ref({
});

const onDelete = async (props) => {
    try {
        const id = props.row.id
        const res = await axios.delete(`/api/services/${id}`)
        $q.notify({
            color: 'positive',
            message: 'Project Deleted',
            position: 'center'
        });
        getServices('/api/services')
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
    getServices(pagination.value.next_page_url)
    router.push({ path: '', query: { page: nextPageNumber } })
}

const prevPage = () => {
    const prevPageNumber = pagination.value.prev_page_url.match(/page=(\d+)/)[1];
    getServices(pagination.value.prev_page_url)
    router.push({ path: '', query: { page: prevPageNumber } })
}

const getServices = async (endpoint = null, params = {}) => {
    if (!endpoint)
        return;

    const res = await axios.get(endpoint, { params: { ...params }, })

    services.value = res.data.data
    pagination.value.rowsPerPage = res.data.per_page
    pagination.value.next_page_url = res.data.next_page_url
    pagination.value.prev_page_url = res.data.prev_page_url

}

const onSubmit = async () => {
    try {
        const res = await axios.post('/api/services', formData.value, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
        $q.notify({
            color: 'positive',
            message: 'Project Created',
            position: 'center'
        });
        getServices('/api/services')
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
        name: "service_name",
        label: "Service Name",
        field: "service_name",
        required: true,
        align: "left",
        format: (val) => `${val}`,
    },
    {
        name: "service_cover",
        label: "Service Cover Photo",
        field: "service_cover",
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
        getServices('/api/services', { page: route.query.page });
    } catch (err) {
        console.error(err);
        done(true);
    }
}

onLoad();

</script>
