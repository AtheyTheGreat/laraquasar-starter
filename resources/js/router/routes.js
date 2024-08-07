const routes = [
    {
        path: '/admin',
        component: () => import('../layouts/MainLayout.vue'),
        meta: { requireAuth: true},
        children: [
            {
                path: "roles",
                component: () => import("../pages/RolePage.vue"),
                meta: { permission: "roles.index" },
                children: [
                    {
                        path: "",
                        component: () => import("../components/RoleTable.vue"),
                        meta: { permission: "roles.index" },
                    },
                ],
            },
            {
                path: 'projects',
                component: () => import('../pages/ProjectPage.vue'),
                meta: { permission: 'projects.index' },
                children: [
                    {
                        path: "",
                        component: () => import('../components/ProjectTable.vue'),
                        meta: { permission: 'projects.index' }
                    },
                    {
                        path: ":id/edit",
                        component: () => import("../components/ProjectEdit.vue"),
                        meta: { permission: 'projects.edit' }
                    },
                ],
            },
            {
                path: 'covers',
                component: () => import('../pages/GalleryPage.vue'),
                meta: { permission: 'galleries.index' },
                children: [
                    {
                        path: "",
                        component: () => import('../components/GalleryTable.vue'),
                        meta: { permission: 'galleries.index' }
                    },
                    {
                        path: ":id/edit",
                        component: () => import("../components/GalleryEdit.vue"),
                        meta: { permission: 'galleries.edit' }
                    },
                ],
            },
            {
                path: 'abouts',
                component: () => import('../pages/AboutPage.vue'),
                meta: { permission: 'abouts.index' },
                children: [
                    {
                        path: "",
                        component: () => import('../components/AboutTable.vue'),
                        meta: { permission: 'abouts.index' }
                    },
                    {
                        path: ":id/edit",
                        component: () => import("../components/AboutEdit.vue"),
                        meta: { permission: 'abouts.edit' }
                    },
                ],
            },
            {
                path: 'clients',
                component: () => import('../pages/ClientPage.vue'),
                meta: { permission: 'clients.index' },
                children: [
                    {
                        path: "",
                        component: () => import('../components/ClientTable.vue'),
                        meta: { permission: 'clients.index' }
                    },
                    {
                        path: ":id/edit",
                        component: () => import("../components/ClientEdit.vue"),
                        meta: { permission: 'clients.edit' }
                    },
                ],
            },
            {
                path: 'services',
                component: () => import('../pages/ServicePage.vue'),
                meta: { permission: 'services.index' },
                children: [
                    {
                        path: "",
                        component: () => import('../components/ServiceTable.vue'),
                        meta: { permission: 'services.index' }
                    },
                    {
                        path: ":id/edit",
                        component: () => import("../components/ServiceEdit.vue"),
                        meta: { permission: 'services.edit' }
                    },
                ],
            },
            {
                path: 'tags',
                component: () => import('../pages/TagPage.vue'),
                meta: { permission: 'tags.index' },
                children: [
                    {
                        path: "",
                        component: () => import('../components/TagTable.vue'),
                        meta: { permission: 'tags.index' }
                    },
                    {
                        path: ":id/edit",
                        component: () => import("../components/TagEdit.vue"),
                        meta: { permission: 'tags.edit' }
                    },
                ],
            },
        ],
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
