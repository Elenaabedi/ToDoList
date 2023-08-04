<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NewTask from '../Components/NewTask.vue';

import { Head } from '@inertiajs/vue3';

// Recibimos desde el controlador
const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    }
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <NewTask></NewTask>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="table-responsive tableContent">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width=60>Tasks</th>
                                </tr>
                            </thead>
                            <tbody v-if="tasks">
                                <tr v-for="task in tasks" :key="task.id">
                                    <td>
                                        {{ task.description }}
                                        <button class="">Delete</button>
                                        <button>Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td>No hi ha tasquest a mostrar</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
