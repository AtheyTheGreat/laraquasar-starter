<template>
    <q-page class="q-pa-md q-gutter-md">
        <q-table :rows="clients" :columns="columns" title="Clients" hide-bottom :pagination="pagination"
            :separator="separator" flat>
            <template v-slot:top-right>
                <q-btn v-if="clients.length === 0" color="secondary" icon-right="add" label="Add Clients" no-caps
                    @click="form = true" />
            </template>
            <template v-slot:body-cell-logo="props">
                <q-td :props="props">
                    <q-img :src="props.row.logo" />
                </q-td>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props">
                    <q-btn icon="edit" rounded dense flat color="positive"
                        @click="$router.push(`/admin/clients/${props.row.id}/edit`)" />
                    <q-btn icon="delete" rounded dense flat color="negative" @click="onDelete(props)" />
                </q-td>
            </template>
        </q-table>
        <q-dialog v-model="form">
            <q-card class="q-pa-md" style="width: 900px; max-width: 100vw;">
                <q-form @submit="onSubmit" class="q-gutter-md">
                    <q-input filled v-model="formData.name" label="Client Name" lazy-rules />
                    <q-file single filled v-model="formData.logo" label="Upload Client Image or Logo" lazy-rules
                        :headers="[{ name: 'X-XSRF-TOKEN', value: getCookie('XSRF-TOKEN') }]" />
                    <q-input filled v-model="formData.testimonial_giver" label="Testimonial Giver" lazy-rules />
                    <q-input filled v-model="formData.testimonial_giver_position" label="Testimonial Giver Designation"
                        lazy-rules />
                    <q-input type="textarea" filled v-model="formData.testimonial" label="Testimonial" lazy-rules />
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
const clients = ref([])
const separator = ref("none");

const formData = ref({
});

const onDelete = async (props) => {
    try {
        const id = props.row.id
        const res = await axios.delete(`/api/clients/${id}`)
        $q.notify({
            color: 'positive',
            message: 'Project Deleted',
            position: 'center'
        });
        getClients('/api/clients')
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
    getClients(pagination.value.next_page_url)
    router.push({ path: '', query: { page: nextPageNumber } })
}

const prevPage = () => {
    const prevPageNumber = pagination.value.prev_page_url.match(/page=(\d+)/)[1];
    getClients(pagination.value.prev_page_url)
    router.push({ path: '', query: { page: prevPageNumber } })
}

const getClients = async (endpoint = null, params = {}) => {
    if (!endpoint)
        return;

    const res = await axios.get(endpoint, { params: { ...params }, })

    clients.value = res.data.data
    pagination.value.rowsPerPage = res.data.per_page
    pagination.value.next_page_url = res.data.next_page_url
    pagination.value.prev_page_url = res.data.prev_page_url

}

const onSubmit = async () => {
    try {
        const res = await axios.post('/api/clients', formData.value, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
        $q.notify({
            color: 'positive',
            message: 'Project Created',
            position: 'center'
        });
        getClients('/api/clients')
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
        name: "name",
        label: "Client Name",
        field: "name",
        required: true,
        align: "left",
        format: (val) => `${val}`,
    },
    {
        name: "logo",
        label: "Client Picture or Logo",
        field: "logo",
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
        getClients('/api/clients', { page: route.query.page });
    } catch (err) {
        console.error(err);
        done(true);
    }
}

onLoad();

</script>
