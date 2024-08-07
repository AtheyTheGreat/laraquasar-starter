<template>
    <q-page>
        <q-form @submit="onSubmit" class="justify-center q-gutter-md q-pa-md">
            <div>
                <q-img :src="covers.cover_image"/>
            </div>

            <q-file single filled v-model="covers.gallery" label="Update Cover Image" lazy-rules
                :headers="[{ name: 'X-XSRF-TOKEN', value: getCookie('XSRF-TOKEN') }]" />

            <div class="row justify-end q-gutter-sm">
                <q-btn label="Go Back" color="primary" @click="router.push('/admin/covers')" />
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
const covers = ref([])

const getCover = async () => {
    const id = route.params.id
    const res = await axios.get(`/api/galleries/${id}`)
    covers.value = res.data
}

const onSubmit = async () => {
    try {
        const id = route.params.id
        const res = await axios.post(`/api/galleries/${id}`, covers.value, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-HTTP-Method-Override': 'PATCH'
            },
        })
        $q.notify({
            color: 'positive',
            message: 'Category Updated',
            position: 'center'
        });
        router.push('/admin/covers');
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
    getCover();
})

</script>