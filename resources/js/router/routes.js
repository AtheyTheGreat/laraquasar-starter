const routes = [
    {
        path: '/admin',
        component: () => import('../layouts/MainLayout.vue'),
        meta: { requireAuth: true},
        children: [],
    },

    {
        // path: "/setup",
        // component: SetupLayout,
        // children: [
        //     {
        //         path: "",
        //         name: "setup",
        //         component: SetupLayout
        //     },
        // ],
    },
];

export default routes;
