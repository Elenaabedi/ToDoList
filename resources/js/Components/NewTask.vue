<script setup>
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import SubmitButton from '../Components/SubmitButton.vue';

/**
 * Inputs from the controller
 */
const form = reactive({
    description: null,
})

// Request form  
async function onSubmit(values) {
    router.post('/dashboard/store', form);
}

</script>

<template>
    <div>
        <form @submit="onSubmit" class="ms-5 me-5">
            <!-- Description task -->
            <div class="form-group col mt-3">
                <label class="mb-2"><b>Insert a new task</b></label>
                <input as="textarea" name="description" class="form-control" v-model="form.description" />
            </div>
            <!--Submit-->
            <div class="form-group mt-3 mb-3 d-md-flex justify-content-md-end">
                <!-- <button type="button" class="btn btn-primary text-primary">Primary</button> -->
                <SubmitButton></SubmitButton>
            </div>
        </form>
    </div>
</template>