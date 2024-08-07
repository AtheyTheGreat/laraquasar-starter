<template>
    <q-page>
        <q-form @submit="onSubmit" class="justify-center q-gutter-md q-pa-md">
            <div>
                <q-img :src="abouts.image"/>
            </div>
            <q-file single filled v-model="abouts.about" label="Upload Cover Image" lazy-rules
                :headers="[{ name: 'X-XSRF-TOKEN', value: getCookie('XSRF-TOKEN') }]" />
            <q-input filled v-model="abouts.title" label="Page Title" lazy-rules />
            <q-input type="textarea" filled v-model="abouts.desc" label="About Description" lazy-rules />
            <div class="row justify-end q-gutter-sm">
                <q-btn label="Go Back" color="primary" @click="router.push('/admin/abouts')" />
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
const abouts = ref([])

const getAbouts = async () => {
    const id = route.params.id
    const res = await axios.get(`/api/abouts/${id}`)
    abouts.value = res.data
}

const onSubmit = async () => {
    try {
        const id = route.params.id
        const res = await axios.patch(`/api/abouts/${id}`, abouts.value)
        $q.notify({
            color: 'positive',
            message: 'About Page Updated',
            position: 'center'
        });
        router.push('/admin/abouts');
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
    getAbouts();
})

</script>