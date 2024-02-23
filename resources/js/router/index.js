
import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes";
import { useAuthStore } from "../stores/auth.js";


const router = createRouter({
    history: createWebHistory(),
    routes,
});


router.beforeEach(async (to, from, next) => {
    const authUser = useAuthStore();
    if (!authUser.authUser) {
        await authUser.getUser();
    }
    if (to.meta.permission) {
        const requiredPermission = to.meta.permission;
        if (authUser.userHasPermission(requiredPermission)) {
            next();
        } else {
            next("/admin");
        }
    } else {
        next();
    }
});


export default router;
