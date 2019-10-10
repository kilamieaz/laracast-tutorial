<template>
    <div>
        <ul>
            <li v-for="item in items">
                <slot name="list-item" :data="item">{{ item }}</slot>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['items']
}
</script>