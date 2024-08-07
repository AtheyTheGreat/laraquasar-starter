<template>
    <q-page>
        <q-form @submit="onSubmit" class="justify-center q-gutter-md q-pa-md">
            <q-input filled v-model="service.service_name" label="Service Name" lazy-rules />
            <q-input type="textarea" filled v-model="service.service_desc" label="Service Description" lazy-rules />
            <div>
                <q-img :src="service.service_cover" style="width: 100%;" />
            </div>
            <q-file single filled v-model="service.service_cover" label="Update Service Cover Image" lazy-rules
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
const service = ref([])

const getService = async () => {
    const id = route.params.id
    const res = await axios.get(`/api/services/${id}`)
    service.value = res.data
}

const onSubmit = async () => {
    try {
        const id = route.params.id
        const res = await axios.patch(`/api/services/${id}`, client.value)
        $q.notify({
            color: 'positive',
            message: 'Client Updated',
            position: 'center'
        });
        router.push('/admin/services');
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
    getService();
})

</script>