<template>
    <q-page>
        <div class="q-pa-md">
            <q-card flat class="row q-px-md q-mt-md q-mb-md">
                <q-card-section style="width:100%" class="q-pb-xl">
                    <div class="text-h5 q-py-md">Roles</div>
                    <div class="row justify-end">
                        <q-select outlined label="Roles" v-model="state.formData['role']" :options="state.roles"
                            option-label="name" style="width: 250px" @update:model-value="rolePermission()" />
                    </div>
                    <div class="text-h6">Permissions</div>
                    <div class="row" v-if="state.formData['role']?.id">
                        <div v-for="permission in state.permissions" :key="permission.id" class="col-4 q-pa-md">
                            <q-checkbox :disable="!state.formData['role']" v-model="state.formData[permission.name]"
                                :label="permission.name" @update:model-value="handleCheckboxChange(permission)" />
                        </div>
                    </div>
                    <div v-else class="row items-center justify-center text-center" style="height: 20vh">
                        <div>
                            <div class="text-caption">
                                Select an Role to view Permissions
                            </div>
                            No roles selected
                        </div>
                    </div>
                </q-card-section>
            </q-card>
        </div>
    </q-page>
</template>

<script setup>
import { reactive, onMounted } from 'vue'
import { useQuasar } from 'quasar'

const q = useQuasar()

const state = reactive({
    permissions: [],
    rolePer: [],
    roles: [],
    formData: {
        role: null,
        permission: false,
    },
})

const fetchPermissions = async () => {
    const { data } = await axios.get('/api/permissions');
    state.permissions = data;
    state.formData = data.reduce((acc, cur) => {
        acc[cur.name] = false;
        return acc;
    }, {});
};

const fetchRoles = async () => {
    const { data } = await axios.get('/api/roles');
    state.roles = data;
};

const rolePermission = () => {
    const id = state.formData['role']?.id;
    if (id) {
        axios
            .get(`/api/roles/${id}/permissions`)
            .then((response) => {
                // console.log(response);
                state.rolePer = response.data;
                for (const permission of state.permissions) {
                    state.formData[permission.name] =
                        state.rolePer.findIndex((rp) => rp.id === permission.id) !== -1;
                }
            })
            .catch((error) => {
                console.error(error);
            });
    } else {
        state.rolePer = [];
        for (const permission of state.permissions) {
            state.formData[permission.name] = false;
        }
    }
};

const handleCheckboxChange = (permission) => {
    const permissionName = permission.name;
    const permissionValue = state.formData[permissionName];
    const roleId = state.formData.role.id;

    if (permissionValue) {
        axios
            .post('/api/roles/update', {
                role_id: roleId,
                permission_name: permissionName,
            })
            .then((response) => {
                q.notify({
                    type: 'primary',
                    message: 'Permission updated successfully!',
                    position: 'bottom',
                    timeout: 20 * 1000,
                    closeBtn: true,
                });
            })
            .catch((error) => {
                q.notify({
                    type: 'red',
                    message: 'Failed to update permission.',
                    position: 'bottom',
                    timeout: 20 * 1000,
                    closeBtn: true,
                });
                console.error('Failed to update permission:', error);
            });
    } else {
        axios
            .post('/api/roles/revoke', {
                role_id: roleId,
                permission_name: permissionName,
            })
            .then((response) => {
                q.notify({
                    type: 'red',
                    message: 'Permission revoked successfully!',
                    position: 'bottom',
                    timeout: 20 * 1000,
                    closeBtn: true,
                });
            })
            .catch((error) => {
                q.notify({
                    type: 'red',
                    message: 'Failed to revoke permission.',
                    position: 'bottom-',
                    timeout: 20 * 1000,
                    closeBtn: true,
                });
                console.error('Failed to revoke permission:', error);
            });
    }
};


onMounted(async () => {
    await fetchPermissions()
    await fetchRoles()
})
</script>
