<template>
    <q-page>
        <q-form @submit="onSubmit" class="justify-center q-gutter-md q-pa-md">
            <q-input filled v-model="client.name" label="Client Name" lazy-rules />
            <q-input filled v-model="client.testimonial_giver" label="Client Testimonial Giver" lazy-rules />
            <q-input filled v-model="client.testimonial_giver_position" label="Client Testimonial Giver Position"
                lazy-rules />
            <q-input type="textarea" filled v-model="client.testimonial" label="Client Testimonial" lazy-rules />
            <div>
                <q-img :src="client.logo" style="width: 100%;" />
            </div>
            <q-file single filled v-model="client.logo" label="Update Client Image or Logo" lazy-rules
                :headers="[{ name: 'X-XSRF-TOKEN', value: getCookie('XSRF-TOKEN') }]" />
            <div class="row justify-end q-gutter-sm">
                <q-btn label="Go Back" color="primary" @click="router.push('/admin/client')" />
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
const client = ref([])

const getClient = async () => {
    const id = route.params.id
    const res = await axios.get(`/api/clients/${id}`)
    client.value = res.data
}

const onSubmit = async () => {
    try {
        const id = route.params.id
        const res = await axios.patch(`/api/clients/${id}`, client.value)
        $q.notify({
            color: 'positive',
            message: 'Client Updated',
            position: 'center'
        });
        router.push('/admin/clients');
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
    getClient();
})

</script>