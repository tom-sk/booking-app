<script setup>
import { ref, watch, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const visible = ref(true)
const page = usePage()

const message = computed(() => page.props.flash.success || page.props.flash.error || null)

const typeClass = computed(() => {
    if (page.props.flash.success) return 'bg-green-500 text-white'
    if (page.props.flash.error) return 'bg-red-500 text-white'
    return 'bg-gray-500 text-white'
})

watch(message, (val) => {
    visible.value = !!val
})
</script>

<template>
    <div
        v-if="visible && message"
        :class="[
      'fixed top-4 right-4 z-50 rounded-lg px-4 py-3 shadow-md transition-opacity duration-300',
      typeClass
    ]"
        role="alert"
    >
        <div class="flex items-center justify-between space-x-4">
            <span>{{ message }}</span>
            <button @click="visible = false" class="text-white hover:text-gray-200">
                &times;
            </button>
        </div>
    </div>
</template>
