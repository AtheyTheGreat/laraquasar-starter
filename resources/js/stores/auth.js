import {defineStore} from 'pinia';
import {ref} from 'vue';

export const useAuthStore = defineStore('authStore', () => {

    const authUser = ref(null)

    const getToken = async () => {
        return await axios.get("/sanctum/csrf-cookie");
    }

    const fetchMe = async () => {
        return await axios.get('/api/me').then(data => data.data);
    }

    const getUser = async () => {
        if (localStorage.getItem("authUser")) {
            const storedUser = await JSON.parse(localStorage.getItem("authUser"));
            const needUserRefresh =
                storedUser?.browser_stored_at === undefined ||
                (new Date() - new Date(storedUser?.browser_stored_at)) / 1000 / 60 > 0.5; // > than 2 minutes
            if (needUserRefresh) {
                await setAuthUser();
            } else {
                authUser.value = storedUser;
            }
        } else {
            await setAuthUser();
        }
        return authUser.value;
    };

    const setAuthUser = async (user = null) => {

        if (user === null) {
            authUser.value = await fetchMe()
            authUser.value["browser_stored_at"] = new Date()
            await localStorage.setItem('authUser', JSON.stringify(authUser.value))
            return;
        }

        await localStorage.setItem('authUser', JSON.stringify(user))
        return;
    }

    const logout = async () => {
        authUser.value = null;
        localStorage.removeItem("authUser");
        await axios.get('/user-logout')
        window.location.reload();
    };

    const userHasPermission = (permission) => {
        if (permission === undefined)
            return false;
        const permissions = authUser.value.permissions ?? []
        return permissions.find(item => item === permission) === permission
    }

    return {
        authUser,
        getUser,
        getToken,
        setAuthUser,
        logout,
        userHasPermission,
    }

})
