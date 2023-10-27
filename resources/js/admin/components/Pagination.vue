<template>
    <div>
        <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item" v-for="(v, i) in data" :key="i">
                <a class="page-link" :class="{ active: v.active, disabled: (!v.url || v.active) }" v-html="v.label" @click="pageChange(v.url)" />
            </li>
        </ul>
    </div>
</template>

<script setup>

    defineProps(['data']);
    const emit = defineEmits(['get-datas'])

    const pageChange = (url) => {
        const urlParams = new URL(url);
        emit('get-datas', urlParams.searchParams.get('page'));
    }

</script>

<style scoped>
    .page-link {
        cursor: pointer;
    }
    .active {
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    .disabled {
        pointer-events: none;
    }
</style>