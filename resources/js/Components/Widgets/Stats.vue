<template>
    <div class="bg-zinc-50 p-4">
        <h3 class="text-base font-semibold text-gray-900">Last 30 days</h3>
        <dl class="mt-5 grid grid-cols-1 divide-gray-200 overflow-hidden rounded-lg bg-white shadow-sm md:grid-cols-3 md:divide-x md:divide-y-0">
            <div v-for="item in stats" :key="item.name" class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">{{ item.name }}</dt>
                <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                        {{ item.stat }}
                        <span class="ml-2 text-sm font-medium text-gray-500">from {{ item.previousStat }}</span>
                    </div>

                    <div :class="[item.changeType === 'increase' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800', 'inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0']">
                        <ArrowUpIcon v-if="item.changeType === 'increase'" class="mr-0.5 -ml-1 size-5 shrink-0 self-center text-green-500" aria-hidden="true" />
                        <ArrowDownIcon v-else class="mr-0.5 -ml-1 size-5 shrink-0 self-center text-red-500" aria-hidden="true" />
                        <span class="sr-only"> {{ item.changeType === 'increase' ? 'Increased' : 'Decreased' }} by </span>
                        {{ item.change }}
                    </div>
                </dd>
            </div>
        </dl>
    </div>
</template>

<script setup>
import { ArrowDownIcon, ArrowUpIcon } from '@heroicons/vue/20/solid'

const stats = [
    { name: 'Total Subscribers', stat: '71,897', previousStat: '70,946', change: '12%', changeType: 'increase' },
    { name: 'Avg. Open Rate', stat: '58.16%', previousStat: '56.14%', change: '2.02%', changeType: 'increase' },
    { name: 'Avg. Click Rate', stat: '24.57%', previousStat: '28.62%', change: '4.05%', changeType: 'decrease' },
]
</script>
