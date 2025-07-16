<script setup>
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    client: {
        type: Object,
        required: true,
    }
})

const form = useForm({
    id: props.client.id,
    name: props.client.name ?? '',
    email: props.client.email ?? '',
    phone: props.client.phone ?? '',
    notes: props.client.notes ?? '',
})

function cancel() {
    router.visit(route('clients.index'))
}
</script>

<template>
    <form @submit.prevent="form.put(route('clients.update', form.id))">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Client Information</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Update client details below.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- Name -->
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                        <div class="mt-2">
                            <input
                                type="text"
                                id="name"
                                v-model="form.name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            />
                            <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2">
                            <input
                                type="email"
                                id="email"
                                v-model="form.email"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            />
                            <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="sm:col-span-4">
                        <label for="phone" class="block text-sm/6 font-medium text-gray-900">Phone</label>
                        <div class="mt-2">
                            <input
                                type="text"
                                id="phone"
                                v-model="form.phone"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            />
                            <p v-if="form.errors.phone" class="mt-2 text-sm text-red-600">{{ form.errors.phone }}</p>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="col-span-full">
                        <label for="notes" class="block text-sm/6 font-medium text-gray-900">Notes</label>
                        <div class="mt-2">
              <textarea
                  id="notes"
                  v-model="form.notes"
                  rows="3"
                  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
              />
                            <p v-if="form.errors.notes" class="mt-2 text-sm text-red-600">{{ form.errors.notes }}</p>
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-600">Optional internal notes about the client.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900" @click="cancel">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" :disabled="form.processing">
                Save
            </button>
        </div>
    </form>
</template>
