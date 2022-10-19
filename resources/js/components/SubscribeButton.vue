<template>
    <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props: ['active'],

        data() {
            return {
                isActive: this.active
            }
        },

        computed: {
            classes() {
                return ['btn', this.isActive ? 'btn-primary' : 'btn-outline-primary'];
            }
        },

        methods: {
            subscribe() {
                const requestType = this.isActive ? 'delete' : 'post';

                axios[(requestType)](location.pathname + '/subscriptions');

                this.isActive = ! this.isActive;
            }
        }
    }
</script>
