<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4">
            <x-dashadmin :title="__('Dashbaord')" />
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-card :title="'Total Projects'" :value="$overallStats['total_projects']" :color="'teal'"  :change="'1.7'" :lastWeek="'5'" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-card :title="'Total Tasks'" :value="$overallStats['total_tasks']" :color="'sky'" :change="'2.7'" :lastWeek="'15'"/>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-card :title="'Total completed'" :value="$overallStats['total_completed']" :color="'red'" :change="'1.8'" :lastWeek="'6'"/>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-card :title="'Avarage progress'" :value="$overallStats['average_progress']" :color="'pink'" :change="'.9'" :lastWeek="'3'"/>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-card :title="'To do'" :value="$overallStats['todo']" :color="'purple'" :change="'0.7'" :lastWeek="'5'"/>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-card :title="'Register User'" :value="$overallStats['total_users']" :change="'3.7'" :lastWeek="'25'"/>
            </div>
        </div>
    </div>
</x-layouts.app>
